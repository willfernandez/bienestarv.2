<?php
    require_once("models/annio.php");
    
    $annio= new annio('', '', '', '', '');
    $a=$annio->listarSimple('', 'activo', '=', '1', '', '', '');
    $html="
        
            <label>Año Académico</label>
            <div class='xinput'>
            <select required='1' name='annio_id' id='annio_id';>
           <option value=''>Seleccione.. </option>";
    $na=count($a);
    for($i=0;$i<$na;$i++){
        $html.="<option value='".$a[$i][0]."'>".$a[$i][1]."</option>";
    }
    $html.="</select></div><br/>
        ";
    echo $html;
?>
