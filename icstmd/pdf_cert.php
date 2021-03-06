﻿<?php
/* <one line to give the program's name and a brief idea of what it does.>
 * Copyright (C) <2017> jamelbaz.com <jamelbaz@gmail.com>
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
require_once DOL_DOCUMENT_ROOT.'/includes/fpdf/fpdf/fpdf.php';
require_once DOL_DOCUMENT_ROOT.'/core/lib/company.lib.php';
require_once DOL_DOCUMENT_ROOT.'/fichinter/class/fichinter.class.php';

require_once('scripts/fpdi.php');


$tR = $tFer = $tFl = "";
$cR = $cFer = $cFl = "";
$rR = $rFer = $rFl = "";
$dR = $dFer = $dFl = "";

$emballage = $adr = "";

$socid = GETPOST('interv_id','int');
$id	= GETPOST('interv_id','int');
$lastname = '';
$firstname = '';
$objSociete = new Societe($db);
if ($id > 0) $objSociete->fetch($id);
$sql = "SELECT lastname ,firstname ";
$sql.= " FROM " . MAIN_DB_PREFIX . "socpeople";	
$sql.= " WHERE fk_soc = $id";
$sql.= " AND poste = 'responsable'";

dol_syslog($script_file . " sql=" . $sql, LOG_DEBUG);
$resql=$db->query($sql);
if ($resql) {
	$num = $db->num_rows($resql);
	$i = 0;
	
	if ($num) {
		while ($i < $num) {
			$obj = $db->fetch_object($resql);
			if ($obj) {
				$lastname = $obj->lastname;
				$firstname = $obj->firstname;				
			}
			$i++;
		}
	}
} else {
	$error++;
	dol_print_error($db);
}


$transRoute	= GETPOST('transRoute'); 
$transFer	= GETPOST('transFer');
$transFluv	= GETPOST('transFluv');

$chargRoute	= GETPOST('chargRoute'); 
$chargFer	= GETPOST('chargFer');
$chargFluv	= GETPOST('chargFluv');

$rempRoute	= GETPOST('rempRoute'); 
$rempFer	= GETPOST('rempFer');
$rempFluv	= GETPOST('rempFluv');

$dechargRoute	= GETPOST('dechargRoute'); 
$dechargFer	= GETPOST('dechargFer');
$dechargFluv	= GETPOST('dechargFluv');



$emballage	= GETPOST('emballage');
$adr	= GETPOST('adr');

/*********************************************************************************/
	//Siège de l’entreprise
	$filiale	= GETPOST('filiale');
	$nic	= GETPOST('nic');
	$nom_commercial	= GETPOST('nom_commercial');
	$adresse	= GETPOST('adresse');
	$adresse_suite	= GETPOST('adresse_suite');
	$code_postal	= GETPOST('code_postal');
	$commune	= GETPOST('commune');
	$tele_1	= GETPOST('tele_1');
	$tele_2	= GETPOST('tele_2');
	$nom	= GETPOST('nom');
	$prenom	= GETPOST('prenom');
	$numero_certicat	= GETPOST('numero_certicat');
	$pays_certicat	= GETPOST('pays_certicat');
	$competence_thematique	= GETPOST('competence_thematique');
	
/*********************************************************************************/


	$nic_	= array();  $nom_commercial_	= array();	$adresse_	= array();	$adresse_suite_	= array();	$code_postal_	= array();	$commune_	= array();	$tele_1_	= array();	$tele_2_	= array();	$nom_	= array();	$prenom_	= array();	$numero_certicat_	= array();	$pays_certicat_	= array();	$competence_thematique_	= array();
	

