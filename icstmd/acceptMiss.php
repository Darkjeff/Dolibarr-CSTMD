<?php
/* <one line to give the program's name and a brief idea of what it does.>
 * Copyright (C) <2017> SaaSprov.ma <saasprov@gmail.com>
 *
 * This program is free software: you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation, either version 3 of the License, or
 * (at your option) any later version.
 *
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License
 * along with this program.  If not, see <http://www.gnu.org/licenses/>.
 */

// Load Dolibarr environment
if (false === (@include '../main.inc.php')) {  // From htdocs directory
	require '../../main.inc.php'; // From "custom" directory
}
require_once 'fpdf/fpdf.php';
require_once DOL_DOCUMENT_ROOT.'/core/lib/company.lib.php';
require_once DOL_DOCUMENT_ROOT.'/core/lib/pdf.lib.php';



$socid = GETPOST('socid','int');
$object = new Societe($db);
$object->fetch($socid);
//var_dump($object);

$contacts = $object->contact_array_objects();
// var_dump($object->contact_array_objects());die;
$data = array();
// var_dump($contacts);die;
foreach($contacts as $k => $v){
	// var_dump(get_class_methods($v->fetch()));
	$sql = "SELECT * ";
	$sql.= " FROM ".MAIN_DB_PREFIX."categorie_contact as p1, ".MAIN_DB_PREFIX."categorie as p2 ";	
	$sql.= " WHERE p1.fk_categorie = p2.rowid";
	$sql.= " AND p2.label = 'Filiale'";
	$sql.= " AND p1.fk_socpeople = ".$v->id;
	// echo $sql;
	$resql = $db->query($sql);
	if ($resql) {
		
		if ($db->num_rows($resql)) {
			$data[] = array('nom' => $v->lastname, 'adresse' => $v->address, 'adresse2' => $v->zip .", ".$v->town.", ".$v->country);
			// $obj = $db->fetch_object($resql);
			// $user_id = $obj->rowid;
			
		}
	}
}

// var_dump($data);die;

$tab = explode(" ", $object->array_options['options_cstmd']);
// var_dump($tab);die();
$sql = "SELECT rowid ";
$sql.= " FROM ".MAIN_DB_PREFIX."user";	
$sql.= " WHERE firstname = '" . $tab[0] . "'";
$sql.= " AND lastname = '" . $tab[1] . "'";
// echo $sql;
$user_id = null;
dol_syslog(__METHOD__ . " sql=" . $sql, LOG_DEBUG);
$resql = $db->query($sql);
if ($resql) {
	if ($db->num_rows($resql)) {
		$obj = $db->fetch_object($resql);
		$user_id = $obj->rowid;
		
	}
}

$user_cstmd = new User($db);
$user_cstmd->fetch($user_id); 

$myname = $conf->global->MAIN_INFO_SOCIETE_NOM ;
$logo =  $conf->global->MAIN_INFO_SOCIETE_LOGO;
$siret =  $conf->global->MAIN_INFO_SIRET;

// var_dump($user_cstmd);die;


class PDF extends FPDF
{
	public $arr = '';
	function __construct($arr = '') {
		parent::__construct();
		$this->arr = $arr;
    }
	// En-tête
	function Header()
	{
		include 'pdfheader.php';
	}

	function Footer()
	{
		$arr = $this->arr;
		include 'pdffooter.php';
	}
}

// Instanciation de la classe dérivée
$pdf = new PDF(array($conf->global->FOOTER_LIGNE1, $conf->global->FOOTER_LIGNE2, $conf->global->FOOTER_LIGNE3, $conf->global->FOOTER_LIGNE4));
if (method_exists($pdf,'AliasNbPages')) $pdf->AliasNbPages();
$pdf->AddPage();
$pdf->SetFont('Arial','BU',13);

//$this->Image('img/logo.jpg',20,15,50);
$pdf->Image('../../../documents/mycompany/logos/'.$logo ,20,15,50);

$pdf->SetXY(15, 60);
$pdf->MultiCell(180,8,utf8_decode('ACCEPTATION DE MISSION DE "CONSEILLER A LA SÉCURITÉ"'), 0, 'C');

