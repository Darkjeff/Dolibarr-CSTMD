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
require_once DOL_DOCUMENT_ROOT.'/core/lib/company.lib.php';

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

$dreal = new Societe($db);

$dreal = $dreal->searchByName($soc->array_options['options_dreal'])[0];

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

// qry pour les quantites marchandises

$sql2 = "SELECT 211classe as a_classe, 211etiquette as a_etiquette, 211conditionnement as a_conditionnement," ;
$sql2.= "211quantite as a_quantite, 212classe as b_classe, 212etiquette as b_etiquette, 212colis as b_colis,";
$sql2.= "212vrac as b_vrac, 212citerne as b_citerne, 212R as b_R, 212F as b_F, 212N as b_N, ";
$sql2.= "2131classe as c_classe, 2131etiquette as c_etiquette, 2131colis as c_colis, 2131vrac as c_vrac, 2131citerne as c_citerne, ";
$sql2.= "2132classe as d_classe, 2132etiquette as d_etiquette, 2132wagon as d_wagon, 2132uti as d_uti, ";
$sql2.= "2133classe as e_classe, 2133etiquette as e_etiquette, 2133bateau as e_bateau, 2133citerne as e_citerne, ";
$sql2.= "214classe as f_classe, 214etiquette as f_etiquette, 214R as f_R, 214F as f_F, 214N as f_N, ";
$sql2.= "2151classe as g_classe, 2151etiquette as g_etiquette, 2151colis as g_colis, 2151vrac as g_vrac, 2151citerne as g_citerne, ";
$sql2.= "2152classe as h_classe, 2152etiquette as h_etiquette, 2152wagon as h_wagon, 2152uti as h_uti, ";
$sql2.= "2153classe as i_classe, 2153etiquette as i_etiquette, 2153bateau as i_bateau, 2153citerne as i_citerne ";
$sql2.= " FROM ".MAIN_DB_PREFIX."cust_marchandise_activite_extrafields";	
$sql2.= " WHERE fk_object = " . $id ;

// echo $sql;

dol_syslog(__METHOD__ . " sql2=" . $sql2, LOG_DEBUG);
$resql2 = $db->query($sql2);
if ($resql2) {
	if ($db->num_rows($resql2)) {
		$obj2 = $db->fetch_object($resql2);
				
	}
}

$a_classe = $obj2->a_classe;
$a_etiquette = $obj2->a_etiquette;
$a_conditionnement = $obj2->a_conditionnement;
$a_quantite = $obj2->a_quantite ;

$b_classe = $obj2->b_classe;
$b_etiquette = $obj2->b_etiquette;
$b_colis = $obj2->b_colis;
$b_vrac = $obj2->b_vrac;
$b_citerne = $obj2->b_citerne;
$b_R = $obj2->b_R;
$b_F = $obj2->b_F;
$b_N = $obj2->b_N;

$c_classe = $obj2->c_classe;
$c_etiquette = $obj2->c_etiquette;
$c_colis = $obj2->c_colis;
$c_vrac = $obj2->c_vrac;
$c_citerne = $obj2->c_citerne;

$d_classe = $obj2->d_classe;
$d_etiquette = $obj2->d_etiquette;
$d_wagon = $obj2->d_wagon;
$d_uti = $obj2->d_uti;

$e_classe = $obj2->e_classe;
$e_etiquette = $obj2->e_etiquette;
$e_bateau = $obj2->e_bateau;
$e_citerne = $obj2->e_citerne;

$f_classe = $obj2->f_classe;
$f_etiquette = $obj2->f_etiquette;
$f_R = $obj2->f_R;
$f_F = $obj2->f_F;
$f_N = $obj2->f_N;

$g_classe = $obj2->g_classe;
$g_etiquette = $obj2->g_etiquette;
$g_colis = $obj2->g_colis;
$g_vrac = $obj2->g_vrac;
$g_citerne = $obj2->g_citerne;

$h_classe = $obj2->h_classe;
$h_etiquette = $obj2->h_etiquette;
$h_wagon = $obj2->h_wagon;
$h_uti = $obj2->h_uti;

$i_classe = $obj2->i_classe;
$i_etiquette = $obj2->i_etiquette;
$i_bateau = $obj2->i_bateau;
$i_citerne = $obj2->i_citerne;

global $conf,$langs,$mysoc;



$user_cstmd = new User($db);
$user_cstmd->fetch($user_id); 

// var_dump($interv);die;
/*
print '<pre>';
 var_dump($mysoc);die;
 print '</pre>';
*/
// liste variable pour document 

$name = $soc->nom;

$myname = $conf->global->MAIN_INFO_SOCIETE_NOM ;
$myadress =  $conf->global->MAIN_INFO_SOCIETE_ADDRESS ;
$myzip =  $conf->global->MAIN_INFO_SOCIETE_ZIP;
$mytown =  $conf->global->MAIN_INFO_SOCIETE_TOWN;
$logo =  $conf->global->MAIN_INFO_SOCIETE_LOGO;
$myemail = $conf->global->MAIN_INFO_SOCIETE_MAIL;
$myfax = $conf->global->MAIN_INFO_SOCIETE_FAX;
$mytel = $conf->global->MAIN_INFO_SOCIETE_TEL;


