function guardarRegistro(boton)
{ 
    switch(boton)
	{
		case 'Guardar':
                        var idReg=$('#idReg').html();
                        var nombAl=$('#nombAl').val();
                        var apeAL=$('#apeAL').val();
                        var dniAl=$('#dniAl').val();
                        var codAl=$('#codAl').val();
			            var emailAl=$('#emailAl').val();
                        var modAl=$('#modAl').val();
                        var sede_id=$('#sede_id').val();
                        var annio_id=$('#annio_id').val();
                        var carreraAl_id=$('#carreraAl_id').val();
                        var cicloAl_id=$('#cicloAl_id').val();
        		        var datosd="idDatos="+idReg+"&sede_id="+sede_id+"&annio_id="+annio_id+"&cicloAl_id="+cicloAl_id+"&nombAl="+nombAl+"&apeAL="+apeAL+"&dniAl="+dniAl+"&codAl="+codAl+"&modAl="+modAl+"&carreraAl_id="+carreraAl_id+"&emailAl="+emailAl+"&boton="+boton;
        			        $.ajax({
                                type: "POST",
                                url: "cAlumno.php",
                                data: datosd,
                                success: function(html)
                                        {	
                                            if(html>0)
                                            {
                                                alert('Gracias por registrarse Ud. es el usuario N°'+html)
                                                alert('Ahora Ud. puede ya puede ingresar al sistema')
                                                
                                                limpiarDatos();
                                            }else{
                                                alert('Ud. ya esta registrado')
                                            }
                                        }
                            });
                            break;
                            
               
	}
}

function limpiarDatos()
{
   $('#nombAl').html(' ');
                      $('#nombAl').val('');
                        $('#apeAL').val('');
                        $('#dniAl').val('');
                        $('#codAl').val('');
			$('#emailAl').val('');
                       $('#sede_id').val('');
                        $('#annio_id').val('');                       
                       $('#facultadAl_id').val('');
                        $('#carreraAl_id').val('');
                        $('#cicloAl_id').val('');
}
