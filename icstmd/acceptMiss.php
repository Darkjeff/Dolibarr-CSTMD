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

$pdf->SetXY(15, 60);
$pdf->MultiCell(180,8,utf8_decode('ACCEPTATION DE MISSION DE "CONSEILLER A LA SÉCURITÉ"'), 0, 'C');

$pdf->SetFont('Arial','',12);
$pdf->SetXY(15, 75);
$pdf->MultiCell(180,8,utf8_decode('Je soussigné '.$object->array_options['options_cstmd'].', (Conseiller à la sécurité certificat n° '.$user_cstmd->array_options['options_cstmd'].' / CARBONNE Conseil & Formation SIRET : 500 040 092 00016), déclare accepter la mission de :'), 0, 'L');

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
$pdf->Image($user_cstmd->array_options['options_vcstmd'],135,200,40);

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
