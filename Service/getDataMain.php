<?php
	include("config.php");
	$branchID=$_GET['branchID'];
	$date_start=$_GET['date_start'];
	$date_end=$_GET['date_end'];
	if($_GET['key']==1){
		if($branchID!='cheese'&&$branchID!=''){
			$stmt = "select BranchCode,BranchNameTH,ops_ordersupplies.OrderNo,CreateDate as OrderSuppliesDate,
ops_ordersupplies.IsActive,coalesce(IsChecker,0) as IsChecker,coalesce(IsBranchEmp,0) as IsBranchEmp
from ops_ordersupplies left join mas_branch on ops_ordersupplies.BranchID=mas_branch.BranchID
where OrderSuppliesDate between '".$date_start."' and '".$date_end."' AND (IsChecker=0 OR IsChecker IS NULL) AND ops_ordersupplies.IsActive=1 AND mas_branch.BranchID='".trim($branchID)."' Order By CreateDate";
		}elseif($date_start!=''&&$branchID=='cheese'){
			$stmt = "select BranchCode,BranchNameTH,ops_ordersupplies.OrderNo,CreateDate as OrderSuppliesDate,
ops_ordersupplies.IsActive,coalesce(IsChecker,0) as IsChecker,coalesce(IsBranchEmp,0) as IsBranchEmp
from ops_ordersupplies left join mas_branch on ops_ordersupplies.BranchID=mas_branch.BranchID
where OrderSuppliesDate between '".$date_start."' and '".$date_end."' AND (IsChecker=0 OR IsChecker IS NULL) AND ops_ordersupplies.IsActive=1 Order By CreateDate";
		}else{
			$stmt = "select BranchCode,BranchNameTH,ops_ordersupplies.OrderNo,CreateDate as OrderSuppliesDate,
ops_ordersupplies.IsActive,coalesce(IsChecker,0) as IsChecker,coalesce(IsBranchEmp,0) as IsBranchEmp
from ops_ordersupplies left join mas_branch on ops_ordersupplies.BranchID=mas_branch.BranchID
where (IsChecker=0 OR IsChecker IS NULL) AND ops_ordersupplies.IsActive=1 Order By CreateDate";
		}
	}elseif($_GET['key']==5){
		if($branchID!='cheese'&&$branchID!=''){
			$stmt = "select BranchCode,BranchNameTH,ops_ordersupplies.OrderNo,CreateDate as OrderSuppliesDate,
ops_ordersupplies.IsActive,coalesce(IsChecker,0) as IsChecker,coalesce(IsBranchEmp,0) as IsBranchEmp,
CheckerDate
from ops_ordersupplies left join mas_branch on ops_ordersupplies.BranchID=mas_branch.BranchID
where OrderSuppliesDate between '".$date_start."' and '".$date_end."' AND IsChecker=1 AND ops_ordersupplies.IsActive=1 AND (IsBranchEmp=0 OR IsBranchEmp IS NULL) AND mas_branch.BranchID='".trim($branchID)."' Order By CheckerDate";
		}elseif($date_start!=''&&$branchID=='cheese'){
			$stmt = "select BranchCode,BranchNameTH,ops_ordersupplies.OrderNo,CreateDate as OrderSuppliesDate,
ops_ordersupplies.IsActive,coalesce(IsChecker,0) as IsChecker,coalesce(IsBranchEmp,0) as IsBranchEmp,
CheckerDate
from ops_ordersupplies left join mas_branch on ops_ordersupplies.BranchID=mas_branch.BranchID
where OrderSuppliesDate between '".$date_start."' and '".$date_end."' AND IsChecker=1 AND ops_ordersupplies.IsActive=1 AND (IsBranchEmp=0 OR IsBranchEmp IS NULL) Order By CheckerDate";
		}else{
			$stmt = "select BranchCode,BranchNameTH,ops_ordersupplies.OrderNo,CreateDate as OrderSuppliesDate,
ops_ordersupplies.IsActive,coalesce(IsChecker,0) as IsChecker,coalesce(IsBranchEmp,0) as IsBranchEmp,
CheckerDate
from ops_ordersupplies left join mas_branch on ops_ordersupplies.BranchID=mas_branch.BranchID
where IsChecker=1 AND ops_ordersupplies.IsActive=1 AND (IsBranchEmp=0 OR IsBranchEmp IS NULL) Order By CheckerDate";
		}
	}elseif($_GET['key']==3){
		if($branchID!='cheese'&&$branchID!=''){
			$stmt = "select BranchCode,BranchNameTH,ops_ordersupplies.OrderNo,CreateDate as OrderSuppliesDate,
ops_ordersupplies.IsActive,coalesce(IsChecker,0) as IsChecker,coalesce(IsBranchEmp,0) as IsBranchEmp,BranchEmpDate
from ops_ordersupplies left join mas_branch on ops_ordersupplies.BranchID=mas_branch.BranchID
where OrderSuppliesDate between '".$date_start."' and '".$date_end."' AND ops_ordersupplies.IsActive=1 AND IsChecker=1 AND IsBranchEmp=1 AND mas_branch.BranchID='".trim($branchID)."' Order By BranchEmpDate";
		}elseif($date_start!=''&&$branchID=='cheese'){
			$stmt = "select BranchCode,BranchNameTH,ops_ordersupplies.OrderNo,CreateDate as OrderSuppliesDate,
ops_ordersupplies.IsActive,coalesce(IsChecker,0) as IsChecker,coalesce(IsBranchEmp,0) as IsBranchEmp,BranchEmpDate
from ops_ordersupplies left join mas_branch on ops_ordersupplies.BranchID=mas_branch.BranchID
where OrderSuppliesDate between '".$date_start."' and '".$date_end."' AND ops_ordersupplies.IsActive=1 AND IsChecker=1 AND IsBranchEmp=1 Order By BranchEmpDate";
		}else{
			$stmt = "select BranchCode,BranchNameTH,ops_ordersupplies.OrderNo,CreateDate as OrderSuppliesDate,
ops_ordersupplies.IsActive,coalesce(IsChecker,0) as IsChecker,coalesce(IsBranchEmp,0) as IsBranchEmp,BranchEmpDate
from ops_ordersupplies left join mas_branch on ops_ordersupplies.BranchID=mas_branch.BranchID
where ops_ordersupplies.IsActive=1 AND IsChecker=1 AND IsBranchEmp=1 Order By BranchEmpDate";
		}
	}elseif($_GET['key']==4){
		if($branchID!='cheese'&&$branchID!=''){
			$stmt = "select BranchCode,BranchNameTH,ops_ordersupplies.OrderNo,CreateDate as OrderSuppliesDate,
ops_ordersupplies.IsActive,coalesce(IsChecker,0) as IsChecker,coalesce(IsBranchEmp,0) as IsBranchEmp,CancelDate
from ops_ordersupplies left join mas_branch on ops_ordersupplies.BranchID=mas_branch.BranchID
where OrderSuppliesDate between '".$date_start."' and '".$date_end."' AND ops_ordersupplies.IsActive=0 AND mas_branch.BranchID='".trim($branchID)."' Order By CancelDate";
		}elseif($date_start!=''&&$branchID=='cheese'){
			$stmt = "select BranchCode,BranchNameTH,ops_ordersupplies.OrderNo,CreateDate as OrderSuppliesDate,
ops_ordersupplies.IsActive,coalesce(IsChecker,0) as IsChecker,coalesce(IsBranchEmp,0) as IsBranchEmp,CancelDate
from ops_ordersupplies left join mas_branch on ops_ordersupplies.BranchID=mas_branch.BranchID
where OrderSuppliesDate between '".$date_start."' and '".$date_end."' AND ops_ordersupplies.IsActive=0 Order By CancelDate";
		}else{
			$stmt = "select BranchCode,BranchNameTH,ops_ordersupplies.OrderNo,CreateDate as OrderSuppliesDate,
ops_ordersupplies.IsActive,coalesce(IsChecker,0) as IsChecker,coalesce(IsBranchEmp,0) as IsBranchEmp,CancelDate
from ops_ordersupplies left join mas_branch on ops_ordersupplies.BranchID=mas_branch.BranchID
where ops_ordersupplies.IsActive=0 Order By CancelDate";
		}
	}else{
		if($branchID!='cheese'&&$branchID!=''){
			$stmt = "select BranchCode,BranchNameTH,ops_ordersupplies.OrderNo,CreateDate as OrderSuppliesDate,
ops_ordersupplies.IsActive,coalesce(IsChecker,0) as IsChecker,coalesce(IsBranchEmp,0) as IsBranchEmp
from ops_ordersupplies left join mas_branch on ops_ordersupplies.BranchID=mas_branch.BranchID
where OrderSuppliesDate between '".$date_start."' and '".$date_end."' AND (IsChecker=0 OR IsChecker IS NULL) AND ops_ordersupplies.IsActive=1 AND mas_branch.BranchID='".trim($branchID)."' Order By CreateDate";
		}elseif($date_start!=''&&$branchID=='cheese'){
			$stmt = "select BranchCode,BranchNameTH,ops_ordersupplies.OrderNo,CreateDate as OrderSuppliesDate,
ops_ordersupplies.IsActive,coalesce(IsChecker,0) as IsChecker,coalesce(IsBranchEmp,0) as IsBranchEmp
from ops_ordersupplies left join mas_branch on ops_ordersupplies.BranchID=mas_branch.BranchID
where OrderSuppliesDate between '".$date_start."' and '".$date_end."' AND (IsChecker=0 OR IsChecker IS NULL) AND ops_ordersupplies.IsActive=1 Order By CreateDate";
		}else{
			$stmt = "select BranchCode,BranchNameTH,ops_ordersupplies.OrderNo,CreateDate as OrderSuppliesDate,
ops_ordersupplies.IsActive,coalesce(IsChecker,0) as IsChecker,coalesce(IsBranchEmp,0) as IsBranchEmp
from ops_ordersupplies left join mas_branch on ops_ordersupplies.BranchID=mas_branch.BranchID
where (IsChecker=0 OR IsChecker IS NULL) AND ops_ordersupplies.IsActive=1 Order By CreateDate";
		}
	}
    $query = sqlsrv_query($conn, $stmt);
	$object_array = array();
     while($row = sqlsrv_fetch_array($query, SQLSRV_FETCH_ASSOC))
    {
 		array_push($object_array,$row);
    }
    $json_array=json_encode($object_array);
	echo $json_array;
?>
