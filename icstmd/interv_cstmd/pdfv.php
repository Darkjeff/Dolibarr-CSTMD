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

$res = @include ("../../main.inc.php"); // For root directory
if (! $res)
	$res = @include ("../../../main.inc.php"); // For "custom" directory
if (! $res)
	die("Include of main fails");
// ini_set('display_errors', 1);
// ini_set('display_startup_errors', 1);
// error_reporting(E_ALL);
require_once '../fpdf/fpdf.php';
require_once DOL_DOCUMENT_ROOT.'/core/lib/date.lib.php';
require_once DOL_DOCUMENT_ROOT.'/fichinter/class/fichinter.class.php';
$id			= GETPOST('id','int');
$interv = new Fichinter($db);

if ($id > 0 )
{
	$ret=$interv->fetch($id, null);
	if ($ret > 0) $socid=$interv->socid;
}

if ($user->societe_id) $socid=$user->societe_id;
$result = restrictedArea($user, 'societe', $socid, '&societe');

$soc = new Societe($db);
if ($id > 0) $soc->fetch($socid);


$tab = explode(" ", $soc->array_options['options_cstmd']);
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

// var_dump($interv);die;
// var_dump($soc);die;

// recup referentiel




$name = $soc->nom;
$myname = $conf->global->MAIN_INFO_SOCIETE_NOM ;
$myadress =  $conf->global->MAIN_INFO_SOCIETE_ADDRESS ;
$myzip =  $conf->global->MAIN_INFO_SOCIETE_ZIP;
$mytown =  $conf->global->MAIN_INFO_SOCIETE_TOWN;

$now = date('d/m/Y' ,dol_now());

$date = date('d/m/Y' ,$interv->datec);
$annee = date('Y', $interv->datec);
$adresse = $soc->address .", ". $soc->zip .", ". $soc->town;
$certificat = $user->array_options['options_cstmd'];
$datecertif = $user->array_options['options_valcertif'];
$prenom = "";

include("datav.php");


class PDF_MC_Table extends FPDF{
	
	
		public $datafooter = array();

	// head Like header but not header
	function head($title)
	{
		$this->return_to_default();
		$this->SetY(5);
		$this->SetFont('Arial','B',11);
	    $this->Cell(0,5,$title[0],0,0,'C');
	    $this->Ln();
	    $this->Cell(0,5,$title[1],0,0,'C');
	    $this->Ln();
		$this->SetFont('Arial','i',11);
	    $this->Cell(0,5,$title[2],0,0,'C');
	    $this->Ln();
	}

	// First Page
	function firstpage($data)
	{
	    // Logo
	    $this->Image($data["logo"],13,13,50);
	    $this->SetDrawColor(255, 191, 0);
	    $this->SetLineWidth(2);
	    $this->Line(10, 60, 200, 60);
	    $this->Line(10, 140, 200, 140);
	    // Arial bold 15
	    $this->SetFont('Arial','B',20);
	    // Title
	    $this->SetY(90);
	    $this->Cell(0,0,$data["title"][0],0,0,'C');
	    $this->Ln(20); // Line break
	    $this->Cell(0,0,$data["title"][1],0,0,'C');
	    $this->Ln(20);
	    $this->Cell(0,0,$data["title"][2],0,0,'C');
	    // Image
	    $this->Image($data["image"],55,150,100);
	}

	// Page 1
	function drawfirsttable($image)
	{
		$this->return_to_default();
		//line
	    $this->Line(10, 22, 200, 22);
	    $this->Line(10, 30, 200, 30);
	    $this->Line(10, 40, 200, 40);
	    $this->Line(10, 48, 200, 48);
	    $this->Line(10, 56, 200, 56);
	    $this->Line(10, 64, 200, 64);
	    $this->Line(10, 76, 200, 76);
	    $this->Line(10, 84, 200, 84);
	    $this->Line(90, 94, 200, 94);
	    $this->Line(90, 102, 200, 102);
	    $this->Line(90, 120, 200, 120);
	    $this->Line(10, 128, 200, 128);
	    $this->Line(10, 140, 200, 140);
	    $this->Line(90, 148, 200, 148);
	    $this->Line(90, 156, 200, 156);
	    $this->Line(10, 170, 200, 170);
	    $this->Line(90, 178, 200, 178);
	    $this->Line(10, 186, 200, 186);
	    $this->Line(10, 200, 200, 200);
	    $this->Line(10, 250, 200, 250);
		//colon
	    $this->Line(10, 22, 10, 250);
	    $this->Line(90, 22, 90, 48);
	    $this->Line(50, 56, 50, 76);
	    $this->Line(90, 76, 90, 200);
	    $this->Line(150, 76, 150, 170);
	    $this->Line(200, 22, 200, 250);
	    //colon
	    $this->Image($image,15,87,70);
	}

