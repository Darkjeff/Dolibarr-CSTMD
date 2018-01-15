-- <one line to give the program's name and a brief idea of what it does.>
-- Copyright (C) <2017> SaaSprov.ma <saasprov@gmail.com>
--
-- This program is free software: you can redistribute it and/or modify
-- it under the terms of the GNU General Public License as published by
-- the Free Software Foundation, either version 3 of the License, or
-- (at your option) any later version.
--
-- This program is distributed in the hope that it will be useful,
-- but WITHOUT ANY WARRANTY; without even the implied warranty of
-- MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
-- GNU General Public License for more details.
--
-- You should have received a copy of the GNU General Public License
-- along with this program.  If not, see <http://www.gnu.org/licenses/>.

--
-- Contenu de la table `llx_cstmd_referentiels`
--
INSERT INTO `llx_cstmd_referentiels` VALUES(1, 'CSTMD');
INSERT INTO `llx_cstmd_referentiels` VALUES(2, 'Sureté');
INSERT INTO `llx_cstmd_referentiels` VALUES(3, '14001');

--
-- Contenu de la table `llx_cstmd_chapitres`
--

INSERT INTO `llx_cstmd_chapitres` VALUES(1, '5.1', 'Les	procédés	visant	au	respect	des	règles	relatives	à	l\'identification des	marchandises	dangereuses	transportées', 1);
INSERT INTO `llx_cstmd_chapitres` VALUES(2, '5.2', 'La	 pratique	 de	 l’entreprise	 concernant	 la	 prise	 en	 compte	 dans	l’achat	 des	 moyens	 de	 transport	 de	 tout	 besoin	 particulier	 relatif	 aux	marchandises	dangereuses	transportées', 1);
INSERT INTO `llx_cstmd_chapitres` VALUES(3, '5.3', 'Les	 procédés	 permeeant	 de	 vérifier	 le	 matériel	 utilisé	 pour	 le	transport	 de	 matières	 dangereuses	 ou	 pour	 les	 opérations	 de	chargement	ou	de	déchargement', 1);
INSERT INTO `llx_cstmd_chapitres` VALUES(4, '5.4', 'Le	 fait	 que	 les	 employés	 concernés	 de	 l’entreprise	 ont	 reçu	 une formation	 appropriée,	 y	 compris	 à	 propos	 des	 modifications	 à	 la	réglementation,	et	que	ceee	formation	est	inscrite	sur	leur	dossier', 1);
INSERT INTO `llx_cstmd_chapitres` VALUES(5, '5.5', 'La	 mise	 en	 œuvre	 de	 procédures	 d’urgence	 appropriées	 aux	accidents	 ou	 incidents	 éventuels	 pouvant	 porter	 aeeinte	 à	 la	 sécurité	pendant	 le	 transport	 de	 marchandises	 dangereuses	 ou	 pendant	 les	opérations	de	chargement	ou	de	déchargement', 1);
INSERT INTO `llx_cstmd_chapitres` VALUES(6, '5.6', 'Le	recours	à	des	analyses	et,	si	nécessaire,	la	rédaction	de	rapports	concernant	 les	 accidents,	 les	 incidents	 ou	 les	 infractions	 graves	constatés	 au	 cours	 du	 transport	 de	 marchandises	 dangereuses	 ou	pendant	les	opérations	de	chargement	ou	de	déchargement', 1);
INSERT INTO `llx_cstmd_chapitres` VALUES(7, '5.7', 'La	mise	en	place	de	mesures	appropriées	pour	éviter	la	répétition	d’accidents,	d’incidents	ou	d’infractions	graves', 1);
INSERT INTO `llx_cstmd_chapitres` VALUES(8, '5.8', 'La	 prise	 en	 compte	 des	 prescriptions	 législatives	 et	 des	 besoins	particuliers	 relatifs	 au	 transport	 de	 marchandises	 dangereuses	concernant	 le	 choix	 et	 l’utilisation	 de	 sous-traitants	 ou	 autres	intervenants', 1);
INSERT INTO `llx_cstmd_chapitres` VALUES(9, '5.9', 'La	 vérification	 que	 le	 personnel	 affecté	 au	 transport	 des	marchandises	dangereuses,	au	chargement	ou	au	déchargement	de	ces	marchandises	 dispose	 de	 procédures	 d’exécution	 et	 de	 consignes	détaillées', 1);
INSERT INTO `llx_cstmd_chapitres` VALUES(10, '5.10', 'La	mise	en	place	d’actions	pour	la	sensibilisation	aux	risques	liés	au	transport	 des	 marchandises	 dangereuses,	 au	 chargement	 ou	 au	déchargement	de	ces	dernières', 1);
INSERT INTO `llx_cstmd_chapitres` VALUES(11, '5.11', 'La	 mise	 en	 place	 de	 procédés	 de	 vérification	 afin	 d’assurer	 la	présence,	 à	 bord	 des	 moyens	 de	 transport,	 des	 documents	 et	 des	équipements	 de	 sécurité	 devant	 accompagner	 les	 transports	 et	 la	conformité	 de	 ces	 documents	 et	 de	 ces	 équipements	 avec	 la	réglementation', 1);
INSERT INTO `llx_cstmd_chapitres` VALUES(12, '5.12', 'La	 mise	 en	 place	 de	 procédés	 de	 vérification	 afin	 d’assurer	 le	respect	des	prescriptions	relatives	aux	opérations	de	chargement	et	de	déchargement', 1);
INSERT INTO `llx_cstmd_chapitres` VALUES(13, '5.13', 'L’existence	du	plan	de	sûreté	prévu	au	1.10.3.2', 1);

