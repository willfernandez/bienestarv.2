<?php
	require_once("models/config.php");
	class educacion
	{
		private $tabla="educations";
		private $id;
		private $alumno_id;
                private $colegio;
		private $nombreC;
		private $ubicacionC;
      		private $carreraT;
		private $nombreCr;
		private $actAcade;
                private $actDepor;
                private $academia;
                private $nomAcademia;
                private $tiempoAcademia;
                private $numIntento;
                private $postuCarrera;
                private $año;
                
		
		function __construct($id,$alumno_id,$colegio,$nombreC,$ubicacionC,$carreraT,$nombreCr,$actAcade,$actDepor,$academia,$nomAcademia,$tiempoAcademia,$numIntento,$postuCarrera,$año)
		{
			$this->id=$id;
			$this->alumno_id=$alumno_id;
                        $this->colegio=$colegio;
			$this->nombreC=$nombreC;
			$this->ubicacionC=$ubicacionC;
			$this->carreraT=$carreraT;
			$this->nombreCr=$nombreCr;
			$this->actAcade=$actAcade;
                        $this->actDepor=$actDepor;
                        $this->academia=$academia;
                        $this->nomAcademia=$nomAcademia;
                        $this->tiempoAcademia=$tiempoAcademia;
                        $this->numIntento=$numIntento;
                        $this->postuCarrera=$postuCarrera;
                        $this->año=$año;
		}
		
		function guardar()
		{
			$datos="0*$this->alumno_id*$this->colegio*$this->nombreC*$this->ubicacionC*$this->carreraT*$this->nombreCr*$this->actAcade*$this->actDepor*$this->academia*$this->nomAcademia*$this->tiempoAcademia*$this->numIntento*$this->postuCarrera*$this->año";
			$config=new config($this->tabla,$datos,"","","","","","","","","","");
			$config->enlazar();
			$id=$config->conn->guardar();
			return $id;
		}
		
		function actualizar()
		{
			$datos="$this->id*$this->alumno_id*$this->colegio*$this->nombreC*$this->ubicacionC*$this->carreraT*$this->nombreCr*$this->actAcade*$this->actDepor*$this->academia*$this->nomAcademia*$this->tiempoAcademia*$this->numIntento*$this->postuCarrera*$this->año";
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
			$tablas="alumnos*carreras*educations*matriculas";
			$config=new config($tablas,$this->id,$camposMostrar,$campo,$operador,$valor,$separador,"","","a*ca*d*m",$inicio,$fin);
			$config->enlazar();
			$a=$config->conn->crearConsultaMultiple();
			return $a;
		}
                
                function listarPeriodo($camposMostrar,$campo,$operador,$valor,$separador,$inicio,$fin)
		{
			$tablas="educations*matriculas*sedes*anioacademicos*carreras*alumnos*facultad";
			$config=new config($tablas,$this->id,$camposMostrar,$campo,$operador,$valor,$separador,"","","f*m*s*a*ca*al*fac",$inicio,$fin);
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