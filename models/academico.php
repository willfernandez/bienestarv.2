<?php
	require_once("models/config.php");
	class Academico
	{
		private $tabla="academicos";
		private $id;
                private $alumno_id;
		private $universidad;
                private $tcarrera;
                private $pcarrera;
		private $motivo_1;
                private $motivo_2;
                private $motivo_3;
                private $motivo_4;
                private $motivo_5;
                private $motivo_6;
                private $motivo_7;
                private $motivo_8;
                private $motivo_9;
                private $motivo_10;
                private $ayuda;
                private $año;
                
		

                function __construct($id,$alumno_id,$universidad,$tcarrera,$pcarrera,$motivo_1,$motivo_2,$motivo_3,$motivo_4,$motivo_5,$motivo_6,
                                        $motivo_7,$motivo_8,$motivo_9,$motivo_10,$ayuda,$año)
		{
			$this->id=$id;
			$this->alumno_id=$alumno_id;
                        $this->universidad=$universidad;
			$this->tcarrera=$tcarrera;
			$this->pcarrera=$pcarrera;
                        $this->motivo_1=$motivo_1;
                        $this->motivo_2=$motivo_2;
                        $this->motivo_3=$motivo_3;
                        $this->motivo_4=$motivo_4;
                        $this->motivo_5=$motivo_5;
                        $this->motivo_6=$motivo_6;
                        $this->motivo_7=$motivo_7;
                        $this->motivo_8=$motivo_8;
                        $this->motivo_9=$motivo_9;
                        $this->motivo_10=$motivo_10;
                        $this->ayuda=$ayuda;
                        $this->año=$año;
                        
                        
		}
		
		function guardar()
		{
			$datos="0*$this->alumno_id*$this->universidad*$this->tcarrera*$this->pcarrera*$this->motivo_1*$this->motivo_2*$this->motivo_3*$this->motivo_4*$this->motivo_5*$this->motivo_6*$this->motivo_7*$this->motivo_8*$this->motivo_9*$this->motivo_10*$this->ayuda*$this->año";
			$config=new config($this->tabla,$datos,"","","","","","","","","","");
			$config->enlazar();
			$id=$config->conn->guardar();
			return $id;
		}
		
		function actualizar()
		{
			$datos="$this->id*$this->alumno_id*$this->universidad*$this->tcarrera*$this->pcarrera*$this->motivo_1*$this->motivo_2*$this->motivo_3*$this->motivo_4*$this->motivo_5*$this->motivo_6*$this->motivo_7*$this->motivo_8*$this->motivo_9*$this->motivo_10*$this->ayuda*$this->año";
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
			$tablas="estadoBandeja*bandeja*tramite";
			$config=new config($tablas,$this->id,$camposMostrar,$campo,$operador,$valor,$separador,"b.fechallegada","DESC","eb*b*t",$inicio,$fin);
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
