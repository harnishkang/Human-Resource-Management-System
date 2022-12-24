<?php

class site extends database{
	
	public function login($usr,$pwd){	
		$logcnt = $this->select_count_part("usrdetail","uname = '$usr' and pswd = '$pwd'");
		if($logcnt == 0){
			$logres = "<p class='notvalid'>Invalid Username / Password</p>";
		}
		else{
			$logid = mysqli_fetch_assoc($this->select_col_part("usrdetail","empid,id","uname='".$usr."'"));
			$_SESSION['login_user'] = $usr;
			$_SESSION['loginid'] = $logid['id'];
			$_SESSION['menuid'] = $logid['empid'];
			$menucount = $this->select_count("menuoptions");
			
			$usermenu = $this->select_count_part("userrights","usrid =".$_SESSION['loginid']);
			
			if($menucount != $usermenu){
			
				$sql = $this->select_part("menuoptions","lower(menu) not in(select lower(menu) from userrights where usrid=".$_SESSION['loginid'].")");
				while($row = mysql_fetch_array($sql)){
					$sqlins = $this->insert_all("userrights",array("id"=>"","usrid"=>$_SESSION['loginid'],"uname"=>$_SESSION['login_user'],"menu"=>$row['menu'],"submenu"=>$row['submenu'],"rights"=>"N","menuorder"=>$row['menuorder'],"linkpage"=>$row['linkpage']));
				}
				
				$sql = $this->select_part("menuoptions","lower(submenu) not in(select lower(submenu) from userrights where usrid=".$_SESSION['loginid'].")");
				while($row = mysql_fetch_array($sql)){
					$sqlins = $this->insert_all("userrights",array("id"=>"","usrid"=>$_SESSION['loginid'],"uname"=>$_SESSION['login_user'],"menu"=>$row['menu'],"submenu"=>$row['submenu'],"rights"=>"N","menuorder"=>$row['menuorder'],"linkpage"=>$row['linkpage']));
				}
			}
			
				header("Location: index.php?p=home");
			
			
			
		}
		return $logres;
	}
	
	public function saveimg($data){
		$datares = $this->insert_all("empimg",$data);
		if($datares){
			$empres = $datares;
		}
		else{
			$empres = "false";
		}
		return $empres;
	}
	
	public function saveempdet($data){
		$datares = $this->insert_all("employee",$data);
		if($datares){
			$empres = "true";
		}
		else{
			$empres = "false";
		}
		return $empres;
	}
	
	public function saveproof($data){
		$datares = $this->insert_all("empidproof",$data);
		if($datares){
			$empres = "<div class='msg'>Record Saved</div>";
		}
		else{
			$empres = "<div class='msg'>Access Denied</div>";
		}
		return $empres;
	}
	
	public function tableview(){
		$datatable = $this->select_col_part("employee","id,fname,lname","status!='Y' order by fname");
		$i = 1;
		while($datarow = mysql_fetch_array($datatable)){
			$a="'";
			$present = $a."pr".$a;
			$absent = $a."ab".$a; 
			$leave = $a."lv".$a;
			$half = $a."half".$a;
			$off = $a."off".$a;
			
			
			$datares .= '<div class="datatable"><div class="sno">'.$i.'</div><div class="empname">'.$datarow["fname"].'<input type="hidden" name="empname'.$datarow['id'].'" id="empname" value="'.$datarow["fname"].'"/></div><div class="pr"><input type="checkbox" name="pr'.$datarow['id'].'" class="pr'.$i.'" id="pr'.$datarow['id'].'" onclick="chkall('.$present.','.$datarow['id'].')"/><input type="hidden" name="inpr'.$datarow['id'].'" class="inpr'.$i.'" id="inpr'.$datarow['id'].'"/></div><div class="ab"><input type="hidden" name="inab'.$datarow['id'].'" class="inab'.$i.'" id="inab'.$datarow['id'].'" /><input type="checkbox" name="ab'.$datarow['id'].'" class="ab'.$i.'" id="ab'.$datarow['id'].'" onclick="chkall('.$absent.','.$datarow['id'].')"/></div><div class="lv"><input type="hidden" class="inlv'.$i.'" name="inlv'.$datarow['id'].'" id="inlv'.$datarow['id'].'"/><input type="checkbox" name="lv'.$datarow['id'].'" class="lv'.$i.'" id="lv'.$datarow['id'].'" onclick="chkall('.$leave.','.$datarow['id'].')"/></div><div class="half"><input type="hidden" name="inhalf'.$datarow['id'].'" class="inhalf'.$i.'" id="inhalf'.$datarow['id'].'"/><input type="checkbox" name="half'.$datarow['id'].'" class="half'.$i.'" id="half'.$datarow['id'].'" onclick="chkall('.$half.','.$datarow['id'].')"/></div><div class="off"><input type="hidden" name="inoff'.$datarow['id'].'" class="inoff'.$i.'" id="inoff'.$datarow['id'].'"/><input type="checkbox" name="off'.$datarow['id'].'" class="off'.$i.'" id="off'.$datarow['id'].'" onclick="chkall('.$off.','.$datarow['id'].')"/></div></div><div class="clear"></div><hr/>';
			$i++;
		}
		$i--;
		$datares .= '<input type="hidden" name="countsno" id="countsno" value='.$i.'>';
		return $datares;
	}
	
	
	public function empattend($dtval){
		$attendcount = $this->select_count_part("daily_attend","dt = '".$dtval."'");
		if($attendcount == 0){
		$attendsel = $this->select_col_part("employee","id","status!='Y' order by fname");
		$dt = $dtval;
		while($attendrow = mysql_fetch_array($attendsel)){
			$data = array("id"=>"","empid"=>$attendrow['id'],"name"=>$_POST['empname'.$attendrow['id']],"dt"=>$dtval,"present"=>$_POST['inpr'.$attendrow['id']],"absent"=>$_POST['inab'.$attendrow['id']],"lv"=>$_POST['inlv'.$attendrow['id']],"half"=>$_POST['inhalf'.$attendrow['id']],"off"=>$_POST['inoff'.$attendrow['id']]);
			$attendres = $this->insert_all("daily_attend",$data);
		}
		
		
		if($attendres){
			$attres = "<div class='msg'>Record Saved</div>";
		}
		else{
			$attres = "<div class='msg'>Access Denied</div>";
		}
		}
		else{
			$attres = "<div class='msg'>Attendance Already Updated</div>";
		}
		return $attres;
	}
	
	public function viewattend($dt){
		$viewres = $this->select_count_part("daily_attend","dt = '".$dt."'");
		if($viewres != 0){
			$i = 1;
			$viewsel = $this->select_part("daily_attend","dt = '".$dt."'");
			
			while($viewrow = mysql_fetch_array($viewsel)){
				if($viewrow['present']=='Y')
					$attend = 'P';
				if($viewrow['absent']=='Y')
					$attend = 'A';
				if($viewrow['lv']=='Y')
					$attend = 'L';
				if($viewrow['half']=='Y')
					$attend = 'H';
				if($viewrow['off']=='Y')
					$attend = 'O';
				
				
				$res .= '<div class="datatable"><div class="sno">'.$i.'</div><div class="empname">'.$viewrow['name'].'</div><div class="attend">'.$attend.'</div></div><div class="clear"></div><hr/>';
				$i++;
			}
			
		}
		else{
			$res = '<div class="msg1">Attendance Not Uploaded</div>';
		}
		
		return $res;
	}
	
	public function colhead(){
		$i = 1;
		while($i<=31){
			$col .= '<div class="col-'.$i.'">'.$i.'</div>';
			$i++;
		}
		
		return $col;
	}
	


	public function empmonthlyattend($yr,$mnt){
		
		$pos = 0;
		$lv = 0;
		$ab = 0;
		$hf = 0;
		$pr = 0;
		$off = 0;
		$res="";
		$firstDayUTS = mktime(0, 0, 0, $mnt, 1, $yr);
		$firstday = date("D", $firstDayUTS);
		switch(strtolower($firstday)){
			
			case "sun" : $pos = 0;
			break;
			
			case "mon" : $pos = 1;
			break;
			
			case "tue" : $pos = 2;
			break;
			
			case "wed" : $pos = 3;
			break;
			
			case "thu" : $pos = 4;
			break;
			
			case "fri" : $pos = 5;
			break;
		
			case "sat" : $pos = 6;
			break;
			
			default:$n="none";
		}
		$res .= '<ul>';
		if($pos!=0){
			$i = 1;
			while($i<=$pos){
				$res .= '<li style="visibility:hidden;"></li>';
				$i++;	
			}
		}
		
		$j = 1;
		$nod = date("t", mktime(1, 1, 1, $mnt, 1, $yr));
		
		while($j <= $nod){
			$sql = mysql_fetch_assoc($this->select_part("daily_attend","month(dt) = ".ltrim($mnt,0)." and year(dt) = ".$yr." and day(dt) = ".ltrim($j,0)." and empid = ".$_SESSION['menuid']));
			$res .= '<input type="hidden" class="empid" value="'.$sql['empid'].'"/><li>';
			if($sql['lv'] == 'Y'){
				$res .= '<div class="cal-leave"></div>';
				$lv++;
				
			}
			else if($sql['absent'] == 'Y'){
				$res .= '<div class="cal-absent"></div>';
				$ab++;
			}
			else if($sql['half'] == 'Y'){
				$res .= '<div class="cal-half"></div>';
				$hf++;
			}
			else if($sql['present'] == 'Y'){
				$res .= '<div class="cal-present"></div>';
				$pr++;
			}
			else if($sql['off'] == 'Y'){
				$res .= '<div class="cal-off"></div>';
				$off++;
			}
			$res .= $j.'</li>';
			$j++;	
		}
		
		$res .= '</ul>
		<div class="color-info"><ul><li><div class="cal-leave"></div><p>Leaves</p></li>
		<li><div class="cal-absent"></div><p>Absents</p></li>
		<li><div class="cal-half"></div><p>Half Days</p></li>
		<li><div class="cal-present"></div><p>Presents</p></li>
		<li><div class="cal-off"></div><p>Off Days</p></li>
		</ul>
		</div>
		<hr/>
		
            <div class="calfoot">
			<div class="subfoot"><p>Total Present : </p></div><div class="subfoot1"><p>'.$pr.'</p></div>
            <div class="subfoot"><p>Total Leaves Taken : </p></div><div class="subfoot1"><p>'.$lv.'</p></div>
            <div class="subfoot"><p>Total Absents : </p></div><div class="subfoot1"><p>'.$ab.'</p></div>
            <div class="subfoot"><p>Total Half Days : </p></div><div class="subfoot1"><p>'.$hf.'</p></div>
			<div class="subfoot"><p>Total Off Days : </p></div><div class="subfoot1"><p>'.$off.'</p></div>
            </div>
			';
		
		return $res;
	}
	
