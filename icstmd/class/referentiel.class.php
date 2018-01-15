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
class Referentiel  extends CommonObject
{

    /** @var string Error code or message */
	public $error;
    /** @var array Several error codes or messages */
	public $errors = array();
    public $element='cstmd_referentiels';
    public $table_element = 'cstmd_referentiels';
	/**
	 * Regular product
	 */
	//const TYPE_VEHICLE = 0;
    /** @var int An example ID */
	public $id;
    /** @var mixed An example property */
	public $label; 

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
		if (isset($this->label)) {
			$this->label = trim($this->label);
		}

		// Check parameters
		// Put here code to add control on parameters values
		// Insert request
		$sql = "INSERT INTO " . MAIN_DB_PREFIX . "cstmd_referentiels(";
		$sql.= " label";
		$sql.= ") VALUES (";
		$sql.= (strval($this->label)!=''?"'".$this->label."'":"null"). "";
		$sql.= ")";
		$this->db->begin();

		dol_syslog(get_class($this) . "::create ", LOG_DEBUG);
		$resql = $this->db->query($sql);
		if (! $resql) {
			$error ++;
			$this->errors[] = "Error " . $this->db->lasterror();
		}

		if (! $error) {
			$this->id = $this->db->last_insert_id(MAIN_DB_PREFIX . "cstmd_referentiels");
		}
		
