
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
    <script type="text/javascript" language="javascript" src="jsshadow/scripts/jquery.dataTables.js"></script>
    <script type="text/javascript" language="javascript" src="jsshadow/scripts/DT_bootstrap.js"></script>
        
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
    <h1>Aspecto Familiar<small>  Reportes</small><span style="font-size: 12px;margin-left: 300px;font-weight: bold;">Para ver los reportes a nivel de Instición hacer click <a href="frmAspectFamiliar2.php" target='_Blanck'>aquí</a></span></h1> 
</div>
         <div style="padding-left:0px;float:left">
             <div id="sede" style="float:left"> </div>
         </div>
         <div style="padding-left:0px;float:left">
             <div id="periodo" style="float:left"> </div>
         </div>
         
             <div id="facultad" style="float:left">
                 
             </div>
          <button class="btn btn-success" onclick="filtrarCarreras();">REPORTE</button>
        
             <div id="tablaCarreras" style="float:left">
                 
             </div>
        <div>

        </div>
    </div>

     
 </div>
    <script src="jsshadow/frmAspectFamiliar.js"></script>
</body>
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