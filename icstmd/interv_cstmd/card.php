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
$res = @include ("../../main.inc.php"); // For root directory
if (! $res)
	$res = @include ("../../../main.inc.php"); // For "custom" directory
if (! $res)
	die("Include of main fails");

require_once '../class/interv_questions.class.php';
require_once '../class/chapitre.class.php';
require_once DOL_DOCUMENT_ROOT.'/core/class/extrafields.class.php';
require_once DOL_DOCUMENT_ROOT.'/core/class/html.formfile.class.php';

// Load traductions files requiredby by page
$langs->load("interventions");
$langs->load("icstmd");

$form = new Form($db);
$formfile = new FormFile($db);
// Get parameters
$id         = GETPOST('id','int');
$num         = GETPOST('num');
$id_interv         = GETPOST('id_interv','int');
$action     = GETPOST('action','alpha');

// Load object if id or ref is provided as parameter
$object = new IntervQuestions($db);
$chap = new Chapitre($db);

if (($id > 0 ) && $action != 'add')
{
    $result=$object->fetch($id);
	$chap->fetch($id_cha);
    if ($result < 0) dol_print_error($db);
}

/*******************************************************************
* ACTIONS
*
* Put here all code to do according to value of "action" parameter
********************************************************************/

    // Action to add record
     if ($action == 'add')
    {
		if (! $_POST["cancel"]) {
			$error = 0;
			$test = true;
			$array = array();
			$arr = array();
			if(!empty(GETPOST("choisse"))){
				$sqls = "SELECT * ";
				$sqls.= " FROM ".MAIN_DB_PREFIX."cstmd_chapitres ";
				$sqls.= " where fk_referentiel_id = " . GETPOST("choisse");
				$resqls=$db->query($sqls);
				if ($resqls) {
					for($cmp=0;$cmp<$db->num_rows($resqls);$cmp++){
						$obj = $db->fetch_object($resqls);
						$array[$obj->rowid] = $obj->rowid;
					}
					$db->free($resqls);
				}
				else{
					$error++;
					dol_print_error($db);
				}
				if(!empty($array)){	
					foreach($array as $k => $v){
						$sql = "SELECT * ";
						$sql.= " FROM ".MAIN_DB_PREFIX."cstmd_questions";
						$sql.= " where fk_chapitre_id = " . $v;
						dol_syslog(__METHOD__ . " sql=" . $sql, LOG_DEBUG);
						$resql = $db->query($sql);
						if ($resql) {
							for($cmp=0;$cmp<$db->num_rows($resql);$cmp++){
								$obj = $db->fetch_object($resql);
								$arr[]= array( 'rowid' => $obj->rowid , 'position' => $obj->position , 'label_question' => $obj->label_question , 'texte_reglementaire' => $obj->texte_reglementaire , 'fk_chapitre_id' => $obj->fk_chapitre_id );
							}
							$db->free($resql);

						} else {
							$error = "Error " . $db->lasterror();
							dol_syslog(__METHOD__ . " " . $error, LOG_ERR);

							return -1;
						}
					}
					if(!empty($arr)){	
						foreach($arr as $key => $va){
							if (! $error)
							{
								$object->fk_intervention = GETPOST("id_interv");
								$object->position = $va["position"];
								$object->label_question = $va["label_question"];
								$object->texte_reglementaire = $va["texte_reglementaire"];
								$object->fk_chapitre_id = $va["fk_chapitre_id"];
								$result = $object->create($user);
								if ($result > 0)
								{
									// Creation OK
									$test = true;
								}
								else{
									// Creation KO
									$test = false;
									if (! empty($object->errors)) setEventMessages(null, $object->errors, 'errors');
									else  setEventMessages($object->error, null, 'errors');
									$action='create';
								}
								
							}
							else
							{
								$action='create';
							}
						}
						if($test === true){
							setEventMessage($langs->trans("AddedSuccessfully"), 'mesgs');
							header("Location: index.php?id=".GETPOST("id_interv"));
							exit();
						}
					}else{
						setEventMessage($langs->trans('ReferentielNotChapitre'), 'errors');
						header("Location: card.php?action=create&id_interv=".GETPOST("id_interv"));
						exit();
						$error ++;
					}
				}else{
					setEventMessage($langs->trans('ReferentielNotChapitre'), 'errors');
					header("Location: card.php?action=create&id_interv=".GETPOST("id_interv"));
					exit();
					$error ++;
				}
			}else{
				setEventMessage($langs->trans('FieldIsReferentiel'), 'errors');
				header("Location: card.php?action=create&id_interv=".GETPOST("id_interv"));
				exit();
				$error ++;
			}
		}else {
			header("Location: index.php?id=".GETPOST("id_interv"));
			exit();
		}	
    }

    // Action to update record
    if ($action == 'update')
    {
		if (! $_POST["cancel"]) {
		
		$dater = dol_mktime(0,0,0, GETPOST("remonth"), GETPOST("reday"), GETPOST("reyear"));
		
		
			$error=0;
			$object->id = GETPOST("id");
			$object->position = GETPOST("position");
			$object->label_question = GETPOST("label_question");
			$object->etat_lieux = GETPOST("etat_lieux");
			$object->titre_recommandation = GETPOST("titre_recommandation");
			$object->recommandation = GETPOST("recommandation");
			$object->dater = $dater;
			$object->reference = GETPOST("reference");
			$object->texte_reglementaire = GETPOST("texte_reglementaire");
			$object->fk_chapitre_id = GETPOST("fk_chapitre");
			$chek_cf = (GETPOST("cf")?1 : 0);
			$chek_nc = (GETPOST("nc")?1 : 0);
			$chek_pa = (GETPOST("pa")?1 : 0);
			$chek_ev = (GETPOST("ev")?1 : 0);
			$object->cf = $chek_cf;
			$object->nc = $chek_nc;
			$object->pa = $chek_pa;
			$object->ev = $chek_ev;
			if (empty(GETPOST("position"))) {
				setEventMessage($langs->trans('FieldIsPosition'), 'errors');
				$error ++;
			}
			if (strpos(GETPOST("position"), $num) === false){
				setEventMessage($langs->trans('NumCom').' '.$num, 'errors');
				$error ++;
			}
			if (empty(GETPOST("label_question"))) {
				setEventMessage($langs->trans('FieldIsQuestion'), 'errors');
				$error ++;
			}
			if (! $error)
			{
				$result=$object->update( $user );
				// var_dump($result);die();
				if ($result > 0)
				{
					setEventMessage($langs->trans("UpdatedSuccessfully"), 'mesgs');
					header("Location: index.php?id=".GETPOST("id_interv"));
					exit;
				}
				else
				{
					// Creation KO
					if (! empty($object->errors)) setEventMessages(null, $object->errors, 'errors');
					else setEventMessages($object->error, null, 'errors');
					$action='edit';
				}
			}
			else
			{
				$action='edit';
			}
		} else {
			header("Location: index.php?id=".GETPOST("id_interv"));
			exit();
		}
    }




