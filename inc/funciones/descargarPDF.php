<?php 

require_once('funciones.php');
require_once('fpdf\fpdf.php');

$a_productos = array();
$a_productos = json_decode(file_get_contents('..\..\json\productos.json'),true);

//MostrarArray($a_productos);

//echo($_GET["producto"]);

//$_GET["producto"] $a_productos

$nombre_producto = $_GET["producto"]["nombre"];

crearPDF_producto();


function crearPDF_producto(){
  $pdf = new FPDF();
  $pdf->AddPage();
  $pdf->SetFont('Arial','',16);
  //$pdf->Cell(40,10, $nombre_producto);

    //FALTA PROGRESO




  $pdf->Output();
   
}

?>