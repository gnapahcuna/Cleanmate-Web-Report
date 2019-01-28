<?php
require('fpdf_thai.php');
define('FPDF_FONTPATH','font/');
class PDF extends FPDF
{
//Load data
function LoadData($file)
{
	//Read file lines
	$lines=file($file);
	$data=array();
	foreach($lines as $line)
		$data[]=explode(';',chop($line));
	return $data;
}
function DateThai($strDate)
	{
		$strYear = date("Y",strtotime($strDate))+543;
		$strMonth= date("n",strtotime($strDate));
		$strDay= date("j",strtotime($strDate));
		$strHour= date("H",strtotime($strDate));
		$strMinute= date("i",strtotime($strDate));
		$strSeconds= date("s",strtotime($strDate));
		$strMonthCut = Array("","มกราคม","กุมภาพันธ์","มีนาคม","เมษายน","พฤษภาคม","มิถุนายน","กรกฎาคม","สิงหาคม","กันยายน","ตุลาคม","พฤศจิกายน","ธันวาคม");
		$strMonthThai=$strMonthCut[$strMonth];
		return "$strMonthThai";
	}
function DateThai1($strDate)
	{
		$strYear = date("Y",strtotime($strDate))+543;
		$strMonth= date("n",strtotime($strDate));
		$strDay= date("j",strtotime($strDate));
		$strHour= date("H",strtotime($strDate));
		$strMinute= date("i",strtotime($strDate));
		$strSeconds= date("s",strtotime($strDate));
		$strMonthCut = Array("","มกราคม","กุมภาพันธ์","มีนาคม","เมษายน","พฤษภาคม","มิถุนายน","กรกฎาคม","สิงหาคม","กันยายน","ตุลาคม","พฤศจิกายน","ธันวาคม");
		$strMonthThai=$strMonthCut[$strMonth];
		return "$strDay $strMonthThai $strYear";
	}

//Simple table
function BasicTable($header,$data,$getDate_start,$getDate_end,$getBranch)
{
	//Header
	$this->SetFillColor(204, 204, 204);
	$this->SetFont('AngsanaNew','B',18);
	$this->Cell(190,21,iconv( 'UTF-8','TIS-620','รายงานสรุปยอดขายรวมทุกประเภท'),0, 'C', 'C');
	$this->Cell(0,7,'',0,1);
	$this->SetFont('AngsanaNew','',16);
	if($getBranch!=""){
		$this->Cell(190,21,iconv( 'UTF-8','TIS-620','สาขา : '.$getBranch),0, 'C', 'C');
		$this->Cell(0,7,'',0,1);
	}
	$this->Cell(190,21,iconv( 'UTF-8','TIS-620','วันที่ : '.$getDate_start.' ถึง '.$getDate_end),0, 'C', 'C');
	$this->Ln();
	
	$this->SetFont('AngsanaNew','',13);
	$this->Cell(14,7,iconv( 'UTF-8','TIS-620','ลำดับ'),1, 'C', 'C',true);
	$this->Cell(28,7,iconv( 'UTF-8','TIS-620','ประเภทร้าน'),'1','C','C',true);
	$this->Cell(18,7,iconv( 'UTF-8','TIS-620','รหัสร้าน'),1,'C','C',true);
	$this->Cell(38,7,iconv( 'UTF-8','TIS-620','ชื่อร้าน'),1,'C','C',true);
	$this->Cell(28,7,iconv( 'UTF-8','TIS-620','จำนวนเงิน'),1,'C','C',true);
	$this->Cell(28,7,iconv( 'UTF-8','TIS-620','ส่วนลดโดยร้าน'),1,'C','C',true);
	$this->Cell(36,7,iconv( 'UTF-8','TIS-620','จำนวนเงินสุทธิ'),1,'C','C',true);
	$this->Ln();
	
	$j=0;
	
	$data1=0;	
		
   	foreach ($data as $eachResult) 
	{
		
		$this->SetFont('AngsanaNew','',13);
		$this->Cell(14,6,number_format($j+1),1,'C','C');
		$this->Cell(28,6,iconv( 'UTF-8','TIS-620',$eachResult["BranchType"]),1,'C','C');
        $this->Cell(18,6,iconv( 'UTF-8','TIS-620',$eachResult["BranchID"]),1,'C','C');
        $this->Cell(38,6,iconv( 'UTF-8','TIS-620',$eachResult["BranchNameTH"]),1,'C','C');
		
		if($eachResult["Total"]!=0){
			$this->Cell(28,6,number_format($eachResult["Total"],2),1,'C','C');
		}else{
			$this->Cell(28,6,'-',1,'C','C');
		}if($eachResult["Specail"]!=0){
			$this->Cell(18,6,number_format($eachResult["Specail"],2),1,'C','C');
		}else{
			$this->Cell(28,6,'-',1,'C','C');
		}if($eachResult["Total1"]!=0){
			$this->Cell(36,6,number_format($eachResult["Total1"],2),1,'C','C');
		}else{
			$this->Cell(36,6,'-',1,'C','C');
		}
		
		$data1=$data1+$eachResult["Total"];
		$data2=$data2+$eachResult["Specail"];
		$data3=$data3+$eachResult["Total1"];
		
		$j++;
		if($j==sizeof($data)){
			$this->Ln();
		
			$this->Cell(98,7,iconv( 'UTF-8','TIS-620','รวม'),1,'C','C',true);
			if($data1!=0){
				$this->Cell(28,7,iconv( 'UTF-8','TIS-620',number_format($data1,2)),1,'C','C',true);
			}else{
				$this->Cell(28,7,iconv( 'UTF-8','TIS-620','-'),1,'C','C',true);
			}
			if($data2!=0){
				$this->Cell(28,7,iconv( 'UTF-8','TIS-620',number_format($data2,2)),1,'C','C',true);
			}else{
				$this->Cell(28,7,iconv( 'UTF-8','TIS-620','-'),1,'C','C',true);
			}
			if($data3!=0){
				$this->Cell(36,7,iconv( 'UTF-8','TIS-620',number_format($data3,2)),1,'C','C',true);
			}else{
				$this->Cell(36,7,iconv( 'UTF-8','TIS-620','-'),1,'C','C',true);
			}
			$this->Ln();
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

		$resultData = json_decode($_POST['resultData'], TRUE);
		$getDate_start= $_POST['date_start'];
		$getDate_end = $_POST['date_end'];
		$getBranch = $_POST['branch'];
		
		echo $getBranch.",".$getDate_start.",".$getDate_end;
		
		$dates=date('Y-m-d');
		
		$header=array('ลำดับ','วันที่','เลขที่บิล','ซักแห้ง','ซักน้ำ','สปาหนัง','รีด','');

		$pdf=new PDF();
		$pdf->AddPage();
		$pdf->AliasNbPages();
		$pdf->AddFont('AngsanaNew','','angsa.php');
		$pdf->AddFont('AngsanaNew','B','angsab.php');
		$pdf->SetFont('AngsanaNew','',12);
		$pdf->BasicTable($header,$resultData,$getDate_start,$getDate_end,$getBranch);
		$pdf->Output("MyPDF/File-Summary-All-F.pdf","F");
		//header("Location: MyPDF/File-Invoice.pdf");
		
?>