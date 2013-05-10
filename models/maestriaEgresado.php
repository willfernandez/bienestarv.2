<?php
	require_once("models/config.php");
	class Egre
	{
		private $tabla="maestriaegresado";
		private $id;
		private $codigo;
                private $apellidos;
                private $nombres;
                private $maestria;
                private $mencion;
                private $añoEgreso;
                private $ofEnlace;
	
		function __construct($id,$codigo,$apellidos,$nombres,$maestria,$mencion,$añoEgreso,$ofEnlace)
		{
			$this->id=$id;
                        $this->codigo=$codigo;
                        $this->apellidos=$apellidos;
                        $this->nombres=$nombres;
                        $this->maestria=$maestria;
                        $this->mencion=$mencion;
                        $this->añoEgreso=$añoEgreso;
                        $this->ofEnlace=$ofEnlace;
                          
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
			$config=new config($this->tabla,$this->codigo,$camposMostrar,$campo,$operador,$valor,$separador,"codigo","ASC","",$inicio,$fin);
			$config->enlazar();
			$a=$config->conn->crearConsultaSeleccion();
			return $a;
		}
		
		function listar($camposMostrar,$campo,$operador,$valor,$separador,$inicio,$fin)
		{
                    // WHERE e.`apellidos`='' AND e.`mencion`=''
			$tablas="menciones*".$this->tabla;
			$campos="en.mencion*en.apellidos*en.mencion".$campo;
			$operadores="=*=*=".$operador;
			$valores="me.id*".$valor;
			$config=new config($tablas,$this->id,"en.codigo*en.apellidos*en.nombres*en.maestria*me.nombre*en.anoEgreso*en.ofEnlace",$campos,$operadores,$valores,"AND*AND","","","me*en",$inicio,$fin);
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