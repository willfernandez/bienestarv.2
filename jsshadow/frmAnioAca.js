$(document).on("ready", inicioAnnio);

function inicioAnnio()
{
    $.ajax({
        type:"POST",
        url: "cAnioAcademicos.php",
        data: "boton=Cargar",
       success: function(html){

           $('#Anioss').html(html);
            $('#tAnios').dataTable( {
					"sPaginationType": "bootstrap",
					"sDom": "<'row'<'span5'l><'span4'f>r>t<'row'<'span5'i><'span4'p>>"
				} );
           
       }
    });

}

function guardarAnnio(){
  var nombreAnnio = $("#nannio").val();
  var fechaI = $('#fini').val();
  var fechaF = $('#ffin').val();
  var activo = $('#activo').val();

var datos = "id="+"&nombre="+nombreAnnio+"&fechaI="+fechaI+"&fechaF="+fechaF+"&activo="+activo+"&boton=Guardar";
alert(datos)
  $.ajax({
        type:"POST",
        url: "cAnioAcademicos.php",
        data: datos,
       success: function(html){
            if(html > 0)
            {
              alert("datos Guardados")
             inicioAnnio();
            }else{
              alert("Error en guardar")
              inicioAnnio();
            }
           
       }
    });
}

function actualizarAnnio(){
  var id = $("#idAnnio").html();
  var nombre = $("#nAnnio").val();
  var fechaI = $("#fecI").val();
  alert(fechaI)
  var fechaF = $("#fecF").val();
  var activo = $("#estadoA").val();
  datos="id="+id+"&nombre="+nombre+"&fechaI="+fechaI+"&fechaF="+fechaF+"&activo="+activo+"&boton=Guardar";
  $.ajax({
          type:"POST",
          url: "cAnioAcademicos.php",
          data: datos,
         success: function(html){
              if(html>0){
                alert('Datos actualizados');
                inicioAnnio();
              }else{
                alert('Datos no actualizados');
                inicioAnnio();
              }
         }
      });
}