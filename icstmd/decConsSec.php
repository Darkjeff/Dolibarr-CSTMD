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


$socid = GETPOST('socid','int');
$object = new Societe($db);
$dreal = new Societe($db);
$object->fetch($socid);

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

$pdf->SetFont('Arial','B',12);
$pdf->SetXY(120, 55);
$pdf->MultiCell(70,8,utf8_decode($object->nom), 0, 'L');

$pdf->SetFont('Arial','',11);
$pdf->SetXY(120, 62);
$adresse = $object->address;
//$adresse = strtok($adresse, "\n");
$pdf->MultiCell(70,6,utf8_decode($adresse."\n".$object->zip .", ".$object->town.", ".$object->country), 0, 'L');

// $pdf->SetXY(120, 69);
// $pdf->MultiCell(70,8,utf8_decode(), 0, 'L');



$pdf->SetFont('Arial','BU',12);
$pdf->SetXY(15, 85);
$pdf->MultiCell(180,8,utf8_decode('Objet : '), 0, 'L');

$pdf->SetFont('Arial','B',12);
$pdf->SetXY(32, 85);
$pdf->MultiCell(170,8,utf8_decode('Déclaration du conseiller à la sécurité.'), 0, 'L');


$pdf->SetFont('Arial','',12);
$pdf->SetXY(120, 95);
$pdf->MultiCell(80,8,utf8_decode("Fait à Espiet, le ".date("d/m/Y")), 0, 'L');

$pdf->SetFont('Arial','',12);
$pdf->SetXY(15, 120);
$pdf->MultiCell(180,8,utf8_decode('Madame, Monsieur,'), 0, 'L');

$pdf->SetFont('Arial','',12);
$pdf->SetXY(15, 130);
$pdf->MultiCell(180,8,utf8_decode('Nous vous prions de trouver ci-joint :'), 0, 'L');

$pdf->SetFont('Arial','',12);
$pdf->SetXY(20, 138);
$pdf->MultiCell(180,8,utf8_decode('- Le formulaire de déclaration à compléter.'), 0, 'L');

$pdf->SetFont('Arial','',12);
$pdf->SetXY(20, 145);
$pdf->MultiCell(170,7,utf8_decode("- Ce formulaire, accompagné de la lettre d'acceptation de mission et de la copie du certificat CS, est à envoyer à :"), 0, 'L');


$dreal = $dreal->searchByName($object->array_options['options_dreal'])[0];
// var_dump($dreal->address);
// die();


$pdf->SetFont('Arial','B',12);
$pdf->SetXY(60, 160);
$pdf->MultiCell(70,7,utf8_decode($dreal->nom), 0, 'L');


$pdf->SetFont('Arial','',12);
$pdf->SetXY(60, 166);
/*
$pdf->MultiCell(140,7,utf8_decode("Service Transports des Marchandises Dangereuses Cité Administrative"), 0, 'L');
$pdf->MultiCell(70,7,utf8_decode($dreal->address .", ".$dreal->zip .", ".$dreal->town.", ".$dreal->country), 0, 'L');
*/

$pdf->SetXY(60, 168);
$pdf->MultiCell(100,7,utf8_decode($dreal->address), 0, 'L');
$pdf->SetXY(60, 182);
$pdf->MultiCell(70,7,utf8_decode($dreal->zip ." ".$dreal->town), 0, 'L');
$pdf->SetXY(15, 197);
$pdf->MultiCell(180,7,utf8_decode("Veuillez agréer, Madame, Monsieur, l'expression de ma considération distinguée."), 0, 'L');



$pdf->SetFont('Arial','B',12);
$pdf->SetXY(110, 208);
$pdf->MultiCell(80,8,utf8_decode($object->array_options['options_cstmd']), 0, 'C');

$pdf->SetFont('Arial','',12);
$pdf->SetXY(110, 214);
$pdf->MultiCell(80,8,utf8_decode("Conseiller à la sécurité"), 0, 'C');

$pdf->Image('img/sig.jpg',135,220,40);

$dir = $dolibarr_main_data_root."/icstmd/".$socid;
if (!file_exists($dir)) {
    mkdir($dir, 0777, true);
}

$filename=$dir."/decConsSec ".date('Y_m_d').".pdf";
$pdf->Output($filename,'F');

if (isset($_SERVER["HTTP_REFERER"])) {
	header("Location: " . $_SERVER["HTTP_REFERER"]);
}

?>
