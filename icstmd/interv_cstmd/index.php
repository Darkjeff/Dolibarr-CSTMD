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

$res = @include ("../../main.inc.php"); // For root directory
if (! $res)
	$res = @include ("../../../main.inc.php"); // For "custom" directory
if (! $res)
	die("Include of main fails");

require_once DOL_DOCUMENT_ROOT.'/fichinter/class/fichinter.class.php';
require_once DOL_DOCUMENT_ROOT.'/core/lib/fichinter.lib.php';
require_once '../class/icstmd.class.php';
require_once '../class/interv_questions.class.php';

$langs->load("interventions");
$langs->load("icstmd");

$id			= GETPOST('id','int');
$ref		= GETPOST('ref','alpha');
$socid		= GETPOST('socid','int');
$action		= GETPOST('action','alpha');
$confirm	= GETPOST('confirm','alpha');

// Search criteria
$search_position = GETPOST("search_position");
$search_chapitre = GETPOST("search_chapitre");
$search_label_question = GETPOST("search_label_question");
$search_descrition = GETPOST("search_descrition", 'alpha');
$search_cf = GETPOST("search_cf");
$search_nc = GETPOST("search_nc");
$search_pa = GETPOST("search_pa");
$search_ev = GETPOST("search_ev");
$id_ques = GETPOST('id_ques','int');
	
	// Do we click on purge search criteria ?
if (GETPOST("button_removefilter_x")) {
	$search_position = '';
	$search_chapitre = '';
	$search_label_question = "";
	$search_descrition = '';
	$search_cf = "";
	$search_nc = "";
	$search_pa = '';
	$search_ev = '';
}

$limit = GETPOST("limit")?GETPOST("limit","int"):$conf->liste_limit;
$page=GETPOST("page",'int');
if ($page == -1) { $page = 0 ; }
$offset = $limit * $page;
$pageprev = $page - 1;
$pagenext = $page + 1;
$sortorder = GETPOST('sortorder', 'alpha');
$sortfield = GETPOST('sortfield', 'alpha');

// Security check
if ($user->societe_id) $socid=$user->societe_id;
$result = restrictedArea($user, 'ficheinter', $id, 'fichinter');


$object = new Fichinter($db);
$icstmd = new Icstmd($db);
$questions = new IntervQuestions($db);


// Load object
if ($id > 0 || ! empty($ref))
{
	$ret=$object->fetch($id, $ref);
	if ($ret > 0) $ret=$object->fetch_thirdparty();
	if ($ret < 0) dol_print_error('',$object->error);
}

if ($action == 'confirm_delete' )
{
	$questions->id = $id_ques;
	$result = $questions->delete($user);
	if ($result > 0)
	{ 		
		setEventMessage($langs->trans("DeletedSuccessfully"), 'mesgs');
		header("Location:index.php?id=".$id);
	}
	else
	{
		$error++;
		$langs->load("errors");
		setEventMessages($langs->trans("Error Relation"), null, 'errors');
		$action='';
	}
}

/*
 * View
 */

$form = new Form($db);

llxHeader('',$langs->trans("Intervention"));

	/*
	* Affichage en mode visu
 	*/

	$object->fetch($id, $ref);
	$object->fetch_thirdparty();

	$soc=new Societe($db);
	$soc->fetch($object->socid);

	$head = fichinter_prepare_head($object);

	dol_fiche_head($head, 'icstmdficheinter', $langs->trans("InterventionCard"), -1, 'intervention');

	


	// Intervention card
	$linkback = '<a href="'.DOL_URL_ROOT.'/fichinter/list.php'.(! empty($socid)?'?socid='.$socid:'').'">'.$langs->trans("BackToList").'</a>';


	$morehtmlref='<div class="refidno">';

	// Thirdparty
	$morehtmlref.=$langs->trans('ThirdParty') . ' : ' . $object->thirdparty->getNomUrl(1);
	
	$morehtmlref.='</div>';

    dol_banner_tab($object, 'ref', $linkback, 1, 'ref', 'ref', $morehtmlref);
	print '<div class="clearboth"></div>';
	