--
-- Contenu de la table `llx_cstmd_questions`
--

    -- 5.1 --
INSERT INTO `llx_cstmd_questions` VALUES(1, '5.1.1', 'Gestion des fiches	de données de sécurité', 'Les	FDS	des	produits	transportés	sont	conservées	dans	l’entreprise.	Une	mise	\nà	jour	régulière	est	effectuée.', null, null, null, null, 1, 0);
INSERT INTO `llx_cstmd_questions` VALUES(2, '5.1.2', 'Classification	ONU	des	produits', 'Les	 produits	 sont	 en	 classe	 3,	 GE	 II	 et	 GE	 III.	 Ils	 possèdent	 un	 danger	\nsecondaire	«	polluant	pour	l’environnement	».', null, null, null, null, 1, 0);
INSERT INTO `llx_cstmd_questions` VALUES(3, '5.1.3', 'Classification	des	déchets', 'Non	applicable.', null, null, null, null, 1, 0);
INSERT INTO `llx_cstmd_questions` VALUES(4, '5.1.4', 'Quantification	des	activités	et	communication	au	CSTMD', 'Les	quantités	de	MD	transportées	devront	être	communiquées	au	CSTMD.	\nFait	le	04	avril	2017.', null, null, null, null, 1, 0);
    -- 5.2 --
INSERT INTO `llx_cstmd_questions` VALUES(5, '5.2.1', 'Choix	et	achats	des	véhicules	et	moyens	de	transport', 'Les	 véhicules	 sont	 équipés	 ADR-FL	 (transport	 de	 liquides	 inflammables	 en	\nciterne).', null, null, null, null, 2, 0);
INSERT INTO `llx_cstmd_questions` VALUES(6, '5.2.2', 'Contrôle	de	conformité	après	/	avant	l’achat', 'N/A', null, null, null, null, 2, 0);
INSERT INTO `llx_cstmd_questions` VALUES(7, '5.2.3', 'Achats	des	accessoires	(flexibles,)', 'Les	flexibles	achetées	sont	conformes	à	l’appendice	IV	de	l’arrêté	TMD', null, null, null, null, 2, 0);
INSERT INTO `llx_cstmd_questions` VALUES(8, '5.2.4', 'Choix	et	achat	des	emballages,	fabricants	agréés', 'Les	marchandises	dangereuses	transportées	sont	exclusivement	des	liquides	\ninflammables	en	citerne.	Ce	point	n’est	donc	pas	applicable	à	l’entreprise.', null, null, null, null, 2, 0);
INSERT INTO `llx_cstmd_questions` VALUES(9, '5.2.5', 'Présence	du	certificat	de	conformité', 'Non	applicable	(transports	en	citerne).', null, null, null, null, 2, 0);
INSERT INTO `llx_cstmd_questions` VALUES(10, '5.2.6', 'Marquage	et	étiquetage	des	emballages', 'Non	applicable	(transports	en	citerne).', null, null, null, null, 2, 0);
INSERT INTO `llx_cstmd_questions` VALUES(11, '5.2.7', 'Utilisations	de	"suremballage"', 'N/A\n', null, null, null, null, 2, 0);
INSERT INTO `llx_cstmd_questions` VALUES(12, '5.2.8', 'Conditionnements	suivant	une	disposition	spéciale', 'N/A', null, null, null, null, 2, 0);
INSERT INTO `llx_cstmd_questions` VALUES(13, '5.2.9', 'Conditionnement	"en	quantités	limitées"', 'N/A', null, null, null, null, 2, 0);
INSERT INTO `llx_cstmd_questions` VALUES(14, '5.2.10', 'Conditionnement	"en	quantités	exceptées"', 'N/A', null, null, null, null, 2, 0);
	-- 5.3 --
