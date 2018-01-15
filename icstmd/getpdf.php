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
require_once 'fpdf/fpdf.php';
require_once DOL_DOCUMENT_ROOT.'/core/lib/company.lib.php';


$socid = GETPOST('socid','int');
$code = GETPOST('code');
$object = new Societe($db);
$object->fetch($socid);
//var_dump($object);



header("Content-Type: application/octet-stream");

$dir = $dolibarr_main_data_root."/icstmd/".$socid;


$file=$dir."/".$code;

if (file_exists($file)) {
header("Content-type:application/pdf");

// It will be called downloaded.pdf
header("Content-Disposition:attachment;filename='".$code.".pdf'");

// The PDF source is in original.pdf
readfile($file);
}

?>
