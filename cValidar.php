<?php
session_start();
	$boton=$_REQUEST['boton'];
	require_once("models/validar.php");
        require_once ('models/annio.php');
        $annio= new annio('', '', '', '', '');
        $año = $annio->listarSimple('id', 'activo', '=','1', '', '', '');
	switch($boton)
	{
		case 'Buscar':
			$alumno_id=$_SESSION['id'];
            
			$validar= new validar('', '', '', '');
			//SELECT * FROM usuario WHERE dni='' AND clave=''
                        $a= $validar->listarSimple('', "alumno_id*academico_id", "=*=", $alumno_id.'*'.$año[0][0], 'AND', '', '');
			$na=count($a);
			if($na>0)
			{	
					$datos=$a[0][1];
                                     echo $datos;
					
			}
			else
			{
				echo 'No';//header("Location:frmLogin.php");
			}
			break;
			
			
		case 'Guardar':
            $alumno_id=$_SESSION['id'];
			$idVal= $_SESSION['validacionId'];
            $año = $annio->listarSimple('id', 'activo', '=','1', '', '', '');
            $validar= new validar($idVal,'SI',$alumno_id,$año[0][0]);
			if($idVal=="0"){
                                
                                $_SESSION['validacion']='SI';
				$idVal=$validar->guardar();
				
				}
			else
				$validar->actualizar();
				
			break;
	}
?>