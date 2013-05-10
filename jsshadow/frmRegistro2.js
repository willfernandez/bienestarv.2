function guardarActualizacion(botonn)
{ 
    switch(botonn)
	{
            case 'Guardarr':
               // alert(botonn)
                        var modAll=$('#modAl2').val();
                        var sede_idl=$('#sede_id').val();
                        var annio_idl=$('#annio_id').val();
                        var carreraAll_id=$('#carreraAl_id').val();
                        var cicloAl_idl=$('#cicloAl_id').val();
                        var codalum=$('#codalum').val();

                         if (modAll==0){ 
                            alert("Tiene que seleccionar tu modalidad de estudio") 
                            return false; 
                         }

                         if (sede_idl==0){ 
                            alert("Tiene que seleccionar tu Sede") 
                            return false; 
                         }

                         if (annio_idl==0){ 
                            alert("Tiene que seleccionar el año académico") 
                            return false; 
                         }

                         if (carreraAll_id==0){ 
                            alert("Tiene que seleccionar tu carrera") 
                            return false; 
                         }
                         if (cicloAl_idl==0){ 
                            alert("Tiene que seleccionar el ciclo que cursas en este periodo") 
                            return false; 
                         }



                    
                        var datosdd="modAll="+modAll+"&sede_idl="+sede_idl+"&annio_idl="+annio_idl+"&carreraAll_id="+carreraAll_id+"&cicloAl_idl="+cicloAl_idl+"&codalum="+codalum+"&boton="+botonn;
                        //alert(datosdd)
                        $.ajax({
                                type: "POST",
                                url: "cMatricula.php",
                                data: datosdd,
                            success: function(html)
                                        {	
                                           // alert(html)
                                                if(html>0)
                                                {
                                                        $('#seguir').show();
                                                         $("#actualizar").hide();
                                                          document.getElementById('seguir').style.margin='2% 18%';
                                                }else{
                                                    alert('Error en guardar datos')
                                                }
                                             
					}
                            });
        }
    
}