$sql = "SELECT qu.rowid as rowid, qu.position as position, qu.label_question as label_question, qu.texte_reglementaire as texte_reglementaire, qu.etat_lieux as etat_lieux, qu.titre_recommandation as titre_recommandation, ";
$sql.= " qu.recommandation as recommandation, qu.dater as dater, qu.reference as reference, qu.fk_intervention as intervention, qu.fk_chapitre as fk_chapitre, qu.cf as cf, qu.nc as nc, qu.pa as pa, ";
$sql.= " qu.ev as ev, ch.chapitre as chapitre, ch.position as posi, ch.rowid as chrowid ";
$sql.= " FROM ".MAIN_DB_PREFIX."cstmd_interv_questions as qu";
$sql.= " LEFT JOIN  ".MAIN_DB_PREFIX."cstmd_chapitres as ch ON ch.rowid = qu.fk_chapitre";
$sql.= " WHERE qu.fk_intervention = ".$id;
$rec_ev = null;
$rec_pa = null;
$rec_nc = null;
$rec_cf = null;
if($search_ev != '' && (int)$search_ev != -1){
	$rec_ev = is_int((int)$search_ev);
}
if($search_pa != '' && (int)$search_pa != -1){
	$rec_pa = is_int((int)$search_pa);
}
if($search_nc != '' && (int)$search_nc != -1){
	$rec_nc = is_int((int)$search_nc);
}
if($search_cf != '' && (int)$search_cf != -1){
	$rec_cf = is_int((int)$search_cf);
}
if ($search_position) $sql.= natural_search("qu.position",$search_position);
if ($search_chapitre) $sql.= natural_search("chapitre",$search_chapitre);
if ($search_label_question) $sql.= natural_search("label_question",$search_label_question);
if ($search_descrition) $sql.= natural_search("recommandation",$search_descrition);
if ($rec_cf) $sql.= natural_search("cf",$search_cf);
if ($rec_nc) $sql.= natural_search("nc",$search_nc);
if ($rec_pa) $sql.= natural_search("nc",$search_pa);
if ($rec_ev) $sql.= natural_search("r.ev",$search_ev);
$nbtotalofrecords = 0;
if (empty($conf->global->MAIN_DISABLE_FULL_SCANLIST))
{
	$result = $db->query($sql);
	$nbtotalofrecords = $db->num_rows($result);
}	

