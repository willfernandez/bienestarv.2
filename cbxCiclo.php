<?php
    require_once("models/carreraciclos.php");
    $carrera=$_REQUEST['carrera_id'];
    $ciclo = new carreraciclos('','', '');
    $a=$ciclo->listar('', "", "", $carrera, "", "", "");
    $html="
        
            <label>Ciclo</label>
            <div class='xinput'>
            <select required='1' name='cicloAl_id' id='cicloAl_id';>
           <option value=''>Seleccione.. </option>";
    $na=count($a);
    for($i=0;$i<$na;$i++){
        $html.="<option value='".$a[$i][0]."'>".$a[$i][1]."</option>";
    }
    $html.="</select></div>
        ";
    echo $html;
?>
