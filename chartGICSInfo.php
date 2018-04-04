<?php

# check logSTBInfoTable

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

$loadquery = "SELECT csrConnectTime, cssDataConnectTime, cssIMGConnectTime, downloadIMGTime, drawIMGTime FROM logICSInfoTable";
$result = mysqli_query($conn, $loadquery) or die(mysqli_error($conn));

$data = array(['step', 'csrConnectTime', 'cssDataConnectTime', 'cssIMGConnectTime', 'downloadIMGTime', 'drawIMGTime']);
$arrayCount = 0;
while($row = mysqli_fetch_row($result))	{
	$rowArray = array($arrayCount, (int)$row[0], (int)$row[1], (int)$row[2], (int)$row[3], (int)$row[4]);
	$arrayCount++;
	#print_r ($rowArray);
	array_push($data, ($rowArray));
	#print_r ($data);
}

#print_r ($data);
?>

<!DOCTYPE HTML>
<html lang="ko">
<head>
	<script src="//www.google.com/jsapi"></script>
	<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
	<script>
      google.charts.load('current', {packages: ['corechart']});
      google.charts.setOnLoadCallback(drawChart);

      function drawChart() {
		
		var data = google.visualization.arrayToDataTable(<?php echo json_encode($data)?>);
		
        var options = {
			title : 'ICS Latency Profile',
			vAxis: {title: 'Time(ms)'},
			/*
			hAxis: {title: 'Month'},
			seriesType: 'bars',
			series: {6: {type: 'line'}}
			*/
			isStacked : true
        };

        var chart = new google.visualization.SteppedAreaChart(document.getElementById('chart_div'));

        chart.draw(data, options);
      }
    </script>

</head>

<body>
		
		<div id="chart_div" style="width: 1200px; height: 1000px"></div>
</body>
</html>	
		
		
