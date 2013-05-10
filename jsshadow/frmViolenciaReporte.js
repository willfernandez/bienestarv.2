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
          cargarCarrerasR(facultad,carrera);
          cargarCiclosR(carrera);
          cargarSedesR(sede);
          //cargarFiltradorCarreras()
          ObsViolencia(periodo,carrera,sede);
          
         // SituacionActualEstudiante(periodo,carrera);
        }
});
 
 $("a").click(function()
  {
      //alert('fff')
	var aa=$(this)[0].id;
	var a=aa.split('*');
	var accion=a[0];
	 
        
	if(accion=='reporteV')
	{
            window.open("frmReporteViolencia.php?periodo="+a[1]+"&facultad="+a[2]+"&carrera="+a[3]+"&sede="+a[4], '_blank');
        }
   });
        
        function ObsViolencia(periodo,carrera,sede){
            $('#violenciaSN').html('');
           $('#TviolenciaSN').html('');
           var ciclo =$('#cicloR_id').val();
           if(ciclo == null || ciclo== '0'){
                var datosOb="boton=BuscarPeriodoObsViolencia&periodo="+periodo+"&carrera="+carrera+"&sede="+sede+"&ciclo=0&campo=violencia_familia";
           }
           if(ciclo != null ){
               
               var datosOb="boton=BuscarPeriodoObsViolencia&periodo="+periodo+"&carrera="+carrera+"&sede="+sede+"&ciclo="+ciclo+"&campo=violencia_familia";
           }
        $.ajax({
                                type: "POST",
                                url: "cViolencia.php",
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
                                                     traerTablaAlumnosObs(periodo,carrera,ciclo,'violencia_familia','1',sede);
                                                }
                                            tablaSe="<table class='table_detalle table-bordered' style='text-align:center;width:40%;margin:auto;position:relative; top: -50px;'>";
                                                    tablaSe+="<thead><th>#</th><th>¿Ha observado violencia familiar en su hogar?</th><th>Frecuencia</th><th>%</th></thead><tbody>";
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
                                           $('#TviolenciaSN').html(tablaSe);
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
                                chart.addTitle("¿Ha observado violencia familiar en su hogar?",16);
                                
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
                                chart.write("violenciaSN");
                                }
                        });
                       
                       maltratoFisico(periodo,carrera,sede);
                       maltratoPsicologico(periodo,carrera,sede);
                        BuscarCvCiudad(periodo,carrera,sede);
                        BuscarRlfamiliares(periodo,carrera,sede);
        }
       function maltratoFisico(periodo,carrera,sede){
           $('#maltratoF').html('');
           $('#TmaltratoF').html('');
           var ciclo =$('#cicloR_id').val();
           if(ciclo == null || ciclo== '0'){
                 var datosOb="boton=BuscarPeriodoObsViolencia&periodo="+periodo+"&carrera="+carrera+"&sede="+sede+"&ciclo=0&campo=maltrato_fisico";
           }
           if(ciclo != null ){
               
                var datosOb="boton=BuscarPeriodoObsViolencia&periodo="+periodo+"&carrera="+carrera+"&sede="+sede+"&ciclo="+ciclo+"&campo=maltrato_fisico";
                traerTablaAlumnosObs(periodo,carrera,ciclo,'maltrato_fisico','2',sede);
           }
          
                $.ajax({
                                type: "POST",
                                url: "cViolencia.php",
                                data: datosOb,
                            success: function(html)
                                        {
                                           var b=html.split('*');
                                            $('#sedeF').html(b[3]);
                                                if(ciclo == null){
                                                      $('#cicloF').html('CONSOLIDADO');

                                                }else{
                                                     traerCiclo($('#cicloR_id').val());
                                                }
                                            tablaSe="<table class='table_detalle table-bordered' style='text-align:center;width:40%;margin:auto;position:relative; top: -50px;'>";
                                                    tablaSe+="<thead><th>#</th><th>¿Maltrato Físico?</th><th>Frecuencia</th><th>%</th></thead><tbody>";
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
                                           $('#TmaltratoF').html(tablaSe);
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
                                chart.addTitle("¿Maltrato Físico?",16);
                                
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
                                    "#0eee20","#0D8ECF", "#0D8ECF", 
                                    "#FF0F00","#0eee20", "#CD0D74", 
                                    "#754DEB", "#DDDDDD", "#999999", "#333333", 
                                    "#000000", "#57032A", "#CA9726", "#990000", "#4B0C25"];
                                // WRITE
                                var legend = new AmCharts.AmLegend();
                                legend.position = "right";
                                chart.addLegend(legend);
                                chart.write("maltratoF");
                                }
                        });
                        
                        
       }
       
       function maltratoPsicologico(periodo,carrera,sede){
           $('#maltratoPs').html('');
           $('#TmaltratoPs').html('');
           var ciclo =$('#cicloR_id').val();
           if(ciclo == null || ciclo== '0'){
                 var datosOb="boton=BuscarPeriodoObsViolencia&periodo="+periodo+"&carrera="+carrera+"&sede="+sede+"&ciclo=0&campo=maltrato_psicologico";
           }
           if(ciclo != null ){
               
                var datosOb="boton=BuscarPeriodoObsViolencia&periodo="+periodo+"&carrera="+carrera+"&sede="+sede+"&ciclo="+ciclo+"&campo=maltrato_psicologico";
                 traerTablaAlumnosObs(periodo,carrera,ciclo,'maltrato_psicologico','3',sede);
           }
          
                $.ajax({
                                type: "POST",
                                url: "cViolencia.php",
                                data: datosOb,
                            success: function(html)
                                        {
                                           var b=html.split('*');
                                            $('#sedeF').html(b[3]);
                                                if(ciclo == null){
                                                      $('#cicloF').html('CONSOLIDADO');

                                                }else{
                                                     traerCiclo($('#cicloR_id').val());
                                                }
                                            tablaSe="<table class='table_detalle table-bordered' style='text-align:center;width:40%;margin:auto;position:relative; top: -50px;'>";
                                                    tablaSe+="<thead><th>#</th><th>¿Maltrato Psicológico?</th><th>Frecuencia</th><th>%</th></thead><tbody>";
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
                                           $('#TmaltratoPs').html(tablaSe);
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
                                chart.addTitle("¿Maltrato Psicológico?",16);
                                
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
                                    "#f3f92f","#3A8B53", "#0D8ECF", 
                                    "#FF0F00","#8A0CCF", "#CD0D74", 
                                    "#754DEB", "#DDDDDD", "#999999", "#333333", 
                                    "#000000", "#57032A", "#CA9726", "#990000", "#4B0C25"];
                                // WRITE
                                var legend = new AmCharts.AmLegend();
                                legend.position = "right";
                                chart.addLegend(legend);
                                chart.write("maltratoPs");
                                }
                        });
                        
                        
       }
       
       
       
       function BuscarCvCiudad(periodo,carrera,sede){
           $('#CvCiudad').html('');
           $('#TcvCiudad').html('');
           var ciclo =$('#cicloR_id').val();
           if(ciclo == null || ciclo== '0'){
                 var datosOb="boton=BuscarCvCiudad&periodo="+periodo+"&carrera="+carrera+"&sede="+sede+"&ciclo=0&campo=maltrato_psicologico";
           }
           if(ciclo != null ){
               
                var datosOb="boton=BuscarCvCiudad&periodo="+periodo+"&carrera="+carrera+"&sede="+sede+"&ciclo="+ciclo+"&campo=maltrato_psicologico";
                traerTablaAlumnosObs(periodo,carrera,ciclo,'familia_actual','4',sede);
           }
                //6=total            7 sede           8 periodo            9    carrera               10 facultad                    
                $.ajax({
                                type: "POST",
                                url: "cViolencia.php",
                                data: datosOb,
                            success: function(html)
                                        {
                                           var b=html.split('*');
                                            $('#sedeF').html(b[7]);
                                                if(ciclo == null){
                                                      $('#cicloF').html('CONSOLIDADO');

                                                }else{
                                                     traerCiclo($('#cicloR_id').val());
                                                }
                                            tablaSe="<table class='table_detalle table-bordered' style='text-align:center;width:40%;margin:auto;position:relative; top: -50px;'>";
                                                    tablaSe+="<thead><th>#</th><th>¿Con quién vive en esta ciuda?</th><th>Frecuencia</th><th>%</th></thead><tbody>";
                                                    tablaSe+="<tr><td align='center'>1</td>";
                                                    tablaSe+="<td>Ambos Padres</td>";
                                                    tablaSe+="<td>"+b[0]+"</td>";
                                                    var porcentaje=(b[0]/b[6])*100;
                                                    var total1=formatNumber(porcentaje);
                                                    tablaSe+="<td>"+total1+"%</td></tr>";

                                                    tablaSe+="<tr><td align='center'>2</td>";
                                                    tablaSe+="<td>Sólo con madre</td>";
                                                    tablaSe+="<td>"+b[1]+"</td>"; 
                                                    var porcentaje2=(b[1]/b[6])*100;
                                                    var total2=formatNumber(porcentaje2);
                                                    tablaSe+="<td>"+total2+"%</td></tr></tbody>";
                                                    
                                                    tablaSe+="<tr><td align='center'>2</td>";
                                                    tablaSe+="<td>Sólo</td>";
                                                    tablaSe+="<td>"+b[2]+"</td>"; 
                                                    var porcentaje3=(b[2]/b[6])*100;
                                                    var total3=formatNumber(porcentaje3);
                                                    tablaSe+="<td>"+total3+"%</td></tr></tbody>";
                                                    
                                                    tablaSe+="<tr><td align='center'>2</td>";
                                                    tablaSe+="<td>Sólo con padre</td>";
                                                    tablaSe+="<td>"+b[3]+"</td>"; 
                                                    var porcentaje4=(b[3]/b[6])*100;
                                                    var total4=formatNumber(porcentaje4);
                                                    tablaSe+="<td>"+total4+"%</td></tr></tbody>";
                                                    
                                                    tablaSe+="<tr><td align='center'>2</td>";
                                                    tablaSe+="<td>Familiares</td>";
                                                    tablaSe+="<td>"+b[4]+"</td>"; 
                                                    var porcentaje5=(b[4]/b[6])*100;
                                                    var total5=formatNumber(porcentaje5);
                                                    tablaSe+="<td>"+total5+"%</td></tr></tbody>";
                                                    
                                                    tablaSe+="<tr><td align='center'>2</td>";
                                                    tablaSe+="<td>Cónyuge</td>";
                                                    tablaSe+="<td>"+b[5]+"</td>"; 
                                                    var porcentaje6=(b[5]/b[6])*100;
                                                    var total6=formatNumber(porcentaje6);
                                                    tablaSe+="<td>"+total6+"%</td></tr></tbody>";
                                                 

                                                    tablaSe+="<tfoot><tr><td colspan='2'>Total</td>";
                                                    tablaSe+="<td>"+b[6]+"</td>";
                                                    tablaSe+="<td>100%</td>";
                                                    tablaSe+="</tr></tfoot></table>";
                                           $('#TcvCiudad').html(tablaSe);
                                           var legend;
                                            var chartData = [{
                                                country: "Ambos Padres",
                                                value: b[0]
                                            }, {
                                                country: "Sólo con madre",
                                                value: b[1]
                                            }, {
                                                country: "Solo",
                                                value: b[2]
                                            }, {
                                                country: "Sólo con padre",
                                                value: b[3]
                                            }, {
                                                country: "Familiares",
                                                value: b[4]
                                            }, {
                                                country: "Cónyuge",
                                                value: b[5]
                                            }];
                                // PIE CHART
                                chart = new AmCharts.AmPieChart();
                                chart.addTitle("¿Con quién vive en esta ciuda?",16);
                                
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
                                chart.write("CvCiudad");
                                }
                        });
                        
                        
       }
       
       
       function BuscarRlfamiliares(periodo,carrera,sede){
           $('#vilFamiliar').html('');
           $('#TvilFamiliar').html('');
           var ciclo =$('#cicloR_id').val();
           if(ciclo == null || ciclo== '0'){
                 var datosOb="boton=BuscarRlfamiliares&periodo="+periodo+"&carrera="+carrera+"&sede="+sede+"&ciclo=0&campo=maltrato_psicologico";
           }
           if(ciclo != null ){
               
                var datosOb="boton=BuscarRlfamiliares&periodo="+periodo+"&carrera="+carrera+"&sede="+sede+"&ciclo="+ciclo+"&campo=maltrato_psicologico";
                traerTablaAlumnosObs(periodo,carrera,ciclo,'famila_relacion','5',sede);
           }
  
                $.ajax({
                                type: "POST",
                                url: "cViolencia.php",
                                data: datosOb,
                            success: function(html)
                                        {
                                            //5=total            6 sede          7 periodo            8    carrera               9 facultad                    
                                           var b=html.split('*');
                                            $('#sedeF').html(b[6]);
                                                if(ciclo == null){
                                                      $('#cicloF').html('CONSOLIDADO');

                                                }else{
                                                     traerCiclo($('#cicloR_id').val());
                                                }
                                            tablaSe="<table class='table_detalle table-bordered' style='text-align:center;width:40%;margin:auto;position:relative; top: -50px;'>";
                                                    tablaSe+="<thead><th>#</th><th>Mis relaciones familiares son:</th><th>Frecuencia</th><th>%</th></thead><tbody>";
                                                    tablaSe+="<tr><td align='center'>1</td>";
                                                    tablaSe+="<td>Excelentes</td>";
                                                    tablaSe+="<td>"+b[0]+"</td>";
                                                    var porcentaje=(b[0]/b[5])*100;
                                                    var total1=formatNumber(porcentaje);
                                                    tablaSe+="<td>"+total1+"%</td></tr>";

                                                    tablaSe+="<tr><td align='center'>2</td>";
                                                    tablaSe+="<td>Buenas</td>";
                                                    tablaSe+="<td>"+b[1]+"</td>"; 
                                                    var porcentaje2=(b[1]/b[5])*100;
                                                    var total2=formatNumber(porcentaje2);
                                                    tablaSe+="<td>"+total2+"%</td></tr></tbody>";
                                                    
                                                    tablaSe+="<tr><td align='center'>2</td>";
                                                    tablaSe+="<td>Regulares</td>";
                                                    tablaSe+="<td>"+b[2]+"</td>"; 
                                                    var porcentaje3=(b[2]/b[5])*100;
                                                    var total3=formatNumber(porcentaje3);
                                                    tablaSe+="<td>"+total3+"%</td></tr></tbody>";
                                                    
                                                    tablaSe+="<tr><td align='center'>2</td>";
                                                    tablaSe+="<td>Malas</td>";
                                                    tablaSe+="<td>"+b[3]+"</td>"; 
                                                    var porcentaje4=(b[3]/b[5])*100;
                                                    var total4=formatNumber(porcentaje4);
                                                    tablaSe+="<td>"+total4+"%</td></tr></tbody>";
                                                    
                                                    tablaSe+="<tr><td align='center'>2</td>";
                                                    tablaSe+="<td>Muy malas</td>";
                                                    tablaSe+="<td>"+b[4]+"</td>"; 
                                                    var porcentaje5=(b[4]/b[5])*100;
                                                    var total5=formatNumber(porcentaje5);
                                                    tablaSe+="<td>"+total5+"%</td></tr></tbody>";
                                                    
                                                    tablaSe+="<tfoot><tr><td colspan='2'>Total</td>";
                                                    tablaSe+="<td>"+b[5]+"</td>";
                                                    tablaSe+="<td>100%</td>";
                                                    tablaSe+="</tr></tfoot></table>";
                                           $('#TvilFamiliar').html(tablaSe);
                                           var legend;
                                            var chartData = [{
                                                country: "Excelentes",
                                                value: b[0]
                                            }, {
                                                country: "Buenas",
                                                value: b[1]
                                            }, {
                                                country: "Regulares",
                                                value: b[2]
                                            }, {
                                                country: "Malas",
                                                value: b[3]
                                            }, {
                                                country: "Muy malas",
                                                value: b[4]
                                            }];
                                // PIE CHART
                                chart = new AmCharts.AmPieChart();
                                chart.addTitle("Mis relaciones familiares son:",16);
                                
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
                                    "#f3f92f","#850016", "#0D8ECF", 
                                    "#959A1E","#8A0CCF", "#CD0D74", 
                                    "#754DEB", "#DDDDDD", "#999999", "#333333", 
                                    "#000000", "#57032A", "#CA9726", "#990000", "#4B0C25"];
                                // WRITE
                                var legend = new AmCharts.AmLegend();
                                legend.position = "right";
                                chart.addLegend(legend);
                                chart.write("vilFamiliar");
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
           $('#sede').html(html);
           
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

function traerTablaAlumnosObs(periodo,carrera,ciclo,campo,numReporte,sede){
   
 var datosSP="boton=BuscarPeriodoObsViolenciaAlumnado&periodo="+periodo+"&carrera="+carrera+"&sede="+sede+"&ciclo="+ciclo+"&campo="+campo;
    $.ajax({
        type: "POST",
        url: "cViolencia.php",
        data: datosSP,
       success: function(html){
         switch(numReporte)
	{	case '1':
                     $('#resumenAlumnos').html(html);
                     $('#tabAlumnado').dataTable( {
					"sPaginationType": "bootstrap",
					"sDom": "<'row'<'span5'l><'span6'f>r>t<'row'<'span8'i><'span9'p>>"
				} );
                                
                   break;
                   
                   case '2':
                     $('#resumenAlumnos2').html(html);
                     $('#tabAlumnado2').dataTable( {
					"sPaginationType": "bootstrap",
					"sDom": "<'row'<'span5'l><'span6'f>r>t<'row'<'span8'i><'span9'p>>"
				} );
                                
                   break;
                   
                   case '3':
                     $('#resumenAlumnos3').html(html);
                     $('#tabAlumnado3').dataTable( {
					"sPaginationType": "bootstrap",
					"sDom": "<'row'<'span5'l><'span6'f>r>t<'row'<'span8'i><'span9'p>>"
				} );
                                
                   break;
                   
                   case '4':
                     $('#resumenAlumnos4').html(html);
                     $('#tabAlumnado4').dataTable( {
					"sPaginationType": "bootstrap",
					"sDom": "<'row'<'span5'l><'span6'f>r>t<'row'<'span8'i><'span9'p>>"
				} );
                                
                   break;
                   
                    case '5':
                     $('#resumenAlumnos5').html(html);
                     $('#tabAlumnado5').dataTable( {
					"sPaginationType": "bootstrap",
					"sDom": "<'row'<'span5'l><'span6'f>r>t<'row'<'span8'i><'span9'p>>"
				} );
                                
                   break;
        }
       }
    });
}
