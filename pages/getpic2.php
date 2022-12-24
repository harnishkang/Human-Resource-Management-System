<?php
$sql = mysql_connect("localhost","a3ghr","a3ghr1q2w3e4r5t");
$db = mysql_select_db("hr",$sql);
$id = stripslashes($_REQUEST['id']);
$col = stripslashes($_REQUEST['col']);

$query_category="SELECT idimg1 FROM empidproof where empimgid = '$id'";
$result_category = mysql_query($query_category);
while($row=mysql_fetch_row($result_category))
{
    header("Content-type: image/jpeg");
    echo "$row[0]";
}  

?>