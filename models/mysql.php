<?php
require_once("conexion.php");

class mysql
{
	private $tabla; //La tabla
	private $datos; //Los datos
	//Para el m�todo buscar
	private $camposMostrar; //Los campos a mostrar en el resultado
	private $filtroCampo; //Los campos para filtrar
	private $filtroOperador; //Los operadores de los filtros
	private $filtroValor; //Los valores de los filtros
	private $filtroSeparador; //Los AND u OR
	private $camposOrdenar; //Los campos por los que se ordenara
	private $tipoOrdenar; //El tipo de ordenamiento
	
	private $alias; //Los alias de las tablas para consulta multiple
	
	private $inicio;
	private $fin;
	
	private $mc;
        private $mcEncuesta;
	
	function __construct($tabla,$datos,$camposMostrar,$filtroCampo,$filtroOperador,$filtroValor,$filtroSeparador,$camposOrdenar,$tipoOrdenar,$alias,$inicio,$fin)
	{
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
		
		$this->mc=new conexion();
             //   $this->mcEncuesta= new conexionEncuesta;
	}
	//Pendiente GROUP BY, LIMIT
	public function guardar()
	{
		$d=self::separarValores($this->datos);
		$n=count($d);
		$valorescampos='';
		if($n>1)
		{
			$valorescampos="0";
			for ($i=1;$i<$n;$i++)
			{
				$valorescampos.=",'$d[$i]'";
			}
		}
		$sql="INSERT INTO $this->tabla VALUES($valorescampos)";
		mysql::ejecutarConsulta($sql,1);//?????
		//$this->mc->conectarMySQL();
		//$this->mc->conex->query($sql);
		$id=$this->mc->conex->insert_id;
		//echo $sql;
		return $id;
	}
	public function actualizar()
	{
		$d=self::separarValores($this->datos);
		$n=count($d);
		$campos=self::obtenerCampos($this->tabla);
		$nc=count($campos);
		if($n>1)
		{
			$valorescampos=$campos[1]."='".$d[1]."'";///
			for ($i=2;$i<$n;$i++)
			{
				$valorescampos.=",".$campos[$i]."='$d[$i]'";
			}
		}
		$sql="UPDATE $this->tabla SET $valorescampos WHERE $campos[0]='$d[0]'";
		mysql::ejecutarConsulta($sql,1);//?????
		//$this->mc->conectarMySQL();
		//$this->mc->conex->query($sql);
	}
	public function eliminar() //Solo elimina por id
	{
		if ($this->filtroCampo=="")
			$sql="DELETE FROM $this->tabla WHERE id='$this->datos'";
		else
			$sql="DELETE FROM $this->tabla WHERE $this->filtroCampo=$this->datos";
		//$this->mc->conectarMySQL();
		//$this->mc->conex->query($sql);
		mysql::ejecutarConsulta($sql,1);//?????
	}
	/////------------------------------------------------------------------------------
        /*public function crearConsultaSeleccionEncuestas()
	{
		$sql="SELECT ";
		//Agregamos a la consulta los campos a mostrar
		if (trim($this->camposMostrar)=="")
		{
			$sql.='* ';
		}
		else
		{
			$cm=explode("*",$this->camposMostrar);
			$ncm=count($cm);
			$sql.=$cm[0];
			for($i=1;$i<$ncm;$i++)
			{
				$sql.=','.$cm[$i];
			}
		}
		//Agregamos la tabla fuente
		$sql.=" FROM $this->tabla ";
		//Agregamos los filtros de la consulta
		//$tabla,$datos,$camposMostrar,$filtroCampo,$filtroOperador,$filtroValor,$filtroSeparador,$camposOrdenar,$tipoOrdenar
		if (trim($this->filtroCampo)<>"")
		{
			$fc=explode("*",$this->filtroCampo);
			$fo=explode("*",$this->filtroOperador);
			$fv=explode("*",$this->filtroValor);
			$fs=explode("*",$this->filtroSeparador);
			$nfc=count($fc);
			$nfo=count($fo);
			$nfv=count($fv);
			$nfs=count($fs);
			if ($nfc>0)
			{ 
				//SELECT id,apellidos,nombres FROM cliente WHERE apellidos=$ape AND nombres LIKE '%$nom%' ORDER BY apellidos,nombres DESC
				$antes='';$despues='';
				if(trim($fo[0])=='LIKE')
				{
					$antes='%';
					$despues='%';
				}
				$sql.="WHERE ".$fc[0]." ".$fo[0]."'".$antes.$fv[0].$despues."'";
				//if ($nfc>1)
					for($i=1;$i<$nfc;$i++)
					{
						$antes='';$despues='';
						if(trim($fo[$i])=='LIKE')
						{
							$antes='%';
							$despues='%';
						}
						$sql.=$fs[$i-1]." ".$fc[$i]." ".$fo[$i]."'".$antes.$fv[$i].$despues."'";
					}
			}
		}
		//Implementamos la clausula ORDER BY
		if(trim($this->camposOrdenar)<>"")
		{
			$co=explode("*",$this->camposOrdenar);
			$nco=count($co);
			if ($nco>0)
			{
				$sql.=" ORDER BY $co[0]";
				for($i=1;$i<$nco;$i++)
				{
					$sql.=", $co[$i]";
				}
			}
			//Agregamos el tipo de ordenamiento//Ojo tipoOrdenar debe contener ASC, DESC, o nada
			$sql.=" ".$this->tipoOrdenar;
		}
		//Agregamos la paginacion si corresponde
		if (trim($this->inicio)!="")
			if (trim($this->fin)!="")
				$sql.=" LIMIT $this->inicio,$this->fin";
		//Procedemos a ejecutar la consulta
		//echo $sql;
		$a=mysql::ejecutarConsultaEncuesta($sql,2);
		return $a;
	}
        
        
        ///////---------------------------------------------------------------------------------fin
        
        public function ejecutarConsultaEncuesta($sql,$tipo)
	{
		//echo $sql."<hr/>";
		$this->mcEncuesta->conectarMySQL();
                
		$res=$this->mcEncuesta->conex->query($sql);
		if($tipo==2)
		{
			$tcampos=$res->field_count;
			if ($res->num_rows>0)
			{	$i=0;
				while($r=$res->fetch_array())
				{
					for($j=0;$j<$tcampos;$j++)
					{
						$a[$i][$j]=$r[$j];
					}
					$i++;
				}
                                $this->mcEncuesta->cerrar();
                                return $a;
			}
			
		}
	}
        
        
        ///////---------------------------------------------------------------------------------fin2
        */
	public function crearConsultaSeleccion()
	{
		$sql="SELECT ";
		//Agregamos a la consulta los campos a mostrar
		if (trim($this->camposMostrar)=="")
		{
			$sql.='* ';
		}
		else
		{
			$cm=explode("*",$this->camposMostrar);
			$ncm=count($cm);
			$sql.=$cm[0];
			for($i=1;$i<$ncm;$i++)
			{
				$sql.=','.$cm[$i];
			}
		}
		//Agregamos la tabla fuente
		$sql.=" FROM $this->tabla ";
		//Agregamos los filtros de la consulta
		//$tabla,$datos,$camposMostrar,$filtroCampo,$filtroOperador,$filtroValor,$filtroSeparador,$camposOrdenar,$tipoOrdenar
		if (trim($this->filtroCampo)<>"")
		{
			$fc=explode("*",$this->filtroCampo);
			$fo=explode("*",$this->filtroOperador);
			$fv=explode("*",$this->filtroValor);
			$fs=explode("*",$this->filtroSeparador);
			$nfc=count($fc);
			$nfo=count($fo);
			$nfv=count($fv);
			$nfs=count($fs);
			if ($nfc>0)
			{ 
				//SELECT id,apellidos,nombres FROM cliente WHERE apellidos=$ape AND nombres LIKE '%$nom%' ORDER BY apellidos,nombres DESC
				$antes='';$despues='';
				if(trim($fo[0])=='LIKE')
				{
					$antes='%';
					$despues='%';
				}
				$sql.="WHERE ".$fc[0]." ".$fo[0]."'".$antes.$fv[0].$despues."'";
				//if ($nfc>1)
					for($i=1;$i<$nfc;$i++)
					{
						$antes='';$despues='';
						if(trim($fo[$i])=='LIKE')
						{
							$antes='%';
							$despues='%';
						}
						$sql.=$fs[$i-1]." ".$fc[$i]." ".$fo[$i]."'".$antes.$fv[$i].$despues."'";
					}
			}
		}
		//Implementamos la clausula ORDER BY
		if(trim($this->camposOrdenar)<>"")
		{
			$co=explode("*",$this->camposOrdenar);
			$nco=count($co);
			if ($nco>0)
			{
				$sql.=" ORDER BY $co[0]";
				for($i=1;$i<$nco;$i++)
				{
					$sql.=", $co[$i]";
				}
			}
			//Agregamos el tipo de ordenamiento//Ojo tipoOrdenar debe contener ASC, DESC, o nada
			$sql.=" ".$this->tipoOrdenar;
		}
		//Agregamos la paginacion si corresponde
		if (trim($this->inicio)!="")
			if (trim($this->fin)!="")
				$sql.=" LIMIT $this->inicio,$this->fin";
		//Procedemos a ejecutar la consulta
		//echo $sql;
		$a=mysql::ejecutarConsulta($sql,2);
		return $a;
	}
	
