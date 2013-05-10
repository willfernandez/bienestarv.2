<?php
class config
{
	private $sgbd;	
	
	private $tabla; //La tabla 
	private $datos; //Los datos
	//Para el método buscar
	private $camposMostrar; //Los campos a mostrar en el resultado
	private $filtroCampo; //Los campos para filtrar
	private $filtroOperador; //Los operadores de los filtros
	private $filtroValor; //Los valores de los filtros
	private $filtroSeparador; //los AND u OR
	private $camposOrdenar; //Los campos por los que se ordenara
	private $tipoOrdenar; //El tipo de ordenamiento
	
	private $alias; //Los alias de las tablas
	
	private $inicio; //Para paginacion
	private $fin; //Para paginacion
	
	public $conn;
	
	function __construct($tabla,$datos,$camposMostrar,$filtroCampo,$filtroOperador,$filtroValor,$filtroSeparador,$camposOrdenar,$tipoOrdenar,$alias,$inicio,$fin)
	{
		$this->sgbd="MySQL";
		
		$this->tabla=$tabla;
		$this->datos=$datos;
		$this->camposMostrar=$camposMostrar;
		$this->filtroCampo=$filtroCampo;
		$this->filtroOperador=$filtroOperador;
		$this->filtroValor=$filtroValor;
		$this->filtroSeparador=$filtroSeparador;
		$this->camposOrdenar=$camposOrdenar;
		$this->tipoOrdenar=$tipoOrdenar;
		
		$this->alias=$alias;
		
		$this->inicio=$inicio;
		$this->fin=$fin;
	}
	
	public function enlazar()
	{
		if($this->sgbd=='MySQL')
		{
			require_once("mysql.php");
			$this->conn=new mysql($this->tabla,$this->datos,$this->camposMostrar,$this->filtroCampo,$this->filtroOperador,$this->filtroValor,$this->filtroSeparador,$this->camposOrdenar,$this->tipoOrdenar,$this->alias,$this->inicio,$this->fin);
		}
		if($this->sgbd=='Oracle')
		{
			
		}
	}
}
?>