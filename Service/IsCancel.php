<?php
	include("config.php");
	date_default_timezone_set('Asia/Bangkok');
	$date = date('Y-m-d h:i:s a', time());
    	$sql = "update ops_ordersupplies set IsActive = ?, CancelDate = ? where OrderNo= ?";
	$params = array(0,$date,$_GET['OrderNo']);
       	$stmt = sqlsrv_query( $conn, $sql, $params);
	
	if( $stmt === false ) {
		die( print_r( sqlsrv_errors(), true));
	}else
	{
	}
?>
