<?php
	$boton=$_REQUEST['boton'];
	switch($boton)
	{
		case 'iniciar':
			$dni=$_REQUEST['dni'];
			$codigo=$_REQUEST['codigo'];
			require_once("models/alumno.php");
                        require_once("models/validar.php");
                        require_once ('models/annio.php');
                        require_once ('models/matricula.php');
                        
                       
			$alumno = new alumno('', '', '', '',  '',  '',  '');
            $annio = new annio('', '', '', '', '');
            $matricula = new matricula('','','','','','','');
            $año = $annio->listarSimple('id,nombre_anio', 'activo', '=','1', '', '', '');
			//SELECT * FROM usuario WHERE dni='' AND clave=''
            $a = $alumno->listarSimple('', "dni*codigo", "=*=", "$dni*$codigo", "AND", '', '');
                    //    $a = $alumno->listarSimple('', "dni*codigo", "=*=", "$dni*$codigo", "AND", '', '');
			$na=count($a);
			if($na>0)
			{	
					session_start();
					$m = $matricula->listarSesion('ma.id*ma.modalidadEstudio*ca.nombre_carrera*fa.siglas*fa.nombreFacult*ci.ciclo','ma.ciclo_id*ma.carrera_id*ca.facultad_id*alumno_id*annio_id',"=*=*=*=*=","ci.id*ca.id*fa.id*".$a[0][0].'*'.$año[0][0],'AND*AND*AND*AND','','');
                    $nm=count($m);
                     $matriculado='No';
                    if($nm > 0){
                        $matriculado='Si';
                        $_SESSION['matId']=$m[0][0];
                        $_SESSION['modE']=$m[0][1];
                        $_SESSION['carerra']=utf8_encode($m[0][2]);
                        $_SESSION['sig']=$m[0][3];
                        $_SESSION['facu']=utf8_encode($m[0][4]);
                        $_SESSION['ciclo']=$m[0][5];
                    }

                    $validador= new validar('', '', '','');
					$v= $validador->listarSimple('', "alumno_id*academico_id", "=*=", $a[0][0].'*'.$año[0][0], 'AND', '', '');
                    $nv=count($v);
                    
                    
					$_SESSION['autenticado']='SI';
					$_SESSION['codigo']=$a[0][1];
					$_SESSION['nombres']=utf8_encode($a[0][4]);
					$_SESSION['apellidos']=$a[0][5];
					$_SESSION['id']=$a[0][0];
					$_SESSION['año']=$año[0][0];
                    $_SESSION['nomannio']=$año[0][1];
                    if($nv>0){
                        $_SESSION['validacion']=$v[0][1];
   					 $_SESSION['validacionId']=$v[0][0]; 
                    }else{
                        $_SESSION['validacion']='No';
                         $_SESSION['validacionId']='0'; 
                    }
                    $imprimir='1*'.$matriculado;
                    echo $imprimir;
			}
			else
			{
				 $imprimir='0*No';
                    echo $imprimir;
			}
			break;
	}


?>
