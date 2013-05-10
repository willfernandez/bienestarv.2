<?php
    require_once("models/departamento.php");
    $departamento = new departamento('', '');
    $a=$departamento->listarSimple("","","","","","", "");
    $html='
            <label>Departamento</label>
            <div class="xinput">
            <select onchange="cargarProvincia(this.value);" name="departamentoA" id="departamentoA">
           <option value="">Seleccione.. </option>';
    $na=count($a);
    for($i=0;$i<$na;$i++){
        $html.="<option value='".$a[$i][0]."'>".$a[$i][1]."</option>";
    }
    $html.="</select></div><br/>
        ";
    echo $html;
?>