INSERT INTO `llx_cstmd_questions` VALUES(15, '5.3.1', 'Contrôle	de	l’état	des	véhicules', 'Un	contrôle	technique	est	effectué	tous	les	ans.	\nUne	trace	écrite	est	conservée	dans	le	carnet	d’entretien	du	véhicule.	\nUn	tableau	informatique	permet	le	suivi	de	ces	échéances.', null, null, null, null, 3, 0);
INSERT INTO `llx_cstmd_questions` VALUES(16, '5.3.2', 'Contrôle	de	la	conformité	des	extincteurs', 'Contrôle	annuel	des	extincteurs', null, null, null, null, 3, 0);
INSERT INTO `llx_cstmd_questions` VALUES(17, '5.3.3', 'Vérification	des	moyens	de	manutention	', 'N/A', null, null, null, null, 3, 0);
INSERT INTO `llx_cstmd_questions` VALUES(18, '5.3.4', 'Contrôles	des	emballages	avant	expéditions', 'N/A', null, null, null, null, 3, 0);
INSERT INTO `llx_cstmd_questions` VALUES(19, '5.3.5', 'Contrôles	administratifs	des	conducteurs	au	chargement', 'N/A', null, null, null, null, 3, 0);
INSERT INTO `llx_cstmd_questions` VALUES(20, '5.3.6', 'Contrôles	administratifs	des	véhicules	au	chargement', 'Non	applicable.', null, null, null, null, 3, 0);
INSERT INTO `llx_cstmd_questions` VALUES(21, '5.3.7', 'Protocole	de	sécurité', 'Clients	 «	 industriel	 »	 :	 L’entreprise	 prend	 en	 compte	 les	 protocoles	 de	\nsécurité	qui	lui	sont	communiqués	par	les	entreprises	où	elle	livre.	Elle	en	\nconserve	 un	 exemplaire	 et	 les	 communique	 aux	 conducteurs	 lors	 de	 leurs	\nmissions	sur	les	sites	concernées.\nStation	service	:	un	«	annuaire	»	des	protocoles	de	livraisons	avec	plan	de	\nchaque	site	a	été	constitué	et	transmis	aux	conducteurs.', null, null, null, null, 3, 0);
INSERT INTO `llx_cstmd_questions` VALUES(22, '5.3.8', 'Contrôles	des	équipements	des	véhicules	au	chargement', 'Des	contrôles	sont	effectués	de	façon	aléatoire	par	les	dépôts	de	la	SARA	lors	\ndes	chargements', null, null, null, null, 3, 0);
INSERT INTO `llx_cstmd_questions` VALUES(23, '5.3.9', 'Contrôles	des	équipements	de	chargement	/	déchargement', 'N/A', null, null, null, null, 3, 0);
INSERT INTO `llx_cstmd_questions` VALUES(24, '5.3.10', 'Contrôles	des	accessoires	(notamment	des	flexibles)', 'Un	suivi	de	flexibles	de	dépotages	est	réalisé	par	l’entreprise	:	les	fiches	de	\nsuivis	sont	renseignées	et	se	trouvent	à	bord	des	véhicules.', null, null, null, null, 3, 0);
INSERT INTO `llx_cstmd_questions` VALUES(25, '5.3.11', 'Respect	 des	 interdictions	 de	 chargement	 en	 commun	 (explosif,	\nalimentaire...)', 'Non	applicable	à	l’activité	:	transports	de	produits	compatibles.', null, null, null, null, 3, 0);
INSERT INTO `llx_cstmd_questions` VALUES(26, '5.3.12', 'Empotage	de	conteneur', 'N/A', null, null, null, null, 3, 0);
INSERT INTO `llx_cstmd_questions` VALUES(27, '5.3.13', 'Contrôle	du	chargement,	arrimage	et	calage', 'N/A', null, null, null, null, 3, 0);
INSERT INTO `llx_cstmd_questions` VALUES(28, '5.3.14', 'Contrôle	de	la	citerne	avant	chargement/déchargement', 'Un	contrôle	visuel	est	effectué	par	les	conducteurs.', null, null, null, null, 3, 0);
INSERT INTO `llx_cstmd_questions` VALUES(29, '5.3.15', 'Contrôle	de	la	citerne	après	chargement/déchargement', 'Un	contrôle	visuel	est	effectué	par	les	conducteurs. ', null, null, null, null, 3, 0);
INSERT INTO `llx_cstmd_questions` VALUES(30, '5.3.16', 'Gestion	des	seuils	d’application	de	la	réglementation', 'Non	applicable	en	citerne.', null, null, null, null, 3, 0);
INSERT INTO `llx_cstmd_questions` VALUES(31, '5.3.17', 'Contrôle	du	matériel	incendie,	sécurité	et	«	environnement	»	sur	\nsite	de	chargement	/	déchargement', 'N/A', null, null, null, null, 3, 0);
INSERT INTO `llx_cstmd_questions` VALUES(32, '5.3.18', 'Conformité	des	aires	de	chargement	/	déchargement	-	accès	aux	\ndômes	de	citernes', 'N/A', null, null, null, null, 3, 0);
	-- 5.4 --