	public function monthlyattend($yr,$mnt){
		
		$empdet = $this->select_part("employee","status!='Y' order by fname");
		
		$i = 1;
		
		while($emprow = mysql_fetch_array($empdet)){
			
			$monres .= '<div calss="datatable"><div class="monthly-sno">'.$i.'</div><div class="monthly-empname">'.$emprow['fname'].' '.$emprow['lname'].'</div>';
			
			
			
				
						/*$timestamp = strtotime($monrow['dt']);*/
						$j = 1;
							while($j<=31){
								if($j < 10){
									$dtval = "0".$j;
								}
								else{
									$dtval = $j;
								}
								
								$dt = $yr."-".$mnt."-".$dtval;
								
								$monsel = $this->select_part("daily_attend","dt = '".$dt."' and empid = ".$emprow['id']);
								$monrow = mysql_fetch_assoc($monsel);
								if(($monrow['present'] == 'Y'))
									$monres  .= '<div class="col-'.$i.'" style="color:green;font-weight: bold;">P</div>';
								elseif(($monrow['absent'] == 'Y'))
									$monres  .= '<div class="col-'.$i.'" style="color:red;font-weight: bold;">A</div>';
								elseif(($monrow['lv'] == 'Y'))
									$monres  .= '<div class="col-'.$i.'" style="color:blue;font-weight: bold;">L</div>';
								elseif(($monrow['half'] == 'Y'))
									$monres  .= '<div class="col-'.$i.'" style="color: rgb(12, 223, 143);font-weight:bold;">H</div>';
								elseif(($monrow['off'] == 'Y'))
									$monres  .= '<div class="col-'.$i.'" style="color: rgb(188, 3, 250);font-weight: bold;">O</div>';
								else
									$monres  .= '<div class="col-'.$i.'">-</div>';
							
								$j++;
							}
				
			$monres .= '<div class="clear"></div><hr/></div>';
			$i++;
		}
		
		
		return $monres;
		
	}
	
	public function empsalarydetail($mnt,$yr){
		$empres = mysql_fetch_assoc($this->select_part("employee","status!='Y' and empid = ".$_SESSION['menuid']." order by fname"));
		$i = 1;
		$totsal = 0;
		while($i<=ltrim($mnt,0)){
			$salarydetail .= '<div class="salary-datatable"><div class="salary-sno">'.$i.'</div><div class="bpay">'.$empres['basic_pay'].'</div><div class="bpay">'.$i.'-'.$yr.'</div>';
			$countp = $this->select_count_part("daily_attend","empid = ".$empres['id']." and month(dt) = ".$i." and year(dt) = '".$yr."' and present = 'Y'");
			$salarydetail .= '<div class="stat">'.$countp.'</div>';
			$counta = $this->select_count_part("daily_attend","empid = ".$empres['id']." and month(dt) = ".$i." and year(dt) = '".$yr."' and absent = 'Y'");
			$salarydetail .= '<div class="stat">'.$counta.'</div>';
			$countl = $this->select_count_part("daily_attend","empid = ".$empres['id']." and month(dt) = ".$i." and year(dt) = '".$yr."' and lv = 'Y'");
			$salarydetail .= '<div class="stat">'.$countl.'</div>';
			$counth = $this->select_count_part("daily_attend","empid = ".$empres['id']." and month(dt) = ".$i." and year(dt) = '".$yr."' and half = 'Y'");
			$salarydetail .= '<div class="stat">'.$counth.'</div>';
			$counto = $this->select_count_part("daily_attend","empid = ".$empres['id']." and month(dt) = ".$i." and year(dt) = '".$yr."' and off = 'Y'");
			$salarydetail .= '<div class="stat">'.$counto.'</div>';
			$this->connect();
			$sum = mysql_fetch_assoc(mysql_query("select sum(totamt) as sum from allowchild where parentid = (select id from allowparent where name = '".$empres['id']."' and month(dt) = ".$i." and year(dt) = ".$yr.")") );
			
			if($sum['sum']){
				$val = $sum['sum'];
			}
			else{
				$val = 0;
			}
			$salarydetail .= '<div class="bpay">'.$val.'</div>';
			$sqllate = mysql_fetch_assoc($this->select_part("daily_attend","empid = ".$empres['id']." and month(dt) = '".$mnt."' and year(dt) = '".$yr."' group by empid"));
			/*$totdeddays = ($counta + $countl + ($counth/2)) - 1.5; */
			if($sqllate['latecount']>3){
				$lateded = $sqllate['latecount']*50;
			}
			else{
				$lateded = 0;
			}
			$totdeddays = ($counta + $countl + ($counth/2));
			
			if($totdeddays > 0){
				$totded = ($empres['basic_pay']/30) * $totdeddays;
			}
			else{
				$totded = 0;
			} 
			$netsal = ($empres['basic_pay'] - $totded - $lateded) + $val;
			$salarydetail .= '<div class="bpay ';
			if($empres['basic_pay'] != $netsal){
			
				$salarydetail .= '"style=color:red; font-weight:bold;"';
			
			}
			$salarydetail .= '">'.round($netsal,2).'</div><div class="salary-name">Final Calculated Salary </div></div><div class="clear"></div><hr/>';
			
			$totsal += round($netsal,2);
			$i++;
		
		}
		$salarydetail .= '<div class="salary-datatable totsal">Total Salary : '.round($totsal,2).'</div>
		
		<div class="clear"></div>';
		return $salarydetail;
	
	}
	
	public function salarydetail($mnt,$yr){
	
		$empres = $this->select_part("employee","status!='Y' order by fname");
		$i = 1;
		$totsal = 0;
		while($emprow = mysql_fetch_array($empres)){
			$salarydetail .= '<div class="salary-datatable"><div class="salary-sno">'.$i.'</div><div class="salary-name">'.$emprow['fname'].' '.$emprow['lname'].'</div><div class="bpay">'.$emprow['basic_pay'].'</div><div class="bpay">'.$mnt.'-'.$yr.'</div>';
			$countp = $this->select_count_part("daily_attend","empid = ".$emprow['id']." and month(dt) = '".$mnt."' and year(dt) = '".$yr."' and present = 'Y'");
			$salarydetail .= '<div class="stat">'.$countp.'</div>';
			$counta = $this->select_count_part("daily_attend","empid = ".$emprow['id']." and month(dt) = '".$mnt."' and year(dt) = '".$yr."' and absent = 'Y'");
			$salarydetail .= '<div class="stat">'.$counta.'</div>';
			$countl = $this->select_count_part("daily_attend","empid = ".$emprow['id']." and month(dt) = '".$mnt."' and year(dt) = '".$yr."' and lv = 'Y'");
			$salarydetail .= '<div class="stat">'.$countl.'</div>';
			$counth = $this->select_count_part("daily_attend","empid = ".$emprow['id']." and month(dt) = '".$mnt."' and year(dt) = '".$yr."' and half = 'Y'");
			$salarydetail .= '<div class="stat">'.$counth.'</div>';
			$counto = $this->select_count_part("daily_attend","empid = ".$emprow['id']." and month(dt) = '".$mnt."' and year(dt) = '".$yr."' and off = 'Y'");
				
			$salarydetail .= '<div class="stat">'.$counto.'</div>';
			$this->connect();
			$sum = mysql_fetch_assoc(mysql_query("select sum(totamt) as sum from allowchild where parentid = (select id from allowparent where name = '".$emprow['id']."' and month(dt) = ".$mnt." and year(dt) = ".$yr.")") );
			
			if($sum['sum']){
				$val = $sum['sum'];
			}
			else{
				$val = 0;
			}
			$salarydetail .= '<div class="bpay">'.$val.'</div>';
			$sqllate = mysql_fetch_assoc($this->select_part("daily_attend","empid = ".$emprow['id']." and month(dt) = '".$mnt."' and year(dt) = '".$yr."' and present = 'Y' group by empid"));
			/*$totdeddays = ($counta + $countl + ($counth/2)) - 1.5; */
			if($sqllate['latecount']>3){
				$lateded = $sqllate['latecount']*50;
			}
			else{
				$lateded = 0;
			}
			$totdeddays = ($counta + $countl + ($counth/2));
			
			if($totdeddays > 0){
				$totded = ($emprow['basic_pay']/30) * $totdeddays;
			}
			else{
				$totded = 0;
			} 
			$netsal = ($emprow['basic_pay'] - $totded - $lateded) + $val;
			$salarydetail .= '<div class="bpay ';
			if($emprow['basic_pay'] != $netsal){
			
				$salarydetail .= '"style=color:red; font-weight:bold;"';
			
			}
			$salarydetail .= '">'.round($netsal,2).'</div></div><div class="clear"></div><hr/>';
			
			$totsal += round($netsal,2);
			$i++;
		
		}
	
	
		$salarydetail .= '<div class="salary-datatable totsal">Total Salary : '.round($totsal,2).'</div><div class="clear"></div>';
		return $salarydetail;
	
	}
	
	public function allowances(){
		
		$i = 1;
		while($i <= 5){
			
			$res .= '<div class="datatable"><div class="sno">'.$i.'</div><div class="empname1"><input type="text" name="from'.$i.'" class="allowances" placeholder="From Place"/> </div><div class="empname1"><input type="text" name="to'.$i.'" class="allowances" placeholder="To Place"/></div><div class="empname1"><select name="vehicle'.$i.'" id="vehicle'.$i.'" class="allowances"><option value="select">---Select---</option><option value="two">Two Wheeler</option><option value="four">Four Wheeler</option></select></div><div class="empname1"><input type="text" name="kms'.$i.'" id="kms'.$i.'" class="allowances" placeholder="Kms Driven" onblur="calamt('.$i.')"/></div><div class="empname1"><input type="text" name="amt'.$i.'" id="amt'.$i.'" class="allowances" placeholder="Total Amount"/></div></div><div class="clear"></div><hr/>';
		$i++;
		}
		
		return $res;
	}
	
	public function allowins($data){
	
		$res = $this->insert_all("allowparent",$data);
		if($res){
		$i = 1;
		while($i<=5){
			if($_POST['from'.$i] != ""){
			$res1 = $this->insert_all("allowchild",array("id"=>"","parentid"=>$res,"fromval"=>$_POST['from'.$i],"toval"=>$_POST['to'.$i],"vehicle"=>$_POST['vehicle'.$i],"totkms"=>$_POST['kms'.$i],"totamt"=>$_POST['amt'.$i]));
			}
			
			$i++;
		}
			
		}
		
		return '<div class="msg1">Record Updated</div>';
	
	}
	
	public function optionsval($table,$col){
		$resopt = '';
		$a = explode(",",$col);
		$res = $this->select_col_all($table,$col);
		while($resrow = mysql_fetch_array($res)){
		
			$resopt .= '<option value = "'.$resrow[$a[0]].'">'.$resrow[$a[1]]." ".$resrow[$a[2]].'</option>';
		
		}
		
		return  $resopt;
		
	}

	public function optionsvalpart($table,$col,$clause){
		$resopt = '';
		$a = explode(",",$col);
		$res = $this->select_col_part($table,$col,$clause);
		while($resrow = mysql_fetch_array($res)){
		
			$resopt .= '<option value = "'.$resrow[$a[0]].'">'.$resrow[$a[1]]." ".$resrow[$a[2]].'</option>';
		
		}
		
		return  $resopt;
		
	}

	
	public function leaveins($data){
		$res = $this->insert_all("leaveform",$data);
		if($res){
			/*$attres = "<div class='msg'>Record Saved</div>";*/
			$attres = 1;
		}
		else{
			/*$attres = "<div class='msg'>Access Denied</div>";*/
			$attres = 0;
		}
		
		return $attres;
		
	}
	
	public function appointins($data){
		$res = $this->insert_all("appointletter",$data);
		if($res){
			/*$attres = "<div class='msg'>Record Saved</div>";*/
			$attres = 1;
		}
		else{
			/*$attres = "<div class='msg'>Access Denied</div>";*/
			$attres = 0;
		}
		
		return $attres;
		
	}
	
