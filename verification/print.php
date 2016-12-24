


<?php

$text = $_POST['area']; // remove the last \n or whitespace character




require('tfpdf.php');
$pdf = new tFPDF();
$pdf->AddPage();


$pdf->SetFont('times','',14);
$pdf->Ln(10);
$pdf->Write(8,utf8_decode($text));

$pdf->Output();

?>
