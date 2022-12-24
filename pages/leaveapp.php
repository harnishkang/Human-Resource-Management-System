<div class="leave">
<?php
if($_POST['yes']){
	echo $site->approveleave("Y");
}
if($_POST['no']){
	echo $site->approveleave("N");
}
?>
	<div class="popup">
	<form method="post">
	<div class="popcontent">
	<p>Do you want to approve this leave</p>
	<div class="row"><div class="col1"><br/></div><div class="col2"><input type="hidden" class="inp-form" id="leaveval" name="leaveid" /><input type="submit" name="yes" value="Yes" class="submitBtn" /> <input type="submit" name="no" value="No" class="submitBtn" /></div></div>
	
	<div class="clear"></div>
	</div>
	</form>
	</div>
	<div class="printdata" id="printdata">
	<div class="emphead"><p>Leave Applications</p></div>
	<div class="formhead">
	<div class="leavefields" style="width:3%;">S.No.</div>
	<div class="line"></div>
	<div class="leavefields" style="width:14%;">Name</div>
	<div class="line"></div>
	<div class="leavefields" style="width:13%;">Designation</div>
	<div class="line"></div>
	<div class="leavefields" style="width:10%;">Reason</div>
	<div class="line"></div>
	<div class="leavefields" style="width: 6%;">Leave Type</div>
	<div class="line"></div>
	<div class="leavefields" style="width: 3%;">Total</div>
	<div class="line"></div>
	<div class="leavefields" style="width:6%;">From</div>
	<div class="line"></div>
	<div class="leavefields" style="width:6%;">To</div>
	<div class="line"></div>
	<div class="leavefields" style="width:4%;">Previous</div>
	<div class="line"></div>
	<div class="leavefields" style="width:6%;">Applied On</div>
	<div class="line"></div>
	<div class="leavefields" style="width:6%;">Update</div>
	</div>
	<div class="clear"></div>
	<hr/>
	<div class="datatable">
		<?php echo $site->leavedet(); ?>
	</div>
	<div class="clear"></div>
	
	</div>
	<div class="row"><div class="col1"><br/></div><div class="col2"><button class="submitBtn" onclick="printreport();">Print</button></div></div>
	<div class="clear"></div>
</div>
<div class="clear"></div>