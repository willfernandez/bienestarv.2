<?php
    session_start();  
    $boton=$_REQUEST['boton'];	
    if($boton=='Guardar')
	       {
            $idDatos=$_REQUEST['idDatos'];
            $domicilioActual=$_REQUEST['domicilioActual'];
            $telefonoA=$_REQUEST['telefonoA'];
            $departamento_id=$_REQUEST['departamentoA'];
            $provincia_id=$_REQUEST['provinciaA'];
			      $fecha=$_REQUEST['fechaNac'];
          }
     if($boton=='Listar'){
         $alumno_id=$_REQUEST['alumno_id'];
     }
     require_once("models/datoGenerales.php");
    	switch($boton)
    	{	
              case 'Guardar':
                                  $alumno_id=$_SESSION['id'];
                                  $año=$_SESSION['año'];
                                  
                                  $datos= new datoGenerales($idDatos, $alumno_id, $departamento_id, $provincia_id, htmlentities("$domicilioActual", ENT_QUOTES,"UTF-8"), $telefonoA,$fecha,$año);
          			if($idDatos=="")
          				$idDatos=$datos->guardar();
          			else
          				$datos->actualizar();
          			echo $idDatos;
          			break;

                /////

                
                case 'Listar':
                        $datos = new datoGenerales('', '', '', '', '', '', '','');
                        $a=$datos->listarSimple('', 'alumno_id', '=', $alumno_id, '', '', '');
                         $na=count($a);
                                for($i=0;$i<$na;$i++)
                                {	
                                        $data=$a[$i][0].'*'.$a[$i][1].'*'.$a[$i][2].'*'.$a[$i][3].'*'.$a[$i][4].'*'.$a[$i][5].'*'.$a[$i][6];
                                }
                    
                        echo $data;
                    break;

                    ///////////


                case 'listarReporte':
                    $datos = new datoGenerales('', '', '', '', '', '', '','');
                    $a=$datos->listarSimple('COUNT(departamento_id)', 'departamento_id', '=', 'Moquegua', '', '', '');
                     $na=count($a);
                            for($i=0;$i<$na;$i++)
                            {	
                                  $nombreciudad='Moquegua';
                                  $cantidadC=$a[$i][0];
                                     
                            }
                break;
                      
               
                   
        }
?>

