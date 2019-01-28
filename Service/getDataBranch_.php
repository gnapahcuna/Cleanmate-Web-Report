<?php
	include("config.php");
    $stmt = "select Distinct mas_branch.BranchID,mas_branch.BranchCode,mas_branch.BranchNameTH,mas_branchtype.BranchTypeNameTH,
mas_branch.TelephoneNo,mas_branch.Address,BranchContactName,Email
		from ops_order left join (mas_branch left join mas_branchtype on mas_branch.BranchType=mas_branchtype.BranchTypeID) 
		on ops_order.BranchID=mas_branch.BranchID
		where mas_branch.BranchID ='".$_GET['branchID']."'";
    $query = sqlsrv_query($conn, $stmt);
	$object_array = array();
     while($row = sqlsrv_fetch_array($query, SQLSRV_FETCH_ASSOC))
    {
 		array_push($object_array,$row);
    }
    $json_array=json_encode($object_array);
	echo $json_array;
?>
