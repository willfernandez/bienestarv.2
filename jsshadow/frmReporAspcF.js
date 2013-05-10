 $(document).ready(function()
{
    
	if($('#vperiodo').val()!=null){
            var periodo=$('#vperiodo').val();
            var facultad=$('#vfacultad').val();
            var carrera=$('#vcarrera').val();
            var sede =$("#vsede").val();
            if(sede == null){
              sede=0;
            }
          //  alert(carrera)
         // cargarFacultadesR(facultad);
          cargarCarrerasR(facultad,carrera);
          cargarCiclosR(carrera);
          cargarSedesR(sede);
        //  cargarFiltradorCarreras()
          SituacionActualPadres(periodo,carrera,sede);
         
        }
});
 
 $("a").click(function()
  {
      //alert('fff')
	var aa=$(this)[0].id;
	var a=aa.split('*');
	var accion=a[0];
	 
        
	if(accion=='reporte')
	{
            window.open("frmReporteAspeFam.php?periodo="+a[1]+"&facultad="+a[2]+"&carrera="+a[3]+"&sede="+a[4], '_blank');
   }
   });
        
        
       function SituacionActualPadres(periodo,carrera,sede){
           $('#tabla').html('');
           $('#prueba').html('');
           var ciclo =$('#cicloR_id').val();
          
            if(ciclo == null || ciclo== '0'){
                var datosSP="boton=BuscarPeriodo&periodo="+periodo+"&carrera="+carrera+"&sede="+sede+"&ciclo=0";
               }
              if(ciclo != null ){
               var datosSP="boton=BuscarPeriodo&periodo="+periodo+"&carrera="+carrera+"&sede="+sede+"&ciclo="+ciclo;
              }
                $.ajax({
                                type: "POST",
                                url: "cFamiliares.php",
                                data: datosSP,
                            success: function(html)
                                        {
                                            var a=html.split('*');
                                            if(sede == 0){
                                            a[5]='CONSOLIDADO';
                                             }
                                               $('#sedeF').html(a[5]);
                                                $('#facultadF').html(a[8]);
                                                $('#carreraF').html(a[7]);
                                                $('#periodoF').html(a[6]);
                                                if(ciclo == null){
                                                      $('#cicloF').html('CONSOLIDADO');

                                                }else{
                                                     traerCiclo($('#cicloR_id').val());
                                                     traerTablaAlumnos(periodo,carrera,ciclo,'estado_padres',sede);
                                                }
                                                
                                            tabla="<table class='table_detalle table-bordered' style='text-align:center;width:40%;margin:auto;position:relative; top: -50px;'>";
                                                    tabla+="<thead><th>#</th><th>Situación de los Padres</th><th>Frecuencia</th><th>%</th></thead><tbody>";
                                                    tabla+="<tr><td align='center'>1</td>";
                                                    tabla+="<td>Casados</td>";
                                                    tabla+="<td>"+a[0]+"</td>";
                                                    var porcentaje=(a[0]/a[4])*100;
                                                    var total1=formatNumber(porcentaje);
                                                    tabla+="<td>"+total1+"%</td></tr>";

                                                    tabla+="<tr><td align='center'>2</td>";
                                                    tabla+="<td>Convivientes</td>";
                                                    tabla+="<td>"+a[1]+"</td>"; 
                                                    var porcentaje2=(a[1]/a[4])*100;
                                                    var total2=formatNumber(porcentaje2);
                                                    tabla+="<td>"+total2+"%</td></tr>";

                                                    tabla+="<tr><td align='center'>3</td>";
                                                    tabla+="<td>Divorciados</td>";
                                                    tabla+="<td>"+a[2]+"</td>"; 
                                                    var porcentaje3=(a[2]/a[4])*100;
                                                    var total3=formatNumber(porcentaje3);
                                                    tabla+="<td>"+total3+"%</td></tr>";

                                                    tabla+="<tr><td align='center'>4</td>";
                                                    tabla+="<td>Separados</td>";
                                                    tabla+="<td>"+a[3]+"</td>"; 
                                                    var porcentaje4=(a[3]/a[4])*100;
                                                    var total4=formatNumber(porcentaje4);
                                                    tabla+="<td>"+total4+"%</td></tr></tbody>";
                                                    tabla+="<tfoot><tr><td colspan='2'>Total</td>";
                                                    tabla+="<td>"+a[4]+"</td>";
                                                    tabla+="<td>100%</td>";
                                                    tabla+="</tr></tfoot></table>";
                                                        $('#tabla').html(tabla);
                                            var legend;
                                            var chartData = [{
                                                country: "Casados",
                                                value: a[0]
                                            }, {
                                                country: "Convivientes",
                                                value: a[1]
                                            }, {
                                                country: "Divorciados",
                                                value: a[2]
                                            }, {
                                                country: "Separados",
                                                value: a[3]
                                            }];
                                // PIE CHART
                                chart = new AmCharts.AmPieChart();
                                chart.addTitle("Situación actual de los padres: "+a[5]+"-"+a[6], 16);
                                chart.dataProvider = chartData;
                                chart.titleField = "country";
                                chart.valueField = "value";
                                chart.outlineColor = "#FFFFFF";
                                // this makes the chart 3D
                                chart.depth3D = 15;
                                chart.angle = 30;
                                chart.colors = [
                                                    "#f3f92f","#0eee20", "#0D8ECF", 
                                                    "#FF0F00","#8A0CCF", "#CD0D74", 
                                                    "#754DEB", "#DDDDDD", "#999999", "#333333", 
                                                    "#000000", "#57032A", "#CA9726", "#990000", "#4B0C25"];
                                // WRITE
                                var legend = new AmCharts.AmLegend();
                                legend.position = "right";
                                chart.addLegend(legend);
                                chart.write("prueba");
                                }
                        });
                          SituacionActualEstudiante(periodo,carrera,sede);
       }
       
       
       function SituacionActualEstudiante(periodo,carrera,sede){
            
           $('#sitEstud').html('');
           $('#tabSe').html('');
           var ciclo =$('#cicloR_id').val();
           if(ciclo == null || ciclo== '0'){
                var datosSE="boton=BuscarPeriodoSE&periodo="+periodo+"&carrera="+carrera+"&sede="+sede+"&ciclo=0";
           }
           if(ciclo != null ){
               
               var datosSE="boton=BuscarPeriodoSE&periodo="+periodo+"&carrera="+carrera+"&sede="+sede+"&ciclo="+ciclo;
               traerTablaAlumnosSE(periodo,carrera,ciclo,'estado_hijo',sede);
           }
           
        $.ajax({
                                type: "POST",
                                url: "cFamiliares.php",
                                data: datosSE,
                            success: function(html)
                                        {
                                            var b=html.split('*');
                                             if(sede == 0){
                                                b[5]='CONSOLIDADO';
                                              }
                                            tablaSe="<table class='table_detalle table-bordered' style='text-align:center;width:40%;margin:auto;position:relative; top: -50px;'>";
                                                    tablaSe+="<thead><th>#</th><th>Situación de los Padres</th><th>Frecuencia</th><th>%</th></thead><tbody>";
                                                    tablaSe+="<tr><td align='center'>1</td>";
                                                    tablaSe+="<td>Huérfano de padre</td>";
                                                    tablaSe+="<td>"+b[0]+"</td>";
                                                    var porcentaje=(b[0]/b[4])*100;
                                                    var total1=formatNumber(porcentaje);
                                                    tablaSe+="<td>"+total1+"%</td></tr>";

                                                    tablaSe+="<tr><td align='center'>2</td>";
                                                    tablaSe+="<td>Huérfano de madre</td>";
                                                    tablaSe+="<td>"+b[1]+"</td>"; 
                                                    var porcentaje2=(b[1]/b[4])*100;
                                                    var total2=formatNumber(porcentaje2);
                                                    tablaSe+="<td>"+total2+"%</td></tr>";

                                                    tablaSe+="<tr><td align='center'>3</td>";
                                                    tablaSe+="<td>Huérfano de ambos</td>";
                                                    tablaSe+="<td>"+b[2]+"</td>"; 
                                                    var porcentaje3=(b[2]/b[4])*100;
                                                    var total3=formatNumber(porcentaje3);
                                                    tablaSe+="<td>"+total3+"%</td></tr>";

                                                    tablaSe+="<tr><td align='center'>4</td>";
                                                    tablaSe+="<td>N.A</td>";
                                                    tablaSe+="<td>"+b[3]+"</td>"; 
                                                    var porcentaje4=(b[3]/b[4])*100;
                                                    var total4=formatNumber(porcentaje4);
                                                    tablaSe+="<td>"+total4+"%</td></tr></tbody>";
                                                    tablaSe+="<tfoot><tr><td colspan='2'>Total</td>";
                                                    tablaSe+="<td>"+b[4]+"</td>";
                                                    tablaSe+="<td>100%</td>";
                                                    tablaSe+="</tr></tfoot></table>";
                                           $('#tabSe').html(tablaSe);
                                           var legend;
                                            var chartData = [{
                                                country: "Huérfano de padre",
                                                value: b[0]
                                            }, {
                                                country: "Huérfano de madre",
                                                value: b[1]
                                            }, {
                                                country: "Huérfano de ambos",
                                                value: b[2]
                                            }, {
                                                country: "N.A",
                                                value: b[3]
                                            }];
                                // PIE CHART
                                chart = new AmCharts.AmPieChart();
                                chart.addTitle("Situación actual del estudiante:",16);
                                chart.addTitle(b[5]+"-"+b[6], 16);
                                
                            chart.dataProvider = chartData;
                            chart.titleField = "country";
                            chart.valueField = "value";
                            chart.outlineColor = "#FFFFFF";
                            chart.outlineAlpha = 0.8;
                            chart.outlineThickness = 2;
                            // this makes the chart 3D
                            chart.depth3D = 15;
                            chart.angle = 30;
                            chart.labelRadius = 30;
                                chart.colors = [
                                    "#f3f92f","#0eee20", "#0D8ECF", 
                                    "#FF0F00","#8A0CCF", "#CD0D74", 
                                    "#754DEB", "#DDDDDD", "#999999", "#333333", 
                                    "#000000", "#57032A", "#CA9726", "#990000", "#4B0C25"];
                                // WRITE
                                var legend = new AmCharts.AmLegend();
                                legend.position = "right";
                                chart.addLegend(legend);
                                chart.write("sitEstud");
                                }
                        });
                        
                       
        }