// var_dump($_POST);die;
// nbr contacts
$nbrcnt = 0;
if(!empty($_POST)){
	// $nbrcnt = 2;
	// if(!empty($filiale)){
		
		$nbrcnt = count($_POST['nic_']);
	// }
	for($i = 0; $i<$nbrcnt; $i++){
		$nic_[$i]	= GETPOST('nic_')[$i];
		$nom_commercial_[$i]	= GETPOST('nom_commercial_')[$i];
		$adresse_[$i]	= GETPOST('adresse_')[$i];
		$adresse_suite_[$i]	= GETPOST('adresse_suite_')[$i];
		$code_postal_[$i]	= GETPOST('code_postal_')[$i];
		$commune_[$i]	= GETPOST('commune_')[$i];
		$tele_1_[$i]	= GETPOST('tele_1_')[$i];
		$tele_2_[$i]	= GETPOST('tele_2_')[$i];
		$nom_[$i]	= GETPOST('nom_')[$i];
		$prenom_[$i]	= GETPOST('prenom_')[$i];
		$numero_certicat_[$i]	= GETPOST('numero_certicat_')[$i];
		$pays_certicat_[$i]	= GETPOST('pays_certicat_')[$i];
		$competence_thematique_[$i]	= GETPOST('competence_thematique_')[$i];
	}
}
// var_dump($nbrcnt);die;
	//Établissement 1 :


	// données pour 1er page
	$nic_1	= GETPOST('nic_1');
	$nom_commercial_1	= GETPOST('nom_commercial_1');
	$adresse_1	= GETPOST('adresse_1');
	$adresse_suite_1	= GETPOST('adresse_suite_1');
	$code_postal_1	= GETPOST('code_postal_1');
	$commune_1	= GETPOST('commune_1');
	$tele_1_1	= GETPOST('tele_1_1');
	$tele_2_1	= GETPOST('tele_2_1');
	$nom_1	= GETPOST('nom_1');
	$prenom_1	= GETPOST('prenom_1');
	$numero_certicat_1	= GETPOST('numero_certicat_1');
	$pays_certicat_1	= GETPOST('pays_certicat_1');
	$competence_thematique_1	= GETPOST('competence_thematique_1');
	
	if(!empty($filiale)){
		
		$nic_1	= $nic_[0];
		$nom_commercial_1	= $nom_commercial_[0];
		$adresse_1	= $adresse_[0];
		$adresse_suite_1	= $adresse_suite_[0];
		$code_postal_1	= $code_postal_[0];
		$commune_1	= $commune_[0];
		$tele_1_1	= $tele_1_[0];
		$tele_2_1	= $tele_2_[0];
		$nom_1	= $nom_[0];
		$prenom_1	= $prenom_[0];
		$numero_certicat_1	= $numero_certicat_[0];
		$pays_certicat_1	= $pays_certicat_[0];
		$competence_thematique_1	= $competence_thematique_[0];
		
	}
	

	$date	= GETPOST('date');




if(!empty($transRoute)) $tR = "X"; if(!empty($transFer)) $tFer = "X"; if(!empty($transFluv)) $tFl = "X";

if(!empty($chargRoute)) $cR = "X"; if(!empty($chargFer)) $cFer = "X"; if(!empty($chargFluv)) $cFl = "X";

if(!empty($rempRoute)) $rR = "X"; if(!empty($rempFer)) $rFer = "X"; if(!empty($rempFluv)) $rFl = "X";

if(!empty($dechargRoute)) $dR = "X"; if(!empty($dechargFer)) $dFer = "X"; if(!empty($dechargFluv)) $dFl = "X";

if(!empty($emballage)) $emballage = "X"; if(!empty($adr)) $adr = "X";

$object = new Fichinter($db);


// Load object
if ($id > 0 || ! empty($ref))
{
	$ret=$object->fetch($id, $ref);
	if ($ret > 0) $ret=$object->fetch_thirdparty();
	if ($ret < 0) dol_print_error('',$object->error);
	//var_dump($object->thirdparty);die;
}


// initiate FPDI
$pdf = new FPDI();
// add a page
$pdf->AddPage();
// set the source file

if($nbrcnt>=6){	
	$pdf->setSourceFile("cerfa_12251-03.pdf");
}else{
	$pdf->setSourceFile("cerfa_12251-02.pdf");
}

