<?php
	include("config.php");
    $stmt = "select distinct pd.ProductID,pd.ProductNameTH+'('+cate.CategoryNameTH+')' as ProductNameTH from ops_orderdetail odd left join (mas_product pd left join mas_productcategory cate on pd.CategoryID=cate.CategoryID) on odd.ProductID=pd.ProductID Order By pd.ProductID ASC";
    $query = sqlsrv_query($conn, $stmt);
	$object_array = array();
     while($row = sqlsrv_fetch_array($query, SQLSRV_FETCH_ASSOC))
    {
 		array_push($object_array,$row);
    }
    $json_array=json_encode($object_array);
	echo $json_array;
?>