function formatNumber(num)
{    
    var n = num.toString();
    var nums = n.split('.');
    var newNum = "";
    if (nums.length > 1)
    {
        var dec = nums[1].substring(0,2);
        newNum = nums[0] + "," + dec;
    }
    else
    {
    newNum = num;
    }
    return newNum;
}

function cargarSedesR(sede){

    $.ajax({
        type:"POST",
        url: "cbxSedeR.php",
        data: "idSede="+sede,
       success: function(html){
           $('#facultad').html(html);
           
       }
    })
}

function cargarFacultadesR(id){
    
    $.ajax({
        type:"POST",
        url: "cbxFacultadR.php",
        data: "idFac="+id,
       success: function(html){
           $('#facultad').html(html);
           
       }
    })
}

function cargarCarrerasR(facultad,carrera_id){
    var datos="facultadAl_id="+facultad+"&carrera_id="+carrera_id;
    $.ajax({
        type:"POST",
        url: "cbxCarreraR.php",
        data: datos,
       success: function(html){
           $('#carrera').html(html);
       }
    });
}

function cargarCiclosR(carrera_id){
    var datos="carrera_id="+carrera_id;
    $.ajax({
        type:"POST",
        url: "cbxCicloR.php",
        data: datos,
       success: function(html){
           $('#cicloR').html(html);
       }
    });
}



