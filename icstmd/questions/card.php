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

require_once '../class/chapitre.class.php';
require_once '../class/questions.class.php';
require_once DOL_DOCUMENT_ROOT.'/core/class/extrafields.class.php';
require_once DOL_DOCUMENT_ROOT.'/core/class/html.formfile.class.php';

// Load traductions files requiredby by page
$langs->load("interventions");
$langs->load("icstmd");

$form = new Form($db);
$formfile = new FormFile($db);
// Get parameters
$id         = GETPOST('id','int');
$id_cha         = GETPOST('id_cha','int');
$num         = GETPOST('num','int');
$action		= (GETPOST('action') ? GETPOST('action') : 'view');


// Load object if id or ref is provided as parameter
$object = new Questions($db);
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
			$object->position = GETPOST("position");
			$object->label_question = GETPOST("label_question");
			$object->etat_lieux = GETPOST("etat_lieux");
			$object->titre_recommandation = GETPOST("titre_recommandation");
			$object->recommandation = GETPOST("recommandation");
			$object->reference = GETPOST("reference");
			$object->texte_reglementaire = GETPOST("texte_reglementaire");
			$object->fk_chapitre_id = GETPOST("id_cha");
			if (empty(GETPOST("position"))) {
				setEventMessage($langs->trans('FieldIsPosition'), 'errors');
				$error ++;
			}
			if(!empty($num)){
				if (strpos(GETPOST("position"), $num.'.') === false){
					setEventMessage($langs->trans('NumCom').' '.$num.'.', 'errors');
					$error ++;
				}
			}
			if (empty(GETPOST("label_question"))) {
				setEventMessage($langs->trans('FieldIsQuestion'), 'errors');
				$error ++;
			}
			if (! $error)
			{
				$result = $object->create($user);
				if ($result > 0)
				{
					// Creation OK
					setEventMessage($langs->trans("AddedSuccessfully"), 'mesgs');
					header("Location: detail.php?id_cha=".GETPOST("id_cha"));
					exit;
				}
				else{
					// Creation KO
					if (! empty($object->errors)) setEventMessages(null, $object->errors, 'errors');
					else  setEventMessages($object->error, null, 'errors');
					$action='create';
				}
				
			}
			else
			{
				$action='create';
			}
		} else {
			header("Location: detail.php?id_cha=".GETPOST("id_cha"));
			exit();
		}
    }

    // Action to update record
    if ($action == 'update')
    {
		if (! $_POST["cancel"]) {
			$error=0;
			$object->id = GETPOST("id");
			$object->position = GETPOST("position");
			$object->label_question = GETPOST("label_question");
			$object->etat_lieux = GETPOST("etat_lieux");
			$object->titre_recommandation = GETPOST("titre_recommandation");
			$object->recommandation = GETPOST("recommandation");
			$object->reference = GETPOST("reference");
			$object->texte_reglementaire = GETPOST("texte_reglementaire");
			$object->fk_chapitre_id = GETPOST("id_cha");
			if (empty(GETPOST("position"))) {
				setEventMessage($langs->trans('FieldIsPosition'), 'errors');
				$error ++;
			}
			if(!empty($num)){
				if (strpos(GETPOST("position"), $num.'.') === false){
					setEventMessage($langs->trans('NumCom').' '.$num.'.', 'errors');
					$error ++;
				}
			}
			if (empty(GETPOST("label_question"))) {
				setEventMessage($langs->trans('FieldIsQuestion'), 'errors');
				$error ++;
			}
		   
			if (! $error)
			{
				$result=$object->update( $user );
				if ($result > 0)
				{
					setEventMessage($langs->trans("UpdatedSuccessfully"), 'mesgs');
					header("Location: detail.php?id_cha=".GETPOST("id_cha"));
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
			header("Location: detail.php?id_cha=".GETPOST("id_cha"));
			exit();
		}
    }
$titrecreer = '';
$titreedit = '';
$sql = "SELECT * ";
$sql.= " FROM ".MAIN_DB_PREFIX."cstmd_chapitres ";
$sql.= " where rowid = ".$id_cha;
$resql=$db->query($sql);

if ($resql) {
	for($cmp=0;$cmp<$db->num_rows($resql);$cmp++){
		$obj = $db->fetch_object($resql);
		$titrecreer = $langs->trans($obj->position.'.'.$obj->chapitre);
		$titreedit = $langs->trans($obj->position.'.'.$obj->chapitre);
	}
	$db->free($resql);
}
else{
	$titrecreer = $langs->trans("NewQuestions");
	$titreedit = $langs->trans("EditQuestions");
}

/***************************************************
* VIEW
*
* Put here all code to build page
****************************************************/

llxHeader('',$langs->trans("Questions"),'');
$morejs=array("/dolibooks/js/select2.js");
// Part to create
if ($action == 'create')
{
	
	print load_fiche_titre($titrecreer);
    print '<form method="POST" action="'.$_SERVER["PHP_SELF"].'">';
    print '<input type="hidden" name="action" value="add">';
    print '<input type="hidden" name="backtopage" value="'.$backtopage.'">';
	print '<input type="hidden" name="num" value="'.$num.'">';
	print '<input type="hidden" name="id_cha" value="'.$id_cha.'">';

    dol_fiche_head();

	print dol_set_focus('#position');
	
    print '<table class="border centpercent">'."\n";
	//Numero
    print '<tr><td class="fieldrequired">'.$langs->trans("Numero").'</td><td><input class="flat" type="text" id="position" size="36" name="position" value="'.GETPOST('position').'" ></td></tr>';
	//Question
	print '<tr><td >'.$langs->trans("Question").'</td><td><textarea name="label_question" rows="3" cols="0" class="flat" style="width:360px;" >'.nl2br(GETPOST('label_question', 'alpha')).'</textarea></td></tr>';
	//Etat des lieux
	print '<tr><td>'.$langs->trans("Etat des lieux").'</td><td><textarea name="etat_lieux" rows="3" cols="0" class="flat" style="width:360px;" >'.nl2br(GETPOST('etat_lieux', 'alpha')).'</textarea></td></tr>';
	//Titre recommandation
	print '<tr><td>'.$langs->trans("Titre recommandation").'</td><td><textarea name="titre_recommandation" rows="3" cols="0" class="flat" style="width:360px;" >'.nl2br(GETPOST('titre_recommandation', 'alpha')).'</textarea></td></tr>';
	//Recommandation
	print '<tr><td>'.$langs->trans("Recommandation").'</td><td><textarea name="recommandation" rows="3" cols="0" class="flat" style="width:360px;" >'.nl2br(GETPOST('recommandation', 'alpha')).'</textarea></td></tr>';
	//Référence
	print '<tr><td>'.$langs->trans("Référence").'</td><td><textarea name="reference" rows="3" cols="0" class="flat" style="width:360px;" >'.nl2br(GETPOST('reference', 'alpha')).'</textarea></td></tr>';
	//Texte réglementaire
	print '<tr><td>'.$langs->trans("Texte réglementaire").'</td><td><textarea name="texte_reglementaire" rows="3" cols="0" class="flat" style="width:360px;" >'.nl2br(GETPOST('texte_reglementaire', 'alpha')).'</textarea></td></tr>';
	//Chapitre du Référentiel
	print '<tr>';
	if(empty($id_cha)){
		
		print '<td>'.$langs->trans("Chapitre du Référentiel").'</td><td><input id="fk_chapitre_id" name="id_cha" class="form-control col-lg-5 itemSearch" style="width: 30%;" type="text" value="'.$id_cha.'" /><input type="hidden" id="idbook"  value="'.$id_cha.'"><input type="hidden" id="textlabel"  value="'.$chap->chapitre.'"></td>';
	}else{
		print '<input type="hidden" name="id_cha"  value="'.$id_cha.'">';
	}
	print '</tr>';
  
    print '</table>'."\n";

    dol_fiche_end();

    print '<div class="center"><input type="submit" class="button btn_click" name="add" value="'.$langs->trans("Create").'"><input disabled type="submit" class="button btn_click_2" name="add" value="'.$langs->trans("Create").'"> &nbsp; <input type="submit" class="button" name="cancel" value="'.$langs->trans("Cancel").'"></div>';

    print '</form>';
}



// Part to edit record
if (($id) && $action == 'edit')
{
    print load_fiche_titre($titreedit);
    
    print '<form method="POST" action="'.$_SERVER["PHP_SELF"].'">';
    print '<input type="hidden" name="action" value="update">';
    print '<input type="hidden" name="backtopage" value="'.$backtopage.'">';
    print '<input type="hidden" name="id" value="'.$object->id.'">';
	print '<input type="hidden" name="num" value="'.$num.'">';
	print '<input type="hidden" name="id_cha" value="'.$id_cha.'">';
    
    dol_fiche_head();
	
	print dol_set_focus('#position');
	
    print '<table class="border centpercent">'."\n";
	//Numero
    print '<tr><td class="fieldrequired">'.$langs->trans("Numero").'</td><td><input class="flat" type="text" id="position" size="36" name="position" value="'.$object->position.'" ></td></tr>';
	//Question
	print '<tr><td >'.$langs->trans("Question").'</td><td><textarea name="label_question" rows="3" cols="0" class="flat" style="width:360px;" >'.nl2br($object->label_question).'</textarea></tr>';
	//Etat des lieux
	print '<tr><td>'.$langs->trans("Etat des lieux").'</td><td><textarea name="etat_lieux" rows="3" cols="0" class="flat" style="width:360px;" >'.nl2br($object->etat_lieux).'</textarea></td></tr>';
	//Titre recommandation
	print '<tr><td>'.$langs->trans("Titre recommandation").'</td><td><textarea name="titre_recommandation" rows="3" cols="0" class="flat" style="width:360px;" >'.nl2br($object->titre_recommandation).'</textarea></td></tr>';
	//Recommandation
	print '<tr><td>'.$langs->trans("Recommandation").'</td><td><textarea name="recommandation" rows="3" cols="0" class="flat" style="width:360px;" >'.nl2br($object->recommandation).'</textarea></td></tr>';
	//Référence
	print '<tr><td>'.$langs->trans("Référence").'</td><td><textarea name="reference" rows="3" cols="0" class="flat" style="width:360px;" >'.nl2br($object->reference).'</textarea></td></tr>';
	//Texte réglementaire
	print '<tr><td>'.$langs->trans("Texte réglementaire").'</td><td><textarea name="texte_reglementaire" rows="3" cols="0" class="flat" style="width:360px;" >'.nl2br($object->texte_reglementaire).'</textarea></td></tr>';
	//Chapitre du Référentiel
	print '<tr>';
	if(empty($id_cha)){
		
		print '<td>'.$langs->trans("Chapitre du Référentiel").'</td><td><input id="fk_chapitre_id" name="id_cha" class="form-control col-lg-5 itemSearch" style="width: 30%;" type="text" value="'.$id_cha.'" /><input type="hidden" id="idbook"  value="'.$id_cha.'"><input type="hidden" id="textlabel"  value="'.$chap->chapitre.'"></td>';
	}else{
		print '<input type="hidden" name="id_cha"  value="'.$id_cha.'">';
	}
	print '</tr>';
    print '</table>';
    
    dol_fiche_end();

    print '<div class="center"><input type="submit" class="button btn_click" name="save" value="'.$langs->trans("Save").'">
	<input type="submit" disabled class="button btn_click_2" name="save" value="'.$langs->trans("Save").'">&nbsp; <input type="submit" class="button" name="cancel" value="'.$langs->trans("Cancel").'"></div>';

    print '</form>';
}

print '<script type="text/javascript" language="javascript">
			$(".itemSearch").select2({
				placeholder: "'.$langs->trans("Search for an Chapitre").'",
				minimumInputLength: 1,
				ajax: {
					url: "getajax.php",
					dataType: \'json\',
					quietMillis: 100,
					data: function (term, page) {
						return {
							option: term,
							page_limit: 10 
						};
					},
					results: function (data, page) {
						var more = (page * 10) < data.total;
						return {
							results: data,
							more: more
						};
					}
				},
				formatResult: function (data, term) {
					return data.text;
				},
				formatSelection: function (data) {
					return data.text;
				},
				dropdownCssClass: "bigdrop",
				escapeMarkup: function (m) {
					return m;
				},
				initSelection : function (element, callback) {
					callback({id:$(idbook).val(),text:$(textlabel).val()});
				}
			});
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