	public function perbill($data){
	
		$res = $this->insert_all("personalbills",$data);
		
		if($res){
			$attres = "<div class='msg'>Record Saved</div>";
		}
		else{
			$attres = "<div class='msg'>Access Denied</div>";
		}
		
		return $attres;
	
	}
	
	public function compbill($data){
	
		$res = $this->insert_all("companybills",$data);
		
		if($res){
			$attres = "<div class='msg'>Record Saved</div>";
		}
		else{
			$attres = "<div class='msg'>Access Denied</div>";
		}
		
		return $attres;
	
	}
	
	public function typlist(){
		$sql = $this->select_all("billtyp");
		while($sqlrow = mysql_fetch_array($sql)){
			$sqlres .= '<option value="'.strtolower($sqlrow['billtyp']).'">'.$sqlrow['billtyp'].'</option>';
		}
		
		return $sqlres;
	}
	
	public function compbilldet(){
		$sql = $this->select_all("companybills");
		$i = 1;
		while($sqlrow = mysql_fetch_array($sql)){
		
			$sqlres .= '<div class="row"><div class="sno1">'.$i.'</div>
			<div class="sno reportdt">.'.$sqlrow['billdt'].'</div>
			<div class="sno reportdt">.'.$sqlrow['duedt'].'</div>
			<div class="sno reportdt">.'.$sqlrow['typ'].'</div>
			<div class="sno reportdt">.'.$sqlrow['amt'].'</div>';
			$sqldesig = mysql_fetch_assoc($this->select_part("employee","id=".$sqlrow['paidto']));
			$sqlres .= '<div class="sno reportdt">.'.$sqldesig['fname'].' '.$sqldesig['lname'].'</div>
			<div class="sno reportdt">.'.$sqlrow['rem'].'</div></div>
			<div class="clear"></div>
			<hr/>
			';
			$sum +=  $sqlrow['amt'];
		$i++;
		}
		$sqlres .= '<div class="row"><div class="col1">Total : </div><div class="col2"><p class="price">'.$sum.'</p></div></div><div class="clear"></div>';
		return $sqlres;
	}
	
	public function perbilldet(){
		$sql = $this->select_all("personalbills");
		$i = 1;
		while($sqlrow = mysql_fetch_array($sql)){
		
			$sqlres .= '<div class="row"><div class="sno1">'.$i.'</div>
			<div class="sno reportdt">.'.$sqlrow['billdt'].'</div>
			<div class="sno reportdt">.'.$sqlrow['duedt'].'</div>
			<div class="sno reportdt">.'.$sqlrow['relto'].'</div>
			<div class="sno reportdt">.'.$sqlrow['amt'].'</div>
			<div class="sno reportdt">.'.$sqlrow['rem'].'</div></div>
			<div class="clear"></div>
			<hr/>
			';
		$sum +=  $sqlrow['amt'];
		$i++;
		}
		$sqlres .= '<div class="row"><div class="col1">Total : </div><div class="col2"><p class="price">'.$sum.'</p></div></div><div class="clear"></div>';
		return $sqlres;
	}
	
	public function employeedet(){
		$sql = $this->select_part("employee","status != 'Y' order by fname");
		$i = 1;
		while($sqlrow = mysql_fetch_array($sql)){
		/*<a href="/hr/?p=viewemp&id='.$sqlrow['id'].'" class="emplink">*//*</a>
		
		*/
			$sqlres .= '<div class="row">
				<div class="sno reportdt"><br/>'.$sqlrow['fname'].' '.$sqlrow['lname'].'</div>';
				$sqldesig = mysql_fetch_assoc($this->select_part("desig_master","id=".$sqlrow['designation']));
				$sqlres .= '<div class="sno reportdt"><br/>'.$sqldesig['desig'].'</div>
				<div class="sno reportdt"><br/>'.$sqlrow['basic_pay'].'</div>
				<div class="sno reportdt"><br/>'.$sqlrow['jdt'].'</div>
				<div class="sno reportdt"><br/>'.$sqlrow['contact'].'</div>
				<div class="sno reportdt"><br/>'.$sqlrow['email'].'</div></div>
			<div class="clear"></div>
			<hr/>
			';
		$i++;
		}
		
		return $sqlres;
	}
	
	public function leavedet(){
		$sql = $this->select_part("leaveform","month(applydt) = '".MNT."' and year(applydt) = '".YR."' order by applydt desc");
		$i = 1;
		while($sqlrow = mysql_fetch_array($sql)){
			$sqlres .= '<div class="leavefields nobold" style="width:3%;">'.$i.'</div>
	<div class="line"></div>';
	$sqlnm = mysql_fetch_assoc($this->select_part("employee","id=".$sqlrow['name']));
	
	$sqlres .= '<div class="leavefields nobold" style="width:14%;">'.ucwords($sqlnm['fname'].' '.$sqlnm['lname']).'</div>';
	
	$sqlres .= '<div class="line"></div>';
	$sqldesig = mysql_fetch_assoc($this->select_part("desig_master","id=".$sqlrow['designation']));
	$sqlres .= '<div class="leavefields nobold" style="width:13%;">'.ucwords($sqldesig['desig']).'</div>
	<div class="line"></div>
	<div class="leavefields nobold" style="width:10%;">'.ucwords($sqlrow['reason']).'</div>
	<div class="line"></div>
	<div class="leavefields nobold" style="width: 6%;">';
	if($sqlrow['fulltype'] == 'Y'){
	$sqlres .= 'Full Day';
	}
	else{
	$sqlres .= 'Half Day';
	}
	$sqlres .= '</div>
	<div class="line"></div>
	<div class="leavefields nobold" style="width: 3%;">'.$sqlrow['noleave'].'</div>
	<div class="line"></div>
	<div class="leavefields nobold" style="width:6%;">'.$sqlrow['fromdt'].'</div>
	<div class="line"></div>
	<div class="leavefields nobold" style="width:6%;">'.$sqlrow['todt'].'</div>
	<div class="line"></div>
	<div class="leavefields nobold" style="width:4%;">'.$sqlrow['prev'].'</div>
	<div class="line"></div>
	<div class="leavefields nobold" style="width:6%;">'.$sqlrow['applydt'].'</div>
	<div class="line"></div>';
	if($sqlrow['approved'] == 'Y'){
	
		$sqlres .= '<div class="leavefields nobold" style="width:6%;" >Approved</div>';
	
	}
	else if($sqlrow['approved'] == 'N'){
	
		$sqlres .= '<div class="leavefields nobold" style="width:6%;" onclick="approve('.$sqlrow['id'].');">UnApproved</div>';
	
	}
	else{
		$sqlres .= '<div class="leavefields nobold" style="width:6%;" onclick="approve('.$sqlrow['id'].');">Update</div>';
	}
	
	$sqlres .= '<div class="clear"></div>
			<hr/>
			';
		$i++;
		}
		
		return $sqlres;
	}
	
	public function sendleavesms($cont,$msg){
	
		$userID = '9876551789';
		$userPWD = 'F5845R';

    if (!function_exists('curl_init')) {
        echo "Error : Curl library not installed";
        return FALSE;
    }
    $message_urlencode = rawurlencode($message);
    if (strlen($message) > 140) {
        $message = substr($message, 0, 139);
    }
    
    $cookie_file_path = "./cookie.txt";
    $temp_file        = "./temporary.txt";
    $user_agent       = "Mozilla/5.0 (Windows NT 6.1) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/35.0.1916.153 Safari/537.36";
    
    // LOGIN TO WAY2SMS
    
    $url        = "http://site24.way2sms.com/content/Login1.action";
    $parameters = array(
        "username" => "$userID",
        "password" => "$userPWD",
        "button" => "Login"
    );
    
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_POST, count($parameters));
    curl_setopt($ch, CURLOPT_POSTFIELDS, $parameters);
    curl_setopt($ch, CURLOPT_HEADER, TRUE);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
    curl_setopt($ch, CURLOPT_COOKIEJAR, $cookie_file_path);
    curl_setopt($ch, CURLOPT_COOKIEFILE, $cookie_file_path);
    curl_setopt($ch, CURLOPT_FOLLOWLOCATION, TRUE);
    curl_setopt($ch, CURLOPT_USERAGENT, $user_agent);
    curl_setopt($ch, CURLOPT_NOBODY, FALSE);
    $result = curl_exec($ch);
    curl_close($ch);
    
    // SAVE LOGOUT URL
    
    file_put_contents($temp_file, $result);
    $result     = "";
    $logout_url = "";
    $file       = fopen($temp_file, "r");
    $line       = "";
    $cond       = TRUE;
    while ($cond == TRUE) {
        $line = fgets($file);
        if ($line === FALSE) { // EOF
            $cond = FALSE;
        } else {
            $pos = strpos($line, ' window.location="');
            if ($pos === FALSE) {
                $line = "";
            } else { // URL FOUND
                $cond       = FALSE;
                $logout_url = substr($line, -25);
                $logout_url = substr($logout_url, 0, 21);
            }
        }
    }
    fclose($file);
    
    // SAVE SESSION ID
    
    $file = fopen($cookie_file_path, "r");
    $line = "";
    $cond = TRUE;
    while ($cond == TRUE) {
        $line = fgets($file);
        if ($line === FALSE) { // EOF
            $cond = FALSE;
        } else {
            $pos = strpos($line, "JSESSIONID");
            if ($pos === FALSE) {
                $line = "";
            } else { // SESSION ID FOUND
                $cond = FALSE;
                $id   = substr($line, $pos + 15);
            }
        }
    }
    fclose($file);
    
