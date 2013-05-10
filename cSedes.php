<?php
     session_start(); 
    $boton=$_REQUEST['boton'];	
        if($boton == 'Guardar'){
            $nombre = $_REQUEST['nsede'];
        }
     require_once("models/sede.php");
	switch($boton)
	{	
             case 'Cargar':
                 $sede = new sede('','');
                 $a= $sede->listarSimple('', '', '', '', '', '', '');
                 $na=count($a);
                 if($na>0){
                     $html="<table style='margin-top: 24px;' align='center' class='dataTables table table-striped table-bordered table-condensed' id='tsedes'>
                                <thead><tr>
                                            <th>#</th>
                                            <th>Institución</th>
                                            <th>Acciones</th>
                                        </tr>
                                 </thead><tbody>";
                               $c=0;
                                for($i=0;$i<$na;$i++)
                                {	$c++;
                                        $html.="<tr>
                                                        <th>$c</th>
                                                        <td>".$a[$i][1]."</td>
                                                        <td><a href='#myModal' data-toggle='modal' >Ver </a></td>
                                                </tr>";
                                }
                            $html.="</tbody></table>";
                            echo $html;
                 }else{
                 echo "no hay nada aca";
                 }
                   break;   



           case 'Guardar':
                        $sede = new sede('',$nombre);
                        $id = $sede->guardar();
                        echo $id;
           break;
        }
?>

