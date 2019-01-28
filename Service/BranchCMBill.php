<?php
	include("config.php");
   	$keywords2=$_GET['keywords2'];
	$keywords=$_GET['keywords'];
	$date_start=$_GET['date_start'];
	$date_end=$_GET['date_end'];
	
	if($_GET['select_top']==10){
					if($_GET['keywords2']=='cheese'&&$_GET['keywords']=='cheese'){
				$stmt="select top 10 ops_order.OrderDate,ops_order.OrderNo,
coalesce (SUM(CASE WHEN ops_orderdetail.ServiceNameEN = 'Dry Clean' then 1 else null end),0) AS CountService1,
coalesce (SUM(CASE WHEN ops_orderdetail.ServiceNameEN = 'Dry Clean' then ops_orderdetail.Amount else null end),0) AS SumService1,
coalesce (SUM(CASE WHEN ops_orderdetail.ServiceNameEN = 'Laundry' then 1 else null end),0) AS CountService2,
coalesce (SUM(CASE WHEN ops_orderdetail.ServiceNameEN = 'Laundry' then ops_orderdetail.Amount else null end),0) AS SumService2,
coalesce (SUM(CASE WHEN ops_orderdetail.ServiceNameEN = 'Spa Leathers' then 1 else null end),0) AS CountService3,
coalesce (SUM(CASE WHEN ops_orderdetail.ServiceNameEN = 'Spa Leathers' then ops_orderdetail.Amount else null end),0) AS SumService3,
coalesce (SUM(CASE WHEN ops_orderdetail.ServiceNameEN = 'Press Only' then 1 else null end),0) AS CountService4,
coalesce (SUM(CASE WHEN ops_orderdetail.ServiceNameEN = 'Press Only' then ops_orderdetail.Amount else null end),0) AS SumService4,
coalesce (SUM(CASE WHEN ops_orderdetail.ServiceNameEN = 'Other' AND (ops_orderdetail.ProductID=360 OR ops_orderdetail.ProductID=361) then 1 else null end),0) AS CountService5,
coalesce (SUM(CASE WHEN ops_orderdetail.ServiceNameEN = 'Other' AND (ops_orderdetail.ProductID=360 OR ops_orderdetail.ProductID=361) then ops_orderdetail.Amount else null end),0) AS SumService5,
coalesce (SUM(CASE WHEN ops_orderdetail.ServiceNameEN = 'Other' AND ops_orderdetail.ProductID=362 then 1 else null end),0) AS CountService6,
coalesce (SUM(CASE WHEN ops_orderdetail.ServiceNameEN = 'Other' AND ops_orderdetail.ProductID=362 then ops_orderdetail.Amount else null end),0) AS SumService6,
((sum(Amount)+sum((Amount)*coalesce(ExpressRate,0))/100)+sum(coalesce(ops_orderdetail.AdditionAmount,0)))-sum(coalesce(ops_orderdetail.DiscountAmount,0)) as total,
CASE WHEN ops_order.IsPayment = 1 then 1 else 0 end as IsPayment
from ((ops_order left join
(ops_orderdetail left join mas_product on ops_orderdetail.ProductID=mas_product.ProductID)
on ops_order.OrderNo=ops_orderdetail.OrderNo)
left join mas_priceexpression on ops_order.IsExpressLevel=mas_priceexpression.IsExpressLevel)
left join (mas_branch
left join mas_branchtype on mas_branch.BranchType=mas_branchtype.BranchTypeID)
on ops_order.BranchID=mas_branch.BranchID
WHERE  ops_order.OrderDate BETWEEN  '".$date_start."' AND '".$date_end."' AND ops_order.IsActive='1'
Group By ops_order.OrderDate,ops_order.OrderNo,IsPayment
Order By ops_order.OrderNo ASC";

$stmt1="select top 10 ops_order.OrderNo,sum(PromoDiscount) as PromoDiscount,
coalesce(sum(SpecialDiscount),0) as SpecialDiscount,
coalesce(sum(MemberDiscount),0) as MemberDiscount,
ops_order.NetAmount
from (ops_order
left join (mas_branch left join mas_branchtype on mas_branch.BranchID=mas_branchtype.BranchTypeID)
on ops_order.BranchID=mas_branch.BranchID)
WHERE  ops_order.OrderDate BETWEEN  '".$date_start."' AND '".$date_end."' AND ops_order.IsActive='1'
GROUP BY ops_order.OrderNo,ops_order.NetAmount
Order By ops_order.OrderNo ASC";

$stmt2="select top 10 ops_order.OrderNo,count(ops_coupondiscount.OrderID) as couponCount
from (ops_order left join (mas_branch left join mas_branchtype on mas_branch.BranchID=mas_branchtype.BranchTypeID)
on ops_order.BranchID=mas_branch.BranchID) left join ops_coupondiscount on ops_order.OrderNo=ops_coupondiscount.OrderID
WHERE  ops_order.OrderDate BETWEEN  '".$date_start."' AND '".$date_end."' AND ops_order.IsActive='1'
GROUP BY ops_order.OrderNo,ops_order.NetAmount
Order By ops_order.OrderNo ASC";
				}else if($_GET['keywords2']!='cheese'&&$_GET['keywords']=='cheese'){
						$stmt="select top 10 ops_order.OrderDate,ops_order.OrderNo,
coalesce (SUM(CASE WHEN ops_orderdetail.ServiceNameEN = 'Dry Clean' then 1 else null end),0) AS CountService1,
coalesce (SUM(CASE WHEN ops_orderdetail.ServiceNameEN = 'Dry Clean' then ops_orderdetail.Amount else null end),0) AS SumService1,
coalesce (SUM(CASE WHEN ops_orderdetail.ServiceNameEN = 'Laundry' then 1 else null end),0) AS CountService2,
coalesce (SUM(CASE WHEN ops_orderdetail.ServiceNameEN = 'Laundry' then ops_orderdetail.Amount else null end),0) AS SumService2,
coalesce (SUM(CASE WHEN ops_orderdetail.ServiceNameEN = 'Spa Leathers' then 1 else null end),0) AS CountService3,
coalesce (SUM(CASE WHEN ops_orderdetail.ServiceNameEN = 'Spa Leathers' then ops_orderdetail.Amount else null end),0) AS SumService3,
coalesce (SUM(CASE WHEN ops_orderdetail.ServiceNameEN = 'Press Only' then 1 else null end),0) AS CountService4,
coalesce (SUM(CASE WHEN ops_orderdetail.ServiceNameEN = 'Press Only' then ops_orderdetail.Amount else null end),0) AS SumService4,
coalesce (SUM(CASE WHEN ops_orderdetail.ServiceNameEN = 'Other' AND (ops_orderdetail.ProductID=360 OR ops_orderdetail.ProductID=361) then 1 else null end),0) AS CountService5,
coalesce (SUM(CASE WHEN ops_orderdetail.ServiceNameEN = 'Other' AND (ops_orderdetail.ProductID=360 OR ops_orderdetail.ProductID=361) then ops_orderdetail.Amount else null end),0) AS SumService5,
coalesce (SUM(CASE WHEN ops_orderdetail.ServiceNameEN = 'Other' AND ops_orderdetail.ProductID=362 then 1 else null end),0) AS CountService6,
coalesce (SUM(CASE WHEN ops_orderdetail.ServiceNameEN = 'Other' AND ops_orderdetail.ProductID=362 then ops_orderdetail.Amount else null end),0) AS SumService6,
((sum(Amount)+sum((Amount)*coalesce(ExpressRate,0))/100)+sum(coalesce(ops_orderdetail.AdditionAmount,0)))-sum(coalesce(ops_orderdetail.DiscountAmount,0)) as total,
CASE WHEN ops_order.IsPayment = 1 then 1 else 0 end as IsPayment
from ((ops_order left join
(ops_orderdetail left join mas_product on ops_orderdetail.ProductID=mas_product.ProductID)
on ops_order.OrderNo=ops_orderdetail.OrderNo)
left join mas_priceexpression on ops_order.IsExpressLevel=mas_priceexpression.IsExpressLevel)
left join (mas_branch
left join mas_branchtype on mas_branch.BranchType=mas_branchtype.BranchTypeID)
on ops_order.BranchID=mas_branch.BranchID
WHERE  ops_order.OrderDate BETWEEN  '".$date_start."' AND '".$date_end."' AND ops_order.IsActive='1'
AND mas_branch.BranchID = '".$keywords2."'
Group By ops_order.OrderDate,ops_order.OrderNo,IsPayment
Order By ops_order.OrderNo ASC";

$stmt1="select top 10 ops_order.OrderNo,sum(PromoDiscount) as PromoDiscount,
coalesce(sum(SpecialDiscount),0) as SpecialDiscount,
coalesce(sum(MemberDiscount),0) as MemberDiscount,
ops_order.NetAmount
from (ops_order
left join (mas_branch left join mas_branchtype on mas_branch.BranchID=mas_branchtype.BranchTypeID)
on ops_order.BranchID=mas_branch.BranchID)
WHERE  ops_order.OrderDate BETWEEN  '".$date_start."' AND '".$date_end."' AND ops_order.IsActive='1'
AND mas_branch.BranchID = '".$keywords2."'
GROUP BY ops_order.OrderNo,ops_order.NetAmount
Order By ops_order.OrderNo ASC";

$stmt2="select top 10 ops_order.OrderNo,count(ops_coupondiscount.OrderID) as couponCount
from (ops_order left join (mas_branch left join mas_branchtype on mas_branch.BranchID=mas_branchtype.BranchTypeID)
on ops_order.BranchID=mas_branch.BranchID) left join ops_coupondiscount on ops_order.OrderNo=ops_coupondiscount.OrderID
WHERE  ops_order.OrderDate BETWEEN  '".$date_start."' AND '".$date_end."' AND ops_order.IsActive='1'
AND mas_branch.BranchID = '".$keywords2."'
GROUP BY ops_order.OrderNo,ops_order.NetAmount
Order By ops_order.OrderNo ASC";
						}
						else{
					$stmt="select top 10 ops_order.OrderDate,ops_order.OrderNo,
coalesce (SUM(CASE WHEN ops_orderdetail.ServiceNameEN = 'Dry Clean' then 1 else null end),0) AS CountService1,
coalesce (SUM(CASE WHEN ops_orderdetail.ServiceNameEN = 'Dry Clean' then ops_orderdetail.Amount else null end),0) AS SumService1,
coalesce (SUM(CASE WHEN ops_orderdetail.ServiceNameEN = 'Laundry' then 1 else null end),0) AS CountService2,
coalesce (SUM(CASE WHEN ops_orderdetail.ServiceNameEN = 'Laundry' then ops_orderdetail.Amount else null end),0) AS SumService2,
coalesce (SUM(CASE WHEN ops_orderdetail.ServiceNameEN = 'Spa Leathers' then 1 else null end),0) AS CountService3,
coalesce (SUM(CASE WHEN ops_orderdetail.ServiceNameEN = 'Spa Leathers' then ops_orderdetail.Amount else null end),0) AS SumService3,
coalesce (SUM(CASE WHEN ops_orderdetail.ServiceNameEN = 'Press Only' then 1 else null end),0) AS CountService4,
coalesce (SUM(CASE WHEN ops_orderdetail.ServiceNameEN = 'Press Only' then ops_orderdetail.Amount else null end),0) AS SumService4,
coalesce (SUM(CASE WHEN ops_orderdetail.ServiceNameEN = 'Other' AND (ops_orderdetail.ProductID=360 OR ops_orderdetail.ProductID=361) then 1 else null end),0) AS CountService5,
coalesce (SUM(CASE WHEN ops_orderdetail.ServiceNameEN = 'Other' AND (ops_orderdetail.ProductID=360 OR ops_orderdetail.ProductID=361) then ops_orderdetail.Amount else null end),0) AS SumService5,
coalesce (SUM(CASE WHEN ops_orderdetail.ServiceNameEN = 'Other' AND ops_orderdetail.ProductID=362 then 1 else null end),0) AS CountService6,
coalesce (SUM(CASE WHEN ops_orderdetail.ServiceNameEN = 'Other' AND ops_orderdetail.ProductID=362 then ops_orderdetail.Amount else null end),0) AS SumService6,
((sum(Amount)+sum((Amount)*coalesce(ExpressRate,0))/100)+sum(coalesce(ops_orderdetail.AdditionAmount,0)))-sum(coalesce(ops_orderdetail.DiscountAmount,0)) as total,
CASE WHEN ops_order.IsPayment = 1 then 1 else 0 end as IsPayment
from ((ops_order left join
(ops_orderdetail left join mas_product on ops_orderdetail.ProductID=mas_product.ProductID)
on ops_order.OrderNo=ops_orderdetail.OrderNo)
left join mas_priceexpression on ops_order.IsExpressLevel=mas_priceexpression.IsExpressLevel)
left join (mas_branch
left join mas_branchtype on mas_branch.BranchType=mas_branchtype.BranchTypeID)
on ops_order.BranchID=mas_branch.BranchID
WHERE  ops_order.OrderDate BETWEEN  '".$date_start."' AND '".$date_end."' AND ops_order.IsActive='1'
AND mas_branch.BranchType = '".$keywords."'
Group By ops_order.OrderDate,ops_order.OrderNo,IsPayment
Order By ops_order.OrderNo ASC";

$stmt1="select top 10 ops_order.OrderNo,sum(PromoDiscount) as PromoDiscount,
coalesce(sum(SpecialDiscount),0) as SpecialDiscount,
coalesce(sum(MemberDiscount),0) as MemberDiscount,
ops_order.NetAmount
from (ops_order
left join (mas_branch left join mas_branchtype on mas_branch.BranchID=mas_branchtype.BranchTypeID)
on ops_order.BranchID=mas_branch.BranchID)
WHERE  ops_order.OrderDate BETWEEN  '".$date_start."' AND '".$date_end."' AND ops_order.IsActive='1'
AND mas_branch.BranchType = '".$keywords."'
GROUP BY ops_order.OrderNo,ops_order.NetAmount
Order By ops_order.OrderNo ASC";

$stmt2="select top 10 ops_order.OrderNo,count(ops_coupondiscount.OrderID) as couponCount
from (ops_order left join (mas_branch left join mas_branchtype on mas_branch.BranchID=mas_branchtype.BranchTypeID)
on ops_order.BranchID=mas_branch.BranchID) left join ops_coupondiscount on ops_order.OrderNo=ops_coupondiscount.OrderID
WHERE  ops_order.OrderDate BETWEEN  '".$date_start."' AND '".$date_end."' AND ops_order.IsActive='1'
AND mas_branch.BranchType = '".$keywords."'
GROUP BY ops_order.OrderNo,ops_order.NetAmount
Order By ops_order.OrderNo ASC";
				}
				}
				else if($_GET['select_top']==20){
				if($_GET['keywords2']=='cheese'&&$_GET['keywords']=='cheese'){
				$stmt="select top 20 ops_order.OrderDate,ops_order.OrderNo,
coalesce (SUM(CASE WHEN ops_orderdetail.ServiceNameEN = 'Dry Clean' then 1 else null end),0) AS CountService1,
coalesce (SUM(CASE WHEN ops_orderdetail.ServiceNameEN = 'Dry Clean' then ops_orderdetail.Amount else null end),0) AS SumService1,
coalesce (SUM(CASE WHEN ops_orderdetail.ServiceNameEN = 'Laundry' then 1 else null end),0) AS CountService2,
coalesce (SUM(CASE WHEN ops_orderdetail.ServiceNameEN = 'Laundry' then ops_orderdetail.Amount else null end),0) AS SumService2,
coalesce (SUM(CASE WHEN ops_orderdetail.ServiceNameEN = 'Spa Leathers' then 1 else null end),0) AS CountService3,
coalesce (SUM(CASE WHEN ops_orderdetail.ServiceNameEN = 'Spa Leathers' then ops_orderdetail.Amount else null end),0) AS SumService3,
coalesce (SUM(CASE WHEN ops_orderdetail.ServiceNameEN = 'Press Only' then 1 else null end),0) AS CountService4,
coalesce (SUM(CASE WHEN ops_orderdetail.ServiceNameEN = 'Press Only' then ops_orderdetail.Amount else null end),0) AS SumService4,
coalesce (SUM(CASE WHEN ops_orderdetail.ServiceNameEN = 'Other' AND (ops_orderdetail.ProductID=360 OR ops_orderdetail.ProductID=361) then 1 else null end),0) AS CountService5,
coalesce (SUM(CASE WHEN ops_orderdetail.ServiceNameEN = 'Other' AND (ops_orderdetail.ProductID=360 OR ops_orderdetail.ProductID=361) then ops_orderdetail.Amount else null end),0) AS SumService5,
coalesce (SUM(CASE WHEN ops_orderdetail.ServiceNameEN = 'Other' AND ops_orderdetail.ProductID=362 then 1 else null end),0) AS CountService6,
coalesce (SUM(CASE WHEN ops_orderdetail.ServiceNameEN = 'Other' AND ops_orderdetail.ProductID=362 then ops_orderdetail.Amount else null end),0) AS SumService6,
((sum(Amount)+sum((Amount)*coalesce(ExpressRate,0))/100)+sum(coalesce(ops_orderdetail.AdditionAmount,0)))-sum(coalesce(ops_orderdetail.DiscountAmount,0)) as total,
CASE WHEN ops_order.IsPayment = 1 then 1 else 0 end as IsPayment
from ((ops_order left join
(ops_orderdetail left join mas_product on ops_orderdetail.ProductID=mas_product.ProductID)
on ops_order.OrderNo=ops_orderdetail.OrderNo)
left join mas_priceexpression on ops_order.IsExpressLevel=mas_priceexpression.IsExpressLevel)
left join (mas_branch
left join mas_branchtype on mas_branch.BranchType=mas_branchtype.BranchTypeID)
on ops_order.BranchID=mas_branch.BranchID
WHERE  ops_order.OrderDate BETWEEN  '".$date_start."' AND '".$date_end."' AND ops_order.IsActive='1'
Group By ops_order.OrderDate,ops_order.OrderNo,IsPayment
Order By ops_order.OrderNo ASC";

$stmt1="select top 20 ops_order.OrderNo,sum(PromoDiscount) as PromoDiscount,
coalesce(sum(SpecialDiscount),0) as SpecialDiscount,
coalesce(sum(MemberDiscount),0) as MemberDiscount,
ops_order.NetAmount
from (ops_order
left join (mas_branch left join mas_branchtype on mas_branch.BranchID=mas_branchtype.BranchTypeID)
on ops_order.BranchID=mas_branch.BranchID)
WHERE  ops_order.OrderDate BETWEEN  '".$date_start."' AND '".$date_end."' AND ops_order.IsActive='1'
GROUP BY ops_order.OrderNo,ops_order.NetAmount
Order By ops_order.OrderNo ASC";

$stmt2="select top 20 ops_order.OrderNo,count(ops_coupondiscount.OrderID) as couponCount
from (ops_order left join (mas_branch left join mas_branchtype on mas_branch.BranchID=mas_branchtype.BranchTypeID)
on ops_order.BranchID=mas_branch.BranchID) left join ops_coupondiscount on ops_order.OrderNo=ops_coupondiscount.OrderID
WHERE  ops_order.OrderDate BETWEEN  '".$date_start."' AND '".$date_end."' AND ops_order.IsActive='1'
GROUP BY ops_order.OrderNo,ops_order.NetAmount
Order By ops_order.OrderNo ASC";
				}else if($_GET['keywords2']!='cheese'&&$_GET['keywords']=='cheese'){
						$stmt="select top 20 ops_order.OrderDate,ops_order.OrderNo,
coalesce (SUM(CASE WHEN ops_orderdetail.ServiceNameEN = 'Dry Clean' then 1 else null end),0) AS CountService1,
coalesce (SUM(CASE WHEN ops_orderdetail.ServiceNameEN = 'Dry Clean' then ops_orderdetail.Amount else null end),0) AS SumService1,
coalesce (SUM(CASE WHEN ops_orderdetail.ServiceNameEN = 'Laundry' then 1 else null end),0) AS CountService2,
coalesce (SUM(CASE WHEN ops_orderdetail.ServiceNameEN = 'Laundry' then ops_orderdetail.Amount else null end),0) AS SumService2,
coalesce (SUM(CASE WHEN ops_orderdetail.ServiceNameEN = 'Spa Leathers' then 1 else null end),0) AS CountService3,
coalesce (SUM(CASE WHEN ops_orderdetail.ServiceNameEN = 'Spa Leathers' then ops_orderdetail.Amount else null end),0) AS SumService3,
coalesce (SUM(CASE WHEN ops_orderdetail.ServiceNameEN = 'Press Only' then 1 else null end),0) AS CountService4,
coalesce (SUM(CASE WHEN ops_orderdetail.ServiceNameEN = 'Press Only' then ops_orderdetail.Amount else null end),0) AS SumService4,
coalesce (SUM(CASE WHEN ops_orderdetail.ServiceNameEN = 'Other' AND (ops_orderdetail.ProductID=360 OR ops_orderdetail.ProductID=361) then 1 else null end),0) AS CountService5,
coalesce (SUM(CASE WHEN ops_orderdetail.ServiceNameEN = 'Other' AND (ops_orderdetail.ProductID=360 OR ops_orderdetail.ProductID=361) then ops_orderdetail.Amount else null end),0) AS SumService5,
coalesce (SUM(CASE WHEN ops_orderdetail.ServiceNameEN = 'Other' AND ops_orderdetail.ProductID=362 then 1 else null end),0) AS CountService6,
coalesce (SUM(CASE WHEN ops_orderdetail.ServiceNameEN = 'Other' AND ops_orderdetail.ProductID=362 then ops_orderdetail.Amount else null end),0) AS SumService6,
((sum(Amount)+sum((Amount)*coalesce(ExpressRate,0))/100)+sum(coalesce(ops_orderdetail.AdditionAmount,0)))-sum(coalesce(ops_orderdetail.DiscountAmount,0)) as total,
CASE WHEN ops_order.IsPayment = 1 then 1 else 0 end as IsPayment
from ((ops_order left join
(ops_orderdetail left join mas_product on ops_orderdetail.ProductID=mas_product.ProductID)
on ops_order.OrderNo=ops_orderdetail.OrderNo)
left join mas_priceexpression on ops_order.IsExpressLevel=mas_priceexpression.IsExpressLevel)
left join (mas_branch
left join mas_branchtype on mas_branch.BranchType=mas_branchtype.BranchTypeID)
on ops_order.BranchID=mas_branch.BranchID
WHERE  ops_order.OrderDate BETWEEN  '".$date_start."' AND '".$date_end."' AND ops_order.IsActive='1'
AND mas_branch.BranchID = '".$keywords2."'
Group By ops_order.OrderDate,ops_order.OrderNo,IsPayment
Order By ops_order.OrderNo ASC";

$stmt1="select top 20 ops_order.OrderNo,sum(PromoDiscount) as PromoDiscount,
coalesce(sum(SpecialDiscount),0) as SpecialDiscount,
coalesce(sum(MemberDiscount),0) as MemberDiscount,
ops_order.NetAmount
from (ops_order
left join (mas_branch left join mas_branchtype on mas_branch.BranchID=mas_branchtype.BranchTypeID)
on ops_order.BranchID=mas_branch.BranchID)
WHERE  ops_order.OrderDate BETWEEN  '".$date_start."' AND '".$date_end."' AND ops_order.IsActive='1'
AND mas_branch.BranchID = '".$keywords2."'
GROUP BY ops_order.OrderNo,ops_order.NetAmount
Order By ops_order.OrderNo ASC";

$stmt2="select top 20 ops_order.OrderNo,count(ops_coupondiscount.OrderID) as couponCount
from (ops_order left join (mas_branch left join mas_branchtype on mas_branch.BranchID=mas_branchtype.BranchTypeID)
on ops_order.BranchID=mas_branch.BranchID) left join ops_coupondiscount on ops_order.OrderNo=ops_coupondiscount.OrderID
WHERE  ops_order.OrderDate BETWEEN  '".$date_start."' AND '".$date_end."' AND ops_order.IsActive='1'
AND mas_branch.BranchID = '".$keywords2."'
GROUP BY ops_order.OrderNo,ops_order.NetAmount
Order By ops_order.OrderNo ASC";
						}
						else{
					$stmt="select top 20 ops_order.OrderDate,ops_order.OrderNo,
coalesce (SUM(CASE WHEN ops_orderdetail.ServiceNameEN = 'Dry Clean' then 1 else null end),0) AS CountService1,
coalesce (SUM(CASE WHEN ops_orderdetail.ServiceNameEN = 'Dry Clean' then ops_orderdetail.Amount else null end),0) AS SumService1,
coalesce (SUM(CASE WHEN ops_orderdetail.ServiceNameEN = 'Laundry' then 1 else null end),0) AS CountService2,
coalesce (SUM(CASE WHEN ops_orderdetail.ServiceNameEN = 'Laundry' then ops_orderdetail.Amount else null end),0) AS SumService2,
coalesce (SUM(CASE WHEN ops_orderdetail.ServiceNameEN = 'Spa Leathers' then 1 else null end),0) AS CountService3,
coalesce (SUM(CASE WHEN ops_orderdetail.ServiceNameEN = 'Spa Leathers' then ops_orderdetail.Amount else null end),0) AS SumService3,
coalesce (SUM(CASE WHEN ops_orderdetail.ServiceNameEN = 'Press Only' then 1 else null end),0) AS CountService4,
coalesce (SUM(CASE WHEN ops_orderdetail.ServiceNameEN = 'Press Only' then ops_orderdetail.Amount else null end),0) AS SumService4,
coalesce (SUM(CASE WHEN ops_orderdetail.ServiceNameEN = 'Other' AND (ops_orderdetail.ProductID=360 OR ops_orderdetail.ProductID=361) then 1 else null end),0) AS CountService5,
coalesce (SUM(CASE WHEN ops_orderdetail.ServiceNameEN = 'Other' AND (ops_orderdetail.ProductID=360 OR ops_orderdetail.ProductID=361) then ops_orderdetail.Amount else null end),0) AS SumService5,
coalesce (SUM(CASE WHEN ops_orderdetail.ServiceNameEN = 'Other' AND ops_orderdetail.ProductID=362 then 1 else null end),0) AS CountService6,
coalesce (SUM(CASE WHEN ops_orderdetail.ServiceNameEN = 'Other' AND ops_orderdetail.ProductID=362 then ops_orderdetail.Amount else null end),0) AS SumService6,
((sum(Amount)+sum((Amount)*coalesce(ExpressRate,0))/100)+sum(coalesce(ops_orderdetail.AdditionAmount,0)))-sum(coalesce(ops_orderdetail.DiscountAmount,0)) as total,
CASE WHEN ops_order.IsPayment = 1 then 1 else 0 end as IsPayment
from ((ops_order left join
(ops_orderdetail left join mas_product on ops_orderdetail.ProductID=mas_product.ProductID)
on ops_order.OrderNo=ops_orderdetail.OrderNo)
left join mas_priceexpression on ops_order.IsExpressLevel=mas_priceexpression.IsExpressLevel)
left join (mas_branch
left join mas_branchtype on mas_branch.BranchType=mas_branchtype.BranchTypeID)
on ops_order.BranchID=mas_branch.BranchID
WHERE  ops_order.OrderDate BETWEEN  '".$date_start."' AND '".$date_end."' AND ops_order.IsActive='1'
AND mas_branch.BranchType = '".$keywords."'
Group By ops_order.OrderDate,ops_order.OrderNo,IsPayment
Order By ops_order.OrderNo ASC";

$stmt1="select top 20 ops_order.OrderNo,sum(PromoDiscount) as PromoDiscount,
coalesce(sum(SpecialDiscount),0) as SpecialDiscount,
coalesce(sum(MemberDiscount),0) as MemberDiscount,
ops_order.NetAmount
from (ops_order
left join (mas_branch left join mas_branchtype on mas_branch.BranchID=mas_branchtype.BranchTypeID)
on ops_order.BranchID=mas_branch.BranchID)
WHERE  ops_order.OrderDate BETWEEN  '".$date_start."' AND '".$date_end."' AND ops_order.IsActive='1'
AND mas_branch.BranchType = '".$keywords."'
GROUP BY ops_order.OrderNo,ops_order.NetAmount
Order By ops_order.OrderNo ASC";

$stmt2="select top 20 ops_order.OrderNo,count(ops_coupondiscount.OrderID) as couponCount
from (ops_order left join (mas_branch left join mas_branchtype on mas_branch.BranchID=mas_branchtype.BranchTypeID)
on ops_order.BranchID=mas_branch.BranchID) left join ops_coupondiscount on ops_order.OrderNo=ops_coupondiscount.OrderID
WHERE  ops_order.OrderDate BETWEEN  '".$date_start."' AND '".$date_end."' AND ops_order.IsActive='1'
AND mas_branch.BranchType = '".$keywords."'
GROUP BY ops_order.OrderNo,ops_order.NetAmount
Order By ops_order.OrderNo ASC";
				}
				}
				else if($_GET['select_top']==30){
				if($_GET['keywords2']=='cheese'&&$_GET['keywords']=='cheese'){
				$stmt="select top 30 ops_order.OrderDate,ops_order.OrderNo,
coalesce (SUM(CASE WHEN ops_orderdetail.ServiceNameEN = 'Dry Clean' then 1 else null end),0) AS CountService1,
coalesce (SUM(CASE WHEN ops_orderdetail.ServiceNameEN = 'Dry Clean' then ops_orderdetail.Amount else null end),0) AS SumService1,
coalesce (SUM(CASE WHEN ops_orderdetail.ServiceNameEN = 'Laundry' then 1 else null end),0) AS CountService2,
coalesce (SUM(CASE WHEN ops_orderdetail.ServiceNameEN = 'Laundry' then ops_orderdetail.Amount else null end),0) AS SumService2,
coalesce (SUM(CASE WHEN ops_orderdetail.ServiceNameEN = 'Spa Leathers' then 1 else null end),0) AS CountService3,
coalesce (SUM(CASE WHEN ops_orderdetail.ServiceNameEN = 'Spa Leathers' then ops_orderdetail.Amount else null end),0) AS SumService3,
coalesce (SUM(CASE WHEN ops_orderdetail.ServiceNameEN = 'Press Only' then 1 else null end),0) AS CountService4,
coalesce (SUM(CASE WHEN ops_orderdetail.ServiceNameEN = 'Press Only' then ops_orderdetail.Amount else null end),0) AS SumService4,
coalesce (SUM(CASE WHEN ops_orderdetail.ServiceNameEN = 'Other' AND (ops_orderdetail.ProductID=360 OR ops_orderdetail.ProductID=361) then 1 else null end),0) AS CountService5,
coalesce (SUM(CASE WHEN ops_orderdetail.ServiceNameEN = 'Other' AND (ops_orderdetail.ProductID=360 OR ops_orderdetail.ProductID=361) then ops_orderdetail.Amount else null end),0) AS SumService5,
coalesce (SUM(CASE WHEN ops_orderdetail.ServiceNameEN = 'Other' AND ops_orderdetail.ProductID=362 then 1 else null end),0) AS CountService6,
coalesce (SUM(CASE WHEN ops_orderdetail.ServiceNameEN = 'Other' AND ops_orderdetail.ProductID=362 then ops_orderdetail.Amount else null end),0) AS SumService6,
((sum(Amount)+sum((Amount)*coalesce(ExpressRate,0))/100)+sum(coalesce(ops_orderdetail.AdditionAmount,0)))-sum(coalesce(ops_orderdetail.DiscountAmount,0)) as total,
CASE WHEN ops_order.IsPayment = 1 then 1 else 0 end as IsPayment
from ((ops_order left join
(ops_orderdetail left join mas_product on ops_orderdetail.ProductID=mas_product.ProductID)
on ops_order.OrderNo=ops_orderdetail.OrderNo)
left join mas_priceexpression on ops_order.IsExpressLevel=mas_priceexpression.IsExpressLevel)
left join (mas_branch
left join mas_branchtype on mas_branch.BranchType=mas_branchtype.BranchTypeID)
on ops_order.BranchID=mas_branch.BranchID
WHERE  ops_order.OrderDate BETWEEN  '".$date_start."' AND '".$date_end."' AND ops_order.IsActive='1'
Group By ops_order.OrderDate,ops_order.OrderNo,IsPayment
Order By ops_order.OrderNo ASC";

$stmt1="select top 30 ops_order.OrderNo,sum(PromoDiscount) as PromoDiscount,
coalesce(sum(SpecialDiscount),0) as SpecialDiscount,
coalesce(sum(MemberDiscount),0) as MemberDiscount,
ops_order.NetAmount
from (ops_order
left join (mas_branch left join mas_branchtype on mas_branch.BranchID=mas_branchtype.BranchTypeID)
on ops_order.BranchID=mas_branch.BranchID)
WHERE  ops_order.OrderDate BETWEEN  '".$date_start."' AND '".$date_end."' AND ops_order.IsActive='1'
GROUP BY ops_order.OrderNo,ops_order.NetAmount
Order By ops_order.OrderNo ASC";

$stmt2="select top 30 ops_order.OrderNo,count(ops_coupondiscount.OrderID) as couponCount
from (ops_order left join (mas_branch left join mas_branchtype on mas_branch.BranchID=mas_branchtype.BranchTypeID)
on ops_order.BranchID=mas_branch.BranchID) left join ops_coupondiscount on ops_order.OrderNo=ops_coupondiscount.OrderID
WHERE  ops_order.OrderDate BETWEEN  '".$date_start."' AND '".$date_end."' AND ops_order.IsActive='1'
GROUP BY ops_order.OrderNo,ops_order.NetAmount
Order By ops_order.OrderNo ASC";
				}else if($_GET['keywords2']!='cheese'&&$_GET['keywords']=='cheese'){
				$stmt="select top 30 ops_order.OrderDate,ops_order.OrderNo,
coalesce (SUM(CASE WHEN ops_orderdetail.ServiceNameEN = 'Dry Clean' then 1 else null end),0) AS CountService1,
coalesce (SUM(CASE WHEN ops_orderdetail.ServiceNameEN = 'Dry Clean' then ops_orderdetail.Amount else null end),0) AS SumService1,
coalesce (SUM(CASE WHEN ops_orderdetail.ServiceNameEN = 'Laundry' then 1 else null end),0) AS CountService2,
coalesce (SUM(CASE WHEN ops_orderdetail.ServiceNameEN = 'Laundry' then ops_orderdetail.Amount else null end),0) AS SumService2,
coalesce (SUM(CASE WHEN ops_orderdetail.ServiceNameEN = 'Spa Leathers' then 1 else null end),0) AS CountService3,
coalesce (SUM(CASE WHEN ops_orderdetail.ServiceNameEN = 'Spa Leathers' then ops_orderdetail.Amount else null end),0) AS SumService3,
coalesce (SUM(CASE WHEN ops_orderdetail.ServiceNameEN = 'Press Only' then 1 else null end),0) AS CountService4,
coalesce (SUM(CASE WHEN ops_orderdetail.ServiceNameEN = 'Press Only' then ops_orderdetail.Amount else null end),0) AS SumService4,
coalesce (SUM(CASE WHEN ops_orderdetail.ServiceNameEN = 'Other' AND (ops_orderdetail.ProductID=360 OR ops_orderdetail.ProductID=361) then 1 else null end),0) AS CountService5,
coalesce (SUM(CASE WHEN ops_orderdetail.ServiceNameEN = 'Other' AND (ops_orderdetail.ProductID=360 OR ops_orderdetail.ProductID=361) then ops_orderdetail.Amount else null end),0) AS SumService5,
coalesce (SUM(CASE WHEN ops_orderdetail.ServiceNameEN = 'Other' AND ops_orderdetail.ProductID=362 then 1 else null end),0) AS CountService6,
coalesce (SUM(CASE WHEN ops_orderdetail.ServiceNameEN = 'Other' AND ops_orderdetail.ProductID=362 then ops_orderdetail.Amount else null end),0) AS SumService6,
((sum(Amount)+sum((Amount)*coalesce(ExpressRate,0))/100)+sum(coalesce(ops_orderdetail.AdditionAmount,0)))-sum(coalesce(ops_orderdetail.DiscountAmount,0)) as total,
CASE WHEN ops_order.IsPayment = 1 then 1 else 0 end as IsPayment
from ((ops_order left join
(ops_orderdetail left join mas_product on ops_orderdetail.ProductID=mas_product.ProductID)
on ops_order.OrderNo=ops_orderdetail.OrderNo)
left join mas_priceexpression on ops_order.IsExpressLevel=mas_priceexpression.IsExpressLevel)
left join (mas_branch
left join mas_branchtype on mas_branch.BranchType=mas_branchtype.BranchTypeID)
on ops_order.BranchID=mas_branch.BranchID
WHERE  ops_order.OrderDate BETWEEN  '".$date_start."' AND '".$date_end."' AND ops_order.IsActive='1'
AND mas_branch.BranchID = '".$keywords2."'
Group By ops_order.OrderDate,ops_order.OrderNo,IsPayment
Order By ops_order.OrderNo ASC";

$stmt1="select top 30 ops_order.OrderNo,sum(PromoDiscount) as PromoDiscount,
coalesce(sum(SpecialDiscount),0) as SpecialDiscount,
coalesce(sum(MemberDiscount),0) as MemberDiscount,
ops_order.NetAmount
from (ops_order
left join (mas_branch left join mas_branchtype on mas_branch.BranchID=mas_branchtype.BranchTypeID)
on ops_order.BranchID=mas_branch.BranchID)
WHERE  ops_order.OrderDate BETWEEN  '".$date_start."' AND '".$date_end."' AND ops_order.IsActive='1'
AND mas_branch.BranchID = '".$keywords2."'
GROUP BY ops_order.OrderNo,ops_order.NetAmount
Order By ops_order.OrderNo ASC";

$stmt2="select top 30 ops_order.OrderNo,count(ops_coupondiscount.OrderID) as couponCount
from (ops_order left join (mas_branch left join mas_branchtype on mas_branch.BranchID=mas_branchtype.BranchTypeID)
on ops_order.BranchID=mas_branch.BranchID) left join ops_coupondiscount on ops_order.OrderNo=ops_coupondiscount.OrderID
WHERE  ops_order.OrderDate BETWEEN  '".$date_start."' AND '".$date_end."' AND ops_order.IsActive='1'
AND mas_branch.BranchID = '".$keywords2."'
GROUP BY ops_order.OrderNo,ops_order.NetAmount
Order By ops_order.OrderNo ASC";

						}
						else{
						$stmt="select top 30 ops_order.OrderDate,ops_order.OrderNo,
coalesce (SUM(CASE WHEN ops_orderdetail.ServiceNameEN = 'Dry Clean' then 1 else null end),0) AS CountService1,
coalesce (SUM(CASE WHEN ops_orderdetail.ServiceNameEN = 'Dry Clean' then ops_orderdetail.Amount else null end),0) AS SumService1,
coalesce (SUM(CASE WHEN ops_orderdetail.ServiceNameEN = 'Laundry' then 1 else null end),0) AS CountService2,
coalesce (SUM(CASE WHEN ops_orderdetail.ServiceNameEN = 'Laundry' then ops_orderdetail.Amount else null end),0) AS SumService2,
coalesce (SUM(CASE WHEN ops_orderdetail.ServiceNameEN = 'Spa Leathers' then 1 else null end),0) AS CountService3,
coalesce (SUM(CASE WHEN ops_orderdetail.ServiceNameEN = 'Spa Leathers' then ops_orderdetail.Amount else null end),0) AS SumService3,
coalesce (SUM(CASE WHEN ops_orderdetail.ServiceNameEN = 'Press Only' then 1 else null end),0) AS CountService4,
coalesce (SUM(CASE WHEN ops_orderdetail.ServiceNameEN = 'Press Only' then ops_orderdetail.Amount else null end),0) AS SumService4,
coalesce (SUM(CASE WHEN ops_orderdetail.ServiceNameEN = 'Other' AND (ops_orderdetail.ProductID=360 OR ops_orderdetail.ProductID=361) then 1 else null end),0) AS CountService5,
coalesce (SUM(CASE WHEN ops_orderdetail.ServiceNameEN = 'Other' AND (ops_orderdetail.ProductID=360 OR ops_orderdetail.ProductID=361) then ops_orderdetail.Amount else null end),0) AS SumService5,
coalesce (SUM(CASE WHEN ops_orderdetail.ServiceNameEN = 'Other' AND ops_orderdetail.ProductID=362 then 1 else null end),0) AS CountService6,
coalesce (SUM(CASE WHEN ops_orderdetail.ServiceNameEN = 'Other' AND ops_orderdetail.ProductID=362 then ops_orderdetail.Amount else null end),0) AS SumService6,
((sum(Amount)+sum((Amount)*coalesce(ExpressRate,0))/100)+sum(coalesce(ops_orderdetail.AdditionAmount,0)))-sum(coalesce(ops_orderdetail.DiscountAmount,0)) as total,
CASE WHEN ops_order.IsPayment = 1 then 1 else 0 end as IsPayment
from ((ops_order left join
(ops_orderdetail left join mas_product on ops_orderdetail.ProductID=mas_product.ProductID)
on ops_order.OrderNo=ops_orderdetail.OrderNo)
left join mas_priceexpression on ops_order.IsExpressLevel=mas_priceexpression.IsExpressLevel)
left join (mas_branch
left join mas_branchtype on mas_branch.BranchType=mas_branchtype.BranchTypeID)
on ops_order.BranchID=mas_branch.BranchID
WHERE  ops_order.OrderDate BETWEEN  '".$date_start."' AND '".$date_end."' AND ops_order.IsActive='1'
AND mas_branch.BranchType = '".$keywords."'
Group By ops_order.OrderDate,ops_order.OrderNo,IsPayment
Order By ops_order.OrderNo ASC";

$stmt1="select top 30 ops_order.OrderNo,sum(PromoDiscount) as PromoDiscount,
coalesce(sum(SpecialDiscount),0) as SpecialDiscount,
coalesce(sum(MemberDiscount),0) as MemberDiscount,
ops_order.NetAmount
from (ops_order
left join (mas_branch left join mas_branchtype on mas_branch.BranchID=mas_branchtype.BranchTypeID)
on ops_order.BranchID=mas_branch.BranchID)
WHERE  ops_order.OrderDate BETWEEN  '".$date_start."' AND '".$date_end."' AND ops_order.IsActive='1'
AND mas_branch.BranchType = '".$keywords."'
GROUP BY ops_order.OrderNo,ops_order.NetAmount
Order By ops_order.OrderNo ASC";

$stmt2="select top 30 ops_order.OrderNo,count(ops_coupondiscount.OrderID) as couponCount
from (ops_order left join (mas_branch left join mas_branchtype on mas_branch.BranchID=mas_branchtype.BranchTypeID)
on ops_order.BranchID=mas_branch.BranchID) left join ops_coupondiscount on ops_order.OrderNo=ops_coupondiscount.OrderID
WHERE  ops_order.OrderDate BETWEEN  '".$date_start."' AND '".$date_end."' AND ops_order.IsActive='1'
AND mas_branch.BranchType = '".$keywords."'
GROUP BY ops_order.OrderNo,ops_order.NetAmount
Order By ops_order.OrderNo ASC";
				}
				}
				else if($_GET['select_top']==100){
				if($_GET['keywords2']=='cheese'||$_GET['keywords']=='cheese'){
				$stmt="select ops_order.OrderDate,ops_order.OrderNo,
coalesce (SUM(CASE WHEN ops_orderdetail.ServiceNameEN = 'Dry Clean' then 1 else null end),0) AS CountService1,
coalesce (SUM(CASE WHEN ops_orderdetail.ServiceNameEN = 'Dry Clean' then ops_orderdetail.Amount else null end),0) AS SumService1,
coalesce (SUM(CASE WHEN ops_orderdetail.ServiceNameEN = 'Laundry' then 1 else null end),0) AS CountService2,
coalesce (SUM(CASE WHEN ops_orderdetail.ServiceNameEN = 'Laundry' then ops_orderdetail.Amount else null end),0) AS SumService2,
coalesce (SUM(CASE WHEN ops_orderdetail.ServiceNameEN = 'Spa Leathers' then 1 else null end),0) AS CountService3,
coalesce (SUM(CASE WHEN ops_orderdetail.ServiceNameEN = 'Spa Leathers' then ops_orderdetail.Amount else null end),0) AS SumService3,
coalesce (SUM(CASE WHEN ops_orderdetail.ServiceNameEN = 'Press Only' then 1 else null end),0) AS CountService4,
coalesce (SUM(CASE WHEN ops_orderdetail.ServiceNameEN = 'Press Only' then ops_orderdetail.Amount else null end),0) AS SumService4,
coalesce (SUM(CASE WHEN ops_orderdetail.ServiceNameEN = 'Other' AND (ops_orderdetail.ProductID=360 OR ops_orderdetail.ProductID=361) then 1 else null end),0) AS CountService5,
coalesce (SUM(CASE WHEN ops_orderdetail.ServiceNameEN = 'Other' AND (ops_orderdetail.ProductID=360 OR ops_orderdetail.ProductID=361) then ops_orderdetail.Amount else null end),0) AS SumService5,
coalesce (SUM(CASE WHEN ops_orderdetail.ServiceNameEN = 'Other' AND ops_orderdetail.ProductID=362 then 1 else null end),0) AS CountService6,
coalesce (SUM(CASE WHEN ops_orderdetail.ServiceNameEN = 'Other' AND ops_orderdetail.ProductID=362 then ops_orderdetail.Amount else null end),0) AS SumService6,
((sum(Amount)+sum((Amount)*coalesce(ExpressRate,0))/100)+sum(coalesce(ops_orderdetail.AdditionAmount,0)))-sum(coalesce(ops_orderdetail.DiscountAmount,0)) as total,
CASE WHEN ops_order.IsPayment = 1 then 1 else 0 end as IsPayment
from ((ops_order left join
(ops_orderdetail left join mas_product on ops_orderdetail.ProductID=mas_product.ProductID)
on ops_order.OrderNo=ops_orderdetail.OrderNo)
left join mas_priceexpression on ops_order.IsExpressLevel=mas_priceexpression.IsExpressLevel)
left join (mas_branch
left join mas_branchtype on mas_branch.BranchType=mas_branchtype.BranchTypeID)
on ops_order.BranchID=mas_branch.BranchID
WHERE  ops_order.OrderDate BETWEEN  '".$date_start."' AND '".$date_end."' AND ops_order.IsActive='1'
Group By ops_order.OrderDate,ops_order.OrderNo,IsPayment
Order By ops_order.OrderNo ASC";

$stmt1="select ops_order.OrderNo,sum(PromoDiscount) as PromoDiscount,
coalesce(sum(SpecialDiscount),0) as SpecialDiscount,
coalesce(sum(MemberDiscount),0) as MemberDiscount,
ops_order.NetAmount
from (ops_order
left join (mas_branch left join mas_branchtype on mas_branch.BranchID=mas_branchtype.BranchTypeID)
on ops_order.BranchID=mas_branch.BranchID)
WHERE  ops_order.OrderDate BETWEEN  '".$date_start."' AND '".$date_end."' AND ops_order.IsActive='1'
GROUP BY ops_order.OrderNo,ops_order.NetAmount
Order By ops_order.OrderNo ASC";

$stmt2="select ops_order.OrderNo,count(ops_coupondiscount.OrderID) as couponCount
from (ops_order left join (mas_branch left join mas_branchtype on mas_branch.BranchID=mas_branchtype.BranchTypeID)
on ops_order.BranchID=mas_branch.BranchID) left join ops_coupondiscount on ops_order.OrderNo=ops_coupondiscount.OrderID
WHERE  ops_order.OrderDate BETWEEN  '".$date_start."' AND '".$date_end."' AND ops_order.IsActive='1'
GROUP BY ops_order.OrderNo,ops_order.NetAmount
Order By ops_order.OrderNo ASC";
				}else if($_GET['keywords2']!='cheese'&&$_GET['keywords']=='cheese'){
						$stmt="select ops_order.OrderDate,ops_order.OrderNo,
coalesce (SUM(CASE WHEN ops_orderdetail.ServiceNameEN = 'Dry Clean' then 1 else null end),0) AS CountService1,
coalesce (SUM(CASE WHEN ops_orderdetail.ServiceNameEN = 'Dry Clean' then ops_orderdetail.Amount else null end),0) AS SumService1,
coalesce (SUM(CASE WHEN ops_orderdetail.ServiceNameEN = 'Laundry' then 1 else null end),0) AS CountService2,
coalesce (SUM(CASE WHEN ops_orderdetail.ServiceNameEN = 'Laundry' then ops_orderdetail.Amount else null end),0) AS SumService2,
coalesce (SUM(CASE WHEN ops_orderdetail.ServiceNameEN = 'Spa Leathers' then 1 else null end),0) AS CountService3,
coalesce (SUM(CASE WHEN ops_orderdetail.ServiceNameEN = 'Spa Leathers' then ops_orderdetail.Amount else null end),0) AS SumService3,
coalesce (SUM(CASE WHEN ops_orderdetail.ServiceNameEN = 'Press Only' then 1 else null end),0) AS CountService4,
coalesce (SUM(CASE WHEN ops_orderdetail.ServiceNameEN = 'Press Only' then ops_orderdetail.Amount else null end),0) AS SumService4,
coalesce (SUM(CASE WHEN ops_orderdetail.ServiceNameEN = 'Other' AND (ops_orderdetail.ProductID=360 OR ops_orderdetail.ProductID=361) then 1 else null end),0) AS CountService5,
coalesce (SUM(CASE WHEN ops_orderdetail.ServiceNameEN = 'Other' AND (ops_orderdetail.ProductID=360 OR ops_orderdetail.ProductID=361) then ops_orderdetail.Amount else null end),0) AS SumService5,
coalesce (SUM(CASE WHEN ops_orderdetail.ServiceNameEN = 'Other' AND ops_orderdetail.ProductID=362 then 1 else null end),0) AS CountService6,
coalesce (SUM(CASE WHEN ops_orderdetail.ServiceNameEN = 'Other' AND ops_orderdetail.ProductID=362 then ops_orderdetail.Amount else null end),0) AS SumService6,
((sum(Amount)+sum((Amount)*coalesce(ExpressRate,0))/100)+sum(coalesce(ops_orderdetail.AdditionAmount,0)))-sum(coalesce(ops_orderdetail.DiscountAmount,0)) as total,
CASE WHEN ops_order.IsPayment = 1 then 1 else 0 end as IsPayment
from ((ops_order left join
(ops_orderdetail left join mas_product on ops_orderdetail.ProductID=mas_product.ProductID)
on ops_order.OrderNo=ops_orderdetail.OrderNo)
left join mas_priceexpression on ops_order.IsExpressLevel=mas_priceexpression.IsExpressLevel)
left join (mas_branch
left join mas_branchtype on mas_branch.BranchType=mas_branchtype.BranchTypeID)
on ops_order.BranchID=mas_branch.BranchID
WHERE  ops_order.OrderDate BETWEEN  '".$date_start."' AND '".$date_end."' AND ops_order.IsActive='1'
AND mas_branch.BranchID = '".$keywords2."'
Group By ops_order.OrderDate,ops_order.OrderNo,IsPayment
Order By ops_order.OrderNo ASC";

$stmt1="select ops_order.OrderNo,sum(PromoDiscount) as PromoDiscount,
coalesce(sum(SpecialDiscount),0) as SpecialDiscount,
coalesce(sum(MemberDiscount),0) as MemberDiscount,
ops_order.NetAmount
from (ops_order
left join (mas_branch left join mas_branchtype on mas_branch.BranchID=mas_branchtype.BranchTypeID)
on ops_order.BranchID=mas_branch.BranchID)
WHERE  ops_order.OrderDate BETWEEN  '".$date_start."' AND '".$date_end."' AND ops_order.IsActive='1'
AND mas_branch.BranchID = '".$keywords2."'
GROUP BY ops_order.OrderNo,ops_order.NetAmount
Order By ops_order.OrderNo ASC";

$stmt2="select ops_order.OrderNo,count(ops_coupondiscount.OrderID) as couponCount
from (ops_order left join (mas_branch left join mas_branchtype on mas_branch.BranchID=mas_branchtype.BranchTypeID)
on ops_order.BranchID=mas_branch.BranchID) left join ops_coupondiscount on ops_order.OrderNo=ops_coupondiscount.OrderID
WHERE  ops_order.OrderDate BETWEEN  '".$date_start."' AND '".$date_end."' AND ops_order.IsActive='1'
AND mas_branch.BranchID = '".$keywords2."'
GROUP BY ops_order.OrderNo,ops_order.NetAmount
Order By ops_order.OrderNo ASC";
						}
						else{
					$stmt="select ops_order.OrderDate,ops_order.OrderNo,
coalesce (SUM(CASE WHEN ops_orderdetail.ServiceNameEN = 'Dry Clean' then 1 else null end),0) AS CountService1,
coalesce (SUM(CASE WHEN ops_orderdetail.ServiceNameEN = 'Dry Clean' then ops_orderdetail.Amount else null end),0) AS SumService1,
coalesce (SUM(CASE WHEN ops_orderdetail.ServiceNameEN = 'Laundry' then 1 else null end),0) AS CountService2,
coalesce (SUM(CASE WHEN ops_orderdetail.ServiceNameEN = 'Laundry' then ops_orderdetail.Amount else null end),0) AS SumService2,
coalesce (SUM(CASE WHEN ops_orderdetail.ServiceNameEN = 'Spa Leathers' then 1 else null end),0) AS CountService3,
coalesce (SUM(CASE WHEN ops_orderdetail.ServiceNameEN = 'Spa Leathers' then ops_orderdetail.Amount else null end),0) AS SumService3,
coalesce (SUM(CASE WHEN ops_orderdetail.ServiceNameEN = 'Press Only' then 1 else null end),0) AS CountService4,
coalesce (SUM(CASE WHEN ops_orderdetail.ServiceNameEN = 'Press Only' then ops_orderdetail.Amount else null end),0) AS SumService4,
coalesce (SUM(CASE WHEN ops_orderdetail.ServiceNameEN = 'Other' AND (ops_orderdetail.ProductID=360 OR ops_orderdetail.ProductID=361) then 1 else null end),0) AS CountService5,
coalesce (SUM(CASE WHEN ops_orderdetail.ServiceNameEN = 'Other' AND (ops_orderdetail.ProductID=360 OR ops_orderdetail.ProductID=361) then ops_orderdetail.Amount else null end),0) AS SumService5,
coalesce (SUM(CASE WHEN ops_orderdetail.ServiceNameEN = 'Other' AND ops_orderdetail.ProductID=362 then 1 else null end),0) AS CountService6,
coalesce (SUM(CASE WHEN ops_orderdetail.ServiceNameEN = 'Other' AND ops_orderdetail.ProductID=362 then ops_orderdetail.Amount else null end),0) AS SumService6,
((sum(Amount)+sum((Amount)*coalesce(ExpressRate,0))/100)+sum(coalesce(ops_orderdetail.AdditionAmount,0)))-sum(coalesce(ops_orderdetail.DiscountAmount,0)) as total,
CASE WHEN ops_order.IsPayment = 1 then 1 else 0 end as IsPayment
from ((ops_order left join
(ops_orderdetail left join mas_product on ops_orderdetail.ProductID=mas_product.ProductID)
on ops_order.OrderNo=ops_orderdetail.OrderNo)
left join mas_priceexpression on ops_order.IsExpressLevel=mas_priceexpression.IsExpressLevel)
left join (mas_branch
left join mas_branchtype on mas_branch.BranchType=mas_branchtype.BranchTypeID)
on ops_order.BranchID=mas_branch.BranchID
WHERE  ops_order.OrderDate BETWEEN  '".$date_start."' AND '".$date_end."' AND ops_order.IsActive='1'
AND mas_branch.BranchType = '".$keywords."'
Group By ops_order.OrderDate,ops_order.OrderNo,IsPayment
Order By ops_order.OrderNo ASC";

$stmt1="select ops_order.OrderNo,sum(PromoDiscount) as PromoDiscount,
coalesce(sum(SpecialDiscount),0) as SpecialDiscount,
coalesce(sum(MemberDiscount),0) as MemberDiscount,
ops_order.NetAmount
from (ops_order
left join (mas_branch left join mas_branchtype on mas_branch.BranchID=mas_branchtype.BranchTypeID)
on ops_order.BranchID=mas_branch.BranchID)
WHERE  ops_order.OrderDate BETWEEN  '".$date_start."' AND '".$date_end."' AND ops_order.IsActive='1'
AND mas_branch.BranchType = '".$keywords."'
GROUP BY ops_order.OrderNo,ops_order.NetAmount
Order By ops_order.OrderNo ASC";

$stmt2="select ops_order.OrderNo,count(ops_coupondiscount.OrderID) as couponCount
from (ops_order left join (mas_branch left join mas_branchtype on mas_branch.BranchID=mas_branchtype.BranchTypeID)
on ops_order.BranchID=mas_branch.BranchID) left join ops_coupondiscount on ops_order.OrderNo=ops_coupondiscount.OrderID
WHERE  ops_order.OrderDate BETWEEN  '".$date_start."' AND '".$date_end."' AND ops_order.IsActive='1'
AND mas_branch.BranchType = '".$keywords."'
GROUP BY ops_order.OrderNo,ops_order.NetAmount
Order By ops_order.OrderNo ASC";
				}
				}
				else{
				if($_GET['keywords2']=='cheese'&&$_GET['keywords']=='cheese'){
$stmt="select ops_order.OrderDate,ops_order.OrderNo,
coalesce (SUM(CASE WHEN ops_orderdetail.ServiceNameEN = 'Dry Clean' then 1 else null end),0) AS CountService1,
coalesce (SUM(CASE WHEN ops_orderdetail.ServiceNameEN = 'Dry Clean' then ops_orderdetail.Amount else null end),0) AS SumService1,
coalesce (SUM(CASE WHEN ops_orderdetail.ServiceNameEN = 'Laundry' then 1 else null end),0) AS CountService2,
coalesce (SUM(CASE WHEN ops_orderdetail.ServiceNameEN = 'Laundry' then ops_orderdetail.Amount else null end),0) AS SumService2,
coalesce (SUM(CASE WHEN ops_orderdetail.ServiceNameEN = 'Spa Leathers' then 1 else null end),0) AS CountService3,
coalesce (SUM(CASE WHEN ops_orderdetail.ServiceNameEN = 'Spa Leathers' then ops_orderdetail.Amount else null end),0) AS SumService3,
coalesce (SUM(CASE WHEN ops_orderdetail.ServiceNameEN = 'Press Only' then 1 else null end),0) AS CountService4,
coalesce (SUM(CASE WHEN ops_orderdetail.ServiceNameEN = 'Press Only' then ops_orderdetail.Amount else null end),0) AS SumService4,
coalesce (SUM(CASE WHEN ops_orderdetail.ServiceNameEN = 'Other' AND (ops_orderdetail.ProductID=360 OR ops_orderdetail.ProductID=361) then 1 else null end),0) AS CountService5,
coalesce (SUM(CASE WHEN ops_orderdetail.ServiceNameEN = 'Other' AND (ops_orderdetail.ProductID=360 OR ops_orderdetail.ProductID=361) then ops_orderdetail.Amount else null end),0) AS SumService5,
coalesce (SUM(CASE WHEN ops_orderdetail.ServiceNameEN = 'Other' AND ops_orderdetail.ProductID=362 then 1 else null end),0) AS CountService6,
coalesce (SUM(CASE WHEN ops_orderdetail.ServiceNameEN = 'Other' AND ops_orderdetail.ProductID=362 then ops_orderdetail.Amount else null end),0) AS SumService6,
((sum(Amount)+sum((Amount)*coalesce(ExpressRate,0))/100)+sum(coalesce(ops_orderdetail.AdditionAmount,0)))-sum(coalesce(ops_orderdetail.DiscountAmount,0)) as total,
CASE WHEN ops_order.IsPayment = 1 then 1 else 0 end as IsPayment
from ((ops_order left join
(ops_orderdetail left join mas_product on ops_orderdetail.ProductID=mas_product.ProductID)
on ops_order.OrderNo=ops_orderdetail.OrderNo)
left join mas_priceexpression on ops_order.IsExpressLevel=mas_priceexpression.IsExpressLevel)
left join (mas_branch
left join mas_branchtype on mas_branch.BranchType=mas_branchtype.BranchTypeID)
on ops_order.BranchID=mas_branch.BranchID
WHERE  ops_order.OrderDate BETWEEN  '".$date_start."' AND '".$date_end."' AND ops_order.IsActive='1'
Group By ops_order.OrderDate,ops_order.OrderNo,IsPayment
Order By ops_order.OrderNo ASC";

$stmt1="select ops_order.OrderNo,sum(PromoDiscount) as PromoDiscount,
coalesce(sum(SpecialDiscount),0) as SpecialDiscount,
coalesce(sum(MemberDiscount),0) as MemberDiscount,
ops_order.NetAmount
from (ops_order
left join (mas_branch left join mas_branchtype on mas_branch.BranchID=mas_branchtype.BranchTypeID)
on ops_order.BranchID=mas_branch.BranchID)
WHERE  ops_order.OrderDate BETWEEN  '".$date_start."' AND '".$date_end."' AND ops_order.IsActive='1'
GROUP BY ops_order.OrderNo,ops_order.NetAmount
Order By ops_order.OrderNo ASC";

$stmt2="select ops_order.OrderNo,count(ops_coupondiscount.OrderID) as couponCount
from (ops_order left join (mas_branch left join mas_branchtype on mas_branch.BranchID=mas_branchtype.BranchTypeID)
on ops_order.BranchID=mas_branch.BranchID) left join ops_coupondiscount on ops_order.OrderNo=ops_coupondiscount.OrderID
WHERE  ops_order.OrderDate BETWEEN  '".$date_start."' AND '".$date_end."' AND ops_order.IsActive='1'
GROUP BY ops_order.OrderNo,ops_order.NetAmount
Order By ops_order.OrderNo ASC";

						}else if($_GET['keywords2']!='cheese'&&$_GET['keywords']=='cheese'){
						$stmt="select ops_order.OrderDate,ops_order.OrderNo,
coalesce (SUM(CASE WHEN ops_orderdetail.ServiceNameEN = 'Dry Clean' then 1 else null end),0) AS CountService1,
coalesce (SUM(CASE WHEN ops_orderdetail.ServiceNameEN = 'Dry Clean' then ops_orderdetail.Amount else null end),0) AS SumService1,
coalesce (SUM(CASE WHEN ops_orderdetail.ServiceNameEN = 'Laundry' then 1 else null end),0) AS CountService2,
coalesce (SUM(CASE WHEN ops_orderdetail.ServiceNameEN = 'Laundry' then ops_orderdetail.Amount else null end),0) AS SumService2,
coalesce (SUM(CASE WHEN ops_orderdetail.ServiceNameEN = 'Spa Leathers' then 1 else null end),0) AS CountService3,
coalesce (SUM(CASE WHEN ops_orderdetail.ServiceNameEN = 'Spa Leathers' then ops_orderdetail.Amount else null end),0) AS SumService3,
coalesce (SUM(CASE WHEN ops_orderdetail.ServiceNameEN = 'Press Only' then 1 else null end),0) AS CountService4,
coalesce (SUM(CASE WHEN ops_orderdetail.ServiceNameEN = 'Press Only' then ops_orderdetail.Amount else null end),0) AS SumService4,
coalesce (SUM(CASE WHEN ops_orderdetail.ServiceNameEN = 'Other' AND (ops_orderdetail.ProductID=360 OR ops_orderdetail.ProductID=361) then 1 else null end),0) AS CountService5,
coalesce (SUM(CASE WHEN ops_orderdetail.ServiceNameEN = 'Other' AND (ops_orderdetail.ProductID=360 OR ops_orderdetail.ProductID=361) then ops_orderdetail.Amount else null end),0) AS SumService5,
coalesce (SUM(CASE WHEN ops_orderdetail.ServiceNameEN = 'Other' AND ops_orderdetail.ProductID=362 then 1 else null end),0) AS CountService6,
coalesce (SUM(CASE WHEN ops_orderdetail.ServiceNameEN = 'Other' AND ops_orderdetail.ProductID=362 then ops_orderdetail.Amount else null end),0) AS SumService6,
((sum(Amount)+sum((Amount)*coalesce(ExpressRate,0))/100)+sum(coalesce(ops_orderdetail.AdditionAmount,0)))-sum(coalesce(ops_orderdetail.DiscountAmount,0)) as total,
CASE WHEN ops_order.IsPayment = 1 then 1 else 0 end as IsPayment
from ((ops_order left join
(ops_orderdetail left join mas_product on ops_orderdetail.ProductID=mas_product.ProductID)
on ops_order.OrderNo=ops_orderdetail.OrderNo)
left join mas_priceexpression on ops_order.IsExpressLevel=mas_priceexpression.IsExpressLevel)
left join (mas_branch
left join mas_branchtype on mas_branch.BranchType=mas_branchtype.BranchTypeID)
on ops_order.BranchID=mas_branch.BranchID
WHERE  ops_order.OrderDate BETWEEN  '".$date_start."' AND '".$date_end."' AND ops_order.IsActive='1'
AND mas_branch.BranchID = '".$keywords2."'
Group By ops_order.OrderDate,ops_order.OrderNo,IsPayment
Order By ops_order.OrderNo ASC";

$stmt1="select ops_order.OrderNo,sum(PromoDiscount) as PromoDiscount,
coalesce(sum(SpecialDiscount),0) as SpecialDiscount,
coalesce(sum(MemberDiscount),0) as MemberDiscount,
ops_order.NetAmount
from (ops_order
left join (mas_branch left join mas_branchtype on mas_branch.BranchID=mas_branchtype.BranchTypeID)
on ops_order.BranchID=mas_branch.BranchID)
WHERE  ops_order.OrderDate BETWEEN  '".$date_start."' AND '".$date_end."' AND ops_order.IsActive='1'
AND mas_branch.BranchID = '".$keywords2."'
GROUP BY ops_order.OrderNo,ops_order.NetAmount
Order By ops_order.OrderNo ASC";

$stmt2="select ops_order.OrderNo,count(ops_coupondiscount.OrderID) as couponCount
from (ops_order left join (mas_branch left join mas_branchtype on mas_branch.BranchID=mas_branchtype.BranchTypeID)
on ops_order.BranchID=mas_branch.BranchID) left join ops_coupondiscount on ops_order.OrderNo=ops_coupondiscount.OrderID
WHERE  ops_order.OrderDate BETWEEN  '".$date_start."' AND '".$date_end."' AND ops_order.IsActive='1'
AND mas_branch.BranchID = '".$keywords2."'
GROUP BY ops_order.OrderNo,ops_order.NetAmount
Order By ops_order.OrderNo ASC";
						}
						else{
					$stmt="select ops_order.OrderDate,ops_order.OrderNo,
coalesce (SUM(CASE WHEN ops_orderdetail.ServiceNameEN = 'Dry Clean' then 1 else null end),0) AS CountService1,
coalesce (SUM(CASE WHEN ops_orderdetail.ServiceNameEN = 'Dry Clean' then ops_orderdetail.Amount else null end),0) AS SumService1,
coalesce (SUM(CASE WHEN ops_orderdetail.ServiceNameEN = 'Laundry' then 1 else null end),0) AS CountService2,
coalesce (SUM(CASE WHEN ops_orderdetail.ServiceNameEN = 'Laundry' then ops_orderdetail.Amount else null end),0) AS SumService2,
coalesce (SUM(CASE WHEN ops_orderdetail.ServiceNameEN = 'Spa Leathers' then 1 else null end),0) AS CountService3,
coalesce (SUM(CASE WHEN ops_orderdetail.ServiceNameEN = 'Spa Leathers' then ops_orderdetail.Amount else null end),0) AS SumService3,
coalesce (SUM(CASE WHEN ops_orderdetail.ServiceNameEN = 'Press Only' then 1 else null end),0) AS CountService4,
coalesce (SUM(CASE WHEN ops_orderdetail.ServiceNameEN = 'Press Only' then ops_orderdetail.Amount else null end),0) AS SumService4,
coalesce (SUM(CASE WHEN ops_orderdetail.ServiceNameEN = 'Other' AND (ops_orderdetail.ProductID=360 OR ops_orderdetail.ProductID=361) then 1 else null end),0) AS CountService5,
coalesce (SUM(CASE WHEN ops_orderdetail.ServiceNameEN = 'Other' AND (ops_orderdetail.ProductID=360 OR ops_orderdetail.ProductID=361) then ops_orderdetail.Amount else null end),0) AS SumService5,
coalesce (SUM(CASE WHEN ops_orderdetail.ServiceNameEN = 'Other' AND ops_orderdetail.ProductID=362 then 1 else null end),0) AS CountService6,
coalesce (SUM(CASE WHEN ops_orderdetail.ServiceNameEN = 'Other' AND ops_orderdetail.ProductID=362 then ops_orderdetail.Amount else null end),0) AS SumService6,
((sum(Amount)+sum((Amount)*coalesce(ExpressRate,0))/100)+sum(coalesce(ops_orderdetail.AdditionAmount,0)))-sum(coalesce(ops_orderdetail.DiscountAmount,0)) as total,
CASE WHEN ops_order.IsPayment = 1 then 1 else 0 end as IsPayment
from ((ops_order left join
(ops_orderdetail left join mas_product on ops_orderdetail.ProductID=mas_product.ProductID)
on ops_order.OrderNo=ops_orderdetail.OrderNo)
left join mas_priceexpression on ops_order.IsExpressLevel=mas_priceexpression.IsExpressLevel)
left join (mas_branch
left join mas_branchtype on mas_branch.BranchType=mas_branchtype.BranchTypeID)
on ops_order.BranchID=mas_branch.BranchID
WHERE  ops_order.OrderDate BETWEEN  '".$date_start."' AND '".$date_end."' AND ops_order.IsActive='1'
AND mas_branch.BranchType = '".$keywords."'
Group By ops_order.OrderDate,ops_order.OrderNo,IsPayment
Order By ops_order.OrderNo ASC";

$stmt1="select ops_order.OrderNo,sum(PromoDiscount) as PromoDiscount,
coalesce(sum(SpecialDiscount),0) as SpecialDiscount,
coalesce(sum(MemberDiscount),0) as MemberDiscount,
ops_order.NetAmount
from (ops_order
left join (mas_branch left join mas_branchtype on mas_branch.BranchID=mas_branchtype.BranchTypeID)
on ops_order.BranchID=mas_branch.BranchID)
WHERE  ops_order.OrderDate BETWEEN  '".$date_start."' AND '".$date_end."' AND ops_order.IsActive='1'
AND mas_branch.BranchType = '".$keywords."'
GROUP BY ops_order.OrderNo,ops_order.NetAmount
Order By ops_order.OrderNo ASC";

$stmt2="select ops_order.OrderNo,count(ops_coupondiscount.OrderID) as couponCount
from (ops_order left join (mas_branch left join mas_branchtype on mas_branch.BranchID=mas_branchtype.BranchTypeID)
on ops_order.BranchID=mas_branch.BranchID) left join ops_coupondiscount on ops_order.OrderNo=ops_coupondiscount.OrderID
WHERE  ops_order.OrderDate BETWEEN  '".$date_start."' AND '".$date_end."' AND ops_order.IsActive='1'
AND mas_branch.BranchType = '".$keywords."'
GROUP BY ops_order.OrderNo,ops_order.NetAmount
Order By ops_order.OrderNo ASC";
				}
				}
				$query = sqlsrv_query($conn,$stmt);
				$query1 = sqlsrv_query($conn,$stmt1);
				$query2 = sqlsrv_query($conn,$stmt2);
				
   				$object_array = array();
				$arrOrderDate=array();
								$arrOrderNo=array();
								$arrCountService1=array();
								$arrSumService1=array();
								$arrCountService2=array();
								$arrSumService2=array();
								$arrCountService3=array();
								$arrSumService3=array();
								$arrCountService4=array();
								$arrSumService4=array();
								$arrCountService5=array();
								$arrSumService5=array();
								$arrCountService6=array();
								$arrSumService6=array();
								$arrCountCoupon=array();
								$arrTotal=array();
								$arrIsPayment=array();
								$arrMemberDiscount=array();
								$arrSpecail=array();
								while($row = sqlsrv_fetch_array($query)){

									array_push($arrOrderDate,$row['OrderDate']);
									array_push($arrOrderNo,$row['OrderNo']);
									array_push($arrCountService1,$row['CountService1']);
									array_push($arrSumService1,$row['SumService1']);
									array_push($arrCountService2,$row['CountService2']);
									array_push($arrSumService2,$row['SumService2']);
									array_push($arrCountService3,$row['CountService3']);
									array_push($arrSumService3,$row['SumService3']);
									array_push($arrCountService4,$row['CountService4']);
									array_push($arrSumService4,$row['SumService4']);
									array_push($arrCountService5,$row['CountService5']);
									array_push($arrSumService5,$row['SumService5']);
									array_push($arrCountService6,$row['CountService6']);
									array_push($arrSumService6,$row['SumService6']);
									array_push($arrTotal,$row['total']);
									array_push($arrIsPayment,$row['IsPayment']);
									//array_push($arrSpecial,$row['SpecialDiscount']);
								}
								$arrPromo=array();
								while($row1 = sqlsrv_fetch_array($query1)){
										array_push($arrPromo,$row1['PromoDiscount']);
										array_push($arrSpecail,$row1['SpecialDiscount']);
										array_push($arrMemberDiscount,$row1['MemberDiscount']);
										//array_push($arrCountCoupon,$row1['CountCoupon']);
								}
								while($row2 = sqlsrv_fetch_array($query2)){
										array_push($arrCountCoupon,$row2['couponCount']);
								}
								for($i=0;$i<count($arrPromo);$i++){
									array_push($object_array,array('OrderDate' => $arrOrderDate[$i], 'OrderNo' => $arrOrderNo[$i]
		,'CountService1' => $arrCountService1[$i],'CountService2' => $arrCountService2[$i],'CountService3' => $arrCountService3[$i]
		,'CountService4' => $arrCountService4[$i],'CountService5' => $arrCountService5[$i],'CountService6' => $arrCountService6[$i]
		,'SumService1' => $arrSumService1[$i],'SumService2' => $arrSumService2[$i],'SumService3' => $arrSumService3[$i]
		,'SumService4' => $arrSumService4[$i],'SumService5' => $arrSumService5[$i],'SumService6' => $arrSumService6[$i]
		,'couponCount' => $arrCountCoupon[$i],'PromoDiscount' => $arrPromo[$i],'MemberDiscount' => $arrMemberDiscount[$i]
		,'SpecialDiscount' => $arrSpecail[$i],'total' => (($arrTotal[$i]-$arrPromo[$i])-$arrMemberDiscount[$i])-$arrSpecail[$i]
		,'IsPayment' => $arrIsPayment[$i]));
								}
		
    $json_array=json_encode($object_array);
	echo $json_array;
?>
