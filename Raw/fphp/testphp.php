<?php

ob_end_clean();
require('fpdf.php');

$cusname = "kyaw gyi";
$emailbody = '';
$emailbody = '';

// Instantiate and use the FPDF class 
$pdf = new FPDF();

//Add a new page
$pdf->AddPage();

// Set the font for the text
$pdf->SetFont('Arial', 'B', 18);

// Prints a cell with given text 
$pdf->Cell(60, 20, $cusname);

// return the generated output
$pdf->Output();
