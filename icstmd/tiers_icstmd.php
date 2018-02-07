﻿<?php
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
$res = @include ("../main.inc.php"); // For root directory
if (! $res)
	$res = @include ("../../main.inc.php"); // For "custom" directory
if (! $res)
	die("Include of main fails");

require_once DOL_DOCUMENT_ROOT.'/core/lib/company.lib.php';
include_once DOL_DOCUMENT_ROOT . '/core/lib/files.lib.php';
require_once 'class/icstmd.class.php';

$icstmd = new Icstmd($db);

$action = GETPOST('action');

$langs->load("companies");

// Security check
$id = GETPOST('id','int');
if ($user->societe_id) $id=$user->societe_id;
$result = restrictedArea($user, 'societe', $id, '&societe');

$object = new Societe($db);
if ($id > 0) $object->fetch($id);

//var_dump($object);
// cherche commercial
$commercial = $icstmd->getCommercial($id);


// liste des formations du dictionnaire
$formations = $icstmd->getFormations();


if($action == 'saveVeh'){
	$date = GETPOST('dateNbrFrVeh');

	$parts = explode('/', $date);
	$year = $parts[2];
	
	$veh = GETPOST('veh');
	$nbrveh = GETPOST('nbrveh');
	
	$icstmd->saveNbrEmpVeh($id, $veh, $year, $nbrveh, 'VEH');
	
}

if($action == 'remove_file'){
	$file = GETPOST('file');
	$dir = $dolibarr_main_data_root."/icstmd/".$id;
	unlink($dir.'/'.$file);
	header("Location: ".$_SERVER["PHP_SELF"]."?id=".$id);

	
}

if($action == 'saveFor'){
	$date = GETPOST('dateNbrFrVeh');

	$parts = explode('/', $date);
	$year = $parts[2];
	
	$for = GETPOST('for');
	$nbrfor = GETPOST('nbrfor');
	
	$icstmd->saveNbrEmpVeh($id, $for, $year, $nbrfor, 'FOR');
}


if ($action == 'saveCSTMD' )
{
	$userid = GETPOST('userid');
	
	$icstmd->saveCstmd($userid, $id);
	
	header("Location: ".$_SERVER["PHP_SELF"]."?id=".$id);
}

if ($action == 'saveDREAL' )
{
	$dreal_id = GETPOST('soc_id');
	
	echo $dreal_id;
	
	$icstmd->saveDreal($dreal_id, $id);
	
	header("Location: ".$_SERVER["PHP_SELF"]."?id=".$id);
}

if ($action == 'savedatev' )
{
	$datev= dol_mktime(12,0,0,$_POST["datevmonth"],$_POST["datevday"],$_POST["datevyear"]);
		
	$icstmd->saveDatev($datev, $id);
	
	header("Location: ".$_SERVER["PHP_SELF"]."?id=".$id);
}

if($action == 'impNbrFor'){
	
	$icstmd->impNbrFor($formations, $id);
	
}

$permissionnote=$user->rights->societe->creer;	// Used by the include of actions_setnotes.inc.php


/*
 * Actions
 */

include DOL_DOCUMENT_ROOT.'/core/actions_setnotes.inc.php';	// Must be include, not includ_once


/*
 *	View
 */

$form = new Form($db);

$help_url='EN:Module_Third_Parties|FR:Module_Tiers|ES:Empresas';
llxHeader('',$langs->trans("ThirdParty").' - '.$langs->trans("Notes"),$help_url);

