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
    <script type="text/javascript" language="javascript" src="jsshadow/scripts/jquery.dataTables.js"></script>
    <script type="text/javascript" language="javascript" src="jsshadow/scripts/DT_bootstrap.js"></script>
        <script src="jsshadow/scripts/amcharts/amcharts.js" type="text/javascript"></script>  
        <link rel="stylesheet" href="css/ui-lightness/jquery-ui-1.8.21.custom.css" type="text/css"/>
    
</head>

<body> 
    <?php include('includes/menu.php') ?>
    <?php    require_once("models/familiar.php");
    
    //SELECT DISTINCT(d.`departamento_id`) FROM datogenerales AS d  
    $aspFam= new familiar('', '', '', '', '', '', '', '');
    $total=$aspFam->listarSimple('COUNT(estado_padres)','', '','', '', '', '');
    $sitPadres='Casados*Convivientes*Divorciados*Separados';
    $cm=explode("*",$sitPadres);
    $ncm=count($cm);
    
    for($j=0;$j<$ncm;$j++){
                     
                        $a=$aspFam->listarSimple('COUNT(estado_padres)', 'estado_padres', '=',$cm[$j], '', '', '');
                       	//SELECT COUNT(f.`estado_padres`) FROM familiares AS f WHERE f.`estado_padres`='Casados'
                                      $sp[$j][0]=$cm[$j];
                                      $sp[$j][1]=$a[0][0];
                                         
    }
     ?>
    
    <?php    require_once("models/familiar.php");
    
    //SELECT DISTINCT(d.`departamento_id`) FROM datogenerales AS d  
    $aspFamH= new familiar('', '', '', '', '', '', '', '');
   
    $huerfano='Hu&eacute;rfano de padre*Hu&eacute;rfano de madre*Hu&eacute;rfano de ambos*N.A';
    $total2=$aspFam->listarSimple('COUNT(estado_hijo)','', '','', '', '', '');
    $huerfanoE='Huérfano de padre*Huérfano de madre*Huérfano de ambos*N.A';
    $ch2=explode("*",$huerfanoE);
    $ch=explode("*",$huerfano);
    
    $nch=count($ch);
    
    for($j=0;$j<$nch;$j++){
                     
                        $h=$aspFamH->listarSimple('COUNT(estado_hijo)', 'estado_hijo', '=',$ch[$j], '', '', '');
                       	//SELECT COUNT(f.`estado_padres`) FROM familiares AS f WHERE f.`estado_padres`='Casados'
                                      $sh[$j][0]=$ch2[$j];
                                      $sh[$j][1]=$h[0][0];
                                         
    }
     ?>
    
 <div class="container" style="margin-top: 60px;">
     <div class="content">
    
<div class="page-header">
	<h1>Aspecto Familiar<small>  Reportes</small></h1>
</div>
       
         
        <div id="figura" style="width: 100%; height: 400px;"></div>
        <table class="table_detalle table-bordered" style="width:100%;margin:0;position:relative; top: -50px;">
<thead>
	<th>#</th>
	<th>Situacion de los Padres</th>
	<th>Frecuencia</th>
	<!--<th>%</th> -->
</thead>
            <tbody>
                <?php $k = 1;$nb=count($sp)?>	
                <?php for($i=0;$i<$nb;$i++){ ?>
                <tr>
                    <td align="center"><?php echo $k;?></td>
                    <td> <?php echo $sp[$i][0];?></td>
                   <td align="center"><?php echo $sp[$i][1];?></td>
                    <?php 
                          //  $porcentaje = ($sp[$i][1] / $total[0][0])*100;
                    ?>
                  <!--  <td align="center"><?php echo number_format($porcentaje,3).' %';?></td> -->
                </tr>
                
               <?php $k++; } ?>
            </tbody>
            <tfoot>
                <tr>
                        <td colspan="2">Total</td>
                        <td align="center"><?php echo $total[0][0];?></td>
                  <!--      <td align="center">100.00 %</td> -->
                </tr>
                </tfoot>
        </table>
        <h3></h3>
        <div id="huerfano" style="width: 100%; height: 400px;"></div>
        
        
        <table class="table_detalle table-bordered" style="width:100%;margin:0;position:relative; top: -50px;">
