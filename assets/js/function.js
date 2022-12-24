// JavaScript Document

function approve(idparam){
	$(".popup").show(1000);
	$("#leaveval").val(idparam);

}

function validateperbills(){
	var num = 0
	var nm = $("#concper").val();
	if((nm == "") || (nm == "undefined") || (nm == "-")){
		$("#concerr").show();
		num = 1;
	}
	else{
		$("#concerr").hide();
	
	}
	var desig = $("#dt").val();
	if((desig == "") || (desig == "undefined") || (desig == "-")){
		$("#dterr").show();
		num = 1;
	}
	else{
		$("#dterr").hide();
	}
	var travel = $("#relto").val();
	if((travel == "") || (travel == "undefined") || (travel == "-")){
		$("#relerr").show();
		num = 1;
	}
	else{
		$("#relerr").hide();
	}
	
	var dt = $("#amt").val();
	if((dt == "") || (dt == "undefined") || (dt == "-")){
		$("#amterr").show();
		num = 1;
	}
	else{
		$("#amterr").hide();
	}
	
	if(num == 0){
		return true;
	}
	else{
		return false;
	}
}


function validatecompbills(){
	var num = 0
	var nm = $("#dt").val();
	if((nm == "") || (nm == "undefined") || (nm == "-")){
		$("#dterr").show();
		num = 1;
	}
	else{
		$("#dterr").hide();
	
	}
	var desig = $("#dt1").val();
	if((desig == "") || (desig == "undefined") || (desig == "-")){
		$("#dt1err").show();
		num = 1;
	}
	else{
		$("#dt1err").hide();
	}
	var travel = $("#typ").val();
	if((travel == "") || (travel == "undefined") || (travel == "-")){
		$("#typerr").show();
		num = 1;
	}
	else{
		$("#typerr").hide();
	}
	
	var dt = $("#amt").val();
	if((dt == "") || (dt == "undefined") || (dt == "-")){
		$("#amterr").show();
		num = 1;
	}
	else{
		$("#amterr").hide();
	}
	var paid = $("#paidto").val();
	if((paid == "") || (paid == "undefined") || (paid == "-")){
		$("#paiderr").show();
		num = 1;
	}
	else{
		$("#paiderr").hide();
	}
	if(num == 0){
		return true;
	}
	else{
		return false;
	}
}

function validateallowance(){
	var num = 0
	var nm = $("#nm").val();
	if((nm == "") || (nm == "undefined") || (nm == "-")){
		$("#nmerr").show();
		num = 1;
	}
	else{
		$("#nmerr").hide();
	
	}
	var desig = $("#desig").val();
	if((desig == "") || (desig == "undefined") || (desig == "-")){
		$("#dserr").show();
		num = 1;
	}
	else{
		$("#dserr").hide();
	}
	var travel = $("#travel").val();
	if((travel == "") || (travel == "undefined") || (travel == "-")){
		$("#trerr").show();
		num = 1;
	}
	else{
		$("#trerr").hide();
	}
	var rec = $("#recom").val();
	if((rec == "") || (rec == "undefined") || (rec == "-")){
		$("#recerr").show();
		num = 1;
	}
	else{
		$("#recerr").hide();
	}
	var dt = $("#dt").val();
	if((dt == "") || (dt == "undefined") || (dt == "-")){
		$("#dterr").show();
		num = 1;
	}
	else{
		$("#dterr").hide();
	}
	
	if(num == 0){
		return true;
	}
	else{
		return false;
	}
}
function selectcity(){

	var stateid = $("#state").val();
	$.post("time.php",
    {
        action:"getcity",stateid:stateid
    },
    function(data){
    	
    if(data){
    		
    		$("#city").append(data);
    		
    }
       
    });

}
function nxt(nxtype){
if(nxtype == "prev"){
	var nxtid =  parseInt($('.empid').val()) - 1;
}
else{
	var nxtid =  parseInt($('.empid').val()) + 1;
}
	$.post("time.php",
    {
        action:"getdata",nxtid:nxtid
    },
    function(data){
    if(data){
    		$(".viewempdet").empty();
    		$(".viewempdet").append(data);
    		
    }
       
    });
}

