 $("a").click(function()
  {
  var aa=$(this)[0].id;
  var a=aa.split('*');
  var accion=a[0];
  if(accion=='carrera_edit')
  {
    var idCarrera = a[1];
    var nombreC = a[2];
    var facultad_id = a[3];
    $("#ncarreraedit").val(nombreC);
    $("#idCarreraedit").val(idCarrera);
    cargarFacultadesE(facultad_id);
   
  }
        
       
  });

 function cargarFacultadesE(facultad_id){
    
    $.ajax({
        type:"POST",
        url: "cbxFacultad.php",
       success: function(html){
           $('#facultad_eddit').html(html);
           $('#facultadAl_id').val(facultad_id);
           
       }
    });
}

function editarCarrera(){
  var ncarrera = $("#ncarreraedit").val();
  var idCarrera=$("#idCarreraedit").val();
  var facultad_id = $('#facultadAl_id').val();
$.ajax({
        type:"POST",
        url: "cCarreras.php",
        data: "boton=guardarCarrera&nombreC="+ncarrera+"&facultad_id="+facultad_id+"&idCar="+idCarrera,
       success: function(html){
            if(html >0){
              alert("Carrera Actualizada... ")
             cargarCarreras();
            }else{
              alert("Datos no Actualizada")
              cargarCarreras();
            }
           
       }
    });
}

