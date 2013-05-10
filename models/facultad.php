<?php
	require_once("models/config.php");
	class facultad
	{
		private $tabla="facultad";
		private $id;
		private $siglas;
		private $nombre;
		
		
		function __construct($id,$siglas,$nombre)
		{
			$this->id=$id;
			$this->siglas=$siglas;
			$this->nombre=$nombre;
		}
		
		function guardar()
		{
			$datos="0*$this->siglas*$this->nombre";
			$config=new config($this->tabla,$datos,"","","","","","","","","","","","");
			$config->enlazar();
			$id=$config->conn->guardar();
			return $id;
		}
		
		function actualizar()
		{
			$datos="$this->id*$this->siglas*$this->nombre";
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
		function listar($campo,$operador,$valor,$separador,$inicio,$fin)
		{
			$config=new config($this->tabla,$this->id,"",$campo,$operador,$valor,$separador,"","","","","");
			$config->enlazar();
			$a=$config->conn->crearConsultaSeleccion();
			return $a;
		}
	}
?>