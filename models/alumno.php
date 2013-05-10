<?php
	require_once("models/config.php");
	class alumno
	{
		private $tabla="alumnos";
		private $id;
                private $codigo;
                private $DNI;
                private $carrera_id;
		private $nombres;
		private $apellidos;
                private $email;
            
		
		function __construct($id,$codigo,$dni,$carrera_id,$nombres,$apellidos,$email)
		{
			$this->id=$id;
                        $this->codigo=$codigo;
			$this->DNI=$dni;
                        $this->carrera_id=$carrera_id;
			$this->nombres=$nombres;
			$this->apellidos=$apellidos;
                        $this->email=$email;
                       
			
		}
		
		function guardar()
		{
			$datos="0*$this->codigo*$this->DNI*$this->carrera_id*$this->nombres*$this->apellidos*$this->email";
			$config=new config($this->tabla,$datos,"","","","","","","","","","");
			$config->enlazar();
			$id=$config->conn->guardar();
			return $id;
		}
		
		function actualizar()
		{
			$datos="0*$this->codigo*$this->DNI*$this->carrera_id*$this->nombres*$this->apellidos*$this->email";
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
		
		function listar($camposMostrar,$campo,$operador,$valor,$separador,$inicio,$fin)
		{
			$tablas="carreras*matriculas*sedes*".$this->tabla;
			$config=new config($tablas,$this->id,$camposMostrar,$campo,$operador,$valor,$separador,'','',"c*m*s*a",$inicio,$fin);
                        
			$config->enlazar();
			$a=$config->conn->crearConsultaMultiple();
			return $a;
		}
                
        function listarDetalle($camposMostrar,$campo,$operador,$valor,$separador,$inicio,$fin)
		{
			$tablas="datogenerales*ciclos*carreras*matriculas*sedes*".$this->tabla;
			$config=new config($tablas,$this->id,$camposMostrar,$campo,$operador,$valor,$separador,'','',"d*cic*c*m*s*a",$inicio,$fin);
                        
			$config->enlazar();
			$a=$config->conn->crearConsultaMultiple();
			return $a;
		}
		
        function listarFichas($camposMostrar,$campo,$operador,$valor,$separador,$inicio,$fin)
		{
			$tablas="anioacademicos*matriculas*".$this->tabla;
			$config=new config($tablas,$this->id,$camposMostrar,$campo,$operador,$valor,$separador,'','',"an*m*a",$inicio,$fin);
			$config->enlazar();
			$a=$config->conn->crearConsultaMultiple();
			return $a;
		}
	}
?>