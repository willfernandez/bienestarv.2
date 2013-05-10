$(document).ready(function()
{
 $.ajax({
            type: "POST",
            url: "cValidar.php",
            data: "boton=Buscar",
        success: function(html)
                    {	
                       // alert(html)
                            if(html=='SI')
                            {
                               // alert(html)
                              $('#todo').hide();

                            }else{
                                //alert(html)
                            }

            }
        });
        $('#escondermaltrato').hide();
        $('#esconderEconomia').hide();
        $('#esconderCarrera').hide();
        $('#esconderAcademia').hide();
        $('#esconderenfermedad').hide();
        $('#esconderUniversidad').hide();
        $('#esconderemb').hide();
        $('#esconderant').hide();
        
        $('#cargador').hide();
        $('#mensajej').hide();
        cargarDepartamentos();
});

function cargarDepartamentos(){
 $.ajax({
            type: "POST",
            url: "cbxDepartamento.php",
        success: function(html)
            {	
                       $('#departamento').html(html);

            }   
        });
}
function esconderAut(valor){
    if(valor == 'Se Autosostiene'){
        $('#aut').hide();
        var nombre =$('#nomUs').val();
        $('#nombreEco').val(nombre);
        
    }else{
        $('#aut').show();
        $('#nombreEco').val('');
    }
}

function cargarProvincia(idDep){
 $.ajax({
            type: "POST",
            url: "cbxProvincia.php",
            data: "Boton=buscarProvincias&departamento_id="+idDep,
        success: function(html)
            {	
                       $('#provinciaA').html(html);

            }   
        });
}
function abrirAnt(id){
     if(id=='Si')
	{
            if($('#fndAnt').val()==0)
            {
                $('#Antc').val('');
                $('#esconderant').show();
                $('#fndAnt').val(1);
            }
        }
        else{
             $('#Antc').val('No');
             $('#esconderant').hide();
             $('#fndAnt').val(0);
        }
    
}
function abrirEmb(id,form){
    if(id=='Si')
	{
            if($('#fndEmb').val()==0)
            {
                $('#embTiempo').val('');
                $('#dobemb').val('0000-00-00');
                $('#lcontroles').val('');
                $('#esconderemb').show();
                $('#fndEmb').val(1);
                }
                        
               
	} else
        {
              $('#embTiempo').val('No Embarazo');
              $('#dobemb').val('2013-01-02');
              $('#lcontroles').val('No Embarazo');
               $('#esconderemb').hide();
               $('#fndEmb').val(0);
        }
}
function abrirMaltratos(id,form)
{
	if(id=='Si')
	{
                        if($('#fndmaltrato').val()==0)
                        {
                            $('#razonV').val('');
                            $('#escondermaltrato').show();
                            $('#fndmaltrato').val(1);
                          }
                        
               
	} else
        {
               form.maltratoP[0].checked = false;
               form.maltratoP[1].checked = true;
               form.maltratoF[0].checked = false;
               form.maltratoF[1].checked = true;
              $('#razonV').val('No se ha especificado');
               $('#escondermaltrato').hide();
               $('#fndmaltrato').val(0);
        }
}

function abrirEconomia(id,form)
{
	if(id=='Si')
	{
                        if($('#fndeconomia').val()==0)
                        {
                            $('#esconderEconomia').show();
                            $('#fndeconomia').val(1);
                        }
                        
               
	} else
        {
               form.tipoDeuda1[0].checked = false;
               form.tipoDeuda1[1].checked = false;
               form.tipoDeuda1[2].checked = false;
               form.tipoDeuda1[3].checked = false;
               form.tipoDeuda1[4].checked = false;
                $('#desdeEco').val('0');
               $('#cuantoEco').val('0');
                $('#esconderEconomia').hide();
                $('#fndeconomia').val(0);
        }
}

function abrirCarrera(id)
{
	if(id=='Si')
	{
                        if($('#fndCarrera').val()==0)
                        {
                            
                            $('#esconderCarrera').show();
                            $('#nombreCr').val('');
                            $('#fndCarrera').val(1);
                        }
                        
               
	} else
        {
               
               $('#nombreCr').val('no hay carrera tecnica');
                $('#esconderCarrera').hide();
                $('#fndCarrera').val(0);
        }
}

