<?php
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

if (false === (@include '../main.inc.php')) {  // From htdocs directory
require '../../main.inc.php'; // From "custom" directory
}
require_once DOL_DOCUMENT_ROOT.'/core/class/html.formfile.class.php';
require_once DOL_DOCUMENT_ROOT.'/fichinter/class/fichinter.class.php';
require_once DOL_DOCUMENT_ROOT.'/core/modules/fichinter/modules_fichinter.php';
require_once DOL_DOCUMENT_ROOT.'/core/lib/fichinter.lib.php';
require_once DOL_DOCUMENT_ROOT.'/core/lib/company.lib.php';
require_once DOL_DOCUMENT_ROOT.'/user/class/user.class.php';
require_once DOL_DOCUMENT_ROOT.'/includes/fpdf/fpdf/fpdf.php';


$id	= GETPOST('id','int');

$objSociete = new Societe($db);
if ($id > 0) $objSociete->fetch($id);

$contacts = $objSociete->contact_array_objects();
// var_dump($object->contact_array_objects());die;
$data = array();
// var_dump($contacts);die;
foreach($contacts as $k => $v){
	//var_dump($v->array_options);die;
	$sql = "SELECT * ";
	$sql.= " FROM ".MAIN_DB_PREFIX."categorie_contact as p1, ".MAIN_DB_PREFIX."categorie as p2 ";	
	$sql.= " WHERE p1.fk_categorie = p2.rowid";
	$sql.= " AND p2.label = 'Filiale'";
	$sql.= " AND p1.fk_socpeople = ".$v->id;
	// echo $sql;
	$resql = $db->query($sql);
	if ($resql) {
		
		if ($db->num_rows($resql)) {
			$data[] = array('nom' => $v->lastname, 'prenom' => $v->firstname, 'adresse' => $v->address, 'cp' => $v->zip , 'ville' => $v->town, 'pays' => $v->country, 'tel1' => $v->phone_pro, 'tel2' => $v->phone_mobile, );
			// $obj = $db->fetch_object($resql);
			// $user_id = $obj->rowid;
			
		}
	}
}


// var_dump($data);
// die();

$object = new Fichinter($db);
$extrafields = new ExtraFields($db);
$extralabels=$extrafields->fetch_name_optionals_label($object->table_element);

// Load object
if ($id > 0 || ! empty($ref))
{
	$ret=$object->fetch($id, $ref);
	if ($ret > 0) $ret=$object->fetch_thirdparty();
	if ($ret < 0) dol_print_error('',$object->error);
}

$permissionnote=$user->rights->ficheinter->creer;	// Used by the include of actions_setnotes.inc.php
$permissiondellink=$user->rights->ficheinter->creer;	// Used by the include of actions_dellink.inc.php

class PDF extends FPDF {}

$pdf = new PDF();
$pdf->AliasNbPages();
$pdf->AddPage();

/*
 * View
 */


llxHeader('',$langs->trans("Intervention"));


	$head = societe_prepare_head($objSociete);

    dol_fiche_head($head, 'tabname1', $langs->trans("ThirdParty"),0,'company');
	
    
	$full_name=explode(" ",$objSociete->array_options['options_cstmd']);
	
	$user_cstmd = new User($db);
	
	$sql = "SELECT rowid ";
	$sql.= " FROM ".MAIN_DB_PREFIX."user";	
	$sql.= " WHERE firstname = '" . $full_name[0] . "'";
	$sql.= " AND lastname = '" . $full_name[1] . "'";

$user_id = null;
dol_syslog(__METHOD__ . " sql=" . $sql, LOG_DEBUG);
$resql = $db->query($sql);
if ($resql) {
	if ($db->num_rows($resql)) {
		$obj = $db->fetch_object($resql);
		$user_id = $obj->rowid;
		
	}
}

$user_cstmd->fetch($user_id); 

// classes et domaines cstmd
$compcstmd = "";

