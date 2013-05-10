<?php
	$boton=$_REQUEST['boton'];
    $usuario=$_REQUEST['usuario'];
	$clave=$_REQUEST['clave'];
	switch($boton)
	{
		case 'iniciar':
			
                    $pass=  md5($clave);
			require_once("models/usuario.php");
           $datos="$usuario*$pass";
            $usuario= new usuario('', '','','','','');
			//SELECT * FROM usuario WHERE dni='' AND clave=''
            $a= $usuario->listarSimple('', 'email*password', '=*=', $datos, 'AND','', '');
			$na=count($a);
			if($na>0)
			{	
					session_start();
					$_SESSION['autenticadoU']='SI';
					$_SESSION['nombresU']=$a[0][3];
					$_SESSION['apellidosU']=$a[0][4];
                    $_SESSION['email']=$a[0][1];
                    echo '1';
                                       
			}
			else
			{
				echo '0';//header("Location:frmLogin.php");
			}
			break;
	}
?>