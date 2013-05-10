
<?php
ini_set('display_errors',0);
session_start();
//echo "...".$_SESSION['autenticado'];
if($_SESSION['autenticadoU']=='SI')
{
?>
<html xmlns="http://www.w3.org/1999/xhtml">
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
  <link href="cssshadow/bootstrap.css" rel="stylesheet"/>
    <link href="cssshadow/estilos.css" rel="stylesheet"/>
     <link href="cssshadow/bootstrap-responsive.css" type="text/css" rel="stylesheet"/>
     <script src="jsshadow/scripts/jquery.js"></script>
    <script src="jsshadow/scripts/bootstrap-tab.js"></script>
    <script src="jsshadow/scripts/bootstrap-dropdown.js"></script>
    <script src="jsshadow/scripts/bootstrap-modal.js"></script>
  
    <script src="jsshadow/scripts/jquery.min.js"></script>

        <script src="jsshadow/scripts/amcharts/amcharts.js" type="text/javascript"></script>  
    
    
    <script type="text/javascript" src="http://code.jquery.com/ui/1.8.21/jquery-ui.min.js"></script>
        
        <link rel="stylesheet" href="css/ui-lightness/jquery-ui-1.8.21.custom.css" type="text/css"/>
   
      

    <!-- Le HTML5 shim, for IE6-8 support of HTML5 elements -->
    <!--[if lt IE 9]>
      <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
    <![endif]-->

    <!-- Le fav and touch icons -->
    <style>
        
    </style>
   
     
</head>

<body> 
    <?php include('includes/menu.php') ?>
    <?php    require_once("models/deudas.php");
    
    //SELECT DISTINCT(d.`departamento_id`) FROM datogenerales AS d  
    $objdeudas= new deudas('','', '','', '', '', '');
    $total=$objdeudas->listarSimple('COUNT(deuda_pendiente)', '', '','', '', '', '');
    $deudaSN='Si*No';
    $deu=explode("*",$deudaSN);
    $ndeu=count($deu);
    
    for($j=0;$j<$ndeu;$j++){
                     
                        $a=$objdeudas->listarSimple('COUNT(deuda_pendiente)', 'deuda_pendiente', '=',$deu[$j], '', '', '');
                       	//SELECT COUNT(f.`estado_padres`) FROM familiares AS f WHERE f.`estado_padres`='Casados'
                                      $arraydeu[$j][0]=$deu[$j];
                                      $arraydeu[$j][1]=$a[0][0];
                                         
    }
    
    $total2=$objdeudas->listarSimple('COUNT(tipo_deuda)', 'deuda_pendiente', '=','Si', '', '', '');
    $deudaTD='Matrícula*Mensualidad*Intereses*Libros*Otro';
    $td=explode("*",$deudaTD);
    $ntd=count($td);
    
    for($j=0;$j<$ntd;$j++){
                     
                        $b=$objdeudas->listarSimple('COUNT(tipo_deuda)', 'tipo_deuda', '=',htmlentities("$td[$j]", ENT_QUOTES,"UTF-8"), '', '', '');
                       	//SELECT COUNT(f.`estado_padres`) FROM familiares AS f WHERE f.`estado_padres`='Casados'
                                      $arraytd[$j][0]=$td[$j];
                                      $arraytd[$j][1]=$b[0][0];
                                         
    }
    
   ?>
 <div class="container" style="margin-top: 60px;">
     <div class="content">
    
<div class="page-header">
	<h1>Deudas<small>  Reportes</small></h1>
</div>
    
        <div id="deudas" style="width: 100%; height: 400px;"></div><br/><br/>
        
        <table class="table_detalle table-bordered" style="width:100%;margin:0;position:relative; top: -50px;">
        <thead>
                <th>#</th>
                <th>Deudas Pendientes de la universidad</th>
                <th>Frecuencia</th>
                <th>%</th> 
        </thead>
            <tbody>
                <?php $k = 1;$nb=count($arraydeu)?>	
                <?php for($i=0;$i<$nb;$i++){ ?>
                <tr>
                    <td align="center"><?php echo $k;?></td>
                    <td> <?php echo $arraydeu[$i][0];?></td>
                   <td align="center"><?php echo $arraydeu[$i][1];?></td>
                    <?php 
                           $porcentaje = ($arraydeu[$i][1] / $total[0][0])*100;
                    ?>
                   <td align="center"><?php echo number_format($porcentaje,2).' %';?></td> 
                </tr>
                
               <?php $k++; } ?>
            </tbody>
            <tfoot>
                <tr>
                        <td colspan="2">Total</td>
                        <td align="center"><?php echo $total[0][0];?></td>
                        <td align="center">100.00 %</td> 
                </tr>
                </tfoot>
        </table>
        
        <div id="tipoDeu" style="width: 100%; height: 400px;"></div><br/><br/>
        
        
        <table class="table_detalle table-bordered" style="width:100%;margin:0;position:relative; top: -50px;">
        <thead>
                <th>#</th>
                <th>Deudas Pendientes de la universidad</th>
                <th>Frecuencia</th>
                <th>%</th> 
        </thead>
            <tbody>
                <?php $k = 1;$nb=count($arraytd)?>	
                <?php for($i=0;$i<$nb;$i++){ ?>
                <tr>
                    <td align="center"><?php echo $k;?></td>
                    <td> <?php echo $arraytd[$i][0];?></td>
                   <td align="center"><?php echo $arraytd[$i][1];?></td>
                    <?php 
                           $porcentaje = ($arraytd[$i][1] / $total2[0][0])*100;
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
<script type="text/javascript">
            var chart;
            var legend;
            var chartData = [
                    <?php $k = 0;$nb=count($arraydeu)?>	
                    <?php for($i=0;$i<$nb;$i++){ ?>
                    {
                    country: "<?php echo $arraydeu[$i][0];?>",
                    value: <?php echo $arraydeu[$i][1];?>
                    }
                    <?php if($k != count($arraydeu)):?>
                            ,
                            <?php endif;?>
                    <?php $k++; ?>
                    <?php }?>
                    ];


                        AmCharts.ready(function () {
                            // PIE CHART
                            chart = new AmCharts.AmPieChart();
                            chart.addTitle("¿Tienes deudas pendientes con la Universidad?", 16);
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
                            chart.write("deudas");
                        });
                        
                        
                        ///TIPO DEUDAS
                        
                        var chartDataTD = [
                    <?php $k = 0;$nb=count($arraytd)?>	
                    <?php for($i=0;$i<$nb;$i++){ ?>
                    {
                    country: "<?php echo $arraytd[$i][0];?>",
                    value: <?php echo $arraytd[$i][1];?>
                    }
                    <?php if($k != count($arraytd)):?>
                            ,
                            <?php endif;?>
                    <?php $k++; ?>
                    <?php }?>
                    ];


                        AmCharts.ready(function () {
                            // PIE CHART
                            chart = new AmCharts.AmPieChart();
                            chart.addTitle("¿Tienes deudas pendientes con la Universidad?", 16);
                            chart.dataProvider = chartDataTD;
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
                                    "#0D8ECF","#990000", "#CA9726", 
                                    "#FF0F00","#8A0CCF", "#CD0D74", 
                                    "#754DEB", "#DDDDDD", "#999999", "#333333", 
                                    "#000000", "#57032A", "#CA9726", "#990000", "#4B0C25"];
                            // WRITE
                            
                            var legend = new AmCharts.AmLegend();
                        legend.position = "right";
                        chart.addLegend(legend);
                            chart.write("tipoDeu");
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