 $(document).ready(function()
{
    
	if($('#vperiodo').val()!=null){
            var periodo=$('#vperiodo').val();
            var facultad=$('#vfacultad').val();
            var carrera=$('#vcarrera').val();
          //  alert(carrera)
           var sede =$("#vsede").val();
            if(sede == null){
              sede=0;
            }
         // cargarFacultadesR(facultad);
          cargarCarrerasR(facultad,carrera);
          cargarCiclosR(carrera);
          cargarSedesR(sede);
          //cargarFiltradorCarreras()
         tipoColegio(periodo,carrera,sede);
          
         // SituacionActualEstudiante(periodo,carrera);
        }
});
 
 $("a").click(function()
  {
      //alert('fff')
	var aa=$(this)[0].id;
	var a=aa.split('*');
	var accion=a[0];
	 
        
	if(accion=='reporteEdu')
	{
            window.open("frmReporteEducacion.php?periodo="+a[1]+"&facultad="+a[2]+"&carrera="+a[3]+"&sede="+a[4], '_blank');
        }
   });
        
        function tipoColegio(periodo,carrera,sede){
           $('#tipoColegio').html('');
           $('#TtipoColegio').html('');
           var ciclo =$('#cicloR_id').val();
           if(ciclo == null || ciclo== '0'){
                var datosOb="boton=BuscarTipoColegio&periodo="+periodo+"&carrera="+carrera+"&sede="+sede+"&ciclo=0&campo=tipo_colegio";
           }
           if(ciclo != null ){
               
               var datosOb="boton=BuscarTipoColegio&periodo="+periodo+"&carrera="+carrera+"&sede="+sede+"&ciclo="+ciclo+"&campo=tipo_colegio";
           }
        $.ajax({
                                type: "POST",
                                url: "cEducacion.php",
                                data: datosOb,
                            success: function(html)
                                        {
                                            //0= SI 1 =No         //2 =total            3 sede           4 periodo            5    carrera               6  facultad                    
                                            var b=html.split('*');
                                            if(sede == 0){
                                            b[4]='CONSOLIDADO';
                                             }
                                            $('#sedeF').html(b[4]);
                                                $('#facultadF').html(b[7]);
                                                $('#carreraF').html(b[6]);
                                                $('#periodoF').html(b[5]);
                                                if(ciclo == null){
                                                      $('#cicloF').html('CONSOLIDADO');

                                                }else{
                                                     traerCiclo($('#cicloR_id').val());
                                                     traerTablaAlumnos(periodo,carrera,ciclo,'tipo_colegio',sede);
                                                }
                                            tablaSe="<table class='table_detalle table-bordered' style='text-align:center;width:40%;margin:auto;position:relative; top: -50px;'>";
                                                    tablaSe+="<thead><th>#</th><th>El alumno proviene de:</th><th>Frecuencia</th><th>%</th></thead><tbody>";
                                                    tablaSe+="<tr><td align='center'>1</td>";
                                                    tablaSe+="<td>I.E Parroquial</td>";
                                                    tablaSe+="<td>"+b[0]+"</td>";
                                                    var porcentaje=(b[0]/b[3])*100;
                                                    var total1=formatNumber(porcentaje);
                                                    tablaSe+="<td>"+total1+"%</td></tr>";

                                                    tablaSe+="<tr><td align='center'>2</td>";
                                                    tablaSe+="<td>I.E Nacional</td>";
                                                    tablaSe+="<td>"+b[1]+"</td>"; 
                                                    var porcentaje2=(b[1]/b[3])*100;
                                                    var total2=formatNumber(porcentaje2);
                                                    tablaSe+="<td>"+total2+"%</td></tr>";
                                                 
                                                    tablaSe+="<tr><td align='center'>2</td>";
                                                    tablaSe+="<td>I.E Particular</td>";
                                                    tablaSe+="<td>"+b[2]+"</td>"; 
                                                    var porcentaje3=(b[2]/b[3])*100;
                                                    var total3=formatNumber(porcentaje3);
                                                    tablaSe+="<td>"+total3+"%</td></tr></tbody>";
                                                 
                                                    tablaSe+="<tfoot><tr><td colspan='2'>Total</td>";
                                                    tablaSe+="<td>"+b[3]+"</td>";
                                                    tablaSe+="<td>100%</td>";
                                                    tablaSe+="</tr></tfoot></table>";
                                           $('#TtipoColegio').html(tablaSe);
                                           var legend;
                                            var chartData = [{
                                                country: "I.E Parroquial",
                                                value: b[0]
                                            }, {
                                                country: "I.E Nacional",
                                                value: b[1]
                                            }, {
                                                country: "I.E Particular",
                                                value: b[2]
                                            }];
                                // PIE CHART
                                chart = new AmCharts.AmPieChart();
                                chart.addTitle("El alumno proviene de",16);
                                
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
                                    "#E3E63D","#B72222", "#0D8ECF", 
                                    "#FF0F00","#8A0CCF", "#CD0D74", 
                                    "#754DEB", "#DDDDDD", "#999999", "#333333", 
                                    "#000000", "#57032A", "#CA9726", "#990000", "#4B0C25"];
                                // WRITE
                                var legend = new AmCharts.AmLegend();
                                legend.position = "right";
                                chart.addLegend(legend);
                                chart.write("tipoColegio");
                                }
                        });
                        carreraTecnica(periodo,carrera,sede);
                       
        }
       function carreraTecnica(periodo,carrera,sede){
           $('#RcarreraTec').html('');
           $('#TcarreraTec').html('');
            var ciclo =$('#cicloR_id').val();
           if(ciclo == null || ciclo== '0'){
                var datosOb="boton=BuscarCarreraTecnica&periodo="+periodo+"&carrera="+carrera+"&sede="+sede+"&ciclo=0&campo=carrera_tecnica";
           }
           if(ciclo != null ){
               
               var datosOb="boton=BuscarCarreraTecnica&periodo="+periodo+"&carrera="+carrera+"&sede="+sede+"&ciclo="+ciclo+"&campo=carrera_tecnica";
           }
        $.ajax({
                                type: "POST",
                                url: "cEducacion.php",
                                data: datosOb,
                            success: function(html)
                                        {
                                            //0= SI 1 =No         //2 =total            3 sede           4 periodo            5    carrera               6  facultad                    
                                            var b=html.split('*');
                                           
                                                if(ciclo == null){
                                                      $('#cicloF').html('CONSOLIDADO');

                                                }else{
                                                     traerCiclo($('#cicloR_id').val());
                                                     traerTablaAlumnosSE(periodo,carrera,ciclo,'carrera_tecnica',sede);
                                                }
                                            tablaSe="<table class='table_detalle table-bordered' style='text-align:center;width:40%;margin:auto;position:relative; top: -50px;'>";
                                                    tablaSe+="<thead><th>#</th><th>Carrera Técnica</th><th>Frecuencia</th><th>%</th></thead><tbody>";
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
                                           $('#TcarreraTec').html(tablaSe);
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
                                chart.addTitle("Carrera Tecnica:",16);
                                
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
                                    "#E3E63D","#4476AA", "#0D8ECF", 
                                    "#FF0F00","#8A0CCF", "#CD0D74", 
                                    "#754DEB", "#DDDDDD", "#999999", "#333333", 
                                    "#000000", "#57032A", "#CA9726", "#990000", "#4B0C25"];
                                // WRITE
                                var legend = new AmCharts.AmLegend();
                                legend.position = "right";
                                chart.addLegend(legend);
                                chart.write("RcarreraTec");
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
        url: "cEducacion.php",
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
        url: "cEducacion.php",
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