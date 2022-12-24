<div class="main-attend">
	<div class="emphead"><p>Monthly Leave Detail</p></div>
    <div class="cal">
    <form method="post">
	<div class="monthly-formhead"><div class="datatable">Select Month<select class="inp-form" id="selmon" name="selmon">
	<option value="select">---Select Month---</option>
	<option value="1">January</option>
	<option value="2">February</option>
	<option value="3">March</option>
	<option value="4">April</option>
	<option value="5">May</option>
	<option value="6">June</option>
	<option value="7">July</option>
	<option value="8">August</option>
	<option value="9">September</option>
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
    </div></div>
	</form>
     <?php 
			if($_POST['submitval']){
				if($_SESSION['login_user'] == "admin"){
					echo "<input type='hidden' class='inmnt' value='".$_POST['selmon']."' /><input type='hidden' class='inyr' value='".$_POST['selyr']."' />";
					
				}
				else{
					echo "<input type='hidden' class='inmnt' value='".$_POST['selmon']."' /><input type='hidden' class='inyr' value='".$_POST['selyr']."' />";
					
				}
				
			}
			else{
				if($_SESSION['login_user'] == "admin"){
					echo "<input type='hidden' class='inmnt' value='".ltrim(MNT,0)."' /><input type='hidden' class='inyr' value='".YR."' />";
					
				}
				else{
					echo "<input type='hidden' class='inmnt' value='".ltrim(MNT,0)."' /><input type='hidden' class='inyr' value='".YR."' />";
					
				}
				
			}
		?>
    <?php 
	if($_SESSION['login_user'] == 'admin'){
	?>
	
    <div class="nxt">
    <div class="calprev">
        
            <ul>
                <li onclick="leavenxt('next')">Next</li>
                <li class="differ">|</li>
                <li onclick="leavenxt('prev')">Prev</li>
            </ul>
       </div>
    </div>
    
    <?php } ?>
    
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
				if($_SESSION['login_user'] == "admin"){
					
					echo $site->calendarfirst("1",$_POST['selmon'],$_POST['selyr']);
				}
				else{
					
					echo $site->calendar($_POST['selmon'],$_POST['selyr']);
				}
				
			}
			else{
				if($_SESSION['login_user'] == "admin"){
					
					echo $site->calendarfirst("1",MNT,YR);
				}
				else{
					
					echo $site->calendar(MNT,YR);
				}
				
			}
		?>
        </div>
        
            
    </div>
	<div class="clear"></div>
</div>