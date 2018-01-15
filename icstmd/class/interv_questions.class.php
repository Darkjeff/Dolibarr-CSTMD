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
 
/** Includes */
require_once DOL_DOCUMENT_ROOT."/core/class/commonobject.class.php";
require_once DOL_DOCUMENT_ROOT.'/multicurrency/class/multicurrency.class.php';

/**
 * Put your class' description here
 */
class IntervQuestions  extends CommonObject
{

    /** @var string Error code or message */
	public $error;
    /** @var array Several error codes or messages */
	public $errors = array();
    public $element='cstmd_interv_questions';
    public $table_element = 'cstmd_interv_questions';
	/**
	 * Regular product
	 */
	//const TYPE_VEHICLE = 0;
    /** @var int An example ID */
	public $id;
    /** @var mixed An example property */
	public $position; 
	/** @var mixed An example property */
	public $label_question;
	/** @var mixed An example property */
	public $etat_lieux;
	/** @var mixed An example property */
	public $titre_recommandation;
	/** @var mixed An example property */
	public $recommandation;
	/** @var mixed An example property */
	public $dater;
	/** @var mixed An example property */
	public $reference;
	/** @var mixed An example property */
	public $texte_reglementaire;
	/** @var mixed An example property */
	public $fk_chapitre_id;
	/** @var mixed An example property */
	public $cf;
    /** @var mixed An example property */
	public $nc;
    /** @var mixed An example property */
	public $fk_intervention;
	/** @var mixed An example property */
	public $pa;
	/** @var mixed An example property */
	public $ev;

	/**
	 * Constructor
	 *
	 * @param DoliDb $db Database handler
	 */
	public function __construct(DoliDB $db)
	{
		 global $langs;

        $this->db = $db;
	}

	/**
	 * Create object into database
	 *
	 * @param User $user User that create
	 * @param int $notrigger 0=launch triggers after, 1=disable triggers
	 * @return int <0 if KO, Id of created object if OK
	 */
	public function create($user)
	{
		global $conf, $langs;
		$error = 0;

		// Clean parameters
		if (isset($this->position)) {
			$this->position = trim($this->position);
		}
		if (isset($this->label_question)) {
			$this->label_question = trim($this->label_question);
		}
		if (isset($this->etat_lieux)) {
			$this->etat_lieux = trim($this->etat_lieux);
		}
		if (isset($this->titre_recommandation)) {
			$this->titre_recommandation = trim($this->titre_recommandation);
		}
		if (isset($this->recommandation)) {
			$this->recommandation = trim($this->recommandation);
		}
		if (isset($this->reference)) {
			$this->reference = trim($this->reference);
		}
		if (isset($this->texte_reglementaire)) {
			$this->texte_reglementaire = trim($this->texte_reglementaire);
		}
		if (isset($this->fk_chapitre_id)) {
			$this->fk_chapitre_id = trim($this->fk_chapitre_id);
		}
		if (isset($this->cf)) {
			$this->cf = trim($this->cf);
		}
		if (isset($this->nc)) {
			$this->nc = trim($this->nc);
		}
		if (isset($this->fk_intervention)) {
			$this->fk_intervention = trim($this->fk_intervention);
		}
		if (isset($this->pa)) {
			$this->pa = trim($this->pa);
		}
		if (isset($this->ev)) {
			$this->ev = trim($this->ev);
		}

		// Check parameters
		// Put here code to add control on parameters values
		// Insert request
		$sql = "INSERT IGNORE  INTO " . MAIN_DB_PREFIX . "cstmd_interv_questions(";
		$sql.= " position,";
		$sql.= " label_question,";
		$sql.= " fk_intervention,";
		$sql.= " texte_reglementaire,";
		$sql.= " etat_lieux,";
		$sql.= " titre_recommandation,";
		$sql.= " recommandation,";
		$sql.= " reference,";
		$sql.= " fk_chapitre,";
		$sql.= " cf,";
		$sql.= " nc,";
		$sql.= " pa,";
		$sql.= " ev";
		$sql.= ") VALUES (";
		$sql.= " '" . $this->db->escape($this->position) . "',";
		$sql.= " '" . $this->db->escape($this->label_question) . "',";
		$sql.= " '" . $this->db->escape($this->fk_intervention) . "',";
		$sql.= " '" . $this->db->escape($this->texte_reglementaire) . "',";
		$sql.= " '" . $this->db->escape($this->etat_lieux) . "',";
		$sql.= " '" . $this->db->escape($this->titre_recommandation) . "',";
		$sql.= " '" . $this->db->escape($this->recommandation) . "',";
		$sql.= " '" . $this->db->escape($this->reference) . "',";
		$sql.= " '" . $this->db->escape($this->fk_chapitre_id) . "',";
		$sql.= (strval($this->cf)!=''?"'".$this->cf."'":"0"). ",";
		$sql.= (strval($this->nc)!=''?"'".$this->nc."'":"0"). ",";
		$sql.= (strval($this->pa)!=''?"'".$this->pa."'":"0"). ",";
		$sql.= (strval($this->ev)!=''?"'".$this->ev."'":"0"). "";
		$sql.= ")";
		$this->db->begin();

		dol_syslog(get_class($this) . "::create ", LOG_DEBUG);
		$resql = $this->db->query($sql);
		if (! $resql) {
			$error ++;
			$this->errors[] = "Error " . $this->db->lasterror();
		}
		
		// Commit or rollback
		if ($error) {
			foreach ($this->errors as $errmsg) {
				dol_syslog(__METHOD__ . " " . $errmsg, LOG_ERR);
				$this->error.=($this->error ? ', ' . $errmsg : $errmsg);
			}
			$this->db->rollback();

			return -1 * $error;
		} else {
			$this->db->commit();

			return 1;
		}
	}

