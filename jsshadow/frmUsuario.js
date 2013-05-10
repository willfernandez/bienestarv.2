function cerrarSesionAd(boton){
    switch(boton)
	{
            case'Salir':
                $.ajax({
                                type: "POST",
                                url: "cUsuario.php",
                                data: "boton=Salir",
                            success: function(html)
                                        {	if(confirm('Desea Salir?'))
                                              location.href="frmAdmin.php" 
                                        }
                            });
            break;
        }
}

function guardarAdm(boton)
{ 
    switch(boton)
	{
		case 'Guardar':
                        var idUs=$('#UsuarioId').html();
                        var nombUs=$('#UsuarioNombres').val();
                        var apeUs=$('#UsuarioApellidos').val();
                        var dniUs=$('#UsuarioDni').val();
                        var emailUs=$('#UsuarioEmail').val();
			var passUs=$('#UsuarioPassword').val();
                        
		       var datosd="idUs="+idUs+"&nombUs="+nombUs+"&apeUs="+apeUs+"&dniUs="+dniUs+"&emailUs="+emailUs+"&passUs="+passUs+"&boton="+boton;
			$.ajax({
                                type: "POST",
                                url: "cUsuario.php",
                                data: datosd,
                            success: function(html)
                                        {	
                                                if(html>0)
                                                {
                                                   $('#agregadoU').hide();
                                                   var div = "<div align='center' class='alert alert-success'> Usuario Registrado con éxito!!!</div>"
                                                    $('#alert').html(div);
                                                }else{
                                                    alert('Ud. ya esta registrado')
                                                }
                                                
                                }
                            });
                    break
        }
        
}