function abrirAcademia(id)
{
	if(id=='Si')
	{
            
                        if($('#fndAcademia').val()==0)
                        {   $('#nomAcademia').val('');
                             $('#tiempoAcademia').val('');
                            $('#esconderAcademia').show();
                            $('#fndAcademia').val(1);
                        }
                        
               
	} else
        {
               
               $('#nomAcademia').val('No hay academia');
               $('#tiempoAcademia').val('No hay academia');
                $('#esconderAcademia').hide();
                $('#fndAcademia').val(0);
        }
}
function abrirSalud(id)
{
	if(id=='Si')
	{
            
                        if($('#fndEnfermedad').val()==0)
                        {   $('#enfermedadNom').val('');
                           
                            
                            $('#esconderenfermedad').show();
                            $('#fndEnfermedad').val(1);
                        }
                        
               
	} else
        {
               
               $('#enfermedadNom').val('No hay enfermedad');
                $('#esconderenfermedad').hide();
                $('#fndEnfermedad').val(0);
        }
}

function abrirU(id,form)
{
	if(id=='Si')
	{
            
                        if($('#fndUniversidad').val()==0)
                        {   $('#tcarrera').val('');
                            $('#pcarrera').val('');
                            $('#ayuda').val('');
                            $('#esconderUniversidad').show();
                            $('#fndUniversidad').val(1);
                        }
                        
               
	} else
        {
              $('#esconderUniversidad').hide();
                $('#tcarrera').val('0');
                $('#pcarrera').val('0');
                
                $('#ayuda').val('-');
                
                $('#fndUniversidad').val(0);
        }
}

function guardarFamiliar(boton){
    
                   
                   

}

function guardarViolencia(boton){
    var idVio=$('#idVio').html();
                           
                                    var familiaA=$("input[name='familiaA']:checked").val(); 
                                    var relacion=$("input[name='relacion']:checked").val(); 
                                    var violencia=$("input[name='violencia']:checked").val(); 
                                    var maltratoP=$("input[name='maltratoP']:checked").val(); 
                                    var maltratoF=$("input[name='maltratoF']:checked").val(); 
                                    var razonV=$('#razonV').val();
                                    var datosV="idVio="+idVio+"&familiaA="+familiaA+"&relacion="+relacion+"&violencia="+violencia+"&maltratoP="+maltratoP+"&maltratoF="+maltratoF+"&razonV="+razonV+"&boton="+boton;
                                    $.ajax({
                                        type: "POST",
                                        url: "cViolencia.php",
                                        data: datosV,
                                    success: function(html)
                                                {
                                                        if(html>0)
                                                        {//alert('Guardando Convivencia')
                                                                $('#idVio').html(html);
                                                       

                                                        }
                                                       
                                        }
                                    });
                            
                            
}


function guardarDeudas(boton){
     var idDeu=$('#idDeu').html();
                          
                            var deudaP=$("input[name='deudaP']:checked").val(); 
                            var cuantoEco=$('#cuantoEco').val();
                            var desdeEco=$('#desdeEco').val();
                             if($("input[name='tipoDeuda1']:checked").val()==null){
                                var tipoDeuda='No tiene deudas';
                              }
                            else{
                                var tipoDeuda=$("input[name='tipoDeuda1']:checked").val();
                            }

                            var datosE="idDeu="+idDeu+"&deudaP="+deudaP+"&cuantoEco="+cuantoEco+"&desdeEco="+desdeEco+"&tipoDeuda="+tipoDeuda+"&boton="+boton;
                           
                            $.ajax({
                                type: "POST",
                                url: "cDeuda.php",
                                data: datosE,
                            success: function(html)
                                        {	
                                                if(html>0)
                                                {//alert('Guardando Deudas')
                                                     $('#idDeu').html(html);
                                                    
                                                         
                                                }
                                             
										}
                            });
                             
}

function guardarEducacion(boton){
    var idEdu=$('#idEdu').html();
                    
                             var colegio=$('#colegio').val();
                             var nombreC=$('#nombreC').val();
                             var ubicacionC=$('#ubicacionC').val();
                             var carreraT=$("input[name='carreraT']:checked").val(); 
                             var nombreCr=$('#nombreCr').val();
                             var actAcade=$('#actAcade').val();
                             var actDepor=$('#actDepor').val();
                             var academia=$("input[name='academia']:checked").val(); 
                             var nomAcademia=$('#nomAcademia').val();
                             var tiempoAcademia=$('#tiempoAcademia').val();
                             var numIntento=$('#numIntento').val();
                             var postuCarrera=$('#postuCarrera').val();
                             
                            var datosEd="idEdu="+idEdu+"&colegio="+colegio+"&nombreC="+nombreC+"&ubicacionC="+ubicacionC
                                        +"&carreraT="+carreraT+"&nombreCr="+nombreCr+"&actAcade="+actAcade
                                        +"&actDepor="+actDepor+"&academia="+academia+"&nomAcademia="+nomAcademia+"&tiempoAcademia="+tiempoAcademia
                                        +"&numIntento="+numIntento+"&postuCarrera="+postuCarrera+"&boton="+boton;
                          
                            $.ajax({
                                type: "POST",
                                url: "cEducacion.php",
                                data: datosEd,
                            success: function(html)
                                        {	
                                                if(html>0)
                                                {//alert('Guardando Educacion')
                                                      $('#idEdu').html(html);
                                                     
                                                         
                                                }
                                               
                                                      
                                }
                            });
                                         
}

