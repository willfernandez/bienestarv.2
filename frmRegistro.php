<?php
$url2=isset($_GET['error']) ? $_GET['error'] : 0;
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <title>Universidad José Carlos Mariátegui</title>
	 <meta name="description" content="Ficha Socioeconómica Bienestar UJCM">
     
	 <link href="img/favicon.ico" type="image/x-icon" rel="icon"/> 
   <link rel="shortcut icon" href="/favicon.ico">
      <link rel="stylesheet" href="cssshadow/mystyle.css" type="text/css" media="screen"/>
	 <link rel="stylesheet" href="cssshadow/bootstrap.css" type="text/css" media="screen"/>
	 <link rel="stylesheet" href="cssshadow/bootstrap-responsive.css" type="text/css" media="screen"/>
      <link rel="stylesheet" href="cssshadow/bootstrap-responsive.min.css" type="text/css" media="screen"/>
   <link href="cssshadow/shCore.css" rel="stylesheet" type="text/css" />
    <!--   -->
   <link href="cssshadow/shThemeDefault.css" rel="stylesheet" type="text/css" />
  <!-- Demo CSS -->
	<link rel="stylesheet" href="cssshadow/flexslider.css" type="text/css" media="screen" />
  <link rel="stylesheet" type="text/css" href="cssshadow/estilos.css">
	
	<!-- Modernizr -->
  
  <script src="jsshadow/scripts/jquery.js"></script>
  <script src="jsshadow/scripts/vanadium.js"></script>
  <script src="jsshadow/scripts/jquery.min.js"></script>
    <!-- Le HTML5 shim, for IE6-8 support of HTML elements -->
    <!--[if lt IE 9]>
      <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
    <![endif]-->
	<!-- Le HTML5 shim, for IE6-8 support of HTML elements -->
    <!--[if lt IE 9]>
      <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
    <![endif]-->
     <script type="text/javascript">
    var VanadiumRules = {
     
      pass: [
        'required',
        ['min_length', 5, 'global-advice'],
        ['wait', 200]
      ],
      repeat_pass: [
        ['advice', 'global-advice'],
        'required',
        ['min_length', 5, 'global-advice'],
        ['same_as','pass','global-advice']
      ],
      top: 'container',
      email_and_name: 'container',
      passwords: 'container'
    }
  </script>
<script type="text/javascript">

var _gaq = _gaq || [];
_gaq.push(['_setAccount', 'UA-34178304-1']);
_gaq.push(['_trackPageview']);

(function() {
var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
})();

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
     <div class="container" style="min-height: 472px;padding-right: 40px; padding-top:1px; width:auto;">
	<div class="login span4" style="margin: 4% 18% auto;width: 60%;">
	<legend>Para acceder al sistema deberá ingresar su DNI y  código universitario válido.</legend>
        <?php 
                            if($url2 == '1'){
         ?>
                            <div id="authMessage" class="alert alert-block alert-error fade in">
                              <button class="close" type="button" data-dismiss="alert">×</button>
                              Los datos ingresados son incorrectos o Ud. ya se encuentra registrado. Favor de llamar al siguiente número RPC para soporte técnico <strong> 953502283 </strong> - Oficina de Acreditación
                            </div>
          <?php  } ?>
         <div id="reg_box">
               <form accept-charset="utf-8"  name="fvalida" action="cAlumno.php  "> 
                           
                            <div class="span3" style="padding-left:10%">
                              <input type="hidden" value="0" id="idAlum" name="idAlum"
                               />
                                <div class="input text">
                                    <label class="desc" for="name">Nombres: </label>
                                    <input class=":required mayuscula " name="nomAl" id="nombAl" type="text">
                                </div>
                                <div class="input text">
                                    <label class="desc" for="apellidos">Apellidos: </label>
                                    <input id="apeAl" name="apeAl"  class=":required mayuscula" type="text">
                                </div>
                                <label for="dni">DNI: </label><br/>
                                <input class=":only_on_blur :required :digits :min_length;8 :max_length;8" name="dniAl" id="dniAl" type="text">

                                <div class="input text">
                                    <label >Codigo:</label>
                                      <input id="codAl" name="codAl" class=":required" type="text">
                                </div>
                                
                                <div class="input text">
                                    <label>Tu correo electrónico:</label>
                                     <input name="emailAl" id="emailAl" type="text" class=":only_on_blur :required;;email_advice  :email;;email_advice">
                                </div>
                            </div>
                            <div class="span3" style="padding-left:10%">
                                  <div class="input select">
                                      <label>Modalidad de Estudio</label>
                                      <div class="xinput">
                                      <select id="modAl"  name="modAl" required="1">
                                      <option value="">Seleccione...</option>
                                      <option value="Presencial">Presencial</option>
                                      <option value="Distancia">Distancia</option>
                                      <option value="Programa Adultos">Programa Adultos</option>
                                      <option value="Programa Especial">Programa Especial</option>
                                      </select>
                                      </div>
                                 </div>
                            
                                 <div class="input select" id="sede"></div>
                                 <div class="input select" id="annio"></div>
                                 <div class="input select" id="facultad"></div>
                                 <div class="input select" id="carrera"></div>
                                 <div class="input select" id="ciclo"></div>
                             </div>
                       <div class="span7 botonL">     
                          <button class="btn btn-success" name='boton' type="submit" value="Guardar" data-loading-text="Loading..."> Guardar</button>
                       </div>
                    </form>
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
   <script src="jsshadow/frmFacultades.js"></script>
</body>
</html>

