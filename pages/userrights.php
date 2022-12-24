<div class="empdet">
	<div class="emphead"><p>User Rights</p></div>
	<div class="row"><p class="alert">* Select User before update or view rights. </p></div>
	<?php
	if($_POST['submitrights']){
		echo $site->updaterights();
	}
	?>
	<form method="post">
	<div class="row"><div class="col1"><label for="user">Select User : </lebel></div><div class="col2"><select name="user" class="inp-form">
	<option value="-">---Select---</option>
	<?php echo $site->userlist(); ?>
	</select></div></div>
	<div class="row">
	<div class="col1"><input type="submit" name="submitrights" class="submitBtn1" value="Update Rights"/></div>
	<div class="col2"><input type="submit" name="viewrights" class="submitBtn1" value="View Rights"/></div>
	</div>
	<div class="empsubhead"><p>Assign Rights</p></div>
	<div class="row">
	<div class="sno headfont">S.No.</div>
	<div class="line"></div>
	<div class="empname line-font headfont">Menu</div>
	<div class="line"></div>
	<div class="empname line-font headfont">Sub Menu</div>
	<div class="line"></div>
	<div class="sno headfont">Rights<br/><input type="checkbox" id="allrights" name="all" onchange="chkallrights();"/></div>
	</div>
	<div class="clear"></div>
	<hr/>
	<?php
	if($_POST['viewrights']){
		echo $site->viewuser($_POST['user']);
	}
	else{
		echo $site->viewuser($_SESSION['loginid']);
	}
	?>
	<div class="row"><div class="col1"></div><div class="col2"></div></div>
	<div class="clear"></div>
	</form>
</div>