function guardarSalud(boton){ 
     var idSal=$('#idSal').html();
                          
                             var enfermedad=$("input[name='enfermedad']:checked").val(); 
                             var enfermedadNom=$('#enfermedadNom').val();
                             var atencionS=$("input[name='atencionS']:checked").val(); 
                             var embarazo=$("input[name='embarazada']:checked").val(); 
                             var embTiempo=$('#embTiempo').val();
                             var dobemb=$('#dobemb').val();
                             var lcontroles=$('#lcontroles').val();
                             var conceptivo=$("input[name='conceptivo']:checked").val();
                             var anticonceptivo=$('#Antc').val();
                             var datosSa="idSal="+idSal+"&enfermedad="+enfermedad+"&enfermedadNom="+enfermedadNom+"&atencionS="+atencionS+"&embarazo="+embarazo+"&embTiempo="+embTiempo+"&dobemb="+dobemb+"&lcontroles="+lcontroles+"&conceptivo="+conceptivo+"&anticonceptivo="+anticonceptivo+"&boton="+boton;
                       // alert(datosSa)
                            $.ajax({
                                type: "POST",
                                url: "cSalud.php",
                                data: datosSa,
                            success: function(html)
                                        {	
                                                if(html>0)
                                                {//alert('Guardando Salud')
                                                     $('#idSal').html(html);
                                                     
                                                         
                                                }
                                               
                                                       
                                }
                            });
                            
}
function guardarUniversidad(boton){
    
      var idU=$('#idU').html();
      
                              
                            var universidad=$("input[name='universidad']:checked").val(); 
                             var tcarrera=$('#tcarrera').val();
                             var pcarrera=$('#pcarrera').val();
                             var ayuda=$('#ayuda').val();
                var motivo_1;
                var motivo_2;
                var motivo_3;
                var motivo_4;
                var motivo_5;
                var motivo_6;
                var motivo_7;
                var motivo_8;
                var motivo_9;
                var motivo_10;
                          if($('#motivo_1:checked').val()!=null){
                                 motivo_1=$('#motivo_1:checked').val();
                            }else{
                                 motivo_1='No'
                            }
                            if($('#motivo_2:checked').val()!=null){
                                 motivo_2=$('#motivo_2:checked').val();
                            }else{
                                 motivo_2='No'
                            }
                            if($('#motivo_3:checked').val()!=null){
                                 motivo_3=$('#motivo_3:checked').val();
                            }else{
                                 motivo_3='No'
                            }
                            if($('#motivo_4:checked').val()!=null){
                                 motivo_4=$('#motivo_4:checked').val();
                            }else{
                                 motivo_4='No'
                            }
                            if($('#motivo_5:checked').val()!=null){
                                 motivo_5=$('#motivo_5:checked').val();
                            }else{
                                 motivo_5='No'
                            }
                            if($('#motivo_6:checked').val()!=null){
                                 motivo_6=$('#motivo_6:checked').val();
                            }else{
                                 motivo_6='No'
                            }
                            if($('#motivo_7:checked').val()!=null){
                                 motivo_7=$('#motivo_7:checked').val();
                            }else{
                                 motivo_7='No'
                            }
                            if($('#motivo_8:checked').val()!=null){
                                 motivo_8=$('#motivo_8:checked').val();
                            }else{
                                 motivo_8='No'
                            }
                            if($('#motivo_9:checked').val()!=null){
                                 motivo_9=$('#motivo_9:checked').val();
                            }else{
                                 motivo_9='No'
                            }
                            if($('#motivo_10:checked').val()!=null){
                                 motivo_10=$('#motivo_10:checked').val();
                            }else{
                                 motivo_10='No'
                            }
                          
                             
                            var datosU="idU="+idU+"&universidad="+universidad+"&tcarrera="+tcarrera+"&pcarrera="+pcarrera+"&motivo_1="+motivo_1+"&motivo_2="+motivo_2+"&motivo_3="+motivo_3+"&motivo_4="+motivo_4+"&motivo_5="+motivo_5+"&motivo_6="+motivo_6+"&motivo_7="+motivo_7+"&motivo_8="+motivo_8+"&motivo_9="+motivo_9+"&motivo_10="+motivo_10+"&ayuda="+ayuda+"&boton="+boton;
              
                                $.ajax({
                                                type: "POST",
                                                url: "cAcademico.php",
                                                data: datosU,
                                            success: function(html)
                                                        {	
                                                                if(html>0)
                                                                {//alert('Guardando Academico')
                                                                             $('#idU').html(html);
                                                                    

                                                                }
                                                                
                                                }
                                            });
                                      
                                        
                                        
}
function guardarVivienda(boton){
     var idVi=$('#idVi').html();
    
     
                             var vivienda=$('#vivienda').val();
                             var construccion=$('#construccion').val();
                             var servicio_a='';
                             var servicio_b='';
                             var servicio_c='';
                             var servicio_d='';
                             var servicio_e='';
                             var servicio_f='';
                             
                             var equipo_a='';
                             var equipo_b='';
                             var equipo_c='';
                             var equipo_d='';
                             var equipo_e='';
                             var equipo_f='';
                             var equipo_g='';
                             var equipo_h='';
                             
                            if($('#servicio1:checked').val()!=null){
                                 servicio_a=$('#servicio1:checked').val();
                            }else{
                                 servicio_a='No tiene agua'
                            }
                            if($('#servicio2:checked').val()!=null){
                                 servicio_b=$('#servicio2:checked').val();
                            }else{
                                 servicio_b='No tiene desagüe'
                            }
                            if($('#servicio3:checked').val()!=null){
                                 servicio_c=$('#servicio3:checked').val();
                            }else{
                                 servicio_c='No tiene luz'
                            }
                            if($('#servicio4:checked').val()!=null){
                                 servicio_d=$('#servicio4:checked').val();
                            }else{
                                 servicio_d='No tiene Alumbrado Público'
                            }
                            if($('#servicio5:checked').val()!=null){
                                 servicio_e=$('#servicio5:checked').val();
                            }else{
                                 servicio_e='No tiene cable'
                            }
                            if($('#servicio6:checked').val()!=null){
                                 servicio_f=$('#servicio6:checked').val();
                            }else{
                                 servicio_f='No tiene Internet'
                            }
                       
                        if($('#equipo1:checked').val()!=null){
                                 equipo_a=$('#equipo1:checked').val();
                            }else{
                                 equipo_a='No tiene TV'
                            }
                            if($('#equipo2:checked').val()!=null){
                                 equipo_b=$('#equipo2:checked').val();
                            }else{
                                 equipo_b='No tiene Equipo de sonido'
                            }
                            if($('#equipo3:checked').val()!=null){
                                 equipo_c=$('#equipo3:checked').val();
                            }else{
                                 equipo_c='No tiene computadora'
                            }
                            if($('#equipo4:checked').val()!=null){
                                 equipo_d=$('#equipo4:checked').val();
                            }else{
                                 equipo_d='No tiene Cocina a gas'
                            }
                            if($('#equipo5:checked').val()!=null){
                                 equipo_e=$('#equipo5:checked').val();
                            }else{
                                 equipo_e='No tiene Refrigerador'
                            }
                            if($('#equipo6:checked').val()!=null){
                                 equipo_f=$('#equipo6:checked').val();
                            }else{
                                 equipo_f='No tiene microondas'
                            }
                            if($('#equipo7:checked').val()!=null){
                                 equipo_g=$('#equipo7:checked').val();
                            }else{
                                 equipo_g='No tiene Muebles de sala/comedor'
                            }
                            if($('#equipo8:checked').val()!=null){
                                 equipo_h=$('#equipo8:checked').val();
                            }else{
                                 equipo_h='No tiene Otros'
                            }
                            
                             
                            var datosSa="idVi="+idVi+"&vivienda="+vivienda+"&construccion="+construccion
                                        +"&servicio_a="+servicio_a+"&servicio_b="+servicio_b+"&servicio_c="+servicio_c+"&servicio_d="+servicio_d+"&servicio_e="+servicio_e+"&servicio_f="+servicio_f
                                    +"&equipo_a="+equipo_a+"&equipo_b="+equipo_b+"&equipo_c="+equipo_c+"&equipo_d="+equipo_d+"&equipo_e="+equipo_e+"&equipo_f="+equipo_f+"&equipo_g="+equipo_g+"&equipo_h="+equipo_h
                                        +"&boton="+boton;
                            $.ajax({
                                type: "POST",
                                url: "cVivienda.php",
                                data: datosSa,
                            success: function(html)
                                        {	
                                                if(html>0)
                                                {
                                                     $('#idVi').html(html);
                                                }else{
                                                alert(html)
                                                }
                                                                                                   
                                }
                            });                              
                       

}

