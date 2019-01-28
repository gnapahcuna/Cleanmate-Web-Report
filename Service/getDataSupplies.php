<?php
	include("config.php");
   
	$stmt1 = "select SuppliesNameTH,Price,count(ops_orderdetailsupplies.SuppliesID) as counts,(Price*count(ops_orderdetailsupplies.SuppliesID)) as totals
from ops_orderdetailsupplies left join mas_supplies on ops_orderdetailsupplies.SuppliesID=mas_supplies.SuppliesID 
where OrderNo='".$_GET['OrderNo']."'
group by  SuppliesNameTH,Price,ops_orderdetailsupplies.SuppliesID";
	$query1 = sqlsrv_query($conn, $stmt1);
	$object_array1 = array();
     while($row = sqlsrv_fetch_array($query1, SQLSRV_FETCH_ASSOC))
    {
 		array_push($object_array1,$row);
    }
	
	$stmt = "select ops_ordersupplies.OrderNo,Convert(varchar,ops_ordersupplies.OrderSuppliesDate) as OrderSuppliesDate,
mas_branch.BranchNameTH+'('+mas_branch.BranchCode+')' as BranchNameTH
from (ops_ordersupplies left join mas_branch on ops_ordersupplies.BranchID=mas_branch.BranchID) 
left join ops_orderdetailsupplies on ops_ordersupplies.OrderNo=ops_orderdetailsupplies.OrderNo
where ops_ordersupplies.OrderNo='".$_GET['OrderNo']."'
group by ops_ordersupplies.OrderNo,ops_ordersupplies.OrderSuppliesDate,mas_branch.BranchNameTH,mas_branch.BranchCode";
    $query = sqlsrv_query($conn, $stmt);
	$object_array = array();
     while($row = sqlsrv_fetch_array($query, SQLSRV_FETCH_ASSOC))
    {
 		array_push($object_array,array('OrderNo' => $row['OrderNo'], 'OrderSuppliesDate' => $row['OrderSuppliesDate']
		,'BranchNameTH' => $row['BranchNameTH'],'Data' => $object_array1));
    }
	
    $json_array=json_encode($object_array);
	echo $json_array;
?>
