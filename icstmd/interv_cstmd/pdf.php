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

class PDF_MC_Table extends FPDF{
	
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



$pdf=new PDF_MC_Table();
$pdf->AddPage();

//Table de 20 lignes et 4 colonnes
$pdf->SetWidths(array(140,12,12,12, 12));
srand(microtime()*1000000);
// for($i=0;$i<20;$i++)
	foreach($data as $row){
		$pdf->SetFont('Arial','B',8);
		$pdf->Row(array(utf8_decode($row['position'].' '.$row['label_question']),' CF ',' NC ',' PA ', ' EV '));
		
		$pdf->SetFont('Arial','',8);
		$cf = $nc = $pa = $ev = null;
		if($row['cf'] == 1){ $cf = 'X'; }
		
		if($row['nc'] == 1){ $nc = 'X'; }
		
		if($row['pa'] == 1){ $pa = 'X'; }
		
		if($row['ev'] == 1){ $ev = 'X'; }
		
		$pdf->Row(array(utf8_decode($row['texte_reglementaire']), $cf, $nc, $pa, $ev));
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
