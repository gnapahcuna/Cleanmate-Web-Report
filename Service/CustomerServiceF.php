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
					if($_GET['keywords2']=='cheese'||$_GET['keywords']=='cheese'){
					$stmt="select distinct top 10 ROW_NUMBER() OVER(ORDER BY uac_customer.CustomerID ASC) AS Row ,mas_branch.BranchNameTH,
case when  uac_customer.CustomerType=1 then 1 else 0 end as CustomerType,
uac_customer.FirstName+' '+uac_customer.LastName as CustomerName,uac_customer.TelephoneNo,
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
coalesce (SUM(CASE WHEN ops_orderdetail.ServiceNameEN = 'Press Only' then 1 else null end),0)+
coalesce (SUM(CASE WHEN ops_orderdetail.ServiceNameEN = 'Other' AND (ops_orderdetail.ProductID=360 OR ops_orderdetail.ProductID=361) then 1 else null end),0)+
coalesce (SUM(CASE WHEN ops_orderdetail.ServiceNameEN = 'Other' AND ops_orderdetail.ProductID=362 then 1 else null end),0)  AS total,MAX(OrderDate) as dates
from ((ops_order left join uac_customer on ops_order.CustomerID=uac_customer.CustomerID)
left join (mas_branch left join mas_branchtype on mas_branch.BranchType=mas_branchtype.BranchTypeID) ON ops_order.BranchID=mas_branch.BranchID)
left join ops_orderdetail on ops_order.OrderNo=ops_orderdetail.OrderNo
WHERE ops_order.OrderDate BETWEEN '".$date_start."' AND '".$date_end."' AND ops_order.IsActive='1'
GROUP BY uac_customer.CustomerID,uac_customer.FirstName,uac_customer.LastName,uac_customer.TelephoneNo,mas_branch.BranchNameTH,uac_customer.CustomerType
Order By MAX(OrderDate)ASC";

						}else{
					$stmt="select distinct top 10 ROW_NUMBER() OVER(ORDER BY uac_customer.CustomerID ASC) AS Row ,mas_branch.BranchNameTH,
case when  uac_customer.CustomerType=1 then 1 else 0 end as CustomerType,
uac_customer.FirstName+' '+uac_customer.LastName as CustomerName,uac_customer.TelephoneNo,
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
coalesce (SUM(CASE WHEN ops_orderdetail.ServiceNameEN = 'Press Only' then 1 else null end),0)+
coalesce (SUM(CASE WHEN ops_orderdetail.ServiceNameEN = 'Other' AND (ops_orderdetail.ProductID=360 OR ops_orderdetail.ProductID=361) then 1 else null end),0)+
coalesce (SUM(CASE WHEN ops_orderdetail.ServiceNameEN = 'Other' AND ops_orderdetail.ProductID=362 then 1 else null end),0)  AS total,MAX(OrderDate) as dates
from ((ops_order left join uac_customer on ops_order.CustomerID=uac_customer.CustomerID)
left join (mas_branch left join mas_branchtype on mas_branch.BranchType=mas_branchtype.BranchTypeID) ON ops_order.BranchID=mas_branch.BranchID)
left join ops_orderdetail on ops_order.OrderNo=ops_orderdetail.OrderNo
WHERE ops_order.OrderDate BETWEEN '".$date_start."' AND '".$date_end."' AND ops_order.IsActive='1'
AND mas_branch.BranchType = '".$keywords."'
GROUP BY uac_customer.CustomerID,uac_customer.FirstName,uac_customer.LastName,uac_customer.TelephoneNo,mas_branch.BranchNameTH,uac_customer.CustomerType
Order By MAX(OrderDate)ASC";
}}
					else if($_GET['select_top']==20){
					if($_GET['keywords2']=='cheese'||$_GET['keywords']=='cheese'){
					$stmt="select distinct top 20 ROW_NUMBER() OVER(ORDER BY uac_customer.CustomerID ASC) AS Row ,mas_branch.BranchNameTH,
case when  uac_customer.CustomerType=1 then 1 else 0 end as CustomerType,
uac_customer.FirstName+' '+uac_customer.LastName as CustomerName,uac_customer.TelephoneNo,
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
coalesce (SUM(CASE WHEN ops_orderdetail.ServiceNameEN = 'Press Only' then 1 else null end),0)+
coalesce (SUM(CASE WHEN ops_orderdetail.ServiceNameEN = 'Other' AND (ops_orderdetail.ProductID=360 OR ops_orderdetail.ProductID=361) then 1 else null end),0)+
coalesce (SUM(CASE WHEN ops_orderdetail.ServiceNameEN = 'Other' AND ops_orderdetail.ProductID=362 then 1 else null end),0)  AS total,MAX(OrderDate) as dates
from ((ops_order left join uac_customer on ops_order.CustomerID=uac_customer.CustomerID)
left join (mas_branch left join mas_branchtype on mas_branch.BranchType=mas_branchtype.BranchTypeID) ON ops_order.BranchID=mas_branch.BranchID)
left join ops_orderdetail on ops_order.OrderNo=ops_orderdetail.OrderNo
WHERE ops_order.OrderDate BETWEEN '".$date_start."' AND '".$date_end."' AND ops_order.IsActive='1'
GROUP BY uac_customer.CustomerID,uac_customer.FirstName,uac_customer.LastName,uac_customer.TelephoneNo,mas_branch.BranchNameTH,uac_customer.CustomerType
Order By MAX(OrderDate)ASC";
						}else{
					$stmt="select distinct top 20 ROW_NUMBER() OVER(ORDER BY uac_customer.CustomerID ASC) AS Row ,mas_branch.BranchNameTH,
case when  uac_customer.CustomerType=1 then 1 else 0 end as CustomerType,
uac_customer.FirstName+' '+uac_customer.LastName as CustomerName,uac_customer.TelephoneNo,
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
coalesce (SUM(CASE WHEN ops_orderdetail.ServiceNameEN = 'Press Only' then 1 else null end),0)+
coalesce (SUM(CASE WHEN ops_orderdetail.ServiceNameEN = 'Other' AND (ops_orderdetail.ProductID=360 OR ops_orderdetail.ProductID=361) then 1 else null end),0)+
coalesce (SUM(CASE WHEN ops_orderdetail.ServiceNameEN = 'Other' AND ops_orderdetail.ProductID=362 then 1 else null end),0)  AS total,MAX(OrderDate) as dates
from ((ops_order left join uac_customer on ops_order.CustomerID=uac_customer.CustomerID)
left join (mas_branch left join mas_branchtype on mas_branch.BranchType=mas_branchtype.BranchTypeID) ON ops_order.BranchID=mas_branch.BranchID)
left join ops_orderdetail on ops_order.OrderNo=ops_orderdetail.OrderNo
WHERE ops_order.OrderDate BETWEEN '".$date_start."' AND '".$date_end."' AND ops_order.IsActive='1'
AND mas_branch.BranchType = '".$keywords."'
GROUP BY uac_customer.CustomerID,uac_customer.FirstName,uac_customer.LastName,uac_customer.TelephoneNo,mas_branch.BranchNameTH,uac_customer.CustomerType
Order By MAX(OrderDate)ASC";
}}
					else if($_GET['select_top']==30){
					if($_GET['keywords2']=='cheese'||$_GET['keywords']=='cheese'){
					$stmt="select distinct top 30 ROW_NUMBER() OVER(ORDER BY uac_customer.CustomerID ASC) AS Row ,mas_branch.BranchNameTH,
case when  uac_customer.CustomerType=1 then 1 else 0 end as CustomerType,
uac_customer.FirstName+' '+uac_customer.LastName as CustomerName,uac_customer.TelephoneNo,
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
coalesce (SUM(CASE WHEN ops_orderdetail.ServiceNameEN = 'Press Only' then 1 else null end),0)+
coalesce (SUM(CASE WHEN ops_orderdetail.ServiceNameEN = 'Other' AND (ops_orderdetail.ProductID=360 OR ops_orderdetail.ProductID=361) then 1 else null end),0)+
coalesce (SUM(CASE WHEN ops_orderdetail.ServiceNameEN = 'Other' AND ops_orderdetail.ProductID=362 then 1 else null end),0)  AS total,MAX(OrderDate) as dates
from ((ops_order left join uac_customer on ops_order.CustomerID=uac_customer.CustomerID)
left join (mas_branch left join mas_branchtype on mas_branch.BranchType=mas_branchtype.BranchTypeID) ON ops_order.BranchID=mas_branch.BranchID)
left join ops_orderdetail on ops_order.OrderNo=ops_orderdetail.OrderNo
WHERE ops_order.OrderDate BETWEEN '".$date_start."' AND '".$date_end."' AND ops_order.IsActive='1'
GROUP BY uac_customer.CustomerID,uac_customer.FirstName,uac_customer.LastName,uac_customer.TelephoneNo,mas_branch.BranchNameTH,uac_customer.CustomerType
Order By MAX(OrderDate)ASC";
						}else{
					$stmt="select distinct top 30 ROW_NUMBER() OVER(ORDER BY uac_customer.CustomerID ASC) AS Row ,mas_branch.BranchNameTH,
case when  uac_customer.CustomerType=1 then 1 else 0 end as CustomerType,
uac_customer.FirstName+' '+uac_customer.LastName as CustomerName,uac_customer.TelephoneNo,
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
coalesce (SUM(CASE WHEN ops_orderdetail.ServiceNameEN = 'Press Only' then 1 else null end),0)+
coalesce (SUM(CASE WHEN ops_orderdetail.ServiceNameEN = 'Other' AND (ops_orderdetail.ProductID=360 OR ops_orderdetail.ProductID=361) then 1 else null end),0)+
coalesce (SUM(CASE WHEN ops_orderdetail.ServiceNameEN = 'Other' AND ops_orderdetail.ProductID=362 then 1 else null end),0)  AS total,MAX(OrderDate) as dates
from ((ops_order left join uac_customer on ops_order.CustomerID=uac_customer.CustomerID)
left join (mas_branch left join mas_branchtype on mas_branch.BranchType=mas_branchtype.BranchTypeID) ON ops_order.BranchID=mas_branch.BranchID)
left join ops_orderdetail on ops_order.OrderNo=ops_orderdetail.OrderNo
WHERE ops_order.OrderDate BETWEEN '".$date_start."' AND '".$date_end."' AND ops_order.IsActive='1'
AND mas_branch.BranchType = '".$keywords."'
GROUP BY uac_customer.CustomerID,uac_customer.FirstName,uac_customer.LastName,uac_customer.TelephoneNo,mas_branch.BranchNameTH,uac_customer.CustomerType
Order By MAX(OrderDate)ASC";
}}
					else if($_GET['select_top']==100){
					if($_GET['keywords2']=='cheese'||$_GET['keywords']=='cheese'){
					$stmt="select distinct ROW_NUMBER() OVER(ORDER BY uac_customer.CustomerID ASC) AS Row ,mas_branch.BranchNameTH,
case when  uac_customer.CustomerType=1 then 1 else 0 end as CustomerType,
uac_customer.FirstName+' '+uac_customer.LastName as CustomerName,uac_customer.TelephoneNo,
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
coalesce (SUM(CASE WHEN ops_orderdetail.ServiceNameEN = 'Press Only' then 1 else null end),0)+
coalesce (SUM(CASE WHEN ops_orderdetail.ServiceNameEN = 'Other' AND (ops_orderdetail.ProductID=360 OR ops_orderdetail.ProductID=361) then 1 else null end),0)+
coalesce (SUM(CASE WHEN ops_orderdetail.ServiceNameEN = 'Other' AND ops_orderdetail.ProductID=362 then 1 else null end),0)  AS total,MAX(OrderDate) as dates
from ((ops_order left join uac_customer on ops_order.CustomerID=uac_customer.CustomerID)
left join (mas_branch left join mas_branchtype on mas_branch.BranchType=mas_branchtype.BranchTypeID) ON ops_order.BranchID=mas_branch.BranchID)
left join ops_orderdetail on ops_order.OrderNo=ops_orderdetail.OrderNo
WHERE ops_order.OrderDate BETWEEN '".$date_start."' AND '".$date_end."' AND ops_order.IsActive='1'
GROUP BY uac_customer.CustomerID,uac_customer.FirstName,uac_customer.LastName,uac_customer.TelephoneNo,mas_branch.BranchNameTH,uac_customer.CustomerType
Order By MAX(OrderDate)ASC";
						}else{
					$stmt="select distinct ROW_NUMBER() OVER(ORDER BY uac_customer.CustomerID ASC) AS Row ,mas_branch.BranchNameTH,
case when  uac_customer.CustomerType=1 then 1 else 0 end as CustomerType,
uac_customer.FirstName+' '+uac_customer.LastName as CustomerName,uac_customer.TelephoneNo,
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
coalesce (SUM(CASE WHEN ops_orderdetail.ServiceNameEN = 'Press Only' then 1 else null end),0)+
coalesce (SUM(CASE WHEN ops_orderdetail.ServiceNameEN = 'Other' AND (ops_orderdetail.ProductID=360 OR ops_orderdetail.ProductID=361) then 1 else null end),0)+
coalesce (SUM(CASE WHEN ops_orderdetail.ServiceNameEN = 'Other' AND ops_orderdetail.ProductID=362 then 1 else null end),0)  AS total,MAX(OrderDate) as dates
from ((ops_order left join uac_customer on ops_order.CustomerID=uac_customer.CustomerID)
left join (mas_branch left join mas_branchtype on mas_branch.BranchType=mas_branchtype.BranchTypeID) ON ops_order.BranchID=mas_branch.BranchID)
left join ops_orderdetail on ops_order.OrderNo=ops_orderdetail.OrderNo
WHERE ops_order.OrderDate BETWEEN '".$date_start."' AND '".$date_end."' AND ops_order.IsActive='1'
AND mas_branch.BranchType = '".$keywords."'
GROUP BY uac_customer.CustomerID,uac_customer.FirstName,uac_customer.LastName,uac_customer.TelephoneNo,mas_branch.BranchNameTH,uac_customer.CustomerType
Order By MAX(OrderDate)ASC";
}}
					else{
					if($_GET['keywords2']=='cheese'&&$_GET['keywords']=='cheese'){
					$stmt="select distinct ROW_NUMBER() OVER(ORDER BY uac_customer.CustomerID ASC) AS Row ,mas_branch.BranchNameTH,
case when  uac_customer.CustomerType=1 then 1 else 0 end as CustomerType,
uac_customer.FirstName+' '+uac_customer.LastName as CustomerName,uac_customer.TelephoneNo,
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
coalesce (SUM(CASE WHEN ops_orderdetail.ServiceNameEN = 'Press Only' then 1 else null end),0)+
coalesce (SUM(CASE WHEN ops_orderdetail.ServiceNameEN = 'Other' AND (ops_orderdetail.ProductID=360 OR ops_orderdetail.ProductID=361) then 1 else null end),0)+
coalesce (SUM(CASE WHEN ops_orderdetail.ServiceNameEN = 'Other' AND ops_orderdetail.ProductID=362 then 1 else null end),0)  AS total,MAX(OrderDate) as dates
from ((ops_order left join uac_customer on ops_order.CustomerID=uac_customer.CustomerID)
left join (mas_branch left join mas_branchtype on mas_branch.BranchType=mas_branchtype.BranchTypeID) ON ops_order.BranchID=mas_branch.BranchID)
left join ops_orderdetail on ops_order.OrderNo=ops_orderdetail.OrderNo
WHERE ops_order.OrderDate BETWEEN '".$date_start."' AND '".$date_end."' AND ops_order.IsActive='1'
GROUP BY uac_customer.CustomerID,uac_customer.FirstName,uac_customer.LastName,uac_customer.TelephoneNo,mas_branch.BranchNameTH,uac_customer.CustomerType
Order By MAX(OrderDate)ASC";
					}else if($_GET['keywords2']!='cheese'&&$_GET['keywords']=='cheese'){
						$stmt="select distinct ROW_NUMBER() OVER(ORDER BY uac_customer.CustomerID ASC) AS Row ,mas_branch.BranchNameTH,
case when  uac_customer.CustomerType=1 then 1 else 0 end as CustomerType,
uac_customer.FirstName+' '+uac_customer.LastName as CustomerName,uac_customer.TelephoneNo,
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
coalesce (SUM(CASE WHEN ops_orderdetail.ServiceNameEN = 'Press Only' then 1 else null end),0)+
coalesce (SUM(CASE WHEN ops_orderdetail.ServiceNameEN = 'Other' AND (ops_orderdetail.ProductID=360 OR ops_orderdetail.ProductID=361) then 1 else null end),0)+
coalesce (SUM(CASE WHEN ops_orderdetail.ServiceNameEN = 'Other' AND ops_orderdetail.ProductID=362 then 1 else null end),0)  AS total,MAX(OrderDate) as dates
from ((ops_order left join uac_customer on ops_order.CustomerID=uac_customer.CustomerID)
left join (mas_branch left join mas_branchtype on mas_branch.BranchType=mas_branchtype.BranchTypeID) ON ops_order.BranchID=mas_branch.BranchID)
left join ops_orderdetail on ops_order.OrderNo=ops_orderdetail.OrderNo
WHERE ops_order.OrderDate BETWEEN '".$date_start."' AND '".$date_end."' AND ops_order.IsActive='1'
AND mas_branch.BranchID= '".$keywords2."'
GROUP BY uac_customer.CustomerID,uac_customer.FirstName,uac_customer.LastName,uac_customer.TelephoneNo,mas_branch.BranchNameTH,uac_customer.CustomerType
Order By MAX(OrderDate)ASC";
						}else{
					$stmt="select distinct ROW_NUMBER() OVER(ORDER BY uac_customer.CustomerID ASC) AS Row ,mas_branch.BranchNameTH,
case when  uac_customer.CustomerType=1 then 1 else 0 end as CustomerType,
uac_customer.FirstName+' '+uac_customer.LastName as CustomerName,uac_customer.TelephoneNo,
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
coalesce (SUM(CASE WHEN ops_orderdetail.ServiceNameEN = 'Press Only' then 1 else null end),0)+
coalesce (SUM(CASE WHEN ops_orderdetail.ServiceNameEN = 'Other' AND (ops_orderdetail.ProductID=360 OR ops_orderdetail.ProductID=361) then 1 else null end),0)+
coalesce (SUM(CASE WHEN ops_orderdetail.ServiceNameEN = 'Other' AND ops_orderdetail.ProductID=362 then 1 else null end),0)  AS total,MAX(OrderDate) as dates
from ((ops_order left join uac_customer on ops_order.CustomerID=uac_customer.CustomerID)
left join (mas_branch left join mas_branchtype on mas_branch.BranchType=mas_branchtype.BranchTypeID) ON ops_order.BranchID=mas_branch.BranchID)
left join ops_orderdetail on ops_order.OrderNo=ops_orderdetail.OrderNo
WHERE ops_order.OrderDate BETWEEN '".$date_start."' AND '".$date_end."' AND ops_order.IsActive='1'
AND mas_branch.BranchType = '".$keywords."'
GROUP BY uac_customer.CustomerID,uac_customer.FirstName,uac_customer.LastName,uac_customer.TelephoneNo,mas_branch.BranchNameTH,uac_customer.CustomerType
Order By MAX(OrderDate)ASC";
}
}

					//branch
					}else{
					if($_GET['select_top']==10){
					if($_GET['keywords2']=='cheese'||$_GET['keywords']=='cheese'){
					$stmt="select distinct top 10 ROW_NUMBER() OVER(ORDER BY uac_customer.CustomerID ASC) AS Row ,mas_branch.BranchNameTH,
case when  uac_customer.CustomerType=1 then 1 else 0 end as CustomerType,
uac_customer.FirstName+' '+uac_customer.LastName as CustomerName,uac_customer.TelephoneNo,
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
coalesce (SUM(CASE WHEN ops_orderdetail.ServiceNameEN = 'Press Only' then 1 else null end),0)+
coalesce (SUM(CASE WHEN ops_orderdetail.ServiceNameEN = 'Other' AND (ops_orderdetail.ProductID=360 OR ops_orderdetail.ProductID=361) then 1 else null end),0)+
coalesce (SUM(CASE WHEN ops_orderdetail.ServiceNameEN = 'Other' AND ops_orderdetail.ProductID=362 then 1 else null end),0)  AS total,MAX(OrderDate) as dates
from ((ops_order left join uac_customer on ops_order.CustomerID=uac_customer.CustomerID)
left join (mas_branch left join mas_branchtype on mas_branch.BranchType=mas_branchtype.BranchTypeID) ON ops_order.BranchID=mas_branch.BranchID)
left join ops_orderdetail on ops_order.OrderNo=ops_orderdetail.OrderNo
WHERE ops_order.OrderDate BETWEEN '".$date_start."' AND '".$date_end."' AND ops_order.IsActive='1'
 AND mas_branch.BranchID='".$session."'
GROUP BY uac_customer.CustomerID,uac_customer.FirstName,uac_customer.LastName,uac_customer.TelephoneNo,mas_branch.BranchNameTH,uac_customer.CustomerType
Order By MAX(OrderDate)ASC";
					}}
					else if($_GET['select_top']==20){
					if($_GET['keywords2']=='cheese'||$_GET['keywords']=='cheese'){
					$stmt="select distinct top 20 ROW_NUMBER() OVER(ORDER BY uac_customer.CustomerID ASC) AS Row ,mas_branch.BranchNameTH,
case when  uac_customer.CustomerType=1 then 1 else 0 end as CustomerType,
uac_customer.FirstName+' '+uac_customer.LastName as CustomerName,uac_customer.TelephoneNo,
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
coalesce (SUM(CASE WHEN ops_orderdetail.ServiceNameEN = 'Press Only' then 1 else null end),0)+
coalesce (SUM(CASE WHEN ops_orderdetail.ServiceNameEN = 'Other' AND (ops_orderdetail.ProductID=360 OR ops_orderdetail.ProductID=361) then 1 else null end),0)+
coalesce (SUM(CASE WHEN ops_orderdetail.ServiceNameEN = 'Other' AND ops_orderdetail.ProductID=362 then 1 else null end),0)  AS total,MAX(OrderDate) as dates
from ((ops_order left join uac_customer on ops_order.CustomerID=uac_customer.CustomerID)
left join (mas_branch left join mas_branchtype on mas_branch.BranchType=mas_branchtype.BranchTypeID) ON ops_order.BranchID=mas_branch.BranchID)
left join ops_orderdetail on ops_order.OrderNo=ops_orderdetail.OrderNo
WHERE ops_order.OrderDate BETWEEN '".$date_start."' AND '".$date_end."' AND ops_order.IsActive='1'
 AND mas_branch.BranchID='".$session."'
GROUP BY uac_customer.CustomerID,uac_customer.FirstName,uac_customer.LastName,uac_customer.TelephoneNo,mas_branch.BranchNameTH,uac_customer.CustomerType
Order By MAX(OrderDate)ASC";
}}
					else if($_GET['select_top']==30){
					if($_GET['keywords2']=='cheese'||$_GET['keywords']=='cheese'){
					$stmt="select distinct top 30 ROW_NUMBER() OVER(ORDER BY uac_customer.CustomerID ASC) AS Row ,mas_branch.BranchNameTH,
case when  uac_customer.CustomerType=1 then 1 else 0 end as CustomerType,
uac_customer.FirstName+' '+uac_customer.LastName as CustomerName,uac_customer.TelephoneNo,
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
coalesce (SUM(CASE WHEN ops_orderdetail.ServiceNameEN = 'Press Only' then 1 else null end),0)+
coalesce (SUM(CASE WHEN ops_orderdetail.ServiceNameEN = 'Other' AND (ops_orderdetail.ProductID=360 OR ops_orderdetail.ProductID=361) then 1 else null end),0)+
coalesce (SUM(CASE WHEN ops_orderdetail.ServiceNameEN = 'Other' AND ops_orderdetail.ProductID=362 then 1 else null end),0)  AS total,MAX(OrderDate) as dates
from ((ops_order left join uac_customer on ops_order.CustomerID=uac_customer.CustomerID)
left join (mas_branch left join mas_branchtype on mas_branch.BranchType=mas_branchtype.BranchTypeID) ON ops_order.BranchID=mas_branch.BranchID)
left join ops_orderdetail on ops_order.OrderNo=ops_orderdetail.OrderNo
WHERE ops_order.OrderDate BETWEEN '".$date_start."' AND '".$date_end."' AND ops_order.IsActive='1'
 AND mas_branch.BranchID='".$session."'
GROUP BY uac_customer.CustomerID,uac_customer.FirstName,uac_customer.LastName,uac_customer.TelephoneNo,mas_branch.BranchNameTH,uac_customer.CustomerType
Order By MAX(OrderDate)ASC";

}}
					else if($_GET['select_top']==100){
					if($_GET['keywords2']=='cheese'||$_GET['keywords']=='cheese'){
					$stmt="select distinct ROW_NUMBER() OVER(ORDER BY uac_customer.CustomerID ASC) AS Row ,mas_branch.BranchNameTH,
case when  uac_customer.CustomerType=1 then 1 else 0 end as CustomerType,
uac_customer.FirstName+' '+uac_customer.LastName as CustomerName,uac_customer.TelephoneNo,
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
coalesce (SUM(CASE WHEN ops_orderdetail.ServiceNameEN = 'Press Only' then 1 else null end),0)+
coalesce (SUM(CASE WHEN ops_orderdetail.ServiceNameEN = 'Other' AND (ops_orderdetail.ProductID=360 OR ops_orderdetail.ProductID=361) then 1 else null end),0)+
coalesce (SUM(CASE WHEN ops_orderdetail.ServiceNameEN = 'Other' AND ops_orderdetail.ProductID=362 then 1 else null end),0)  AS total,MAX(OrderDate) as dates
from ((ops_order left join uac_customer on ops_order.CustomerID=uac_customer.CustomerID)
left join (mas_branch left join mas_branchtype on mas_branch.BranchType=mas_branchtype.BranchTypeID) ON ops_order.BranchID=mas_branch.BranchID)
left join ops_orderdetail on ops_order.OrderNo=ops_orderdetail.OrderNo
WHERE ops_order.OrderDate BETWEEN '".$date_start."' AND '".$date_end."' AND ops_order.IsActive='1'
 AND mas_branch.BranchID='".$session."'
GROUP BY uac_customer.CustomerID,uac_customer.FirstName,uac_customer.LastName,uac_customer.TelephoneNo,mas_branch.BranchNameTH,uac_customer.CustomerType
Order By MAX(OrderDate)ASC";


}}
					else{
					if($_GET['keywords2']=='cheese'&&$_GET['keywords']=='cheese'){
					$stmt="select distinct ROW_NUMBER() OVER(ORDER BY uac_customer.CustomerID ASC) AS Row ,mas_branch.BranchNameTH,
case when  uac_customer.CustomerType=1 then 1 else 0 end as CustomerType,
uac_customer.FirstName+' '+uac_customer.LastName as CustomerName,uac_customer.TelephoneNo,
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
coalesce (SUM(CASE WHEN ops_orderdetail.ServiceNameEN = 'Press Only' then 1 else null end),0)+
coalesce (SUM(CASE WHEN ops_orderdetail.ServiceNameEN = 'Other' AND (ops_orderdetail.ProductID=360 OR ops_orderdetail.ProductID=361) then 1 else null end),0)+
coalesce (SUM(CASE WHEN ops_orderdetail.ServiceNameEN = 'Other' AND ops_orderdetail.ProductID=362 then 1 else null end),0)  AS total,MAX(OrderDate) as dates
from ((ops_order left join uac_customer on ops_order.CustomerID=uac_customer.CustomerID)
left join (mas_branch left join mas_branchtype on mas_branch.BranchType=mas_branchtype.BranchTypeID) ON ops_order.BranchID=mas_branch.BranchID)
left join ops_orderdetail on ops_order.OrderNo=ops_orderdetail.OrderNo
WHERE ops_order.OrderDate BETWEEN '".$date_start."' AND '".$date_end."' AND ops_order.IsActive='1'
 AND mas_branch.BranchID='".$session."'
GROUP BY uac_customer.CustomerID,uac_customer.FirstName,uac_customer.LastName,uac_customer.TelephoneNo,mas_branch.BranchNameTH,uac_customer.CustomerType
Order By MAX(OrderDate)ASC";
					}
					}
					}


				$query = sqlsrv_query($conn,$stmt);
   				$object_array = array();
				while($row = sqlsrv_fetch_array($query)){
					array_push($object_array,$row);
				}
		
    $json_array=json_encode($object_array);
	echo $json_array;
?>
