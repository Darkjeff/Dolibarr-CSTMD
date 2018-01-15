<?php
require('fpdf.php');

class PDF_MC_Table extends FPDF
{
var $widths;
var $aligns;

public $logo;
public $type;

public $nomSociete;
public $emailSociete;
public $telSociete;
public $mobile;
public $siteSociete;
public $adressSociete;

public $numFacture;
public $dateFacture;
public $colorBorder;
public $colorTextGeneral;
public $colorTextTitle;
public $colorBackTitleMenu;

public $textFooter1;
public $textFooter2;

public $tva = array();


// En-tête
function Header()
{
    // Logo
    $this->Image($this->logo,150,12,50,30,'PNG');
    // Police Arial gras 15
    $this->SetFont('Arial','B',14);
    // Titre
	$this->SetX($this->GetX());
    $this->Cell(0,8,utf8_decode($this->nomSociete),0,'L');
	$this->Ln();
	
    // Police Arial 12
    $this->SetFont('Arial','',10);
	
	if(!empty($this->adressSociete)){
		$this->Image("img/home.png",$this->GetX()+1,$this->GetY(),3.5,3.5,'PNG');
		$this->SetX(15);
		$this->MultiCell(80,5,utf8_decode($this->adressSociete),0,'L');
	}
	if(!empty($this->emailSociete)){
		$this->Image("img/envelope.png",$this->GetX()+1,$this->GetY()+0.3,3.5,3.5,'PNG');
		$this->SetX(15);
		$this->Cell(3,5,utf8_decode($this->emailSociete),0,'L');
		$this->Ln();
	}
	if(!empty($this->telSociete)){
		$this->Image("img/phone-fix.png",$this->GetX()+1,$this->GetY(),3.5,3.5,'PNG');
		$this->SetX(15);
		$this->Cell(3,5,utf8_decode($this->telSociete),0,'L');
		//mobile-phone.png
		$this->Image("img/phone.png",40,$this->GetY(),3.5,3.5,'PNG');
		$this->SetX(44);
		$this->Cell(3,5,utf8_decode($this->mobile),0,'L');
		$this->Ln();
	}
	if(!empty($this->siteSociete)){
		$this->Image("img/world-web.png",$this->GetX()+1,$this->GetY(),3.5,3.5,'PNG');
		$this->SetX(15);
		$this->Cell(3,5,utf8_decode($this->siteSociete),0,'L');
	}
	
    // $this->Ln(20);
	$this->SetY(55);
	
    $this->SetFont('Arial','',12);
	//cell title
	$this->SetDrawColor($this->colorBorder[0], $this->colorBorder[1], $this->colorBorder[2]);
	$this->SetTextColor($this->colorTextTitle[0], $this->colorTextTitle[1], $this->colorTextTitle[2]);
	$this->SetFillColor($this->colorBackTitleMenu[0], $this->colorBackTitleMenu[1], $this->colorBackTitleMenu[2]);
	$this->Cell(190,11,utf8_decode("  ".$this->type." : ".$this->numFacture),1,1,'L',1);
	$this->Cell(151.5);
	$this->Cell(0,-11,utf8_decode($this->dateFacture),0,'L');

    // Saut de ligne
    $this->Ln(8);
}

// Pied de page
function Footer()
{
    // Positionnement à 1,5 cm du bas
    $this->SetY(-15);
    $this->Line($this->GetX(),$this->GetY(),$this->GetX()+190,$this->GetY());
    // Police Arial italique 8
    $this->SetFont('Arial','',7);
    // text footer de page
    $this->Cell(0,10,$this->textFooter1,0,0,'C');
	$this->Ln(5);
    $this->Cell(0,7,$this->textFooter2,0,0,'C');
	//Numéro de page
    $this->SetFont('Arial','BI',10);	
	$this->AliasNbPages("{totalPages}");
	$this->Cell(0,5, "Page " . $this->PageNo() . "/{totalPages}" ,0,0,'C');
}

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

function Row($data, $pasVarifyTva = null, $isMenu = null)
{
    //Calcule la hauteur de la ligne
    $nb=0;
    for($i=0;$i<count($data);$i++)
        $nb=max($nb,$this->NbLines($this->widths[$i],$data[$i]));
    $h=(5*$nb)+2;
    //Effectue un saut de page si nécessaire
    $this->CheckPageBreak($h);
	
	//Montant de chaque TVA
	if(empty($pasVarifyTva) AND array_key_exists($data[1],$this->tva)){
		$this->tva[$data[1]] = $this->tva[$data[1]] + $data[4] ;
	}elseif(empty($pasVarifyTva)){
		$this->tva[$data[1]] = $data[4] ;
	}
	
    //Dessine les cellules
    for($i=0;$i<count($data);$i++)
    {
        $w=$this->widths[$i];
        $a=isset($this->aligns[$i]) ? $this->aligns[$i] : 'L';
        //Sauve la position courante
        $x=$this->GetX();
        $y=$this->GetY();
        //Dessine le cadre
		if(isset($this->widths[$i+1])){
			$this->Rect($x,$y,0,$h);			
		}else{
			$this->Rect($x,$y,0,$h);
			$this->Rect($x+30,$y,0,$h);
		}
        //Imprime le texte
		if(empty($isMenu)){
			if($i == 1 AND is_numeric($data[$i])) $this->MultiCell($w,5,utf8_decode($data[$i]."%"),0,'C');
			elseif($i == 3) $this->MultiCell($w,5,utf8_decode($data[$i]),0,'C');
			elseif(($i == 2 OR $i == 4) AND empty($pasVarifyTva)) $this->MultiCell($w,5, number_format((float)$data[$i], 2, ',', ' ') ,0,'R');
			else $this->MultiCell($w,5,utf8_decode($data[$i]),0,$a);
		}else{
			$this->SetFillColor($this->colorBackTitleMenu[0], $this->colorBackTitleMenu[1], $this->colorBackTitleMenu[2]);
			$this->SetTextColor($this->colorTextTitle[0], $this->colorTextTitle[1], $this->colorTextTitle[2]);
			$this->Cell($w,5,utf8_decode($data[$i]),0,1,'C',true);
			$this->SetTextColor($this->colorTextGeneral[0], $this->colorTextGeneral[1], $this->colorTextGeneral[2]);
		}
        //Repositionne à droite
        $this->SetXY($x+$w,$y);
    }
    //Va à la ligne
    $this->Ln($h);
}

function CheckPageBreak($h)
{
    //Si la hauteur h provoque un débordement, saut de page manuel
    if($this->GetY()+$h>$this->PageBreakTrigger){
		$this->Line($this->GetX(),$this->GetY(),$this->GetX()+190,$this->GetY());
        $this->AddPage($this->CurOrientation);
		$this->Row(array("Description", "TVA", "P.U.HT", "Qté", "Total HT"), null, 1);
		// $this->Row(array("", "", "", "", ""),1);
	}
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
?>