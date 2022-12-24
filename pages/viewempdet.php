<div class="empdet">
<div class="emphead"><p>Employee Detail</p></div>
<hr/>
<div class="viewempdet">
<?php	
	if($_SESSION['login_user'] == 'admin'){
	
		echo $site->viewempdet("all"); 
	}
	else{
	
		echo $site->viewempdetid($_SESSION['menuid']);
	}
?>

	</div>
	
</div>