function leavenxt(nxtype){
if(nxtype == "prev"){
	var nxtid =  parseInt($('.empid').val()) - 1;
}
else{
	var nxtid =  parseInt($('.empid').val()) + 1;
}


	$.post("time.php",
    {
        action:"getleave",nxtid:nxtid,mnt:parseInt($('.inmnt').val()),yr:parseInt($('.inyr').val())
    },
    function(data){
    if(data){
    		$(".calbody").empty();
    		$(".calbody").append(data);
    		
    }
       
    });
}


function timein(idparam){

	$.post("time.php",
    {
        action:"getTime"
    },
    function(data){
    	if($(".timein"+idparam).text() == 'Enter'){
    		$(".timein"+idparam).text(data);
    		$("#intimein"+idparam).val(data);
    		if(data>"09:35:59"){
    			$(".instatus"+idparam).text('Present LateIn');
    			$("#instatusval"+idparam).val('Present LateIn');
    			$(".instatus"+idparam).css("color","red");
    		}
        	else if(data<"09:30:00"){
        		$(".instatus"+idparam).text('Present EarlyIn');
        		$("#instatusval"+idparam).val('Present EarlyIn');
        		$(".instatus"+idparam).css("color","green");
        	}
        	else{
        		$(".instatus"+idparam).text('Present');
        		$("#instatusval"+idparam).val('Present');
        		$(".status"+idparam).css("color","green");
        	}
        }
        
    });
}

function timeout(idparam){
	$.post("time.php",
    {
        action:"getTime"
    },
    function(data){
    	if(($(".timeout"+idparam).text() == 'Out')&&($(".timein"+idparam).text() != 'Enter')){
    		$(".timeout"+idparam).text(data);
    		$("#intimeout"+idparam).val(data);
    		if(data>"18:05:00"){
    			$(".outstatus"+idparam).text('LateOut');
    			$("#outstatusval"+idparam).val('LateOut');
    			$(".instatus"+idparam).css("color","grren");
    			
    		}
        	else if(data<"18:00:00"){
        		$(".outstatus"+idparam).text('EarlyOut');
        		$("#outstatusval"+idparam).val('EarlyOut');
        		$(".outstatus"+idparam).css("color","red");
        		
        	}
        	else{
        		$(".outstatus"+idparam).text('Present');
        		$("#outstatusval"+idparam).val('Present');
        		$(".outstatus"+idparam).css("color","green");
        	}
        }
        
    });
}

function guestout(idparam){
if(($(".guestout"+idparam).text()).trim() == 'Click'){
	$.post("time.php",
    {
        action:"guestout",id:idparam
    },
    function(data){
    		if(data){
    		
    			$(".guestout"+idparam).text(data);
    		}
        
        
    });
    }
}

function chkall(param,param1){

	if(document.getElementById(param+param1).checked){
		switch(param){
			case "pr":$("#inpr"+param1).val("Y");
					$("#ab"+param1).prop('checked', false);
					$("#inab"+param1).val("N");
					$("#lv"+param1).prop('checked', false);
					$("#inlv"+param1).val("N");
					$("#half"+param1).prop('checked', false);
					$("#inhalf"+param1).val("N");
					$("#off"+param1).prop('checked', false);
					$("#inoff"+param1).val("N");
					break;
						
			case "ab":$("#inab"+param1).val("Y");
					$("#pr"+param1).prop('checked', false);
					$("#inpr"+param1).val("N");
					$("#lv"+param1).prop('checked', false);
					$("#inlv"+param1).val("N");
					$("#half"+param1).prop('checked', false);
					$("#inhalf"+param1).val("N");
					$("#off"+param1).prop('checked', false);
					$("#inoff"+param1).val("N");
					break;
					
			case "lv":$("#inlv"+param1).val("Y");
					$("#ab"+param1).prop('checked', false);
					$("#inab"+param1).val("N");
					$("#pr"+param1).prop('checked', false);
					$("#inpr"+param1).val("N");
					$("#half"+param1).prop('checked', false);
					$("#inhalf"+param1).val("N");
					$("#off"+param1).prop('checked', false);
					$("#inoff"+param1).val("N");
					break;
					
			case "half":$("#inhalf"+param1).val("Y");
					$("#ab"+param1).prop('checked', false);
					$("#inab"+param1).val("N");
					$("#lv"+param1).prop('checked', false);
					$("#inlv"+param1).val("N");
					$("#pr"+param1).prop('checked', false);
					$("#inpr"+param1).val("N");
					$("#off"+param1).prop('checked', false);
					$("#inoff"+param1).val("N");
					break;
					
			case "off":$("#inoff"+param1).val("Y");
					$("#ab"+param1).prop('checked', false);
					$("#inab"+param1).val("N");
					$("#lv"+param1).prop('checked', false);
					$("#inlv"+param1).val("N");
					$("#pr"+param1).prop('checked', false);
					$("#inpr"+param1).val("N");
					$("#half"+param1).prop('checked', false);
					$("#inhalf"+param1).val("N");
					break;		
					
		}
		
				$("#pr").prop('checked', false);
				$("#ab").prop('checked', false);
				$("#lv").prop('checked', false);
				$("#off").prop('checked', false);
				$("#half").prop('checked', false);
		
	}
	
}

