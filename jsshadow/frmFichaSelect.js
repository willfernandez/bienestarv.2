 $("a").click(function()
  {
      //alert('fff')
	var aa=$(this)[0].id;
	var a=aa.split('*');
	var accion=a[0];
	 
        
	if(accion=='Modificar')
	{
            $('#todo').show();
			//alert('holas');
            $('#modif').hide();
			     $('#idDatos').html(a[1]);
                $('#domicilioActual').val(a[4]);
                $('#telefonoA').val(a[5]);
                $('#departamentoA').val(a[2]);
                cargarProvincia(a[2]);
                $('#dob').val(a[6]);
                $('#provinciaAl').val(a[3]);
                
                
                //cargar emergencia
               $('#iidE').html(a[7]);
               
			   var data =a[7]+'*'+a[8]+'*'+a[9]+'*'+a[10]+'*'+a[11]+'*'+a[12];
                           
                     //      alert(data)
                var frm="<table align='center' class='table table-striped table-bordered dataTable' id='document'> <thead><tr><th>No</th><th>Familiar</th><th>Nombres y Apellidos</th><th>Telefono</th><th>Acci&oacute;n</th></tr></thead><tbody>";
                            frm+="<tr><td>1</td>";
							frm+="<td>"+a[9]+"</td>";
                            frm+="<td>"+a[8]+"</td>";
                            frm+="<td>"+a[11]+"</td>";
							frm+='<td><a  href="#myModal" data-toggle="modal" id="Modificar*'+a[7]+'*'+a[8]+'*'+a[9]+'*'+a[10]+'*'+a[11]+'*'+a[12]+'"><img src="images/editar.png"/ title="Editar"></a><a id="Eliminar*$data"><img src="images/borrar.png"/></a></td></tr>';
                            frm+="</tbody></table>";
                            //CORREGIR
                            $('#validaBtn1').val(a[7]); 
                $('#TablaE').html(frm); 
                
                      
                 //Aspecto Familiar
                 $('#idFam').html(a[13]);
                 var i;
                 var elemento = document.getElementsByName("radio1");
                 for (i=0;i<elemento.length;i++){ 
                    if (elemento[i].value==a[14]) {
                        // alert(elemento[i].value)
                        elemento[i].checked="true";
                    
                   }
                    } 
                 $('#huerfano').val(a[15]);
                 $('#num_hijo').val(a[18]);
                 $('#num_dependiente').val(a[16]);
                 $('#num_independiente').val(a[17]);
                 
                 //Convivencia
                 $('#idVio').html(a[19]);
                   $('#razonV').val(a[25]);
                    
               
                 var m;
                 var familiaA = document.getElementsByName("familiaA");
                 for (m=0;m<familiaA.length;m++){ 
                    if (familiaA[m].value==a[20]) {
                     //  alert(familiaA[m].value)
                        familiaA[m].checked="true";
                    
                    }
                    }
                    // alert(a[25]);
                  var b;
                 var rea = document.getElementsByName("relacion");
                 for (b=0;b<rea.length;b++){ 
                     
                    if (rea[b].value==a[21]) {
                       //  alert(rea[b].value)
                        rea[b].checked="true";
                    
                    }
                    }
                 
                 var j;
                 var violencia = document.getElementsByName("violencia")
                 for (j=0;j<violencia.length;j++){ 
                    if (violencia[j].value==a[22]) 
                    {
                       // alert(violencia[j].value)
                        violencia[j].checked="true";
                        if(a[22]=='Si')
                          {
                              $('#escondermaltrato').show();
                              var k;
                                var mp = document.getElementsByName("maltratoP")
                                for (k=0;k<mp.length;k++){ 
                                    if (mp[k].value==a[24]) {
                                 //       alert(mp[k].value)
                                        mp[k].checked="true";

                                    }
                                    } 
                                    var l;
                                var mf = document.getElementsByName("maltratoF")
                                for (l=0;l<mp.length;l++){ 
                                    if (mf[l].value==a[23]) {
                                    //    alert(mf[l].value)
                                        mf[l].checked="true";

                                    }
                                    } 
                              
                          }
                  
                    }
                    }
                    
                    ///fin de convivencia
                    
                    /// Economia
                     $('#idDeu').html(a[26]);
                     var d;
                 var deudaP = document.getElementsByName("deudaP")
                 for (d=0;d<deudaP.length;d++){ 
                    if (deudaP[d].value==a[27]) 
                    {
                       // alert(violencia[j].value)
                        deudaP[d].checked="true";
                        if(a[27]=='Si')
                          {
                              $('#esconderEconomia').show();
                              var d1;
                                var tipoDeuda1 = document.getElementsByName("tipoDeuda1")
                                for (d1=0;d1<tipoDeuda1.length;d1++){ 
                                    if (tipoDeuda1[d1].value==a[30]) {
                                 //       alert(mp[k].value)
                                        tipoDeuda1[d1].checked="true";

                                    }
                                    } 
                                    $('#desdeEco').val(a[29]);
                                    $('#cuantoEco').val(a[28]);
                          }else{
                              $('#desdeEco').val('0');
                               $('#cuantoEco').val('0');
                          }
                  
                    }
                    }
                 
                 
                 ///  EDUCACION
                 
                 $('#idEdu').html(a[31]);
                 $('#colegio').val(a[32]);
                 $('#nombreC').val(a[33]);
                 $('#ubicacionC').val(a[34]);
               
               
               var edu;
                 var carreraT = document.getElementsByName("carreraT")
                 for (edu=0;edu<carreraT.length;edu++){ 
                    if (carreraT[edu].value==a[35]) 
                    {
                       // alert(violencia[j].value)
                        carreraT[edu].checked="true";
                        if(a[35]=='Si')
                          {
                              $('#esconderCarrera').show();
                                    $('#nombreCr').val(a[36]);
                          }else{
                               $('#nombreCr').val('no hay carrera tecnica');
                          }
                  
                    }
                    }
                 $('#actAcade').val(a[37]);
                 $('#actDepor').val(a[38]);
                 
                 var edu2;
                 var academia = document.getElementsByName("academia")
                 for (edu2=0;edu2<academia.length;edu2++){ 
                    if (academia[edu2].value==a[39]) 
                    {
                       // alert(violencia[j].value)
                        academia[edu2].checked="true";
                        if(a[39]=='Si')
                          {
                              $('#esconderAcademia').show();
                                    $('#nomAcademia').val(a[40]);
                                    $('#tiempoAcademia').val(a[41]);
                          }else{
                                $('#nomAcademia').val('No hay academia');
                                 $('#tiempoAcademia').val('No hay academia');
                          }
                  
                    }
                    }
                    $('#numIntento').val(a[42]);
                    $('#postuCarrera').val(a[43]);
                   //SALUD
                   $('#idSal').html(a[44]);
                   
                 var sa;
                 var enfermedad = document.getElementsByName("enfermedad")
                 for (sa=0;sa<enfermedad.length;sa++){ 
                    if (enfermedad[sa].value==a[45]) 
                    {
                       // alert(violencia[j].value)
                        enfermedad[sa].checked="true";
                        if(a[45]=='Si')
                          {
                              $('#esconderenfermedad').show();
                                    $('#enfermedadNom').val(a[46]);
                          }else{
                              $('#enfermedadNom').val('No hay enfermedad');
                          }
                    }
                 }
              
                 var saa;
                 var atencionS = document.getElementsByName("atencionS")
                 for (saa=0;saa<atencionS.length;saa++){ 
                    if (atencionS[saa].value==a[47]) 
                    {
                       // alert(violencia[j].value)
                        atencionS[saa].checked="true";
                        
                    }
                 }
                //alert('holas')
                //VIVIENDA
                
                $('#idVi').html(a[48]);
                $('#vivienda').val(a[49]);
                $('#construccion').val(a[50]);
              var ele=document.getElementsByName("servicio");
                if($('#servicio1').val()==a[51]){
                  
                   
                   ele[0].checked=true;
                  
                }
                if($('#servicio2').val()==a[52]){
                   ele[1].checked=true;
                }
                if($('#servicio3').val()==a[53]){
                     ele[2].checked=true;
                }
                if($('#servicio4').val()==a[54]){
                     ele[3].checked=true;
                }
                if($('#servicio5:checked').val()==a[55]){
                     ele[4].checked=true;
                }                
                if($('#servicio6:checked').val()==a[56]){
                     ele[5].checked=true;
                }
                
                 var equi=document.getElementsByName("equipos");
                if($('#equipo1').val()==a[57]){
                  
                   
                   equi[0].checked=true;
                  
                }
                if($('#equipo2').val()==a[58]){
                   equi[1].checked=true;
                }
                if($('#equipo3').val()==a[59]){
                     equi[2].checked=true;
                }
                if($('#equipo4').val()==a[60]){
                     equi[3].checked=true;
                }
                if($('#equipo5:checked').val()==a[61]){
                     equi[4].checked=true;
                }
                if($('#equipo6:checked').val()==a[62]){
                     equi[5].checked=true;
                }
                if($('#equipo7:checked').val()==a[63]){
                     equi[6].checked=true;
                }
                if($('#equipo8:checked').val()==a[64]){
                     equi[7].checked=true;
                }
                
                //ACADEMICOS
                $('#idU').html(a[65]);
                var un;
                 var universidad = document.getElementsByName("universidad")
                 for (un=0;un<universidad.length;un++){ 
                     
                    if (universidad[un].value==a[66]) 
                    {
                        
                      
                                    
                        universidad[un].checked="true";
						
                        if(a[66]=='Si')
                          {
                              $('#esconderUniversidad').show();
                                    $('#tcarrera').val(a[67]);
                                    $('#pcarrera').val(a[68]);
                                     $('#ayuda').val(a[79]);
                                    
                                    var acade=document.getElementsByName("motivo");
                                    
                                    
                                    if($('#motivo_1').val()==a[69]){
                                      acade[0].checked=true;
                                    }
                                    if($('#motivo_2').val()==a[70]){
                                      //  alert($('#motivo_2').val()+a[70])
                                      acade[1].checked=true;
                                    }
                                    if($('#motivo_3').val()==a[71]){
                                      acade[2].checked=true;
                                    }
                                    if($('#motivo_4').val()==a[72]){
                                      acade[3].checked=true;
                                    }
                                    if($('#motivo_5').val()==a[73]){
                                      acade[4].checked=true;
                                    }
                                    if($('#motivo_6').val()==a[74]){
                                      acade[5].checked=true;
                                    }
                                    if($('#motivo_7').val()==a[75]){
                                      acade[6].checked=true;
                                    }
                                    if($('#motivo_8').val()==a[76]){
                                      acade[7].checked=true;
                                    }
                                    if($('#motivo_9').val()==a[77]){
                                      acade[8].checked=true;
                                    }
                                    if($('#motivo_10').val()==a[78]){
                                      acade[9].checked=true;
                                    }
                                    
                          }else{
                              $('#tcarrera').val('0');
                              $('#pcarrera').val('0');
							  $('#ayuda').val('-');
                          }
                    }
                 }
               //ECONOMIA
               $('#economia').html(a[80]);
               $('#validaBtn2').val('-');
               
               //alert(a[80])
                
                
                
	}
  });
  
  
  
  
  