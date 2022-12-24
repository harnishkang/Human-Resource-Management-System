<div class="salary">
	<div class="printdata" id="printdata">
	<div class="emphead"><p>Employee Detail Report</p></div>
	<div class="formhead">

	<div class="sno reportdt">Name</div>
	<div class="sno reportdt">Designation</div>
	<div class="sno reportdt">Basic Pay</div>
	<div class="sno reportdt">Joining Date</div>
	<div class="sno reportdt">Contact</div>
	<div class="sno reportdt">Email</div>
	</div>
	<div class="clear"></div>
	<hr/>
	<div class="datatable">
		<?php echo $site->employeedet(); ?>
	</div>
	<div class="clear"></div>
	
	</div>
	<div class="row"><div class="col1"><br/></div><div class="col2"><button class="submitBtn" onclick="printreport();">Print</button></div></div>
	<div class="clear"></div>
</div>
<div class="clear"></div>