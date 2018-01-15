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





/************************/
$action = GETPOST('action', 'alpha');
$dataFormations = array();
if($action == "saveTypeform"){
	$sql = "SELECT rowid, ref";
	$sql.= " FROM " . MAIN_DB_PREFIX . "agefodd_formation_catalogue";	
	$sql.= " WHERE ref not in (";
	$sql.= "SELECT label";
	$sql.= " FROM " . MAIN_DB_PREFIX . "c_cstmd_formations)";

	dol_syslog($script_file . " sql=" . $sql, LOG_DEBUG);
	$resql=$db->query($sql);
	
	if ($resql) {
		$num = $db->num_rows($resql);
		$i = 0;
		
		if ($num) {
			while ($i < $num) {
				$obj = $db->fetch_object($resql);
				if ($obj) {
					$dataFormations[$obj->rowid] =  $obj->ref;					
				}
				$i++;
			}
		}
	} else {
		$error++;
		dol_print_error($db);
	}
	
	if(!empty($dataFormations)){
		foreach($dataFormations as $k => $v){
			$sql = 'INSERT INTO ' . MAIN_DB_PREFIX . 'c_cstmd_formations (';
			$sql .= ' label,';
			$sql .= ' code,';
			$sql .= ' active';
			$sql .= ') VALUES (';
			$sql .= ' "' . $v . '",';
			$sql .= ' "' . $v . '",';
			$sql .= ' 1';
			$sql .= ')';
			//echo $sql;
			$db->begin();

			$resql = $db->query($sql);
			$db->commit();
		}
		
		
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
		<form method="post" action="imp_typ_form.php">
			<input type="hidden" name="action" value="saveTypeform">
			<table class="noborder nohover centpercent">
			   <tbody>
				  <tr class="liste_titre">
					 <td >Rechercher et enregistrement des types de formations</td>
				  </tr>
				  <tr class="impair">
					<td><input type="submit" value="Lancer la recherche et import" class="button"></td>
				  </tr> 
				  
					<?php if(!empty($dataFormations)):
							foreach($dataFormations as $k => $v):?>
							<tr class="pair"><td><?php print $v;?></td></tr>
						<?php endforeach;?>
					<?php elseif($action == "saveTypeform"):?>
					<tr class="pair"><td>Toutes les formations sont enregistrées</td></tr>
					<?php endif;?>
				  
				  
			   </tbody>
			</table>
		</form>
	
	
		
	</div>


</div>
    
    </div><!-- /page -->
<?php llxFooter();?>