$sql.= $db->plimit($limit+1, $offset);
$resql=$db->query($sql);
if ($resql)
{
    $num = $db->num_rows($resql);
    $params='';

	if ($search_position != '') $params.= '&amp;search_position='.urlencode($search_position);
	if ($search_chapitre != '') $params.= '&amp;search_chapitre='.urlencode($search_chapitre);
	if ($search_label_question != '') $params.= '&amp;search_label_question='.urlencode($search_label_question);
	if ($search_descrition != '') $params.= '&amp;search_descrition='.urlencode($search_descrition);
	if ($search_cf != '') $params.= '&amp;search_cf='.urlencode($search_cf);
	if ($search_nc != '') $params.= '&amp;search_nc='.urlencode($search_nc);
	if ($search_ev != '') $params.= '&amp;search_ev='.urlencode($search_ev);
	if ($search_pa != '') $params.= '&amp;search_pa='.urlencode($search_pa);
    if ($optioncss != '') $param.='&optioncss='.$optioncss;
    // Add $param from extra fields
	if ($limit > 0 && $limit != $conf->liste_limit) $params.='&limit='.$limit;
	$params.='&id='.$id;
	print '<form method="post" action="'.$_SERVER["REQUEST_URI"].'" name="formfilter">';
	if ($optioncss != '') print '<input type="hidden" name="optioncss" value="'.$optioncss.'">';
	print '<input type="hidden" name="token" value="'.$_SESSION['newtoken'].'">';
	print '<input type="hidden" name="formfilteraction" id="formfilteraction" value="list">';
	print '<input type="hidden" name="sortfield" value="'.$sortfield.'">';
	print '<input type="hidden" name="sortorder" value="'.$sortorder.'">';
	print_barre_liste($title, $page, $_SERVER["PHP_SELF"], $params, $sortfield, $sortorder, '', $num, $nbtotalofrecords, 'title_companies', 0, '', '', $limit);
	
	print '<table class="liste '.($moreforfilter?"listwithfilterbefore":"").'">';

    // Fields title
    print '<tr class="liste_titre">
		<th class="liste_titre">Numéro</th>
        <th class="liste_titre">Chapitre</th>
		<th class="liste_titre">Question</th>
		<th class="liste_titre">Recommandation</th>
		<th class="liste_titre">CF</th>
		<th class="liste_titre">NC</th>
		<th class="liste_titre">PA</th>
		<th class="liste_titre">EV</th>
		<th class="liste_titre">Action</th></tr>';

    // Fields title search
	print '<tr class="liste_titre">';
	// LIST_OF_TD_TITLE_SEARCH
	
	print '<td class="liste_titre"><input type="text" class="flat" name="search_position" value="'.$search_position.'" size="10"></td>';
	print '<td class="liste_titre"><input type="text" class="flat" name="search_position" value="'.$search_chapitre.'" size="10"></td>';
	print '<td class="liste_titre"><input type="text" class="flat" name="search_label_question" value="'.$search_label_question.'" size="10"></td>';
	print '<td class="liste_titre"><input type="text" class="flat" name="search_descrition" value="'.$search_descrition.'" size="10"></td>';
	print '<td class="liste_titre">';
	print $form->selectarray('search_cf', array('1'=>$langs->trans('Yes'),'0'=>$langs->trans('No')),$search_cf,1);
	print '</td>';
	print '<td class="liste_titre">';
	print $form->selectarray('search_nc', array('1'=>$langs->trans('Yes'),'0'=>$langs->trans('No')),$search_nc,1);
	print '</td>';
	print '<td class="liste_titre">';
	print $form->selectarray('search_pa', array('1'=>$langs->trans('Yes'),'0'=>$langs->trans('No')),$search_pa,1);
	print '<td class="liste_titre">';
	print $form->selectarray('search_ev', array('1'=>$langs->trans('Yes'),'0'=>$langs->trans('No')),$search_ev,1);
	print '</td>';
	print '</td>';
	 
    // Action column
	print '<td class="liste_titre" align="right">';
    $searchpitco=$form->showFilterAndCheckAddButtons(0);
    print $searchpitco;
    print '</td>';
	print '</tr>'."\n";
    
	$i=0;
	$var=true;
    while ($i < min($num, $limit))
    {
		
        $obj = $db->fetch_object($resql);
        if ($obj)
        {
            $var = !$var;
            // Show here line of result
            print '<tr '.$bc[$var].'>';
            // LIST_OF_TD_FIELDS_LIST
				$nums = explode(".",$obj->position);
				$num = $nums[0].'.'.$nums[1].'.';
                print '<td>'.$obj->position.'</td>';
      			print '<td>'. dol_trunc($obj->chapitre, 32) .'</td>';
                print '<td>'.$obj->label_question.'</td>';
                print '<td>'.$obj->recommandation.'-'.$obj->dater.'</td>';
                $chek_cf = ($obj->cf?'statut4' : 'statut8');
                $chek_nc = ($obj->nc?'statut4' : 'statut8');
                $chek_pa = ($obj->pa?'statut4' : 'statut8');
                $chek_ev = ($obj->ev?'statut4' : 'statut8');
				print '<td align="center" class="nowrap">'.img_picto($langs->trans("ActivityCeased"),$chek_cf, 'class="pictostatus"').'</td>';
				print '<td align="center" class="nowrap">'.img_picto($langs->trans("ActivityCeased"),$chek_nc, 'class="pictostatus"').'</td>';
				print '<td align="center" class="nowrap">'.img_picto($langs->trans("ActivityCeased"),$chek_pa, 'class="pictostatus"').'</td>';
				print '<td align="center" class="nowrap">'.img_picto($langs->trans("ActivityCeased"),$chek_ev, 'class="pictostatus"').'</td>';
				print '<td align="right">';
					print '<a class="btn_click_edit" href="card.php?action=edit&id_interv=' . $id . '&id='.$obj->rowid.'&num='.$num.'&id_cha='.$obj->fk_chapitre.'">' . img_edit($langs->trans('Modify')) .'</a><a class="btn_click_edit_2" title="' . dol_escape_htmltag($langs->trans("NotAllowed")) . '">' . img_edit($langs->trans('Modify')) .'</a>';
					print '&nbsp;&nbsp;&nbsp;';
					print '<a class="btn_click_delete_0" href="'.$_SERVER["PHP_SELF"].'?id_ques='.$obj->rowid.'&amp;action=delete&amp;id='.$id.'&num='.$num.'">' . img_delete($langs->trans('Delete')) . '</a><a class="btn_click_delete_02" title="' . dol_escape_htmltag($langs->trans("NotAllowed")) . '" >' . img_delete($langs->trans('Delete')) . '</a>';
				print '</td>';
            print '</tr>';
        }
        $i++;
    }
    
    $db->free($resql);
	print "</table>\n";
	print "</form>\n";
	
	$db->free($result);
}
else
{
    $error++;
    dol_print_error($db);
}

