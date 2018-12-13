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


$decla_1 = GETPOST('decla_1');
$decla_2 = GETPOST('decla_2');
$decla_3 = GETPOST('decla_3');
$decla_4 = GETPOST('decla_4');
$decla_5 = GETPOST('decla_5');
$decla_6 = GETPOST('decla_6');
$decla_7 = GETPOST('decla_7');



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
	//Établissement 1 :
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
	
/*********************************************************************************/
	//Établissement 2 :
	$nic_2	= GETPOST('nic_2');
	$nom_commercial_2	= GETPOST('nom_commercial_2');
	$adresse_2	= GETPOST('adresse_2');
	$adresse_suite_2	= GETPOST('adresse_suite_2');
	$code_postal_2	= GETPOST('code_postal_2');
	$commune_2	= GETPOST('commune_2');
	$tele_1_2	= GETPOST('tele_1_2');
	$tele_2_2	= GETPOST('tele_2_2');
	$nom_2	= GETPOST('nom_2');
	$prenom_2	= GETPOST('prenom_2');
	$numero_certicat_2	= GETPOST('numero_certicat_2');
	$pays_certicat_2	= GETPOST('pays_certicat_2');
	$competence_thematique_2	= GETPOST('competence_thematique_2');

/*********************************************************************************/
	//Établissement 3 :
	$nic_3	= GETPOST('nic_3');
	$nom_commercial_3	= GETPOST('nom_commercial_3');
	$adresse_3	= GETPOST('adresse_3');
	$adresse_suite_3	= GETPOST('adresse_suite_3');
	$code_postal_3	= GETPOST('code_postal_3');
	$commune_3	= GETPOST('commune_3');
	$tele_1_3	= GETPOST('tele_1_3');
	$tele_2_3	= GETPOST('tele_2_3');
	$nom_3	= GETPOST('nom_3');
	$prenom_3	= GETPOST('prenom_3');
	$numero_certicat_3	= GETPOST('numero_certicat_3');
	$pays_certicat_3	= GETPOST('pays_certicat_3');
	$competence_thematique_3	= GETPOST('competence_thematique_3');

/*********************************************************************************/
	//Établissement 4 :
	$nic_4	= GETPOST('nic_4');
	$nom_commercial_4	= GETPOST('nom_commercial_4');
	$adresse_4	= GETPOST('adresse_4');
	$adresse_suite_4	= GETPOST('adresse_suite_4');
	$code_postal_4	= GETPOST('code_postal_4');
	$commune_4	= GETPOST('commune_4');
	$tele_1_4	= GETPOST('tele_1_4');
	$tele_2_4	= GETPOST('tele_2_4');
	$nom_4	= GETPOST('nom_4');
	$prenom_4	= GETPOST('prenom_4');
	$numero_certicat_4	= GETPOST('numero_certicat_4');
	$pays_certicat_4	= GETPOST('pays_certicat_4');
	$competence_thematique_4	= GETPOST('competence_thematique_4');

/*********************************************************************************/
	//Établissement 5 :
	$nic_5	= GETPOST('nic_5');
	$nom_commercial_5	= GETPOST('nom_commercial_5');
	$adresse_5	= GETPOST('adresse_5');
	$adresse_suite_5	= GETPOST('adresse_suite_5');
	$code_postal_5	= GETPOST('code_postal_5');
	$commune_5	= GETPOST('commune_5');
	$tele_1_5	= GETPOST('tele_1_5');
	$tele_2_5	= GETPOST('tele_2_5');
	$nom_5	= GETPOST('nom_5');
	$prenom_5	= GETPOST('prenom_5');
	$numero_certicat_5	= GETPOST('numero_certicat_5');
	$pays_certicat_5	= GETPOST('pays_certicat_5');
	$competence_thematique_5	= GETPOST('competence_thematique_5');
	$date	= GETPOST('date');

/*********************************************************************************/
//var_dump($dechargement);die;





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
$pdf->setSourceFile("cerfa_materiel.pdf");
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
			"$decla_1" => array(26,33,$decla_1,0),
			"$decla_2"    => array(105,33,$decla_2,0),
			"$decla_3"   => array(105,43,$decla_3,0),
			"$decla_4"   => array(125,43,$decla_4,0),





			
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