	// Page 1
	function page2($title,$data)
	{
		$this->return_to_default();
		$this->SetY(5);
		$this->SetFont('Arial','B',11);
	    $this->Cell(0,5,$title[0],0,0,'C');
	    $this->Ln();
	    $this->Cell(0,5,$title[1],0,0,'C');
	    $this->Ln();
		$this->SetFont('Arial','i',11);
	    $this->Cell(0,5,$title[2],0,0,'C');
	    $this->Ln();

	    foreach ($data as $key => $row) {
	    	foreach ($row as $kCol => $colon) {
		    	$this->SetXY($colon['x'], $colon['y']);
				$this->SetFont('Arial', $colon['t'], $colon['s']);
				$this->MultiCell($colon['w'], $colon['h'], $colon['c'], $colon['b'],$colon['l']);
			}
	    }
	}

	// Page 3
	function page3($title,$data)
	{
		$this->return_to_default();
		$this->head($title);
	    foreach ($data as $key => $row) {
			$y1 = $this->GetY();
			$this->MultiCell(180, 8, $row[0], 0,"L");
			$y2 = $this->GetY();
			$this->SetXY(-15,$y1);
			$this->MultiCell(10, 8, $row[1], 0,"L");
			$this->SetY($y2);
	    	$this->Ln();
	    }
	}

	// Page 4
	function page4($title,$data)
	{
		$this->return_to_default();
		$this->head($title);
	    foreach ($data as $key => $row) {
	    	$this->Ln($row["ln"]);
			$this->SetFont('Arial',$row["t"],$row["s"]);
			$this->MultiCell(0, $row['h'], $row['c'], 0,"L");
	    }
	}

	// Range
	function range($title,$pages)
	{
		$this->return_to_default();
		$this->head($title);
	    foreach ($pages as $kpage => $page) {
	    	foreach ($page as $kinfo => $info) {
		    	$this->SetXY($info['x'], $info['y']);
				$this->SetFont('Arial', $info['t'], $info['s']);
				if($info['m']!=0){
					$this->MultiCell($info['w'], $info['h'], $info['c'], $info['b'],$info['l']);
				}else{
					$this->Cell($info['w'], $info['h'], $info['c'], $info['b'],0,$info['l']);
				}
			}
			if(isset($pages[$kpage+1])){ $this->AddPage();}
	    }
	}

	// Simple table
	function return_to_default()
	{
		$this->SetFont('Arial','',14);
	    $this->SetDrawColor(null);
		$this->SetLineWidth(null);
	}

	// Page footer
	function Footer()
	{
		//return to default
		$this->return_to_default();
	    // Position at 1.5 cm from bottom
	    $this->SetY(-20);
	    // Arial italic 8
	    $this->SetFont('Arial','I',8);
	    $this->Cell(0,5,$this->datafooter["date"]);
	    $this->Ln();
	    $this->Cell(0,5,$this->datafooter["adress"]);
	    $this->Ln();
	    // Page number
	    
	    $this->Cell(0,10,'p '.$this->PageNo().'',0,0,'C');
	}
	
	
	
	
	
	
	
	
	
	var $widths;
	var $aligns;

	function SetWidths($w)
	{
		//Tableau des largeurs de colonnes
		$this->widths=$w;
	}

	function SetAligns($a)
	{
		//Tableau des alignements de colonnes
		$this->aligns=$a;
	}

	function Row($data, $line_height = 6)
	{
		//Calcule la hauteur de la ligne
		$nb=0;
		for($i=0;$i<count($data);$i++)
			$nb=max($nb,$this->NbLines($this->widths[$i],$data[$i]));
		$h=$line_height*$nb;
		//Effectue un saut de page si nécessaire
		$this->CheckPageBreak($h);
		//Dessine les cellules
		for($i=0;$i<count($data);$i++)
		{
			$w=$this->widths[$i];
			$a=isset($this->aligns[$i]) ? $this->aligns[$i] : 'L';
			//Sauve la position courante
			$x=$this->GetX();
			$y=$this->GetY();
			//Dessine le cadre
			$this->Rect($x,$y,$w,$h);
			//Imprime le texte
			$hh = $line_height - 1; 
			$this->MultiCell($w,$hh,$data[$i],0,$a);
			//Repositionne à droite
			$this->SetXY($x+$w,$y);
		}
		//Va à la ligne
		$this->Ln($h);
	}

	function CheckPageBreak($h)
	{
		//Si la hauteur h provoque un débordement, saut de page manuel
		if($this->GetY()+$h>$this->PageBreakTrigger)
			$this->AddPage($this->CurOrientation);
	}

