<?php
include('dbconn.php');
$query = 'SELECT `temperature`, `time` AS `datetime` FROM `data` ORDER BY `time` DESC limit 100';

$result = mysqli_query($conn, $query);
$rows = array();
$table = array();

$table['cols'] = array( 
    array('label' => 'Date Time', 'type' => 'datetime'),
    array('label' => 'Temperature', 'type' => 'number')
);

while($row = mysqli_fetch_array($result))
{
 $sub_array = array();
 $datetime = explode(".", $row["datetime"]);
 $localtime= strtotime($datetime[0]);
 
 //$sub_array[] =  array("v" => 'Date(' .$datetime[0]  . '000)');
 $sub_array[] =  array("v" => 'Date(' . $localtime*1000 . ')');

 $sub_array[] =  array("v" => $row["temperature"]);

 
 $rows[] =  array("c" => $sub_array);
}

$table['rows'] = $rows;
$jsonTable = json_encode($table);
?>

<html>
<head>
    <title>SmartGreenSpace</title>
	<link rel="icon" type="image/png" href="images/icon.jpg"/>
	<meta http-equiv="content-type" content="text/html; charset=ISO-8859-1">
	<meta http-equiv="refresh" content="300">
	
    <script type="text/javascript" src="asset/loader.js"></script>
    <script type="text/javascript">

    google.charts.load('current', {'packages':['corechart']});
    google.charts.setOnLoadCallback(drawChart);
    
    /*var dateFormatter = new google.visualization.DateFormat({formatType: 'long',timeZone: +0800 });
    dateFormatter.format(data,0);*/
   
    function drawChart()
    {
        var data = new google.visualization.DataTable(<?php echo $jsonTable; ?>);

    var options = 
    {
        title:'Temperature',
        legend:{position:'bottom'},
        width:800,
        height:400,
        chartArea:{width:'95%', height:'65%',},
        hAxis: {slantedText:true, slantedTextAngle:60 },
        
    };
    
    /*var view = new google.visualization.DataView(data);
    view.setColumns([0, 1, {
    calc: "stringify",
    sourceColumn: 1,
    type: "string",
    role: "annotation"}]);*/
    
    var chart = new google.visualization.LineChart(document.getElementById('temperature_chart'));
    chart.draw(data, options);
   }
   
  </script>
  <style>
    

    

  </style>
 </head>  
 
 <body>
  <div class="page-wrapper">
   <br />
   <div id="temperature_chart" ></div>
  </div>
 </body>
</html>

<!-- To eliminate 000webhost watermark-->
<script>
    $(document).ready(function(){ 
    $('body').find('img[src$="https://cdn.rawgit.com/000webhost/logo/e9bd13f7/footer-powered-by-000webhost-white2.png"]').remove();
   }); 
</script>
