-- phpMyAdmin SQL Dump
-- version 4.2.12deb2+deb8u3
-- http://www.phpmyadmin.net
--
-- Client :  localhost
-- Généré le :  Lun 23 Septembre 2019 à 14:38
-- Version du serveur :  5.5.60-0+deb8u1
-- Version de PHP :  5.6.38-0+deb8u1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de données :  `dbremsecurite`
--

-- --------------------------------------------------------

--
-- Structure de la table `llxhu_cstmd_questions`
--

CREATE TABLE IF NOT EXISTS `llxhu_cstmd_questions` (
`rowid` int(11) NOT NULL,
  `position` varchar(45) DEFAULT NULL,
  `label_question` varchar(1200) DEFAULT NULL,
  `texte_reglementaire` varchar(1200) DEFAULT NULL,
  `etat_lieux` varchar(500) DEFAULT NULL,
  `titre_recommandation` varchar(500) DEFAULT NULL,
  `recommandation` varchar(500) DEFAULT NULL,
  `reference` varchar(500) DEFAULT NULL,
  `fk_chapitre_id` int(11) NOT NULL,
  `type` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB AUTO_INCREMENT=94 DEFAULT CHARSET=utf8;

--
-- Contenu de la table `llxhu_cstmd_questions`
--

INSERT INTO `llxhu_cstmd_questions` (`rowid`, `position`, `label_question`, `texte_reglementaire`, `etat_lieux`, `titre_recommandation`, `recommandation`, `reference`, `fk_chapitre_id`, `type`) VALUES
(1, '5.1.1', 'Gestion des fiches	de données de sécurité', '', '', '', '', NULL, 1, 0),
(2, '5.1.2', 'Classification	ONU	des	produits', '', '', '', '', NULL, 1, 0),
(3, '5.1.3', 'Classification	des	déchets', '', '', '', '', NULL, 1, 0),
(4, '5.1.4', 'Quantification	des	activités	et	communication	au	CSTMD', '', '', '', '', NULL, 1, 0),
(5, '5.2.1', 'Choix	et	achats	des	véhicules	et	moyens	de	transport', '', '', '', '', NULL, 2, 0),
(6, '5.2.2', 'Contrôle	de	conformité	après	/	avant	l’achat', '', '', '', '', NULL, 2, 0),
(7, '5.2.3', 'Achats	des	accessoires	(flexibles,)', '', '', '', '', NULL, 2, 0),
(8, '5.2.4', 'Choix	et	achat	des	emballages,	fabricants	agréés', '', '', '', '', NULL, 2, 0),
(9, '5.2.5', 'Présence	du	certificat	de	conformité', '', '', '', '', NULL, 2, 0),
(10, '5.2.6', 'Marquage	et	étiquetage	des	emballages', '', '', '', '', NULL, 2, 0),
(11, '5.2.7', 'Utilisations	de	"suremballage"', '', '', '', '', NULL, 2, 0),
(12, '5.2.8', 'Conditionnements	suivant	une	disposition	spéciale', '', '', '', '', NULL, 2, 0),
(13, '5.2.9', 'Conditionnement	"en	quantités	limitées"', '', '', '', '', NULL, 2, 0),
(14, '5.2.10', 'Conditionnement	"en	quantités	exceptées"', '', '', '', '', NULL, 2, 0),
(15, '5.3.1', 'Contrôle	de	l''état	des	véhicules', '', '', '', '', NULL, 3, 0),
(16, '5.3.2', 'Contrôle	de	la	conformité	des	extincteurs', '', '', '', '', NULL, 3, 0),
(17, '5.3.3', 'Vérification	des	moyens	de	manutention	', '', '', '', '', NULL, 3, 0),
(18, '5.3.4', 'Contrôles	des	emballages	avant	expéditions', '', '', '', '', NULL, 3, 0),
(19, '5.3.5', 'Contrôles	administratifs	des	conducteurs	au	chargement', '', '', '', '', NULL, 3, 0),
(20, '5.3.6', 'Contrôles	administratifs	des	véhicules	au	chargement', '', '', '', '', NULL, 3, 0),
(21, '5.3.7', 'Protocole	de	sécurité', '', '', '', '', NULL, 3, 0),
(22, '5.3.8', 'Contrôles	des	équipements	des	véhicules	au	chargement', '', '', '', '', NULL, 3, 0),
(23, '5.3.9', 'Contrôles	des	équipements	de	chargement	/	déchargement', '', '', '', '', NULL, 3, 0),
(24, '5.3.10', 'Contrôles	des	accessoires	(notamment	des	flexibles)', '', '', '', '', NULL, 3, 0),
(25, '5.3.11', 'Respect	 des	 interdictions	 de	 chargement	 en	 commun	 (explosif,	\nalimentaire...)', '', '', '', '', NULL, 3, 0),
(26, '5.3.12', 'Empotage	de	conteneur', '', '', '', '', NULL, 3, 0),
(27, '5.3.13', 'Contrôle	du	chargement,	arrimage	et	calage', '', '', '', '', NULL, 3, 0),
(28, '5.3.14', 'Contrôle	de	la	citerne	avant	chargement/déchargement', '', '', '', '', NULL, 3, 0),
(29, '5.3.15', 'Contrôle	de	la	citerne	après	chargement/déchargement', '', '', '', '', NULL, 3, 0),
(30, '5.3.16', 'Gestion	des	seuils	d’application	de	la	réglementation', '', '', '', '', NULL, 3, 0),
(31, '5.3.17', 'Contrôle	du	matériel	incendie,	sécurité	et	«	environnement	»	sur	\nsite	de	chargement	/	déchargement', '', '', '', '', NULL, 3, 0),
(32, '5.3.18', 'Conformité	des	aires	de	chargement	/	déchargement	-	accès	aux	\ndômes	de	citernes', '', '', '', '', NULL, 3, 0),
(33, '5.4.1', 'Formation	obligatoire	des	personnels	autre	que	les	conducteurs', '', '', '', '', NULL, 4, 0),
(34, '5.4.2', 'Formation	des	conducteurs	transports	exemptés	(1.1.3.6	/	LQ	-	QE)', '', '', '', '', NULL, 4, 0),
(35, '5.4.3', 'Formation	des	conducteurs	hors	exemption', '', '', '', '', NULL, 4, 0),
(36, '5.4.4', 'Formation	"engins	de	manutention"', '', '', '', '', NULL, 4, 0),
(37, '5.4.5', 'Formation	à	l''accès	aux	dômes	de	citerne', '', '', '', '', NULL, 4, 0),
(38, '5.4.6', 'Autre	formation	liée	aux	opérations	de	chargement	/	déchargement', '', '', '', '', NULL, 4, 0),
(39, '5.4.7', 'Formation	aux	installations	automatiques', '', '', '', '', NULL, 4, 0),
(40, '5.4.8', 'Formation	pour	les	experts	selon	le	chapitre	8.2	de	l’ADN', '', '', '', '', NULL, 4, 0),
(41, '5.4.9', 'Formation	à	la	radioprotection', '', '', '', '', NULL, 4, 0),
(42, '5.5.1', '	Identification	des	situations	à	risques', '', '', '', '', NULL, 5, 0),
(43, '5.5.2', 'Identification	et	contrôles	des	moyens	d’interventions', '', '', '', '', NULL, 5, 0),
(44, '5.5.3', 'Procédures	d’urgence	en	cas	d''accident	/	test	de	la	procédures', '', '', '', '', NULL, 5, 0),
(45, '5.5.4', 'Intégration	du	scénario	accidents	TMD	dans	la	gestion	des	situations	\nd’urgence', '', '', '', '', NULL, 5, 0),
(46, '5.5.5', 'Avis	à	diffuser	aux	secours', '', '', '', '', NULL, 5, 0),
(47, '5.5.6', 'Procédure	de	sécurité	à	l’usage	du	conducteur', '', '', '', '', NULL, 5, 0),
(48, '5.5.7', 'Information	du	personnel	concerné	sur	les	procédures	d’urgences', '', '', '', '', NULL, 5, 0),
(49, '5.5.8', 'Formation	du	personnel	d''intervention', '', '', '', '', NULL, 5, 0),
(50, '5.5.9', 'Autres	procédures	de	sécurité', '', '', '', '', NULL, 5, 0),
(51, '5.6.1', 'Information	du	CSTMD	en	cas	d’accidents	/	Incidents', '', '', '', '', NULL, 6, 0),
(52, '5.6.2', 'Collecte	des	informations	sur	les	accidents	et	incidents	', '', '', '', '', NULL, 6, 0),
(53, '5.6.3', 'Méthodes	d''analyse	des	causes', '', '', '', '', NULL, 6, 0),
(54, '5.6.4', 'Déclaration	d''accidents', '', '', '', '', NULL, 6, 0),
(55, '5.7.1', 'Établissement	et	suivi	de	plan	d’action	pour	les	actions	correctives', '', '', '', '', NULL, 7, 0),
(56, '5.7.2', 'Exploitation	des	retours	d’expérience	(statistique,)', '', '', '', '', NULL, 7, 0),
(57, '5.7.3', 'Gestions	des	infractions	TMD', '', '', '', '', NULL, 7, 0),
(58, '5.8.1', 'Sous-traitance	"classification	des	matières"', '', '', '', '', NULL, 8, 0),
(59, '5.8.2', 'Sous-traitance	transport	(identification	et	contrôle	des	prestataires)', '', '', '', '', NULL, 8, 0),
(60, '5.8.3', 'Sous-traitance	"Gestions	des	déchets	dangereux"', '', '', '', '', NULL, 8, 0),
(61, '5.8.4', 'Sous-traitance	"contrôles	d''accès	au	site"	et/	ou	"contrôle	des	véhicules"', '', '', '', '', NULL, 8, 0),
(62, '5.9.1', 'Présence	«	d''un	manuel	conducteur	»', '', '', '', '', NULL, 9, 0),
(63, '5.9.2', 'Procédure	ou	consignes	de	réception	et	d''expédition', '', '', '', '', NULL, 9, 0),
(64, '5.9.3', 'Procédure	ou	consignes	de	rédaction	des	documents	de	transports', '', '', '', '', NULL, 9, 0),
(65, '5.9.4', 'Consignes	de	port	des	EPI	sur	site	de	chargement	/	déchargement', '', '', '', '', NULL, 9, 0),
(66, '5.9.5', 'Procédure	de	chargement	/	déchargement', '', '', '', '', NULL, 9, 0),
(67, '5.10.1', 'Sensibilisation	aux	risques	chimiques', '', '', '', '', NULL, 10, 0),
(68, '5.10.2', 'Autre	sensibilisation	aux	risques', '', '', '', '', NULL, 10, 0),
(69, '5.10.3', 'Causeries	sécurité', '', '', '', '', NULL, 10, 0),
(70, '5.10.4', 'Exercices	incendies', '', '', '', '', NULL, 10, 0),
(71, '5.10.5', 'Autre	exercice	de	sécurité', '', '', '', '', NULL, 10, 0),
(72, '5.11.1', 'Document	de	transport	ADR', '', '', '', '', NULL, 11, 0),
(73, '5.11.2', 'Document	spécifique	Déchets	(Dangereux,	amiantes,	DASRI)', '', '', '', '', NULL, 11, 0),
(74, '5.11.3', 'Consignes	écrites	selon	le	chapitre	5.4.3', '', '', '', '', NULL, 11, 0),
(75, '5.11.4', 'Pièces	d''identité	du	conducteur', '', '', '', '', NULL, 11, 0),
(76, '5.11.5', 'Fiches	de	suivi	des	flexibles	de	dépotage', '', '', '', '', NULL, 11, 0),
(77, '5.11.6', 'Certificat	d''agrément	des	véhicules	(Citerne	/	Classe	1)', '', '', '', '', NULL, 11, 0),
(78, '5.11.6', 'Certificat	d''agrément	des	véhicules	(Citerne	/	Classe	1)', '', '', '', '', NULL, 11, 0),
(79, '5.11.7', 'Récépissé	de	déclaration	de	transports	de	déchets', '', '', '', '', NULL, 11, 0),
(80, '5.11.8', 'Agréments	et	documents	spécifiques	"classe	7"', '', '', '', '', NULL, 11, 0),
(81, '5.11.9', 'Équipements	divers	des	véhicules', '', '', '', '', NULL, 11, 0),
(82, '5.11.10', 'Signalisation	des	véhicules', '', '', '', '', NULL, 11, 0),
(83, '5.12.1', 'Traçabilité	des	contrôles	effectués	(Check-list)', '', '', '', '', NULL, 12, 0),
(84, '5.12.2', 'Organisation,	planification	et	formalisation	des	audits	internes', '', '', '', '', NULL, 12, 0),
(85, '5.12.3', 'Qualification	du	personnel	d''audit	interne', '', '', '', '', NULL, 12, 0),
(86, '5.12.4', 'Suivi	de	l''activité	des	conducteurs', '', '', '', '', NULL, 12, 0),
(87, '5.13.1', 'Identification	des	marchandises	à	haut	risque', '', '', '', '', NULL, 13, 0),
(88, '5.13.2', 'Établissement	du	plan	de	sûreté', '', '', '', '', NULL, 13, 0),
(89, '5.13.3', 'Responsabilité	en	matière	de	sûreté', '', '', '', '', NULL, 13, 0),
(90, '5.13.4', 'Mesure	générale	de	sûreté	(hors	MD	haut	risque)	-	Formation', '', '', '', '', NULL, 13, 0),
(91, '5.13.5', 'Mesure	générale	de	sûreté	(hors	MD	haut	risque)	-	Identification	\ndes	transporteurs', '', '', '', '', NULL, 13, 0),
(92, '5.13.6', 'Mesure	générale	de	sûreté	(hors	MD	haut	risque)	-	Sécurisation	des	\ndépôts	de	véhicules', '', '', '', '', NULL, 13, 0),
(93, '5.13.7', 'Mesure	générale	de	sûreté	(hors	MD	haut	risque)	-	Document	\nd''identification	des	conducteurs', '', '', '', '', NULL, 13, 0);

--
-- Index pour les tables exportées
--

--
-- Index pour la table `llxhu_cstmd_questions`
--
ALTER TABLE `llxhu_cstmd_questions`
 ADD PRIMARY KEY (`rowid`);

--
-- AUTO_INCREMENT pour les tables exportées
--

--
-- AUTO_INCREMENT pour la table `llxhu_cstmd_questions`
--
ALTER TABLE `llxhu_cstmd_questions`
MODIFY `rowid` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=94;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
