<?php
	require_once("models/config.php");
	class carrera
	{
		private $tabla="carreras";
		private $id;
		private $facultad_id;
		private $nombre;
		
		
		function __construct($id,$nombre,$facultad_id)
		{
			$this->id=$id;
			$this->facultad_id=$facultad_id;
			$this->nombre=$nombre;
		}
		
		function guardar()
		{
			$datos="0*$this->nombre*$this->facultad_id";
			$config=new config($this->tabla,$datos,"","","","","","","","","","","","");
			$config->enlazar();
			$id=$config->conn->guardar();
			return $id;
		}
		
		function actualizar()
		{
			$datos="$this->id*$this->nombre*$this->facultad_id";
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
			$tablas="carreras*facultad";
			$config=new config($tablas,$this->id,$camposMostrar,$campo,$operador,$valor,$separador,"c.id","ASC","c*f",$inicio,$fin);
			$config->enlazar();
			$a=$config->conn->crearConsultaMultiple();
			return $a;
		}
	}
?>