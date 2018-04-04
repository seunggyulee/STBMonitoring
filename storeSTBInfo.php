<?php

# store logSTBInfoTable

# DB
$db_host = "localhost";
$db_user = "root";
$db_passwd = "autoset";
$db_name = "stblog";

$conn = new mysqli($db_host, $db_user, $db_passwd, $db_name);
if ($conn) {
	#echo "Type:".gettype($conn).",Class:".get_class($conn).",error number:".mysqli_connect_error();	
}	
else {
	die("Error [".mysqli_connect_errno()."]:".mysqli_connect_error());	
}

#POST message receive
$body = @file_get_contents('php://input');
$data = explode("&", $body);
$arr = array();

foreach($data as $key=>$val){
#  echo "$key => $val.\n"; 

  $arrData = explode("=", $val);
  $arr[$arrData[0]] = $arrData[1];
}

$mac = $arr['mac'];
$cpu = $arr['cpu'];
$mem = $arr['mem'];
$mode = $arr['mode'];

/*
if($arr['msg'])
	$msg = $arr['msg'];
*/

/*
# test mode
if($arr['cpu'])
	$cpu = mt_rand(40, 100);
if($arr['mem'])
	$mem = mt_rand(20, 100);


# date server
$format = date('Y-m-d H:i:s').gettimeofday()["usec"];
echo $format;

*/

$format = $arr['date'];

if($arr['date'])
	$date = $format;

if($arr['msg']) { # exist connect Time
	$insert_sql = "insert into  logSTBInfoTable(date, mac, cpu, mem, msg, mode) values('$date', '$mac', $cpu, $mem, $msg, $mode)";
#	echo $insert_sql;
}
else {
	$insert_sql = "insert into  logSTBInfoTable(date, mac, cpu, mem, mode) values('$date', '$mac', $cpu, $mem, '$mode')";
}

$result = mysqli_query($conn, $insert_sql) or die(mysqli_error($conn));
mysqli_free_result($result);

mysqli_close($conn);


?>
