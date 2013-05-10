$('a').click(function()
    {
        var aa=$(this)[0].id
           var a=aa.split('*');
            var accion=a[0];
            if(accion=='Detalle')
            {
                $('#NomAl').html(a[2]);
                $('#codAL').html(a[1]);
                var datos = 'alumno_id='+a[3]+'&boton=Detalle';
                $.ajax({
                        type: 'POST',
                        url: 'cAlumno.php',
                        data: datos,
                         success: function(html)
                                {
                                 var b=html.split('*');
                                 var div='<h3>Información personal</h3>';
                                 div+='<strong>Dirección:  </strong>'+b[2] +'<br/><br/>';
                                 div+='<strong>DNI:  </strong>'+b[0] +'<br/><br/>';
                                 div+='<strong>E-mail:  </strong>'+b[1] +'<br/><br/>';
                                 div+='<strong>Teléfono/celular:  </strong>'+b[3] +'<br/><br/>';
                                 div+='<strong>Fecha de Nacimiento:  </strong>'+b[4] +'<br/><br/>';
                                 div+='<h4 style='+'border-top-color:#1d5987;border-top-style: solid;border-top-width: 3px'+' >Información académica</h4>';
                                 div+='<strong>Sede:  </strong>'+b[7]+'<br/><br/>';
                                 div+='<strong>Carrera:  </strong>'+b[6]+'<br/><br/>';
                                 div+='<strong>Ciclo:  </strong>'+b[5]+'<br/><br/>';
                                 
                                 $('#informacion').html(div);
                                }
                 });
            }
            
            if(accion=='listDatosGenerales')
            {
            	 $('#pacman').show();
            	$('#resultss').hide('fast');
            	datos='annio_id='+a[2]+'&idAlumno='+a[1]+"&boton=listDatosGenerales";
 				$.ajax({
                type: 'POST',
                url: 'cAlumno.php',
                data: datos,
                 success: function(html)
                        {

	                	var menu='<div class="row"><div class="span3 bs-docs-sidebar"><ul class="nav nav-list bs-docs-sidenav ">';
	                	menu+='<li class="active"><a href="#listDatosGenerales"><i class="icon-chevron-right"></i>Datos Generales</a></li>';
	                	menu+='<li><a href="#" id="listFamiliares*'+a[1]+'*'+a[2]+'*'+a[3]+'"><i class="icon-chevron-right"></i>Aspecto Familiar</a></li>';
	                	menu+='<li><a href="#" id="listViolencia*'+a[1]+'*'+a[2]+'*'+a[3]+'"><i class="icon-chevron-right"></i>Convivencia</a></li>';
	                	menu+='<li><a href="#" id="listEconomia*'+a[1]+'*'+a[2]+'*'+a[3]+'"><i class="icon-chevron-right"></i>Aspecto Económico</a></li>';
	                	menu+='<li><a href="#" id="listEducativo*'+a[1]+'*'+a[2]+'*'+a[3]+'"><i class="icon-chevron-right"></i>Aspecto Educativo</a></li>';
	                	menu+='<li><a href="#" id="listSalud*'+a[1]+'*'+a[2]+'*'+a[3]+'"><i class="icon-chevron-right"></i>Aspecto Salud</a></li>';
	                	menu+='<li><a href="#" id="listVivienda*'+a[1]+'*'+a[2]+'*'+a[3]+'"><i class="icon-chevron-right"></i>Aspecto Vivienda</a></li>';
	                	menu+='<li><a href="#" id="listAcademico*'+a[1]+'*'+a[2]+'*'+a[3]+'"><i class="icon-chevron-right"></i>Aspecto Académico</a></li>';
	                	menu+='</ul></div>';
	                	menu+='<h2>Periodo:'+a[3]+'</h2>';
	                	menu+=html; // concatenar el resultado con el menu
	                	menu+="</div><script src='jsshadow/frmAlumnoSelect.js'></script>";
            			
	                	$('#resultss').html(menu);
            			$("#regresar").show("slow");
            			$('#resultss').show('slow');
            			 $('#pacman').hide();
            			 var tam=$(document).height();
         				jQuery("html, body").animate({scrollTop:tam});
	                	}
	                });
            }

            if(accion=='listFamiliares')
            {
            	 $('#pacman').show();
            	$('#resultss').hide('fast');
            	datos='annio_id='+a[2]+'&idAlumno='+a[1]+"&boton=listFamiliares";
 				$.ajax({
                type: 'POST',
                url: 'cAlumno.php',
                data: datos,
                 success: function(html)
                        {

	                	var menu='<div class="row"><div class="span3 bs-docs-sidebar"><ul class="nav nav-list bs-docs-sidenav ">';
	                	menu+='<li><a href="#" id="listDatosGenerales*'+a[1]+'*'+a[2]+'*'+a[3]+'"><i class="icon-chevron-right"></i>Datos Generales</a></li>';
	                	menu+='<li class="active"><a href="#"><i class="icon-chevron-right"></i>Aspecto Familiar</a></li>';
	                	menu+='<li><a href="#" id="listViolencia*'+a[1]+'*'+a[2]+'*'+a[3]+'"><i class="icon-chevron-right"></i>Convivencia</a></li>';
	                	menu+='<li><a href="#" id="listEconomia*'+a[1]+'*'+a[2]+'*'+a[3]+'"><i class="icon-chevron-right"></i>Aspecto Económico</a></li>';
	                	menu+='<li><a href="#" id="listEducativo*'+a[1]+'*'+a[2]+'*'+a[3]+'"><i class="icon-chevron-right"></i>Aspecto Educativo</a></li>';
	                	menu+='<li><a href="#" id="listSalud*'+a[1]+'*'+a[2]+'*'+a[3]+'"><i class="icon-chevron-right"></i>Aspecto Salud</a></li>';
	                	menu+='<li><a href="#" id="listVivienda*'+a[1]+'*'+a[2]+'*'+a[3]+'"><i class="icon-chevron-right"></i>Aspecto Vivienda</a></li>';
	                	menu+='<li><a href="#" id="listAcademico*'+a[1]+'*'+a[2]+'*'+a[3]+'"><i class="icon-chevron-right"></i>Aspecto Académico</a></li>';
	                	menu+='</ul></div>';
	                	menu+='<h2>Periodo:'+a[3]+'</h2>';
	                	menu+=html;
	                	menu+="</div><script src='jsshadow/frmAlumnoSelect.js'></script>";
	                	$('#resultss').html(menu);
	                	$("#regresar").show("slow");
            			$('#resultss').show('slow');
            			 $('#pacman').hide();
            			var tam=$(document).height();
         				jQuery("html, body").animate({scrollTop:tam});
	                	}
	                });
            }

              if(accion=='listViolencia')
            {
            	 $('#pacman').show();
            	$('#resultss').hide('fast');
            	datos='annio_id='+a[2]+'&idAlumno='+a[1]+"&boton=listViolencia";
 				$.ajax({
                type: 'POST',
                url: 'cAlumno.php',
                data: datos,
                 success: function(html)
                        {
	                	var menu='<div class="row"><div class="span3 bs-docs-sidebar"><ul class="nav nav-list bs-docs-sidenav">';
	                	menu+='<li><a href="#" id="listDatosGenerales*'+a[1]+'*'+a[2]+'*'+a[3]+'"><i class="icon-chevron-right"></i>Datos Generales</a></li>';
	                	menu+='<li><a href="#" id="listFamiliares*'+a[1]+'*'+a[2]+'*'+a[3]+'"><i class="icon-chevron-right"></i>Aspecto Familiar</a></li>';
	                	menu+='<li class="active"><a href="#"><i class="icon-chevron-right"></i>Convivencia</a></li>';
	                	menu+='<li><a href="#" id="listEconomia*'+a[1]+'*'+a[2]+'*'+a[3]+'"><i class="icon-chevron-right"></i>Aspecto Económico</a></li>';
	                	menu+='<li><a href="#" id="listEducativo*'+a[1]+'*'+a[2]+'*'+a[3]+'"><i class="icon-chevron-right"></i>Aspecto Educativo</a></li>';
	                	menu+='<li><a href="#" id="listSalud*'+a[1]+'*'+a[2]+'*'+a[3]+'"><i class="icon-chevron-right"></i>Aspecto Salud</a></li>';
	                	menu+='<li><a href="#" id="listVivienda*'+a[1]+'*'+a[2]+'*'+a[3]+'"><i class="icon-chevron-right"></i>Aspecto Vivienda</a></li>';
	                	menu+='<li><a href="#" id="listAcademico*'+a[1]+'*'+a[2]+'*'+a[3]+'"><i class="icon-chevron-right"></i>Aspecto Académico</a></li>';
	                	menu+='</ul></div>';
	                	menu+='<h2>Periodo:'+a[3]+'</h2>';
	                	menu+=html;
	                	menu+="</div><script src='jsshadow/frmAlumnoSelect.js'></script>";
	                	$('#resultss').html(menu);
	                	$("#regresar").show("slow");
            			$('#resultss').show('slow');
            			 $('#pacman').hide();
            			 var tam=$(document).height();
         				jQuery("html, body").animate({scrollTop:tam});
	                	}
	                });
            }

            if(accion=='listEconomia')
            {
            	 $('#pacman').show();
            	$('#resultss').hide('fast');
            	datos='annio_id='+a[2]+'&idAlumno='+a[1]+"&boton=listEconomia";
 				$.ajax({
                type: 'POST',
                url: 'cAlumno.php',
                data: datos,
                 success: function(html)
                        {
	                	var menu='<div class="row"><div class="span3 bs-docs-sidebar"><ul class="nav nav-list bs-docs-sidenav">';
	                	menu+='<li><a href="#" id="listDatosGenerales*'+a[1]+'*'+a[2]+'*'+a[3]+'"><i class="icon-chevron-right"></i>Datos Generales</a></li>';
	                	menu+='<li><a href="#" id="listFamiliares*'+a[1]+'*'+a[2]+'*'+a[3]+'"><i class="icon-chevron-right"></i>Aspecto Familiar</a></li>';
	                	menu+='<li><a href="#" id="listViolencia*'+a[1]+'*'+a[2]+'*'+a[3]+'"><i class="icon-chevron-right"></i>Convivencia</a></li>';
	                	menu+='<li class="active"><a href="#"><i class="icon-chevron-right"></i>Aspecto Económico</a></li>';
	                	menu+='<li><a href="#" id="listEducativo*'+a[1]+'*'+a[2]+'*'+a[3]+'"><i class="icon-chevron-right"></i>Aspecto Educativo</a></li>';
	                	menu+='<li><a href="#" id="listSalud*'+a[1]+'*'+a[2]+'*'+a[3]+'"><i class="icon-chevron-right"></i>Aspecto Salud</a></li>';
	                	menu+='<li><a href="#" id="listVivienda*'+a[1]+'*'+a[2]+'*'+a[3]+'"><i class="icon-chevron-right"></i>Aspecto Vivienda</a></li>';
	                	menu+='<li><a href="#" id="listAcademico*'+a[1]+'*'+a[2]+'*'+a[3]+'"><i class="icon-chevron-right"></i>Aspecto Académico</a></li>';
	                	menu+='</ul></div>';
	                	menu+='<h2>Periodo:'+a[3]+'</h2>';
	                	menu+=html;
	                	menu+="</div><script src='jsshadow/frmAlumnoSelect.js'></script>";
	                	$('#resultss').html(menu);
	                	$("#regresar").show("slow");
            			$('#resultss').show('slow');
            			 $('#pacman').hide();
            			 var tam=$(document).height();
         				jQuery("html, body").animate({scrollTop:tam});
	                	}
	                });
            }

            if(accion=='listEducativo')
            {
            	$('#pacman').show();
            	$('#resultss').hide('fast');
            	datos='annio_id='+a[2]+'&idAlumno='+a[1]+"&boton=listEducativo";
 				$.ajax({
                type: 'POST',
                url: 'cAlumno.php',
                data: datos,
                 success: function(html)
                        {
	                	var menu='<div class="row"><div class="span3 bs-docs-sidebar"><ul class="nav nav-list bs-docs-sidenav">';
	                	menu+='<li><a href="#" id="listDatosGenerales*'+a[1]+'*'+a[2]+'*'+a[3]+'"><i class="icon-chevron-right"></i>Datos Generales</a></li>';
	                	menu+='<li><a href="#" id="listFamiliares*'+a[1]+'*'+a[2]+'*'+a[3]+'"><i class="icon-chevron-right"></i>Aspecto Familiar</a></li>';
	                	menu+='<li><a href="#" id="listViolencia*'+a[1]+'*'+a[2]+'*'+a[3]+'"><i class="icon-chevron-right"></i>Convivencia</a></li>';
	                	menu+='<li><a href="#" id="listEconomia*'+a[1]+'*'+a[2]+'*'+a[3]+'"><i class="icon-chevron-right"></i>Aspecto Económico</a></li>';
	                	menu+='<li class="active"><a href="#"><i class="icon-chevron-right"></i>Aspecto Educativo</a></li>';
	                	menu+='<li><a href="#" id="listSalud*'+a[1]+'*'+a[2]+'*'+a[3]+'"><i class="icon-chevron-right"></i>Aspecto Salud</a></li>';
	                	menu+='<li><a href="#" id="listVivienda*'+a[1]+'*'+a[2]+'*'+a[3]+'"><i class="icon-chevron-right"></i>Aspecto Vivienda</a></li>';
	                	menu+='<li><a href="#" id="listAcademico*'+a[1]+'*'+a[2]+'*'+a[3]+'"><i class="icon-chevron-right"></i>Aspecto Académico</a></li>';
	                	menu+='</ul></div>';
	                	menu+='<h2>Periodo:'+a[3]+'</h2>';
	                	menu+=html;
	                	menu+="</div><script src='jsshadow/frmAlumnoSelect.js'></script>";
	                	$('#resultss').html(menu);
	                	$("#regresar").show("slow");
            			$('#resultss').show('slow');
            			 $('#pacman').hide();
            			 var tam=$(document).height();
         				jQuery("html, body").animate({scrollTop:tam});
	                	}
	                });
            }

            if(accion=='listSalud')
            {
            	$('#pacman').show();
            	$('#resultss').hide('fast');
            	datos='annio_id='+a[2]+'&idAlumno='+a[1]+"&boton=listSalud";
 				$.ajax({
                type: 'POST',
                url: 'cAlumno.php',
                data: datos,
                 success: function(html)
                        {
	                	var menu='<div class="row"><div class="span3 bs-docs-sidebar"><ul class="nav nav-list bs-docs-sidenav">';
	                	menu+='<li><a href="#" id="listDatosGenerales*'+a[1]+'*'+a[2]+'*'+a[3]+'"><i class="icon-chevron-right"></i>Datos Generales</a></li>';
	                	menu+='<li><a href="#" id="listFamiliares*'+a[1]+'*'+a[2]+'*'+a[3]+'"><i class="icon-chevron-right"></i>Aspecto Familiar</a></li>';
	                	menu+='<li><a href="#" id="listViolencia*'+a[1]+'*'+a[2]+'*'+a[3]+'"><i class="icon-chevron-right"></i>Convivencia</a></li>';
	                	menu+='<li><a href="#" id="listEconomia*'+a[1]+'*'+a[2]+'*'+a[3]+'"><i class="icon-chevron-right"></i>Aspecto Económico</a></li>';
	                	menu+='<li><a href="#" id="listEducativo*'+a[1]+'*'+a[2]+'*'+a[3]+'"><i class="icon-chevron-right"></i>Aspecto Educativo</a></li>';
	                	menu+='<li class="active"><a href="#"><i class="icon-chevron-right"></i>Aspecto Salud</a></li>';
	                	menu+='<li><a href="#" id="listVivienda*'+a[1]+'*'+a[2]+'*'+a[3]+'"><i class="icon-chevron-right"></i>Aspecto Vivienda</a></li>';
	                	menu+='<li><a href="#" id="listAcademico*'+a[1]+'*'+a[2]+'*'+a[3]+'"><i class="icon-chevron-right"></i>Aspecto Académico</a></li>';
	                	menu+='</ul></div>';
	                	menu+='<h2>Periodo:'+a[3]+'</h2>';
	                	menu+=html;
	                	menu+="</div><script src='jsshadow/frmAlumnoSelect.js'></script>";
	                	$('#resultss').html(menu);
	                	$("#regresar").show("slow");
            			$('#resultss').show('slow');
            			 $('#pacman').hide();
            			 var tam=$(document).height();
         				jQuery("html, body").animate({scrollTop:tam});
	                	}
	                });
            }

            if(accion=='listVivienda')
            {
            	$('#pacman').show();
            	$('#resultss').hide('fast');
            	datos='annio_id='+a[2]+'&idAlumno='+a[1]+"&boton=listVivienda";
 				$.ajax({
                type: 'POST',
                url: 'cAlumno.php',
                data: datos,
                 success: function(html)
                        {
	                	var menu='<div class="row"><div class="span3 bs-docs-sidebar"><ul class="nav nav-list bs-docs-sidenav">';
	                	menu+='<li><a href="#" id="listDatosGenerales*'+a[1]+'*'+a[2]+'*'+a[3]+'"><i class="icon-chevron-right"></i>Datos Generales</a></li>';
	                	menu+='<li><a href="#" id="listFamiliares*'+a[1]+'*'+a[2]+'*'+a[3]+'"><i class="icon-chevron-right"></i>Aspecto Familiar</a></li>';
	                	menu+='<li><a href="#" id="listViolencia*'+a[1]+'*'+a[2]+'*'+a[3]+'"><i class="icon-chevron-right"></i>Convivencia</a></li>';
	                	menu+='<li><a href="#" id="listEconomia*'+a[1]+'*'+a[2]+'*'+a[3]+'"><i class="icon-chevron-right"></i>Aspecto Económico</a></li>';
	                	menu+='<li><a href="#" id="listEducativo*'+a[1]+'*'+a[2]+'*'+a[3]+'"><i class="icon-chevron-right"></i>Aspecto Educativo</a></li>';
	                	menu+='<li><a href="#" id="listSalud*'+a[1]+'*'+a[2]+'*'+a[3]+'"><i class="icon-chevron-right"></i>Aspecto Salud</a></li>';
	                	menu+='<li class="active"><a href="#"><i class="icon-chevron-right"></i>Aspecto Vivienda</a></li>';
	                	menu+='<li><a href="#"  id="listAcademico*'+a[1]+'*'+a[2]+'*'+a[3]+'"><i class="icon-chevron-right"></i>Aspecto Académico</a></li>';
	                	menu+='</ul></div>';
	                	menu+='<h2>Periodo:'+a[3]+'</h2>';
	                	menu+=html;
	                	menu+="</div><script src='jsshadow/frmAlumnoSelect.js'></script>";
	                	$('#resultss').html(menu);
	                	$("#regresar").show("slow");
            			$('#resultss').show('slow');
            			 $('#pacman').hide();
            			 var tam=$(document).height();
         				jQuery("html, body").animate({scrollTop:tam});
	                	}
	                });
            }

             if(accion=='listAcademico')
            {
            	$('#pacman').show();
            	$('#resultss').hide('fast');
            	datos='annio_id='+a[2]+'&idAlumno='+a[1]+"&boton=listAcademico";
 				$.ajax({
                type: 'POST',
                url: 'cAlumno.php',
                data: datos,
                 success: function(html)
                        {
	                	var menu='<div class="row"><div class="span3 bs-docs-sidebar"><ul class="nav nav-list bs-docs-sidenav">';
	                	menu+='<li><a href="#" id="listDatosGenerales*'+a[1]+'*'+a[2]+'*'+a[3]+'"><i class="icon-chevron-right"></i>Datos Generales</a></li>';
	                	menu+='<li><a href="#" id="listFamiliares*'+a[1]+'*'+a[2]+'*'+a[3]+'"><i class="icon-chevron-right"></i>Aspecto Familiar</a></li>';
	                	menu+='<li><a href="#" id="listViolencia*'+a[1]+'*'+a[2]+'*'+a[3]+'"><i class="icon-chevron-right"></i>Convivencia</a></li>';
	                	menu+='<li><a href="#" id="listEconomia*'+a[1]+'*'+a[2]+'*'+a[3]+'"><i class="icon-chevron-right"></i>Aspecto Económico</a></li>';
	                	menu+='<li><a href="#" id="listEducativo*'+a[1]+'*'+a[2]+'*'+a[3]+'"><i class="icon-chevron-right"></i>Aspecto Educativo</a></li>';
	                	menu+='<li><a href="#" id="listSalud*'+a[1]+'*'+a[2]+'*'+a[3]+'"><i class="icon-chevron-right"></i>Aspecto Salud</a></li>';
	                	menu+='<li><a href="#" id="listVivienda*'+a[1]+'*'+a[2]+'*'+a[3]+'"><i class="icon-chevron-right"></i>Aspecto Vivienda</a></li>';
	                	menu+='<li class="active"><a href="#" ><i class="icon-chevron-right"></i>Aspecto Académico</a></li>';
	                	menu+='</ul></div>';
	                	menu+='<h2>Periodo:'+a[3]+'</h2>';
	                	menu+=html;
	                	menu+="</div><script src='jsshadow/frmAlumnoSelect.js'></script>";
	                	$('#resultss').html(menu);
	                	$("#regresar").show("slow");
            			$('#resultss').show('slow');
            			 $('#pacman').hide();
            			 var tam=$(document).height();
         				jQuery("html, body").animate({scrollTop:tam});
	                	}
	                });
            }

    });