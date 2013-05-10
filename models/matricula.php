<?php
	require_once("models/config.php");
	class matricula
	{
		private $tabla="matriculas";
		private $id;
                private $_alumno_id;
                private $_carrera_id;
                private $_modalidadEstudio;
		private $_sede_id;
		private $_ciclo_id;
                private $_annio_id;
             
		
		function __construct($id,$alumno_id,$carrera_id,$modalidadEstudio,$sede_id,$ciclo_id,$annio_id)
		{
			$this->id=$id;
                        $this->_alumno_id=$alumno_id;
			$this->_carrera_id=$carrera_id;
                        $this->_modalidadEstudio=$modalidadEstudio;
			$this->_sede_id=$sede_id;
			$this->_ciclo_id=$ciclo_id;
                        $this->_annio_id=$annio_id;
			
		}
		
		function guardar()
		{
			$datos="0*$this->_alumno_id*$this->_carrera_id*$this->_modalidadEstudio*$this->_sede_id*$this->_ciclo_id*$this->_annio_id";
			$config=new config($this->tabla,$datos,"","","","","","","","","","");
			$config->enlazar();
			$id=$config->conn->guardar();
			return $id;
		}
		
		function actualizar()
		{
			$datos="0*$this->_alumno_id*$this->_carrera_id*$this->_modalidadEstudio*$this->_sede_id*$this->_ciclo_id*$this->_annio_id";
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
		//	$a=$config->conn->crearConsultaSeleccionEncuestas();
                        $a=$config->conn->crearConsultaSeleccion();
			return $a;
		}
		
		function listarSesion($camposMostrar,$campo,$operador,$valor,$separador,$inicio,$fin)
		{
			$tablas="ciclos*carreras*facultad*".$this->tabla;
			$config=new config($tablas,$this->id,$camposMostrar,$campo,$operador,$valor,$separador,"id","ASC","ci*ca*fa*ma",$inicio,$fin);
			$config->enlazar();
			$a=$config->conn->crearConsultaMultiple();
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