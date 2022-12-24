<?php

include_once("inc/header.php");
?>
<div class="maincontent">

<?php
 if($_SESSION['login_user']){
	 isset($p) ? include("pages/$p.php") : include("pages/home.php") ;
}
else{
	isset($p) ? include("pages/$p.php") : include("pages/login.php") ;
}
?>
</div>	
		
<?php
include_once("inc/footer.php");
?>