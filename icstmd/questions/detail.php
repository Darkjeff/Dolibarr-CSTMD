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

require_once '../class/questions.class.php';
/***************************************************
* VIEW
*
* Put here all code to build page
****************************************************/
$langs->load("interventions");
$langs->load("icstmd");

$id_cha		= GETPOST('id_cha','int');
$action		= GETPOST('action','alpha');
$confirm	= GETPOST('confirm','alpha');
$id = GETPOST('id');
$form=new Form($db);
$object=new Questions($db);
$limit = GETPOST("limit")?GETPOST("limit","int"):$conf->liste_limit;
$page=GETPOST("page",'int');
if ($page == -1) { $page = 0 ; }
$offset = $limit * $page;
$pageprev = $page - 1;
$pagenext = $page + 1;
if ($id > 0 || ! empty($ref))
{
	$result=$object->fetch($id,$ref);
	if ($result < 0) dol_print_error($db);
}

if ($action == 'confirm_delete' )
{
	$result = $object->delete($user);
	if ($result > 0)
	{ 		
		setEventMessage($langs->trans("DeletedSuccessfully"), 'mesgs');
		header("Location:detail.php?id_cha=".$id_cha);
	}
	else
	{
		$error++;
		$langs->load("errors");
		setEventMessages($langs->trans("Error Relation"), null, 'errors');
		$action='';
	}
}
$title = $langs->trans('Questions');
llxHeader('', $title, '');


if ($action == 'delete' ) 
{
	$formconfirm = $form->formconfirm($_SERVER["PHP_SELF"] . '?num=' . $nums.'&id='.$id.'&id_cha='.$id_cha, $langs->trans('DeleteMyQuestion'), $langs->trans('ConfirmDeleteMyQuestion'), 'confirm_delete', '', 0, 1);
	print $formconfirm;
}
$nums = -1;
$sqls = "SELECT * ";
$sqls.= " FROM ".MAIN_DB_PREFIX."cstmd_chapitres ";
$sqls.= " where rowid = ".$id_cha;
$resqls=$db->query($sqls);
$sql = 'SELECT * FROM '.MAIN_DB_PREFIX.'cstmd_questions ';
$sql.= " Where fk_chapitre_id =".$id_cha;
$sql.= $db->plimit($limit+1, $offset);
$resql=$db->query($sql);

print '
	<h1 style="text-align:center;margin:auto;">';
	if ($resqls) {
		for($cmp=0;$cmp<$db->num_rows($resqls);$cmp++){
			$obj = $db->fetch_object($resqls);
			echo $obj->position.'.'.$obj->chapitre;
			$nums = $obj->position;
		}
		$db->free($resqls);
	}
	else{
		echo 'Aucan chapitre';
	}
	print '</h1>';
	if ($resql)
	{
		$num = $db->num_rows($resql);
		print '<form method="post" action="'.$_SERVER["PHP_SELF"].'" name="formfilter">';
		if ($optioncss != '') print '<input type="hidden" name="optioncss" value="'.$optioncss.'">';
		print '<input type="hidden" name="token" value="'.$_SESSION['newtoken'].'">';
		print '<input type="hidden" name="formfilteraction" id="formfilteraction" value="list">';
		print '<input type="hidden" name="sortfield" value="'.$sortfield.'">';
		print '<input type="hidden" name="sortorder" value="'.$sortorder.'">';
		print_barre_liste($langs->trans('Questions'), $page, $_SERVER["PHP_SELF"], $params, $sortfield, $sortorder, '', $num, null, 'title_companies', 0, '', '', $limit);
		print '<table cellpadding="0" cellspacing="0" class="liste '.($moreforfilter?"listwithfilterbefore":"").'">';

		// Fields isbn10
		print '<tr class="liste_titre">
			<th class="liste_titre">Numero</th>
			<th class="liste_titre">Question</th>
			<th class="liste_titre">Référence</th>
			<th class="liste_titre">Etat des lieux</th>
			<th class="liste_titre">Titre recommandation</th>
			<th class="liste_titre">Recommandation</th>
			<th class="liste_titre">Action</th>
		</tr>';
		$i=0;
		$var=true;
		$row = 0;
		while ($i < min($num, $limit))
		{
			$num = $db->num_rows($resql);
			$obj = $db->fetch_object($resql);
			if ($obj)
			{
				$var = !$var;
				// Show here line of result
				$row++;
				print '<tr '.$bc[$var].'>';
				// LIST_OF_TD_FIELDS_LIST
					print '<td>'.$obj->position.'</td>';
					print '<td>'.nl2br($obj->label_question).'</td>';
					print '<td>'.nl2br($obj->reference).'</td>';
					print '<td>'.nl2br($obj->etat_lieux).'</td>';
					print '<td>'.nl2br($obj->titre_recommandation).'</td>';
					print '<td>'.nl2br($obj->recommandation).'</td>';
					print '<td >';
						
							print '<a class="btn_click_edit" href="card.php?action=edit&num=' . $nums . '&id='.$obj->rowid.'&id_cha='.$id_cha.'">' . img_edit($langs->trans('Modify')) .'</a><a class="btn_click_edit_2" title="' . dol_escape_htmltag($langs->trans("NotAllowed")) . '">' . img_edit($langs->trans('Modify')) .'</a>';
							print '&nbsp;&nbsp;&nbsp;';
							print '<a class="btn_click_delete_0" href="'.$_SERVER["PHP_SELF"].'?id='.$obj->rowid.'&amp;action=delete&amp;num='.$nums.'&id_cha='.$id_cha.'">' . img_delete($langs->trans('Delete')) . '</a><a class="btn_click_delete_02" title="' . dol_escape_htmltag($langs->trans("NotAllowed")) . '" >' . img_delete($langs->trans('Delete')) . '</a>';
						
					print '</td>';
				print '</tr>';
			}
			$i++;
		}
		if (! $row) print '<tr '.$bc[$var].'><td colspan="8" class="opacitymedium">'.$langs->trans("None").'</td></tr>';
		$db->free($resql);
		print "</table>\n";
		print "</form>\n";
	}
else
{
	$error++;
	dol_print_error($db);
}

print '<a class="butAction btn_click" href="card.php?action=create&num=' . $nums . '&id_cha='.$id_cha.'">' . $langs->trans('New') . '</a>';

print '<script type="text/javascript" language="javascript">
		jQuery(document).ready(function() {
			$(".btn_click_edit_2").hide();
			$("body").on("click", "a.btn_click_edit", function(e) {
				$(this).hide();
				$(this).parent().find("a.btn_click_edit_2").disabled = true;
				$(this).parent().find("a.btn_click_edit_2").show();
			});
			$(".btn_click_delete_02").hide();
			$("body").on("click", "a.btn_click_delete_0", function(e) {
				$(this).hide();
				$(this).parent().find("a.btn_click_delete_02").disabled = true;
				$(this).parent().find("a.btn_click_delete_02").show();
			});
		});
	</script>';
// End of page
llxFooter();
$db->close();
