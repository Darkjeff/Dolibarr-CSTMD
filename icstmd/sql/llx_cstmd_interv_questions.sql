-- ========================================================================
-- Copyright (C) <2017> SaaSprov.ma <saasprov@gmail.com>
--
-- This program is free software; you can redistribute it and/or modify
-- it under the terms of the GNU General Public License as published by
-- the Free Software Foundation; either version 3 of the License, or
-- (at your option) any later version.
--
-- This program is distributed in the hope that it will be useful,
-- but WITHOUT ANY WARRANTY; without even the implied warranty of
-- MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
-- GNU General Public License for more details.
--
-- You should have received a copy of the GNU General Public License
-- along with this program. If not, see <http://www.gnu.org/licenses/>.
--
-- ========================================================================

CREATE TABLE IF NOT EXISTS `llx_cstmd_interv_questions` (
  `rowid` int(11) NOT NULL AUTO_INCREMENT,
  `position` varchar(45) NOT NULL,
  `label_question` varchar(300) NOT NULL,
   `texte_reglementaire` varchar(1200) DEFAULT NULL,
  `etat_lieux` varchar(500) DEFAULT NULL,
  `titre_recommandation` varchar(500) DEFAULT NULL,
  `recommandation` varchar(500) DEFAULT NULL,
  `dater` date DEFAULT NULL,
  `reference` varchar(500) DEFAULT NULL,
   fk_intervention INTEGER NOT NULL,
  `fk_chapitre` int(11) NOT NULL,
   cf tinyint(1) NOT NULL DEFAULT '0',
   nc tinyint(1) NOT NULL DEFAULT '0',
   pa tinyint(1) NOT NULL DEFAULT '0',
   ev tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`rowid`),
  INDEX (fk_intervention),
  INDEX (fk_chapitre)
  )ENGINE=innodb DEFAULT CHARSET=utf8;

