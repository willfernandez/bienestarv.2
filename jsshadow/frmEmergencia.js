$(document).ready(function()
{
	$('#finder').hide();
});

function limpiarEm(){
    $('#iidE').html('');
    $('#nombreE').val('');
    $('#tipoFamilia').val('Papá');
    $('#telefonoE').val('');
    $('#direccionE').val('');
    $('#emailE').val('');
    $('#finder').hide();
    $('#fnd').val(0);
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
function enviarEmergencia(boton)
{
    switch(boton)
	{
            
		case 'Guardar':
                        var id=$('#iidE').html();
                        if($('#tipoFamilia').val()=='...'){
                            var familiarE=$('#tipoFamilia2').val();
                        }else{
                           var familiarE=$('#tipoFamilia').val();
                        }
			var nombreE=$('#nombreE').val();
                        var telefonoE=$('#telefonoE').val();
                        var direccionE=$('#direccionE').val();
                        var emailE=$('#emailE').val();
                        
			var datos="iidE="+id+"&familiarE="+familiarE+"&nombreE="+nombreE+"&telefonoE="+telefonoE+"&direccionE="+direccionE+"&emailE="+emailE+"&boton="+boton;
			$.ajax({
                                type: "POST",
                                url: "cEmergencia.php",
                                data: datos,
                            success: function(html)
                                        {	
                                        // alert(html)
                                                if(html>0)
                                                {
                                                    
                                                        $('#iidE').html(html);
                                                       
                                                        //esto
                                                       $('#fndBoton1').val('0');
                                                       $('#validaBtn1').val('0');
                                                       
                                                        //esto
                                                       llenarEmergencia();
                                                       limpiarEm();
                                                        alert("Datos registrados correctamente...");
                                                        
                                                         
                                                }
                                                else
                                                        alert("No se pudo registrar los datos...!");
                                }
                            });
                            
			break;
	}
}

function llenarEmergencia(){
    
    
    var datos="alumno_id=7&boton=listarTabla";
    $.ajax({
            type: "POST",
            url: "cEmergencia.php",
            data: datos,
        success: function(html)
                    {	
                        //esto
                           if($('#fndBoton1').val()==0){
                           $('#esconderBoton1').hide();
                           }
                           
                           //fin esto
                           $('#TablaE').html(html);
                    }
        });

}