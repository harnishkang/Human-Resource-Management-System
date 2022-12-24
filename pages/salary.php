<div class="salary">

	<div class="emphead"><p>Salary Detail</p></div>
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
	
	<input type="submit" name="submitval" class="submitBtn4" value="Refresh Data" />
	<input type="button" name="print" class="submitBtn4" value="Print" onclick="tablePrint()"/></div></div>
	</form>
	<div id="main-attend1">
    <?php 
	if($_SESSION['login_user'] == 'admin'){ ?>
	<div class="salary-head">Salary Sheet for the Month of <?php echo $_POST['selmon']." ".$_POST['selyr']?> </div>
    <?php }
	?>
	<div class="salary-head">
	
	<hr/>
	
	<div class="salary-sno">S.No.</div>
    <?php 
	if($_SESSION['login_user'] == 'admin'){ ?>
	<div class="salary-name">Name of the Employee</div>
    <?php }
	?>
	<div class="bpay">Basic Pay</div>
	<div class="bpay">Month-Year</div>
	<div class="stat">P</div>
	<div class="stat">A</div>
	<div class="stat">L</div>
	<div class="stat">H</div>
	<div class="stat">O</div>	
	<div class="bpay">Allowances</div>
	<div class="bpay">Net Salary</div>
	</div>
	<div class="clear"></div>
	<hr/>
	<?php 
    
   
    if($_POST['submitval']){
    	if(($_POST['selyr'] == "select")||($_POST['selmon'] == "select")){
    	echo '<script>alert("Select Month and Year")</script>';
    }
    else{
		if($_SESSION['login_user'] == 'admin'){
    		echo $site->salarydetail($_POST['selmon'],$_POST['selyr']);
		}
		else{
			echo $site->empsalarydetail($_POST['selmon'],$_POST['selyr']);
		}
    	}
    }
    else{
		if($_SESSION['login_user'] == 'admin'){
    		echo $site->salarydetail(MNT,YR);
		}
		else{
			echo $site->empsalarydetail(MNT,YR);
		}
  }
    
    ?>
	</div>
</div>