function selectall(param){
	var loopval = $("#countsno").val();
	var i=1;
	if(document.getElementById(param).checked){
		switch(param){
			case "pr":$("#ab").prop('checked', false);
					$("#lv").prop('checked', false);
					$("#half").prop('checked', false);
					$("#off").prop('checked', false);
					while( i <= loopval){
						$(".pr"+i).prop('checked', true);
						$(".inpr"+i).val("Y");
						$(".ab"+i).prop('checked', false);
						$(".inab"+i).val("N");
						$(".lv"+i).prop('checked', false);
						$(".inlv"+i).val("N");
						$(".off"+i).prop('checked', false);
						$(".inoff"+i).val("N");
						$(".half"+i).prop('checked', false);
						$(".inhalf"+i).val("N");
					i++;
					}
					i=1;
					break;
					
			case "ab":$("#pr").prop('checked', false);
					$("#lv").prop('checked', false);
					$("#half").prop('checked', false);
					$("#off").prop('checked', false);
					while( i <= loopval){
						$(".ab"+i).prop('checked', true);
						$(".inab"+i).val("Y");
						$(".pr"+i).prop('checked', false);
						$(".inpr"+i).val("N");
						$(".lv"+i).prop('checked', false);
						$(".inlv"+i).val("N");
						$(".off"+i).prop('checked', false);
						$(".inoff"+i).val("N");
						$(".half"+i).prop('checked', false);
						$(".inhalf"+i).val("N");
					i++;
					}
					i=1;
					break;
					
			case "lv":$("#ab").prop('checked', false);
					$("#pr").prop('checked', false);
					$("#half").prop('checked', false);
					$("#off").prop('checked', false);
					while( i <= loopval){
						$(".lv"+i).prop('checked', true);
						$(".inlv"+i).val("Y");
						$(".pr"+i).prop('checked', false);
						$(".inpr"+i).val("N");
						$(".ab"+i).prop('checked', false);
						$(".inab"+i).val("N");
						$(".off"+i).prop('checked', false);
						$(".inoff"+i).val("N");
						$(".half"+i).prop('checked', false);
						$(".inhalf"+i).val("N");
					i++;
					}
					i=1;
					break;
					
			case "half":$("#ab").prop('checked', false);
					$("#lv").prop('checked', false);
					$("#pr").prop('checked', false);
					$("#off").prop('checked', false);
					while( i <= loopval){
						$(".half"+i).prop('checked', true);
						$(".inhalf"+i).val("Y");
						$(".pr"+i).prop('checked', false);
						$(".inpr"+i).val("N");
						$(".ab"+i).prop('checked', false);
						$(".inab"+i).val("N");
						$(".lv"+i).prop('checked', false);
						$(".inlv"+i).val("N");
						$(".off"+i).prop('checked', false);
						$(".inoff"+i).val("N");
						
					i++;
					}
					i=1;
					break;
			
			case "off":$("#ab").prop('checked', false);
					$("#lv").prop('checked', false);
					$("#half").prop('checked', false);
					$("#pr").prop('checked', false);
					while( i <= loopval){
						$(".off"+i).prop('checked', true);
						$(".inoff"+i).val("Y");
						$(".pr"+i).prop('checked', false);
						$(".inpr"+i).val("N");
						$(".ab"+i).prop('checked', false);
						$(".inab"+i).val("N");
						$(".lv"+i).prop('checked', false);
						$(".inlv"+i).val("N");
						$(".half"+i).prop('checked', false);
						$(".inhalf"+i).val("N");
					i++;
					}
					i=1;
					break;
		}
	}
	
	else{
		
		while( i <= loopval){
						$(".pr"+i).prop('checked', false);
						$(".inpr"+i).val("N");
						$(".ab"+i).prop('checked', false);
						$(".inab"+i).val("N");
						$(".lv"+i).prop('checked', false);
						$(".inlv"+i).val("N");
						$(".off"+i).prop('checked', false);
						$(".inoff"+i).val("N");
						$(".half"+i).prop('checked', false);
						$(".inhalf"+i).val("N");
					i++;
					}
	}
	
}

