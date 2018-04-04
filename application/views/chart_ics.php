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
      google.charts.load('current', {packages: ['corechart']});
      google.charts.setOnLoadCallback(drawChart);

      function drawChart() {
	
        var jsonData = $.ajax({ 
          url: "<?php echo base_url() . 'Chart_ICS/getdata'?>", 
          dataType: "json", 
          async: false 
          }).responseText; 

        // console.log(jsonData);
        
		    var data = google.visualization.arrayToDataTable($.parseJSON(jsonData));
        // var data = google.visualization.arrayToDataTable([["step","csrConnectTime","cssDataConnectTime","cssIMGConnectTime","downloadIMGTime","drawIMGTime"],
        // [1,48,110,171,435,796],[2,64,116,162,393,668],[3,75,100,178,276,737],[4,77,150,161,289,747],[5,52,124,164,356,749],[6,79,104,161,464,663],[7,89,121,179,454,754],
        // [8,94,131,153,373,757],[9,62,135,173,321,670],[10,75,149,175,221,550],[11,95,129,169,351,574],[12,34,100,194,395,726],[13,80,130,160,360,670],[14,76,107,169,200,633],
        // [15,48,113,158,297,767],[16,70,150,180,447,515],[17,81,105,195,368,732],[18,76,134,157,487,506],[19,50,111,179,352,692],[20,44,111,200,402,629],[21,67,144,177,383,725],
        // [22,36,115,155,436,794],[23,89,117,187,458,689],[24,93,119,183,445,538],[25,37,147,188,425,745],[26,79,126,177,454,503],[27,38,117,182,461,558],[28,84,122,180,436,600],
        // [29,83,112,174,310,625]]);


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
		<div id="chart_div" style="width: 700px; height: 500px"></div>
</body>
</html>	