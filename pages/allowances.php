<?php 
	if($_POST['allowsubmit']){
	
		echo $site->allowins(array("id"=>"","name"=>$_POST['nm'],"designation"=>$_POST['desig'],"travel"=>$_POST['travel'],"recom"=>$_POST['recom'],"dt"=>$_POST['dt']));
	}
	?>
<div class="main-attend">
	<div class="alert alert-danger">Fields Marked * are Mandatory</div>
	<div class="emphead"><p>Petrol Reimbursement</p></div>
	<form method="post" onsubmit="return validateallowance()">
	<div class="row"><div class="alert alert-danger" id="nmerr">Select Name</div><div class="col1"><div class="alert alert-danger">*</div>Name : </div><div class="col2"><select name="nm" id="nm" class="inp-form">
	<option value="-">---Select---</option>
	<?php echo $site->optionsval("employee","id,fname,lname"); ?>
	</select></div></div>
	<div class="row"><div class="alert alert-danger" id="dserr">Select Designation</div><div class="col1"><div class="alert alert-danger">*</div>Designation : </div><div class="col2"><select name="desig" id="desig" class="inp-form">
	<option value="-">---Select---</option>
	<?php echo $site->optionsval("desig_master","id,desig"); ?>
	</select></div></div>
	<div class="row"><div class="alert alert-danger" id="trerr">Enter Travelling Purpose</div><div class="col1"><div class="alert alert-danger">*</div>Travelling Purpose : </div><div class="col2"><input type="text" name="travel" id="travel" class="inp-form" placeholder="Travelling Purpose"/></div></div>
	<div class="row"><div class="alert alert-danger" id="recerr">Select Name</div><div class="col1"><div class="alert alert-danger">*</div>Recommended By : </div><div class="col2"><select name="recom" id="recom" class="inp-form">
	<option value="-">---Select---</option>
	<?php echo $site->optionsval("employee","id,fname,lname"); ?>
	</select></div></div>
	<div class="row"><div class="alert alert-danger" id="dterr">Select Date</div><div class="col1"><div class="alert alert-danger">*</div>Date : </div><div class="col2"><input type="text" name="dt" id="dt" class="inp-form" placeholder="yyyy-mm-dd"/></div></div>
	
	<div class="clear"></div>
	<hr/>
	<div class="formhead">
	<div class="sno">S.No.</div>
	<div class="empname1">From</div>
	<div class="empname1">To</div>
	<div class="empname1">Vehicle</div>
	<div class="empname1">Total Kms</div>
	<div class="empname1">Total Amount</div>
	</div>
	<div class="clear"></div>
	
		<?php echo $site->allowances(); ?>
		<div class="row"><div class="col1">.</div><div class="col2"><input type="submit" name="allowsubmit" class="submitBtn1" /></div></div>
		<div class="clear"></div>
	</form>
	
	
	
</div>