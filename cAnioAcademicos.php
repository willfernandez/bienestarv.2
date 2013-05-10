<?php
     session_start(); 
    $boton=$_REQUEST['boton'];	
    if($boton=='Guardar'){
        $id = $_REQUEST['id'];
        $nombre = $_REQUEST['nombre'];
        $fechaI = $_REQUEST['fechaI'];
        $fechaF = $_REQUEST['fechaF'];
        $activo = $_REQUEST['activo'];

    }    
    require_once("models/annio.php");
	switch($boton)
	{	
            case 'Guardar':
                    $fechaI1=date("Y-m-d",strtotime($fechaI));
                    $fechaF1=date("Y-m-d",strtotime($fechaF));
                    $annio = new annio($id,$nombre,$fechaI1,$fechaF1,$activo);
                    if($id==''){
                    $id= $annio->guardar();
                    }else{
                        $annio->actualizar();
                    }
                    echo $id;
            break;

             case 'Cargar':
                 $annio = new annio('','', '', '', '');
                 $a= $annio->listarSimple('id*nombre_anio*DATE_FORMAT(fecha_inicio,"%d-%m-%Y")*DATE_FORMAT(fecha_fin,"%d-%m-%Y")*activo','', '','','','','');
                 $na=count($a);
                 if($na>0){
                     $html="<table style='margin-top: 24px;' align='center' class='table table-striped table-bordered dataTable' id='tAnios'>
                                <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Año académico</th>
                                    <th>Fecha inicio</th>
                                    <th>Fecha fin</th>
                                    <th>Activo</th>
                                    <th>Acciones</th>
                                </tr>
                                </thead>
                                <tbody>";
                               $c=0;
                                for($i=0;$i<$na;$i++)
                                {	$c++;
                                        $html.="<tr>
                                                        <th>$c</th>
                                                        <td>".$a[$i][1]."</td>
                                                        <td>".$a[$i][2]."</td>
                                                        <td>".$a[$i][3]."</td>
                                                        <td>";
                                                            if($a[$i][4]):
                                                                $html.='<a title="Inactivo" href="frmConfiguracion.php">
                                                                     <img alt="" src="img/tick_circle.png">
                                                                
                                                                </a>';
                                                                else: 
                                                            $html.= '<a title="Activo" href="frmConfiguracion.php">
                                                                <img alt="" src="img/icon-16-delete.png">   
                                                                    </a>';
                                                                endif;
                                                        $datos=$a[$i][0].'*'.$a[$i][1].'*'.$a[$i][2].'*'.$a[$i][3].'*'.$a[$i][4];
                                                        $html.="</td>
                                                        <td>
                                                            <a class='edit' href='#myModal' data-toggle='modal' title='Editar' id='editAnios*$datos'>Editar</a>
                                                         </td><script src='jsshadow/frmAnioSelect.js'></script>
                                                        </tr>";
                                }
                            $html.='</tbody></table><script src="jsshadow/frmAnioSelect.js"></script>';
                            echo $html;
                    break;
                 }else{
                 echo "no hay nada aca";
                 break;}
                      
               
                   
        }
?>

