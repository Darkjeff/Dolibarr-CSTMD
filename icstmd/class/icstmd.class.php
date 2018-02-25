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
/**
 * Put your class' description here
 */
class Icstmd // extends CommonObject
{

	public function __construct($db)
	{
		$this->db = $db;

		return 1;
	}
	
	function getFormations()
    {
		$formations = array();
		$sql = "SELECT *";
		$sql.= " FROM " . MAIN_DB_PREFIX . "c_cstmd_formations";	
		$sql.= " WHERE active = 1";

		dol_syslog($script_file . " sql=" . $sql, LOG_DEBUG);
		$resql=$this->db->query($sql);
		$data = array();
		if ($resql) {
			$num = $this->db->num_rows($resql);
			$i = 0;
			
			if ($num) {
				while ($i < $num) {
					$obj = $this->db->fetch_object($resql);
					if ($obj) {									
						$formations[$obj->rowid] = $obj->label;
					}
					$i++;
				}
			}
		} else {
			$error++;
			dol_print_error($this->db);
		}
		return $formations;
	}
	
	
	function saveNbrEmpVeh($soc_id, $label, $year, $nbrveh, $type)
    {
        $this->db->begin();
		
		$sql = 'INSERT INTO ' . MAIN_DB_PREFIX . 'cstmd_nbrEmpVeh (';
		$sql .= ' label,';
		$sql .= ' year,';
		$sql .= ' nombre,';
		$sql .= ' fk_soc,';
		$sql .= ' type';
		$sql .= ') VALUES (';
		$sql .= ' \'' . $label . '\',';
		$sql .= ' \'' . $year . '\',';
		$sql .= ' ' . $nbrveh . ',';
		$sql .= ' ' . $soc_id . ',';
		$sql .= "'".$type."'";
		$sql .= ')';
		
        dol_syslog(get_class($this)."::add", LOG_DEBUG);
        $resql=$this->db->query($sql);
        if ($resql)
        {
			$this->db->commit();
			return 1;
           
        }
        else
        {
            $this->db->rollback();
            $this->error=$this->db->lasterror();
            return -1;
        }

    }
	
	function impNbrFor($formations, $id){
			// Pour chaque formation du dictionnaire je cherche le nombre de participants 
		foreach($formations as $rowid => $label){
			
			$sql = "SELECT SUM(nb_stagiaire) as nb, YEAR(dated) as year FROM " . MAIN_DB_PREFIX . "agefodd_session WHERE fk_soc=$id AND fk_formation_catalogue IN ( SELECT rowid FROM " . MAIN_DB_PREFIX . "agefodd_formation_catalogue WHERE ref = '$label') GROUP BY  YEAR(dated)";
			
			$resql=$this->db->query($sql);
			//echo $sql."<br>";
			
			if ($resql) {
				$num = $this->db->num_rows($resql);
				$i = 0;
				if ($num) {
					while ($i < $num) {
						$obj = $this->db->fetch_object($resql);
						if ($obj) {	
							
							//echo $obj->year.' - '.$obj->nb.'<br>';
							$nb = $obj->nb;
							if($nb > 0){
								$nbrfor = GETPOST('nbrfor');
								$sql = 'INSERT INTO ' . MAIN_DB_PREFIX . 'cstmd_nbrEmpVeh (';
								$sql .= ' label,';
								$sql .= ' year,';
								$sql .= ' nombre,';
								$sql .= ' fk_soc,';
								$sql .= ' type';
								$sql .= ') VALUES (';
								$sql .= ' \'' . $label . '\',';
								$sql .= ' \'' . $obj->year . '\',';
								$sql .= ' ' . $nb . ',';
								$sql .= ' ' . $id . ',';
								$sql .= '\'FOR\'';
								$sql .= ')';
								$this->db->begin();
								$resql = $this->db->query($sql);
								$this->db->commit();
							}
							
						}
						$i++;
					}
				}
			}
			
		}
	}
	
	function getCommercial($id)
    {
		$commercial = 0;
		$sql = "SELECT fk_user";
		$sql.= " FROM " . MAIN_DB_PREFIX . "societe_commerciaux";
		$sql.= " WHERE fk_soc = $id";
		$sql.= " Order by rowid asc";

		dol_syslog($script_file . " sql=" . $sql, LOG_DEBUG);
		$resql=$this->db->query($sql);
		$data = array();
		if ($resql) {
			$num = $this->db->num_rows($resql);
			$i = 0;
			
			if ($num) {
				while ($i < $num) {
					$obj = $this->db->fetch_object($resql);
					if ($obj) {									
						$commercial = $obj->fk_user;
					}
					$i++;
				}
			}
		} else {
			$error++;
			dol_print_error($this->db);
		}
		return $commercial;
	
	}
	
