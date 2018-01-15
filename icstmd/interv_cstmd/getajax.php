<?php
// Load Dolibarr environment
$res = @include ("../../main.inc.php"); // For root directory
if (! $res)
	$res = @include ("../../../main.inc.php"); // For "custom" directory
if (! $res)
	die("Include of main fails");

$ques = GETPOST('num');
	// Do Prepared Query 
	$sql = "SELECT * ";
	$sql.= " FROM ".MAIN_DB_PREFIX."cstmd_questions ";
	// Add a wildcard search to the search variable
	$sql.= " Where position LIKE '".$ques.".%' ";
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
				$arrayAccount[] = array($obj->position,  $obj->label_question,  $obj->descrition , $ques);
				$i++;
			}
		}
	}
	$db->free($resql);
	echo json_encode($arrayAccount);
?>

