
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
    <style>
       input-text{
          height: 30px;   
        }
    </style>
   
     
</head>

<body> 
    
         <?php include('includes/menu.php') ?> 
 <div class="container" style="margin-top: 60px;">
<div class="content">
<div class="page-header">
<h1>Usuarios</h1>
</div>
<div class="row">
<div class="span3">
<h3>Gestión de usuarios</h3>
<p>Agregue un nuevo usuario.</p>
</div>
<div class="span9">
    <div id="alert"></div>
    <div id="agregadoU">
<form action="doc" class="well" id="Usuario" method="post" accept-charset="utf-8">
    <div id="UsuarioId"> </div>
<label for="UsuarioNombres">Nombres</label>
<input name="data[Usuario][nombres]" type="text" class=":required span5" style=" height: 30px" maxlength="80" id="UsuarioNombres"/>
<label for="UsuarioApellidos">Apellidos</label>
<input name="data[Usuario][apellidos]" type="text" style=" height: 30px" class="span5 :required" maxlength="80" id="UsuarioApellidos"/>
<label for="Dni">Dni</label>
<input type="text" style=" height: 30px" class="span2 :required" maxlength="8" id="UsuarioDni"/>
<label for="UsuarioEmail">Correo eléctronico</label>
<input name="data[Usuario][email]" type="text" style=" height: 30px" class=":required :email span5" maxlength="120" id="UsuarioEmail"/>
<label for="UsuarioPassword">Contraseña</label>
<input type="password" name="data[Usuario][password]" style=" height: 30px" class=":required" id="UsuarioPassword"/>
<br/>
<input type="button" class="btn btn-info" style="margin-left:95px; margin-top:10px;" onclick="guardarAdm('Guardar');" value="Ingresar" />
<input type="reset" class="btn btn-success" style="margin-left:95px; margin-top:10px;" value="Reestablecer" />
</form>
</div>
</div>
</div>
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