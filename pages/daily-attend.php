<div class="main-attend">
	<div class="emphead"><p>Upload Daily Attendance</p></div>
	<div class="formhead"><div class="datatable">Enter PassWord to Select Date<input type="password" name="pass" class="pass" onKeydown="Javascript: if (event.keyCode==13) viewfield();" /><input type="text" name="dt" id="dt" class="pass1" placeholder="yyyy-mm-dd" /><button name="dateval" class="pass1 submitBtn2" onclick="validatedate()">Add Date</button></div></div>
	<hr/>
    <div class="formhead">
    <div class="sno">Sr. No.</div>
    <div class="empname">Name of the Employee</div>
    <div class="pr">Present<br/><input type="checkbox" name="pr" id="pr" onclick="selectall('pr')"/></div>
    <div class="ab">Absent<br/><input type="checkbox" name="ab" id="ab" onclick="selectall('ab')"/></div>
    <div class="lv">Leave<br/><input type="checkbox" name="lv" id="lv" onclick="selectall('lv')"/></div>
    <div class="half">Half Day<br/><input type="checkbox" name="half" id="half" onclick="selectall('half')"/></div>
    <div class="off">Off<br/><input type="checkbox" name="off" id="off" onclick="selectall('off')"/></div>
    </div>
    <hr/>
    <div class="clear"></div>
    <form method="post">
    <?php echo $site->tableview(); ?>
    <div class="formhead" style="text-align:center;">
    	<input type="hidden" name="dtval" class="dtval" value=<?php echo DT; ?>>
	<input type="submit" name="attendSubmit" class="submitBtn1" value="Submit" />
    </div>
    <div class="clear"></div>
    
	</form>
    <?php
	if($_POST['attendSubmit']){

		echo $site->empattend($_POST['dtval']);
		
	}
	?>
    
</div>