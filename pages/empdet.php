<div class="empdet">
<form method="post" enctype="multipart/form-data">
<div class="emphead"><p>Employee Detail</p></div>
<hr/>

<?php

$file1 = addslashes(file_get_contents($_FILES['file']['tmp_name']));
$file2 = addslashes(file_get_contents($_FILES['file1']['tmp_name']));
$file3 = addslashes(file_get_contents($_FILES['file2']['tmp_name']));
$sval = 0;
	if($_POST['empsub']){
		if(!$file1){
			$sval = 1;
			?>
			<script type="text/javascript">
				alert("Select Employee Image")
			</script>
			<?php
		}
		else if(!$file2){
			$sval = 1;
			?>
			<script type="text/javascript">
				alert("Select ID Proof 1")
			</script>
			<?php
		}
		else if(!$file3){
			$sval = 1;
			?>
			<script type="text/javascript">
				alert("Select ID Proof 2")
			</script>
			<?php
		}
		else if(!$_POST['fname']){
			$sval = 1;
			?>
			<script type="text/javascript">
				alert("Enter First Name")
			</script>
			<?php
		}
		else if(!$_POST['last']){
			$sval = 1;
			?>
			<script type="text/javascript">
				alert("Enter Last Name")
			</script>
			<?php
		}
		else if(!$_POST['address1']){
			$sval = 1;
			?>
			<script type="text/javascript">
				alert("Enter Address")
			</script>
			<?php
		}
		else if(!$_POST['state']){
			$sval = 1;
			?>
			<script type="text/javascript">
				alert("Select State")
			</script>
			<?php
		}
		else if(!$_POST['city']){
			$sval = 1;
			?>
			<script type="text/javascript">
				alert("Select City")
			</script>
			<?php
		}
		
		else if(!$_POST['pin']){
			$sval = 1;
			?>
			<script type="text/javascript">
				alert("Enter PinCode")
			</script>
			<?php
		}
		else if((!$_POST['contact']) || (!preg_match('/^[0-9]{10}+$/', $_POST['contact']))){
			$sval = 1;
			?>
			<script type="text/javascript">
				alert("Enter Valid Contact Number")
			</script>
			<?php
		}
		else if((!$_POST['email']) || (!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL))){
			$sval = 1;
			?>
			<script type="text/javascript">
				alert("Enter Valid Email")
			</script>
			<?php
		}
		else if(!$_POST['m']){
			$sval = 1;
			?>
			<script type="text/javascript">
				alert("Select Marital Status")
			</script>
			<?php
		}
		else if(!$_POST['dob']){
			$sval = 1;
			?>
			<script type="text/javascript">
				alert("Enter Date of Birth")
			</script>
			<?php
		}
		else if(!$_POST['qua']){
			$sval = 1;
			?>
			<script type="text/javascript">
				alert("Enter Qualification")
			</script>
			<?php
		}
		
		else if(!$_POST['designation']){
			$sval = 1;
			?>
			<script type="text/javascript">
				alert("Select Designation")
			</script>
			<?php
		}
		else if(!$_POST['bpay']){
			$sval = 1;
			?>
			<script type="text/javascript">
				alert("Enter Basic Pay")
			</script>
			<?php
		}
		else if(!$_POST['jdt']){
			$sval = 1;
			?>
			<script type="text/javascript">
				alert("Enter Joining Date")
			</script>
			<?php
		}
		else if(!$_POST['pt']){
			$sval = 1;
			?>
			<script type="text/javascript">
				alert("Enter Type Permanent/Temporary")
			</script>
			<?php
		}
		else if(!$_POST['yrs']){
			$sval = 1;
			?>
			<script type="text/javascript">
				alert("Enter years of Experience")
			</script>
			<?php
		}
		else if(!$_POST['comp']){
			$sval = 1;
			?>
			<script type="text/javascript">
				alert("Enter Recent Company")
			</script>
			<?php
		}
		

		if($sval != 1){
			
			$imgres = $site->saveimg(array("id"=>"","empimg"=>"$file1"));
			$imgval = $imgres;
			if($imgres != "false"){
				$empres = $site->saveempdet(array("id"=>"","empid"=>$imgval,"fname"=>$_POST['fname'],"lname"=>$_POST['last'],"address1"=>$_POST['address1'],"address2"=>$_POST['address2'],"city"=>$_POST['city'],"state"=>$_POST['state'],"pincode"=>$_POST['pin'],"contact"=>$_POST['contact'],"email"=>$_POST['email'],"mstatus"=>$_POST['m'],"dob"=>$_POST['dob'],"qual"=>$_POST['qua'],"add_qual"=>$_POST['addqua'],"designation"=>$_POST['designation'],"basic_pay"=>$_POST['bpay'],"jdt"=>$_POST['jdt'],"pt"=>$_POST['pt'],"years"=>$_POST['yrs'],"company"=>$_POST['comp'],"remark1"=>$_POST['rem']));
				if($empres=="true"){
					
					echo $site->saveproof(array("id"=>"","idimg"=>"$file2","idimg1"=>"$file3","empimgid"=>$imgres));
					
				}
				else{
					echo "Access Denied";
				}
			}
			else{
				echo "Access Denied";
			}
			}
		
	}

