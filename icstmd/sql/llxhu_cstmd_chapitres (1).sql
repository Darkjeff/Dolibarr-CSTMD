-- phpMyAdmin SQL Dump
-- version 4.2.12deb2+deb8u8
-- http://www.phpmyadmin.net
--
-- Client :  localhost
-- Généré le :  Mer 22 Janvier 2020 à 17:14
-- Version du serveur :  5.5.60-0+deb8u1
-- Version de PHP :  5.6.40-0+deb8u7

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
-- Structure de la table `llxhu_cstmd_chapitres`
--

CREATE TABLE IF NOT EXISTS `llxhu_cstmd_chapitres` (
`rowid` int(11) NOT NULL,
  `position` varchar(45) DEFAULT NULL,
  `chapitre` varchar(500) DEFAULT NULL,
  `fk_referentiel_id` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8;

--
-- Contenu de la table `llxhu_cstmd_chapitres`
--

INSERT INTO `llxhu_cstmd_chapitres` (`rowid`, `position`, `chapitre`, `fk_referentiel_id`) VALUES
(1, '5.1', 'Les procédés visant au respect des règles relatives à l''identification des marchandises dangereuses transportées', 1),
(2, '5.2', 'La	 pratique	 de	 l''entreprise	 concernant	 la	 prise	 en	 compte	 dans	l''achat	 des	 moyens	 de	 transport	 de	 tout	 besoin	 particulier	 relatif	 aux	marchandises	dangereuses	transportées', 1),
(3, '5.3', 'Les	 procédés	 permettant	 de	 vérifier	 le	 matériel	 utilisé	 pour	 le	transport	 de	 matières	 dangereuses	 ou	 pour	 les	 opérations	 de	chargement	ou	de	déchargement', 1),
(4, '5.4', 'Le	 fait	 que	 les	 employés	 concernés	 de	 l''entreprise	 ont	 reçu	 une formation	 appropriée,	 y	 compris	 à	 propos	 des	 modifications	 à	 la	réglementation,	et	que	cette	formation	est	inscrite	sur	leur	dossier', 1),
(5, '5.5', 'La	 mise	 en	 oeuvre	 de	 procédures	 d''urgence	 appropriées	 aux	accidents	 ou	 incidents	 éventuels	 pouvant	 porter	 atteinte	 à	 la	 sécurité	pendant	 le	 transport	 de	 marchandises	 dangereuses	 ou	 pendant	 les	opérations	de	chargement	ou	de	déchargement', 1),
(6, '5.6', 'Le	recours	à	des	analyses	et,	si	nécessaire,	la	rédaction	de	rapports	concernant	 les	 accidents,	 les	 incidents	 ou	 les	 infractions	 graves	constatés	 au	 cours	 du	 transport	 de	 marchandises	 dangereuses	 ou	pendant	les	opérations	de	chargement	ou	de	déchargement', 1),
(7, '5.7', 'La mise en place de mesures appropriées	pour éviter la répétition d''accidents, d''incidents ou d''infractions graves', 1),
(8, '5.8', 'La	 prise	 en	 compte	 des	 prescriptions	 législatives	 et	 des	 besoins	particuliers	 relatifs	 au	 transport	 de	 marchandises	 dangereuses	concernant	 le	 choix	 et	 l''utilisation	 de	 sous-traitants	 ou	 autres	intervenants', 1),
(9, '5.9', 'La vérification que le personnel affecté au transport des marchandises dangereuses, au chargement ou au déchargement de ces marchandises dispose de procédures d''exécution et de consignes détaillées', 1),
(10, '5.10', 'La	mise	en	place	d''actions	pour	la	sensibilisation	aux	risques	liés	au	transport	 des	 marchandises	 dangereuses,	 au	 chargement	 ou	 au	déchargement	de	ces	dernières', 1),
(11, '5.11', 'La	 mise	 en	 place	 de	 procédés	 de	 vérification	 afin	 d''assurer	 la	présence,	 à	 bord	 des	 moyens	 de	 transport,	 des	 documents	 et	 des	équipements	 de	 sécurité	 devant	 accompagner	 les	 transports	 et	 la	conformité	 de	 ces	 documents	 et	 de	 ces	 équipements	 avec	 la	réglementation', 1),
(12, '5.12', 'La mise en place de procédés de vérification afin d''assurer le respect des prescriptions relatives aux opérations de chargement	et de déchargement', 1),
(13, '5.13', 'L''existence	du	plan	de	sûreté	prévu	au	1.10.3.2', 1);

--
-- Index pour les tables exportées
--

--
-- Index pour la table `llxhu_cstmd_chapitres`
--
ALTER TABLE `llxhu_cstmd_chapitres`
 ADD PRIMARY KEY (`rowid`), ADD KEY `fk_cstmd_questions_rowid` (`fk_referentiel_id`);

--
-- AUTO_INCREMENT pour les tables exportées
--

--
-- AUTO_INCREMENT pour la table `llxhu_cstmd_chapitres`
--
ALTER TABLE `llxhu_cstmd_chapitres`
MODIFY `rowid` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=14;
--
-- Contraintes pour les tables exportées
--

--
-- Contraintes pour la table `llxhu_cstmd_chapitres`
--
ALTER TABLE `llxhu_cstmd_chapitres`
ADD CONSTRAINT `fk_cstmd_questions_rowid` FOREIGN KEY (`fk_referentiel_id`) REFERENCES `llxhu_cstmd_referentiels` (`rowid`) ON DELETE CASCADE ON UPDATE NO ACTION;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
