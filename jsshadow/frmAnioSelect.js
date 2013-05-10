 $("a").click(function()
  {
  		var aa=$(this)[0].id;
		var a=aa.split('*');
		var accion=a[0];
		if(accion == 'editAnios'){
			$('#idAnnio').html(a[1]);
			var nombre ='<label>Nombre de Año</label><div class="xinput"><input id="nAnnio" name="nAnnio" type="text" value="'+a[2]+'" /></div>';
            $('#nomAnnio').html(nombre);

            var fechaI ='<label>Fecha Inicio</label><div class="xinput"><input type="text" name="fecI" id="fecI" value="'+a[3]+'"/></div>';
            $('#fechaI').html(fechaI);

            var fechaF ='<label>Fecha Fin</label><div class="xinput"><input type="text" name="fecF" id="fecF" value="'+a[4]+'"/></div>';
            $('#fechaF').html(fechaF);

            $('#estadoA').val(a[5]);
		}
  });