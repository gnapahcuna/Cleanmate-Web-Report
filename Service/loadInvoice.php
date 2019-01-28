<?php
include("config.php");
$getTop='undefined';
$getBranchID=$_GET['branchID'];
$branchCode=$_GET['branchCode'];
$getBranchType=$_GET['branchType'];
$getDate_start=$_GET['date_start'];
$getDate_end=$_GET['date_end'];

if($getTop=='undefined'){
		if($getBranchID!='cheese'&&$getBranchType=='cheese'){
			$stmt = "select ops_order.OrderDate,ops_order.OrderNo,
coalesce (SUM(CASE WHEN ops_orderdetail.ServiceNameEN = 'Dry Clean' then 1 else null end),0) AS CountService1,
coalesce (SUM(CASE WHEN ops_orderdetail.ServiceNameEN = 'Dry Clean' then (ops_orderdetail.Amount + coalesce(ops_orderdetail.AdditionAmount,0))-coalesce(ops_orderdetail.DiscountAmount,0) else null end),0) AS SumService1,
coalesce (SUM(CASE WHEN ops_orderdetail.ServiceNameEN = 'Laundry' then 1 else null end),0) + 
coalesce (SUM(CASE WHEN ops_orderdetail.ServiceNameEN = 'hand wash' then 1 else null end),0) AS CountService2,
coalesce (SUM(CASE WHEN ops_orderdetail.ServiceNameEN = 'Laundry' then (ops_orderdetail.Amount + coalesce(ops_orderdetail.AdditionAmount,0))-coalesce(ops_orderdetail.DiscountAmount,0) else null end),0) +
coalesce (SUM(CASE WHEN ops_orderdetail.ServiceNameEN = 'hand wash' then (ops_orderdetail.Amount + coalesce(ops_orderdetail.AdditionAmount,0))-coalesce(ops_orderdetail.DiscountAmount,0) else null end),0) AS SumService2,
coalesce (SUM(CASE WHEN ops_orderdetail.ServiceNameEN = 'Spa Leathers' then 1 else null end),0) AS CountService3,
coalesce (SUM(CASE WHEN ops_orderdetail.ServiceNameEN = 'Spa Leathers' then (ops_orderdetail.Amount + coalesce(ops_orderdetail.AdditionAmount,0))-coalesce(ops_orderdetail.DiscountAmount,0) else null end),0) AS SumService3,
coalesce (SUM(CASE WHEN ops_orderdetail.ServiceNameEN = 'Press Only' then 1 else null end),0) AS CountService4,
coalesce (SUM(CASE WHEN ops_orderdetail.ServiceNameEN = 'Press Only' then (ops_orderdetail.Amount + coalesce(ops_orderdetail.AdditionAmount,0))-coalesce(ops_orderdetail.DiscountAmount,0) else null end),0) AS SumService4,
coalesce (SUM(CASE WHEN ops_orderdetail.ServiceNameEN = 'Other' AND (mas_product.ProductID=360 OR mas_product.ProductID=361 OR mas_product.ProductID=362)
then 1 else null end),0) AS CountService5,
coalesce (SUM(CASE WHEN ops_orderdetail.ServiceNameEN = 'Other' AND (mas_product.ProductID=360 OR mas_product.ProductID=361 OR mas_product.ProductID=362)
then (ops_orderdetail.Amount + coalesce(ops_orderdetail.AdditionAmount,0))-coalesce(ops_orderdetail.DiscountAmount,0) else null end),0) AS SumService5,
((sum(Amount)+sum((Amount)*coalesce(ExpressRate,0))/100)+sum(coalesce(ops_orderdetail.AdditionAmount,0)))-sum(coalesce(ops_orderdetail.DiscountAmount,0)) as total,
CASE WHEN ops_order.IsPayment = 1 then 1 else 0 end as IsPayment,PromoDiscount,MemberDiscount
from ((ops_order left join
(ops_orderdetail left join mas_product on ops_orderdetail.ProductID=mas_product.ProductID)
on ops_order.OrderNo=ops_orderdetail.OrderNo)
left join mas_priceexpression on ops_order.IsExpressLevel=mas_priceexpression.IsExpressLevel)
left join (mas_branch
left join mas_branchtype on mas_branch.BranchType=mas_branchtype.BranchTypeID)
on ops_order.BranchID=mas_branch.BranchID
WHERE  ops_order.OrderDate between '".$getDate_start."' AND '".$getDate_end."' AND ops_order.IsActive='1' AND mas_branch.BranchID='".$getBranchID."'
Group By ops_order.OrderDate,ops_order.OrderNo,IsPayment,PromoDiscount,MemberDiscount
Order By ops_order.OrderNo ASC";

			$stmt1="select ops_order.OrderNo,sum(PromoDiscount) as PromoDiscount,
coalesce(sum(SpecialDiscount),0) as SpecialDiscount,
coalesce(sum(MemberDiscount),0) as MemberDiscount,
ops_order.NetAmount
from (ops_order
left join (mas_branch left join mas_branchtype on mas_branch.BranchID=mas_branchtype.BranchTypeID)
on ops_order.BranchID=mas_branch.BranchID)
WHERE  ops_order.OrderDate between '".$getDate_start."' AND '".$getDate_end."' AND ops_order.IsActive='1' AND mas_branch.BranchID='".$getBranchID."'
GROUP BY ops_order.OrderNo,ops_order.NetAmount
Order By ops_order.OrderNo ASC";

			$stmt2="select ops_order.OrderNo,count(ops_coupondiscount.OrderID) as couponCount,
coalesce (SUM(CASE WHEN ops_coupondiscount.Type = 1 then 1 else null end),0) AS couponCount1,
coalesce (SUM(CASE WHEN ops_coupondiscount.Type = 3 then 1 else null end),0) AS couponCount2
from (ops_order left join (mas_branch left join mas_branchtype on mas_branch.BranchID=mas_branchtype.BranchTypeID)
on ops_order.BranchID=mas_branch.BranchID) left join ops_coupondiscount on ops_order.OrderNo=ops_coupondiscount.OrderID
WHERE  ops_order.OrderDate between '".$getDate_start."' AND '".$getDate_end."' AND ops_order.IsActive='1' AND mas_branch.BranchID='".$getBranchID."'
GROUP BY ops_order.OrderNo,ops_order.NetAmount
Order By ops_order.OrderNo ASC";

$stmt3="select coalesce (SUM(CASE WHEN mas_supplies.SuppliesID = 1 then 1 else null end),0) AS Count1,
coalesce (SUM(CASE WHEN mas_supplies.SuppliesID = 2 then 1 else null end),0) AS Count2,
coalesce (SUM(CASE WHEN mas_supplies.SuppliesID = 3 then 1 else null end),0) AS Count3,
coalesce (SUM(CASE WHEN mas_supplies.SuppliesID = 4 then 1 else null end),0) AS Count4,
coalesce (SUM(CASE WHEN mas_supplies.SuppliesID = 5 then 1 else null end),0) AS Count5,
coalesce (SUM(CASE WHEN mas_supplies.SuppliesID = 6 then 1 else null end),0) AS Count6,
coalesce (SUM(CASE WHEN mas_supplies.SuppliesID = 7 then 1 else null end),0) AS Count7,
coalesce (SUM(CASE WHEN mas_supplies.SuppliesID = 8 then 1 else null end),0) AS Count8,
coalesce (SUM(CASE WHEN mas_supplies.SuppliesID = 9 then 1 else null end),0) AS Count9,
coalesce (SUM(CASE WHEN mas_supplies.SuppliesID = 10 then 1 else null end),0) AS Count10,
coalesce (SUM(CASE WHEN mas_supplies.SuppliesID = 11 then 1 else null end),0) AS Count11,
coalesce (SUM(CASE WHEN mas_supplies.SuppliesID = 12 then 1 else null end),0) AS Count12,
coalesce (SUM(CASE WHEN mas_supplies.SuppliesID = 13 then 1 else null end),0) AS Count13,
coalesce (SUM(CASE WHEN mas_supplies.SuppliesID = 14 then 1 else null end),0) AS Count14,
coalesce (SUM(CASE WHEN mas_supplies.SuppliesID = 15 then 1 else null end),0) AS Count15,
coalesce (SUM(CASE WHEN mas_supplies.SuppliesID = 16 then 1 else null end),0) AS Count16,
coalesce (SUM(CASE WHEN mas_supplies.SuppliesID = 17 then 1 else null end),0) AS Count17,
coalesce (SUM(CASE WHEN mas_supplies.SuppliesID = 18 then 1 else null end),0) AS Count18,
coalesce (SUM(CASE WHEN mas_supplies.SuppliesID = 17 then 1 else null end*Price),0) AS Sum17,
coalesce (SUM(CASE WHEN mas_supplies.SuppliesID = 18 then 1 else null end*Price),0) AS Sum18
from (mas_supplies left join ops_orderdetailsupplies on mas_supplies.SuppliesID=ops_orderdetailsupplies.SuppliesID)
left join (ops_ordersupplies left join mas_branch on ops_ordersupplies.BranchID=mas_branch.BranchID)
on ops_orderdetailsupplies.OrderNo=ops_ordersupplies.OrderNo
where OrderSuppliesDate between '".$getDate_start."' AND '".$getDate_end."' and ops_ordersupplies.IsActive=1 and mas_branch.BranchID='".$getBranchID."'";


		}else if($getBranchID=='cheese'&&$getBranchType!='cheese'){
			$stmt = "select ops_order.OrderDate,ops_order.OrderNo,
coalesce (SUM(CASE WHEN ops_orderdetail.ServiceNameEN = 'Dry Clean' then 1 else null end),0) AS CountService1,
coalesce (SUM(CASE WHEN ops_orderdetail.ServiceNameEN = 'Dry Clean' then (ops_orderdetail.Amount + coalesce(ops_orderdetail.AdditionAmount,0))-coalesce(ops_orderdetail.DiscountAmount,0) else null end),0) AS SumService1,
coalesce (SUM(CASE WHEN ops_orderdetail.ServiceNameEN = 'Laundry' then 1 else null end),0) + 
coalesce (SUM(CASE WHEN ops_orderdetail.ServiceNameEN = 'hand wash' then 1 else null end),0) AS CountService2,
coalesce (SUM(CASE WHEN ops_orderdetail.ServiceNameEN = 'Laundry' then (ops_orderdetail.Amount + coalesce(ops_orderdetail.AdditionAmount,0))-coalesce(ops_orderdetail.DiscountAmount,0) else null end),0) +
coalesce (SUM(CASE WHEN ops_orderdetail.ServiceNameEN = 'hand wash' then (ops_orderdetail.Amount + coalesce(ops_orderdetail.AdditionAmount,0))-coalesce(ops_orderdetail.DiscountAmount,0) else null end),0) AS SumService2,
coalesce (SUM(CASE WHEN ops_orderdetail.ServiceNameEN = 'Spa Leathers' then 1 else null end),0) AS CountService3,
coalesce (SUM(CASE WHEN ops_orderdetail.ServiceNameEN = 'Spa Leathers' then (ops_orderdetail.Amount + coalesce(ops_orderdetail.AdditionAmount,0))-coalesce(ops_orderdetail.DiscountAmount,0) else null end),0) AS SumService3,
coalesce (SUM(CASE WHEN ops_orderdetail.ServiceNameEN = 'Press Only' then 1 else null end),0) AS CountService4,
coalesce (SUM(CASE WHEN ops_orderdetail.ServiceNameEN = 'Press Only' then (ops_orderdetail.Amount + coalesce(ops_orderdetail.AdditionAmount,0))-coalesce(ops_orderdetail.DiscountAmount,0) else null end),0) AS SumService4,
coalesce (SUM(CASE WHEN ops_orderdetail.ServiceNameEN = 'Other' AND (mas_product.ProductID=360 OR mas_product.ProductID=361 OR mas_product.ProductID=362)
then 1 else null end),0) AS CountService5,
coalesce (SUM(CASE WHEN ops_orderdetail.ServiceNameEN = 'Other' AND (mas_product.ProductID=360 OR mas_product.ProductID=361 OR mas_product.ProductID=362)
then (ops_orderdetail.Amount + coalesce(ops_orderdetail.AdditionAmount,0))-coalesce(ops_orderdetail.DiscountAmount,0) else null end),0) AS SumService5,
((sum(Amount)+sum((Amount)*coalesce(ExpressRate,0))/100)+sum(coalesce(ops_orderdetail.AdditionAmount,0)))-sum(coalesce(ops_orderdetail.DiscountAmount,0)) as total,
CASE WHEN ops_order.IsPayment = 1 then 1 else 0 end as IsPayment,PromoDiscount,MemberDiscount
from ((ops_order left join
(ops_orderdetail left join mas_product on ops_orderdetail.ProductID=mas_product.ProductID)
on ops_order.OrderNo=ops_orderdetail.OrderNo)
left join mas_priceexpression on ops_order.IsExpressLevel=mas_priceexpression.IsExpressLevel)
left join (mas_branch
left join mas_branchtype on mas_branch.BranchType=mas_branchtype.BranchTypeID)
on ops_order.BranchID=mas_branch.BranchID
WHERE  ops_order.OrderDate between '".$getDate_start."' AND '".$getDate_end."' AND ops_order.IsActive='1' AND mas_branch.BranchType='".$getBranchType."'
Group By ops_order.OrderDate,ops_order.OrderNo,IsPayment,PromoDiscount,MemberDiscount
Order By ops_order.OrderNo ASC";


			$stmt1="select ops_order.OrderNo,sum(PromoDiscount) as PromoDiscount,
coalesce(sum(SpecialDiscount),0) as SpecialDiscount,
coalesce(sum(MemberDiscount),0) as MemberDiscount,
ops_order.NetAmount
from (ops_order
left join (mas_branch left join mas_branchtype on mas_branch.BranchID=mas_branchtype.BranchTypeID)
on ops_order.BranchID=mas_branch.BranchID)
WHERE  ops_order.OrderDate between '".$getDate_start."' AND '".$getDate_end."' AND ops_order.IsActive='1' AND mas_branch.BranchType='".$getBranchType."'
GROUP BY ops_order.OrderNo,ops_order.NetAmount
Order By ops_order.OrderNo ASC";

			$stmt2="select ops_order.OrderNo,count(ops_coupondiscount.OrderID) as couponCount,
coalesce (SUM(CASE WHEN ops_coupondiscount.Type = 1 then 1 else null end),0) AS couponCount1,
coalesce (SUM(CASE WHEN ops_coupondiscount.Type = 3 then 1 else null end),0) AS couponCount2
from (ops_order left join (mas_branch left join mas_branchtype on mas_branch.BranchID=mas_branchtype.BranchTypeID)
on ops_order.BranchID=mas_branch.BranchID) left join ops_coupondiscount on ops_order.OrderNo=ops_coupondiscount.OrderID
WHERE  ops_order.OrderDate between '".$getDate_start."' AND '".$getDate_end."' AND ops_order.IsActive='1' AND mas_branch.BranchType='".$getBranchType."'
GROUP BY ops_order.OrderNo,ops_order.NetAmount
Order By ops_order.OrderNo ASC";

			
			$stmt3="select coalesce (SUM(CASE WHEN mas_supplies.SuppliesID = 1 then 1 else null end),0) AS Count1,
coalesce (SUM(CASE WHEN mas_supplies.SuppliesID = 2 then 1 else null end),0) AS Count2,
coalesce (SUM(CASE WHEN mas_supplies.SuppliesID = 3 then 1 else null end),0) AS Count3,
coalesce (SUM(CASE WHEN mas_supplies.SuppliesID = 4 then 1 else null end),0) AS Count4,
coalesce (SUM(CASE WHEN mas_supplies.SuppliesID = 5 then 1 else null end),0) AS Count5,
coalesce (SUM(CASE WHEN mas_supplies.SuppliesID = 6 then 1 else null end),0) AS Count6,
coalesce (SUM(CASE WHEN mas_supplies.SuppliesID = 7 then 1 else null end),0) AS Count7,
coalesce (SUM(CASE WHEN mas_supplies.SuppliesID = 8 then 1 else null end),0) AS Count8,
coalesce (SUM(CASE WHEN mas_supplies.SuppliesID = 9 then 1 else null end),0) AS Count9,
coalesce (SUM(CASE WHEN mas_supplies.SuppliesID = 10 then 1 else null end),0) AS Count10,
coalesce (SUM(CASE WHEN mas_supplies.SuppliesID = 11 then 1 else null end),0) AS Count11,
coalesce (SUM(CASE WHEN mas_supplies.SuppliesID = 12 then 1 else null end),0) AS Count12,
coalesce (SUM(CASE WHEN mas_supplies.SuppliesID = 13 then 1 else null end),0) AS Count13,
coalesce (SUM(CASE WHEN mas_supplies.SuppliesID = 14 then 1 else null end),0) AS Count14,
coalesce (SUM(CASE WHEN mas_supplies.SuppliesID = 15 then 1 else null end),0) AS Count15,
coalesce (SUM(CASE WHEN mas_supplies.SuppliesID = 16 then 1 else null end),0) AS Count16,
coalesce (SUM(CASE WHEN mas_supplies.SuppliesID = 17 then 1 else null end),0) AS Count17,
coalesce (SUM(CASE WHEN mas_supplies.SuppliesID = 18 then 1 else null end),0) AS Count18,
coalesce (SUM(CASE WHEN mas_supplies.SuppliesID = 17 then 1 else null end*Price),0) AS Sum17,
coalesce (SUM(CASE WHEN mas_supplies.SuppliesID = 18 then 1 else null end*Price),0) AS Sum18
from (mas_supplies left join ops_orderdetailsupplies on mas_supplies.SuppliesID=ops_orderdetailsupplies.SuppliesID)
left join (ops_ordersupplies left join mas_branch on ops_ordersupplies.BranchID=mas_branch.BranchID)
on ops_orderdetailsupplies.OrderNo=ops_ordersupplies.OrderNo
where OrderSuppliesDate between '".$getDate_start."' AND '".$getDate_end."' and ops_ordersupplies.IsActive=1 and mas_branch.BranchType='".$getBranchType."'";
		}else{
			$stmt = "select ops_order.OrderDate,ops_order.OrderNo,
coalesce (SUM(CASE WHEN ops_orderdetail.ServiceNameEN = 'Dry Clean' then 1 else null end),0) AS CountService1,
coalesce (SUM(CASE WHEN ops_orderdetail.ServiceNameEN = 'Dry Clean' then (ops_orderdetail.Amount + coalesce(ops_orderdetail.AdditionAmount,0))-coalesce(ops_orderdetail.DiscountAmount,0) else null end),0) AS SumService1,
coalesce (SUM(CASE WHEN ops_orderdetail.ServiceNameEN = 'Laundry' then 1 else null end),0) + 
coalesce (SUM(CASE WHEN ops_orderdetail.ServiceNameEN = 'hand wash' then 1 else null end),0) AS CountService2,
coalesce (SUM(CASE WHEN ops_orderdetail.ServiceNameEN = 'Laundry' then (ops_orderdetail.Amount + coalesce(ops_orderdetail.AdditionAmount,0))-coalesce(ops_orderdetail.DiscountAmount,0) else null end),0) +
coalesce (SUM(CASE WHEN ops_orderdetail.ServiceNameEN = 'hand wash' then (ops_orderdetail.Amount + coalesce(ops_orderdetail.AdditionAmount,0))-coalesce(ops_orderdetail.DiscountAmount,0) else null end),0) AS SumService2,
coalesce (SUM(CASE WHEN ops_orderdetail.ServiceNameEN = 'Spa Leathers' then 1 else null end),0) AS CountService3,
coalesce (SUM(CASE WHEN ops_orderdetail.ServiceNameEN = 'Spa Leathers' then (ops_orderdetail.Amount + coalesce(ops_orderdetail.AdditionAmount,0))-coalesce(ops_orderdetail.DiscountAmount,0) else null end),0) AS SumService3,
coalesce (SUM(CASE WHEN ops_orderdetail.ServiceNameEN = 'Press Only' then 1 else null end),0) AS CountService4,
coalesce (SUM(CASE WHEN ops_orderdetail.ServiceNameEN = 'Press Only' then (ops_orderdetail.Amount + coalesce(ops_orderdetail.AdditionAmount,0))-coalesce(ops_orderdetail.DiscountAmount,0) else null end),0) AS SumService4,
coalesce (SUM(CASE WHEN ops_orderdetail.ServiceNameEN = 'Other' AND (mas_product.ProductID=360 OR mas_product.ProductID=361 OR mas_product.ProductID=362)
then 1 else null end),0) AS CountService5,
coalesce (SUM(CASE WHEN ops_orderdetail.ServiceNameEN = 'Other' AND (mas_product.ProductID=360 OR mas_product.ProductID=361 OR mas_product.ProductID=362)
then (ops_orderdetail.Amount + coalesce(ops_orderdetail.AdditionAmount,0))-coalesce(ops_orderdetail.DiscountAmount,0) else null end),0) AS SumService5,
((sum(Amount)+sum((Amount)*coalesce(ExpressRate,0))/100)+sum(coalesce(ops_orderdetail.AdditionAmount,0)))-sum(coalesce(ops_orderdetail.DiscountAmount,0)) as total,
CASE WHEN ops_order.IsPayment = 1 then 1 else 0 end as IsPayment,PromoDiscount,MemberDiscount
from ((ops_order left join
(ops_orderdetail left join mas_product on ops_orderdetail.ProductID=mas_product.ProductID)
on ops_order.OrderNo=ops_orderdetail.OrderNo)
left join mas_priceexpression on ops_order.IsExpressLevel=mas_priceexpression.IsExpressLevel)
left join (mas_branch
left join mas_branchtype on mas_branch.BranchType=mas_branchtype.BranchTypeID)
on ops_order.BranchID=mas_branch.BranchID
WHERE  ops_order.OrderDate between '".$getDate_start."' AND '".$getDate_end."' AND ops_order.IsActive='1'
Group By ops_order.OrderDate,ops_order.OrderNo,IsPayment,PromoDiscount,MemberDiscount
Order By ops_order.OrderNo ASC";

			$stmt1="select ops_order.OrderNo,sum(PromoDiscount) as PromoDiscount,
coalesce(sum(SpecialDiscount),0) as SpecialDiscount,
coalesce(sum(MemberDiscount),0) as MemberDiscount,
ops_order.NetAmount
from (ops_order
left join (mas_branch left join mas_branchtype on mas_branch.BranchID=mas_branchtype.BranchTypeID)
on ops_order.BranchID=mas_branch.BranchID)
WHERE  ops_order.OrderDate between '".$getDate_start."' AND '".$getDate_end."' AND ops_order.IsActive='1'
GROUP BY ops_order.OrderNo,ops_order.NetAmount
Order By ops_order.OrderNo ASC";


			$stmt2="select ops_order.OrderNo,count(ops_coupondiscount.OrderID) as couponCount,
coalesce (SUM(CASE WHEN ops_coupondiscount.Type = 1 then 1 else null end),0) AS couponCount1,
coalesce (SUM(CASE WHEN ops_coupondiscount.Type = 3 then 1 else null end),0) AS couponCount2
from (ops_order left join (mas_branch left join mas_branchtype on mas_branch.BranchID=mas_branchtype.BranchTypeID)
on ops_order.BranchID=mas_branch.BranchID) left join ops_coupondiscount on ops_order.OrderNo=ops_coupondiscount.OrderID
WHERE  ops_order.OrderDate between '".$getDate_start."' AND '".$getDate_end."' AND ops_order.IsActive='1'
GROUP BY ops_order.OrderNo,ops_order.NetAmount
Order By ops_order.OrderNo ASC";


$stmt3="select coalesce (SUM(CASE WHEN mas_supplies.SuppliesID = 1 then 1 else null end),0) AS Count1,
coalesce (SUM(CASE WHEN mas_supplies.SuppliesID = 2 then 1 else null end),0) AS Count2,
coalesce (SUM(CASE WHEN mas_supplies.SuppliesID = 3 then 1 else null end),0) AS Count3,
coalesce (SUM(CASE WHEN mas_supplies.SuppliesID = 4 then 1 else null end),0) AS Count4,
coalesce (SUM(CASE WHEN mas_supplies.SuppliesID = 5 then 1 else null end),0) AS Count5,
coalesce (SUM(CASE WHEN mas_supplies.SuppliesID = 6 then 1 else null end),0) AS Count6,
coalesce (SUM(CASE WHEN mas_supplies.SuppliesID = 7 then 1 else null end),0) AS Count7,
coalesce (SUM(CASE WHEN mas_supplies.SuppliesID = 8 then 1 else null end),0) AS Count8,
coalesce (SUM(CASE WHEN mas_supplies.SuppliesID = 9 then 1 else null end),0) AS Count9,
coalesce (SUM(CASE WHEN mas_supplies.SuppliesID = 10 then 1 else null end),0) AS Count10,
coalesce (SUM(CASE WHEN mas_supplies.SuppliesID = 11 then 1 else null end),0) AS Count11,
coalesce (SUM(CASE WHEN mas_supplies.SuppliesID = 12 then 1 else null end),0) AS Count12,
coalesce (SUM(CASE WHEN mas_supplies.SuppliesID = 13 then 1 else null end),0) AS Count13,
coalesce (SUM(CASE WHEN mas_supplies.SuppliesID = 14 then 1 else null end),0) AS Count14,
coalesce (SUM(CASE WHEN mas_supplies.SuppliesID = 15 then 1 else null end),0) AS Count15,
coalesce (SUM(CASE WHEN mas_supplies.SuppliesID = 16 then 1 else null end),0) AS Count16,
coalesce (SUM(CASE WHEN mas_supplies.SuppliesID = 17 then 1 else null end),0) AS Count17,
coalesce (SUM(CASE WHEN mas_supplies.SuppliesID = 18 then 1 else null end),0) AS Count18,
coalesce (SUM(CASE WHEN mas_supplies.SuppliesID = 17 then 1 else null end*Price),0) AS Sum17,
coalesce (SUM(CASE WHEN mas_supplies.SuppliesID = 18 then 1 else null end*Price),0) AS Sum18
from (mas_supplies left join ops_orderdetailsupplies on mas_supplies.SuppliesID=ops_orderdetailsupplies.SuppliesID)
left join (ops_ordersupplies left join mas_branch on ops_ordersupplies.BranchID=mas_branch.BranchID)
on ops_orderdetailsupplies.OrderNo=ops_ordersupplies.OrderNo
where OrderSuppliesDate between '".$getDate_start."' AND '".$getDate_end."' and ops_ordersupplies.IsActive=1";

			
		}

	}
	//GetSupplies
	//$stmt4="select SuppliesID,SuppliesNameTH from mas_supplies";
	$stmt4="select mas_service.ServiceType,RevCm,RevBranch
