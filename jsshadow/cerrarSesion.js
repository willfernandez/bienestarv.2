 $("a").click(function()
  {
      //alert('fff')
	var aa=$(this)[0].id;
	var a=aa.split('*');
	var accion=a[0];
        
	if(accion=='Salir')
	{
                     $.ajax({
                                type: "POST",
                                url: "cAlumno.php",
                                data: "boton=Salir",
                            success: function(html)
                                        {	if(confirm('Desea Salir?'))
                                              location.href="frmLogin.php" 
                                        }
                            });
        }
        
  
    });
