<?php
    $boton=$_REQUEST['boton'];	
    if($boton=='BuscarNombreC')
	{
            $idC=$_REQUEST['ciclo'];
            
            
        }
     require_once("models/ciclo.php");
	switch($boton)
	{	case 'BuscarNombreC':
                      $ciclo = new ciclo('', '');
                      $nombre= $ciclo->listarSimple('ciclo', 'id', '=', $idC, '', '', '');
                      $nc=count($nombre);
                          if($nc>0)
                      echo $nombre[0][0];
                          else
                              echo 'CONSOLIDADO';
                break;
                   
        }
?>

