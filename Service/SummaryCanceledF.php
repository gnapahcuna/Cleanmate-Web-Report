<?php
	include("config.php");
   	$keywords2=$_GET['keywords2'];
	$keywords=$_GET['keywords'];
	$date_start=$_GET['date_start'];
	$date_end=$_GET['date_end'];
	$session=$_GET['session'];
	
	if($session==1){

					if($_GET['select_top']==10){
					if($_GET['keywords2']=='cheese'&&$_GET['keywords']=='cheese'){
					$stmt="SELECT top 10 mas_branchtype.BranchTypeNameTH, mas_branch.BranchNameTH,
				  Sum(ops_order.NetAmount)As total
				  FROM ops_order left join (mas_branch left join mas_branchtype on mas_branch.BranchType=mas_branchtype.BranchTypeID)
				  on ops_order.BranchID=mas_branch.BranchID
				  where ops_order.OrderDate BETWEEN '$date_start' AND '$date_end'  AND ops_order.IsActive='0'
				  GROUP BY  mas_branchtype.BranchTypeNameTH, mas_branch.BranchNameTH";
					}else if($_GET['keywords2']!='cheese'&&$_GET['keywords']=='cheese'){
						$stmt="SELECT top 10 mas_branchtype.BranchTypeNameTH, mas_branch.BranchNameTH,
				  Sum(ops_order.NetAmount)As total
				  FROM ops_order left join (mas_branch left join mas_branchtype on mas_branch.BranchType=mas_branchtype.BranchTypeID)
				  on ops_order.BranchID=mas_branch.BranchID
				  where ops_order.OrderDate BETWEEN '$date_start' AND '$date_end' AND ops_order.IsActive='0'
				  AND mas_branch.BranchID = '".$keywords2."'
				  GROUP BY  mas_branchtype.BranchTypeNameTH, mas_branch.BranchNameTH";
					}else{
					$stmt="SELECT top 10 mas_branchtype.BranchTypeNameTH, mas_branch.BranchNameTH,
				  Sum(ops_order.NetAmount)As total
				  FROM ops_order left join (mas_branch left join mas_branchtype on mas_branch.BranchType=mas_branchtype.BranchTypeID)
				  on ops_order.BranchID=mas_branch.BranchID
				  where ops_order.OrderDate BETWEEN '$date_start' AND '$date_end' AND ops_order.IsActive='0'
				  AND mas_branch.BranchType = '".$keywords."'
				  GROUP BY  mas_branchtype.BranchTypeNameTH, mas_branch.BranchNameTH";
					}}else if($_GET['select_top']==20){
					if($_GET['keywords2']=='cheese'&&$_GET['keywords']=='cheese'){
					$stmt="SELECT top 20 mas_branchtype.BranchTypeNameTH, mas_branch.BranchNameTH,
				  Sum(ops_order.NetAmount)As total
				  FROM ops_order left join (mas_branch left join mas_branchtype on mas_branch.BranchType=mas_branchtype.BranchTypeID)
				  on ops_order.BranchID=mas_branch.BranchID
				  where ops_order.OrderDate BETWEEN '$date_start' AND '$date_end'  AND ops_order.IsActive='0'
				  GROUP BY  mas_branchtype.BranchTypeNameTH, mas_branch.BranchNameTH";
					}else if($_GET['keywords2']!='cheese'&&$_GET['keywords']=='cheese'){
						$stmt="SELECT top 20 mas_branchtype.BranchTypeNameTH, mas_branch.BranchNameTH,
				  Sum(ops_order.NetAmount)As total
				  FROM ops_order left join (mas_branch left join mas_branchtype on mas_branch.BranchType=mas_branchtype.BranchTypeID)
				  on ops_order.BranchID=mas_branch.BranchID
				  where ops_order.OrderDate BETWEEN '$date_start' AND '$date_end' AND ops_order.IsActive='0'
				  AND mas_branch.BranchID = '".$keywords2."'
				  GROUP BY  mas_branchtype.BranchTypeNameTH, mas_branch.BranchNameTH";
					}else{
					$stmt="SELECT top 20 mas_branchtype.BranchTypeNameTH, mas_branch.BranchNameTH,
				  Sum(ops_order.NetAmount)As total
				  FROM ops_order left join (mas_branch left join mas_branchtype on mas_branch.BranchType=mas_branchtype.BranchTypeID)
				  on ops_order.BranchID=mas_branch.BranchID
				  where ops_order.OrderDate BETWEEN '$date_start' AND '$date_end' AND ops_order.IsActive='0'
				  AND mas_branch.BranchType = '".$keywords."'
				  GROUP BY  mas_branchtype.BranchTypeNameTH, mas_branch.BranchNameTH";
					}}else if($_GET['select_top']==30){
					if($_GET['keywords2']=='cheese'&&$_GET['keywords']=='cheese'){
					$stmt="SELECT top 30 mas_branchtype.BranchTypeNameTH, mas_branch.BranchNameTH,
				  Sum(ops_order.NetAmount)As total
				  FROM ops_order left join (mas_branch left join mas_branchtype on mas_branch.BranchType=mas_branchtype.BranchTypeID)
				  on ops_order.BranchID=mas_branch.BranchID
				  where ops_order.OrderDate BETWEEN '$date_start' AND '$date_end'  AND ops_order.IsActive='0'
				  GROUP BY  mas_branchtype.BranchTypeNameTH, mas_branch.BranchNameTH";
					}else if($_GET['keywords2']!='cheese'&&$_GET['keywords']=='cheese'){
						$stmt="SELECT top 30 mas_branchtype.BranchTypeNameTH, mas_branch.BranchNameTH,
				  Sum(ops_order.NetAmount)As total
				  FROM ops_order left join (mas_branch left join mas_branchtype on mas_branch.BranchType=mas_branchtype.BranchTypeID)
				  on ops_order.BranchID=mas_branch.BranchID
				  where ops_order.OrderDate BETWEEN '$date_start' AND '$date_end' AND ops_order.IsActive='0'
				  AND mas_branch.BranchID = '".$keywords2."'
				  GROUP BY  mas_branchtype.BranchTypeNameTH, mas_branch.BranchNameTH";
					}else{
					$stmt="SELECT top 30 mas_branchtype.BranchTypeNameTH, mas_branch.BranchNameTH,
				  Sum(ops_order.NetAmount)As total
				  FROM ops_order left join (mas_branch left join mas_branchtype on mas_branch.BranchType=mas_branchtype.BranchTypeID)
				  on ops_order.BranchID=mas_branch.BranchID
				  where ops_order.OrderDate BETWEEN '$date_start' AND '$date_end' AND ops_order.IsActive='0'
				  AND mas_branch.BranchType = '".$keywords."'
				  GROUP BY  mas_branchtype.BranchTypeNameTH, mas_branch.BranchNameTH";
					}}else if($_GET['select_top']==100){
					if($_GET['keywords2']=='cheese'&&$_GET['keywords']=='cheese'){
					$stmt="SELECT mas_branchtype.BranchTypeNameTH, mas_branch.BranchNameTH,
				  Sum(ops_order.NetAmount)As total
				  FROM ops_order left join (mas_branch left join mas_branchtype on mas_branch.BranchType=mas_branchtype.BranchTypeID)
				  on ops_order.BranchID=mas_branch.BranchID
				  where ops_order.OrderDate BETWEEN '$date_start' AND '$date_end'  AND ops_order.IsActive='0'
				  GROUP BY  mas_branchtype.BranchTypeNameTH, mas_branch.BranchNameTH";
					}else if($_GET['keywords2']!='cheese'&&$_GET['keywords']=='cheese'){
						$stmt="SELECT mas_branchtype.BranchTypeNameTH, mas_branch.BranchNameTH,
				  Sum(ops_order.NetAmount)As total
				  FROM ops_order left join (mas_branch left join mas_branchtype on mas_branch.BranchType=mas_branchtype.BranchTypeID)
				  on ops_order.BranchID=mas_branch.BranchID
				  where ops_order.OrderDate BETWEEN '$date_start' AND '$date_end' AND ops_order.IsActive='0'
				  AND mas_branch.BranchID = '".$keywords2."'
				  GROUP BY  mas_branchtype.BranchTypeNameTH, mas_branch.BranchNameTH";
					}else{
					$stmt="SELECT mas_branchtype.BranchTypeNameTH, mas_branch.BranchNameTH,
				  Sum(ops_order.NetAmount)As total
				  FROM ops_order left join (mas_branch left join mas_branchtype on mas_branch.BranchType=mas_branchtype.BranchTypeID)
				  on ops_order.BranchID=mas_branch.BranchID
				  where ops_order.OrderDate BETWEEN '$date_start' AND '$date_end' AND ops_order.IsActive='0'
				  AND mas_branch.BranchType = '".$keywords."'
				  GROUP BY  mas_branchtype.BranchTypeNameTH, mas_branch.BranchNameTH";

					}}else{
					if($_GET['keywords2']=='cheese'&&$_GET['keywords']=='cheese'){
					$stmt="SELECT mas_branchtype.BranchTypeNameTH, mas_branch.BranchNameTH,
				  Sum(ops_order.NetAmount)As total
				  FROM ops_order left join (mas_branch left join mas_branchtype on mas_branch.BranchType=mas_branchtype.BranchTypeID)
				  on ops_order.BranchID=mas_branch.BranchID
				  where ops_order.OrderDate BETWEEN '$date_start' AND '$date_end'  AND ops_order.IsActive='0'
				  GROUP BY  mas_branchtype.BranchTypeNameTH, mas_branch.BranchNameTH";
					}else if($_GET['keywords2']!='cheese'&&$_GET['keywords']=='cheese'){
						$stmt="SELECT mas_branchtype.BranchTypeNameTH, mas_branch.BranchNameTH,
				  Sum(ops_order.NetAmount)As total
				  FROM ops_order left join (mas_branch left join mas_branchtype on mas_branch.BranchType=mas_branchtype.BranchTypeID)
				  on ops_order.BranchID=mas_branch.BranchID
				  where ops_order.OrderDate BETWEEN '$date_start' AND '$date_end' AND ops_order.IsActive='0'
				  AND mas_branch.BranchID = '".$keywords2."'
				  GROUP BY  mas_branchtype.BranchTypeNameTH, mas_branch.BranchNameTH";
					}else{
					$stmt="SELECT mas_branchtype.BranchTypeNameTH, mas_branch.BranchNameTH,
				  Sum(ops_order.NetAmount)As total
				  FROM ops_order left join (mas_branch left join mas_branchtype on mas_branch.BranchType=mas_branchtype.BranchTypeID)
				  on ops_order.BranchID=mas_branch.BranchID
				  where ops_order.OrderDate BETWEEN '$date_start' AND '$date_end' AND ops_order.IsActive='0'
				  AND mas_branch.BranchType = '".$keywords."'
				  GROUP BY  mas_branchtype.BranchTypeNameTH, mas_branch.BranchNameTH";
					}
					}

					//branch
					}else{
					if($_GET['select_top']==10){
					if($_GET['keywords2']=='cheese'&&$_GET['keywords']=='cheese'){
					$stmt="SELECT top 10 mas_branchtype.BranchTypeNameTH, mas_branch.BranchNameTH,
				  Sum(ops_order.NetAmount)As total
				  FROM ops_order left join (mas_branch left join mas_branchtype on mas_branch.BranchType=mas_branchtype.BranchTypeID)
				  on ops_order.BranchID=mas_branch.BranchID
				  where ops_order.OrderDate BETWEEN '$date_start' AND '$date_end'  AND ops_order.IsActive='0'
				  AND mas_branch.BranchID='".$session."'
				  GROUP BY  mas_branchtype.BranchTypeNameTH, mas_branch.BranchNameTH";
					}}else if($_GET['select_top']==20){
					if($_GET['keywords2']=='cheese'&&$_GET['keywords']=='cheese'){
					$stmt="SELECT top 20 mas_branchtype.BranchTypeNameTH, mas_branch.BranchNameTH,
				  Sum(ops_order.NetAmount)As total
				  FROM ops_order left join (mas_branch left join mas_branchtype on mas_branch.BranchType=mas_branchtype.BranchTypeID)
				  on ops_order.BranchID=mas_branch.BranchID
				  where ops_order.OrderDate BETWEEN '$date_start' AND '$date_end'  AND ops_order.IsActive='0'
				  AND mas_branch.BranchID='".$session."'
				  GROUP BY  mas_branchtype.BranchTypeNameTH, mas_branch.BranchNameTH";
					}}else if($_GET['select_top']==30){
					if($_GET['keywords2']=='cheese'&&$_GET['keywords']=='cheese'){
					$stmt="SELECT top 30 mas_branchtype.BranchTypeNameTH, mas_branch.BranchNameTH,
				  Sum(ops_order.NetAmount)As total
				  FROM ops_order left join (mas_branch left join mas_branchtype on mas_branch.BranchType=mas_branchtype.BranchTypeID)
				  on ops_order.BranchID=mas_branch.BranchID
				  where ops_order.OrderDate BETWEEN '$date_start' AND '$date_end'  AND ops_order.IsActive='0'
				  AND mas_branch.BranchID='".$session."'
				  GROUP BY  mas_branchtype.BranchTypeNameTH, mas_branch.BranchNameTH";
					}}else if($_GET['select_top']==100){
					if($_GET['keywords2']=='cheese'&&$_GET['keywords']=='cheese'){
					$stmt="SELECT mas_branchtype.BranchTypeNameTH, mas_branch.BranchNameTH,
				  Sum(ops_order.NetAmount)As total
				  FROM ops_order left join (mas_branch left join mas_branchtype on mas_branch.BranchType=mas_branchtype.BranchTypeID)
				  on ops_order.BranchID=mas_branch.BranchID
				  where ops_order.OrderDate BETWEEN '$date_start' AND '$date_end'  AND ops_order.IsActive='0'
				  AND mas_branch.BranchID='".$session."'
				  GROUP BY  mas_branchtype.BranchTypeNameTH, mas_branch.BranchNameTH";
					}}else{
					if($_GET['keywords2']=='cheese'&&$_GET['keywords']=='cheese'){
					$stmt="SELECT mas_branchtype.BranchTypeNameTH, mas_branch.BranchNameTH,
				  Sum(ops_order.NetAmount)As total
				  FROM ops_order left join (mas_branch left join mas_branchtype on mas_branch.BranchType=mas_branchtype.BranchTypeID)
				  on ops_order.BranchID=mas_branch.BranchID
				  where ops_order.OrderDate BETWEEN '$date_start' AND '$date_end'  AND ops_order.IsActive='0'
				  AND mas_branch.BranchID='".$session."'
				  GROUP BY  mas_branchtype.BranchTypeNameTH, mas_branch.BranchNameTH";
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
