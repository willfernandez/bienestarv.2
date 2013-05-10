<?php
      session_start();
    $boton=$_REQUEST['boton'];	
    if($boton=='Guardar')
	{
            $idEco=$_REQUEST['idEco'];
            $tipoFamiliaEco=$_REQUEST['tipoFamiliaEco'];
            $nombreEco=$_REQUEST['nombreEco'];
            $edadEco=$_REQUEST['edadEco'];
            $ocupacionEco=$_REQUEST['ocupacionEco'];
            $ingresosEco=$_REQUEST['ingresosEco'];
        }
    if($boton=='listarTabla')
    {
        $alumno_id=$_SESSION['id'];
        $annio = $_SESSION['año'];
    }
    if($boton=='Eliminar')
    {
        $idEco=$_REQUEST['id'];
    }
        
     require_once("models/economia.php");
	switch($boton)
	{	case 'Guardar':
                        $alumno_id=$_SESSION['id'];
                        $año=$_SESSION['año'];
                        $economia = new economia($idEco, $alumno_id, $tipoFamiliaEco, htmlentities($nombreEco, ENT_QUOTES,"UTF-8"), $edadEco, htmlentities($ocupacionEco, ENT_QUOTES,"UTF-8"), $ingresosEco,$año);
            			if($idEco==""){
                            $_SESSION['bandera']='Sii';
            				$idEco=$economia->guardar();
                        }
            			else{
                            $_SESSION['bandera']='Sii';
            				$economia->actualizar();

                        }
            			echo $idEco;
			break;
                      
                case 'listarTabla':
                            $economia = new economia('', '', '', '', '', '', '','');
                            $a=$economia->listarSimple('', 'alumno_id*academico_id', '=*=', $alumno_id."*".$annio, 'AND', '', '');
                                //$camposMostrar,$campo,$operador,$valor,$separador,$inicio,$fin
                                $html="<table align='center' class='table table-striped table-bordered dataTable'>
                                <thead><tr><th>No</th><th>Nombres y Apellidos</th><th>Ingresos</th><th>Acci&oacute;n</th></tr></thead><tbody>";
                                $na=count($a);$c=0;
                                for($i=0;$i<$na;$i++)
                                {	$c++;
                                        $data=$a[$i][0].'*'.$a[$i][2].'*'.$a[$i][3].'*'.$a[$i][4].'*'.$a[$i][5].'*'.$a[$i][6];
                                        $html.="<tr>
                                                                <th>$c</th>
                                                                <td>".$a[$i][3]."</td>
                                                                <td>".$a[$i][6]."</td>
                                                                <td>
                                                                        <a  href='#emergencia' data-toggle='modal' id='Modificar*$data'><img src='images/editar.png'/></a>
                                                                        <a href='#' id='Eliminar*$data'><img src='images/borrar.png'/></a>
                                                                </td>
                                                        </tr>";
                                }
                                $html.="</tbody></table>
                                <script src='jsshadow/frmEconomiaSelect.js'></script>";
                                echo $html;
                    break;
                    
                    case 'Eliminar':
			 
                        $economia = new economia($idEco,'','', '', '', '', '');
			$economia->eliminar();
			break;
                        
        }
?>
