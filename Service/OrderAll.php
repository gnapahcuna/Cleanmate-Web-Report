<?php
	include("config.php");
   	$keywords2=$_GET['keywords2'];
	$keywords=$_GET['keywords'];
	$date_start=$_GET['date_start'];
	$date_end=$_GET['date_end'];
	$session=$_GET['session'];
	if($session==1){

				if($_GET['select_top']==10){
				if($_GET['keywords2']=='cheese'&&$_GET['keywords']=='cheese'){
				$stmt="select top 10 ROW_NUMBER() OVER(ORDER BY ops_order.OrderNo ASC) AS Row ,mas_branch.BranchNameTH,
mas_branchtype.BranchTypeNameTH,ops_order.OrderDate,ops_order.OrderNo,
coalesce (SUM(CASE WHEN ops_orderdetail.ServiceNameEN = 'Dry Clean' then 1 else null end),0) AS service1,
coalesce (SUM(CASE WHEN ops_orderdetail.ServiceNameEN = 'Laundry' then 1 else null end),0) AS service2,
coalesce (SUM(CASE WHEN ops_orderdetail.ServiceNameEN = 'Spa Leathers' then 1 else null end),0) AS service3,
coalesce (SUM(CASE WHEN ops_orderdetail.ServiceNameEN = 'hand wash' then 1 else null end),0) AS service4,
coalesce (SUM(CASE WHEN ops_orderdetail.ServiceNameEN = 'Press Only' then 1 else null end),0) AS service7,
coalesce (SUM(CASE WHEN ops_orderdetail.ServiceNameEN = 'Other' AND (ops_orderdetail.ProductID=360 OR ops_orderdetail.ProductID=361) then 1 else null end),0) AS service5,
coalesce (SUM(CASE WHEN ops_orderdetail.ServiceNameEN = 'Other' AND ops_orderdetail.ProductID=362 then 1 else null end),0) AS service6,
coalesce (SUM(CASE WHEN ops_orderdetail.ServiceNameEN = 'Dry Clean' then 1 else null end),0) +
coalesce (SUM(CASE WHEN ops_orderdetail.ServiceNameEN = 'Laundry' then 1 else null end),0) +
coalesce (SUM(CASE WHEN ops_orderdetail.ServiceNameEN = 'Spa Leathers' then 1 else null end),0) +
coalesce (SUM(CASE WHEN ops_orderdetail.ServiceNameEN = 'hand wash' then 1 else null end),0)+
coalesce (SUM(CASE WHEN ops_orderdetail.ServiceNameEN = 'Other' AND (ops_orderdetail.ProductID=360 OR ops_orderdetail.ProductID=361) then 1 else null end),0)+
coalesce (SUM(CASE WHEN ops_orderdetail.ServiceNameEN = 'Other' AND ops_orderdetail.ProductID=362 then 1 else null end),0) AS counts,
((sum(Amount)+sum((Amount)*coalesce(ExpressRate,0))/100)+sum(coalesce(ops_orderdetail.AdditionAmount,0)))-sum(coalesce(ops_orderdetail.DiscountAmount,0)) as total from (((ops_order left join uac_customer on ops_order.CustomerID=uac_customer.CustomerID)
left join (mas_branch left join mas_branchtype on mas_branch.BranchType=mas_branchtype.BranchTypeID) ON ops_order.BranchID=mas_branch.BranchID)
left join ops_orderdetail on ops_order.OrderNo=ops_orderdetail.OrderNo)
left join mas_priceexpression on ops_order.IsExpressLevel=mas_priceexpression.IsExpressLevel
WHERE  ops_order.OrderDate BETWEEN  '".$date_start."' AND '".$date_end."' AND ops_order.IsActive='1'
Group By mas_branch.BranchNameTH,ops_order.OrderNo,mas_branchtype.BranchTypeNameTH,
ops_order.OrderDate,ops_order.NetAmount,ops_order.OrderNo
Order By ops_order.OrderNo ASC";

$stmt1="select top 10 ops_order.OrderNo,sum(PromoDiscount) as PromoDiscount,sum(ops_order.IsExpress) as counts,sum(MemberDiscount) as MemberDiscount,
sum(SpecialDiscount) as SpecialDiscount,IsPayment from (ops_order
left join (mas_branch left join mas_branchtype on mas_branch.BranchID=mas_branchtype.BranchTypeID)
on ops_order.BranchID=mas_branch.BranchID)
WHERE  ops_order.OrderDate BETWEEN  '".$date_start."' AND '".$date_end."' AND ops_order.IsActive='1'
GROUP BY ops_order.OrderNo,IsPayment
Order By ops_order.OrderNo ASC";

$stmt2="select top 10 coalesce (SUM(CASE WHEN ops_orderdetail.ServiceNameEN = 'Dry Clean' then 1 else null end),0) AS service1,
coalesce (SUM(CASE WHEN ops_orderdetail.ServiceNameEN = 'Laundry' then 1 else null end),0) AS service2,
coalesce (SUM(CASE WHEN ops_orderdetail.ServiceNameEN = 'Spa Leathers' then 1 else null end),0) AS service3,
coalesce (SUM(CASE WHEN ops_orderdetail.ServiceNameEN = 'hand wash' then 1 else null end),0) AS service4,
coalesce (SUM(CASE WHEN ops_orderdetail.ServiceNameEN = 'Press Only' then 1 else null end),0) AS service7,
coalesce (SUM(CASE WHEN ops_orderdetail.ServiceNameEN = 'Other' AND (ops_orderdetail.ProductID=360 OR ops_orderdetail.ProductID=361) then 1 else null end),0) AS service5,
coalesce (SUM(CASE WHEN ops_orderdetail.ServiceNameEN = 'Other' AND ops_orderdetail.ProductID=362 then 1 else null end),0) AS service6,
coalesce (SUM(CASE WHEN ops_orderdetail.ServiceNameEN = 'Dry Clean' then 1 else null end),0) +
coalesce (SUM(CASE WHEN ops_orderdetail.ServiceNameEN = 'Laundry' then 1 else null end),0) +
coalesce (SUM(CASE WHEN ops_orderdetail.ServiceNameEN = 'Spa Leathers' then 1 else null end),0) +
coalesce (SUM(CASE WHEN ops_orderdetail.ServiceNameEN = 'hand wash' then 1 else null end),0)+
coalesce (SUM(CASE WHEN ops_orderdetail.ServiceNameEN = 'Other' AND (ops_orderdetail.ProductID=360 OR ops_orderdetail.ProductID=361) then 1 else null end),0)+
coalesce (SUM(CASE WHEN ops_orderdetail.ServiceNameEN = 'Other' AND ops_orderdetail.ProductID=362 then 1 else null end),0) AS counts
from (ops_order left join ops_orderdetail on ops_order.OrderNo=ops_orderdetail.OrderNo)
left join (mas_branch left join mas_branchtype on mas_branch.BranchID=mas_branchtype.BranchTypeID)
on ops_order.BranchID=mas_branch.BranchID
where ops_order.OrderDate BETWEEN '".$date_start."' AND '".$date_end."' AND ops_order.IsActive='1'
group by ops_order.OrderNo
Order By ops_order.OrderNo ASC";
				}else if($_GET['keywords2']!='cheese'&&$_GET['keywords']=='cheese'){
						$stmt="select top 10 ROW_NUMBER() OVER(ORDER BY ops_order.OrderNo ASC) AS Row ,mas_branch.BranchNameTH,
mas_branchtype.BranchTypeNameTH,ops_order.OrderDate,ops_order.OrderNo,
coalesce (SUM(CASE WHEN ops_orderdetail.ServiceNameEN = 'Dry Clean' then 1 else null end),0) AS service1,
coalesce (SUM(CASE WHEN ops_orderdetail.ServiceNameEN = 'Laundry' then 1 else null end),0) AS service2,
coalesce (SUM(CASE WHEN ops_orderdetail.ServiceNameEN = 'Spa Leathers' then 1 else null end),0) AS service3,
coalesce (SUM(CASE WHEN ops_orderdetail.ServiceNameEN = 'hand wash' then 1 else null end),0) AS service4,
coalesce (SUM(CASE WHEN ops_orderdetail.ServiceNameEN = 'Press Only' then 1 else null end),0) AS service7,
coalesce (SUM(CASE WHEN ops_orderdetail.ServiceNameEN = 'Other' AND (ops_orderdetail.ProductID=360 OR ops_orderdetail.ProductID=361) then 1 else null end),0) AS service5,
coalesce (SUM(CASE WHEN ops_orderdetail.ServiceNameEN = 'Other' AND ops_orderdetail.ProductID=362 then 1 else null end),0) AS service6,
coalesce (SUM(CASE WHEN ops_orderdetail.ServiceNameEN = 'Dry Clean' then 1 else null end),0) +
coalesce (SUM(CASE WHEN ops_orderdetail.ServiceNameEN = 'Laundry' then 1 else null end),0) +
coalesce (SUM(CASE WHEN ops_orderdetail.ServiceNameEN = 'Spa Leathers' then 1 else null end),0) +
coalesce (SUM(CASE WHEN ops_orderdetail.ServiceNameEN = 'hand wash' then 1 else null end),0)+
coalesce (SUM(CASE WHEN ops_orderdetail.ServiceNameEN = 'Other' AND (ops_orderdetail.ProductID=360 OR ops_orderdetail.ProductID=361) then 1 else null end),0)+
coalesce (SUM(CASE WHEN ops_orderdetail.ServiceNameEN = 'Other' AND ops_orderdetail.ProductID=362 then 1 else null end),0) AS counts,
((sum(Amount)+sum((Amount)*coalesce(ExpressRate,0))/100)+sum(coalesce(ops_orderdetail.AdditionAmount,0)))-sum(coalesce(ops_orderdetail.DiscountAmount,0)) as total from (((ops_order left join uac_customer on ops_order.CustomerID=uac_customer.CustomerID)
left join (mas_branch left join mas_branchtype on mas_branch.BranchType=mas_branchtype.BranchTypeID) ON ops_order.BranchID=mas_branch.BranchID)
left join ops_orderdetail on ops_order.OrderNo=ops_orderdetail.OrderNo)
left join mas_priceexpression on ops_order.IsExpressLevel=mas_priceexpression.IsExpressLevel
WHERE  ops_order.OrderDate BETWEEN  '".$date_start."' AND '".$date_end."' AND ops_order.IsActive='1'
AND mas_branch.BranchID='".$keywords2."'
Group By mas_branch.BranchNameTH,ops_order.OrderNo,mas_branchtype.BranchTypeNameTH,
ops_order.OrderDate,ops_order.NetAmount,ops_order.OrderNo
Order By ops_order.OrderNo ASC";

$stmt1="select top 10 ops_order.OrderNo,sum(PromoDiscount) as PromoDiscount,sum(ops_order.IsExpress) as counts,sum(MemberDiscount) as MemberDiscount,
sum(SpecialDiscount) as SpecialDiscount,IsPayment from (ops_order
left join (mas_branch left join mas_branchtype on mas_branch.BranchID=mas_branchtype.BranchTypeID)
on ops_order.BranchID=mas_branch.BranchID)
WHERE  ops_order.OrderDate BETWEEN  '".$date_start."' AND '".$date_end."' AND ops_order.IsActive='1'
AND mas_branch.BranchID='".$keywords2."'
GROUP BY ops_order.OrderNo,IsPayment
Order By ops_order.OrderNo ASC";

$stmt2="select top 10 coalesce (SUM(CASE WHEN ops_orderdetail.ServiceNameEN = 'Dry Clean' then 1 else null end),0) AS service1,
coalesce (SUM(CASE WHEN ops_orderdetail.ServiceNameEN = 'Laundry' then 1 else null end),0) AS service2,
coalesce (SUM(CASE WHEN ops_orderdetail.ServiceNameEN = 'Spa Leathers' then 1 else null end),0) AS service3,
coalesce (SUM(CASE WHEN ops_orderdetail.ServiceNameEN = 'hand wash' then 1 else null end),0) AS service4,
coalesce (SUM(CASE WHEN ops_orderdetail.ServiceNameEN = 'Press Only' then 1 else null end),0) AS service7,
coalesce (SUM(CASE WHEN ops_orderdetail.ServiceNameEN = 'Other' AND (ops_orderdetail.ProductID=360 OR ops_orderdetail.ProductID=361) then 1 else null end),0) AS service5,
coalesce (SUM(CASE WHEN ops_orderdetail.ServiceNameEN = 'Other' AND ops_orderdetail.ProductID=362 then 1 else null end),0) AS service6,
coalesce (SUM(CASE WHEN ops_orderdetail.ServiceNameEN = 'Dry Clean' then 1 else null end),0) +
coalesce (SUM(CASE WHEN ops_orderdetail.ServiceNameEN = 'Laundry' then 1 else null end),0) +
coalesce (SUM(CASE WHEN ops_orderdetail.ServiceNameEN = 'Spa Leathers' then 1 else null end),0) +
coalesce (SUM(CASE WHEN ops_orderdetail.ServiceNameEN = 'hand wash' then 1 else null end),0)+
coalesce (SUM(CASE WHEN ops_orderdetail.ServiceNameEN = 'Other' AND (ops_orderdetail.ProductID=360 OR ops_orderdetail.ProductID=361) then 1 else null end),0)+
coalesce (SUM(CASE WHEN ops_orderdetail.ServiceNameEN = 'Other' AND ops_orderdetail.ProductID=362 then 1 else null end),0) AS counts
from (ops_order left join ops_orderdetail on ops_order.OrderNo=ops_orderdetail.OrderNo)
left join (mas_branch left join mas_branchtype on mas_branch.BranchID=mas_branchtype.BranchTypeID)
on ops_order.BranchID=mas_branch.BranchID
where ops_order.OrderDate BETWEEN '".$date_start."' AND '".$date_end."' AND ops_order.IsActive='1'
AND mas_branch.BranchID='".$keywords2."'
group by ops_order.OrderNo
Order By ops_order.OrderNo ASC";
						}
						else{
					$stmt="select top 10 ROW_NUMBER() OVER(ORDER BY ops_order.OrderNo ASC) AS Row ,mas_branch.BranchNameTH,
mas_branchtype.BranchTypeNameTH,ops_order.OrderDate,ops_order.OrderNo,
coalesce (SUM(CASE WHEN ops_orderdetail.ServiceNameEN = 'Dry Clean' then 1 else null end),0) AS service1,
coalesce (SUM(CASE WHEN ops_orderdetail.ServiceNameEN = 'Laundry' then 1 else null end),0) AS service2,
coalesce (SUM(CASE WHEN ops_orderdetail.ServiceNameEN = 'Spa Leathers' then 1 else null end),0) AS service3,
coalesce (SUM(CASE WHEN ops_orderdetail.ServiceNameEN = 'hand wash' then 1 else null end),0) AS service4,
coalesce (SUM(CASE WHEN ops_orderdetail.ServiceNameEN = 'Press Only' then 1 else null end),0) AS service7,
coalesce (SUM(CASE WHEN ops_orderdetail.ServiceNameEN = 'Other' AND (ops_orderdetail.ProductID=360 OR ops_orderdetail.ProductID=361) then 1 else null end),0) AS service5,
coalesce (SUM(CASE WHEN ops_orderdetail.ServiceNameEN = 'Other' AND ops_orderdetail.ProductID=362 then 1 else null end),0) AS service6,
coalesce (SUM(CASE WHEN ops_orderdetail.ServiceNameEN = 'Dry Clean' then 1 else null end),0) +
coalesce (SUM(CASE WHEN ops_orderdetail.ServiceNameEN = 'Laundry' then 1 else null end),0) +
coalesce (SUM(CASE WHEN ops_orderdetail.ServiceNameEN = 'Spa Leathers' then 1 else null end),0) +
coalesce (SUM(CASE WHEN ops_orderdetail.ServiceNameEN = 'hand wash' then 1 else null end),0)+
coalesce (SUM(CASE WHEN ops_orderdetail.ServiceNameEN = 'Other' AND (ops_orderdetail.ProductID=360 OR ops_orderdetail.ProductID=361) then 1 else null end),0)+
coalesce (SUM(CASE WHEN ops_orderdetail.ServiceNameEN = 'Other' AND ops_orderdetail.ProductID=362 then 1 else null end),0) AS counts,
((sum(Amount)+sum((Amount)*coalesce(ExpressRate,0))/100)+sum(coalesce(ops_orderdetail.AdditionAmount,0)))-sum(coalesce(ops_orderdetail.DiscountAmount,0)) as total from (((ops_order left join uac_customer on ops_order.CustomerID=uac_customer.CustomerID)
left join (mas_branch left join mas_branchtype on mas_branch.BranchType=mas_branchtype.BranchTypeID) ON ops_order.BranchID=mas_branch.BranchID)
left join ops_orderdetail on ops_order.OrderNo=ops_orderdetail.OrderNo)
left join mas_priceexpression on ops_order.IsExpressLevel=mas_priceexpression.IsExpressLevel
WHERE  ops_order.OrderDate BETWEEN  '".$date_start."' AND '".$date_end."' AND ops_order.IsActive='1'
AND mas_branch.BranchType = '".$keywords."'
Group By mas_branch.BranchNameTH,ops_order.OrderNo,mas_branchtype.BranchTypeNameTH,
ops_order.OrderDate,ops_order.NetAmount,ops_order.OrderNo
Order By ops_order.OrderNo ASC";

$stmt1="select top 10 ops_order.OrderNo,sum(PromoDiscount) as PromoDiscount,sum(ops_order.IsExpress) as counts,sum(MemberDiscount) as MemberDiscount,
sum(SpecialDiscount) as SpecialDiscount,IsPayment from (ops_order
left join (mas_branch left join mas_branchtype on mas_branch.BranchID=mas_branchtype.BranchTypeID)
on ops_order.BranchID=mas_branch.BranchID)
WHERE  ops_order.OrderDate BETWEEN  '".$date_start."' AND '".$date_end."' AND ops_order.IsActive='1'
AND mas_branch.BranchType = '".$keywords."'
GROUP BY ops_order.OrderNo,IsPayment
Order By ops_order.OrderNo ASC";

$stmt2="select top 10 coalesce (SUM(CASE WHEN ops_orderdetail.ServiceNameEN = 'Dry Clean' then 1 else null end),0) AS service1,
coalesce (SUM(CASE WHEN ops_orderdetail.ServiceNameEN = 'Laundry' then 1 else null end),0) AS service2,
coalesce (SUM(CASE WHEN ops_orderdetail.ServiceNameEN = 'Spa Leathers' then 1 else null end),0) AS service3,
coalesce (SUM(CASE WHEN ops_orderdetail.ServiceNameEN = 'hand wash' then 1 else null end),0) AS service4,
coalesce (SUM(CASE WHEN ops_orderdetail.ServiceNameEN = 'Press Only' then 1 else null end),0) AS service7,
coalesce (SUM(CASE WHEN ops_orderdetail.ServiceNameEN = 'Other' AND (ops_orderdetail.ProductID=360 OR ops_orderdetail.ProductID=361) then 1 else null end),0) AS service5,
coalesce (SUM(CASE WHEN ops_orderdetail.ServiceNameEN = 'Other' AND ops_orderdetail.ProductID=362 then 1 else null end),0) AS service6,
coalesce (SUM(CASE WHEN ops_orderdetail.ServiceNameEN = 'Dry Clean' then 1 else null end),0) +
coalesce (SUM(CASE WHEN ops_orderdetail.ServiceNameEN = 'Laundry' then 1 else null end),0) +
coalesce (SUM(CASE WHEN ops_orderdetail.ServiceNameEN = 'Spa Leathers' then 1 else null end),0) +
coalesce (SUM(CASE WHEN ops_orderdetail.ServiceNameEN = 'hand wash' then 1 else null end),0)+
coalesce (SUM(CASE WHEN ops_orderdetail.ServiceNameEN = 'Other' AND (ops_orderdetail.ProductID=360 OR ops_orderdetail.ProductID=361) then 1 else null end),0)+
coalesce (SUM(CASE WHEN ops_orderdetail.ServiceNameEN = 'Other' AND ops_orderdetail.ProductID=362 then 1 else null end),0) AS counts
from (ops_order left join ops_orderdetail on ops_order.OrderNo=ops_orderdetail.OrderNo)
left join (mas_branch left join mas_branchtype on mas_branch.BranchID=mas_branchtype.BranchTypeID)
on ops_order.BranchID=mas_branch.BranchID
where ops_order.OrderDate BETWEEN '".$date_start."' AND '".$date_end."' AND ops_order.IsActive='1'
AND mas_branch.BranchType = '".$keywords."'
group by ops_order.OrderNo
Order By ops_order.OrderNo ASC";
				}
				}
				else if($_GET['select_top']==20){
				if($_GET['keywords2']=='cheese'&&$_GET['keywords']=='cheese'){
				$stmt="select top 20 ROW_NUMBER() OVER(ORDER BY ops_order.OrderNo ASC) AS Row ,mas_branch.BranchNameTH,
mas_branchtype.BranchTypeNameTH,ops_order.OrderDate,ops_order.OrderNo,
coalesce (SUM(CASE WHEN ops_orderdetail.ServiceNameEN = 'Dry Clean' then 1 else null end),0) AS service1,
coalesce (SUM(CASE WHEN ops_orderdetail.ServiceNameEN = 'Laundry' then 1 else null end),0) AS service2,
coalesce (SUM(CASE WHEN ops_orderdetail.ServiceNameEN = 'Spa Leathers' then 1 else null end),0) AS service3,
coalesce (SUM(CASE WHEN ops_orderdetail.ServiceNameEN = 'hand wash' then 1 else null end),0) AS service4,
coalesce (SUM(CASE WHEN ops_orderdetail.ServiceNameEN = 'Press Only' then 1 else null end),0) AS service7,
coalesce (SUM(CASE WHEN ops_orderdetail.ServiceNameEN = 'Other' AND (ops_orderdetail.ProductID=360 OR ops_orderdetail.ProductID=361) then 1 else null end),0) AS service5,
coalesce (SUM(CASE WHEN ops_orderdetail.ServiceNameEN = 'Other' AND ops_orderdetail.ProductID=362 then 1 else null end),0) AS service6,
coalesce (SUM(CASE WHEN ops_orderdetail.ServiceNameEN = 'Dry Clean' then 1 else null end),0) +
coalesce (SUM(CASE WHEN ops_orderdetail.ServiceNameEN = 'Laundry' then 1 else null end),0) +
coalesce (SUM(CASE WHEN ops_orderdetail.ServiceNameEN = 'Spa Leathers' then 1 else null end),0) +
coalesce (SUM(CASE WHEN ops_orderdetail.ServiceNameEN = 'hand wash' then 1 else null end),0)+
coalesce (SUM(CASE WHEN ops_orderdetail.ServiceNameEN = 'Other' AND (ops_orderdetail.ProductID=360 OR ops_orderdetail.ProductID=361) then 1 else null end),0)+
coalesce (SUM(CASE WHEN ops_orderdetail.ServiceNameEN = 'Other' AND ops_orderdetail.ProductID=362 then 1 else null end),0) AS counts,
((sum(Amount)+sum((Amount)*coalesce(ExpressRate,0))/100)+sum(coalesce(ops_orderdetail.AdditionAmount,0)))-sum(coalesce(ops_orderdetail.DiscountAmount,0)) as total from (((ops_order left join uac_customer on ops_order.CustomerID=uac_customer.CustomerID)
left join (mas_branch left join mas_branchtype on mas_branch.BranchType=mas_branchtype.BranchTypeID) ON ops_order.BranchID=mas_branch.BranchID)
left join ops_orderdetail on ops_order.OrderNo=ops_orderdetail.OrderNo)
left join mas_priceexpression on ops_order.IsExpressLevel=mas_priceexpression.IsExpressLevel
WHERE  ops_order.OrderDate BETWEEN  '".$date_start."' AND '".$date_end."' AND ops_order.IsActive='1'
Group By mas_branch.BranchNameTH,ops_order.OrderNo,mas_branchtype.BranchTypeNameTH,
ops_order.OrderDate,ops_order.NetAmount,ops_order.OrderNo
Order By ops_order.OrderNo ASC";

$stmt1="select top 20 ops_order.OrderNo,sum(PromoDiscount) as PromoDiscount,sum(ops_order.IsExpress) as counts,sum(MemberDiscount) as MemberDiscount,
sum(SpecialDiscount) as SpecialDiscount,IsPayment from (ops_order
left join (mas_branch left join mas_branchtype on mas_branch.BranchID=mas_branchtype.BranchTypeID)
on ops_order.BranchID=mas_branch.BranchID)
WHERE  ops_order.OrderDate BETWEEN  '".$date_start."' AND '".$date_end."' AND ops_order.IsActive='1'
GROUP BY ops_order.OrderNo,IsPayment
Order By ops_order.OrderNo ASC";

$stmt2="select top 20 coalesce (SUM(CASE WHEN ops_orderdetail.ServiceNameEN = 'Dry Clean' then 1 else null end),0) AS service1,
coalesce (SUM(CASE WHEN ops_orderdetail.ServiceNameEN = 'Laundry' then 1 else null end),0) AS service2,
coalesce (SUM(CASE WHEN ops_orderdetail.ServiceNameEN = 'Spa Leathers' then 1 else null end),0) AS service3,
coalesce (SUM(CASE WHEN ops_orderdetail.ServiceNameEN = 'hand wash' then 1 else null end),0) AS service4,
coalesce (SUM(CASE WHEN ops_orderdetail.ServiceNameEN = 'Press Only' then 1 else null end),0) AS service7,
coalesce (SUM(CASE WHEN ops_orderdetail.ServiceNameEN = 'Other' AND (ops_orderdetail.ProductID=360 OR ops_orderdetail.ProductID=361) then 1 else null end),0) AS service5,
coalesce (SUM(CASE WHEN ops_orderdetail.ServiceNameEN = 'Other' AND ops_orderdetail.ProductID=362 then 1 else null end),0) AS service6,
coalesce (SUM(CASE WHEN ops_orderdetail.ServiceNameEN = 'Dry Clean' then 1 else null end),0) +
coalesce (SUM(CASE WHEN ops_orderdetail.ServiceNameEN = 'Laundry' then 1 else null end),0) +
coalesce (SUM(CASE WHEN ops_orderdetail.ServiceNameEN = 'Spa Leathers' then 1 else null end),0) +
coalesce (SUM(CASE WHEN ops_orderdetail.ServiceNameEN = 'hand wash' then 1 else null end),0)+
coalesce (SUM(CASE WHEN ops_orderdetail.ServiceNameEN = 'Other' AND (ops_orderdetail.ProductID=360 OR ops_orderdetail.ProductID=361) then 1 else null end),0)+
coalesce (SUM(CASE WHEN ops_orderdetail.ServiceNameEN = 'Other' AND ops_orderdetail.ProductID=362 then 1 else null end),0) AS counts
from (ops_order left join ops_orderdetail on ops_order.OrderNo=ops_orderdetail.OrderNo)
left join (mas_branch left join mas_branchtype on mas_branch.BranchID=mas_branchtype.BranchTypeID)
on ops_order.BranchID=mas_branch.BranchID
where ops_order.OrderDate BETWEEN '".$date_start."' AND '".$date_end."' AND ops_order.IsActive='1'
group by ops_order.OrderNo
Order By ops_order.OrderNo ASC";
				}else if($_GET['keywords2']!='cheese'&&$_GET['keywords']=='cheese'){
						$stmt="select top 20 ROW_NUMBER() OVER(ORDER BY ops_order.OrderNo ASC) AS Row ,mas_branch.BranchNameTH,
mas_branchtype.BranchTypeNameTH,ops_order.OrderDate,ops_order.OrderNo,
coalesce (SUM(CASE WHEN ops_orderdetail.ServiceNameEN = 'Dry Clean' then 1 else null end),0) AS service1,
coalesce (SUM(CASE WHEN ops_orderdetail.ServiceNameEN = 'Laundry' then 1 else null end),0) AS service2,
coalesce (SUM(CASE WHEN ops_orderdetail.ServiceNameEN = 'Spa Leathers' then 1 else null end),0) AS service3,
coalesce (SUM(CASE WHEN ops_orderdetail.ServiceNameEN = 'hand wash' then 1 else null end),0) AS service4,
coalesce (SUM(CASE WHEN ops_orderdetail.ServiceNameEN = 'Press Only' then 1 else null end),0) AS service7,
coalesce (SUM(CASE WHEN ops_orderdetail.ServiceNameEN = 'Other' AND (ops_orderdetail.ProductID=360 OR ops_orderdetail.ProductID=361) then 1 else null end),0) AS service5,
coalesce (SUM(CASE WHEN ops_orderdetail.ServiceNameEN = 'Other' AND ops_orderdetail.ProductID=362 then 1 else null end),0) AS service6,
coalesce (SUM(CASE WHEN ops_orderdetail.ServiceNameEN = 'Dry Clean' then 1 else null end),0) +
coalesce (SUM(CASE WHEN ops_orderdetail.ServiceNameEN = 'Laundry' then 1 else null end),0) +
coalesce (SUM(CASE WHEN ops_orderdetail.ServiceNameEN = 'Spa Leathers' then 1 else null end),0) +
coalesce (SUM(CASE WHEN ops_orderdetail.ServiceNameEN = 'hand wash' then 1 else null end),0)+
coalesce (SUM(CASE WHEN ops_orderdetail.ServiceNameEN = 'Other' AND (ops_orderdetail.ProductID=360 OR ops_orderdetail.ProductID=361) then 1 else null end),0)+
coalesce (SUM(CASE WHEN ops_orderdetail.ServiceNameEN = 'Other' AND ops_orderdetail.ProductID=362 then 1 else null end),0) AS counts,
((sum(Amount)+sum((Amount)*coalesce(ExpressRate,0))/100)+sum(coalesce(ops_orderdetail.AdditionAmount,0)))-sum(coalesce(ops_orderdetail.DiscountAmount,0)) as total from (((ops_order left join uac_customer on ops_order.CustomerID=uac_customer.CustomerID)
left join (mas_branch left join mas_branchtype on mas_branch.BranchType=mas_branchtype.BranchTypeID) ON ops_order.BranchID=mas_branch.BranchID)
left join ops_orderdetail on ops_order.OrderNo=ops_orderdetail.OrderNo)
left join mas_priceexpression on ops_order.IsExpressLevel=mas_priceexpression.IsExpressLevel
WHERE  ops_order.OrderDate BETWEEN  '".$date_start."' AND '".$date_end."' AND ops_order.IsActive='1'
AND mas_branch.BranchID='".$keywords2."'
Group By mas_branch.BranchNameTH,ops_order.OrderNo,mas_branchtype.BranchTypeNameTH,
ops_order.OrderDate,ops_order.NetAmount,ops_order.OrderNo
Order By ops_order.OrderNo ASC";

$stmt1="select top 20 ops_order.OrderNo,sum(PromoDiscount) as PromoDiscount,sum(ops_order.IsExpress) as counts,sum(MemberDiscount) as MemberDiscount,
sum(SpecialDiscount) as SpecialDiscount,IsPayment from (ops_order
left join (mas_branch left join mas_branchtype on mas_branch.BranchID=mas_branchtype.BranchTypeID)
on ops_order.BranchID=mas_branch.BranchID)
WHERE  ops_order.OrderDate BETWEEN  '".$date_start."' AND '".$date_end."' AND ops_order.IsActive='1'
AND mas_branch.BranchID='".$keywords2."'
GROUP BY ops_order.OrderNo,IsPayment
Order By ops_order.OrderNo ASC";

$stmt2="select top 20 coalesce (SUM(CASE WHEN ops_orderdetail.ServiceNameEN = 'Dry Clean' then 1 else null end),0) AS service1,
coalesce (SUM(CASE WHEN ops_orderdetail.ServiceNameEN = 'Laundry' then 1 else null end),0) AS service2,
coalesce (SUM(CASE WHEN ops_orderdetail.ServiceNameEN = 'Spa Leathers' then 1 else null end),0) AS service3,
coalesce (SUM(CASE WHEN ops_orderdetail.ServiceNameEN = 'hand wash' then 1 else null end),0) AS service4,
coalesce (SUM(CASE WHEN ops_orderdetail.ServiceNameEN = 'Press Only' then 1 else null end),0) AS service7,
coalesce (SUM(CASE WHEN ops_orderdetail.ServiceNameEN = 'Other' AND (ops_orderdetail.ProductID=360 OR ops_orderdetail.ProductID=361) then 1 else null end),0) AS service5,
coalesce (SUM(CASE WHEN ops_orderdetail.ServiceNameEN = 'Other' AND ops_orderdetail.ProductID=362 then 1 else null end),0) AS service6,
coalesce (SUM(CASE WHEN ops_orderdetail.ServiceNameEN = 'Dry Clean' then 1 else null end),0) +
coalesce (SUM(CASE WHEN ops_orderdetail.ServiceNameEN = 'Laundry' then 1 else null end),0) +
coalesce (SUM(CASE WHEN ops_orderdetail.ServiceNameEN = 'Spa Leathers' then 1 else null end),0) +
coalesce (SUM(CASE WHEN ops_orderdetail.ServiceNameEN = 'hand wash' then 1 else null end),0)+
coalesce (SUM(CASE WHEN ops_orderdetail.ServiceNameEN = 'Other' AND (ops_orderdetail.ProductID=360 OR ops_orderdetail.ProductID=361) then 1 else null end),0)+
coalesce (SUM(CASE WHEN ops_orderdetail.ServiceNameEN = 'Other' AND ops_orderdetail.ProductID=362 then 1 else null end),0) AS counts
from (ops_order left join ops_orderdetail on ops_order.OrderNo=ops_orderdetail.OrderNo)
left join (mas_branch left join mas_branchtype on mas_branch.BranchID=mas_branchtype.BranchTypeID)
on ops_order.BranchID=mas_branch.BranchID
where ops_order.OrderDate BETWEEN '".$date_start."' AND '".$date_end."' AND ops_order.IsActive='1'
AND mas_branch.BranchID='".$keywords2."'
group by ops_order.OrderNo
Order By ops_order.OrderNo ASC";
						}
						else{
					$stmt="select top 20 ROW_NUMBER() OVER(ORDER BY ops_order.OrderNo ASC) AS Row ,mas_branch.BranchNameTH,
mas_branchtype.BranchTypeNameTH,ops_order.OrderDate,ops_order.OrderNo,
coalesce (SUM(CASE WHEN ops_orderdetail.ServiceNameEN = 'Dry Clean' then 1 else null end),0) AS service1,
coalesce (SUM(CASE WHEN ops_orderdetail.ServiceNameEN = 'Laundry' then 1 else null end),0) AS service2,
coalesce (SUM(CASE WHEN ops_orderdetail.ServiceNameEN = 'Spa Leathers' then 1 else null end),0) AS service3,
coalesce (SUM(CASE WHEN ops_orderdetail.ServiceNameEN = 'hand wash' then 1 else null end),0) AS service4,
coalesce (SUM(CASE WHEN ops_orderdetail.ServiceNameEN = 'Press Only' then 1 else null end),0) AS service7,
coalesce (SUM(CASE WHEN ops_orderdetail.ServiceNameEN = 'Other' AND (ops_orderdetail.ProductID=360 OR ops_orderdetail.ProductID=361) then 1 else null end),0) AS service5,
coalesce (SUM(CASE WHEN ops_orderdetail.ServiceNameEN = 'Other' AND ops_orderdetail.ProductID=362 then 1 else null end),0) AS service6,
coalesce (SUM(CASE WHEN ops_orderdetail.ServiceNameEN = 'Dry Clean' then 1 else null end),0) +
coalesce (SUM(CASE WHEN ops_orderdetail.ServiceNameEN = 'Laundry' then 1 else null end),0) +
coalesce (SUM(CASE WHEN ops_orderdetail.ServiceNameEN = 'Spa Leathers' then 1 else null end),0) +
coalesce (SUM(CASE WHEN ops_orderdetail.ServiceNameEN = 'hand wash' then 1 else null end),0)+
coalesce (SUM(CASE WHEN ops_orderdetail.ServiceNameEN = 'Other' AND (ops_orderdetail.ProductID=360 OR ops_orderdetail.ProductID=361) then 1 else null end),0)+
coalesce (SUM(CASE WHEN ops_orderdetail.ServiceNameEN = 'Other' AND ops_orderdetail.ProductID=362 then 1 else null end),0) AS counts,
((sum(Amount)+sum((Amount)*coalesce(ExpressRate,0))/100)+sum(coalesce(ops_orderdetail.AdditionAmount,0)))-sum(coalesce(ops_orderdetail.DiscountAmount,0)) as total from (((ops_order left join uac_customer on ops_order.CustomerID=uac_customer.CustomerID)
left join (mas_branch left join mas_branchtype on mas_branch.BranchType=mas_branchtype.BranchTypeID) ON ops_order.BranchID=mas_branch.BranchID)
left join ops_orderdetail on ops_order.OrderNo=ops_orderdetail.OrderNo)
left join mas_priceexpression on ops_order.IsExpressLevel=mas_priceexpression.IsExpressLevel
WHERE  ops_order.OrderDate BETWEEN  '".$date_start."' AND '".$date_end."' AND ops_order.IsActive='1'
AND mas_branch.BranchType = '".$keywords."'
Group By mas_branch.BranchNameTH,ops_order.OrderNo,mas_branchtype.BranchTypeNameTH,
ops_order.OrderDate,ops_order.NetAmount,ops_order.OrderNo
Order By ops_order.OrderNo ASC";

$stmt1="select top 20 ops_order.OrderNo,sum(PromoDiscount) as PromoDiscount,sum(ops_order.IsExpress) as counts,sum(MemberDiscount) as MemberDiscount,
sum(SpecialDiscount) as SpecialDiscount,IsPayment from (ops_order
left join (mas_branch left join mas_branchtype on mas_branch.BranchID=mas_branchtype.BranchTypeID)
on ops_order.BranchID=mas_branch.BranchID)
WHERE  ops_order.OrderDate BETWEEN  '".$date_start."' AND '".$date_end."' AND ops_order.IsActive='1'
AND mas_branch.BranchType = '".$keywords."'
GROUP BY ops_order.OrderNo,IsPayment
Order By ops_order.OrderNo ASC";

$stmt2="select top 20 coalesce (SUM(CASE WHEN ops_orderdetail.ServiceNameEN = 'Dry Clean' then 1 else null end),0) AS service1,
coalesce (SUM(CASE WHEN ops_orderdetail.ServiceNameEN = 'Laundry' then 1 else null end),0) AS service2,
coalesce (SUM(CASE WHEN ops_orderdetail.ServiceNameEN = 'Spa Leathers' then 1 else null end),0) AS service3,
coalesce (SUM(CASE WHEN ops_orderdetail.ServiceNameEN = 'hand wash' then 1 else null end),0) AS service4,
coalesce (SUM(CASE WHEN ops_orderdetail.ServiceNameEN = 'Press Only' then 1 else null end),0) AS service7,
coalesce (SUM(CASE WHEN ops_orderdetail.ServiceNameEN = 'Other' AND (ops_orderdetail.ProductID=360 OR ops_orderdetail.ProductID=361) then 1 else null end),0) AS service5,
coalesce (SUM(CASE WHEN ops_orderdetail.ServiceNameEN = 'Other' AND ops_orderdetail.ProductID=362 then 1 else null end),0) AS service6,
coalesce (SUM(CASE WHEN ops_orderdetail.ServiceNameEN = 'Dry Clean' then 1 else null end),0) +
coalesce (SUM(CASE WHEN ops_orderdetail.ServiceNameEN = 'Laundry' then 1 else null end),0) +
coalesce (SUM(CASE WHEN ops_orderdetail.ServiceNameEN = 'Spa Leathers' then 1 else null end),0) +
coalesce (SUM(CASE WHEN ops_orderdetail.ServiceNameEN = 'hand wash' then 1 else null end),0)+
coalesce (SUM(CASE WHEN ops_orderdetail.ServiceNameEN = 'Other' AND (ops_orderdetail.ProductID=360 OR ops_orderdetail.ProductID=361) then 1 else null end),0)+
coalesce (SUM(CASE WHEN ops_orderdetail.ServiceNameEN = 'Other' AND ops_orderdetail.ProductID=362 then 1 else null end),0) AS counts
from (ops_order left join ops_orderdetail on ops_order.OrderNo=ops_orderdetail.OrderNo)
left join (mas_branch left join mas_branchtype on mas_branch.BranchID=mas_branchtype.BranchTypeID)
on ops_order.BranchID=mas_branch.BranchID
where ops_order.OrderDate BETWEEN '".$date_start."' AND '".$date_end."' AND ops_order.IsActive='1'
AND mas_branch.BranchType = '".$keywords."'
group by ops_order.OrderNo
Order By ops_order.OrderNo ASC";
				}
				}
				else if($_GET['select_top']==30){
				if($_GET['keywords2']=='cheese'&&$_GET['keywords']=='cheese'){
				$stmt="select top 30 ROW_NUMBER() OVER(ORDER BY ops_order.OrderNo ASC) AS Row ,mas_branch.BranchNameTH,
mas_branchtype.BranchTypeNameTH,ops_order.OrderDate,ops_order.OrderNo,
coalesce (SUM(CASE WHEN ops_orderdetail.ServiceNameEN = 'Dry Clean' then 1 else null end),0) AS service1,
coalesce (SUM(CASE WHEN ops_orderdetail.ServiceNameEN = 'Laundry' then 1 else null end),0) AS service2,
coalesce (SUM(CASE WHEN ops_orderdetail.ServiceNameEN = 'Spa Leathers' then 1 else null end),0) AS service3,
coalesce (SUM(CASE WHEN ops_orderdetail.ServiceNameEN = 'hand wash' then 1 else null end),0) AS service4,
coalesce (SUM(CASE WHEN ops_orderdetail.ServiceNameEN = 'Press Only' then 1 else null end),0) AS service7,
coalesce (SUM(CASE WHEN ops_orderdetail.ServiceNameEN = 'Other' AND (ops_orderdetail.ProductID=360 OR ops_orderdetail.ProductID=361) then 1 else null end),0) AS service5,
coalesce (SUM(CASE WHEN ops_orderdetail.ServiceNameEN = 'Other' AND ops_orderdetail.ProductID=362 then 1 else null end),0) AS service6,
coalesce (SUM(CASE WHEN ops_orderdetail.ServiceNameEN = 'Dry Clean' then 1 else null end),0) +
coalesce (SUM(CASE WHEN ops_orderdetail.ServiceNameEN = 'Laundry' then 1 else null end),0) +
coalesce (SUM(CASE WHEN ops_orderdetail.ServiceNameEN = 'Spa Leathers' then 1 else null end),0) +
coalesce (SUM(CASE WHEN ops_orderdetail.ServiceNameEN = 'hand wash' then 1 else null end),0)+
coalesce (SUM(CASE WHEN ops_orderdetail.ServiceNameEN = 'Other' AND (ops_orderdetail.ProductID=360 OR ops_orderdetail.ProductID=361) then 1 else null end),0)+
coalesce (SUM(CASE WHEN ops_orderdetail.ServiceNameEN = 'Other' AND ops_orderdetail.ProductID=362 then 1 else null end),0) AS counts,
((sum(Amount)+sum((Amount)*coalesce(ExpressRate,0))/100)+sum(coalesce(ops_orderdetail.AdditionAmount,0)))-sum(coalesce(ops_orderdetail.DiscountAmount,0)) as total from (((ops_order left join uac_customer on ops_order.CustomerID=uac_customer.CustomerID)
left join (mas_branch left join mas_branchtype on mas_branch.BranchType=mas_branchtype.BranchTypeID) ON ops_order.BranchID=mas_branch.BranchID)
left join ops_orderdetail on ops_order.OrderNo=ops_orderdetail.OrderNo)
left join mas_priceexpression on ops_order.IsExpressLevel=mas_priceexpression.IsExpressLevel
WHERE  ops_order.OrderDate BETWEEN  '".$date_start."' AND '".$date_end."' AND ops_order.IsActive='1'
Group By mas_branch.BranchNameTH,ops_order.OrderNo,mas_branchtype.BranchTypeNameTH,
ops_order.OrderDate,ops_order.NetAmount,ops_order.OrderNo
Order By ops_order.OrderNo ASC";

$stmt1="select top 30 ops_order.OrderNo,sum(PromoDiscount) as PromoDiscount,sum(ops_order.IsExpress) as counts,sum(MemberDiscount) as MemberDiscount,
sum(SpecialDiscount) as SpecialDiscount,IsPayment from (ops_order
left join (mas_branch left join mas_branchtype on mas_branch.BranchID=mas_branchtype.BranchTypeID)
on ops_order.BranchID=mas_branch.BranchID)
WHERE  ops_order.OrderDate BETWEEN  '".$date_start."' AND '".$date_end."' AND ops_order.IsActive='1'
GROUP BY ops_order.OrderNo,IsPayment
Order By ops_order.OrderNo ASC";

$stmt2="select top 30 coalesce (SUM(CASE WHEN ops_orderdetail.ServiceNameEN = 'Dry Clean' then 1 else null end),0) AS service1,
coalesce (SUM(CASE WHEN ops_orderdetail.ServiceNameEN = 'Laundry' then 1 else null end),0) AS service2,
coalesce (SUM(CASE WHEN ops_orderdetail.ServiceNameEN = 'Spa Leathers' then 1 else null end),0) AS service3,
coalesce (SUM(CASE WHEN ops_orderdetail.ServiceNameEN = 'hand wash' then 1 else null end),0) AS service4,
coalesce (SUM(CASE WHEN ops_orderdetail.ServiceNameEN = 'Press Only' then 1 else null end),0) AS service7,
coalesce (SUM(CASE WHEN ops_orderdetail.ServiceNameEN = 'Other' AND (ops_orderdetail.ProductID=360 OR ops_orderdetail.ProductID=361) then 1 else null end),0) AS service5,
coalesce (SUM(CASE WHEN ops_orderdetail.ServiceNameEN = 'Other' AND ops_orderdetail.ProductID=362 then 1 else null end),0) AS service6,
coalesce (SUM(CASE WHEN ops_orderdetail.ServiceNameEN = 'Dry Clean' then 1 else null end),0) +
coalesce (SUM(CASE WHEN ops_orderdetail.ServiceNameEN = 'Laundry' then 1 else null end),0) +
coalesce (SUM(CASE WHEN ops_orderdetail.ServiceNameEN = 'Spa Leathers' then 1 else null end),0) +
coalesce (SUM(CASE WHEN ops_orderdetail.ServiceNameEN = 'hand wash' then 1 else null end),0)+
coalesce (SUM(CASE WHEN ops_orderdetail.ServiceNameEN = 'Other' AND (ops_orderdetail.ProductID=360 OR ops_orderdetail.ProductID=361) then 1 else null end),0)+
coalesce (SUM(CASE WHEN ops_orderdetail.ServiceNameEN = 'Other' AND ops_orderdetail.ProductID=362 then 1 else null end),0) AS counts
from (ops_order left join ops_orderdetail on ops_order.OrderNo=ops_orderdetail.OrderNo)
left join (mas_branch left join mas_branchtype on mas_branch.BranchID=mas_branchtype.BranchTypeID)
on ops_order.BranchID=mas_branch.BranchID
where ops_order.OrderDate BETWEEN '".$date_start."' AND '".$date_end."' AND ops_order.IsActive='1'
group by ops_order.OrderNo
Order By ops_order.OrderNo ASC";
				}else if($_GET['keywords2']!='cheese'&&$_GET['keywords']=='cheese'){
						$stmt="select top 30 ROW_NUMBER() OVER(ORDER BY ops_order.OrderNo ASC) AS Row ,mas_branch.BranchNameTH,
mas_branchtype.BranchTypeNameTH,ops_order.OrderDate,ops_order.OrderNo,
coalesce (SUM(CASE WHEN ops_orderdetail.ServiceNameEN = 'Dry Clean' then 1 else null end),0) AS service1,
coalesce (SUM(CASE WHEN ops_orderdetail.ServiceNameEN = 'Laundry' then 1 else null end),0) AS service2,
coalesce (SUM(CASE WHEN ops_orderdetail.ServiceNameEN = 'Spa Leathers' then 1 else null end),0) AS service3,
coalesce (SUM(CASE WHEN ops_orderdetail.ServiceNameEN = 'hand wash' then 1 else null end),0) AS service4,
coalesce (SUM(CASE WHEN ops_orderdetail.ServiceNameEN = 'Press Only' then 1 else null end),0) AS service7,
coalesce (SUM(CASE WHEN ops_orderdetail.ServiceNameEN = 'Other' AND (ops_orderdetail.ProductID=360 OR ops_orderdetail.ProductID=361) then 1 else null end),0) AS service5,
coalesce (SUM(CASE WHEN ops_orderdetail.ServiceNameEN = 'Other' AND ops_orderdetail.ProductID=362 then 1 else null end),0) AS service6,
coalesce (SUM(CASE WHEN ops_orderdetail.ServiceNameEN = 'Dry Clean' then 1 else null end),0) +
coalesce (SUM(CASE WHEN ops_orderdetail.ServiceNameEN = 'Laundry' then 1 else null end),0) +
coalesce (SUM(CASE WHEN ops_orderdetail.ServiceNameEN = 'Spa Leathers' then 1 else null end),0) +
coalesce (SUM(CASE WHEN ops_orderdetail.ServiceNameEN = 'hand wash' then 1 else null end),0)+
coalesce (SUM(CASE WHEN ops_orderdetail.ServiceNameEN = 'Other' AND (ops_orderdetail.ProductID=360 OR ops_orderdetail.ProductID=361) then 1 else null end),0)+
coalesce (SUM(CASE WHEN ops_orderdetail.ServiceNameEN = 'Other' AND ops_orderdetail.ProductID=362 then 1 else null end),0) AS counts,
((sum(Amount)+sum((Amount)*coalesce(ExpressRate,0))/100)+sum(coalesce(ops_orderdetail.AdditionAmount,0)))-sum(coalesce(ops_orderdetail.DiscountAmount,0)) as total from (((ops_order left join uac_customer on ops_order.CustomerID=uac_customer.CustomerID)
left join (mas_branch left join mas_branchtype on mas_branch.BranchType=mas_branchtype.BranchTypeID) ON ops_order.BranchID=mas_branch.BranchID)
left join ops_orderdetail on ops_order.OrderNo=ops_orderdetail.OrderNo)
left join mas_priceexpression on ops_order.IsExpressLevel=mas_priceexpression.IsExpressLevel
WHERE  ops_order.OrderDate BETWEEN  '".$date_start."' AND '".$date_end."' AND ops_order.IsActive='1'
AND mas_branch.BranchID='".$keywords2."'
Group By mas_branch.BranchNameTH,ops_order.OrderNo,mas_branchtype.BranchTypeNameTH,
ops_order.OrderDate,ops_order.NetAmount,ops_order.OrderNo
Order By ops_order.OrderNo ASC";

$stmt1="select top 30 ops_order.OrderNo,sum(PromoDiscount) as PromoDiscount,sum(ops_order.IsExpress) as counts,sum(MemberDiscount) as MemberDiscount,
sum(SpecialDiscount) as SpecialDiscount,IsPayment from (ops_order
left join (mas_branch left join mas_branchtype on mas_branch.BranchID=mas_branchtype.BranchTypeID)
on ops_order.BranchID=mas_branch.BranchID)
WHERE  ops_order.OrderDate BETWEEN  '".$date_start."' AND '".$date_end."' AND ops_order.IsActive='1'
AND mas_branch.BranchID='".$keywords2."'
GROUP BY ops_order.OrderNo,IsPayment
Order By ops_order.OrderNo ASC";

$stmt2="select top 30 coalesce (SUM(CASE WHEN ops_orderdetail.ServiceNameEN = 'Dry Clean' then 1 else null end),0) AS service1,
coalesce (SUM(CASE WHEN ops_orderdetail.ServiceNameEN = 'Laundry' then 1 else null end),0) AS service2,
coalesce (SUM(CASE WHEN ops_orderdetail.ServiceNameEN = 'Spa Leathers' then 1 else null end),0) AS service3,
coalesce (SUM(CASE WHEN ops_orderdetail.ServiceNameEN = 'hand wash' then 1 else null end),0) AS service4,
coalesce (SUM(CASE WHEN ops_orderdetail.ServiceNameEN = 'Press Only' then 1 else null end),0) AS service7,
coalesce (SUM(CASE WHEN ops_orderdetail.ServiceNameEN = 'Other' AND (ops_orderdetail.ProductID=360 OR ops_orderdetail.ProductID=361) then 1 else null end),0) AS service5,
coalesce (SUM(CASE WHEN ops_orderdetail.ServiceNameEN = 'Other' AND ops_orderdetail.ProductID=362 then 1 else null end),0) AS service6,
coalesce (SUM(CASE WHEN ops_orderdetail.ServiceNameEN = 'Dry Clean' then 1 else null end),0) +
coalesce (SUM(CASE WHEN ops_orderdetail.ServiceNameEN = 'Laundry' then 1 else null end),0) +
coalesce (SUM(CASE WHEN ops_orderdetail.ServiceNameEN = 'Spa Leathers' then 1 else null end),0) +
coalesce (SUM(CASE WHEN ops_orderdetail.ServiceNameEN = 'hand wash' then 1 else null end),0)+
coalesce (SUM(CASE WHEN ops_orderdetail.ServiceNameEN = 'Other' AND (ops_orderdetail.ProductID=360 OR ops_orderdetail.ProductID=361) then 1 else null end),0)+
coalesce (SUM(CASE WHEN ops_orderdetail.ServiceNameEN = 'Other' AND ops_orderdetail.ProductID=362 then 1 else null end),0) AS counts
from (ops_order left join ops_orderdetail on ops_order.OrderNo=ops_orderdetail.OrderNo)
left join (mas_branch left join mas_branchtype on mas_branch.BranchID=mas_branchtype.BranchTypeID)
on ops_order.BranchID=mas_branch.BranchID
where ops_order.OrderDate BETWEEN '".$date_start."' AND '".$date_end."' AND ops_order.IsActive='1'
AND mas_branch.BranchID='".$keywords2."'
group by ops_order.OrderNo
Order By ops_order.OrderNo ASC";
						}
						else{
					$stmt="select top 30 ROW_NUMBER() OVER(ORDER BY ops_order.OrderNo ASC) AS Row ,mas_branch.BranchNameTH,
mas_branchtype.BranchTypeNameTH,ops_order.OrderDate,ops_order.OrderNo,
coalesce (SUM(CASE WHEN ops_orderdetail.ServiceNameEN = 'Dry Clean' then 1 else null end),0) AS service1,
coalesce (SUM(CASE WHEN ops_orderdetail.ServiceNameEN = 'Laundry' then 1 else null end),0) AS service2,
coalesce (SUM(CASE WHEN ops_orderdetail.ServiceNameEN = 'Spa Leathers' then 1 else null end),0) AS service3,
coalesce (SUM(CASE WHEN ops_orderdetail.ServiceNameEN = 'hand wash' then 1 else null end),0) AS service4,
coalesce (SUM(CASE WHEN ops_orderdetail.ServiceNameEN = 'Press Only' then 1 else null end),0) AS service7,
coalesce (SUM(CASE WHEN ops_orderdetail.ServiceNameEN = 'Other' AND (ops_orderdetail.ProductID=360 OR ops_orderdetail.ProductID=361) then 1 else null end),0) AS service5,
coalesce (SUM(CASE WHEN ops_orderdetail.ServiceNameEN = 'Other' AND ops_orderdetail.ProductID=362 then 1 else null end),0) AS service6,
coalesce (SUM(CASE WHEN ops_orderdetail.ServiceNameEN = 'Dry Clean' then 1 else null end),0) +
coalesce (SUM(CASE WHEN ops_orderdetail.ServiceNameEN = 'Laundry' then 1 else null end),0) +
coalesce (SUM(CASE WHEN ops_orderdetail.ServiceNameEN = 'Spa Leathers' then 1 else null end),0) +
coalesce (SUM(CASE WHEN ops_orderdetail.ServiceNameEN = 'hand wash' then 1 else null end),0)+
coalesce (SUM(CASE WHEN ops_orderdetail.ServiceNameEN = 'Other' AND (ops_orderdetail.ProductID=360 OR ops_orderdetail.ProductID=361) then 1 else null end),0)+
coalesce (SUM(CASE WHEN ops_orderdetail.ServiceNameEN = 'Other' AND ops_orderdetail.ProductID=362 then 1 else null end),0) AS counts,
((sum(Amount)+sum((Amount)*coalesce(ExpressRate,0))/100)+sum(coalesce(ops_orderdetail.AdditionAmount,0)))-sum(coalesce(ops_orderdetail.DiscountAmount,0)) as total from (((ops_order left join uac_customer on ops_order.CustomerID=uac_customer.CustomerID)
left join (mas_branch left join mas_branchtype on mas_branch.BranchType=mas_branchtype.BranchTypeID) ON ops_order.BranchID=mas_branch.BranchID)
left join ops_orderdetail on ops_order.OrderNo=ops_orderdetail.OrderNo)
left join mas_priceexpression on ops_order.IsExpressLevel=mas_priceexpression.IsExpressLevel
WHERE  ops_order.OrderDate BETWEEN  '".$date_start."' AND '".$date_end."' AND ops_order.IsActive='1'
AND mas_branch.BranchType = '".$keywords."'
Group By mas_branch.BranchNameTH,ops_order.OrderNo,mas_branchtype.BranchTypeNameTH,
ops_order.OrderDate,ops_order.NetAmount,ops_order.OrderNo
Order By ops_order.OrderNo ASC";

$stmt1="select top 30 ops_order.OrderNo,sum(PromoDiscount) as PromoDiscount,sum(ops_order.IsExpress) as counts,sum(MemberDiscount) as MemberDiscount,
sum(SpecialDiscount) as SpecialDiscount,IsPayment from (ops_order
left join (mas_branch left join mas_branchtype on mas_branch.BranchID=mas_branchtype.BranchTypeID)
on ops_order.BranchID=mas_branch.BranchID)
WHERE  ops_order.OrderDate BETWEEN  '".$date_start."' AND '".$date_end."' AND ops_order.IsActive='1'
AND mas_branch.BranchType = '".$keywords."'
GROUP BY ops_order.OrderNo,IsPayment
Order By ops_order.OrderNo ASC";

$stmt2="select top 30 coalesce (SUM(CASE WHEN ops_orderdetail.ServiceNameEN = 'Dry Clean' then 1 else null end),0) AS service1,
coalesce (SUM(CASE WHEN ops_orderdetail.ServiceNameEN = 'Laundry' then 1 else null end),0) AS service2,
coalesce (SUM(CASE WHEN ops_orderdetail.ServiceNameEN = 'Spa Leathers' then 1 else null end),0) AS service3,
coalesce (SUM(CASE WHEN ops_orderdetail.ServiceNameEN = 'hand wash' then 1 else null end),0) AS service4,
coalesce (SUM(CASE WHEN ops_orderdetail.ServiceNameEN = 'Press Only' then 1 else null end),0) AS service7,
coalesce (SUM(CASE WHEN ops_orderdetail.ServiceNameEN = 'Other' AND (ops_orderdetail.ProductID=360 OR ops_orderdetail.ProductID=361) then 1 else null end),0) AS service5,
coalesce (SUM(CASE WHEN ops_orderdetail.ServiceNameEN = 'Other' AND ops_orderdetail.ProductID=362 then 1 else null end),0) AS service6,
coalesce (SUM(CASE WHEN ops_orderdetail.ServiceNameEN = 'Dry Clean' then 1 else null end),0) +
coalesce (SUM(CASE WHEN ops_orderdetail.ServiceNameEN = 'Laundry' then 1 else null end),0) +
coalesce (SUM(CASE WHEN ops_orderdetail.ServiceNameEN = 'Spa Leathers' then 1 else null end),0) +
coalesce (SUM(CASE WHEN ops_orderdetail.ServiceNameEN = 'hand wash' then 1 else null end),0)+
coalesce (SUM(CASE WHEN ops_orderdetail.ServiceNameEN = 'Other' AND (ops_orderdetail.ProductID=360 OR ops_orderdetail.ProductID=361) then 1 else null end),0)+
coalesce (SUM(CASE WHEN ops_orderdetail.ServiceNameEN = 'Other' AND ops_orderdetail.ProductID=362 then 1 else null end),0) AS counts
from (ops_order left join ops_orderdetail on ops_order.OrderNo=ops_orderdetail.OrderNo)
left join (mas_branch left join mas_branchtype on mas_branch.BranchID=mas_branchtype.BranchTypeID)
on ops_order.BranchID=mas_branch.BranchID
where ops_order.OrderDate BETWEEN '".$date_start."' AND '".$date_end."' AND ops_order.IsActive='1'
AND mas_branch.BranchType = '".$keywords."'
group by ops_order.OrderNo
Order By ops_order.OrderNo ASC";
				}
				}
				else if($_GET['select_top']==100){
				if($_GET['keywords2']=='cheese'||$_GET['keywords']=='cheese'){
				$stmt="select ROW_NUMBER() OVER(ORDER BY ops_order.OrderNo ASC) AS Row ,mas_branch.BranchNameTH,
mas_branchtype.BranchTypeNameTH,ops_order.OrderDate,ops_order.OrderNo,
coalesce (SUM(CASE WHEN ops_orderdetail.ServiceNameEN = 'Dry Clean' then 1 else null end),0) AS service1,
coalesce (SUM(CASE WHEN ops_orderdetail.ServiceNameEN = 'Laundry' then 1 else null end),0) AS service2,
coalesce (SUM(CASE WHEN ops_orderdetail.ServiceNameEN = 'Spa Leathers' then 1 else null end),0) AS service3,
coalesce (SUM(CASE WHEN ops_orderdetail.ServiceNameEN = 'hand wash' then 1 else null end),0) AS service4,
coalesce (SUM(CASE WHEN ops_orderdetail.ServiceNameEN = 'Press Only' then 1 else null end),0) AS service7,
coalesce (SUM(CASE WHEN ops_orderdetail.ServiceNameEN = 'Other' AND (ops_orderdetail.ProductID=360 OR ops_orderdetail.ProductID=361) then 1 else null end),0) AS service5,
coalesce (SUM(CASE WHEN ops_orderdetail.ServiceNameEN = 'Other' AND ops_orderdetail.ProductID=362 then 1 else null end),0) AS service6,
coalesce (SUM(CASE WHEN ops_orderdetail.ServiceNameEN = 'Dry Clean' then 1 else null end),0) +
coalesce (SUM(CASE WHEN ops_orderdetail.ServiceNameEN = 'Laundry' then 1 else null end),0) +
coalesce (SUM(CASE WHEN ops_orderdetail.ServiceNameEN = 'Spa Leathers' then 1 else null end),0) +
coalesce (SUM(CASE WHEN ops_orderdetail.ServiceNameEN = 'hand wash' then 1 else null end),0)+
coalesce (SUM(CASE WHEN ops_orderdetail.ServiceNameEN = 'Other' AND (ops_orderdetail.ProductID=360 OR ops_orderdetail.ProductID=361) then 1 else null end),0)+
coalesce (SUM(CASE WHEN ops_orderdetail.ServiceNameEN = 'Other' AND ops_orderdetail.ProductID=362 then 1 else null end),0) AS counts,
((sum(Amount)+sum((Amount)*coalesce(ExpressRate,0))/100)+sum(coalesce(ops_orderdetail.AdditionAmount,0)))-sum(coalesce(ops_orderdetail.DiscountAmount,0)) as total from (((ops_order left join uac_customer on ops_order.CustomerID=uac_customer.CustomerID)
left join (mas_branch left join mas_branchtype on mas_branch.BranchType=mas_branchtype.BranchTypeID) ON ops_order.BranchID=mas_branch.BranchID)
left join ops_orderdetail on ops_order.OrderNo=ops_orderdetail.OrderNo)
left join mas_priceexpression on ops_order.IsExpressLevel=mas_priceexpression.IsExpressLevel
WHERE  ops_order.OrderDate BETWEEN  '".$date_start."' AND '".$date_end."' AND ops_order.IsActive='1'
Group By mas_branch.BranchNameTH,ops_order.OrderNo,mas_branchtype.BranchTypeNameTH,
ops_order.OrderDate,ops_order.NetAmount,ops_order.OrderNo
Order By ops_order.OrderNo ASC";

$stmt1="select ops_order.OrderNo,sum(PromoDiscount) as PromoDiscount,sum(ops_order.IsExpress) as counts,sum(MemberDiscount) as MemberDiscount,
sum(SpecialDiscount) as SpecialDiscount,IsPayment from (ops_order
left join (mas_branch left join mas_branchtype on mas_branch.BranchID=mas_branchtype.BranchTypeID)
on ops_order.BranchID=mas_branch.BranchID)
WHERE  ops_order.OrderDate BETWEEN  '".$date_start."' AND '".$date_end."' AND ops_order.IsActive='1'
GROUP BY ops_order.OrderNo,IsPayment
Order By ops_order.OrderNo ASC";

$stmt2="select coalesce (SUM(CASE WHEN ops_orderdetail.ServiceNameEN = 'Dry Clean' then 1 else null end),0) AS service1,
coalesce (SUM(CASE WHEN ops_orderdetail.ServiceNameEN = 'Laundry' then 1 else null end),0) AS service2,
coalesce (SUM(CASE WHEN ops_orderdetail.ServiceNameEN = 'Spa Leathers' then 1 else null end),0) AS service3,
coalesce (SUM(CASE WHEN ops_orderdetail.ServiceNameEN = 'hand wash' then 1 else null end),0) AS service4,
coalesce (SUM(CASE WHEN ops_orderdetail.ServiceNameEN = 'Press Only' then 1 else null end),0) AS service7,
coalesce (SUM(CASE WHEN ops_orderdetail.ServiceNameEN = 'Other' AND (ops_orderdetail.ProductID=360 OR ops_orderdetail.ProductID=361) then 1 else null end),0) AS service5,
coalesce (SUM(CASE WHEN ops_orderdetail.ServiceNameEN = 'Other' AND ops_orderdetail.ProductID=362 then 1 else null end),0) AS service6,
coalesce (SUM(CASE WHEN ops_orderdetail.ServiceNameEN = 'Dry Clean' then 1 else null end),0) +
coalesce (SUM(CASE WHEN ops_orderdetail.ServiceNameEN = 'Laundry' then 1 else null end),0) +
coalesce (SUM(CASE WHEN ops_orderdetail.ServiceNameEN = 'Spa Leathers' then 1 else null end),0) +
coalesce (SUM(CASE WHEN ops_orderdetail.ServiceNameEN = 'hand wash' then 1 else null end),0)+
coalesce (SUM(CASE WHEN ops_orderdetail.ServiceNameEN = 'Other' AND (ops_orderdetail.ProductID=360 OR ops_orderdetail.ProductID=361) then 1 else null end),0)+
coalesce (SUM(CASE WHEN ops_orderdetail.ServiceNameEN = 'Other' AND ops_orderdetail.ProductID=362 then 1 else null end),0) AS counts
from (ops_order left join ops_orderdetail on ops_order.OrderNo=ops_orderdetail.OrderNo)
left join (mas_branch left join mas_branchtype on mas_branch.BranchID=mas_branchtype.BranchTypeID)
on ops_order.BranchID=mas_branch.BranchID
where ops_order.OrderDate BETWEEN '".$date_start."' AND '".$date_end."' AND ops_order.IsActive='1'
group by ops_order.OrderNo
Order By ops_order.OrderNo ASC";
				}else if($_GET['keywords2']!='cheese'&&$_GET['keywords']=='cheese'){
						$stmt="select ROW_NUMBER() OVER(ORDER BY ops_order.OrderNo ASC) AS Row ,mas_branch.BranchNameTH,
mas_branchtype.BranchTypeNameTH,ops_order.OrderDate,ops_order.OrderNo,
coalesce (SUM(CASE WHEN ops_orderdetail.ServiceNameEN = 'Dry Clean' then 1 else null end),0) AS service1,
coalesce (SUM(CASE WHEN ops_orderdetail.ServiceNameEN = 'Laundry' then 1 else null end),0) AS service2,
coalesce (SUM(CASE WHEN ops_orderdetail.ServiceNameEN = 'Spa Leathers' then 1 else null end),0) AS service3,
coalesce (SUM(CASE WHEN ops_orderdetail.ServiceNameEN = 'hand wash' then 1 else null end),0) AS service4,
coalesce (SUM(CASE WHEN ops_orderdetail.ServiceNameEN = 'Press Only' then 1 else null end),0) AS service7,
coalesce (SUM(CASE WHEN ops_orderdetail.ServiceNameEN = 'Other' AND (ops_orderdetail.ProductID=360 OR ops_orderdetail.ProductID=361) then 1 else null end),0) AS service5,
coalesce (SUM(CASE WHEN ops_orderdetail.ServiceNameEN = 'Other' AND ops_orderdetail.ProductID=362 then 1 else null end),0) AS service6,
coalesce (SUM(CASE WHEN ops_orderdetail.ServiceNameEN = 'Dry Clean' then 1 else null end),0) +
coalesce (SUM(CASE WHEN ops_orderdetail.ServiceNameEN = 'Laundry' then 1 else null end),0) +
coalesce (SUM(CASE WHEN ops_orderdetail.ServiceNameEN = 'Spa Leathers' then 1 else null end),0) +
coalesce (SUM(CASE WHEN ops_orderdetail.ServiceNameEN = 'hand wash' then 1 else null end),0)+
coalesce (SUM(CASE WHEN ops_orderdetail.ServiceNameEN = 'Other' AND (ops_orderdetail.ProductID=360 OR ops_orderdetail.ProductID=361) then 1 else null end),0)+
coalesce (SUM(CASE WHEN ops_orderdetail.ServiceNameEN = 'Other' AND ops_orderdetail.ProductID=362 then 1 else null end),0) AS counts,
((sum(Amount)+sum((Amount)*coalesce(ExpressRate,0))/100)+sum(coalesce(ops_orderdetail.AdditionAmount,0)))-sum(coalesce(ops_orderdetail.DiscountAmount,0)) as total from (((ops_order left join uac_customer on ops_order.CustomerID=uac_customer.CustomerID)
left join (mas_branch left join mas_branchtype on mas_branch.BranchType=mas_branchtype.BranchTypeID) ON ops_order.BranchID=mas_branch.BranchID)
left join ops_orderdetail on ops_order.OrderNo=ops_orderdetail.OrderNo)
left join mas_priceexpression on ops_order.IsExpressLevel=mas_priceexpression.IsExpressLevel
WHERE  ops_order.OrderDate BETWEEN  '".$date_start."' AND '".$date_end."' AND ops_order.IsActive='1'
AND mas_branch.BranchID='".$keywords2."'
Group By mas_branch.BranchNameTH,ops_order.OrderNo,mas_branchtype.BranchTypeNameTH,
ops_order.OrderDate,ops_order.NetAmount,ops_order.OrderNo
Order By ops_order.OrderNo ASC";

$stmt1="select ops_order.OrderNo,sum(PromoDiscount) as PromoDiscount,sum(ops_order.IsExpress) as counts,sum(MemberDiscount) as MemberDiscount,
sum(SpecialDiscount) as SpecialDiscount,IsPayment from (ops_order
left join (mas_branch left join mas_branchtype on mas_branch.BranchID=mas_branchtype.BranchTypeID)
on ops_order.BranchID=mas_branch.BranchID)
WHERE  ops_order.OrderDate BETWEEN  '".$date_start."' AND '".$date_end."' AND ops_order.IsActive='1'
AND mas_branch.BranchID='".$keywords2."'
GROUP BY ops_order.OrderNo,IsPayment
Order By ops_order.OrderNo ASC";

$stmt2="select coalesce (SUM(CASE WHEN ops_orderdetail.ServiceNameEN = 'Dry Clean' then 1 else null end),0) AS service1,
coalesce (SUM(CASE WHEN ops_orderdetail.ServiceNameEN = 'Laundry' then 1 else null end),0) AS service2,
coalesce (SUM(CASE WHEN ops_orderdetail.ServiceNameEN = 'Spa Leathers' then 1 else null end),0) AS service3,
coalesce (SUM(CASE WHEN ops_orderdetail.ServiceNameEN = 'hand wash' then 1 else null end),0) AS service4,
coalesce (SUM(CASE WHEN ops_orderdetail.ServiceNameEN = 'Press Only' then 1 else null end),0) AS service7,
coalesce (SUM(CASE WHEN ops_orderdetail.ServiceNameEN = 'Other' AND (ops_orderdetail.ProductID=360 OR ops_orderdetail.ProductID=361) then 1 else null end),0) AS service5,
coalesce (SUM(CASE WHEN ops_orderdetail.ServiceNameEN = 'Other' AND ops_orderdetail.ProductID=362 then 1 else null end),0) AS service6,
coalesce (SUM(CASE WHEN ops_orderdetail.ServiceNameEN = 'Dry Clean' then 1 else null end),0) +
coalesce (SUM(CASE WHEN ops_orderdetail.ServiceNameEN = 'Laundry' then 1 else null end),0) +
coalesce (SUM(CASE WHEN ops_orderdetail.ServiceNameEN = 'Spa Leathers' then 1 else null end),0) +
coalesce (SUM(CASE WHEN ops_orderdetail.ServiceNameEN = 'hand wash' then 1 else null end),0)+
coalesce (SUM(CASE WHEN ops_orderdetail.ServiceNameEN = 'Other' AND (ops_orderdetail.ProductID=360 OR ops_orderdetail.ProductID=361) then 1 else null end),0)+
coalesce (SUM(CASE WHEN ops_orderdetail.ServiceNameEN = 'Other' AND ops_orderdetail.ProductID=362 then 1 else null end),0) AS counts
from (ops_order left join ops_orderdetail on ops_order.OrderNo=ops_orderdetail.OrderNo)
left join (mas_branch left join mas_branchtype on mas_branch.BranchID=mas_branchtype.BranchTypeID)
on ops_order.BranchID=mas_branch.BranchID
where ops_order.OrderDate BETWEEN '".$date_start."' AND '".$date_end."' AND ops_order.IsActive='1'
AND mas_branch.BranchID='".$keywords2."'
group by ops_order.OrderNo
Order By ops_order.OrderNo ASC";
						}
						else{
					$stmt="select ROW_NUMBER() OVER(ORDER BY ops_order.OrderNo ASC) AS Row ,mas_branch.BranchNameTH,
mas_branchtype.BranchTypeNameTH,ops_order.OrderDate,ops_order.OrderNo,
coalesce (SUM(CASE WHEN ops_orderdetail.ServiceNameEN = 'Dry Clean' then 1 else null end),0) AS service1,
coalesce (SUM(CASE WHEN ops_orderdetail.ServiceNameEN = 'Laundry' then 1 else null end),0) AS service2,
coalesce (SUM(CASE WHEN ops_orderdetail.ServiceNameEN = 'Spa Leathers' then 1 else null end),0) AS service3,
coalesce (SUM(CASE WHEN ops_orderdetail.ServiceNameEN = 'hand wash' then 1 else null end),0) AS service4,
coalesce (SUM(CASE WHEN ops_orderdetail.ServiceNameEN = 'Other' AND (ops_orderdetail.ProductID=360 OR ops_orderdetail.ProductID=361) then 1 else null end),0) AS service5,
coalesce (SUM(CASE WHEN ops_orderdetail.ServiceNameEN = 'Other' AND ops_orderdetail.ProductID=362 then 1 else null end),0) AS service6,
coalesce (SUM(CASE WHEN ops_orderdetail.ServiceNameEN = 'Dry Clean' then 1 else null end),0) +
coalesce (SUM(CASE WHEN ops_orderdetail.ServiceNameEN = 'Laundry' then 1 else null end),0) +
coalesce (SUM(CASE WHEN ops_orderdetail.ServiceNameEN = 'Spa Leathers' then 1 else null end),0) +
coalesce (SUM(CASE WHEN ops_orderdetail.ServiceNameEN = 'hand wash' then 1 else null end),0)+
coalesce (SUM(CASE WHEN ops_orderdetail.ServiceNameEN = 'Other' AND (ops_orderdetail.ProductID=360 OR ops_orderdetail.ProductID=361) then 1 else null end),0)+
coalesce (SUM(CASE WHEN ops_orderdetail.ServiceNameEN = 'Other' AND ops_orderdetail.ProductID=362 then 1 else null end),0) AS counts,
((sum(Amount)+sum((Amount)*coalesce(ExpressRate,0))/100)+sum(coalesce(ops_orderdetail.AdditionAmount,0)))-sum(coalesce(ops_orderdetail.DiscountAmount,0)) as total from (((ops_order left join uac_customer on ops_order.CustomerID=uac_customer.CustomerID)
left join (mas_branch left join mas_branchtype on mas_branch.BranchType=mas_branchtype.BranchTypeID) ON ops_order.BranchID=mas_branch.BranchID)
left join ops_orderdetail on ops_order.OrderNo=ops_orderdetail.OrderNo)
left join mas_priceexpression on ops_order.IsExpressLevel=mas_priceexpression.IsExpressLevel
WHERE  ops_order.OrderDate BETWEEN  '".$date_start."' AND '".$date_end."' AND ops_order.IsActive='1'
AND mas_branch.BranchType = '".$keywords."'
Group By mas_branch.BranchNameTH,ops_order.OrderNo,mas_branchtype.BranchTypeNameTH,
ops_order.OrderDate,ops_order.NetAmount,ops_order.OrderNo
Order By ops_order.OrderNo ASC";

$stmt1="select ops_order.OrderNo,sum(PromoDiscount) as PromoDiscount,sum(ops_order.IsExpress) as counts,sum(MemberDiscount) as MemberDiscount,
sum(SpecialDiscount) as SpecialDiscount,IsPayment from (ops_order
left join (mas_branch left join mas_branchtype on mas_branch.BranchID=mas_branchtype.BranchTypeID)
on ops_order.BranchID=mas_branch.BranchID)
WHERE  ops_order.OrderDate BETWEEN  '".$date_start."' AND '".$date_end."' AND ops_order.IsActive='1'
AND mas_branch.BranchType = '".$keywords."'
GROUP BY ops_order.OrderNo,IsPayment
Order By ops_order.OrderNo ASC";

$stmt2="select coalesce (SUM(CASE WHEN ops_orderdetail.ServiceNameEN = 'Dry Clean' then 1 else null end),0) AS service1,
coalesce (SUM(CASE WHEN ops_orderdetail.ServiceNameEN = 'Laundry' then 1 else null end),0) AS service2,
coalesce (SUM(CASE WHEN ops_orderdetail.ServiceNameEN = 'Spa Leathers' then 1 else null end),0) AS service3,
coalesce (SUM(CASE WHEN ops_orderdetail.ServiceNameEN = 'hand wash' then 1 else null end),0) AS service4,
coalesce (SUM(CASE WHEN ops_orderdetail.ServiceNameEN = 'Press Only' then 1 else null end),0) AS service7,
coalesce (SUM(CASE WHEN ops_orderdetail.ServiceNameEN = 'Other' AND (ops_orderdetail.ProductID=360 OR ops_orderdetail.ProductID=361) then 1 else null end),0) AS service5,
coalesce (SUM(CASE WHEN ops_orderdetail.ServiceNameEN = 'Other' AND ops_orderdetail.ProductID=362 then 1 else null end),0) AS service6,
coalesce (SUM(CASE WHEN ops_orderdetail.ServiceNameEN = 'Dry Clean' then 1 else null end),0) +
coalesce (SUM(CASE WHEN ops_orderdetail.ServiceNameEN = 'Laundry' then 1 else null end),0) +
coalesce (SUM(CASE WHEN ops_orderdetail.ServiceNameEN = 'Spa Leathers' then 1 else null end),0) +
coalesce (SUM(CASE WHEN ops_orderdetail.ServiceNameEN = 'hand wash' then 1 else null end),0)+
coalesce (SUM(CASE WHEN ops_orderdetail.ServiceNameEN = 'Other' AND (ops_orderdetail.ProductID=360 OR ops_orderdetail.ProductID=361) then 1 else null end),0)+
coalesce (SUM(CASE WHEN ops_orderdetail.ServiceNameEN = 'Other' AND ops_orderdetail.ProductID=362 then 1 else null end),0) AS counts
from (ops_order left join ops_orderdetail on ops_order.OrderNo=ops_orderdetail.OrderNo)
left join (mas_branch left join mas_branchtype on mas_branch.BranchID=mas_branchtype.BranchTypeID)
on ops_order.BranchID=mas_branch.BranchID
where ops_order.OrderDate BETWEEN '".$date_start."' AND '".$date_end."' AND ops_order.IsActive='1'
AND mas_branch.BranchType = '".$keywords."'
group by ops_order.OrderNo
Order By ops_order.OrderNo ASC";
				}
				}
				else{
				if($_GET['keywords2']=='cheese'&&$_GET['keywords']=='cheese'){
$stmt="select distinct ROW_NUMBER() OVER(ORDER BY ops_order.OrderNo ASC) AS Row ,mas_branch.BranchNameTH,
mas_branchtype.BranchTypeNameTH,ops_order.OrderDate,ops_order.OrderNo,
coalesce (SUM(CASE WHEN ops_orderdetail.ServiceNameEN = 'Dry Clean' then 1 else null end),0) AS service1,
coalesce (SUM(CASE WHEN ops_orderdetail.ServiceNameEN = 'Laundry' then 1 else null end),0) AS service2,
coalesce (SUM(CASE WHEN ops_orderdetail.ServiceNameEN = 'Spa Leathers' then 1 else null end),0) AS service3,
coalesce (SUM(CASE WHEN ops_orderdetail.ServiceNameEN = 'hand wash' then 1 else null end),0) AS service4,
coalesce (SUM(CASE WHEN ops_orderdetail.ServiceNameEN = 'Press Only' then 1 else null end),0) AS service7,
coalesce (SUM(CASE WHEN ops_orderdetail.ServiceNameEN = 'Other' AND (ops_orderdetail.ProductID=360 OR ops_orderdetail.ProductID=361) then 1 else null end),0) AS service5,
coalesce (SUM(CASE WHEN ops_orderdetail.ServiceNameEN = 'Other' AND ops_orderdetail.ProductID=362 then 1 else null end),0) AS service6,
coalesce (SUM(CASE WHEN ops_orderdetail.ServiceNameEN = 'Dry Clean' then 1 else null end),0) +
coalesce (SUM(CASE WHEN ops_orderdetail.ServiceNameEN = 'Laundry' then 1 else null end),0) +
coalesce (SUM(CASE WHEN ops_orderdetail.ServiceNameEN = 'Spa Leathers' then 1 else null end),0) +
coalesce (SUM(CASE WHEN ops_orderdetail.ServiceNameEN = 'hand wash' then 1 else null end),0)+
coalesce (SUM(CASE WHEN ops_orderdetail.ServiceNameEN = 'Other' AND (ops_orderdetail.ProductID=360 OR ops_orderdetail.ProductID=361) then 1 else null end),0)+
coalesce (SUM(CASE WHEN ops_orderdetail.ServiceNameEN = 'Other' AND ops_orderdetail.ProductID=362 then 1 else null end),0) AS counts,
((sum(Amount)+sum((Amount)*coalesce(ExpressRate,0))/100)+sum(coalesce(ops_orderdetail.AdditionAmount,0)))-sum(coalesce(ops_orderdetail.DiscountAmount,0)) as total from (((ops_order left join uac_customer on ops_order.CustomerID=uac_customer.CustomerID)
left join (mas_branch left join mas_branchtype on mas_branch.BranchType=mas_branchtype.BranchTypeID) ON ops_order.BranchID=mas_branch.BranchID)
left join ops_orderdetail on ops_order.OrderNo=ops_orderdetail.OrderNo)
left join mas_priceexpression on ops_order.IsExpressLevel=mas_priceexpression.IsExpressLevel
WHERE  ops_order.OrderDate BETWEEN  '".$date_start."' AND '".$date_end."' AND ops_order.IsActive='1'
Group By mas_branch.BranchNameTH,ops_order.OrderNo,mas_branchtype.BranchTypeNameTH,
ops_order.OrderDate,ops_order.NetAmount,ops_order.OrderNo
Order By ops_order.OrderNo ASC";

$stmt1="select ops_order.OrderNo,sum(PromoDiscount) as PromoDiscount,sum(ops_order.IsExpress) as counts,sum(MemberDiscount) as MemberDiscount,
 sum(SpecialDiscount) as SpecialDiscount,IsPayment from (ops_order
left join (mas_branch left join mas_branchtype on mas_branch.BranchID=mas_branchtype.BranchTypeID)
on ops_order.BranchID=mas_branch.BranchID)
WHERE  ops_order.OrderDate BETWEEN  '".$date_start."' AND '".$date_end."' AND ops_order.IsActive='1'
GROUP BY ops_order.OrderNo,IsPayment
Order By ops_order.OrderNo ASC";

$stmt2="select coalesce (SUM(CASE WHEN ops_orderdetail.ServiceNameEN = 'Dry Clean' then 1 else null end),0) AS service1,
coalesce (SUM(CASE WHEN ops_orderdetail.ServiceNameEN = 'Laundry' then 1 else null end),0) AS service2,
coalesce (SUM(CASE WHEN ops_orderdetail.ServiceNameEN = 'Spa Leathers' then 1 else null end),0) AS service3,
coalesce (SUM(CASE WHEN ops_orderdetail.ServiceNameEN = 'hand wash' then 1 else null end),0) AS service4,
coalesce (SUM(CASE WHEN ops_orderdetail.ServiceNameEN = 'Press Only' then 1 else null end),0) AS service7,
coalesce (SUM(CASE WHEN ops_orderdetail.ServiceNameEN = 'Other' AND (ops_orderdetail.ProductID=360 OR ops_orderdetail.ProductID=361) then 1 else null end),0) AS service5,
coalesce (SUM(CASE WHEN ops_orderdetail.ServiceNameEN = 'Other' AND ops_orderdetail.ProductID=362 then 1 else null end),0) AS service6,
coalesce (SUM(CASE WHEN ops_orderdetail.ServiceNameEN = 'Dry Clean' then 1 else null end),0) +
coalesce (SUM(CASE WHEN ops_orderdetail.ServiceNameEN = 'Laundry' then 1 else null end),0) +
coalesce (SUM(CASE WHEN ops_orderdetail.ServiceNameEN = 'Spa Leathers' then 1 else null end),0) +
coalesce (SUM(CASE WHEN ops_orderdetail.ServiceNameEN = 'hand wash' then 1 else null end),0)+
coalesce (SUM(CASE WHEN ops_orderdetail.ServiceNameEN = 'Other' AND (ops_orderdetail.ProductID=360 OR ops_orderdetail.ProductID=361) then 1 else null end),0)+
coalesce (SUM(CASE WHEN ops_orderdetail.ServiceNameEN = 'Other' AND ops_orderdetail.ProductID=362 then 1 else null end),0) AS counts
from (ops_order left join ops_orderdetail on ops_order.OrderNo=ops_orderdetail.OrderNo)
left join (mas_branch left join mas_branchtype on mas_branch.BranchID=mas_branchtype.BranchTypeID)
on ops_order.BranchID=mas_branch.BranchID
where ops_order.OrderDate BETWEEN '".$date_start."' AND '".$date_end."' AND ops_order.IsActive='1'
group by ops_order.OrderNo
Order By ops_order.OrderNo ASC";
						}else if($_GET['keywords2']!='cheese'&&$_GET['keywords']=='cheese'){
						$stmt="select ROW_NUMBER() OVER(ORDER BY ops_order.OrderNo ASC) AS Row ,mas_branch.BranchNameTH,
mas_branchtype.BranchTypeNameTH,ops_order.OrderDate,ops_order.OrderNo,
coalesce (SUM(CASE WHEN ops_orderdetail.ServiceNameEN = 'Dry Clean' then 1 else null end),0) AS service1,
coalesce (SUM(CASE WHEN ops_orderdetail.ServiceNameEN = 'Laundry' then 1 else null end),0) AS service2,
coalesce (SUM(CASE WHEN ops_orderdetail.ServiceNameEN = 'Spa Leathers' then 1 else null end),0) AS service3,
coalesce (SUM(CASE WHEN ops_orderdetail.ServiceNameEN = 'hand wash' then 1 else null end),0) AS service4,
coalesce (SUM(CASE WHEN ops_orderdetail.ServiceNameEN = 'Press Only' then 1 else null end),0) AS service7,
coalesce (SUM(CASE WHEN ops_orderdetail.ServiceNameEN = 'Other' AND (ops_orderdetail.ProductID=360 OR ops_orderdetail.ProductID=361) then 1 else null end),0) AS service5,
coalesce (SUM(CASE WHEN ops_orderdetail.ServiceNameEN = 'Other' AND ops_orderdetail.ProductID=362 then 1 else null end),0) AS service6,
coalesce (SUM(CASE WHEN ops_orderdetail.ServiceNameEN = 'Dry Clean' then 1 else null end),0) +
coalesce (SUM(CASE WHEN ops_orderdetail.ServiceNameEN = 'Laundry' then 1 else null end),0) +
coalesce (SUM(CASE WHEN ops_orderdetail.ServiceNameEN = 'Spa Leathers' then 1 else null end),0) +
coalesce (SUM(CASE WHEN ops_orderdetail.ServiceNameEN = 'hand wash' then 1 else null end),0)+
coalesce (SUM(CASE WHEN ops_orderdetail.ServiceNameEN = 'Other' AND (ops_orderdetail.ProductID=360 OR ops_orderdetail.ProductID=361) then 1 else null end),0)+
coalesce (SUM(CASE WHEN ops_orderdetail.ServiceNameEN = 'Other' AND ops_orderdetail.ProductID=362 then 1 else null end),0) AS counts,
((sum(Amount)+sum((Amount)*coalesce(ExpressRate,0))/100)+sum(coalesce(ops_orderdetail.AdditionAmount,0)))-sum(coalesce(ops_orderdetail.DiscountAmount,0)) as total from (((ops_order left join uac_customer on ops_order.CustomerID=uac_customer.CustomerID)
left join (mas_branch left join mas_branchtype on mas_branch.BranchType=mas_branchtype.BranchTypeID) ON ops_order.BranchID=mas_branch.BranchID)
left join ops_orderdetail on ops_order.OrderNo=ops_orderdetail.OrderNo)
left join mas_priceexpression on ops_order.IsExpressLevel=mas_priceexpression.IsExpressLevel
WHERE  ops_order.OrderDate BETWEEN  '".$date_start."' AND '".$date_end."' AND ops_order.IsActive='1'
AND mas_branch.BranchID='".$keywords2."'
Group By mas_branch.BranchNameTH,ops_order.OrderNo,mas_branchtype.BranchTypeNameTH,
ops_order.OrderDate,ops_order.NetAmount,ops_order.OrderNo
Order By ops_order.OrderNo ASC";

$stmt1="select ops_order.OrderNo,sum(PromoDiscount) as PromoDiscount,sum(ops_order.IsExpress) as counts,sum(MemberDiscount) as MemberDiscount,
sum(SpecialDiscount) as SpecialDiscount,IsPayment from (ops_order
left join (mas_branch left join mas_branchtype on mas_branch.BranchID=mas_branchtype.BranchTypeID)
on ops_order.BranchID=mas_branch.BranchID)
WHERE  ops_order.OrderDate BETWEEN  '".$date_start."' AND '".$date_end."' AND ops_order.IsActive='1'
AND mas_branch.BranchID='".$keywords2."'
GROUP BY ops_order.OrderNo,IsPayment
Order By ops_order.OrderNo ASC";

$stmt2="select coalesce (SUM(CASE WHEN ops_orderdetail.ServiceNameEN = 'Dry Clean' then 1 else null end),0) AS service1,
coalesce (SUM(CASE WHEN ops_orderdetail.ServiceNameEN = 'Laundry' then 1 else null end),0) AS service2,
coalesce (SUM(CASE WHEN ops_orderdetail.ServiceNameEN = 'Spa Leathers' then 1 else null end),0) AS service3,
coalesce (SUM(CASE WHEN ops_orderdetail.ServiceNameEN = 'hand wash' then 1 else null end),0) AS service4,
coalesce (SUM(CASE WHEN ops_orderdetail.ServiceNameEN = 'Press Only' then 1 else null end),0) AS service7,
coalesce (SUM(CASE WHEN ops_orderdetail.ServiceNameEN = 'Other' AND (ops_orderdetail.ProductID=360 OR ops_orderdetail.ProductID=361) then 1 else null end),0) AS service5,
coalesce (SUM(CASE WHEN ops_orderdetail.ServiceNameEN = 'Other' AND ops_orderdetail.ProductID=362 then 1 else null end),0) AS service6,
coalesce (SUM(CASE WHEN ops_orderdetail.ServiceNameEN = 'Dry Clean' then 1 else null end),0) +
coalesce (SUM(CASE WHEN ops_orderdetail.ServiceNameEN = 'Laundry' then 1 else null end),0) +
coalesce (SUM(CASE WHEN ops_orderdetail.ServiceNameEN = 'Spa Leathers' then 1 else null end),0) +
coalesce (SUM(CASE WHEN ops_orderdetail.ServiceNameEN = 'hand wash' then 1 else null end),0)+
coalesce (SUM(CASE WHEN ops_orderdetail.ServiceNameEN = 'Other' AND (ops_orderdetail.ProductID=360 OR ops_orderdetail.ProductID=361) then 1 else null end),0)+
coalesce (SUM(CASE WHEN ops_orderdetail.ServiceNameEN = 'Other' AND ops_orderdetail.ProductID=362 then 1 else null end),0) AS counts
from (ops_order left join ops_orderdetail on ops_order.OrderNo=ops_orderdetail.OrderNo)
left join (mas_branch left join mas_branchtype on mas_branch.BranchID=mas_branchtype.BranchTypeID)
on ops_order.BranchID=mas_branch.BranchID
where ops_order.OrderDate BETWEEN '".$date_start."' AND '".$date_end."' AND ops_order.IsActive='1'
AND mas_branch.BranchID='".$keywords2."'
group by ops_order.OrderNo
Order By ops_order.OrderNo ASC";
						}
						else{
					$stmt="select ROW_NUMBER() OVER(ORDER BY ops_order.OrderNo ASC) AS Row ,mas_branch.BranchNameTH,
mas_branchtype.BranchTypeNameTH,ops_order.OrderDate,ops_order.OrderNo,
coalesce (SUM(CASE WHEN ops_orderdetail.ServiceNameEN = 'Dry Clean' then 1 else null end),0) AS service1,
coalesce (SUM(CASE WHEN ops_orderdetail.ServiceNameEN = 'Laundry' then 1 else null end),0) AS service2,
coalesce (SUM(CASE WHEN ops_orderdetail.ServiceNameEN = 'Spa Leathers' then 1 else null end),0) AS service3,
coalesce (SUM(CASE WHEN ops_orderdetail.ServiceNameEN = 'hand wash' then 1 else null end),0) AS service4,
coalesce (SUM(CASE WHEN ops_orderdetail.ServiceNameEN = 'Press Only' then 1 else null end),0) AS service7,
coalesce (SUM(CASE WHEN ops_orderdetail.ServiceNameEN = 'Other' AND (ops_orderdetail.ProductID=360 OR ops_orderdetail.ProductID=361) then 1 else null end),0) AS service5,
coalesce (SUM(CASE WHEN ops_orderdetail.ServiceNameEN = 'Other' AND ops_orderdetail.ProductID=362 then 1 else null end),0) AS service6,
coalesce (SUM(CASE WHEN ops_orderdetail.ServiceNameEN = 'Dry Clean' then 1 else null end),0) +
coalesce (SUM(CASE WHEN ops_orderdetail.ServiceNameEN = 'Laundry' then 1 else null end),0) +
coalesce (SUM(CASE WHEN ops_orderdetail.ServiceNameEN = 'Spa Leathers' then 1 else null end),0) +
coalesce (SUM(CASE WHEN ops_orderdetail.ServiceNameEN = 'hand wash' then 1 else null end),0)+
coalesce (SUM(CASE WHEN ops_orderdetail.ServiceNameEN = 'Other' AND (ops_orderdetail.ProductID=360 OR ops_orderdetail.ProductID=361) then 1 else null end),0)+
coalesce (SUM(CASE WHEN ops_orderdetail.ServiceNameEN = 'Other' AND ops_orderdetail.ProductID=362 then 1 else null end),0) AS counts,
((sum(Amount)+sum((Amount)*coalesce(ExpressRate,0))/100)+sum(coalesce(ops_orderdetail.AdditionAmount,0)))-sum(coalesce(ops_orderdetail.DiscountAmount,0)) as total from (((ops_order left join uac_customer on ops_order.CustomerID=uac_customer.CustomerID)
left join (mas_branch left join mas_branchtype on mas_branch.BranchType=mas_branchtype.BranchTypeID) ON ops_order.BranchID=mas_branch.BranchID)
left join ops_orderdetail on ops_order.OrderNo=ops_orderdetail.OrderNo)
left join mas_priceexpression on ops_order.IsExpressLevel=mas_priceexpression.IsExpressLevel
WHERE  ops_order.OrderDate BETWEEN  '".$date_start."' AND '".$date_end."' AND ops_order.IsActive='1'
AND mas_branch.BranchType = '".$keywords."'
Group By mas_branch.BranchNameTH,ops_order.OrderNo,mas_branchtype.BranchTypeNameTH,
ops_order.OrderDate,ops_order.NetAmount,ops_order.OrderNo
Order By ops_order.OrderNo ASC";

$stmt1="select ops_order.OrderNo,sum(PromoDiscount) as PromoDiscount,sum(ops_order.IsExpress) as counts,sum(MemberDiscount) as MemberDiscount,
 sum(SpecialDiscount) as SpecialDiscount,IsPayment from (ops_order
left join (mas_branch left join mas_branchtype on mas_branch.BranchID=mas_branchtype.BranchTypeID)
on ops_order.BranchID=mas_branch.BranchID)
WHERE  ops_order.OrderDate BETWEEN  '".$date_start."' AND '".$date_end."' AND ops_order.IsActive='1'
AND mas_branch.BranchType = '".$keywords."'
GROUP BY ops_order.OrderNo,IsPayment
Order By ops_order.OrderNo ASC";

$stmt2="select coalesce (SUM(CASE WHEN ops_orderdetail.ServiceNameEN = 'Dry Clean' then 1 else null end),0) AS service1,
coalesce (SUM(CASE WHEN ops_orderdetail.ServiceNameEN = 'Laundry' then 1 else null end),0) AS service2,
coalesce (SUM(CASE WHEN ops_orderdetail.ServiceNameEN = 'Spa Leathers' then 1 else null end),0) AS service3,
coalesce (SUM(CASE WHEN ops_orderdetail.ServiceNameEN = 'hand wash' then 1 else null end),0) AS service4,
coalesce (SUM(CASE WHEN ops_orderdetail.ServiceNameEN = 'Press Only' then 1 else null end),0) AS service7,
coalesce (SUM(CASE WHEN ops_orderdetail.ServiceNameEN = 'Other' AND (ops_orderdetail.ProductID=360 OR ops_orderdetail.ProductID=361) then 1 else null end),0) AS service5,
coalesce (SUM(CASE WHEN ops_orderdetail.ServiceNameEN = 'Other' AND ops_orderdetail.ProductID=362 then 1 else null end),0) AS service6,
coalesce (SUM(CASE WHEN ops_orderdetail.ServiceNameEN = 'Dry Clean' then 1 else null end),0) +
coalesce (SUM(CASE WHEN ops_orderdetail.ServiceNameEN = 'Laundry' then 1 else null end),0) +
coalesce (SUM(CASE WHEN ops_orderdetail.ServiceNameEN = 'Spa Leathers' then 1 else null end),0) +
coalesce (SUM(CASE WHEN ops_orderdetail.ServiceNameEN = 'hand wash' then 1 else null end),0)+
coalesce (SUM(CASE WHEN ops_orderdetail.ServiceNameEN = 'Other' AND (ops_orderdetail.ProductID=360 OR ops_orderdetail.ProductID=361) then 1 else null end),0)+
coalesce (SUM(CASE WHEN ops_orderdetail.ServiceNameEN = 'Other' AND ops_orderdetail.ProductID=362 then 1 else null end),0) AS counts
from (ops_order left join ops_orderdetail on ops_order.OrderNo=ops_orderdetail.OrderNo)
left join (mas_branch left join mas_branchtype on mas_branch.BranchID=mas_branchtype.BranchTypeID)
on ops_order.BranchID=mas_branch.BranchID
where ops_order.OrderDate BETWEEN '".$date_start."' AND '".$date_end."' AND ops_order.IsActive='1'
AND mas_branch.BranchType = '".$keywords."'
group by ops_order.OrderNo
Order By ops_order.OrderNo ASC";
				}
				}

				//branch
				}else{
					if($_GET['select_top']==10){
						if($_GET['keywords2']=='cheese'&&$_GET['keywords']=='cheese'){
				$stmt="select top 10 ROW_NUMBER() OVER(ORDER BY ops_order.OrderNo ASC) AS Row ,mas_branch.BranchNameTH,
mas_branchtype.BranchTypeNameTH,ops_order.OrderDate,ops_order.OrderNo,
coalesce (SUM(CASE WHEN ops_orderdetail.ServiceNameEN = 'Dry Clean' then 1 else null end),0) AS service1,
coalesce (SUM(CASE WHEN ops_orderdetail.ServiceNameEN = 'Laundry' then 1 else null end),0) AS service2,
coalesce (SUM(CASE WHEN ops_orderdetail.ServiceNameEN = 'Spa Leathers' then 1 else null end),0) AS service3,
coalesce (SUM(CASE WHEN ops_orderdetail.ServiceNameEN = 'hand wash' then 1 else null end),0) AS service4,
coalesce (SUM(CASE WHEN ops_orderdetail.ServiceNameEN = 'Press Only' then 1 else null end),0) AS service7,
coalesce (SUM(CASE WHEN ops_orderdetail.ServiceNameEN = 'Other' AND (ops_orderdetail.ProductID=360 OR ops_orderdetail.ProductID=361) then 1 else null end),0) AS service5,
coalesce (SUM(CASE WHEN ops_orderdetail.ServiceNameEN = 'Other' AND ops_orderdetail.ProductID=362 then 1 else null end),0) AS service6,
coalesce (SUM(CASE WHEN ops_orderdetail.ServiceNameEN = 'Dry Clean' then 1 else null end),0) +
coalesce (SUM(CASE WHEN ops_orderdetail.ServiceNameEN = 'Laundry' then 1 else null end),0) +
coalesce (SUM(CASE WHEN ops_orderdetail.ServiceNameEN = 'Spa Leathers' then 1 else null end),0) +
coalesce (SUM(CASE WHEN ops_orderdetail.ServiceNameEN = 'hand wash' then 1 else null end),0) AS counts,
((sum(Amount)+sum((Amount)*coalesce(ExpressRate,0))/100)+sum(coalesce(ops_orderdetail.AdditionAmount,0)))-sum(coalesce(ops_orderdetail.DiscountAmount,0)) as total from (((ops_order left join uac_customer on ops_order.CustomerID=uac_customer.CustomerID)
left join (mas_branch left join mas_branchtype on mas_branch.BranchType=mas_branchtype.BranchTypeID) ON ops_order.BranchID=mas_branch.BranchID)
left join ops_orderdetail on ops_order.OrderNo=ops_orderdetail.OrderNo)
left join mas_priceexpression on ops_order.IsExpressLevel=mas_priceexpression.IsExpressLevel
WHERE  ops_order.OrderDate BETWEEN  '".$date_start."' AND '".$date_end."' AND ops_order.IsActive='1'
AND mas_branch.BranchID='".$session."'
Group By mas_branch.BranchNameTH,ops_order.OrderNo,mas_branchtype.BranchTypeNameTH,
ops_order.OrderDate,ops_order.NetAmount,ops_order.OrderNo
Order By ops_order.OrderNo ASC";

$stmt1="select top 10 ops_order.OrderNo,sum(PromoDiscount) as PromoDiscount,sum(ops_order.IsExpress) as counts,IsPayment from (ops_order
left join (mas_branch left join mas_branchtype on mas_branch.BranchID=mas_branchtype.BranchTypeID)
on ops_order.BranchID=mas_branch.BranchID)
WHERE  ops_order.OrderDate BETWEEN  '".$date_start."' AND '".$date_end."' AND ops_order.IsActive='1'
AND mas_branch.BranchID='".$session."'
GROUP BY ops_order.OrderNo,IsPayment
Order By ops_order.OrderNo ASC";

$stmt2="select top 10 coalesce (SUM(CASE WHEN ops_orderdetail.ServiceNameEN = 'Dry Clean' then 1 else null end),0) AS service1,
coalesce (SUM(CASE WHEN ops_orderdetail.ServiceNameEN = 'Laundry' then 1 else null end),0) AS service2,
coalesce (SUM(CASE WHEN ops_orderdetail.ServiceNameEN = 'Spa Leathers' then 1 else null end),0) AS service3,
coalesce (SUM(CASE WHEN ops_orderdetail.ServiceNameEN = 'hand wash' then 1 else null end),0) AS service4,
coalesce (SUM(CASE WHEN ops_orderdetail.ServiceNameEN = 'Press Only' then 1 else null end),0) AS service7,
coalesce (SUM(CASE WHEN ops_orderdetail.ServiceNameEN = 'Other' AND (ops_orderdetail.ProductID=360 OR ops_orderdetail.ProductID=361) then 1 else null end),0) AS service5,
coalesce (SUM(CASE WHEN ops_orderdetail.ServiceNameEN = 'Other' AND ops_orderdetail.ProductID=362 then 1 else null end),0) AS service6,
coalesce (SUM(CASE WHEN ops_orderdetail.ServiceNameEN = 'Dry Clean' then 1 else null end),0) +
coalesce (SUM(CASE WHEN ops_orderdetail.ServiceNameEN = 'Laundry' then 1 else null end),0) +
coalesce (SUM(CASE WHEN ops_orderdetail.ServiceNameEN = 'Spa Leathers' then 1 else null end),0) +
coalesce (SUM(CASE WHEN ops_orderdetail.ServiceNameEN = 'hand wash' then 1 else null end),0) AS counts
from (ops_order left join ops_orderdetail on ops_order.OrderNo=ops_orderdetail.OrderNo)
left join (mas_branch left join mas_branchtype on mas_branch.BranchID=mas_branchtype.BranchTypeID)
on ops_order.BranchID=mas_branch.BranchID
where ops_order.OrderDate BETWEEN '".$date_start."' AND '".$date_end."' AND ops_order.IsActive='1'
AND mas_branch.BranchID='".$session."'
group by ops_order.OrderNo
Order By ops_order.OrderNo ASC";
					}

				}
				else if($_GET['select_top']==20){
				if($_GET['keywords2']=='cheese'&&$_GET['keywords']=='cheese'){
				$stmt="select top 20 ROW_NUMBER() OVER(ORDER BY ops_order.OrderNo ASC) AS Row ,mas_branch.BranchNameTH,
mas_branchtype.BranchTypeNameTH,ops_order.OrderDate,ops_order.OrderNo,
coalesce (SUM(CASE WHEN ops_orderdetail.ServiceNameEN = 'Dry Clean' then 1 else null end),0) AS service1,
coalesce (SUM(CASE WHEN ops_orderdetail.ServiceNameEN = 'Laundry' then 1 else null end),0) AS service2,
coalesce (SUM(CASE WHEN ops_orderdetail.ServiceNameEN = 'Spa Leathers' then 1 else null end),0) AS service3,
coalesce (SUM(CASE WHEN ops_orderdetail.ServiceNameEN = 'hand wash' then 1 else null end),0) AS service4,
coalesce (SUM(CASE WHEN ops_orderdetail.ServiceNameEN = 'Press Only' then 1 else null end),0) AS service7,
coalesce (SUM(CASE WHEN ops_orderdetail.ServiceNameEN = 'Other' AND (ops_orderdetail.ProductID=360 OR ops_orderdetail.ProductID=361) then 1 else null end),0) AS service5,
coalesce (SUM(CASE WHEN ops_orderdetail.ServiceNameEN = 'Other' AND ops_orderdetail.ProductID=362 then 1 else null end),0) AS service6,
coalesce (SUM(CASE WHEN ops_orderdetail.ServiceNameEN = 'Dry Clean' then 1 else null end),0) +
coalesce (SUM(CASE WHEN ops_orderdetail.ServiceNameEN = 'Laundry' then 1 else null end),0) +
coalesce (SUM(CASE WHEN ops_orderdetail.ServiceNameEN = 'Spa Leathers' then 1 else null end),0) +
coalesce (SUM(CASE WHEN ops_orderdetail.ServiceNameEN = 'hand wash' then 1 else null end),0) AS counts,
((sum(Amount)+sum((Amount)*coalesce(ExpressRate,0))/100)+sum(coalesce(ops_orderdetail.AdditionAmount,0)))-sum(coalesce(ops_orderdetail.DiscountAmount,0)) as total from (((ops_order left join uac_customer on ops_order.CustomerID=uac_customer.CustomerID)
left join (mas_branch left join mas_branchtype on mas_branch.BranchType=mas_branchtype.BranchTypeID) ON ops_order.BranchID=mas_branch.BranchID)
left join ops_orderdetail on ops_order.OrderNo=ops_orderdetail.OrderNo)
left join mas_priceexpression on ops_order.IsExpressLevel=mas_priceexpression.IsExpressLevel
WHERE  ops_order.OrderDate BETWEEN  '".$date_start."' AND '".$date_end."' AND ops_order.IsActive='1'
AND mas_branch.BranchID='".$session."'
Group By mas_branch.BranchNameTH,ops_order.OrderNo,mas_branchtype.BranchTypeNameTH,
ops_order.OrderDate,ops_order.NetAmount,ops_order.OrderNo
Order By ops_order.OrderNo ASC";

$stmt1="select top 20 ops_order.OrderNo,sum(PromoDiscount) as PromoDiscount,sum(ops_order.IsExpress) as counts,IsPayment from (ops_order
left join (mas_branch left join mas_branchtype on mas_branch.BranchID=mas_branchtype.BranchTypeID)
on ops_order.BranchID=mas_branch.BranchID)
WHERE  ops_order.OrderDate BETWEEN  '".$date_start."' AND '".$date_end."' AND ops_order.IsActive='1'
AND mas_branch.BranchID='".$session."'
GROUP BY ops_order.OrderNo,IsPayment
Order By ops_order.OrderNo ASC";

$stmt2="select top 20 coalesce (SUM(CASE WHEN ops_orderdetail.ServiceNameEN = 'Dry Clean' then 1 else null end),0) AS service1,
coalesce (SUM(CASE WHEN ops_orderdetail.ServiceNameEN = 'Laundry' then 1 else null end),0) AS service2,
coalesce (SUM(CASE WHEN ops_orderdetail.ServiceNameEN = 'Spa Leathers' then 1 else null end),0) AS service3,
coalesce (SUM(CASE WHEN ops_orderdetail.ServiceNameEN = 'hand wash' then 1 else null end),0) AS service4,
coalesce (SUM(CASE WHEN ops_orderdetail.ServiceNameEN = 'Press Only' then 1 else null end),0) AS service7,
coalesce (SUM(CASE WHEN ops_orderdetail.ServiceNameEN = 'Other' AND (ops_orderdetail.ProductID=360 OR ops_orderdetail.ProductID=361) then 1 else null end),0) AS service5,
coalesce (SUM(CASE WHEN ops_orderdetail.ServiceNameEN = 'Other' AND ops_orderdetail.ProductID=362 then 1 else null end),0) AS service6,
coalesce (SUM(CASE WHEN ops_orderdetail.ServiceNameEN = 'Dry Clean' then 1 else null end),0) +
coalesce (SUM(CASE WHEN ops_orderdetail.ServiceNameEN = 'Laundry' then 1 else null end),0) +
coalesce (SUM(CASE WHEN ops_orderdetail.ServiceNameEN = 'Spa Leathers' then 1 else null end),0) +
coalesce (SUM(CASE WHEN ops_orderdetail.ServiceNameEN = 'hand wash' then 1 else null end),0) AS counts
from (ops_order left join ops_orderdetail on ops_order.OrderNo=ops_orderdetail.OrderNo)
left join (mas_branch left join mas_branchtype on mas_branch.BranchID=mas_branchtype.BranchTypeID)
on ops_order.BranchID=mas_branch.BranchID
where ops_order.OrderDate BETWEEN '".$date_start."' AND '".$date_end."' AND ops_order.IsActive='1'
AND mas_branch.BranchID='".$session."'
group by ops_order.OrderNo
Order By ops_order.OrderNo ASC";
				}
				}
				else if($_GET['select_top']==30){
				if($_GET['keywords2']=='cheese'&&$_GET['keywords']=='cheese'){
				$stmt="select top 30 ROW_NUMBER() OVER(ORDER BY ops_order.OrderNo ASC) AS Row ,mas_branch.BranchNameTH,
mas_branchtype.BranchTypeNameTH,ops_order.OrderDate,ops_order.OrderNo,
coalesce (SUM(CASE WHEN ops_orderdetail.ServiceNameEN = 'Dry Clean' then 1 else null end),0) AS service1,
coalesce (SUM(CASE WHEN ops_orderdetail.ServiceNameEN = 'Laundry' then 1 else null end),0) AS service2,
coalesce (SUM(CASE WHEN ops_orderdetail.ServiceNameEN = 'Spa Leathers' then 1 else null end),0) AS service3,
coalesce (SUM(CASE WHEN ops_orderdetail.ServiceNameEN = 'hand wash' then 1 else null end),0) AS service4,
coalesce (SUM(CASE WHEN ops_orderdetail.ServiceNameEN = 'Press Only' then 1 else null end),0) AS service7,
coalesce (SUM(CASE WHEN ops_orderdetail.ServiceNameEN = 'Other' AND (ops_orderdetail.ProductID=360 OR ops_orderdetail.ProductID=361) then 1 else null end),0) AS service5,
coalesce (SUM(CASE WHEN ops_orderdetail.ServiceNameEN = 'Other' AND ops_orderdetail.ProductID=362 then 1 else null end),0) AS service6,
coalesce (SUM(CASE WHEN ops_orderdetail.ServiceNameEN = 'Dry Clean' then 1 else null end),0) +
coalesce (SUM(CASE WHEN ops_orderdetail.ServiceNameEN = 'Laundry' then 1 else null end),0) +
coalesce (SUM(CASE WHEN ops_orderdetail.ServiceNameEN = 'Spa Leathers' then 1 else null end),0) +
coalesce (SUM(CASE WHEN ops_orderdetail.ServiceNameEN = 'hand wash' then 1 else null end),0) AS counts,
((sum(Amount)+sum((Amount)*coalesce(ExpressRate,0))/100)+sum(coalesce(ops_orderdetail.AdditionAmount,0)))-sum(coalesce(ops_orderdetail.DiscountAmount,0)) as total from (((ops_order left join uac_customer on ops_order.CustomerID=uac_customer.CustomerID)
left join (mas_branch left join mas_branchtype on mas_branch.BranchType=mas_branchtype.BranchTypeID) ON ops_order.BranchID=mas_branch.BranchID)
left join ops_orderdetail on ops_order.OrderNo=ops_orderdetail.OrderNo)
left join mas_priceexpression on ops_order.IsExpressLevel=mas_priceexpression.IsExpressLevel
WHERE  ops_order.OrderDate BETWEEN  '".$date_start."' AND '".$date_end."' AND ops_order.IsActive='1'
AND mas_branch.BranchID='".$session."'
Group By mas_branch.BranchNameTH,ops_order.OrderNo,mas_branchtype.BranchTypeNameTH,
ops_order.OrderDate,ops_order.NetAmount,ops_order.OrderNo
Order By ops_order.OrderNo ASC";

$stmt1="select top 30 ops_order.OrderNo,sum(PromoDiscount) as PromoDiscount,sum(ops_order.IsExpress) as counts,IsPayment from (ops_order
left join (mas_branch left join mas_branchtype on mas_branch.BranchID=mas_branchtype.BranchTypeID)
on ops_order.BranchID=mas_branch.BranchID)
WHERE  ops_order.OrderDate BETWEEN  '".$date_start."' AND '".$date_end."' AND ops_order.IsActive='1'
AND mas_branch.BranchID='".$session."'
GROUP BY ops_order.OrderNo,IsPayment
Order By ops_order.OrderNo ASC";

$stmt2="select top 30 coalesce (SUM(CASE WHEN ops_orderdetail.ServiceNameEN = 'Dry Clean' then 1 else null end),0) AS service1,
coalesce (SUM(CASE WHEN ops_orderdetail.ServiceNameEN = 'Laundry' then 1 else null end),0) AS service2,
coalesce (SUM(CASE WHEN ops_orderdetail.ServiceNameEN = 'Spa Leathers' then 1 else null end),0) AS service3,
coalesce (SUM(CASE WHEN ops_orderdetail.ServiceNameEN = 'hand wash' then 1 else null end),0) AS service4,
coalesce (SUM(CASE WHEN ops_orderdetail.ServiceNameEN = 'Press Only' then 1 else null end),0) AS service7,
coalesce (SUM(CASE WHEN ops_orderdetail.ServiceNameEN = 'Other' AND (ops_orderdetail.ProductID=360 OR ops_orderdetail.ProductID=361) then 1 else null end),0) AS service5,
coalesce (SUM(CASE WHEN ops_orderdetail.ServiceNameEN = 'Other' AND ops_orderdetail.ProductID=362 then 1 else null end),0) AS service6,
coalesce (SUM(CASE WHEN ops_orderdetail.ServiceNameEN = 'Dry Clean' then 1 else null end),0) +
coalesce (SUM(CASE WHEN ops_orderdetail.ServiceNameEN = 'Laundry' then 1 else null end),0) +
coalesce (SUM(CASE WHEN ops_orderdetail.ServiceNameEN = 'Spa Leathers' then 1 else null end),0) +
coalesce (SUM(CASE WHEN ops_orderdetail.ServiceNameEN = 'hand wash' then 1 else null end),0) AS counts
from (ops_order left join ops_orderdetail on ops_order.OrderNo=ops_orderdetail.OrderNo)
left join (mas_branch left join mas_branchtype on mas_branch.BranchID=mas_branchtype.BranchTypeID)
on ops_order.BranchID=mas_branch.BranchID
where ops_order.OrderDate BETWEEN '".$date_start."' AND '".$date_end."' AND ops_order.IsActive='1'
AND mas_branch.BranchID='".$session."'
group by ops_order.OrderNo
Order By ops_order.OrderNo ASC";
				}
				}
				else if($_GET['select_top']==100){
				if($_GET['keywords2']=='cheese'||$_GET['keywords']=='cheese'){
				$stmt="select ROW_NUMBER() OVER(ORDER BY ops_order.OrderNo ASC) AS Row ,mas_branch.BranchNameTH,
mas_branchtype.BranchTypeNameTH,ops_order.OrderDate,ops_order.OrderNo,
coalesce (SUM(CASE WHEN ops_orderdetail.ServiceNameEN = 'Dry Clean' then 1 else null end),0) AS service1,
coalesce (SUM(CASE WHEN ops_orderdetail.ServiceNameEN = 'Laundry' then 1 else null end),0) AS service2,
coalesce (SUM(CASE WHEN ops_orderdetail.ServiceNameEN = 'Spa Leathers' then 1 else null end),0) AS service3,
coalesce (SUM(CASE WHEN ops_orderdetail.ServiceNameEN = 'hand wash' then 1 else null end),0) AS service4,
coalesce (SUM(CASE WHEN ops_orderdetail.ServiceNameEN = 'Press Only' then 1 else null end),0) AS service7,
coalesce (SUM(CASE WHEN ops_orderdetail.ServiceNameEN = 'Other' AND (ops_orderdetail.ProductID=360 OR ops_orderdetail.ProductID=361) then 1 else null end),0) AS service5,
coalesce (SUM(CASE WHEN ops_orderdetail.ServiceNameEN = 'Other' AND ops_orderdetail.ProductID=362 then 1 else null end),0) AS service6,
coalesce (SUM(CASE WHEN ops_orderdetail.ServiceNameEN = 'Dry Clean' then 1 else null end),0) +
coalesce (SUM(CASE WHEN ops_orderdetail.ServiceNameEN = 'Laundry' then 1 else null end),0) +
coalesce (SUM(CASE WHEN ops_orderdetail.ServiceNameEN = 'Spa Leathers' then 1 else null end),0) +
coalesce (SUM(CASE WHEN ops_orderdetail.ServiceNameEN = 'hand wash' then 1 else null end),0) AS counts,
((sum(Amount)+sum((Amount)*coalesce(ExpressRate,0))/100)+sum(coalesce(ops_orderdetail.AdditionAmount,0)))-sum(coalesce(ops_orderdetail.DiscountAmount,0)) as total from (((ops_order left join uac_customer on ops_order.CustomerID=uac_customer.CustomerID)
left join (mas_branch left join mas_branchtype on mas_branch.BranchType=mas_branchtype.BranchTypeID) ON ops_order.BranchID=mas_branch.BranchID)
left join ops_orderdetail on ops_order.OrderNo=ops_orderdetail.OrderNo)
left join mas_priceexpression on ops_order.IsExpressLevel=mas_priceexpression.IsExpressLevel
WHERE  ops_order.OrderDate BETWEEN  '".$date_start."' AND '".$date_end."' AND ops_order.IsActive='1'
AND mas_branch.BranchID='".$session."'
Group By mas_branch.BranchNameTH,ops_order.OrderNo,mas_branchtype.BranchTypeNameTH,
ops_order.OrderDate,ops_order.NetAmount,ops_order.OrderNo
Order By ops_order.OrderNo ASC";

$stmt1="select ops_order.OrderNo,sum(PromoDiscount) as PromoDiscount,sum(ops_order.IsExpress) as counts,IsPayment from (ops_order
left join (mas_branch left join mas_branchtype on mas_branch.BranchID=mas_branchtype.BranchTypeID)
on ops_order.BranchID=mas_branch.BranchID)
WHERE  ops_order.OrderDate BETWEEN  '".$date_start."' AND '".$date_end."' AND ops_order.IsActive='1'
AND mas_branch.BranchID='".$session."'
GROUP BY ops_order.OrderNo,IsPayment
Order By ops_order.OrderNo ASC";

$stmt2="select coalesce (SUM(CASE WHEN ops_orderdetail.ServiceNameEN = 'Dry Clean' then 1 else null end),0) AS service1,
coalesce (SUM(CASE WHEN ops_orderdetail.ServiceNameEN = 'Laundry' then 1 else null end),0) AS service2,
coalesce (SUM(CASE WHEN ops_orderdetail.ServiceNameEN = 'Spa Leathers' then 1 else null end),0) AS service3,
coalesce (SUM(CASE WHEN ops_orderdetail.ServiceNameEN = 'hand wash' then 1 else null end),0) AS service4,
coalesce (SUM(CASE WHEN ops_orderdetail.ServiceNameEN = 'Press Only' then 1 else null end),0) AS service7,
coalesce (SUM(CASE WHEN ops_orderdetail.ServiceNameEN = 'Other' AND (ops_orderdetail.ProductID=360 OR ops_orderdetail.ProductID=361) then 1 else null end),0) AS service5,
coalesce (SUM(CASE WHEN ops_orderdetail.ServiceNameEN = 'Other' AND ops_orderdetail.ProductID=362 then 1 else null end),0) AS service6,
coalesce (SUM(CASE WHEN ops_orderdetail.ServiceNameEN = 'Dry Clean' then 1 else null end),0) +
coalesce (SUM(CASE WHEN ops_orderdetail.ServiceNameEN = 'Laundry' then 1 else null end),0) +
coalesce (SUM(CASE WHEN ops_orderdetail.ServiceNameEN = 'Spa Leathers' then 1 else null end),0) +
coalesce (SUM(CASE WHEN ops_orderdetail.ServiceNameEN = 'hand wash' then 1 else null end),0) AS counts
from (ops_order left join ops_orderdetail on ops_order.OrderNo=ops_orderdetail.OrderNo)
left join (mas_branch left join mas_branchtype on mas_branch.BranchID=mas_branchtype.BranchTypeID)
on ops_order.BranchID=mas_branch.BranchID
where ops_order.OrderDate BETWEEN '".$date_start."' AND '".$date_end."' AND ops_order.IsActive='1'
AND mas_branch.BranchID='".$session."'
group by ops_order.OrderNo
Order By ops_order.OrderNo ASC";
				}
				}
				else{
				if($_GET['keywords2']=='cheese'&&$_GET['keywords']=='cheese'){
$stmt="select distinct ROW_NUMBER() OVER(ORDER BY ops_order.OrderNo ASC) AS Row ,mas_branch.BranchNameTH,
mas_branchtype.BranchTypeNameTH,ops_order.OrderDate,ops_order.OrderNo,
coalesce (SUM(CASE WHEN ops_orderdetail.ServiceNameEN = 'Dry Clean' then 1 else null end),0) AS service1,
coalesce (SUM(CASE WHEN ops_orderdetail.ServiceNameEN = 'Laundry' then 1 else null end),0) AS service2,
coalesce (SUM(CASE WHEN ops_orderdetail.ServiceNameEN = 'Spa Leathers' then 1 else null end),0) AS service3,
coalesce (SUM(CASE WHEN ops_orderdetail.ServiceNameEN = 'hand wash' then 1 else null end),0) AS service4,
coalesce (SUM(CASE WHEN ops_orderdetail.ServiceNameEN = 'Press Only' then 1 else null end),0) AS service7,
coalesce (SUM(CASE WHEN ops_orderdetail.ServiceNameEN = 'Other' AND (ops_orderdetail.ProductID=360 OR ops_orderdetail.ProductID=361) then 1 else null end),0) AS service5,
coalesce (SUM(CASE WHEN ops_orderdetail.ServiceNameEN = 'Other' AND ops_orderdetail.ProductID=362 then 1 else null end),0) AS service6,
coalesce (SUM(CASE WHEN ops_orderdetail.ServiceNameEN = 'Dry Clean' then 1 else null end),0) +
coalesce (SUM(CASE WHEN ops_orderdetail.ServiceNameEN = 'Laundry' then 1 else null end),0) +
coalesce (SUM(CASE WHEN ops_orderdetail.ServiceNameEN = 'Spa Leathers' then 1 else null end),0) +
coalesce (SUM(CASE WHEN ops_orderdetail.ServiceNameEN = 'hand wash' then 1 else null end),0) AS counts,
((sum(Amount)+sum((Amount)*coalesce(ExpressRate,0))/100)+sum(coalesce(ops_orderdetail.AdditionAmount,0)))-sum(coalesce(ops_orderdetail.DiscountAmount,0)) as total from (((ops_order left join uac_customer on ops_order.CustomerID=uac_customer.CustomerID)
left join (mas_branch left join mas_branchtype on mas_branch.BranchType=mas_branchtype.BranchTypeID) ON ops_order.BranchID=mas_branch.BranchID)
left join ops_orderdetail on ops_order.OrderNo=ops_orderdetail.OrderNo)
left join mas_priceexpression on ops_order.IsExpressLevel=mas_priceexpression.IsExpressLevel
WHERE  ops_order.OrderDate BETWEEN  '".$date_start."' AND '".$date_end."' AND ops_order.IsActive='1'
AND mas_branch.BranchID='".$session."'
Group By mas_branch.BranchNameTH,ops_order.OrderNo,mas_branchtype.BranchTypeNameTH,
ops_order.OrderDate,ops_order.NetAmount,ops_order.OrderNo
Order By ops_order.OrderNo ASC";

$stmt1="select ops_order.OrderNo,sum(PromoDiscount) as PromoDiscount,sum(ops_order.IsExpress) as counts,IsPayment from (ops_order
left join (mas_branch left join mas_branchtype on mas_branch.BranchID=mas_branchtype.BranchTypeID)
on ops_order.BranchID=mas_branch.BranchID)
WHERE  ops_order.OrderDate BETWEEN  '".$date_start."' AND '".$date_end."' AND ops_order.IsActive='1'
AND mas_branch.BranchID='".$session."'
GROUP BY ops_order.OrderNo,IsPayment
Order By ops_order.OrderNo ASC";

$stmt2="select coalesce (SUM(CASE WHEN ops_orderdetail.ServiceNameEN = 'Dry Clean' then 1 else null end),0) AS service1,
coalesce (SUM(CASE WHEN ops_orderdetail.ServiceNameEN = 'Laundry' then 1 else null end),0) AS service2,
coalesce (SUM(CASE WHEN ops_orderdetail.ServiceNameEN = 'Spa Leathers' then 1 else null end),0) AS service3,
coalesce (SUM(CASE WHEN ops_orderdetail.ServiceNameEN = 'hand wash' then 1 else null end),0) AS service4,
coalesce (SUM(CASE WHEN ops_orderdetail.ServiceNameEN = 'Press Only' then 1 else null end),0) AS service7,
coalesce (SUM(CASE WHEN ops_orderdetail.ServiceNameEN = 'Other' AND (ops_orderdetail.ProductID=360 OR ops_orderdetail.ProductID=361) then 1 else null end),0) AS service5,
coalesce (SUM(CASE WHEN ops_orderdetail.ServiceNameEN = 'Other' AND ops_orderdetail.ProductID=362 then 1 else null end),0) AS service6,
coalesce (SUM(CASE WHEN ops_orderdetail.ServiceNameEN = 'Dry Clean' then 1 else null end),0) +
coalesce (SUM(CASE WHEN ops_orderdetail.ServiceNameEN = 'Laundry' then 1 else null end),0) +
coalesce (SUM(CASE WHEN ops_orderdetail.ServiceNameEN = 'Spa Leathers' then 1 else null end),0) +
coalesce (SUM(CASE WHEN ops_orderdetail.ServiceNameEN = 'hand wash' then 1 else null end),0) AS counts
from (ops_order left join ops_orderdetail on ops_order.OrderNo=ops_orderdetail.OrderNo)
left join (mas_branch left join mas_branchtype on mas_branch.BranchID=mas_branchtype.BranchTypeID)
on ops_order.BranchID=mas_branch.BranchID
where ops_order.OrderDate BETWEEN '".$date_start."' AND '".$date_end."' AND ops_order.IsActive='1'
AND mas_branch.BranchID='".$session."'
group by ops_order.OrderNo
Order By ops_order.OrderNo ASC";
				}
				}
				}
					$query = sqlsrv_query($conn,$stmt);
					$query1 = sqlsrv_query($conn,$stmt1);
					$query2 = sqlsrv_query($conn,$stmt2);
	
    				$object_array = array();
					
					
								$arrBranchType=array();
								$arrBranchName=array();
								$arrDateOrder=array();
								$arrOrderNo=array();
								$arrSer1=array();
								$arrSer2=array();
								$arrSer3=array();
								$arrSer4=array();
								$arrSer5=array();
								$arrSer6=array();
								$arrSer7=array();
								$arrSer8=array();
								$arrTotal=array();
								$arrCount=array();
								$arrCount1=array();
                                $arrMember=array();
                                $arrIsPayment=array();

								$arrSpecail=array();
								while($row = sqlsrv_fetch_array($query)){
									array_push($arrDateOrder,$row['OrderDate']);
									array_push($arrBranchType,$row['BranchTypeNameTH']);
									array_push($arrBranchName,$row['BranchNameTH']);
									array_push($arrTotal,$row['total']);
									array_push($arrOrderNo,$row['OrderNo']);
								}
								$arrPromo=array();
								while($row1 = sqlsrv_fetch_array($query1)){
										array_push($arrPromo,$row1['PromoDiscount']);
										array_push($arrCount1,$row1['counts']);
										array_push($arrMember,$row1['MemberDiscount']);
                                        array_push($arrSpecail,$row1['SpecialDiscount']);
                                        array_push($arrIsPayment,$row1['IsPayment']);
								}

								while($row2 = sqlsrv_fetch_array($query2)){
									array_push($arrSer1,$row2['service1']);
									array_push($arrSer2,$row2['service2']);
									array_push($arrSer3,$row2['service3']);
									array_push($arrSer4,$row2['service4']);
									array_push($arrSer6,$row2['service5']);
									array_push($arrSer7,$row2['service6']);
									array_push($arrSer8,$row2['service7']);
									array_push($arrCount,$row2['counts']);
								}

								/*for($i=0;$i<count($arrPromo);$i++){
									$total1=$total1+$arrSer1[$i];
									$total2=$total2+$arrSer2[$i];
									$total3=$total3+$arrSer3[$i];
									$total4=$total4+$arrSer4[$i];
									$total7=$total7+$arrSer6[$i];
									$total8=$total8+$arrSer7[$i];
									$total10=$total10+$arrSer8[$i];
									//$total5+=($arrCount[$i]);
									$total5+=$arrSer1[$i]+$arrSer2[$i]+$arrSer3[$i]+$arrSer4[$i]+$arrSer8[$i]+$arrSer6[$i]+$arrSer7[$i];
									$total9+=($arrSpecail[$i]);
									$total6=$total6+((($arrTotal[$i]-$arrPromo[$i])-$arrMember[$i])-$arrSpecail[$i]);
								}*/
					for($i=0;$i<count($arrPromo);$i++){
						array_push($object_array,array('BranchType' => $arrBranchType[$i], 'OrderDate' => $arrDateOrder[$i]
		,'BranchNameTH' => $arrBranchName[$i],'OrderNo' => $arrOrderNo[$i],'service1' => $arrSer1[$i],'service2' => $arrSer2[$i]
		,'service3' => $arrSer3[$i],'service4' => $arrSer4[$i],'service5' => $arrSer6[$i],'service6' => $arrSer7[$i],
		'service7' => $arrSer8[$i],'counts' => $arrSer1[$i]+$arrSer2[$i]+$arrSer3[$i]+$arrSer4[$i]+$arrSer8[$i]+$arrSer6[$i]+$arrSer7[$i]
		,'SpecialDiscount' => $arrSpecail[$i],'Total' => $arrTotal[$i]-$arrPromo[$i]-$arrMember[$i]-$arrSpecail[$i],'IsPayment' => $arrIsPayment[$i]));
					}
    $json_array=json_encode($object_array);
	echo $json_array;
?>
