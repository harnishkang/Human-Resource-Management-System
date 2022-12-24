<div class="main-attend">
	<div class="emphead">
    <p>Leave Application Form</p>
    </div>
	<?php
	if($_POST['leavesubmit']){
		$sqlres = $site->leaveins(array("id"=>"","name"=>$_POST['nm'],"designation"=>$_POST['desig'],"reason"=>$_POST['leave_stat'],"fulltype"=>$_POST['infull'],"halftype"=>$_POST['inhalf'],"noleave"=>$_POST['noleave'],"fromdt"=>$_POST['fromdt'],"todt"=>$_POST['todt'],"daytype"=>$_POST['halftype'],"applydt"=>$_POST['dt'],"rem"=>$_POST['rem']));
		if($sqlres == 1){
			
			echo $site->sendsms($_POST['nm']);
		
		}
	}
	?>
	<div class="empsubhead"><p>Applicant : </p></div>
	<form method="post">
	<div class="row"><div class="col1">Name : </div><div class="col2">
	<?php	echo $site->upperfields(); ?>
    </div></div>
	<div class="clear"></div>
	<div class="empsubhead"><p>Reason : </p></div>
	<div class="row"><div class="col1">Medical Leave</div><div class="col2"><input type="radio" value = "medical" name="leave_stat"/></div></div>
	<div class="row"><div class="col1">Personal Work</div><div class="col2"><input type="radio" value = "personal" name="leave_stat"/></div></div>
	<div class="row"><div class="col1">Study Leave</div><div class="col2"><input type="radio" value = "study" name="leave_stat"/></div></div>
	<div class="row"><div class="col1">Funeral Leave</div><div class="col2"><input type="radio" value = "funeral" name="leave_stat"/></div></div>
	<div class="row"><div class="col1">Paternity Leave</div><div class="col2"><input type="radio" value = "paternity" name="leave_stat"/></div></div>
	<div class="row"><div class="col1">Full Day</div><div class="col2"><input type="radio" name="lvtype" id="full" onclick="leavechek('full');"/><input type="hidden" name="infull" id="infull" value="N" /></div></div>
	<div class="row"><div class="col1">Half Day</div><div class="col2"><input type="radio" name="lvtype" id="half" onclick="leavechek('half');"/><input type="hidden" name="inhalf" id="inhalf" value="N" /></div></div>
    <div class="row ht"><div class="col1">First Half</div><div class="col2"><input type="radio" value = "FH" name="halftype"/></div></div>
    <div class="row ht"><div class="col1">Second Half</div><div class="col2"><input type="radio" value = "SH" name="halftype"/></div></div>
	<div class="row"><div class="col1">No. of Leaves</div><div class="col2"><input type="text" name="noleave" class="inp-form" /></div></div>
	<div class="row"><div class="col1">From</div><div class="col2"><input type="text" name="fromdt" id="dt" class="inp-form" /></div></div>
	<div class="row"><div class="col1">To</div><div class="col2"><input type="text" name="todt" id="dt1" class="inp-form" /></div></div>
    <div class="row"><div class="col1">Remarks</div><div class="col2"><textarea name="rem"></textarea></div></div>
	<!--<div class="row"><div class="col1">Previous Leaves Taken</div><div class="col2"><input type="text" name="prev" class="inp-form"/></div></div>-->
	<div class="row"><div class="col1">Date</div><div class="col2"><input type="text" name="dt" readonly="readonly" class="inp-form" value="<?php echo DT; ?>"/></div></div>
	<hr/>
	<div class="row"><div class="col1">.</div><div class="col2"><input type="submit" name="leavesubmit" class="submitBtn1" /></div></div>
	</form>
	<div class="clear"></div>
	
	
</div>