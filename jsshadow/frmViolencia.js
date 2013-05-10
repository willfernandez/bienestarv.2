
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
                        alert(datos)
			$.ajax({
                                type: "POST",
                                url: "cEmergencia.php",
                                data: datos,
                            success: function(html)
                                        {	
                                                if(html>0)
                                                {
                                                        $('#iidE').html(html);
                                                       // $('#btnbuscar').trigger("click");
                                                       llenarEmergencia();
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

function llenarEmergencia(){
    var datos="alumno_id=7&boton=listarTabla";
    $.ajax({
            type: "POST",
            url: "cEmergencia.php",
            data: datos,
        success: function(html)
                    {	
                           $('#TablaE').html(html);
                    }
        });

}