if ($user_cstmd->array_options['options_clcstmd'] == 1) {
$compcstmd = "Classe 3 à 9";}
if ($user_cstmd->array_options['options_clcstmd'] == 2) {
$compcstmd = "Classe 2";}
if ($user_cstmd->array_options['options_clcstmd'] == 3) {
$compcstmd = "Classe 1";}
if ($user_cstmd->array_options['options_clcstmd'] == 4) {
$compcstmd = "Classe 7";}
if ($user_cstmd->array_options['options_clcstmd'] == 5) {
$compcstmd = "PP";}
if ($user_cstmd->array_options['options_clcstmd'] == 6) {
$compcstmd = "Toutes Classes";}
if ($user_cstmd->array_options['options_clcstmd'] == 7) {
$compcstmd = "1 + 2 + 3 à 9";}
if ($user_cstmd->array_options['options_clcstmd'] == 8) {
$compcstmd = "2 + 3 à 9";}


	
print '<form action="pdf_cert.php" method="POST" target="_blank"><div class="container">
	<input type="hidden" name="interv_id" value="'.$id.'">
    <div class="header">
		<span style="font-size:22px;color:#fff;margin-left:35px;">Activités marchandises dangereurses de l\'entreprise </span>
	</div>
    <div class="mainbody">
			<table style="width: 100%;">
				 <thead>
					  <tr>
						 <th style="width: 15%;"></th>
						 <th>Route</th>
						 <th>Fer</th>
						 <th>Fluvial</th>
						 <th style="width: 15%;"></th>
						 <th>Route</th>
						 <th>Fer</th>
						 <th>Fluvial</th>
					  </tr>
				 </thead>
				 <tfoot>
					  <tr>
						 <td></td>
						 <td></td>
					  </tr>
				 </tfoot>
				 <tbody>
					  <tr>
						 <td style="font-size:17px;">Transport</td>
						 <td style="text-align: center;"><input type="checkbox" name="transRoute" value="route"/></td>
						 <td style="text-align: center;"><input type="checkbox" name="transFer" value="fer" /></td>
						 <td style="text-align: center;"><input type="checkbox" name="transFluv" value="fluvial" /></td>
						 <td style="font-size:17px;">Chargement</td>
						 <td style="text-align: center;"><input type="checkbox" name="chargRoute" value="route" /></td>
						 <td style="text-align: center;"><input type="checkbox" name="chargFer" value="fer" /></td>
						 <td style="text-align: center;"><input type="checkbox" name="chargFluv" value="fluvial" /></td>
					  </tr>
					  <tr>
						 <td style="font-size:17px;">Remplissage</td>
						 <td style="text-align: center;"><input type="checkbox" name="rempRoute" value="route"/></td>
						 <td style="text-align: center;"><input type="checkbox" name="rempFer" value="fer" /></td>
						 <td style="text-align: center;"><input type="checkbox" name="rempFluv" value="fluvial" /></td>
						 <td style="font-size:17px;">Déchargement</td>
						 <td style="text-align: center;"><input type="checkbox" name="dechargRoute" value="route"/></td>
						 <td style="text-align: center;"><input type="checkbox" name="dechargFer" value="fer" /></td>
						 <td style="text-align: center;"><input type="checkbox" name="dechargFluv" value="fluvial" /></td>
					  </tr>
					  <tr>
						 <td colspan="8">
							<hr style="border-color: #0153a0;">
						 </td>
					  </tr>
					  <tr>
						 <td style="font-size:17px;" colspan="3">
							Emballage (tous modes confondus)
						 </td>
						 <td style="text-align: center;"><input type="checkbox" name="emballage" /></td>
						 <td colspan="4">
						 </td>
					  </tr>
					  <tr>
						 <td colspan="8">
							<hr style="border-color: #0153a0;">
						 </td>
					  </tr>
					  <tr>
						 <td style="font-size:17px;" colspan="7">
							Marchandises dangereurses à haut risque selon accord ADR (tableau 1.10.5)
						 </td>
						 <td style="text-align: center;"><input type="checkbox" name="adr"/></td>
					  </tr>
				 </tbody>
			</table>
    </div>
	