$now = date('d/m/Y' ,dol_now());

$name = $soc->nom;
$annee = date('Y', $interv->datec);
$daterapport =  date('d/m/Y',$interv->array_options['options_daterapport'] );
$synthrapport =  $interv->array_options['options_synthrapport'] ;
$adresse = $soc->address .", ". $soc->zip .", ". $soc->town;
$adressedoli = $myadress .", ". $myzip .", ". $mytown;
$activiteclient =  utf8_decode($soc->array_options['options_activiteclient'] );
$orgaclient =  $soc->array_options['options_orgaclient'] ;
$nom = $user_cstmd->array_options['options_cstmd'];
$prenom = "";

$certificat = $user->array_options['options_cstmd'];
$datecertif = date('d/m/Y',$user->array_options['options_valcertif']);

$prenomuser = $tab[0] ." ". $tab[1];
$nomuser = $tab[1];
$teluser = $user_cstmd->user_mobile ;
$mailuser = $user_cstmd->email ;
$posteuser = $user_cstmd->job ; 
$signuser = $user_cstmd->array_options['options_vcstmd'] ;

$drealnom = $dreal->nom ;
$drealaddress = $dreal->address ;
$drealcpville = $dreal->zip ." ".$dreal->town ;

//

$suretehr = $soc->array_options['options_suretehr'] ;
$suretehrtxt = " " ;

if ($soc->array_options['options_suretehr'] == 1) {
$suretehrtxt = "L'entreprise a mis en place un plan de sûreté conformément a ses obligations.Le CSTMD a vérifié son adéqua9on avec l'activité et la taille de l'organisme." ;}
if ($soc->array_options['options_suretehr'] == 0) {
$suretehrtxt = "L'entreprise ne transporte pas des marchandises dangereuses à haut risque" ; }
//Mode user
//



$modeuser = "";

if ($user_cstmd->array_options['options_modecstmd'] == 1) {
$modeuser  = "Route";}
if ($user_cstmd->array_options['options_modecstmd'] == 2) {
$modeuser  = "Fer";}
if ($user_cstmd->array_options['options_modecstmd'] == 3) {
$modeuser  = "Fluvial";}
if ($user_cstmd->array_options['options_modecstmd'] == 4) {
$modeuser  = "Tous modes";}
if ($user_cstmd->array_options['options_modecstmd'] == 5) {
$modeuser  = "Route + Fer";}

// Class user
// 
$classuser= "";

if ($user_cstmd->array_options['options_clcstmd'] == 1) {
$classuser = "Classe 3 à 9";}
if ($user_cstmd->array_options['options_clcstmd'] == 2) {
$classuser = "Classe 2";}
if ($user_cstmd->array_options['options_clcstmd'] == 3) {
$classuser = "Classe 1";}
if ($user_cstmd->array_options['options_clcstmd'] == 4) {
$classuser = "Classe 7";}
if ($user_cstmd->array_options['options_clcstmd'] == 5) {
$classuser = "PP";}
if ($user_cstmd->array_options['options_clcstmd'] == 6) {
$classuser= "Toutes Classes";}
if ($user_cstmd->array_options['options_clcstmd'] == 7) {
$classuser = "1 + 2 + 3 à 9";}
if ($user_cstmd->array_options['options_clcstmd'] == 8) {
$classuser = "2 + 3 à 9";}

include("data.php");


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
	   // $this->Line(10, 200, 200, 200);
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
		//$this->Image($image,55,150,100);
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
	
	// Page 5
	function page5($title,$data)
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
	    $this->Cell(0,5,$this->datafooter["address"]);
	    $this->Ln();
	    // Page number
	    $this->Cell(0,5,'page '.$this->PageNo(),0,0,'C');
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
		$dataq[$p[1]][] = array( 'position'=> $obj->position, 'label_question'=> $obj->label_question, 'texte_reglementaire'=> $obj->texte_reglementaire, 'etat_lieux'=> $obj->etat_lieux, 'titre_recommandation'=> $obj->titre_recommandation, 'recommandation'=> $obj->recommandation, 'dater'=> $obj->dater, 'cf'=> $obj->cf, 'nc'=> $obj->nc, 'pa'=> $obj->pa, 'ev'=> $obj->ev, 'recommandation'=> $obj->recommandation, 'reference'=> $obj->reference);
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
$pdf->Image("../" .$signuser,160,156,20);
$pdf->Image("../" .$signuser,150,215,40);

//page 3
$pdf->AddPage();
$pdf->page3($title, $page3);
// page 4
$pdf->AddPage();
$pdf->page4($title, $page4);
// page 5
//$pdf->AddPage();
//$pdf->page5($title, $page5);


// Range
 $pdf->AddPage();
 $pdf->range($title, $pages);





//********************************************************* Questions
$pdf->AddPage();

$t = "5.1. Les procédés visant au respect des règles relatives à l'identification des marchandises dangereuses transportées";

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
