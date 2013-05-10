<?php
     session_start(); 
    $boton=$_REQUEST['boton'];	
        
        if($boton=='Guardarr'){
            $codalum=$_REQUEST['codalum'];
            $carrera_id=$_REQUEST['carreraAll_id'];
            $modE=$_REQUEST['modAll'];
            $ciclo=$_REQUEST['cicloAl_idl'];
            $sede_id=$_REQUEST['sede_idl'];
            $annio_id=$_REQUEST['annio_idl'];
        }
      
     require_once("models/matricula.php");
	switch($boton)
	{	
             case 'Guardarr':
                 
                    $matricula = new matricula('', $codalum, $carrera_id, $modE, $sede_id, $ciclo, $annio_id);
                    $idmat=$matricula->guardar();
                    $m = $matricula->listarSesion('ma.id*ma.modalidadEstudio*ca.nombre_carrera*fa.siglas*fa.nombreFacult*ci.ciclo','ma.ciclo_id*ma.carrera_id*ca.facultad_id*alumno_id*annio_id',"=*=*=*=*=","ci.id*ca.id*fa.id*".$codalum.'*'.$annio_id,'AND*AND*AND*AND','','');
                    $nm=count($m);
                    if($nm>0){

                        $_SESSION['matriculado']='Si';
                        $_SESSION['matId']=$m[0][0];
                        $_SESSION['modE']=$m[0][1];
                        $_SESSION['carerra']=utf8_encode($m[0][2]);
                        $_SESSION['sig']=$m[0][3];
                        $_SESSION['facu']=utf8_encode($m[0][4]);
                        $_SESSION['ciclo']=$m[0][5];

                    }

                    echo $idmat;
                 break;
                        
                   
        }
?>

