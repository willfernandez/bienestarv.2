<?php
      session_start();
    $boton=$_REQUEST['boton'];	
    if($boton=='Guardar')
	{
            $idDeu=$_REQUEST['idEdu'];
            $colegio=$_REQUEST['colegio'];
            $nombreC=$_REQUEST['nombreC'];
            $ubicacionC=$_REQUEST['ubicacionC'];
            $carreraT=$_REQUEST['carreraT'];
            $nombreCr=$_REQUEST['nombreCr'];
            $actAcade=$_REQUEST['actAcade'];
            $actDepor=$_REQUEST['actDepor'];
            $academia=$_REQUEST['academia'];
            $nomAcademia=$_REQUEST['nomAcademia'];
            $tiempoAcademia=$_REQUEST['tiempoAcademia'];
            $numIntento=$_REQUEST['numIntento'];
            $postuCarrera=$_REQUEST['postuCarrera'];
        }
          if($boton=='BuscarTipoColegio')
         {
            $sede=$_REQUEST['sede'];
            $periodo=$_REQUEST['periodo'];
            $carrera=$_REQUEST['carrera'];
            $ciclo=$_REQUEST['ciclo'];
            $campo=$_REQUEST['campo'];
         }
          if($boton=='BuscarCarreraTecnica')
         {
            $sede=$_REQUEST['sede'];
            $periodo=$_REQUEST['periodo'];
            $carrera=$_REQUEST['carrera'];
            $ciclo=$_REQUEST['ciclo'];
            $campo=$_REQUEST['campo'];
         }

         if($boton=='BuscarPeriodoAlumnado')
         {
            $sede=$_REQUEST['sede'];
            $periodo=$_REQUEST['periodo'];
            $carrera=$_REQUEST['carrera'];
            $ciclo=$_REQUEST['ciclo'];
             $campo=$_REQUEST['campo'];
         }
     require_once("models/educacion.php");
	switch($boton)
	{	
            case 'Guardar':
                        $alumno_id=$_SESSION['id'];
                        $año=$_SESSION['año'];
                        $educacion = new educacion($idDeu,$alumno_id,$colegio,  htmlentities("$nombreC", ENT_QUOTES,"UTF-8"), $ubicacionC, $carreraT,  htmlentities("$nombreCr", ENT_QUOTES,"UTF-8"),  htmlentities("$actAcade", ENT_QUOTES,"UTF-8"),  htmlentities("$actDepor", ENT_QUOTES,"UTF-8"), $academia,  htmlentities("$nomAcademia", ENT_QUOTES,"UTF-8"), $tiempoAcademia, $numIntento,htmlentities("$postuCarrera", ENT_QUOTES,"UTF-8"),$año);
			if($idDeu==" ")
				$idDeu=$educacion->guardar();
			else
				$educacion->actualizar();
			echo $idDeu;
			break;
                        
            case 'BuscarTipoColegio':
                //INGRESO EL PERIODO , LA SEDE ES CONSOLIDADO
                    $cole='I.E Parroquial*I.E Nacional*I.E Particular';
                      $educacion= new educacion('', '', '', '', '', '', '', '', '', '', '', '', '', '', '');
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
                $totalSalud=$educacion->listarPeriodo('COUNT(f.'.$campo.')*a.nombre_anio*ca.nombre_carrera*s.nombre,fac.nombreFacult', 'al.id*m.carrera_id*m.alumno_id*m.sede_id*m.annio_id*a.id*ca.id*ca.facultad_id'.$cicloCampo.$sedeCampo.'*f.academico_id', '=*=*=*=*=*=*=*='.$cicloOperador.$sedeOperador.'*=', 'f.alumno_id*ca.id*al.id*s.id*a.id*'.$periodo.'*'.$carrera.'*fac.id'.$cicloValor.$sedeValor.'*'.$periodo, 'AND*AND*AND*AND*AND*AND*AND'.$cicloSeparador.$sedeSeparador.'*AND', '', '');
                
                     /*
                                                                            
                                                                            
                    */
                                    $cm=explode("*",$cole);
                                    $ncm=count($cm);
                                    $html='';
                                    $k=0;
                                        for($j=0;$j<$ncm;$j++)
                                            {

                                                $a=$educacion->listarPeriodo(' COUNT(f.'.$campo.')', 'al.id*m.carrera_id*m.alumno_id*m.sede_id*m.annio_id*a.id*ca.id*f.'.$campo.'*ca.facultad_id'.$cicloCampo.$sedeCampo.'*f.academico_id', '=*=*=*=*=*=*=*=*='.$cicloOperador.$sedeOperador.'*=', 'f.alumno_id*ca.id*al.id*s.id*a.id*'.$periodo.'*'.$carrera.'*"'.$cm[$j].'"*fac.id'.$cicloValor.$sedeValor.'*'.$periodo, 'AND*AND*AND*AND*AND*AND*AND*AND'.$cicloSeparador.$sedeSeparador.'*AND', '', '');
                                                    $html.=$a[0][0];
                                                        if($k < count($cm)-1){
                                                            $html.='*';
                                                        }
                                                        $k++;                                      
                                            }
                                               //0= SI 1 =No         //3 =total            4 sede           5 periodo            6    carrera              7  facultad                    
                                        $html.='*'.$totalSalud[0][0].'*'.$totalSalud[0][3].'*'.$totalSalud[0][1].'*'.$totalSalud[0][2].'*'.$totalSalud[0][4];
                                echo $html;
                break;
                
                case 'BuscarCarreraTecnica':
                //INGRESO EL PERIODO , LA SEDE ES CONSOLIDADO
                    $cole='Si*No';
                      $educacion= new educacion('', '', '', '', '', '', '', '', '', '', '', '', '', '', '');
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
                $totalSalud=$educacion->listarPeriodo('COUNT(f.'.$campo.')*a.nombre_anio*ca.nombre_carrera*s.nombre,fac.nombreFacult', 'al.id*m.carrera_id*m.alumno_id*m.sede_id*m.annio_id*a.id*ca.id*ca.facultad_id'.$cicloCampo.$sedeCampo.'*f.academico_id', '=*=*=*=*=*=*=*='.$cicloOperador.$sedeOperador.'*=', 'f.alumno_id*ca.id*al.id*s.id*a.id*'.$periodo.'*'.$carrera.'*fac.id'.$cicloValor.$sedeValor.'*'.$periodo, 'AND*AND*AND*AND*AND*AND*AND'.$cicloSeparador.$sedeSeparador.'*AND', '', '');
                                    $cm=explode("*",$cole);
                                    $ncm=count($cm);
                                    $html='';
                                    $k=0;
                                        for($j=0;$j<$ncm;$j++)
                                            {

                                                $a=$educacion->listarPeriodo(' COUNT(f.'.$campo.')', 'al.id*m.carrera_id*m.alumno_id*m.sede_id*m.annio_id*a.id*ca.id*f.'.$campo.'*ca.facultad_id'.$cicloCampo.$sedeCampo.'*f.academico_id', '=*=*=*=*=*=*=*=*='.$cicloOperador.$sedeOperador.'*=', 'f.alumno_id*ca.id*al.id*s.id*a.id*'.$periodo.'*'.$carrera.'*'.$cm[$j].'*fac.id'.$cicloValor.$sedeValor.'*'.$periodo, 'AND*AND*AND*AND*AND*AND*AND*AND'.$cicloSeparador.$sedeSeparador.'*AND', '', '');
                                                    $html.=$a[0][0];
                                                        if($k < count($cm)-1){
                                                            $html.='*';
                                                        }
                                                        $k++;                                      
                                            }
                                               //0= SI 1 =No         //3 =total            4 sede           5 periodo            6    carrera              7  facultad                    
                                        $html.='*'.$totalSalud[0][0].'*'.$totalSalud[0][3].'*'.$totalSalud[0][1].'*'.$totalSalud[0][2].'*'.$totalSalud[0][4];
                                echo $html;
                break;

                case 'BuscarPeriodoAlumnado':
                        //INGRESO EL PERIODO , LA SEDE ES CONSOLIDADO
                              if($campo=='tipo_colegio'){
                                     $sitPadres='"I.E Parroquial"*"I.E Nacional"*"I.E Particular"';
                              }
                              if($campo=='carrera_tecnica'){
                                  $sitPadres='Si*No';
                              }
                         $educacion= new educacion('', '', '', '', '', '', '', '', '', '', '', '', '', '', '');
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
                                             if($campo=='tipo_colegio'){
                                                       $html="<table style='margin-top: 24px;' align='center' class='table table-striped table-bordered dataTable' id='tabAlumnado'>
                                                    <thead><tr><th>N°</th><th>Codigo</th><th>Nombres y Apellidos</th><th>Tipo Colegio</th><th>Modalidad de Estudio</th><th></th></tr></thead><tbody>";
                                                }
                                            if($campo=='carrera_tecnica'){
                                                  $html="<table style='margin-top: 24px;' align='center' class='table table-striped table-bordered dataTable' id='tabAlumnadoSE'>
                                                    <thead><tr><th>N°  </th><th>Codigo</th><th>Nombres y Apellidos</th><th>situacion del alumno</th><th>Modalidad de Estudio</th><th></th></tr></thead><tbody>";
                                            }
                                          
                                            $k=0;
                                                for($j=0;$j<$ncm;$j++)
                                                    {

                                                        $a=$educacion->listarPeriodo('al.`codigo`*al.`nombres`*al.`apellidos`*f.`'.$campo.'`*m.`modalidadEstudio`*al.id', 'al.id*m.carrera_id*m.alumno_id*m.sede_id*m.annio_id*a.id*ca.id*f.'.$campo.'*ca.facultad_id'.$cicloCampo.$sedeCampo.'*f.academico_id', '=*=*=*=*=*=*=*=*='.$cicloOperador.$sedeOperador.'*=', 'f.alumno_id*ca.id*al.id*s.id*a.id*'.$periodo.'*'.$carrera.'*'.$cm[$j].'*fac.id'.$cicloValor.$sedeValor.'*'.$periodo, 'AND*AND*AND*AND*AND*AND*AND*AND'.$cicloSeparador.$sedeSeparador.'*AND', '', '');
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
                      
        }
?>