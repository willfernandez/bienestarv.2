<?php
    require_once("models/carreraciclos.php");
    $carrera=$_REQUEST['carrera_id'];
    $ciclo = new carreraciclos('','', '');
    $a=$ciclo->listar('', "", "", $carrera, "", "", "");
    $html="
            <label>Ciclo</label>
            <div class='xinput'>
            <select id='cicloR_id' name='ciclo'>
           <option value='0'>Seleccione.. </option>";
    $na=count($a);
    for($i=0;$i<$na;$i++){
        $html.="<option value='".$a[$i][0]."'>".$a[$i][1]."</option>";
    }
    $html.="</select></div><br/>
        ";
    echo $html;
?>


