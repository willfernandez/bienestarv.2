<?php
    require_once("models/sede.php");
    
    $sede= new sede('', '');
    $a=$sede->listarSimple('', '', '', '', '', '', '');
    $html="
        
            <label>Sede</label>
            <div class='xinput'>
            <select required='1' name='sede_id' id='sede_id'>
           <option value=''>Seleccione.. </option>";
    $na=count($a);
    for($i=0;$i<$na;$i++){
        $html.="<option value='".$a[$i][0]."'>".$a[$i][1]."</option>";
    }
    $html.="</select></div><br/>
        ";
    echo $html;
?>