?>
<div class="alert alert-danger">Fields Marked * are Mandatory</div>
<div class="empsubhead"><p>Personal Information</p></div>
<div class="row"><div class="col1"><div class="alert alert-danger">*</div><label for="epic">Employee Image : </label></div><div class="col2"><div class="img" id="img"><p>Click to Upload</p></div><input type="file" name="file" class="file" id="fileInput" style="display:none;"/><p id="pfileInput" class="error_text" style="background:none;display:none;"></p></div></div>

<div class="clear"></div>	
<div class="row"><div class="col1"><div class="alert alert-danger">*</div><label for="fname">First Name : </label></div><div class="col2"><input type="text" name="fname" placeholder="First Name" class="inp-form" /></div></div>
<div class="clear"></div>
<div class="row"><div class="col1"><div class="alert alert-danger">*</div><label for="lname">Last Name : </label></div><div class="col2"><input type="text" name="last" placeholder="Last Name" class="inp-form" /></div></div>
<div class="clear"></div>
<div class="row"><div class="col1"><div class="alert alert-danger">*</div><label for="add1">Address 1 : </label></div><div class="col2"><input type="text" name="address1" placeholder="Address1" class="inp-form" /></div></div>
<div class="clear"></div>
<div class="row"><div class="col1"><label for="add2">Address 2 : </label></div><div class="col2"><input type="text" name="address2" placeholder="Address2" class="inp-form" /></div></div>
<div class="clear"></div>
<div class="row"><div class="col1"><div class="alert alert-danger">*</div><label for="add2">State : </label></div>
<div class="col2"><select name="state" id="state" class="inp-form" onchange="selectcity()">
	
	<option value="-">---Select State---</option>
	<?php echo $site->optionsval("state_Master","id,state") ?>
</select></div></div>

<div class="clear"></div>
<div class="row"><div class="col1"><div class="alert alert-danger">*</div><label for="add2">City : </label></div><div class="col2">
	<select name="city" id="city" class="inp-form">
	
	<option value="-">---Select City---</option>
</select></div></div>

