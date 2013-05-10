
$(document).ready(function()
{
    $('#pacman').hide();
});
function listarAlumnos(){
     $('#pacman').show();
     $('#results').hide();
    var campo=$('#campo').val();
    var operador=$('#operador').val();
    var valor=$('#valor').val();
    if(valor == null || valor == ''){
        alert('Falta ingresar un valor de búsqueda');
        $('#pacman').hide();
        return false;
    }
    
    $.ajax({
   	        type: "POST",
        	url: "cAlumno.php",
		    data:"boton=Listar&campo="+campo+"&operador="+operador+"&valor="+valor,
    	    success: function(html)
			{
                $('#results').html(html);+
                 $('#pacman').hide();
                 $('#results').show('slow');
                $('#frmalumnos').dataTable( {
					"sPaginationType": "bootstrap",
					"sDom": "<'row'<'span5'l><'span6'f>r>t<'row'<'span8'i><'span9'p>>"
				} );
            }
        });
    
}

                          