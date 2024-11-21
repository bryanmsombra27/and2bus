<?php
	
	include'plantillacomprobante.php';
	require 'conexionpdf.php';
	
$query="SELECT * FROM transacciones ORDER BY noFolio DESC LIMIT 1";
$resultado = $mysqli->query($query);

$pdf=new PDF();
$pdf->AddPage();

$pdf->SetFillColor(216, 249, 245 );
$pdf->SetFont ('Arial','B',12);


$pdf->SetFont ('Arial','',10);


while($row=$resultado->fetch_assoc())
{
$pdf->SetFont ('Arial','B',12);
$pdf->Cell(52,10 ,'Numero de folio', 1,0,'C',1); 
$pdf->Cell(140,10 ,$row['noFolio'], 1,0,'C',1);   
$pdf->Ln();
$pdf->Cell(52,10, 'Importe $', 1,0,'C',1); 
$pdf->Cell(140,10, $row['importe'], 1,0,'C',1);   
$pdf->Ln();
$pdf->Cell(52,10, 'Estado', 1,0,'C',1); 
$pdf->Cell(140,10 ,$row['status'], 1,0,'C',1);  
$pdf->Ln();
$pdf->Cell(52,10, 'Codigo', 1,0,'C',1); 
$pdf->Cell(140,10 ,$row['code'], 1,0,'C',1);  
$pdf->Ln();
$pdf->Cell(52,10, 'Informacion de la tarjeta', 1,0,'C',1);
$pdf->Cell(140,10, $row['cardInfo'], 1,0,'C',1); 
$pdf->Ln();
$pdf->Cell(52,10, 'Fecha', 1,0,'C',1);  
$pdf->Cell(140,10 ,$row['fecha'], 1,0,'C',1);   
$pdf->Ln();
$pdf->Cell(52,10, 'Numero de serie', 1,0,'C',1);  
$pdf->Cell(140,10 ,$row['noSerie'], 1,0,'C',1);   


	
}

$pdf->Output();

?>