	function NbLines($w,$txt)
	{
		//Calcule le nombre de lignes qu'occupe un MultiCell de largeur w
		$cw=&$this->CurrentFont['cw'];
		if($w==0)
			$w=$this->w-$this->rMargin-$this->x;
		$wmax=($w-2*$this->cMargin)*1000/$this->FontSize;
		$s=str_replace("\r",'',$txt);
		$nb=strlen($s);
		if($nb>0 and $s[$nb-1]=="\n")
			$nb--;
		$sep=-1;
		$i=0;
		$j=0;
		$l=0;
		$nl=1;
		while($i<$nb)
		{
			$c=$s[$i];
			if($c=="\n")
			{
				$i++;
				$sep=-1;
				$j=$i;
				$l=0;
				$nl++;
				continue;
			}
			if($c==' ')
				$sep=$i;
			$l+=$cw[$c];
			if($l>$wmax)
			{
				if($sep==-1)
				{
					if($i==$j)
						$i++;
				}
				else
					$i=$sep+1;
				$sep=-1;
				$j=$i;
				$l=0;
				$nl++;
			}
			else
				$i++;
		}
		return $nl;
	}
}

/**********************************/

$id	= GETPOST('id','int');

// questions

$dataq = array();

$sql = "SELECT * ";
$sql.= " FROM ".MAIN_DB_PREFIX."cstmd_interv_questions ";
$sql.= " WHERE fk_intervention = ".$id;
dol_syslog(__METHOD__ . " sql=" . $sql, LOG_DEBUG);
$resql = $db->query($sql);
if ($resql) {
	for($cmp=0;$cmp<$db->num_rows($resql);$cmp++){
		$obj = $db->fetch_object($resql);
		$p = explode(".", $obj->position);//die;
		$dataq[$p[1]][] = array( 'position'=> $obj->position, 'label_question'=> $obj->label_question, 'texte_reglementaire'=> $obj->texte_reglementaire, 'etat_lieux'=> $obj->etat_lieux, 'titre_recommandation'=> $obj->titre_recommandation, 'recommandation'=> $obj->recommandation, 'dater'=> $obj->dater, 'cf'=> $obj->cf, 'nc'=> $obj->nc, 'pa'=> $obj->pa, 'ev'=> $obj->ev, 'recommandation'=> $obj->recommandation, 'reference'=> $obj->reference, 'namereferentiel'=> $obj->refelabel );
	}
	$db->free($resql);

} else {
	$error = "Error " . $db->lasterror();
	dol_syslog(__METHOD__ . " " . $error, LOG_ERR);
}

// chapitres

$sql = "SELECT * ";
$sql.= " FROM ".MAIN_DB_PREFIX."cstmd_chapitres";
$resql=$db->query($sql);
$chap = array();
if ($resql) {
	for($cmp=0;$cmp<$db->num_rows($resql);$cmp++){
		$obj = $db->fetch_object($resql);
		$chap[$obj->position] = $obj->chapitre;
	}
	$db->free($resql);

} else {
	$error = "Error " . $db->lasterror();
	dol_syslog(__METHOD__ . " " . $error, LOG_ERR);
}


$pdf=new PDF_MC_Table();


$pdf->datafooter = $footer;
$pdf->SetFont('Arial','',14);
//First Page
$pdf->AddPage();
$pdf->firstpage($firstpage);
//Second Page
$pdf->AddPage();
$pdf->drawfirsttable($firstpage['logo']);
$pdf->page2($title, $data);
//page 3
// $pdf->AddPage();
// $pdf->page3($title, $page3);
// page 4
// $pdf->AddPage();
// $pdf->page4($title, $page4);
// Range
// $pdf->AddPage();
// $pdf->range($title, $pages);

//********************************************************* Questions
$pdf->AddPage();

//$t = "5.1. Les procédés visant au respect des règles relatives à l'identification des marchandises dangereuses transportées";

// $pdf->SetFont('Arial','B',12);
// $pdf->SetXY(10, 10);
// $pdf->MultiCell(170,5,utf8_decode($t), 0, 'L');
// $pdf->MultiCell(175,5,'', 0, 'L');
// var_dump($dataq);
// die();

//Table de 20 lignes et 4 colonnes
$pdf->SetWidths(array(140,12,12,12, 12));
srand(microtime()*1000000);
// for($i=0;$i<20;$i++)
	$posit = 0;
