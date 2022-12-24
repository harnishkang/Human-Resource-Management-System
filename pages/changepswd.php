<div class="empdet">

<div class="emphead"><p>Change Password</p></div>
<?php
if($_POST['changesubmit']){
	echo "in";
	echo $site->changepswd();
}
if($_POST['login']){
	header("Location:/hr/");
}
?>
<form method="post">
<div class="row"><div class="col1">Username : </div><div class="col2"><input type="text" name="usr" class="inp-form" /></div></div>
<div class="row"><div class="col1">Old Password : </div><div class="col2"><input type="text" name="oldpwd" class="inp-form" /></div></div> 
<div class="row"><div class="col1">New Password : </div><div class="col2"><input type="text" name="newpwd" class="inp-form" /></div></div>
<div class="row"><div class="col1">Confirm Password : </div><div class="col2"><input type="text" name="confpwd" class="inp-form" /></div></div>
<div class="row"><div class="col1"></div><div class="col2"><input type="submit" name="changesubmit" class="submitBtn1" /><input type="submit" name="login" class="submitBtn1" value="Login"/></div></div>
</form>
<div class="clear"></div>
</div>