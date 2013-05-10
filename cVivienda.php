<?php
      session_start();
    $boton=$_REQUEST['boton'];	
    if($boton=='Guardar')
	{
            $idVi=$_REQUEST['idVi'];
            $vivienda=$_REQUEST['vivienda'];
            $construccion=$_REQUEST['construccion'];
            $servicio_a=$_REQUEST['servicio_a'];
            $servicio_b=$_REQUEST['servicio_b'];
            $servicio_c=$_REQUEST['servicio_c'];
            $servicio_d=$_REQUEST['servicio_d'];
            $servicio_e=$_REQUEST['servicio_e'];
            $servicio_f=$_REQUEST['servicio_f'];
            $equipo_a=$_REQUEST['equipo_a'];
            $equipo_b=$_REQUEST['equipo_b'];
            $equipo_c=$_REQUEST['equipo_c'];
            $equipo_d=$_REQUEST['equipo_d'];
            $equipo_e=$_REQUEST['equipo_e'];
            $equipo_f=$_REQUEST['equipo_f'];
            $equipo_g=$_REQUEST['equipo_g'];
            $equipo_h=$_REQUEST['equipo_h'];
        }
     require_once("models/vivienda.php");
	switch($boton)
	{	case 'Guardar':
                        $alumno_id=$_SESSION['id'];
                       $año=$_SESSION['año'];
                        $vivienda = new Vivienda($idVi, $alumno_id, $vivienda, htmlentities("$construccion", ENT_QUOTES,"UTF-8"), $servicio_a,  htmlentities("$servicio_b", ENT_QUOTES,"UTF-8"), $servicio_c,htmlentities("$servicio_d", ENT_QUOTES,"UTF-8") , $servicio_e, $servicio_f, $equipo_a, $equipo_b, $equipo_c, $equipo_d, $equipo_e, $equipo_f, $equipo_g, $equipo_h,$año);
			if($idVi==" ")
				$idVi=$vivienda->guardar();
			else
				$vivienda->actualizar();
			echo $idVi;
			break;
                      
               
                   
        }
?>

