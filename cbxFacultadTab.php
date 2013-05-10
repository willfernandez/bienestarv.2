<?php
    require_once("models/facultad.php");
    $facultad = new facultad('', '', '');
    $a=$facultad->listarSimple("","","","","","", "");
    $boton = $_REQUEST['boton'];
        switch($boton)
	{	case 'AspcFam':
            
                            $html='
                                    <label>Facultad</label>
                                    <div class="xinput">
                                    <select  name="facultad" id="facultadAl_id" class=":required">
                                <option value="">Seleccione.. </option>';
                            $na=count($a);
                            for($i=0;$i<$na;$i++){
                                $html.="<option value='".$a[$i][0]."'>".$a[$i][2]."</option>";
                            }
                            $html.="</select></div><br/>
                                ";
                            echo $html;
                            break;
                            
                case 'Violencia':
                    
                            $html='
                                    <label>Facultad</label>
                                    <div class="xinput">
                                    <select  name="facultad" id="facultadAl_id" required="1">
                                <option value="">Seleccione.. </option>';
                            $na=count($a);
                            for($i=0;$i<$na;$i++){
                                $html.="<option value='".$a[$i][0]."'>".$a[$i][2]."</option>";
                            }
                            $html.="</select></div><br/>
                                ";
                            echo $html;
                            break;
                            
                case 'Deuda':
                             $html='
                                    <label>Facultad</label>
                                    <div class="xinput">
                                    <select name="facultad" id="facultadAl_id" required="1">
                                <option value="">Seleccione.. </option>';
                            $na=count($a);
                            for($i=0;$i<$na;$i++){
                                $html.="<option value='".$a[$i][0]."'>".$a[$i][2]."</option>";
                            }
                            $html.="</select></div><br/>
                                ";
                            echo $html;
                                break;
                                
           case 'Educacion':
                             $html='
                                    <label>Facultad</label>
                                    <div class="xinput">
                                    <select name="facultad" id="facultadAl_id" class=":required">
                                <option value="">Seleccione.. </option>';
                            $na=count($a);
                            for($i=0;$i<$na;$i++){
                                $html.="<option value='".$a[$i][0]."'>".$a[$i][2]."</option>";
                            }
                            $html.="</select></div><br/>
                                ";
                            echo $html;
                    break;
                    
           case 'Salud':
                             $html='
                                    <label>Facultad</label>
                                    <div class="xinput">
                                    <select name="facultad" id="facultadAl_id" class=":required">
                                <option value="">Seleccione.. </option>';
                            $na=count($a);
                            for($i=0;$i<$na;$i++){
                                $html.="<option value='".$a[$i][0]."'>".$a[$i][2]."</option>";
                            }
                            $html.="</select></div><br/>
                                ";
                            echo $html;
                    break;
                    
                    
   
    }
    
?>