INSERT INTO `llx_cstmd_questions` VALUES(33, '5.4.1', 'Formation	obligatoire	des	personnels	autre	que	les	conducteurs', 'Le	responsable	du	suivi	de	l’activité	est	titulaire	de	la	formation	ADR	de	Base	\net	de	la	spécialisation	citerne,	ce	qui	est	supérieur	à	la	formation	ADR	1.3.', null, null, null, null, 4, 0);
INSERT INTO `llx_cstmd_questions` VALUES(34, '5.4.2', 'Formation	des	conducteurs	transports	exemptés	(1.1.3.6	/	LQ	-	QE)', 'N/A', null, null, null, null, 4, 0);
INSERT INTO `llx_cstmd_questions` VALUES(35, '5.4.3', "Formation	des	conducteurs	hors	exemption", "L’entreprise	 dispose	 de	 8	 conducteurs.	 Un	 tableau	 de	 suivi	 qui	 permet	 le	\nsuivi	 de	 l\'ensemble	 des	 formations	 et	 visites	 obligatoires	 (Formation	 Air	\nBase;	Formation	citerne,	FCO,	Validité	du	Permis	de	conduire,	Formation	aux	\ninstallations	automatique).	\nUne	 copie	 de	 l\'ensemble	 des	 documents	 concernant	 les	 formations	\n(notamment	les	ajestations)	se	trouve	dans	le	dossier	du	personnel.", null, null, null, null, 4, 0);
INSERT INTO `llx_cstmd_questions` VALUES(36, '5.4.4', 'Formation	"engins	de	manutention"', 'N/A', null, null, null, null, 4, 0);
INSERT INTO `llx_cstmd_questions` VALUES(37, '5.4.5', "Formation	à	l\'accès	aux	dômes	de	citerne", "Les	conducteurs	ont	interdictions	d’accéder	aux	dômes	des	citernes.", null, null, null, null, 4, 0);
INSERT INTO `llx_cstmd_questions` VALUES(38, '5.4.6', 'Autre	formation	liée	aux	opérations	de	chargement	/	déchargement', 'N/A', null, null, null, null, 4, 0);
INSERT INTO `llx_cstmd_questions` VALUES(39, '5.4.7', 'Formation	aux	installations	automatiques', 'Ceje	formation	a	été	faite	par	la	SARA.', null, null, null, null, 4, 0);
INSERT INTO `llx_cstmd_questions` VALUES(40, '5.4.8', 'Formation	pour	les	experts	selon	le	chapitre	8.2	de	l’ADN', 'N/A', null, null, null, null, 4, 0);
INSERT INTO `llx_cstmd_questions` VALUES(41, '5.4.9', 'Formation	à	la	radioprotection', 'N/A', null, null, null, null, 4, 0);
	-- 5.5 --
