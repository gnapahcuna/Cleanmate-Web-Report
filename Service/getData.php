<?php
	include("config.php");
    $stmt = "select ops_order.OrderNo,mas_branch.BranchNameTH + ' ('+mas_branch.BranchCode+')' as BranchNameTH,coalesce(ops_orderdetail.AdditionAmount,0) as AdditionAmount,coalesce(ops_orderdetail.DiscountAmount,0) as DiscountAmount,
uac_customer.FirstName+' '+uac_customer.LastName as FirstName,uac_customer.TelephoneNo,ops_order.OrderDate,ops_order.AppointmentDate,
mas_product.ProductID,mas_product.ProductNameTH,mas_service.ServiceNameTH,Amount,count(ops_orderdetail.OrderDetailID) as counts,
sum(distinct ops_order.PromoDiscount) as PromoDiscount ,
Amount*count(ops_orderdetail.OrderDetailID) as totals,coalesce(SpecialDiscount,0) as SpecialDiscount ,
NetAmount,coalesce(ops_order.MemberDiscount,0) as MemberDiscount
from (ops_orderdetail
left join (mas_product left join mas_service on mas_product.ServiceType=mas_service.ServiceType)
on ops_orderdetail.ProductID=mas_product.ProductID)
left join ((ops_order left join mas_branch on ops_order.BranchID=mas_branch.BranchID)
left join uac_customer on ops_order.CustomerID=uac_customer.CustomerID)
on ops_orderdetail.OrderNo=ops_order.OrderNo
where ops_order.OrderNo='".$_GET['OrderNo']."'
Group By ops_order.MemberDiscount,NetAmount,SpecialDiscount,ops_order.PromoDiscount,uac_customer.TelephoneNo,mas_product.ProductID,ops_order.OrderDate,ops_order.AppointmentDate,uac_customer.FirstName,
uac_customer.LastName,ops_order.OrderNo,mas_branch.BranchNameTH,mas_branch.BranchCode,mas_product.ProductID,
mas_product.ProductNameTH,mas_service.ServiceNameTH,Amount,ops_orderdetail.AdditionAmount,ops_orderdetail.DiscountAmount";

    $stmt1 = "select count(*) as CouponCounts from ops_coupondiscount where OrderID='".$_GET['OrderNo']."'";

    $query = sqlsrv_query($conn, $stmt);
    $query1 = sqlsrv_query($conn, $stmt1);
    $object_array = array();
    $counpon="";
    while($row = sqlsrv_fetch_array($query1, SQLSRV_FETCH_ASSOC))
    {
        $counpon = $row['CouponCounts'];
    }
    while($row = sqlsrv_fetch_array($query, SQLSRV_FETCH_ASSOC))
    {
         array_push($object_array,array('OrderNo' => $row['OrderNo'], 'BranchNameTH' => $row['BranchNameTH']
        ,'AdditionAmount' => $row['AdditionAmount']
        ,'DiscountAmount' => $row['DiscountAmount']
        ,'FirstName' => $row['FirstName']
        ,'TelephoneNo' => $row['TelephoneNo']
        ,'OrderDate' => $row['OrderDate']
        ,'AppointmentDate' => $row['AppointmentDate']
        ,'ProductID' => $row['ProductID']
        ,'ProductNameTH' => $row['ProductNameTH']
        ,'ServiceNameTH' => $row['ServiceNameTH']
        ,'Amount' => $row['Amount']
        ,'counts' => $row['counts']
        ,'PromoDiscount' => $row['PromoDiscount']
        ,'totals' => $row['totals']
        ,'SpecialDiscount' => $row['SpecialDiscount']
        ,'NetAmount' => $row['NetAmount']
        ,'MemberDiscount' => $row['MemberDiscount']
        ,'CouponCount' => $counpon));
    }

    $json_array=json_encode($object_array);
	echo $json_array;
?>
