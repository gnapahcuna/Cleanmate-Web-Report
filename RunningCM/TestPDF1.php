<?php
require('fpdf.php');
define('FPDF_FONTPATH','font/');

class PDF extends FPDF
{
// Load data
function LoadData($file)
{
    // Read file lines
    $lines = file($file);
    $data = array();
    foreach($lines as $line)
        $data[] = explode(';',trim($line));
    return $data;
}

// Simple table
function BasicTable($header, $data)
{
	$this->SetFillColor(209, 209, 224);
    // Header
	$i=0;  
	$this->AddFont('angsa','','angsa.php');
	$this->SetFont('angsa','',18);
	$this->Cell(190,21,iconv( 'UTF-8','TIS-620','ประจำวันที่ : 2018-09-04'),0, 'C', 'C');
	$this->Cell(0,7,'',0,1);
	$this->Cell(190,21,iconv( 'UTF-8','TIS-620','สาขา : บิ๊กซีพระราม 4 '),0, 'C', 'C');
	$this->Ln();
	
	$this->AddFont('angsa','','angsa.php');
	$this->SetFont('angsa','',14);
	$this->Cell(8,21,iconv( 'UTF-8','TIS-620','ลำดับ'),1, 'C', 'C',true);
	$this->Cell(17,21,iconv( 'UTF-8','TIS-620','วันที่'),'1','C','C',true);
	$this->Cell(18,21,iconv( 'UTF-8','TIS-620','เลขที่บิล'),1,'C','C',true);
	$this->Cell(92,7,iconv( 'UTF-8','TIS-620','จำนวน(ชิ้น)/จำนวน(บาท)'),1,'C','C',true);
	$this->Cell(9,21,iconv( 'UTF-8','TIS-620','คูปอง'),1,'C','C',true);
	$this->Cell(14,21,iconv( 'UTF-8','TIS-620','โปรโมชั่น'),1,'C','C',true);
	$this->Cell(14,21,iconv( 'UTF-8','TIS-620','จำนวนเงิน'),1,'C','C',true);
	$this->Cell(18,21,iconv( 'UTF-8','TIS-620','สถานะ'),1,'C','C',true);
	
	
	$this->Cell(0,7,'',0,1);
	$this->Cell(8,7,'',0);
	$this->Cell(17,7,'',0);
	$this->Cell(18,7,'',0);
	$this->Cell(23,7,iconv( 'UTF-8','TIS-620','ซักแห้ง'),1,'C','C',true);
	$this->Cell(23,7,iconv( 'UTF-8','TIS-620','ซักน้ำ'),1,'C','C',true);
	$this->Cell(23,7,iconv( 'UTF-8','TIS-620','สปาเครื่องหนัง'),1,'C','C',true);
	$this->Cell(23,7,iconv( 'UTF-8','TIS-620','รีด'),1,'C','C',true);
	$this->Cell(0,7,'',0,1);
	
	
	$this->Cell(8,7,'',0);
	$this->Cell(17,7,'',0);
	$this->Cell(18,7,'',0);
	$this->Cell(9,7,iconv( 'UTF-8','TIS-620','ชิ้น'),1,'C','C',true);
	$this->Cell(14,7,iconv( 'UTF-8','TIS-620','บาท'),1,'C','C',true);
	$this->Cell(9,7,iconv( 'UTF-8','TIS-620','ชิ้น'),1,'C','C',true);
	$this->Cell(14,7,iconv( 'UTF-8','TIS-620','บาท'),1,'C','C',true);
	$this->Cell(9,7,iconv( 'UTF-8','TIS-620','ชิ้น'),1,'C','C',true);
	$this->Cell(14,7,iconv( 'UTF-8','TIS-620','บาท'),1,'C','C',true);
	$this->Cell(9,7,iconv( 'UTF-8','TIS-620','ชิ้น'),1,'C','C',true);
	$this->Cell(14,7,iconv( 'UTF-8','TIS-620','บาท'),1,'C','C',true);
	
	$this->Ln();
    // Data
	$j=0;
    foreach($data as $row)
    {
		$j++;
		$w = array(8, 17, 18, 9,14,9,14,9,14,9,14,9,14,14,18);
		$i=0;
		$data1=0;
		$data2=0;
		$data3=0;
		$data4=0;
		$data5=0;
		
		$data6=0;
		$data7=0;
		$data8=0;
		$data9=0;
		$data10=0;
		$data11=0;
        foreach($row as $col){
			if($i<=3||$i==5||$i==7||$i==9||$i==11||$i==14){
				$data1=$data1+$row[3];
				$data2=$data1+$row[5];
				$data3=$data1+$row[7];
				$data4=$data1+$row[9];
				$data5=$data1+$row[11];
				$this->Cell($w[$i],6,iconv( 'UTF-8','TIS-620',$col),1,'C','C');
			}else if($i==4||$i==6||$i==8||$i==10||$i==12||$i==13){
				$data6=$data1+$row[4];
				$data7=$data1+$row[6];
				$data8=$data1+$row[8];
				$data9=$data1+$row[10];
				$data10=$data1+$row[12];
				$data11=$data1+$row[13];
				$this->Cell($w[$i],6,iconv( 'UTF-8','TIS-620',number_format($col,2)),1,'R','R');
			}else{
				$this->Cell($w[$i],6,iconv( 'UTF-8','TIS-620',$col),1);
			}
            
			$i++;
		}
		if($j==sizeof($data)){
			$this->Ln();
			
			$this->Cell(43,7,iconv( 'UTF-8','TIS-620','รวม'),1,'C','C',true);
			$this->Cell(9,7,iconv( 'UTF-8','TIS-620',number_format($data1)),1,'C','C',true);
			$this->Cell(14,7,iconv( 'UTF-8','TIS-620',number_format($data6)),1,'R','R',true);
			$this->Cell(9,7,iconv( 'UTF-8','TIS-620',number_format($data2)),1,'C','C',true);
			$this->Cell(14,7,iconv( 'UTF-8','TIS-620',number_format($data7)),1,'R','R',true);
			$this->Cell(9,7,iconv( 'UTF-8','TIS-620',number_format($data3)),1,'C','C',true);
			$this->Cell(14,7,iconv( 'UTF-8','TIS-620',number_format($data8)),1,'R','R',true);
			$this->Cell(9,7,iconv( 'UTF-8','TIS-620',number_format($data4)),1,'C','C',true);
			$this->Cell(14,7,iconv( 'UTF-8','TIS-620',number_format($data9)),1,'R','R',true);
			$this->Cell(9,7,iconv( 'UTF-8','TIS-620',number_format($data5)),1,'C','C',true);
			$this->Cell(14,7,iconv( 'UTF-8','TIS-620',number_format($data10)),1,'R','R',true);
			$this->Cell(14,7,iconv( 'UTF-8','TIS-620',number_format($data11)),1,'R','R',true);
			$this->Cell(18,7,iconv( 'UTF-8','TIS-620',''),1,'C','C',true);
		}
        $this->Ln();
    }
}
function Footer()
{
    $this->SetY(-15);
    $this->Cell(0,10,'Page '.$this->PageNo().'/{nb}',0,0,'C');
}
}
$pdf = new PDF();
// Column headings
$header=array('ลำดับ','วันที่','เลขที่บิล','ซักแห้ง','ซักน้ำ','สปาเครื่องหนัง','รีด','');
// Data loading
$data = $pdf->LoadData('countries.txt');
$pdf->AddPage();
$pdf->AliasNbPages();
$pdf->AddFont('angsa','','angsa.php');
$pdf->SetFont('angsa','',14);
$pdf->BasicTable($header,$data);
$pdf->Output();
?>