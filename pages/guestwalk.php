<div class="salary" style="width:100%;">
	<?php 
	if($_POST['guest']){
		echo $site->guestwalk(array("id"=>"","guestname"=>$_POST['nm'],"timein"=>TM,"dt"=>DT,"tomeet"=>$_POST['tomeet'],"rem"=>$_POST['rem']));
	}
	?>
	<div class="emphead"><p>Guest Walkin</p></div>
	
	<div class="billdet">
	<div class="row">
	<div class="col1">
		<form method="post"/>
		<div class="row"><div class="col1"><label for="nm">Guest Name : </label></div><div class="col2"><input type="text" name="nm" class="inp-form" /></div></div>
		<div class="row"><div class="col1"><label for="tommet">To Meet : </label></div><div class="col2"><select name="tomeet" class="inp-form">
		<option value="-">---Select---</option>
		
		<?php
			echo $site->optionsval("employee","id,fname,lname");
		?>
		
		
		
		
		</select></div>
		<div class="row"><div class="col1"><label for="rem">Remarks(if any) : </label></div><div class="col2"><textarea class="inp-form" name="rem"></textarea></div></div>
		</div>
		<div class="row"><div class="col1">.</div><div class="col2"><input type="submit" name="guest" class="submitBtn" /></div></div>
		<div class="clear"></div>
		</form>
		</div>
		<div class="line"></div>
		<div class="col2">
			<div class="row"><div class="col2"><p>Time Out Update <?php echo "(".DT.")"; ?></p></div></div>
			<div class="clear"></div>
			<div class="formhead">
				<div class="sno">Sno</div>
				
				<div class="reportdt" style="width:25%;">Guest Name</div>
				
				<div class="reportdt" style="width:20%;">Remark</div>
				
				<div class="reportdt" style="width: 17%;">Date</div>
				
				<div class="reportdt">TimeIn</div>
				
				<div class="reportdt" style="width: 12%;">TimeOut</div>
				
			</div>
			<hr/>
			<div class="tabledata">
			<?php echo $site->guestwalkdet(); ?>
			</div>
		</div>
		</div>
		<div class="clear"></div>
		
		
	</div>
</div>