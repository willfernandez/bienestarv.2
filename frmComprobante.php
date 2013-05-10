<?php

session_start();
//echo "...".$_SESSION['autenticado'];
if($_SESSION['autenticado']=='SI'&&$_SESSION['validacion']=='SI')
{

?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <title>Universidad José Carlos Mariátegui</title>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
        <meta name="description" content="Ficha Socioeconómica Bienestar UJCM" />
		<link href="img/favicon.ico" type="image/x-icon" rel="icon"/> 
        <meta name="keywords" content="Ficha Socioeconómica Bienestar UJCM"/>
        <link rel="stylesheet" href="cssshadow/bootstrap.css" type="text/css" media="screen"/>
        <link rel="stylesheet" href="cssshadow/comprobante.css" type="text/css" media="screen"/>
        
		<script src="jsshadow/scripts/jquery.js"></script>
<style>
a {
	background-image: url(images/salir.png);
	background-position: 50% 50%;
	background-repeat: no-repeat;
	background-origin: border-box;
	
	display: inline-block; width: 100px; height: 100px;
	border-width: 50px;
	border-color: rgba(0,0,0,0);
	
	border-radius: 100%;
	-moz-border-radius: 100%;
	-webkit-border-radius: 100%;
	
	-webkit-box-sizing: border-box;
	-moz-box-sizing: border-box;
	box-sizing: border-box;
	
	-webkit-transition: 0.5s ease;
	-moz-transition: 0.5s ease;
	-ms-transition: 0.5s ease;
	-o-transition: 0.5s ease;
	transition: 0.5s ease;
}

a:hover {
	border-width: 0;
	border-color: rgba(0, 0, 0, 0.5);
}

.one{border-style: solid;}
.two{border-style: dashed;}
.three{border-style: dotted;}

.yon {border: 50px solid rgba(0, 0, 0, 0.7);}
.goo {border: 50px dashed rgba(0, 0, 0, 0.7);}
.rok {border: 50px dotted rgba(0, 0, 0, 0.7);}
.ryk {border: 50px double rgba(0, 0, 0, 0.7);}
.yon:hover{border: 1px solid rgba(0, 0, 0, 0.7);}
.goo:hover{border: 1px dashed rgba(0, 0, 0, 0.7);}
.rok:hover{border: 1px dotted rgba(0, 0, 0, 0.7);}
.ryk:hover{border: 1px double rgba(0, 0, 0, 0.7);}
</style>    
	
    </head>
    
    
    <body>
       <div id="header">
	<div class="inner">
	 <img alt="logo" src='images/logo2.png'/>
		<div class="header-title">
			<h1>Universidad José Carlos Mariátegui</h1>
			<span>Oficina de Bienestar Universitario OBU</span>
		</div>
	</div>
        </div>
        <div id="container" style="min-height: 472px; padding-top: 70px;">
            <form action="prueba.php" method="post">
            <div class="inner" style="width:920px;">
          
            <div class="ficha">
                        <div style="position:absolute;left:20%;top:150px;z-index:0;">
                            <img src="cssshadow/img/compo.png">
                        </div>
                        <div >
                                <div class="inner2">
                            <div class="image">

                                 <img alt="logo" src='images/logo2.png'/>
                            </div>
                                        <div class="header-title2">

                                            <center><h1>Universidad José Carlos Mariátegui</h1>
                                                <span>Oficina de Bienestar Universitario OBU</span>
                                            </center>
                                        </div>
                                </div>
                        </div>
                        <div id="reg-content2">
                            
                            <div class="form-title">CONSTANCIA DE EVALUACION SOCIOECONÓMICA - MEDICA</div>
                            <br/>
                        <br/>
                        <div class="tabla">

                        <div class="fila">
                        <div class="col_titulo" style="width:80px" >Codigo</div>
                        <div style="float: left; padding-top: 5px;paddint-left: 10px">:</div>
                        <div class="col" style="width:600px" id='codigoAl'><?php echo $_SESSION['codigo'] ?></div>
                        <div class="col_titulo" style="width:80px">Nombres</div>
                        <div style="float: left; padding-top: 5px;paddint-left: 10px">:</div>
                        <div class="col" style="width:600px" id='nomAl'><?php echo $_SESSION['nombres'] ?></div>
                        <div class="col_titulo" style="width:80px">Apellidos</div>
                        <div style="float: left; padding-top: 5px;paddint-left: 10px">:</div>
                        <div class="col" style="width:600px" id='apeAl'><?php echo $_SESSION['apellidos']?></div>
                       
                        </div>
                        </div>
                        </div>

                        </div>
 
				
                    
           </div>     
            <div style="float:left;">
		   <input type="submit" value="IMP" />
                   </div>
		   <script src="jsshadow/cerrarSesion.js"></script>
           <script src="jsshadow/comprobante.js"></script>
       </form>
        </div>
		
    </body>
    
</html>
<?php

}
else
	echo "Ud. no est&aacute; autorizado para ver esta p&aacute;gina...";
?>