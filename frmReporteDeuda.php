
<?php
ini_set('display_errors',0);
session_start();
//echo "...".$_SESSION['autenticado'];
if($_SESSION['autenticadoU']=='SI')
{
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
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
    <link href="cssshadow/DT_bootstrap.css" type="text/css" rel="stylesheet"/>
    <link href="cssshadow/bootstrap-responsive.css" type="text/css" rel="stylesheet"/>
    <script src="jsshadow/scripts/jquery.min.js"></script>
    <script src="jsshadow/scripts/jquery.js"></script>
    <script src="jsshadow/scripts/bootstrap-tab.js"></script>
    <script src="jsshadow/scripts/bootstrap-dropdown.js"></script>
    <script src="jsshadow/scripts/bootstrap-modal.js"></script>
   <script src="jsshadow/scripts/bootstrap-transition.js"></script>
    <script type="text/javascript" language="javascript" src="jsshadow/scripts/jquery.dataTables.js"></script>
    <script type="text/javascript" language="javascript" src="jsshadow/scripts/DT_bootstrap.js"></script>
    
    <script type="text/javascript" src="http://code.jquery.com/ui/1.8.21/jquery-ui.min.js"></script>
          <script src="jsshadow/scripts/amcharts/amcharts.js" type="text/javascript"></script>  
        <link rel="stylesheet" href="css/ui-lightness/jquery-ui-1.8.21.custom.css" type="text/css"/>
    <!-- Le HTML5 shim, for IE6-8 support of HTML5 elements -->
    <!--[if lt IE 9]>
      <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
    <![endif]-->

    <!-- Le fav and touch icons -->
</head>

<body> 
     <?php include('includes/menu.php') ?>
 <div class="container" style="margin-top: 60px;">
     <div class="content">
    
<div class="page-header">
	<h1>Deudas<small>  Reportes</small></h1>
</div>
         <input type="hidden" name="periodo" id="vperiodo" value="<?php echo $_REQUEST['periodo'];?> "/>
            <input type="hidden" name="periodo" id="vfacultad" value="<?php echo $_REQUEST['facultad'];?> "/>
            <input type="hidden" name="periodo" id="vcarrera" value="<?php echo $_REQUEST['carrera'];?> "/>
            <input type="hidden" name="sede" id="vsede" value="<?php echo $_REQUEST['sede'];?> "/>
       
         <div class="well filtro">
                        <table class="table_filtro">
                    <tr>
                             <td>
                                <div id="sede"></div>
                            </td>
                            <td>
                                <div id="facultad"></div>
                            </td>
                            <td>
                                <div id="carrera"></div>
                            </td>
                            <td>
                                  <div id="cicloR"></div>
                            </td>
                            <td align="right">
                                <button class="btn btn-primary" type="submit" style="margin-top: -40px" onclick="deudaPendiente('<?php echo $_REQUEST['periodo'];?>','<?php echo $_REQUEST['carrera'];?>','<?php echo $_REQUEST['sede'];?>')">Ver estadisticas</button><br/>
                            </td>
                    </tr>
                    </table>
         </div>
            <br/>
            <br/>
                        <div class="well filtro">
                        <table class="table table_info">
                                <tr>
                                        <td class="strong" style="text-align: left">Institución</td>
                                        <td><span style="float:left">: Universidad José Carlos Mariátegui -</span><div id="sedeF"></div></td>
                                        
                                        <td class="strong" style="text-align: left">Facultad</td>
                                        <td>
                                          <span style="float:left">:&nbsp</span><div id="facultadF" style="text-align: left"></div>
                                        </td>
                                </tr>
                                <tr>
                                    <td></td><td></td>
                                        <td class="strong" style="text-align: left">Carrera</td>
                                        <td><span style="float:left">:&nbsp</span><div id="carreraF" style="text-align: left"></div>
                                        </td>
                                </tr>
                                <tr>
                                        <td class="strong" style="text-align: left">Periodo</td>
                                        <td><span style="float:left">:&nbsp</span><div id="periodoF" style="text-align: left"></div></td>
                                        <td class="strong" style="text-align: left">Ciclo: </td>
                                        <td><span style="float:left">:&nbsp</span><div id="cicloF" style="text-align: left"></div></td>
                                </tr>
                        </table>
                </div>
            
            
            <div id="deudaSN" style="width: 100%; height: 400px;"></div><br/><br/>
          <div id="TdeudaSN"> </div>
           <div id="resumenAlumnos"> </div><br/>
          
         <div id="tipoDeuda" style="width: 100%; height: 400px;"></div><br/><br/>
          <div id="TtipoDeuda"></div>
          <div id="resumenAlumnosSE"> </div><br/>
          
         <!--   <div id="maltratoPs" style="width: 100%; height: 400px;"></div><br/><br/>
          <div id="TmaltratoPs"></div>
         
          <div id="CvCiudad" style="width: 100%; height: 400px;"></div><br/><br/>
          <div id="TcvCiudad"></div>
          
           <div id="vilFamiliar" style="width: 100%; height: 400px;"></div><br/><br/>
          <div id="TvilFamiliar"></div>-->
    </div>

     
 </div>
   
   
            <div class="hide fade modal" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
            <div class="modal-header">
            <button class="close" aria-hidden="true" data-dismiss="modal" type="button">×</button>
            <h3 id="myModalLabel" style="float:left"><div id="NomAl"></div></h3> <span style="color: #999999;padding-left: 50px;"><strong><span id="codAL"></span>  </strong></span><br/><br/>
            </div>
            <div class="modal-body">
                <div class="row" style="margin:auto;">
                    <div class="span2"><img src="images/Perfil.PNG" style="border:3px solid #ccc;" width="100%"/></div> 
                        <div class="span4" id="informacion">


                        </div>

                </div>
            </div>
            <div class="modal-footer">
                <button class="btn" data-dismiss="modal" aria-hidden="true">Close</button>
                <button class="btn btn-primary">Save changes</button>
            </div>
            </div>
</body>
 <script src='jsshadow/frmDeudaReporte.js'></script>
<script src="jsshadow/frmUsuario.js"></script>
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