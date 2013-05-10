<?php
	require_once("models/config.php");
	class pregradoEgresado
	{
		private $tabla="vegresado";
		private $id;
		private $CODALU;
                private $YYEGRE;
                private $NombAlu;
                private $ApeAlu;
                private $LUGPRA;
                private $NOMESC;
	
		function __construct($id,$codigo,$año,$nombre,$apellido,$lugar,$escuela)
		{
			$this->id=$id;
			$this->CODALU=$codigo;
                        $this->YYEGRE=$año;
                        $this->NombAlu=$nombre;
                        $this->ApeAlu=$apellido;
                        $this->LUGPRA=$lugar;
                        $this->NOMESC=$escuela;
                          
		}
		
		function guardar()
		{
			$datos="0*$this->usuario_id";
			$config=new config($this->tabla,$datos,"","","","","","","","","","");
			$config->enlazar();
			$id=$config->conn->guardar();
			return $id;
		}
		
		function actualizar()
		{
			$datos="$this->id*$this->usuario_id";
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
		
		function obtenerTotalRegistros()
		{
			$config=new config($this->tabla,"","","","","","","","","","","");
			$config->enlazar();
			$a=$config->conn->totalRegistros();
			return $a;
		}
	}
?>