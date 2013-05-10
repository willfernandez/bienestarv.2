<?php
    require_once("models/carrera.php");
    $facultadAl_id=$_REQUEST['facultadAl_id'];
    $carrera = new carrera('','', '');
    $a=$carrera->listarSimple("","facultad_id","=",$facultadAl_id,"","", "");
    $html="
        
            <label>Carrera</label>
            <div class='xinput'>
            <select required='1' id='carreraAl_id' name='carreraAl_id' onchange='cargarCiclos();'>
           <option value=''>Seleccione.. </option>";
    $na=count($a);
    for($i=0;$i<$na;$i++){
        $html.="<option value='".$a[$i][0]."'>".$a[$i][1]."</option>";
    }
    $html.="</select></div><br/>
        ";
    echo $html;
?>
