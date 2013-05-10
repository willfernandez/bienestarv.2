<?php
	require_once("models/config.php");
	class orden
	{
		private $tabla="orden";
		private $id;
		private $documento_id;
		private $oficina_id;
		private $orden;
		
		function __construct($id,$documento_id,$oficina_id,$orden)
		{
			$this->id=$id;
			$this->documento_id=$documento_id;
			$this->oficina_id=$oficina_id;
			$this->orden=$orden;
		}
		
		function guardar()
		{
			$datos="0*$this->documento_id*$this->oficina_id*$this->orden";
			$config=new config($this->tabla,$datos,"","","","","","","","","","");
			$config->enlazar();
			$id=$config->conn->guardar();
			return $id;
		}
		
		function actualizar()
		{
			$datos="$this->id*$this->documento_id*$this->oficina_id*$this->orden";
			$config=new config($this->tabla,$datos,"","","","","","","","","","");
			$config->enlazar();
			$config->conn->actualizar();
		}
		
		function eliminar()
		{
			$config=new config($this->tabla,$this->id,"","","","","","","","","","");
			$config->enlazar();
			$config->conn->eliminar();
		}
		
		function listarSimple($camposMostrar,$campo,$operador,$valor,$separador,$inicio,$fin)
		{//Lista por titulo
			$config=new config($this->tabla,$this->id,$camposMostrar,$campo,$operador,$valor,$separador,"id","ASC","",$inicio,$fin);
			$config->enlazar();
			$a=$config->conn->crearConsultaSeleccion();
			return $a;
		}
		
		function listar($camposMostrar,$campo,$operador,$valor,$separador,$inicio,$fin)
		{
			$tablas="proceso*lineaAccion*".$this->tabla;
			$config=new config($tablas,$this->id,$camposMostrar,$campo,$operador,$valor,$separador,"p.id*l.id*a.orden","ASC","p*l*a",$inicio,$fin);
			$config->enlazar();
			$a=$config->conn->crearConsultaMultiple();
			return $a;
		}
		function obtenerOrden($camposMostrar,$campo,$operador,$valor,$separador,$inicio,$fin)
		{
			$config=new config($this->tabla,$this->id,$camposMostrar,$campo,$operador,$valor,$separador,"id","ASC","",$inicio,$fin);
			$config->enlazar();
			$a=$config->conn->crearConsultaSeleccion();
			return $a;
		}
		function obtenerOficinas($documento_id)
		{
			$sql="SELECT oo.nombre FROM oficina as oo, orden as o WHERE oo.id=o.oficina_id AND o.documento_id='$documento_id' ORDER BY o.orden ASC";
			$config=new config($this->tabla,$this->id,$camposMostrar,$campo,$operador,$valor,$separador,"","","",$inicio,$fin);
			$config->enlazar();
			$a=$config->conn->ejecutarConsulta($sql);
			return $a;
		}
		function obtenerTotalRegistros()
		{
			$config=new config($this->tabla,"","","","","","","","","","","");
			$config->enlazar();
			$a=$config->conn->totalRegistros();
			return $a;
		}
	}
?>