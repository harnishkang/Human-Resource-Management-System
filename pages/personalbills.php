<div class="salary">
	<div class="emphead"><p>Personal Bills</p></div>
	<?php 
	if($_POST['persubmit']){
		echo $site->perbill(array("id"=>"","billdt"=>$_POST['dt'],"relto"=>$_POST['relto'],"rem"=>$_POST['rem'],"amt"=>$_POST['amt'],"postedby"=>$_SESSION['login_user'],"postedon"=>DT,"concper"=>$_POST['concper']));
	}
	?>
	<div class="billdet">
		<div class="alert alert-danger">Fields Marked * are Mandatory</div>
		<form method="post" onsubmit="return validateperbills()">

        <div class="row"><div class="alert alert-danger" id="concerr">Enter Concerned Person</div><div class="col1"><div class="alert alert-danger">*</div><label for="concper">Concerned Person : </label></div><div class="col2">
        <input type="text" name="concper" id="concper" class="inp-form" />
        	
        </div></div>

		<div class="row"><div class="alert alert-danger" id="dterr">Enter Bill Date</div><div class="col1"><div class="alert alert-danger">*</div><label for="dt">Bill Date : </label></div><div class="col2"><input type="text" name="dt" id = "dt" class="inp-form" /></div></div>

		<div class="row"><div class="alert alert-danger" id="relerr">Enter Data</div><div class="col1"><div class="alert alert-danger">*</div><label for="relto">Related To : </label></div><div class="col2"><input type="text" name="relto" id="relto" class="inp-form" /></div></div>

		<div class="row"><div class="col1"><label for="rem">Remark : </label></div><div class="col2"><input type="text" name="rem" class="inp-form" /></div></div>

		<div class="row"><div class="alert alert-danger" id="amterr">Enter Amount</div><div class="col1"><div class="alert alert-danger">*</div><label for="amt">Amount : </label></div><div class="col2"><input type="text" name="amt" id="amt" class="inp-form" /></div></div>

		<div class="row"><div class="col1">.</div><div class="col2"><input type="submit" name="persubmit" class="submitBtn" /></div></div>
		<div class="clear"></div>
		</form>
	</div>
</div>