if ($action == 'delete' ) 
{
	$formconfirm = $form->formconfirm($_SERVER["PHP_SELF"] . '?id_ques=' . $id_ques.'&id='.$id, $langs->trans('DeleteMyQuestion'), $langs->trans('ConfirmDeleteMyQuestion'), 'confirm_delete', '', 0, 1);
	print $formconfirm;
}
	
print '<div class="tabsAction">';

	print '<a class="butAction btn_click" href="card.php?action=create&id_interv=' . $id . '">' . $langs->trans('New') . '</a><a class="butActionRefused btn_click_2"  title="' . dol_escape_htmltag($langs->trans("NotAllowed")) . '">' . $langs->trans('New') . '</a>';
	
	print '<a class="butAction btn_click_pdf" target="blank" href="pdf.php?id='.$id.'">' . $langs->trans('Générer Rapport Annuel') . '</a><a class="butActionRefused btn_click_pdf_2"  title="' . dol_escape_htmltag($langs->trans("NotAllowed")) . '">' . $langs->trans('Générer PDF') . '</a>';
	
	print '<a class="butAction btn_click_pdfv" target="blank" href="pdfv.php?id='.$id.'">' . $langs->trans('Générer Rapport Visite') . '</a><a class="butActionRefused btn_click_pdf_v"  title="' . dol_escape_htmltag($langs->trans("NotAllowed")) . '">' . $langs->trans('Générer PDF') . '</a>';


print '</div>';

print '<script type="text/javascript" language="javascript">
		jQuery(document).ready(function() {
			$(".btn_click_2").hide();
			$("body").on("click", "a.btn_click", function(e) {
				$(this).hide();
				$(".btn_click_2").attr("disabled", true);
				$(".btn_click_2").show();
			});
			$(".btn_click_pdf_2").hide();
			$("body").on("click", "a.btn_click_pdf", function(e) {
				$(this).hide();
				$(".btn_click_pdf_2").attr("disabled", true);
				$(".btn_click_pdf_2").show();
			});
            
            $(".btn_click_pdf_v").hide();
			$("body").on("click", "a.btn_click_pdfv", function(e) {
				$(this).hide();
				$(".btn_click_pdf_v").attr("disabled", true);
				$(".btn_click_pdf_v").show();
			});
            
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

llxFooter();

$db->close();
