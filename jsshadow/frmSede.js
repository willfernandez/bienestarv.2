$(document).on("ready", inicio);

function inicio(){

    $.ajax({
        type:"POST",
        url: "cSedes.php",
        data: "boton=Cargar",
       success: function(html){
           $('#Sedes').html(html);
            $('#tsedes').dataTable( {
					"sPaginationType": "bootstrap",
					"sDom": "<'row'<'span5'l><'span4'f>r>t<'row'<'span5'i><'span4'p>>"
				} );
           
       }
    });
  }

function guardarSede()
{
  var nombre = $("#nsede").val()
  $.ajax({
        type:"POST",
        url: "cSedes.php",
        data: "boton=Guardar&nsede="+nombre,
       success: function(html){
        alert("Sede Guardada")
            inicio();           
       }
    });
}