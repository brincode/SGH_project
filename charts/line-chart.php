<!DOCTYPE HTML>
<html>
<head>
<script>
$(document).ready(function () {
var <?=$chart?>chart = new CanvasJS.Chart("<?=$id?>", {
	animationEnabled: true,
	theme: "light2",
	title:{
		text: "<?=$title?>"
	},
	axisX:{
		valueFormatString: "DD MMM",
		crosshair: {
			enabled: true,
			snapToDataPoint: true
		}
	},
	axisY: {
		title: "<?=$yAxis?>",
		crosshair: {
			enabled: true
		}
	},
	toolTip:{
		shared:true
	},  
	legend:{
		cursor:"pointer",
		verticalAlign: "bottom",
		horizontalAlign: "left",
		dockInsidePlotArea: true,
		itemclick: toogleDataSeries
	},
	data: [{
		type: "line",
		showInLegend: true,
		name: "Total Visit",
		markerType: "square",
		xValueFormatString: "DD MMM, YYYY @ h:m:s TT",
		color: "#F08080",
		dataPoints: <?=$jsonTable?>
	}]
});

function toogleDataSeries(e){
	if (typeof(e.dataSeries.visible) === "undefined" || e.dataSeries.visible) {
		e.dataSeries.visible = false;
	} else{
		e.dataSeries.visible = true;
	}
	<?=$chart?>chart.render();
}

$('#<?=strtolower(str_replace(" ",'',$title))?>-data').on('shown.bs.modal',function(){
     <?=$chart?>chart.render();
 });

}); 
</script>
</head>
<body>
<div id="<?=$id?>" style="height: 370px; max-width: 920px; margin: 0px auto;"></div>

</body>
</html>