		// For avoid conflicts if trigger used
		if (empty($conf->global->MAIN_EXTRAFIELDS_DISABLED)) {
			$result = $this->insertExtraFields();
			if ($result < 0) {
				$error ++;
			}
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

			return $this->id;
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
		$sql = "SELECT * ";
		$sql.= " FROM ".MAIN_DB_PREFIX."cstmd_referentiels  ";
		$sql.= " where rowid = " . $id;
		dol_syslog(get_class($this) . "::fetch ", LOG_DEBUG);
		$resql = $this->db->query($sql);
		if ($resql) {
			if ($this->db->num_rows($resql)) {
				$obj = $this->db->fetch_object($resql);
				$this->id = $obj->rowid;
				$this->label = $obj->label;
			}
			$this->db->free($resql);
			require_once (DOL_DOCUMENT_ROOT . '/core/class/extrafields.class.php');
			$extrafields = new ExtraFields($this->db);
			$extralabels = $extrafields->fetch_name_optionals_label($this->table_element, true);
			if (count($extralabels) > 0) {
				$this->fetch_optionals($this->id, $extralabels);
			}
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
		if (isset($this->label)) {
			$this->label = trim($this->label);
		}

		// Check parameters
		// Put here code to add control on parameters values
		// Update request
		
		$sql = "UPDATE " . MAIN_DB_PREFIX . "cstmd_referentiels SET";
		$sql.= " label=" . (strval($this->label)!=''?"'".$this->label."'":"null") . "";
		$sql.= " WHERE rowid=" . $this->id;

		$this->db->begin();

		dol_syslog(__METHOD__ . " sql=" . $sql, LOG_DEBUG);
		$resql = $this->db->query($sql);
		if (! $resql) {
			$error ++;
			$this->errors[] = "Error " . $this->db->lasterror();
		}
		
		// For avoid conflicts if trigger used
		if (empty($conf->global->MAIN_EXTRAFIELDS_DISABLED)) {
			$result = $this->insertExtraFields();
			if ($result < 0) {
				$error ++;
			}
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

			return $this->id;
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
		// Remove associated users
		$error = 0;
		$resql = false;
		$sql = "DELETE FROM " . MAIN_DB_PREFIX . "cstmd_referentiels";
		$sql .= " WHERE rowid = " . $this->id;
		dol_syslog(get_class($this) . "::delete ", LOG_DEBUG);
		$resql = $this->db->query($sql);
		if ($resql !== false) {
			$error ++;
			$this->errors[] = "Error " . $this->db->lasterror();
		}
		
		// Removed extrafields
		if ($error !== 0) {
			// For avoid conflicts if trigger used
			if (empty($conf->global->MAIN_EXTRAFIELDS_DISABLED)) {
				$result = $this->deleteExtraFields();
				if ($result < 0) {
					$error ++;
					dol_syslog(get_class($this) . "::delete erreur " . $error . " " . $this->error, LOG_ERR);
				}
			}
		}
		
		if ($error !== 0) {
			return 1;
		} else {
			$this->error = $this->db->lasterror();
			return - 1;
		}
		
	}
	
	/**
	 *  Return a link to the user card (with optionaly the picto)
	 * 	Use this->id,this->lastname, this->firstname
	 *
	 *	@param	int		$withpicto			Include picto in link (0=No picto, 1=Include picto into link, 2=Only picto)
	 *	@param	string	$option				On what the link point to
     *  @param	integer	$notooltip			1=Disable tooltip
     *  @param	int		$maxlen				Max length of visible user name
     *  @param  string  $morecss            Add more css on link
	 *	@return	string						String with URL
	 */
	function getNomUrl($rowid ,$fk_product_id =0, $withpicto=0, $option='', $notooltip=0, $maxlen=24, $morecss='')
	{
		global $langs, $conf, $db;
        global $dolibarr_main_authentication, $dolibarr_main_demo;
        global $menumanager;


        $result = '';
		$resu = '';
        $companylink = '';
		$id = 0;
		if(!empty($rowid) && $rowid !=-1){
			$id = $rowid;
			$page = 'reservations';
			
		}else{
			$id = $this->id;
			$page = 'book';
		}
		$sql = "SELECT ";
		$sql.= " label";
		$sql.= " from ".MAIN_DB_PREFIX."product ";
		$sql.= " where rowid = ".$fk_product_id;
		$result=$db->query($sql);
		if ($result)
		{
			if ($db->num_rows($result)) {
				$obj = $db->fetch_object($result);
				$label = '<u>' . $langs->trans("Referentiel") . '</u>';
				$label.= '<div width="100%">';
				$label.= '<b>' . $langs->trans('Title') . ':</b> ' . $obj->label;
				$link = '<a href="'.dol_buildpath('/dolibooks/book/card.php', 1) . '?id='.$this->id.'"';
				$link.= ($notooltip?'':' title="'.dol_escape_htmltag($label, 1).'" class="classfortooltip'.($morecss?' '.$morecss:'').'"');
				$link.= '>';
				$linkend='</a>';
				if ($withpicto)
				{
					$resu.=($link.img_object(($notooltip?'':$label), 'label', ($notooltip?'':'class="classfortooltip"')).$linkend);
					if ($withpicto != 2) $resu.=' ';
				}
				$resu.= $link . $obj->label . $linkend;
			}
			$db->free($result);
		}
		return $resu;
	}
	
	/**
	 * Load object in memory from database
	 *
	 * @param int $id Id object
	 * @return int <0 if KO, >0 if OK
	 */
	public function nbchapitre($id)
	{
		global $langs;
		$nb_chapitre = -1;
		$sql = "SELECT ";
		$sql.= " count(fk_referentiel_id) as 'nb_chapitre' ";
		$sql.= " FROM ".MAIN_DB_PREFIX."cstmd_chapitres  ";
		$sql.= " where fk_referentiel_id = " . $id;
		dol_syslog(__METHOD__ . " sql=" . $sql, LOG_DEBUG);
		$resql = $this->db->query($sql);
		if ($resql) {
			for($cmp=0;$cmp<$this->db->num_rows($resql);$cmp++){
				$obj = $this->db->fetch_object($resql);
				$nb_chapitre = $obj->nb_chapitre;
			}
			$this->db->free($resql);

		} else {
			$this->error = "Error " . $this->db->lasterror();
			dol_syslog(__METHOD__ . " " . $this->error, LOG_ERR);

			return -1;
		}
		return $nb_chapitre;
		
	}
	
	/**
	 * Load object in memory from database
	 *
	 * @param int $id Id object
	 * @return int <0 if KO, >0 if OK
	 */
	public function nbquestion($id)
	{
		global $langs;
		$nb_question = 0;
		$array = array();
		$sql = "SELECT ";
		$sql.= " `rowid` ";
		$sql.= " FROM ".MAIN_DB_PREFIX."cstmd_chapitres  ";
		$sql.= " where fk_referentiel_id = " . $id;
		dol_syslog(__METHOD__ . " sql=" . $sql, LOG_DEBUG);
		$resql = $this->db->query($sql);
		if ($resql) {
			for($cmp=0;$cmp<$this->db->num_rows($resql);$cmp++){
				$obj = $this->db->fetch_object($resql);
				$array[$obj->rowid] = $obj->rowid;
			}
			$this->db->free($resql);

		} else {
			$this->error = "Error " . $this->db->lasterror();
			dol_syslog(__METHOD__ . " " . $this->error, LOG_ERR);

			return -1;
		}
		foreach($array as $k => $v){
			$sql = "SELECT ";
			$sql.= " count(fk_chapitre_id) as 'nb_question' ";
			$sql.= " FROM ".MAIN_DB_PREFIX."cstmd_questions  ";
			$sql.= " where fk_chapitre_id = " . $v;
			dol_syslog(__METHOD__ . " sql=" . $sql, LOG_DEBUG);
			$resql = $this->db->query($sql);
			if ($resql) {
				for($cmp=0;$cmp<$this->db->num_rows($resql);$cmp++){
					$obj = $this->db->fetch_object($resql);
					$nb_question+= $obj->nb_question;
				}
				$this->db->free($resql);

			} else {
				$this->error = "Error " . $this->db->lasterror();
				dol_syslog(__METHOD__ . " " . $this->error, LOG_ERR);

				return -1;
			}
		}
		return $nb_question;
	}
}
