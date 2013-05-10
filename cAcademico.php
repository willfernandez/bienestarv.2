<?php
     session_start(); 
    $boton=$_REQUEST['boton'];	
    if($boton=='Guardar')
	{
            $idU=$_REQUEST['idU'];
            $universidad=$_REQUEST['universidad'];
            $tcarrera=$_REQUEST['tcarrera'];
            $pcarrera=$_REQUEST['pcarrera'];
            $motivo_1=$_REQUEST['motivo_1'];
            $motivo_2=$_REQUEST['motivo_2'];
            $motivo_3=$_REQUEST['motivo_3'];
            $motivo_4=$_REQUEST['motivo_4'];
            $motivo_5=$_REQUEST['motivo_5'];
            $motivo_6=$_REQUEST['motivo_6'];
            $motivo_7=$_REQUEST['motivo_7'];
            $motivo_8=$_REQUEST['motivo_8'];
            $motivo_9=$_REQUEST['motivo_9'];
            $motivo_10=$_REQUEST['motivo_10'];
            $ayuda=$_REQUEST['ayuda'];
            
        }
     require_once("models/academico.php");
	switch($boton)
	{	case 'Guardar':
                        $alumno_id=$_SESSION['id'];
                        $año=$_SESSION['año'];
                        
                        $universidad= new Academico($idU, $alumno_id, $universidad, $tcarrera, $pcarrera, $motivo_1, $motivo_2,htmlentities("$motivo_3", ENT_QUOTES,"UTF-8"),htmlentities("$motivo_4", ENT_QUOTES,"UTF-8"), $motivo_5, $motivo_6, $motivo_7, $motivo_8, $motivo_9, $motivo_10, $ayuda,$año);
			if($idU==" ")
				$idU=$universidad->guardar();
			else
				$universidad->actualizar();
			echo $idU;
			break;
                      
               
                   
        }
?>