/***************************************************
* VIEW
*
* Put here all code to build page
****************************************************/

llxHeader('',$langs->trans("Intervention"),'');

// Part to create
if ($action == 'create')
{
    print load_fiche_titre($langs->trans("NewIntervention"));

    print '<form method="POST" action="'.$_SERVER["PHP_SELF"].'">';
    print '<input type="hidden" name="action" value="add">';
    print '<input type="hidden" name="backtopage" value="'.$backtopage.'">';
    print '<input type="hidden" name="id_interv" value="'.$id_interv.'">';

    dol_fiche_head();
	$sqls = "SELECT * ";
		$sqls.= " FROM ".MAIN_DB_PREFIX."cstmd_referentiels ";
		$resqls=$db->query($sqls);
		print '<table style="text-align:center;margin:auto;">
				<tr>
					<td class="fieldrequired"><H3>Choissez un Referentiel : </H3></td>';
			print "<td><select name='choisse'><option value = '0'>select</option>";
				if ($resqls) {
					for($cmp=0;$cmp<$db->num_rows($resqls);$cmp++){
						$obj = $db->fetch_object($resqls);
						print "<option value = ".$obj->rowid.">".$obj->label."</option>";
					}
					$db->free($resqls);
				}
				else{
					$error++;
					dol_print_error($db);
				}
			print "			</select>
					</td>";
			print	'
				</tr>
		</table>';

    dol_fiche_end();

    print '<div class="center"><input type="submit" class="button btn_click" name="add" value="'.$langs->trans("Add").'"><input disabled type="submit" class="button btn_click_2" name="add" value="'.$langs->trans("Add").'"></div>';

    print '</form>';
}



