<?php
      session_start();
    $boton=$_REQUEST['boton'];	
    if($boton=='Guardar')
	{
            $idDeu=$_REQUEST['idDeu'];
            $deudaP=$_REQUEST['deudaP'];
            $cuantoEco=$_REQUEST['cuantoEco'];
            $desdeEco=$_REQUEST['desdeEco'];
            $tipoDeuda=$_REQUEST['tipoDeuda'];
        }
        
         if($boton=='BuscardeudaPendiente')
         {
            $sede=$_REQUEST['sede'];
            $periodo=$_REQUEST['periodo'];
            $carrera=$_REQUEST['carrera'];
            $ciclo=$_REQUEST['ciclo'];
            $campo=$_REQUEST['campo'];
         }
         
         
         if($boton=='BuscarTipoDeuda')
         {
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
     require_once("models/deudas.php");
	switch($boton)
	{	case 'Guardar':
                        $alumno_id=$_SESSION['id'];
                         $año=$_SESSION['año'];
                        
                        $deudas = new deudas($idDeu, $alumno_id, $deudaP, $cuantoEco, $desdeEco, htmlentities("$tipoDeuda", ENT_QUOTES,"UTF-8"),$año);
			if($idDeu==" ") {
                                $_SESSION['bandera']='Sii';
				$idDeu=$deudas->guardar();
            }
			else{
                $_SESSION['bandera']='Sii';
				$deudas->actualizar();
                }
			echo $idDeu;
			break;
                        
               case 'BuscardeudaPendiente':
                //INGRESO EL PERIODO , LA SEDE ES CONSOLIDADO
                    $deudaSN='Si*No';
                     $deuda = new deudas('', '', '', '', '', '', '');
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
                $totalSalud=$deuda->listarPeriodo('COUNT(f.'.$campo.')*a.nombre_anio*ca.nombre_carrera*s.nombre,fac.nombreFacult', 'al.id*al.carrera_id*m.alumno_id*m.sede_id*m.annio_id*a.id*ca.id*ca.facultad_id'.$cicloCampo.$sedeCampo.'*f.academico_id', '=*=*=*=*=*=*=*='.$cicloOperador.$sedeOperador.'*=', 'f.alumno_id*ca.id*al.id*s.id*a.id*'.$periodo.'*'.$carrera.'*fac.id'.$cicloValor.$sedeValor.'*'.$periodo, 'AND*AND*AND*AND*AND*AND*AND'.$cicloSeparador.$sedeSeparador.'*AND', '', '');
                
                     /*
                                                                            
                                                                            
                    */
                                    $cm=explode("*",$deudaSN);
                                    $ncm=count($cm);
                                    $html='';
                                    $k=0;
                                        for($j=0;$j<$ncm;$j++)
                                            {

                                                $a=$deuda->listarPeriodo(' COUNT(f.'.$campo.')', 'al.id*al.carrera_id*m.alumno_id*m.sede_id*m.annio_id*a.id*ca.id*f.'.$campo.'*ca.facultad_id'.$cicloCampo.$sedeCampo.'*f.academico_id', '=*=*=*=*=*=*=*=*='.$cicloOperador.$sedeOperador.'*=', 'f.alumno_id*ca.id*al.id*s.id*a.id*'.$periodo.'*'.$carrera.'*'.$cm[$j].'*fac.id'.$cicloValor.$sedeValor.'*'.$periodo, 'AND*AND*AND*AND*AND*AND*AND*AND'.$cicloSeparador.$sedeSeparador.'*AND', '', '');
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
                
                 case 'BuscarTipoDeuda':
                //INGRESO EL PERIODO , LA SEDE ES CONSOLIDADO
                    $deudaSN='Matr&iacute;cula*Mensualidad*Intereses*Libros*Otro';
                     $deuda = new deudas('', '', '', '', '', '', '');
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
                $totalSalud=$deuda->listarPeriodo('COUNT(f.deuda_pendiente)*a.nombre_anio*ca.nombre_carrera*s.nombre,fac.nombreFacult', 'al.id*al.carrera_id*m.alumno_id*m.sede_id*m.annio_id*a.id*ca.id*ca.facultad_id'.$cicloCampo.'*f.deuda_pendiente'.$sedeCampo.'*f.academico_id', '=*=*=*=*=*=*=*='.$cicloOperador.'*='.$sedeOperador.'*=', 'f.alumno_id*ca.id*al.id*s.id*a.id*'.$periodo.'*'.$carrera.'*fac.id'.$cicloValor.'*Si'.$sedeValor.'*'.$periodo, 'AND*AND*AND*AND*AND*AND*AND*AND'.$cicloSeparador.$sedeSeparador.'*AND', '', '');
                
                     /*
                                                                            
                                                                            
                    */
                                    $cm=explode("*",$deudaSN);
                                    $ncm=count($cm);
                                    $html='';
                                    $k=0;
                                        for($j=0;$j<$ncm;$j++)
                                            {

                                                $a=$deuda->listarPeriodo(' COUNT(f.'.$campo.')', 'al.id*al.carrera_id*m.alumno_id*m.sede_id*m.annio_id*a.id*ca.id*f.'.$campo.'*ca.facultad_id'.$cicloCampo.$sedeCampo.'*f.academico_id', '=*=*=*=*=*=*=*=*='.$cicloOperador.$sedeOperador.'*=', 'f.alumno_id*ca.id*al.id*s.id*a.id*'.$periodo.'*'.$carrera.'*'.$cm[$j].'*fac.id'.$cicloValor.$sedeValor.'*'.$periodo, 'AND*AND*AND*AND*AND*AND*AND*AND'.$cicloSeparador.$sedeSeparador.'*AND', '', '');
                                                    $html.=$a[0][0];
                                                        if($k < count($cm)-1){
                                                            $html.='*';
                                                        }
                                                        $k++;                                      
                                            }
                                               //0= SI 1 =No         //6 =total            7 sede           4 periodo            5    carrera               6  facultad                    
                                        $html.='*'.$totalSalud[0][0].'*'.$totalSalud[0][3].'*'.$totalSalud[0][1].'*'.$totalSalud[0][2].'*'.$totalSalud[0][4];
                                echo $html;
                break;
                      
               case 'BuscarPeriodoAlumnado':
                        //INGRESO EL PERIODO , LA SEDE ES CONSOLIDADO
                              if($campo=='deuda_pendiente'){
                                     $sitEco='Si*No';
                              }
                              if($campo=='tipo_deuda'){
                                  $sitEco='Matr&iacute;cula*Mensualidad*Intereses*Libros*Otro';
                              }
                         $deuda= new deudas('','','','','','','');
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
                        
                                           $cm=explode("*",$sitEco);
                                           $ncm=count($cm);
                                           $c=0;
                                             if($campo=='deuda_pendiente'){
                                                       $html="<table style='margin-top: 24px;' align='center' class='table table-striped table-bordered dataTable' id='tabAlumnado'>
                                                    <thead><tr><th>N°</th><th>Codigo</th><th>Nombres y Apellidos</th><th>Deudas Pendientes</th><th>Modalidad de Estudio</th><th></th></tr></thead><tbody>";
                                                }
                                            if($campo=='tipo_deuda'){
                                                  $html="<table style='margin-top: 24px;' align='center' class='table table-striped table-bordered dataTable' id='tabAlumnado3'>
                                                    <thead><tr><th>N°  </th><th>Codigo</th><th>Nombres y Apellidos</th><th>Tipo de Deuda</th><th>Modalidad de Estudio</th><th></th></tr></thead><tbody>";
                                            }
                                          
                                            $k=0;
                                                for($j=0;$j<$ncm;$j++)
                                                    {

                                                        $a=$deuda->listarPeriodo('al.`codigo`*al.`nombres`*al.`apellidos`*f.`'.$campo.'`*m.`modalidadEstudio`*al.id', 'al.id*al.carrera_id*m.alumno_id*m.sede_id*m.annio_id*a.id*ca.id*f.'.$campo.'*ca.facultad_id'.$cicloCampo.$sedeCampo.'*f.academico_id', '=*=*=*=*=*=*=*=*='.$cicloOperador.$sedeOperador.'*=', 'f.alumno_id*ca.id*al.id*s.id*a.id*'.$periodo.'*'.$carrera.'*'.$cm[$j].'*fac.id'.$cicloValor.$sedeValor.'*'.$periodo, 'AND*AND*AND*AND*AND*AND*AND*AND'.$cicloSeparador.$sedeSeparador.'*AND', '', '');
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
