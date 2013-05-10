<?php
    session_start(); 
    $boton=$_REQUEST['boton'];	
    if($boton == 'Listar'){
      $campo=$_REQUEST['campo'];
      $operador=$_REQUEST['operador'];
      $valor=$_REQUEST['valor'];

    }
        if($boton=='Guardar')
	{
            $idAlumno=$_REQUEST['idAlum'];
            $codigo=$_REQUEST['codAl'];
            $dni=$_REQUEST['dniAl'];
            $carrera_id=$_REQUEST['carreraAl_id'];
            $nombres=$_REQUEST['nomAl'];
            $apellidos=$_REQUEST['apeAl'];
            $email=$_REQUEST['emailAl'];
            $modE=$_REQUEST['modAl'];
            $ciclo=$_REQUEST['cicloAl_id'];
            $sede_id=$_REQUEST['sede_id'];
            $annio_id=$_REQUEST['annio_id'];
        }
        if($boton=='Guardarr'){
            $codalum=$_REQUEST['codalum'];
            $carrera_id=$_REQUEST['carreraAl_id'];
            $modE=$_REQUEST['modAl'];
            $ciclo=$_REQUEST['cicloAl_id'];
            $sede_id=$_REQUEST['sede_id'];
            $annio_id=$_REQUEST['annio_id'];
        }
      if($boton=='Detalle'){
          $idAlumno=$_REQUEST['alumno_id'];
      }

      if($boton == 'verFichas'){
        $idAlumno=$_REQUEST['alumno_id'];
      }

      if($boton == 'listDatosGenerales' || $boton == 'listFamiliares' || $boton == 'listViolencia' || $boton == 'listEconomia' || $boton == 'listEducativo' || $boton == 'listSalud' || $boton == 'listVivienda' || $boton == 'listAcademico'){
       $alumno_id=$_REQUEST['idAlumno']; 
       $annio_id = $_REQUEST['annio_id'];
      }

     require_once("models/alumno.php");
     require_once("models/matricula.php");
	switch($boton)
	{
  	case 'Salir':
                       session_destroy();
                       header("Location: frmLogin.php");
                        break;

            
            case 'Guardar':
                           //aca va lo de verificar si esta registrado con elc odigo y el dni                   
                        $alVeri = new alumno('', '', '', '', '', '', '');
                        $b=$alVeri->listarSimple('', 'codigo*dni', '=*=', "$codigo*$dni", "AND", '', '');
                        $nb=count($b);
                        if($nb<1){
                            $alumno= new alumno($idAlumno, $codigo, $dni, $carrera_id, htmlentities("$nombres", ENT_QUOTES,"UTF-8") , htmlentities("$apellidos", ENT_QUOTES,"UTF-8"), $email);
                      			if($idAlumno=="0")
                                {
                      				      $idAlumno=$alumno->guardar();
                                    //GUARDO EN MATRICULA
                                    $matricula = new matricula('', $idAlumno, $carrera_id, $modE, $sede_id, $ciclo, $annio_id);
                                    $matricula->guardar();
                                    header("Location: frmLogin.php");
                                 }
                			      else{
                			             	$alumno->actualizar();
                                }
                        }else{
                            header("Location: frmRegistro.php?error=1");
                        }
                        

                        break;

             case 'Listar':

                 $alumno = new alumno('', '', '', '', '', '', '');
                 $a=$alumno->listar('DISTINCT(a.codigo)*c.nombre_carrera*a.nombres*a.apellidos*s.nombre*a.id', 'c.id*a.id*s.id*'.$campo, '=*=*=*'.$operador, 'a.carrera_id*m.alumno_id*m.sede_id*'.$valor, 'AND*AND*AND', '', '');
                 $na=count($a);
                 if($na>0){

                     $html="<table style='margin-top: 24px;' align='center' class='table table-striped table-bordered dataTable' id='frmalumnos'>
                                <thead><tr><th>No</th><th>Codigo</th><th>Nombres y Apellidos</th><th>Carrera</th><th>Sede</th><th>Acci&oacute;n</th></tr></thead><tbody>";
                               $c=0;
                                for($i=0;$i<$na;$i++)
                                {	$c++;
                                        $data=$a[$i][0].'*'.$a[$i][2].' '.$a[$i][3].'*'.$a[$i][5];
                                        $idAlumno=$a[$i][5];
                                        $html.="<tr>
                                                                <th>$c</th>
                                                                <td>".$a[$i][0]."</td>
                                                                <td>".$a[$i][2]." ".$a[$i][3]."</td>
                                                                <td>".$a[$i][1]."</td>
                                                                <td>".
                                                                      $a[$i][4]
                                                                ."</td><td><a href='#myModal' data-toggle='modal' class='view' title='Ver'   id='Detalle*$data' ></a> <a class='ficha' title='ver ficha'  href='frmDetAlumno.php?idAlumno=$idAlumno' target='_BLANK' > </a> </td>
                                                        </tr>";
                                }
                            $html.="</tbody></table><script src='jsshadow/frmAlumnoSelect.js'></script> ";
                           
                                echo $html;
                    break;
                 }else{
                 echo "no hay nada aca XD";
                 break;}
                      
               case 'Detalle':
                   $alumno = new alumno('', '', '', '', '', '', '');
                 $a=$alumno->listarDetalle('a.dni*a.email*d.direccionA*d.celular*DATE_FORMAT(d.fecha_nacimiento,"%d-%m-%Y")*cic.ciclo*c.nombre_carrera*s.nombre', 'c.id*a.id*s.id*a.id*m.ciclo_id*a.id', '=*=*=*=*=*=', 'a.carrera_id*m.alumno_id*m.sede_id*d.alumno_id*cic.id*'.$idAlumno, 'AND*AND*AND*AND*AND', '', '');
                                                                                                                                        /*SELECT a.`dni`,d.`direccionA`,d.`celular`,d.`fecha_nacimiento`,cic.`ciclo`
                                                                                                                        FROM alumnos AS a , carreras AS c , sedes AS s , matriculas AS m, datogenerales AS d, ciclos AS cic 
                                                                                                                       WHERE c.`id`=a.`carrera_id` AND a.`id`=m.`alumno_id` AND s.`id`=m.`sede_id` 
                                                                                                                        AND a.`id`=d.`alumno_id` AND m.`ciclo_id`=cic.`id`*/
                  $data=$a[0][0].'*'.$a[0][1].'*'.$a[0][2].'*'.$a[0][3].'*'.$a[0][4].'*'.$a[0][5].'*'.$a[0][6].'*'.$a[0][7];
                  echo $data;
               break;

               case 'verFichas':
 
                    $alumno = new alumno('', '', '', '', '', '', '');
                    $a=$alumno->listarFichas('an.nombre_anio*an.id*a.nombres*a.apellidos', 'an.id*m.alumno_id*a.id', '=*=*=', 'm.annio_id*'.$idAlumno.'*m.alumno_id', 'AND*AND', '', '');
                    $na = count($a);
                        $c=0;
                    $html = "<h2>".$a[0][2]." ".$a[0][3]."</h2><br/><table class='table table-striped table-bordered dataTable'>
                                <thead>
                                <tr><th>N°</th><th>Periodo de llenado </th> <th> Acciones </th> </tr>
                                </thead>
                                <tbody>";
                            for($i=0;$i<$na;$i++){
                                $datos=$idAlumno.'*'.$a[$i][1].'*'.$a[$i][0];
                    $c++;
                    $html.= " <tr><th>".$c."</th><td>".$a[$i][0]."</td><td><a href='#' class='view' title='Ver' id='listDatosGenerales*$datos' ></a></td>
                                    </tr>";

                            }
                    $html.="</tbody>
                            </table><script src='jsshadow/frmAlumnoSelect.js'></script>";
                    echo $html;
               break;

               case 'listDatosGenerales':
               require_once("models/datoGenerales.php");
                     $datos = new datoGenerales('', '', '', '', '', '', '','');
                     $a=$datos->listarSimple('id,alumno_id,departamento_id,provincia_id,direccionA,celular,DATE_FORMAT(fecha_nacimiento,"%d-%m-%Y")', 'alumno_id*academico_id', '=*=', $alumno_id.'*'.$annio_id, 'AND', '', '');
                     $na=count($a);
                     $html = "<div class='span8' style='margin-left:70px'><h3>Datos Generales</h3><table class='table table-hover' style='margin-top:20pxss'>
                                <tbody>";
                   for($i=0;$i<$na;$i++)
                    { 
                      $html.="<tr><th>Fecha de Nacimiento</th><th>:</th><td>".$a[$i][6]."</td></tr>";  
                      $html.="<tr><th>Departamento</th><th>:</th><td>".$a[$i][2]."</td></tr>";
                      $html.="<tr><th>Provincia</th><th>:</th><td>".$a[$i][3]."</td></tr>";
                      $html.="<tr><th>Dirección Actual</th><th>:</th><td>".$a[$i][4]."</td></tr>";
                      $html.="<tr><th>Celular</th><th>:</th><td>".$a[$i][5]."</td></tr>";
                      
                    }

                    $html.="</tbody></table></div>";
                    echo $html;
               break;

               case 'listFamiliares':
               require_once("models/familiar.php");
                     $familiar= new familiar('', '', '', '', '', '', '', '');
                     $a=$familiar->listarSimple('', 'alumno_id*academico_id', '=*=', $alumno_id.'*'.$annio_id, 'AND', '', '');
                     $na=count($a);
                     $html = "<div class='span8' id='listadoFamiliares' style='margin-left:70px'><h3>Aspecto Familiar</h3><table class='table table-hover' style='margin-top:20pxss'>
                                <tbody>";
                   for($i=0;$i<$na;$i++)
                    { 
                      $html.="<tr><th>Estado de los Padres</th><th>:</th><td>".$a[$i][2]."</td></tr>";  
                      $html.="<tr><th>Estado del Hijo</th><th>:</th><td>".$a[$i][3]."</td></tr>";
                      $html.="<tr><th>Número de Hermanos Dependientes</th><th>:</th><td>".$a[$i][4]."</td></tr>";
                      $html.="<tr><th>Número de Hermanos Independientes</th><th>:</th><td>".$a[$i][5]."</td></tr>";
                      $html.="<tr><th>Número de Hijo</th><th>:</th><td>".$a[$i][6]."</td></tr>";
                    }
                    $html.="</tbody></table></div>";
                    echo $html;
               break;
               
                case 'listViolencia':
               require_once("models/violencia.php");
                     $violencia= new violencia('', '', '', '', '', '', '', '', '');
                     $a=$violencia->listarSimple('', 'alumno_id*academico_id', '=*=', $alumno_id.'*'.$annio_id, 'AND', '', '');
                     $na=count($a);
                     $html = "<div class='span8' style='margin-left:70px'><h3>Aspecto Convivencia</h3><table class='table table-hover' style='margin-top:20pxss'>
                                <tbody>";
                   for($i=0;$i<$na;$i++)
                    { 
                      $html.="<tr><th>Ud. vive con</th><th>:</th><td>".$a[$i][2]."</td></tr>";  
                      $html.="<tr><th>Relacion Familiar</th><th>:</th><td>".$a[$i][3]."</td></tr>";
                      $html.="<tr><th>¿Ha observado violencia en su hogar?</th><th>:</th><td>".$a[$i][4]."</td></tr>";
                      $html.="<tr><th>Maltrato Físico</th><th>:</th><td>".$a[$i][5]."</td></tr>";
                      $html.="<tr><th>Maltrato Psicológico</th><th>:</th><td>".$a[$i][6]."</td></tr>";
                      $html.="<tr><th>Razón</th><th>:</th><td>".$a[$i][7]."</td></tr>";
                    }
                    $html.="</tbody></table></div>";
                    echo $html;
               break;

               case 'listEconomia':
               require_once("models/economia.php");
                     $economia = new economia('', '', '', '', '', '', '','');
                     $a=$economia->listarSimple('', 'alumno_id*academico_id', '=*=', $alumno_id."*".$annio_id, 'AND', '', '');
                     $na=count($a);
                     $html = "<div class='span8' style='margin-left:70px'><h3>Aspecto Economia</h3><table class='table table-hover' style='margin-top:20pxss'>
                                <tbody>";
                   for($i=0;$i<$na;$i++)
                    { 
                      $html.="<tr><th>Dependencia Económica</th><th>:</th><td>".$a[$i][2]."</td></tr>";  
                      $html.="<tr><th>Parentesco</th><th>:</th><td>".$a[$i][3]."</td></tr>";
                      $html.="<tr><th>Edad</th><th>:</th><td>".$a[$i][4]."</td></tr>";
                      $html.="<tr><th>Ocupación</th><th>:</th><td>".$a[$i][5]."</td></tr>";
                      $html.="<tr><th>Ingreso</th><th>:</th><td>".$a[$i][6]."</td></tr>";
                    }
                    $html.="</tbody></table></div>";
                    echo $html;
               break;

               case 'listEducativo':
               require_once("models/educacion.php");
                     $educacion= new educacion('', '', '', '', '', '', '', '', '', '', '', '', '', '', '');
                     $a=$educacion->listarSimple('', 'alumno_id*academico_id', '=*=', $alumno_id."*".$annio_id, 'AND', '', '');
                     $na=count($a);
                     $html = "<div class='span8' style='margin-left:70px'><h3>Aspecto Economia</h3><table class='table table-hover' style='margin-top:20pxss'>
                                <tbody>";
                   for($i=0;$i<$na;$i++)
                    { 
                      $html.="<tr><th>Tipo del Colegio</th><th>:</th><td>".$a[$i][2]."</td></tr>";  
                      $html.="<tr><th>Nombre</th><th>:</th><td>".$a[$i][3]."</td></tr>";
                      $html.="<tr><th>Ubicación</th><th>:</th><td>".$a[$i][4]."</td></tr>";
                      $html.="<tr><th>Carrera Técnica</th><th>:</th><td>".$a[$i][5]."</td></tr>";
                      $html.="<tr><th>Anterior Carrera</th><th>:</th><td>".$a[$i][6]."</td></tr>";
                      $html.="<tr><th>Actividad Académica</th><th>:</th><td>".$a[$i][7]."</td></tr>";
                      $html.="<tr><th>Actividad Deportiva</th><th>:</th><td>".$a[$i][8]."</td></tr>";
                      $html.="<tr><th>¿Estudió en academias?</th><th>:</th><td>".$a[$i][9]."</td></tr>";
                      $html.="<tr><th>Nombre de la academia</th><th>:</th><td>".$a[$i][10]."</td></tr>";
                      $html.="<tr><th>Tiempo en la académia</th><th>:</th><td>".$a[$i][11]."</td></tr>";
                      $html.="<tr><th>Número de intentos de ingreso</th><th>:</th><td>".$a[$i][12]."</td></tr>";
                      $html.="<tr><th>Carrera a la que postuló antes</th><th>:</th><td>".$a[$i][13]."</td></tr>";
                    }
                    $html.="</tbody></table></div>";
                    echo $html;
               break;

               case 'listSalud':
               require_once("models/salud.php");
                    $salud= new Salud('', '', '', '', '', '','','','','','','');
                     $a=$salud->listarSimple('', 'alumno_id*academico_id', '=*=', $alumno_id."*".$annio_id, 'AND', '', '');
                     $na=count($a);
                     $html = "<div class='span8' style='margin-left:70px'><h3>Aspecto Salud</h3><table class='table table-hover' style='margin-top:20pxss'>
                                <tbody>";
                   for($i=0;$i<$na;$i++)
                    { 
                      $html.="<tr><th>Padece alguna enfermedad</th><th>:</th><td>".$a[$i][2]."</td></tr>";  
                      $html.="<tr><th>Nombre de la enfermedad</th><th>:</th><td>".$a[$i][3]."</td></tr>";
                      $html.="<tr><th>Centro de Salud</th><th>:</th><td>".$a[$i][4]."</td></tr>";
                      $html.="<tr><th>¿Embarazo?</th><th>:</th><td>".$a[$i][6]."</td></tr>";
                      $html.="<tr><th>Tiempo de embarazo</th><th>:</th><td>".$a[$i][7]."</td></tr>";
                      $html.="<tr><th>Fecha de Parto</th><th>:</th><td>".$a[$i][8]."</td></tr>";
                      $html.="<tr><th>Lugar de control</th><th>:</th><td>".$a[$i][9]."</td></tr>";
                      $html.="<tr><th>¿Usa un método anticonceptivo?</th><th>:</th><td>".$a[$i][10]."</td></tr>";
                      $html.="<tr><th>¿Cúal?</th><th>:</th><td>".$a[$i][11]."</td></tr>";
                    }
                    $html.="</tbody></table></div>";
                    echo $html;
               break;

                case 'listVivienda':
                    require_once("models/vivienda.php");
                    $vivienda = new Vivienda('', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '');
                     $a=$vivienda->listarSimple('', 'alumno_id*academico_id', '=*=', $alumno_id."*".$annio_id, 'AND', '', '');
                     $na=count($a);
                     $html = "<div class='span8' style='margin-left:70px'><h3>Aspecto Vivienda</h3><table class='table table-hover' style='margin-top:20pxss'>
                                <tbody>";
                   for($i=0;$i<$na;$i++)
                    { 
                      $html.="<tr><th>Estado de la casa</th><th>:</th><td>".$a[$i][2]."</td></tr>";  
                      $html.="<tr><th>Construída de</th><th>:</th><td>".$a[$i][3]."</td></tr>";
                      $html.="<tr><th>Tiene los Servicios de</th><th>:</th><td>".$a[$i][4]."</td></tr>";
                      $html.="<tr><th></th><th></th><td>".$a[$i][5]."</td></tr>";
                      $html.="<tr><th></th><th></th><td>".$a[$i][6]."</td></tr>";
                      $html.="<tr><th></th><th></th><td>".$a[$i][7]."</td></tr>";
                      $html.="<tr><th></th><th></th><td>".$a[$i][8]."</td></tr>";
                      $html.="<tr><th></th><th></th><td>".$a[$i][9]."</td></tr>";
                      $html.="<tr><th>Tiene</th><th>:</th><td>".$a[$i][10]."</td></tr>";
                      $html.="<tr><th></th><th></th><td>".$a[$i][11]."</td></tr>";
                      $html.="<tr><th></th><th></th><td>".$a[$i][12]."</td></tr>";
                      $html.="<tr><th></th><th></th><td>".$a[$i][13]."</td></tr>";
                      $html.="<tr><th></th><th></th><td>".$a[$i][14]."</td></tr>";
                      $html.="<tr><th></th><th></th><td>".$a[$i][15]."</td></tr>";
                      $html.="<tr><th></th><th></th><td>".$a[$i][16]."</td></tr>";
                      $html.="<tr><th></th><th></th><td>".$a[$i][17]."</td></tr>";
                    }
                    $html.="</tbody></table></div>";
                    echo $html;
                   break;

                case 'listAcademico':
                     require_once("models/academico.php");
                      $academico= new Academico('', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '','');
                     $a=$academico->listarSimple('', 'alumno_id*academico_id', '=*=', $alumno_id."*".$annio_id, 'AND', '', '');
                     $na=count($a);
                     $html = "<div class='span8' style='margin-left:70px'><h3>Aspecto Académico Universitario</h3><table class='table table-hover' style='margin-top:20pxss'>
                                <tbody>";
                   for($i=0;$i<$na;$i++)
                    { 
                      $html.="<tr><th>Desaprobó un curso</th><th>:</th><td>".$a[$i][2]."</td></tr>";  
                      $html.="<tr><th>Número de desaprobados</th><th>:</th><td>".$a[$i][3]."</td></tr>";
                      $html.="<tr><th>Pre-requisitos</th><th>:</th><td>".$a[$i][4]."</td></tr>";
                      $html.="<tr><th>Motivos</th><th>:</th><td></td></tr>";
                      if($a[$i][5] != 'No'){
                      $html.="<tr><th></th><th></th><td>".$a[$i][5]."</td></tr>";
                      }
                      if($a[$i][6] != 'No'){
                      $html.="<tr><th></th><th></th><td>".$a[$i][6]."</td></tr>";
                      }
                      if($a[$i][7] != 'No'){
                      $html.="<tr><th></th><th></th><td>".$a[$i][7]."</td></tr>";
                      }
                      if($a[$i][8] != 'No'){
                      $html.="<tr><th></th><th></th><td>".$a[$i][8]."</td></tr>";
                      }
                      if($a[$i][9] != 'No'){
                      $html.="<tr><th></th><th></th><td>".$a[$i][9]."</td></tr>";
                      }
                      if($a[$i][10] != 'No'){
                      $html.="<tr><th></th><th></th><td>".$a[$i][10]."</td></tr>";
                      }
                      if($a[$i][11] != 'No'){
                      $html.="<tr><th></th><th></th><td>".$a[$i][11]."</td></tr>";
                      }
                      if($a[$i][12] != 'No'){
                      $html.="<tr><th></th><th></th><td>".$a[$i][12]."</td></tr>";
                      }
                      if($a[$i][13] != 'No'){
                      $html.="<tr><th></th><th></th><td>".$a[$i][13]."</td></tr>";
                      }
                      if($a[$i][14] != 'No'){
                      $html.="<tr><th></th><th></th><td>".$a[$i][14]."</td></tr>";
                      }
                      $html.="<tr><th>Opinión Personal</th><th>:</th><td>".$a[$i][15]."</td></tr>";
                    }
                    $html.="</tbody></table></div>";
                    echo $html;
                   break;

               

        }
?>

