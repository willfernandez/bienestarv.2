
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
    

   
      

    <!-- Le HTML5 shim, for IE6-8 support of HTML5 elements -->
    <!--[if lt IE 9]>
      <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
    <![endif]-->

    <!-- Le fav and touch icons -->
    
   
     
</head>

<body> 
     <?php include('includes/menu.php') ?>
    <?php    require_once("models/violencia.php");
    
    //SELECT DISTINCT(d.`departamento_id`) FROM datogenerales AS d  
    $datoV=new violencia('','','','', '', '', '', '', '');
    $total1=$datoV->listarSimple('COUNT(violencia_familia)', '', '','', '', '', '');
    $total2=$datoV->listarSimple('COUNT(maltrato_psicologico)', '', '','', '', '', '');
    $total3=$datoV->listarSimple('COUNT(maltrato_fisico)', '', '','', '', '', '');
    $violenciaSN='Si*No';
    $cv=explode("*",$violenciaSN);
    $ncv=count($cv);
    
   for($j=0;$j<$ncv;$j++){
                     
                        $a=$datoV->listarSimple('COUNT(violencia_familia)', 'violencia_familia', '=',$cv[$j], '', '', '');
                       	//SELECT COUNT(f.`estado_padres`) FROM familiares AS f WHERE f.`estado_padres`='Casados'
                                      $sp[$j][0]=$cv[$j];
                                      $sp[$j][1]=$a[0][0];
                          //maltrato Ps
                         $b=$datoV->listarSimple('COUNT(maltrato_psicologico)', 'maltrato_psicologico', '=',$cv[$j], '', '', '');
                        
                                         $smp[$j][0]=$cv[$j];
                                        $smp[$j][1]=$b[0][0];
                                        
                        $c=$datoV->listarSimple('COUNT(maltrato_fisico)', 'maltrato_fisico', '=',$cv[$j], '', '', '');

                            $smf[$j][0]=$cv[$j];
                        $smf[$j][1]=$c[0][0];
    }
    $viveC='Ambos Padres*S&oacute;lo con madre*Solo*S&oacute;lo con padre*Familiares*C&oacute;nyuge';
    $viveC2='Ambos Padres*Sólo con madre*Solo*Sólo con padre*Familiares*Cónyuge';
    $total4=$datoV->listarSimple('COUNT(familia_actual)', '', '','', '', '', '');
    $cvi2=explode("*",$viveC2);
    $cvi=explode("*",$viveC);
    $ncvi=count($cvi);
    for($j=0;$j<$ncvi;$j++){
                        $d=$datoV->listarSimple('COUNT(familia_actual)', 'familia_actual', '=',$cvi[$j], '', '', '');
                        $smv[$j][0]=$cvi2[$j];
                        $smv[$j][1]=$d[0][0];
    }
    
     $relaciones='Excelentes*Buenas*Regulares*Malas*Muy malas';
     $total5=$datoV->listarSimple('COUNT(famila_relacion)', '', '','', '', '', '');
    $cre=explode("*",$relaciones);
    $ncre=count($cre);
    for($j=0;$j<$ncre;$j++){
                        $e=$datoV->listarSimple('COUNT(famila_relacion)', 'famila_relacion', '=',$cre[$j], '', '', '');
                        $smre[$j][0]=$cre[$j];
                        $smre[$j][1]=$e[0][0];
    }
    
    
     ?>
    
 <div class="container" style="margin-top: 60px;">
     <div class="content">
   
<div class="page-header">
	<h1>Convivencia <small>  Reportes</small></h1>
