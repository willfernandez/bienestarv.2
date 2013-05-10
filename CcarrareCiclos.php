<?php
    $boton=$_REQUEST['boton'];	
    if($boton=='guardar')
	{
		$idCarrera = $_REQUEST['idCarrera'];
		$nciclos = $_REQUEST['nciclos'];
	}

	 require_once("models/carreraciclos.php");
	 require_once("models/ciclo.php");
	switch($boton)
	{	
     case 'guardar':
                      $ciclo = new ciclo('', '');
                      $a= $ciclo->listarSimple('', '', '', '', '', '', '');
                      $na = count($a);
                      for ($i=0;$i<$nciclos;$i++){
                      	$carciclo = new carreraciclos('',$a[$i][0],$idCarrera)	;
                      	$id = $carciclo->guardar();
                      }
					echo $id;                      
      break;
                   
  }
?>