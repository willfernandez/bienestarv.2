function imprimirComprobante(){
	var codigo = $("#codigoAl").html();
	var nombre = $("#nomAl").html();
	var apellido = $("#apeAl").html();
	var datos = "codigo="+codigo+"&nombre="+nombre+"&apellido="+apellido+"&boton=imprimir";
	window.open("prueba.php?codigo="+codigo+"&nombre="+nombre+"&apellido="+apellido, '_blank');
}