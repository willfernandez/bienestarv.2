
<?php
ini_set('display_errors',0);
session_start();
//echo "...".$_SESSION['autenticado'];
//echo "...".$_SESSION['bandera'];
if($_SESSION['autenticado']=='SI' &&  $_SESSION['bandera']=='Sii')
{
?>
<!DOCTYPE html>
<html>
    <head>
          <title>Universidad José Carlos Mariátegui</title>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
        <meta name="description" content="Ficha Socioeconómica Bienestar UJCM" />
        <meta name="keywords" content="Ficha Socioeconómica Bienestar UJCM"/>
		<link rel="icon" type="image/x-icon" href="img/favicon.ico">
        <link rel="stylesheet" href="cssshadow/normalize.css" />
         <link href='http://fonts.googleapis.com/css?family=Open+Sans' rel='stylesheet' type='text/css' />
        <link rel="stylesheet" href="cssshadow/bootstrap.css" type="text/css" media="screen"/>
        <link rel="stylesheet" href="cssshadow/bootstrap-responsive.css" type="text/css" media="screen"/>
        <link rel="stylesheet" href="cssshadow/bootstrap-responsive.min.css" type="text/css" media="screen"/>
        <link rel="stylesheet" href="cssshadow/styleform.css" type="text/css" media="screen"/>
        <link href="cssshadow/jquery.msgbox.css" type="text/css" rel="stylesheet">
  <script src="jsshadow/scripts/vanadium.js" type="text/javascript"></script>
<script src="jsshadow/scripts/msgbox/jquery.msgbox.js" type="text/javascript"> </script>
        <script src="jsshadow/scripts/jquery.js"></script>
		 <link type="text/css" href="cssshadow/jquery-ui-1.8.6.css" rel="Stylesheet" />

        <script src="jsshadow/scripts/bootstrap-transition.js"></script>
        <script src="jsshadow/scripts/bootstrap-modal.js"></script>
	<script type="jsshadow/scripts/jquery.min.js"></script>
	<script type="text/javascript" src="jsshadow/scripts/jquery-1.4.2.min.js"></script>
        <script type="text/javascript" src="jsshadow/scripts/jquery-ui-1.8.6.min.js"></script>
	
        <script type="text/javascript" src="jsshadow/scripts/sliding.form.js"></script>
<script type="text/javascript">
$(function() {
	$('#dob').datepicker({dateFormat: 'yy-mm-dd', changeMonth: true, changeYear: true, yearRange: '-100:+0'});
        $('#dobemb').datepicker({dateFormat: 'yy-mm-dd', changeMonth: true, changeYear: true, yearRange: '-100:+0'});
});
</script>	
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
      
    </style>
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
        <div id="container"><div id="modif">
             
			
           <?php if($_SESSION['validacion']=='SI') { 
               $alumno_id=$_SESSION['id'];
                    require_once("models/datoGenerales.php");
                     $datos = new datoGenerales('', '', '', '', '', '', '');
                     $a=$datos->listarSimple('', 'alumno_id', '=', $alumno_id, '', '', '');
                     $na=count($a);
                     if($na>0){
                                for($i=0;$i<$na;$i++)
                                {	
                                        $dataG=$a[$i][0].'*'.$a[$i][2].'*'.$a[$i][3].'*'.$a[$i][4].'*'.$a[$i][5].'*'.$a[$i][6];
                                        // del 1 al 6
                                }
                     }else{
                         $dataG=' * * * * * ';
                     }
                     
                    require_once("models/emergencia.php");
                    
                            $emergencia = new emergencia('', '', '', '', '', '', '','');
                            $a=$emergencia->listarSimple('', 'alumno_id', '=', $alumno_id, '', '', '');
                            $na=count($a);$c=0;
                            if($na>0){
                                for($i=0;$i<$na;$i++)
                                {	$c++;
                                        $dataEm=$a[$i][0].'*'.$a[$i][2].'*'.$a[$i][3].'*'.$a[$i][4].'*'.$a[$i][5].'*'.$a[$i][6];
                                        // del 7 al 12
                                }
                            }else{
                                $dataEm=' * * * * * ';
                            }
                                //Aspecto Familiar
                 require_once("models/familiar.php");
                    
                           $familiar = new familiar('','', '', '', '', '', '');
                            $a=$familiar->listarSimple('', 'alumno_id', '=', $alumno_id, '', '', '');
                            $na=count($a);
                             if($na>0){
                                for($i=0;$i<$na;$i++)
                                {	$c++;
                                        $dataFa=$a[$i][0].'*'.$a[$i][2].'*'.$a[$i][3].'*'.$a[$i][4].'*'.$a[$i][5].'*'.$a[$i][6];
                                        // del 13 al 18
                                }
                             }else{
                                       $dataFa=' * * * * * ';
                             }
                                
                                
                            require_once("models/violencia.php");
                    
                            $violencia = new violencia('', '', '', '', '', '', '', '');
                            $a=$violencia->listarSimple('', 'alumno_id', '=', $alumno_id, '', '', '');
                            $na=count($a);
                             if($na>0){
                                for($i=0;$i<$na;$i++)
                                {	$c++;
                                        $dataVi=$a[$i][0].'*'.$a[$i][2].'*'.$a[$i][3].'*'.$a[$i][4].'*'.$a[$i][5].'*'.$a[$i][6].'*'.$a[$i][7];
                                        // del 19 al 25
                                }  
                             }else{
                                        $dataVi=' * * * * * * ';
                             }
                             
                                require_once("models/deudas.php");
                    
                            $deuda = new deudas('', '', '', '', '', '');
                            $a=$deuda->listarSimple('', 'alumno_id', '=', $alumno_id, '', '', '');
                            $na=count($a);
                            if($na>0){
                                for($i=0;$i<$na;$i++)
                                {	
                                        $dataDe=$a[$i][0].'*'.$a[$i][2].'*'.$a[$i][3].'*'.$a[$i][4].'*'.$a[$i][5];
                                        // del 26 al 30
                                }
                            }else{
                                        $dataDe=' * * * * ';
                            }
                                
                                
                                 require_once("models/educacion.php");
                    
                            $educacion = new educacion('', '', '', '', '', '', '', '', '', '', '', '', '', '');
                            $a=$educacion->listarSimple('', 'alumno_id', '=', $alumno_id, '', '', '');
                            $na=count($a);
                            if($na>0){
                                for($i=0;$i<$na;$i++)
                                {	
                                        $dataEd=$a[$i][0].'*'.$a[$i][2].'*'.$a[$i][3].'*'.$a[$i][4].'*'.$a[$i][5].'*'.$a[$i][6].'*'.$a[$i][7].'*'.$a[$i][8].'*'.$a[$i][9].'*'.$a[$i][10].'*'.$a[$i][11].'*'.$a[$i][12].'*'.$a[$i][13];
                                        // del 31 al 43
                                } 
                            }else{
                                        $dataEd=' * * * * * * * * * * * * ';
                            }
                                
                                  require_once("models/salud.php");
                    
                            $salu = new Salud('', '', '', '', '');
                            $a=$salu->listarSimple('', 'alumno_id', '=', $alumno_id, '', '', '');
                            $na=count($a);
                            if($na>0){
                                for($i=0;$i<$na;$i++)
                                {	
                                        $dataSa=$a[$i][0].'*'.$a[$i][2].'*'.$a[$i][3].'*'.$a[$i][4];
                                        // del 44 al 47
                                } 
                            }else{
                                        $dataSa=' * * * ';
                            }
                           
                                
                                require_once("models/vivienda.php");
                    
                            $vivienda = new Vivienda('', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '');
                            $b=$vivienda->listarSimple('', 'alumno_id', '=', $alumno_id, '', '', '');
                            $na=count($b);
                            if($na>0){
                            for($i=0;$i<$na;$i++)
                                {	
                                        $dataVivi=$b[$i][0].'*'.$b[$i][2].'*'.$b[$i][3].'*'.$b[$i][4].'*'.$b[$i][5].'*'.$b[$i][6].'*'.$b[$i][7].'*'.$b[$i][8].'*'.$b[$i][9].'*'.$b[$i][10].'*'.$b[$i][11].'*'.$b[$i][12].'*'.$b[$i][13].'*'.$b[$i][14].'*'.$b[$i][15].'*'.$b[$i][16].'*'.$b[$i][17];
                                        // del 65 al 64
                                } 
                            }else{
                                        $dataVivi=' * * * * * * * * * * * * * * * * ';                              
                            }
                                
                                require_once("models/academico.php");
                    
                            $academico= new Academico('', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '');
                            $c=$academico->listarSimple('', 'alumno_id', '=', $alumno_id, '', '', '');
                            $nc=count($c);
                            if($nc>0){
                            for($i=0;$i<$nc;$i++)
                                {	
                                        $datosAcademi=$c[$i][0].'*'.$c[$i][2].'*'.$c[$i][3].'*'.$c[$i][4].'*'.$c[$i][5].'*'.$c[$i][6].'*'.$c[$i][7].'*'.$c[$i][8].'*'.$c[$i][9].'*'.$c[$i][10].'*'.$c[$i][11].'*'.$c[$i][12].'*'.$c[$i][13].'*'.$c[$i][14].'*'.$c[$i][15];
                                        // del 65 al 79
                                } 
                            }else{
                                        $datosAcademi=' * * * * * * * * * * * * * * ';
                            }
							
							require_once("models/economia.php");
                            
                            $economia = new economia('', '', '', '', '', '', '','');
                            $a=$economia->listarSimple('', 'alumno_id','=', $alumno_id, '', '', '');
                                //$camposMostrar,$campo,$operador,$valor,$separador,$inicio,$fin
                                $html='<table align="center" class="table table-striped table-bordered dataTable" id="document">
                                <thead><tr><th>No</th><th>Nombres y Apellidos</th><th>Ingresos</th><th>Acci&oacute;n</th></tr></thead><tbody>';
                                $na=count($a);$c=0;
                                for($i=0;$i<$na;$i++)
                                {	$c++;
								$data=$a[$i][0].'-'.$a[$i][2].'-'.$a[$i][3].'-'.$a[$i][4].'-'.$a[$i][5].'-'.$a[$i][6];
                                        $html.='<tr>
                                                                <th>'.$c.'</th>
                                                                <td>'.$a[$i][3].'</td>
                                                                <td>'.$a[$i][6].'</td>
																<td><a  href="#emergencia" data-toggle="modal" id="Modificar-'.$data.'"><img src="images/editar.png"/></a>
																<a href="#" id="Eliminar-'.$a[$i][0].'"><img src="images/borrar.png"/></a><td>
                                                                
                                                        </tr>';
                                }
                                $html.='</tbody></table>
                                <script src="jsshadow/frmEconomiaSelect2.js"></script>';
                    
                            $datosTotales=$dataG.'*'.$dataEm.'*'.$dataFa.'*'.$dataVi.'*'.$dataDe.'*'.$dataEd.'*'.$dataSa.'*'.$dataVivi.'*'.$datosAcademi.'*'.$html;
               
                $parametro="Ud. Ya lleno Su ficha socioeconómica para editar hacer click: <a class='view' href='#' id='Modificar*$datosTotales' title='Ver'>fff</a></br>
                               " ;
               $parametro2="También puede ver su comprobante en el siguiente enlace:";
               ?>
             <div style="background: #F4F4F4; 
                    padding-bottom: 0;
                    padding-left: 50px;
                    padding-right: 45px;
                    padding-top: 12px;
                    width: 280px;"><h3 style="color:#7199B7"><?php echo $_SESSION['nombres'].' '.$_SESSION['apellidos'] ?></h3></div>
             <div style="background: #F4F4F4; margin-left: 400px;
                    padding-bottom: 0;
                    padding-left: 50px;
                    padding-right: 45px;
                    padding-top: 12px;
                    width: 500px;"><p><?php echo $parametro  ?></p></div>
                    
                    <div style="background: #F4F4F4; margin-left: 400px;
                    padding-bottom: 10px;
                    padding-left: 50px;
                    padding-right: 45px;
                    padding-top: 12px;
                    width: 500px;"><p><?php echo $parametro2  ?> <button class='btn btn-danger' onClick='location.href = "prueba.php"'>Comprobante</button></p></div>
             
              
           <?php }  ?>  
             </div>
             <div id="todo" >
            <div class="inner">
          
            <div id="wrapper" style="width:790px;margin:auto">
                
                  <div id="navigation" style=" float:left">
				  <h2><?php echo $_SESSION['nombres'].' '.$_SESSION['apellidos']; ?></h2>
                                  <input type="hidden" name="nomUs" id="nomUs" value="<?php echo $_SESSION['nombres'].' '.$_SESSION['apellidos']; ?>"/>
                    <ul style="margin:0px'">
                         <li class="selected">
                            <a href="#">Educativo</a>
                        </li>
                        <li>
                            <a href="#">Salud</a>
                        </li>
                        <li>
                            <a href="#">Vivienda</a>
                        </li>
                        <li>
                            <a href="#">Academico</a>
                        </li>
			<li>
                            <a href="#">Guardar Datos</a>
                        </li>
                    </ul>
                </div>
                <div id="steps" style="padding-left: 180px;">
                    <form id="formElem" name="formElem" action="" method="post">
                         <!-- ASPECTO EDUCATIVO -->
                        <fieldset class="step">
                            <legend>Aspecto Educativo</legend>
                            <div id="idEdu" style="visibility:hidden"> </div>
                            <p>
                                <label style="width:120px">Usted Proviene de:</label>
                                <select id="colegio" name="Tcolegio">
                                    <option value="" selected>Seleccione...</option>
                                    <option value="I.E Nacional">I.E Nacional</option>
                                    <option value="I.E Parroquial">I.E Parroquial</option>
                                    <option value="I.E Particular">I.E Particular</option>
                                </select>
                            </p>
                            
                            <p>
                                <label style="width:120px">Nombre de la I.E:</label>
                                <input type="text" id="nombreC" name="nombreC" class=" span1" placeholder="" />
                            </p>
                            
                            <p>
                                <label style="width:120px">Ubicación:</label>
                                <input type="text" id="ubicacionC" name="ubicacionC" class=" span1" placeholder="" />
                            </p>
                            
                            <p>
                                <label style="float: none;width:530px">¿Estudió alguna Carrera Técnica?</label>
                                        <label class="radio">
                                         <input id="carreraT" type="radio"  value="Si" name="carreraT" onchange="abrirCarrera(this.value);" />
                                           Si
                                        </label>
                                    <span style="float:none;">
                                        <label class="radio"  >
                                        <input id="carreraT" type="radio" value="No" name="carreraT" onchange="abrirCarrera(this.value);" />
                                            No
                                        </label>
                                    </span>
                            </p>
                            <!--  AJAX -->
                            <input type="hidden" name="fndCarrera" id="fndCarrera" value="0"/>
                            <div id="esconderCarrera">
                            <p>
                                <label style="width:120px">¿Cuál?:</label>
                                <input type="text" id="nombreCr" class="span1" placeholder="" />
                            </p>
                            <!--  ACA TERMINA -->
                            </div>
                            <p>
                                <label style="width:350px">¿Realiza alguna actividad académica en particular?:</label>
                                <input type="text" id="actAcade" name="actAcade" class=" span1" placeholder="" />
                            </p>
                            <p>
                                <label style="width:350px">¿Realiza alguna actividad deportiva en particular?:</label>
                                <input type="text" id="actDepor" name="actDepor" class=" span1" placeholder="" />
                            </p>
                          
                            <p>
                                <label style="float: none;width:530px">¿Se preparó en una academia preuniversitaria?</label>
                                        <label class="radio">
                                         <input id="academia" type="radio"  value="Si" name="academia" onchange="abrirAcademia(this.value);" />
                                           Si
                                        </label>
                                    <span style="float:none;">
                                        <label class="radio"  >
                                        <input id="academia" type="radio" value="No" name="academia" onchange="abrirAcademia(this.value);" />
                                            No
                                        </label>
                                    </span>
                            </p>
                            <!--  AJAX -->
                            <input type="hidden" name="fndAcademia" id="fndAcademia" value="0"/>
                            <div id="esconderAcademia">
                            <p>
                                <label style="width:120px">¿Cuál?:</label>
                                <input type="text" id="nomAcademia" class=" span1" placeholder="" />
                            </p>
                            <p>
                                <label style="width:120px">¿Cuánto tiempo?:</label>
                                <input type="text" id="tiempoAcademia" class="span1" placeholder="" />
                            </p>
                            </div>
                            <!--  ACA TERMINA -->
                            
                            <p>
                                <label style="width:270px">¿Cuantas veces postuló a la Universidad?:</label>
                                <input id="numIntento" style="width:20px" name="numIntento" type="text" AUTOCOMPLETE=OFF />
                            </p>
                            
                            <p style="width:380px">
                                <label style="float: none;width:500px">¿A qué Carrera(s) Profesional(es) y/o Tecnicas Postuló antes?</label>
                                <textarea style="width: 360px;" id="postuCarrera" name="postuCarrera" class="input-xlarge" rows="3"></textarea>
                            </p>
                        </fieldset>
                        <!-- END ASPECTO EDUCATIVO -->
                        
                        
                        <!--   SALUD -->
                        
                        <fieldset class="step">
                            <legend>Aspectos de Salud</legend>
                            <div id="idSal" style="visibility:hidden"> </div>
                            <p>
                                <label style="float: none;width:530px">¿Padece alguna enfermedad?</label>
                                        <label class="radio">
                                         <input id="enfermedad" type="radio" value="Si" name="enfermedad" onchange="abrirSalud(this.value);" />
                                           Si
                                        </label>
                                    <span style="float:none;">
                                        <label class="radio"  >
                                        <input id="enfermedad" type="radio" value="No" name="enfermedad" onchange="abrirSalud(this.value);"  />
                                            No
                                        </label>
                                    </span>
                            </p>
                                <input type="hidden" name="fndAcademia" id="fndEnfermedad" value="0"/>
                                <div id="esconderenfermedad">
                            <p>
                                <label for="enfermedadNom">¿Cual?</label>
                                <input id="enfermedadNom" name="enfermedadNom" type="text" />
                            </p>
                                 </div>
                            <p>
                                    <label style="float: none;width:530px">¿Actualmente se encuentra embarazada?</label>
                                            <label class="radio">
                                            <input id="embarazada" type="radio" value="Si" name="embarazada" onchange="abrirEmb(this.value);" />
                                            Si
                                            </label>
                                        <span style="float:none;">
                                            <label class="radio"  >
                                            <input id="embarazada" type="radio" value="No" name="embarazada" onchange="abrirEmb(this.value);"  />
                                                No
                                            </label>
                                        </span>
                            </p>
                            <input type="hidden" name="fndEmb" id="fndEmb" value="0"/>
                                <div id="esconderemb">
                                    <p>
                                        <label for="aa">¿Cuanto tiempo de Gestación?</label>
                                        <span class="add-on">meses</span><input id="embTiempo" name="embTiempo" type="text" />
                                    </p>
                                    <p>
                                        <label for="aa">Fecha de Parto</label>
                                         <input type="text" name="dobemb" id="dobemb" />
                                    </p>
                                    <p>
                                        <label for="aa">¿Dónde son tus controles?</label>
                                         <input id="lcontroles" name="lcontroles" type="text" />
                                    </p>
                                 </div>
                              <p>
                                <label style="float: none;width:530px">¿Usas algún método anticonceptivo?</label>
                                        <label class="radio">
                                         <input id="conceptivo" type="radio" value="Si" name="conceptivo" onchange="abrirAnt(this.value);" />
                                           Si
                                        </label>
                                    <span style="float:none;">
                                        <label class="radio"  >
                                        <input id="conceptivo" type="radio" value="No" name="conceptivo" onchange="abrirAnt(this.value);"  />
                                            No
                                        </label>
                                    </span>
                            </p>
                            <input type="hidden" name="fndAnt" id="fndAnt" value="0"/>
                                <div id="esconderant">
                                    <p>
                                        <label for="aa">¿Cual?</label>
                                        <select id="Antc" name="newsletter">
                                            <option value="No" selected>Seleccione...</option>
                                            <option value="Preservativo">Preservativo</option>
                                            <option value="Pildora">Píldora</option>
                                            <option value="Inyectable">Inyectable</option>
                                            <option value="DIU">DIU</option>
                                            <option value="Natural">Natural</option>
                                            <option value="Otro">Otro</option>
                                        </select>
                                    </p>
                                 </div>
                            
                            <p>
                                <label  style="float: none;width:530px">Se atiende en:</label>
                                        <label class="radio">
                                         <input id="atencionS" type="radio"  value="MINSA" name="atencionS" />
                                           MINSA
                                        </label>
                                    <span style="float:none;">
                                        <label class="radio"  >
                                        <input id="atencionS" type="radio" value="EsSALUD" name="atencionS"  />
                                            EsSALUD
                                        </label>
                                    </span>
                                       
                                    <span style="float:none;">
                                        <label class="radio"  >
                                        <input id="atencionS" type="radio" value="Particular" name="atencionS"  />
                                            Particular
                                        </label>
                                    </span>
                                        <label class="radio">
                                         <input id="atencionS" type="radio" value="Remedios caceros" name="atencionS" />
                                           Remedios caceros
                                        </label>
                                    <span style="float:none;">
                                        <label class="radio"  >
                                        <input id="atencionS" type="radio" value="Se auto medica" name="atencionS"  />
                                            Se auto medica
                                        </label>
                                    </span>
                            </p>
                        </fieldset>
                         <!-- END  SALUD -->
                         
                          <!--   VIVIENDA -->
                        <fieldset class="step">
                            <legend>Aspectos de Vivienda</legend>
                            <div id="idVi" style="visibility:hidden"> </div>
                            <p >
                                <label style="width:120px;" for="newsletter">Su vivienda es:</label>
                                <select id="vivienda" name="newsletter">
                                    <option value="" selected>Seleccione...</option>
                                    <option value="Propia">Propia</option>
                                    <option value="Alquilada">Alquilada</option>
                                    <option value="Alojamiento">Alojamiento</option>
                                    <option value="Invasion">Invasion</option>
                                    <option value="Familiares y otros">Familiares y otros</option>
                                </select>
                            </p>
                            <p>
                                <label style="width:120px" for="newsletter">Construída de:</label>
                                 <select id="construccion" name="construccion">
                                     <option value="" selected>Seleccione...</option>
                                    <option value="Material Noble">Material Noble</option>
                                    <option value="Adobe y Quincha">Adobe y Quincha</option>
                                    <option value="Esteras">Esteras</option>
                                    <option value="En construcción">En construcción</option>
                                </select>
                            </p>
                            
                            <p style="width: 200px;">
                                <label style="width:120px" for="newsletter">Tiene servicios de:</label>
                                <label class="checkbox" style="width:200px">
                                <input style="width:30px"type="checkbox" value="Agua" name="servicio" id="servicio1">
                                Agua
                                </label>
                                <label class="checkbox" style="width:200px">
                                <input style="width:30px"type="checkbox" value="Desagüe" name="servicio" id="servicio2">
                                Desagüe
                                </label>
                                <label class="checkbox" style="width:200px">
                                <input style="width:30px"type="checkbox" value="Luz" name="servicio" id="servicio3"> 
                                Luz
                                </label>
                                <label class="checkbox" style="width:200px">
                                <input style="width:30px"type="checkbox" value="Alumbrado Público" name="servicio" id="servicio4">
                                Alumbrado Público
                                </label>
                                <label class="checkbox" style="width:200px">
                                <input style="width:30px"type="checkbox" value="Cable" name="servicio" id="servicio5">
                                Cable
                                </label>
                                <label class="checkbox" style="width:200px">
                                <input style="width:30px"type="checkbox" value="Internet" name="servicio" id="servicio6">
                                Internet
                                </label>
                            </p>
                            
                            <p style="width: 200px;">
                                <label style="width:120px" for="newsletter">Tiene:</label>
                                <label class="checkbox" style="width:200px">
                                <input style="width:30px"type="checkbox" value="TV" name="equipos" id="equipo1">
                                TV
                                </label>
                                <label class="checkbox" style="width:200px">
                                <input style="width:30px"type="checkbox" value="Equipo de sonido" name="equipos" id="equipo2">
                                Equipo de sonido
                                </label>
                                <label class="checkbox" style="width:200px">
                                <input style="width:30px"type="checkbox" value="Computadora" name="equipos" id="equipo3">
                                Computadora
                                </label>
                                <label class="checkbox" style="width:200px">
                                <input style="width:30px"type="checkbox" value="Cocina a gas" name="equipos" id="equipo4">
                                Cocina a gas
                                </label>
                                <label class="checkbox" style="width:200px">
                                <input style="width:30px"type="checkbox" value="Refrigerador" name="equipos" id="equipo5">
                                Refrigerador
                                </label>
                                <label class="checkbox" style="width:200px">
                                <input style="width:30px"type="checkbox" value="Microondas" name="equipos" id="equipo6">
                                Microondas
                                </label>
                                <label class="checkbox" style="width:200px">
                                <input style="width:30px"type="checkbox" value="Muebles de sala/comedor" name="equipos" id="equipo7">
                                Muebles de sala/comedor
                                </label>
                                <label class="checkbox" style="width:200px">
                                <input style="width:30px"type="checkbox" value="otros" name="equipos" id="equipo8">
                                otros
                                </label>
                            </p>
                            
                        </fieldset>
                         <!-- END  VIVIEND -->
                         
                         <!--  UNIVERSITARIO -->
                        <fieldset class="step">
                            <legend>Aspectos de Universitario</legend>
                            <div id="idU" style="visibility:hidden"> </div>
                            <p>
                                <label style="float: none;width:530px">¿Desaprobó algún curso?</label>
                                        <label class="radio">
                                         <input id="universidad" type="radio"  value="Si" name="universidad" onchange="abrirU(this.value,this.form);" />
                                           Si
                                        </label>
                                    <span style="float:none;">
                                        <label class="radio"  >
                                        <input id="universidad" type="radio" value="No" name="universidad"  onchange="abrirU(this.value,this.form);" />
                                            No
                                        </label>
                                    </span>
                            </p>
                             <input type="hidden" name="fndUniversidad" id="fndUniversidad" value="0"/>
                             <div id="esconderUniversidad">
                            <p>
                            <label>Total en la carrera</label>
                                        <span class="input-prepend input-append">
                                        <input style="width:20px" type="text" id="tcarrera" class=":span1" placeholder="" />
                                        </span>
                            </p>
                            
                            <p>
                            <label>Pre requisitos</label>
                                        <span class="input-prepend input-append">
                                        <input style="width:20px" type="text" id="pcarrera" class=":span1" placeholder="" />
                                        </span>
                            </p> 
                            
                            <p>
                                <label style="width:120px" for="newsletter">Motivo:</label>
                                <label class="checkbox" style="width:200px">
                                <input style="width:30px"type="checkbox" value="Problema con el Docente" name="motivo" id="motivo_1">
                                Problema con el Docente
                                </label>
                                <label class="checkbox" style="width:200px">
                                <input style="width:30px"type="checkbox" value="Horario" name="motivo" id="motivo_2">
                                Horario
                                </label>
                                <label class="checkbox" style="width:200px">
                                <input style="width:30px"type="checkbox" value="Compañeros" name="motivo" id="motivo_3">
                                Compañeros
                                </label>
                                <label class="checkbox" style="width:200px">
                                <input style="width:30px"type="checkbox" value="Económico" name="motivo" id="motivo_4">
                                Económico
                                </label>
                                <label class="checkbox" style="width:200px">
                                <input style="width:30px"type="checkbox" value="Familiar" name="motivo" id="motivo_5">
                                Familiar
                                </label>
                                <label class="checkbox" style="width:200px">
                                <input style="width:30px"type="checkbox" value="Sentimiental" name="motivo" id="motivo_6">
                                Sentimiental
                                </label>
                                <label class="checkbox" style="width:200px">
                                <input style="width:30px"type="checkbox" value="No me gusta la Carrera" name="motivo" id="motivo_7">
                                No me gusta la Carrera
                                </label>
                                <label class="checkbox" style="width:200px">
                                <input style="width:30px"type="checkbox" value="No entiendo la clase" name="motivo" id="motivo_8">
                                No entiendo la clase
                                </label>
                                 <label class="checkbox" style="width:200px">
                                <input style="width:30px"type="checkbox" value="Temor a Exponer" name="motivo" id="motivo_9">
                                Temor a Exponer
                                </label>
                                 <label class="checkbox" style="width:200px">
                                <input style="width:30px"type="checkbox" value="No me gusta gusta leer" name="motivo" id="motivo_10">
                                No me gusta leer
                                </label>
                            </p>
                            
                             <p style="width:420px">
                                <label style="float: none;width:560px">¿Cómo crees que te podemos ayudar a superar estas dificultades?</label>
                                <textarea style="width: 360px;" id="ayuda" class="input-xlarge" rows="3"></textarea>
                             </p>
                            </div>
                        </fieldset>
                        <!-- END  UNIVERSITARIO -->
			<fieldset class="step">
                            <legend>Guardar Datos</legend>
							<p>
								"Tu has nacido para triunfar, nunca una noche ha vencido
                                                                 al amanecer, y nunca un problema ha vencido a la esperanza"
							</p>
                            <p class="submit">
                                <button id="registerButtonII" type="submit" onclick="guardarFichaII('Guardar');">GUARDAR DATOS Y DESCARGAR COMPROBANTE</button><br/>
                                <span id="cargador">
                                 <img src="images/loading.gif" style="margin-left:40%; margin-top: 5%"/><br/>
                                 <strong>GUARDANDO DATOS ESPERE</strong>
                                </span>
                                <input style="visibility:hidden" type="button" value="Buscar" id="btnbuscar" onClick="location.href='frmComprobante.php'"/>
								
                            </p>
                            <p>
                                <span id="mensajej" class="label label-important">
                                        GUARDAR EL PDF, IMPRIMIR EL COMPROBANTE Y<br/> PRESENTARLO AL MOMENTO DE LA MATRICULA. <br/>GRACIAS<br/><br/><br/>
                                <a class="btn btn-warning" href="#" id='Salir'>SALIR DEL SISTEMA</a>

                                </span>
                            </p>
                        </fieldset>
                    </form>
                </div>
              
            </div>
            </div><!--Inner -->
						 <div id="footer">
					<div class="inner">
					   © 2012 Universidad José Carlos Mariátegui <br />
					   Calle Ayacucho Nº 393. Moquegua - Perú Telf. 461110 Anexo 101 <br />
					   acreditacion.ujcm@gmail.com
					</div>
				</div>
                 </div><!--Todo-->
				
            </div>
        </div>
        <script src="jsshadow/frmFicha.js"></script>
        <script src="jsshadow/frmFichaSelect.js"></script>
     <script src="jsshadow/cerrarSesion.js"></script>
    </body>
</html>
<?php

}
else
	echo "Ud. no est&aacute; autorizado para ver esta p&aacute;gina...";
?>