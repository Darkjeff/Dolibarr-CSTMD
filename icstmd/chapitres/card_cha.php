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
require_once DOL_DOCUMENT_ROOT.'/core/class/extrafields.class.php';
require_once DOL_DOCUMENT_ROOT.'/core/class/html.formfile.class.php';


// Load traductions files requiredby by page
$langs->load("referentiel");
$form = new Form($db);
$id_ref	= GETPOST('id_ref');
$formfile = new FormFile($db);
// Get parameters
$id         = GETPOST('id','int');
$action     = GETPOST('action','alpha');

// Protection if external user

if (empty($action) && empty($id)) $action='list';

// Load object if id or ref is provided as parameter
$object = new Chapitre($db);
// Initialize technical object to manage hooks of modules. Note that conf->hooks_modules contains array array
$extrafields = new ExtraFields($db);

// fetch optionals attributes and labels
$extralabels=$extrafields->fetch_name_optionals_label($object->table_element);

if (($id > 0 ) && $action != 'add')
{
    $result=$object->fetch($id);
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
			$object->fk_referentiel_id = GETPOST("id_ref");
			$object->position = GETPOST("position");
			$object->chapitre = GETPOST("chapitre");
			if (empty(GETPOST("position"))) {
				setEventMessage($langs->trans('FieldIsPosition'), 'errors');
				$error ++;
			}
			if (empty(GETPOST("chapitre"))) {
				setEventMessage($langs->trans('FieldIsChapitre'), 'errors');
				$error ++;
			}
			if (! $error)
			{
				$extrafields->setOptionalsFromPost($extralabels, $object);
				$result = $object->create($user);
				if ($result > 0)
				{
					// Creation OK
					setEventMessage($langs->trans("AddedSuccessfully"), 'mesgs');
					header("Location: index_cha.php?id_ref=".GETPOST("id_ref"));
					exit();
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
			header("Location: index_cha.php?id_ref=".GETPOST("id_ref"));
			exit();
		}
    }

	if ($action == 'update')
    {
		if (! $_POST["cancel"]) {
			$error=0;
			$object->id = GETPOST("id");
			$object->fk_referentiel_id = GETPOST("id_ref");
			$object->position = GETPOST("position");
			$object->chapitre = GETPOST("chapitre");
			if (empty(GETPOST("position"))) {
				setEventMessage($langs->trans('FieldIsPosition'), 'errors');
				$error ++;
			}
			if (empty(GETPOST("chapitre"))) {
				setEventMessage($langs->trans('FieldIsChapitre'), 'errors');
				$error ++;
			}
		   
			if (! $error)
			{
				$extrafields->setOptionalsFromPost($extralabels, $object);
				$result=$object->update( $user );
				if ($result > 0)
				{
					setEventMessage($langs->trans("UpdatedSuccessfully"), 'mesgs');
					header("Location: index_cha.php?id_ref=".GETPOST("id_ref"));
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
			header("Location: index_cha.php?id_ref=".GETPOST("id_ref"));
			exit();
		}
    }
    // Action to delete
	
    if ($action == 'confirm_delete' )
    {
        $result = $object->delete($user);

        if ($result < 0)
        { 
			setEventMessage($langs->trans("DeletedSuccessfully"), 'mesgs');
			header("Location: index_cha.php?id_ref=".GETPOST("id_ref"));
			exit;
        }
        else
        {
            $langs->load("errors");
            $error=$langs->trans($object->error); $errors = $object->errors;
            $action='';
        }
    }




/***************************************************
* VIEW
*
* Put here all code to build page
****************************************************/

llxHeader('',$langs->trans("Chapitre"),'');

// Part to create
if ($action == 'create' )
{
    print load_fiche_titre($langs->trans("NewChapitre"));

    print '<form method="POST" action="'.$_SERVER["PHP_SELF"].'">';
    print '<input type="hidden" name="action" value="add">';
    print '<input type="hidden" name="backtopage" value="'.$backtopage.'">';
	print '<input type="hidden" name="id_ref" value="'.$id_ref.'">';

    dol_fiche_head();
	
	print dol_set_focus('#position');
	
    print '<table class="border centpercent">'."\n";
	print '<tr><td >'.$langs->trans("Code").'</td><td><input class="flat" type="text" size="36" id="position" name="position" value="'.GETPOST('position', 'alpha').'" ></td></tr>';
	print '<tr><td >'.$langs->trans("Chapitre").'</td><td><input class="flat" type="text" size="36"  name="chapitre" value="'.GETPOST('chapitre', 'alpha').'" ></td></tr>';

    print '</table>'."\n";

    dol_fiche_end();

    print '<div class="center"><input type="submit" class="button btn_click" name="add" value="'.$langs->trans("Create").'"><input disabled type="submit" class="button btn_click_2" name="add" value="'.$langs->trans("Create").'"> &nbsp; <input type="submit" class="button" name="cancel" value="'.$langs->trans("Cancel").'"></div>';

    print '</form>';
}



// Part to edit record
if (($id) && $action == 'edit')
{
    print load_fiche_titre($langs->trans("EditChapitre"));
    
    print '<form method="POST" action="'.$_SERVER["PHP_SELF"].'">';
    print '<input type="hidden" name="action" value="update">';
    print '<input type="hidden" name="backtopage" value="'.$backtopage.'">';
    print '<input type="hidden" name="id" value="'.$object->id.'">';
    print '<input type="hidden" name="id_ref" value="'.$id_ref.'">';
    
    dol_fiche_head();
	
	print dol_set_focus('#position');
	
    print '<table class="border centpercent">'."\n";
	print '<tr><td >'.$langs->trans("Code").'</td><td><input class="flat" type="text" size="36" id="position" name="position" value="'.$object->position.'" ></td></tr>';
	//print '<tr><td >'.$langs->trans("Chapitre").'</td><td><input class="flat" type="text" size="36"  name="chapitre" value="'.nl2br($object->chapitre).'" ></td></tr>';
	
	print '<tr><td >'.$langs->trans("Chapitre").'</td><td><textarea name="chapitre" rows="3" cols="0" class="flat" style="width:360px;" >'.nl2br($object->chapitre).'</textarea></tr>';
    print '</table>';
    
    dol_fiche_end();

    print '<div class="center"><input type="submit" class="button btn_click" name="save" value="'.$langs->trans("Save").'">
	<input type="submit" disabled class="button btn_click_2" name="save" value="'.$langs->trans("Save").'">&nbsp; <input type="submit" class="button" name="cancel" value="'.$langs->trans("Cancel").'"></div>';

    print '</form>';
}



// Part to show record
if ($id && (empty($action) || $action == 'view' || $action == 'delete'))
{
	/*
	* Affichage onglets
	*/

    if (($action == 'delete' && $user->rights->dolibooks->supprimer) || ($conf->use_javascript_ajax && empty($conf->dol_use_jmobile))) {
		$formconfirm = $form->formconfirm($_SERVER["PHP_SELF"] . '?id=' . $id, $langs->trans('DeleteMyChapitre'), $langs->trans('ConfirmDeleteMyChapitre'), 'confirm_delete', '', 0, "action-delete");
		print $formconfirm;
	}

}

print '<script type="text/javascript" language="javascript">
		jQuery(document).ready(function() {
			$(".btn_click_2").hide();
			$("body").on("click", "input.btn_click", function(e) {
				$(this).hide();
				$(".btn_click_2").show();
			});
			$(".btn_click_edit_2").hide();
			$("body").on("click", "a.btn_click_edit", function(e) {
				$(this).hide();
				$(".btn_click_edit_2").show();
			});
			$(".btn_click_delete_2").hide();
			$("body").on("click", "a.btn_click_delete", function(e) {
				$(this).hide();
				$(".btn_click_delete_2").show();
			});
		});
	</script>';


// End of page
llxFooter();
$db->close();
