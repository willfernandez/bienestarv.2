
<?php
ini_set('display_errors',0);
session_start();
//echo "...".$_SESSION['autenticado'];
if($_SESSION['autenticado']=='SI')
{
?>
<!DOCTYPE html>
<html lang="en">
    <head>
          <title>Universidad José Carlos Mariátegui</title>
        <meta charset="utf-8">
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
        <meta name="description" content="Ficha Socioeconómica Bienestar UJCM" />
        <meta name="keywords" content="Ficha Socioeconómica Bienestar UJCM"/>
        
        <link href="img/favicon.ico" type="image/x-icon" rel="icon"/> 
        <link rel="shortcut icon" href="/favicon.ico">
        <link rel="stylesheet" href="cssshadow/bootstrap2.css" type="text/css" media="screen"/>
        <link rel="stylesheet" href="cssshadow/bootstrap-responsive.css" type="text/css" media="screen"/>
        <link rel="stylesheet" href="cssshadow/bootstrap-responsive.min.css" type="text/css" media="screen"/>
        <link href="cssshadow/shCore.css" rel="stylesheet" type="text/css" />
        <link rel="stylesheet" href="cssshadow/mystyle.css" type="text/css" media="screen"/>
    <!--   -->
        <link rel="stylesheet" type="text/css" href="cssshadow/estilos.css">
        <link type="text/css" href="cssshadow/jquery-ui-1.8.6.css" rel="Stylesheet" />
  <!-- Demo CSS -->
        <link rel="stylesheet" href="cssshadow/flexslider.css" type="text/css" media="screen" />
        <script src="jsshadow/scripts/prefixfree.min.js"></script>
        <script src="jsshadow/scripts/jquery.js"></script>


        <script src="jsshadow/scripts/vanadium.js" type="text/javascript"></script>
        <script src="jsshadow/scripts/msgbox/jquery.msgbox.js" type="text/javascript"> </script>
	
        <script src="jsshadow/scripts/bootstrap-transition.js"></script>
        <script src="jsshadow/scripts/bootstrap-modal.js"></script>
    	<script type="jsshadow/scripts/jquery.min.js"></script>
        <script type="text/javascript" src="jsshadow/scripts/jquery-ui-1.8.6.min.js"></script>
	
<script type="text/javascript">
$(function() {
	$('#fechaNac').datepicker({dateFormat: 'yy-mm-dd', changeMonth: true, changeYear: true, yearRange: '-100:+0'});
});
</script>	
    </head>
   
    <body>
       <div id="header">
            <div class="inner">
                <div class="header-title">
                    <h1>Universidad José Carlos Mariátegui</h1>
                    <h2>Oficina de Bienestar Universitario OBU</h2>
                </div>
            </div>
        </div>
        <div class="container">
                <div class="content">
                   <div class="titulo">
                       <div class="ficha"> Fichas socioeconómica</div>
                        <div class="alumno-tit"><span style="text-transform: none;"> Alumno: </span> 
                            <?php echo $_SESSION['nombres'].' '.$_SESSION['apellidos']  ?> 
                            <span>
                            <a href="logout.php" id="cerrarSesion" title="cierra su sesion actual">CERRAR SESIÓN</a>
                            </span>
                               <input type="hidden" name="idAlumno" id="idAlumno" value='<?php echo $_SESSION['id']?>'/>
                        </div>

                    </div>
                    <div class="row row-titulo" >
                          <div class="span3">
                                    <div class="menu2">
                                        <h4>Partes de llenado</h4>
                                        <ul class="menu">
                                            <li><a href="#" id="mgeneral" class="diseabled enabled">1. Datos Generales</a></li>
                                            <li><a href="#" id="mdomicilio" class="diseabled">2. Domicilio</a></li>
                                            <li><a href="#" id="mfamiliar" class="diseabled ">3. Familiares dependientes</a></li>
                                            <li><a href="#" id="meconomico" class="diseabled">4. Economía</a></li>                    
                                            <li><a href="#" id="mvivienda" class="diseabled">5. Vivienda</a></li>
                                            <li><a href="#" id="msalud" class="diseabled">6. Salud</a></li>                    
                                        </ul>
                                    </div>
                                    <div class="ayudalateral">
                                        <p> Favor llenar cuidadosamente cada campo.</p>
                                    </div>
                          </div>
                            <div class="span9">
                                <div class="page-header">
                                    <h1>1. Datos Generales</h1>
                                </div>
                                <div  class="well" >
                                    <div style="display:none;"><input type="hidden" name="_method" value="POST"></div> 
                                           <label>Domicilio Actual</label>
                                           <input id="direccionA" type="text" class="span5" maxlength="60">
                                           <label>Telefono/Cel.</label>
                                           <input id="telefonoA" type="text" class="span2" maxlength="60">

                                            <div class="page-header-blue">
                                                <h5>Lugar de Nacimiento:</h5>
                                            </div>
                                           <div  id="departamento">

                                           </div>
                                            <div  id="provinciaA">
                                            
                                           </div>

                                            <label>Fecha de Nacimiento</label>
                                            <input id="fechaNac" type="text" class="span2" maxlength="60">

                                             <div class="page-header-blue">
                                                <h5>En caso de emergencia comunicar a:</h5>
                                            </div>
                                                <button href="#emergencia"  class="btn btn-warning" data-toggle="modal" style="margin-left: 30%;
                                                        margin-right: 30%;">AGREGAR NUEVO FAMILIAR</button>
                                        
                                </div>  
                                <div class="well">
                                        <button type="reset" class="btn btn-success" style="float:right"><strong>SIGUIENTE PASO>></strong></button>
                                </div> 

                            </div>


                          </div>
                    </div>

               </div>
       </div>

        <div class="modal hide fade" id="emergencia" style="text-align: justify;">
            <div class="modal-header">
            <a class="close " data-dismiss="modal">×</a>
            <h3>Ud. depende económicamente de:</h3>
            </div>
            <div class="modal-body">
                <div>
                                <form style="padding-left:140px">
                                   
                                    <div id="idEco" style="visibility:hidden"></div>
                                        <select id="tipoFamiliaEco" name="tipoFamiliaEco" onchange="esconderAut(this.value);">
                                                <option value="Padre" selected>Padre</option>
                                                <option value="Madre">Madre</option>
                                                <option value="Apoderado/Tutor">Apoderado/Tutor</option>
                                                <option value="Conyugue">Conyugue</option>
                                                <option value="Se Autosostiene">Se Autosostiene</option>
                                          </select>
                                    <span id="aut">
                                        <label >Nombres y Apellidos de esta persona</label>
                                        <input id="nombreEco" type="text" class=" span3" placeholder="" style="text-transform:uppercase;" />
                                        </span>
                                        <label>Edad de esta persona:</label>
                                        <div class="input-prepend input-append">
                                        <input style="width:20px" type="text" id="edadEco" class=" span1" placeholder=""  style="text-transform:uppercase;" />
                                        <span class="add-on">años</span>
                                        </div>
                                        <label>Ocupacion de esta persona:</label>
                                        <input type="text" id="ocupacionEco" class=" span3" placeholder="" style="text-transform:uppercase;" />
                                        <label>Ingresos de esta persona:</label>
                                        <div class="input-prepend input-append">
                                        <span class="add-on">S./</span><input type="text" id="ingresosEco" class=" span1" placeholder="" style="text-transform:uppercase;" />
                                        </div>

                                </form> 
                              

                </div>
            </div>
            <div class="modal-footer">
                <a class="btn" data-dismiss="modal" href="#">Cerrar</a>
            <a class="btn btn-primary" data-dismiss="modal" href="#" value="Guardar" onclick="enviarEconomia('Guardar');">Guardar cambios</a>
            
            </div>
        </div>
   </body>
   <script type="text/javascript" src="jsshadow/frmFicha2.js"></script>
<?php

}
else
	echo "Ud. no est&aacute; autorizado para ver esta p&aacute;gina...";
?>border-bottom: 2px solid rgb(230, 228, 228);