    // SEND SMS
    
    
		$recerverNO = $cont;
		$message = $msg;
		$url        = "http://site24.way2sms.com/smstoss.action?Token=" . $id;
    $parameters = array(
        "button" => "Send SMS",
        "mobile" => "$recerverNO",
        "message" => "$message"
    );
    
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_POST, count($parameters));
    curl_setopt($ch, CURLOPT_POSTFIELDS, $parameters);
    curl_setopt($ch, CURLOPT_HEADER, TRUE);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
    curl_setopt($ch, CURLOPT_COOKIEJAR, $cookie_file_path);
    curl_setopt($ch, CURLOPT_COOKIEFILE, $cookie_file_path);
    curl_setopt($ch, CURLOPT_FOLLOWLOCATION, TRUE);
    curl_setopt($ch, CURLOPT_USERAGENT, $user_agent);
    curl_setopt($ch, CURLOPT_NOBODY, FALSE);
    $result = curl_exec($ch);
    curl_close($ch);
	
    // LOGOUT WAY2SMS
    
    $url = "site24.way2sms.com/" . $logout_url;
    
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_HEADER, TRUE);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
    curl_setopt($ch, CURLOPT_COOKIEJAR, $cookie_file_path);
    curl_setopt($ch, CURLOPT_COOKIEFILE, $cookie_file_path);
    curl_setopt($ch, CURLOPT_FOLLOWLOCATION, TRUE);
    curl_setopt($ch, CURLOPT_USERAGENT, $user_agent);
    curl_setopt($ch, CURLOPT_NOBODY, FALSE);
    $result = curl_exec($ch);
    curl_close($ch);
    
    // DELETE TEMP FILES
    
    unlink($cookie_file_path);
    unlink($temp_file);
	
	return true;
	}
	public function approveleave($val){
	
		$sql = $this->update_part("leaveform","approved='".$val."',approvedon='".DT."',approvedby='".$_SESSION['login_user']."'","id=".$_POST['leaveid']);
		if($sql){
			$sqlcont = mysql_fetch_assoc($this->select_part("employee","id=(select name from leaveform where id = ".$_POST['leaveid'].")"));
			$sqldt = mysql_fetch_assoc($this->select_part("leaveform","id=".$_POST['leaveid']));
			
			$this->sendleavesms($sqlcont['contact'],'Your leave for '.$sqldt['fromdt'].' To '.$sqldt['todt'].' has been approved');
			$attres = "<div class='msg'>Leave Status Updated</div>";
		}
		else{
			$attres = "<div class='msg'>Access Denied</div>";
		}
		
		return $attres;
	
	}
	
	public function empfetch(){
	
		$sql = $this->select_part("employee","id=".$_GET['id']);
		
		while($sqlrow = mysql_fetch_array($sql)){
			$sql1 = $this->select_part("empimg","id=".$_GET['empid']);
			$sqlres .= '<div class="row"><div class="row"><div class="col1"><label for="epic">Employee Image : </label></div><div class="col2"><div class="img" id="img"><img src = "pages/getpic.php?id='.$sqlrow['empid'].'" width="100%" height="100%" /></div><input type="file" name="file" class="file" id="fileInput" style="display:none;"/><p id="pfileInput" class="error_text" style="background:none;display:none;"></p></div></div>
			<div class="col1"><label for="fname">First Name : </label></div><div class="col2"><input type="text" name="fname" placeholder="First Name" class="inp-form" value="'.$sqlrow['fname'].'" /></div></div>
<div class="row"><div class="col1"><label for="lname">Last Name : </label></div><div class="col2"><input type="text" name="last" placeholder="Last Name" class="inp-form"  value="'.$sqlrow['lname'].'"/></div></div>
<div class="row"><div class="col1"><label for="add1">Address 1 : </label></div><div class="col2"><input type="text" name="address1" placeholder="Address1" class="inp-form" value="'.$sqlrow['address1'].'" /></div></div>
<div class="row"><div class="col1"><label for="add2">Address 2 : </label></div><div class="col2"><input type="text" name="address2" placeholder="Address2" class="inp-form" value="'.$sqlrow['address2'].'" /></div></div>
<div class="row"><div class="col1"><label for="add2">City : </label></div><div class="col2"><input type="text" name="city" placeholder="City" class="inp-form" value="'.$sqlrow['city'].'" /></div></div>
<div class="row"><div class="col1"><label for="add2">State : </label></div><div class="col2"><input type="text" name="state" placeholder="State" class="inp-form" value="'.$sqlrow['state'].'" /></div></div>
<div class="row"><div class="col1"><label for="add2">PinCode : </label></div><div class="col2"><input type="text" name="pin" placeholder="Pin Code" class="inp-form" value="'.$sqlrow['pincode'].'" /></div></div>
<div class="row"><div class="col1"><label for="add2">Contact Number : </label></div><div class="col2"><input type="text" name="contact" placeholder="Contact Number" class="inp-form" value="'.$sqlrow['contact'].'" /></div></div>
<div class="row"><div class="col1"><label for="add2">Email : </label></div><div class="col2"><input type="text" name="email" placeholder="Email" class="inp-form" value="'.$sqlrow['email'].'" /></div></div>
<div class="row"><div class="col1"><label for="add2">Marital Status : </label></div><div class="col2"><select class="inp-form" name="m">
<option>----Select----</option>
<option>Married</option>
<option>Unmarried</option>
</select></div></div>
<div class="row"><div class="col1"><label for="add2">Date of Birth : </label></div><div class="col2"><input type="text" name="dob" placeholder="DOB" class="inp-form" value="'.$sqlrow['dob'].'" /></div></div>
<div class="row"><div class="col1"><label for="add2">Qualification : </label></div><div class="col2"><input type="text" name="qua" placeholder="Qualification" class="inp-form" value="'.$sqlrow['qual'].'" /></div></div>
<div class="row"><div class="col1"><label for="add2">Additional Qualification : </label></div><div class="col2"><input type="text" name="addqua" placeholder="Additional Qualification" class="inp-form" value="'.$sqlrow['add_qual'].'" /></div></div>
<div class="empsubhead"><p>Official Information</p></div>
<div class="row"><div class="col1"><label for="add2">Designation : </label></div><div class="col2"><input type="text" name="designation" placeholder="Designation" class="inp-form" value="'.$sqlrow['designation'].'" /></div></div>
<div class="row"><div class="col1"><label for="add2">Basic Pay : </label></div><div class="col2"><input type="text" name="bpay" placeholder="Basic Pay" class="inp-form" value="'.$sqlrow['basic_pay'].'" /></div></div>
<div class="row"><div class="col1"><label for="add2">Joining Date : </label></div><div class="col2"><input type="text" name="jdt" id="dt" placeholder="Joining Date" class="inp-form" value="'.$sqlrow['jdt'].'" /></div></div>
<div class="row"><div class="col1"><label for="add2">Permanent / Temporary : </label></div><div class="col2"><input type="text" name="pt" placeholder="Permanent / Temporary" class="inp-form" value="'.$sqlrow['pt'].'" /></div></div>
<div class="empsubhead"><p>Work Experience</p></div>
<div class="row"><div class="col1"><label for="add2">Years : </label></div><div class="col2"><input type="text" name="yrs" placeholder="Years" class="inp-form" value="'.$sqlrow['years'].'" /></div></div>
<div class="row"><div class="col1"><label for="add2">Company : </label></div><div class="col2"><input type="text" name="comp" placeholder="Company" class="inp-form" value="'.$sqlrow['company'].'" /></div></div>
<div class="row"><div class="col1"><label for="add2">Remark : </label></div><div class="col2"><input type="text" name="rem" placeholder="Remark" class="inp-form" value="'.$sqlrow['remark1'].'" /></div></div>
<div class="empsubhead"><p>Identity Proof</p></div>
<div class="row"><div class="col1"><label for="epic">Employee ID Proof : </label></div><div class="col2"><div class="img1" id="img1"><img src = "pages/getpic1.php?id='.$sqlrow['empid'].'" width="50%" height="50%" /></div><input type="file" name="file1" class="file" id="fileInput1" style="display:none;"/><p id="pfileInput" class="error_text" style="background:none;display:none;"></p>
<div class="img2" id="img2"><img src = "pages/getpic2.php?id='.$sqlrow['empid'].'" width="50%" height="50%" /></div><input type="file" name="file2" class="file" id="fileInput2" style="display:none;"/><p id="pfileInput" class="error_text" style="background:none;display:none;"></p>
</div></div>
';
		
		}
	
	return $sqlres;
	}
	
	public function editdet($data){
		
		
		$sql = $this->update_part("employee",$data,"id=".$_GET['id']);
		
		if($sql){
			$attres = "<div class='msg'>Record Updated</div>";
		}
		else{
			$attres = "<div class='msg'>Access Denied</div>";
		}
		
		return $attres;	
		
	
	}
	
	public function editprofile($data){
		$sql = $this->select_part("employee","id=".$_GET['id']);
		while($sqlrow = mysql_fetch_array($sql)){
			$idres = $sqlrow['empid'];
		}
		$sql = $this->update_part("empimg",$data,"id=".$idres);
		if($sql){
			$attres = "<div class='msg'>Record Updated</div>";
		}
		else{
			$attres = "<div class='msg'>Access Denied</div>";
		}
	}
	
	public function editid($data){
		$sql = $this->select_part("employee","id=".$_GET['id']);
		while($sqlrow = mysql_fetch_array($sql)){
			$idres = $sqlrow['empid'];
		}
		$sql = $this->update_part("empidproof",$data,"empimgid=".$idres);
		if($sql){
			$attres = "<div class='msg'>Record Updated</div>";
		}
		else{
			$attres = "<div class='msg'>Access Denied</div>";
		}
	}
	
	public function createuser($data){
	
		$empsql = $this->select_part("employee","lower(fname)='".strtolower($data['fname'])."' and lower(lname) = '".strtolower($data['lname'])."'");
		while($emprow = mysql_fetch_array($empsql)){
			$empid = $emprow['id'];
		}
		$datares = $this->insert_all("usrdetail",$data);
		$insid = 1;
		$dataup = $this->update_part("usrdetail","empid=".$empid,"id = ".$datares);
		if($datares){
			$sqlmenu = $this->select_all("menuoptions");
			while($rowmenu = mysql_fetch_array($sqlmenu)){
			$datares1 = $this->insert_all("userrights",array("usrid"=>$datares,"uname"=>$data['uname'],"menu"=>$rowmenu['menu'],"submenu"=>$rowmenu['submenu'],"menuorder"=>$rowmenu['menuorder'],"linkpage"=>$rowmenu['linkpage']));
			}
			if($datares1){
			$empres ="<div class='msg'>User Created Successfully</div>";
			}
			else{
			$empres = "<div class='msg'>Access Denied</div>";
			}
		}
		else{
			$empres = "<div class='msg'>Access Denied</div>";
		}
		return $empres;
	}
	
	
	public function viewuser($usrid){
	
		$sql = $this->select_part("userrights","usrid=".$usrid);
		$a = "'";
		$i = 1;
			while($sqlrow = mysql_fetch_array($sql)){
		$param = $a.$sqlrow['id'].$a;
			$sqlres .= '<div class="row">
	<div class="sno">'.$i.'</div>
	<div class="line"></div>
	<div class="empname line-font"><input type="text" name="menu'.$i.'" class="menu'.$i.' hiddeninp" value="'.$sqlrow['menu'].'" readonly /></div>
	<div class="line"></div>
	<div class="empname line-font"><input type="text" name="submenu'.$i.'" class="submenu'.$i.' hiddeninp" value="'.$sqlrow['submenu'].'" readonly /></div>
	<div class="line"></div>
	<div class="sno"><input type="checkbox" name="rights" class="rights rights'.$i.'" id="rights'.$sqlrow['id'].'" onchange="chkrights('.$param.');" ';
	
	if($sqlrow['rights']!='N'){
		$sqlres .= 'checked';
	}
	
	$sqlres .= '/><input type="hidden" name="inrights'.$i.'" class="inrights'.$i.' inrights inrights'.$sqlrow['id'].'" value="'.$sqlrow['rights'].'" /></div>
	</div><div class="clear"></div><hr/>';
	$i++;
		
		}
		
		$sqlres .= '<input type="hidden" name="maxsno" class="maxsno" value="'.$i.'" />';
		
	return $sqlres;
	}
	
	public function userlist(){
		$sql = $this->select_all("usrdetail");
		while($sqlrow = mysql_fetch_array($sql)){
		
			$sqlres .= '<option value="'.$sqlrow['id'].'">'.$sqlrow['uname'].'</option>';
		
		}
		
		return $sqlres ;
	}
	
	public function updaterights(){
	
		if($_POST['user']=='-'){
			$sqlres = "<div class='msg'>Select User</div>";
		}
		else{
			for($i = 1;$i<$_POST['maxsno'];$i++){
				$sql = $this->update_part("userrights","rights='".$_POST['inrights'.$i]."'","menu='".$_POST['menu'.$i]."' and submenu='".$_POST['submenu'.$i]."' and usrid='".$_POST['user']."'");
			}
			
			$sqlres = "<div class='msg'>Rights Granted</div>";
		}
		
	return $sqlres;
	}
	
	
	public function allmenuoptions(){
	
		$sqlres .= '<ul>
<li><a href="index.php">Home</a></li>

<li><a href="">Employee Detail</a>
<ul>
<li><a href="index.php?p=empdet">Add New Employee</a></li>
<li><a href="index.php?p=viewempdet">View Employee Data</a></li>
</ul>
</li>
<li><a href="#">Attendance Management</a>
<ul>
<li><a href="index.php?p=daily-attend">Upload Data</a></li>
<li><a href="index.php?p=view-attend">View Data</a></li>
<li><a href="index.php?p=monthly-attend">Monthly Attendance</a></li>
<li><a href="index.php?p=monthleave">Monthly Leaves</a></li>
</ul>
</li>
<li><a href="#">Payroll</a>
<ul>
<li><a href="index.php?p=salary">Salary</a></li>
<li><a href="index.php?p=allowances">Allowances</a></li>
</ul></li>
<li><a href="#">Forms</a>
<ul> 
<li><a href="index.php?p=leave">Leave Form</a></li>
<li><a href="index.php?p=appointment">Appointment Letter</a></li>
<li><a href="index.php?p=promotion">Promotion Letter</a></li>
<li><a href="index.php?p=demotion">Demotion Letter</a></li>
</ul>
</li>
<li><a href="#">Expense Management</a>
<ul>
<li><a href="/hr/?p=companybills">Company Bills</a></li>
<li><a href="/hr/?p=personalbills">Personal Bills</a></li>
</ul>
</li>
<li><a href="#">Reports</a>
<ul>
<li><a href="/hr/?p=empreport">Employee Detail</a></li>
<li><a href="/hr/?p=compbillreport">Company Bills</a></li>
<li><a href="/hr/?p=personalbillreport">Personal Bills</a></li>
<li><a href="/hr/?p=leaveapp">Leave Applications</a></li>
</ul>
</li>
<li>
<a href="#">Walkins</a>
<ul>
<li><a href="/hr/?p=empwalk">Employee Walkin</a></li>
<li><a href="/hr/?p=guestwalk">Guest Walkin</a></li>
</ul>
</li>
<li>
<a href="#">Users</a>
<ul>
<li><a href="/hr/?p=createuser">Create User</a></li>
<li><a href="/hr/?p=userrights">User Rights</a></li>
</ul>
</li>
<li><a href="index.php?p=logout">Logout</a></li>';
if($_SESSION['login_user']){ 

$sqlres .= '<li>Welcome : '.$_SESSION['login_user'].'</li>';
}
$sqlres .= '</ul>';
return $sqlres;
	
	}
	
	
	public function viewmenu(){
	
	$menucount = $this->select_count("menuoptions");
	
	$rightscount = $this->select_count_part("userrights","usrid='".$_SESSION['loginid']."' and rights='Y'");

		if($menucount == $rightscount){
			$sqlres = $this->allmenuoptions();
		}
		elseif($rightscount == 0){
			$sqlres .= '<ul>
<li><a href="index.php">Home</a></li>';
if($_SESSION['login_user'] == 'admin'){
$sqlres .= '<li>
<a href="#">Users</a>
<ul>
<li><a href="/hr/?p=createuser">Create User</a></li>
<li><a href="/hr/?p=userrights">User Rights</a></li>
</ul>
</li>';

}
$sqlres .= '<li><a href="index.php?p=logout">Logout</a></li>';
if($_SESSION['login_user']){ 

$sqlres .= '<li>Welcome : '.ucwords($_SESSION['login_user']).'</li>';
}
$sqlres .= '</ul>';
		
		}
		
		else{
		$sqlres .= '<ul>
<li><a href="index.php">Home</a></li>';

			$sql = $this->select_part("userrights","usrid='".$_SESSION['loginid']."' and rights='Y'and menu=submenu");
			while($sqlrow = mysql_fetch_array($sql)){
			
				/*if($sqlrow['menu']==$sqlrow['submenu']){*/
				
					$sqlres .= '<li><a href="/hr/?p='.$sqlrow['linkpage'].'">'.$sqlrow['menu'].'</a>';
					
					$count = $this->select_count_part("userrights","usrid='".$_SESSION['loginid']."' and rights='Y'and menu='".$sqlrow['menu']."' and menu!=submenu");
					
					if($count!=0){
					$sql1 = $this->select_part("userrights","usrid='".$_SESSION['loginid']."' and rights='Y'and menu='".$sqlrow['menu']."' and menu!=submenu");
					
					$sqlres .= '<ul>';
					while($sqlrow1 = mysql_fetch_array($sql1)){
						$sqlres .= '<li><a href="/hr/?p='.$sqlrow1['linkpage'].'">'.$sqlrow1['submenu'].'</a></li>';
					}
					$sqlres .= '</ul></li>';
					}
					else{
						$sqlres .= '</li>';
					}
						
			/*	}*/
				
			
			}
			
			$sqlres .= '<li><a href="index.php?p=logout">Logout</a></li>';
if($_SESSION['login_user']){ 

$sqlres .= '<li>Welcome : '.ucwords($_SESSION['login_user']).'</li>';
}
$sqlres .= '</ul>';
		
		}
	
	return $sqlres;
	}
	
	public function smsinfo(){
		$sqlres = $this->select_all("smscontact");
		
		return $sqlres;
	}

