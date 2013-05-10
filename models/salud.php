<?php
	require_once("models/config.php");
	class Salud
	{
		private $tabla="salud";
		private $id;
		private $alumno_id;
        private $enfermedad;
		private $enfermedadNom;
		private $atencionS;
        private $año;
        private $embarazo;
        private $tembarazo;
        private $fparto;
        private $controles;
        private $sn_anticonceptivo;
        private $c_anticonceptivo;

        function __construct($id,$alumno_id,$enfermedad,$enfermedadNom,$atencionS,$año,$emb,$temb,$fpa,$cont,$sn,$c)
		{
			$this->id=$id;
			$this->alumno_id=$alumno_id;
            $this->enfermedad=$enfermedad;
			$this->enfermedadNom=$enfermedadNom;
			$this->atencionS=$atencionS;
            $this->año=$año;
            $this->embarazo = $emb;
            $this->tembarazo = $temb;
            $this->fparto = $fpa;
            $this->controles = $cont;
            $this->sn_anticonceptivo = $sn;
            $this->c_anticonceptivo = $c;
		}
		
		function guardar()
		{
			$datos="0*$this->alumno_id*$this->enfermedad*$this->enfermedadNom*$this->atencionS*$this->año*$this->embarazo*$this->tembarazo*$this->fparto*$this->controles*$this->sn_anticonceptivo*$this->c_anticonceptivo";
			$config=new config($this->tabla,$datos,"","","","","","","","","","");
			$config->enlazar();
			$id=$config->conn->guardar();
			return $id;
		}
		
		function actualizar()
		{
			$datos="$this->id*$this->alumno_id*$this->enfermedad*$this->enfermedadNom*$this->atencionS*$this->año*$this->embarazo*$this->tembarazo*$this->fparto*$this->controles*$this->sn_anticonceptivo*$this->c_anticonceptivo";
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
		 function listarTotal($camposMostrar,$campo,$operador,$valor,$separador,$inicio,$fin)
		{
			$tablas="alumnos*carreras*salud*matriculas";
			$config=new config($tablas,$this->id,$camposMostrar,$campo,$operador,$valor,$separador,"","","a*ca*d*m",$inicio,$fin);
			$config->enlazar();
			$a=$config->conn->crearConsultaMultiple();
			return $a;
		}
                
        function listarPeriodo($camposMostrar,$campo,$operador,$valor,$separador,$inicio,$fin)
		{
			$tablas="salud*matriculas*sedes*anioacademicos*carreras*alumnos*facultad";
			$config=new config($tablas,$this->id,$camposMostrar,$campo,$operador,$valor,$separador,"","","f*m*s*a*ca*al*fac",$inicio,$fin);
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