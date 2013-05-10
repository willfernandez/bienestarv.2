$(document).ready(function()
{
    $('#pacman').hide();
});

function iniciarSesion()
{	
    $('#boton').hide();
    $('#pacman').show();
    var dni=$('#dni').val();
	var codigo=$('#codigo').val();

    totalD=dni.length;
    if(totalD == null || totalD<8 || totalD>8){
        var div = "<div align='center' class='alert alert-error'> Falta ingresar su DNI!!!</div>";
         $('#alert').html(div);
         $('#boton').show();
         $('#pacman').hide();
        return false;
    }
    if(codigo == ''){
        var div = "<div align='center' class='alert alert-error'> Falta ingresar su código!!!</div>";
         $('#alert').html(div);
         $('#boton').show();
         $('#pacman').hide();
        return false;
    }
	$.ajax({
   	        type: "POST",
        	url: "csesion.php",
			data:"dni="+dni+"&codigo="+codigo+"&boton=iniciar",
    	    success: function(html)
			{
                            var a=html.split('*');
                            if(a[0]=='0'){
                                var div = "<div align='center' class='alert alert-error'> Los datos ingresados son incorrectos!!!</div>";
                                $('#alert').html(div);
                                 $('#boton').show();
                                $('#pacman').hide();
                            }
                            if(a[0]=='1')
                            {
                                $('#pacman').hide();
				            location.href="frmBienvenida.php?matriculado="+a[1];
                            }
                        }
		   });
}