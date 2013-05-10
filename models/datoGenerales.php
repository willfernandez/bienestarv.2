<?php
	require_once("models/config.php");
	class datoGenerales
	{
		private $tabla="datogenerales";
		private $id;
		private $alumno_id;
		private $departamento_id;
		private $provincia_id;
      		private $direccion;
		private $celular;
                private $fecha_nacimiento;
                private $año;
		
		function __construct($id,$alumno_id,$departamento_id,$provincia_id,$direccion,$celular,$fecha_nacimiento,$año)
		{
			$this->id=$id;
			$this->alumno_id=$alumno_id;
			$this->departamento_id=$departamento_id;
			$this->provincia_id=$provincia_id;
			$this->direccion=$direccion;
			$this->celular=$celular;
                        $this->fecha_nacimiento=$fecha_nacimiento;
                        $this->año=$año;
		}
		
		function guardar()
		{
			$datos="0*$this->alumno_id*$this->departamento_id*$this->provincia_id*$this->direccion*$this->celular*$this->fecha_nacimiento*$this->año";
			$config=new config($this->tabla,$datos,"","","","","","","","","","");
			$config->enlazar();
			$id=$config->conn->guardar();
			return $id;
		}
		
		function actualizar()
		{
			$datos="$this->id*$this->alumno_id*$this->departamento_id*$this->provincia_id*$this->direccion*$this->celular*$this->fecha_nacimiento*$this->año";
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
		
		function listar($camposMostrar,$campo,$operador,$valor,$separador,$inicio,$fin)
		{
			$tablas="departamentos*".$this->tabla;
			$config=new config($tablas,$this->id,$camposMostrar,$campo,$operador,$valor,$separador,"d.id","ASC","dep*d",$inicio,$fin);
			$config->enlazar();
			$a=$config->conn->crearConsultaMultiple();
			return $a;
		}
	
	}
?>