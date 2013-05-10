<?php
    require_once("models/facultad.php");
    $idFac=$_REQUEST['idFac'];
    $facultad = new facultad('', '', '');
    $a=$facultad->listarSimple("","id","=",$idFac,"","", "");
    $html='
            <label>Facultad</label>
            <div class="xinput">
            <select name="facultad"  id="facultadR_id" class=":required">';
    $na=count($a);
    for($i=0;$i<$na;$i++){
        $html.="<option value='".$a[$i][0]."'>".$a[$i][2]."</option>";
    }
    $html.="</select></div><br/>
        ";
    echo $html;
?>