<thead>
	<th>#</th>
	<th>Situacion de los Padres</th>
	<th>Frecuencia</th>
	<th>%</th>
</thead>
            <tbody>
                <?php $k = 1;$nb=count($sh)?>	
                <?php for($i=0;$i<$nb;$i++){ ?>
                <tr>
                    <td align="center"><?php echo $k;?></td>
                    <td> <?php echo $sh[$i][0];?></td>
                   <td align="center"><?php echo $sh[$i][1];?></td>
                    <?php 
                            $porcentaje = ($sh[$i][1] / $total2[0][0])*100;
                    ?>
                    <td align="center"><?php echo number_format($porcentaje,2).' %';?></td>
                </tr>
                
               <?php $k++; } ?>
            </tbody>
            <tfoot>
                <tr>
                        <td colspan="2">Total</td>
                        <td align="center"><?php echo $total2[0][0];?></td>
                        <td align="center">100.00 %</td>
                </tr>
                </tfoot>
        </table>
   
    </div>

     
 </div>
    <script src="jsshadow/frmAspectFamiliar.js"></script>
<script type="text/javascript">
            var chart;
            var legend;
            var chartData = [
                    <?php $k = 0;$nb=count($sp)?>	
                    <?php for($i=0;$i<$nb;$i++){ ?>
                    {
                    country: "<?php echo $sp[$i][0];?>",
                    value: <?php echo $sp[$i][1];?>
                    }
                    <?php if($k != count($sp)):?>
                            ,
                            <?php endif;?>
                    <?php $k++; ?>
                    <?php }?>
                    ];


                        AmCharts.ready(function () {
                            // PIE CHART
                            chart = new AmCharts.AmPieChart();
                            chart.addTitle("Situación actual de los padres:", 16);
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
                            
                            var legend = new AmCharts.AmLegend();
                        legend.position = "right";
                        chart.addLegend(legend);
                            chart.write("figura");
                        });
                        
                        //Huerfanos
                        var chartDataH = [
                    <?php $k = 0;$nh=count($sh)?>	
                    <?php for($i=0;$i<$nh;$i++){ ?>
                    {
                    estadoH: "<?php echo $sh[$i][0];?>",
                    valueH: <?php echo $sh[$i][1];?>
                    }
                    <?php if($k != count($sh)):?>
                            ,
                            <?php endif;?>
                    <?php $k++; ?>
                    <?php }?>
                    ];
                    
                    AmCharts.ready(function () {
                            // PIE CHART
                            chart = new AmCharts.AmPieChart();
                             chart.addTitle("Situacion actual del estudiante:", 16);
                            chart.dataProvider = chartDataH;
                            chart.titleField = "estadoH";
                            chart.valueField = "valueH";
                            chart.outlineColor = "#FFFFFF";
                            chart.outlineAlpha = 0.8;
                            chart.outlineThickness = 2;
                            // this makes the chart 3D
                            chart.depth3D = 15;
                            chart.angle = 30;
                            chart.labelRadius = 30;
                            
                            
                             chart.colors = [
                                    "#f3f92f","#0eee20", "#0D8ECF", 
                                    "#FF0F00","#8A0CCF", "#CD0D74", 
                                    "#754DEB", "#DDDDDD", "#999999", "#333333", 
                                    "#000000", "#57032A", "#CA9726", "#990000", "#4B0C25"];
                            // WRITE
                            var legend = new AmCharts.AmLegend();
		legend.position = "right";
		chart.addLegend(legend);
                            chart.write("huerfano");
                        });
                        
        </script>
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