public function finalsend($recerverNO,$message){
		
		$url        = "http://site24.way2sms.com/smstoss.action?Token=" . $id;
    $parameters = array(
        "button" => "Send SMS",
        "mobile" => "$recerverNO",
        "message" => "$message"
    );
    
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_POST, count($parameters));
    curl_setopt($ch, CURLOPT_POSTFIELDS, $parameters);
    curl_setopt($ch, CURLOPT_HEADER, TRUE);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
    curl_setopt($ch, CURLOPT_COOKIEJAR, $cookie_file_path);
    curl_setopt($ch, CURLOPT_COOKIEFILE, $cookie_file_path);
    curl_setopt($ch, CURLOPT_FOLLOWLOCATION, TRUE);
    curl_setopt($ch, CURLOPT_USERAGENT, $user_agent);
    curl_setopt($ch, CURLOPT_NOBODY, FALSE);
    $result = curl_exec($ch);
    curl_close($ch);
	
	
	}
		
		
	public function sendmail($mail,$usr){
	
	$to = $mail;
   $subject = "Leave Application (A3G INFOTECH)";
   $message = "<b>Leave Submitted by ".$usr." on ".DT."</b>";
   $message .= "<h1>Reason : </h1>";
   $message .= "<p>".$_POST['leave_stat']."</p>";
   $header = "From:harnish.kang2012@gmail.com \r\n";
   $header = "Cc:harnish@a3g.in \r\n";
   $header .= "MIME-Version: 1.0\r\n";
   $header .= "Content-type: text/html\r\n";
   $retval = mail ($to,$subject,$message,$header);
  	
	return $retval;
	
	}
	public function sendsms($usrid){
	
	 $sqlres = $this->select_part("smscontact","empid=".$usrid);	
	while($sqlrow = mysql_fetch_array($sqlres)){
		$s = $this->sendmail($sqlrow['email'],$sqlrow['empname']);
		if($s){
		$sqlres1 .= "<div class='msg'>Password Changed.</div>";
		}
	$sqladmin = $this->select_part("smscontact","adminyn='Y'");	
while($sqlrowadmin = mysql_fetch_array($sqladmin)){
		$s1 = $this->sendmail($sqlrow['email'],$sqlrow['empname']);
		if($s1){
		$sqlres1 .= "<div class='msg'>Password Changed.</div>";
		}

	}
	}

	
		$userID = '9876551789';
		$userPWD = 'F5845R';

    if (!function_exists('curl_init')) {
        echo "Error : Curl library not installed";
        return FALSE;
    }
    $message_urlencode = rawurlencode($message);
    if (strlen($message) > 140) {
        $message = substr($message, 0, 139);
    }
    
    $cookie_file_path = "./cookie.txt";
    $temp_file        = "./temporary.txt";
    $user_agent       = "Mozilla/5.0 (Windows NT 6.1) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/35.0.1916.153 Safari/537.36";
    
    // LOGIN TO WAY2SMS
    
    $url        = "http://site24.way2sms.com/content/Login1.action";
    $parameters = array(
        "username" => "$userID",
        "password" => "$userPWD",
        "button" => "Login"
    );
    
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_POST, count($parameters));
    curl_setopt($ch, CURLOPT_POSTFIELDS, $parameters);
    curl_setopt($ch, CURLOPT_HEADER, TRUE);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
    curl_setopt($ch, CURLOPT_COOKIEJAR, $cookie_file_path);
    curl_setopt($ch, CURLOPT_COOKIEFILE, $cookie_file_path);
    curl_setopt($ch, CURLOPT_FOLLOWLOCATION, TRUE);
    curl_setopt($ch, CURLOPT_USERAGENT, $user_agent);
    curl_setopt($ch, CURLOPT_NOBODY, FALSE);
    $result = curl_exec($ch);
    curl_close($ch);
    
    // SAVE LOGOUT URL
    
    file_put_contents($temp_file, $result);
    $result     = "";
    $logout_url = "";
    $file       = fopen($temp_file, "r");
    $line       = "";
    $cond       = TRUE;
    while ($cond == TRUE) {
        $line = fgets($file);
        if ($line === FALSE) { // EOF
            $cond = FALSE;
        } else {
            $pos = strpos($line, ' window.location="');
            if ($pos === FALSE) {
                $line = "";
            } else { // URL FOUND
                $cond       = FALSE;
                $logout_url = substr($line, -25);
                $logout_url = substr($logout_url, 0, 21);
            }
        }
    }
    fclose($file);
    
    // SAVE SESSION ID
    
    $file = fopen($cookie_file_path, "r");
    $line = "";
    $cond = TRUE;
    while ($cond == TRUE) {
        $line = fgets($file);
        if ($line === FALSE) { // EOF
            $cond = FALSE;
        } else {
            $pos = strpos($line, "JSESSIONID");
            if ($pos === FALSE) {
                $line = "";
            } else { // SESSION ID FOUND
                $cond = FALSE;
                $id   = substr($line, $pos + 15);
            }
        }
    }
    fclose($file);
    
    // SEND SMS
    
    $sqlres = $this->select_part("smscontact","empid=".$usrid);	
	while($sqlrow = mysql_fetch_array($sqlres)){
		
		$recerverNO = $sqlrow['contact'];
		$message = 'Your leave has been submitted (A3G INFOTECH)';
		$url        = "http://site24.way2sms.com/smstoss.action?Token=" . $id;
    $parameters = array(
        "button" => "Send SMS",
        "mobile" => "$recerverNO",
        "message" => "$message"
    );
    
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_POST, count($parameters));
    curl_setopt($ch, CURLOPT_POSTFIELDS, $parameters);
    curl_setopt($ch, CURLOPT_HEADER, TRUE);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
    curl_setopt($ch, CURLOPT_COOKIEJAR, $cookie_file_path);
    curl_setopt($ch, CURLOPT_COOKIEFILE, $cookie_file_path);
    curl_setopt($ch, CURLOPT_FOLLOWLOCATION, TRUE);
    curl_setopt($ch, CURLOPT_USERAGENT, $user_agent);
    curl_setopt($ch, CURLOPT_NOBODY, FALSE);
    $result = curl_exec($ch);
    curl_close($ch);
	$sqladmin = $this->select_part("smscontact","adminyn='Y'");	