// import page 1
$tplIdx = $pdf->importPage(1);
// use the imported page and place it at point 10,10 with a width of 100 mm
$pdf->useTemplate($tplIdx);

$pdf->SetAutoPageBreak(true, 0);
// now write some text above the imported page
$pdf->SetFont('Arial');
$pdf->SetTextColor(0, 0, 0);

$identite = array(

			//identite de l'entreprise
			"siren" => array(28,63,$objSociete->idprof1,1),
			"rs"    => array(47,68.8,$objSociete->nom,0),
			"ren"   => array(76,74.6,$lastname,0),
			"rep"   => array(37,80,$firstname,0),
			
			//Activites marchandises dangereuses de l'entreprise
			"transportRoute"   => array(49,102,$tR,0),
			"transportFer"   => array(68.8,102,$tFer,0),
			"transportFluvial"   => array(89,102,$tFl,0),
			
			"chargementRoute"   => array(148.9,102,$cR,0),
			"chargementFer"   => array(169,102,$cFer,0),
			"chargementFluvial"   => array(188.5,102,$cFl,0),
			
			"remplissageRoute"   => array(49,108,$rR,0),
			"remplissageFer"   => array(68.8,108,$rFer,0),
			"remplissageFluvial"   => array(89,108,$rFl,0),
			
			"dechargementRoute"   => array(148.9,108,$dR,0),
			"dechargementFer"   => array(169,108,$dFer,0),
			"dechargementFluvial"   => array(188.5,108,$dFl,0),
			
			"emballage"   => array(88.8,114.9,$emballage,0),
			
			"marchandises"   => array(188.4,121.8,$adr,0),
			
			//Siège de l’entreprise
			"nic"   => array(29.5,138,$nic,1),
			"nomCommercia"   => array(84,138.2,$nom_commercial,0),
			"adresseJuridique"   => array(85,146,$adresse,0),
			"adresseJuridique2"   => array(20,153,$adresse_suite,0),
			"codePostal"   => array(39,161,$code_postal,1),
			"commune"   => array(83,161.2,$commune,0),
			"telephone"   => array(36.3,169,$tele_1,1),
			"telecopie"   => array(161.8,169,$tele_2,1),
			"nomS"   => array(66,176.5,$nom,0),
			"prenomS"   => array(147,176.5,$prenom,0),
			"numCertificat"   => array(51.4,184,$numero_certicat,1),
			"paysAyant"   => array(146,184.3,$pays_certicat,0),
			"CompetenceThematique"   => array(112,192,$competence_thematique,0),
			
			//Liste des établissements et conseillers à déclarer (transmettre une copie des certificats)
	
			//Établissement 1 :
			"nicEtablis"   => array(65,215,$nic_1,1),
			"nomCommercialEtablis"   => array(120,215.6,$nom_commercial_1,0),
			"adresseJuridique1Etablis"   => array(85,221.5,$adresse_1,0),
			"adresseJuridique2Etablis"   => array(20,227,$adresse_suite_1,0),
			"codePostalEtablis"   => array(38.5,234.5,$code_postal_1,1),
			"communeEtablis"   => array(83,234.5,$commune_1,0),
			"teleEtablis"   => array(35.5,242,$tele_1_1,1),
			"telecopieEtablis"   => array(161.5,242,$tele_1_2,1),
			"nomConseiller"   => array(65,249.9,$nom_1,0),
			"prenomConseiller"   => array(145,249.9,$prenom_1,0),
			"numCertificatConseiller"   => array(51,257.5,$numero_certicat_1,1),
			"paysCertificatConseiller"   => array(145,257.5,$pays_certicat_1,0),
			"CompetenceThematiqueConseiller"   => array(110,265,$competence_thematique_1,0),
		);


$pages = array();

	$j = 2;
	// $np = 4;
	// if(isset($nic_[6])){
		// $np = 8;
	// }
	// die($np);