	/**
	 * Load object in memory from database
	 *
	 * @param int $id Id object
	 * @return int <0 if KO, >0 if OK
	 */
	public function fetch($id)
	{
		global $langs;
		$sql = "SELECT *";
		$sql.= " FROM ". MAIN_DB_PREFIX."cstmd_interv_questions";
		$sql.= " where rowid = " . $id;
		dol_syslog(get_class($this) . "::fetch ", LOG_DEBUG);
		$resql = $this->db->query($sql);
		if ($resql) {
			if ($this->db->num_rows($resql)) {
				$obj = $this->db->fetch_object($resql);
				$this->id = $obj->rowid;
				$this->position = $obj->position;
				$this->label_question = $obj->label_question;
				$this->etat_lieux = $obj->etat_lieux;
				$this->titre_recommandation = $obj->titre_recommandation;
				$this->recommandation = $obj->recommandation;
				$this->dater = $obj->dater;
				$this->reference = $obj->reference;
				$this->texte_reglementaire = $obj->texte_reglementaire;
				$this->fk_chapitre_id = $obj->fk_chapitre_id;
				$this->cf = $obj->cf;
				$this->nc = $obj->nc;
				$this->fk_intervention = $obj->fk_intervention;
				$this->pa = $obj->pa;
				$this->ev = $obj->ev;
			}
			$this->db->free($resql);
			return 1;
		} else {
			$this->error = "Error " . $this->db->lasterror();
			dol_syslog(__METHOD__ . " " . $this->error, LOG_ERR);

			return -1;
		}
	}

