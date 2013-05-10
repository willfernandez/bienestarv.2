<?
require('FPDF/fpdf.php');
class PDF extends FPDF
{
   //Cabecera de página
   function Header()
   {

       $this->Image('img/logo_login.png',10,8,33);

      $this->SetFont('Arial','B',12);

      $this->Cell(30,10,'Title',1,0,'C');

   }

   function Footer()
	{

	$this->SetY(-10);

	$this->SetFont('Arial','I',8);

	$this->Cell(0,10,'Page '.$this->PageNo().'/{nb}',0,0,'C');
	   }
}

//Creación del objeto de la clase heredada
$pdf=new PDF();
$pdf->AddPage();
$pdf->SetFont('Times','',12);
$pdf->Cell(40,10,'¡Hola, Mundo marína!');
$pdf->Output();
?>