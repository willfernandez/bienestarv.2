
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
    <script src="jsshadow/frmAnioSelect.js"></script>
    <script src="jsshadow/frmUsuario.js"></script>
    <script src="jsshadow/frmSede.js"></script>
    <script src="jsshadow/frmAnioAca.js"></script>
    <script src="jsshadow/frmCarrera.js"></script>
<script type="text/javascript">
$(function() {
    $('#fini').datepicker({dateFormat: 'yy-mm-dd', changeMonth: true, changeYear: true, yearRange: '-1:+1'});
});
$(function() {
    $('#ffin').datepicker({dateFormat: 'yy-mm-dd', changeMonth: true, changeYear: true, yearRange: '-1:+1'});
});
</script>   
    <style>
        input{
        height: 26px;
        }
        
        h4{
             border-top-color:#1d5987;border-top-style: solid;border-top-width: 3px;
             font-size: 18px;
              line-height: 35px;
        }
        select{
            width: auto;
        }
    </style>
     
</head>

<body> 
    <?php include('includes/menu.php') ?>
 <div class="container" style="margin-top: 60px;">
     <div class="content">
            <div class="page-header">
                    <h1>Configuración</h1>
            </div>

            <h3>Sedes</h3>
            <div class="row">
                    <div class="span3">
                <p>Desde aqui Ud. puede agregar nuevas sedes.</p>
                   <a class="btn btn-success" href="#sede_add"  data-toggle='modal'>Agregar</a>
                </div>
                <div class="span9">
                               <div id="Sedes">             </div>
                    </div>
            </div><!-- end row -->
            
            <h3>Años Académicos</h3>
            <div class="row">
                    <div class="span3">
                <p>Desde aqui Ud. puede agregar nuevos años académicos.</p>
                   <a class="btn btn-success" href="#annio_add" data-toggle='modal'>Agregar</a>
                </div>
                <div class="span9">
                 <div id="Anioss">             </div>
                 </div>
            </div><!-- end row -->

             <h3>Carreras Profesionales</h3>
            <div class="row">
                    <div class="span3">
                <p>Desde aqui Ud. puede agregar nuevas carreras.</p>
                   <a class="btn btn-success" href="#modCarreras" data-toggle='modal' onclick="cargarFacultades();">Agregar</a>
                </div>
                <div class="span9">
                 <div id="Carrerass">             </div>
                 </div>
            </div><!-- end row -->

                <!-- Modal -->
                <div id="myModal" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                        <h3 id="myModalLabel">Años Académicos</h3>
                    </div>
                    <div class="modal-body">
                         <div class="form-title">Oficina de Bienestar Universitario</div>

                         <div id="reg_box"  style="width:470px">
                             <form accept-charset="utf-8" style="width:460px" name="fvalida">
                                <fieldset style="margin-left: 120px;">
                                    <div id="idAnnio" style="visibility:hidden"> </div>
                                    <div class="input text" id="nomAnnio">
                                        
                                    </div>
                            
                                   <div class="input text" id="fechaI">
                                       
                                    </div>
                            
                                    <div class="input text" id="fechaF">
                                      
                                    </div>
                            
                                    <div class="input select">
                                        <label>Activo</label>
                                        <div class="xinput">
                                        <select id="estadoA"  name="modAl" class=":required">
                                        <option value="0">No</option>
                                        <option value="1">Si</option>
                                        </select>
                                        </div>
                                     </div>
                                 </fieldset>
                    
                            </form>
                        </div>
                </div>
                    <div class="modal-footer">
                        <button class="btn" data-dismiss="modal" aria-hidden="true">Close</button>
                        <button class="btn btn-primary"  data-dismiss="modal" onclick="actualizarAnnio();">Actualizar</button>
                    </div>
                </div>


                  <!-- Modal -->
                <div id="modCarreras" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                        <h3 id="myModalLabel">Ingrese los datos de la Nueva carrera</h3>
                    </div>
                    <div class="modal-body">
                         <h4>Oficina de Bienestar Universitario</h4><br/>

                         <div id="reg_box"  style="width:470px">
                             <form accept-charset="utf-8" style="width:460px" name="fvalida">
                                <fieldset style="margin-left: 120px;">
                                    <div  id="facultad"></div>
                                    <input type="hidden" id="idCarrera" />
                                     <label >Nombre de la carrera</label>
                                         <div class="xinput">
                                             <input id="ncarrera" name="ncarrera" type="text" />
                                             <button style="margin-left:5px" class="btn btn-danger" type="button" onclick="guardarCarrera();">Guardar</button>
                                        </div>

                                    <div id="formC"></div>
                                    <div id="nciclos"></div>

                                 </fieldset>
                    
                            </form>
                        </div>
                </div>
                    <div class="modal-footer">
                        <button class="btn" data-dismiss="modal" aria-hidden="true">Close</button>
                        <button class="btn btn-primary"  data-dismiss="modal" onclick="actualizarAnnio();">Guardar</button>
                    </div>
                </div>
                

                 <!-- Modal -->
                <div id="carrera_edit" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                        <h3 id="myModalLabel">Editanto datos</h3>
                    </div>
                    <div class="modal-body">
                         <h4>Oficina de Bienestar Universitario</h4><br/>

                         <div id="reg_box"  style="width:470px">
                             <form accept-charset="utf-8" style="width:460px" name="fvalida">
                                <fieldset style="margin-left: 120px;">
                                    <div  id="facultad_eddit"></div>
                                     <input type="hidden" id="idCarreraedit" />
                                     <label >Nombre de la carrera</label>
                                         <div class="xinput">
                                             <input id="ncarreraedit" name="ncarreraedit" type="text" />
                                        </div>
                                 </fieldset>
                    
                            </form>
                        </div>
                </div>
                    <div class="modal-footer">
                        <button class="btn" data-dismiss="modal" aria-hidden="true">Cerrar</button>
                        <button class="btn btn-primary"  data-dismiss="modal" onclick="editarCarrera();">Guardar</button>
                    </div>
                </div>

                 <!-- Modal -->
                <div id="sede_add" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                        <h3 id="myModalLabel">Ingrese los datos de la Nueva Sede</h3>
                    </div>
                    <div class="modal-body">
                         <h4>Oficina de Bienestar Universitario</h4><br/>

                         <div id="reg_box"  style="width:470px">
                             <form accept-charset="utf-8" style="width:460px" name="fvalida">
                                <fieldset style="margin-left: 120px;">
                                     <label >Nombre de la sede</label>
                                         <div class="xinput">
                                             <input id="nsede" name="nsede" type="text" />
                                        </div>
                                 </fieldset>
                    
                            </form>
                        </div>
                </div>
                    <div class="modal-footer">
                        <button class="btn" data-dismiss="modal" aria-hidden="true">Cerrar</button>
                        <button class="btn btn-primary"  data-dismiss="modal" onclick="guardarSede();">Guardar</button>
                    </div>
                </div>


                <!-- Modal -->
                <div id="annio_add" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                        <h3 id="myModalLabel">Ingrese los datos del nuevo Año Académico</h3>
                    </div>
                    <div class="modal-body">
                         <h4>Oficina de Bienestar Universitario</h4><br/>

                         <div id="reg_box"  style="width:470px">
                             <form accept-charset="utf-8" style="width:460px" name="fvalida">
                                <fieldset style="margin-left: 120px;">
                                    <label >Nombre del Periodo</label>
                                         <div class="xinput">
                                             <input id="nannio" name="nannio" type="text" />
                                        </div>
                                    <label >Fecha de Inicio</label>
                                         <div class="xinput">
                                             <input id="fini" name="fini" type="text" />
                                        </div>
                                        <label >Fecha Final</label>
                                         <div class="xinput">
                                             <input id="ffin" name="ffin" type="text" />
                                        </div>
                                     
                                        <label >¿Habilitado?</label>
                                         <div class="xinput">
                                              <select id="activo" name="activo">
                                                <option value="1" selected>SI</option>
                                                <option value="0">NO</option>
                                          </select>
                                        </div>
                                        

                                 </fieldset>
                    
                            </form>
                        </div>
                </div>
                    <div class="modal-footer">
                        <button class="btn" data-dismiss="modal" aria-hidden="true">Cerrar</button>
                        <button class="btn btn-primary"  data-dismiss="modal" onclick="guardarAnnio();">Guardar</button>
                    </div>
                </div>
    
</div>

     
 </div>

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