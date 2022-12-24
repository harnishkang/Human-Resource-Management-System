<div class="monthly-attend">

	<div class="monthly-emphead"><p>Monthly Attendance</p></div>
	<form method="post">
	<div class="monthly-formhead"><div class="datatable">Select Month<select class="inp-form" id="selmon" name="selmon">
	<option value="select">---Select Month---</option>
	<option value="01">January</option>
	<option value="02">February</option>
	<option value="03">March</option>
	<option value="04">April</option>
	<option value="05">May</option>
	<option value="06">June</option>
	<option value="07">July</option>
	<option value="08">August</option>
	<option value="09">September</option>
	<option value="10">October</option>
	<option value="11">November</option>
	<option value="12">december</option>
	</select>
	Select Year
	<Select class="inp-form" id="selyr" name="selyr">
	<option value="select">---Select Year---</option>
	<option value="2019">2019</option>
	</select>
	
	<input type="submit" name="submitval" class="submitBtn4" value="Refresh Data" /></div></div>
	</form>
	<div class="monthly-formhead">
    <hr/>
 	<?php if($_SESSION['login_user'] == 'admin') {?>
    <div class="monthly-sno">S.No.</div>
    <div class="monthly-empname">Name of the Employee</div>
    
    <?php echo $site->colhead(); 
	}
	?>
    <div class="clear"></div>
    <hr/>
    </div>
    <?php 
    if(($_POST['selyr'] == "select")||($_POST['selmon'] == "select")){
    	echo '<script>alert("Select Month and Year")</script>';
    }
    else{
	if($_SESSION['login_user'] == 'admin'){
    if($_POST['submitval']){
    	echo $site->monthlyattend($_POST['selyr'],$_POST['selmon']); 
    }
    else{
    	echo $site->monthlyattend(YR,MNT); 
  }
    }
	else{
		?>
        <div class="cal">
        <div class="calhd">
        	<ul>
            	<li>Sunday</li>
                <li>Monday</li>
                <li>Tuesday</li>
                <li>Wednesday</li>
                <li>Thursday</li>
                <li>Friday</li>
                <li>Saturday</li>
            </ul>
        </div>
        <div class="calbody">
        <?php
		if($_POST['submitval']){
    	echo $site->empmonthlyattend($_POST['selyr'],$_POST['selmon']); 
    }
    else{
    	echo $site->empmonthlyattend(YR,MNT); 
  }
	}
	}
	
    ?>
    
    </div>
    </div>
    <div class="clear"></div>
</div>