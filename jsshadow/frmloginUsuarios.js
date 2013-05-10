$(document).ready(function()
{
    $('#pacman').hide();
});
function iniciarSesionA()
{	
   
        var usuario=$('#usuarios').val();
	   var clave=$('#claves').val();
       if(usuario == null || usuario ==''){
            var div = "<div align='center' class='alert-message danger'> Falta ingresar su usuario!!!</div>";
            $('#alert').html(div);
            return false;
       }

       if(clave == null || clave ==''){
            var div = "<div align='center' class='alert-message danger'> Falta ingresar su clave!!!</div>";
            $('#alert').html(div);
            return false;
       }
       $('#pacman').show();
       $('#botton').hide();
	   $.ajax({       
   	        type: "POST",
        	url: "csesionUsur.php",
		  data:"usuario="+usuario+"&clave="+clave+"&boton=iniciar",
    	    success: function(html)
			{
                            if(html=='0'){
                                var div = "<div align='center' class='alert-message danger'> Los datos ingresados son incorrectos!!!</div>"
                                $('#alert').html(div);
                                $('#pacman').hide();
                                 $('#botton').show();

                            }else{
                                location.href="frmHome.php" ;
                            }
                        }
		   });
}