// Part to edit record
if (($id) && $action == 'edit')
{
    print load_fiche_titre($langs->trans("EditIntervention"));
    print '<form method="POST" action="'.$_SERVER["PHP_SELF"].'">';
    print '<input type="hidden" name="action" value="update">';
    print '<input type="hidden" name="backtopage" value="'.$backtopage.'">';
    print '<input type="hidden" name="id" value="'.$object->id.'">';
	print '<input type="hidden" name="id_interv" value="'.$id_interv.'">';
	print '<input type="hidden" name="num" value="'.$num.'">';
	print '<input type="hidden" name="fk_chapitre" value="'.GETPOST("id_cha").'">';
    
    dol_fiche_head();
	print dol_set_focus('#position');
	
	
    print '<table class="border centpercent">'."\n";
	//Numero
    print '<tr><td class="fieldrequired">'.$langs->trans("Numero").'</td><td><input class="flat" type="text" id="position" size="36" name="position" value="'.$object->position.'" ></td></tr>';
   //Question
	print '<tr><td >'.$langs->trans("Question").'</td><td><textarea name="label_question" rows="3" cols="0" class="flat" style="width:360px;" >'.$object->label_question.'</textarea></tr>';
	//Etat des lieux
	print '<tr><td>'.$langs->trans("Etat des lieux").'</td><td><textarea name="etat_lieux" rows="3" cols="0" class="flat" style="width:360px;" >'.$object->etat_lieux.'</textarea></td></tr>';
	//Titre recommandation
	print '<tr><td>'.$langs->trans("Titre recommandation").'</td><td><textarea name="titre_recommandation" rows="3" cols="0" class="flat" style="width:360px;" >'.$object->titre_recommandation.'</textarea></td></tr>';
	//Recommandation
	print '<tr><td>'.$langs->trans("Recommandation").'</td><td><textarea name="recommandation" rows="3" cols="0" class="flat" style="width:360px;" >'.$object->recommandation.'</textarea></td></tr>';
	//Date Recommandation
	print '<tr><td>'.$langs->trans("Date Recommandation").'</td>';
	print '<td align="left">';
	print $form->select_date($object->dater, 're', 0, 0, 0, 'card', 1);
	print '</td></tr>';
	//Référence
	print '<tr><td>'.$langs->trans("Référence").'</td><td><textarea name="reference" rows="3" cols="0" class="flat" style="width:360px;" >'.$object->reference.'</textarea></td></tr>';
	//Texte réglementaire
	print '<tr><td>'.$langs->trans("Texte réglementaire").'</td><td><textarea name="texte_reglementaire" rows="3" cols="0" class="flat" style="width:360px;" >'. $object->texte_reglementaire .'</textarea></td></tr>';
	
	print 
		'<tr>
			<td class="fieldrequired">
				<label for="cf">'.$langs->trans("CF").'</label>
			</td>
			<td>';
				if ($object->cf != 0)
				{
					print '<input type="checkbox" name="cf" id="cf" checked></td>';
				}
				else
				{
					print '<input type="checkbox" name="cf" id="cf"></td>';
				}
	print '	</td>
		</tr>'
	;
	
	print 
		'<tr>
			<td class="fieldrequired">
				<label for="nc">'.$langs->trans("NC").'</label>
			</td>
			<td>';
				if ($object->nc != 0)
				{
					print '<input type="checkbox" name="nc" id="nc" checked></td>';
				}
				else
				{
					print '<input type="checkbox" name="nc" id="nc"></td>';
				}
	print '	</td>
		</tr>'
	;
	
	print 
		'<tr>
			<td class="fieldrequired">
				<label for="pa">'.$langs->trans("PA").'</label>
			</td>
			<td>';
				if ($object->pa != 0)
				{
					print '<input type="checkbox" name="pa" id="pa" checked></td>';
				}
				else
				{
					print '<input type="checkbox" name="pa" id="pa"></td>';
				}
	print '	</td>
		</tr>'
	;
	
	print 
		'<tr>
			<td class="fieldrequired">
				<label for="ev">'.$langs->trans("EV").'</label>
			</td>
			<td>';
				if ($object->ev != 0)
				{
					print '<input type="checkbox" name="ev" id="ev" checked></td>';
				}
				else
				{
					print '<input type="checkbox" name="ev" id="ev"></td>';
				}
	print '	</td>
		</tr>'
	;
    print '</table>';
    
    dol_fiche_end();

    print '<div class="center"><input type="submit" class="button btn_click" name="save" value="'.$langs->trans("Save").'">
	<input type="submit" disabled class="button btn_click_2" name="save" value="'.$langs->trans("Save").'">&nbsp; <input type="submit" class="button" name="cancel" value="'.$langs->trans("Cancel").'"></div>';

    print '</form>';
}

print '<script type="text/javascript" language="javascript">
		jQuery(document).ready(function() {
			$(".btn_click_2").hide();
			$("body").on("click", "input.btn_click", function(e) {
				$(this).hide();
				$(".btn_click_2").show();
			});
		});
	</script>';
// End of page
llxFooter();
$db->close();
