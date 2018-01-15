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
require_once DOL_DOCUMENT_ROOT.'/includes/fpdf/fpdf/fpdf.php';
require_once DOL_DOCUMENT_ROOT.'/core/lib/company.lib.php';


$id = GETPOST('id','int');

	$sql = "DELETE FROM  " . MAIN_DB_PREFIX . "cstmd_nbrEmpVeh";
	$sql.= " WHERE rowid=" . $id;
	$resql = $db->query($sql);
	
	$db->commit();

header('Location: ' . $_SERVER['HTTP_REFERER']);

?>
