<html>
<head>
<title>Report PDF</title>
</head>
<body>

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

//Simple table
function BasicTable($header,$data,$data1,$data2,$dates,$branchName,$branchCode,$branchType,$getTop)
{
	//Header
	$this->SetFillColor(209, 209, 224);
	$this->SetFont('AngsanaNew','',18);
	$this->Cell(190,21,iconv( 'UTF-8','TIS-620','ประจำวันที่ : '.$dates),0, 'C', 'C');
	$this->Cell(0,7,'',0,1);

	if($branchName!=''){
		$this->Cell(190,21,iconv( 'UTF-8','TIS-620','ประเภทสาขา : '.$branchType),0, 'C', 'C');
		$this->Cell(0,7,'',0,1);
		$this->Cell(190,21,iconv( 'UTF-8','TIS-620','สาขา : '.$branchName.' ('.$branchCode.')'),0, 'C', 'C');
		$this->Cell(0,7,'',0,1);
	}
	if($getTop!=''){
		$this->Cell(190,21,iconv( 'UTF-8','TIS-620',$getTop.' อันดับแรก'),0, 'C', 'C');
		$this->Cell(0,7,'',0,1);
	}
	$this->Cell(0,7,'',0,1);
	$this->Cell(0,7,'',0,1);
	$this->Ln();
	
	$this->SetFont('AngsanaNew','',13);
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
		$data9=0;
		$data10=0;
		$data11=0;
		
		
   	foreach ($data as $eachResult) 
	{
		$this->Cell(8,6,number_format($j+1),1,'C','C');
		$this->Cell(17,6,$eachResult["OrderDate"],1,'C','C');
		$this->Cell(18,6,$eachResult["OrderNo"],1,'C','C');
		$this->Cell(9,6,number_format($eachResult["CountService1"]),1,'C','C');
		$this->Cell(14,6,number_format($eachResult["SumService1"]),1,'R','R');
		$this->Cell(9,6,number_format($eachResult["CountService2"]),1,'C','C');
		$this->Cell(14,6,number_format($eachResult["SumService2"]),1,'R','R');
		$this->Cell(9,6,number_format($eachResult["CountService3"]),1,'C','C');
		$this->Cell(14,6,number_format($eachResult["SumService3"]),1,'R','R');
		$this->Cell(9,6,'',1,'C','C');
		$this->Cell(14,6,'',1,'R','R');
		$this->Cell(9,6,number_format($data2[$j]["couponCount"]),1,'C','C');
		$this->Cell(14,6,number_format($data1[$j]["PromoDiscount"]),1,'R','R');
		$this->Cell(14,6,number_format($eachResult["total"]-$data1[$j]["PromoDiscount"]),1,'R','R');
		$this->Cell(18,6,iconv( 'UTF-8','TIS-620',$eachResult["IsPayment"]),1,'C','C');
		
		
		$data1=$data1+$eachResult["CountService1"];
		$data2=$data2+$eachResult["SumService1"];
		$data3=$data3+$eachResult["CountService2"];
		$data4=$data4+$eachResult["SumService2"];
		$data5=$data5+$eachResult["CountService3"];
		$data6=$data6+$eachResult["SumService3"];
		//$data7=$data7+$row[5];
		//$data8=$data8+$row[7];
		$data9=$data9+$data2[$j]["couponCount"];
		$data10=$data10+$data1[$j]["PromoDiscount"];
		$data11=$data11+$eachResult["total"]-$data1[$j]["PromoDiscount"];
		
		
		$j++;
		if($j==sizeof($data)){
			$this->Ln();
			
			$this->Cell(43,7,iconv( 'UTF-8','TIS-620','รวม'),1,'C','C',true);
			$this->Cell(9,7,iconv( 'UTF-8','TIS-620',number_format($data1)),1,'C','C',true);
			$this->Cell(14,7,iconv( 'UTF-8','TIS-620',number_format($data2)),1,'R','R',true);
			$this->Cell(9,7,iconv( 'UTF-8','TIS-620',number_format($data3)),1,'C','C',true);
			$this->Cell(14,7,iconv( 'UTF-8','TIS-620',number_format($data4)),1,'R','R',true);
			$this->Cell(9,7,iconv( 'UTF-8','TIS-620',number_format($data5)),1,'C','C',true);
			$this->Cell(14,7,iconv( 'UTF-8','TIS-620',number_format($data6)),1,'R','R',true);
			$this->Cell(9,7,iconv( 'UTF-8','TIS-620',''),1,'C','C',true);
			$this->Cell(14,7,iconv( 'UTF-8','TIS-620',''),1,'R','R',true);
			$this->Cell(9,7,iconv( 'UTF-8','TIS-620',number_format($data9)),1,'C','C',true);
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

	include("config.php");
	
	if(isset($_GET["date_start"]) && isset($_GET["date_end"]) && isset($_GET["branchID"]) && isset($_GET["branchType"]) && isset($_GET["top"]))
    {
        $getDate_start=$_GET['date_start'];
		$getDate_end=$_GET['date_end'];
		$getBranchID=$_GET['branchID'];
		$getBranchType=$_GET['branchType'];
		$getTop=$_GET['top'];
		
		echo $getBranchID.', '.$getBranchType;
    }
	
	
	$stmt_b="select Distinct mas_branch.BranchID,mas_branch.BranchCode,mas_branch.BranchNameTH,mas_branchtype.BranchTypeNameTH
		from ops_order left join (mas_branch left join mas_branchtype on mas_branch.BranchType=mas_branchtype.BranchTypeID) 
		on ops_order.BranchID=mas_branch.BranchID
		where mas_branch.BranchID ='".$getBranchID."'";
    $query_b = sqlsrv_query($conn, $stmt_b);
	$branchData = "";
	$branchCode = "";
	$branchName = "";
	$branchType = "";
    while($row = sqlsrv_fetch_array($query_b, SQLSRV_FETCH_ASSOC))
    {
 		$branchData=$row['BranchID'];
		$branchCode=$row['BranchCode'];
		$branchName=$row['BranchNameTH'];
		$branchType=$row['BranchTypeNameTH'];
    }
	
	
	if($getTop==''||$getTop=='100'){
		echo 'true';
		if($getBranchID!='cheese'&&$getBranchType=='cheese'){
			$stmt = "select ops_order.OrderDate,ops_order.OrderNo,
coalesce (SUM(CASE WHEN ops_orderdetail.ServiceNameEN = 'Dry Clean' then 1 else null end),0) AS CountService1,
coalesce (SUM(CASE WHEN ops_orderdetail.ServiceNameEN = 'Dry Clean' then ops_orderdetail.Amount else null end),0) AS SumService1,
coalesce (SUM(CASE WHEN ops_orderdetail.ServiceNameEN = 'Laundry' then 1 else null end),0) AS CountService2,
coalesce (SUM(CASE WHEN ops_orderdetail.ServiceNameEN = 'Laundry' then ops_orderdetail.Amount else null end),0) AS SumService2,
coalesce (SUM(CASE WHEN ops_orderdetail.ServiceNameEN = 'Spa Leathers' then 1 else null end),0) AS CountService3,
coalesce (SUM(CASE WHEN ops_orderdetail.ServiceNameEN = 'Spa Leathers' then ops_orderdetail.Amount else null end),0) AS SumService3,
((sum(Amount)+sum((Amount)*coalesce(ExpressRate,0))/100)+sum(coalesce(ops_orderdetail.AdditionAmount,0)))-sum(coalesce(ops_orderdetail.DiscountAmount,0)) as total,
CASE WHEN ops_order.IsPayment = 1 then 'ชำระเงิน' else 'ค้างชำระ' end as IsPayment
from ((ops_order left join
(ops_orderdetail left join mas_product on ops_orderdetail.ProductID=mas_product.ProductID)
on ops_order.OrderNo=ops_orderdetail.OrderNo)
left join mas_priceexpression on ops_order.IsExpressLevel=mas_priceexpression.IsExpressLevel)
left join (mas_branch
left join mas_branchtype on mas_branch.BranchType=mas_branchtype.BranchTypeID)
on ops_order.BranchID=mas_branch.BranchID
WHERE  ops_order.OrderDate between '".$getDate_start."' AND '".$getDate_end."' AND ops_order.IsActive='1' AND mas_branch.BranchID='".$getBranchID."'
Group By ops_order.OrderDate,ops_order.OrderNo,IsPayment
Order By ops_order.OrderNo DESC";

			$stmt1="select ops_order.OrderNo,sum(PromoDiscount) as PromoDiscount,
coalesce(sum(SpecialDiscount),0) as SpecialDiscount,
coalesce(sum(MemberDiscount),0) as MemberDiscount,
ops_order.NetAmount
from (ops_order
left join (mas_branch left join mas_branchtype on mas_branch.BranchID=mas_branchtype.BranchTypeID)
on ops_order.BranchID=mas_branch.BranchID)
WHERE  ops_order.OrderDate between '".$getDate_start."' AND '".$getDate_end."' AND ops_order.IsActive='1' AND mas_branch.BranchID='".$getBranchID."'
GROUP BY ops_order.OrderNo,ops_order.NetAmount
Order By ops_order.OrderNo DESC";

			$stmt2="select ops_order.OrderNo,count(ops_coupondiscount.OrderID) as couponCount
from (ops_order left join (mas_branch left join mas_branchtype on mas_branch.BranchID=mas_branchtype.BranchTypeID)
on ops_order.BranchID=mas_branch.BranchID) left join ops_coupondiscount on ops_order.OrderNo=ops_coupondiscount.OrderID
WHERE  ops_order.OrderDate between '".$getDate_start."' AND '".$getDate_end."' AND ops_order.IsActive='1' AND mas_branch.BranchID='".$getBranchID."'
GROUP BY ops_order.OrderNo,ops_order.NetAmount
Order By ops_order.OrderNo DESC";
		}else if($getBranchID=='cheese'&&$getBranchType!='cheese'){
			$stmt = "select ops_order.OrderDate,ops_order.OrderNo,
coalesce (SUM(CASE WHEN ops_orderdetail.ServiceNameEN = 'Dry Clean' then 1 else null end),0) AS CountService1,
coalesce (SUM(CASE WHEN ops_orderdetail.ServiceNameEN = 'Dry Clean' then ops_orderdetail.Amount else null end),0) AS SumService1,
coalesce (SUM(CASE WHEN ops_orderdetail.ServiceNameEN = 'Laundry' then 1 else null end),0) AS CountService2,
coalesce (SUM(CASE WHEN ops_orderdetail.ServiceNameEN = 'Laundry' then ops_orderdetail.Amount else null end),0) AS SumService2,
coalesce (SUM(CASE WHEN ops_orderdetail.ServiceNameEN = 'Spa Leathers' then 1 else null end),0) AS CountService3,
coalesce (SUM(CASE WHEN ops_orderdetail.ServiceNameEN = 'Spa Leathers' then ops_orderdetail.Amount else null end),0) AS SumService3,
((sum(Amount)+sum((Amount)*coalesce(ExpressRate,0))/100)+sum(coalesce(ops_orderdetail.AdditionAmount,0)))-sum(coalesce(ops_orderdetail.DiscountAmount,0)) as total,
CASE WHEN ops_order.IsPayment = 1 then 'ชำระเงิน' else 'ค้างชำระ' end as IsPayment
from ((ops_order left join
(ops_orderdetail left join mas_product on ops_orderdetail.ProductID=mas_product.ProductID)
on ops_order.OrderNo=ops_orderdetail.OrderNo)
left join mas_priceexpression on ops_order.IsExpressLevel=mas_priceexpression.IsExpressLevel)
left join (mas_branch
left join mas_branchtype on mas_branch.BranchType=mas_branchtype.BranchTypeID)
on ops_order.BranchID=mas_branch.BranchID
WHERE  ops_order.OrderDate between '".$getDate_start."' AND '".$getDate_end."' AND ops_order.IsActive='1' AND mas_branch.BranchType='".$getBranchType."'
Group By ops_order.OrderDate,ops_order.OrderNo,IsPayment
Order By ops_order.OrderNo DESC";

			$stmt1="select ops_order.OrderNo,sum(PromoDiscount) as PromoDiscount,
coalesce(sum(SpecialDiscount),0) as SpecialDiscount,
coalesce(sum(MemberDiscount),0) as MemberDiscount,
ops_order.NetAmount
from (ops_order
left join (mas_branch left join mas_branchtype on mas_branch.BranchID=mas_branchtype.BranchTypeID)
on ops_order.BranchID=mas_branch.BranchID)
WHERE  ops_order.OrderDate between '".$getDate_start."' AND '".$getDate_end."' AND ops_order.IsActive='1' AND mas_branch.BranchType='".$getBranchType."'
GROUP BY ops_order.OrderNo,ops_order.NetAmount
Order By ops_order.OrderNo DESC";

			$stmt2="select ops_order.OrderNo,count(ops_coupondiscount.OrderID) as couponCount
from (ops_order left join (mas_branch left join mas_branchtype on mas_branch.BranchID=mas_branchtype.BranchTypeID)
on ops_order.BranchID=mas_branch.BranchID) left join ops_coupondiscount on ops_order.OrderNo=ops_coupondiscount.OrderID
WHERE  ops_order.OrderDate between '".$getDate_start."' AND '".$getDate_end."' AND ops_order.IsActive='1' AND mas_branch.BranchType='".$getBranchType."'
GROUP BY ops_order.OrderNo,ops_order.NetAmount
Order By ops_order.OrderNo DESC";
		}else{
			$stmt = "select ops_order.OrderDate,ops_order.OrderNo,
coalesce (SUM(CASE WHEN ops_orderdetail.ServiceNameEN = 'Dry Clean' then 1 else null end),0) AS CountService1,
coalesce (SUM(CASE WHEN ops_orderdetail.ServiceNameEN = 'Dry Clean' then ops_orderdetail.Amount else null end),0) AS SumService1,
coalesce (SUM(CASE WHEN ops_orderdetail.ServiceNameEN = 'Laundry' then 1 else null end),0) AS CountService2,
coalesce (SUM(CASE WHEN ops_orderdetail.ServiceNameEN = 'Laundry' then ops_orderdetail.Amount else null end),0) AS SumService2,
coalesce (SUM(CASE WHEN ops_orderdetail.ServiceNameEN = 'Spa Leathers' then 1 else null end),0) AS CountService3,
coalesce (SUM(CASE WHEN ops_orderdetail.ServiceNameEN = 'Spa Leathers' then ops_orderdetail.Amount else null end),0) AS SumService3,
((sum(Amount)+sum((Amount)*coalesce(ExpressRate,0))/100)+sum(coalesce(ops_orderdetail.AdditionAmount,0)))-sum(coalesce(ops_orderdetail.DiscountAmount,0)) as total,
CASE WHEN ops_order.IsPayment = 1 then 'ชำระเงิน' else 'ค้างชำระ' end as IsPayment
from ((ops_order left join
(ops_orderdetail left join mas_product on ops_orderdetail.ProductID=mas_product.ProductID)
on ops_order.OrderNo=ops_orderdetail.OrderNo)
left join mas_priceexpression on ops_order.IsExpressLevel=mas_priceexpression.IsExpressLevel)
left join (mas_branch
left join mas_branchtype on mas_branch.BranchType=mas_branchtype.BranchTypeID)
on ops_order.BranchID=mas_branch.BranchID
WHERE  ops_order.OrderDate between '".$getDate_start."' AND '".$getDate_end."' AND ops_order.IsActive='1'
Group By ops_order.OrderDate,ops_order.OrderNo,IsPayment
Order By ops_order.OrderNo DESC";

			$stmt1="select ops_order.OrderNo,sum(PromoDiscount) as PromoDiscount,
coalesce(sum(SpecialDiscount),0) as SpecialDiscount,
coalesce(sum(MemberDiscount),0) as MemberDiscount,
ops_order.NetAmount
from (ops_order
left join (mas_branch left join mas_branchtype on mas_branch.BranchID=mas_branchtype.BranchTypeID)
on ops_order.BranchID=mas_branch.BranchID)
WHERE  ops_order.OrderDate between '".$getDate_start."' AND '".$getDate_end."' AND ops_order.IsActive='1'
GROUP BY ops_order.OrderNo,ops_order.NetAmount
Order By ops_order.OrderNo DESC";

			$stmt2="select ops_order.OrderNo,count(ops_coupondiscount.OrderID) as couponCount
from (ops_order left join (mas_branch left join mas_branchtype on mas_branch.BranchID=mas_branchtype.BranchTypeID)
on ops_order.BranchID=mas_branch.BranchID) left join ops_coupondiscount on ops_order.OrderNo=ops_coupondiscount.OrderID
WHERE  ops_order.OrderDate between '".$getDate_start."' AND '".$getDate_end."' AND ops_order.IsActive='1'
GROUP BY ops_order.OrderNo,ops_order.NetAmount
Order By ops_order.OrderNo DESC";
		}

	}else if($getTop=='10'){
		echo 'top '.$getTop;
		if($getBranchID!='cheese'&&$getBranchType=='cheese'){
			$stmt = "select top 10 ops_order.OrderDate,ops_order.OrderNo,
coalesce (SUM(CASE WHEN ops_orderdetail.ServiceNameEN = 'Dry Clean' then 1 else null end),0) AS CountService1,
coalesce (SUM(CASE WHEN ops_orderdetail.ServiceNameEN = 'Dry Clean' then ops_orderdetail.Amount else null end),0) AS SumService1,
coalesce (SUM(CASE WHEN ops_orderdetail.ServiceNameEN = 'Laundry' then 1 else null end),0) AS CountService2,
coalesce (SUM(CASE WHEN ops_orderdetail.ServiceNameEN = 'Laundry' then ops_orderdetail.Amount else null end),0) AS SumService2,
coalesce (SUM(CASE WHEN ops_orderdetail.ServiceNameEN = 'Spa Leathers' then 1 else null end),0) AS CountService3,
coalesce (SUM(CASE WHEN ops_orderdetail.ServiceNameEN = 'Spa Leathers' then ops_orderdetail.Amount else null end),0) AS SumService3,
((sum(Amount)+sum((Amount)*coalesce(ExpressRate,0))/100)+sum(coalesce(ops_orderdetail.AdditionAmount,0)))-sum(coalesce(ops_orderdetail.DiscountAmount,0)) as total,
CASE WHEN ops_order.IsPayment = 1 then 'ชำระเงิน' else 'ค้างชำระ' end as IsPayment
from ((ops_order left join
(ops_orderdetail left join mas_product on ops_orderdetail.ProductID=mas_product.ProductID)
on ops_order.OrderNo=ops_orderdetail.OrderNo)
left join mas_priceexpression on ops_order.IsExpressLevel=mas_priceexpression.IsExpressLevel)
left join (mas_branch
left join mas_branchtype on mas_branch.BranchType=mas_branchtype.BranchTypeID)
on ops_order.BranchID=mas_branch.BranchID
WHERE  ops_order.OrderDate between '".$getDate_start."' AND '".$getDate_end."' AND ops_order.IsActive='1' AND mas_branch.BranchID='".$getBranchID."'
Group By ops_order.OrderDate,ops_order.OrderNo,IsPayment
Order By ops_order.OrderNo DESC";

			$stmt1="select top 10 ops_order.OrderNo,sum(PromoDiscount) as PromoDiscount,
coalesce(sum(SpecialDiscount),0) as SpecialDiscount,
coalesce(sum(MemberDiscount),0) as MemberDiscount,
ops_order.NetAmount
from (ops_order
left join (mas_branch left join mas_branchtype on mas_branch.BranchID=mas_branchtype.BranchTypeID)
on ops_order.BranchID=mas_branch.BranchID)
WHERE  ops_order.OrderDate between '".$getDate_start."' AND '".$getDate_end."' AND ops_order.IsActive='1' AND mas_branch.BranchID='".$getBranchID."'
GROUP BY ops_order.OrderNo,ops_order.NetAmount
Order By ops_order.OrderNo DESC";

			$stmt2="select top 10 ops_order.OrderNo,count(ops_coupondiscount.OrderID) as couponCount
from (ops_order left join (mas_branch left join mas_branchtype on mas_branch.BranchID=mas_branchtype.BranchTypeID)
on ops_order.BranchID=mas_branch.BranchID) left join ops_coupondiscount on ops_order.OrderNo=ops_coupondiscount.OrderID
WHERE  ops_order.OrderDate between '".$getDate_start."' AND '".$getDate_end."' AND ops_order.IsActive='1' AND mas_branch.BranchID='".$getBranchID."'
GROUP BY ops_order.OrderNo,ops_order.NetAmount
Order By ops_order.OrderNo DESC";
		}else if($getBranchID=='cheese'&&$getBranchType!='cheese'){
			$stmt = "select top 10 ops_order.OrderDate,ops_order.OrderNo,
coalesce (SUM(CASE WHEN ops_orderdetail.ServiceNameEN = 'Dry Clean' then 1 else null end),0) AS CountService1,
coalesce (SUM(CASE WHEN ops_orderdetail.ServiceNameEN = 'Dry Clean' then ops_orderdetail.Amount else null end),0) AS SumService1,
coalesce (SUM(CASE WHEN ops_orderdetail.ServiceNameEN = 'Laundry' then 1 else null end),0) AS CountService2,
coalesce (SUM(CASE WHEN ops_orderdetail.ServiceNameEN = 'Laundry' then ops_orderdetail.Amount else null end),0) AS SumService2,
coalesce (SUM(CASE WHEN ops_orderdetail.ServiceNameEN = 'Spa Leathers' then 1 else null end),0) AS CountService3,
coalesce (SUM(CASE WHEN ops_orderdetail.ServiceNameEN = 'Spa Leathers' then ops_orderdetail.Amount else null end),0) AS SumService3,
((sum(Amount)+sum((Amount)*coalesce(ExpressRate,0))/100)+sum(coalesce(ops_orderdetail.AdditionAmount,0)))-sum(coalesce(ops_orderdetail.DiscountAmount,0)) as total,
CASE WHEN ops_order.IsPayment = 1 then 'ชำระเงิน' else 'ค้างชำระ' end as IsPayment
from ((ops_order left join
(ops_orderdetail left join mas_product on ops_orderdetail.ProductID=mas_product.ProductID)
on ops_order.OrderNo=ops_orderdetail.OrderNo)
left join mas_priceexpression on ops_order.IsExpressLevel=mas_priceexpression.IsExpressLevel)
left join (mas_branch
left join mas_branchtype on mas_branch.BranchType=mas_branchtype.BranchTypeID)
on ops_order.BranchID=mas_branch.BranchID
WHERE  ops_order.OrderDate between '".$getDate_start."' AND '".$getDate_end."' AND ops_order.IsActive='1' AND mas_branch.BranchType='".$getBranchType."'
Group By ops_order.OrderDate,ops_order.OrderNo,IsPayment
Order By ops_order.OrderNo DESC";

			$stmt1="select top 10 ops_order.OrderNo,sum(PromoDiscount) as PromoDiscount,
coalesce(sum(SpecialDiscount),0) as SpecialDiscount,
coalesce(sum(MemberDiscount),0) as MemberDiscount,
ops_order.NetAmount
from (ops_order
left join (mas_branch left join mas_branchtype on mas_branch.BranchID=mas_branchtype.BranchTypeID)
on ops_order.BranchID=mas_branch.BranchID)
WHERE  ops_order.OrderDate between '".$getDate_start."' AND '".$getDate_end."' AND ops_order.IsActive='1' AND mas_branch.BranchType='".$getBranchType."'
GROUP BY ops_order.OrderNo,ops_order.NetAmount
Order By ops_order.OrderNo DESC";

			$stmt2="select top 10 ops_order.OrderNo,count(ops_coupondiscount.OrderID) as couponCount
from (ops_order left join (mas_branch left join mas_branchtype on mas_branch.BranchID=mas_branchtype.BranchTypeID)
on ops_order.BranchID=mas_branch.BranchID) left join ops_coupondiscount on ops_order.OrderNo=ops_coupondiscount.OrderID
WHERE  ops_order.OrderDate between '".$getDate_start."' AND '".$getDate_end."' AND ops_order.IsActive='1' AND mas_branch.BranchType='".$getBranchType."'
GROUP BY ops_order.OrderNo,ops_order.NetAmount
Order By ops_order.OrderNo DESC";
		}else{
			$stmt = "select top 10 ops_order.OrderDate,ops_order.OrderNo,
coalesce (SUM(CASE WHEN ops_orderdetail.ServiceNameEN = 'Dry Clean' then 1 else null end),0) AS CountService1,
coalesce (SUM(CASE WHEN ops_orderdetail.ServiceNameEN = 'Dry Clean' then ops_orderdetail.Amount else null end),0) AS SumService1,
coalesce (SUM(CASE WHEN ops_orderdetail.ServiceNameEN = 'Laundry' then 1 else null end),0) AS CountService2,
coalesce (SUM(CASE WHEN ops_orderdetail.ServiceNameEN = 'Laundry' then ops_orderdetail.Amount else null end),0) AS SumService2,
coalesce (SUM(CASE WHEN ops_orderdetail.ServiceNameEN = 'Spa Leathers' then 1 else null end),0) AS CountService3,
coalesce (SUM(CASE WHEN ops_orderdetail.ServiceNameEN = 'Spa Leathers' then ops_orderdetail.Amount else null end),0) AS SumService3,
((sum(Amount)+sum((Amount)*coalesce(ExpressRate,0))/100)+sum(coalesce(ops_orderdetail.AdditionAmount,0)))-sum(coalesce(ops_orderdetail.DiscountAmount,0)) as total,
CASE WHEN ops_order.IsPayment = 1 then 'ชำระเงิน' else 'ค้างชำระ' end as IsPayment
from ((ops_order left join
(ops_orderdetail left join mas_product on ops_orderdetail.ProductID=mas_product.ProductID)
on ops_order.OrderNo=ops_orderdetail.OrderNo)
left join mas_priceexpression on ops_order.IsExpressLevel=mas_priceexpression.IsExpressLevel)
left join (mas_branch
left join mas_branchtype on mas_branch.BranchType=mas_branchtype.BranchTypeID)
on ops_order.BranchID=mas_branch.BranchID
WHERE  ops_order.OrderDate between '".$getDate_start."' AND '".$getDate_end."' AND ops_order.IsActive='1'
Group By ops_order.OrderDate,ops_order.OrderNo,IsPayment
Order By ops_order.OrderNo DESC";

			$stmt1="select top 10 ops_order.OrderNo,sum(PromoDiscount) as PromoDiscount,
coalesce(sum(SpecialDiscount),0) as SpecialDiscount,
coalesce(sum(MemberDiscount),0) as MemberDiscount,
ops_order.NetAmount
from (ops_order
left join (mas_branch left join mas_branchtype on mas_branch.BranchID=mas_branchtype.BranchTypeID)
on ops_order.BranchID=mas_branch.BranchID)
WHERE  ops_order.OrderDate between '".$getDate_start."' AND '".$getDate_end."' AND ops_order.IsActive='1'
GROUP BY ops_order.OrderNo,ops_order.NetAmount
Order By ops_order.OrderNo DESC";

			$stmt2="select top 10 ops_order.OrderNo,count(ops_coupondiscount.OrderID) as couponCount
from (ops_order left join (mas_branch left join mas_branchtype on mas_branch.BranchID=mas_branchtype.BranchTypeID)
on ops_order.BranchID=mas_branch.BranchID) left join ops_coupondiscount on ops_order.OrderNo=ops_coupondiscount.OrderID
WHERE  ops_order.OrderDate between '".$getDate_start."' AND '".$getDate_end."' AND ops_order.IsActive='1'
GROUP BY ops_order.OrderNo,ops_order.NetAmount
Order By ops_order.OrderNo DESC";
		}
	}else if($getTop=='20'){
		echo 'top '.$getTop;
		if($getBranchID!='cheese'&&$getBranchType=='cheese'){
			$stmt = "select top 20 ops_order.OrderDate,ops_order.OrderNo,
coalesce (SUM(CASE WHEN ops_orderdetail.ServiceNameEN = 'Dry Clean' then 1 else null end),0) AS CountService1,
coalesce (SUM(CASE WHEN ops_orderdetail.ServiceNameEN = 'Dry Clean' then ops_orderdetail.Amount else null end),0) AS SumService1,
coalesce (SUM(CASE WHEN ops_orderdetail.ServiceNameEN = 'Laundry' then 1 else null end),0) AS CountService2,
coalesce (SUM(CASE WHEN ops_orderdetail.ServiceNameEN = 'Laundry' then ops_orderdetail.Amount else null end),0) AS SumService2,
coalesce (SUM(CASE WHEN ops_orderdetail.ServiceNameEN = 'Spa Leathers' then 1 else null end),0) AS CountService3,
coalesce (SUM(CASE WHEN ops_orderdetail.ServiceNameEN = 'Spa Leathers' then ops_orderdetail.Amount else null end),0) AS SumService3,
((sum(Amount)+sum((Amount)*coalesce(ExpressRate,0))/100)+sum(coalesce(ops_orderdetail.AdditionAmount,0)))-sum(coalesce(ops_orderdetail.DiscountAmount,0)) as total,
CASE WHEN ops_order.IsPayment = 1 then 'ชำระเงิน' else 'ค้างชำระ' end as IsPayment
from ((ops_order left join
(ops_orderdetail left join mas_product on ops_orderdetail.ProductID=mas_product.ProductID)
on ops_order.OrderNo=ops_orderdetail.OrderNo)
left join mas_priceexpression on ops_order.IsExpressLevel=mas_priceexpression.IsExpressLevel)
left join (mas_branch
left join mas_branchtype on mas_branch.BranchType=mas_branchtype.BranchTypeID)
on ops_order.BranchID=mas_branch.BranchID
WHERE  ops_order.OrderDate between '".$getDate_start."' AND '".$getDate_end."' AND ops_order.IsActive='1' AND mas_branch.BranchID='".$getBranchID."'
Group By ops_order.OrderDate,ops_order.OrderNo,IsPayment
Order By ops_order.OrderNo DESC";

			$stmt1="select top 20 ops_order.OrderNo,sum(PromoDiscount) as PromoDiscount,
coalesce(sum(SpecialDiscount),0) as SpecialDiscount,
coalesce(sum(MemberDiscount),0) as MemberDiscount,
ops_order.NetAmount
from (ops_order
left join (mas_branch left join mas_branchtype on mas_branch.BranchID=mas_branchtype.BranchTypeID)
on ops_order.BranchID=mas_branch.BranchID)
WHERE  ops_order.OrderDate between '".$getDate_start."' AND '".$getDate_end."' AND ops_order.IsActive='1' AND mas_branch.BranchID='".$getBranchID."'
GROUP BY ops_order.OrderNo,ops_order.NetAmount
Order By ops_order.OrderNo DESC";

			$stmt2="select top 20 ops_order.OrderNo,count(ops_coupondiscount.OrderID) as couponCount
from (ops_order left join (mas_branch left join mas_branchtype on mas_branch.BranchID=mas_branchtype.BranchTypeID)
on ops_order.BranchID=mas_branch.BranchID) left join ops_coupondiscount on ops_order.OrderNo=ops_coupondiscount.OrderID
WHERE  ops_order.OrderDate between '".$getDate_start."' AND '".$getDate_end."' AND ops_order.IsActive='1' AND mas_branch.BranchID='".$getBranchID."'
GROUP BY ops_order.OrderNo,ops_order.NetAmount
Order By ops_order.OrderNo DESC";
		}else if($getBranchID=='cheese'&&$getBranchType!='cheese'){
			$stmt = "select top 20 ops_order.OrderDate,ops_order.OrderNo,
coalesce (SUM(CASE WHEN ops_orderdetail.ServiceNameEN = 'Dry Clean' then 1 else null end),0) AS CountService1,
coalesce (SUM(CASE WHEN ops_orderdetail.ServiceNameEN = 'Dry Clean' then ops_orderdetail.Amount else null end),0) AS SumService1,
coalesce (SUM(CASE WHEN ops_orderdetail.ServiceNameEN = 'Laundry' then 1 else null end),0) AS CountService2,
coalesce (SUM(CASE WHEN ops_orderdetail.ServiceNameEN = 'Laundry' then ops_orderdetail.Amount else null end),0) AS SumService2,
coalesce (SUM(CASE WHEN ops_orderdetail.ServiceNameEN = 'Spa Leathers' then 1 else null end),0) AS CountService3,
coalesce (SUM(CASE WHEN ops_orderdetail.ServiceNameEN = 'Spa Leathers' then ops_orderdetail.Amount else null end),0) AS SumService3,
((sum(Amount)+sum((Amount)*coalesce(ExpressRate,0))/100)+sum(coalesce(ops_orderdetail.AdditionAmount,0)))-sum(coalesce(ops_orderdetail.DiscountAmount,0)) as total,
CASE WHEN ops_order.IsPayment = 1 then 'ชำระเงิน' else 'ค้างชำระ' end as IsPayment
from ((ops_order left join
(ops_orderdetail left join mas_product on ops_orderdetail.ProductID=mas_product.ProductID)
on ops_order.OrderNo=ops_orderdetail.OrderNo)
left join mas_priceexpression on ops_order.IsExpressLevel=mas_priceexpression.IsExpressLevel)
left join (mas_branch
left join mas_branchtype on mas_branch.BranchType=mas_branchtype.BranchTypeID)
on ops_order.BranchID=mas_branch.BranchID
WHERE  ops_order.OrderDate between '".$getDate_start."' AND '".$getDate_end."' AND ops_order.IsActive='1' AND mas_branch.BranchType='".$getBranchType."'
Group By ops_order.OrderDate,ops_order.OrderNo,IsPayment
Order By ops_order.OrderNo DESC";

			$stmt1="select top 20 ops_order.OrderNo,sum(PromoDiscount) as PromoDiscount,
coalesce(sum(SpecialDiscount),0) as SpecialDiscount,
coalesce(sum(MemberDiscount),0) as MemberDiscount,
ops_order.NetAmount
from (ops_order
left join (mas_branch left join mas_branchtype on mas_branch.BranchID=mas_branchtype.BranchTypeID)
on ops_order.BranchID=mas_branch.BranchID)
WHERE  ops_order.OrderDate between '".$getDate_start."' AND '".$getDate_end."' AND ops_order.IsActive='1' AND mas_branch.BranchType='".$getBranchType."'
GROUP BY ops_order.OrderNo,ops_order.NetAmount
Order By ops_order.OrderNo DESC";

			$stmt2="select top 20 ops_order.OrderNo,count(ops_coupondiscount.OrderID) as couponCount
from (ops_order left join (mas_branch left join mas_branchtype on mas_branch.BranchID=mas_branchtype.BranchTypeID)
on ops_order.BranchID=mas_branch.BranchID) left join ops_coupondiscount on ops_order.OrderNo=ops_coupondiscount.OrderID
WHERE  ops_order.OrderDate between '".$getDate_start."' AND '".$getDate_end."' AND ops_order.IsActive='1' AND mas_branch.BranchType='".$getBranchType."'
GROUP BY ops_order.OrderNo,ops_order.NetAmount
Order By ops_order.OrderNo DESC";
		}else{
			$stmt = "select top 20 ops_order.OrderDate,ops_order.OrderNo,
coalesce (SUM(CASE WHEN ops_orderdetail.ServiceNameEN = 'Dry Clean' then 1 else null end),0) AS CountService1,
coalesce (SUM(CASE WHEN ops_orderdetail.ServiceNameEN = 'Dry Clean' then ops_orderdetail.Amount else null end),0) AS SumService1,
coalesce (SUM(CASE WHEN ops_orderdetail.ServiceNameEN = 'Laundry' then 1 else null end),0) AS CountService2,
coalesce (SUM(CASE WHEN ops_orderdetail.ServiceNameEN = 'Laundry' then ops_orderdetail.Amount else null end),0) AS SumService2,
coalesce (SUM(CASE WHEN ops_orderdetail.ServiceNameEN = 'Spa Leathers' then 1 else null end),0) AS CountService3,
coalesce (SUM(CASE WHEN ops_orderdetail.ServiceNameEN = 'Spa Leathers' then ops_orderdetail.Amount else null end),0) AS SumService3,
((sum(Amount)+sum((Amount)*coalesce(ExpressRate,0))/100)+sum(coalesce(ops_orderdetail.AdditionAmount,0)))-sum(coalesce(ops_orderdetail.DiscountAmount,0)) as total,
CASE WHEN ops_order.IsPayment = 1 then 'ชำระเงิน' else 'ค้างชำระ' end as IsPayment
from ((ops_order left join
(ops_orderdetail left join mas_product on ops_orderdetail.ProductID=mas_product.ProductID)
on ops_order.OrderNo=ops_orderdetail.OrderNo)
left join mas_priceexpression on ops_order.IsExpressLevel=mas_priceexpression.IsExpressLevel)
left join (mas_branch
left join mas_branchtype on mas_branch.BranchType=mas_branchtype.BranchTypeID)
on ops_order.BranchID=mas_branch.BranchID
WHERE  ops_order.OrderDate between '".$getDate_start."' AND '".$getDate_end."' AND ops_order.IsActive='1'
Group By ops_order.OrderDate,ops_order.OrderNo,IsPayment
Order By ops_order.OrderNo DESC";

			$stmt1="select top 20 ops_order.OrderNo,sum(PromoDiscount) as PromoDiscount,
coalesce(sum(SpecialDiscount),0) as SpecialDiscount,
coalesce(sum(MemberDiscount),0) as MemberDiscount,
ops_order.NetAmount
from (ops_order
left join (mas_branch left join mas_branchtype on mas_branch.BranchID=mas_branchtype.BranchTypeID)
on ops_order.BranchID=mas_branch.BranchID)
WHERE  ops_order.OrderDate between '".$getDate_start."' AND '".$getDate_end."' AND ops_order.IsActive='1'
GROUP BY ops_order.OrderNo,ops_order.NetAmount
Order By ops_order.OrderNo DESC";

			$stmt2="select top 20 ops_order.OrderNo,count(ops_coupondiscount.OrderID) as couponCount
from (ops_order left join (mas_branch left join mas_branchtype on mas_branch.BranchID=mas_branchtype.BranchTypeID)
on ops_order.BranchID=mas_branch.BranchID) left join ops_coupondiscount on ops_order.OrderNo=ops_coupondiscount.OrderID
WHERE  ops_order.OrderDate between '".$getDate_start."' AND '".$getDate_end."' AND ops_order.IsActive='1'
GROUP BY ops_order.OrderNo,ops_order.NetAmount
Order By ops_order.OrderNo DESC";
		}
	}else if($getTop=='30'){
		echo 'top '.$getTop;
		if($getBranchID!='cheese'&&$getBranchType=='cheese'){
			$stmt = "select top 30 ops_order.OrderDate,ops_order.OrderNo,
coalesce (SUM(CASE WHEN ops_orderdetail.ServiceNameEN = 'Dry Clean' then 1 else null end),0) AS CountService1,
coalesce (SUM(CASE WHEN ops_orderdetail.ServiceNameEN = 'Dry Clean' then ops_orderdetail.Amount else null end),0) AS SumService1,
coalesce (SUM(CASE WHEN ops_orderdetail.ServiceNameEN = 'Laundry' then 1 else null end),0) AS CountService2,
coalesce (SUM(CASE WHEN ops_orderdetail.ServiceNameEN = 'Laundry' then ops_orderdetail.Amount else null end),0) AS SumService2,
coalesce (SUM(CASE WHEN ops_orderdetail.ServiceNameEN = 'Spa Leathers' then 1 else null end),0) AS CountService3,
coalesce (SUM(CASE WHEN ops_orderdetail.ServiceNameEN = 'Spa Leathers' then ops_orderdetail.Amount else null end),0) AS SumService3,
((sum(Amount)+sum((Amount)*coalesce(ExpressRate,0))/100)+sum(coalesce(ops_orderdetail.AdditionAmount,0)))-sum(coalesce(ops_orderdetail.DiscountAmount,0)) as total,
CASE WHEN ops_order.IsPayment = 1 then 'ชำระเงิน' else 'ค้างชำระ' end as IsPayment
from ((ops_order left join
(ops_orderdetail left join mas_product on ops_orderdetail.ProductID=mas_product.ProductID)
on ops_order.OrderNo=ops_orderdetail.OrderNo)
left join mas_priceexpression on ops_order.IsExpressLevel=mas_priceexpression.IsExpressLevel)
left join (mas_branch
left join mas_branchtype on mas_branch.BranchType=mas_branchtype.BranchTypeID)
on ops_order.BranchID=mas_branch.BranchID
WHERE  ops_order.OrderDate between '".$getDate_start."' AND '".$getDate_end."' AND ops_order.IsActive='1' AND mas_branch.BranchID='".$getBranchID."'
Group By ops_order.OrderDate,ops_order.OrderNo,IsPayment
Order By ops_order.OrderNo DESC";

			$stmt1="select top 30 ops_order.OrderNo,sum(PromoDiscount) as PromoDiscount,
coalesce(sum(SpecialDiscount),0) as SpecialDiscount,
coalesce(sum(MemberDiscount),0) as MemberDiscount,
ops_order.NetAmount
from (ops_order
left join (mas_branch left join mas_branchtype on mas_branch.BranchID=mas_branchtype.BranchTypeID)
on ops_order.BranchID=mas_branch.BranchID)
WHERE  ops_order.OrderDate between '".$getDate_start."' AND '".$getDate_end."' AND ops_order.IsActive='1' AND mas_branch.BranchID='".$getBranchID."'
GROUP BY ops_order.OrderNo,ops_order.NetAmount
Order By ops_order.OrderNo DESC";

			$stmt2="select top 30 ops_order.OrderNo,count(ops_coupondiscount.OrderID) as couponCount
from (ops_order left join (mas_branch left join mas_branchtype on mas_branch.BranchID=mas_branchtype.BranchTypeID)
on ops_order.BranchID=mas_branch.BranchID) left join ops_coupondiscount on ops_order.OrderNo=ops_coupondiscount.OrderID
WHERE  ops_order.OrderDate between '".$getDate_start."' AND '".$getDate_end."' AND ops_order.IsActive='1' AND mas_branch.BranchID='".$getBranchID."'
GROUP BY ops_order.OrderNo,ops_order.NetAmount
Order By ops_order.OrderNo DESC";
		}else if($getBranchID=='cheese'&&$getBranchType!='cheese'){
			$stmt = "select top 30 ops_order.OrderDate,ops_order.OrderNo,
coalesce (SUM(CASE WHEN ops_orderdetail.ServiceNameEN = 'Dry Clean' then 1 else null end),0) AS CountService1,
coalesce (SUM(CASE WHEN ops_orderdetail.ServiceNameEN = 'Dry Clean' then ops_orderdetail.Amount else null end),0) AS SumService1,
coalesce (SUM(CASE WHEN ops_orderdetail.ServiceNameEN = 'Laundry' then 1 else null end),0) AS CountService2,
coalesce (SUM(CASE WHEN ops_orderdetail.ServiceNameEN = 'Laundry' then ops_orderdetail.Amount else null end),0) AS SumService2,
coalesce (SUM(CASE WHEN ops_orderdetail.ServiceNameEN = 'Spa Leathers' then 1 else null end),0) AS CountService3,
coalesce (SUM(CASE WHEN ops_orderdetail.ServiceNameEN = 'Spa Leathers' then ops_orderdetail.Amount else null end),0) AS SumService3,
((sum(Amount)+sum((Amount)*coalesce(ExpressRate,0))/100)+sum(coalesce(ops_orderdetail.AdditionAmount,0)))-sum(coalesce(ops_orderdetail.DiscountAmount,0)) as total,
CASE WHEN ops_order.IsPayment = 1 then 'ชำระเงิน' else 'ค้างชำระ' end as IsPayment
from ((ops_order left join
(ops_orderdetail left join mas_product on ops_orderdetail.ProductID=mas_product.ProductID)
on ops_order.OrderNo=ops_orderdetail.OrderNo)
left join mas_priceexpression on ops_order.IsExpressLevel=mas_priceexpression.IsExpressLevel)
left join (mas_branch
left join mas_branchtype on mas_branch.BranchType=mas_branchtype.BranchTypeID)
on ops_order.BranchID=mas_branch.BranchID
WHERE  ops_order.OrderDate between '".$getDate_start."' AND '".$getDate_end."' AND ops_order.IsActive='1' AND mas_branch.BranchType='".$getBranchType."'
Group By ops_order.OrderDate,ops_order.OrderNo,IsPayment
Order By ops_order.OrderNo DESC";

			$stmt1="select top 30 ops_order.OrderNo,sum(PromoDiscount) as PromoDiscount,
coalesce(sum(SpecialDiscount),0) as SpecialDiscount,
coalesce(sum(MemberDiscount),0) as MemberDiscount,
ops_order.NetAmount
from (ops_order
left join (mas_branch left join mas_branchtype on mas_branch.BranchID=mas_branchtype.BranchTypeID)
on ops_order.BranchID=mas_branch.BranchID)
WHERE  ops_order.OrderDate between '".$getDate_start."' AND '".$getDate_end."' AND ops_order.IsActive='1' AND mas_branch.BranchType='".$getBranchType."'
GROUP BY ops_order.OrderNo,ops_order.NetAmount
Order By ops_order.OrderNo DESC";

			$stmt2="select top 30 ops_order.OrderNo,count(ops_coupondiscount.OrderID) as couponCount
from (ops_order left join (mas_branch left join mas_branchtype on mas_branch.BranchID=mas_branchtype.BranchTypeID)
on ops_order.BranchID=mas_branch.BranchID) left join ops_coupondiscount on ops_order.OrderNo=ops_coupondiscount.OrderID
WHERE  ops_order.OrderDate between '".$getDate_start."' AND '".$getDate_end."' AND ops_order.IsActive='1' AND mas_branch.BranchType='".$getBranchType."'
GROUP BY ops_order.OrderNo,ops_order.NetAmount
Order By ops_order.OrderNo DESC";
		}else{
			$stmt = "select top 30 ops_order.OrderDate,ops_order.OrderNo,
coalesce (SUM(CASE WHEN ops_orderdetail.ServiceNameEN = 'Dry Clean' then 1 else null end),0) AS CountService1,
coalesce (SUM(CASE WHEN ops_orderdetail.ServiceNameEN = 'Dry Clean' then ops_orderdetail.Amount else null end),0) AS SumService1,
coalesce (SUM(CASE WHEN ops_orderdetail.ServiceNameEN = 'Laundry' then 1 else null end),0) AS CountService2,
coalesce (SUM(CASE WHEN ops_orderdetail.ServiceNameEN = 'Laundry' then ops_orderdetail.Amount else null end),0) AS SumService2,
coalesce (SUM(CASE WHEN ops_orderdetail.ServiceNameEN = 'Spa Leathers' then 1 else null end),0) AS CountService3,
coalesce (SUM(CASE WHEN ops_orderdetail.ServiceNameEN = 'Spa Leathers' then ops_orderdetail.Amount else null end),0) AS SumService3,
((sum(Amount)+sum((Amount)*coalesce(ExpressRate,0))/100)+sum(coalesce(ops_orderdetail.AdditionAmount,0)))-sum(coalesce(ops_orderdetail.DiscountAmount,0)) as total,
CASE WHEN ops_order.IsPayment = 1 then 'ชำระเงิน' else 'ค้างชำระ' end as IsPayment
from ((ops_order left join
(ops_orderdetail left join mas_product on ops_orderdetail.ProductID=mas_product.ProductID)
on ops_order.OrderNo=ops_orderdetail.OrderNo)
left join mas_priceexpression on ops_order.IsExpressLevel=mas_priceexpression.IsExpressLevel)
left join (mas_branch
left join mas_branchtype on mas_branch.BranchType=mas_branchtype.BranchTypeID)
on ops_order.BranchID=mas_branch.BranchID
WHERE  ops_order.OrderDate between '".$getDate_start."' AND '".$getDate_end."' AND ops_order.IsActive='1'
Group By ops_order.OrderDate,ops_order.OrderNo,IsPayment
Order By ops_order.OrderNo DESC";

			$stmt1="select top 30 ops_order.OrderNo,sum(PromoDiscount) as PromoDiscount,
coalesce(sum(SpecialDiscount),0) as SpecialDiscount,
coalesce(sum(MemberDiscount),0) as MemberDiscount,
ops_order.NetAmount
from (ops_order
left join (mas_branch left join mas_branchtype on mas_branch.BranchID=mas_branchtype.BranchTypeID)
on ops_order.BranchID=mas_branch.BranchID)
WHERE  ops_order.OrderDate between '".$getDate_start."' AND '".$getDate_end."' AND ops_order.IsActive='1'
GROUP BY ops_order.OrderNo,ops_order.NetAmount
Order By ops_order.OrderNo DESC";

			$stmt2="select top 30 ops_order.OrderNo,count(ops_coupondiscount.OrderID) as couponCount
from (ops_order left join (mas_branch left join mas_branchtype on mas_branch.BranchID=mas_branchtype.BranchTypeID)
on ops_order.BranchID=mas_branch.BranchID) left join ops_coupondiscount on ops_order.OrderNo=ops_coupondiscount.OrderID
WHERE  ops_order.OrderDate between '".$getDate_start."' AND '".$getDate_end."' AND ops_order.IsActive='1'
GROUP BY ops_order.OrderNo,ops_order.NetAmount
Order By ops_order.OrderNo DESC";
		}
	}



		$query = sqlsrv_query($conn, $stmt);
		$query1 = sqlsrv_query($conn, $stmt1);
		$query2 = sqlsrv_query($conn, $stmt2);
		$resultData = array();
		$resultData1 = array();
		$resultData2 = array();
    	while($row = sqlsrv_fetch_array($query, SQLSRV_FETCH_ASSOC))
    	{
 			array_push($resultData,$row);
    	}
		while($row = sqlsrv_fetch_array($query1, SQLSRV_FETCH_ASSOC))
    	{
 			array_push($resultData1,$row);
    	}
		while($row = sqlsrv_fetch_array($query2, SQLSRV_FETCH_ASSOC))
    	{
 			array_push($resultData2,$row);
    	}

		$dates=date('Y-m-d');
		
		$header=array('ลำดับ','วันที่','เลขที่บิล','ซักแห้ง','ซักน้ำ','สปาเครื่องหนัง','รีด','');

		$pdf=new PDF();
		$pdf->AddPage();
		$pdf->AliasNbPages();
		$pdf->AddFont('AngsanaNew','','angsa.php');
		$pdf->SetFont('AngsanaNew','',12);
		$pdf->BasicTable($header,$resultData,$resultData1,$resultData2,$getDate_start.' - '.$getDate_end,$branchName,$branchCode, $branchType,$getTop);
		$pdf->Output("MyPDF/File-Report.pdf","F");
		header("Location: MyPDF/File-Report.pdf");
		
?>
</body>
</html>