<?php
require('html_table.php');

session_start();
$pdf=new PDF();
$pdf->AddPage();
$pdf->SetFont('Arial','',12);


$pdf->WriteHTML($_SESSION['results']);
$pdf->Output();
?>
