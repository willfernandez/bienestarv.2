<?php
	require_once("models/config.php");
	class annio
	{
		private $tabla="anioacademicos";
		private $id;
		private $nombre;
                private $fechaI;
                private $fechaF;
                private $activo;
		
		
		function __construct($id,$nombre,$fechaI,$fechaF,$activo)
		{
			$this->id=$id;
			$this->nombre=$nombre;
                        $this->fechaI=$fechaI;
                        $this->fechaF=$fechaF;
                        $this->activo=$activo;
		}
		
		function guardar()
		{
			$datos="0*$this->nombre* $this->fechaI*$this->fechaF*$this->activo";
			$config=new config($this->tabla,$datos,"","","","","","","","","","","","");
			$config->enlazar();
			$id=$config->conn->guardar();
			return $id;
		}
		
		function actualizar()
		{
			$datos="$this->id*$this->nombre* $this->fechaI*$this->fechaF*$this->activo";
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