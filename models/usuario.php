<?php
	require_once("models/config.php");
	class usuario
	{
		private $tabla="usuarios";
		private $id;
                private $email;
                private $password;
		private $nombres;
		private $apellidos;
                private $dni;
            
		
		function __construct($id,$email,$password,$nombres,$apellidos,$dni)
		{
			$this->id=$id;
                        $this->email=$email;
			$this->password=$password;
                        $this->dni=$dni;
			$this->nombres=$nombres;
			$this->apellidos=$apellidos;
                       
			
		}
		
		function guardar()
		{
			$datos="0*$this->email*$this->password*$this->nombres*$this->apellidos*$this->dni";
			$config=new config($this->tabla,$datos,"","","","","","","","","","");
			$config->enlazar();
			$id=$config->conn->guardar();
			return $id;
		}
		
		function actualizar()
		{
			$datos="0*$this->email*$this->password*$this->nombres*$this->apellidos*$this->dni";
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
		
		
	}
?>