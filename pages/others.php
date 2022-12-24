
<?php
require_once('admin/constants.php');
function __autoload($classname) {
    $lower = strtolower($classname);
    include("admin/$lower.php");   
}
$site = new Site;
if($_REQUEST['action'] == 'guestout'){
		$val = $site->guest($_REQUEST['id']);
		if($val){
		date_default_timezone_set("Asia/Kolkata");
		echo date("H:i:s");
		echo "val = ".$val;
		}
		echo "val = ".$val;

}
	
?>