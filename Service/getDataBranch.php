<?php
	include("config.php");
    $stmt = "select distinct ops_order.BranchID,BranchNameTH ,BranchTypeNameTH
from ops_order left join (mas_branch left join mas_branchtype on mas_branch.BranchType=mas_branchtype.BranchTypeID)
on ops_order.BranchID=mas_branch.BranchID
 where ops_order.IsActive=1";
    $query = sqlsrv_query($conn, $stmt);
	$object_array = array();
     while($row = sqlsrv_fetch_array($query, SQLSRV_FETCH_ASSOC))
    {
 		array_push($object_array,$row);
    }
    $json_array=json_encode($object_array);
	echo $json_array;
?>
