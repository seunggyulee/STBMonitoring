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
if($arr['pmem_01'])
	$pmem_01 = $arr['pmem_01'];
if($arr['pname_01'])
	$pname_01 = $arr['pname_01'];
if($arr['pmem_02'])
	$pmem_02 = $arr['pmem_02'];
if($arr['pname_02'])
	$pname_02 = $arr['pname_02'];
if($arr['pmem_03'])
	$pmem_03 = $arr['pmem_03'];
if($arr['pname_03'])
	$pname_03 = $arr['pname_03'];
if($arr['pmem_04'])
	$pmem_04 = $arr['pmem_04'];
if($arr['pname_04'])
	$pname_04 = $arr['pname_04'];
if($arr['pmem_05'])
	$pmem_05 = $arr['pmem_05'];
if($arr['pname_05'])
	$pname_05 = $arr['pname_05'];

#if($arr['date'])
#	$date = $arr['date'];

$format = date('Y-m-d H:i:s').gettimeofday()["usec"];
echo $format;

if($arr['date'])
	$date = $format;

if($pmem_01) { # exist connect Time
	$insert_sql = "insert into  logprocessinfotable(date, mac, pmem_01, pname_01, pmem_02, pname_02, pmem_03, pname_03, pmem_04, pname_04, pmem_05, pname_05) values('$date', '$mac', '$pmem_01', '$pname_01', '$pmem_02', '$pname_02', '$pmem_03', '$pname_03', '$pmem_04', '$pname_04', '$pmem_05', '$pname_05')";
#	echo $insert_sql;
}

$result = mysqli_query($conn, $insert_sql) or die(mysqli_error($conn));
mysqli_free_result($result);

mysqli_close($conn);


?>
