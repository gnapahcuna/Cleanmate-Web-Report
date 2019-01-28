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
function BasicTable($header,$data,$arr_data1,$data2_cp,$dates,$branchName,$branchCode,$branchType,$getTop,$branchTel,$branchAddress,$data3_sp,$dataRev,$branchContact,$getEmail)
{
	//Header
	$this->Image('logo.png',20,12,63);
	$this->SetFont('AngsanaNew','',50);
	$this->SetTextColor(204, 204, 204);
	$this->Cell(170,21,iconv( 'UTF-8','TIS-620','Invoice'),0, 'R', 'R');
	$this->Cell(20,21,'',0);
	$this->Cell(0,7,'',0,1);
	
	$this->SetTextColor('');
	$this->SetFillColor(242, 242, 242);
	$this->SetFont('AngsanaNew','',18);
	$this->Cell(10,21,'',0);
	$this->Cell(180,21,iconv( 'UTF-8','TIS-620','CLEANMATE SERVICE CO.,LTD.'),0, 'L', 'L');
	$this->Cell(0,7,'',0,1);
	
	$this->SetFont('AngsanaNew','',16);
	$this->Cell(10,21,'',0);
	$this->Cell(180,21,iconv( 'UTF-8','TIS-620','บริษัท คลีนเมท เซอร์วิส จำกัด'),0, 'L', 'L');
	$this->Cell(0,5,'',0,1);

	$this->SetFont('AngsanaNew','',14);
	$this->Cell(10,21,'',0);
	$this->Cell(180,21,iconv( 'UTF-8','TIS-620','341 ซอยพิบูลย์อุปถัมภ์ (ลาดพร้าว 48)'),0, 'L', 'L');
	$this->Cell(0,5,'',0,1);
	$this->Cell(10,21,'',0);
	$this->Cell(180,21,iconv( 'UTF-8','TIS-620','แขวงสามเสนนอก เขตห้วยขวาง กรุงเทพฯ 10130'),0, 'L', 'L');
	$this->Cell(0,5,'',0,1);
	$this->Cell(10,21,'',0);
	$this->Cell(180,21,iconv( 'UTF-8','TIS-620','โทรศัพท์/Fax: 0-2930-4971'),0, 'L', 'L');
	$this->Cell(0,14,'',0,1);
	
	$this->SetFont('AngsanaNew','',16);
	$this->Cell(10,21,'',0);
	$this->Cell(14,21,iconv( 'UTF-8','TIS-620','ถึง.'),0, 'L', 'L');
	$this->Cell(0,7,'',0,1);
	$this->Cell(10,21,'',0);
	$this->Cell(120,21,iconv( 'UTF-8','TIS-620','สาขา : '.$branchName),0, 'L', 'L');
	$this->Cell(70,21,iconv( 'UTF-8','TIS-620','เลขที่ : '.date('Ym').'25'.$branchCode),0, 'L', 'L');
	$this->Cell(0,6,'',0,1);
	$this->Cell(10,21,'',0);
	$this->Cell(120,21,iconv( 'UTF-8','TIS-620','รหัส : '.$branchCode),0, 'L', 'L');
	$this->Cell(70,21,iconv( 'UTF-8','TIS-620','วันที่ : '.date('d')),0, 'L', 'L');
	$this->Cell(0,6,'',0,1);
	$this->Cell(10,21,'',0);
	$this->Cell(120,21,iconv( 'UTF-8','TIS-620','ผู้ติดต่อ : '.$branchContact),0, 'L', 'L');
	$this->Cell(70,21,iconv( 'UTF-8','TIS-620','เดือน : '.$this->DateThai(date('Y/m/d'))),0, 'L', 'L');
	$this->Cell(0,6,'',0,1);
	$this->Cell(10,21,'',0);
	$this->Cell(120,21,iconv( 'UTF-8','TIS-620','ที่อยู่ : '.$branchAddress),0, 'L', 'L');
	$this->Cell(70,21,iconv( 'UTF-8','TIS-620','วันที่ปิดยอด : '.$this->DateThai1($dates)),0, 'L', 'L');
	$this->Cell(0,6,'',0,1);
	$this->Cell(10,21,'',0);
	$this->Cell(190,21,iconv( 'UTF-8','TIS-620','Email : '.$getEmail),0, 'L', 'L');
	$this->Cell(0,6,'',0,1);
	$this->Cell(10,21,'',0);
	$this->Cell(190,21,iconv( 'UTF-8','TIS-620','เบอร์โทรศัพท์ : '.$branchTel),0, 'L', 'L');
	$this->Cell(0,6,'',0,1);
	
	
	$this->Cell(0,7,'',0,1);
	$this->Cell(0,7,'',0,1);
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
	//Data
	$j=0;
	
	$data1=0;
		$data2=0;
		$data3=0;
		$data4=0;
		$data5=0;
		
		$data6=0;
		$data7=0;
		$data8=0;
		$data9_1=0;
		$data9_2=0;
		$data10=0;
		$data11=0;
		$data11_1=0;
		$data13=0;
		$data14=0;
		
		$dataCoupon=0;
		$dataCoupon1=0;
		$dataMeterial=0;
		
		$total_sp=0;
		
		$dataRev1=$dataRev[0]["RevBranch"];
		$dataRev2=$dataRev[1]["RevBranch"];
		$dataRev3=$dataRev[2]["RevBranch"];
		$dataRev4=$dataRev[3]["RevBranch"];
		$dataRev5=$dataRev[4]["RevBranch"];
		$dataRev6=$dataRev[5]["RevBranch"];
		$dataRev7=$dataRev[6]["RevBranch"];
		
		$dataTotalRev6=($data3_sp[0]['Sum17']*$dataRev6)/100;
		$dataTotalRev7=($data3_sp[0]['Sum18']*$dataRev7)/100;
		$dataTotalRavAll=$dataTotalRev6+$dataTotalRev7;
	
	/*$sup1=0;
	$sup2=0;
	$sup3=0;
	$sup4=0;
	$sup5=0;
	$sup6=0;
	$sup7=0;
	$sup8=0;
	$sup9=0;
	$sup10=0;
	$sup11=0;
	$sup12=0;
	$sup13=0;
	$sup14=0;
	$sup15=0;
	$sup16=0;
	
	foreach ($data3 as $eachResult) 
	{
		if($eachResult['SuppliesNameTH']=='บิลซักแห้ง'){
			$sup1=$eachResult['counts'];
		}
	}*/
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
		if($data2_cp[$j]["couponCount1"]!=0){
			$this->Cell(9,6,number_format($data2_cp[$j]["couponCount1"]),1,'R','R');
		}else{
			$this->Cell(9,6,'-',1,'R','R');
		}
		//coupon2
		if($data2_cp[$j]["couponCount2"]!=0){
			$this->Cell(9,6,number_format($data2_cp[$j]["couponCount2"]),1,'R','R');
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
		$this->SetFillColor(242, 242, 242);
		
		
		if($eachResult["total"]-$eachResult["PromoDiscount"]-$eachResult["MemberDiscount"]-$arr_data1[$j]["SpecialDiscount"]!=0){
			$this->Cell(18,6,number_format(($eachResult["total"]-$eachResult["PromoDiscount"]-$eachResult["MemberDiscount"]-$arr_data1[$j]["SpecialDiscount"])+$eachResult["SumService5"],2),1,'R','R');
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
		$data9_1=$data9_1+$data2_cp[$j]["couponCount1"];
		$data9_2=$data9_2+$data2_cp[$j]["couponCount2"];
		$data10=$data10+$eachResult["PromoDiscount"];
		$data11=$data11+$eachResult["total"];
		$data12=$data12+$eachResult["MemberDiscount"];
		$dataSpecial=$dataSpecial+$arr_data1[$j]["SpecialDiscount"];
		
		
		$j++;
		if($j==sizeof($data)){
			//$data11_1=(((($data2+$data4+$data6+$data8+$data14))-$dataSpecial)-$data10)-$data12;
			$data11_1=(($data11-$data10)-$data12)-$dataSpecial;
			
			$this->Ln();
			$this->SetFont('AngsanaNew','B',13);
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
			$this->SetFont('AngsanaNew','B',16);
			$this->Cell(18,7,iconv( 'UTF-8','TIS-620',number_format($data11_1,2)),1,'R','R',true);
			$this->Ln();
			
			
			$this->Cell(147,7,iconv( 'UTF-8','TIS-620',''),0,'C','C');
			$this->SetFont('AngsanaNew','B',16);
			$this->Cell(30,7,iconv( 'UTF-8','TIS-620',''),0,'R','R');
			
			$this->Cell(18,7,iconv( 'UTF-8','TIS-620',''),1,'C','C');
			
			$this->Ln();
			
			$this->SetFont('AngsanaNew','BU',16);
			$this->Cell(66,7,iconv( 'UTF-8','TIS-620','รายการเบิกคูปอง (1)'),0,'L','L');
			$this->Cell(78,7,iconv( 'UTF-8','TIS-620','รายการเบิกอุปกรณ์ (2)'),0,'L','L');
			$this->SetFont('AngsanaNew','',14);
			$this->Cell(33,7,iconv( 'UTF-8','TIS-620','ซักแห้ง'),0,'R','R');
			if($data2!=0){
				$this->Cell(18,7,iconv( 'UTF-8','TIS-620',number_format($data2,2)),1,'C','C');
			}else{
				$this->Cell(18,7,iconv( 'UTF-8','TIS-620','-'),1,'C','C',true);
			}
			$this->Ln();
			
			$this->SetFont('AngsanaNew','',12);
			$this->SetFillColor(242, 242, 242);
			$this->Cell(20,14,iconv( 'UTF-8','TIS-620','รายการ'),1,'C','C',true);
			$this->Cell(12,14,iconv( 'UTF-8','TIS-620','ราคา'),1,'C','C',true);
			$this->Cell(10,14,iconv( 'UTF-8','TIS-620','จำนวน'),1,'C','C',true);
			$this->Cell(12,14,iconv( 'UTF-8','TIS-620','ส่วนแบ่ง'),1,'C','C',true);
			$this->Cell(12,14,iconv( 'UTF-8','TIS-620','จำนวนเงิน'),1,'C','C',true);
			$this->Cell(30,14,iconv( 'UTF-8','TIS-620','รายการ'),1,'C','C',true);
			$this->Cell(12,14,iconv( 'UTF-8','TIS-620','ราคา'),1,'C','C',true);
			$this->Cell(12,14,iconv( 'UTF-8','TIS-620','จำนวน'),1,'C','C',true);
			$this->Cell(12,14,iconv( 'UTF-8','TIS-620','จำนวนเงิน'),1,'C','C',true);
			
			$this->SetFont('AngsanaNew','',14);
			$this->Cell(45,7,iconv( 'UTF-8','TIS-620','ซักน้ำ'),0,'R','R');
			if($data4==0){
				$this->Cell(18,7,iconv( 'UTF-8','TIS-620',"-"),1,'C','C');
			}else{
				$this->Cell(18,7,iconv( 'UTF-8','TIS-620',number_format($data4,2)),1,'C','C');
			}
			$this->Ln();
			$this->SetFont('AngsanaNew','',12);
			$this->Cell(20,7,'',0);
			$this->Cell(12,7,iconv( 'UTF-8','TIS-620','(บาท)'),0,'C','C');
			$this->Cell(10,7,iconv( 'UTF-8','TIS-620','(เล่ม)'),0,'C','C');
			$this->Cell(12,7,iconv( 'UTF-8','TIS-620','(%)'),0,'C','C');
			$this->Cell(12,7,iconv( 'UTF-8','TIS-620','(บาท)'),0,'C','C');
			$this->Cell(30,7,'',0);
			$this->Cell(12,7,iconv( 'UTF-8','TIS-620','(บาท)'),0,'C','C');
			$this->Cell(12,7,iconv( 'UTF-8','TIS-620','(หน่วย)'),0,'C','C');
			$this->Cell(12,7,iconv( 'UTF-8','TIS-620','(บาท)'),0,'C','C');
			
			$this->SetFont('AngsanaNew','',14);
			$this->Cell(45,7,iconv( 'UTF-8','TIS-620','สปาหนัง'),0,'R','R');
			if($data6==0){
				$this->Cell(18,7,iconv( 'UTF-8','TIS-620',"-"),1,'C','C');
			}else{
				$this->Cell(18,7,iconv( 'UTF-8','TIS-620',number_format($data6,2)),1,'C','C');
			}
			$this->Ln();
			
			$this->SetFont('AngsanaNew','',12);
			$this->Cell(20,7,iconv( 'UTF-8','TIS-620','คูปองซักน้ำ'),1,'L','L');
			
			$this->Cell(12,7,iconv( 'UTF-8','TIS-620',number_format(1320)),1,'C','C');
			
			if($data3_sp[0]['Count17']!=0){
				$this->Cell(10,7,iconv( 'UTF-8','TIS-620',number_format($data3_sp[0]['Count17'])),1,'C','C');
			}else{
				$this->Cell(10,7,iconv( 'UTF-8','TIS-620',"-"),1,'C','C');
			}
			$this->Cell(12,7,iconv( 'UTF-8','TIS-620',$dataRev6),1,'C','C');
			if($dataTotalRev6!=0){
				$this->Cell(12,7,iconv( 'UTF-8','TIS-620',number_format($dataTotalRev6,2)),1,'R','R');
			}else{
				$this->Cell(12,7,iconv( 'UTF-8','TIS-620',"-"),1,'R','R',true);
			}
			$this->Cell(30,7,iconv( 'UTF-8','TIS-620','บิลซักแห้ง'),1,'L','L');
			$this->Cell(12,7,iconv( 'UTF-8','TIS-620','69'),1,'R','R');
			if($data3_sp[0]['Count1']==0){
				$this->Cell(12,7,iconv( 'UTF-8','TIS-620',"-"),1,'R','R');
				$this->Cell(12,7,iconv( 'UTF-8','TIS-620',"-"),1,'C','C');
			}else{
				$this->Cell(12,7,iconv( 'UTF-8','TIS-620',number_format($data3_sp[0]['Count1'])),1,'R','R');
				$this->Cell(12,7,iconv( 'UTF-8','TIS-620',number_format($data3_sp[0]['Count1']*69,2)),1,'C','C');
				$total_sp=$total_sp+($data3_sp[0]['Count1']*69);
			}
			
			$this->SetFont('AngsanaNew','',14);
			$this->Cell(45,7,iconv( 'UTF-8','TIS-620','รีด'),0,'R','R');
			if($data8==0){
				$this->Cell(18,7,iconv( 'UTF-8','TIS-620',"-"),1,'C','C');
			}else{
				$this->Cell(18,7,iconv( 'UTF-8','TIS-620',number_format($data8,2)),1,'C','C');
			}
			$this->Ln();
			
			$this->SetFont('AngsanaNew','',12);
			$this->Cell(20,7,iconv( 'UTF-8','TIS-620','คูปองรีด'),1,'L','L');
			
			$this->Cell(12,7,iconv( 'UTF-8','TIS-620',number_format(525)),1,'C','C');
			
			if($data3_sp[0]['Count18']!=0){
				$this->Cell(10,7,iconv( 'UTF-8','TIS-620',number_format($data3_sp[0]['Count18'])),1,'C','C');
			}else{
				$this->Cell(10,7,iconv( 'UTF-8','TIS-620',"-"),1,'C','C');
			}	
			$this->Cell(12,7,iconv( 'UTF-8','TIS-620',$dataRev7),1,'C','C');
			if($dataTotalRev7!=0){
				$this->Cell(12,7,iconv( 'UTF-8','TIS-620',number_format($dataTotalRev7,2)),1,'R','R');
			}else{
				$this->Cell(12,7,iconv( 'UTF-8','TIS-620',"-"),1,'R','R',true);
			}
			$this->Cell(30,7,iconv( 'UTF-8','TIS-620','บิลโรงงาน'),1,'L','L');
			$this->Cell(12,7,iconv( 'UTF-8','TIS-620','38'),1,'R','R');
			
			if($data3_sp[0]['Count2']==0){
				$this->Cell(12,7,iconv( 'UTF-8','TIS-620',"-"),1,'R','R');
				$this->Cell(12,7,iconv( 'UTF-8','TIS-620',"-"),1,'C','C');
			}else{
				$this->Cell(12,7,iconv( 'UTF-8','TIS-620',number_format($data3_sp[0]['Count2'])),1,'R','R');
				$this->Cell(12,7,iconv( 'UTF-8','TIS-620',number_format($data3_sp[0]['Count2']*38,2)),1,'C','C');
				$total_sp=$total_sp+($data3_sp[0]['Count2']*38);
			}
			/*$this->SetFont('AngsanaNew','BU',14);
			$this->Cell(2,7,'',0);
			$this->Cell(2,7,iconv( 'UTF-8','TIS-620','หัก'),0,'L','L');
			$this->SetFont('AngsanaNew','',14);
			$this->Cell(36,7,iconv( 'UTF-8','TIS-620','ยอดคูปองระหว่างเดือน'),0,'R','R');
			
			if($dataCoupon==0){
				$this->Cell(18,7,iconv( 'UTF-8','TIS-620',"-"),1,'C','C');
			}else{
				$this->Cell(18,7,iconv( 'UTF-8','TIS-620',number_format($dataCoupon,2)),1,'C','C');
			}*/
			$this->SetFont('AngsanaNew','B',16);
			$this->Cell(45,7,iconv( 'UTF-8','TIS-620','รวม'),0,'R','R');
			if($data2+$data4+$data6+$data8==0){
				$this->Cell(18,7,iconv( 'UTF-8','TIS-620',"-"),1,'C','C');
			}else{
				$this->Cell(18,7,iconv( 'UTF-8','TIS-620',number_format($data2+$data4+$data6+$data8,2)),1,'C','C',true);
			}
			$this->Ln();
			if($dataRev2!=0||$dataRev4!=0){
				$total_coupon=(($data3_sp[0]['Sum17']*$dataRev2)/100)+(($data3_sp[0]['Sum18']*$dataRev4)/100);


			}else{
				$total_coupon=(($data3_sp[0]['Sum17']))+(($data3_sp[0]['Sum18']));
			}
			$this->SetFont('AngsanaNew','B',12);
			$this->Cell(54,7,iconv( 'UTF-8','TIS-620','ยอดเบิกคูปอง(1)'),0,'R','R');
			if($dataTotalRavAll!=0){
				$this->Cell(12,7,iconv( 'UTF-8','TIS-620',number_format($dataTotalRavAll,2)),1,'R','R',true);
			}else{
				$this->Cell(12,7,iconv( 'UTF-8','TIS-620',"-"),1,'R','R',true);
			}
			$this->SetFont('AngsanaNew','',12);
			$this->Cell(30,7,iconv( 'UTF-8','TIS-620','บิลสปาหนัง'),1,'L','L');
			$this->Cell(12,7,iconv( 'UTF-8','TIS-620','50'),1,'R','R');
			
			if($data3_sp[0]['Count3']==0){
				$this->Cell(12,7,iconv( 'UTF-8','TIS-620',"-"),1,'R','R');
				$this->Cell(12,7,iconv( 'UTF-8','TIS-620',"-"),1,'C','C');
			}else{
				$this->Cell(12,7,iconv( 'UTF-8','TIS-620',number_format($data3_sp[0]['Count3'])),1,'R','R');
				$this->Cell(12,7,iconv( 'UTF-8','TIS-620',number_format($data3_sp[0]['Count3']*50,2)),1,'C','C');
				$total_sp=$total_sp+($data3_sp[0]['Count3']*50);
			}
			
			$this->SetFont('AngsanaNew','BU',14);
			$this->Cell(12,7,'',0);
			$this->Cell(2,7,iconv( 'UTF-8','TIS-620','หัก'),0,'L','L');
			$this->SetFont('AngsanaNew','',14);
			$this->Cell(31,7,iconv( 'UTF-8','TIS-620','ส่วนลดโปรโมชั่น'),0,'R','R');
			if($data10!=0){
				$this->Cell(18,7,iconv( 'UTF-8','TIS-620',number_format($data10,2)),1,'C','C');
			}else{
				$this->Cell(18,7,iconv( 'UTF-8','TIS-620','-'),1,'C','C');
			}
			$this->Ln();
			
			
			$this->SetFont('AngsanaNew','',12);
			$this->Cell(66,7,'',0);
			$this->Cell(30,7,iconv( 'UTF-8','TIS-620','เข็มกลัด'),1,'L','L');
			$this->Cell(12,7,iconv( 'UTF-8','TIS-620','370'),1,'R','R');
			
			if($data3_sp[0]['Count4']==0){
				$this->Cell(12,7,iconv( 'UTF-8','TIS-620',"-"),1,'R','R');
				$this->Cell(12,7,iconv( 'UTF-8','TIS-620',"-"),1,'C','C');
			}else{
				$this->Cell(12,7,iconv( 'UTF-8','TIS-620',number_format($data3_sp[0]['Count4'])),1,'R','R');
				$this->Cell(12,7,iconv( 'UTF-8','TIS-620',number_format($data3_sp[0]['Count4']*370,2)),1,'C','C');
				$total_sp=$total_sp+($data3_sp[0]['Count4']*370);
			}
			
			$this->SetFont('AngsanaNew','BU',14);
			$this->Cell(15,7,'',0);
			$this->Cell(2,7,iconv( 'UTF-8','TIS-620','หัก'),0,'L','L');
			$this->SetFont('AngsanaNew','',14);
			$this->Cell(28,7,iconv( 'UTF-8','TIS-620','ส่วนลดสมาชิก'),0,'R','R');
			if($data12==0){
				$this->Cell(18,7,iconv( 'UTF-8','TIS-620','-'),1,'C','C');
			}else{
				$this->Cell(18,7,iconv( 'UTF-8','TIS-620',number_format($data12,2)),1,'C','C');
			}
			$this->Ln();
			
			$this->SetFont('AngsanaNew','BU',14);
			$this->Cell(66,7,iconv( 'UTF-8','TIS-620','รายการส่วนแบ่งหักให้สาขา (3)'),0,'L','L');
			
			$this->SetFont('AngsanaNew','',12);
			$this->Cell(30,7,iconv( 'UTF-8','TIS-620','ริบบิ้น'),1,'L','L');
			$this->Cell(12,7,iconv( 'UTF-8','TIS-620','400'),1,'R','R');
			
			if($data3_sp[0]['Count5']==0){
				$this->Cell(12,7,iconv( 'UTF-8','TIS-620',"-"),1,'R','R');
				$this->Cell(12,7,iconv( 'UTF-8','TIS-620',"-"),1,'C','C');
			}else{
				$this->Cell(12,7,iconv( 'UTF-8','TIS-620',number_format($data3_sp[0]['Count5'])),1,'R','R');
				$this->Cell(12,7,iconv( 'UTF-8','TIS-620',number_format($data3_sp[0]['Count5']*400,2)),1,'C','C');
				$total_sp=$total_sp+($data3_sp[0]['Count5']*400);
			}
			//
			$this->SetFont('AngsanaNew','BU',14);
			$this->Cell(15,7,'',0);
			$this->Cell(2,7,iconv( 'UTF-8','TIS-620','เพิ่ม'),0,'L','L');
			$this->SetFont('AngsanaNew','',14);
			$this->Cell(28,7,iconv( 'UTF-8','TIS-620','ส่วนลดโดยร้าน'),0,'R','R');
			if($dataSpecial==0){
				$this->Cell(18,7,iconv( 'UTF-8','TIS-620','-'),1,'C','C');
			}else{
				$this->Cell(18,7,iconv( 'UTF-8','TIS-620',number_format($dataSpecial,2)),1,'C','C');
			}
			$this->Ln();
			
			$this->SetFont('AngsanaNew','',12);
			$this->SetFillColor(242, 242, 242);
			$this->Cell(30,14,iconv( 'UTF-8','TIS-620','รายการ'),1,'C','C',true);
			$this->Cell(12,14,iconv( 'UTF-8','TIS-620','ส่วนแบ่ง'),1,'C','C',true);
			$this->Cell(12,14,iconv( 'UTF-8','TIS-620','จำนวนเงิน'),1,'C','C',true);
			
			$this->Cell(12,7,'',0,'L','L');
			$this->Cell(30,7,iconv( 'UTF-8','TIS-620','บัตรสมาชิก'),1,'L','L');
			$this->Cell(12,7,iconv( 'UTF-8','TIS-620','15'),1,'R','R');
			
			if($data3_sp[0]['Count6']==0){
				$this->Cell(12,7,iconv( 'UTF-8','TIS-620',"-"),1,'R','R');
				$this->Cell(12,7,iconv( 'UTF-8','TIS-620',"-"),1,'C','C');
			}else{
				$this->Cell(12,7,iconv( 'UTF-8','TIS-620',number_format($data3_sp[0]['Count6'])),1,'R','R');
				$this->Cell(12,7,iconv( 'UTF-8','TIS-620',number_format($data3_sp[0]['Count6']*15,2)),1,'C','C');
				$total_sp=$total_sp+($data3_sp[0]['Count6']*15);
			}
			//
			$data11_1=(($data2+$data4+$data6+$data8)-$data10-$data12)+$dataSpecial;
			$this->SetFont('AngsanaNew','B',16);
			$this->Cell(45,7,iconv( 'UTF-8','TIS-620','ยอดก่อนหักส่วนแบ่ง'),0,'R','R');
			$this->Cell(18,7,iconv( 'UTF-8','TIS-620',number_format($data11_1,2)),1,'C','C',true);
			$this->Ln();
			
			$this->SetFont('AngsanaNew','',12);
			$this->Cell(30,7,'',0);
			$this->Cell(12,7,iconv( 'UTF-8','TIS-620','(%)'),0,'C','C');
			$this->Cell(12,7,iconv( 'UTF-8','TIS-620','บาท'),0,'C','C');
			
			$this->Cell(12,7,'',0);
			$this->Cell(30,7,iconv( 'UTF-8','TIS-620','โบร์ชัวร์'),1,'L','L');
			$this->Cell(12,7,iconv( 'UTF-8','TIS-620','2'),1,'R','R');
			
			if($data3_sp[0]['Count7']==0){
				$this->Cell(12,7,iconv( 'UTF-8','TIS-620',"-"),1,'R','R');
				$this->Cell(12,7,iconv( 'UTF-8','TIS-620',"-"),1,'C','C');
			}else{
				$this->Cell(12,7,iconv( 'UTF-8','TIS-620',number_format($data3_sp[0]['Count7'])),1,'R','R');
				$this->Cell(12,7,iconv( 'UTF-8','TIS-620',number_format($data3_sp[0]['Count7']*2,2)),1,'C','C');
				$total_sp=$total_sp+($data3_sp[0]['Count7']*2);
			}
			//
			$this->SetFont('AngsanaNew','BU',14);
			$this->Cell(18,7,'',0);
			$this->Cell(2,7,iconv( 'UTF-8','TIS-620','หัก'),0,'R','R');
			$this->SetFont('AngsanaNew','',14);
			$this->Cell(25,7,iconv( 'UTF-8','TIS-620','ยอดส่วนแบ่ง (3)'),0,'R','R');
			
			$total=(($data2*$dataRev1)/100)+(($data4*$dataRev2)/100)+(($data6*$dataRev3)/100)+(($data8*$dataRev4)/100);
			if($total!=0){
				$this->Cell(18,7,iconv( 'UTF-8','TIS-620',number_format($total,2)),1,'C','C');
			}else{
				$this->Cell(18,7,iconv( 'UTF-8','TIS-620','-'),1,'C','C');
			}
			$this->Ln();
			
			$this->SetFont('AngsanaNew','',12);
			$this->Cell(30,7,iconv( 'UTF-8','TIS-620','ซักแห้ง'),1,'L','L');
			$this->Cell(12,7,iconv( 'UTF-8','TIS-620',$dataRev1),1,'C','C');
			
			if(($data2*$dataRev1)/100!=0){
				$this->Cell(12,7,iconv( 'UTF-8','TIS-620',number_format(($data2*$dataRev1)/100,2)),1,'C','C');
			}else{
				$this->Cell(12,7,iconv( 'UTF-8','TIS-620','-'),1,'C','C');
			}
			
			$this->Cell(12,7,'',0);
			$this->Cell(30,7,iconv( 'UTF-8','TIS-620','น้ำยาปรับผ้านุ่ม'),1,'L','L');
			$this->Cell(12,7,iconv( 'UTF-8','TIS-620','600'),1,'R','R');
			
			if($data3_sp[0]['Count8']==0){
				$this->Cell(12,7,iconv( 'UTF-8','TIS-620',"-"),1,'R','R');
				$this->Cell(12,7,iconv( 'UTF-8','TIS-620',"-"),1,'C','C');
			}else{
				$this->Cell(12,7,iconv( 'UTF-8','TIS-620',number_format($data3_sp[0]['Count8'])),1,'R','R');
				$this->Cell(12,7,iconv( 'UTF-8','TIS-620',number_format($data3_sp[0]['Count8']*600,2)),1,'C','C');
				$total_sp=$total_sp+($data3_sp[0]['Count8']*600);
			}
			//
			$this->SetFont('AngsanaNew','BU',14);
			$this->Cell(5,7,'',0);
			$this->Cell(2,7,iconv( 'UTF-8','TIS-620','เพิ่ม'),0,'L','L');
			$this->SetFont('AngsanaNew','',14);
			$this->Cell(38,7,iconv( 'UTF-8','TIS-620','ยอดคูปองที่เบิกจริง (1)'),0,'R','R');
			
			if($total_coupon!=0){
				$this->Cell(18,7,iconv( 'UTF-8','TIS-620',number_format($dataTotalRavAll,2)),1,'C','C');
			}else{
				$this->Cell(18,7,iconv( 'UTF-8','TIS-620',"-"),1,'C','C');
			}
			$this->Ln();
			
			$this->SetFont('AngsanaNew','',12);
			$this->Cell(30,7,iconv( 'UTF-8','TIS-620','ซักน้ำ'),1,'L','L');
			$this->Cell(12,7,iconv( 'UTF-8','TIS-620',$dataRev2),1,'C','C');
			
			if(($data4*$dataRev2)/100!=0){
				$this->Cell(12,7,iconv( 'UTF-8','TIS-620',number_format(($data4*$dataRev2)/100,2)),1,'C','C');
			}else{
				$this->Cell(12,7,iconv( 'UTF-8','TIS-620','-'),1,'C','C');
			}
			
			$this->Cell(12,7,'',0);
			$this->Cell(30,7,iconv( 'UTF-8','TIS-620','ผงซักฟอก25ก.ก.'),1,'L','L');
			$this->Cell(12,7,iconv( 'UTF-8','TIS-620','1100'),1,'R','R');
			
			if($data3_sp[0]['Count9']==0){
				$this->Cell(12,7,iconv( 'UTF-8','TIS-620',"-"),1,'R','R');
				$this->Cell(12,7,iconv( 'UTF-8','TIS-620',"-"),1,'C','C');
			}else{
				$this->Cell(12,7,iconv( 'UTF-8','TIS-620',number_format($data3_sp[0]['Count9'])),1,'R','R');
				$this->Cell(12,7,iconv( 'UTF-8','TIS-620',number_format($data3_sp[0]['Count9']*1100,2)),1,'C','C');
				$total_sp=$total_sp+($data3_sp[0]['Count9']*1100);
			}
			//
			$this->SetFont('AngsanaNew','BU',14);
			$this->Cell(9,7,'',0);
			$this->Cell(2,7,iconv( 'UTF-8','TIS-620','เพิ่ม'),0,'L','L');
			$this->SetFont('AngsanaNew','',14);
			
			$this->Cell(34,7,iconv( 'UTF-8','TIS-620','อุปกรณ์ที่เบิกจริง (2)'),0,'R','R');
			
			$dataMeterial=$total_sp+($data3_sp[0]['Count10']*2.5)+($data3_sp[0]['Count11']*120)+
			($data3_sp[0]['Count12']*120)+($data3_sp[0]['Count13']*100)+($data3_sp[0]['Count14']*100)
			+($data3_sp[0]['Count15']*100)+($data3_sp[0]['Count16']*100);
			
			if($dataMeterial!=0){
				$this->Cell(18,7,iconv( 'UTF-8','TIS-620',number_format($dataMeterial,2)),1,'C','C');
			}else{
				$this->Cell(18,7,iconv( 'UTF-8','TIS-620','-'),1,'C','C');
			}
			$this->Ln();
			
			$this->SetFont('AngsanaNew','',12);
			$this->Cell(30,7,iconv( 'UTF-8','TIS-620','สปาหนัง'),1,'L','L');
			$this->Cell(12,7,iconv( 'UTF-8','TIS-620',$dataRev3),1,'C','C');
			
			if(($data6*$dataRev3)/100!=0){
				$this->Cell(12,7,iconv( 'UTF-8','TIS-620',number_format(($data6*$dataRev3)/100,2)),1,'C','C');
			}else{
				$this->Cell(12,7,iconv( 'UTF-8','TIS-620','-'),1,'C','C');
			}
			
			$this->Cell(12,7,'',0);
			$this->Cell(30,7,iconv( 'UTF-8','TIS-620','ไม้แขวนฟ้า'),1,'L','L');
			$this->Cell(12,7,iconv( 'UTF-8','TIS-620','2.5'),1,'R','R');
			
			if($data3_sp[0]['Count10']==0){
				$this->Cell(12,7,iconv( 'UTF-8','TIS-620',"-"),1,'R','R');
				$this->Cell(12,7,iconv( 'UTF-8','TIS-620',"-"),1,'C','C');
			}else{
				$this->Cell(12,7,iconv( 'UTF-8','TIS-620',number_format($data3_sp[0]['Count10'])),1,'R','R');
				$this->Cell(12,7,iconv( 'UTF-8','TIS-620',number_format($data3_sp[0]['Count10']*2.5,2)),1,'C','C');
				$total_sp=$total_sp+($data3_sp[0]['Count10']*2.5);
			}
			//
			$this->SetFont('AngsanaNew','B',16);
			$this->Cell(45,7,iconv( 'UTF-8','TIS-620','รวมยอดชำระ'),0,'R','R');
			
			$totalAmount=($data11_1-$total)+$dataMeterial+$total_coupon;
			if($totalAmount!=0){
				$this->Cell(18,7,iconv( 'UTF-8','TIS-620',number_format($totalAmount,2)),1,'C','C',true);
			}else{
				$this->Cell(18,7,iconv( 'UTF-8','TIS-620','-'),1,'C','C');
			}
			$this->Ln();
			
			
			$this->SetFont('AngsanaNew','',12);
			$this->Cell(30,7,iconv( 'UTF-8','TIS-620','รีด'),1,'L','L');
			$this->Cell(12,7,iconv( 'UTF-8','TIS-620',$dataRev4),1,'C','C');
			
			if(($data8*$dataRev4)/100!=0){
				$this->Cell(12,7,iconv( 'UTF-8','TIS-620',number_format(($data8*$dataRev4)/100,2)),1,'C','C');
			}else{
				$this->Cell(12,7,iconv( 'UTF-8','TIS-620','-'),1,'C','C');
			}
			
			$this->Cell(12,7,'',0);
			$this->Cell(30,7,iconv( 'UTF-8','TIS-620','ถุงหิ้ว#ใหญ่'),1,'L','L');
			$this->Cell(12,7,iconv( 'UTF-8','TIS-620','120'),1,'R','R');
			
			if($data3_sp[0]['Count11']==0){
				$this->Cell(12,7,iconv( 'UTF-8','TIS-620',"-"),1,'R','R');
				$this->Cell(12,7,iconv( 'UTF-8','TIS-620',"-"),1,'C','C');
			}else{
				$this->Cell(12,7,iconv( 'UTF-8','TIS-620',number_format($data3_sp[0]['Count11'])),1,'R','R');
				$this->Cell(12,7,iconv( 'UTF-8','TIS-620',number_format($data3_sp[0]['Count11']*120,2)),1,'C','C');
				$total_sp=$total_sp+($data3_sp[0]['Count11']*120);
			}
			//
			$this->SetFont('AngsanaNew','',14);
			$this->Cell(45,7,iconv( 'UTF-8','TIS-620','VAT 7%'),0,'R','R');
		
			$vat=($totalAmount*7)/100;
			if($vat!=0){
				$this->Cell(18,7,iconv( 'UTF-8','TIS-620',number_format($vat,2)),1,'C','C');
			}else{
				$this->Cell(18,7,iconv( 'UTF-8','TIS-620','-'),1,'C','C');
			}
			$this->Ln();
			
			/*$this->SetFont('AngsanaNew','',12);
			$this->Cell(30,7,iconv( 'UTF-8','TIS-620','คูปองเล่ม'),1,'L','L');
			$this->Cell(12,7,iconv( 'UTF-8','TIS-620','20'),1,'C','C');
			
			if($data14!=0){
				$this->Cell(12,7,iconv( 'UTF-8','TIS-620',number_format(($data14*20)/100,2)),1,'C','C');
			}else{
				$this->Cell(12,7,iconv( 'UTF-8','TIS-620','-'),1,'C','C');
			}*/
			//
			$this->SetFont('AngsanaNew','B',12);
			$this->Cell(42,7,iconv( 'UTF-8','TIS-620','ยอดส่วนแบ่ง (3)'),0,'R','R');
			if($total!=0){
				$this->Cell(12,7,iconv( 'UTF-8','TIS-620',number_format($total,2)),1,'C','C',true);
			}else{
				$this->Cell(12,7,iconv( 'UTF-8','TIS-620','-'),1,'C','C');
			}
			
			$this->SetFont('AngsanaNew','',12);
			$this->Cell(12,7,'',0);
			$this->Cell(30,7,iconv( 'UTF-8','TIS-620','ถุงหิ้ว#เล็ก'),1,'L','L');
			$this->Cell(12,7,iconv( 'UTF-8','TIS-620','120'),1,'R','R');
			
			if($data3_sp[0]['Count12']==0){
				$this->Cell(12,7,iconv( 'UTF-8','TIS-620',"-"),1,'R','R');
				$this->Cell(12,7,iconv( 'UTF-8','TIS-620',"-"),1,'C','C');
			}else{
				$this->Cell(12,7,iconv( 'UTF-8','TIS-620',number_format($data3_sp[0]['Count12'])),1,'R','R');
				$this->Cell(12,7,iconv( 'UTF-8','TIS-620',number_format($data3_sp[0]['Count12']*120,2)),1,'C','C');
				$total_sp=$total_sp+($data3_sp[0]['Count12']*120);
			}
			//
			$this->SetFont('AngsanaNew','',14);
			$this->Cell(45,7,iconv( 'UTF-8','TIS-620','ภาษี 3%'),0,'R','R');
			
			$tax=($totalAmount*3)/100;
			if($tax!=0){
				$this->Cell(18,7,iconv( 'UTF-8','TIS-620',number_format($tax,2)),1,'C','C');
			}else{
				$this->Cell(18,7,iconv( 'UTF-8','TIS-620','-'),1,'C','C');
			}
			$this->Ln();
			
			
			$this->Cell(66,7,'',0);
			$this->SetFont('AngsanaNew','',12);
			$this->Cell(30,7,iconv( 'UTF-8','TIS-620','ถุงขุ่น'),1,'L','L');
			$this->Cell(12,7,iconv( 'UTF-8','TIS-620','100'),1,'R','R');
			
			if($data3_sp[0]['Count13']==0){
				$this->Cell(12,7,iconv( 'UTF-8','TIS-620',"-"),1,'R','R');
				$this->Cell(12,7,iconv( 'UTF-8','TIS-620',"-"),1,'C','C');
			}else{
				$this->Cell(12,7,iconv( 'UTF-8','TIS-620',number_format($data3_sp[0]['Count13'])),1,'R','R');
				$this->Cell(12,7,iconv( 'UTF-8','TIS-620',number_format($data3_sp[0]['Count13']*100,2)),1,'C','C');
				$total_sp=$total_sp+($data3_sp[0]['Count13']*100);
			}
			
			$this->SetFont('AngsanaNew','B',16);
			
			$this->Cell(45,7,iconv( 'UTF-8','TIS-620','รวมยอดสุทธิ'),0,'R','R');
			$netAmount=($totalAmount+$vat)-$tax;
			if($netAmount!=0){
				$this->Cell(18,7,iconv( 'UTF-8','TIS-620',number_format($netAmount,2)),1,'C','C',true);
			}else{
				$this->Cell(18,7,iconv( 'UTF-8','TIS-620','-'),1,'C','C');
			}
			$this->Ln();
			
			
			$this->Cell(66,7,'',0);
			$this->SetFont('AngsanaNew','',12);
			$this->Cell(30,7,iconv( 'UTF-8','TIS-620','บาร์โค๊ดไวนิล'),1,'L','L');
			$this->Cell(12,7,iconv( 'UTF-8','TIS-620','100'),1,'R','R');
			
			if($data3_sp[0]['Count14']==0){
				$this->Cell(12,7,iconv( 'UTF-8','TIS-620',"-"),1,'R','R');
				$this->Cell(12,7,iconv( 'UTF-8','TIS-620',"-"),1,'C','C');
			}else{
				$this->Cell(12,7,iconv( 'UTF-8','TIS-620',number_format($data3_sp[0]['Count14'])),1,'R','R');
				$this->Cell(12,7,iconv( 'UTF-8','TIS-620',number_format($data3_sp[0]['Count14']*100,2)),1,'C','C');
				$total_sp=$total_sp+($data3_sp[0]['Count14']*100);
			}
			
			$this->Cell(58,7,'',0);
			$this->Ln();
			
			
			$this->Cell(66,7,'',0);
			$this->SetFont('AngsanaNew','',12);
			$this->Cell(30,7,iconv( 'UTF-8','TIS-620','สติกเกอร์บาร์โค๊ด'),1,'L','L');
			$this->Cell(12,7,iconv( 'UTF-8','TIS-620','100'),1,'R','R');
			
			if($data3_sp[0]['Count15']==0){
				$this->Cell(12,7,iconv( 'UTF-8','TIS-620',"-"),1,'R','R');
				$this->Cell(12,7,iconv( 'UTF-8','TIS-620',"-"),1,'C','C');
			}else{
				$this->Cell(12,7,iconv( 'UTF-8','TIS-620',number_format($data3_sp[0]['Count15'])),1,'R','R');
				$this->Cell(12,7,iconv( 'UTF-8','TIS-620',number_format($data3_sp[0]['Count15']*100,2)),1,'C','C');
				$total_sp=$total_sp+($data3_sp[0]['Count15']*100);
			}
			
			$this->Cell(58,7,'',0);
			$this->Ln();
		
			
			$this->Cell(66,7,'',0);
			$this->SetFont('AngsanaNew','',12);
			$this->Cell(30,7,iconv( 'UTF-8','TIS-620','กระดาษปริ้นเตอร์'),1,'L','L');
			$this->Cell(12,7,iconv( 'UTF-8','TIS-620','100'),1,'R','R');
			
			if($data3_sp[0]['Count16']==0){
				$this->Cell(12,7,iconv( 'UTF-8','TIS-620',"-"),1,'R','R');
				$this->Cell(12,7,iconv( 'UTF-8','TIS-620',"-"),1,'C','C');
			}else{
				$this->Cell(12,7,iconv( 'UTF-8','TIS-620',number_format($data3_sp[0]['Count16'])),1,'R','R');
				$this->Cell(12,7,iconv( 'UTF-8','TIS-620',number_format($data3_sp[0]['Count16']*100,2)),1,'C','C');
				$total_sp=$total_sp+($data3_sp[0]['Count16']*100);
			}
			
			$this->Cell(58,7,'',0);
			$this->Ln();
			
			$this->Cell(108,7,'',0);
			$this->SetFont('AngsanaNew','B',12);
			$this->Cell(12,7,iconv( 'UTF-8','TIS-620','ยอดเบิกอุปกรณ์ (2)'),0,'R','R');
			
			if($total_sp==0){
				$this->Cell(12,7,iconv( 'UTF-8','TIS-620','-'),1,'C','C',true);
			}else{
				$this->Cell(12,7,iconv( 'UTF-8','TIS-620',number_format($total_sp,2)),1,'C','C',true);
			}
			
			$this->Cell(58,7,'',0);
			$this->Ln();
			
			$this->Ln();
			$this->Ln();
			
			$this->SetFont('AngsanaNew','B',16);
			$this->Cell(190,7,iconv( 'UTF-8','TIS-620','กรุณาโอนเงินเข้าบัญชี'),0,'C','C');
			$this->Ln();
			$this->Cell(190,7,iconv( 'UTF-8','TIS-620','ธนาคาร ไทยพาณิชย์ เลขที่ 033-284446-3  โยธิน   พงษ์พานิชย์'),0,'C','C');
			$this->Cell(58,7,'',0);
			$this->Ln();
			$this->Ln();
			$this->SetTextColor(255, 0, 0);
			$this->Cell(190,7,iconv( 'UTF-8','TIS-620',' (กรณีโอนเงินผิดจากยอดที่แจ้งกรุณาแจงรายละเอียดให้ทราบด้วยนะคะ)'),0,'C','C');
			
			$this->Ln();
			
			$this->SetTextColor('');
			$this->SetFont('AngsanaNew','',12);
		
			
			
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
		$resultData1 = json_decode($_POST['resultData1'], TRUE);
		$resultData2 = json_decode($_POST['resultData2'], TRUE);
		$resultData3 = json_decode($_POST['resultData3'], TRUE);
		$resultData4 = json_decode($_POST['resultData4'], TRUE);
		$branchName = $_POST['branchName'];
		$branchCode = $_POST['branchCode'];
		$branchType = $_POST['branchType'];
		$getTop="";
		$branchTel = $_POST['branchTel'];
		$branchAddress = $_POST['branchAddress'];
		$branchContact = $_POST['branchContact'];
		$getDate_end = $_POST['date_end'];
		$getEmail = $_POST['email'];
		
		echo $branchName.",".$branchType.",".$branchTel.",".$branchAddress.",".$branchContact;
		
		$dates=date('Y-m-d');
		
		$header=array('ลำดับ','วันที่','เลขที่บิล','ซักแห้ง','ซักน้ำ','สปาหนัง','รีด','');

		$pdf=new PDF();
		$pdf->AddPage();
		$pdf->AliasNbPages();
		$pdf->AddFont('AngsanaNew','','angsa.php');
		$pdf->AddFont('AngsanaNew','B','angsab.php');
		$pdf->SetFont('AngsanaNew','',12);
		$pdf->BasicTable($header,$resultData,$resultData1,$resultData2,$getDate_end,$branchName,$branchCode, $branchType,$getTop,$branchTel,$branchAddress,$resultData3,$resultData4,$branchContact,$getEmail);
		$pdf->Output("MyPDF/File-Invoice.pdf","F");
		//header("Location: MyPDF/File-Invoice.pdf");
		
?>