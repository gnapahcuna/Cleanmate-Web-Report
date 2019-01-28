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
	$this->Cell(190,21,iconv( 'UTF-8','TIS-620','รายงานสรุปยอดขายแยกตามทุกรายการสินค้า'),0, 'C', 'C');
	$this->Cell(0,7,'',0,1);
	$this->SetFont('AngsanaNew','',16);
	if($getBranch!=""){
		$this->Cell(190,21,iconv( 'UTF-8','TIS-620','สาขา : '.$getBranch),0, 'C', 'C');
		$this->Cell(0,7,'',0,1);
	}
	$this->Cell(190,21,iconv( 'UTF-8','TIS-620','วันที่ : '.$getDate_start.' ถึง '.$getDate_end),0, 'C', 'C');
	$this->Ln();
	
	$this->SetFont('AngsanaNew','',13);
	$this->Cell(10,14,iconv( 'UTF-8','TIS-620','ลำดับ'),1, 'C', 'C',true);
	$this->Cell(38,14,iconv( 'UTF-8','TIS-620','รายการสินค้า'),'1','C','C',true);
    $this->Cell(114,7,iconv( 'UTF-8','TIS-620','ประเภทร้าน'),1,'C','C',true);
    $this->Cell(28,14,iconv( 'UTF-8','TIS-620','รวมจำนวนชิ้น'),1,'C','C',true);
    $this->Cell(0,7,'',0,1);

    $this->Cell(48,7,'',0);
	$this->Cell(38,7,iconv( 'UTF-8','TIS-620','คลีนเมท (Cleanmate)'),1,'C','C',true);
	$this->Cell(38,7,iconv( 'UTF-8','TIS-620','แฟรนไชส์ (Franchise )'),1,'C','C',true);
	$this->Cell(38,7,iconv( 'UTF-8','TIS-620','เซเว่นอีเลฟเฟ่น (7-Eleven)'),1,'C','C',true);
    
	$this->Ln();
	
	$j=0;
	
	$data1=0;	
		
   	foreach ($data as $eachResult) 
	{
		
		$this->SetFont('AngsanaNew','',13);
		$this->Cell(10,6,number_format($j+1),1,'C','C');
		$this->Cell(38,6,iconv( 'UTF-8','TIS-620',$eachResult["ProductNameTH"]),1,'C','C');
		
		if($eachResult["service1"]!=0){
			$this->Cell(38,6,number_format($eachResult["service1"]),1,'C','C');
		}else{
			$this->Cell(38,6,'-',1,'C','C');
		}if($eachResult["service2"]!=0){
			$this->Cell(38,6,number_format($eachResult["service2"]),1,'C','C');
		}else{
			$this->Cell(38,6,'-',1,'C','C');
		}if($eachResult["service3"]!=0){
			$this->Cell(38,6,number_format($eachResult["service3"]),1,'C','C');
		}else{
			$this->Cell(38,6,'-',1,'C','C');
		}if(($eachResult["service1"]+$eachResult["service2"]+$eachResult["service3"])!=0){
			$this->Cell(28,6,number_format($eachResult["service1"]+$eachResult["service2"]+$eachResult["service3"]),1,'C','C');
		}else{
			$this->Cell(28,6,'-',1,'C','C');
		}
		
		$data1=$data1+$eachResult["service1"];
		$data2=$data2+$eachResult["service2"];
        $data3=$data3+$eachResult["service3"];
        $data4=$data4+$eachResult["service1"]+$eachResult["service2"]+$eachResult["service3"];
		
		$j++;
		if($j==sizeof($data)){
			$this->Ln();
		
			$this->Cell(48,7,iconv( 'UTF-8','TIS-620','รวม'),1,'C','C',true);
			if($data1!=0){
				$this->Cell(38,7,iconv( 'UTF-8','TIS-620',number_format($data1)),1,'C','C',true);
			}else{
				$this->Cell(38,7,iconv( 'UTF-8','TIS-620','-'),1,'C','C',true);
			}
			if($data2!=0){
				$this->Cell(38,7,iconv( 'UTF-8','TIS-620',number_format($data2)),1,'C','C',true);
			}else{
				$this->Cell(38,7,iconv( 'UTF-8','TIS-620','-'),1,'C','C',true);
			}
			if($data3!=0){
				$this->Cell(38,7,iconv( 'UTF-8','TIS-620',number_format($data3)),1,'C','C',true);
			}else{
				$this->Cell(38,7,iconv( 'UTF-8','TIS-620','-'),1,'C','C',true);
            }
            if($data4!=0){
				$this->Cell(28,7,iconv( 'UTF-8','TIS-620',number_format($data4)),1,'C','C',true);
			}else{
				$this->Cell(28,7,iconv( 'UTF-8','TIS-620','-'),1,'C','C',true);
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
		$pdf->Output("MyPDF/File-Summary-All-Product-F.pdf","F");
		//header("Location: MyPDF/File-Invoice.pdf");
		
?>