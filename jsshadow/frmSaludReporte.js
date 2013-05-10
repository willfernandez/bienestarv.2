 $(document).ready(function()
{
    
	if($('#vperiodo').val()!=null){
            var periodo=$('#vperiodo').val();
            var facultad=$('#vfacultad').val();
            var carrera=$('#vcarrera').val();
            var sede =$("#vsede").val();
            alert(sede)
            if(sede == null){
              sede=0;
            }
          cargarCarrerasR(facultad,carrera);
          cargarCiclosR(carrera);
          cargarSedesR(sede);
          //cargarFiltradorCarreras()
          padEnfermedad(periodo,carrera,sede);
       
         // SituacionActualEstudiante(periodo,carrera);
        }
});
 
 $("a").click(function()
  {
      //alert('fff')
	var aa=$(this)[0].id;
	var a=aa.split('*');
	var accion=a[0];
	 
        
	if(accion=='reporteSal')
	{
            window.open("frmReporteSalud.php?periodo="+a[1]+"&facultad="+a[2]+"&carrera="+a[3]+"&sede="+a[4], '_blank');
        }
   });
        
        function padEnfermedad(periodo,carrera,sede){
            alert(periodo)
            $('#padEnfermedad').html('');
           $('#TpadEnfermedad').html('');
           var ciclo =$('#cicloR_id').val();
           if(ciclo == null || ciclo== '0'){
                var datosOb="boton=BuscarPadeceEnfermedad&periodo="+periodo+"&carrera="+carrera+"&sede="+sede+"&ciclo=0&campo=enfermdedad";
           }
           if(ciclo != null ){
               
               var datosOb="boton=BuscarPadeceEnfermedad&periodo="+periodo+"&carrera="+carrera+"&sede="+sede+"&ciclo="+ciclo+"&campo=enfermdedad";
           }
           alert(datosOb)
        $.ajax({
                                type: "POST",
                                url: "cSalud.php",
                                data: datosOb,
                            success: function(html)
                                        {
                                            
                                            //0= SI 1 =No         //2 =total            3 sede           4 periodo            5    carrera               6  facultad                    
                                            var b=html.split('*');
                                             if(sede == 0){
                                            b[3]='CONSOLIDADO';
                                             }
                                            $('#sedeF').html(b[3]);
                                                $('#facultadF').html(b[6]);
                                                $('#carreraF').html(b[5]);
                                                $('#periodoF').html(b[4]);
                                                if(ciclo == null){
                                                      $('#cicloF').html('CONSOLIDADO');

                                                }else{
                                                     traerCiclo($('#cicloR_id').val());
                                                     traerTablaAlumnos(periodo,carrera,ciclo,'enfermdedad',sede);
                                                }
                                            tablaSe="<table class='table_detalle table-bordered' style='text-align:center;width:40%;margin:auto;position:relative; top: -50px;'>";
                                                    tablaSe+="<thead><th>#</th><th>¿Padece alguna enfermedad?</th><th>Frecuencia</th><th>%</th></thead><tbody>";
                                                    tablaSe+="<tr><td align='center'>1</td>";
                                                    tablaSe+="<td>Si</td>";
                                                    tablaSe+="<td>"+b[0]+"</td>";
                                                    var porcentaje=(b[0]/b[2])*100;
                                                    var total1=formatNumber(porcentaje);
                                                    tablaSe+="<td>"+total1+"%</td></tr>";

                                                    tablaSe+="<tr><td align='center'>2</td>";
                                                    tablaSe+="<td>No</td>";
                                                    tablaSe+="<td>"+b[1]+"</td>"; 
                                                    var porcentaje2=(b[1]/b[2])*100;
                                                    var total2=formatNumber(porcentaje2);
                                                    tablaSe+="<td>"+total2+"%</td></tr></tbody>";
                                                 

                                                    tablaSe+="<tfoot><tr><td colspan='2'>Total</td>";
                                                    tablaSe+="<td>"+b[2]+"</td>";
                                                    tablaSe+="<td>100%</td>";
                                                    tablaSe+="</tr></tfoot></table>";
                                           $('#TpadEnfermedad').html(tablaSe);
                                           var legend;
                                            var chartData = [{
                                                country: "Si",
                                                value: b[0]
                                            }, {
                                                country: "No",
                                                value: b[1]
                                            }];
                                // PIE CHART
                                chart = new AmCharts.AmPieChart();
                                chart.addTitle("¿Padece alguna enfermedad?",16);
                                
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
                                    "#f3f92f","#FF0F00", "#0D8ECF", 
                                    "#FF0F00","#8A0CCF", "#CD0D74", 
                                    "#754DEB", "#DDDDDD", "#999999", "#333333", 
                                    "#000000", "#57032A", "#CA9726", "#990000", "#4B0C25"];
                                // WRITE
                                var legend = new AmCharts.AmLegend();
                                legend.position = "right";
                                chart.addLegend(legend);
                                chart.write("padEnfermedad");
                                }
                        });
                        BuscarAtencion(periodo,carrera,sede);
        }
       
       
       
       function BuscarAtencion(periodo,carrera,sede){
           $('#aatencion').html('');
           $('#Tatencion').html('');
           var ciclo =$('#cicloR_id').val();
           if(ciclo == null || ciclo== '0'){
                 var datosOb="boton=BuscarAtencion&periodo="+periodo+"&carrera="+carrera+"&sede="+sede+"&ciclo=0&campo=centro_salud";
           }
           if(ciclo != null ){
               
                var datosOb="boton=BuscarAtencion&periodo="+periodo+"&carrera="+carrera+"&sede="+sede+"&ciclo="+ciclo+"&campo=centro_salud";
           }
                //6=total            7 sede           8 periodo            9    carrera               10 facultad                    
                $.ajax({
                                type: "POST",
                                url: "cSalud.php",
                                data: datosOb,
                            success: function(html)
                                        {
                                           var b=html.split('*');
                                                if(ciclo == null){
                                                      $('#cicloF').html('CONSOLIDADO');

                                                }else{
                                                     traerCiclo($('#cicloR_id').val());
                                                     traerTablaAlumnos2(periodo,carrera,ciclo,'centro_salud',sede);
                                                }
                                            tablaSe="<table class='table_detalle table-bordered' style='text-align:center;width:40%;margin:auto;position:relative; top: -50px;'>";
                                                    tablaSe+="<thead><th>#</th><th>Se atiende en:</th><th>Frecuencia</th><th>%</th></thead><tbody>";
                                                    tablaSe+="<tr><td align='center'>1</td>";
                                                    tablaSe+="<td>MINSA</td>";
                                                    tablaSe+="<td>"+b[0]+"</td>";
                                                    var porcentaje=(b[0]/b[5])*100;
                                                    var total1=formatNumber(porcentaje);
                                                    tablaSe+="<td>"+total1+"%</td></tr>";

                                                    tablaSe+="<tr><td align='center'>2</td>";
                                                    tablaSe+="<td>EsSALUD</td>";
                                                    tablaSe+="<td>"+b[1]+"</td>"; 
                                                    var porcentaje2=(b[1]/b[5])*100;
                                                    var total2=formatNumber(porcentaje2);
                                                    tablaSe+="<td>"+total2+"%</td></tr></tbody>";
                                                    
                                                    tablaSe+="<tr><td align='center'>2</td>";
                                                    tablaSe+="<td>Particular</td>";
                                                    tablaSe+="<td>"+b[2]+"</td>"; 
                                                    var porcentaje3=(b[2]/b[5])*100;
                                                    var total3=formatNumber(porcentaje3);
                                                    tablaSe+="<td>"+total3+"%</td></tr></tbody>";
                                                    
                                                    tablaSe+="<tr><td align='center'>2</td>";
                                                    tablaSe+="<td>Remedios caceros</td>";
                                                    tablaSe+="<td>"+b[3]+"</td>"; 
                                                    var porcentaje4=(b[3]/b[5])*100;
                                                    var total4=formatNumber(porcentaje4);
                                                    tablaSe+="<td>"+total4+"%</td></tr></tbody>";
                                                    
                                                    tablaSe+="<tr><td align='center'>2</td>";
                                                    tablaSe+="<td>Se auto medica</td>";
                                                    tablaSe+="<td>"+b[4]+"</td>"; 
                                                    var porcentaje5=(b[4]/b[5])*100;
                                                    var total5=formatNumber(porcentaje5);
                                                    tablaSe+="<td>"+total5+"%</td></tr></tbody>";
                                                    

                                                    tablaSe+="<tfoot><tr><td colspan='2'>Total</td>";
                                                    tablaSe+="<td>"+b[5]+"</td>";
                                                    tablaSe+="<td>100%</td>";
                                                    tablaSe+="</tr></tfoot></table>";
                                           $('#Tatencion').html(tablaSe);
                                           var legend;
                                            var chartData = [{
                                                country: "MINSA",
                                                value: b[0]
                                            }, {
                                                country: "EsSALUD",
                                                value: b[1]
                                            }, {
                                                country: "Particular",
                                                value: b[2]
                                            }, {
                                                country: "Remedios caceros",
                                                value: b[3]
                                            }, {
                                                country: "Se auto medica",
                                                value: b[4]
                                            }];
                                // PIE CHART
                                chart = new AmCharts.AmPieChart();
                                chart.addTitle("Se atiende en:",16);
                                
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
                                chart.write("aatencion");
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
function traerTablaAlumnos(periodo,carrera,ciclo,campo,sede){
 var datosSP="boton=BuscarPeriodoAlumnado&periodo="+periodo+"&carrera="+carrera+"&sede=&ciclo="+ciclo+"&campo="+campo+"&sede="+sede;
    $.ajax({
        type: "POST",
        url: "cSalud.php",
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

function traerTablaAlumnos2(periodo,carrera,ciclo,campo,sede){
 var datosSP="boton=BuscarPeriodoAlumnado&periodo="+periodo+"&carrera="+carrera+"&sede=&ciclo="+ciclo+"&campo="+campo+"&sede="+sede;
    $.ajax({
        type: "POST",
        url: "cSalud.php",
        data: datosSP,
       success: function(html){
           $('#resumenAlumnos2').html(html);
            $('#tabAlumnado2').dataTable( {
                    "sPaginationType": "bootstrap",
                    "sDom": "<'row'<'span5'l><'span6'f>r>t<'row'<'span8'i><'span9'p>>"
                } );
       }
    });
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

function cargarSedesR(sede){

    $.ajax({
        type:"POST",
        url: "cbxSedeR.php",
        data: "idSede="+sede,
       success: function(html){
           $('#sede').html(html);
           
       }
    });
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