<div class="main-attend1">
<form method = "post">
<div class="row"><input type="submit" name="appointsubmit" class="submitBtn5" />
<input type="button" name="print" class="submitBtn4" value="Print" onclick="tablePrint()"/></div>
<div id="main-attend1">
  <div id="header-sec">
    
  <!-- <div id="header-a3glogo"><img src="images/Hr2.png" class="logofix"/></div><!-- header-a3glogo ends here -->
  <!-- <div id="header-stream"><img src="images/Hr2.png" class="logofix"/></div><!-- header-stream ends here -->
    <h1>Appointment Letter</h1>
  </div><!-- header-sec ends here -->
 
 <div id="content-sec">
  
  <div class="content-upper">
  
   <div class="content-name">
    
    <input type="text" class="input-fix"  name="empname"/>
    
    <br><br>
    
    <label class="chd" >CHANDIGARH</label>
    
   </div><!-- content-name ends here -->
   
   <div class="content-date">	
   
   	<input type="text" class="input-fix" name="dt" value="<?php echo DT; ?>"/>
   
   </div><!-- content-date ends here -->
  
  </div><!-- content-upper ends here -->		
 
   <label class="subject">Sub: Letter of Joining</label>
  
  <br><br>
  
  <label>Dear</label>&nbsp;<input type="text" class="input-fix" />
  
 <div id="cont-part">
 
 <p >With reference to the discussions we had with you, we, on behalf of our Group, are pleased to offer you the position of "<input type="text" class="input-fix" name="desig"/>" and   invite you to join our family.</p>

 <br> 
 <p>Your cost to the company (CTC) would be <input type="text" class="input-fix" name="ctc"/> Per annum. </p>

 <br> 
 <p>The allowances, benefits and other term and conditions of your employment will be as per Company policies as applicable from time to time. Your compensation will be reviewed in future as per Company policy </p>
 
 <br> 
 <p>On joining the company you shall be on probation for three months. You will abide by the rules and regulations of the company as may be in force from time to time. </p>
 
 <br> 
 <p>We welcome you and expect you to join on <input type="text" class="input-fix" name="joindt" id="dt"/> in line with discussion with you; otherwise this offer will stand withdrawn automatically. </p>

 <br> 
 <p>The company looks for a long-term association with all its employees and expects the same from you. Again, congratulations and welcome to our family.</p>
 
 <br> 
 <p>Thanking You.</p>

  </div><!----cont-part-ends----->

<div class="clear"></div>
 <div id="cont-bottom">
  
  <div class="cont-lft">
   
   <p>For <input type="text" class="input-fix" name="comp" /></p>
   
   <br><br><br>
   <p><input type="text" class="input-fix" /></p>
   
   <br>
   <p class="hr-fix">HR GENERALIST</p>
   
  </div><!-----cont-lft-ends---->
  
  <div class="cont-ryt">

   <p>Employment offer Accepted</p>

   <br><br><br>
   <p><input type="text" class="input-fix" /></p>
  
  </div><!------cont-ryt-ends---->
  
  
 </div><!-----cont-bottom-ends--->
 <div class="clear"></div>
 </div><!-----cont-sec-ends--->
<div class="clear"></div>
 <div id="field-sec">
  
  <div class="field-one">&nbsp;</div><!----field-one-ends---->
  
 <!-- <div class="field-two">Real Estate. Information Technology. Entertainment. Agro</div><!------field-two-ends----->
 
  <div class="field-three">&nbsp;</div><!----field-three-ends---->
  
 </div><!----feild-sec-ends---->
<div class="clear"></div>
 <div id="footer">
  Human Resource Management
 </div><!-----footer-ends---->
 </form>
 <div class="clear"></div>
 </div><!-- wrapper ends here -->
</div>
  <?php echo $site->appointins(array("id"=>"","empnm"=>$_POST['empname'],"dt"=>$_POST['dt'],"ctc"=>$_POST['ctc'],"joindt"=>$_POST['joindt'],"comp"=>$_POST['comp'],"desig"=>$_POST['desig'])); ?>