$page2 = array(

	//Établissement 2 :
	"nicEtablis2"   => array(65,30,$nic_2,1),
	"nomCommercialEtablis2"   => array(120,30,$nom_commercial_2,0),
	"adresseJuridique1Etablis2"   => array(85,35.8,$adresse_2,0),
	"adresseJuridique2Etablis2"   => array(20,41.2,$adresse_suite_2,0),
	"codePostalEtablis2"   => array(38.5,46.8,$code_postal_2,1),
	"communeEtablis2"   => array(83,46.9,$commune_2,0),
	"teleEtablis2"   => array(35.5,52.8,$tele_1_2,1),
	"telecopieEtablis2"   => array(163,52.8,$tele_2_2,1),
	"nomConseiller2"   => array(65,61.2,$nom_2,0),
	"prenomConseiller2"   => array(145,61.2,$prenom_2,0),
	"numCertificatConseiller2"   => array(52,67,$numero_certicat_2,1),
	"paysCertificatConseiller2"   => array(145,67,$pays_certicat_2,0),
	"CompetenceThematiqueConseiller2"   => array(110,72.7,$competence_thematique_2,0),

	//Établissement 3 :
	"nicEtablis3"   => array(65,81.5,$nic_3,1),
	"nomCommercialEtablis3"   => array(120,81.5,$nom_commercial_3,0),
	"adresseJuridique1Etablis3"   => array(85,87.2,$adresse_3,0),
	"adresseJuridique2Etablis3"   => array(20,92.8,$adresse_suite_3,0),
	"codePostalEtablis3"   => array(38.5,98.2,$code_postal_3,1),
	"communeEtablis3"   => array(83,98.2,$commune_3,0),
	"teleEtablis3"   => array(35.5,103.8,$tele_1_3,1),
	"telecopieEtablis3"   => array(163,103.8,$tele_2_3,1),
	"nomConseiller3"   => array(65,113,$nom_3,0),
	"prenomConseiller3"   => array(145,113,$prenom_3,0),
	"numCertificatConseiller3"   => array(52,118.2,$numero_certicat_3,1),
	"paysCertificatConseiller3"   => array(145,118.2,$pays_certicat_3,0),
	"CompetenceThematiqueConseiller3"   => array(110,124,$competence_thematique_3,0),
	
	//Établissement 4 :
	"nicEtablis4"   => array(65,133,$nic_4,1),
	"nomCommercialEtablis4"   => array(120,133,$nom_commercial_4,0),
	"adresseJuridique1Etablis4"   => array(85,138.8,$adresse_4,0),
	"adresseJuridique2Etablis4"   => array(20,143.8,$adresse_suite_4,0),
	"codePostalEtablis4"   => array(38.5,149.7,$code_postal_4,1),
	"communeEtablis4"   => array(83,149.7,$commune_4,0),
	"teleEtablis4"   => array(35.5,155.5,$tele_1_4,1),
	"telecopieEtablis4"   => array(163,155.5,$tele_2_4,1),
	"nomConseiller4"   => array(65,164.2,$nom_4,0),
	"prenomConseiller4"   => array(145,164.2,$prenom_4,0),
	"numCertificatConseiller4"   => array(52,170,$numero_certicat_4,1),
	"paysCertificatConseiller4"   => array(145,170,$pays_certicat_4,0),
	"CompetenceThematiqueConseiller4"   => array(110,175.5,$competence_thematique_4,0),

	//Établissement 5 :
	"nicEtablis5"   => array(65,184.5,$nic_5,1),
	"nomCommercialEtablis5"   => array(120,184.5,$nom_commercial_5,0),
	"adresseJuridique1Etablis5"   => array(85,190.2,$adresse_5,0),
	"adresseJuridique2Etablis5"   => array(20,195.5,$adresse_suite_5,0),
	"codePostalEtablis5"   => array(38.5,201.5,$code_postal_5,1),
	"communeEtablis5"   => array(83,201.5,$commune_5,0),
	"teleEtablis5"   => array(35.5,206.7,$tele_1_5,1),
	"telecopieEtablis5"   => array(163,206.7,$tele_2_5,1),
	"nomConseiller5"   => array(65,216,$nom_5,0),
	"prenomConseiller5"   => array(145,216,$prenom_5,0),
	"numCertificatConseiller5"   => array(52,221.5,$numero_certicat_5,1),
	"paysCertificatConseiller5"   => array(145,221.5,$pays_certicat_5,0),
	"CompetenceThematiqueConseiller5"   => array(110,226.9,$competence_thematique_5,0),
	
	"date" => array(27.6,247,$date,1)
);
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


// add a page 2
$pdf->AddPage();
// import page 2
$tplIdx = $pdf->importPage(2);
// use the imported page and place it at point 10,10 with a width of 100 mm
$pdf->useTemplate($tplIdx);


/***************************Start contenu de la deuxieme page****************************/
foreach($page2 as $key => $valIdentite){
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