from mas_service left join (mas_revenue left join mas_branch on mas_revenue.BranchCode=mas_branch.BranchCode)
on mas_service.ServiceType=mas_revenue.ServiceType
where mas_revenue.BranchCode= '".$branchCode."'
Group by mas_service.ServiceType,RevCm,RevBranch,RevenueID";

$query = sqlsrv_query($conn, $stmt);
		$query1 = sqlsrv_query($conn, $stmt1);
		$query2 = sqlsrv_query($conn, $stmt2);
		$query3 = sqlsrv_query($conn, $stmt3);
		$query4 = sqlsrv_query($conn, $stmt4);
		$resultData = array();
		$resultData1 = array();
		$resultData2 = array();
		$resultData3 = array();
		$resultData4 = array();
		
		$object_array = array();
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
		$f=0;
		while($row = sqlsrv_fetch_array($query3, SQLSRV_FETCH_ASSOC))
    	{
			array_push($resultData3,$row);
    	}
		while($row = sqlsrv_fetch_array($query4, SQLSRV_FETCH_ASSOC))
    	{
			array_push($resultData4,$row);
			//echo $row['RevBranch'];
    	}
		
		array_push($object_array,array('resultData' => $resultData, 'resultData1' => $resultData1
		,'resultData2' => $resultData2,'resultData3' => $resultData3,'resultData4' => $resultData4));
		
		$json_array=json_encode($object_array);
		echo $json_array;


?>