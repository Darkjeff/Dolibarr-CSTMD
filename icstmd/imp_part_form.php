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

dol_include_once('/icstmd/class/icstmd.class.php');
require_once DOL_DOCUMENT_ROOT.'/contact/class/contact.class.php';

$icstmd = new Icstmd($db);


/************************/
$action = GETPOST('action', 'alpha');
//echo $action;
$participants_importes = array();
if($action == "impPartEnContact"){
	$sql = "SELECT rowid, fk_soc, nom, prenom, civilite, fonction, mail, tel1, tel2";
	$sql.= " FROM " . MAIN_DB_PREFIX . "agefodd_stagiaire";	
	$sql.= " WHERE fk_socpeople is null";
	$sql.= " OR fk_socpeople = 0";
	//echo $sql;
	dol_syslog($script_file . " sql=" . $sql, LOG_DEBUG);
	$resql=$db->query($sql);
	
	if ($resql) {
		$num = $db->num_rows($resql);
		$i = 0;
		
		if ($num) {
			while ($i < $num) {
				$obj = $db->fetch_object($resql);
				if ($obj) {
					// je cherche si participant existe déjà comme contacts
					
					$rep = $icstmd->getContact($obj->fk_soc, $obj->nom, $obj->prenom);
					//echo $rep;
					if(empty($rep)){
						$object = new Contact($db);
						$object->socid			= $obj->fk_soc;
						$object->lastname		= $obj->nom;
						$object->firstname		= $obj->prenom;
						$object->civility_id	= $obj->civilite;
						$object->poste			= $obj->fonction;
						$object->email			= $obj->mail;
						$object->phone_pro		= $obj->tel1;
						$object->phone_perso	= $obj->tel2;
						$object->note_private	= 'Imported from Agefodd';
						$object->statut			= 1; //Defult status to Actif						
						
						$id =  $object->create($user);
						if ($id <= 0)
						{
							$error++; $errors=array_merge($errors,($object->error?array($object->error):$object->errors));
						} else {
							// Categories association
							
							//$object->setCategories(array());
							$particp_id =  $obj->rowid;
							$icstmd->updateParticipant($id, $particp_id);
						}
						
						$participants_importes[] = $obj->nom.' '.$obj->prenom;
					}
				}
				$i++;
			}
		}
	} else {
		$error++;
		dol_print_error($db);
	}
}


llxHeader('', $langs->trans('Calendar'), '');

?>


<div data-role="page" id="index">
    
	<div data-role="header">
            <h1><img src="<?php print dol_buildpath('theme/eldy/img/title_companies.png', 1);?>"> <?php print $langs->trans("Import");?></h1>
    </div><!-- /header -->

	
	<br>


	<div class="tabBar">
		<form method="post" action="imp_part_form.php">
			<input type="hidden" name="action" value="impPartEnContact">
			<table class="noborder nohover centpercent">
			   <tbody>
				  <tr class="liste_titre">
					 <td >Rechercher et enregistrement des participant comme contacts</td>
				  </tr>
				  <tr class="impair">
					<td><input type="submit" value="Lancer la recherche et import" class="button"></td>
				  </tr> 
				  
					<?php if(!empty($participants_importes)):
							foreach($participants_importes as $k => $v):?>
							<tr class="pair"><td><?php print $v;?></td></tr>
						<?php endforeach;?>
					<?php elseif($action == "impPartEnContact"):?>
					<tr class="pair"><td>Toutes les participants sont enregistrés comme contacts</td></tr>
					<?php endif;?>
				  
				  
			   </tbody>
			</table>
		</form>
	
	
		
	</div>


</div>
    
    </div><!-- /page -->
<?php llxFooter();?>