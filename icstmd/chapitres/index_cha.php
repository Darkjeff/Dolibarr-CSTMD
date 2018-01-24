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
/***************************************************
* VIEW
*
* Put here all code to build page
****************************************************/
$id			= GETPOST('id','int');
$id_ref			= GETPOST('id_ref');
$action		= GETPOST('action','alpha');
$form=new Form($db);
$object=new Chapitre($db);
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
	if ($result < 0)
	{ 		
		setEventMessage($langs->trans("DeletedSuccessfully"), 'mesgs');
		header("Location: index_cha.php?id_ref=".GETPOST("id_ref"));
		exit;
	}
	else
	{
		$error++;
		$langs->load("errors");
		setEventMessages($langs->trans("Error Relation"), null, 'errors');
		$action='';
	}
}
$title = $langs->trans('Chapitre');
llxHeader('', $title, '');


if ($action == 'delete' ) 
{
	$formconfirm = $form->formconfirm($_SERVER["PHP_SELF"] . '?id=' . $id.'&id_ref='.$id_ref, $langs->trans('DeleteMyChapitre'), $langs->trans('ConfirmDeleteMyChapitre'), 'confirm_delete', '', 0, 1);
	print $formconfirm;
}
$sql = "SELECT * ";
$sql.= " FROM ".MAIN_DB_PREFIX."cstmd_chapitres ";
$sql.= " where fk_referentiel_id = ".$id_ref;
$sql.= $db->plimit($limit+1, $offset);
$resql=$db->query($sql);

print '
	<h1 style="text-align:center;margin:auto;">Chapitre	</h1><br>';

	if ($resql)
	{
		$num = $db->num_rows($resql);
		print '<form method="post" action="'.$_SERVER["PHP_SELF"].'" name="formfilter">';
		if ($optioncss != '') print '<input type="hidden" name="optioncss" value="'.$optioncss.'">';
		print '<input type="hidden" name="token" value="'.$_SESSION['newtoken'].'">';
		print '<input type="hidden" name="formfilteraction" id="formfilteraction" value="list">';
		print '<input type="hidden" name="sortfield" value="'.$sortfield.'">';
		print '<input type="hidden" name="sortorder" value="'.$sortorder.'">';
		print_barre_liste($langs->trans('Chapitre'), $page, $_SERVER["PHP_SELF"], $params, $sortfield, $sortorder, '', $num, null, 'title_companies', 0, '', '', $limit);
		print '<table cellpadding="0" cellspacing="0" class="liste '.($moreforfilter?"listwithfilterbefore":"").'">';

		
		// Fields isbn10
		print '<tr class="liste_titre">
			<th class="liste_titre">Code</th>
			<th class="liste_titre">Label</th>
			<th class="liste_titre">Action</th>
		</tr>';
		// Fields isbn10 search
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
					print '<td>'.$obj->chapitre.'</td>';
					print '<td >';
						print '&nbsp;&nbsp;&nbsp;';
						print '<a href="../questions/detail.php?id_cha='.$obj->rowid.'" target="_blank"><img src="../../../theme/eldy/img/detail.png" border="0" alt="" title="Detail"></a>';
						print '&nbsp;&nbsp;&nbsp;';
						print '<a class="btn_click_edit" href="card_cha.php?action=edit&id='.$obj->rowid.'&id_ref='.$id_ref.'">' . img_edit($langs->trans('Modify')) .'</a><a class="btn_click_edit_2" title="' . dol_escape_htmltag($langs->trans("NotAllowed")) . '">' . img_edit($langs->trans('Modify')) .'</a>';
						print '&nbsp;&nbsp;&nbsp;';
						print '<a class="btn_click_delete_0" href="'.$_SERVER["PHP_SELF"].'?id='.$obj->rowid.'&amp;action=delete&amp;id_ref='.$id_ref.'">' . img_delete($langs->trans('Delete')) . '</a><a class="btn_click_delete_02" title="' . dol_escape_htmltag($langs->trans("NotAllowed")) . '" >' . img_delete($langs->trans('Delete')) . '</a>';
						print '&nbsp;&nbsp;&nbsp;';
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
print'
	<a class="butAction btn_click" href="card_cha.php?action=create&id_ref='.$id_ref.'">'.$langs->trans("Ajouter un nouveau chapitre").'</a>
';

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
