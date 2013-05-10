<?php
      session_start();
    $boton=$_REQUEST['boton'];	
    if($boton=='Guardar')
	{
            $iidE=$_REQUEST['iidE'];
            $familiarE=$_REQUEST['familiarE'];
            $nombreE=$_REQUEST['nombreE'];
            $telefonoE=$_REQUEST['telefonoE'];
            $emailE=$_REQUEST['emailE'];
            $direccionE=$_REQUEST['direccionE'];
        }
    if($boton=='listarTabla')
    {
        $alumno_id=$_REQUEST['alumno_id'];
        $annio = $_SESSION['año'];
    }
    if($boton=='Eliminar')
    {
        $id=$_REQUEST['id'];
    }
        
     require_once("models/emergencia.php");
	switch($boton)
	{	case 'Guardar':
                        $alumno_id=$_SESSION['id'];
                        $año=$_SESSION['año'];
                        $emergencia = new emergencia($iidE, $alumno_id, htmlentities("$nombreE", ENT_QUOTES,"UTF-8"),  htmlentities("$familiarE", ENT_QUOTES,"UTF-8"), $direccionE, $telefonoE, $emailE,$año);
			if($iidE=="")
				$iidE=$emergencia->guardar();
			else
				$emergencia->actualizar();
			echo $iidE;
			break;
                      
                case 'listarTabla':
                    $alumno_id=$_SESSION['id'];
                            $emergencia = new emergencia('', '', '', '', '', '', '','');
                            $a=$emergencia->listarSimple('', 'alumno_id*academico_id', '=*=', $alumno_id."*".$annio, 'AND', '', '');
                                //$camposMostrar,$campo,$operador,$valor,$separador,$inicio,$fin
                                $html="<table align='center' class='table table-striped table-bordered dataTable' id='document'>
                                <thead><tr><th>No</th><th>Familiar</th><th>Nombres y Apellidos</th><th>Telefono</th><th>Acci&oacute;n</th></tr></thead><tbody>";
                                $na=count($a);$c=0;
                                for($i=0;$i<$na;$i++)
                                {	$c++;
                                        $data=$a[$i][0].'*'.$a[$i][2].'*'.$a[$i][3].'*'.$a[$i][4].'*'.$a[$i][5].'*'.$a[$i][6];
                                        $html.="<tr>
                                                                <th>".$c."</th>
                                                                <td>".$a[$i][3]."</td>
                                                                <td>".$a[$i][2]."</td>
                                                                <td>".$a[$i][5]."</td>
                                                                <td>
                                                                        <a  href='#myModal' data-toggle='modal' id='Modificar*$data' title='Editar'><img src='images/editar.png' tile='editar'/></a>
                                                                        <a href='#' id='Eliminar*$data' title='Eliminar'><img src='images/borrar.png' /></a>
                                                                </td>
                                                        </tr>";
                                }
                                $html.="</tbody></table>
                                <script src='jsshadow/frmEmergenciaSelect.js'></script>";
                                echo $html;
                    break;
                    
                    case 'Eliminar':
			$emergencia = new emergencia($id, '', '', '', '', '', '');
			$emergencia->eliminar();
			break;
                        
        }
?>