	// chercher un contact par nom et prenom et societe
	function getContact($soc_id, $lastname, $firstname)
    {
		$commercial = 0;
		$sql = "SELECT fk_user";
		$sql.= " FROM " . MAIN_DB_PREFIX . "socpeople";
		$sql.= " WHERE fk_soc = $soc_id";
		$sql.= " AND lastname = $lastname";
		$sql.= " AND firstname = $firstname";

		dol_syslog(get_class($this) . "::fetch ", LOG_DEBUG);
		$resql = $this->db->query($sql);
		if ($resql) {
			if ($this->db->num_rows($resql)) {
				return 1;
			}else{
				return 0;
			}
			
		} else {
			$this->error = "Error " . $this->db->lasterror();
			dol_syslog(__METHOD__ . " " . $this->error, LOG_ERR);

			return 0;
		}
	
	}
	
		// chercher un contact par nom et prenom et societe
	function updateParticipant($contact_id, $particp_id)
    {
		$this->db->begin();

		// Desactive utilisateur
		$sql = "UPDATE ".MAIN_DB_PREFIX."agefodd_stagiaire";
		$sql.= " SET fk_socpeople = ".$contact_id;
		$sql.= " WHERE rowid = ".$particp_id;
		$result = $this->db->query($sql);
		
		dol_syslog(get_class($this)."::setstatus", LOG_DEBUG);
		

		if (empty($result))
		{
			$this->db->rollback();
			return -1;
		}
		else
		{
			$this->db->commit();
			return 1;
		}
	
	}
	
    function saveCstmd($userid, $socId)
    {
		// je cherche si user est dans commerciaux du tiers
		$sql = "SELECT *";
		$sql.= " FROM " . MAIN_DB_PREFIX . "societe_commerciaux";	
		$sql.= " WHERE fk_user = $userid";
		$sql.= " AND fk_soc = $socId";
		
		//echo $sql;
		dol_syslog($script_file . " sql=" . $sql, LOG_DEBUG);
		$resql=$this->db->query($sql);
		//commercial n'est pas lié au tiers j'enregistre
		if (empty($resql->num_rows)) {
			$sql = 'INSERT INTO ' . MAIN_DB_PREFIX . 'societe_commerciaux (';
			$sql .= ' fk_user,';
			$sql .= ' fk_soc';
			$sql .= ') VALUES (';
			$sql .= '' . $userid . ',';
			$sql .= '' . $socId . '';
			$sql .= ')';
			echo $sql;
			$this->db->begin();

			$resql = $this->db->query($sql);
			$this->db->commit();			
		}
		
		// je cherche nom du commercial
		
		$sql = "SELECT 	firstname,";
		$sql.= " lastname";
		$sql.= " FROM ".MAIN_DB_PREFIX."user ";
		$sql.= " WHERE rowid = $userid";
		//echo $sql;
		$name = "";
		dol_syslog(__METHOD__ . " sql=" . $sql, LOG_DEBUG);
		$resql = $this->db->query($sql);
		if ($resql) {
			if ($this->db->num_rows($resql)) {
				$obj = $this->db->fetch_object($resql);
				$name = $obj->firstname.' '.$obj->lastname;
				
			}
		}
		echo $name;
		// j'enregistre le commercial comme cstmd pour tiers
		// je vérifie si tiers a déjà un cstmd
		$sql = "SELECT *";
		$sql.= " FROM " . MAIN_DB_PREFIX . "societe_extrafields";	
		$sql.= " WHERE fk_object = $socId";
		
		// echo $sql;
		dol_syslog($script_file . " sql=" . $sql, LOG_DEBUG);
		$resql=$this->db->query($sql);
		
		$obj = $this->db->fetch_object($resql);
		//pas cstmd pour tiers j'enregistre
		if (empty($resql->num_rows)) {
		
			$sql = 'INSERT INTO ' . MAIN_DB_PREFIX . 'societe_extrafields (';
			$sql .= ' cstmd,';
			$sql .= ' fk_object';
			$sql .= ') VALUES (';
			$sql .= "'" . $name . "',";
			$sql .= '' . $socId . '';
			$sql .= ')';
			echo $sql;
			$this->db->begin();

			$resql = $this->db->query($sql);
			$this->db->commit();
		}else{// si non mise à jour
			
			$rowid = $obj->rowid;
			
			$sql = "UPDATE " . MAIN_DB_PREFIX . "societe_extrafields SET";
			$sql.= " cstmd = '$name'";

			$sql.= " WHERE rowid = $rowid";
			echo $sql;
			$this->db->begin();

			$resql = $this->db->query($sql);
			$this->db->commit();
			
		}
		return 1;
		
	}
	