foreach($dataq as $k => $rows){
	// var_dump($row['position']);
	// die();
		$pdf->Ln();
		$t = "5.".$k." ".$chap["5.".$k];
		$pdf->SetFont('Arial','B',12);
		$pdf->SetX(10);
		$pdf->MultiCell(170,5,utf8_decode($t), 0, 'L');
		$pdf->MultiCell(175,5,'', 0, 'L');
		
	$posit = 0;
	
	foreach($rows as $row){
		$pdf->SetFont('Arial','B',8);		
		$pdf->SetFont('Arial','',8);
		$cf = $nc = $pa = $ev = null;
		$show = false;
		if($row['cf'] == 1){ $cf = 'X'; $show = true;}
		
		if($row['nc'] == 1){ $nc = 'X'; $show = true;}
		
		if($row['pa'] == 1){ $pa = 'X'; $show = true;}
		
		if($row['ev'] == 1){ $ev = 'X'; $show = true;}
		
		if($show){
			$qst = $row['position'].' '.$row['label_question'];
			//todo mettre en gras
			$pdf->Row(array(utf8_decode($qst),' CF ',' NC ',' PA ', ' EV '));
			if(!empty($row['etat_lieux'])){
				$txt = "Etat des lieux";
				$pdf->Row(array(utf8_decode($txt), '', '', '', ''));
				$pdf->Row(array(utf8_decode($row['etat_lieux']), '', '', '', ''));				
			}
			if(!empty($row['recommandation'])){
				$pdf->Row(array(utf8_decode($row['titre_recommandation']), '', '', '', ''));				
				$pdf->Row(array(utf8_decode($row['recommandation']), '', '', '', ''));
				
				$txt = "Recommandation à mettre en oeuvre avant le " .dol_print_date($row['dater'],'day', false, $outputlangs, true);
				$pdf->Row(array(utf8_decode($txt), '', '', '', ''));
			}
			if(!empty($row['reference'])){				
				$pdf->Row(array(utf8_decode($row['reference']), '', '', '', ''));
			}
			
			$pdf->Row(array(utf8_decode($row['texte_reglementaire']), $cf, $nc, $pa, $ev));
		}
	
	}
}
$pdf->Output();

/* 
class PDF extends FPDF
{

	// Tableau simple
	function BasicTable($data)
	{
		// Données
		foreach($data as $row)
		{
			$this->SetFont('Arial','B',8);
			$this->Cell(148,6,iconv('UTF-8', 'cp1252',($row['position'].' '.$row['label_question'])),1,'C');
			$this->Cell(8,6,' CF ',1,'C');
			$this->Cell(8,6,' NC ',1,'C');
			$this->Cell(8,6,' PA ',1,'C');
			$this->Cell(8,6,' EV ',1,'C');
			$this->Ln();
			$this->SetFont('Arial','',8);
			$this->MultiCell(150,6,utf8_decode($row['texte_reglementaire']), 0, 'L');
			// $this->Cell(148,6,iconv('UTF-8', 'cp1252',$row['texte_reglementaire']),1,'C');
			if($row['cf'] == 1){
				$this->Cell(8,6,' X ',1,'C');
			}
			else{
				$this->Cell(8,6,'  ',1,'C');
			}
			if($row['nc'] == 1){
				$this->Cell(8,6,' X ',1,'C');
			}
			else{
				$this->Cell(8,6,'  ',1,'C');
			}
			if($row['pa'] == 1){
				$this->Cell(8,6,' X ',1,'C');
			}
			else{
				$this->Cell(8,6,'  ',1,'C');
			}
			if($row['ev'] == 1){
				$this->Cell(8,6,' X ',1,'C');
			}
			else{
				$this->Cell(8,6,'  ',1,'C');
			}
			$this->Ln();
		}
	}
}

$langs->load("interventions");
$langs->load("icstmd");

$id	= GETPOST('id','int');



$data = array();

$sql = "SELECT * ";
$sql.= " FROM ".MAIN_DB_PREFIX."cstmd_interv_questions ";
$sql.= " WHERE fk_intervention = ".$id;
dol_syslog(__METHOD__ . " sql=" . $sql, LOG_DEBUG);
$resql = $db->query($sql);
if ($resql) {
	for($cmp=0;$cmp<$db->num_rows($resql);$cmp++){
		$obj = $db->fetch_object($resql);
		$data[$obj->rowid] = array( 'position'=> $obj->position, 'label_question'=> $obj->label_question, 'texte_reglementaire'=> $obj->texte_reglementaire, 'cf'=> $obj->cf, 'nc'=> $obj->nc, 'pa'=> $obj->pa, 'ev'=> $obj->ev);
	}
	$db->free($resql);

} else {
	$error = "Error " . $db->lasterror();
	dol_syslog(__METHOD__ . " " . $error, LOG_ERR);
}


$pdf = new PDF();
$pdf->AddPage();
$pdf->BasicTable($data);

$pdf->Output(); */

llxFooter();

$db->close();