for($i = 0; $i<$nbrcnt; $i+=4){
	$k1 = $i+1;$k2 = $i+2;$k3 = $i+3;$k4 = $i+4;
	//$k1 = $i+2;$k2 = $i+3;$k3 = $i+4;$k4 = $i+5;
	// echo $k1.'<br>';
	// echo $code_postal_[$k1].'<br>';
	// echo $code_postal_[$k2].'<br>';
	// echo $code_postal_[$k3].'<br>';
	// echo $code_postal_[$k4].'<br>';
	$pages[$j] = array(
		//Établissement 2 :
		"nicEtablis".$k1   => array(65,30,$nic_[$k1],1),
		"nomCommercialEtablis$k1"   => array(120,30,$nom_commercial_[$k1],0),
		"adresseJuridique1Etablis$k1"   => array(85,35.8,$adresse_[$k1],0),
		"adresseJuridique2Etablis$k1"   => array(20,41.2,$adresse_suite_[$k1],0),
		"codePostalEtablis$k1"   => array(38.5,46.8,$code_postal_[$k1],1),
		"communeEtablis$k1"   => array(83,46.9,$commune_[$k1],0),
		"teleEtablis$k1"   => array(35.5,52.8,$tele_1_[$k1],1),
		"telecopieEtablis$k1"   => array(163,52.8,$tele_2_[$k1],1),
		"nomConseiller$k1"   => array(65,61.2,$nom_[$k1],0),
		"prenomConseiller$k1"   => array(145,61.2,$prenom_[$k1],0),
		"numCertificatConseiller$k1"   => array(52,67,$numero_certicat_[$k1],1),
		"paysCertificatConseiller$k1"   => array(145,67,$pays_certicat_[$k1],0),
		"CompetenceThematiqueConseiller$k1"   => array(110,72.7,$competence_thematique_[$k1],0),

		//Établissement 3 :
		"nicEtablis$k2"   => array(65,81.5,$nic_[$k2],1),
		"nomCommercialEtablis$k2"   => array(120,81.5,$nom_commercial_[$k2],0),
		"adresseJuridique1Etablis$k2"   => array(85,87.2,$adresse_[$k2],0),
		"adresseJuridique2Etablis$k2"   => array(20,92.8,$adresse_suite_[$k2],0),
		"codePostalEtablis$k2"   => array(38.5,98.2,$code_postal_[$k2],1),
		"communeEtablis$k2"   => array(83,98.2,$commune_[$k2],0),
		"teleEtablis$k2"   => array(35.5,103.8,$tele_1_[$k2],1),
		"telecopieEtablis$k2"   => array(163,103.8,$tele_2_[$k2],1),
		"nomConseiller$k2"   => array(65,113,$nom_[$k2],0),
		"prenomConseiller3"   => array(145,113,$prenom_[$k2],0),
		"numCertificatConseiller$k2"   => array(52,118.2,$numero_certicat_[$k2],1),
		"paysCertificatConseiller$k2"   => array(145,118.2,$pays_certicat_[$k2],0),
		"CompetenceThematiqueConseiller$k2"   => array(110,124,$competence_thematique_[$k2],0),
		
		//Établissement 4 :
		"nicEtablis$k3"   => array(65,133,$nic_[$k3],1),
		"nomCommercialEtablis$k3"   => array(120,133,$nom_commercial_[$k3],0),
		"adresseJuridique1Etablis$k3"   => array(85,138.8,$adresse_[$k3],0),
		"adresseJuridique2Etablis$k3"   => array(20,143.8,$adresse_suite_[$k3],0),
		"codePostalEtablis$k3"   => array(38.5,149.7,$code_postal_[$k3],1),
		"communeEtablis$k3"   => array(83,149.7,$commune_[$k3],0),
		"teleEtablis$k3"   => array(35.5,155.5,$tele_1_[$k3],1),
		"telecopieEtablis$k3"   => array(163,155.5,$tele_2_[$k3],1),
		"nomConseiller$k3"   => array(65,164.2,$nom_[$k3],0),
		"prenomConseiller$k3"   => array(145,164.2,$prenom_[$k3],0),
		"numCertificatConseiller$k3"   => array(52,170,$numero_certicat_[$k3],1),
		"paysCertificatConseiller$k3"   => array(145,170,$pays_certicat_[$k3],0),
		"CompetenceThematiqueConseiller$k3"   => array(110,175.5,$competence_thematique_[$k3],0),

		//Établissement 5 :
		"nicEtablis$k4"   => array(65,184.5,$nic_[$k4],1),
		"nomCommercialEtablis$k4"   => array(120,184.5,$nom_commercial_[$k4],0),
		"adresseJuridique1Etablis$k4"   => array(85,190.2,$adresse_[$k4],0),
		"adresseJuridique2Etablis$k4"   => array(20,195.5,$adresse_suite_[$k4],0),
		"codePostalEtablis$k4"   => array(38.5,201.5,$code_postal_[$k4],1),
		"communeEtablis$k4"   => array(83,201.5,$commune_[$k4],0),
		"teleEtablis$k4"   => array(35.5,206.7,$tele_1_[$k4],1),
		"telecopieEtablis$k4"   => array(163,206.7,$tele_2_[$k4],1),
		"nomConseiller$k4"   => array(65,216,$nom_[$k4],0),
		"prenomConseiller$k4"   => array(145,216,$prenom_[$k4],0),
		"numCertificatConseiller$k4"   => array(52,221.5,$numero_certicat_[$k4],1),
		"paysCertificatConseiller$k4"   => array(145,221.5,$pays_certicat_[$k4],0),
		"CompetenceThematiqueConseiller$k4"   => array(110,226.9,$competence_thematique_[$k4],0),
	);
	
	$j++;
}

