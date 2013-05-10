 $("a").click(function()
  {
	var aa=$(this)[0].id;
	var a=aa.split('*');
	var accion=a[0];
	
	if(accion=='Eliminar')
	{
		res=confirm("Deseas eliminar este registro...");
		if(res==true)
		{	
                         //esto
                        $('#fndBoton1').val('1');
                        $('#esconderBoton1').show();
                         //fin esto
			var datos="id="+a[1]+"&boton=Eliminar";
			$.ajax({
                                type: "POST",
                                url: "cEmergencia.php",
                                data: datos,
                                  success: function(html)
                                        {	
                                            alert('eliminado')
                                             
                                               llenarEmergencia();
                                        }
                                  });
		}
	}
        
        if(accion=='Modificar'){
            $('#iidE').html(a[1]);
            $('#tipoFamilia').val(a[3]);
            $('#nombreE').val(a[2]);
            $('#telefonoE').val(a[5]);
            $('#direccionE').val(a[4]);
            $('#emailE').val(a[6]);
            
        }
  });
