<div class="salary">
	<div class="emphead"><p>Company Bills</p></div>
	<?php 
	if($_POST['persubmit']){
		echo $site->compbill(array("id"=>"","billdt"=>$_POST['dt'],"duedt"=>$_POST['duedt'],"typ"=>$_POST['typ'],"rem"=>$_POST['rem'],"amt"=>$_POST['amt'],"paidto"=>$_POST['paidto'],"postedby"=>$_SESSION['login_user'],"postedon"=>DT));
	}
	?>
	<div class="billdet">
		<div class="alert alert-danger">Fields Marked * are Mandatory</div>
		<form method="post" onsubmit="return validatecompbills()">
		<div class="row"><div class="alert alert-danger" id="dterr">Enter Bill Date</div><div class="col1"><div class="alert alert-danger">*</div><label for="dt">Bill Date : </label></div><div class="col2"><input type="text" name="dt" id = "dt" class="inp-form" /></div></div>
		<div class="row"><div class="alert alert-danger" id="dt1err">Enter Due Date</div><div class="col1"><div class="alert alert-danger">*</div><label for="dt">Due Date : </label></div><div class="col2"><input type="text" name="duedt" id = "dt1" class="inp-form" /></div></div>
		<div class="row"><div class="alert alert-danger" id="typerr">Select Type</div><div class="col1"><div class="alert alert-danger">*</div><label for="typ">Type : </label></div><div class="col2"><select name="typ" class="inp-form" id="typ">
		<option value="-">---Select---</option>
		<?php echo $site->typlist(); ?>
		</select></div></div>
		<div class="row"><div class="col1"><label for="rem">Remark : </label></div><div class="col2"><input type="text" name="rem" id="rem" class="inp-form" /></div></div>
		<div class="row"><div class="alert alert-danger" id="amterr">Enter Amount</div><div class="col1"><div class="alert alert-danger">*</div><label for="amt">Amount : </label></div><div class="col2"><input type="text" name="amt" id="amt" class="inp-form" /></div></div>
		<div class="row"><div class="alert alert-danger" id="paiderr">Select Employee</div><div class="col1"><div class="alert alert-danger">*</div><label for="paidto">Paid To : </label></div><div class="col2">
		<select name="paidto" id="paidto" class="inp-form">
		<option value="select">---Select---</option>
		<?php echo $site->optionsval("employee","id,fname,lname"); ?>
		</select>
		</div></div>
		<div class="row"><div class="col1">.</div><div class="col2"><input type="submit" name="persubmit" class="submitBtn" /></div></div>
		<div class="clear"></div>
		</form>
	</div>
</div>