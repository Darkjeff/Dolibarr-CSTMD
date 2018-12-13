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

//var_dump($objSociete);die();

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


	
	$head = fichinter_prepare_head($object);

	dol_fiche_head($head, 'icstmdficheinter', $langs->trans("InterventionCard"), -1, 'intervention');
	
	// Intervention card
	$linkback = '<a href="'.DOL_URL_ROOT.'/fichinter/list.php'.(! empty($socid)?'?socid='.$socid:'').'">'.$langs->trans("BackToList").'</a>';


	$morehtmlref='<div class="refidno">';
	
    
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


	
print '<form action="pdf_ticket.php" method="POST" target="_blank"><div class="container">
	<input type="hidden" name="interv_id" value="'.$id.'">
    
    <div class="header">
		<span style="font-size:22px;color:#fff;margin-left:35px;">DECLARATION D\'EXPEDITION DE MARCHANDISES DANGEREUSES 1</span>
	</div>
    <div class="mainbody">
     <table style="width: 100%;">
			<tr>
            	<td style="font-size:17px;" >1 Expediteur : </td>
				<td colspan="2"><input name="decla_1" style="width: 80%;" type="text" value="'.$objSociete->nom.'"/></td>
            </tr>
            <tr>
                <td style="font-size:17px;" >2 Numero de document de transport : </td>
				<td colspan="2"><input name="decla_2" style="width: 80%;" type="text" value="'.$objSociete->nom.'"/></td>
			</tr>
			<tr>
           	 	<td style="font-size:17px;" >3 numero : </td>
				<td colspan="2"><input name="decla_3" style="width: 40%;" type="text" value="'.$objSociete->nom.'"/></td>
            </tr>
			<tr>
            	<td style="font-size:17px;" >4 Numero de reference de l expediteur : </td>
				<td colspan="2"><input name="decla_4" style="width: 40%;" type="text" value="'.$objSociete->nom.'"/></td>
            </tr>
			<tr>
                <td style="font-size:17px;" >5 numero de reference du transitaire  : </td>
				<td colspan="2"><input name="decla_5" style="width: 40%;" type="text" value="'.$objSociete->nom.'"/></td>
			</tr>
            <tr>
                <td style="font-size:17px;" >6 Destinataire  : </td>
				<td colspan="2"><input name="decla_6" style="width: 40%;" type="text" value="'.$objSociete->nom.'"/></td>
			</tr>
            <tr>
                <td style="font-size:17px;" >7 Transporteur  : </td>
				<td colspan="2"><input name="decla_7" style="width: 40%;" type="text" value="'.$objSociete->nom.'"/></td>
			</tr>
            
                
                
				 </tbody>
			</table>
    </div>
	
</div><br>';
print '<div class="container">
    <div class="header">
		<span style="font-size:22px;color:#fff;margin-left:35px;">DECLARATION D\'EXPEDITION DE MARCHANDISES DANGEREUSES 2</span>
	</div>
    <div class="mainbody">
	   <table style="width: 100%;">
       <tr>
                <td style="font-size:17px;" >9 Informations complementaires  : </td>
				<td colspan="2"><input name="decla_9" style="width: 40%;" type="text" value="'.$objSociete->nom.'"/></td>
			</tr>
            <tr>
                <td style="font-size:17px;" >10 Navire  : </td>
				<td colspan="2"><input name="decla_10" style="width: 40%;" type="text" value="'.$objSociete->nom.'"/></td>
			</tr>
            <tr>
                <td style="font-size:17px;" >11 Port chargement  : </td>
				<td colspan="2"><input name="decla_11" style="width: 40%;" type="text" value="'.$objSociete->nom.'"/></td>
			</tr>
            <tr>
                <td style="font-size:17px;" >12 Port dechargement  : </td>
				<td colspan="2"><input name="decla_12" style="width: 40%;" type="text" value="'.$objSociete->nom.'"/></td>
			</tr>
            <tr>
                <td style="font-size:17px;" >13 Destination  : </td>
				<td colspan="2"><input name="decla_13" style="width: 40%;" type="text" value="'.$objSociete->nom.'"/></td>
			</tr>
            <tr>
                <td style="font-size:17px;" >14 Marques d expeditions  : </td>
				<td colspan="2"><input name="decla_14" style="width: 40%;" type="text" value="'.$objSociete->nom.'"/></td>
			</tr>
            
            
       
			
			
			
		</table>
    </div>
</div><br>
<div class="tab">
	<span style="font-size:21px;color:#fff;">Liste des établissements et conseillers à déclarer (transmettre une copie des certificats)</span>
