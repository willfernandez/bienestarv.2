
<?php
ini_set('display_errors',0);
session_start();
//echo "...".$_SESSION['autenticado'];
if($_SESSION['autenticadoU']=='SI')
{
?>
<!DOCTYPE html>
<html>
<head>

    <meta charset="utf-8">
    <title>Ficha Socioeconómica Bienestar UJCM</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" type="image/x-icon" href="img/favicon.ico">

    <!-- Le styles -->
    <link rel="stylesheet" href="cssshadow/normalize.css" />
         <link href='http://fonts.googleapis.com/css?family=Open+Sans' rel='stylesheet' type='text/css' />
      <link href="cssshadow/jqueryui.css" type="text/css" rel="stylesheet"/>
      <link href="cssshadow/bootstrap.css" type="text/css" rel="stylesheet"/>
      <link href="cssshadow/bootstrap-responsive.css" type="text/css" rel="stylesheet"/>
    <link href="cssshadow/docs.css" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="cssshadow/jquery.datatables.css">
      
      
      <link rel="stylesheet" href="css/ui-lightness/jquery-ui-1.8.21.custom.css" type="text/css"/>
   <script src="jsshadow/scripts/jquery.min.js"></script>
   <script src="jsshadow/scripts/jquery.js"></script>
    <script src="jsshadow/scripts/bootstrap-tab.js"></script>
    <script src="jsshadow/scripts/bootstrap-dropdown.js"></script>
    <script src="jsshadow/scripts/bootstrap-collapse.js"></script>
    <script src="jsshadow/scripts/bootstrap-modal.js"></script>
   <script src="jsshadow/scripts/bootstrap-transition.js"></script>
    <script src="jsshadow/scripts/jquery.dataTables.js" type="text/javascript"></script>
    <script src="jsshadow/scripts/DT_bootstrap.js" type="text/javascript"></script>
    <script src="jsshadow/scripts/script.js"></script>
    <script type="text/javascript" src="http://code.jquery.com/ui/1.8.21/jquery-ui.min.js"></script>
    <script type="text/javascript" language="javascript" src="jsshadow/scripts/jquery.dataTables.js"></script>
    <script type="text/javascript" language="javascript" src="jsshadow/scripts/DT_bootstrap.js"></script>
    <script src='jsshadow/frmAlumno.js'></script>
      
  
    <style>
        input{
        height: 26px;
        }
        
        h4{
             border-top-color:#1d5987;border-top-style: solid;border-top-width: 3px;
             font-size: 18px;
              line-height: 35px;
        }
    </style>
     
</head>

<body> 
   <?php include('includes/menu.php') ?>
<div class="container" style="margin-top: 60px;min-height: 450px;">
     <div class="content">
    <div class="page-header" style="padding-bottom: 44px;">
		<h1>Sistema de Gestión de Fichas Socioeconómicas</h1>
    </div>
    <div id="finder" style="display: block;">
        Buscar por:
            <select id="campo" name="campo">
                <option  value="a.nombres">Nombres</option>
                <option selected="selected"value="a.apellidos">Apellidos</option>
                <option value="a.codigo">Código Universitario</option>
                <option value="a.dni">Tipo Documento</option>
            </select>

             <select id="operador" name="operador">
                <option value="LIKE">Similar a</option>
             </select>

        <input id="valor" type="text" name="valor"><br/>
        <input id="btnbuscar" type="button" onclick="listarAlumnos();" value="Buscar">

         <div id="pacman">
            <img alt="loading" style="width:20px;margin-top: 60px;" src="data:image/gif;base64,R0lGODlhDwAPAPfDACF0qxRspsDY5yV2rOfw9hVtpgRioOry9y58ryp6riB0q+nx9ix7rw5opCZ3rQNhnyJ1q+fv9myjx8LZ6M3g6wtnog5oo+nx9wNioGuixyl6rs/h7G+kyC59sApnoi18rw5ppAdjoefv9S17r3ClyCN2q7fR5A9ppAxnoxBqpMDY6AFgnyN1rLHO4SN2rLLO4RxxqQRin+rx9wVioOrx9hJrpQBcnCZ3rPr8/Sl5ruLt9Ct7rzyFtQpmogtmowtmogtno/n7/LrT5Ct6rw9poxlvqObv9QhloeLs877W5h1yqQ9opH2tzv/+/UCHthFqpafH3TqDtL3W5luYwMjc6r3V5ghlosLZ53ClycHY5zJ/sRhuqPX4+uXu9R5yqrLP4unw9gNin4Sx0DJ+sU2PuwBfnmigxtLj7hxxqJK71gJhn2WexKvL3qrK3rXQ4glmovv8/Wqixm2jxx5zqsve6zB+sG2kx5/C2vT4++Ds8+Pt9B1xqdPk7u/1+USKt7/X5+jw9mihxix7rgBgn8ve6mSewx9zqgRhoDyEtVWUvlCRvZS81tvo8RVspjN/sdzp8g1opPv9/s7h61GSvRNspk6RvCBzqhBqpdPj7iJ1rDeCsxdup5O71QVjoPb5+wllokeMuSV3rSx6r2OdxN3q8g1ooyt7rrPP4TqEtLTQ4xtxqWGcw2KcwxBppQRhny58sJC51G+lyMHY6CF0qip5rr7X5oWy0EyPurXQ4wJhoIaz0EGItgBfn7PQ4gllodfm7yV3rCR2rP///////wAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAACH/C05FVFNDQVBFMi4wAwEAAAAh/wtYTVAgRGF0YVhNUDw/eHBhY2tldCBiZWdpbj0i77u/IiBpZD0iVzVNME1wQ2VoaUh6cmVTek5UY3prYzlkIj8+IDx4OnhtcG1ldGEgeG1sbnM6eD0iYWRvYmU6bnM6bWV0YS8iIHg6eG1wdGs9IkFkb2JlIFhNUCBDb3JlIDUuMy1jMDExIDY2LjE0NTY2MSwgMjAxMi8wMi8wNi0xNDo1NjoyNyAgICAgICAgIj4gPHJkZjpSREYgeG1sbnM6cmRmPSJodHRwOi8vd3d3LnczLm9yZy8xOTk5LzAyLzIyLXJkZi1zeW50YXgtbnMjIj4gPHJkZjpEZXNjcmlwdGlvbiByZGY6YWJvdXQ9IiIgeG1sbnM6eG1wPSJodHRwOi8vbnMuYWRvYmUuY29tL3hhcC8xLjAvIiB4bWxuczp4bXBNTT0iaHR0cDovL25zLmFkb2JlLmNvbS94YXAvMS4wL21tLyIgeG1sbnM6c3RSZWY9Imh0dHA6Ly9ucy5hZG9iZS5jb20veGFwLzEuMC9zVHlwZS9SZXNvdXJjZVJlZiMiIHhtcDpDcmVhdG9yVG9vbD0iQWRvYmUgUGhvdG9zaG9wIENTNiAoTWFjaW50b3NoKSIgeG1wTU06SW5zdGFuY2VJRD0ieG1wLmlpZDowQzgxNzQ3ODMyNzMxMUUyODczN0IwMTA5MzYyQTdERiIgeG1wTU06RG9jdW1lbnRJRD0ieG1wLmRpZDowQzgxNzQ3OTMyNzMxMUUyODczN0IwMTA5MzYyQTdERiI+IDx4bXBNTTpEZXJpdmVkRnJvbSBzdFJlZjppbnN0YW5jZUlEPSJ4bXAuaWlkOjBDODE3NDc2MzI3MzExRTI4NzM3QjAxMDkzNjJBN0RGIiBzdFJlZjpkb2N1bWVudElEPSJ4bXAuZGlkOjBDODE3NDc3MzI3MzExRTI4NzM3QjAxMDkzNjJBN0RGIi8+IDwvcmRmOkRlc2NyaXB0aW9uPiA8L3JkZjpSREY+IDwveDp4bXBtZXRhPiA8P3hwYWNrZXQgZW5kPSJyIj8+Af/+/fz7+vn49/b19PPy8fDv7u3s6+rp6Ofm5eTj4uHg397d3Nva2djX1tXU09LR0M/OzczLysnIx8bFxMPCwcC/vr28u7q5uLe2tbSzsrGwr66trKuqqainpqWko6KhoJ+enZybmpmYl5aVlJOSkZCPjo2Mi4qJiIeGhYSDgoGAf359fHt6eXh3dnV0c3JxcG9ubWxramloZ2ZlZGNiYWBfXl1cW1pZWFdWVVRTUlFQT05NTEtKSUhHRkVEQ0JBQD8+PTw7Ojk4NzY1NDMyMTAvLi0sKyopKCcmJSQjIiEgHx4dHBsaGRgXFhUUExIREA8ODQwLCgkIBwYFBAMCAQAAIfkEBQUAwwAsAAAAAA8ADwAACJ0AhQkUSGDCCwEyBioUdkCChhQrGrxipWfhhg4GCigYAGFFAFIKIyDwMCBYMGAwWglZSOIBMJPBIHSCtfDAiAAwgfm6tVCYAAsAYBZBVXGhiRAlTLI4oqunzwZBTaoa8qvnBQY4TTr4sStITw4YXpp00clWTxEfKogFpqQBrp4UEGQEAIxFro89F2RIAIIXCgarkDgVRkBFiySAFgYEACH5BAUFAMMALAUAAAAIAA8AAAhmAIcNczPhgECBJ2KcMGWHxsFgCgLMgJBEYLABwIBYYCMQmIsjPBgJdADj0JQFB+c4EHNwWLAalVoKzLRlDY6WwBRgAPWoZTBgPcZgehjMQYMfbSxGnChFoJoTCeQ4HCbgSxaUAgMCACH5BAUFAMMALAYAAAAIAA8AAAhvAIe9+CNjmMFhKVag2BEHzMEBAIY9ECXpYLBgDqwY4jMs2IBgl4hEoRJKQYoKiO7gGAYgBxkoQQ5ucoLkoEEWljSl6WOTRYBPdRbhsXiDkg8tVyw6eOPlzDBgEArEyEHIYJkew8x0MaiiRRUCNgMCACH5BAUFAMMALAUAAAAKAA8AAAhwAIcJFCCwoEFIDCQsMMiQAQWGAgegEGTEYLBhwW7YSBRp2AAIRZ40ALJnlKdhEBjwUMREiA6BLpQ44tQEYjAAO/xgOZWnYLBgMGos8YGmEBeLwRzYmASHITAUCV4WBBAgTAI6BgeVGhIoAkQBFxgGBAAh+QQFBQDDACwFAAAACgAPAAAIYACHDes1gYDAg8NOPDihYdgBhMOCKShgoMMGiAc9IIiAcRiwGLGERQxGkmSjBIBGlgwG4UetlStdpRIIcxYRWQdXNqJlECIwAxxEQqzwwQhEiggoIFwBIkGGBRhV9DwYEAAh+QQFBQDDACwFAAAACgAPAAAIcgCHDXshQIbAg8NSrIDEYNgChMMGAAjwgAEFiAdRCDKCcdgNG4kiRYRQ5EkDIHtGeRoGgQEPRUyE6BAmzIUSR5ya0NwpEMAOP1hO5aF5EEaNJT7QFOKC0YGNSXAwokigA2KAMAnoIBxUakigCBgFXIAYEAAh+QQFBQDDACwFAAAACgAPAAAIbACHCfwjsKBBFDvigDHIUJQkhgIdWDHEx+CAYZeIRKEibFgoBSkqILqDQ1hHADnIQAliUmCwTU6QdGTIwpKmNH1aCgTGIsCnOovw6BR4g5IPLVdmFnTwxssZgxAKxMhByGCZHgnMdIFYhQDDgAAh+QQFBQDDACwGAAAACAAPAAAIZwCHuZlwYJjBYSdinDBlh8bBYAqGzYCQ5OAAYEAssBE2DJiLIzwYCRPmAMahKQtGDpvjQIxKgzUqcTw4LNOWNThmGlSAAdSjlx17jMEE1EGDH204QgwwUYpBNSeGyXE4TMCXLAtoBgQAOw==" />
         </div>
    </div>
         <div id="results"></div>
	
</div>

     
 </div>
<div class="hide fade modal" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-header">
<button class="close" aria-hidden="true" data-dismiss="modal" type="button">×</button>
<h3 id="myModalLabel" style="float:left"><div id="NomAl"></div></h3> <span style="color: #999999;padding-left: 50px;"><strong><span id="codAL"></span>  </strong></span><br/><br/>
</div>
 <div class="modal-body">
     <div class="row" style="margin:auto;">
           <div class="span2"><img src="images/Perfil.PNG" style="border:3px solid #ccc;" width="100%"/></div> 
            <div class="span3" style="text-align: justify;" id="informacion">
               
                
            </div>
            
    </div>
</div>
  <div class="modal-footer">
    <button class="btn" data-dismiss="modal" aria-hidden="true">Cerrar</button>
    <button class="btn btn-primary">Guardar Cambios</button>
  </div>
</div>
  <script src='jsshadow/frmAlumno.js'></script>
</body>
<script src='jsshadow/frmUsuario.js'></script>
</html>
<?php

}
else{
	echo "Ud. no est&aacute; autorizado para ver esta p&aacute;gina...";
        
?>

<html>
<head>
<meta http-equiv="Refresh" content="4;url=frmAdmin.php">
</head>

</html>

<?php 
}
?>