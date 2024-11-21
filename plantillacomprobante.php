<?php
require 'fpdf/fpdf.php';

class PDF  extends FPDF
{
	
	function Header()
	{
		$this->Image('img/logo.png', 18, 12, 32);
		$this->SetFont ('Arial','B',25);
        
		$this->Cell(25);
		$this->Cell(120, 10, 'Comprobante', 0,1,'C');
		
		$this->Ln(22);
	}
	

	
}

?>