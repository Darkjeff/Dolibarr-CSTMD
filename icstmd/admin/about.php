<?php
/* <one line to give the program's name and a brief idea of what it does.>
 * Copyright (C) <2017> SaaSprov.ma <saasprov@gmail.com>
 * Copyright (C) 2018 Philippe Grand  <philippe.grand@atoo-net.com>
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
if (false === (@include '../../main.inc.php')) {  // From htdocs directory
	require '../../../main.inc.php'; // From "custom" directory
}

global $langs, $user;

// Libraries
require_once DOL_DOCUMENT_ROOT . "/core/lib/admin.lib.php";
require_once '../class/ParsedownDolibarr.php';
dol_include_once('/ultimatepdf/class/ParsedownDolibarr.php','ParsedownDolibarr');
require_once '../lib/icstmd.lib.php';

//require_once "../class/myclass.class.php";
// Translations
$langs->loadLangs(array("admin", "icstmd@icstmd"));

// Access control
if (! $user->admin) {
	accessforbidden();
}

// Parameters
$action = GETPOST('action', 'alpha');

/*
 * Actions
 */

/*
 * View
 */
$page_name = "IcstmdAbout";
llxHeader('', $langs->trans($page_name));

// Subheader
$linkback = '<a href="'.($backtopage?$backtopage:DOL_URL_ROOT.'/admin/modules.php?restore_lastsearch_values=1').'">'.$langs->trans("BackToModuleList").'</a>';

print load_fiche_titre($langs->trans($page_name), $linkback, 'icstmd@icstmd');

// Configuration header
$head = icstmd_prepare_head();
dol_fiche_head(
	$head,
	'about',
	$langs->trans("CSTMD"),
	0,
	'icstmd@icstmd'
);

// About page goes here
echo $langs->trans("IcstmdAboutPage");

echo '<br>';

$buffer = file_get_contents(dol_buildpath('/icstmd/README.md', 0));
echo ParsedownDolibarr::instance()->text($buffer);

// Page end
dol_fiche_end();
llxFooter();
