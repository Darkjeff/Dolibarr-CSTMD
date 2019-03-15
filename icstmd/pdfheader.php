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

    // Logo
	
	
	
   // $this->Image('img/logo.jpg',20,15,50);
   // $this->Image('../../../documents/mycompany/logos/'.$logo ,20,15,50);
    // Police Arial gras 15
    $this->SetFont('Arial','I',11);
    $this->SetXY(80, 20);
    $this->Write(0,utf8_decode('Conseiller à la Sécurité '));
	
	
	$this->SetXY(80, 24);
    $this->Write(0,utf8_decode('Sûreté aérienne'));
	
	$this->SetXY(80, 28);
    $this->Write(0,utf8_decode('Formation Transport de Marchandises Dangereuses'));
	
	$this->SetXY(80, 32);
    $this->Write(0,utf8_decode('Formation déchets et CLP-GHS'));
	
	//$this->SetXY(80, 36);
    //$this->Write(0,utf8_decode($logo));

?>
