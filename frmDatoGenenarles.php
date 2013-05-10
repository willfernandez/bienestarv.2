
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
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" type="image/x-icon" href="img/favicon.ico">

    <!-- Le styles -->
    <link rel="stylesheet" href="cssshadow/normalize.css" />
         <link href='http://fonts.googleapis.com/css?family=Open+Sans' rel='stylesheet' type='text/css' />
      <link href="cssshadow/jqueryui.css" type="text/css" rel="stylesheet"/>
      <link href="cssshadow/bootstrap.css" type="text/css" rel="stylesheet"/>
      <link href="cssshadow/bootstrap-responsive.css" type="text/css" rel="stylesheet"/>
    <link href="cssshadow/docs.css" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="cssshadow/jquery.datatables.css">
      
      
      <link rel="stylesheet" href="css/ui-lightness/jquery-ui-1.8.21.custom.css" type="text/css"/>
   <script src="jsshadow/scripts/jquery.min.js"></script>
   <script src="jsshadow/scripts/jquery.js"></script>
    <script src="jsshadow/scripts/bootstrap-tab.js"></script>
    <script src="jsshadow/scripts/bootstrap-dropdown.js"></script>
    <script src="jsshadow/scripts/bootstrap-collapse.js"></script>
    <script src="jsshadow/scripts/bootstrap-modal.js"></script>
   <script src="jsshadow/scripts/bootstrap-transition.js"></script>
    <script src="jsshadow/scripts/jquery.dataTables.js" type="text/javascript"></script>
    <script src="jsshadow/scripts/DT_bootstrap.js" type="text/javascript"></script>
    <script src="jsshadow/scripts/script.js"></script>
    <script type="text/javascript" src="http://code.jquery.com/ui/1.8.21/jquery-ui.min.js"></script>

        <script src="jsshadow/scripts/amcharts/amcharts.js" type="text/javascript"></script>  
    
   
      

    <!-- Le HTML5 shim, for IE6-8 support of HTML5 elements -->
    <!--[if lt IE 9]>
      <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
    <![endif]-->

    <!-- Le fav and touch icons -->
    
   
     
</head>

<body> 
    <?php include('includes/menu.php') ?>
    <?php    
    require_once("models/datoGenerales.php");
    require_once("models/annio.php");
    
    //SELECT DISTINCT(d.`departamento_id`) FROM datogenerales AS d  
    $total=0;
    $dato0= new datoGenerales('', '', '', '', '', '', '','');
    $annio = new  annio('','','','','');
    $totalC=$dato0->listar('COUNT(DISTINCT(d.departamento_id))','d.`departamento_id`','=','dep.`id`','','','');
    $ciudades=$dato0->listar('DISTINCT(d.departamento_id), dep.`nombre`','d.`departamento_id`','=','dep.`id`','','','');
    $an = $annio->listarSimple('id','activo','=','1','','','');
    $tC=count($ciudades);
    $colores="#f3f92f*#0eee20*#0D8ECF*#FF0F00*#8A0CCF*#CD0D74*#754DEB*#DDDDDD*#999999*#333333*#000000*#57032A*#CA9726*#990000*#4B0C25*#f3f92f*#0eee20*#0D8ECF*#FF0F00*#8A0CCF*#CD0D74*#f3f92f*#0eee20*#0D8ECF*#FF0F00*#8A0CCF*#CD0D74";
    $ccolor=explode("*",$colores);
    for($j=0;$j<$tC;$j++){
                        $datos = new datoGenerales('', '', '', '', '', '', '','');
                        $a=$datos->listarSimple('COUNT(departamento_id)', 'departamento_id*academico_id', '=*=',$ciudades[$j][0].'*'.$an[0][0], 'AND', '', '');
                       	
                                      $nombreciudad[$j][0]=$ciudades[$j][0];
                                      $nombreciudad[$j][1]=$a[0][0];
                                      $nombreciudad[$j][2]=$ccolor[$j];
                                      $nombreciudad[$j][3]=$ciudades[$j][1];
                                      
                                         
    }
     ?>
    
 <div class="container" style="margin-top: 60px;">
     <div class="content">
    
<div class="page-header">
	<h1>Datos Generales <small>  Reportes</small></h1>
</div>
    
         <h3>Lugar de nacimiento de los alumnos</h3>
    
    
        <div id="chartdiv" style="width: 100%; height: 400px;"></div><br/><br/><br/>
        <table class="table_detalle table-bordered" style="width:100%;margin:0;position:relative; top: -50px;">
<thead>
	<th>#</th>
	<th>Departamento</th>
	<th>Frecuencia</th>
	<th>%</th>
</thead>
            <tbody>
                <?php $k = 1;$nb=count($nombreciudad)?>	
                
                 <?php for($i=0;$i<$nb;$i++){ 
                            $total = $total+$nombreciudad[$i][1];
                 } ?>

                <?php for($i=0;$i<$nb;$i++){ ?>
                <tr>
                    <td align="center"><?php echo $k;?></td>
                    <td> <?php echo $nombreciudad[$i][3];?></td>
                   <td align="center"><?php echo $nombreciudad[$i][1];?></td>
                    <?php 
                            $porcentaje = ($nombreciudad[$i][1] / $total)*100;
                    ?>
                    <td align="center"><?php echo number_format($porcentaje,2).' %';?></td>
                </tr>
                
                <?php $k++; } ?>
            </tbody>
            <tfoot>
                <tr>
                        <td colspan="2">Total</td>
                        <td align="center"><?php echo $total;?></td>
                        <td align="center">100.00 %</td>
                </tr>
                </tfoot>
        </table>
   
    </div>

     
 </div>
<script src="jsshadow/frmUsuario.js"></script>
</body>
</html>
<script type="text/javascript">
            var chart;
            var legend;
var chartData = [
	<?php $k = 0;$nb=count($nombreciudad)?>	
	<?php for($i=0;$i<$nb;$i++){ ?>
	{
	country: "<?php echo $nombreciudad[$i][3];?>",
	value: <?php echo $nombreciudad[$i][1];?>,
        color: "<?php echo $nombreciudad[$i][2];?>"
	}
	<?php if($k != count($nombreciudad)):?>
		,
		<?php endif;?>
	<?php $k++; ?>
	<?php }?>
	];
           

            AmCharts.ready(function () {
                
                // PIE CHART
                chart = new AmCharts.AmSerialChart();
                chart.dataProvider = chartData;
                chart.categoryField = "country";
                chart.startDuration = 2;
                // the following two lines makes chart 3D
                chart.depth3D = 20;
                chart.angle = 30;
                
                 // AXES
                // category
                var categoryAxis = chart.categoryAxis;
                categoryAxis.labelRotation = 90;
                categoryAxis.dashLength = 5;
                categoryAxis.gridPosition = "start";
                
                   // value
                var valueAxis = new AmCharts.ValueAxis();
                valueAxis.title = "Cantidad";
                valueAxis.dashLength = 5;
                chart.addValueAxis(valueAxis);
                 // GRAPH            
                var graph = new AmCharts.AmGraph();
                graph.valueField = "value";
                 graph.colorField = "color";
                graph.balloonText = "[[category]]: [[value]]";
                graph.type = "column";
                graph.lineAlpha = 0;
                graph.fillAlphas = 1;
                chart.addGraph(graph);
//
var legend = new AmCharts.AmLegend();
                        legend.position = "right";
                        chart.addLegend(legend);
                // WRITE
                chart.write("chartdiv");
            });
        </script>
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