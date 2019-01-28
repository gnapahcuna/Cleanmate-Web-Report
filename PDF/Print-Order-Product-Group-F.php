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
	$this->Cell(190,21,iconv( 'UTF-8','TIS-620','รายงานสรุปยอดรายการออเดอร์ประเภทกลุ่มสินค้า'),0, 'C', 'C');
	$this->Cell(0,7,'',0,1);
	$this->SetFont('AngsanaNew','',16);
	if($getBranch!=""){
		$this->Cell(190,21,iconv( 'UTF-8','TIS-620','สาขา : '.$getBranch),0, 'C', 'C');
		$this->Cell(0,7,'',0,1);
	}
	$this->Cell(190,21,iconv( 'UTF-8','TIS-620','วันที่ : '.$getDate_start.' ถึง '.$getDate_end),0, 'C', 'C');
	$this->Ln();
	
	$this->SetFont('AngsanaNew','',13);
	$this->Cell(8,14,iconv( 'UTF-8','TIS-620','ลำดับ'),1, 'C', 'C',true);
	$this->Cell(18,14,iconv( 'UTF-8','TIS-620','ประเภทสาขา'),'1','C','C',true);
	$this->Cell(12,14,iconv( 'UTF-8','TIS-620','รหัสร้าน'),1,'C','C',true);
	$this->Cell(28,14,iconv( 'UTF-8','TIS-620','ชื่อร้าน'),1,'C','C',true);
	$this->Cell(105,7,iconv( 'UTF-8','TIS-620','จำนวน(ชิ้น)'),1,'C','C',true);
	$this->Cell(19,14,iconv( 'UTF-8','TIS-620','รวมจำนวน'),1,'C','C',true);
	
	
	$this->Cell(0,7,'',0,1);
	$this->Cell(8,7,'',0);
	$this->Cell(18,7,'',0);
	$this->Cell(12,7,'',0);
	$this->Cell(28,7,'',0);
	$this->Cell(15,7,iconv( 'UTF-8','TIS-620','เสื้อผ้าบุรุษ'),1,'C','C',true);
	$this->Cell(15,7,iconv( 'UTF-8','TIS-620','เสื้อผ้าสตรี'),1,'C','C',true);
	$this->Cell(15,7,iconv( 'UTF-8','TIS-620','รองเท้า'),1,'C','C',true);
	$this->Cell(15,7,iconv( 'UTF-8','TIS-620','กระเป๋า'),1,'C','C',true);
	$this->Cell(15,7,iconv( 'UTF-8','TIS-620','เครื่องนอน'),1,'C','C',true);
	$this->Cell(15,7,iconv( 'UTF-8','TIS-620','พรม ผ้าม่าน'),1,'C','C',true);
	$this->Cell(15,7,iconv( 'UTF-8','TIS-620','อื่นๆ'),1,'C','C',true);
	$this->Ln();
	$j=0;
	
	$data1=0;	
		
   	foreach ($data as $eachResult) 
	{
		
		$this->SetFont('AngsanaNew','',13);
		$this->Cell(8,6,number_format($j+1),1,'C','C');
		$this->Cell(18,6,iconv( 'UTF-8','TIS-620',$eachResult["BranchTypeNameTH"]),1,'C','C');
		$this->Cell(12,6,iconv( 'UTF-8','TIS-620',$eachResult["BranchCode"]),1,'C','C');
		$this->Cell(28,6,iconv( 'UTF-8','TIS-620',$eachResult["BranchNameTH"]),1,'C','C');
		if($eachResult["service1"]!=0){
			$this->Cell(15,6,number_format($eachResult["service1"]),1,'C','C');
		}else{
			$this->Cell(15,6,'-',1,'C','C');
		}if($eachResult["service2"]!=0){
			$this->Cell(15,6,number_format($eachResult["service2"]),1,'C','C');
		}else{
			$this->Cell(15,6,'-',1,'C','C');
		}if($eachResult["service3"]!=0){
			$this->Cell(15,6,number_format($eachResult["service3"]),1,'C','C');
		}else{
			$this->Cell(15,6,'-',1,'C','C');
		}if($eachResult["service4"]!=0){
			$this->Cell(15,6,number_format($eachResult["service4"]),1,'C','C');
		}else{
			$this->Cell(15,6,'-',1,'C','C');
		}if($eachResult["service5"]!=0){
			$this->Cell(15,6,number_format($eachResult["service5"]),1,'C','C');
		}else{
			$this->Cell(15,6,'-',1,'C','C');
		}if($eachResult["service6"]!=0){
			$this->Cell(15,6,number_format($eachResult["service6"]),1,'C','C');
		}else{
			$this->Cell(15,6,'-',1,'C','C');
		}if($eachResult["service7"]!=0){
			$this->Cell(15,6,number_format($eachResult["service7"]),1,'C','C');
		}else{
			$this->Cell(15,6,'-',1,'C','C');
		}
		if($eachResult["total"]!=0){
			$this->Cell(19,6,number_format($eachResult["total"]),1,'C','C');
		}else{
			$this->Cell(19,6,'-',1,'C','C');
		}
		$data1=$data1+$eachResult["service1"];
		$data2=$data2+$eachResult["service2"];
		$data3=$data3+$eachResult["service3"];
		$data4=$data4+$eachResult["service4"];
		$data5=$data5+$eachResult["service5"];
		$data6=$data6+$eachResult["service6"];
		$data7=$data7+$eachResult["service7"];
		$data8=$data8+$eachResult["total"];
		
		$j++;
		if($j==sizeof($data)){
			$this->Ln();
		
			$this->Cell(66,7,iconv( 'UTF-8','TIS-620','รวม'),1,'C','C',true);
			if($data1!=0){
				$this->Cell(15,7,iconv( 'UTF-8','TIS-620',number_format($data1)),1,'C','C',true);
			}else{
				$this->Cell(15,7,iconv( 'UTF-8','TIS-620','-'),1,'C','C',true);
			}
			if($data2!=0){
				$this->Cell(15,7,iconv( 'UTF-8','TIS-620',number_format($data2)),1,'C','C',true);
			}else{
				$this->Cell(15,7,iconv( 'UTF-8','TIS-620','-'),1,'C','C',true);
			}
			if($data3!=0){
				$this->Cell(15,7,iconv( 'UTF-8','TIS-620',number_format($data3)),1,'C','C',true);
			}else{
				$this->Cell(15,7,iconv( 'UTF-8','TIS-620','-'),1,'C','C',true);
			}
			if($data4!=0){
				$this->Cell(15,7,iconv( 'UTF-8','TIS-620',number_format($data4)),1,'C','C',true);
			}else{
				$this->Cell(15,7,iconv( 'UTF-8','TIS-620','-'),1,'C','C',true);
			}
			if($data5!=0){
				$this->Cell(15,7,iconv( 'UTF-8','TIS-620',number_format($data5)),1,'C','C',true);
			}else{
				$this->Cell(15,7,iconv( 'UTF-8','TIS-620','-'),1,'C','C',true);
			}
			if($data6!=0){
				$this->Cell(15,7,iconv( 'UTF-8','TIS-620',number_format($data6)),1,'C','C',true);
			}else{
				$this->Cell(15,7,iconv( 'UTF-8','TIS-620','-'),1,'C','C',true);
			}
			if($data7!=0){
				$this->Cell(15,7,iconv( 'UTF-8','TIS-620',number_format($data7)),1,'C','C',true);
			}else{
				$this->Cell(15,7,iconv( 'UTF-8','TIS-620','-'),1,'C','C',true);
			}
			if($data8!=0){
				$this->Cell(19,7,iconv( 'UTF-8','TIS-620',number_format($data8)),1,'C','C',true);
			}else{
				$this->Cell(19,7,iconv( 'UTF-8','TIS-620','-'),1,'C','C',true);
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
		
		echo $resultData[0]['BranchNameTH'].",".$getDate_start.",".$getDate_end;
		
		$dates=date('Y-m-d');
		
		$header=array('ลำดับ','วันที่','เลขที่บิล','ซักแห้ง','ซักน้ำ','สปาหนัง','รีด','');

		$pdf=new PDF();
		$pdf->AddPage();
		$pdf->AliasNbPages();
		$pdf->AddFont('AngsanaNew','','angsa.php');
		$pdf->AddFont('AngsanaNew','B','angsab.php');
		$pdf->SetFont('AngsanaNew','',12);
		$pdf->BasicTable($header,$resultData,$getDate_start,$getDate_end,$getBranch);
		$pdf->Output("MyPDF/File-Order-Product-Group-F.pdf","F");
		//header("Location: MyPDF/File-Invoice.pdf");
		
?>