	function saveDreal($dreal_id, $soc_id)
    {
		// je cherche nom de la societe dreal
		$sql = "SELECT 	nom";
		$sql.= " FROM ".MAIN_DB_PREFIX."societe ";
		$sql.= " WHERE rowid = $dreal_id";
		echo $sql;
		$name = "";
		dol_syslog(__METHOD__ . " sql=" . $sql, LOG_DEBUG);
		$resql = $this->db->query($sql);
		if ($resql) {
			if ($this->db->num_rows($resql)) {
				$obj = $this->db->fetch_object($resql);
				$name = $obj->nom;
				
			}
		}
		//echo $name;
		
		// je cherche si y a déjà un dreal enregistré pour la soc
		$sql = "SELECT *";
		$sql.= " FROM " . MAIN_DB_PREFIX . "societe_extrafields";	
		$sql.= " WHERE fk_object = $soc_id";
		
		// echo $sql;
		dol_syslog($script_file . " sql=" . $sql, LOG_DEBUG);
		$resql=$this->db->query($sql);
		
		$obj = $this->db->fetch_object($resql);
		//pas dreal pour tiers j'enregistre
		if (empty($resql->num_rows)) {
		
			$sql = 'INSERT INTO ' . MAIN_DB_PREFIX . 'societe_extrafields (';
			$sql .= ' dreal,';
			$sql .= ' fk_object';
			$sql .= ') VALUES (';
			$sql .= "'" . $name . "',";
			$sql .= '' . $soc_id . '';
			$sql .= ')';
			echo $sql;
			$this->db->begin();

			$resql = $this->db->query($sql);
			$this->db->commit();
		}else{// si non mise à jour
			
			$rowid = $obj->rowid;
			
			$sql = "UPDATE " . MAIN_DB_PREFIX . "societe_extrafields SET";
			$sql.= " dreal = '$name'";

			$sql.= " WHERE rowid = $rowid";
			echo $sql;
			$this->db->begin();

			$resql = $this->db->query($sql);
			$this->db->commit();
			
		}
		return 1;
		
	}
	
	function saveDatev($datev, $soc_id)
    {
    //$dateval = $this->db->idate($datev) ;
   
		$dateval = date('Y-m-d', $datev) ;
    
		// looking for date validated
		$sql = "SELECT *";
		$sql.= " FROM " . MAIN_DB_PREFIX . "societe_extrafields";	
		$sql.= " WHERE fk_object = $soc_id";
		
		// echo $sql;die;
		dol_syslog($script_file . " sql=" . $sql, LOG_DEBUG);
		$resql=$this->db->query($sql);
		
		$obj = $this->db->fetch_object($resql);
		//pas dreal pour tiers j'enregistre
		if (empty($resql->num_rows)) {
		
			$sql = 'INSERT INTO ' . MAIN_DB_PREFIX . 'societe_extrafields (';
			$sql .= ' datev,';
			$sql .= ' fk_object';
			$sql .= ') VALUES (';
			$sql .= "'" . $dateval . "',";
			$sql .= '' . $soc_id . '';
			$sql .= ')';
			echo $sql;die;
			$this->db->begin();

			$resql = $this->db->query($sql);
			$this->db->commit();
		}else{// si non mise à jour
			
			$rowid = $obj->rowid;
			
			$sql = "UPDATE " . MAIN_DB_PREFIX . "societe_extrafields SET";
			//$sql.= " datev = ' $dateval'";
			$sql.= " datev ='" .$dateval ."'";

			$sql.= " WHERE rowid = $rowid";
			// echo $sql;die;
			$this->db->begin();

			$resql = $this->db->query($sql);
			$this->db->commit();
			
		}
		return 1;
		
	}

}
