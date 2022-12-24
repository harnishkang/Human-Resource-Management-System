<?php
	date_default_timezone_set("Asia/Kolkata");
	define("DT",date("Y-m-d"));
	define("NXTDT",date('Y-m-d', strtotime(' +1 day')));
	define("NXTDD",date('d', strtotime(' +1 day')));
	/*define("TM",date("h:i:sa"));*/
	define("TM",date("h:i:s"));
	define("MNT",date("m"));
	define("CHARMNT",date("M"));
	define("YR",date("Y"));
	define("DD",date("d"));
	$firstDayUTS = mktime (0, 0, 0, date("m"), 1, date("Y"));
	define("LASTDT",date("d",mktime (0, 0, 0, date("m"), date('t'), date("Y"))));
	define("FIRSTDAY",date("D", $firstDayUTS));
		

?>