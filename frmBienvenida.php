
<?php
ini_set('display_errors',0);
session_start();
//echo "...".$_SESSION['autenticado'];
if($_SESSION['autenticado']=='SI')
{
?>
<!DOCTYPE html>
<html lang="es">
    <head>
        <title>Universidad José Carlos Mariátegui</title>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
        <meta name="description" content="Ficha Socioeconómica Bienestar UJCM" />
        <meta name="keywords" content="Ficha Socioeconómica Bienestar UJCM"/>
        <link rel="stylesheet" href="cssshadow/normalize.css" />
        <link href='http://fonts.googleapis.com/css?family=Open+Sans' rel='stylesheet' type='text/css' />
        <link rel="stylesheet" href="cssshadow/mystyle.css" type="text/css" media="screen"/>
        <link rel="icon" type="image/x-icon" href="img/favicon.ico">
        <link rel="stylesheet" href="cssshadow/bootstrap.css" type="text/css" media="screen"/>
        <link rel="stylesheet" href="cssshadow/bootstrap-responsive.css" type="text/css" media="screen"/>
        <link rel="stylesheet" href="cssshadow/bootstrap-responsive.min.css" type="text/css" media="screen"/>
        <link rel="stylesheet" href="cssshadow/styleform.css" type="text/css" media="screen"/>
        
    <script src="jsshadow/scripts/jquery.min.js"></script>
          <script src="jsshadow/scripts/jquery.js"></script>
    <script src="jsshadow/scripts/bootstrap-transition.js"></script>
    <script src="jsshadow/scripts/bootstrap-modal.js"></script>

    </head>
    <style>
        span.reference{
            position:fixed;
            left:5px;
            top:5px;
            font-size:10px;
            text-shadow:1px 1px 1px #fff;
        }
        span.reference a{
            color:#555;
            text-decoration:none;
			text-transform:uppercase;
        }
        span.reference a:hover{
            color:#000;
            
        }
        .llenar:hover {
    -moz-border-bottom-colors: none;
    -moz-border-image: none;
    -moz-border-left-colors: none;
    -moz-border-right-colors: none;
    -moz-border-top-colors: none;
    background-color: #006600;
    border-bottom-color: #009933;
    border-bottom-style: solid;
    border-bottom-width: 1px;
    border-left-color-ltr-source: physical;
    border-left-color-rtl-source: physical;
    border-left-color-value: #009933;
    border-left-style-ltr-source: physical;
    border-left-style-rtl-source: physical;
    border-left-style-value: solid;
    border-left-width-ltr-source: physical;
    border-left-width-rtl-source: physical;
    border-left-width-value: 1px;
    border-right-color-ltr-source: physical;
    border-right-color-rtl-source: physical;
    border-right-color-value: #009933;
    border-right-style-ltr-source: physical;
    border-right-style-rtl-source: physical;
    border-right-style-value: solid;
    border-right-width-ltr-source: physical;
    border-right-width-rtl-source: physical;
    border-right-width-value: 1px;
    border-top-color: #009933;
    border-top-style: solid;
    border-top-width: 1px;
    color: #FFFFFF;
}
      .llenar {
    -moz-border-bottom-colors: none;
    -moz-border-image: none;
    -moz-border-left-colors: none;
    -moz-border-right-colors: none;
    -moz-border-top-colors: none;
    border-bottom-color: #0033CC;
    border-bottom-style: solid;
    border-bottom-width: 1px;
    border-left-color-ltr-source: physical;
    border-left-color-rtl-source: physical;
    border-left-color-value: #0033CC;
    border-left-style-ltr-source: physical;
    border-left-width-rtl-source: physical;
    border-left-width-value: 1px;
    border-right-color-ltr-source: physical;
    border-right-color-rtl-source: physical;
    border-right-color-value: #0033CC;
    border-right-style-ltr-source: physical;
    border-right-style-rtl-source: physical;
    border-right-style-value: solid;
    border-right-width-ltr-source: physical;
    border-right-width-rtl-source: physical;
    border-right-width-value: 1px;
    border-top-color: #0033CC;
    border-top-style: solid;
    border-top-width: 1px;
    color: #0033CC;
    font-size: 20px;
    padding-bottom: 5px;
    padding-left: 5px;
    padding-right: 5px;
    padding-top: 5px;
}
.inner h2 {
    border-bottom-color: #006600;
    border-bottom-style: solid;
    border-bottom-width: 1px;
    color: #006600;
    font-size: 24px;
    margin-bottom: 10px;
}
a {
    -moz-text-blink: none;
    -moz-text-decoration-color: -moz-use-text-color;
    -moz-text-decoration-line: none;
    -moz-text-decoration-style: solid;
    color: #0033CC;
}
    </style>
    <body>
       <div id="header">
            	<div class="inner">
            		<div class="header-title">
            			<h1>Universidad José Carlos Mariátegui</h1>
            			<h2>Oficina de Bienestar Universitario OBU</h2>
            		</div>
            	</div>
        </div>
        <div id="container" style="min-height: 422px; padding-top: 70px;">
            <div class="inner">
          
            <div id="wrapper" style=" margin-bottom: auto;
                            margin-left: auto;
                            margin-right: auto;
                            margin-top: auto;
                            width: 90%;">
                 <br/>
                  <br/>
                   <br/>
                   <p>
                       La Oficina de Bienestar Universitario, con su Equipo de Profesionales, Médicos- Enfermeros(as), Trabajadores Sociales, Psicólogos(as) , Profesores de Educación Física y Personal, te damos la BIENVENIDA Y TE FELICITAMOS por tu decisión y esfuerzo de superación. Esperamos logres tus propósitos y para ello estamos nosotros, OBU, para brindarte un servicio oportuno.
                   </p>
                   <form accept-charset="utf-8" style="width:460px" name="fmatri">
                   <div id="actualizar" class="span3" style="padding:4% 9%">
                       <h2>Actualize sus datos:</h2>
                                 <input id="codalum" name="codalum" type="hidden" value="<?php echo $_SESSION['id'] ?>">
                                 <input id="mat" name="mat" type="hidden" value="<?php echo $_REQUEST['matriculado'] ?>">
                            
                            <div class="input select">
                                <label>Modalidad de Estudio</label>
                                <div class="xinput">
                                <select id="modAl2"  name="modAl" class=":required">
                                <option value="">Seleccione...</option>
                                <option value="Presencial">Presencial</option>
                                <option value="Distancia">Distancia</option>
                                <option value="Programa Adultos">Programa Adultos</option>
                                <option value="Programa Especial">Programa Especial</option>
                                </select>
                                </div>
                         </div>
                            
                            <div class="input select" id="sede">
                                
                          </div>
                          
                            <div class="input select" id="annio">
                                
                         </div>
                          <div class="input select" id="facultad">
                                
                         </div>
                            
                            <div class="input select" id="carrera">
                                 <label>Carrera</label>
                                    <div class='xinput'>
                                    <select class=':required' id='carreraAl_id' name='carrera' onclick='cargarCiclos();'>
                                <option value=''>Seleccione.. </option>
                                    </select>
                                    </div>
                            </div>
                            
                            <div class="input select" id="ciclo">
                                <label>Ciclo</label>
                                    <div class='xinput'>
                                    <select class=':required' name='ciclo' id='cicloAl_id';>
                                <option value=''>Seleccione.. </option>
                                    </select>
                                    </div>
                            </div>
                            <input value="GUARDAR" class="btn btn-success" onclick="guardarActualizacion('Guardarr');" />
                        </form>
                       </div>
                   <div id="seguir" class='span7' style="margin-top: 22%;text-align:center">
                        <a class="llenar" href="frmFicha.php">LLENAR LA FICHA SOCIOECONÓMICA</a>
                </div>
                    <br/>
                
            </div>
                           <script src="jsshadow/frmRegistro2.js"></script>
                    <script src="jsshadow/frmFacultades.js"></script>
           </div>        
        </div>
    </div>
    <div id="footer">
        <div class="inner">
           © 2012 Universidad José Carlos Mariátegui <br />
           Calle Ayacucho Nº 393. Moquegua - Perú Telf. 461110 Anexo 101 <br />
           acreditacion.ujcm@gmail.com
        </div>
    </div> 
    </body>
    
</html>
<script type="text/javascript">
    var matriculado = $('#mat').val();
  //  alert(matriculado)
    if(matriculado == 'Si' ){
        $("#actualizar").hide();
        $('#seguir').show();
        document.getElementById('seguir').style.margin='2% 18%';
    }else{
          $("#actualizar").show();
         
          $('#seguir').hide();
        }
</script>
<?php

}
else
	echo "Ud. no est&aacute; autorizado para ver esta p&aacute;gina...";
?>