<?php
    require_once("models/facultad.php");
    $facultad = new facultad('', '', '');
    $a=$facultad->listarSimple("","","","","","", "");
    $html='
            <label>Facultad</label>
            <div class="xinput">
            <select onchange="cargarCarreras();" name="facultadAl_id" id="facultadAl_id" required="1">
           <option value="">Seleccione.. </option>';
    $na=count($a);
    for($i=0;$i<$na;$i++){
        $html.="<option value='".$a[$i][0]."'>".$a[$i][2]."</option>";
    }
    $html.="</select></div><br/>
        ";
    echo $html;
?>
