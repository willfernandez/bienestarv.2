<?php
    $boton=$_REQUEST['boton'];	
    if($boton=='filtrarCarreras')
	{
            $idFac=$_REQUEST['facultadAl_id'];
            $periodo=$_REQUEST['periodo'];
            $sede = $_REQUEST['sede'];
           
        }
        
        if($boton=='filtrarCarrerasV')
	   {
            $idFac=$_REQUEST['facultadAl_id'];
            $periodo=$_REQUEST['periodo'];
            $sede = $_REQUEST['sede'];
        }
        
        if($boton=='filtrarCarrerasDeu'){
            $idFac=$_REQUEST['facultadAl_id'];
            $periodo=$_REQUEST['periodo'];
            $sede = $_REQUEST['sede'];
        }
        
        if($boton=='filtrarCarrerasEdu'){
            $idFac=$_REQUEST['facultadAl_id'];
            $periodo=$_REQUEST['periodo'];
            $sede = $_REQUEST['sede'];
        }
         if($boton=='filtrarCarrerasSalud'){
            $idFac=$_REQUEST['facultadAl_id'];
            $periodo=$_REQUEST['periodo'];
            $sede = $_REQUEST['sede'];
        }
        if($boton == 'guardarCarrera'){
            $carrera = $_REQUEST['nombreC'];
            $facultad_id = $_REQUEST['facultad_id'];
            $idCar= $_REQUEST['idCar'];
        }
        
     require_once("models/carrera.php");

     require_once("models/annio.php");
	switch($boton)
	{	
            case 'guardarCarrera':
                    if($idCar==0 ){
                    $carreras= new carrera('',htmlentities("$carrera", ENT_QUOTES,"UTF-8"),$facultad_id);

                            $idCar = $carreras->guardar();
                    }else{
                    $carreras= new carrera($idCar,htmlentities("$carrera", ENT_QUOTES,"UTF-8"),$facultad_id);
                    $carreras->actualizar();
                    }
                    echo $idCar;
            break;
            case 'Cargar':
                     $carreras= new carrera('', '', '');
                     $a=$carreras->listar('','c.facultad_id','=','f.id','','','');
                     $na=count($a);
                     if($na>0){
                     $html="<table style='margin-top: 24px;' align='center' class='table table-striped table-bordered dataTable' id='tCarre'>
                                <thead>
                                <tr>
                                    <th>#</th>
                                    <th>SIGLAS</th>
                                    <th>Facultad</th>
                                    <th>Carrera</th>
                                    <th>Acciones</th>
                                </tr>
                                </thead>
                                <tbody>";
                               $c=0;
                                for($i=0;$i<$na;$i++)
                                {   $c++;
                                    $datos = $a[$i][0]."*".$a[$i][1]."*".$a[$i][3];
                                        $html.="<tr>
                                                        <th>$c</th>
                                                        <td>".$a[$i][4]."</td>
                                                        <td>".$a[$i][5]."</td>
                                                        <td>".$a[$i][1]."</td>
                                                        <td>
                                                            <a class='edit' href='#carrera_edit' title='Editar' data-toggle='modal' id='carrera_edit*$datos'>Editar</a>
                                                         </td>
                                                        </tr>";
                                }
                            $html.='</tbody></table><script src="jsshadow/frmCarreraSelect.js"></script>';
                        }
                            echo $html;
                    break;

            case 'filtrarCarreras':
                     require_once("models/familiar.php");
                    $carreras= new carrera('', '', '');
                    $familiar= new familiar('', '', '', '', '', '', '', '');
                    $ann= new annio('', '', '', '', '');
                    $a=$carreras->listarSimple('', 'facultad_id', '=', $idFac, '', '', '');
                    $d=$ann->listarSimple('nombre_anio', 'id', '=', $periodo, '', '', '');
                     if (empty($sede)){
                             $sedeCampo='';
                             $sedeOperador='';
                             $sedeSeparador='';
                              $sedeValor='';
                        }else{
                             $sedeCampo='*m.sede_id';
                             $sedeOperador='*=';
                             $sedeSeparador='*AND';
                             $sedeValor='*'.$sede;
                        }
                     $html="<table  class='table table-striped table-bordered dataTable' id='document'>
                                <thead><tr><th>No</th><th>Carrera</th><th>Periodo</th><th>Total</th><th></th></tr></thead><tbody>";
                    $na=count($a);$c=0;
                                for($i=0;$i<$na;$i++)
                                {	$c++;
                                          $b=$familiar->listarTotal('COUNT(f.`estado_padres`)', 'f.alumno_id*ca.id*a.carrera_id*f.academico_id*f.alumno_id'.$sedeCampo.'*m.annio_id', '=*=*=*=*=*='.$sedeOperador.'*=', 'a.id*a.carrera_id*'.$a[$i][0].'*'.$periodo.'*m.alumno_id'.$sedeValor.'*'.$periodo, 'AND*AND*AND*AND*AND'.$sedeSeparador.'*AND','', '');
                                          //SELECT COUNT(f.`estado_padres`) FROM alumnos AS a, carreras AS ca, familiares AS f   WHERE  f.`alumno_id`=a.`id` AND ca.`id`=a.`carrera_id` AND
                                            //a.carrera_id ='2'AND f.`academico_id` ='1' 
                                          $data=$periodo.'*'.$idFac.'*'.$a[$i][0].'*'.$sede;
                                        $html.="<tr>
                                                                <th>".$c."</th>
                                                                <td>".$a[$i][1]."</td>
                                                                <td>".$d[0][0]."</td>
                                                                <td>".$b[0][0]."</td>
                                                                <td>
                                                                       <a href='#' id='reporte*$data' ><img alt='reportes' src='img/chart_bar.png'> </a> 
                                                                </td>
                                                        </tr>";
                                }
                                $html.="</tbody></table> <script src='jsshadow/frmReporAspcF.js'></script>";
                                echo $html;
                break;
                
                case 'filtrarCarrerasV':
                    require_once("models/violencia.php");
                    $carreras= new carrera('', '', '');
                    $violencia= new violencia('', '', '', '', '', '', '', '', '');
                    $ann= new annio('', '', '', '', '');
                    $a=$carreras->listarSimple('', 'facultad_id', '=', $idFac, '', '', '');
                    $d=$ann->listarSimple('nombre_anio', 'id', '=', $periodo, '', '', '');
                    if (empty($sede)){
                             $sedeCampo='';
                             $sedeOperador='';
                             $sedeSeparador='';
                              $sedeValor='';
                        }else{
                             $sedeCampo='*m.sede_id';
                             $sedeOperador='*=';
                             $sedeSeparador='*AND';
                             $sedeValor='*'.$sede;
                        }

                     $html="<table  class='table table-striped table-bordered dataTable' id='documentov'>
                                <thead><tr><th>No</th><th>Carrera</th><th>Periodo</th><th>Total</th><th></th></tr></thead><tbody>";
                    $na=count($a);$c=0;
                                for($i=0;$i<$na;$i++)
                                {	$c++;
                                          $b=$violencia->listarTotal('COUNT(v.`violencia_familia`)', 'v.alumno_id*ca.id*a.carrera_id*v.academico_id*v.alumno_id'.$sedeCampo.'*m.annio_id', '=*=*=*=*='.$sedeOperador.'*=', 'a.id*a.carrera_id*'.$a[$i][0].'*'.$periodo.'*m.alumno_id'.$sedeValor.'*'.$periodo, 'AND*AND*AND*AND'.$sedeSeparador.'*AND','', '');
                                          //SELECT COUNT(f.`estado_padres`) FROM alumnos AS a, carreras AS ca, familiares AS f   WHERE  f.`alumno_id`=a.`id` AND ca.`id`=a.`carrera_id` AND
                                            //a.carrera_id ='2'AND f.`academico_id` ='1' 
                                          $data=$periodo.'*'.$idFac.'*'.$a[$i][0].'*'.$sede;
                                        $html.="<tr>
                                                                <th>".$c."</th>
                                                                <td>".$a[$i][1]."</td>
                                                                <td>".$d[0][0]."</td>
                                                                <td>".$b[0][0]."</td>
                                                                <td>
                                                                       <a href='#' id='reporteV*$data' ><img alt='reportes' src='img/chart_bar.png'> </a> 
                                                                </td>
                                                        </tr>";
                                }
                                $html.="</tbody></table> <script src='jsshadow/frmViolenciaReporte.js'></script>";
                                echo $html;
                break;
                case 'filtrarCarrerasDeu':
                    require_once("models/deudas.php");
                    $carreras= new carrera('', '', '');
                    $deuda = new deudas('', '', '', '', '', '', '');
                    $ann= new annio('', '', '', '', '');
                    $a=$carreras->listarSimple('', 'facultad_id', '=', $idFac, '', '', '');
                    $d=$ann->listarSimple('nombre_anio', 'id', '=', $periodo, '', '', '');
                  if (empty($sede)){
                             $sedeCampo='';
                             $sedeOperador='';
                             $sedeSeparador='';
                              $sedeValor='';
                        }else{
                             $sedeCampo='*m.sede_id';
                             $sedeOperador='*=';
                             $sedeSeparador='*AND';
                             $sedeValor='*'.$sede;
                        }
                     $html="<table  class='table table-striped table-bordered dataTable' id='documentoD'>
                                <thead><tr><th>No</th><th>Carrera</th><th>Periodo</th><th>Total</th><th></th></tr></thead><tbody>";
                    $na=count($a);$c=0;
                                for($i=0;$i<$na;$i++)
                                {	$c++;
                                          $b=$deuda->listarTotal('COUNT(d.`alumno_id`)', 'd.alumno_id*ca.id*m.carrera_id*d.academico_id*d.alumno_id'.$sedeCampo.'*m.annio_id', '=*=*=*=*='.$sedeOperador.'*=', 'a.id*a.carrera_id*'.$a[$i][0].'*'.$periodo.'*m.alumno_id'.$sedeValor.'*'.$periodo, 'AND*AND*AND*AND'.$sedeSeparador.'*AND','', '');
                                          //SELECT COUNT(f.`estado_padres`) FROM alumnos AS a, carreras AS ca, familiares AS f   WHERE  f.`alumno_id`=a.`id` AND ca.`id`=a.`carrera_id` AND
                                            //a.carrera_id ='2'AND f.`academico_id` ='1' 
                                          $data=$periodo.'*'.$idFac.'*'.$a[$i][0].'*'.$sede;
                                        $html.="<tr>
                                                                <th>".$c."</th>
                                                                <td>".$a[$i][1]."</td>
                                                                <td>".$d[0][0]."</td>
                                                                <td>".$b[0][0]."</td>
                                                                <td>
                                                                       <a href='#' id='reporteD*$data' ><img alt='reportes' src='img/chart_bar.png'> </a> 
                                                                </td>
                                                        </tr>";
                                }
                                $html.="</tbody></table> <script src='jsshadow/frmDeudaReporte.js'></script>";
                                echo $html;
                    
                    break;
                    case 'filtrarCarrerasEdu':
                    require_once("models/educacion.php");
                    $carreras= new carrera('', '', '');
                    $educacion= new educacion('', '', '', '', '', '', '', '', '', '', '', '', '', '', '');
                    $ann= new annio('', '', '', '', '');
                    $a=$carreras->listarSimple('', 'facultad_id', '=', $idFac, '', '', '');
                    $d=$ann->listarSimple('nombre_anio', 'id', '=', $periodo, '', '', '');
                        if (empty($sede)){
                             $sedeCampo='';
                             $sedeOperador='';
                             $sedeSeparador='';
                              $sedeValor='';
                        }else{
                             $sedeCampo='*m.sede_id';
                             $sedeOperador='*=';
                             $sedeSeparador='*AND';
                             $sedeValor='*'.$sede;
                        }
                     $html="<table  class='table table-striped table-bordered dataTable' id='documentoEd'>
                                <thead><tr><th>No</th><th>Carrera</th><th>Periodo</th><th>Total</th><th></th></tr></thead><tbody>";
                    $na=count($a);$c=0;
                                for($i=0;$i<$na;$i++)
                                {	$c++;
                                          $b=$educacion->listarTotal('COUNT(d.`alumno_id`)', 'd.alumno_id*ca.id*m.carrera_id*d.academico_id*d.alumno_id'.$sedeCampo.'*m.annio_id', '=*=*=*=*='.$sedeOperador.'*=', 'a.id*m.carrera_id*'.$a[$i][0].'*'.$periodo.'*m.alumno_id'.$sedeValor.'*'.$periodo, 'AND*AND*AND*AND'.$sedeSeparador.'*AND','', '');
                                          //SELECT COUNT(f.`estado_padres`) FROM alumnos AS a, carreras AS ca, familiares AS f   WHERE  f.`alumno_id`=a.`id` AND ca.`id`=a.`carrera_id` AND
                                            //a.carrera_id ='2'AND f.`academico_id` ='1' 
                                          $data=$periodo.'*'.$idFac.'*'.$a[$i][0].'*'.$sede;
                                        $html.="<tr>
                                                                <th>".$c."</th>
                                                                <td>".$a[$i][1]."</td>
                                                                <td>".$d[0][0]."</td>
                                                                <td>".$b[0][0]."</td>
                                                                <td>
                                                                       <a href='#' id='reporteEdu*$data' ><img alt='reportes' src='img/chart_bar.png'> </a> 
                                                                </td>
                                                        </tr>";
                                }
                                $html.="</tbody></table> <script src='jsshadow/frmEducacionReporte.js'></script>";
                                echo $html;
                    
                    break;
                    
                    
            case 'filtrarCarrerasSalud':
                    require_once("models/salud.php");
                    $carreras= new carrera('', '', '');
                    $salud = new Salud('','','','','','','','','','','','');
                    $ann= new annio('', '', '', '', '');
                    $a=$carreras->listarSimple('', 'facultad_id', '=', $idFac, '', '', '');
                    $d=$ann->listarSimple('nombre_anio', 'id', '=', $periodo, '', '', '');
                 if (empty($sede)){
                             $sedeCampo='';
                             $sedeOperador='';
                             $sedeSeparador='';
                              $sedeValor='';
                        }else{
                             $sedeCampo='*m.sede_id';
                             $sedeOperador='*=';
                             $sedeSeparador='*AND';
                             $sedeValor='*'.$sede;
                        }
                 
                     $html="<table  class='table table-striped table-bordered dataTable' id='documentoEd'>
                                <thead><tr><th>No</th><th>Carrera</th><th>Periodo</th><th>Total</th><th></th></tr></thead><tbody>";
                    $na=count($a);$c=0;
                                for($i=0;$i<$na;$i++)
                                {	$c++;
                                          $b=$salud->listarTotal('COUNT(d.`alumno_id`)', 'd.alumno_id*ca.id*m.carrera_id*d.academico_id*d.alumno_id'.$sedeCampo.'*m.annio_id', '=*=*=*=*='.$sedeOperador.'*=', 'a.id*m.carrera_id*'.$a[$i][0].'*'.$periodo.'*m.alumno_id'.$sedeValor.'*'.$periodo, 'AND*AND*AND*AND'.$sedeSeparador.'*AND','', '');
                                          //SELECT COUNT(f.`estado_padres`) FROM alumnos AS a, carreras AS ca, familiares AS f   WHERE  f.`alumno_id`=a.`id` AND ca.`id`=a.`carrera_id` AND
                                            //a.carrera_id ='2'AND f.`academico_id` ='1' 
                                          $data=$periodo.'*'.$idFac.'*'.$a[$i][0].'*'.$sede;
                                        $html.="<tr>
                                                                <th>".$c."</th>
                                                                <td>".$a[$i][1]."</td>
                                                                <td>".$d[0][0]."</td>
                                                                <td>".$b[0][0]."</td>
                                                                <td>
                                                                       <a href='#' id='reporteSal*$data' ><img alt='reportes' src='img/chart_bar.png'> </a> 
                                                                </td>
                                                        </tr>";
                                }
                                $html.="</tbody></table> <script src='jsshadow/frmSaludReporte.js'></script>";
                                echo $html;
                    
                    break;
        
        }
        
        ?>
