<?php
      session_start();
    $boton=$_REQUEST['boton'];	
    if($boton=='Guardar')
	{
            $idFam=$_REQUEST['idFam'];
            $padresSA=$_REQUEST['padresSA'];
            $huerfano=$_REQUEST['huerfano'];
            $num_hijo=$_REQUEST['num_hijo'];
            $num_dependiente=$_REQUEST['num_dependiente'];
            $num_independiente=$_REQUEST['num_independiente'];
        }
     if($boton=='BuscarSedePeriodo')
          {
            $sede=$_REQUEST['sede'];
            $periodo=$_REQUEST['periodo'];
          }
     if($boton=='BuscarPeriodo'  )
         {
            $sede=$_REQUEST['sede'];
            $periodo=$_REQUEST['periodo'];
            $carrera=$_REQUEST['carrera'];
            $ciclo=$_REQUEST['ciclo'];
           
         }
         
         if($boton=='BuscarPeriodoAlumnado')
         {
            $sede=$_REQUEST['sede'];
            $periodo=$_REQUEST['periodo'];
            $carrera=$_REQUEST['carrera'];
            $ciclo=$_REQUEST['ciclo'];
             $campo=$_REQUEST['campo'];
         }
         
         if($boton=='BuscarPeriodoSE')
         {
            $sede=$_REQUEST['sede'];
            $periodo=$_REQUEST['periodo'];
            $periodo=$_REQUEST['periodo'];
            $carrera=$_REQUEST['carrera'];
            $ciclo=$_REQUEST['ciclo'];
         }
        
        
     require_once("models/familiar.php");
	switch($boton)
	{	case 'Guardar':
                        $alumno_id=$_SESSION['id'];
                        $año=$_SESSION['año'];

                        $familiar = new familiar($idFam, $alumno_id, $padresSA, htmlentities("$huerfano", ENT_QUOTES,"UTF-8"), $num_hijo, $num_dependiente, $num_independiente,$año);
			if($idFam==' ')
				$idFam=$familiar->guardar();
			else
				$familiar->actualizar();
			echo $idFam;
			break;
                        
                    case 'BuscarSedePeriodo':
                        // INGRESO LA SEDE Y TAMBIEN EL PERIODO PERIODO (AMBOS DISTINTO DE CONSOLIDADO)
                         $sitPadres='Casados*Convivientes*Divorciados*Separados';
                         $familiar= new familiar('', '', '', '', '', '', '', '');
                        $totalSalud=$familiar->listarPeriodo(' COUNT(f.estado_padres)*s.nombre*a.nombre_anio', 'f.academico_id*f.alumno_id*m.sede_id*m.sede_id*f.academico_id', '=*=*=*=*=', $periodo.'*m.alumno_id*'.$sede.'*s.id*a.id', 'AND*AND*AND*AND', '', '');
                        /*
                                                                                    * SELECT COUNT(f.estado_padres),s.`nombre`,a.`nombre_anio` FROM familiares AS f, matriculas AS m, sedes AS s, anioacademicos AS a
                                                                                    WHERE f.`academico_id`='1' AND f.`alumno_id`=m.`alumno_id` AND m.`sede_id`='1' AND m.`sede_id`=s.`id`
                                                                                    AND f.`academico_id`=a.`id`
                         */
                                           $cm=explode("*",$sitPadres);
                                           $ncm=count($cm);
                                           $html='';
                                            $k=0;
                                                for($j=0;$j<$ncm;$j++)
                                                    {

                                                        $a=$familiar->listar(' COUNT(f.estado_padres)', 'f.academico_id*f.alumno_id*m.sede_id*f.estado_padres', '=*=*=*=', $periodo.'*m.alumno_id*'.$sede.'*'.$cm[$j], 'AND*AND*AND', '', '');

                                                            $html.=$a[0][0];
                                                                if($k < count($cm)-1){
                                                                    $html.='*';
                                                                }
                                                                $k++;                                      
                                                    }

                                                $html.='*'.$totalSalud[0][0].'*'.$totalSalud[0][1].'*'.$totalSalud[0][2];
                                        echo $html;
                                        
                                        
                      break;
                      /// BUSCAR POR Sede-PERIODO SITUACION ACTUAL DEL ESTUDIANTE
                       case 'BuscarSedePeriodoSE':
                        // INGRESO LA SEDE Y TAMBIEN EL PERIODO PERIODO (AMBOS DISTINTO DE CONSOLIDADO)
                        $huerfano='Hu&eacute;rfano de padre*Hu&eacute;rfano de madre*Hu&eacute;rfano de ambos*"N.A"';
                         $familiar= new familiar('', '', '', '', '', '', '', '');
                        $totalSalud=$familiar->listarPeriodo(' COUNT(f.estado_padres)*s.nombre*a.nombre_anio', 'f.academico_id*f.alumno_id*m.sede_id*m.sede_id*f.academico_id', '=*=*=*=*=', $periodo.'*m.alumno_id*'.$sede.'*s.id*a.id', 'AND*AND*AND*AND', '', '');
                        /*
                                                                                    * SELECT COUNT(f.estado_padres),s.`nombre`,a.`nombre_anio` FROM familiares AS f, matriculas AS m, sedes AS s, anioacademicos AS a
                                                                                    WHERE f.`academico_id`='1' AND f.`alumno_id`=m.`alumno_id` AND m.`sede_id`='1' AND m.`sede_id`=s.`id`
                                                                                    AND f.`academico_id`=a.`id`
                         */
                                           $cm=explode("*",$sitPadres);
                                           $ncm=count($cm);
                                           $html='';
                                            $k=0;
                                                for($j=0;$j<$ncm;$j++)
                                                    {

                                                        $a=$familiar->listar(' COUNT(f.estado_padres)', 'f.academico_id*f.alumno_id*m.sede_id*f.estado_padres', '=*=*=*=', $periodo.'*m.alumno_id*'.$sede.'*'.$cm[$j], 'AND*AND*AND', '', '');

                                                            $html.=$a[0][0];
                                                                if($k < count($cm)-1){
                                                                    $html.='*';
                                                                }
                                                                $k++;                                      
                                                    }

                                                $html.='*'.$totalSalud[0][0].'*'.$totalSalud[0][1].'*'.$totalSalud[0][2];
                                        echo $html;
                                        
                                        
                      break;
                      
                      case 'BuscarPeriodo':
                        //INGRESO EL PERIODO , LA SEDE ES CONSOLIDADO
                         $sitPadres='Casados*Convivientes*Divorciados*Separados';
                         $familiar= new familiar('', '', '', '', '', '', '', '');
                          
                        if ($sede==0){
                             $sedeCampo='';
                             $sedeOperador='';
                             $sedeSeparador='';
                              $sedeValor='';
                        }else
                        {
                             $sedeCampo='*m.sede_id';
                             $sedeOperador='*=';
                             $sedeSeparador='*AND';
                             $sedeValor='*'.$sede;
                        }
                         if($ciclo != '0'){
                             $cicloCampo='*m.ciclo_id';
                             $cicloOperador='*=';
                             $cicloSeparador='*AND';
                             $cicloValor='*'.$ciclo;
                         }else{
                              $cicloCampo='';
                             $cicloOperador='';
                             $cicloSeparador='';
                             $cicloValor='';
                         }
                        $totalSalud=$familiar->listarPeriodo('COUNT(f.estado_padres)*a.nombre_anio*ca.nombre_carrera*s.nombre,fac.nombreFacult', 'al.id*al.carrera_id*m.alumno_id*m.sede_id*m.annio_id*a.id*ca.id*ca.facultad_id'.$cicloCampo.$sedeCampo.'*f.academico_id', '=*=*=*=*=*=*=*='.$cicloOperador.$sedeOperador.'*=', 'f.alumno_id*ca.id*al.id*s.id*a.id*'.$periodo.'*'.$carrera.'*fac.id'.$cicloValor.$sedeValor.'*'.$periodo, 'AND*AND*AND*AND*AND*AND*AND'.$cicloSeparador.$sedeSeparador.'*AND', '', '');
                        /*
                                                                                    * SELECT COUNT(f.estado_padres),s.`nombre`,a.`nombre_anio` FROM familiares AS f, matriculas AS m, sedes AS s, anioacademicos AS a
                                                                                    WHERE f.`academico_id`='1' AND f.`alumno_id`=m.`alumno_id` AND m.`sede_id`='1' AND m.`sede_id`=s.`id`  AND f.`academico_id`=a.`id`AND m.`sede_id`='2'
                         * 
                                                                                                                                                        * SELECT COUNT(fa.`estado_padres`),ca.`nombre_carrera`,s.`nombre` FROM alumnos AS a , familiares AS fa , carreras AS ca, matriculas AS ma, sedes AS s, anioacademicos AS ann
                                                                                                                                                            WHERE a.`id`=fa.`alumno_id` AND a.`carrera_id`=ca.`id` AND ma.`alumno_id`=a.`id` AND ma.`sede_id`=s.`id` AND ma.`annio_id`=ann.`id` 
                                                                                                                                                            AND ann.id='1' AND ca.`id`='1'  AND ma.`sede_id`='2' 
                         */
                                           $cm=explode("*",$sitPadres);
                                           $ncm=count($cm);
                                           $html='';
                                            $k=0;
                                                for($j=0;$j<$ncm;$j++)
                                                    {

                                                        $a=$familiar->listarPeriodo(' COUNT(f.estado_padres)', 'al.id*al.carrera_id*m.alumno_id*m.sede_id*m.annio_id*a.id*ca.id*f.estado_padres*ca.facultad_id'.$cicloCampo.$sedeCampo.'*f.academico_id', '=*=*=*=*=*=*=*=*='.$cicloOperador.$sedeOperador.'*=', 'f.alumno_id*ca.id*al.id*s.id*a.id*'.$periodo.'*'.$carrera.'*'.$cm[$j].'*fac.id'.$cicloValor.$sedeValor.'*'.$periodo, 'AND*AND*AND*AND*AND*AND*AND*AND'.$cicloSeparador.$sedeSeparador.'*AND', '', '');
                                                            $html.=$a[0][0];
                                                                if($k < count($cm)-1){
                                                                    $html.='*';
                                                                }
                                                                $k++;                                      
                                                    }

                                                $html.='*'.$totalSalud[0][0].'*'.$totalSalud[0][3].'*'.$totalSalud[0][1].'*'.$totalSalud[0][2].'*'.$totalSalud[0][4];
                                        echo $html;
                                        
                                        
                      break;
                      
                      case 'BuscarPeriodoAlumnado':
                        //INGRESO EL PERIODO , LA SEDE ES CONSOLIDADO
                              if($campo=='estado_padres'){
                                     $sitPadres='Casados*Convivientes*Divorciados*Separados';
                              }
                              if($campo=='estado_hijo'){
                                  $sitPadres='Hu&eacute;rfano de padre*Hu&eacute;rfano de madre*Hu&eacute;rfano de ambos*"N.A"';
                              }
                         $familiar= new familiar('', '', '', '', '', '', '', '');
                         if ($sede==0){
                             $sedeCampo='';
                             $sedeOperador='';
                             $sedeSeparador='';
                              $sedeValor='';
                        }else
                        {
                             $sedeCampo='*m.sede_id';
                             $sedeOperador='*=';
                             $sedeSeparador='*AND';
                             $sedeValor='*'.$sede;
                        }
                         if($ciclo != '0'){
                             $cicloCampo='*m.ciclo_id';
                             $cicloOperador='*=';
                             $cicloSeparador='*AND';
                             $cicloValor='*'.$ciclo;
                         }
                         else{
                             $cicloCampo='';
                             $cicloOperador='';
                             $cicloSeparador='';
                             $cicloValor='';
                         }
                        
                                           $cm=explode("*",$sitPadres);
                                           $ncm=count($cm);
                                           $c=0;
                                             if($campo=='estado_padres'){
                                                       $html="<table style='margin-top: 24px;' align='center' class='table table-striped table-bordered dataTable' id='tabAlumnado'>
                                                    <thead><tr><th>N°</th><th>Codigo</th><th>Nombres y Apellidos</th><th>Padres</th><th>Modalidad de Estudio</th><th></th></tr></thead><tbody>";
                                                }
                                            if($campo=='estado_hijo'){
                                                  $html="<table style='margin-top: 24px;' align='center' class='table table-striped table-bordered dataTable' id='tabAlumnadoSE'>
                                                    <thead><tr><th>N°  </th><th>Codigo</th><th>Nombres y Apellidos</th><th>situacion del alumno</th><th>Modalidad de Estudio</th><th></th></tr></thead><tbody>";
                                            }
                                          
                                            $k=0;
                                                for($j=0;$j<$ncm;$j++)
                                                    {

                                                        $a=$familiar->listarPeriodo('al.`codigo`*al.`nombres`*al.`apellidos`*f.`'.$campo.'`*m.`modalidadEstudio`*al.id', 'al.id*al.carrera_id*m.alumno_id*m.sede_id*m.annio_id*a.id*ca.id*f.'.$campo.'*ca.facultad_id'.$cicloCampo.$sedeCampo.'*f.academico_id', '=*=*=*=*=*=*=*=*='.$cicloOperador.$sedeOperador.'*=', 'f.alumno_id*ca.id*al.id*s.id*a.id*'.$periodo.'*'.$carrera.'*'.$cm[$j].'*fac.id'.$cicloValor.$sedeValor.'*'.$periodo, 'AND*AND*AND*AND*AND*AND*AND*AND'.$cicloSeparador.$sedeSeparador.'*AND', '', '');
                                                         $na=count($a);
                                                         for($i=0;$i<$na;$i++){
                                                             $c++;
                                                             $data=$a[$i][0].'*'.$a[$i][1].' '.$a[$i][2].'*'.$a[$i][5];
                                                            $html.="<tr>
                                                                <th>$c </th>
                                                                <td>".$a[$i][0]."</td>
                                                                <td>".$a[$i][1]." ".$a[$i][2]."</td>
                                                               <td>".$a[$i][3]."</td>
                                                                <td>".$a[$i][4]."</td>
                                                                <td><a href='#myModal' data-toggle='modal'  id='Detalle*$data' >Ver </a></td>
                                                        </tr>";     
                                                         }
                                                    }
                                                $html.="</tbody></table>";
                                                $html.="<script>  $('a').click(function()
                                        {
                                            var aa=$(this)[0].id
                                               var a=aa.split('*');
                                                var accion=a[0];
                                                if(accion=='Detalle')
                                                {
                                                    $('#NomAl').html(a[2]);
                                                    $('#codAL').html(a[1]);
                                                    var datos = 'alumno_id='+a[3]+'&boton=Detalle';
                                                    $.ajax({
                                                            type: 'POST',
                                                            url: 'cAlumno.php',
                                                            data: datos,
                                                             success: function(html)
                                                                    {
                                                                     var b=html.split('*');
                                                                     var div='<h3>Información personal</h3>';
                                                                     div+='<strong>Dirección:  </strong>'+b[2] +'<br/><br/>';
                                                                     div+='<strong>DNI:  </strong>'+b[0] +'<br/><br/>';
                                                                     div+='<strong>E-mail:  </strong>'+b[1] +'<br/><br/>';
                                                                     div+='<strong>Teléfono/celular:  </strong>'+b[3] +'<br/><br/>';
                                                                     div+='<strong>Fecha de Nacimiento:  </strong>'+b[4] +'<br/><br/>';
                                                                     div+='<h4 style='+'border-top-color:#1d5987;border-top-style: solid;border-top-width: 3px'+' >Información académica</h4>';
                                                                     div+='<strong>Sede:  </strong>'+b[7]+'<br/><br/>';
                                                                     div+='<strong>Carrera:  </strong>'+b[6]+'<br/><br/>';
                                                                     div+='<strong>Ciclo:  </strong>'+b[5]+'<br/><br/>';
                                                                     
                                                                     $('#informacion').html(div);
                                                                    }
                                                     });
                                                }
                                 });
                                  </script>";
                                        echo $html;
                         
                                        
                                        
                      break;
                      
                      /// BUSCAR POR PERIODO SITUACION ACTUAL DEL ESTUDIANTE
                      case 'BuscarPeriodoSE':
                        ////INGRESO EL PERIODO , LA SEDE ES CONSOLIDADO
                         $huerfano='Hu&eacute;rfano de padre*Hu&eacute;rfano de madre*Hu&eacute;rfano de ambos*"N.A"';
                         $familiar= new familiar('', '', '', '', '', '', '', '');
                          if ($sede==0){
                             $sedeCampo='';
                             $sedeOperador='';
                             $sedeSeparador='';
                              $sedeValor='';
                        }else
                        {
                             $sedeCampo='*m.sede_id';
                             $sedeOperador='*=';
                             $sedeSeparador='*AND';
                             $sedeValor='*'.$sede;
                        }
                          if($ciclo != '0'){
                             $cicloCampo='*m.ciclo_id';
                             $cicloOperador='*=';
                             $cicloSeparador='*AND';
                             $cicloValor='*'.$ciclo;
                         }else{
                              $cicloCampo='';
                             $cicloOperador='';
                             $cicloSeparador='';
                             $cicloValor='';
                         }
                        $total=$familiar->listarPeriodo(' COUNT(f.estado_hijo)*a.nombre_anio*ca.nombre_carrera*s.nombre,fac.nombreFacult', 'al.id*al.carrera_id*m.alumno_id*m.sede_id*m.annio_id*a.id*ca.id*ca.facultad_id'.$cicloCampo.$sedeCampo.'*f.academico_id', '=*=*=*=*=*=*=*='.$cicloOperador.$sedeOperador.'*=', 'f.alumno_id*ca.id*al.id*s.id*a.id*'.$periodo.'*'.$carrera.'*fac.id'.$cicloValor.$sedeValor.'*'.$periodo, 'AND*AND*AND*AND*AND*AND*AND'.$cicloSeparador.$sedeSeparador.'*AND', '', '');
                        /*
                                                                                    * SELECT COUNT(f.estado_hijo),s.`nombre`,a.`nombre_anio` FROM familiares AS f, matriculas AS m, sedes AS s, anioacademicos AS a
                                                                                    WHERE f.`academico_id`='1' AND f.`alumno_id`=m.`alumno_id` AND m.`sede_id`='1' AND m.`sede_id`=s.`id`  AND f.`academico_id`=a.`id`
                         */
                                           $cm=explode("*",$huerfano);
                                           $ncm=count($cm);
                                           $html='';
                                            $k=0;
                                                for($j=0;$j<$ncm;$j++)
                                                    {

                                                        $a=$familiar->listarPeriodo(' COUNT(f.estado_hijo)', 'al.id*al.carrera_id*m.alumno_id*m.sede_id*m.annio_id*a.id*ca.id*f.estado_hijo*ca.facultad_id'.$cicloCampo.$sedeCampo.'*f.academico_id', '=*=*=*=*=*=*=*=*='.$cicloOperador.$sedeOperador.'*=', 'f.alumno_id*ca.id*al.id*s.id*a.id*'.$periodo.'*'.$carrera.'*'.$cm[$j].'*fac.id'.$cicloValor.$sedeValor.'*'.$periodo, 'AND*AND*AND*AND*AND*AND*AND*AND'.$cicloSeparador.$sedeSeparador.'*AND', '', '');
                                                            $html.=$a[0][0];
                                                                if($k < count($cm)-1){
                                                                    $html.='*';
                                                                }
                                                                $k++;                                      
                                                    }

                                                $html.='*'.$total[0][0].'*'.$total[0][3].'*'.$total[0][1].'*'.$total[0][2].'*'.$total[0][4];
                                        echo $html;
                                        
                                        
                      break;
        }
?>
                  