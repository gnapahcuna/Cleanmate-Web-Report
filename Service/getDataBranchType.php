<?php
	include("config.php");
    $stmt = "select BranchTypeID,BranchTypeNameTH from mas_branchtype where IsActive=1";
    $query = sqlsrv_query($conn, $stmt);
	$object_array = array();
     while($row = sqlsrv_fetch_array($query, SQLSRV_FETCH_ASSOC))
    {
 		array_push($object_array,$row);
    }
    $json_array=json_encode($object_array);
	echo $json_array;
?>
