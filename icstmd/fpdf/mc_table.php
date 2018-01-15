<?php
require('fpdf.php');

class PDF_MC_Table extends FPDF
{
var $widths;
var $aligns;

public $logo;

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

function Row($data, $testcolorline = null, $colortext = null, $varifytva = null)
{
	
    //Calcule la hauteur de la ligne
    $nb=0;
    for($i=0;$i<count($data);$i++)
        $nb=max($nb,$this->NbLines($this->widths[$i],$data[$i]));
	
	if(empty($testcolorline)){
		$h=(5*$nb)+6;
	}else{
		$h=(5*$nb)+10;
	}
    //Effectue un saut de page si nécessaire
    $this->CheckPageBreak($h);
    //Dessine les cellules
	
	//Montant de chaque TVA
	if(array_key_exists($data[1],$this->tva) AND empty($varifytva)){
		$this->tva[$data[1]] = $this->tva[$data[1]] + $data[4] ;
	}elseif(empty($varifytva)){
		$this->tva[$data[1]] = $data[4] ;
	}
	
	$this->SetTextColor($colortext[0], $colortext[1], $colortext[2]);
	
    for($i=0;$i<count($data);$i++)
    {
        $w=$this->widths[$i];
        $a=isset($this->aligns[$i]) ? $this->aligns[$i] : 'L';
        //Sauve la position courante
        $x=$this->GetX();
		$y=$this->GetY();
		
        //Dessine le cadre
		$this->Rect($x,$y,$w,$h);
			
		if(!empty($testcolorline)){
			$this->SetFillColor($testcolorline[0], $testcolorline[1], $testcolorline[2]);
		}else{
			$this->SetFillColor(255,255,255);
		}
		
		//chaume titre
		$this->RoundedRect($x, $y, $this->widths[$i], $h, 2, 'DF');
		
		//margin
		$this->cMargin = 5;
		
        //Imprime le texte
		if($i == 0){
			$this->MultiCell($w,5,utf8_decode("\n".$data[$i]),0,'L');
		}elseif($i == 1 OR $i == 3){
			$this->MultiCell($w,5,utf8_decode("\n".$data[$i]),0,'C');
		}else{
			$this->MultiCell($w,5,utf8_decode("\n".$data[$i]),0,'R');
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
		
        //Sauve la position courante
        $x=$this->GetX();
		$y=$this->GetY();
		$this->Line($x, $y, $x+190, $y);
		
        $this->AddPage($this->CurOrientation);
		
		$this->SetTextColor(0, 0, 0);
		$this->SetFont('Arial','BI',11);
		// $this->SetY(109);
		$this->Row(array("Description", "TVA", "P.U.HT", "Qté", "Total HT"));
		//Table de 20 lignes et 4 colonnes count 150
		$this->SetFont('Arial','',10);
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

function RoundedRect($x, $y, $w, $h, $r, $style = '')
{
        $k = $this->k;
        $hp = $this->h;
        if($style=='F')
            $op='f';
        elseif($style=='FD' || $style=='DF')
            $op='B';
        else
            $op='S';
        $MyArc = 4/3 * (sqrt(2) - 1);
        $this->_out(sprintf('%.2F %.2F m',($x+$r)*$k,($hp-$y)*$k ));
        $xc = $x+$w-$r ;
        $yc = $y+$r;
        $this->_out(sprintf('%.2F %.2F l', $xc*$k,($hp-$y)*$k ));

        $this->_Arc($xc + $r*$MyArc, $yc - $r, $xc + $r, $yc - $r*$MyArc, $xc + $r, $yc);
        $xc = $x+$w-$r ;
        $yc = $y+$h-$r;
        $this->_out(sprintf('%.2F %.2F l',($x+$w)*$k,($hp-$yc)*$k));
        $this->_Arc($xc + $r, $yc + $r*$MyArc, $xc + $r*$MyArc, $yc + $r, $xc, $yc + $r);
        $xc = $x+$r ;
        $yc = $y+$h-$r;
        $this->_out(sprintf('%.2F %.2F l',$xc*$k,($hp-($y+$h))*$k));
        $this->_Arc($xc - $r*$MyArc, $yc + $r, $xc - $r, $yc + $r*$MyArc, $xc - $r, $yc);
        $xc = $x+$r ;
        $yc = $y+$r;
        $this->_out(sprintf('%.2F %.2F l',($x)*$k,($hp-$yc)*$k ));
        $this->_Arc($xc - $r, $yc - $r*$MyArc, $xc - $r*$MyArc, $yc - $r, $xc, $yc - $r);
        $this->_out($op);
}

function _Arc($x1, $y1, $x2, $y2, $x3, $y3)
{
	$h = $this->h;
	$this->_out(sprintf('%.2F %.2F %.2F %.2F %.2F %.2F c ', $x1*$this->k, ($h-$y1)*$this->k,
		$x2*$this->k, ($h-$y2)*$this->k, $x3*$this->k, ($h-$y3)*$this->k));
}

// En-tête
function Header()
{
	
	// color text
	$this->SetTextColor($this->colorTextGeneral[0], $this->colorTextGeneral[1], $this->colorTextGeneral[2] );
    // Logo
    $this->Image($this->logo,150,0,60,0,'PNG');
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
	$this->SetTextColor($this->colorTextTitle[0], $this->colorTextTitle[1], $this->colorTextTitle[2]);
	$this->SetFillColor($this->colorBackTitleMenu[0], $this->colorBackTitleMenu[1], $this->colorBackTitleMenu[2]);
	$this->Cell(190,11,utf8_decode("  Facture N° : ".$this->numFacture),0,1,'L',1);
	$this->Cell(160);
	$this->Cell(0,-11,utf8_decode($this->dateFacture),0,'L');

    // Saut de ligne
    $this->Ln(8);
}

// Pied de page
function Footer()
{
    // Positionnement à 1,5 cm du bas
    $this->SetY(-15);
	$this->SetDrawColor($this->colorBorder[0], $this->colorBorder[1], $this->colorBorder[2]);
    $this->Line($this->GetX(),$this->GetY(),$this->GetX()+190,$this->GetY());
    // Police Arial italique 8
    $this->SetFont('Arial','I',8);
    // text footer de page
    $this->Cell(0,10,$this->textFooter1,0,0,'C');
	$this->Ln(5);
    $this->Cell(0,10,$this->textFooter2,0,0,'C');
	//Numéro de page
    $this->SetFont('Arial','BI',10);	
	$this->AliasNbPages("{totalPages}");
	$this->Cell(0,5, "Page " . $this->PageNo() . "/{totalPages}" ,0,0,'C');
}

}
?>