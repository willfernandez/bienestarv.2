$(document).ready(function()
{
	$.ajax({
            type: "POST",
            url: "cbxDepartamento.php",
        success: function(html)
            {	
                       $('#departamento').html(html);

            }   
        });
		datoGenerales();
	
});

function datoGenerales(){

	var idAlumno = $("#idAlumno").val();
	datos = "alumno_id="+idAlumno+"&boton=Listar";
	//alert(datos);
	 $.ajax({
        type: "POST",
        url: "cDatoGenerales.php",
        data: datos,
        success: function(html)
                {	
	            		//alert(html);
							var a=html.split('*');
							var id = a[0];
							var id_departamento = a[2];
							var id_provincia = a[3];
							var direccion=a[4];
							var celular = a[5];
							var fechaNac = a[6];
							$("#direccionA").val(direccion);
							$("#telefonoA").val(celular);
							$("#fechaNac").val(fechaNac);
							$("#departamentoA").val(id_departamento);
							cargarProvincia(id_departamento,id_provincia);
                }
	});
}

function cargarProvincia(idDep,id_provincia){
 $.ajax({
            type: "POST",
            url: "cbxProvincia.php",
            data: "Boton=buscarProvincias&departamento_id="+idDep,
        success: function(html)
            {	
                       $('#provinciaA').html(html);
                       $('#provinciaAl').val(id_provincia);

            }   
        });
}