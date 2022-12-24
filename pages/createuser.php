<div class="empdet">

<div class="emphead"><p>Create User</p></div>
<?php
if($_POST['usersubmit']){
	echo $site->createuser(array("fname"=>$_POST['fname'],"lname"=>$_POST['lname'],"uname"=>$_POST['uname'],"pswd"=>$_POST['pswd'],"email"=>$_POST['email'],"cont"=>$_POST['cont'],"status"=>$_POST['status'],"createdon"=>DT));
}
?>
<form method="post">
<div class="row"><div class="col1"><label for="fname">First Name : </label></div><div class="col2"><input type="text" name="fname" class="inp-form" /></div></div>
<div class="row"><div class="col1"><label for="lname">Last Name : </label></div><div class="col2"><input type="text" name="lname" class="inp-form" /></div></div>
<div class="row"><div class="col1"><label for="uname">User Name : </label></div><div class="col2"><input type="text" name="uname" class="inp-form" /></div></div>
<div class="row"><div class="col1"><label for="pswd">Password : </label></div><div class="col2"><input type="Password" name="pswd" class="inp-form" /></div></div>
<div class="row"><div class="col1"><label for="email">Email : </label></div><div class="col2"><input type="text" name="email" class="inp-form" /></div></div>
<div class="row"><div class="col1"><label for="cont">Contact : </label></div><div class="col2"><input type="text" name="cont" class="inp-form" /></div></div>
<div class="row"><div class="col1"><label for="status">Status : </label></div><div class="col2"><select name="status" class="inp-form">
<option value='-'>---Select---</option>
<option value='active'>Active</option>
<option value='inactive'>InActive</option>
</select></div></div>
<div class="row"><div class="col1"><br/></div><div class="col2"><input type="submit" name="usersubmit" class="submitBtn1" /></div></div>
<div class="clear"></div>
</form
</div>