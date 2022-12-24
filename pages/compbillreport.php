<div class="salary">
	<div class="printdata" id="printdata">
	<div class="emphead"><p>Company Bills Report</p></div>
	<div class="formhead">
	<div class="sno1">S.No.</div>
	<div class="sno reportdt">Bill Date</div>
	<div class="sno reportdt">Due Date</div>
	<div class="sno reportdt">Type</div>
	<div class="sno reportdt">Amount</div>
	<div class="sno reportdt">Paid To</div>
	<div class="sno reportdt">Remark</div>
	</div>
	<div class="clear"></div>
	<hr/>
	<div class="datatable">
		<?php echo $site->compbilldet(); ?>
	</div>
	<div class="clear"></div>
	
	</div>
	<div class="row"><div class="col1">.</div><div class="col2"><button class="submitBtn" onclick="printreport();">Print</button></div></div>
	<div class="clear"></div>
</div>