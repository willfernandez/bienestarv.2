$(document).ready(function()
{
    cargarFacultades();
     cargarAnnions();
    cargarSede();
 });
function cargarFacultades(){
    
    $.ajax({
        type:"POST",
        url: "cbxFacultadTab.php",
          data:"boton=Salud",
       success: function(html){
           $('#facultad').html(html);
       }
    })
}
function cargarAnnions(){

    $.ajax({
        type:"POST",
        url: "cbxSede.php",
       success: function(html){
           $('#sede').html(html);
           
       }
    })
}
function cargarSede(){

    $.ajax({
        type:"POST",
        url: "cbxAnnioR.php",
       success: function(html){
           $('#periodo').html(html);
           
       }
    })
}
function filtrarCarrerasSalud(){
   var facultadAl_id=$('#facultadAl_id').val();
   if(facultadAl_id=='')
  {
    alert("falta seleccionar la facultad")
    document.getElementById('facultadAl_id').className = 'required="1"';
    return false;
  }
   var periodo=$('#annio_id').val();
   if(periodo=='')
  {
    alert("falta seleccionar el periodo")
    document.getElementById('annio_id').className = 'required="1"';
    return false;
  }
   var sede = $("#sede_id").val();

    var datos="sede="+sede+"&facultadAl_id="+facultadAl_id+"&periodo="+periodo+"&boton=filtrarCarrerasSalud";
    $.ajax({
        type:"POST",
        url: "cCarreras.php",
        data: datos,
       success: function(html){
         //  alert(html)
           $('#tablaCarreras').html(html);
            $('#documentoEd').dataTable( {
					"sPaginationType": "bootstrap",
					"sDom": "<'row'<'span5'l><'span6'f>r>t<'row'<'span8'i><'span9'p>>"
            } );
       }
    });
   
}
function cargarCarrerass(){
    var facultadAl_id=$('#facultadAl_id').val();
    alert(facultadAl_id)
    if(facultadAl_id==''){
        
    }else{
    
    var datos="facultadAl_id="+facultadAl_id;
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
function reporte(){
    var sede= $('#sede').val();
    var periodo= $('#periodo').val();
    if( sede =='consolidado' && periodo!='consolidado'){
        
        /// SITUACION ACTUAL DE LOS PADRES 
                var datosSP="boton=BuscarPeriodo&periodo="+periodo;
                $.ajax({
                                type: "POST",
                                url: "cFamiliares.php",
                                data: datosSP,
                            success: function(html)
                                        {
                                            var a=html.split('*');
                                            $('#prueba').html('');
                                            $('#tabla').html('');
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
        //// FIN
        
        //// SITUACION ACTUL DEL ESTUDIANTE
         var datosSE="boton=BuscarPeriodoSE&periodo="+periodo;
        $.ajax({
                                type: "POST",
                                url: "cFamiliares.php",
                                data: datosSE,
                            success: function(html)
                                        {
                                            var b=html.split('*');
                                            tablaSe="<table class='table_detalle table-bordered' style='text-align:center;width:40%;margin:auto;position:relative; top: -50px;'>";
                                                    tablaSe+="<thead><th>#</th><th>Situación de los Padres</th><th>Frecuencia</th><th>%</th></thead><tbody>";
                                                    tablaSe+="<tr><td align='center'>1</td>";
                                                    tablaSe+="<td>Casados</td>";
                                                    tablaSe+="<td>"+b[0]+"</td>";
                                                    var porcentaje=(b[0]/b[4])*100;
                                                    var total1=formatNumber(porcentaje);
                                                    tablaSe+="<td>"+total1+"%</td></tr>";

                                                    tablaSe+="<tr><td align='center'>2</td>";
                                                    tablaSe+="<td>Convivientes</td>";
                                                    tablaSe+="<td>"+b[1]+"</td>"; 
                                                    var porcentaje2=(b[1]/b[4])*100;
                                                    var total2=formatNumber(porcentaje2);
                                                    tablaSe+="<td>"+total2+"%</td></tr>";

                                                    tablaSe+="<tr><td align='center'>3</td>";
                                                    tablaSe+="<td>Divorciados</td>";
                                                    tablaSe+="<td>"+b[2]+"</td>"; 
                                                    var porcentaje3=(b[2]/b[4])*100;
                                                    var total3=formatNumber(porcentaje3);
                                                    tablaSe+="<td>"+total3+"%</td></tr>";

                                                    tablaSe+="<tr><td align='center'>4</td>";
                                                    tablaSe+="<td>Separados</td>";
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
    
    if( sede !='consolidado' && periodo!='consolidado'){
    var datos="boton=BuscarSedePeriodo&sede="+sede+"&periodo="+periodo;
 $.ajax({
   	        type: "POST",
        	url: "cFamiliares.php",
		data: datos,
    	    success: function(html)
			{
                             var a=html.split('*');
                            $('#prueba').html('');
                            $('#tabla').html('');
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
                   // WRITE
                            
                            var legend = new AmCharts.AmLegend();
                        legend.position = "right";
                        chart.addLegend(legend);
                            chart.write("prueba");
                          
                }
	});          
    }
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
