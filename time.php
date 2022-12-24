<?php
require_once('admin/constants.php');
function __autoload($classname) {
    $lower = strtolower($classname);
    include("admin/$lower.php");   
}
$site = new Site;

if($_REQUEST['action'] == 'getTime'){
		date_default_timezone_set("Asia/Kolkata");
	echo date("H:i:s");
	
}
	
else if($_REQUEST['action'] == 'guestout'){
	$val = $site->guest($_REQUEST['id']);
	if($val){
		echo date("H:i:s");
	}
}

else if($_REQUEST['action'] == 'getdata'){
	$val = $site->viewempdet($_REQUEST['nxtid']);
	echo $val;
}
else if($_REQUEST['action'] == 'getleave'){
	$val = $site->calendarfirst($_REQUEST['nxtid'],$_REQUEST['mnt'],$_REQUEST['yr']);
	echo $val;
}
	
else if($_REQUEST['action'] == 'getcity'){
	$val = $site->optionsvalpart("city_master","id,city","stid=".$_REQUEST['stateid']);
	echo $val;
}
?>