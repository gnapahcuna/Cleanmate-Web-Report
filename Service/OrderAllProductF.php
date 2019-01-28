<?php
	include("config.php");
	$keywords=$_GET['keywords'];
	$date_start=$_GET['date_start'];
	$date_end=$_GET['date_end'];
	
	if($_GET['select_top']==10){
					if($_GET['keywords']=='cheese'){
					$stmt="SELECT top 10 mas_product.ProductNameTH,mas_product.ProductID,
Count(case when mas_branch.BranchType = 1 then 1 else null end) as service1,
Count(case when mas_branch.BranchType = 2 then 1 else null end) as service2,
Count(case when mas_branch.BranchType = 3 then 1 else null end) as service3,
Count(case when  mas_branch.BranchType = 1 AND ops_order.OrderNo=ops_orderdetail.OrderNo then 1 else null end)+
Count(case when  mas_branch.BranchType = 2 AND ops_order.OrderNo=ops_orderdetail.OrderNo then 1 else null end)+
Count(case when  mas_branch.BranchType = 3  AND ops_order.OrderNo=ops_orderdetail.OrderNo then 1 else null end) as total
from (ops_orderdetail left join
(ops_order left join
(mas_branch left join mas_branchtype on mas_branch.BranchType=mas_branchtype.BranchTypeID)
on ops_order.BranchID=mas_branch.BranchID)
on ops_orderdetail.OrderNo=ops_order.OrderNo)
left join mas_product on ops_orderdetail.ProductID=mas_product.ProductID
WHERE ops_order.OrderDate BETWEEN '$date_start' AND '$date_end' AND ops_order.IsActive='1'
GROUP BY mas_product.ProductNameTH,mas_product.ProductID";
					}else{
					$stmt="SELECT top 10 mas_product.ProductNameTH,mas_product.ProductID,
Count(case when mas_branch.BranchType = 1 then 1 else null end) as service1,
Count(case when mas_branch.BranchType = 2 then 1 else null end) as service2,
Count(case when mas_branch.BranchType = 3 then 1 else null end) as service3,
Count(case when  mas_branch.BranchType = 1 AND ops_order.OrderNo=ops_orderdetail.OrderNo then 1 else null end)+
Count(case when  mas_branch.BranchType = 2 AND ops_order.OrderNo=ops_orderdetail.OrderNo then 1 else null end)+
Count(case when  mas_branch.BranchType = 3  AND ops_order.OrderNo=ops_orderdetail.OrderNo then 1 else null end) as total
from (ops_orderdetail left join
(ops_order left join
(mas_branch left join mas_branchtype on mas_branch.BranchType=mas_branchtype.BranchTypeID)
on ops_order.BranchID=mas_branch.BranchID)
on ops_orderdetail.OrderNo=ops_order.OrderNo)
left join mas_product on ops_orderdetail.ProductID=mas_product.ProductID
WHERE ops_order.OrderDate BETWEEN '$date_start' AND '$date_end' AND ops_order.IsActive='1'
AND ops_orderdetail.ProductID = '".$keywords."'
GROUP BY mas_product.ProductNameTH,mas_product.ProductID";
					}}else if($_GET['select_top']==20){
					if($_GET['keywords']=='cheese'){
					$stmt="SELECT top 20 mas_product.ProductNameTH,mas_product.ProductID,
Count(case when mas_branch.BranchType = 1 then 1 else null end) as service1,
Count(case when mas_branch.BranchType = 2 then 1 else null end) as service2,
Count(case when mas_branch.BranchType = 3 then 1 else null end) as service3,
Count(case when  mas_branch.BranchType = 1 AND ops_order.OrderNo=ops_orderdetail.OrderNo then 1 else null end)+
Count(case when  mas_branch.BranchType = 2 AND ops_order.OrderNo=ops_orderdetail.OrderNo then 1 else null end)+
Count(case when  mas_branch.BranchType = 3  AND ops_order.OrderNo=ops_orderdetail.OrderNo then 1 else null end) as total
from (ops_orderdetail left join
(ops_order left join
(mas_branch left join mas_branchtype on mas_branch.BranchType=mas_branchtype.BranchTypeID)
on ops_order.BranchID=mas_branch.BranchID)
on ops_orderdetail.OrderNo=ops_order.OrderNo)
left join mas_product on ops_orderdetail.ProductID=mas_product.ProductID
WHERE ops_order.OrderDate BETWEEN '$date_start' AND '$date_end' AND ops_order.IsActive='1'
GROUP BY mas_product.ProductNameTH,mas_product.ProductID";
					}else{
					$stmt="SELECT top 20 mas_product.ProductNameTH,mas_product.ProductID,
Count(case when mas_branch.BranchType = 1 then 1 else null end) as service1,
Count(case when mas_branch.BranchType = 2 then 1 else null end) as service2,
Count(case when mas_branch.BranchType = 3 then 1 else null end) as service3,
Count(case when  mas_branch.BranchType = 1 AND ops_order.OrderNo=ops_orderdetail.OrderNo then 1 else null end)+
Count(case when  mas_branch.BranchType = 2 AND ops_order.OrderNo=ops_orderdetail.OrderNo then 1 else null end)+
Count(case when  mas_branch.BranchType = 3  AND ops_order.OrderNo=ops_orderdetail.OrderNo then 1 else null end) as total
from (ops_orderdetail left join
(ops_order left join
(mas_branch left join mas_branchtype on mas_branch.BranchType=mas_branchtype.BranchTypeID)
on ops_order.BranchID=mas_branch.BranchID)
on ops_orderdetail.OrderNo=ops_order.OrderNo)
left join mas_product on ops_orderdetail.ProductID=mas_product.ProductID
WHERE ops_order.OrderDate BETWEEN '$date_start' AND '$date_end' AND ops_order.IsActive='1'
AND ops_orderdetail.ProductID = '".$keywords."'
GROUP BY mas_product.ProductNameTH,mas_product.ProductID";
					}}else if($_GET['select_top']==30){
					if($_GET['keywords']=='cheese'){
					$stmt="SELECT top 30 mas_product.ProductNameTH,mas_product.ProductID,
Count(case when mas_branch.BranchType = 1 then 1 else null end) as service1,
Count(case when mas_branch.BranchType = 2 then 1 else null end) as service2,
Count(case when mas_branch.BranchType = 3 then 1 else null end) as service3,
Count(case when  mas_branch.BranchType = 1 AND ops_order.OrderNo=ops_orderdetail.OrderNo then 1 else null end)+
Count(case when  mas_branch.BranchType = 2 AND ops_order.OrderNo=ops_orderdetail.OrderNo then 1 else null end)+
Count(case when  mas_branch.BranchType = 3  AND ops_order.OrderNo=ops_orderdetail.OrderNo then 1 else null end) as total
from (ops_orderdetail left join
(ops_order left join
(mas_branch left join mas_branchtype on mas_branch.BranchType=mas_branchtype.BranchTypeID)
on ops_order.BranchID=mas_branch.BranchID)
on ops_orderdetail.OrderNo=ops_order.OrderNo)
left join mas_product on ops_orderdetail.ProductID=mas_product.ProductID
WHERE ops_order.OrderDate BETWEEN '$date_start' AND '$date_end' AND ops_order.IsActive='1'
GROUP BY mas_product.ProductNameTH,mas_product.ProductID";
					}else{
					$stmt="SELECT top 30  mas_product.ProductNameTH,mas_product.ProductID,
Count(case when mas_branch.BranchType = 1 then 1 else null end) as service1,
Count(case when mas_branch.BranchType = 2 then 1 else null end) as service2,
Count(case when mas_branch.BranchType = 3 then 1 else null end) as service3,
Count(case when  mas_branch.BranchType = 1 AND ops_order.OrderNo=ops_orderdetail.OrderNo then 1 else null end)+
Count(case when  mas_branch.BranchType = 2 AND ops_order.OrderNo=ops_orderdetail.OrderNo then 1 else null end)+
Count(case when  mas_branch.BranchType = 3  AND ops_order.OrderNo=ops_orderdetail.OrderNo then 1 else null end) as total
from (ops_orderdetail left join
(ops_order left join
(mas_branch left join mas_branchtype on mas_branch.BranchType=mas_branchtype.BranchTypeID)
on ops_order.BranchID=mas_branch.BranchID)
on ops_orderdetail.OrderNo=ops_order.OrderNo)
left join mas_product on ops_orderdetail.ProductID=mas_product.ProductID
WHERE ops_order.OrderDate BETWEEN '$date_start' AND '$date_end' AND ops_order.IsActive='1'
AND ops_orderdetail.ProductID = '".$keywords."'
GROUP BY mas_product.ProductNameTH,mas_product.ProductID";
					}}else if($_GET['select_top']==100){
					if($_GET['keywords']=='cheese'){
					$stmt="SELECT  mas_product.ProductNameTH,mas_product.ProductID,
Count(case when mas_branch.BranchType = 1 then 1 else null end) as service1,
Count(case when mas_branch.BranchType = 2 then 1 else null end) as service2,
Count(case when mas_branch.BranchType = 3 then 1 else null end) as service3,
Count(case when  mas_branch.BranchType = 1 AND ops_order.OrderNo=ops_orderdetail.OrderNo then 1 else null end)+
Count(case when  mas_branch.BranchType = 2 AND ops_order.OrderNo=ops_orderdetail.OrderNo then 1 else null end)+
Count(case when  mas_branch.BranchType = 3  AND ops_order.OrderNo=ops_orderdetail.OrderNo then 1 else null end) as total
from (ops_orderdetail left join
(ops_order left join
(mas_branch left join mas_branchtype on mas_branch.BranchType=mas_branchtype.BranchTypeID)
on ops_order.BranchID=mas_branch.BranchID)
on ops_orderdetail.OrderNo=ops_order.OrderNo)
left join mas_product on ops_orderdetail.ProductID=mas_product.ProductID
WHERE ops_order.OrderDate BETWEEN '$date_start' AND '$date_end' AND ops_order.IsActive='1'
GROUP BY mas_product.ProductNameTH,mas_product.ProductID";
					}else{
					$stmt="SELECT  mas_product.ProductNameTH,mas_product.ProductID,
Count(case when mas_branch.BranchType = 1 then 1 else null end) as service1,
Count(case when mas_branch.BranchType = 2 then 1 else null end) as service2,
Count(case when mas_branch.BranchType = 3 then 1 else null end) as service3,
Count(case when  mas_branch.BranchType = 1 AND ops_order.OrderNo=ops_orderdetail.OrderNo then 1 else null end)+
Count(case when  mas_branch.BranchType = 2 AND ops_order.OrderNo=ops_orderdetail.OrderNo then 1 else null end)+
Count(case when  mas_branch.BranchType = 3  AND ops_order.OrderNo=ops_orderdetail.OrderNo then 1 else null end) as total
from (ops_orderdetail left join
(ops_order left join
(mas_branch left join mas_branchtype on mas_branch.BranchType=mas_branchtype.BranchTypeID)
on ops_order.BranchID=mas_branch.BranchID)
on ops_orderdetail.OrderNo=ops_order.OrderNo)
left join mas_product on ops_orderdetail.ProductID=mas_product.ProductID
WHERE ops_order.OrderDate BETWEEN '$date_start' AND '$date_end' AND ops_order.IsActive='1'
AND ops_orderdetail.ProductID = '".$keywords."'
GROUP BY mas_product.ProductNameTH,mas_product.ProductID";
					}}else{
					if($_GET['keywords']=='cheese'){
					$stmt="SELECT  mas_product.ProductNameTH,mas_product.ProductID,
Count(case when mas_branch.BranchType = 1 then 1 else null end) as service1,
Count(case when mas_branch.BranchType = 2 then 1 else null end) as service2,
Count(case when mas_branch.BranchType = 3 then 1 else null end) as service3,
Count(case when  mas_branch.BranchType = 1 AND ops_order.OrderNo=ops_orderdetail.OrderNo then 1 else null end)+
Count(case when  mas_branch.BranchType = 2 AND ops_order.OrderNo=ops_orderdetail.OrderNo then 1 else null end)+
Count(case when  mas_branch.BranchType = 3  AND ops_order.OrderNo=ops_orderdetail.OrderNo then 1 else null end) as total
from (ops_orderdetail left join
(ops_order left join
(mas_branch left join mas_branchtype on mas_branch.BranchType=mas_branchtype.BranchTypeID)
on ops_order.BranchID=mas_branch.BranchID)
on ops_orderdetail.OrderNo=ops_order.OrderNo)
left join mas_product on ops_orderdetail.ProductID=mas_product.ProductID
WHERE ops_order.OrderDate BETWEEN '$date_start' AND '$date_end' AND ops_order.IsActive='1'
GROUP BY mas_product.ProductNameTH,mas_product.ProductID";
					}else{
					$stmt="SELECT  mas_product.ProductNameTH,mas_product.ProductID,
Count(case when mas_branch.BranchType = 1 then 1 else null end) as service1,
Count(case when mas_branch.BranchType = 2 then 1 else null end) as service2,
Count(case when mas_branch.BranchType = 3 then 1 else null end) as service3,
Count(case when  mas_branch.BranchType = 1 AND ops_order.OrderNo=ops_orderdetail.OrderNo then 1 else null end)+
Count(case when  mas_branch.BranchType = 2 AND ops_order.OrderNo=ops_orderdetail.OrderNo then 1 else null end)+
Count(case when  mas_branch.BranchType = 3  AND ops_order.OrderNo=ops_orderdetail.OrderNo then 1 else null end) as total
from (ops_orderdetail left join
(ops_order left join
(mas_branch left join mas_branchtype on mas_branch.BranchType=mas_branchtype.BranchTypeID)
on ops_order.BranchID=mas_branch.BranchID)
on ops_orderdetail.OrderNo=ops_order.OrderNo)
left join mas_product on ops_orderdetail.ProductID=mas_product.ProductID
WHERE ops_order.OrderDate BETWEEN '$date_start' AND '$date_end' AND ops_order.IsActive='1'
AND ops_orderdetail.ProductID = '".$keywords."'
GROUP BY mas_product.ProductNameTH,mas_product.ProductID";
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
