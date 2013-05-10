<?php
    require_once("models/provincia.php");
    $departamento_id=$_REQUEST['departamento_id'];
    $provincia = new provincia('','','');
    $a=$provincia->listarSimple("","departamento_id","=","$departamento_id","","", "");
    $html='
            <label>Provincias</label>
            <div class="xinput">
            <select name="provinciaAl" id="provinciaAl">
           <option value="">Seleccione.. </option>';
    $na=count($a);
    for($i=0;$i<$na;$i++){
        $html.="<option value='".$a[$i][0]."'>".$a[$i][1]."</option>";
    }
    $html.="</select></div><br/>
        ";
    echo $html;
?>
