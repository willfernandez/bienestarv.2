<?php
	require_once("models/config.php");
	class Vivienda
	{
		private $tabla="vivienda";
		private $id;
                private $alumno_id;
		private $vivienda;
                private $construccion;
		private $servicio_a;
                private $servicio_b;
                private $servicio_c;
                private $servicio_d;
                private $servicio_e;
                private $servicio_f;
                private $equipo_a;
                private $equipo_b;
                private $equipo_c;
                private $equipo_d;
                private $equipo_e;
                private $equipo_f;
                private $equipo_g;
                private $equipo_h;
                private $annio;
		

                function __construct($id,$alumno_id,$vivienda,$construccion,$servicio_a,$servicio_b,$servicio_c,$servicio_d ,$servicio_e,$servicio_f,
                              $equipo_a,$equipo_b,$equipo_c,$equipo_d,$equipo_e,$equipo_f,$equipo_g,$equipo_h,$annio)
		{
			$this->id=$id;
			$this->alumno_id=$alumno_id;
                        $this->vivienda=$vivienda;
			$this->construccion=$construccion;
			$this->servicio_a=$servicio_a;
                        $this->servicio_b=$servicio_b;
                        $this->servicio_c=$servicio_c;
                        $this->servicio_d=$servicio_d;
                        $this->servicio_e=$servicio_e;
                        $this->servicio_f=$servicio_f;
                        $this->equipo_a=$equipo_a;
                        $this->equipo_b=$equipo_b;
                        $this->equipo_c=$equipo_c;
                        $this->equipo_d=$equipo_d;
                        $this->equipo_e=$equipo_e;
                        $this->equipo_f=$equipo_f;
                        $this->equipo_g=$equipo_g;
                        $this->equipo_h=$equipo_h;
                        $this->annio=$annio;
                        
		}
		
		function guardar()
		{
			$datos="0*$this->alumno_id*$this->vivienda*$this->construccion*$this->servicio_a*$this->servicio_b*$this->servicio_c*$this->servicio_d*$this->servicio_e*$this->servicio_f*$this->equipo_a*$this->equipo_b*$this->equipo_c*$this->equipo_d*$this->equipo_e*$this->equipo_f*$this->equipo_g*$this->equipo_h*$this->annio";
			$config=new config($this->tabla,$datos,"","","","","","","","","","");
			$config->enlazar();
			$id=$config->conn->guardar();
			return $id;
		}
		
		function actualizar()
		{
			$datos="$this->id*$this->alumno_id*$this->vivienda*$this->construccion*$this->servicio_a*$this->servicio_b*$this->servicio_c*$this->servicio_d*$this->servicio_e*$this->servicio_f*$this->equipo_a*$this->equipo_b*$this->equipo_c*$this->equipo_d*$this->equipo_e*$this->equipo_f*$this->equipo_g*$this->equipo_h*$this->annio";
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