<div class="clear"></div>
<div class="row"><div class="col1"><div class="alert alert-danger">*</div><label for="add2">PinCode : </label></div><div class="col2"><input type="text" name="pin" placeholder="Pin Code" class="inp-form" /></div></div>
<div class="clear"></div>
<div class="row"><div class="col1"><div class="alert alert-danger">*</div><label for="add2">Contact Number : </label></div><div class="col2"><input type="text" name="contact" placeholder="Contact Number" class="inp-form" /></div></div>
<div class="clear"></div>
<div class="row"><div class="col1"><div class="alert alert-danger">*</div><label for="add2">Email : </label></div><div class="col2"><input type="text" name="email" placeholder="Email" class="inp-form" /></div></div>
<div class="clear"></div>
<div class="row"><div class="col1"><div class="alert alert-danger">*</div><label for="add2">Marital Status : </label></div><div class="col2"><select class="inp-form" name="m">
<option>----Select----</option>
<option>Married</option>
<option>Unmarried</option>
</select></div></div>
<div class="clear"></div>
<div class="row"><div class="col1"><div class="alert alert-danger">*</div><label for="add2">Date of Birth : </label></div><div class="col2"><input type="text" name="dob" placeholder="DOB" class="inp-form" /></div></div>
<div class="clear"></div>
<div class="row"><div class="col1"><div class="alert alert-danger">*</div><label for="add2">Qualification : </label></div><div class="col2"><input type="text" name="qua" placeholder="Qualification" class="inp-form" /></div></div>
<div class="clear"></div>
<div class="row"><div class="col1"><label for="add2">Additional Qualification : </label></div><div class="col2"><input type="text" name="addqua" placeholder="Additional Qualification" class="inp-form" /></div></div>
<div class="clear"></div>
<div class="empsubhead"><p>Official Information</p></div>
<div class="row"><div class="col1"><div class="alert alert-danger">*</div><label for="add2">Designation : </label></div><div class="col2"><select name="designation" id="designation" class="inp-form" >
	
	<option value="-">---Select State---</option>
	<?php echo $site->optionsval("desig_master","id,desig") ?>
</select></div></div>
<div class="clear"></div>
<div class="row"><div class="col1"><div class="alert alert-danger">*</div><label for="add2">Basic Pay : </label></div><div class="col2"><input type="text" name="bpay" placeholder="Basic Pay" class="inp-form" /></div></div>
<div class="clear"></div>
<div class="row"><div class="col1"><div class="alert alert-danger">*</div><label for="add2">Joining Date : </label></div><div class="col2"><input type="text" name="jdt" id="dt" placeholder="Joining Date" class="inp-form" /></div></div>
<div class="clear"></div>
<div class="row"><div class="col1"><div class="alert alert-danger">*</div><label for="add2">Permanent / Temporary : </label></div><div class="col2"><input type="text" name="pt" placeholder="Permanent / Temporary" class="inp-form" /></div></div>
<div class="clear"></div>
<div class="empsubhead"><p>Work Experience</p></div>
<div class="row"><div class="col1"><div class="alert alert-danger">*</div><label for="add2">Years : </label></div><div class="col2"><input type="text" name="yrs" placeholder="Years" class="inp-form" /></div></div>
<div class="clear"></div>
<div class="row"><div class="col1"><div class="alert alert-danger">*</div><label for="add2">Company : </label></div><div class="col2"><input type="text" name="comp" placeholder="Company" class="inp-form" /></div></div>
<div class="clear"></div>
<div class="row"><div class="col1"><label for="add2">Remark : </label></div><div class="col2"><input type="text" name="rem" placeholder="Remark" class="inp-form" /></div></div>
<div class="clear"></div>
<div class="empsubhead"><p>Identity Proof</p></div>
<div class="row"><div class="col1"><div class="alert alert-danger">*</div><label for="epic">Employee ID Proof : </label></div><div class="col2"><div class="img1" id="img1"><p>Click to Upload</p></div><input type="file" name="file1" class="file" id="fileInput1" style="display:none;"/><p id="pfileInput" class="error_text" style="background:none;display:none;"></p>
<div class="img2" id="img2"><p>Click to Upload</p></div><input type="file" name="file2" class="file" id="fileInput2" style="display:none;"/><p id="pfileInput" class="error_text" style="background:none;display:none;"></p>
</div></div>

<div class="clear"></div>
<div class="row"><div class="col1">.</div><div class="col2"><input type="submit" name="empsub" class="submitBtn" value="Submit" /></div></div>
<div class="clear"></div>

</form>

</div>

