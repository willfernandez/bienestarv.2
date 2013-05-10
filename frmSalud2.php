<?php
ini_set('display_errors',0);
session_start();
//echo "...".$_SESSION['autenticado'];
if($_SESSION['autenticadoU']=='SI')
{
?>
<!DOCTYPE html>
<html>
<head>

    <meta charset="utf-8">
    <title>Ficha Socioeconómica Bienestar UJCM</title>
    <meta name="description" content="">
    <meta name="author" content="">
<link rel="icon" type="image/x-icon" href="img/favicon.ico">
    <!-- Le styles -->
    <link rel="stylesheet" href="cssshadow/normalize.css" />
         <link href='http://fonts.googleapis.com/css?family=Open+Sans' rel='stylesheet' type='text/css' />
  <link href="cssshadow/bootstrap.css" rel="stylesheet"/>
    <link href="cssshadow/estilos.css" rel="stylesheet"/>
     <link href="cssshadow/bootstrap-responsive.css" type="text/css" rel="stylesheet"/>
     <script src="jsshadow/scripts/jquery.js"></script>
    <script src="jsshadow/scripts/bootstrap-tab.js"></script>
    <script src="jsshadow/scripts/bootstrap-dropdown.js"></script>
    <script src="jsshadow/scripts/bootstrap-modal.js"></script>
    <script src="jsshadow/scripts/jquery.min.js"></script>
        <script src="jsshadow/scripts/amcharts/amcharts.js" type="text/javascript"></script>  
        <link rel="stylesheet" href="css/ui-lightness/jquery-ui-1.8.21.custom.css" type="text/css"/>
     <script>
        	
        var datos="boton=Reporte";
        var tabla;
			$.ajax({
                                type: "POST",
                                url: "cSalud.php",
                                data: datos,
                                 success: function(html)
                                   {	
                                    var a=html.split('*');
                                   
                                    var chart;
                                    var legend;
                                    var chartData = [
                                            {
                                            country:'Si' ,
                                            value: a[2]
                                            }, {
                                            country: "No",
                                             value: a[3]
                                              }

                                            ];
                                       tabla="<table class='table_detalle table-bordered' style='width:40%;margin:auto;position:relative; top: -50px;'>";
                                     tabla+="<thead><th>#</th><th></th><th>Frecuencia</th><th>%</th></thead><tbody>";
                                     tabla+="<tr><td align='center'>1</td>";
                                     tabla+="<td>Si</td>";
                                     tabla+="<td>"+a[2]+"</td>";
                                     var porcentaje=(a[2]/a[4])*100;
                                     var total1=formatNumber(porcentaje);
                                     tabla+="<td>"+total1+"%</td></tr>";
                                     tabla+="<tr><td align='center'>2</td>";
                                     tabla+="<td>No</td>";
                                    tabla+="<td>"+a[3]+"</td>"; 
                                    var porcentaje2=(a[3]/a[4])*100;
                                    var total2=formatNumber(porcentaje2);
                                     tabla+="<td>"+total2+"%</td></tr>";
                                     tabla+="</tr></tbody></table>";
                                         $('#tabla').html(tabla);

                                                    // PIE CHART
                                                    chart = new AmCharts.AmPieChart();
                                                    chart.addTitle("¿Padece de alguna enfermedad?:", 16);
                                                    chart.dataProvider = chartData;
                                                    chart.titleField = "country";
                                                    chart.valueField = "value";
                                                    chart.sequencedAnimation = true;
                                                    chart.startEffect = "elastic";
                                                    chart.innerRadius = "30%";
                                                    chart.startDuration = 2;
                                                    chart.labelRadius = 15;
                                                    // this makes the chart 3D
                                                    chart.depth3D = 10;
                                                    chart.angle = 15;
                                                  chart.colors = [
                                                            "#f3f92f","#0eee20", "#0D8ECF", 
                                                            "#FF0F00","#8A0CCF", "#CD0D74", 
                                                            "#754DEB", "#DDDDDD", "#999999", "#333333", 
                                                            "#000000", "#57032A", "#CA9726", "#990000", "#4B0C25"];
                                                    // WRITE
                                                    var legend = new AmCharts.AmLegend();
                                                legend.position = "right";
                                                chart.addLegend(legend);
                                                    chart.write("salud");
                                   
                                    
                                    }
                                    
                                     
                          
   });
   function formatNumber(num)
{    
    var n = num.toString();
    var nums = n.split('.');
    var newNum = "";
    if (nums.length > 1)
    {
        var dec = nums[1].substring(0,2);
        newNum = nums[0] + "," + dec;
    }
    else
    {
    newNum = num;
    }
    return newNum;
}
    </script>
     
</head>

<body> 
     <?php include('includes/menu.php') ?>  
 <div class="container" style="margin-top: 60px;">
     <div class="content">
                <div class="page-header">
                        <h1>Salud<small>  Reportes</small></h1>
                </div>
         <div id="Si"></div>
         <div id="No"></div>
         <div id="Total"></div>
          <div id="salud" style="width: 100%; height: 400px;"></div><br/><br/>
          <div id="tabla"></div>
     </div>
 </div>
     <script src="jsshadow/frmUsuario.js"></script>
</body>
</html>
<?php

}
else{
	echo "Ud. no est&aacute; autorizado para ver esta p&aacute;gina...";
        
?>

<html>
<head>
<meta http-equiv="Refresh" content="4;url=frmAdmin.php">
</head>

</html>

<?php 
}
?>