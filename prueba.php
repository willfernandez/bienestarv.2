<?php
require('fpdf/fpdf.php');
class PDF extends FPDF
{
   //Cabecera de p�gina
   function Header()
   {

   }

function Footer()
{

// Posici�n: a 1,5 cm del final
$this->SetY(-15);
// Arial italic 8
$this->SetFont('Arial','I',8);
// N�mero de p�gina
$this->Cell(0,10,'Page '.$this->PageNo().'/{nb}',0,0,'C');
   }

	   function dibujar(){

		   $this->SetFillColor(255,255,255);
		   
		    $this->SetDrawColor(128,0,0);
		    $this->SetLineWidth(.3);
		    $this->SetFont('','B');
    	   $this->Cell(190,70,'',1,0,'C',true);
		   $this->Image('img/logo_login.png',10,13,30);
    	   $this->Image('cssshadow/img/compo.png',9,10,192,70);
	   }
}

//Creaci�n del objeto de la clase heredada
session_start();
$codigo =  $_SESSION['codigo'];
$nombres = convertirtildes($_SESSION['nombres']);
$apellidos = convertirtildes($_SESSION['apellidos']);
$idMat =  $_SESSION['matId'];
$modalidad =  $_SESSION['modE'];
$carreras= $_SESSION['carerra'];
$carrera = convertirtildes($carreras);
$siglas = $_SESSION['sig'];
$facultades = $_SESSION['facu'];
$facultad = convertirtildes($facultades);
$ciclo = $_SESSION['ciclo'];
$semestre = $_SESSION['nomannio'];

$pdf = new PDF();
$pdf->AliasNbPages();
$pdf->AddPage();
$pdf->SetFont('Arial','',12);
$pdf->dibujar();
$pdf->SetTextColor(0);

$pdf->SetXY(60,14);
$pdf->Write(3,'UNIVERSIDAD JOS� CARLOS MARI�TEGUI');
$pdf->SetXY(80,19);
$pdf->SetFont('Arial','',8);
$pdf->Write(1,'Oficina de Bienestar Universitario OBU');
$pdf->SetTextColor(29,42,91);
$pdf->SetXY(55,38);
$pdf->SetFont('Arial','B',10);
$pdf->Write(1,'CONSTANCIA DE EVALUACI�N SOCIOECON�MICA-M�DICA');
$pdf->SetXY(155,32);
$pdf->SetFont('Arial','B',10);
$pdf->Write(1,$semestre);

$pdf->SetTextColor(29,42,91);
$pdf->SetXY(25,47);
$pdf->SetFont('Arial','B',11);
$pdf->Write(1,'C�DIGO');
//
$pdf->SetFont('Arial','B',9);
$pdf->SetXY(150,25);
$pdf->Write(1,'N�mero de Registro: '.$idMat );
$pdf->SetFont('Arial','B',5);
$pdf->SetXY(170,78);
$pdf->Write(1,'By: ACREDITACI�N');

$pdf->SetXY(50,47);
$pdf->SetFont('Arial','B',11);
$pdf->Write(1,':');

$pdf->SetXY(55,47);
$pdf->SetFont('Arial','I',11);
$pdf->Write(1,$codigo);

$pdf->SetTextColor(29,42,91);
$pdf->SetXY(25,52);
$pdf->SetFont('Arial','B',10);
$pdf->Write(1,'NOMBRES');

$pdf->SetXY(50,52);
$pdf->SetFont('Arial','B',10);
$pdf->Write(1,':');
$pdf->SetXY(55,52);
$pdf->SetFont('Arial','I',11);
$pdf->Write(1,$nombres);

$pdf->SetTextColor(29,42,91);
$pdf->SetXY(25,57);
$pdf->SetFont('Arial','B',10);
$pdf->Write(1,'APELLIDOS');

$pdf->SetXY(50,57);
$pdf->SetFont('Arial','B',0);
$pdf->Write(1,':');

$pdf->SetXY(55,57);
$pdf->SetFont('Arial','I',11);
$pdf->Write(1,$apellidos);

$pdf->SetTextColor(29,42,91);
$pdf->SetXY(25,62);
$pdf->SetFont('Arial','B',10);
$pdf->Write(1,'FACULTAD');

$pdf->SetXY(50,62);
$pdf->SetFont('Arial','B',10);
$pdf->Write(1,':');

$pdf->SetXY(55,62);
$pdf->SetFont('Arial','I',11);
$pdf->Write(1,$facultad);

$pdf->SetTextColor(29,42,91);
$pdf->SetXY(25,67);
$pdf->SetFont('Arial','B',10);
$pdf->Write(1,'CARRERA');

$pdf->SetXY(50,67);
$pdf->SetFont('Arial','B',10);
$pdf->Write(1,':');

$pdf->SetXY(55,67);
$pdf->SetFont('Arial','I',11);
$pdf->Write(1,$carrera);

$pdf->SetTextColor(29,42,91);
$pdf->SetXY(108,47);
$pdf->SetFont('Arial','B',10);
$pdf->Write(1,'CICLO');

$pdf->SetXY(130,47);
$pdf->SetFont('Arial','B',10);
$pdf->Write(1,':');

$pdf->SetXY(135,47);
$pdf->SetFont('Arial','I',11);
$pdf->Write(1,$ciclo);

function convertirtildes($dato) {
        $dato = str_replace ('&aacute;','�', $dato);
        $dato = str_replace ('&eacute;','�', $dato);
        $dato = str_replace ('&iacute;','�', $dato);
        $dato = str_replace ('&oacute;','�', $dato);
        $dato = str_replace ('&uacute;','�', $dato);
        $dato = str_replace ('&ntilde;','�', $dato);
        $dato = str_replace ('&Aacute;','�', $dato);
        $dato = str_replace ('&Eacute;','�', $dato);
        $dato = str_replace ('&Iacute;','�', $dato);
        $dato = str_replace ('&Oacute;','�', $dato);
        $dato = str_replace ('&Uacute;','�', $dato);
        $dato = str_replace ('&Ntilde;','�', $dato);
        return $dato;
        }
$pdf->Output('Comprobante_OBU.pdf','D');


?>