	public function crearConsultaMultiple()
	{
		$sql="SELECT ";
		//Agregamos a la consulta los campos a mostrar
		if (trim($this->camposMostrar)=="")
		{
			$sql.='* ';
		}
		else
		{
			$cm=explode("*",$this->camposMostrar);
			$ncm=count($cm);
			$sql.=$cm[0];
			for($i=1;$i<$ncm;$i++)
			{
				$sql.=','.$cm[$i];
			}
		}
		//Agregamos la tabla fuente
		$tt=self::separarValores($this->tabla);
		$ntt=count($tt);
		$aa=self::separarValores($this->alias);
		$naa=count($aa);
		if($ntt>1)
		{
			$sql.=" FROM $tt[0] as $aa[0]";
                       // echo $sql;
			if($naa==$ntt)
			{
				for($i=1;$i<$ntt;$i++)
					$sql.=", $tt[$i] as $aa[$i]";
			}
			else
			{
				echo "El n�mero de tablas es diferente al n�mero de alias...";
				exit();
			}
		}
		//Agregamos los filtros de la consulta
		//		$tabla,$datos,$camposMostrar,$filtroCampo,$filtroOperador,$filtroValor,$filtroSeparador,$camposOrdenar,$tipoOrdenar
		$fc=explode("*",$this->filtroCampo);
		
		$fo=explode("*",$this->filtroOperador);
		$fv=explode("*",$this->filtroValor);
		$fs=explode("*",$this->filtroSeparador);
		$nfc=count($fc);
		$nfo=count($fo);
		$nfv=count($fv);
		$nfs=count($fs);
		if ($nfc>0)
		{ 
			//SELECT id,apellidos,nombres FROM cliente WHERE apellidos=$ape AND nombres LIKE '%$nom%' ORDER BY apellidos,nombres DESC
			$antes='';$despues='';
			if(trim($fo[0])=='LIKE')
			{
				$antes='%';
				$despues='%';
			}
			//Para los ap'ostrofes, verificamos si es una condicion de relacion
			$vf=explode(".",$fv[0]);
			$nvf=count($vf);
			$aantes="'";$adespues="'";
			if($nvf>1)
			{ // No lleva comillas
				$aantes="";
				$adespues="";
			}
			//////////
			$sql.=" WHERE ".$fc[0]." ".$fo[0].$aantes.$antes.$fv[0].$despues.$adespues;
			//if ($nfc>1)
			for($i=1;$i<$nfc;$i++)
			{
				//Para los ap'ostrofes, verificamos si es una condicion de relacion
				$vf=explode(".",$fv[$i]);
				$nvf=count($vf);
				$aantes="'";$adespues="'";
				if($nvf>1)
				{ // No lleva comillas
					$aantes="";	$adespues="";
				}
				
				$antes='';$despues='';
				if(trim($fo[$i])=='LIKE')
				{
					$antes='%';
					$despues='%';
				}
				$sql.=" ".$fs[$i-1]." ".$fc[$i]." ".$fo[$i].$aantes.$antes.$fv[$i].$despues.$adespues;
			}
		}
		//Implementamos la clausula ORDER BY
		if(trim($this->camposOrdenar)!="")
		{
			$co=explode("*",$this->camposOrdenar);
			$nco=count($co);
			if ($nco>0)
			{
				$sql.=" ORDER BY $co[0]";
				for($i=1;$i<$nco;$i++)
				{
					$sql.=",$co[$i]";
				}
			}
		}
		//Agregamos el tipo de ordenamiento//Ojo tipoOrdenar debe contener ASC, DESC, o nada
		$sql.=" ".$this->tipoOrdenar;
		//Agregamos la paginacion si corresponde
		if (trim($this->inicio)!="")
			if (trim($this->fin)!="")
				$sql.=" LIMIT $this->inicio,$this->fin";
		//Procedemos a ejecutar la consulta
                   //     echo $sql;
		$a=mysql::ejecutarConsulta($sql,2);
		return $a;
	}
	//private function ejecutarConsulta($sql);
	public function ejecutarConsulta($sql,$tipo)
	{
		//echo $sql."<hr/>";
		$this->mc->conectarMySQL();
                
		$res=$this->mc->conex->query($sql);
		if($tipo==2)
		{
			$tcampos=$res->field_count;
			if ($res->num_rows>0)
			{	$i=0;
				while($r=$res->fetch_array())
				{
					for($j=0;$j<$tcampos;$j++)
					{
						$a[$i][$j]=$r[$j];
					}
					$i++;
				}
                                return $a;
			}
			
		}
	}
	public function totalRegistros()
	{
		$sql="SELECT COUNT(id) FROM $this->tabla";
		$total=self::ejecutarConsulta($sql);
		return $total;
	}
	private function separarValores($cadena)
	{	
		$d=explode("*",$cadena);
		return $d;
	}
	private function obtenerCampos($tabla)
	{
		$sql="DESCRIBE $tabla";
		$this->mc->conectarMySQL();
		$res=$this->mc->conex->query($sql);
		$c=0;
		if($res->num_rows>0)
		{
			while($r=$res->fetch_array())
			{	
				$campos[$c]=$r[0];//El nombre del campo
				$c++;
			}
		}
		return $campos;
	}
}
?>