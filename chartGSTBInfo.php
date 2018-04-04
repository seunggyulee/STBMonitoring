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

//$loadquery = "SELECT cpu FROM logSTBInfoTable WHERE date(date) >= date_format(now(), '%Y-%m-01') and date(date) <= last_day(now())";
$loadquery = "SELECT cpu FROM logSTBInfoTable WHERE mode='test_0319'";
$result = mysqli_query($conn, $loadquery) or die(mysqli_error($conn));

$cpudata = array([0, 0]);
$arrayCount = 0;
while($row = mysqli_fetch_row($result))	{
	$rowArray = array((int)$arrayCount, (int)$row[0]);
	$arrayCount++;
	#print_r ($rowArray);
	array_push($cpudata, ($rowArray));
	#print_r ($data);
}


//$loadquery = "SELECT mem FROM logSTBInfoTable WHERE date(date) >= date_format(now(), '%Y-%m-01') and date(date) <= last_day(now())";
$loadquery = "SELECT mem FROM logSTBInfoTable WHERE mode='test_0319'";
$result = mysqli_query($conn, $loadquery) or die(mysqli_error($conn));

$memdata = array([0, 0]);
$arrayCount = 0;
while($row = mysqli_fetch_row($result))	{
	$rowArray = array((int)$arrayCount, (int)$row[0]);
	$arrayCount++;
	#print_r ($rowArray);
	array_push($memdata, ($rowArray));
	#print_r ($data);
}


$loadquery = "SELECT cpu FROM logSTBInfoTable WHERE date(date) >= date_format(now(), '%Y-%m-01') and mode = 'test_0321'";
$result = mysqli_query($conn, $loadquery) or die(mysqli_error($conn));

$cpudata_2nd = array([0, 0]);
$arrayCount = 0;
while($row = mysqli_fetch_row($result))	{
	$rowArray = array((int)$arrayCount, (int)$row[0]);
	$arrayCount++;
	#print_r ($rowArray);
	array_push($cpudata_2nd, ($rowArray));
	#print_r ($data);
}


$loadquery = "SELECT mem FROM logSTBInfoTable WHERE date(date) >= date_format(now(), '%Y-%m-01') and mode = 'test_0321'";
$result = mysqli_query($conn, $loadquery) or die(mysqli_error($conn));

$memdata_2nd = array([0, 0]);
$arrayCount = 0;
while($row = mysqli_fetch_row($result))	{
	$rowArray = array((int)$arrayCount, (int)$row[0]);
	$arrayCount++;
	#print_r ($rowArray);
	array_push($memdata_2nd, ($rowArray));
	#print_r ($data);
}


#print_r ($cpudata);
#print_r ($memdata);
?>

<!DOCTYPE HTML>
<html lang="ko">
<head>
	<script src="//www.google.com/jsapi"></script>
	<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
	<script>
      //google.charts.load('current', {packages: ['corechart', 'line']});
      //google.charts.setOnLoadCallback(drawCPUChart);
	  //google.charts.setOnLoadCallback(drawMEMChart);
	  //google.charts.setOnLoadCallback(drawCPUChart_2nd);
	  //google.charts.setOnLoadCallback(drawMEMChart_2nd);
	  
	  google.charts.load('current', 
                        {callback: function () {
                            drawCPUChart(),
                            drawMEMChart(),
                            drawCPUChart_2nd(),
                            drawMEMChart_2nd()
                        },
						packages: ['corechart', 'line']});

      function drawCPUChart() {
		var data = new google.visualization.DataTable();
		data.addColumn('number', 'step');
		data.addColumn('number', 'CPU');
				
		data.addRows(<?php echo json_encode($cpudata)?>);
		
        var options = {
			hAxis: {
				title: 'Time'
			},
			vAxis: {
				title: 'CPU Info'
			},
			colors: ['#ff0000']
        };

        var chart = new google.visualization.LineChart(document.getElementById('chart_cpu'));

        chart.draw(data, options);
      }
	  
	  function drawMEMChart() {
		var data = new google.visualization.DataTable();
		data.addColumn('number', 'step');
		data.addColumn('number', 'MEM');
		
		data.addRows(<?php echo json_encode($memdata)?>);
		
        var options = {
			hAxis: {
				title: 'Time'
			},
			vAxis: {
				title: 'Mem Info'
			},
			colors: ['#0000ff']
        };

        var chart = new google.visualization.LineChart(document.getElementById('chart_mem'));

        chart.draw(data, options);
      }
	  
	  function drawCPUChart_2nd() {
		var data = new google.visualization.DataTable();
		data.addColumn('number', 'step');
		data.addColumn('number', 'CPU');
		
		data.addRows(<?php echo json_encode($cpudata_2nd)?>);
		
        var options = {
			hAxis: {
				title: 'Time'
			},
			vAxis: {
				title: 'CPU Info'
			},
			colors: ['#ff0000']
        };

        var chart = new google.visualization.LineChart(document.getElementById('chart_cpu_2nd'));

        chart.draw(data, options);
      }
	  
	  function drawMEMChart_2nd() {
		var data = new google.visualization.DataTable();
		data.addColumn('number', 'step');
		data.addColumn('number', 'MEM');
		
		data.addRows(<?php echo json_encode($memdata_2nd)?>);
		
        var options = {
			hAxis: {
				title: 'Time'
			},
			vAxis: {
				title: 'Mem Info'
			},
			colors: ['#0000ff']
        };

        var chart = new google.visualization.LineChart(document.getElementById('chart_mem_2nd'));

        chart.draw(data, options);
      }
    </script>

</head>

<body>
		<td>
		<tr>
		CPU 0319 enter_home.txt
		<div id="chart_cpu" style="width: 900px; height: 200px"></div>
		MEM 0319 enter_home.txt
		<div id="chart_mem" style="width: 900px; height: 200px"></div>
		</tr>
		
		<tr>
		CPU 0321 enter_home.txt
		<div id="chart_cpu_2nd" style="width: 900px; height: 200px"></div>
		MEM 0321 enter_home.txt
		<div id="chart_mem_2nd" style="width: 900px; height: 200px"></div>
		</tr>
		<td>
</body>
</html>	
		
		
