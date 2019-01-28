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
	$this->Cell(190,21,iconv( 'UTF-8','TIS-620','รายงานสรุปยอดรายการออเดอร์ทุกรายการสินค้า'),0, 'C', 'C');
	$this->Cell(0,7,'',0,1);
	$this->SetFont('AngsanaNew','',16);
	if($getBranch!=""){
		$this->Cell(190,21,iconv( 'UTF-8','TIS-620','สาขา : '.$getBranch),0, 'C', 'C');
		$this->Cell(0,7,'',0,1);
	}
	$this->Cell(190,21,iconv( 'UTF-8','TIS-620','วันที่ : '.$getDate_start.' ถึง '.$getDate_end),0, 'C', 'C');
	$this->Ln();
	
	$this->SetFont('AngsanaNew','',13);
	$this->Cell(8,21,iconv( 'UTF-8','TIS-620','ลำดับ'),1, 'C', 'C',true);
	$this->Cell(17,21,iconv( 'UTF-8','TIS-620','วันที่'),'1','C','C',true);
	$this->Cell(18,21,iconv( 'UTF-8','TIS-620','เลขที่บิล'),1,'C','C',true);
	$this->Cell(86,7,iconv( 'UTF-8','TIS-620','จำนวน(ชิ้น)/จำนวน(บาท)'),1,'C','C',true);
	$this->Cell(18,21,iconv( 'UTF-8','TIS-620','คูปอง'),1,'C','C',true);
	$this->Cell(30,21,iconv( 'UTF-8','TIS-620','ส่วนลด'),1,'C','C',true);
	$this->Cell(18,21,iconv( 'UTF-8','TIS-620','จำนวนเงิน'),1,'C','C',true);
	
	
	$this->Cell(0,7,'',0,1);
	$this->Cell(8,7,'',0);
	$this->Cell(17,7,'',0);
	$this->Cell(18,7,'',0);
	$this->Cell(17.2,7,iconv( 'UTF-8','TIS-620','ซักแห้ง'),1,'C','C',true);
	$this->Cell(17.2,7,iconv( 'UTF-8','TIS-620','ซักน้ำ'),1,'C','C',true);
	$this->Cell(17.2,7,iconv( 'UTF-8','TIS-620','สปาหนัง'),1,'C','C',true);
	$this->Cell(17.2,7,iconv( 'UTF-8','TIS-620','รีด'),1,'C','C',true);
	$this->Cell(17.2,7,iconv( 'UTF-8','TIS-620','คูปองเล่ม'),1,'C','C',true);
	$this->Cell(0,7,'',0,1);
	
	
	$this->Cell(8,7,'',0);
	$this->Cell(17,7,'',0);
	$this->Cell(18,7,'',0);
	$this->Cell(7.4,7,iconv( 'UTF-8','TIS-620','ชิ้น'),1,'C','C',true);
	$this->Cell(9.8,7,iconv( 'UTF-8','TIS-620','บาท'),1,'C','C',true);
	$this->Cell(7.4,7,iconv( 'UTF-8','TIS-620','ชิ้น'),1,'C','C',true);
	$this->Cell(9.8,7,iconv( 'UTF-8','TIS-620','บาท'),1,'C','C',true);
	$this->Cell(7.4,7,iconv( 'UTF-8','TIS-620','ชิ้น'),1,'C','C',true);
	$this->Cell(9.8,7,iconv( 'UTF-8','TIS-620','บาท'),1,'C','C',true);
	$this->Cell(7.4,7,iconv( 'UTF-8','TIS-620','ชิ้น'),1,'C','C',true);
	$this->Cell(9.8,7,iconv( 'UTF-8','TIS-620','บาท'),1,'C','C',true);
	$this->Cell(7.4,7,iconv( 'UTF-8','TIS-620','เล่ม'),1,'C','C',true);
	$this->Cell(9.8,7,iconv( 'UTF-8','TIS-620','บาท'),1,'C','C',true);
	$this->Cell(9,7,iconv( 'UTF-8','TIS-620','ซักน้ำ'),1,'C','C',true);
	$this->Cell(9,7,iconv( 'UTF-8','TIS-620','รีด'),1,'C','C',true);
	$this->Cell(10,7,iconv( 'UTF-8','TIS-620','โปรฯ'),1,'C','C',true);
	$this->Cell(10,7,iconv( 'UTF-8','TIS-620','สมาชิก'),1,'C','C',true);
	$this->Cell(10,7,iconv( 'UTF-8','TIS-620','โดยร้าน'),1,'C','C',true);
    
	$this->Ln();
	
	$j=0;
	
	$data1=0;	
		
   	foreach ($data as $eachResult) 
	{
		
		$this->Cell(8,6,number_format($j+1),1,'C','C');
		$this->Cell(17,6,$eachResult["OrderDate"],1,'C','C');
		$this->Cell(18,6,$eachResult["OrderNo"],1,'C','C');
		if($eachResult["CountService1"]!=0){
			$this->Cell(7.4,6,number_format($eachResult["CountService1"]),1,'C','C');
		}else{
			$this->Cell(7.4,6,'-',1,'C','C');
		}
		if($eachResult["SumService1"]!=0){
			$this->Cell(9.8,6,number_format($eachResult["SumService1"]),1,'R','R');
		}else{
			$this->Cell(9.8,6,'-',1,'R','R');
		}
		if($eachResult["CountService2"]!=0){
			$this->Cell(7.4,6,number_format($eachResult["CountService2"]),1,'C','C');
		}else{
			$this->Cell(7.4,6,'-',1,'C','C');
		}
		if($eachResult["SumService2"]!=0){
			$this->Cell(9.8,6,number_format($eachResult["SumService2"]),1,'R','R');
		}else{
			$this->Cell(9.8,6,'-',1,'R','R');
		}
		if($eachResult["CountService3"]!=0){
			$this->Cell(7.4,6,number_format($eachResult["CountService3"]),1,'C','C');
		}else{
			$this->Cell(7.4,6,'-',1,'C','C');
		}
		if($eachResult["SumService3"]!=0){
			$this->Cell(9.8,6,number_format($eachResult["SumService3"]),1,'R','R');
		}else{
			$this->Cell(9.8,6,'-',1,'R','R');
		}
		if($eachResult["CountService4"]!=0){
			$this->Cell(7.4,6,number_format($eachResult["CountService4"]),1,'C','C');
		}else{
			$this->Cell(7.4,6,'-',1,'C','C');
		}
		if($eachResult["SumService4"]!=0){
			$this->Cell(9.8,6,number_format($eachResult["SumService4"]),1,'R','R');
		}else{
			$this->Cell(9.8,6,'-',1,'R','R');
		}
		if($eachResult["CountService5"]!=0){
			$this->Cell(7.4,6,number_format($eachResult["CountService5"]),1,'C','C');
		}else{
			$this->Cell(7.4,6,'-',1,'C','C');
		}
		if($eachResult["SumService5"]!=0){
			$this->Cell(9.8,6,number_format($eachResult["SumService5"]),1,'R','R');
		}else{
			$this->Cell(9.8,6,'-',1,'R','R');
		}
		//coupon1
		if($data2_cp[$j]["CountService6"]!=0){
			$this->Cell(9,6,number_format($data2_cp[$j]["CountService5"]),1,'R','R');
		}else{
			$this->Cell(9,6,'-',1,'R','R');
		}
		//coupon2
		if($data2_cp[$j]["SumService6"]!=0){
			$this->Cell(9,6,number_format($data2_cp[$j]["SumService6"]),1,'R','R');
		}else{
			$this->Cell(9,6,'-',1,'R','R');
		}
		if($eachResult["PromoDiscount"]!=0){
			$this->Cell(10,6,number_format($eachResult["PromoDiscount"]),1,'R','R');
		}else{
			$this->Cell(10,6,'-',1,'R','R');
		}
		if($eachResult["MemberDiscount"]!=0){
			$this->Cell(10,6,number_format($eachResult["MemberDiscount"]),1,'R','R');
		}else{
			$this->Cell(10,6,'-',1,'R','R');
		}
		if($eachResult["SpecialDiscount"]!=0){
			$this->Cell(10,6,number_format($arr_data1[$j]["SpecialDiscount"]),1,'R','R');
		}else{
			$this->Cell(10,6,'-',1,'R','R');
		}
		$this->SetFillColor(204, 204, 204);
		
		
		if($eachResult["total"]!=0){
			$this->Cell(18,6,number_format($eachResult["total"],2),1,'R','R');
		}else{
			$this->Cell(18,6,'-',1,'R','R');
		}
		
		
		$data1=$data1+$eachResult["CountService1"];
		$data2=$data2+$eachResult["SumService1"];
		$data3=$data3+$eachResult["CountService2"];
		$data4=$data4+$eachResult["SumService2"];
		$data5=$data5+$eachResult["CountService3"];
		$data6=$data6+$eachResult["SumService3"];
		$data7=$data7+$eachResult["CountService4"];
		$data8=$data8+$eachResult["SumService4"];
		$data13=$data13+$eachResult["CountService5"];
		$data14=$data14+$eachResult["SumService5"];
		$data9_1=$data9_1+$eachResult["CountService6"];
		$data9_2=$data9_2+$eachResult["SumService6"];
		$data10=$data10+$eachResult["PromoDiscount"];
		$data11=$data11+$eachResult["total"];
		$data12=$data12+$eachResult["MemberDiscount"];
		$dataSpecial=$dataSpecial+$arr_data1[$j]["SpecialDiscount"];
		
		
		$j++;
		if($j==sizeof($data)){
            $this->Ln();
			$this->SetFont('AngsanaNew','',13);
			$this->Cell(43,7,iconv( 'UTF-8','TIS-620','รวม'),1,'C','C',true);
			if($data1!=0){
				$this->Cell(7.4,7,iconv( 'UTF-8','TIS-620',number_format($data1)),1,'C','C',true);
			}else{
				$this->Cell(7.4,7,iconv( 'UTF-8','TIS-620','-'),1,'C','C',true);
			}
			if($data2!=0){
				$this->Cell(9.8,7,iconv( 'UTF-8','TIS-620',number_format($data2)),1,'R','R',true);
			}else{
				$this->Cell(9.8,7,iconv( 'UTF-8','TIS-620','-'),1,'R','R',true);
			}
			if($data3!=0){
				$this->Cell(7.4,7,iconv( 'UTF-8','TIS-620',number_format($data3)),1,'C','C',true);
			}else{
				$this->Cell(7.4,7,iconv( 'UTF-8','TIS-620','-'),1,'C','C',true);
			}
			if($data4!=0){
				$this->Cell(9.8,7,iconv( 'UTF-8','TIS-620',number_format($data4)),1,'R','R',true);
			}else{
				$this->Cell(9.8,7,iconv( 'UTF-8','TIS-620','-'),1,'R','R',true);
			}
			if($data5!=0){
				$this->Cell(7.4,7,iconv( 'UTF-8','TIS-620',number_format($data5)),1,'C','C',true);
			}else{
				$this->Cell(7.4,7,iconv( 'UTF-8','TIS-620','-'),1,'C','C',true);
			}
			if($data6!=0){
				$this->Cell(9.8,7,iconv( 'UTF-8','TIS-620',number_format($data6)),1,'R','R',true);
			}else{
				$this->Cell(9.8,7,iconv( 'UTF-8','TIS-620','-'),1,'R','R',true);
			}
			if($data7!=0){
				$this->Cell(7.4,7,iconv( 'UTF-8','TIS-620',number_format($data7)),1,'C','C',true);
			}else{
				$this->Cell(7.4,7,iconv( 'UTF-8','TIS-620','-'),1,'C','C',true);
			}
			if($data8!=0){
				$this->Cell(9.8,7,iconv( 'UTF-8','TIS-620',number_format($data8)),1,'R','R',true);
			}else{
				$this->Cell(9.8,7,iconv( 'UTF-8','TIS-620','-'),1,'R','R',true);
			}
		
			
			if($data13!=0){
				$this->Cell(7.4,7,iconv( 'UTF-8','TIS-620',number_format($data13)),1,'C','C',true);
			}else{
				$this->Cell(7.4,7,iconv( 'UTF-8','TIS-620','-'),1,'C','C',true);
			}
			if($data14!=0){
				$this->Cell(9.8,7,iconv( 'UTF-8','TIS-620',number_format($data14)),1,'C','C',true);
			}else{
				$this->Cell(9.8,7,iconv( 'UTF-8','TIS-620','-'),1,'C','C',true);
			}
			//$this->Cell(10,7,iconv( 'UTF-8','TIS-620','33'),1,'R','R',true);
			
			//coupon
			if($data9_1!=0){
				$this->Cell(9,7,iconv( 'UTF-8','TIS-620',number_format($data9_1)),1,'R','R',true);
			}else{
				$this->Cell(9,7,iconv( 'UTF-8','TIS-620','-'),1,'R','R',true);
			}
			if($data9_2!=0){
				$this->Cell(9,7,iconv( 'UTF-8','TIS-620',number_format($data9_2)),1,'R','R',true);
			}else{
				$this->Cell(9,7,iconv( 'UTF-8','TIS-620','-'),1,'R','R',true);
			}
			if($data10!=0){
				$this->Cell(10,7,iconv( 'UTF-8','TIS-620',number_format($data10)),1,'R','R',true);
			}else{
				$this->Cell(10,7,iconv( 'UTF-8','TIS-620','-'),1,'R','R',true);
			}
			if($data12!=0){
				$this->Cell(10,7,iconv( 'UTF-8','TIS-620',number_format($data12)),1,'R','R',true);
			}else{
				$this->Cell(10,7,iconv( 'UTF-8','TIS-620','-'),1,'R','R',true);
			}
			if($dataSpecial!=0){
				$this->Cell(10,7,iconv( 'UTF-8','TIS-620',number_format($dataSpecial)),1,'R','R',true);
			}else{
				$this->Cell(10,7,iconv( 'UTF-8','TIS-620','-'),1,'R','R',true);
			}
			$this->SetFont('AngsanaNew','',13);
			$this->Cell(18,7,iconv( 'UTF-8','TIS-620',number_format($data11,2)),1,'R','R',true);
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
		$pdf->Output("MyPDF/File-Branch-CM-Bill.pdf","F");
		//header("Location: MyPDF/File-Invoice.pdf");
		
?>