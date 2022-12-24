<?php
error_reporting(0);
ob_start();
session_start();
require_once('admin/constants.php');
function __autoload($classname) {
    $lower = strtolower($classname);
    include("admin/$lower.php");   
}
$site = new Site;
$p = $_GET ? @$_GET['p'] : NULL;
extract($_SESSION);
?>
<!DOCTYPE html>
<html>
<head>
<title>HR MANAGEMENT</title>
	<meta name="viewport" content="width=device-width, initial-scale=1.0"> 
        <meta name="description" content="Parallax Content Slider with CSS3 and jQuery" />
        <meta name="keywords" content="slider, animations, parallax, delayed, easing, jquery, css3, kendo UI" />
        <meta name="author" content="Codrops" />
        <link href="assets/css/stylenew.css" rel="stylesheet" type="text/css" />
        <link rel="stylesheet" type="text/css" href="assets/js/datepik/jquery.datepick.css"> 
        <script src="assets/js/jquery.min.js"></script>
        <script src="assets/js/script.js"></script>
        <script src="assets/js/function.js"></script>
	<script type="text/javascript" src="assets/js/datepik/jquery.plugin.js"></script> 
	<script type="text/javascript" src="assets/js/datepik/jquery.datepick.js"></script>
	
	<script>
	$('document').ready(function(){
		 $("#dt").datepick();
		 $("#dt1").datepick();
		 $("#dt2").datepick();
	});
       
        
        </script>

</head>
<body>


<div class="headerfix">

	<img src="images/Hr2.png" class="logofix"/>

</div>

<div class="blankfix"></div>
<?php 

if($_SESSION['login_user']){
	 include_once("inc/nav.php"); 
	 
	 ?>
	 <div class="blankfix"></div>
     
	 
	 <?php
}

?>