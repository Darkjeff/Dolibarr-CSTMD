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
require_once DOL_DOCUMENT_ROOT.'/core/lib/company.lib.php';

$action = GETPOST('action');

$langs->load("companies");

// Security check
$id = GETPOST('id')?GETPOST('id','int'):GETPOST('socid','int');
if ($user->societe_id) $id=$user->societe_id;
$result = restrictedArea($user, 'societe', $id, '&societe');

$object = new Societe($db);
if ($id > 0) $object->fetch($id);

if($action == 'saveVeh'){
	$veh = GETPOST('veh');
	$nbrveh = GETPOST('nbrveh');
	
		$sql = 'INSERT INTO ' . MAIN_DB_PREFIX . 'cstmd_nbrEmpVeh (';
		$sql .= ' label,';
		$sql .= ' nombre,';
		$sql .= ' fk_soc,';
		$sql .= ' type';
		$sql .= ') VALUES (';
		$sql .= ' \'' . $veh . '\',';
		$sql .= ' ' . $nbrveh . ',';
		$sql .= ' ' . $id . ',';
		$sql .= '\'VEH\'';
		$sql .= ')';
		//echo $sql;
		$db->begin();

		$resql = $db->query($sql);
		$db->commit();
	
}

if($action == 'saveFor'){
	$for = GETPOST('for');
	$nbrfor = GETPOST('nbrfor');
	
		$sql = 'INSERT INTO ' . MAIN_DB_PREFIX . 'cstmd_nbrEmpVeh (';
		$sql .= ' label,';
		$sql .= ' nombre,';
		$sql .= ' fk_soc,';
		$sql .= ' type';
		$sql .= ') VALUES (';
		$sql .= ' \'' . $for . '\',';
		$sql .= ' ' . $nbrfor . ',';
		$sql .= ' ' . $id . ',';
		$sql .= '\'FOR\'';
		$sql .= ')';
		//echo $sql;
		$db->begin();

		$resql = $db->query($sql);
		$db->commit();
	
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
					$data[] = array("rowid" => $obj->rowid, "label" => $obj->label, "type" => $obj->type, "nombre" => $obj->nombre);					
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
						<?php
							$sql = "SELECT *";
							$sql.= " FROM " . MAIN_DB_PREFIX . "c_cstmd_formations";	
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
					<td><input type="text" size="60" name="nbrfor" value=""></td><td> <input type="submit" class="button" value="Enregistrer"></td>
				</tr>
			</tbody>
			</table>
			</form>
			<br>
		
		
		
		<?php endif; ?>
	  
         <table class="noborder" width="100%">
			<caption>le nombre d’employés ayant suivi les formations</caption>
            <tbody>
               <tr class="liste_titre">
                  <td>Formation</td>
                  <td align="right">Nombre</td>
                  <td align="right">Action</td>
               </tr>
			   <?php foreach($data as $k => $v): if($v['type'] == 'FOR'): ?>
               <tr class="impair">
                  <td><?php echo $v['label']; ?></td>
                  <td align="right"><?php echo $v['nombre']; ?></td>
				  <td align="center">Action</td>
               </tr>
			   <?php endif; endforeach;?>
            </tbody>
         </table>
		 <div class="tabsAction"><a class="butAction" href="<?php echo "?id=$id&action=addform"; ?>">? Nombre de formation</a></div>
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
		 <div class="tabsAction"><a class="butAction" href="<?php echo "?id=$id&action=addveh";?>">? Nombre de véhicules</a></div>
      </div>
   </div>
   <div style="clear:both"></div>
</div>
<?php

    dol_fiche_end();
}

llxFooter();
$db->close();