</div><br>
<div class="container">
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
				<td><input name="nic_2" style="width: 80%;" type="text"/></td>
				<td style="font-size:17px;" colspan="2" >Nom commercial : </td>
				<td colspan="2"><input name="nom_commercial_2" type="text"/></td>
			</tr>
			<tr>
				<td colspan="3" style="font-size:17px;">Adresse juridique <span style="font-size:13px;"><i>(N°, type et nom de la voie )</i></span> : </td>
				<td colspan="5"><input name="adresse_2" style="width: 96%;" type="text"/></td>
			</tr>
			<tr>
				<td colspan="8"><input name="adresse_suite_2" style="width: 98%;" type="text"/></td>
			</tr>
			<tr>
				<td colspan="2" style="font-size:17px;">Code Postal :  </td>
				<td  style="text-align: center;"><input colspan="2" name="code_postal_2" type="text"/></td>
				<td colspan="2" style="font-size:17px;" >Commune : </td>
				<td colspan="2"><input name="commune_2" style="width: 95%;" type="text"/></td>
			</tr>
			<tr>
				<td colspan="2" style="font-size:17px;">Téléphone :  </td>
				<td colspan="2"><input name="tele_1_2" style="width: 76%;" type="text"/></td>
				<td colspan="2" style="font-size:17px;" >Téléphone : </td>
				<td colspan="2"><input name="tele_2_2" style="width: 93%;" type="text"/></td>
			</tr>
			<tr>
				<td style="font-size:17px;"><span style="margin-left: -5%;    padding-left: 10%;background-color:#7b92c6;padding-right: 22%;padding-top: 1%;padding-bottom: 1%;"><b>Conseiller :</b></span>  </td>
				<td style="font-size:17px;">Nom :</td>
				<td colspan="2"><input name="nom_2" style="width: 85%;" type="text"/></td>
				<td colspan="2" style="font-size:17px;">Prenom :</td>
				<td ><input name="prenom_2" style="width: 90%;" type="text"/></td>
			</tr>
			<tr>
				<td style="font-size:17px;">Numéro du certicat :</td>
				<td style="text-align: center;" ><input name="numero_certicat_2" type="text"/></td>
				<td colspan="3" style="font-size:17px;">Pays ayant délivré le certicat :</td>
				<td colspan="3"><input style="width: 93%;" name="pays_certicat_2" type="text"/></td>
			</tr>
			<tr>
				<td colspan="3" style="font-size:17px;">Compétence thématique (classes, domaines d\'activité...) :</td>
				<td colspan="5"><input name="competence_thematique_2" style="width: 96%;" type="text"/></td>
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
				<td><input name="nic_3" style="width: 80%;" type="text"/></td>
				<td style="font-size:17px;" colspan="2" >Nom commercial : </td>
				<td colspan="2"><input name="nom_commercial_3" type="text"/></td>
			</tr>
			<tr>
				<td colspan="3" style="font-size:17px;">Adresse juridique <span style="font-size:13px;"><i>(N°, type et nom de la voie )</i></span> : </td>
				<td colspan="5"><input name="adresse_3" style="width: 96%;" type="text"/></td>
			</tr>
			<tr>
				<td colspan="8"><input name="adresse_suite_3" style="width: 98%;" type="text"/></td>
			</tr>
			<tr>
				<td colspan="2" style="font-size:17px;">Code Postal :  </td>
				<td  style="text-align: center;"><input colspan="2" name="code_postal_3" type="text"/></td>
				<td colspan="2" style="font-size:17px;" >Commune : </td>
				<td colspan="2"><input name="commune_3" style="width: 95%;" type="text"/></td>
			</tr>
			<tr>
				<td colspan="2" style="font-size:17px;">Téléphone :  </td>
				<td colspan="2"><input name="tele_1_3" style="width: 76%;" type="text"/></td>
				<td colspan="2" style="font-size:17px;" >Téléphone : </td>
				<td colspan="2"><input name="tele_2_3" style="width: 93%;" type="text"/></td>
			</tr>
			<tr>
				<td style="font-size:17px;"><span style="margin-left: -5%;    padding-left: 10%;background-color:#7b92c6;padding-right: 22%;padding-top: 1%;padding-bottom: 1%;"><b>Conseiller :</b></span>  </td>
				<td style="font-size:17px;">Nom :</td>
				<td colspan="2"><input name="nom_3" style="width: 85%;" type="text"/></td>
				<td colspan="2" style="font-size:17px;">Prenom :</td>
				<td ><input name="prenom_3" style="width: 90%;" type="text"/></td>
			</tr>
			<tr>
				<td style="font-size:17px;">Numéro du certicat :</td>
				<td style="text-align: center;" ><input name="numero_certicat_3" type="text"/></td>
				<td colspan="3" style="font-size:17px;">Pays ayant délivré le certicat :</td>
				<td colspan="3"><input style="width: 93%;" name="pays_certicat_3" type="text"/></td>
			</tr>
			<tr>
				<td colspan="3" style="font-size:17px;">Compétence thématique (classes, domaines d\'activité...) :</td>
				<td colspan="5"><input name="competence_thematique_3" style="width: 96%;" type="text"/></td>
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
				<td><input name="nic_4" style="width: 80%;" type="text"/></td>
				<td style="font-size:17px;" colspan="2" >Nom commercial : </td>
				<td colspan="2"><input name="nom_commercial_4" type="text"/></td>
			</tr>
			<tr>
				<td colspan="3" style="font-size:17px;">Adresse juridique <span style="font-size:13px;"><i>(N°, type et nom de la voie )</i></span> : </td>
				<td colspan="5"><input name="adresse_4" style="width: 96%;" type="text"/></td>
			</tr>
			<tr>
				<td colspan="8"><input name="adresse_suite_4" style="width: 98%;" type="text"/></td>
			</tr>
			<tr>
				<td colspan="2" style="font-size:17px;">Code Postal :  </td>
				<td  style="text-align: center;"><input colspan="2" name="code_postal_4" type="text"/></td>
				<td colspan="2" style="font-size:17px;" >Commune : </td>
				<td colspan="2"><input name="commune_4" style="width: 95%;" type="text"/></td>
			</tr>
			<tr>
				<td colspan="2" style="font-size:17px;">Téléphone :  </td>
				<td colspan="2"><input name="tele_1_4" style="width: 76%;" type="text"/></td>
				<td colspan="2" style="font-size:17px;" >Téléphone : </td>
				<td colspan="2"><input name="tele_2_4" style="width: 93%;" type="text"/></td>
			</tr>
			<tr>
				<td style="font-size:17px;"><span style="margin-left: -5%;    padding-left: 10%;background-color:#7b92c6;padding-right: 22%;padding-top: 1%;padding-bottom: 1%;"><b>Conseiller :</b></span>  </td>
				<td style="font-size:17px;">Nom :</td>
				<td colspan="2"><input name="nom_4" style="width: 85%;" type="text"/></td>
				<td colspan="2" style="font-size:17px;">Prenom :</td>
				<td ><input name="prenom_4" style="width: 90%;" type="text"/></td>
			</tr>
			<tr>
				<td style="font-size:17px;">Numéro du certicat :</td>
				<td style="text-align: center;" ><input name="numero_certicat_4" type="text"/></td>
				<td colspan="3" style="font-size:17px;">Pays ayant délivré le certicat :</td>
				<td colspan="3"><input style="width: 93%;" name="pays_certicat_4" type="text"/></td>
			</tr>
			<tr>
				<td colspan="3" style="font-size:17px;">Compétence thématique (classes, domaines d\'activité...) :</td>
				<td colspan="5"><input name="competence_thematique_4" style="width: 96%;" type="text"/></td>
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
				<td><input name="nic_5" style="width: 80%;" type="text"/></td>
				<td style="font-size:17px;" colspan="2" >Nom commercial : </td>
				<td colspan="2"><input name="nom_commercial_5" type="text"/></td>
			</tr>
			<tr>
				<td colspan="3" style="font-size:17px;">Adresse juridique <span style="font-size:13px;"><i>(N°, type et nom de la voie )</i></span> : </td>
				<td colspan="5"><input name="adresse_5" style="width: 96%;" type="text"/></td>
			</tr>
			<tr>
				<td colspan="8"><input name="adresse_suite_5" style="width: 98%;" type="text"/></td>
			</tr>
			<tr>
				<td colspan="2" style="font-size:17px;">Code Postal :  </td>
				<td  style="text-align: center;"><input colspan="2" name="code_postal_5" type="text"/></td>
				<td colspan="2" style="font-size:17px;" >Commune : </td>
				<td colspan="2"><input name="commune_5" style="width: 95%;" type="text"/></td>
			</tr>
			<tr>
				<td colspan="2" style="font-size:17px;">Téléphone :  </td>
				<td colspan="2"><input name="tele_1_5" style="width: 76%;" type="text"/></td>
				<td colspan="2" style="font-size:17px;" >Téléphone : </td>
				<td colspan="2"><input name="tele_2_5" style="width: 93%;" type="text"/></td>
			</tr>
			<tr>
				<td style="font-size:17px;"><span style="margin-left: -5%;    padding-left: 10%;background-color:#7b92c6;padding-right: 22%;padding-top: 1%;padding-bottom: 1%;"><b>Conseiller :</b></span>  </td>
				<td style="font-size:17px;">Nom :</td>
				<td colspan="2"><input name="nom_5" style="width: 85%;" type="text"/></td>
				<td colspan="2" style="font-size:17px;">Prenom :</td>
				<td ><input name="prenom_5" style="width: 90%;" type="text"/></td>
			</tr>
			<tr>
				<td style="font-size:17px;">Numéro du certicat :</td>
				<td style="text-align: center;" ><input name="numero_certicat_5" type="text"/></td>
				<td colspan="3" style="font-size:17px;">Pays ayant délivré le certicat :</td>
				<td colspan="3"><input style="width: 93%;" name="pays_certicat_5" type="text"/></td>
			</tr>
			<tr>
				<td colspan="3" style="font-size:17px;">Compétence thématique (classes, domaines d\'activité...) :</td>
				<td colspan="5"><input name="competence_thematique_5" style="width: 96%;" type="text"/></td>
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
