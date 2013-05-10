<?php
      session_start();
    $boton=$_REQUEST['boton'];	
    if($boton=='Guardar')
	{
            $idVio=$_REQUEST['idVio'];
            $familiaA=$_REQUEST['familiaA'];
            $relacion=$_REQUEST['relacion'];
            $violencia=$_REQUEST['violencia'];
            $maltratoP=$_REQUEST['maltratoP'];
            $maltratoF=$_REQUEST['maltratoF'];
            $razonV=$_REQUEST['razonV'];
        }
        
        if($boton=='BuscarPeriodoObsViolencia' || $boton=='BuscarCvCiudad' || $boton=='BuscarRlfamiliares')
         {
            $sede=$_REQUEST['sede'];
            $periodo=$_REQUEST['periodo'];
            $carrera=$_REQUEST['carrera'];
            $ciclo=$_REQUEST['ciclo'];
            $campo=$_REQUEST['campo'];
         }
         if($boton == 'BuscarPeriodoObsViolenciaAlumnado'){
             
               $sede=$_REQUEST['sede'];
            $periodo=$_REQUEST['periodo'];
            $carrera=$_REQUEST['carrera'];
            $ciclo=$_REQUEST['ciclo'];
             $campo=$_REQUEST['campo'];
         }
   
        
     require_once("models/violencia.php");
	switch($boton)
	{	case 'Guardar':
                        $alumno_id=$_SESSION['id'];
                        $año=$_SESSION['año'];
                        $violencia = new violencia($idVio, $alumno_id, htmlentities("$familiaA", ENT_QUOTES,"UTF-8") , $relacion, $violencia, $maltratoF, $maltratoP, $razonV,$año);
			if($idVio=='0')
				$idVio=$violencia->guardar();
			else
				$violencia->actualizar();
			echo $idVio;
			break;
                        
                case 'BuscarPeriodoObsViolencia':
                //INGRESO EL PERIODO , LA SEDE ES CONSOLIDADO
                    $violenciaSN='Si*No';
                    $violencia= new violencia('', '', '', '', '', '', '', '', '');
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
                $totalSalud=$violencia->listarPeriodo('COUNT(f.'.$campo.')*a.nombre_anio*ca.nombre_carrera*s.nombre,fac.nombreFacult', 'al.id*al.carrera_id*m.alumno_id*m.sede_id*m.annio_id*a.id*ca.id*ca.facultad_id'.$cicloCampo.$sedeCampo.'*f.academico_id', '=*=*=*=*=*=*=*='.$cicloOperador.$sedeOperador.'*=', 'f.alumno_id*ca.id*al.id*s.id*a.id*'.$periodo.'*'.$carrera.'*fac.id'.$cicloValor.$sedeValor.'*'.$periodo, 'AND*AND*AND*AND*AND*AND*AND'.$cicloSeparador.$sedeSeparador.'*AND', '', '');
                
                     /*
                                                                            
                                                                            
                    */
                                    $cm=explode("*",$violenciaSN);
                                    $ncm=count($cm);
                                    $html='';
                                    $k=0;
                                        for($j=0;$j<$ncm;$j++)
                                            {

                                                $a=$violencia->listarPeriodo(' COUNT(f.'.$campo.')', 'al.id*al.carrera_id*m.alumno_id*m.sede_id*m.annio_id*a.id*ca.id*f.'.$campo.'*ca.facultad_id'.$cicloCampo.$sedeCampo.'*f.academico_id', '=*=*=*=*=*=*=*=*='.$cicloOperador.$sedeOperador.'*=', 'f.alumno_id*ca.id*al.id*s.id*a.id*'.$periodo.'*'.$carrera.'*'.$cm[$j].'*fac.id'.$cicloValor.$sedeValor.'*'.$periodo, 'AND*AND*AND*AND*AND*AND*AND*AND'.$cicloSeparador.$sedeSeparador.'*AND', '', '');
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
                
                case "BuscarCvCiudad":
                     $viveC='Ambos Padres*S&oacute;lo con madre*Solo*S&oacute;lo con padre*Familiares*C&oacute;nyuge';
                    $violencia= new violencia('', '', '', '', '', '', '', '', '');
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
                    $totalSalud=$violencia->listarPeriodo('COUNT(f.familia_actual)*a.nombre_anio*ca.nombre_carrera*s.nombre,fac.nombreFacult', 'al.id*al.carrera_id*m.alumno_id*m.sede_id*m.annio_id*a.id*ca.id*ca.facultad_id'.$cicloCampo.$sedeCampo.'*f.academico_id', '=*=*=*=*=*=*=*='.$cicloOperador.$sedeOperador.'*=', 'f.alumno_id*ca.id*al.id*s.id*a.id*'.$periodo.'*'.$carrera.'*fac.id'.$cicloValor.$sedeValor.'*'.$periodo, 'AND*AND*AND*AND*AND*AND*AND'.$cicloSeparador.$sedeSeparador.'*AND', '', '');
                    $cm=explode("*",$viveC);
                                    $ncm=count($cm);
                                    $html='';
                                    $k=0;
                                        for($j=0;$j<$ncm;$j++)
                                            {

                                                $a=$violencia->listarPeriodo(' COUNT(f.familia_actual)', 'al.id*al.carrera_id*m.alumno_id*m.sede_id*m.annio_id*a.id*ca.id*f.familia_actual*ca.facultad_id'.$cicloCampo.$sedeCampo.'*f.academico_id', '=*=*=*=*=*=*=*=*='.$cicloOperador.$sedeOperador.'*=', 'f.alumno_id*ca.id*al.id*s.id*a.id*'.$periodo.'*'.$carrera.'*'.$cm[$j].'*fac.id'.$cicloValor.$sedeValor.'*'.$periodo, 'AND*AND*AND*AND*AND*AND*AND*AND'.$cicloSeparador.$sedeSeparador.'*AND', '', '');
                                                    $html.=$a[0][0];
                                                        if($k < count($cm)-1){
                                                            $html.='*';
                                                        }
                                                        $k++;                                      
                                            }
                                               //0= SI 1 =No         //6=total            7 sede           8 periodo            9    carrera               10 facultad                    
                                        $html.='*'.$totalSalud[0][0].'*'.$totalSalud[0][3].'*'.$totalSalud[0][1].'*'.$totalSalud[0][2].'*'.$totalSalud[0][4];
                                echo $html;
                    
                    break;
                    
                    
                    case "BuscarRlfamiliares":
                     $relaciones='Excelentes*Buenas*Regulares*Malas*Muy malas';
                    $violencia= new violencia('', '', '', '', '', '', '', '', '');
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
                    $totalSalud=$violencia->listarPeriodo('COUNT(f.famila_relacion)*a.nombre_anio*ca.nombre_carrera*s.nombre,fac.nombreFacult', 'al.id*al.carrera_id*m.alumno_id*m.sede_id*m.annio_id*a.id*ca.id*ca.facultad_id'.$cicloCampo.$sedeCampo.'*f.academico_id', '=*=*=*=*=*=*=*='.$cicloOperador.$sedeOperador.'*=', 'f.alumno_id*ca.id*al.id*s.id*a.id*'.$periodo.'*'.$carrera.'*fac.id'.$cicloValor.$sedeValor.'*'.$periodo, 'AND*AND*AND*AND*AND*AND*AND'.$cicloSeparador.$sedeSeparador.'*AND', '', '');
                    $cm=explode("*",$relaciones);
                                    $ncm=count($cm);
                                    $html='';
                                    $k=0;
                                        for($j=0;$j<$ncm;$j++)
                                            {

                                                $a=$violencia->listarPeriodo(' COUNT(f.famila_relacion)', 'al.id*al.carrera_id*m.alumno_id*m.sede_id*m.annio_id*a.id*ca.id*f.famila_relacion*ca.facultad_id'.$cicloCampo.$sedeCampo.'*f.academico_id', '=*=*=*=*=*=*=*=*='.$cicloOperador.$sedeOperador.'*=', 'f.alumno_id*ca.id*al.id*s.id*a.id*'.$periodo.'*'.$carrera.'*'.$cm[$j].'*fac.id'.$cicloValor.$sedeValor.'*'.$periodo, 'AND*AND*AND*AND*AND*AND*AND*AND'.$cicloSeparador.$sedeSeparador.'*AND', '', '');
                                                    $html.=$a[0][0];
                                                        if($k < count($cm)-1){
                                                            $html.='*';
                                                        }
                                                        $k++;                                      
                                            }
                                               //0= SI 1 =No         //5=total            6 sede          7 periodo            8    carrera               9 facultad                    
                                        $html.='*'.$totalSalud[0][0].'*'.$totalSalud[0][3].'*'.$totalSalud[0][1].'*'.$totalSalud[0][2].'*'.$totalSalud[0][4];
                                echo $html;
                    
                    break;
                      
             //ALUMNADO
                    
               case 'BuscarPeriodoObsViolenciaAlumnado':
                   
                       if($campo=='familia_actual'){
                         $violenciaSN='Ambos Padres*S&oacute;lo con madre*Solo*S&oacute;lo con padre*Familiares*C&oacute;nyuge';
                       }
                       if($campo=='famila_relacion'){
                         $violenciaSN='Excelentes*Buenas*Regulares*Malas*Muy malas';
                       }
                       if($campo == 'maltrato_psicologico' || $campo == 'maltrato_fisico' || $campo=='violencia_familia'){
                             $violenciaSN='Si*No';
                       }
                    $violencia= new violencia('', '', '', '', '', '', '', '', '');
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
                                    if($campo == 'violencia_familia'){
                                    $html="<table style='margin-top: 24px;' align='center' class='table table-striped table-bordered dataTable' id='tabAlumnado'>
                                                    <thead><tr><th>N°</th><th>Codigo</th><th>Nombres y Apellidos</th><th>Respuesta</th><th>Modalidad de Estudio</th><th></th></tr></thead><tbody>";
                                    }
                                    if($campo == 'maltrato_fisico'){
                                    $html="<table style='margin-top: 24px;' align='center' class='table table-striped table-bordered dataTable' id='tabAlumnado2'>
                                                    <thead><tr><th>N°</th><th>Codigo</th><th>Nombres y Apellidos</th><th>Respuesta</th><th>Modalidad de Estudio</th><th></th></tr></thead><tbody>";
                                    }
                                   
                                    if($campo == 'maltrato_psicologico'){
                                    $html="<table style='margin-top: 24px;' align='center' class='table table-striped table-bordered dataTable' id='tabAlumnado3'>
                                                    <thead><tr><th>N°</th><th>Codigo</th><th>Nombres y Apellidos</th><th>Respuesta</th><th>Modalidad de Estudio</th><th></th></tr></thead><tbody>";
                                    }
                                    
                                     if($campo == 'familia_actual'){
                                    $html="<table style='margin-top: 24px;' align='center' class='table table-striped table-bordered dataTable' id='tabAlumnado4'>
                                                    <thead><tr><th>N°</th><th>Codigo</th><th>Nombres y Apellidos</th><th>Respuesta</th><th>Modalidad de Estudio</th><th></th></tr></thead><tbody>";
                                    }
                                    
                                    if($campo == 'famila_relacion'){
                                    $html="<table style='margin-top: 24px;' align='center' class='table table-striped table-bordered dataTable' id='tabAlumnado5'>
                                                    <thead><tr><th>N°</th><th>Codigo</th><th>Nombres y Apellidos</th><th>Respuesta</th><th>Modalidad de Estudio</th><th></th></tr></thead><tbody>";
                                    }
                                    $c=0;
                                        for($j=0;$j<$ncm;$j++)
                                            {

                                                $a=$violencia->listarPeriodo('al.`codigo`*al.`nombres`*al.`apellidos`*f.`'.$campo.'`*m.`modalidadEstudio`*al.id', 'al.id*m.carrera_id*m.alumno_id*m.sede_id*m.annio_id*a.id*ca.id*f.'.$campo.'*ca.facultad_id'.$cicloCampo.$sedeCampo.'*f.academico_id', '=*=*=*=*=*=*=*=*='.$cicloOperador.$sedeOperador.'*=', 'f.alumno_id*ca.id*al.id*s.id*a.id*'.$periodo.'*'.$carrera.'*'.$cm[$j].'*fac.id'.$cicloValor.$sedeValor.'*'.$periodo, 'AND*AND*AND*AND*AND*AND*AND*AND'.$cicloSeparador.$sedeSeparador.'*AND', '', '');
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