INSERT INTO `llx_cstmd_questions` VALUES(42, '5.5.1', '	Identification	des	situations	à	risques', 'Les	situations	à	risques	ont	été	identifiées	dans	le	cadre	du	SME.', null, null, null, null, 5, 0);
INSERT INTO `llx_cstmd_questions` VALUES(43, '5.5.2', 'Identification	et	contrôles	des	moyens	d’interventions', 'N/A', null, null, null, null, 5, 0);
INSERT INTO `llx_cstmd_questions` VALUES(44, '5.5.3', 'Procédures	d’urgence	en	cas	d\'accident	/	test	de	la	procédures', 'La	 gestion	 des	 situations	 d’urgence	 est	 reprise	 dans	 le	 système	\nenvironnemental.', null, null, null, null, 5, 0);
INSERT INTO `llx_cstmd_questions` VALUES(45, '5.5.4', 'Intégration	du	scénario	accidents	TMD	dans	la	gestion	des	situations	\nd’urgence', 'La	 gestion	 des	 situations	 d’urgence	 est	 reprise	 dans	 le	 système	\nenvironnemental.', null, null, null, null, 5, 0);
INSERT INTO `llx_cstmd_questions` VALUES(46, '5.5.5', 'Avis	à	diffuser	aux	secours', 'En	cas	d’accident,	les	secours	doivent	être	prévenus	et	informés	:	\n-	du	lieu	et	la	nature	de	l’accident	;	\n-	des	caractéristiques	des	marchandises	transportées	(s’il	y	a	lieu	les	\nconsignes	particulières	\nd’intervention	ainsi	que	les	agents	d’extinction	prohibés)	;	\n-	de	l’importance	des	dommages	;	\n-	plus	généralement	de	toutes	précisions	permejant	d’estimer	\nl’importance	du	risque	et	de	décider	de	l’ampleur	des	secours	à	mejre	\nen	œuvre.', null, null, null, null, 5, 0);
INSERT INTO `llx_cstmd_questions` VALUES(47, '5.5.6', 'Procédure	de	sécurité	à	l’usage	du	conducteur', 'Les	 véhicules	 sont	 tous	 équipés	 de	 moyens	 de	 télécommunication	\n(Téléphones	portables).	\nLes	conducteurs	ont	le	téléphone	de	l’entreprise	pour	les	cas	d’urgence.	Lors	\ndu	stationnement,	un	n°	de	téléphone	à	joindre	en	cas	d’urgence	est	visible	\nde	l’extérieur	du	véhicule.	\nDe	 nombreuses	 consignes	 sont	 données	 verbalement	 et	 par	 notes	 de	\nservices	aux	conducteurs.	\nUn	manuel	du	conducteur	reprend	l’ensemble	des	consignes.', null, null, null, null, 5, 0);
INSERT INTO `llx_cstmd_questions` VALUES(48, '5.5.7', 'Information	du	personnel	concerné	sur	les	procédures	d’urgences', 'Les	procédures	d’urgences	sont	reprises	dans	le	manuel	remis	à	chacun	des	\nconducteurs.', null, null, null, null, 5, 0);
INSERT INTO `llx_cstmd_questions` VALUES(49, '5.5.8', 'Formation	du	personnel	d’intervention', 'N/A', null, null, null, null, 5, 0);
INSERT INTO `llx_cstmd_questions` VALUES(50, '5.5.9', 'Autres	procédures	de	sécurité', 'N/A', null, null, null, null, 5, 0);
	-- 5.6 --
INSERT INTO `llx_cstmd_questions` VALUES(51, '5.6.1', 'Information	du	CSTMD	en	cas	d’accidents	/	Incidents', 'Pas	d’accidents	ou	d’incidents	en	2016.', null, null, null, null, 6, 0);
INSERT INTO `llx_cstmd_questions` VALUES(52, '5.6.2', 'Collecte	des	informations	sur	les	accidents	et	incidents	', 'En	cas	d’accident	le	CSTMD	serait	informé	des	circonstances	par	l’entreprise.', null, null, null, null, 6, 0);
INSERT INTO `llx_cstmd_questions` VALUES(53, '5.6.3', 'Méthodes	d’analyse	des	causes', 'Le	conseiller	à	la	sécurité	procéderait	à	l’analyse	des	causes	par	la	méthode	\nde	l’arbre	des	causes.', null, null, null, null, 6, 0);
INSERT INTO `llx_cstmd_questions` VALUES(54, '5.6.4', 'Déclaration	d\'accidents', 'Une	déclaration	doit	être	faite	dans	les	cas	suivant		(délais	d’un	mois)	\n• Evénements	corporels:	décès	ou	blessures	entraînant	un	traitement	\nmédical	intensif,	un	séjour	à	l\'hôpital	d\'au	moins	une	journée	ou	une	\nincapacité	de	travailler	pendant	au	moins	trois	jours	consécutifs;	\n• Pour	les	pertes	de	produits:	marchandises	dangereuses	répandues	ou	\navec	risque	imminent	de	perte	quelque	soit	la	quantité	pour	la	classe	\n6.2;	en	quantités	supérieures	à	50,	333	ou	1000	litres	ou	kg,	en	fonction	\ndes	 catégories	 de	 transport	 (0	 et	 1,	 2,	 3	 et	 4).	 Il	 existe	 des	 critères	\nspécifiques	pour	la	classe	7;	\n• Dommages	 matériels:	 50	 000	 €	 sans	 tenir	 compte	 des	 dommages	 du	\nvéhicule	\n• Intervention	 des	 autorités:	 intervention	 directe	 des	 autorités	 ou	 des	\nsecours,	 évacuation	 de	 personnes	 ou	 fermeture	 d\'infrastructures	 de	\ntransport	pendant	au	moins	3	heures.', null, null, null, null, 6, 0);
	-- 5.7 --
INSERT INTO `llx_cstmd_questions` VALUES(55, '5.7.1', 'Établissement	et	suivi	de	plan	d’action	pour	les	actions	correctives', 'Les	actions	correctives	suite	à	des	incidents	seraient	formalisées	par	un	plan	\nd’action	qui	en	permejent	le	suivi.', null, null, null, null, 7, 0);
INSERT INTO `llx_cstmd_questions` VALUES(56, '5.7.2', 'Exploitation	des	retours	d’expérience	(statistique,)', 'La	 société	 Sol	 possède	 une	 solide	 culture	 d’exploitation	 des	 retours	\nd’expériences.', null, null, null, null, 7, 0);
INSERT INTO `llx_cstmd_questions` VALUES(57, '5.7.3', 'Gestions	des	infractions	TMD', 'Aucune	infraction	concernant	des	TMD	n’a	été	relevée	en	2016.', null, null, null, null, 7, 0);
	-- 5.8 --
