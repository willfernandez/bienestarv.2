 $("a").click(function()
  {
	var aa=$(this)[0].id;
	var a=aa.split('-');
	var accion=a[0];
	
	if(accion=='Eliminar')
	{
		res=confirm("Deseas eliminar este registro...");
		if(res==true)
		{	
			var datos="id="+a[1]+"&boton=Eliminar";
			$.ajax({
                                type: "POST",
                                url: "cEconomia.php",
                                data: datos,
                                  success: function(html)
                                        {	
                                               llenarEconomia();
                                        }
                                  });
		}
	}
        
        if(accion=='Modificar'){
            $('#idEco').html(a[1]);
            $('#tipoFamiliaEco').val(a[2]);
            $('#nombreEco').val(a[3]);
            $('#edadEco').val(a[4]);
            $('#ocupacionEco').val(a[5]);
            $('#ingresosEco').val(a[6]);
            
        }
  });

