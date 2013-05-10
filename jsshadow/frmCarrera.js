$(document).ready(function()
{
    cargarCarreras();

});

function cargarCarreras(){
  $.ajax({
        type:"POST",
        url: "cCarreras.php",
        data: "boton=Cargar",
       success: function(html){
           $('#Carrerass').html(html);
            $('#tCarre').dataTable( {
          "sPaginationType": "bootstrap",
          "sDom": "<'row'<'span5'l><'span4'f>r>t<'row'<'span5'i><'span4'p>>"
        } );
           
       }
    });
}

function cargarFacultades(){
    
    $.ajax({
        type:"POST",
        url: "cbxFacultad.php",
       success: function(html){
           $('#facultad').html(html);
           
       }
    });
}
function guardarCarrera(){
  var carrera = $("#ncarrera").val();
  var facultad = $("#facultadAl_id").val();
   $.ajax({
        type:"POST",
        url: "cCarreras.php",
        data: "boton=guardarCarrera&nombreC="+carrera+"&facultad_id="+facultad+"&idCar=0",
       success: function(html){
            if(html >0){
              alert("Carrera guardada... ")
              alert("Seleccione la cantidad de ciclos... ")
              form = '<label >Número de ciclos</label>';
              form+= '<div class="input-append">';
              form+= '<input class="span1" id="nciclos" type="text" />';
              form+= '<span class="add-on">ciclos</span>';
              form+= '<button style="margin-left:5px" data-dismiss="modal" class="btn btn-danger" type="button" onclick="guardarCiclos();">Agregar Ciclos</button>';
              form+= '</div>';
              $("#formC").html(form);
              $("#idCarrera").val(html);
            }else{
              alert("Datos no guardados")
            }
           
       }
    });

}
function guardarCiclos(){
  var nciclos= $("#nciclos").val();
  var idCarrera = $('#idCarrera').val();

  var datos = "nciclos="+nciclos+"&idCarrera="+idCarrera+"&boton=guardar"
    $.ajax({
            type:"POST",
            url: "CcarrareCiclos.php",
            data: datos,
           success: function(html){
            if(html > 0 ){
                cargarCarreras();
                alert("Datos Guardados")
            }else{
                alert("Error")
            }
           }
        });

}

