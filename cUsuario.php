<?php
     session_start(); 
    $boton=$_REQUEST['boton'];	
        if($boton=='Guardar')
	{
              $idUs=$_REQUEST['idUs'];
            $nombUs=$_REQUEST['nombUs'];
            $apeUs=$_REQUEST['apeUs'];
            $dniUs=$_REQUEST['dniUs'];
            $emailUs=$_REQUEST['emailUs'];
            $passUs=$_REQUEST['passUs'];
           
            
        }
     
     require_once("models/usuario.php");
	switch($boton)
	{	
            case 'Salir':
                       session_destroy();
                        break;
            
            case 'Guardar':
                           //aca va lo de verificar si esta registrado con elc odigo y el dni     
                            $pass = md5($passUs);
                        $usuario = new usuario($idUs, $emailUs, $pass, htmlentities("$nombUs", ENT_QUOTES,"UTF-8"), htmlentities("$apeUs", ENT_QUOTES,"UTF-8"), $dniUs);
			if($idUs==" "){
				$idUs=$usuario->guardar();
                        }
			else{
				$usuario->actualizar();
                                
                        }
			echo $idUs;
			break;
                   
        }
?>

