<?php
date_default_timezone_set("Africa/Harare");
include '../gf/database.php';
session_start();
require('fpdf/fpdf.php');

if(!isset($_SESSION['results'])){
	header('Location:reports.php');
}

class PDF extends FPDF
{

  var $angle=0;
// Page header
function Header()
{


}
function Rotate($angle, $x=-1, $y=-1)
{
  if($x==-1)
    $x=$this->x;
  if($y==-1)
    $y=$this->y;
  if($this->angle!=0)
    $this->_out('Q');
  $this->angle=$angle;
  if($angle!=0)
  {
    $angle*=M_PI/180;	
    $c=cos($angle);
    $s=sin($angle);
    $cx=$x*$this->k;
    $cy=($this->h-$y)*$this->k;
    $this->_out(sprintf('q %.5F %.5F %.5F %.5F %.2F %.2F cm 1 0 0 1 %.2F %.2F cm',$c,$s,-$s,$c,$cx,$cy,-$cx,-$cy));
  }
}

//water marks
function temporaire( $texte )
{
  $this->SetFont('Arial','B',50);
  $this->SetTextColor(203,203,203);
  $this->Rotate(45,55,190);
  $this->Text(55,190,$texte);
  $this->Rotate(0);
  $this->SetTextColor(0,0,0);
}



// Page footer
function Footer()
{
// Position at 1.5 cm from bottom
$this->SetTextColor(0,0,0);
$this->SetY(-15);
//Arial italic 8
$this->SetFont('Arial','BI',9);
//Page number
$date = date('D jS M Y');
$this->SetX(15);
$this->Cell(0,10,'Report Printed on : '.$date,0,0,'C');
$this->Cell(0,10,'Page '.$this->PageNo().' of {nb}',0,0,'R');
}
function headerTable(){
	$this->setFont('Times','B',12);
	$this->Cell(15,10,'ID',1,0,'C');
	$this->Cell(30,10,'Department',1,0,'C');
	$this->Cell(30,10,'User',1,0,'C');
	$this->Cell(20,10,'Quantity',1,0,'C');
	$this->Cell(25,10,'Borrow Date',1,0,'C');
	$this->Cell(25,10,'Return Date',1,0,'C');
	$this->Cell(37,10,'Actual Return Date',1,0,'C');
	$this->Cell(25,10,'Status',1,0,'C');
}
function tableItems(){
	
}
}

function makeMargin($data2,$pdf){
	$cellWidth=190;//wrapped cell width
	$cellHeight=5;//normal one-line cell height
	
	//check whether the text is overflowing
	if($pdf->GetStringWidth($data2) < $cellWidth){
		//if not, then do nothing
		$line=1;
	}else{
		//if it is, then calculate the height needed for wrapped cell
		//by splitting the text to fit the cell width
		//then count how many lines are needed for the text to fit the cell
		
		$textLength=strlen($data2);	//total text length
		$errMargin=5;		//cell width error margin, just in case
		$startChar=0;		//character start position for each line
		$maxChar=0;			//maximum character in a line, to be incremented later
		$textArray=array();	//to hold the strings for each line
		$tmpString="";		//to hold the string for a line (temporary)
		
		while($startChar < $textLength){ //loop until end of text
			//loop until maximum character reached
			while( 
			$pdf->GetStringWidth( $tmpString ) < ($cellWidth-$errMargin) && ($startChar+$maxChar) < $textLength ) {
				$maxChar++;
				$tmpString=substr($data2,$startChar,$maxChar);
			}
			//move startChar to next line
			$startChar=$startChar+$maxChar;
			//then add it into the array so we know how many line are needed
			array_push($textArray,$tmpString);
			//reset maxChar and tmpString
			$maxChar=0;
			$tmpString='';
			
		}
		//get number of line
		$line=count($textArray);
	}
	
	//write the cells
	
	
	//use MultiCell instead of Cell
	//but first, because MultiCell is always treated as line ending, we need to 
	//manually set the xy position for the next cell to be next to it.
	//remember the x and y position before writing the multicell
	$pdf->MultiCell($cellWidth,$cellHeight,$data2,'');
	
	//return the position for next cell next to the multicell
	//and offset the x with multicell width
}

//get Data from the database 
$tt = 0;
$k = 1;
$l=0;
$i=0;
$total=9;
// Instanciation of inherited class
  $pdf = new PDF();
  $pdf->AliasNbPages();
  $pdf->AddPage();

  $image_file ='../images/logo.png';
  
// Set font
  $pdf->SetFont('Arial', 'B', 13);
// Title
  $pdf->SetX(85);
  $pdf->Cell(60, 10, "ZIMBABWE POWER COMPANY", '', 0, 'C');
  $pdf->Ln(5);
  $pdf->SetX(85);
  $pdf->SetFont('Arial', 'B', 10);
	$pdf->Cell(60, 10, "TOOL MANAGEMENT SYSTEM REPORT", '', 0, 'C');
	$pdf->Image($image_file,20,10,30,17);
	$pdf->Ln(); 
	$pdf->SetX(5);
	$pdf->Cell(200, 10, "", 'B', 0, 'C');
	$pdf->Ln(); 
	$pdf->Ln(); 
	$pdf->SetX(2);
	$pdf->headerTable();
	$pdf->Ln(); 

	foreach($_SESSION['result'] as $row){
		$pdf->SetX(2);
		$pdf->setFont('Times','',12);
		$pdf->Cell(15,10,$row['tool_id'],1,0,'C');
		$pdf->Cell(30,10,$row['department_code'],1,0,'C');
		$pdf->Cell(30,10,$row['user_id'],1,0,'C');
		$pdf->Cell(20,10,$row['quantity_borrowed'],1,0,'C');
		$pdf->Cell(25,10,$row['borrow_date'],1,0,'C');
		$pdf->Cell(25,10,$row['return_date'],1,0,'C');
		if($row['actual_date_returned']=='0000-00-00'){
			$pdf->Cell(37,10,'Not Yet',1,0,'C');
		}else{
			$pdf->Cell(37,10,$row['actual_date_returned'],1,0,'C');
		}
		
		$pdf->Cell(25,10,$row['status'],1,0,'C');
		$pdf->Ln(); 
	}
	//$pdf->WriteHTML($_SESSION['results']);
	$pdf->output();
//header('Location:../requests.php');




?>