 $(document).ready(function()
{
    $('#pacman').show();
    verFichas();
      $("#regresar").hide();
		
});

 function verFichas(){
     $('#pacman').show('fast');
    $("#resultss").hide('slow');
    var idAlumno = $('#idAlum').val();
        var datos = 'alumno_id='+idAlumno+'&boton=verFichas';

         $.ajax({
                type: 'POST',
                url: 'cAlumno.php',
                data: datos,
                 success: function(html)
                    {
                               $('#resultss').html(html);
                               $("#resultss").show('slow');
                               $('#pacman').hide();
                    }
                });
         $("#regresar").hide('slow');
 }