INSERT INTO `llx_cstmd_questions` VALUES(58, '5.8.1', 'Sous-traitance	"classification	des	matières"', 'N/A', null, null, null, null, 8, 0);
INSERT INTO `llx_cstmd_questions` VALUES(59, '5.8.2', 'Sous-traitance	transport	(identification	et	contrôle	des	prestataires)', 'L’entreprise	 utilise	 à	 titre	 occasionnel	 quelques	 sous-traitants	 :	 il	 s’agit	\nprincipalement	 de	 disposer	 de	 matériels	 plus	 adaptés	 (Porteurs)	 pour	 des	\nlivraisons	sur	des	sites	particuliers	où	l’accès	en	semi-remorque	est	difficile.	\nUn	 audit	 annuel	 et	 une	 vérification	 des	 procédures	 des	 sous-traitants	 est	\neffectués.', null, null, null, null, 8, 0);
INSERT INTO `llx_cstmd_questions` VALUES(60, '5.8.3', 'Sous-traitance	"Gestions	des	déchets	dangereux"', 'N/A', null, null, null, null, 8, 0);
INSERT INTO `llx_cstmd_questions` VALUES(61, '5.8.4', 'Sous-traitance	"contrôles	d\'accès	au	site"	et/	ou	"contrôle	des	\nvéhicules"', 'N/A', null, null, null, null, 8, 0);
	-- 5.9 --
INSERT INTO `llx_cstmd_questions` VALUES(62, '5.9.1', 'Présence	«	d’un	manuel	conducteur	»', 'Un	manuel	de	consignes	reprend	la	réglementation	applicable	et	certaines	\nconsignes	de	l’entreprise.', null, null, null, null, 9, 0);
INSERT INTO `llx_cstmd_questions` VALUES(63, '5.9.2', 'Procédure	ou	consignes	de	réception	et	d’expédition', 'N/A', null, null, null, null, 9, 0);
INSERT INTO `llx_cstmd_questions` VALUES(64, '5.9.3', 'Procédure	ou	consignes	de	rédaction	des	documents	de	transports', 'N/A', null, null, null, null, 9, 0);
INSERT INTO `llx_cstmd_questions` VALUES(65, '5.9.4', 'Consignes	de	port	des	EPI	sur	site	de	chargement	/	déchargement', 'Les	conducteurs	portent	les	équipements	de	protections	individuels	prévus	\npar	les	consignes	de	sécurité	des	sites	de	chargement.	\nLes	conducteurs	sont	équipés	de	tenues	ATEX	haute	visibilité.', null, null, null, null, 9, 0);
INSERT INTO `llx_cstmd_questions` VALUES(66, '5.9.5', 'Procédure	de	chargement	/	déchargement', 'Procédures	incluses	dans	le	Manuel	de	consignes.', null, null, null, null, 9, 0);
	-- 5.10 --
INSERT INTO `llx_cstmd_questions` VALUES(67, '5.10.1', 'Sensibilisation	aux	risques	chimiques', 'Ceje	sensibilisation	est	faite	par	les	organismes	de	formation	(incluse	dans	\nla	formation	ADR	de	base	et	spécialisation	citerne)', null, null, null, null, 10, 0);
INSERT INTO `llx_cstmd_questions` VALUES(68, '5.10.2', 'Autre	sensibilisation	aux	risques', 'Cf	ci-desssus', null, null, null, null, 10, 0);
INSERT INTO `llx_cstmd_questions` VALUES(69, '5.10.3', 'Causeries	sécurité', 'Des	entretiens	avec	les	conducteurs	sont	régulièrement	fait	sous	forme	de	\n«	causeries	sécurité	»	(Toolbox).', null, null, null, null, 10, 0);
INSERT INTO `llx_cstmd_questions` VALUES(70, '5.10.4', 'Exercices	incendies', 'Des	exercices	incendies	sont	réalisés	lors	des	formations	ADR.	Des	exercices	\nsont	également	organisés	par	les	dépôts	pétroliers	(SARA).', null, null, null, null, 10, 0);
INSERT INTO `llx_cstmd_questions` VALUES(71, '5.10.5', 'Autre	exercice	de	sécurité', 'N/A', null, null, null, null, 10, 0);
	-- 5.11 --
