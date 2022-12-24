<div class="main-attend">

	<div class="emphead"><p>View Daily Attendance</p></div>
	<form method="post">
	<div class="formhead"><div class="datatable">Select Date<input type="text" name="dt" id="dt" class="pass2" placeholder="yyyy-mm-dd" />
	<input type="submit" name="submitval" class="submitBtn4" value="Refresh Data" /></div></div>
	</form>
	 <div class="formhead">
    <div class="sno">Sr. No.</div>
    <div class="empname">Name of the Employee</div>
   	<div class="attend">Attendance</div>
    </div>
    <hr/>
    <div class="clear"></div>
    
    <?php
     

    if($_POST['submitval']){
    if(($_POST['dt'] == "")){
    	echo '<script>alert("Select Month and Year")</script>';
    }
    else{
    	echo $site->viewattend($_POST['dt']);
    	}
    }
    else{
    	echo $site->viewattend(DT);
    }
		
	?>
    
</div>