$pdf->SetFont('Arial','',12);
$pdf->SetXY(15, 75);
$pdf->MultiCell(180,8,utf8_decode('Je soussigné '.$object->array_options['options_cstmd'].', (Conseiller à la sécurité certificat n° '.$user_cstmd->array_options['options_cstmd'].' / '.$myname.' SIRET : '.$siret.' ), déclare accepter la mission de :'), 0, 'L');

$pdf->SetFont('Arial','B',12);
$pdf->SetXY(15, 100);
$pdf->MultiCell(180,8,utf8_decode('"Conseiller à la Sécurité pour le transport des marchandises dangereuses"'), 0, 'C');


$pdf->SetFont('Arial','',12);
$pdf->SetXY(15, 113);
$pdf->MultiCell(180,8,utf8_decode("de l'entreprise :"), 0, 'L');

$pdf->SetFont('Arial','B',12);
$pdf->SetXY(35, 120);
$pdf->MultiCell(180,8,utf8_decode($object->nom), 0, 'L');

$pdf->SetFont('Arial','',12);
$pdf->SetXY(35, 126);
$object->address = str_replace("’","'",$object->address);
$object->address = str_replace("–","-",$object->address);
$adress = str_replace(array("\r", "\n"), '', $object->address);
$pdf->MultiCell(180,8,utf8_decode($adress), 0, 'L');

$pdf->SetXY(35, 132);
$pdf->MultiCell(180,8,utf8_decode($object->zip .", ".$object->town.", ".$object->country), 0, 'L');