INSERT INTO `llx_cstmd_questions` VALUES(72, '5.11.1', 'Document	de	transport	ADR', 'Les	 documents	 de	 transports	 ADR	 sont	 données	 par	 les	 dépôts	 pétroliers	\n(Tickets	en	Guadeloupe,	documents	format	A4	en	Martinique).', null, null, null, null, 11, 0);
INSERT INTO `llx_cstmd_questions` VALUES(73, '5.11.2', 'Document	spécifique	Déchets	(Dangereux,	amiantes,	DASRI)', 'N/A', null, null, null, null, 11, 0);
INSERT INTO `llx_cstmd_questions` VALUES(74, '5.11.3', 'Consignes	écrites	selon	le	chapitre	5.4.3', 'La	 consigne	 ADR	 est	 dans	 les	 véhicules.	 Elle	 a	 évolué	 en	 2017.	 A	 meere	\ndans	 les	 véhicules	 avec	 Quizz	 de	 «	 prise	 en	 compte	 »	 transmis	 par	 le	\nCSTMD.	 Fait	 le	 23	 janvier	 2017	 en	 Guadeloupe	 et	 le	 10/02/2017	 en	\nMartinique.', null, null, null, null, 11, 0);
INSERT INTO `llx_cstmd_questions` VALUES(75, '5.11.4', 'Pièces	d’identité	du	conducteur', 'Les	conducteurs	ont	leurs	permis	de	conduire	à	bord	du	véhicule.', null, null, null, null, 11, 0);
INSERT INTO `llx_cstmd_questions` VALUES(76, '5.11.5', 'Fiches	de	suivi	des	flexibles	de	dépotage', 'Les	flexibles	sont	contrôlés	annuellement	:	ces	contrôles	sont	consignés	dans	\ndes	fiches	de	suivis.	Ces	fiches	se	trouvent	à	bord	des	véhicules', null, null, null, null, 11, 0);
INSERT INTO `llx_cstmd_questions` VALUES(77, '5.11.6', 'Certificat	d\'agrément	des	véhicules	(Citerne	/	Classe	1)', 'Les	 certificats	 d’agrément	 des	 citernes	 se	 trouvent	 à	 bord	 des	 véhicules.	\ncependant,	 lors	 de	 la	 visite	 du	 CSTMD	 en	 Martinique,	 nous	 avons	 constaté	\nque	 les	 documents	 originaux	 n’étaient	 pas	 à	 bord	 des	 véhicules,	 qu’un	\nvéhicule	 n’avaient	 pas	 de	 documents	 à	 bord	 (ni	 copie,	 ni	 originaux).	 Fait	 le	\n10/02/2017.	', null, null, null, null, 11, 0);
INSERT INTO `llx_cstmd_questions` VALUES(78, '5.11.6', 'Certificat	d\'agrément	des	véhicules	(Citerne	/	Classe	1)', 'De	 plus,	 sur	 tous	 les	 véhicules	 de	 l’entreprise,	 les	 licences	 de	 transports	\ndélivrées	 par	 la	 DEAL	 sont	 des	 licence	 «	 voyageurs	 »	 et	 non	\n«	marchandises	»	:	il	faudra	se	rapprocher	de	la	DEAL	pour	faire	modifier	\nces	documents.	Fait	le	29/03/2017.', null, null, null, null, 11, 0);
INSERT INTO `llx_cstmd_questions` VALUES(79, '5.11.7', 'Récépissé	de	déclaration	de	transports	de	déchets', 'N/A', null, null, null, null, 11, 0);
INSERT INTO `llx_cstmd_questions` VALUES(80, '5.11.8', 'Agréments	et	documents	spécifiques	"classe	7"', 'N/A', null, null, null, null, 11, 0);
INSERT INTO `llx_cstmd_questions` VALUES(81, '5.11.9', 'Équipements	divers	des	véhicules', 'Un	 contrôle	 de	 la	 présence	 de	 ces	 équipements,	 de	 son	 état	 et	 du	\nfonctionnement	des	lampes	est	régulièrement	effectué	par	Monsieur	ALTIS.	\nLors	 de	 la	 visite	 du	 CSTMD,	 nous	 avons	 constaté	 l’absence	 de	 marquage	\nATEX	sur	les	lampes	de	poches.', null, null, null, null, 11, 0);
INSERT INTO `llx_cstmd_questions` VALUES(82, '5.11.10', 'Signalisation	des	véhicules', 'Les	véhicules	sont	signalés	à	l’aide	des	panneaux	orange	numérotés	et	des	\nétiquejes	 n°3	 et	 dangereux	 pour	 l’environnement.	 Cependant,	 lors	 de	 la	\nvisite	du	CSTMD,	les	panneaux	oranges	et	étiqueees	de	dangers	étaient	un	\npeu	 «	 défraichis	 ».	 Le	 système	 «	 anti-renversement	 »	 étaient	 absent	 et	\ncertains	 véhicules	 n’avaient	 pas	 toutes	 les	 étiqueees	 de	 dangers.	 des	\npanneaux	et	plaques	étiqueees	peuvent	sont	disponibles	sur	le	site	:	il	faut	\nmaintenant	les	meere	en	place.', null, null, null, null, 11, 0);
	-- 5.12 --
