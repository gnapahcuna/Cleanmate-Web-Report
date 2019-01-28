<?php
	include("config.php");
    $stmt = "select distinct ops_ordersupplies.BranchID,BranchNameTH from ops_ordersupplies left join mas_branch on ops_ordersupplies.BranchID=mas_branch.BranchID";
    $query = sqlsrv_query($conn, $stmt);
	$object_array = array();
     while($row = sqlsrv_fetch_array($query, SQLSRV_FETCH_ASSOC))
    {
 		array_push($object_array,$row);
    }
    $json_array=json_encode($object_array);
	echo $json_array;
?>
