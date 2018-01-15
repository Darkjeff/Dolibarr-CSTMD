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


/***************************************************
* VIEW
*
* Put here all code to build page
****************************************************/

$form=new Form($db);
$title = $langs->trans('Questions');
llxHeader('', $title, '');

print '
	<h1>5.	 Résumé	 des	 recommandations	 du	 conseiller	 à	 la	sécurité	durant	l’année	</h1>
	<table border="2" style="text-align:center;margin:auto;">
		<thead>
			<tr>
				<th style="padding:7px; font-weight: bold; font-size:17px; color:#006400;">Numero</th>
				<th style="padding:7px; font-weight: bold; font-size:17px; color:#006400;">Description</th>
				<th style="padding:7px; font-weight: bold; font-size:17px; color:#006400;">Voir Les Questions</th>
			</tr>
		</thead>
		<tbody>
			<tr>
				<td style="padding:4px; font-size:15px; font-weight: bold;">
					5.1
				</td>
				<td style="padding:4px; font-size:15px; font-weight: bold;">
					Les	procédés	visant	au	respect	des	règles	relatives	à	l\'identification	
					des	marchandises	dangereuses	transportées	
				</td>
				<td style="padding:4px; font-size:15px; font-weight: bold;">
					<a class="btn_click_view" href="detail.php?num=5.1" target="_blank"><img src="/dolibarr/htdocs/theme/eldy/img/detail.png" border="0" alt="" title="Detail"></a><a class="btn_click_view_2" title="' . dol_escape_htmltag($langs->trans("NotAllowed")) . '"><img src="/dolibarr/htdocs/theme/eldy/img/detail.png" border="0" alt="" title="Detail"></a>
				</td>
			</tr>
			<tr>
				<td style="padding:4px; font-size:15px; font-weight: bold;">
					5.2
				</td>
				<td style="padding:4px; font-size:15px; font-weight: bold;">
					La	 pratique	 de	 l’entreprise	 concernant	 la	 prise	 en	 compte	 dans	
					l’achat	 des	 moyens	 de	 transport	 de	 tout	 besoin	 particulier	 relatif	 aux	
					marchandises	dangereuses	transportées	
				</td>
				<td style="padding:4px; font-size:15px; font-weight: bold;">
					<a class="btn_click_view" href="detail.php?num=5.2" target="_blank"><img src="/dolibarr/htdocs/theme/eldy/img/detail.png" border="0" alt="" title="Detail"></a><a class="btn_click_view_2" title="' . dol_escape_htmltag($langs->trans("NotAllowed")) . '"><img src="/dolibarr/htdocs/theme/eldy/img/detail.png" border="0" alt="" title="Detail"></a>
				</td>
			</tr>
			<tr>
				<td style="padding:4px; font-size:15px; font-weight: bold;">
					5.3
				</td>
				<td style="padding:4px; font-size:15px; font-weight: bold;">
					Les	 procédés	 permeeant	 de	 vérifier	 le	 matériel	 utilisé	 pour	 le	
					transport	 de	 matières	 dangereuses	 ou	 pour	 les	 opérations	 de	
					chargement	ou	de	déchargement	
				</td>
				<td style="padding:4px; font-size:15px; font-weight: bold;">
					<a class="btn_click_view" href="detail.php?num=5.3" target="_blank"><img src="/dolibarr/htdocs/theme/eldy/img/detail.png" border="0" alt="" title="Detail"></a><a class="btn_click_view_2" title="' . dol_escape_htmltag($langs->trans("NotAllowed")) . '"><img src="/dolibarr/htdocs/theme/eldy/img/detail.png" border="0" alt="" title="Detail"></a>
				</td>
			</tr>
			<tr>
				<td style="padding:4px; font-size:15px; font-weight: bold;">
					5.4
				</td>
				<td style="padding:4px; font-size:15px; font-weight: bold;">
					Le	 fait	 que	 les	 employés	 concernés	 de	 l’entreprise	 ont	 reçu	 une	
					formation	 appropriée,	 y	 compris	 à	 propos	 des	 modifications	 à	 la	
					réglementation,	et	que	ceee	formation	est	inscrite	sur	leur	dossier	
				</td>
				<td style="padding:4px; font-size:15px; font-weight: bold;">
					<a class="btn_click_view" href="detail.php?num=5.4" target="_blank"><img src="/dolibarr/htdocs/theme/eldy/img/detail.png" border="0" alt="" title="Detail"></a><a class="btn_click_view_2" title="' . dol_escape_htmltag($langs->trans("NotAllowed")) . '"><img src="/dolibarr/htdocs/theme/eldy/img/detail.png" border="0" alt="" title="Detail"></a>
				</td>
			</tr>
			<tr>
				<td style="padding:4px; font-size:15px; font-weight: bold;">
					5.5
				</td>
				<td style="padding:4px; font-size:15px; font-weight: bold;">
					La	 mise	 en	 œuvre	 de	 procédures	 d’urgence	 appropriées	 aux	
					accidents	 ou	 incidents	 éventuels	 pouvant	 porter	 aeeinte	 à	 la	 sécurité	
					pendant	 le	 transport	 de	 marchandises	 dangereuses	 ou	 pendant	 les	
					opérations	de	chargement	ou	de	déchargement	
				</td>
				<td style="padding:4px; font-size:15px; font-weight: bold;">
					<a class="btn_click_view" href="detail.php?num=5.5" target="_blank"><img src="/dolibarr/htdocs/theme/eldy/img/detail.png" border="0" alt="" title="Detail"></a><a class="btn_click_view_2" title="' . dol_escape_htmltag($langs->trans("NotAllowed")) . '"><img src="/dolibarr/htdocs/theme/eldy/img/detail.png" border="0" alt="" title="Detail"></a>
				</td>
			</tr>
			<tr>
				<td style="padding:4px; font-size:15px; font-weight: bold;">
					5.6
				</td>
				<td style="padding:4px; font-size:15px; font-weight: bold;">
					Le	recours	à	des	analyses	et,	si	nécessaire,	la	rédaction	de	rapports	
					concernant	 les	 accidents,	 les	 incidents	 ou	 les	 infractions	 graves	
					constatés	 au	 cours	 du	 transport	 de	 marchandises	 dangereuses	 ou	
					pendant	les	opérations	de	chargement	ou	de	déchargement	
				</td>
				<td style="padding:4px; font-size:15px; font-weight: bold;">
					<a class="btn_click_view" href="detail.php?num=5.6" target="_blank"><img src="/dolibarr/htdocs/theme/eldy/img/detail.png" border="0" alt="" title="Detail"></a><a class="btn_click_view_2" title="' . dol_escape_htmltag($langs->trans("NotAllowed")) . '"><img src="/dolibarr/htdocs/theme/eldy/img/detail.png" border="0" alt="" title="Detail"></a>
				</td>
			</tr>
			<tr>
				<td style="padding:4px; font-size:15px; font-weight: bold;">
					5.7
				</td>
				<td style="padding:4px; font-size:15px; font-weight: bold;">
					La	mise	en	place	de	mesures	appropriées	pour	éviter	la	répétition	
					d’accidents,	d’incidents	ou	d’infractions	graves	
				</td>
				<td style="padding:4px; font-size:15px; font-weight: bold;">
					<a class="btn_click_view" href="detail.php?num=5.7" target="_blank"><img src="/dolibarr/htdocs/theme/eldy/img/detail.png" border="0" alt="" title="Detail"></a><a class="btn_click_view_2" title="' . dol_escape_htmltag($langs->trans("NotAllowed")) . '"><img src="/dolibarr/htdocs/theme/eldy/img/detail.png" border="0" alt="" title="Detail"></a>
				</td>
			</tr>
			<tr>
				<td style="padding:4px; font-size:15px; font-weight: bold;">
					5.8
				</td>
				<td style="padding:4px; font-size:15px; font-weight: bold;">
					La	 prise	 en	 compte	 des	 prescriptions	 législatives	 et	 des	 besoins	
					particuliers	 relatifs	 au	 transport	 de	 marchandises	 dangereuses	
					concernant	 le	 choix	 et	 l’utilisation	 de	 sous-traitants	 ou	 autres	
					intervenants	
				</td>
				<td style="padding:4px; font-size:15px; font-weight: bold;">
					<a class="btn_click_view" href="detail.php?num=5.8" target="_blank"><img src="/dolibarr/htdocs/theme/eldy/img/detail.png" border="0" alt="" title="Detail"></a><a class="btn_click_view_2" title="' . dol_escape_htmltag($langs->trans("NotAllowed")) . '"><img src="/dolibarr/htdocs/theme/eldy/img/detail.png" border="0" alt="" title="Detail"></a>
				</td>
			</tr>
			<tr>
				<td style="padding:4px; font-size:15px; font-weight: bold;">
					5.9
				</td>
				<td style="padding:4px; font-size:15px; font-weight: bold;">
					La	 vérification	 que	 le	 personnel	 affecté	 au	 transport	 des	
					marchandises	dangereuses,	au	chargement	ou	au	déchargement	de	ces	
					marchandises	 dispose	 de	 procédures	 d’exécution	 et	 de	 consignes	
					détaillées			
				</td>
				<td style="padding:4px; font-size:15px; font-weight: bold;">
					<a class="btn_click_view" href="detail.php?num=5.9" target="_blank"><img src="/dolibarr/htdocs/theme/eldy/img/detail.png" border="0" alt="" title="Detail"></a><a class="btn_click_view_2" title="' . dol_escape_htmltag($langs->trans("NotAllowed")) . '"><img src="/dolibarr/htdocs/theme/eldy/img/detail.png" border="0" alt="" title="Detail"></a>
				</td>
			</tr>
			<tr>
				<td style="padding:4px; font-size:15px; font-weight: bold;">
					5.10
				</td>
				<td style="padding:4px; font-size:15px; font-weight: bold;">
					La	mise	en	place	d’actions	pour	la	sensibilisation	aux	risques	liés	au	
					transport	 des	 marchandises	 dangereuses,	 au	 chargement	 ou	 au	
					déchargement	de	ces	dernières				
				</td>
				<td style="padding:4px; font-size:15px; font-weight: bold;">
					<a class="btn_click_view" href="detail.php?num=5.10" target="_blank"><img src="/dolibarr/htdocs/theme/eldy/img/detail.png" border="0" alt="" title="Detail"></a><a class="btn_click_view_2" title="' . dol_escape_htmltag($langs->trans("NotAllowed")) . '"><img src="/dolibarr/htdocs/theme/eldy/img/detail.png" border="0" alt="" title="Detail"></a>
				</td>
			</tr>
			<tr>
				<td style="padding:4px; font-size:15px; font-weight: bold;">
					5.11
				</td>
				<td style="padding:4px; font-size:15px; font-weight: bold;">
					La	 mise	 en	 place	 de	 procédés	 de	 vérification	 afin	 d’assurer	 la	
					présence,	 à	 bord	 des	 moyens	 de	 transport,	 des	 documents	 et	 des	
					équipements	 de	 sécurité	 devant	 accompagner	 les	 transports	 et	 la	
					conformité	 de	 ces	 documents	 et	 de	 ces	 équipements	 avec	 la	
					réglementation				
				</td>
				<td style="padding:4px; font-size:15px; font-weight: bold;">
					<a class="btn_click_view" href="detail.php?num=5.11" target="_blank"><img src="/dolibarr/htdocs/theme/eldy/img/detail.png" border="0" alt="" title="Detail"></a><a class="btn_click_view_2" title="' . dol_escape_htmltag($langs->trans("NotAllowed")) . '"><img src="/dolibarr/htdocs/theme/eldy/img/detail.png" border="0" alt="" title="Detail"></a>
				</td>
			</tr>
			<tr>
				<td style="padding:4px; font-size:15px; font-weight: bold;">
					5.12
				</td>
				<td style="padding:4px; font-size:15px; font-weight: bold;">
					La	 mise	 en	 place	 de	 procédés	 de	 vérification	 afin	 d’assurer	 le	
					respect	des	prescriptions	relatives	aux	opérations	de	chargement	et	de	
					déchargement		
				</td>
				<td style="padding:4px; font-size:15px; font-weight: bold;">
					<a class="btn_click_view" href="detail.php?num=5.12" target="_blank"><img src="/dolibarr/htdocs/theme/eldy/img/detail.png" border="0" alt="" title="Detail"></a><a class="btn_click_view_2" title="' . dol_escape_htmltag($langs->trans("NotAllowed")) . '"><img src="/dolibarr/htdocs/theme/eldy/img/detail.png" border="0" alt="" title="Detail"></a>
				</td>
			</tr>
			<tr>
				<td style="padding:4px; font-size:15px; font-weight: bold;">
					5.13
				</td>
				<td style="padding:4px; font-size:15px; font-weight: bold;">
					L’existence	du	plan	de	sûreté	prévu	au	1.10.3.2		
				</td>
				<td style="padding:4px; font-size:15px; font-weight: bold;">
					<a class="btn_click_view" href="detail.php?num=5.13" target="_blank"><img src="/dolibarr/htdocs/theme/eldy/img/detail.png" border="0" alt="" title="Detail"></a><a class="btn_click_view_2" title="' . dol_escape_htmltag($langs->trans("NotAllowed")) . '"><img src="/dolibarr/htdocs/theme/eldy/img/detail.png" border="0" alt="" title="Detail"></a>
				</td>
			</tr>
		</tbody>
	</table>
';

print '<style>
	.btn_click_view_2{
		cursor: not-allowed !important;
		padding: 0.3em 0.4em;
		color: #999 !important;
		background-image: -moz-linear-gradient(top, #ffffff, #e6e6e6);
		background-image: -o-linear-gradient(top, #ffffff, #e6e6e6);
		filter: progid:DXImageTransform.Microsoft.gradient(startColorstr="#ffffffff", endColorstr="#ffe6e6e6", GradientType=0);
		filter: progid:DXImageTransform.Microsoft.gradient(enabled = false);
		border: 1px solid #bbbbbb;
		border-bottom-color: #a2a2a2;
		-moz-border-radius: 4px;
		border-radius: 4px;
	}
</style>';
print '<script type="text/javascript" language="javascript">
		jQuery(document).ready(function() {
			$(".btn_click_view_2").hide();
			$("body").on("click", "a.btn_click_view", function(e) {
				$(this).hide(0).delay(2000).show(0);
				$(this).parent().find("a.btn_click_view_2").disabled = true;
				$(this).parent().find("a.btn_click_view_2").show(0).delay(2000).hide(0);
			});
		});
	</script>';
// End of page
llxFooter();
$db->close();