function viewfield(){
if($(".pass").val() != ""){
	if($(".pass").val() != "changedate"){
	alert("Invalid Password");
	$(".pass").val('');
	$(".pass").focus();
	}
	else{
	$(".pass").css("display","none");
	$(".pass1").css("visibility","visible");
	}
	}

}

function viewbtn(){
if($("#pswd").val() != ""){
	if($("#pswd").val() != "submitattend"){
	$("#pswd").val('');
	$("#pswd").focus();
	}
	else{
	$("#pswd").css("display","none");
	$("#ppswd").css("display","none");
	$(".showbtn").css("visibility","visible");
	}
	}

}


function validatedate(){
	var currdt = new Date();
	var currdtval = currdt.getFullYear()+"-"+(currdt.getMonth()+1)+"-"+currdt.getDate();
	if($(".pass1").val() > currdtval ){
		alert("Invalid Date Selected");
		$(".pass1").val('');
		$(".pass1").focus();
		$(".dtval").val(currdtval);
	}
	else{
		$(".dtval").val($(".pass1").val());
	}
	

}

function leavechek(param){
	if(param == 'half'){
		$("#infull").val("N");
		$("#inhalf").val("Y");
		$(".ht").css("display","block");
	}
	else{
		$("#inhalf").val("N");
		$("#infull").val("Y");
		$(".ht").css("display","none");
	}
	
}

function chkrights(param){
$("#allrights ").prop('checked', false);
var i =1;
var j = $('.maxsno').val();
	while(i<j)
	{
		if(document.getElementById("rights"+param).checked)
		{
		
			$(".inrights"+param).val("Y");
		
		}
		else{
			$(".inrights"+param).val("N");
		}
	i++;
	}
	
}


function chkallrights(){

	
	if(document.getElementById("allrights").checked){
		$(".inrights").val("Y");
		$(".rights").prop('checked', true);
	}
	else{
		$(".inrights").val("N");
		$(".rights").prop('checked', false);
	}
	
}

function calamt(param){
	var vehicle = $("#vehicle"+param).val();
	var kms = $("#kms"+param).val();
	if(vehicle == "two"){
		$("#amt"+param).val((kms*2.5));
	}
	else if(vehicle == "four"){
		$("#amt"+param).val((kms*5));
	}

}


function tablePrint()  
{  

var display_setting="toolbar=yes,location=yes,directories=yes,menubar=nos,";  
 
var content_innerhtml = document.getElementById("main-attend1").innerHTML;  
var document_print=window.open("","",display_setting);  
document_print.document.open();  

//document_print.document.write('<body  onLoad="self.print();self.close();" >'); 
document_print.document.write('<body  onLoad="self.print();self.close();" >');
document_print.document.write('<link href="assets/css/stylenew.css" rel="stylesheet" type="text/css" />'); 
document_print.document.write(content_innerhtml); 
document_print.document.write('</body></html>');  
document_print.print();  
document_print.document.close();  
return false;  
}  

function printreport()  
{  

var display_setting="toolbar=yes,location=yes,directories=yes,menubar=nos,";  
 
var content_innerhtml = document.getElementById("printdata").innerHTML;  
var document_print=window.open("","",display_setting);  
document_print.document.open();  

//document_print.document.write('<body  onLoad="self.print();self.close();" >'); 
document_print.document.write('<body  onLoad="self.print();self.close();" >');
document_print.document.write('<link href="assets/css/stylenew.css" rel="stylesheet" type="text/css" />'); 
document_print.document.write(content_innerhtml); 
document_print.document.write('</body></html>');  
document_print.print();  
document_print.document.close();  
return false;  
}  