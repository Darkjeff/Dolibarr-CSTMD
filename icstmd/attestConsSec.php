<?php
/* <one line to give the program's name and a brief idea of what it does.> * Copyright (C) <2017> SaaSprov.ma <saasprov@gmail.com> * * This program is free software: you can redistribute it and/or modify * it under the terms of the GNU General Public License as published by * the Free Software Foundation, either version 3 of the License, or * (at your option) any later version. * * This program is distributed in the hope that it will be useful, * but WITHOUT ANY WARRANTY; without even the implied warranty of * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the * GNU General Public License for more details. * * You should have received a copy of the GNU General Public License * along with this program.  If not, see <http://www.gnu.org/licenses/>. */
// Load Dolibarr environment
if (false === (@include '../main.inc.php')) {  // From htdocs directory
	require '../../main.inc.php'; // From "custom" directory
}
require_once 'fpdf/fpdf.php';
require_once DOL_DOCUMENT_ROOT.'/core/lib/company.lib.php';
require_once DOL_DOCUMENT_ROOT.'/user/class/user.class.php';


$socid = GETPOST('socid','int');
$object = new Societe($db);
$object->fetch($socid);
// var_dump($user);die();




$tab = explode(" ", $object->array_options['options_cstmd']);
// var_dump($tab);die();
$sql = "SELECT rowid ";
$sql.= " FROM ".MAIN_DB_PREFIX."user";	
$sql.= " WHERE firstname = '" . $tab[0] . "'";
$sql.= " AND lastname = '" . $tab[1] . "'";
echo $sql;
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
//var_dump($user_cstmd->array_options['options_cstmd']);die();


$object->address = str_replace("’","'",$object->address);
$object->address = str_replace("–","-",$object->address);
$object->address = str_replace(array("\r", "\n"), '', $object->address);

class PDF extends FPDF
{
	// En-tête
	function Header()
	{
		include 'pdfheader.php';
	}

	function Footer()
	{
		include 'pdffooter.php';
	}
}
// Instanciation de la classe dérivée
$pdf = new PDF();
$pdf->AliasNbPages();
$pdf->AddPage();
$pdf->SetFont('Arial','B',16);

$pdf->SetXY(15, 70);
$pdf->MultiCell(180,8,utf8_decode('ATTESTATION'), 0, 'C');

$pdf->Line(15, 78, 195, 78);

$pdf->SetFont('Arial','BU',12);
$pdf->SetXY(15, 85);
$pdf->MultiCell(180,8,utf8_decode('Objet : '), 0, 'L');

$pdf->SetFont('Arial','B',12);
$pdf->SetXY(32, 85);
$pdf->MultiCell(170,8,utf8_decode('Attestation de Conseiller à la sécurité.'), 0, 'L');

$pdf->SetFont('Arial','',12);
$pdf->SetXY(15, 95);
//var_dump($object);die();


$pdf->MultiCell(180,8,utf8_decode("Je soussigné, ".$object->array_options['options_cstmd'].", conseiller à la sécurité pour le transport de marchandises dangereuses, titulaire du certificat CIFMD  n° ". $user_cstmd->array_options['options_cstmd'] .", certifie exercer la mission de CSTMD pour le compte de l'entreprise ". $object->nom ." - ". $object->address ." - ". $object->zip ." ". $object->town .". Cette attestation est valable jusqu'au " .dol_print_date($object->array_options['options_datev'],'%d/%m/%Y'). ". "), 0, 'L');

$pdf->SetFont('Arial','',12);
$pdf->SetXY(110, 170);
$pdf->MultiCell(80,8,utf8_decode("Fait à Espiet, le ".date("d/m/Y")), 0, 'C');


$pdf->SetFont('Arial','B',12);
$pdf->SetXY(110, 184);
$pdf->MultiCell(80,8,utf8_decode($object->array_options['options_cstmd']), 0, 'C');

$pdf->SetFont('Arial','',12);
$pdf->SetXY(110, 190);
$pdf->MultiCell(80,8,utf8_decode("Conseiller à la sécurité"), 0, 'C');

//$pdf->Image('img/sig.jpg',135,200,40);
$pdf->Image($user_cstmd->array_options['options_vcstmd'],135,200,40);


$dir = $dolibarr_main_data_root."/icstmd/".$socid;
if (!file_exists($dir)) {
    mkdir($dir, 0777, true);
}

$filename=$dir."/attestConsSec".date('Y_m_d').".pdf";
$pdf->Output($filename,'F');

if (isset($_SERVER["HTTP_REFERER"])) {
	header("Location: " . $_SERVER["HTTP_REFERER"]);
}
?>