function guardarFichaII(boton){
    switch(boton)
	{
        case 'Guardar':
                        guardarEducacion(boton)
                        guardarSalud(boton);
                        guardarVivienda(boton);
                        guardarUniversidad(boton);
                        guardarValidacion(boton);
                break;
        }
}
function guardarFicha(boton)
{
    switch(boton)
	{
		case 'Guardar':
                    if (document.formElem.domicilioActual.value.length==0){ 
                        alert("Tiene que escribir su domicilio actual") 
                        return false; 
                    }                    
                     if (document.formElem.telefonoA.value.length==0){ 
                        alert("Tiene que escribir su telefono actual") 
                        return false; 
                    }
                     if (document.formElem.dob.value.length==0){ 
                        alert("Tiene que seleccionar su fecha de cumpleaños") 
                        return false; 
                    }
                   // alert('datos')
                        var idDatos=$('#idDatos').html();
                        var domicilioActual=$('#domicilioActual').val();
                        var telefonoA=$('#telefonoA').val();
                        var departamentoA=$('#departamentoA').val();
                        var provinciaA=$('#provinciaAl').val();
                        var fechaNac=$('#dob').val();
                        var datosd="idDatos="+idDatos+"&domicilioActual="+domicilioActual+"&telefonoA="+telefonoA+"&departamentoA="+departamentoA+"&provinciaA="+provinciaA+"&fechaNac="+fechaNac+"&boton="+boton;
			//alert(datosd)
                       
			$.ajax({
                                type: "POST",
                                url: "cDatoGenerales.php",
                                data: datosd,
                            success: function(html)
                                        {	
                                                if(html>0)
                                                {//alert('Guardando Datos Generales')
                                                     $('#idDatos').html(html);
                                                  
                                                         
                                                }
                                                
                                }
                            });
                           
                      ////FAMILIAR
                  
                     if (document.formElem.huerfano.value.length==0){ 
                        alert("Falta seleccionar aspecto familiar") 
                        return false; 
                    }
                     if (document.formElem.num_hijo.value.length==0){ 
                        alert("Tiene que escribir el total de hermanos en su familia") 
                        return false; 
                    }
                     if (document.formElem.num_dependiente.value.length==0){ 
                        alert("Tiene que escribir total de dependientes") 
                        return false; 
                    }
                     if (document.formElem.num_independiente.value.length==0){ 
                        alert("Tiene que escribir total de independientes") 
                        return false; 
                    }
                     var idFam=$('#idFam').html();
                            // var padresSA=$('#padresSA').val();
                    var padresSA=$("input[name='radio1']:checked").val();    
                    var huerfano=$('#huerfano').val();
                    var num_hijo=$('#num_hijo').val();
                    var num_dependiente=$('#num_dependiente').val();
                    var num_independiente=$('#num_independiente').val();
                    var datosF="idFam="+idFam+"&padresSA="+padresSA+"&huerfano="+huerfano+"&num_hijo="+num_hijo+"&num_dependiente="+num_dependiente+"&num_independiente="+num_independiente+"&boton="+boton;

                    $.ajax({
                        type: "POST",
                        url: "cFamiliares.php",
                        data: datosF,
                        success: function(html)
                                {	
                                        if(html>0)
                                        {//alert('Guardando Familiares')
                                            $('#idFam').html(html);
                                        }
                                }
                         });
                      
                      ///
                        guardarViolencia(boton);
                        guardarDeudas(boton);
                         alert('Guardando Datos')
                break;
		
	}
}

function guardarValidacion(boton){
var idval=$('#idval').html();
                                    $.ajax({
                                        type: "POST",
                                        url: "cValidar.php",
                                        data: "boton=Guardar",
                                    success: function(html)
                                                {
                                                   //  alert(html)                                                           
						}
                                    });
                            
                            
}


