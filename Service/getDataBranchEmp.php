<?php
	include("config.php");
    $stmt = "select BranchCode,BranchNameTH,ops_ordersupplies.OrderNo,CONVERT(varchar,OrderSuppliesDate) as OrderSuppliesDate,
ops_ordersupplies.IsActive,coalesce(IsChecker,0) as IsChecker,coalesce(IsBranchEmp,0) as IsBranchEmp
from ops_ordersupplies left join mas_branch on ops_ordersupplies.BranchID=mas_branch.BranchID";
    $query = sqlsrv_query($conn, $stmt);
	$object_array = array();
     while($row = sqlsrv_fetch_array($query, SQLSRV_FETCH_ASSOC))
    {
 		array_push($object_array,$row);
    }
    $json_array=json_encode($object_array);
	echo $json_array;
?>