	/**
	 * Update object into database
	 *
	 * @param User $user User that modify
	 * @param int $notrigger 0=launch triggers after, 1=disable triggers
	 * @return int <0 if KO, >0 if OK
	 */
	public function update($user = 0, $notrigger = 0)
	{
		global $conf, $langs;
		$error = 0;

		// Clean parameters
		if (isset($this->position)) {
			$this->position = trim($this->position);
		}
		if (isset($this->label_question)) {
			$this->label_question = trim($this->label_question);
		}
		if (isset($this->etat_lieux)) {
			$this->etat_lieux = trim($this->etat_lieux);
		}
		if (isset($this->titre_recommandation)) {
			$this->titre_recommandation = trim($this->titre_recommandation);
		}
		if (isset($this->recommandation)) {
			$this->recommandation = trim($this->recommandation);
		}
		if (isset($this->reference)) {
			$this->reference = trim($this->reference);
		}
		if (isset($this->texte_reglementaire)) {
			$this->texte_reglementaire = trim($this->texte_reglementaire);
		}
		if (isset($this->fk_chapitre_id)) {
			$this->fk_chapitre_id = trim($this->fk_chapitre_id);
		}
		if (isset($this->cf)) {
			$this->cf = trim($this->cf);
		}
		if (isset($this->nc)) {
			$this->nc = trim($this->nc);
		}
		if (isset($this->fk_intervention)) {
			$this->fk_intervention = trim($this->fk_intervention);
		}
		if (isset($this->pa)) {
			$this->pa = trim($this->pa);
		}
		if (isset($this->ev)) {
			$this->ev = trim($this->ev);
		}
		// Check parameters
		// Put here code to add control on parameters values
		// Update request
		
		
		$sql = "UPDATE " . MAIN_DB_PREFIX . "cstmd_interv_questions SET";
		$sql.= " position='" . $this->db->escape($this->position) . "',";
		$sql.= " label_question='" . $this->db->escape($this->label_question) . "',";
		$sql.= " etat_lieux='" . $this->db->escape($this->etat_lieux) . "',";
		$sql.= " titre_recommandation='"  . $this->db->escape($this->titre_recommandation) . "',";
		$sql.= " recommandation='" . $this->db->escape($this->recommandation) . "',";
		$sql.= " dater='" . $this->db->idate($this->dater) . "',";
		$sql.= " reference='" . $this->db->escape($this->reference) . "',";
		$sql.= " texte_reglementaire='" . $this->db->escape($this->texte_reglementaire) . "',";
		$sql.= " fk_chapitre=" . $this->db->escape($this->fk_chapitre_id) . ",";
		$sql.= " cf=" . (strval($this->cf)!=''?"'".$this->cf."'":"0") . ",";
		$sql.= " nc=" .(strval($this->nc)!=''?"'".$this->nc."'":"0") . ",";
		$sql.= " fk_intervention=" . $this->db->escape($this->fk_intervention) . ",";
		$sql.= " pa=" . (strval($this->pa)!=''?"'".$this->pa."'":"0")  . ",";
		$sql.= " ev=" . (strval($this->ev)!=''?"'".$this->ev."'":"0") . "";	
		$sql.= " WHERE rowid=" . $this->id;
		$this->db->begin();

		dol_syslog(__METHOD__ . " sql=" . $sql, LOG_DEBUG);
		$resql = $this->db->query($sql);
		if (! $resql) {
			$error ++;
			$this->errors[] = "Error " . $this->db->lasterror();
		}
		
		// Commit or rollback
		if ($error) {
			foreach ($this->errors as $errmsg) {
				dol_syslog(__METHOD__ . " " . $errmsg, LOG_ERR);
				$this->error.=($this->error ? ', ' . $errmsg : $errmsg);
			}
			$this->db->rollback();

			return -1 * $error;
		} else {
			$this->db->commit();

			return 1;
		}
	}

	/**
	 * Delete object in database
	 *
	 * @param User $user User that delete
	 * @param int $notrigger 0=launch triggers after, 1=disable triggers
	 * @return int <0 if KO, >0 if OK
	 */
	public function delete($user)
	{
		global $conf;
		$error = 0;
		// Remove associated users
	
		$sql = "DELETE FROM " . MAIN_DB_PREFIX . "cstmd_interv_questions";
		$sql .= " WHERE rowid = " . $this->id;
		dol_syslog(get_class($this) . "::delete ", LOG_DEBUG);
		$resql = $this->db->query($sql);
		if (! $resql) {
			$error ++;
			$this->errors[] = "Error " . $this->db->lasterror();
		}
		
		if (!$error)
		{
			$this->db->commit();

			return 1;
		}
		else
		{
			dol_syslog($this->error, LOG_ERR);
			$this->db->rollback();
			return -1;
		}
		
		if (!$error) {
			return 1;
		} else {
			$this->error = $this->db->lasterror();
			return - 1;
		}
	}
	
}
