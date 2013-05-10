
function limpiarE(){
   
    $('#idEco').html('');
    $('#tipoFamiliaEco').val('');
    $('#nombreEco').val('');
    $('#edadEco').val('');
    $('#ocupacionEco').val('');
    $('#ingresosEco').val('');
}

function validarOpcion(id)
{
	if(id=='...')
	{
                        if($('#fnd').val()==0)
                        {
                        $('#finder').show();
                        $('#fnd').val(1);
                          }
                        
               
	} else
                         {
                        $('#finder').hide();
                        $('#fnd').val(0);
                         }
}
function enviarEconomia(boton)
{
    switch(boton)
	{
            
		case 'Guardar':
                        var idEco=$('#idEco').html();
                        var tipoFamiliaEco=$('#tipoFamiliaEco').val();
			var nombreEco=$('#nombreEco').val();
                        var edadEco=$('#edadEco').val();
                        var ocupacionEco=$('#ocupacionEco').val();
                        var ingresosEco=$('#ingresosEco').val();
                        
			var datos="idEco="+idEco+"&tipoFamiliaEco="+tipoFamiliaEco+"&nombreEco="+nombreEco+"&edadEco="+edadEco+"&ocupacionEco="+ocupacionEco+"&ingresosEco="+ingresosEco+"&boton="+boton;
			$.ajax({
                                type: "POST",
                                url: "cEconomia.php",
                                data: datos,
                            success: function(html)
                                        {	
                                                if(html>0)
                                                {
                                                    $('#validaBtn2').val('0');
                                                        $('#idEco').html(html);
                                                       //esto
                                                       $('#fndBoton2').val('0');
                                                       
                                                       
                                                        //fin esto
                                                       llenarEconomia();
                                                        alert("Datos registrados correctamente...");
                                                        limpiarE();
                                                         
                                                }
                                                else
                                                        alert("No se pudo registrar los datos...!");
                                }
                            });
			break;
	}
}

function llenarEconomia(){
    var datos="alumno_id=7&boton=listarTabla";
    $.ajax({
            type: "POST",
            url: "cEconomia.php",
            data: datos,
        success: function(html)
                    {	
                         //esto
                         if($('#fndBoton2').val()==0){
                           $('#esconderBoton2').hide();
                           }
                            //fin esto
                           $('#economia').html(html);
                    }
        });

}