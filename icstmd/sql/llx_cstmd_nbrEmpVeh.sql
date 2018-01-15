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


CREATE TABLE IF NOT EXISTS `llx_cstmd_nbrEmpVeh`(
  `rowid`          int(11)  AUTO_INCREMENT,
  `label`           varchar(255) NOT NULL, 
  `type`		varchar(12) NOT NULL, 
  `year`		int(4) NOT NULL, 
  `nombre`		 int(11) NOT NULL,    
  `fk_soc`		 int(11) NOT NULL,    
  PRIMARY KEY (`rowid`)    
)ENGINE=innodb DEFAULT CHARSET=utf8;

