<?php
    require_once("models/carrera.php");
    $facultadAl_id=$_REQUEST['facultadAl_id'];
    $carrera_id=$_REQUEST['carrera_id'];
    $carrera = new carrera('','', '');
    $a=$carrera->listarSimple("","facultad_id*id","=*=",$facultadAl_id.'*'.$carrera_id,"AND","", "");
    $html="
        
            <label>Carrera</label>
            <div class='xinput'>
            <select class=':required' id='carreraR_id' name='carrera'>";
    $na=count($a);
    for($i=0;$i<$na;$i++){
        $html.="<option value='".$a[$i][0]."'>".$a[$i][1]."</option>";
    }
    $html.="</select></div><br/>
        ";
    echo $html;
?>
