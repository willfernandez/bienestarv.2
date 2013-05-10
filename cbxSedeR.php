<?php
    require_once("models/sede.php");
     $idSede=$_REQUEST['idSede'];
    $sede= new sede('', '');
    $a=$sede->listarSimple('', 'id', '=', $idSede, '', '', '');
    $na = count($a);
    if($na>0){
    $html="
        
            <label>Sede</label>
            <div class='xinput'>
            <select required='1' name='sede' id='sede_id'>";
            $na=count($a);
            for($i=0;$i<$na;$i++){
                $html.="<option value='".$a[$i][0]."'>".$a[$i][1]."</option>";
            }
            $html.="</select></div><br/>";
    }else{
        $html="
        
            <label>Sede</label>
            <div class='xinput'>
            <select required='1' name='sede' id='sede_id'>
           <option value=''>CONSOLIDADO </option>";
            $html.="</select></div><br/>";
    }
    echo $html;
?>