while($sqlrowadmin = mysql_fetch_array($sqladmin)){
		
		$recerverNO = $sqlrowadmin['contact'];	
		$message = $sqlrow['empname'].' has submitted leave from : '.$_POST['fromdt'].'to : '.$_POST['todt'];
		$url        = "http://site24.way2sms.com/smstoss.action?Token=" . $id;
    $parameters = array(
        "button" => "Send SMS",
        "mobile" => "$recerverNO",
        "message" => "$message"
    );
    
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_POST, count($parameters));
    curl_setopt($ch, CURLOPT_POSTFIELDS, $parameters);
    curl_setopt($ch, CURLOPT_HEADER, TRUE);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
    curl_setopt($ch, CURLOPT_COOKIEJAR, $cookie_file_path);
    curl_setopt($ch, CURLOPT_COOKIEFILE, $cookie_file_path);
    curl_setopt($ch, CURLOPT_FOLLOWLOCATION, TRUE);
    curl_setopt($ch, CURLOPT_USERAGENT, $user_agent);
    curl_setopt($ch, CURLOPT_NOBODY, FALSE);
    $result = curl_exec($ch);
    curl_close($ch);
	
	}
	}
		
			

    
    
    // LOGOUT WAY2SMS
    
    $url = "site24.way2sms.com/" . $logout_url;
    
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_HEADER, TRUE);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
    curl_setopt($ch, CURLOPT_COOKIEJAR, $cookie_file_path);
    curl_setopt($ch, CURLOPT_COOKIEFILE, $cookie_file_path);
    curl_setopt($ch, CURLOPT_FOLLOWLOCATION, TRUE);
    curl_setopt($ch, CURLOPT_USERAGENT, $user_agent);
    curl_setopt($ch, CURLOPT_NOBODY, FALSE);
    $result = curl_exec($ch);
    curl_close($ch);
    
    // DELETE TEMP FILES
    
    unlink($cookie_file_path);
    unlink($temp_file);
    
   /* return TRUE;
    
    
    return $sqlres1;*/
    
    return "<div class='msg'>Leave Submitted</div>";
}
	
	
	public function changepswd(){
	
		$usrcount = $this->select_count_part("usrdetail","uname='".$_POST['usr']."' and pswd='".$_POST['oldpwd']."'");
		return "changepass";
		if($usrcount == 0){
		
			$sqlres = "<div class='msg'>Invalid Username / Password.</div>";
		
		}
		else{
			$sql = $this->update_part("usrdetail","pswd = '".$_POST['newpwd']."'","uname='".$_POST['usr']."' and pswd='".$_POST['oldpwd']."'");
			
			if($sql){
				$sqlres = "<div class='msg'>Password Changed.</div>";
			}
			else{
				$sqlres = "<div class='msg'>Access Denied</div>";
			}
			
		
		}
		
		return $sqlres;
	
	}
	
	public function timeindata(){
		$sql = $this->select_count_part("timeinout","dt = '".DT."'");
		
		if($sql==0){
			$sql = mysql_query("insert into timeinout(empid,empnm,dt,timeinstatus,timeoutstatus) (select id,concat(fname,' ',lname) as empnm,'".DT."','status','status' from employee where status != 'Y' order by fname)");
			
		}

	}
	
	public function timeintimeout(){
		
		$a = "'";
		$param = $a.TM.$a;
		/*$sqlcnt = $this->select_count_part("timeinout","dt='".DT."' and timein = '00:00:00'");
		
		if($sqlcnt!=0){*/
			$res .= '<div class="formhead"><input type="submit" name="submit" class="submitBtn1 showbtn" value="Submit" style="visibility:hidden; cursor:pointer;"/></div><hr/>';
		/*}
		else{
			$res .= '<div class="formhead"><input type="submit" name="update" class="submitBtn1 showbtn" value="Update" style="visibility:hidden; cursor:pointer;"/></div><hr/>';
		}*/
		$res.='<div class="formhead">
		<div class="sno">S.No.</div>
		<div class="empname">Employee Name</div>
		<div class="sno">Time In</div>
		<div class="sno">Time Out</div>
		<div class="sno">Status</div>
	</div>
	<hr/>';
		$sql = $this->select_part("timeinout","dt='".DT."'");
		$i = 1;
		while($row = mysql_fetch_array($sql)){
			$res .= '<div class="row"><div class="sno">'.$i.'</div><div class="line"></div>
		<div class="empname">'.$row['empnm'].'</div><div class="line"></div>';
		if($row['timein']=="00:00:00"){
			$res .= '<input type="hidden" name="timein'.$row['empid'].'" id="intimein'.$row['empid'].'" value="00:00:00" /><div class="sno timein'.$row['empid'].'" onclick="timein('.$row['empid'].');">Enter</div><div class="line"></div>';
		}
		else{
			$res .= '<input type="hidden" name="timein'.$row['empid'].'" id="intimein'.$row['empid'].'" value="'.$row['timein'].'"/><div class="sno timein'.$row['empid'].'">'.$row['timein'].'</div><div class="line"></div>';
		}
		
		/*$res .= '<input type="text" name="timein'.$row['empid'].'" id="intimein'.$row['empid'].'" />';*/
		if($row['timeout']=="00:00:00"){
			$res .= '<input type="hidden" name="timeout'.$row['empid'].'" id="intimeout'.$row['empid'].'" value="00:00:00"/><div class="sno timeout'.$row['empid'].'" onclick="timeout('.$row['empid'].');">Out</div><div class="line"></div>';
		}
		else{
			$res .= '<input type="hidden" name="timeout'.$row['empid'].'" id="intimeout'.$row['empid'].'" value="'.$row['timeout'].'"/><div class="sno timeout'.$row['empid'].'" onclick="timeout('.$row['empid'].');">'.$row['timeout'].'</div><div class="line"></div>';
		}
		
		$res .= '
		<div class="sno status instatus'.$row['empid'].'">'.$row['timeinstatus'].'</div>
		<input type="hidden" name="instatusval'.$row['empid'].'" id="instatusval'.$row['empid'].'" value="'.$row['timeinstatus'].'" />
		<div class="sno status outstatus'.$row['empid'].'">'.$row['timeoutstatus'].'</div>
		<input type="hidden" name="outstatusval'.$row['empid'].'" id="outstatusval'.$row['empid'].'" value="'.$row['timeoutstatus'].'" />
		</div><hr/>';$i++;
		}
		
	return $res;
	
	}
	
	public function timein(){
		$firstDayUTS = mktime(0, 0, 0, $mnt, 1, $yr);
		$firstday = date("D", $firstDayUTS);
		if(strtolower($firstday) == "fri"){
			$d2 = ltrim(date('d',strtotime('+1 week sat '.strtolower(CHARMNT).' 2019')),0);
			$d4 = ltrim(date('d',strtotime('+3 week sat '.strtolower(CHARMNT).' 2019')),0);
		}
		$sql = $this->select_part("employee","status != 'Y' order by fname");
		
		while($row = mysql_fetch_array($sql)){
			
			$selected="";
			$lateval = 0;
			$res .= $this->update_part("timeinout","timein='".$_POST['timein'.$row['id']]."',timeinstatus='".$_POST['instatusval'.$row['id']]."',timeout='".$_POST['timeout'.$row['id']]."',timeoutstatus='".$_POST['outstatusval'.$row['empid']]."'", "empid=".$row['id']." and dt='".DT."'");
			$cntrow = $this->select_count_part("daily_attend","empid = '".$row['id']."' and dt = '".DT."'");
			$insrow = mysql_fetch_assoc($this->select_part("timeinout","empid = '".$row['id']."' and dt = '".DT."'"));
			$selfull = $this->select_count_part("leaveform","name = '".$row['id']."' and approved = 'Y' and fromdt = todt and fromdt = '".DT."' and halftype = 'Y'");
				if($selfull != 0){
					$selected = 'H';
				}
				else{
					$selfull = $this->select_count_part("leaveform","name = '".$row['id']."' and approved = 'Y' and fromdt = todt and fromdt = '".DT."' and fulltype = 'Y'");
					if($selfull != 0){
						$selected = 'F';
					}
					else{
						$selfull = $this->select_count_part("leaveform","name = '".$row['id']."' and approved = 'Y' and fromdt != todt and ('".DT."' BETWEEN fromdt AND todt) and fulltype = 'Y' and halftype != 'Y' ");
						if($selfull != 0){
							$selected = 'F';
						}
						else{
							$selfull = $this->select_count_part("leaveform","name = '".$row['id']."' and approved = 'Y' and fromdt != todt and ('".DT."' BETWEEN fromdt AND todt) and fulltype != 'Y' and halftype = 'Y' ");
							if($selfull != 0){
								$selected = 'H';
							}							
						}
					}
				}
				
				if(($insrow['timein'] == '00:00:00')&&(($selected == 'F'))){
					$prval = 'N';
					$hfval = 'N';
					$abval = 'N';
					$offval= 'N';
					$lvval = 'Y';
				}
				elseif(($insrow['timein'] < '11:00:00')&($insrow['timein'] > '09:35:00')){
					
					$hfval = 'N';
					$prval = 'Y';
					$abval = 'N';
					$offval= 'N';
					$lvval = 'N';
					$lateval = 1;
				}
				elseif($insrow['timein']>'11:00:00'){
					$hfval = 'Y';
					$prval = 'N';
					$abval = 'N';
					$offval= 'N';
					$lvval = 'N';
				}
				elseif($selected == 'H'){
					$hfval = 'Y';
					$prval = 'N';
					$abval = 'N';
					$offval= 'N';
					$lvval = 'N';
				}
				else{
					$hfval = 'N';
					$prval = 'N';
					$abval = 'Y';
					$offval= 'N';
					$lvval = 'N';
					$lateval = 0;
				}
				
			if($cntrow != 0){

				$insdata = "timein='".$insrow['timein']."',timeout='".$insrow['timeout']."',present='".$prval."', half = '".$hfval."', absent='".$abval."', lv='".$lvval."', off='".$offval."', latecount = (latecount+".$lateval.")";
				$res1 = $this->update_part("daily_attend",$insdata,"empid = '".$row['id']."' and dt = '".DT."'");
			}
			else{
				$insdata = array("id"=>"","empid"=>$insrow['empid'],"name"=>$insrow['empnm'],"dt"=>DT,"timein"=>$insrow['timein'],"timeout"=>$insrow['timeout'],"present"=>$prval,"half"=>$hfval,"absent"=>$abval,"lv"=>$lvval,"off"=>$offval,"latecount"=>$lateval);
				$res1 = $this->insert_all("daily_attend",$insdata);
			}
			if(strtolower($firstday) == "fri"){
				echo "yes";
		$cntnxtrow = $this->select_count_part("daily_attend","empid = '".$row['id']."' and dt = '".NXTDT."'");
		if($cntnxtrow == 0){
		if((ltrim(NXTDD,0) == $d2)||(ltrim(NXTDD,0) == $d4)){
				$insoff = array("id"=>"","empid"=>$insrow['empid'],"name"=>$insrow['empnm'],"dt"=>NXTDT,"present"=>'N',"absent"=>'N',"lv"=>'N',"half"=>'N',"off"=>'Y');
				$resoff = $this->insert_all("daily_attend",$insoff);
				$nxtdt = date('Y-m-d', strtotime(' +2 day'));
				$insoff = array("id"=>"","empid"=>$insrow['empid'],"name"=>$insrow['empnm'],"dt"=>$nxtdt,"present"=>'N',"absent"=>"N","lv"=>"N","half"=>"N","off"=>"Y");
				$resoff = $this->insert_all("daily_attend",$insoff);
			}
			else{
				$nxtdt = date('Y-m-d', strtotime(' +2 day'));
				$insoff = array("id"=>"","empid"=>$insrow['empid'],"name"=>$insrow['empnm'],"dt"=>$nxtdt,"present"=>'N',"absent"=>"N","lv"=>"N","half"=>"N","off"=>"Y");
				$resoff = $this->insert_all("daily_attend",$insoff);
			}
		}
		}
			
		}
	
		if($res){
				$sqlres = "<div class='msg'>Walkins Updated</div>";
			}
			else{
				$sqlres = "<div class='msg'>Access /.</div>";
			}
	
	return $sqlres;
	}
	
	public function guestwalk($data){
	
			$sql = $this->insert_all("guestwalk",$data);
			if($sql){
				$empnm = mysql_fetch_assoc($this->select_part("employee","id=".$_POST['tomeet']));
				if($_POST['rem']){
					$msg = $_POST['nm'].' and '.$_POST['rem'].' to meet '.ucwords($empnm['fname']).' '.ucwords($empnm['lname']).' Attend as required';
				}
				else{
					$msg = $_POST['nm'].' to meet '.ucwords($empnm['fname']).' '.ucwords($empnm['lname']).' Attend as required';
				}
				
				/*$this->sendleavesms('7837868829',$msg);*/
				$this->sendleavesms('9876551789',$msg);
				$this->sendleavesms('9876551789',$msg);
				$sqlres = "<div class='msg'>Walkins Updated</div>";
			}
			else{
				$sqlres = "<div class='msg'>Access Denied</div>";
			}
	
	return $sqlres;
	}
	
	public function guestwalkdet(){
	
		$sql = $this->select_part("guestwalk","dt='".DT."'");
		$i = 1;
		while($row = mysql_fetch_array($sql)){
		$empnm = mysql_fetch_assoc($this->select_part("employee","id=".$row['tomeet']));
			$res .= '<div class="row"><div class="sno space">'.$i.'</div>
			
			<div class="line1"></div>
						<div class="reportdt space" style="width:25%;">'.$row['guestname'].'</div>
						<div class="line1"></div>
				<div class="reportdt space" style="width:20%;">'.$row['rem'].'</div>
				<div class="line1"></div>
				<div class="reportdt space" style="width: 17%;">'.ucwords($empnm['fname']).' '.ucwords($empnm['lname']).'</div>
				<div class="line1"></div>
				<div class="reportdt space">'.$row['timein'].'</div>
				<div class="line1"></div>
				<div class="reportdt space guestout'.$row['id'].'" style="width: 12%; cursor:pointer;" ';
				if($row['timeout'] == '00:00:00'){
				$res .= 'onclick="guestout('.$row['id'].');">
				Click';
				}
				else{
				$res .= '>'.$row['timeout'];
				}
				$res .= '</div></div><div class="clear"></div><hr/>';
				$i++;
		}
		
		return $res;
	
	}
	
	
	public function guest($id){
	
		$sql = $this->update_part("guestwalk","timeout='".TM."'","id=".$id);
		
		
	
		if($sql){
				$sqlres = "<div class='msg'>Walkins Updated</div>";
			}
			else{
				$sqlres = "<div class='msg'>Access Denied</div>";
			}
	
	return "sql = ".$sql;
	}

	
	public function viewempdet($empid){
		$num = 1;
		$res="";
		$sqlnum = $this->select_part("employee","status != 'Y' order by fname");
		while($rownum = mysql_fetch_array($sqlnum)){
		
			$this->update_part("employee","seqno=".$num,"id=".$rownum['id']);
			$num++;
		}
		if($empid == 'all'){
			$sql = $this->select_part("employee","status != 'Y' and seqno = (select min(seqno) from employee) order by fname");
		}
		else{
			$sql = $this->select_part("employee","seqno=".$empid." and status != 'Y' order by fname");
		}
		while($row=mysql_fetch_array($sql)){
		$a = "'";
			$res .= '<div class="hd">
			<div class="hdno"><input type="hidden" class="empid" value="'.$row['seqno'].'"/></div>
			<div class="hdleft">
				<p class="profile-nm">'.ucwords($row['fname']).' '.ucwords($row['lname']).'</p>';
				$sqldesig = mysql_fetch_assoc($this->select_part("desig_master","id=".$row['designation']));

  				$res .= '<p class="profile-des">'.$sqldesig['desig'].' (Active)</p>
  			</div>';
  			
			$res .= '<div class="hdright">
  				<ul>
				  <li onclick=nxt("prev")>Prev</li>
				  <li class="li2">|</li>
				  <li onclick=nxt("next")>Next</li>
				</ul>
  			</div>';
  			
  			
		$res .= '</div>
		<div class="clear"></div>
		<div class="profile-pic" >';
		
		/*$sqlcnt = $this->select_col_count_part("empimg","id=".$row['empid']);*/
		
		/*if($sqlcnt != 0){*/
				$res .= '<img src="pages/getpic.php?id='.$row['empid'].'" />';
		/*	}
			else{
				$res .= '<img src="images/usr.png" />';
			}*/
		$res .= '</div>	
		
		<div class="profile-data" >
		<div class="data-left" >
  			<ul>
  				<li>
  					<div class="lidata">
  						<div class="lileft"><img src="images/call.png"/></div>
  						<div class="liright" ><p class="callp">'.$row['contact'].'</p></div>
  					</div>
  				</li>
				<li>
				  <div class="lidata">
				  	<div class="lileft" ><img src="images/mail.png" /></div>
				  	<div class="liright" ><p class="callp">'.$row['email'].'</p></div>
				  </div>
				</li>
				<li><div class="lidata"><p class="p-head">Hire Date</p></div></li>';
				$date=date_create($row['jdt']);
				$date1=date_create(DT);
				$res .= '<li><div class="lidata"><p class="dt-head">'.date_format($date,"d-m-Y").'</p></div></li>';
				$diff=date_diff($date,$date1);
				$diff=intval($diff->format("%R%a"));
				$y = floor($diff/365);
				$m = floor(($diff - ($y*365))/30);
				$d = $diff-(($m*30)+($y*365));
				$res .= '<li><div class="lidata"><p class="dt-int">'.$y.'y '.$m.'m '.$d.'d</p></div></li>
				<li><div class="lidata"><p class="p-head">Department</p></div></li>';
				$sqldept = mysql_fetch_assoc($this->select_part("deptt","id=".$row['depttid']));	
				$agedate=date_create($row['dob']);
				$agedate1=date_create(DT);	
				$agediff=date_diff($agedate,$agedate1);
				$agediff=intval($agediff->format("%R%a"));
				$agey = floor($agediff/365);
				$agem = floor(($agediff - ($agey*365))/30);
				$aged = $agediff-(($agem*30)+($agey*365));
				$res .= '<li><div class="lidata"><p class="dt-int">'.$sqldept['deptnm'].'</p></div></li>
				<li><div class="lidata"><p class="p-head">Status</p></div></li>
				<li><div class="lidata"><p class="dt-int">Permanent</p></div></li>
				<li><div class="lidata"><p class="p-head">Salary</p></div></li>
				<li><div class="lidata"><p class="dt-int">INR '.$row['basic_pay'].'</p></div></li>
		      </ul>
  	      </div>
  	      <div class="data-right" style=" width: 70%;float: left;border-left: solid thin #808080;padding: 0 0 0 1%;">
  	      	<div class="dr-head" style="width: 100%;float: left;margin: 1% 0 0 0;"><img src="images/usr.png" style="float: left;width: 4%;"/><p style="float: left;margin: 1%;font-size: 18px;">Personal</p></div>
  	      	<hr/>
  	      	<div class="lidata"><p class="add-data">Address</p></div>
		<div class="lidata"><p class="dt-int nomarg">'.$row['address1'].'</p></div>
		<div class="lidata"><p class="dt-int nomarg">'.$row['address2'].'</p></div>';
		$sqlcity = mysql_fetch_assoc($this->select_part("city_master","id=".$row['city']));
		$sqlstate = mysql_fetch_assoc($this->select_part("state_master","id=".$row['state']));
		$res .= '<div class="lidata"><p class="dt-int nomarg">'.$sqlcity['city'].' - '.$row['pincode'].'</p></div>
		<div class="lidata"><p class="dt-int nomarg">'.$sqlstate['state'].'</p></div>
		<div class="lidata"><p class="add-data">Qualification and Other</p></div>
		<div class="lidata"><p class="dt-int nomarg">'.$row['mstatus'].'</p></div>
		<div class="lidata"><p class="dt-int nomarg">'.$row['dob'].' Age : '.$agey.'</p></div>
		<div class="lidata"><p class="dt-int nomarg">'.$row['qual'].'</p></div>
		<div class="lidata"><p class="dt-int nomarg">'.$row['add_qual'].'</p></div>
		
		<div class="dr-head" style="width: 100%;float: left;margin: 1% 0 0 0;"><img src="images/work.png" style="float: left;width: 4%;"/><p style="float: left;margin: 1%;font-size: 18px;">Work Experience</p><!--<p class="dt-int"> ('.$row['years'].'y 2m)</p>--></div>
		
  	      	<hr/>
  	      	<div class="lidata"><p class="add-data">Company and Remarks</p></div>
		<div class="lidata"><p class="dt-int nomarg">'.$row['company'].'</p></div>
		<div class="lidata"><p class="dt-int nomarg">'.$row['remark1'].'</p></div>
  	      </div>
	
	     </div>	
	<div class="clear"></div>
	';
	}
	return $res;
	}
	
	public function viewempdetid($empid){
	/*	$num = 1;
		$sqlnum = $this->select_part("employee","status != 'Y' order by fname");
		while($rownum = mysql_fetch_array($sqlnum)){
		
			$this->update_part("employee","seqno=".$num,"id=".$rownum['id']);
			$num++;
		}
		if($empid == 'all'){
			$sql = $this->select_part("employee","status != 'Y' and seqno = (select min(seqno) from employee) order by fname");
		}
		else{*/
		
			$sql = $this->select_part("employee","id=".$_SESSION['menuid']." and status != 'Y' order by fname");
		/*}*/
		while($row=mysql_fetch_array($sql)){
		$a = "'";
			$res .= '<div class="hd">
			<div class="hdno"><input type="hidden" class="empid" value="'.$row['seqno'].'"/></div>
			<div class="hdleft">
				<p class="profile-nm">'.ucwords($row['fname']).' '.ucwords($row['lname']).'</p>
  				<p class="profile-des">'.$row['designation'].' (Active)</p>
  			</div>';
  			
			
		$res .= '</div>
		<div class="clear"></div>
		<div class="profile-pic" >';
		
		$sqlcnt = $this->select_col_count_part("empimg","id=".$row['empid']);
		
		if($sqlcnt != 0){
				$res .= '<img src="pages/getpic.php?id='.$_SESSION['menuid'].'" />';
			}
			else{
				$res .= '<img src="images/usr.png" />';
			}
		$res .= '</div>	
		
		<div class="profile-data" >
		<div class="data-left" >
  			<ul>
  				<li>
  					<div class="lidata">
  						<div class="lileft"><img src="images/call.png"/></div>
  						<div class="liright" ><p class="callp">'.$row['contact'].'</p></div>
  					</div>
  				</li>
				<li>
				  <div class="lidata">
				  	<div class="lileft" ><img src="images/mail.png" /></div>
				  	<div class="liright" ><p class="callp">'.$row['email'].'</p></div>
				  </div>
				</li>
				<li><div class="lidata"><p class="p-head">Hire Date</p></div></li>';
				$date=date_create($row['jdt']);
				$date1=date_create(DT);
				$res .= '<li><div class="lidata"><p class="dt-head">'.date_format($date,"d-m-Y").'</p></div></li>';
				$diff=date_diff($date,$date1);
				$diff=intval($diff->format("%R%a"));
				$y = floor($diff/365);
				$m = floor(($diff - ($y*365))/30);
				$d = $diff-(($m*30)+($y*365));
				$res .= '<li><div class="lidata"><p class="dt-int">'.$y.'y '.$m.'m '.$d.'d</p></div></li>
				<li><div class="lidata"><p class="p-head">Department</p></div></li>';
				$sqldept = mysql_fetch_assoc($this->select_part("deptt","id=".$row['depttid']));
				$agedate=date_create($row['dob']);
				$agedate1=date_create(DT);	
				$agediff=date_diff($agedate,$agedate1);
				$agediff=intval($agediff->format("%R%a"));
				$agey = floor($agediff/365);
				$agem = floor(($agediff - ($agey*365))/30);
				$aged = $agediff-(($agem*30)+($agey*365));		
				$res .= '<li><div class="lidata"><p class="dt-int">'.$sqldept['deptnm'].'</p></div></li>
				<li><div class="lidata"><p class="p-head">Status</p></div></li>
				<li><div class="lidata"><p class="dt-int">Permanent</p></div></li>
				<li><div class="lidata"><p class="p-head">Salary</p></div></li>
				<li><div class="lidata"><p class="dt-int">INR '.$row['basic_pay'].'</p></div></li>
		      </ul>
  	      </div>
  	      <div class="data-right" style=" width: 70%;float: left;border-left: solid thin #808080;padding: 0 0 0 1%;">
  	      	<div class="dr-head" style="width: 100%;float: left;margin: 1% 0 0 0;"><img src="images/usr.png" style="float: left;width: 4%;"/><p style="float: left;margin: 1%;font-size: 18px;">Personal</p></div>
  	      	<hr/>
  	      	<div class="lidata"><p class="add-data">Address</p></div>
		<div class="lidata"><p class="dt-int nomarg">'.$row['address1'].'</p></div>
		<div class="lidata"><p class="dt-int nomarg">'.$row['address2'].'</p></div>
		<div class="lidata"><p class="dt-int nomarg">'.$row['city'].' - '.$row['pincode'].'</p></div>
		<div class="lidata"><p class="dt-int nomarg">'.$row['state'].'</p></div>
		<div class="lidata"><p class="add-data">Qualification and Other</p></div>
		<div class="lidata"><p class="dt-int nomarg">'.$row['mstatus'].'</p></div>
		<div class="lidata"><p class="dt-int nomarg">'.$row['dob'].' Age : '.$agey.'</p></div>
		<div class="lidata"><p class="dt-int nomarg">'.$row['qual'].'</p></div>
		<div class="lidata"><p class="dt-int nomarg">'.$row['add_qual'].'</p></div>
		
		<div class="dr-head" style="width: 100%;float: left;margin: 1% 0 0 0;"><img src="images/work.png" style="float: left;width: 4%;"/><p style="float: left;margin: 1%;font-size: 18px;">Work Experience</p><!--<p class="dt-int"> ('.$row['years'].'y 2m)</p>--></div>
		
  	      	<hr/>
  	      	<div class="lidata"><p class="add-data">Company and Remarks</p></div>
		<div class="lidata"><p class="dt-int nomarg">'.$row['company'].'</p></div>
		<div class="lidata"><p class="dt-int nomarg">'.$row['remark1'].'</p></div>
  	      </div>
	
	     </div>	
	<div class="clear"></div>
	';
	}
	return $res;
	}
	
	public function upperfields(){
		
	if($_SESSION['login_user'] == 'admin'){
		$res.='<select name="nm" class="inp-form">
		<option value="select">---Select---</option>';
			$res.= $this->optionsval("employee","id,fname,lname");
		$res.='</select>';
	} 
	else{
        $res.='<select name="nm" class="inp-form" >
		<option value="'.$_SESSION['menuid'].'">'.$_SESSION['login_user'].'</option></select>';
    }
		$res.='</div></div>
		<div class="row"><div class="col1">Designation : </div><div class="col2">';
		
    if($_SESSION['login_user'] == 'admin'){
		$res.='<select name="desig" class="inp-form">
		<option value="select">---Select---</option>';
		$res.= $this->optionsval("desig_master","id,desig"); 
		$res.='</select>';
   } 
	else{
		$sql = mysql_fetch_assoc($this->select_part("employee","id=".$_SESSION['menuid']));
    	$res.='<select name="desig" class="inp-form" >
		<option value="'.$_SESSION['menuid'].'">'.$sql['designation'].'</option></select>';
	}
	
	echo $res;
}

	public function calendar($mnt,$yr){
		$pos = 0;
		$lv = 0;
		$ab = 0;
		$hf = 0;
		$res="";
		$firstDayUTS = mktime(0, 0, 0, $mnt, 1, $yr);
		$firstday = date("D", $firstDayUTS);
		switch(strtolower($firstday)){
			
			case "sun" : $pos = 0;
			break;
			
			case "mon" : $pos = 1;
			break;
			
			case "tue" : $pos = 2;
			break;
			
			case "wed" : $pos = 3;
			break;
			
			case "thu" : $pos = 4;
			break;
			
			case "fri" : $pos = 5;
			break;
		
			case "sat" : $pos = 6;
			break;
			
			default:$n="none";
		}
		$res .= '<ul>';
		if($pos!=0){
			$i = 1;
			while($i<=$pos){
				$res .= '<li style="visibility:hidden;"></li>';
				$i++;	
			}
		}
		$j = 1;
		$nod = date("t", mktime(1, 1, 1, $mnt, 1, $yr));
		
		while($j <= $nod){
			$sql = mysql_fetch_assoc($this->select_part("daily_attend","month(dt) = ".ltrim($mnt,0)." and year(dt) = ".$yr." and day(dt) = ".ltrim($j,0)." and empid = ".$_SESSION['menuid']));
			$res .= '<input type="hidden" class="empid" value="'.$sql['empid'].'"/><li>';
			if($sql['lv'] == 'Y'){
				$res .= '<div class="cal-leave"></div>';
				$lv++;
				
			}
			else if($sql['absent'] == 'Y'){
				$res .= '<div class="cal-absent"></div>';
				$ab++;
			}
			else if($sql['half'] == 'Y'){
				$res .= '<div class="cal-half"></div>';
				$hf++;
			}
			$res .= $j.'</li>';
			$j++;	
		}
		
		$res .= '</ul>
		<div class="color-info"><ul><li><div class="cal-leave"></div><p>Leaves</p></li>
		<li><div class="cal-absent"></div><p>Absents</p></li>
		<li><div class="cal-half"></div><p>Half Days</p></li>
		</ul>
		</div>
		<hr/>
            <div class="calfoot">
            <div class="subfoot"><p>Total Leaves Taken : </p></div><div class="subfoot1"><p>'.$lv.'</p></div>
            <div class="subfoot"><p>Total Absents : </p></div><div class="subfoot1"><p>'.$ab.'</p></div>
            <div class="subfoot"><p>Total Half Days : </p></div><div class="subfoot1"><p>'.$hf.'</p></div>
            </div>
			
		';
		
		return $res;
	}

	public function calendarfirst($nxtidval,$mnt,$yr){
		
		$pos = 0;
		$lv = 0;
		$ab = 0;
		$hf = 0;
		$res="";
		$nameval="";
		$firstDayUTS = mktime(0, 0, 0, $mnt, 1, $yr);
		$firstday = date("D", $firstDayUTS);
		switch(strtolower($firstday)){
			
			case "sun" : $pos = 0;
			break;
			
			case "mon" : $pos = 1;
			break;
			
			case "tue" : $pos = 2;
			break;
			
			case "wed" : $pos = 3;
			break;
			
			case "thu" : $pos = 4;
			break;
			
			case "fri" : $pos = 5;
			break;
		
			case "sat" : $pos = 6;
			break;
			
			default:$n="none";
		}
$res .= '<ul>';
		if($pos!=0){
			$i = 1;
			while($i<=$pos){
				$res .= '<li style="visibility: hidden;"></li>';
				$i++;	
			}
		}
		$j = 1;
		$sqldrop = $this->droptab();
		
		$sqlnew = mysql_query("create table attend_dummy as select * from daily_attend where 1 = 2");
			
		$sqlfirst = $this->select_part("employee","status != 'Y' order by fname");
		$k = 1;
		
		while($firstrow = mysql_fetch_array($sqlfirst)){
			
			$sqlins = mysql_query("insert into attend_dummy select * from daily_attend where month(dt) = ".ltrim($mnt,0)." and year(dt) = ".ltrim($yr,0)." and empid = ".$firstrow['id']." order by dt");
			$sqlup = mysql_query("update attend_dummy set seqno = ".$k." where empid = ".$firstrow['id']);
			$k++;
		}
			
		$nod = date("t", mktime(1, 1, 1, $mnt, 1, $yr));
		while($j <= $nod){
			$sql = mysql_fetch_assoc($this->select_part("attend_dummy","seqno = $nxtidval and month(dt) = ".ltrim($mnt,0)." and year(dt) = ".ltrim($yr,0)." and day(dt) = ".ltrim($j,0)));
			$res .= '<input type="hidden" class="empid" value="'.$nxtidval.'"/><li>';
			if($sql['lv'] == 'Y'){
				$res .= '<div class="cal-leave"></div>';
				$lv++;
				
			}
			else if($sql['absent'] == 'Y'){
				$res .= '<div class="cal-absent"></div>';
				$ab++;
			}
			else if($sql['half'] == 'Y'){
				$res .= '<div class="cal-half"></div>';
				$hf++;
			}
			$res .= $j.'</li>';
			$j++;	
		}
		$sqlname = mysql_fetch_assoc($this->select_part("employee","id = (select empid from attend_dummy where seqno = $nxtidval group by seqno)"));
		$nameval = $sqlname['fname'].' '.$sqlname['lname'];
		$res .= '</ul>
		<div class="color-info"><ul><li><div class="cal-leave"></div><p>Leaves</p></li>
		<li><div class="cal-absent"></div><p>Absents</p></li>
		<li><div class="cal-half"></div><p>Half Days</p></li>
		</ul>
		</div>
		<hr/>
            <div class="calfoot">
			<div class="subfoot"><p style="font-weight:bold;" >Employee : </p></div><div class="subfoot1"><p style="font-weight:bold;">'.$nameval.'</p></div>
            <div class="subfoot"><p>Total Leaves Taken : </p></div><div class="subfoot1"><p>'.$lv.'</p></div>
            <div class="subfoot"><p>Total Absents : </p></div><div class="subfoot1"><p>'.$ab.'</p></div>
            <div class="subfoot"><p>Total Half Days : </p></div><div class="subfoot1"><p>'.$hf.'</p></div>
            </div>
			
		';
		
		return $res;
	}

}

	
?>