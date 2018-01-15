<?php
// Load Dolibarr environment
$res = @include ("../../main.inc.php"); // For root directory
if (! $res)
	$res = @include ("../../../main.inc.php"); // For "custom" directory
if (! $res)
	die("Include of main fails");

$search = GETPOST('option');

	// Do Prepared Query 
	$sql = " SELECT rowid,position,chapitre ";
	$sql .= " FROM " . MAIN_DB_PREFIX ."cstmd_chapitres";
	$sql.= " where chapitre LIKE '%".$search."%' LIMIT 40 ";
	$resql = $db->query($sql);
	if ($resql)
	{
		$num = $db->num_rows($resql);
		$i = 0;
		$arrayAccount = array();
		if($num>=1){
			while ($i < $num)
			{
				$obj = $db->fetch_object($resql);
				$arrayAccount[] = array('id' => $obj->rowid, 'text' => $obj->position.' '.$obj->chapitre);
				$i++;
			}
		}else{
			$arrayAccount[] = array('id' => '0', 'text' => $langs->trans('No Chapitre Found'));
		}
	}
	$db->free($resql);
	
	echo json_encode($arrayAccount);
?>

