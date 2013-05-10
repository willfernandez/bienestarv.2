$(document).ready(function(){

    cargarSedes();
    cargarAnnios();
    cargarFacultades();
    
})
function cargarAnnios(){
    
    $.ajax({
        type:"POST",
        url: "cbxAnnio.php",
        
       success: function(html){
           $('#annio').html(html);
           
       }
    })
}
function cargarSedes(){
    
    $.ajax({
        type:"POST",
        url: "cbxSede.php",
        
       success: function(html){
           $('#sede').html(html);
           
       }
    })
}
function cargarFacultades(){
    
    $.ajax({
        type:"POST",
        url: "cbxFacultad.php",
        
       success: function(html){
           $('#facultad').html(html);
           
       }
    })
}

function cargarCarreras(){
    var facultadAl_id=$('#facultadAl_id').val();
    if(facultadAl_id==' '){
        $('#carrera').html('');
    }else{
    
    var datos="facultadAl_id="+facultadAl_id;
    alert('Espere mientras carga las carreras')
    $.ajax({
        type:"POST",
        url: "cbxCarrera.php",
        data: datos,
       success: function(html){
           $('#carrera').html(html);
       }
    });}
}
 
 function cargarCiclos(){
 
    var carrera_id=$('#carreraAl_id').val();
    if(carrera_id==0){
        
    }else{
    alert('Espere mientras se cargan los ciclos')
    var datos="carrera_id="+carrera_id;
    $.ajax({
        type:"POST",
        url: "cbxCiclo.php",
        data: datos,
       success: function(html){
           $('#ciclo').html(html);
       }
    });}
    
    
    
}