INSERT INTO `llx_cstmd_questions` VALUES(83, '5.12.1', 'Traçabilité	des	contrôles	effectués	(Check-list)', 'Des	 vérifications	 sont	 effectuées	 régulièrement	 sur	 les	 véhicules.	\nL’utilisation	 d’une	 check-liste	 permeeant	 de	 démontrer	 de	 la	 conformité	\ndes	véhicules	serait	souhaitable.	Fait	par	les	conducteurs.	\nDes	contrôles	supplémentaires	sont	effectués	par	les	dépôts	avant	de	rentrer	\nsur	les	sites	de	chargement.', null, null, null, null, 12, 0);
INSERT INTO `llx_cstmd_questions` VALUES(84, '5.12.2', 'Organisation,	planification	et	formalisation	des	audits	internes', 'Un	audit	annuel	est	réalisé	par	le	CSTMD.	Des	vérifications	sont	effectuées	\nrégulièrement	par	Monsieur	ALTIS.', null, null, null, null, 12, 0);
INSERT INTO `llx_cstmd_questions` VALUES(85, '5.12.3', 'Qualification	du	personnel	d\'audit	interne', 'Le	CSTMD	est	qualifié	par	le	CIFMD.', null, null, null, null, 12, 0);
INSERT INTO `llx_cstmd_questions` VALUES(86, '5.12.4', 'Suivi	de	l\'activité	des	conducteurs', 'L’activité	des	conducteurs	est	suivi	au	quotidien	:	une	ajention	particulière	\nest	portée	au	respect	de	la	réglementation	sociale	européenne	(RSE)	(temps	\nde	conduite,	repos,	…)	et	à	la	vitesse.', null, null, null, null, 12, 0);
	-- 5.13 --
INSERT INTO `llx_cstmd_questions` VALUES(87, '5.13.1', 'Identification	des	marchandises	à	haut	risque', 'L’entreprise	est	soumise	à	l’obligation	de	mejre	en	place	un	plan	de	sûreté	\n(UN	1203	en	citerne	de	plus	de	3000	litres).\nConformément	au	Guide	CIFMD	du	15	juin	2005	(modifié	2016)	sur	la	sûreté	\ndes	transports	de	marchandises	dangereuses,	une	évaluation	des	risques	liés	\nà	la	sûreté	aux	cours	des	différentes	phases	de	transport	a	été	effectuée	par	\nle	conseiller	à	la	sécurité.', null, null, null, null, 13, 0);
INSERT INTO `llx_cstmd_questions` VALUES(88, '5.13.2', 'Établissement	du	plan	de	sûreté', 'Un	plan	de	sûreté	au	sens	du	chapitre	1.10	de	l’ADR	a	été	mis	en	place.', null, null, null, null, 13, 0);
INSERT INTO `llx_cstmd_questions` VALUES(89, '5.13.3', 'Responsabilité	en	matière	de	sûreté', 'N/A', null, null, null, null, 13, 0);
INSERT INTO `llx_cstmd_questions` VALUES(90, '5.13.4', 'Mesure	générale	de	sûreté	(hors	MD	haut	risque)	-	Formation', 'Les	conducteurs	ont	été	sensibilisés	à	la	sûreté. ', null, null, null, null, 13, 0);
INSERT INTO `llx_cstmd_questions` VALUES(91, '5.13.5', 'Mesure	générale	de	sûreté	(hors	MD	haut	risque)	-	Identification	\ndes	transporteurs', 'Les	conducteurs	ont	une	pièce	d’identité	avec	photographie	sur	eux.', null, null, null, null, 13, 0);
INSERT INTO `llx_cstmd_questions` VALUES(92, '5.13.6', 'Mesure	générale	de	sûreté	(hors	MD	haut	risque)	-	Sécurisation	des	\ndépôts	de	véhicules', 'Les	 véhicules	 sont	 garés	 sur	 des	 parkings	 sécurisés	 dans	 la	 mesure	 du	\npossible.', null, null, null, null, 13, 0);
INSERT INTO `llx_cstmd_questions` VALUES(93, '5.13.7', 'Mesure	générale	de	sûreté	(hors	MD	haut	risque)	-	Document	\nd\'identification	des	conducteurs', 'Les	conducteurs	ont	une	pièce	d’identité	avec	photographie.', null, null, null, null, 13, 0);