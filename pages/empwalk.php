<?php echo $site->timeindata(); ?>
<div class="empdet">
	<div class="emphead">
		<p>Employee Walkin / Walkout For <?php echo DT; ?></p>
	</div>
	<?php
	if($_POST['submit']){
	
		echo $site->timein();
	
	}
	
	?>
	<div class="formhead">
	<p id="ppswd">Enter Password to Submit Walkins</p>
	<input type="text" class="inp-form pswd" id="pswd" name="pswd" onKeydown="Javascript: if (event.keyCode==13) viewbtn();" />
	</div>
	<form method="post">
		<div class="datatable">
		<?php
			echo $site->timeintimeout();
			?>
		</div>
	</form>
	<div class="clear"></div>
</div>