if ($id > 0)
{
    /*
     * Affichage onglets
     */
    if (! empty($conf->notification->enabled)) $langs->load("mails");

    $head = societe_prepare_head($object);

    dol_fiche_head($head, 'tabname1', $langs->trans("ThirdParty"),0,'company');
	
    dol_banner_tab($object, 'socid', '', ($user->societe_id?0:1), 'rowid', 'nom');
	
	$sql = "SELECT *";
	$sql.= " FROM " . MAIN_DB_PREFIX . "cstmd_nbrEmpVeh";	
	$sql.= " WHERE fk_soc = $id";

	dol_syslog($script_file . " sql=" . $sql, LOG_DEBUG);
	$resql=$db->query($sql);
	$data = array();
	if ($resql) {
		$num = $db->num_rows($resql);
		$i = 0;
		
		if ($num) {
			while ($i < $num) {
				$obj = $db->fetch_object($resql);
				if ($obj) {
					$data[] = array("rowid" => $obj->rowid, "label" => $obj->label, "type" => $obj->type, "nombre" => $obj->nombre, "year" => $obj->year);					
				}
				$i++;
			}
		}
	} else {
		$error++;
		dol_print_error($db);
	}
   // print_r($data)
 ?> 

<div class="fichecenter">
   <div class="fichehalfleft">
      <div class="ficheaddleft">
	  
		<?php if($action == 'addform'): ?>
		
		
			<form method="POST" action="<?php echo "?id=$id";?>">
			<input type="hidden" name="action" value="saveFor">
			<table class="border centpercent">
			<tbody>
				<tr>
					<td class="titlefield" >Formation</td>
					<td colspan="2">
						<select id="for" class="flat" name="for">
						<?php foreach($formations as $rowid => $label): ?>									
							<option value="<?php echo $label; ?>"><?php echo $label; ?></option>			
						<?php endforeach; ?>
						</select>
					</td>
					
				</tr>
				<tr>
					<td>Date</td>
					<td><?php echo $form->select_date('','dateNbrFrVeh');?></td>
				</tr>
				<tr>
					<td>Nombre</td>
					<td><input type="text" size="60" name="nbrfor" value=""></td><td> <input type="submit" class="button" value="Enregistrer"></td>
				</tr>
				
			</tbody>
			</table>
			</form>
			
			<form method="POST" action="<?php echo "?id=$id";?>">
			<input type="hidden" name="action" value="impNbrFor">
			<table class="border centpercent">
			<tbody>
				<tr>
					<td> <input type="submit" class="button" value="Importer"></td>
				</tr>
				
			</tbody>
			</table>
			</form>
			
			<br>
		
		
		
		<?php endif; ?>
		
		<table class="border tableforfield" width="100%">
			  <tbody>
				<tr>
					<td>CSTMD <?php //echo $commercial;?></td>
					<td>
					<?php if($action == 'editCstmd'):?>
					<form method="POST" action="<?php echo "?id=$id";?>"><?php echo $form->select_dolusers($commercial);?> <input type="hidden" name="action" value="saveCSTMD"><input type="submit" class="button" value="Enregistrer">
					<?php else: echo $object->array_options['options_cstmd'];?>
					
					<a class="pictosubstatus" href="?id=<?php echo $id.'&action=editCstmd'; ?>"><img src="<?php echo dol_buildpath('theme/eldy/img/edit.png', 1); ?>" border="0" alt=""></a>
					
					<?php endif;?>
					
					</td>
				</tr>
				
				<tr>
					<td>DREAL <?php //echo $commercial;?></td>
					<td>
					<?php if($action == 'editDreal'):?>
					<form method="POST" action="<?php echo "?id=$id";?>"><?php echo$form->select_thirdparty_list('','soc_id','s.rowid in (select fk_soc from ' . MAIN_DB_PREFIX . 'categorie_societe where fk_categorie in (select rowid from ' . MAIN_DB_PREFIX . 'categorie where label="DREAL"))');?> <input type="hidden" name="action" value="saveDREAL"><input type="submit" class="button" value="Enregistrer">
					<?php else: echo $object->array_options['options_dreal'];?>
					
					<a class="pictosubstatus" href="?id=<?php echo $id.'&action=editDreal'; ?>"><img src="<?php echo dol_buildpath('theme/eldy/img/edit.png', 1); ?>" border="0" alt=""></a>
					
					<?php endif;?>
					
					</td>
				</tr>
				
				<tr>
					<td>Date Attestation Valide<?php //echo $commercial;?></td>
					<td>
					<?php if($action == 'editDatev'):?>
					<form method="POST" action="<?php echo "?id=$id";?>"><?php echo$form->select_date('','datev');?> <input type="hidden" name="action" value="savedatev"><input type="submit" class="button" value="Enregistrer">
					<?php else: echo dol_print_date($object->array_options['options_datev'],'%d/%m/%Y');?>
					
					<a class="pictosubstatus" href="?id=<?php echo $id.'&action=editDatev'; ?>"><img src="<?php echo dol_buildpath('theme/eldy/img/edit.png', 1); ?>" border="0" alt=""></a>
					
					<?php endif;?>
					
					</td>
				</tr>
				 
			  </tbody>
		   </table>
		   
		   <div class="underbanner clearboth"></div>
			<br><hr>
		   
	  
         <table class="noborder" width="100%">
			<caption>le nombre d’employés ayant suivi les formations</caption>
            <tbody>
               <tr class="liste_titre">
                  <td>Formation</td>
                  <td align="right">Nombre</td>
                  <td align="center">Année</td>
                  <td align="right">Action</td>
               </tr>
			   <?php foreach($data as $k => $v): if($v['type'] == 'FOR'): ?>
               <tr class="impair">
                  <td><?php echo $v['label']; ?></td>
                  <td align="right"><?php echo $v['nombre']; ?></td>
                  <td align="center"><?php echo $v['year']; ?></td>
				  <td align="center"><a class="pictosubstatus" href="deleteNbrFormVeh.php?id=<?php echo $v['rowid']; ?>"><img src="<?php echo dol_buildpath('theme/eldy/img/delete.png', 1); ?>" border="0" alt=""></a></td>
               </tr>
			   <?php endif; endforeach;?>
            </tbody>
         </table>
		 <div class="tabsAction"><a class="butAction" href="<?php echo "?id=$id&action=addform"; ?>">Ajout de nombre de formation</a></div>
		
		
		   <div class="underbanner clearboth"></div>
		   <table class="border tableforfield" width="100%">
			  <tbody>
				 <tr>
					<td>Acceptation de mission
						<div class="floatright"><a class="pictosubstatus" href="acceptMiss.php?socid=<?php echo $id; ?>"><img src="<?php echo dol_buildpath('theme/eldy/img/pdf2.png', 1); ?>" border="0" alt="" title="pdf"></a></div>
					</td>
				 </tr>
				 <tr>
					<td>Attestation de conseiller à la sécurité.
						<div class="floatright"><a class="pictosubstatus" href="attestConsSec.php?socid=<?php echo $id; ?>"><img src="<?php echo dol_buildpath('theme/eldy/img/pdf2.png', 1); ?>" border="0" alt="" title="pdf"></a></div>
					</td>
				 </tr>
				 <tr>
					<td>Déclaration du conseiller à la sécurité
						<div class="floatright"><a class="pictosubstatus"  href="decConsSec.php?socid=<?php echo $id; ?>"><img src="<?php echo dol_buildpath('theme/eldy/img/pdf2.png', 1); ?>" border="0" alt="" title="pdf"></a></div>
					</td>
				 </tr>
			  </tbody>
		   </table>
		   
			<div class="underbanner clearboth"></div>
			<br><hr>
			<table class="border tableforfield" width="100%">
			  <tbody>
				 
				 <?php
				 
				 							 
				 
				 
				 
				 
					$dir = $dolibarr_main_data_root."/icstmd/".$id;
					if (file_exists($dir)) {
						$files = scandir($dir, 1);
						foreach($files as $k => $v){ if($v !="." && $v != ".."){?>
							<tr>
								<td>
								<img src="<?php echo dol_buildpath('theme/eldy/img/file.png', 1); ?>" border="0" alt="" title="pdf">
								<?php echo $v; ?>
									<div class="floatright"><a class="pictosubstatus" href="<?php echo "getpdf.php?socid=$id&code=".$v; ?>"><img src="<?php echo dol_buildpath('theme/eldy/img/detail.png', 1); ?>" border="0" alt="" title="view pdf"></a></div>
									<div class="floatright"><a class="pictosubstatus" href="<?php echo "tiers_icstmd.php?id=$id&action=remove_file&file=".$v; ?>"><img src="<?php echo dol_buildpath('theme/eldy/img/delete.png', 1); ?>" border="0" alt="" title="delete pdf"></a></div>
								</td>
							</tr>
						<?php }}
					}
				?>
				 

				 
				 
				 
				 
			  </tbody>
		   </table>
		   		
		   		
		
      </div>
   </div>
   
  <div class="fichehalfright">
      <div class="ficheaddleft">
		<?php if($action == 'addveh'): ?>
		
		
			<form method="POST" action="<?php echo "?id=$id";?>">
			<input type="hidden" name="action" value="saveVeh">
			<table class="border centpercent">
			<tbody>
				<tr>
					<td class="titlefield" >Type Véhicule</td>
					<td colspan="2">
						<select id="veh" class="flat" name="veh">
						<?php
							$sql = "SELECT *";
							$sql.= " FROM " . MAIN_DB_PREFIX . "c_cstmd_type_vehicule";	
							$sql.= " WHERE active = 1";

							dol_syslog($script_file . " sql=" . $sql, LOG_DEBUG);
							$resql=$db->query($sql);
							$data = array();
							if ($resql) {
								$num = $db->num_rows($resql);
								$i = 0;
								
								if ($num) {
									while ($i < $num) {
										$obj = $db->fetch_object($resql);
										if ($obj) {?>									
											<option value="<?php echo $obj->label; ?>"><?php echo $obj->label; ?></option>			
										<?php
										}
										$i++;
									}
								}
							} else {
								$error++;
								dol_print_error($db);
							}
						?>
						</select>
					</td>
					
				</tr>
				<tr>
					<td>Nombre</td>
					<td><input type="text" size="60" name="nbrveh" id="name_alias_input" value=""></td><td> <input type="submit" class="button" value="Enregistrer"></td>
				</tr>
			</tbody>
			</table>
			</form>
			<br>
		
		
		
		<?php endif; ?>
		
         <table class="noborder" width="100%">
			<caption>Le nombre de véhicules par type</caption>
            <tbody>
               <tr class="liste_titre">
                  <td>Type véhicule</td>
                  <td align="right">Nombre</td>
				  <td align="center">Action</td>
               </tr>
               <?php foreach($data as $k => $v): if($v['type'] == 'VEH'): ?>
               <tr class="impair">
                  <td><?php echo $v['label']; ?></td>
                  <td align="right"><?php echo $v['nombre']; ?></td>
				  <td align="center">Action</td>
               </tr>
			   <?php endif; endforeach;?>
            </tbody>
         </table>
		 <div class="tabsAction"><a class="butAction" href="<?php echo "?id=$id&action=addveh";?>">Ajout de nombre de véhicules</a></div>
      </div>
   </div>
   <div style="clear:both"></div>
</div>
<?php

    dol_fiche_end();
}

llxFooter();
$db->close();