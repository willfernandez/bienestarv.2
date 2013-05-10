<?php
	require_once("models/config.php");
	class carreraciclos
	{
		private $tabla="carreraciclos";
		private $id;
		private $ciclo_id;
		private $carrera_id;
		
		
		function __construct($id,$ciclo_id,$carrera_id)
		{
			$this->id=$id;
			$this->ciclo_id=$ciclo_id;
			$this->carrera_id=$carrera_id;
		}
		
		function guardar()
		{
			$datos="0*$this->ciclo_id*$this->carrera_id";
			$config=new config($this->tabla,$datos,"","","","","","","","","","","","");
			$config->enlazar();
			$id=$config->conn->guardar();
			return $id;
		}
		
		function actualizar()
		{
			$datos="$this->id*$this->ciclo_id*$this->carrera_id";
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
                        $tablas="ciclos*carreras*".$this->tabla;
                        $campos="ci.id*caci.carrera_id";
			$operadores="=*=".$operador;
			$valores="caci.ciclo_id*".$valor;
			$config=new config($tablas,$this->id,"DISTINCT(ci.id)*ci.ciclo",$campos,$operadores,$valores,'AND',"","","ci*ca*caci","","");
			$config->enlazar();
			$a=$config->conn->crearConsultaMultiple();
			return $a;
		}
	}
?>