</div>
    
         <h3></h3>
    
    
        <div id="chartdiv" style="width: 100%; height: 400px;"></div><br/><br/>
        
             <table class="table_detalle table-bordered" style="width:100%;margin:0;position:relative; top: -50px;">
                <thead>
                        <th>#</th>
                        <th>Violencia Familiar</th>
                        <th>Frecuencia</th>
                        <th>%</th>
                </thead>
                 <tbody>
                    <?php $k = 1;$nb=count($sp)?>	
                    <?php for($i=0;$i<$nb;$i++){ ?>
                    <tr>
                        <td align="center"><?php echo $k;?></td>
                        <td> <?php echo $sp[$i][0];?></td>
                    <td align="center"><?php echo $sp[$i][1];?></td>
                        <?php 
                                $porcentaje = ($sp[$i][1] / $total1[0][0])*100;
                        ?>
                        <td align="center"><?php echo number_format($porcentaje,2).' %';?></td>
                    </tr>

                <?php $k++; } ?>
                </tbody>
                <tfoot>
                    <tr>
                            <td colspan="2">Total</td>
                            <td align="center"><?php echo $total1[0][0];?></td>
                            <td align="center">100.00 %</td>
                    </tr>
                    </tfoot>
        </table>
        
        <h3></h3>
    
    
        <div id="maltratoP" style="width: 100%; height: 400px;"></div><br/><br/>
        
         <table class="table_detalle table-bordered" style="width:100%;margin:0;position:relative; top: -50px;">
                <thead>
                        <th>#</th>
                        <th>Violencia Familiar</th>
                        <th>Frecuencia</th>
                        <th>%</th>
                </thead>
                 <tbody>
                    <?php $k = 1;$nb=count($smp)?>	
                    <?php for($i=0;$i<$nb;$i++){ ?>
                    <tr>
                        <td align="center"><?php echo $k;?></td>
                        <td> <?php echo $smp[$i][0];?></td>
                    <td align="center"><?php echo $smp[$i][1];?></td>
                        <?php 
                                $porcentaje = ($smp[$i][1] / $total2[0][0])*100;
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
        <h3></h3>
    
    
        <div id="maltratoF" style="width: 100%; height: 400px;"></div><br/><br/>
        
           <table class="table_detalle table-bordered" style="width:100%;margin:0;position:relative; top: -50px;">
                <thead>
                        <th>#</th>
                        <th>Maltrato Físico</th>
                        <th>Frecuencia</th>
                        <th>%</th>
                </thead>
                 <tbody>
                    <?php $k = 1;$nb=count($smf)?>	
                    <?php for($i=0;$i<$nb;$i++){ ?>
                    <tr>
                        <td align="center"><?php echo $k;?></td>
                        <td> <?php echo $smf[$i][0];?></td>
                    <td align="center"><?php echo $smf[$i][1];?></td>
                        <?php 
                                $porcentaje = ($smf[$i][1] / $total3[0][0])*100;
                        ?>
                        <td align="center"><?php echo number_format($porcentaje,2).' %';?></td>
                    </tr>

                <?php $k++; } ?>
                </tbody>
                <tfoot>
                    <tr>
                            <td colspan="2">Total</td>
                            <td align="center"><?php echo $total3[0][0];?></td>
                            <td align="center">100.00 %</td>
                    </tr>
                    </tfoot>
        </table>
        <h3></h3>
    
    
        <div id="familiaActual" style="width: 100%; height: 400px;"></div>
        
         <table class="table_detalle table-bordered" style="width:100%;margin:0;position:relative; top: -50px;">
                <thead>
                        <th>#</th>
                        <th>Maltrato Psicológico</th>
                        <th>Frecuencia</th>
                    <!--    <th>%</th> -->
                </thead>
                 <tbody>
                    <?php $k = 1;$nb=count($smv)?>	
                    <?php for($i=0;$i<$nb;$i++){ ?>
                    <tr>
                        <td align="center"><?php echo $k;?></td>
                        <td> <?php echo $smv[$i][0];?></td>
                    <td align="center"><?php echo $smv[$i][1];?></td>
                        <?php 
                     //           $porcentaje = ($smv[$i][1] / $total4[0][0])*100;
                        ?>
                      <!--  <td align="center"><?php echo number_format($porcentaje,2).' %';?></td> -->
                    </tr>

                <?php $k++; } ?>
                </tbody>
                <tfoot>
                    <tr>
                            <td colspan="2">Total</td>
                            <td align="center"><?php echo $total4[0][0];?></td>
                           <!-- <td align="center">100.00 %</td>-->
                    </tr>
                    </tfoot>
        </table>
        <h3></h3>
    
    
        <div id="familiaRelacion" style="width: 100%; height: 400px;"></div>
        
        <table class="table_detalle table-bordered" style="width:100%;margin:0;position:relative; top: -50px;">
                <thead>
                        <th>#</th>
                        <th>Violencia Familiar</th>
                        <th>Frecuencia</th>
                        <!-- <th>%</th>-->
                </thead>
                 <tbody>
                    <?php $k = 1;$nb=count($smre)?>	
                    <?php for($i=0;$i<$nb;$i++){ ?>
                    <tr>
                        <td align="center"><?php echo $k;?></td>
                        <td> <?php echo $smre[$i][0];?></td>
                    <td align="center"><?php echo $smre[$i][1];?></td>
                        <?php 
                             //   $porcentaje = ($smre[$i][1] / $total5[0][0])*100;
                        ?>
                       <!-- <td align="center"><?php echo number_format($porcentaje,2).' %';?></td>-->
                    </tr>

                <?php $k++; } ?>
                </tbody>
                <tfoot>
                    <tr>
                            <td colspan="2">Total</td>
                           <td align="center"><?php echo $total5[0][0];?></td>
                          <!--  <td align="center">100.00 %</td> -->
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
                 chart.addTitle("¿Ha observado violencia familiar en su hogar?", 16);
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
			"#0D8ECF","#FF0F00", "#0D8ECF", 
			"#FF0F00","#8A0CCF", "#CD0D74", 
			"#754DEB", "#DDDDDD", "#999999", "#333333", 
			"#000000", "#57032A", "#CA9726", "#990000", "#4B0C25"];
                // WRITE
                   var legend = new AmCharts.AmLegend();
                        legend.position = "right";
                        chart.addLegend(legend);
                chart.write("chartdiv");
            });
            
            //maltrado PSicologico
            
            var chartDataMP = [
	<?php $k = 0;$nb=count($smp)?>	
	<?php for($i=0;$i<$nb;$i++){ ?>
	{
	country: "<?php echo $smp[$i][0];?>",
	value: <?php echo $smp[$i][1];?>
	}
	<?php if($k != count($smp)):?>
		,
		<?php endif;?>
	<?php $k++; ?>
	<?php }?>
	];
           

            AmCharts.ready(function () {
                // PIE CHART
                chart = new AmCharts.AmPieChart();
                chart.addTitle("¿Maltrato físico?", 16);
                chart.dataProvider = chartDataMP;
                chart.titleField = "country";
                chart.valueField = "value";
                chart.outlineColor = "#FFFFFF";
                chart.outlineAlpha = 0.8;
                chart.outlineThickness = 2;
                // this makes the chart 3D
                chart.depth3D = 15;
                chart.angle = 30;
chart.colors = [
			"#0D8ECF","#0eee20", "#0D8ECF", 
			"#FF0F00","#8A0CCF", "#CD0D74", 
			"#754DEB", "#DDDDDD", "#999999", "#333333", 
			"#000000", "#57032A", "#CA9726", "#990000", "#4B0C25"];
                // WRITE
                   var legend = new AmCharts.AmLegend();
                        legend.position = "right";
                        chart.addLegend(legend);
                chart.write("maltratoP");
            });
            
            //maltrato fisico
            
             var chartDataMF = [
	<?php $k = 0;$nb=count($smf)?>	
	<?php for($i=0;$i<$nb;$i++){ ?>
	{
	country: "<?php echo $smf[$i][0];?>",
	value: <?php echo $smf[$i][1];?>
	}
	<?php if($k != count($smf)):?>
		,
		<?php endif;?>
	<?php $k++; ?>
	<?php }?>
	];
           

            AmCharts.ready(function () {
                // PIE CHART
                chart = new AmCharts.AmPieChart();
                chart.addTitle("¿Maltrato psicológico?", 16);
                chart.dataProvider = chartDataMF;
                chart.titleField = "country";
                chart.valueField = "value";
                chart.outlineColor = "#FFFFFF";
                chart.outlineAlpha = 0.8;
                chart.outlineThickness = 2;
                // this makes the chart 3D
                chart.depth3D = 15;
                chart.angle = 30;
chart.colors = [
			"#FAAF0B","#31D3BE", "#0D8ECF", 
			"#FF0F00","#8A0CCF", "#CD0D74", 
			"#754DEB", "#DDDDDD", "#999999", "#333333", 
			"#000000", "#57032A", "#CA9726", "#990000", "#4B0C25"];
                // WRITE
                   var legend = new AmCharts.AmLegend();
                        legend.position = "right";
                        chart.addLegend(legend);
                chart.write("maltratoF");
            });
            
            //con quien vive en esta ciudad
            var chartDataCV = [
	<?php $k = 0;$nb=count($smv)?>	
	<?php for($i=0;$i<$nb;$i++){ ?>
	{
	country: "<?php echo $smv[$i][0];?>",
	value: <?php echo $smv[$i][1];?>
	}
	<?php if($k != count($smv)):?>
		,
		<?php endif;?>
	<?php $k++; ?>
	<?php }?>
	];
           

            AmCharts.ready(function () {
                // PIE CHART
                chart = new AmCharts.AmPieChart();
                chart.addTitle("¿Con quién vive en esta ciudad?", 16);
                chart.dataProvider = chartDataCV;
                chart.titleField = "country";
                chart.valueField = "value";
                chart.outlineColor = "#FFFFFF";
                chart.outlineAlpha = 0.8;
                chart.outlineThickness = 2;
                // this makes the chart 3D
                chart.depth3D = 15;
                chart.angle = 30;
chart.colors = [
			"#FAAF0B","#31D3BE", "#0eee20", 
			"#FF0F00","#8A0CCF", "#CD0D74", 
			"#754DEB", "#DDDDDD", "#999999", "#333333", 
			"#000000", "#57032A", "#CA9726", "#990000", "#4B0C25"];
                // WRITE
                   var legend = new AmCharts.AmLegend();
                        legend.position = "right";
                        chart.addLegend(legend);
                chart.write("familiaActual");
            });
            ///FAMILIA RELACION
            
            var chartDatafr = [
	<?php $k = 0;$nb=count($smre)?>	
	<?php for($i=0;$i<$nb;$i++){ ?>
	{
	country: "<?php echo $smre[$i][0];?>",
	value: <?php echo $smre[$i][1];?>
	}
	<?php if($k != count($smre)):?>
		,
		<?php endif;?>
	<?php $k++; ?>
	<?php }?>
	];
           

            AmCharts.ready(function () {
                // PIE CHART
                chart = new AmCharts.AmPieChart();
                chart.addTitle("Mis relaciones familiares son:", 16);
                chart.dataProvider = chartDatafr;
                chart.titleField = "country";
                chart.valueField = "value";
                chart.outlineColor = "#FFFFFF";
                chart.outlineAlpha = 0.8;
                chart.outlineThickness = 2;
                // this makes the chart 3D
                chart.depth3D = 15;
                chart.angle = 30;
chart.colors = [
			"#f3f92f","#FF0F00", "#0D8ECF", 
			"#57032A","#8A0CCF", "#CD0D74", 
			"#754DEB", "#DDDDDD", "#999999", "#333333", 
			"#000000", "#57032A", "#CA9726", "#990000", "#4B0C25"];
                // WRITE
                   var legend = new AmCharts.AmLegend();
                        legend.position = "right";
                        chart.addLegend(legend);
                chart.write("familiaRelacion");
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
?>>