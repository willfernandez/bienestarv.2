$(document).ready(function()
{
	    var chart;
            var legend;
 $.ajax({
   	        type: "POST",
        	url: "cDatoGenerales.php",
		data:"boton=listarReporte",
    	    success: function(html)
			{
                                          alert(html)            
                            var chartData = [{
                                country: "Lithuania",
                                value: 260
                            },html];

                            AmCharts.ready(function () {
                                // PIE CHART
                                chart = new AmCharts.AmPieChart();
                                chart.dataProvider = chartData;
                                chart.titleField = "country";
                                chart.valueField = "value";
                                chart.outlineColor = "#FFFFFF";
                                chart.outlineAlpha = 0.8;
                                chart.outlineThickness = 2;
                                // this makes the chart 3D
                                chart.depth3D = 15;
                                chart.angle = 30;
                chart.colors = [
                                        "#f3f92f","#0eee20", "#0D8ECF", 
                                        "#FF0F00","#8A0CCF", "#CD0D74", 
                                        "#754DEB", "#DDDDDD", "#999999", "#333333", 
                                        "#000000", "#57032A", "#CA9726", "#990000", "#4B0C25"];
                                // WRITE
                                chart.write("chartdiv");
                            });
              }
	});
});