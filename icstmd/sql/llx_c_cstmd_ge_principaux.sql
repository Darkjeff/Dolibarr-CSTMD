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


CREATE TABLE IF NOT EXISTS `llx_c_cstmd_ge_principaux`(
  `rowid`          int(11)  AUTO_INCREMENT,
  `label`           varchar(48) NOT NULL, 
  `code`		varchar(12) NOT NULL, 
  `active`		tinyint(4) DEFAULT 1 NOT NULL,	     
  PRIMARY KEY (`rowid`)    
)ENGINE=innodb DEFAULT CHARSET=utf8;


INSERT IGNORE INTO llx_c_cstmd_ge_principaux (`rowid`, `label`, `code`, `active`) VALUES (1, 'ge_principaux 1', 'C1', 1);
INSERT IGNORE INTO llx_c_cstmd_ge_principaux (`rowid`, `label`, `code`, `active`) VALUES (2, 'ge_principaux 2', 'C2', 1);
INSERT IGNORE INTO llx_c_cstmd_ge_principaux (`rowid`, `label`, `code`, `active`) VALUES (3, 'ge_principaux 3', 'C3', 1);
INSERT IGNORE INTO llx_c_cstmd_ge_principaux (`rowid`, `label`, `code`, `active`) VALUES (4, 'ge_principaux 4', 'C4', 1);
INSERT IGNORE INTO llx_c_cstmd_ge_principaux (`rowid`, `label`, `code`, `active`) VALUES (5, 'ge_principaux 5', 'C5', 1);
INSERT IGNORE INTO llx_c_cstmd_ge_principaux (`rowid`, `label`, `code`, `active`) VALUES (6, 'ge_principaux 6', 'C6', 1);
