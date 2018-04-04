<?php

# store logICSInfoTable

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
  echo "$key => $val.\n"; 

  $arrData = explode("=", $val);
  $arr[$arrData[0]] = $arrData[1];
}

$mac = $arr['mac'];

# real mode
#if($arr['csrConnectTime'])
#	$csrConnectTime = $arr['csrConnectTime'];
#if($arr['cssDataConnectTime'])
#	$cssDataConnectTime = $arr['cssDataConnectTime'];
#if($arr['cssIMGConnectTime'])
#	$cssIMGConnectTime = $arr['cssIMGConnectTime'];
#if($arr['downloadIMGTime'])
#	$downloadIMGTime = $arr['downloadIMGTime'];
#if($arr['drawIMGTime'])
#	$drawIMGTime = $arr['drawIMGTime'];
#if($arr['IMGSize'])
#	$IMGSize = $arr['IMGSize'];
#if($arr['date'])
#	$date = $arr['date'];


# test mode
if($arr['csrConnectTime'])
	$csrConnectTime = mt_rand(30, 100);
if($arr['cssDataConnectTime'])
	$cssDataConnectTime = mt_rand(100, 150);
if($arr['cssIMGConnectTime'])
	$cssIMGConnectTime = mt_rand(150, 200);
if($arr['downloadIMGTime'])
	$downloadIMGTime = mt_rand(200, 500);
if($arr['drawIMGTime'])
	$drawIMGTime = mt_rand(500, 800);
if($arr['IMGSize'])
	$IMGSize = mt_rand(300, 4000);

# date server
$format = date('Y-m-d H:i:s').gettimeofday()["usec"];
echo $format;

if($arr['date'])
	$date = $format;

if($csrConnectTime) { # exist connect Time
	$insert_sql = "insert into  logICSInfoTable(date, mac, csrConnectTime, cssDataConnectTime, cssIMGConnectTime, downloadIMGTime, drawIMGTime, IMGSize) values('$date', '$mac', $csrConnectTime, $cssDataConnectTime, $cssIMGConnectTime, $downloadIMGTime, $drawIMGTime, $IMGSize)";
#	echo $insert_sql;
}

$result = mysqli_query($conn, $insert_sql) or die(mysqli_error($conn));
mysqli_free_result($result);

mysqli_close($conn);


?>
