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

	$this->SetFont('Arial','B',11);
	$this->SetXY(15, -32);
	$this->MultiCell(180,8,utf8_decode("CARBONNE Conseil & Formation - 25 Merlet - 33420 ESPIET"), 0, 'C');

	$this->SetFont('Arial','',9);
	$this->SetXY(15, -25);
	$this->MultiCell(180,5,utf8_decode("Tel : 05 57 51 70 36 / 06 71 60 62 50 Fax : 05 24 84 62 50 - info@carbonnetmd.fr - www.carbonnetmd.fr"), 0, 'C');
	
/*	$this->SetFont('Arial','',9);
	$this->SetXY(15, -33);
	$this->MultiCell(180,5,utf8_decode("- info@carbonnetmd.fr - www.carbonnetmd.fr"), 0, 'C');
	*/

	$this->SetFont('Arial','',9);
	$this->SetXY(15, -21);
	$this->MultiCell(180,5,utf8_decode("Formation : Déclaration d'activité enregistrée sous le n° 72 33 07266 33 auprès du préfet de région Aquitaine"), 0, 'C');

	/*
	$this->SetFont('Arial','',9);
	$this->SetXY(15, -28);
	$this->MultiCell(180,5,utf8_decode("Formation : Déclaration d’activité enregistrée sous le n° 72 33 07266 33 auprès du préfet de région"), 0, 'C');
*/
	$this->SetFont('Arial','',9);
	$this->SetXY(15, -17);
	$this->MultiCell(180,5,utf8_decode("Cette déclaration ne vaut pas agrément de l'état - Profession Libérale - SIRET : 500 040 092 0016 - NAF : 7022 Z"), 0, 'C');
	/*
	$this->SetFont('Arial','',9);
	$this->SetXY(15, -18);
	$this->MultiCell(180,5,utf8_decode("500 040 092 0016 - NAF : 7022 Z"), 0, 'C');
	*/
    // Positionnement à 1,5 cm du bas
    $this->SetY(-10);
    // Police Arial italique 8
    $this->SetFont('Arial','I',8);
 /*
    // Numéro de page
    $this->Cell(0,10,'Page '.$this->PageNo().'/{nb}',0,0,'C');
    */
    
?>