</div><br>';
print '<div class="container">
    <div class="header">
		<span style="font-size:22px;color:#fff;margin-left:35px;">Siège de l\'entreprise</span>
	</div>
    <div class="mainbody">
	   <table style="width: 100%;">
			<tr>
				<td style="font-size:17px;">NIC<b>(1)</b> : </td>
				<td><input  name="nic" style="width: 80%;" type="text" value="'.substr($objSociete->idprof2, -5).'"/></td>
				<td style="font-size:17px;" >Nom commercial : </td>
				<td colspan="3"><input name="nom_commercial" style="width: 95%;" type="text" value="'.$objSociete->nom.'"/></td>
			</tr>
			<tr>
				<td colspan="2" style="font-size:17px;">Adresse juridique <span style="font-size:13px;"><i>(N°, type et nom de la voie )</i></span> : </td>
				<td colspan="4"><input name="adresse" style="width: 96%;" type="text" value="'.$objSociete->address.'"/></td>
			</tr>
			<tr>
				<td colspan="6"><input name="adresse_suite" style="width: 98%;" type="text" value="'.$pays.'"/></td>
			</tr>
			<tr>
				<td style="font-size:17px;">Code Postal :  </td>
				<td style="text-align: center;"><input name="code_postal" type="text" value="'.$objSociete->zip.'"/></td>
				<td style="font-size:17px;" >Commune : </td>
				<td colspan="3"><input name="commune" style="width: 95%;" type="text" value="'.$objSociete->town.'"/></td>
			</tr>
			<tr>
				<td style="font-size:17px;">Téléphone :  </td>
				<td colspan="2"><input name="tele_1" style="width: 76%;" type="text" value="'.$objSociete->phone.'"/></td>
				<td style="font-size:17px;" >FAX : </td>
				<td colspan="2"><input  name="tele_2" style="width: 93%;" type="text" value="'.$objSociete->fax.'"/></td>
			</tr>
			<tr>
				<td style="font-size:17px;"><span style="margin-left: -5%;    padding-left: 10%;background-color:#7b92c6;padding-right: 22%;padding-top: 1%;padding-bottom: 1%;"><b>Conseiller :</b></span>  </td>
				<td style="font-size:17px;">Nom :</td>
				<td colspan="2"><input name="nom" style="width: 85%;" type="text" value="'.$full_name[1].'"/></td>
				<td style="font-size:17px;">Prenom :</td>
				<td ><input  name="prenom" style="width: 90%;" type="text" value="'.$full_name[0].'"/></td>
			</tr>
			<tr>
				<td style="font-size:17px;">Numéro du certicat :</td>
				<td style="text-align: center;" ><input name="numero_certicat" type="text" value="'. $user_cstmd->array_options['options_cstmd'] .'"/></td>
				<td colspan="2" style="font-size:17px;">Pays ayant délivré le certicat :</td>
				<td colspan="2"><input name="pays_certicat" style="width: 93%;" type="text" value="FRANCE"/></td>
			</tr>
			<tr>
				<td colspan="2" style="font-size:17px;">Compétence thématique (classes, domaines d\'activité...) :</td>
				<td colspan="4"><input name="competence_thematique" style="width: 96%;" type="text" value="'. $compcstmd  .'" /></td>
			</tr>
		</table>
    </div>
</div><br>';


print '<div class="tab">
	<span style="font-size:21px;color:#fff;">Liste des établissements et conseillers à déclarer (transmettre une copie des certificats)</span>
</div><br>';


if(empty($data)){
	print '<div class="container">
		<div class="mainbody">
		   <table style="width: 100%;">
				<tr>
					<td colspan="2" style="font-size:17px;"><span style="margin-left: -5%;    padding-left: 10%;background-color:#7b92c6;padding-right: 22%;padding-top: 1%;padding-bottom: 1%;"><b>Établissement 1 :</b></span>  </td>
					<td style="font-size:17px;">NIC<b>(1)</b> : </td>
					<td><input name="nic_1" style="width: 80%;" type="text"/></td>
					<td style="font-size:17px;" colspan="2" >Nom commercial : </td>
					<td colspan="2"><input name="nom_commercial_1" type="text"/></td>
				</tr>
				<tr>
					<td colspan="3" style="font-size:17px;">Adresse juridique <span style="font-size:13px;"><i>(N°, type et nom de la voie )</i></span> : </td>
					<td colspan="5"><input name="adresse_1" style="width: 96%;" type="text"/></td>
				</tr>
				<tr>
					<td colspan="8"><input name="adresse_suite_1" style="width: 98%;" type="text"/></td>
				</tr>
				<tr>
					<td colspan="2" style="font-size:17px;">Code Postal :  </td>
					<td  style="text-align: center;"><input colspan="2" name="code_postal_1" type="text"/></td>
					<td colspan="2" style="font-size:17px;" >Commune : </td>
					<td colspan="2"><input name="commune_1" style="width: 95%;" type="text"/></td>
				</tr>
				<tr>
					<td colspan="2" style="font-size:17px;">Téléphone :  </td>
					<td colspan="2"><input name="tele_1_1" style="width: 76%;" type="text"/></td>
					<td colspan="2" style="font-size:17px;" >Téléphone : </td>
					<td colspan="2"><input name="tele_2_1" style="width: 93%;" type="text"/></td>
				</tr>
				<tr>
					<td style="font-size:17px;"><span style="margin-left: -5%;    padding-left: 10%;background-color:#7b92c6;padding-right: 22%;padding-top: 1%;padding-bottom: 1%;"><b>Conseiller :</b></span>  </td>
					<td style="font-size:17px;">Nom :</td>
					<td colspan="2"><input name="nom_1" style="width: 85%;" type="text"/></td>
					<td colspan="2" style="font-size:17px;">Prenom :</td>
					<td ><input name="prenom_1" style="width: 90%;" type="text"/></td>
				</tr>
				<tr>
					<td style="font-size:17px;">Numéro du certicat :</td>
					<td style="text-align: center;" ><input name="numero_certicat_1" type="text"/></td>
					<td colspan="3" style="font-size:17px;">Pays ayant délivré le certicat :</td>
					<td colspan="3"><input style="width: 93%;" name="pays_certicat_1" type="text"/></td>
				</tr>
				<tr>
					<td colspan="3" style="font-size:17px;">Compétence thématique (classes, domaines d\'activité...) :</td>
					<td colspan="5"><input name="competence_thematique_1" style="width: 96%;" type="text"/></td>
				</tr>
			</table>
		</div>
	</div>
	<br>
	<div class="container">
		<div class="mainbody">
		   <table style="width: 100%;">
				<tr>
					<td colspan="2" style="font-size:17px;"><span style="margin-left: -5%;    padding-left: 10%;background-color:#7b92c6;padding-right: 22%;padding-top: 1%;padding-bottom: 1%;"><b>Établissement 2 :</b></span>  </td>
					<td style="font-size:17px;">NIC<b>(1)</b> : </td>
					<td><input name="nic_[]" style="width: 80%;" type="text"/></td>
					<td style="font-size:17px;" colspan="2" >Nom commercial : </td>
					<td colspan="2"><input name="nom_commercial_[]" type="text"/></td>
				</tr>
				<tr>
					<td colspan="3" style="font-size:17px;">Adresse juridique <span style="font-size:13px;"><i>(N°, type et nom de la voie )</i></span> : </td>
					<td colspan="5"><input name="adresse_[]" style="width: 96%;" type="text"/></td>
				</tr>
				<tr>
					<td colspan="8"><input name="adresse_suite_[]" style="width: 98%;" type="text"/></td>
				</tr>
				<tr>
					<td colspan="2" style="font-size:17px;">Code Postal :  </td>
					<td  style="text-align: center;"><input colspan="2" name="code_postal_[]" type="text"/></td>
					<td colspan="2" style="font-size:17px;" >Commune : </td>
					<td colspan="2"><input name="commune_[]" style="width: 95%;" type="text"/></td>
				</tr>
				<tr>
					<td colspan="2" style="font-size:17px;">Téléphone :  </td>
					<td colspan="2"><input name="tele_1_[]" style="width: 76%;" type="text"/></td>
					<td colspan="2" style="font-size:17px;" >Téléphone : </td>
					<td colspan="2"><input name="tele_2_[]" style="width: 93%;" type="text"/></td>
				</tr>
				<tr>
					<td style="font-size:17px;"><span style="margin-left: -5%;    padding-left: 10%;background-color:#7b92c6;padding-right: 22%;padding-top: 1%;padding-bottom: 1%;"><b>Conseiller :</b></span>  </td>
					<td style="font-size:17px;">Nom :</td>
					<td colspan="2"><input name="nom_[]" style="width: 85%;" type="text"/></td>
					<td colspan="2" style="font-size:17px;">Prenom :</td>
					<td ><input name="prenom_[]" style="width: 90%;" type="text"/></td>
				</tr>
				<tr>
					<td style="font-size:17px;">Numéro du certicat :</td>
					<td style="text-align: center;" ><input name="numero_certicat_[]" type="text"/></td>
					<td colspan="3" style="font-size:17px;">Pays ayant délivré le certicat :</td>
					<td colspan="3"><input style="width: 93%;" name="pays_certicat_[]" type="text"/></td>
				</tr>
				<tr>
					<td colspan="3" style="font-size:17px;">Compétence thématique (classes, domaines d\'activité...) :</td>
					<td colspan="5"><input name="competence_thematique_[]" style="width: 96%;" type="text"/></td>
				</tr>
			</table>
		</div>
	</div>
	<br>
	<div class="container">
		<div class="mainbody">
		   <table style="width: 100%;">
				<tr>
					<td colspan="2" style="font-size:17px;"><span style="margin-left: -5%;    padding-left: 10%;background-color:#7b92c6;padding-right: 22%;padding-top: 1%;padding-bottom: 1%;"><b>Établissement 3 :</b></span>  </td>
					<td style="font-size:17px;">NIC<b>(1)</b> : </td>
					<td><input name="nic_[]" style="width: 80%;" type="text"/></td>
					<td style="font-size:17px;" colspan="2" >Nom commercial : </td>
					<td colspan="2"><input name="nom_commercial_[]" type="text"/></td>
				</tr>
				<tr>
					<td colspan="3" style="font-size:17px;">Adresse juridique <span style="font-size:13px;"><i>(N°, type et nom de la voie )</i></span> : </td>
					<td colspan="5"><input name="adresse_[]" style="width: 96%;" type="text"/></td>
				</tr>
				<tr>
					<td colspan="8"><input name="adresse_suite_[]" style="width: 98%;" type="text"/></td>
				</tr>
				<tr>
					<td colspan="2" style="font-size:17px;">Code Postal :  </td>
					<td  style="text-align: center;"><input colspan="2" name="code_postal_[]" type="text"/></td>
					<td colspan="2" style="font-size:17px;" >Commune : </td>
					<td colspan="2"><input name="commune_[]" style="width: 95%;" type="text"/></td>
				</tr>
				<tr>
					<td colspan="2" style="font-size:17px;">Téléphone :  </td>
					<td colspan="2"><input name="tele_1_[]" style="width: 76%;" type="text"/></td>
					<td colspan="2" style="font-size:17px;" >Téléphone : </td>
					<td colspan="2"><input name="tele_2_[]" style="width: 93%;" type="text"/></td>
				</tr>
				<tr>
					<td style="font-size:17px;"><span style="margin-left: -5%;    padding-left: 10%;background-color:#7b92c6;padding-right: 22%;padding-top: 1%;padding-bottom: 1%;"><b>Conseiller :</b></span>  </td>
					<td style="font-size:17px;">Nom :</td>
					<td colspan="2"><input name="nom_[]" style="width: 85%;" type="text"/></td>
					<td colspan="2" style="font-size:17px;">Prenom :</td>
					<td ><input name="prenom_[]" style="width: 90%;" type="text"/></td>
				</tr>
				<tr>
					<td style="font-size:17px;">Numéro du certicat :</td>
					<td style="text-align: center;" ><input name="numero_certicat_[]" type="text"/></td>
					<td colspan="3" style="font-size:17px;">Pays ayant délivré le certicat :</td>
					<td colspan="3"><input style="width: 93%;" name="pays_certicat_[]" type="text"/></td>
				</tr>
				<tr>
					<td colspan="3" style="font-size:17px;">Compétence thématique (classes, domaines d\'activité...) :</td>
					<td colspan="5"><input name="competence_thematique_[]" style="width: 96%;" type="text"/></td>
				</tr>
			</table>
		</div>
	</div>
	<br>
	<div class="container">
		<div class="mainbody">
		   <table style="width: 100%;">
				<tr>
					<td colspan="2" style="font-size:17px;"><span style="margin-left: -5%;    padding-left: 10%;background-color:#7b92c6;padding-right: 22%;padding-top: 1%;padding-bottom: 1%;"><b>Établissement 4 :</b></span>  </td>
					<td style="font-size:17px;">NIC<b>(1)</b> : </td>
					<td><input name="nic_[]" style="width: 80%;" type="text"/></td>
					<td style="font-size:17px;" colspan="2" >Nom commercial : </td>
					<td colspan="2"><input name="nom_commercial_[]" type="text"/></td>
				</tr>
				<tr>
					<td colspan="3" style="font-size:17px;">Adresse juridique <span style="font-size:13px;"><i>(N°, type et nom de la voie )</i></span> : </td>
					<td colspan="5"><input name="adresse_[]" style="width: 96%;" type="text"/></td>
				</tr>
				<tr>
					<td colspan="8"><input name="adresse_suite_[]" style="width: 98%;" type="text"/></td>
				</tr>
				<tr>
					<td colspan="2" style="font-size:17px;">Code Postal :  </td>
					<td  style="text-align: center;"><input colspan="2" name="code_postal_[]" type="text"/></td>
					<td colspan="2" style="font-size:17px;" >Commune : </td>
					<td colspan="2"><input name="commune_[]" style="width: 95%;" type="text"/></td>
				</tr>
				<tr>
					<td colspan="2" style="font-size:17px;">Téléphone :  </td>
					<td colspan="2"><input name="tele_1_[]" style="width: 76%;" type="text"/></td>
					<td colspan="2" style="font-size:17px;" >Téléphone : </td>
					<td colspan="2"><input name="tele_2_[]" style="width: 93%;" type="text"/></td>
				</tr>
				<tr>
					<td style="font-size:17px;"><span style="margin-left: -5%;    padding-left: 10%;background-color:#7b92c6;padding-right: 22%;padding-top: 1%;padding-bottom: 1%;"><b>Conseiller :</b></span>  </td>
					<td style="font-size:17px;">Nom :</td>
					<td colspan="2"><input name="nom_[]" style="width: 85%;" type="text"/></td>
					<td colspan="2" style="font-size:17px;">Prenom :</td>
					<td ><input name="prenom_[]" style="width: 90%;" type="text"/></td>
				</tr>
				<tr>
					<td style="font-size:17px;">Numéro du certicat :</td>
					<td style="text-align: center;" ><input name="numero_certicat_[]" type="text"/></td>
					<td colspan="3" style="font-size:17px;">Pays ayant délivré le certicat :</td>
					<td colspan="3"><input style="width: 93%;" name="pays_certicat_[]" type="text"/></td>
				</tr>
				<tr>
					<td colspan="3" style="font-size:17px;">Compétence thématique (classes, domaines d\'activité...) :</td>
					<td colspan="5"><input name="competence_thematique_[]" style="width: 96%;" type="text"/></td>
				</tr>
			</table>
		</div>
	</div>
	<br>
	<div class="container">
		<div class="mainbody">
		   <table style="width: 100%;">
				<tr>
					<td colspan="2" style="font-size:17px;"><span style="margin-left: -5%;    padding-left: 10%;background-color:#7b92c6;padding-right: 22%;padding-top: 1%;padding-bottom: 1%;"><b>Établissement 5 :</b></span>  </td>
					<td style="font-size:17px;">NIC<b>(1)</b> : </td>
					<td><input name="nic_[]" style="width: 80%;" type="text"/></td>
					<td style="font-size:17px;" colspan="2" >Nom commercial : </td>
					<td colspan="2"><input name="nom_commercial_[]" type="text"/></td>
				</tr>
				<tr>
					<td colspan="3" style="font-size:17px;">Adresse juridique <span style="font-size:13px;"><i>(N°, type et nom de la voie )</i></span> : </td>
					<td colspan="5"><input name="adresse_[]" style="width: 96%;" type="text"/></td>
				</tr>
				<tr>
					<td colspan="8"><input name="adresse_suite_[]" style="width: 98%;" type="text"/></td>
				</tr>
				<tr>
					<td colspan="2" style="font-size:17px;">Code Postal :  </td>
					<td  style="text-align: center;"><input colspan="2" name="code_postal_[]5" type="text"/></td>
					<td colspan="2" style="font-size:17px;" >Commune : </td>
					<td colspan="2"><input name="commune_[]" style="width: 95%;" type="text"/></td>
				</tr>
				<tr>
					<td colspan="2" style="font-size:17px;">Téléphone :  </td>
					<td colspan="2"><input name="tele_1_[]" style="width: 76%;" type="text"/></td>
					<td colspan="2" style="font-size:17px;" >Téléphone : </td>
					<td colspan="2"><input name="tele_2_[]" style="width: 93%;" type="text"/></td>
				</tr>
				<tr>
					<td style="font-size:17px;"><span style="margin-left: -5%;    padding-left: 10%;background-color:#7b92c6;padding-right: 22%;padding-top: 1%;padding-bottom: 1%;"><b>Conseiller :</b></span>  </td>
					<td style="font-size:17px;">Nom :</td>
					<td colspan="2"><input name="nom_[]" style="width: 85%;" type="text"/></td>
					<td colspan="2" style="font-size:17px;">Prenom :</td>
					<td ><input name="prenom_[]" style="width: 90%;" type="text"/></td>
				</tr>
				<tr>
					<td style="font-size:17px;">Numéro du certicat :</td>
					<td style="text-align: center;" ><input name="numero_certicat_[]" type="text"/></td>
					<td colspan="3" style="font-size:17px;">Pays ayant délivré le certicat :</td>
					<td colspan="3"><input style="width: 93%;" name="pays_certicat_[]" type="text"/></td>
				</tr>
				<tr>
					<td colspan="3" style="font-size:17px;">Compétence thématique (classes, domaines d\'activité...) :</td>
					<td colspan="5"><input name="competence_thematique_[]" style="width: 96%;" type="text"/></td>
				</tr>
			</table>
		</div>
	</div>
	<br>
	<hr>
	<table style="width: 100%;">
		<tr>
			<td style="font-size:17px;" >date</td>
			<td><input name="date" style="width: 80%;" type="text"/></td>
		</tr>
	</table>
	<hr>
	<br>
	<div class="center"><input type="submit" class="button" name="add" value="'.$langs->trans("Create").'"></div>
	</form>';
}else{
	
	foreach($data as $k => $filiale){
		
		$i = $k +1;
		print '<div class="container">
				<div class="mainbody">
				   <table style="width: 100%;">
						<tr>
							<td colspan="2" style="font-size:17px;"><span style="margin-left: -5%;    padding-left: 10%;background-color:#7b92c6;padding-right: 22%;padding-top: 1%;padding-bottom: 1%;"><b>Établissement '.$i.' :</b></span>  </td>
							<td style="font-size:17px;">NIC<b>(1)</b> : </td>
							<td><input name="nic_[]" style="width: 80%;" type="text"/></td>
							<td style="font-size:17px;" colspan="2" >Nom commercial : </td>
							<td colspan="2"><input name="nom_commercial_[]" type="text"/><input name="filiale" type="hidden" value="1"/></td>
						</tr>
						<tr>
							<td colspan="3" style="font-size:17px;">Adresse juridique <span style="font-size:13px;"><i>(N°, type et nom de la voie )</i></span> : </td>
							<td colspan="5"><input name="adresse_[]" style="width: 96%;" type="text" /></td>
						</tr>
						<tr>
							<td colspan="8"><input name="adresse_suite_[]" style="width: 98%;" type="text" value="' .$filiale['adresse']. '"/></td>
						</tr>
						<tr>
							<td colspan="2" style="font-size:17px;">Code Postal :  </td>
							<td  style="text-align: center;"><input colspan="2" name="code_postal_[]" type="text"  value="' .$filiale['cp']. '"/></td>
							<td colspan="2" style="font-size:17px;" >Commune : </td>
							<td colspan="2"><input name="commune_[]" style="width: 95%;" type="text" value="' .$filiale['ville']. '"/></td>
						</tr>
						<tr>
							<td colspan="2" style="font-size:17px;">Téléphone :  </td>
							<td colspan="2"><input name="tele_1_[]" style="width: 76%;" type="text" value="' .$filiale['tel1']. '"/></td>
							<td colspan="2" style="font-size:17px;" >Téléphone : </td>
							<td colspan="2"><input name="tele_2_[]" style="width: 93%;" type="text" value="' .$filiale['tel2']. '"/></td>
						</tr>
						<tr>
							<td style="font-size:17px;"><span style="margin-left: -5%;    padding-left: 10%;background-color:#7b92c6;padding-right: 22%;padding-top: 1%;padding-bottom: 1%;"><b>Conseiller :</b></span>  </td>
							<td style="font-size:17px;">Nom :</td>
							<td colspan="2"><input name="nom_[]" style="width: 85%;" type="text" value="' .$filiale['nom']. '"/></td>
							<td colspan="2" style="font-size:17px;">Prenom :</td>
							<td ><input name="prenom_[]" style="width: 90%;" type="text" value="' .$filiale['prenom']. '"/></td>
						</tr>
						<tr>
							<td style="font-size:17px;">Numéro du certicat :</td>
							<td style="text-align: center;" ><input name="numero_certicat_[]" type="text"/></td>
							<td colspan="3" style="font-size:17px;">Pays ayant délivré le certicat :</td>
							<td colspan="3"><input style="width: 93%;" name="pays_certicat_[]" type="text" value="FRANCE"/></td>
						</tr>
						<tr>
							<td colspan="3" style="font-size:17px;">Compétence thématique (classes, domaines d\'activité...) :</td>
							<td colspan="5"><input name="competence_thematique_[]" style="width: 96%;" type="text"/></td>
						</tr>
					</table>
				</div>
			</div>
			<br>';
	}	
	
	print '
	<hr>
	<table style="width: 100%;">
		<tr>
			<td style="font-size:17px;" >date</td>
			<td><input name="date" style="width: 80%;" type="text"/></td>
		</tr>
	</table>
	<hr>
	<br>
	<div class="center"><input type="submit" class="button" name="add" value="'.$langs->trans("Create").'"></div>
	</form>';
	
}


print '
<style>
.container {
    margin: 10px;
    border: 1px solid #0153a0;
    background-color: #ffffff;
    box-shadow: 0px 2px 7px #292929;
    -moz-box-shadow: 0px 2px 7px #292929;
    -webkit-box-shadow: 0px 2px 7px #292929;
    border-radius: 15px;
    -moz-border-radius: 15px;
    -webkit-border-radius: 15px;
}
.mainbody,
.header,
.footer {
    padding: 5px;
}
.mainbody {
    margin-top: 0;
    min-height: 150px;
    max-height: 388px;
    overflow: auto;
}
.header {
    height: 40px;
    border-bottom: 1px solid #EEE;
    background-color: #0153a0;
    height: 30px;
    -webkit-border-top-left-radius: 15px;
    -webkit-border-top-right-radius: 15px;
    -moz-border-radius-topleft: 10px;
    -moz-border-radius-topright: 10px;
    border-top-left-radius: 10px;
    border-top-right-radius: 10px;
}
.tab {
    border-bottom: 1px solid #EEE;
    background-color: #0153a0;
    -webkit-border-top-left-radius: 15px;
    -webkit-border-top-right-radius: 15px;
    -moz-border-radius-topleft: 10px;
    -moz-border-radius-topright: 10px;
    border-top-left-radius: 10px;
    border-top-right-radius: 10px;
	-webkit-border-bottom-left-radius: 5px;
    -webkit-border-bottom-right-radius: 5px;
    -moz-border-radius-bottomleft: 5px;
    -moz-border-radius-bottomright: 5px;
    border-bottom-left-radius: 5px;
    border-bottom-right-radius: 5px;
	text-align: center;
    padding-top: 1%;
	padding-bottom: 1%;
}
.footer {
    height: 40px;
    background-color: whiteSmoke;
    border-top: 1px solid #DDD;
    -webkit-border-bottom-left-radius: 5px;
    -webkit-border-bottom-right-radius: 5px;
    -moz-border-radius-bottomleft: 5px;
    -moz-border-radius-bottomright: 5px;
    border-bottom-left-radius: 5px;
    border-bottom-right-radius: 5px;
}

</style>
';

	

	dol_fiche_end();




llxFooter();

$db->close();


?>
