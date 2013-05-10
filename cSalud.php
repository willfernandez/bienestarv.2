<?php
      session_start();
    $boton=$_REQUEST['boton'];	
    if($boton=='Guardar')
	{
            $idSal=$_REQUEST['idSal'];
            $enfermedad=$_REQUEST['enfermedad'];
            $enfermedadNom=$_REQUEST['enfermedadNom'];
            $atencionS=$_REQUEST['atencionS'];
            $embarazo = $_REQUEST['embarazo'];
            $embTiempo = $_REQUEST['embTiempo'];
            $dobemb = $_REQUEST['dobemb'];
            $lcontroles = $_REQUEST['lcontroles'];
            $conceptivo = $_REQUEST['conceptivo'];
            $anticonceptivo = $_REQUEST['anticonceptivo'];
        }
   if($boton=='BuscarPadeceEnfermedad'){
        $sede=$_REQUEST['sede'];
            $periodo=$_REQUEST['periodo'];
            $carrera=$_REQUEST['carrera'];
            $ciclo=$_REQUEST['ciclo'];
            $campo=$_REQUEST['campo'];
   }
   
   if($boton=='BuscarAtencion'){
        $sede=$_REQUEST['sede'];
            $periodo=$_REQUEST['periodo'];
            $carrera=$_REQUEST['carrera'];
            $ciclo=$_REQUEST['ciclo'];
            $campo=$_REQUEST['campo'];
   }
   if($boton == 'BuscarPeriodoAlumnado'){
             
               $sede=$_REQUEST['sede'];
            $periodo=$_REQUEST['periodo'];
            $carrera=$_REQUEST['carrera'];
            $ciclo=$_REQUEST['ciclo'];
             $campo=$_REQUEST['campo'];
         }
     require_once("models/salud.php");
	switch($boton)
	{	case 'Guardar':
                        $alumno_id=$_SESSION['id'];
                        $año=$_SESSION['año'];
                        $salud = new salud($idSal, $alumno_id, $enfermedad, $enfermedadNom, htmlentities("$atencionS", ENT_QUOTES,"UTF-8"),$año,$embarazo,$embTiempo,$dobemb,htmlentities("$lcontroles", ENT_QUOTES,"UTF-8"),$conceptivo,$anticonceptivo);
			if($idSal==" ")
				$idSal=$salud->guardar();
			else
				$salud->actualizar();
			echo $idSal;
			break;
                      
                 case 'Reporte':
                      $objSalud= new Salud('', '', '', '', '', '');
                     $totalSalud=$objSalud->listarSimple('COUNT(enfermedad)', '', '', '', '', '', '');
                    $pS='Si*No';
                    $aS=explode("*",$pS);
                    $nS=count($aS);
                    $k=0;
                    $html='Si*No*';
                    for($j=0;$j<$nS;$j++){
                     
                        $a=$objSalud->listarSimple('COUNT(enfermedad)', 'enfermedad', '=',$aS[$j], '', '', '');
                       	//SELECT COUNT(f.`estado_padres`) FROM familiares AS f WHERE f.`estado_padres`='Casados'
                        $html.=$a[0][0];
                         if($k < count($aS)-1)         {
                             $html.='*';
                         }
                              $k++;           
                     }
                     $html.='*'.$totalSalud[0][0];
                      echo $html;
                     
                     break;
                     
             case 'BuscarPadeceEnfermedad':
                //INGRESO EL PERIODO , LA SEDE ES CONSOLIDADO
                    $saludSN='Si*No';
                       $salud = new Salud('','','','','','','','','','','','');
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
                $totalSalud=$salud->listarPeriodo('COUNT(f.'.$campo.')*a.nombre_anio*ca.nombre_carrera*s.nombre,fac.nombreFacult', 'al.id*m.carrera_id*m.alumno_id*m.sede_id*m.annio_id*a.id*ca.id*ca.facultad_id'.$cicloCampo.$sedeCampo.'*f.academico_id', '=*=*=*=*=*=*=*='.$cicloOperador.$sedeOperador.'*=', 'f.alumno_id*ca.id*al.id*s.id*a.id*'.$periodo.'*'.$carrera.'*fac.id'.$cicloValor.$sedeValor.'*'.$periodo, 'AND*AND*AND*AND*AND*AND*AND'.$cicloSeparador.$sedeSeparador.'*AND', '', '');
                
                     /*
                                                                            
                                                                            
                    */
                                    $cm=explode("*",$saludSN);
                                    $ncm=count($cm);
                                    $html='';
                                    $k=0;
                                        for($j=0;$j<$ncm;$j++)
                                            {

                                                $a=$salud->listarPeriodo(' COUNT(f.'.$campo.')', 'al.id*m.carrera_id*m.alumno_id*m.sede_id*m.annio_id*a.id*ca.id*f.'.$campo.'*ca.facultad_id'.$cicloCampo.$sedeCampo.'*f.academico_id', '=*=*=*=*=*=*=*=*='.$cicloOperador.$sedeOperador.'*=', 'f.alumno_id*ca.id*al.id*s.id*a.id*'.$periodo.'*'.$carrera.'*'.$cm[$j].'*fac.id'.$cicloValor.$sedeValor.'*'.$periodo, 'AND*AND*AND*AND*AND*AND*AND*AND'.$cicloSeparador.$sedeSeparador.'*AND', '', '');
                                                    $html.=$a[0][0];
                                                        if($k < count($cm)-1){
                                                            $html.='*';
                                                        }
                                                        $k++;                                      
                                            }
                                               //0= SI 1 =No         //2 =total            3 sede           4 periodo            5    carrera               6  facultad                    
                                        $html.='*'.$totalSalud[0][0].'*'.$totalSalud[0][3].'*'.$totalSalud[0][1].'*'.$totalSalud[0][2].'*'.$totalSalud[0][4];
                                echo $html;
                        break;
                        
              case 'BuscarAtencion':
                    $saludSN='MINSA*EsSALUD*Particular*Remedios caceros*Se auto medica';
                       $salud = new Salud('','','','','','','','','','','','');
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
                $totalSalud=$salud->listarPeriodo('COUNT(f.'.$campo.')*a.nombre_anio*ca.nombre_carrera*s.nombre,fac.nombreFacult', 'al.id*al.carrera_id*m.alumno_id*m.sede_id*m.annio_id*a.id*ca.id*ca.facultad_id'.$cicloCampo.$sedeCampo.'*f.academico_id', '=*=*=*=*=*=*=*='.$cicloOperador.$sedeOperador.'*=', 'f.alumno_id*ca.id*al.id*s.id*a.id*'.$periodo.'*'.$carrera.'*fac.id'.$cicloValor.$sedeValor.'*'.$periodo, 'AND*AND*AND*AND*AND*AND*AND'.$cicloSeparador.$sedeSeparador.'*AND', '', '');
                
                     /*
                                                                            
                                                                            
                    */
                                    $cm=explode("*",$saludSN);
                                    $ncm=count($cm);
                                    $html='';
                                    $k=0;
                                        for($j=0;$j<$ncm;$j++)
                                            {

                                                $a=$salud->listarPeriodo(' COUNT(f.'.$campo.')', 'al.id*al.carrera_id*m.alumno_id*m.sede_id*m.annio_id*a.id*ca.id*f.'.$campo.'*ca.facultad_id'.$cicloCampo.$sedeCampo.'*f.academico_id', '=*=*=*=*=*=*=*=*='.$cicloOperador.$sedeOperador.'*=', 'f.alumno_id*ca.id*al.id*s.id*a.id*'.$periodo.'*'.$carrera.'*'.$cm[$j].'*fac.id'.$cicloValor.$sedeValor.'*'.$periodo, 'AND*AND*AND*AND*AND*AND*AND*AND'.$cicloSeparador.$sedeSeparador.'*AND', '', '');
                                                    $html.=$a[0][0];
                                                        if($k < count($cm)-1){
                                                            $html.='*';
                                                        }
                                                        $k++;                                      
                                            }
                                               //0= SI 1 =No         //5 =total           6 sede          7 periodo            8    carrera               6  facultad                    
                                        $html.='*'.$totalSalud[0][0].'*'.$totalSalud[0][3].'*'.$totalSalud[0][1].'*'.$totalSalud[0][2].'*'.$totalSalud[0][4];
                                echo $html;
                        break;
                case 'BuscarPeriodoAlumnado':
                   
                       if($campo=='enfermdedad'){
                         $violenciaSN='Si*No';
                       }
                       if($campo=='centro_salud'){
                         $violenciaSN='MINSA*EsSALUD*Particular*Remedios caceros*Se auto medica';
                       }
                       
                    $salud = new Salud('','','','','','','','','','','','');
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
                                    $cm=explode("*",$violenciaSN);
                                    $ncm=count($cm);
                                    if($campo == 'enfermdedad'){
                                    $html="<table style='margin-top: 24px;' align='center' class='table table-striped table-bordered dataTable' id='tabAlumnado'>
                                                    <thead><tr><th>N°</th><th>Codigo</th><th>Nombres y Apellidos</th><th>Respuesta</th><th>Modalidad de Estudio</th><th></th></tr></thead><tbody>";
                                    }
                                    if($campo == 'centro_salud'){
                                    $html="<table style='margin-top: 24px;' align='center' class='table table-striped table-bordered dataTable' id='tabAlumnado2'>
                                                    <thead><tr><th>N°</th><th>Codigo</th><th>Nombres y Apellidos</th><th>Respuesta</th><th>Modalidad de Estudio</th><th></th></tr></thead><tbody>";
                                    }
                                    $c=0;
                                        for($j=0;$j<$ncm;$j++)
                                            {

                                                $a=$salud->listarPeriodo('al.`codigo`*al.`nombres`*al.`apellidos`*f.`'.$campo.'`*m.`modalidadEstudio`*al.id', 'al.id*m.carrera_id*m.alumno_id*m.sede_id*m.annio_id*a.id*ca.id*f.'.$campo.'*ca.facultad_id'.$cicloCampo.$sedeCampo.'*f.academico_id', '=*=*=*=*=*=*=*=*='.$cicloOperador.$sedeOperador.'*=', 'f.alumno_id*ca.id*al.id*s.id*a.id*'.$periodo.'*'.$carrera.'*'.$cm[$j].'*fac.id'.$cicloValor.$sedeValor.'*'.$periodo, 'AND*AND*AND*AND*AND*AND*AND*AND'.$cicloSeparador.$sedeSeparador.'*AND', '', '');
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
                                               //0= SI 1 =No         //2 =total            3 sede           4 periodo            5    carrera               6  facultad                    
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
