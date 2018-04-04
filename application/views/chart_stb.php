<!DOCTYPE HTML>
<html lang="ko">
<head>
    <!-- for Jquery -->
    <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>

    <!-- for google chart -->
	<script src="//www.google.com/jsapi"></script>
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
	<script>
      google.charts.load('current', 
                        {callback: function () {
                            drawCPUChart('test_0319'),
                            drawMEMChart('test_0319'),
                            drawCPUChart('test_0321'),
                            drawMEMChart('test_0321')
                        },
                        packages: ['corechart', 'line']});    
	  
      function drawCPUChart($test_mode) {
		var data = new google.visualization.DataTable();
		data.addColumn('number', 'step');
		data.addColumn('number', 'CPU');
		
        var jsonData = $.ajax({ 
          url: "<?php echo base_url() . 'Chart_STB/getCPUdata/'?>" + $test_mode, 
          dataType: "json", 
          async: false 
          }).responseText;

        // console.log("<?php echo base_url() . 'Chart_STB/getCPUdata/'?>" + $test_mode);
        // console.log(jsonData);
        // console.log($.parseJSON(jsonData));		        
        data.addRows($.parseJSON(jsonData));
		
        var options = {
			hAxis: {
				title: 'Time'
			},
			vAxis: {
				title: 'CPU Info'
			},
			colors: ['#ff0000']
        };

        if($test_mode == 'test_0321')
            var chart = new google.visualization.LineChart(document.getElementById('chart_cpu2'));
        else
            var chart = new google.visualization.LineChart(document.getElementById('chart_cpu'));

        chart.draw(data, options);
      }
	  
	  function drawMEMChart($test_mode) {
		var data = new google.visualization.DataTable();
		data.addColumn('number', 'step');
		data.addColumn('number', 'MEM');
		
        var jsonData = $.ajax({ 
          url: "<?php echo base_url() . 'Chart_STB/getMEMdata/' ?>" + $test_mode, 
          dataType: "json", 
          async: false 
          }).responseText;

        // console.log("<?php echo base_url() . 'Chart_STB/getMEMdata/' ?>" + $test_mode);
        // console.log($.parseJSON(jsonData));
		// data.addRows($.parseJSON(jsonData));
        
		data.addRows($.parseJSON(jsonData));

        var options = {
			hAxis: {
				title: 'Time'
			},
			vAxis: {
				title: 'Mem Info'
			},
			colors: ['#0000ff']
        };

        if($test_mode == 'test_0321')
            var chart = new google.visualization.LineChart(document.getElementById('chart_mem2'));
        else
            var chart = new google.visualization.LineChart(document.getElementById('chart_mem'));

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
		<div id="chart_cpu2" style="width: 900px; height: 200px"></div>
		MEM 0321 enter_home.txt
		<div id="chart_mem2" style="width: 900px; height: 200px"></div>
        </tr>
        
    </td>
</body>
</html>	