function traerCiclo(ciclo){
    var datos="boton=BuscarNombreC&ciclo="+ciclo;
    $.ajax({
        type:"POST",
        url: "cCiclo.php",
        data: datos,
       success: function(html){
           $('#cicloF').html(html);
       }
    });
   
}
function traerTablaAlumnos(periodo,carrera,ciclo,campo,sede){
 var datosSP="boton=BuscarPeriodoAlumnado&periodo="+periodo+"&carrera="+carrera+"&sede=&ciclo="+ciclo+"&campo="+campo+"&sede="+sede;
    $.ajax({
        type: "POST",
        url: "cFamiliares.php",
        data: datosSP,
       success: function(html){
           $('#resumenAlumnos').html(html);
            $('#tabAlumnado').dataTable( {
					"sPaginationType": "bootstrap",
					"sDom": "<'row'<'span5'l><'span6'f>r>t<'row'<'span8'i><'span9'p>>"
				} );
       }
    });
}

function traerTablaAlumnosSE(periodo,carrera,ciclo,campo,sede){
 var datosSP="boton=BuscarPeriodoAlumnado&periodo="+periodo+"&carrera="+carrera+"&sede=&ciclo="+ciclo+"&campo="+campo+"&sede="+sede;
    $.ajax({
        type: "POST",
        url: "cFamiliares.php",
        data: datosSP,
       success: function(html){
           $('#resumenAlumnosSE').html(html);
            $('#tabAlumnadoSE').dataTable( {
					"sPaginationType": "bootstrap",
					"sDom": "<'row'<'span5'l><'span6'f>r>t<'row'<'span8'i><'span9'p>>"
				} );
       }
    });
}