// index derniere page
end( $pages );
$ky = key( $pages );
$pages[$ky]["date"] = array(27.6,247,$date,1);






/***************************Start contenu de la premier page****************************/
foreach($identite as $key => $valIdentite){
	$pdf->SetY($valIdentite[1]);
	$pdf->SetX($valIdentite[0]);
	if($valIdentite[3] == 1){
		$valIdentite[2] = str_split($valIdentite[2]);
		foreach($valIdentite[2] as $key => $char){
			$pdf->Cell(4,0, utf8_decode($char) ,0,'C');
		}
	}else{
		$pdf->Cell(0,0, utf8_decode($valIdentite[2]) ,0,'L');
	}
}
/***************************End contenu de la premier page****************************/

// var_dump($pages);
// var_dump($ky);die;
// autres pages
foreach($pages as $k => $page){
	
	$pdf->AddPage();
	
	$tplIdx = null;
	
	if($ky == 2){
		$tplIdx = $pdf->importPage(2);
	}elseif($k != $ky){ // si ce n'est pas la derniere page j'ajoute à chaque fois la deuxième
		$tplIdx = $pdf->importPage(2);
	}else{
		$tplIdx = $pdf->importPage(3);
	}
	
	
	// use the imported page and place it at point 10,10 with a width of 100 mm
	$pdf->useTemplate($tplIdx);
	foreach($page as $key => $valIdentite){
		$pdf->SetY($valIdentite[1]);
		$pdf->SetX($valIdentite[0]);
		if($valIdentite[3] == 1){
			$valIdentite[2] = str_split($valIdentite[2]);
			foreach($valIdentite[2] as $key => $char){
				$pdf->Cell(4,0, utf8_decode($char) ,0,'C');
			}
		}else{
			$pdf->Cell(0,0, utf8_decode($valIdentite[2]) ,0,'L');
		}
	}
}



/***************************Start contenu de la deuxieme page****************************/


//$pdf->Output();

$dir = $dolibarr_main_data_root."/icstmd/".$socid;
if (!file_exists($dir)) {
    mkdir($dir, 0777, true);
}

$filename=$dir."/pdfcerf ".date('Y_m_d').".pdf";
$pdf->Output($filename,'F');

if (isset($_SERVER["HTTP_REFERER"])) {
	header("Location: " . $_SERVER["HTTP_REFERER"]);
}

?>