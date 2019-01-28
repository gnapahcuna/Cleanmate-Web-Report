<?php
	include("config.php");
   	$keywords2=$_GET['keywords2'];
	$keywords=$_GET['keywords'];
	$date_start=$_GET['date_start'];
	$date_end=$_GET['date_end'];
	$session=$_GET['session'];
	
	$stmt="";
	$stmt1="";
	
	if($session==1){
		if($_GET['select_top']==10){
			if($_GET['keywords2']=='cheese'&&$_GET['keywords']=='cheese'){
				$stmt="select distinct top 10 ROW_NUMBER() OVER(ORDER BY uac_customer.CustomerID ASC) AS Row ,mas_branch.BranchNameTH,
case when  uac_customer.CustomerType=1 then 1 else 0 end as CustomerType,uac_customer.CustomerID,
uac_customer.FirstName+' '+uac_customer.LastName as CustomerName,uac_customer.TelephoneNo,count(ops_order.OrderNo) as counts,
((sum(Amount)+sum((Amount)*coalesce(ExpressRate,0))/100)+sum(coalesce(ops_orderdetail.AdditionAmount,0)))-sum(coalesce(ops_orderdetail.DiscountAmount,0)) as total,
MAX(OrderDate) as dates
from (((ops_order left join uac_customer on ops_order.CustomerID=uac_customer.CustomerID)
left join (mas_branch left join mas_branchtype on mas_branch.BranchType=mas_branchtype.BranchTypeID) ON ops_order.BranchID=mas_branch.BranchID)
left join ops_orderdetail on ops_order.OrderNo=ops_orderdetail.OrderNo)
left join mas_priceexpression on ops_order.IsExpressLevel=mas_priceexpression.IsExpressLevel
WHERE ops_order.OrderDate BETWEEN '".$date_start."' AND '".$date_end."' AND ops_order.IsActive='1'
GROUP BY uac_customer.CustomerID,uac_customer.FirstName,uac_customer.LastName,uac_customer.TelephoneNo,mas_branch.BranchNameTH,uac_customer.CustomerType
Order By total DESC";

$stmt1="select top 10 count(ops_order.OrderNo) as nums,ops_order.CustomerID,sum(PromoDiscount) as PromoDiscount,sum(ops_order.IsExpress)as counts, coalesce(sum(SpecialDiscount),0) as SpecialDiscount,sum(MemberDiscount) as MemberDiscount
from (ops_order
left join (mas_branch left join mas_branchtype on mas_branch.BranchID=mas_branchtype.BranchTypeID)
on ops_order.BranchID=mas_branch.BranchID) left join (SELECT distinct od.OrderNo,Sum(Amount) as Amount from ops_order od left join ops_orderdetail odd on od.OrderNo=odd.OrderNo group by od.OrderNo) As cases on ops_order.OrderNo=cases.OrderNo
WHERE ops_order.OrderDate BETWEEN '".$date_start."' AND '".$date_end."' AND ops_order.IsActive='1'
GROUP BY ops_order.CustomerID,ops_order.BranchID
Order By SUM(cases.Amount) DESC";
				}else if($_GET['keywords2']!='cheese'&&$_GET['keywords']=='cheese'){
						$stmt="select distinct top 10 ROW_NUMBER() OVER(ORDER BY uac_customer.CustomerID ASC) AS Row ,mas_branch.BranchNameTH,
case when  uac_customer.CustomerType=1 then 1 else 0 end as CustomerType,uac_customer.CustomerID,
uac_customer.FirstName+' '+uac_customer.LastName as CustomerName,uac_customer.TelephoneNo,count(ops_order.OrderNo) as counts,
((sum(Amount)+sum((Amount)*coalesce(ExpressRate,0))/100)+sum(coalesce(ops_orderdetail.AdditionAmount,0)))-sum(coalesce(ops_orderdetail.DiscountAmount,0)) as total,
MAX(OrderDate) as dates
from (((ops_order left join uac_customer on ops_order.CustomerID=uac_customer.CustomerID)
left join (mas_branch left join mas_branchtype on mas_branch.BranchType=mas_branchtype.BranchTypeID) ON ops_order.BranchID=mas_branch.BranchID)
left join ops_orderdetail on ops_order.OrderNo=ops_orderdetail.OrderNo)
left join mas_priceexpression on ops_order.IsExpressLevel=mas_priceexpression.IsExpressLevel
WHERE ops_order.OrderDate BETWEEN '".$date_start."' AND '".$date_end."' AND ops_order.IsActive='1'
AND mas_branch.BranchID = '".$keywords2."'
GROUP BY uac_customer.CustomerID,uac_customer.FirstName,uac_customer.LastName,uac_customer.TelephoneNo,mas_branch.BranchNameTH,uac_customer.CustomerType
Order By total DESC";

$stmt1="select top 10 count(ops_order.OrderNo) as nums,ops_order.CustomerID,sum(PromoDiscount) as PromoDiscount,sum(ops_order.IsExpress)as counts, coalesce(sum(SpecialDiscount),0) as SpecialDiscount,sum(MemberDiscount) as MemberDiscount
from (ops_order
left join (mas_branch left join mas_branchtype on mas_branch.BranchID=mas_branchtype.BranchTypeID)
on ops_order.BranchID=mas_branch.BranchID) left join (SELECT distinct od.OrderNo,Sum(Amount) as Amount from ops_order od left join ops_orderdetail odd on od.OrderNo=odd.OrderNo group by od.OrderNo) As cases on ops_order.OrderNo=cases.OrderNo
WHERE ops_order.OrderDate BETWEEN '".$date_start."' AND '".$date_end."' AND ops_order.IsActive='1'
AND mas_branch.BranchID = '".$keywords2."'
GROUP BY ops_order.CustomerID,ops_order.BranchID
Order By SUM(cases.Amount) DESC";
						}
						else{
					$stmt="select distinct top 10 ROW_NUMBER() OVER(ORDER BY uac_customer.CustomerID ASC) AS Row ,mas_branch.BranchNameTH,
case when  uac_customer.CustomerType=1 then 1 else 0 end as CustomerType,uac_customer.CustomerID,
uac_customer.FirstName+' '+uac_customer.LastName as CustomerName,uac_customer.TelephoneNo,count(ops_order.OrderNo) as counts,
((sum(Amount)+sum((Amount)*coalesce(ExpressRate,0))/100)+sum(coalesce(ops_orderdetail.AdditionAmount,0)))-sum(coalesce(ops_orderdetail.DiscountAmount,0)) as total,
MAX(OrderDate) as dates
from (((ops_order left join uac_customer on ops_order.CustomerID=uac_customer.CustomerID)
left join (mas_branch left join mas_branchtype on mas_branch.BranchType=mas_branchtype.BranchTypeID) ON ops_order.BranchID=mas_branch.BranchID)
left join ops_orderdetail on ops_order.OrderNo=ops_orderdetail.OrderNo)
left join mas_priceexpression on ops_order.IsExpressLevel=mas_priceexpression.IsExpressLevel
WHERE ops_order.OrderDate BETWEEN '".$date_start."' AND '".$date_end."' AND ops_order.IsActive='1'
AND mas_branch.BranchType = '".$keywords."'
GROUP BY uac_customer.CustomerID,uac_customer.FirstName,uac_customer.LastName,uac_customer.TelephoneNo,mas_branch.BranchNameTH,uac_customer.CustomerType
Order By total DESC";

$stmt1="select top 10 count(ops_order.OrderNo) as nums,ops_order.CustomerID,sum(PromoDiscount) as PromoDiscount,sum(ops_order.IsExpress)as counts, coalesce(sum(SpecialDiscount),0) as SpecialDiscount,sum(MemberDiscount) as MemberDiscount
from (ops_order
left join (mas_branch left join mas_branchtype on mas_branch.BranchID=mas_branchtype.BranchTypeID)
on ops_order.BranchID=mas_branch.BranchID) left join (SELECT distinct od.OrderNo,Sum(Amount) as Amount from ops_order od left join ops_orderdetail odd on od.OrderNo=odd.OrderNo group by od.OrderNo) As cases on ops_order.OrderNo=cases.OrderNo
WHERE ops_order.OrderDate BETWEEN '".$date_start."' AND '".$date_end."' AND ops_order.IsActive='1'
AND mas_branch.BranchType = '".$keywords."'
GROUP BY ops_order.CustomerID,ops_order.BranchID
Order By SUM(cases.Amount) DESC";
				}
				}
				else if($_GET['select_top']==20){
				if($_GET['keywords2']=='cheese'&&$_GET['keywords']=='cheese'){
				$stmt="select distinct top 20 ROW_NUMBER() OVER(ORDER BY uac_customer.CustomerID ASC) AS Row ,mas_branch.BranchNameTH,
case when  uac_customer.CustomerType=1 then 1 else 0 end as CustomerType,uac_customer.CustomerID,
uac_customer.FirstName+' '+uac_customer.LastName as CustomerName,uac_customer.TelephoneNo,count(ops_order.OrderNo) as counts,
((sum(Amount)+sum((Amount)*coalesce(ExpressRate,0))/100)+sum(coalesce(ops_orderdetail.AdditionAmount,0)))-sum(coalesce(ops_orderdetail.DiscountAmount,0)) as total,
MAX(OrderDate) as dates
from (((ops_order left join uac_customer on ops_order.CustomerID=uac_customer.CustomerID)
left join (mas_branch left join mas_branchtype on mas_branch.BranchType=mas_branchtype.BranchTypeID) ON ops_order.BranchID=mas_branch.BranchID)
left join ops_orderdetail on ops_order.OrderNo=ops_orderdetail.OrderNo)
left join mas_priceexpression on ops_order.IsExpressLevel=mas_priceexpression.IsExpressLevel
WHERE ops_order.OrderDate BETWEEN '".$date_start."' AND '".$date_end."' AND ops_order.IsActive='1'
GROUP BY uac_customer.CustomerID,uac_customer.FirstName,uac_customer.LastName,uac_customer.TelephoneNo,mas_branch.BranchNameTH,uac_customer.CustomerType
Order By total DESC";

$stmt1="select top 20 count(ops_order.OrderNo) as nums,ops_order.CustomerID,sum(PromoDiscount) as PromoDiscount,sum(ops_order.IsExpress)as counts, coalesce(sum(SpecialDiscount),0) as SpecialDiscount,sum(MemberDiscount) as MemberDiscount
from (ops_order
left join (mas_branch left join mas_branchtype on mas_branch.BranchID=mas_branchtype.BranchTypeID)
on ops_order.BranchID=mas_branch.BranchID) left join (SELECT distinct od.OrderNo,Sum(Amount) as Amount from ops_order od left join ops_orderdetail odd on od.OrderNo=odd.OrderNo group by od.OrderNo) As cases on ops_order.OrderNo=cases.OrderNo
WHERE ops_order.OrderDate BETWEEN '".$date_start."' AND '".$date_end."' AND ops_order.IsActive='1'
GROUP BY ops_order.CustomerID,ops_order.BranchID
Order By SUM(cases.Amount) DESC";
				}else if($_GET['keywords2']!='cheese'&&$_GET['keywords']=='cheese'){
						$stmt="select distinct top 20 ROW_NUMBER() OVER(ORDER BY uac_customer.CustomerID ASC) AS Row ,mas_branch.BranchNameTH,
case when  uac_customer.CustomerType=1 then 1 else 0 end as CustomerType,uac_customer.CustomerID,
uac_customer.FirstName+' '+uac_customer.LastName as CustomerName,uac_customer.TelephoneNo,count(ops_order.OrderNo) as counts,
((sum(Amount)+sum((Amount)*coalesce(ExpressRate,0))/100)+sum(coalesce(ops_orderdetail.AdditionAmount,0)))-sum(coalesce(ops_orderdetail.DiscountAmount,0)) as total,
MAX(OrderDate) as dates
from (((ops_order left join uac_customer on ops_order.CustomerID=uac_customer.CustomerID)
left join (mas_branch left join mas_branchtype on mas_branch.BranchType=mas_branchtype.BranchTypeID) ON ops_order.BranchID=mas_branch.BranchID)
left join ops_orderdetail on ops_order.OrderNo=ops_orderdetail.OrderNo)
left join mas_priceexpression on ops_order.IsExpressLevel=mas_priceexpression.IsExpressLevel
WHERE ops_order.OrderDate BETWEEN '".$date_start."' AND '".$date_end."' AND ops_order.IsActive='1'
AND mas_branch.BranchID = '".$keywords2."'
GROUP BY uac_customer.CustomerID,uac_customer.FirstName,uac_customer.LastName,uac_customer.TelephoneNo,mas_branch.BranchNameTH,uac_customer.CustomerType
Order By total DESC";

$stmt1="select top 20 count(ops_order.OrderNo) as nums,ops_order.CustomerID,sum(PromoDiscount) as PromoDiscount,sum(ops_order.IsExpress)as counts, coalesce(sum(SpecialDiscount),0) as SpecialDiscount,sum(MemberDiscount) as MemberDiscount
from (ops_order
left join (mas_branch left join mas_branchtype on mas_branch.BranchID=mas_branchtype.BranchTypeID)
on ops_order.BranchID=mas_branch.BranchID) left join (SELECT distinct od.OrderNo,Sum(Amount) as Amount from ops_order od left join ops_orderdetail odd on od.OrderNo=odd.OrderNo group by od.OrderNo) As cases on ops_order.OrderNo=cases.OrderNo
WHERE ops_order.OrderDate BETWEEN '".$date_start."' AND '".$date_end."' AND ops_order.IsActive='1'
AND mas_branch.BranchID = '".$keywords2."'
GROUP BY ops_order.CustomerID,ops_order.BranchID
Order By SUM(cases.Amount) DESC";
						}
						else{
					$stmt="select distinct top 20 ROW_NUMBER() OVER(ORDER BY uac_customer.CustomerID ASC) AS Row ,mas_branch.BranchNameTH,
case when  uac_customer.CustomerType=1 then 1 else 0 end as CustomerType,uac_customer.CustomerID,
uac_customer.FirstName+' '+uac_customer.LastName as CustomerName,uac_customer.TelephoneNo,count(ops_order.OrderNo) as counts,
((sum(Amount)+sum((Amount)*coalesce(ExpressRate,0))/100)+sum(coalesce(ops_orderdetail.AdditionAmount,0)))-sum(coalesce(ops_orderdetail.DiscountAmount,0)) as total,
MAX(OrderDate) as dates
from (((ops_order left join uac_customer on ops_order.CustomerID=uac_customer.CustomerID)
left join (mas_branch left join mas_branchtype on mas_branch.BranchType=mas_branchtype.BranchTypeID) ON ops_order.BranchID=mas_branch.BranchID)
left join ops_orderdetail on ops_order.OrderNo=ops_orderdetail.OrderNo)
left join mas_priceexpression on ops_order.IsExpressLevel=mas_priceexpression.IsExpressLevel
WHERE ops_order.OrderDate BETWEEN '".$date_start."' AND '".$date_end."' AND ops_order.IsActive='1'
AND mas_branch.BranchType = '".$keywords."'
GROUP BY uac_customer.CustomerID,uac_customer.FirstName,uac_customer.LastName,uac_customer.TelephoneNo,mas_branch.BranchNameTH,uac_customer.CustomerType
Order By total DESC";

$stmt1="select top 20 count(ops_order.OrderNo) as nums,ops_order.CustomerID,sum(PromoDiscount) as PromoDiscount,sum(ops_order.IsExpress)as counts, coalesce(sum(SpecialDiscount),0) as SpecialDiscount,sum(MemberDiscount) as MemberDiscount
from (ops_order
left join (mas_branch left join mas_branchtype on mas_branch.BranchID=mas_branchtype.BranchTypeID)
on ops_order.BranchID=mas_branch.BranchID) left join (SELECT distinct od.OrderNo,Sum(Amount) as Amount from ops_order od left join ops_orderdetail odd on od.OrderNo=odd.OrderNo group by od.OrderNo) As cases on ops_order.OrderNo=cases.OrderNo
WHERE ops_order.OrderDate BETWEEN '".$date_start."' AND '".$date_end."' AND ops_order.IsActive='1'
AND mas_branch.BranchType = '".$keywords."'
GROUP BY ops_order.CustomerID,ops_order.BranchID
Order By SUM(cases.Amount) DESC";
				}
				}
				else if($_GET['select_top']==30){
				if($_GET['keywords2']=='cheese'&&$_GET['keywords']=='cheese'){
				$stmt="select distinct top 30 ROW_NUMBER() OVER(ORDER BY uac_customer.CustomerID ASC) AS Row ,mas_branch.BranchNameTH,
case when  uac_customer.CustomerType=1 then 1 else 0 end as CustomerType,uac_customer.CustomerID,
uac_customer.FirstName+' '+uac_customer.LastName as CustomerName,uac_customer.TelephoneNo,count(ops_order.OrderNo) as counts,
((sum(Amount)+sum((Amount)*coalesce(ExpressRate,0))/100)+sum(coalesce(ops_orderdetail.AdditionAmount,0)))-sum(coalesce(ops_orderdetail.DiscountAmount,0)) as total,
MAX(OrderDate) as dates
from (((ops_order left join uac_customer on ops_order.CustomerID=uac_customer.CustomerID)
left join (mas_branch left join mas_branchtype on mas_branch.BranchType=mas_branchtype.BranchTypeID) ON ops_order.BranchID=mas_branch.BranchID)
left join ops_orderdetail on ops_order.OrderNo=ops_orderdetail.OrderNo)
left join mas_priceexpression on ops_order.IsExpressLevel=mas_priceexpression.IsExpressLevel
WHERE ops_order.OrderDate BETWEEN '".$date_start."' AND '".$date_end."' AND ops_order.IsActive='1'
GROUP BY uac_customer.CustomerID,uac_customer.FirstName,uac_customer.LastName,uac_customer.TelephoneNo,mas_branch.BranchNameTH,uac_customer.CustomerType
Order By total DESC";

$stmt1="select top 30 count(ops_order.OrderNo) as nums,ops_order.CustomerID,sum(PromoDiscount) as PromoDiscount,sum(ops_order.IsExpress)as counts, coalesce(sum(SpecialDiscount),0) as SpecialDiscount,sum(MemberDiscount) as MemberDiscount
from (ops_order
left join (mas_branch left join mas_branchtype on mas_branch.BranchID=mas_branchtype.BranchTypeID)
on ops_order.BranchID=mas_branch.BranchID) left join (SELECT distinct od.OrderNo,Sum(Amount) as Amount from ops_order od left join ops_orderdetail odd on od.OrderNo=odd.OrderNo group by od.OrderNo) As cases on ops_order.OrderNo=cases.OrderNo
WHERE ops_order.OrderDate BETWEEN '".$date_start."' AND '".$date_end."' AND ops_order.IsActive='1'
GROUP BY ops_order.CustomerID,ops_order.BranchID
Order By SUM(cases.Amount) DESC";
				}else if($_GET['keywords2']!='cheese'&&$_GET['keywords']=='cheese'){
						$stmt="select distinct top 30 ROW_NUMBER() OVER(ORDER BY uac_customer.CustomerID ASC) AS Row ,mas_branch.BranchNameTH,
case when  uac_customer.CustomerType=1 then 1 else 0 end as CustomerType,uac_customer.CustomerID,
uac_customer.FirstName+' '+uac_customer.LastName as CustomerName,uac_customer.TelephoneNo,count(ops_order.OrderNo) as counts,
((sum(Amount)+sum((Amount)*coalesce(ExpressRate,0))/100)+sum(coalesce(ops_orderdetail.AdditionAmount,0)))-sum(coalesce(ops_orderdetail.DiscountAmount,0)) as total,
MAX(OrderDate) as dates
from (((ops_order left join uac_customer on ops_order.CustomerID=uac_customer.CustomerID)
left join (mas_branch left join mas_branchtype on mas_branch.BranchType=mas_branchtype.BranchTypeID) ON ops_order.BranchID=mas_branch.BranchID)
left join ops_orderdetail on ops_order.OrderNo=ops_orderdetail.OrderNo)
left join mas_priceexpression on ops_order.IsExpressLevel=mas_priceexpression.IsExpressLevel
WHERE ops_order.OrderDate BETWEEN '".$date_start."' AND '".$date_end."' AND ops_order.IsActive='1'
AND mas_branch.BranchID = '".$keywords2."'
GROUP BY uac_customer.CustomerID,uac_customer.FirstName,uac_customer.LastName,uac_customer.TelephoneNo,mas_branch.BranchNameTH,uac_customer.CustomerType
Order By total DESC";

$stmt1="select top 30 count(ops_order.OrderNo) as nums,ops_order.CustomerID,sum(PromoDiscount) as PromoDiscount,sum(ops_order.IsExpress)as counts, coalesce(sum(SpecialDiscount),0) as SpecialDiscount,sum(MemberDiscount) as MemberDiscount
from (ops_order
left join (mas_branch left join mas_branchtype on mas_branch.BranchID=mas_branchtype.BranchTypeID)
on ops_order.BranchID=mas_branch.BranchID) left join (SELECT distinct od.OrderNo,Sum(Amount) as Amount from ops_order od left join ops_orderdetail odd on od.OrderNo=odd.OrderNo group by od.OrderNo) As cases on ops_order.OrderNo=cases.OrderNo
WHERE ops_order.OrderDate BETWEEN '".$date_start."' AND '".$date_end."' AND ops_order.IsActive='1'
AND mas_branch.BranchID = '".$keywords2."'
GROUP BY ops_order.CustomerID,ops_order.BranchID
Order By SUM(cases.Amount) DESC";
						}
						else{
					$stmt="select distinct top 30 ROW_NUMBER() OVER(ORDER BY uac_customer.CustomerID ASC) AS Row ,mas_branch.BranchNameTH,
case when  uac_customer.CustomerType=1 then 1 else 0 end as CustomerType,uac_customer.CustomerID,
uac_customer.FirstName+' '+uac_customer.LastName as CustomerName,uac_customer.TelephoneNo,count(ops_order.OrderNo) as counts,
((sum(Amount)+sum((Amount)*coalesce(ExpressRate,0))/100)+sum(coalesce(ops_orderdetail.AdditionAmount,0)))-sum(coalesce(ops_orderdetail.DiscountAmount,0)) as total,
MAX(OrderDate) as dates
from (((ops_order left join uac_customer on ops_order.CustomerID=uac_customer.CustomerID)
left join (mas_branch left join mas_branchtype on mas_branch.BranchType=mas_branchtype.BranchTypeID) ON ops_order.BranchID=mas_branch.BranchID)
left join ops_orderdetail on ops_order.OrderNo=ops_orderdetail.OrderNo)
left join mas_priceexpression on ops_order.IsExpressLevel=mas_priceexpression.IsExpressLevel
WHERE ops_order.OrderDate BETWEEN '".$date_start."' AND '".$date_end."' AND ops_order.IsActive='1'
AND mas_branch.BranchType = '".$keywords."'
GROUP BY uac_customer.CustomerID,uac_customer.FirstName,uac_customer.LastName,uac_customer.TelephoneNo,mas_branch.BranchNameTH,uac_customer.CustomerType
Order By total DESC";

$stmt1="select top 30 count(ops_order.OrderNo) as nums,ops_order.CustomerID,sum(PromoDiscount) as PromoDiscount,sum(ops_order.IsExpress)as counts, coalesce(sum(SpecialDiscount),0) as SpecialDiscount,sum(MemberDiscount) as MemberDiscount
from (ops_order
left join (mas_branch left join mas_branchtype on mas_branch.BranchID=mas_branchtype.BranchTypeID)
on ops_order.BranchID=mas_branch.BranchID) left join (SELECT distinct od.OrderNo,Sum(Amount) as Amount from ops_order od left join ops_orderdetail odd on od.OrderNo=odd.OrderNo group by od.OrderNo) As cases on ops_order.OrderNo=cases.OrderNo
WHERE ops_order.OrderDate BETWEEN '".$date_start."' AND '".$date_end."' AND ops_order.IsActive='1'
AND mas_branch.BranchType = '".$keywords."'
GROUP BY ops_order.CustomerID,ops_order.BranchID
Order By SUM(cases.Amount) DESC";
				}
				}
				else if($_GET['select_top']==100){
				if($_GET['keywords2']=='cheese'||$_GET['keywords']=='cheese'){
				$stmt="select distinct ROW_NUMBER() OVER(ORDER BY uac_customer.CustomerID ASC) AS Row ,mas_branch.BranchNameTH,
case when  uac_customer.CustomerType=1 then 1 else 0 end as CustomerType,uac_customer.CustomerID,
uac_customer.FirstName+' '+uac_customer.LastName as CustomerName,uac_customer.TelephoneNo,count(ops_order.OrderNo) as counts,
((sum(Amount)+sum((Amount)*coalesce(ExpressRate,0))/100)+sum(coalesce(ops_orderdetail.AdditionAmount,0)))-sum(coalesce(ops_orderdetail.DiscountAmount,0)) as total,
MAX(OrderDate) as dates
from (((ops_order left join uac_customer on ops_order.CustomerID=uac_customer.CustomerID)
left join (mas_branch left join mas_branchtype on mas_branch.BranchType=mas_branchtype.BranchTypeID) ON ops_order.BranchID=mas_branch.BranchID)
left join ops_orderdetail on ops_order.OrderNo=ops_orderdetail.OrderNo)
left join mas_priceexpression on ops_order.IsExpressLevel=mas_priceexpression.IsExpressLevel
WHERE ops_order.OrderDate BETWEEN '".$date_start."' AND '".$date_end."' AND ops_order.IsActive='1'
GROUP BY uac_customer.CustomerID,uac_customer.FirstName,uac_customer.LastName,uac_customer.TelephoneNo,mas_branch.BranchNameTH,uac_customer.CustomerType
Order By total DESC";

$stmt1="select count(ops_order.OrderNo) as nums,ops_order.CustomerID,sum(PromoDiscount) as PromoDiscount,sum(ops_order.IsExpress)as counts, coalesce(sum(SpecialDiscount),0) as SpecialDiscount,sum(MemberDiscount) as MemberDiscount
from (ops_order
left join (mas_branch left join mas_branchtype on mas_branch.BranchID=mas_branchtype.BranchTypeID)
on ops_order.BranchID=mas_branch.BranchID) left join (SELECT distinct od.OrderNo,Sum(Amount) as Amount from ops_order od left join ops_orderdetail odd on od.OrderNo=odd.OrderNo group by od.OrderNo) As cases on ops_order.OrderNo=cases.OrderNo
WHERE ops_order.OrderDate BETWEEN '".$date_start."' AND '".$date_end."' AND ops_order.IsActive='1'
GROUP BY ops_order.CustomerID,ops_order.BranchID
Order By SUM(cases.Amount) DESC";
				}else if($_GET['keywords2']!='cheese'&&$_GET['keywords']=='cheese'){
						$stmt="select distinct ROW_NUMBER() OVER(ORDER BY uac_customer.CustomerID ASC) AS Row ,mas_branch.BranchNameTH,
case when  uac_customer.CustomerType=1 then 1 else 0 end as CustomerType,uac_customer.CustomerID,
uac_customer.FirstName+' '+uac_customer.LastName as CustomerName,uac_customer.TelephoneNo,count(ops_order.OrderNo) as counts,
((sum(Amount)+sum((Amount)*coalesce(ExpressRate,0))/100)+sum(coalesce(ops_orderdetail.AdditionAmount,0)))-sum(coalesce(ops_orderdetail.DiscountAmount,0)) as total,
MAX(OrderDate) as dates
from (((ops_order left join uac_customer on ops_order.CustomerID=uac_customer.CustomerID)
left join (mas_branch left join mas_branchtype on mas_branch.BranchType=mas_branchtype.BranchTypeID) ON ops_order.BranchID=mas_branch.BranchID)
left join ops_orderdetail on ops_order.OrderNo=ops_orderdetail.OrderNo)
left join mas_priceexpression on ops_order.IsExpressLevel=mas_priceexpression.IsExpressLevel
WHERE ops_order.OrderDate BETWEEN '".$date_start."' AND '".$date_end."' AND ops_order.IsActive='1'
AND mas_branch.BranchID = '".$keywords2."'
GROUP BY uac_customer.CustomerID,uac_customer.FirstName,uac_customer.LastName,uac_customer.TelephoneNo,mas_branch.BranchNameTH,uac_customer.CustomerType
Order By total DESC";

$stmt1="select count(ops_order.OrderNo) as nums,ops_order.CustomerID,sum(PromoDiscount) as PromoDiscount,sum(ops_order.IsExpress)as counts, coalesce(sum(SpecialDiscount),0) as SpecialDiscount,sum(MemberDiscount) as MemberDiscount
from (ops_order
left join (mas_branch left join mas_branchtype on mas_branch.BranchID=mas_branchtype.BranchTypeID)
on ops_order.BranchID=mas_branch.BranchID) left join (SELECT distinct od.OrderNo,Sum(Amount) as Amount from ops_order od left join ops_orderdetail odd on od.OrderNo=odd.OrderNo group by od.OrderNo) As cases on ops_order.OrderNo=cases.OrderNo
WHERE ops_order.OrderDate BETWEEN '".$date_start."' AND '".$date_end."' AND ops_order.IsActive='1'
AND mas_branch.BranchID = '".$keywords2."'
GROUP BY ops_order.CustomerID,ops_order.BranchID
Order By SUM(cases.Amount) DESC";
						}
						else{
					$stmt="select distinct ROW_NUMBER() OVER(ORDER BY uac_customer.CustomerID ASC) AS Row ,mas_branch.BranchNameTH,
case when  uac_customer.CustomerType=1 then 1 else 0 end as CustomerType,uac_customer.CustomerID,
uac_customer.FirstName+' '+uac_customer.LastName as CustomerName,uac_customer.TelephoneNo,count(ops_order.OrderNo) as counts,
((sum(Amount)+sum((Amount)*coalesce(ExpressRate,0))/100)+sum(coalesce(ops_orderdetail.AdditionAmount,0)))-sum(coalesce(ops_orderdetail.DiscountAmount,0)) as total,
MAX(OrderDate) as dates
from (((ops_order left join uac_customer on ops_order.CustomerID=uac_customer.CustomerID)
left join (mas_branch left join mas_branchtype on mas_branch.BranchType=mas_branchtype.BranchTypeID) ON ops_order.BranchID=mas_branch.BranchID)
left join ops_orderdetail on ops_order.OrderNo=ops_orderdetail.OrderNo)
left join mas_priceexpression on ops_order.IsExpressLevel=mas_priceexpression.IsExpressLevel
WHERE ops_order.OrderDate BETWEEN '".$date_start."' AND '".$date_end."' AND ops_order.IsActive='1'
AND mas_branch.BranchType = '".$keywords."'
GROUP BY uac_customer.CustomerID,uac_customer.FirstName,uac_customer.LastName,uac_customer.TelephoneNo,mas_branch.BranchNameTH,uac_customer.CustomerType
Order By total DESC";

$stmt1="select count(ops_order.OrderNo) as nums,ops_order.CustomerID,sum(PromoDiscount) as PromoDiscount,sum(ops_order.IsExpress)as counts, coalesce(sum(SpecialDiscount),0) as SpecialDiscount,sum(MemberDiscount) as MemberDiscount
from (ops_order
left join (mas_branch left join mas_branchtype on mas_branch.BranchID=mas_branchtype.BranchTypeID)
on ops_order.BranchID=mas_branch.BranchID) left join (SELECT distinct od.OrderNo,Sum(Amount) as Amount from ops_order od left join ops_orderdetail odd on od.OrderNo=odd.OrderNo group by od.OrderNo) As cases on ops_order.OrderNo=cases.OrderNo
WHERE ops_order.OrderDate BETWEEN '".$date_start."' AND '".$date_end."' AND ops_order.IsActive='1'
AND mas_branch.BranchType = '".$keywords."'
GROUP BY ops_order.CustomerID,ops_order.BranchID
Order By SUM(cases.Amount) DESC";
				}
				}
				else{
				if($_GET['keywords2']=='cheese'&&$_GET['keywords']=='cheese'){
$stmt="select distinct ROW_NUMBER() OVER(ORDER BY uac_customer.CustomerID ASC) AS Row ,mas_branch.BranchNameTH,
case when  uac_customer.CustomerType=1 then 1 else 0 end as CustomerType,uac_customer.CustomerID,
uac_customer.FirstName+' '+uac_customer.LastName as CustomerName,uac_customer.TelephoneNo,count(ops_order.OrderNo) as counts,
((sum(Amount)+sum((Amount)*coalesce(ExpressRate,0))/100)+sum(coalesce(ops_orderdetail.AdditionAmount,0)))-sum(coalesce(ops_orderdetail.DiscountAmount,0)) as total,
MAX(OrderDate) as dates
from (((ops_order left join uac_customer on ops_order.CustomerID=uac_customer.CustomerID)
left join (mas_branch left join mas_branchtype on mas_branch.BranchType=mas_branchtype.BranchTypeID) ON ops_order.BranchID=mas_branch.BranchID)
left join ops_orderdetail on ops_order.OrderNo=ops_orderdetail.OrderNo)
left join mas_priceexpression on ops_order.IsExpressLevel=mas_priceexpression.IsExpressLevel
WHERE ops_order.OrderDate BETWEEN '".$date_start."' AND '".$date_end."' AND ops_order.IsActive='1'
GROUP BY uac_customer.CustomerID,uac_customer.FirstName,uac_customer.LastName,uac_customer.TelephoneNo,mas_branch.BranchNameTH,uac_customer.CustomerType
Order By total DESC";

$stmt1="select count(ops_order.OrderNo) as nums,ops_order.CustomerID,sum(PromoDiscount) as PromoDiscount,sum(ops_order.IsExpress)as counts, coalesce(sum(SpecialDiscount),0) as SpecialDiscount,sum(MemberDiscount) as MemberDiscount
from (ops_order
left join (mas_branch left join mas_branchtype on mas_branch.BranchID=mas_branchtype.BranchTypeID)
on ops_order.BranchID=mas_branch.BranchID) left join (SELECT distinct od.OrderNo,Sum(Amount) as Amount from ops_order od left join ops_orderdetail odd on od.OrderNo=odd.OrderNo group by od.OrderNo) As cases on ops_order.OrderNo=cases.OrderNo
WHERE ops_order.OrderDate BETWEEN '".$date_start."' AND '".$date_end."' AND ops_order.IsActive='1'
GROUP BY ops_order.CustomerID,ops_order.BranchID
Order By SUM(cases.Amount) DESC";

						}else if($_GET['keywords2']!='cheese'&&$_GET['keywords']=='cheese'){
						$stmt="select distinct ROW_NUMBER() OVER(ORDER BY uac_customer.CustomerID ASC) AS Row ,mas_branch.BranchNameTH,
case when  uac_customer.CustomerType=1 then 1 else 0 end as CustomerType,uac_customer.CustomerID,
uac_customer.FirstName+' '+uac_customer.LastName as CustomerName,uac_customer.TelephoneNo,count(ops_order.OrderNo) as counts,
((sum(Amount)+sum((Amount)*coalesce(ExpressRate,0))/100)+sum(coalesce(ops_orderdetail.AdditionAmount,0)))-sum(coalesce(ops_orderdetail.DiscountAmount,0)) as total,
MAX(OrderDate) as dates
from (((ops_order left join uac_customer on ops_order.CustomerID=uac_customer.CustomerID)
left join (mas_branch left join mas_branchtype on mas_branch.BranchType=mas_branchtype.BranchTypeID) ON ops_order.BranchID=mas_branch.BranchID)
left join ops_orderdetail on ops_order.OrderNo=ops_orderdetail.OrderNo)
left join mas_priceexpression on ops_order.IsExpressLevel=mas_priceexpression.IsExpressLevel
WHERE ops_order.OrderDate BETWEEN '".$date_start."' AND '".$date_end."' AND ops_order.IsActive='1'
AND mas_branch.BranchID = '".$keywords2."'
GROUP BY uac_customer.CustomerID,uac_customer.FirstName,uac_customer.LastName,uac_customer.TelephoneNo,mas_branch.BranchNameTH,uac_customer.CustomerType
Order By total DESC";

$stmt1="select count(ops_order.OrderNo) as nums,ops_order.CustomerID,sum(PromoDiscount) as PromoDiscount,sum(ops_order.IsExpress)as counts, coalesce(sum(SpecialDiscount),0) as SpecialDiscount,sum(MemberDiscount) as MemberDiscount
from (ops_order
left join (mas_branch left join mas_branchtype on mas_branch.BranchID=mas_branchtype.BranchTypeID)
on ops_order.BranchID=mas_branch.BranchID) left join (SELECT distinct od.OrderNo,Sum(Amount) as Amount from ops_order od left join ops_orderdetail odd on od.OrderNo=odd.OrderNo group by od.OrderNo) As cases on ops_order.OrderNo=cases.OrderNo
WHERE ops_order.OrderDate BETWEEN '".$date_start."' AND '".$date_end."' AND ops_order.IsActive='1'
AND mas_branch.BranchID = '".$keywords2."'
GROUP BY ops_order.CustomerID,ops_order.BranchID
Order By SUM(cases.Amount) DESC";
						}
						else{
					$stmt="select distinct ROW_NUMBER() OVER(ORDER BY uac_customer.CustomerID ASC) AS Row ,mas_branch.BranchNameTH,
case when  uac_customer.CustomerType=1 then 1 else 0 end as CustomerType,uac_customer.CustomerID,
uac_customer.FirstName+' '+uac_customer.LastName as CustomerName,uac_customer.TelephoneNo,count(ops_order.OrderNo) as counts,
((sum(Amount)+sum((Amount)*coalesce(ExpressRate,0))/100)+sum(coalesce(ops_orderdetail.AdditionAmount,0)))-sum(coalesce(ops_orderdetail.DiscountAmount,0)) as total,
MAX(OrderDate) as dates
from (((ops_order left join uac_customer on ops_order.CustomerID=uac_customer.CustomerID)
left join (mas_branch left join mas_branchtype on mas_branch.BranchType=mas_branchtype.BranchTypeID) ON ops_order.BranchID=mas_branch.BranchID)
left join ops_orderdetail on ops_order.OrderNo=ops_orderdetail.OrderNo)
left join mas_priceexpression on ops_order.IsExpressLevel=mas_priceexpression.IsExpressLevel
WHERE ops_order.OrderDate BETWEEN '".$date_start."' AND '".$date_end."' AND ops_order.IsActive='1'
AND mas_branch.BranchType = '".$keywords."'
GROUP BY uac_customer.CustomerID,uac_customer.FirstName,uac_customer.LastName,uac_customer.TelephoneNo,mas_branch.BranchNameTH,uac_customer.CustomerType
Order By total DESC";

$stmt1="select count(ops_order.OrderNo) as nums,ops_order.CustomerID,sum(PromoDiscount) as PromoDiscount,sum(ops_order.IsExpress)as counts, coalesce(sum(SpecialDiscount),0) as SpecialDiscount,sum(MemberDiscount) as MemberDiscount
from (ops_order
left join (mas_branch left join mas_branchtype on mas_branch.BranchID=mas_branchtype.BranchTypeID)
on ops_order.BranchID=mas_branch.BranchID) left join (SELECT distinct od.OrderNo,Sum(Amount) as Amount from ops_order od left join ops_orderdetail odd on od.OrderNo=odd.OrderNo group by od.OrderNo) As cases on ops_order.OrderNo=cases.OrderNo
WHERE ops_order.OrderDate BETWEEN '".$date_start."' AND '".$date_end."' AND ops_order.IsActive='1'
AND mas_branch.BranchType = '".$keywords."'
GROUP BY ops_order.CustomerID,ops_order.BranchID
Order By SUM(cases.Amount) DESC";
				}
				}


				//branch
				}else{

				if($_GET['select_top']==10){
					if($_GET['keywords2']=='cheese'&&$_GET['keywords']=='cheese'){
				$stmt="select distinct top 10 ROW_NUMBER() OVER(ORDER BY uac_customer.CustomerID ASC) AS Row ,mas_branch.BranchNameTH,
case when  uac_customer.CustomerType=1 then 1 else 0 end as CustomerType,uac_customer.CustomerID,
uac_customer.FirstName+' '+uac_customer.LastName as CustomerName,uac_customer.TelephoneNo,count(ops_order.OrderNo) as counts,
((sum(Amount)+sum((Amount)*coalesce(ExpressRate,0))/100)+sum(coalesce(ops_orderdetail.AdditionAmount,0)))-sum(coalesce(ops_orderdetail.DiscountAmount,0)) as total,
MAX(OrderDate) as dates
from (((ops_order left join uac_customer on ops_order.CustomerID=uac_customer.CustomerID)
left join (mas_branch left join mas_branchtype on mas_branch.BranchType=mas_branchtype.BranchTypeID) ON ops_order.BranchID=mas_branch.BranchID)
left join ops_orderdetail on ops_order.OrderNo=ops_orderdetail.OrderNo)
left join mas_priceexpression on ops_order.IsExpressLevel=mas_priceexpression.IsExpressLevel
WHERE ops_order.OrderDate BETWEEN '".$date_start."' AND '".$date_end."' AND ops_order.IsActive='1'
 AND mas_branch.BranchID='".$session."'
GROUP BY uac_customer.CustomerID,uac_customer.FirstName,uac_customer.LastName,uac_customer.TelephoneNo,mas_branch.BranchNameTH,uac_customer.CustomerType
Order By total DESC";

$stmt1="select top 10 count(ops_order.OrderNo) as nums,ops_order.CustomerID,sum(PromoDiscount) as PromoDiscount,sum(ops_order.IsExpress)as counts, coalesce(sum(SpecialDiscount),0) as SpecialDiscount,sum(MemberDiscount) as MemberDiscount
from (ops_order
left join (mas_branch left join mas_branchtype on mas_branch.BranchID=mas_branchtype.BranchTypeID)
on ops_order.BranchID=mas_branch.BranchID) left join (SELECT distinct od.OrderNo,Sum(Amount) as Amount from ops_order od left join ops_orderdetail odd on od.OrderNo=odd.OrderNo group by od.OrderNo) As cases on ops_order.OrderNo=cases.OrderNo
WHERE ops_order.OrderDate BETWEEN '".$date_start."' AND '".$date_end."' AND ops_order.IsActive='1'
AND mas_branch.BranchID='".$session."'
GROUP BY ops_order.CustomerID,ops_order.BranchID
Order By SUM(cases.Amount) DESC";
				}
				}
				else if($_GET['select_top']==20){
				if($_GET['keywords2']=='cheese'&&$_GET['keywords']=='cheese'){
				$stmt="select distinct top 20 ROW_NUMBER() OVER(ORDER BY uac_customer.CustomerID ASC) AS Row ,mas_branch.BranchNameTH,
case when  uac_customer.CustomerType=1 then 1 else 0 end as CustomerType,uac_customer.CustomerID,
uac_customer.FirstName+' '+uac_customer.LastName as CustomerName,uac_customer.TelephoneNo,count(ops_order.OrderNo) as counts,
((sum(Amount)+sum((Amount)*coalesce(ExpressRate,0))/100)+sum(coalesce(ops_orderdetail.AdditionAmount,0)))-sum(coalesce(ops_orderdetail.DiscountAmount,0)) as total,
MAX(OrderDate) as dates
from (((ops_order left join uac_customer on ops_order.CustomerID=uac_customer.CustomerID)
left join (mas_branch left join mas_branchtype on mas_branch.BranchType=mas_branchtype.BranchTypeID) ON ops_order.BranchID=mas_branch.BranchID)
left join ops_orderdetail on ops_order.OrderNo=ops_orderdetail.OrderNo)
left join mas_priceexpression on ops_order.IsExpressLevel=mas_priceexpression.IsExpressLevel
WHERE ops_order.OrderDate BETWEEN '".$date_start."' AND '".$date_end."' AND ops_order.IsActive='1'
 AND mas_branch.BranchID='".$session."'
GROUP BY uac_customer.CustomerID,uac_customer.FirstName,uac_customer.LastName,uac_customer.TelephoneNo,mas_branch.BranchNameTH,uac_customer.CustomerType
Order By total DESC";

$stmt1="select top 20 count(ops_order.OrderNo) as nums,ops_order.CustomerID,sum(PromoDiscount) as PromoDiscount,sum(ops_order.IsExpress)as counts, coalesce(sum(SpecialDiscount),0) as SpecialDiscount,sum(MemberDiscount) as MemberDiscount
from (ops_order
left join (mas_branch left join mas_branchtype on mas_branch.BranchID=mas_branchtype.BranchTypeID)
on ops_order.BranchID=mas_branch.BranchID) left join (SELECT distinct od.OrderNo,Sum(Amount) as Amount from ops_order od left join ops_orderdetail odd on od.OrderNo=odd.OrderNo group by od.OrderNo) As cases on ops_order.OrderNo=cases.OrderNo
WHERE ops_order.OrderDate BETWEEN '".$date_start."' AND '".$date_end."' AND ops_order.IsActive='1'
AND mas_branch.BranchID='".$session."'
GROUP BY ops_order.CustomerID,ops_order.BranchID
Order By SUM(cases.Amount) DESC";
				}
				}
				else if($_GET['select_top']==30){
				if($_GET['keywords2']=='cheese'&&$_GET['keywords']=='cheese'){
				$stmt="select distinct top 30 ROW_NUMBER() OVER(ORDER BY uac_customer.CustomerID ASC) AS Row ,mas_branch.BranchNameTH,
case when  uac_customer.CustomerType=1 then 1 else 0 end as CustomerType,uac_customer.CustomerID,
uac_customer.FirstName+' '+uac_customer.LastName as CustomerName,uac_customer.TelephoneNo,count(ops_order.OrderNo) as counts,
((sum(Amount)+sum((Amount)*coalesce(ExpressRate,0))/100)+sum(coalesce(ops_orderdetail.AdditionAmount,0)))-sum(coalesce(ops_orderdetail.DiscountAmount,0)) as total,
MAX(OrderDate) as dates
from (((ops_order left join uac_customer on ops_order.CustomerID=uac_customer.CustomerID)
left join (mas_branch left join mas_branchtype on mas_branch.BranchType=mas_branchtype.BranchTypeID) ON ops_order.BranchID=mas_branch.BranchID)
left join ops_orderdetail on ops_order.OrderNo=ops_orderdetail.OrderNo)
left join mas_priceexpression on ops_order.IsExpressLevel=mas_priceexpression.IsExpressLevel
WHERE ops_order.OrderDate BETWEEN '".$date_start."' AND '".$date_end."' AND ops_order.IsActive='1'
 AND mas_branch.BranchID='".$session."'
GROUP BY uac_customer.CustomerID,uac_customer.FirstName,uac_customer.LastName,uac_customer.TelephoneNo,mas_branch.BranchNameTH,uac_customer.CustomerType
Order By total DESC";

$stmt1="select top 30 count(ops_order.OrderNo) as nums,ops_order.CustomerID,sum(PromoDiscount) as PromoDiscount,sum(ops_order.IsExpress)as counts, coalesce(sum(SpecialDiscount),0) as SpecialDiscount,sum(MemberDiscount) as MemberDiscount
from (ops_order
left join (mas_branch left join mas_branchtype on mas_branch.BranchID=mas_branchtype.BranchTypeID)
on ops_order.BranchID=mas_branch.BranchID) left join (SELECT distinct od.OrderNo,Sum(Amount) as Amount from ops_order od left join ops_orderdetail odd on od.OrderNo=odd.OrderNo group by od.OrderNo) As cases on ops_order.OrderNo=cases.OrderNo
WHERE ops_order.OrderDate BETWEEN '".$date_start."' AND '".$date_end."' AND ops_order.IsActive='1'
AND mas_branch.BranchID='".$session."'
GROUP BY ops_order.CustomerID,ops_order.BranchID
Order By SUM(cases.Amount) DESC";
				}
				}
				else if($_GET['select_top']==100){
				if($_GET['keywords2']=='cheese'||$_GET['keywords']=='cheese'){
				$stmt="select distinct ROW_NUMBER() OVER(ORDER BY uac_customer.CustomerID ASC) AS Row ,mas_branch.BranchNameTH,
case when  uac_customer.CustomerType=1 then 1 else 0 end as CustomerType,uac_customer.CustomerID,
uac_customer.FirstName+' '+uac_customer.LastName as CustomerName,uac_customer.TelephoneNo,count(ops_order.OrderNo) as counts,
((sum(Amount)+sum((Amount)*coalesce(ExpressRate,0))/100)+sum(coalesce(ops_orderdetail.AdditionAmount,0)))-sum(coalesce(ops_orderdetail.DiscountAmount,0)) as total,
MAX(OrderDate) as dates
from (((ops_order left join uac_customer on ops_order.CustomerID=uac_customer.CustomerID)
left join (mas_branch left join mas_branchtype on mas_branch.BranchType=mas_branchtype.BranchTypeID) ON ops_order.BranchID=mas_branch.BranchID)
left join ops_orderdetail on ops_order.OrderNo=ops_orderdetail.OrderNo)
left join mas_priceexpression on ops_order.IsExpressLevel=mas_priceexpression.IsExpressLevel
WHERE ops_order.OrderDate BETWEEN '".$date_start."' AND '".$date_end."' AND ops_order.IsActive='1'
 AND mas_branch.BranchID='".$session."'
GROUP BY uac_customer.CustomerID,uac_customer.FirstName,uac_customer.LastName,uac_customer.TelephoneNo,mas_branch.BranchNameTH,uac_customer.CustomerType
Order By total DESC";

$stmt1="select count(ops_order.OrderNo) as nums,ops_order.CustomerID,sum(PromoDiscount) as PromoDiscount,sum(ops_order.IsExpress)as counts, coalesce(sum(SpecialDiscount),0) as SpecialDiscount,sum(MemberDiscount) as MemberDiscount
from (ops_order
left join (mas_branch left join mas_branchtype on mas_branch.BranchID=mas_branchtype.BranchTypeID)
on ops_order.BranchID=mas_branch.BranchID) left join (SELECT distinct od.OrderNo,Sum(Amount) as Amount from ops_order od left join ops_orderdetail odd on od.OrderNo=odd.OrderNo group by od.OrderNo) As cases on ops_order.OrderNo=cases.OrderNo
WHERE ops_order.OrderDate BETWEEN '".$date_start."' AND '".$date_end."' AND ops_order.IsActive='1'
AND mas_branch.BranchID='".$session."'
GROUP BY ops_order.CustomerID,ops_order.BranchID
Order By SUM(cases.Amount) DESC";
				}
				}
				else{
				if($_GET['keywords2']=='cheese'&&$_GET['keywords']=='cheese'){
$stmt="select distinct ROW_NUMBER() OVER(ORDER BY uac_customer.CustomerID ASC) AS Row ,mas_branch.BranchNameTH,
case when  uac_customer.CustomerType=1 then 1 else 0 end as CustomerType,uac_customer.CustomerID,
uac_customer.FirstName+' '+uac_customer.LastName as CustomerName,uac_customer.TelephoneNo,count(ops_order.OrderNo) as counts,
((sum(Amount)+sum((Amount)*coalesce(ExpressRate,0))/100)+sum(coalesce(ops_orderdetail.AdditionAmount,0)))-sum(coalesce(ops_orderdetail.DiscountAmount,0)) as total,
MAX(OrderDate) as dates
from (((ops_order left join uac_customer on ops_order.CustomerID=uac_customer.CustomerID)
left join (mas_branch left join mas_branchtype on mas_branch.BranchType=mas_branchtype.BranchTypeID) ON ops_order.BranchID=mas_branch.BranchID)
left join ops_orderdetail on ops_order.OrderNo=ops_orderdetail.OrderNo)
left join mas_priceexpression on ops_order.IsExpressLevel=mas_priceexpression.IsExpressLevel
WHERE ops_order.OrderDate BETWEEN '".$date_start."' AND '".$date_end."' AND ops_order.IsActive='1'
 AND mas_branch.BranchID='".$session."'
GROUP BY uac_customer.CustomerID,uac_customer.FirstName,uac_customer.LastName,uac_customer.TelephoneNo,mas_branch.BranchNameTH,uac_customer.CustomerType
Order By total DESC";

$stmt1="select count(ops_order.OrderNo) as nums,ops_order.CustomerID,sum(PromoDiscount) as PromoDiscount,sum(ops_order.IsExpress)as counts, coalesce(sum(SpecialDiscount),0) as SpecialDiscount,sum(MemberDiscount) as MemberDiscount
from (ops_order
left join (mas_branch left join mas_branchtype on mas_branch.BranchID=mas_branchtype.BranchTypeID)
on ops_order.BranchID=mas_branch.BranchID) left join (SELECT distinct od.OrderNo,Sum(Amount) as Amount from ops_order od left join ops_orderdetail odd on od.OrderNo=odd.OrderNo group by od.OrderNo) As cases on ops_order.OrderNo=cases.OrderNo
WHERE ops_order.OrderDate BETWEEN '".$date_start."' AND '".$date_end."' AND ops_order.IsActive='1'
AND mas_branch.BranchID='".$session."'
GROUP BY ops_order.CustomerID,ops_order.BranchID
Order By SUM(cases.Amount) DESC";

				}
				}
				}
				$query = sqlsrv_query($conn,$stmt);
				$query1 = sqlsrv_query($conn,$stmt1);
   				$object_array = array();
				
   				$arrCustomerName=array();
				$arrPhone=array();
				$arrCustomerType=array();
				$arrCount=array();
				$arrCount1=array();
				$arrTotal=array();
				$arrDate=array();
				$arrNums=array();
				$arrSpecail=array();
				$arrMember=array();
				while($row = sqlsrv_fetch_array($query)){
					array_push($arrCustomerName,$row['CustomerName']);
					array_push($arrPhone,$row['TelephoneNo']);
					array_push($arrCustomerType,$row['CustomerType']);
					array_push($arrCount,$row['counts']);
					array_push($arrTotal,$row['total']);
					array_push($arrDate,$row['dates']);
				}
				$arrPromo=array();
				while($row1 = sqlsrv_fetch_array($query1)){
					array_push($arrPromo,$row1['PromoDiscount']);
					array_push($arrCount1,$row1['counts']);
					array_push($arrNums,$row1['nums']);
					array_push($arrSpecail,$row1['SpecialDiscount']);
					array_push($arrMember,$row1['MemberDiscount']);
				}
				for($i=0;$i<count($arrPromo);$i++){
					array_push($object_array,array('CustomerName' => $arrCustomerName[$i], 'TelephoneNo' => $arrPhone[$i]
		,'CustomerType' => $arrCustomerType[$i],'counts' => $arrCount[$i],'total' => $arrTotal[$i]-$arrPromo[$i]-$arrMember[$i]
		,'SpecialDiscount' => $arrSpecail[$i],'total1' => $arrTotal[$i]-$arrPromo[$i]-$arrSpecail[$i]-$arrMember[$i],'dates' => $arrDate[$i]));
				}
	
    $json_array=json_encode($object_array);
	echo $json_array;
?>
