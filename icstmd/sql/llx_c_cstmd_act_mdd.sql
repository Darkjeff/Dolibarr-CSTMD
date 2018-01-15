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


CREATE TABLE IF NOT EXISTS `llx_c_cstmd_act_mdd`(
  `rowid`          int(11)  AUTO_INCREMENT,
  `label`           varchar(48) NOT NULL, 
  `code`		varchar(12) NOT NULL, 
  `active`		tinyint(4) DEFAULT 1 NOT NULL,	     
  PRIMARY KEY (`rowid`)    
)ENGINE=innodb DEFAULT CHARSET=utf8;


INSERT IGNORE INTO llx_c_cstmd_act_mdd (`rowid`, `label`, `code`, `active`) VALUES (1, 'act_mdd 1', 'C1', 1);
INSERT IGNORE INTO llx_c_cstmd_act_mdd (`rowid`, `label`, `code`, `active`) VALUES (2, 'act_mdd 2', 'C2', 1);
INSERT IGNORE INTO llx_c_cstmd_act_mdd (`rowid`, `label`, `code`, `active`) VALUES (3, 'act_mdd 3', 'C3', 1);
INSERT IGNORE INTO llx_c_cstmd_act_mdd (`rowid`, `label`, `code`, `active`) VALUES (4, 'act_mdd 4', 'C4', 1);
INSERT IGNORE INTO llx_c_cstmd_act_mdd (`rowid`, `label`, `code`, `active`) VALUES (5, 'act_mdd 5', 'C5', 1);
INSERT IGNORE INTO llx_c_cstmd_act_mdd (`rowid`, `label`, `code`, `active`) VALUES (6, 'act_mdd 6', 'C6', 1);