if(empty($data)){

	$pdf->SetFont('Arial','',12);
	$pdf->SetXY(15, 145);
	$pdf->MultiCell(180,8,utf8_decode("Pour le site situé à l'adresse suivante :"), 0, 'L');

	$pdf->SetFont('Arial','B',12);
	$pdf->SetXY(35, 152);
	$pdf->MultiCell(180,8,utf8_decode($object->nom), 0, 'L');

	$pdf->SetFont('Arial','',12);
	$pdf->SetXY(35, 158);
	$adress = str_replace(array("\r", "\n"), '', $object->address);
	$pdf->MultiCell(180,8,utf8_decode($adress), 0, 'L');

	$pdf->SetXY(35, 164);
	$pdf->MultiCell(180,8,utf8_decode($object->zip .", ".$object->town.", ".$object->country), 0, 'L');

	$pdf->SetFont('Arial','',12);
	$pdf->SetXY(15, 174);
	$pdf->MultiCell(180,8,utf8_decode("Fait à ".$conf->global->MAIN_INFO_SOCIETE_TOWN." , le ".date("d/m/Y")), 0, 'L');

	$pdf->SetFont('Arial','B',12);
	$pdf->SetXY(110, 184);
	$pdf->MultiCell(80,8,utf8_decode($object->array_options['options_cstmd']), 0, 'C');

	$pdf->SetFont('Arial','',12);
	$pdf->SetXY(110, 190);
	$pdf->MultiCell(80,8,utf8_decode("Conseiller à la sécurité"), 0, 'C');


}else{
	
	$pdf->SetFont('Arial','',12);
	$pdf->SetXY(15, 145);
	$pdf->MultiCell(100,8,utf8_decode("Pour les sites situés aux l'adresses suivantes :"), 0, 'L');
	// $pdf->Ln(50);
	$nbr = count($data) -1;
	$lim = 0;
	//var_dump($data);die;
	for($k=0; $k <= $nbr; $k+=2){
		
		$y = $pdf->GetY();
		if($lim<$y){
			$lim = $y;
		}
		// var_dump($lim);
		$pdf->SetFont('Arial','B',12);
		$pdf->SetXY(18, $lim);
		$pdf->MultiCell(100,8,utf8_decode($data[$k]['nom']), 0, 'L');

		$pdf->SetFont('Arial','',12);
		// $pdf->SetXY(25, 158);
		$pdf->SetX(18);
		$adress = str_replace(array("\r", "\n"), '',$data[$k]['adresse']);
		$pdf->MultiCell(100,8,utf8_decode($adress), 0, 'L');	
		// $pdf->SetXY(35, 164);
		$pdf->SetX(18);
		$pdf->MultiCell(100,8,utf8_decode($data[$k]['adresse2']), 0, 'L');	
		
		$i = $k+1;
		
		$y1 = $pdf->GetY();
		// 
		$pdf->SetXY(112,$lim);
		$pdf->SetFont('Arial','B',12);
		$pdf->MultiCell(100,8,utf8_decode($data[$i]['nom']), 0, 'L');
		$pdf->SetFont('Arial','',12);
		$pdf->SetX(112);
		$adress = str_replace(array("\r", "\n"), '',$data[$i]['adresse']);
		$pdf->MultiCell(100,8,utf8_decode($adress), 0, 'L');	
		$pdf->SetX(112);
		$pdf->MultiCell(100,8,utf8_decode($data[$i]['adresse2']), 0, 'L');	
		
		
		if($y >= 225){
			$pdf->addPage();
			$pdf->SetXY(15, 60);
			$pdf->SetFont('Arial','BU',13);
			$pdf->MultiCell(180,8,utf8_decode('ACCEPTATION DE MISSION DE "CONSEILLER A LA SÉCURITÉ"'), 0, 'C');
			$pdf->setY(80);
			$lim = $pdf->GetY();
			$pdf->Image('../../../documents/mycompany/logos/'.$logo ,20,15,50);
		}
		
		
		
	}
	// die;
	//
	$pdf->Ln();
	$y = $pdf->GetY();
	// var_dump($y);die;
	$pdf->SetFont('Arial','',12);
	$pdf->SetX(15);
	$pdf->MultiCell(180,8,utf8_decode("Fait à ".$conf->global->MAIN_INFO_SOCIETE_TOWN." , le ".date("d/m/Y")), 0, 'L');
	

	$pdf->SetFont('Arial','B',12);
	$pdf->SetXY(110, $y);
	$pdf->MultiCell(80,8,utf8_decode($object->array_options['options_cstmd']), 0, 'C');

	$pdf->SetFont('Arial','',12);
	$pdf->SetX(110);
	$pdf->MultiCell(80,8,utf8_decode("Conseiller à la sécurité"), 0, 'C');
	// $y = $pdf->GetY()+2;
	// $pdf->Image('img/sig.jpg',135,$y,40);
	// $pdf->Footer("hhhh");
	// $pdf->Image($user_cstmd->array_options['options_vcstmd'],135,200,40);


	$dir = $dolibarr_main_data_root."/icstmd/".$socid;
	if (!file_exists($dir)) {
		mkdir($dir, 0777, true);
	}

	$filename=$dir."/acceptmiss".date('Y_m_d').".pdf";
	$pdf->Output($filename,'F');
		
/* 		 $pdf->Cell(50,5,'111 Here',0,0,'L',0);
		$pdf->Cell(50,5,'222 Here',1,0,'L',0);

						$pdf->Ln();

		$pdf->Cell(50,5,'[ o ] che1','LR',0,'L',0);
		$pdf->Cell(50,5,'[ x ] che2','LR',0,'L',0);

						$pdf->Ln();

		$pdf->Cell(50,5,'[ x ] def3','LRB',0,'L',0);
		$pdf->Cell(50,5,'[ o ] def4','LRB',0,'L',0);

						$pdf->Ln();
						$pdf->Ln();
						$pdf->Ln(); */
		
	//}
	
}
//$pdf->Image($user_cstmd->array_options['options_vcstmd'],135,200,40);

/*
$title_key=(empty($user_cstmd->array_options['options_vcstmd']))?'':($user_cstmd->array_options['options_vcstmd']);	
$extrafields = new ExtraFields($db);
$extralabels = $extrafields->fetch_name_optionals_label ($user_cstmd->table_element, true);
if (is_array($extralabels ) && key_exists('vcstmd', $extralabels) && !empty($title_key)) 
{
	$titlekey = $extrafields->showOutputField ('vcstmd', $title_key);
	$pdf->Image('$title_key', 135, 200, 40);
	//$pdf->Image('img/sig_fg.jpg', 135, 200, 40);
}
else
{
	setEventMessages('FPDF error: Image file has no extension and no type was specified:'.$title_key, null, 'errors');
}
*/
$dir = $dolibarr_main_data_root."/icstmd/".$socid;
if (!file_exists($dir)) {
    mkdir($dir, 0777, true);
}

$filename=$dir."/acceptmiss".date('Y_m_d').".pdf";
$pdf->Output($filename,'F');

if (isset($_SERVER["HTTP_REFERER"])) {
	header("Location: " . $_SERVER["HTTP_REFERER"]);
}

?>
