<div class="empdet">
<form method="post" enctype="multipart/form-data">
<div class="emphead"><p>Employee Detail</p></div>

<hr/>

<div class="empsubhead"><p>Personal Information</p></div>
<?php
	if($_POST['editemp']){
		$file1 = addslashes(file_get_contents($_FILES['file']['tmp_name']));
		if($file1){
			$imgres = $site->editprofile("empimg='".$file1."'");
		}	
	echo $site->editdet("fname='".$_POST['fname']."',lname='".$_POST['last']."',address1='".$_POST['address1']."',address2='".$_POST['address2']."',city='".$_POST['city']."',state='".$_POST['state']."',pincode='".$_POST['pin']."',contact='".$_POST['contact']."',email='".$_POST['email']."',mstatus='".$_POST['m']."',dob='".$_POST['dob']."',qual='".$_POST['qua']."',add_qual='".$_POST['addqua']."',designation='".$_POST['designation']."',basic_pay='".$_POST['bpay']."',jdt='".$_POST['jdt']."',pt='".$_POST['pt']."',years='".$_POST['yrs']."',company='".$_POST['comp']."',remark1='".$_POST['rem']."'");
	
	$file2 = addslashes(file_get_contents($_FILES['file1']['tmp_name']));
		if($file2){
			$imgres = $site->editid("idimg='".$file2."'");
		}
	}

if($_POST['bakemp']){
	header("Location:/hr/?p=empreport");
}
?>
	
<?php 
	echo $site->empfetch();
?>
<div class="row"><div class="col1">.</div><div class="col2"><input type="submit" name="editemp" class="submitBtn" value="Edit" /><input type="submit" name="bakemp" class="submitBtn" value="Back" /></div></div>

</form>
<div class="clear"></div>
</div>