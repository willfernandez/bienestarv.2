<?php
	require_once("models/config.php");
	class deudas
	{
		private $tabla="deudas";
		private $id;
		private $alumno_id;
		private $deudaP;
		private $cuantoEco;
      		private $desdeEco;
		private $tipoDeuda;
                private $año;
		
		function __construct($id,$alumno_id,$deudaP,$cuantoEco,$desdeEco,$tipoDeuda,$año)
		{
			$this->id=$id;
			$this->alumno_id=$alumno_id;
			$this->deudaP=$deudaP;
			$this->cuantoEco=$cuantoEco;
			$this->desdeEco=$desdeEco;
			$this->tipoDeuda=$tipoDeuda;
                        $this->año=$año;
		}
		
		function guardar()
		{
			$datos="0*$this->alumno_id*$this->deudaP*$this->cuantoEco*$this->desdeEco*$this->tipoDeuda*$this->año";
			$config=new config($this->tabla,$datos,"","","","","","","","","","");
			$config->enlazar();
			$id=$config->conn->guardar();
			return $id;
		}
		
		function actualizar()
		{
			$datos="$this->id*$this->alumno_id*$this->deudaP*$this->cuantoEco*$this->desdeEco*$this->tipoDeuda*$this->año";
			$config=new config($this->tabla,$datos,"","","","","","","","","","");
			$config->enlazar();
			$config->conn->actualizar();
		}
		function actualizarEstado()
		{
			$sql="UPDATE bandeja SET estadoBandeja_id=$this->estadoBandeja_id,fechaatencion='$this->fechaatencion',horaatencion='$this->horaatencion',observacion='$this->observacion' WHERE id=$this->id";
			$config=new config($this->tabla,$datos,"","","","","","","","","","");
			$config->enlazar();
			$config->conn->ejecutarconsulta($sql);
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
		
		 function listarTotal($camposMostrar,$campo,$operador,$valor,$separador,$inicio,$fin)
		{
			$tablas="alumnos*carreras*deudas*matriculas";
			$config=new config($tablas,$this->id,$camposMostrar,$campo,$operador,$valor,$separador,"","","a*ca*d*m",$inicio,$fin);
			$config->enlazar();
			$a=$config->conn->crearConsultaMultiple();
			return $a;
		}
                
                function listarPeriodo($camposMostrar,$campo,$operador,$valor,$separador,$inicio,$fin)
		{
			$tablas="deudas*matriculas*sedes*anioacademicos*carreras*alumnos*facultad";
			$config=new config($tablas,$this->id,$camposMostrar,$campo,$operador,$valor,$separador,"","","f*m*s*a*ca*al*fac",$inicio,$fin);
			$config->enlazar();
			$a=$config->conn->crearConsultaMultiple();
			return $a;
		}
		function listarSeguimiento($camposMostrar,$campo,$operador,$valor,$separador,$inicio,$fin)
		{
			$tablas="estadoBandeja*bandeja*tramite*oficina";
			$config=new config($tablas,$this->id,$camposMostrar,$campo,$operador,$valor,$separador,"b.fechallegada*b.horallegada","ASC","eb*b*t*o",$inicio,$fin);
			$config->enlazar();
			$a=$config->conn->crearConsultaMultiple();
			return $a;
		}
		function obtenerRecorridos($tramite_id)
		{
			$sql="SELECT count(tramite_id) FROM bandeja WHERE tramite_id=$tramite_id";
			$config=new config($tablas,$this->id,$camposMostrar,$campo,$operador,$valor,$separador,"","","",$inicio,$fin);
			$config->enlazar();
			$a=$config->conn->ejecutarConsulta($sql);
			return $a[0][0];
		}
		function obtenerTipoDocumento($tramite_id)
		{
			$sql="SELECT documento_id FROM tramite WHERE id=$tramite_id";
			$config=new config($tablas,$this->id,$camposMostrar,$campo,$operador,$valor,$separador,"","","",$inicio,$fin);
			$config->enlazar();
			$a=$config->conn->ejecutarConsulta($sql);
			return $a[0][0];
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