<?php
	include("config.php");
   	$keywords2=$_GET['keywords2'];
	$keywords=$_GET['keywords'];
	$date_start=$_GET['date_start'];
	$date_end=$_GET['date_end'];
	
	if($_GET['select_top']==10){
					if($_GET['keywords2']=='cheese'&&$_GET['keywords']=='cheese'){
					$stmt="select top 10 mas_branchtype.BranchTypeNameTH,mas_branch.BranchCode, mas_branch.BranchNameTH,
						count(distinct ops_order.OrderNo) as CountOrder,
						((sum(Amount)+sum((Amount)*coalesce(ExpressRate,0))/100)+sum(coalesce(ops_orderdetail.AdditionAmount,0)))-sum(coalesce(ops_orderdetail.DiscountAmount,0)) as total
						from (ops_orderdetail left join (ops_order left join (mas_branch left join mas_branchtype on mas_branch.BranchType=mas_branchtype.BranchTypeID)
						on ops_order.BranchID=mas_branch.BranchID) on ops_orderdetail.OrderNo=ops_order.OrderNo)
						left join mas_priceexpression on ops_order.IsExpressLevel=mas_priceexpression.IsExpressLevel
						WHERE ops_order.OrderDate BETWEEN '".$date_start."' AND '".$date_end."' AND ops_order.IsActive='1'
						GROUP BY
 						mas_branchtype.BranchTypeNameTH,
 						mas_branch.BranchCode,
 						mas_branch.BranchNameTH,
 						ops_order.BranchID
 						Order By ops_order.BranchID ASC";

					$stmt1=" select top 10 ops_order.BranchID,sum(PromoDiscount) as PromoDiscount, coalesce(sum(SpecialDiscount),0) as SpecialDiscount,sum(MemberDiscount) as MemberDiscount from ops_order
							left join (mas_branch left join mas_branchtype on mas_branch.BranchID=mas_branchtype.BranchTypeID)
							on ops_order.BranchID=mas_branch.BranchID
							WHERE ops_order.OrderDate BETWEEN '".$date_start."' AND '".$date_end."' AND ops_order.IsActive='1'
							GROUP BY ops_order.BranchID
							Order By ops_order.BranchID ASC";

					$stmt2="select top 10 count(distinct ops_order.OrderNo) as CountOrder
from (ops_order left join ops_orderdetail on ops_order.OrderNo=ops_orderdetail.OrderNo)
left join (mas_branch left join mas_branchtype on mas_branch.BranchID=mas_branchtype.BranchTypeID)
on ops_order.BranchID=mas_branch.BranchID
where ops_order.OrderDate BETWEEN '".$date_start."' AND '".$date_end."' AND ops_order.IsActive='1'
group by mas_branchtype.BranchTypeNameTH,
 		mas_branch.BranchCode,
 		mas_branch.BranchNameTH,
 		ops_order.BranchID
Order By ops_order.BranchID ASC";
					}else if($_GET['keywords2']!='cheese'&&$_GET['keywords']=='cheese'){
 					$stmt="select top 10 mas_branchtype.BranchTypeNameTH,mas_branch.BranchCode, mas_branch.BranchNameTH,
						count(distinct ops_order.OrderNo) as CountOrder,
						((sum(Amount)+sum((Amount)*coalesce(ExpressRate,0))/100)+sum(coalesce(ops_orderdetail.AdditionAmount,0)))-sum(coalesce(ops_orderdetail.DiscountAmount,0)) as total
						from (ops_orderdetail left join (ops_order left join (mas_branch left join mas_branchtype on mas_branch.BranchType=mas_branchtype.BranchTypeID)
						on ops_order.BranchID=mas_branch.BranchID) on ops_orderdetail.OrderNo=ops_order.OrderNo)
						left join mas_priceexpression on ops_order.IsExpressLevel=mas_priceexpression.IsExpressLevel
						WHERE ops_order.OrderDate BETWEEN '".$date_start."' AND '".$date_end."' AND ops_order.IsActive='1'
						AND mas_branch.BranchID='".$keywords2."'
						GROUP BY
 						mas_branchtype.BranchTypeNameTH,
 						mas_branch.BranchCode,
 						mas_branch.BranchNameTH,
 						ops_order.BranchID
 						Order By ops_order.BranchID ASC";

					$stmt1=" select top 10 ops_order.BranchID,sum(PromoDiscount) as PromoDiscount, coalesce(sum(SpecialDiscount),0) as SpecialDiscount,sum(MemberDiscount) as MemberDiscount from ops_order
							left join (mas_branch left join mas_branchtype on mas_branch.BranchID=mas_branchtype.BranchTypeID)
							on ops_order.BranchID=mas_branch.BranchID
							WHERE ops_order.OrderDate BETWEEN '".$date_start."' AND '".$date_end."' AND ops_order.IsActive='1'
							AND mas_branch.BranchID='".$keywords2."'
							GROUP BY ops_order.BranchID
							Order By ops_order.BranchID ASC";

					$stmt2="select top 10 count(distinct ops_order.OrderNo) as CountOrder
from (ops_order left join ops_orderdetail on ops_order.OrderNo=ops_orderdetail.OrderNo)
left join (mas_branch left join mas_branchtype on mas_branch.BranchID=mas_branchtype.BranchTypeID)
on ops_order.BranchID=mas_branch.BranchID
where ops_order.OrderDate BETWEEN '".$date_start."' AND '".$date_end."' AND ops_order.IsActive='1'
AND mas_branch.BranchID='".$keywords2."'
group by mas_branchtype.BranchTypeNameTH,
 		mas_branch.BranchCode,
 		mas_branch.BranchNameTH,
 		ops_order.BranchID
Order By ops_order.BranchID ASC";
					}else{
					$stmt="select top 10 mas_branchtype.BranchTypeNameTH,mas_branch.BranchCode, mas_branch.BranchNameTH,
						count(distinct ops_order.OrderNo) as CountOrder,
						((sum(Amount)+sum((Amount)*coalesce(ExpressRate,0))/100)+sum(coalesce(ops_orderdetail.AdditionAmount,0)))-sum(coalesce(ops_orderdetail.DiscountAmount,0)) as total
						from (ops_orderdetail left join (ops_order left join (mas_branch left join mas_branchtype on mas_branch.BranchType=mas_branchtype.BranchTypeID)
						on ops_order.BranchID=mas_branch.BranchID) on ops_orderdetail.OrderNo=ops_order.OrderNo)
						left join mas_priceexpression on ops_order.IsExpressLevel=mas_priceexpression.IsExpressLevel
						WHERE ops_order.OrderDate BETWEEN '".$date_start."' AND '".$date_end."' AND ops_order.IsActive='1'
						AND mas_branch.BranchType='".$keywords."'
						GROUP BY
 						mas_branchtype.BranchTypeNameTH,
 						mas_branch.BranchCode,
 						mas_branch.BranchNameTH,
 						ops_order.BranchID
 						Order By ops_order.BranchID ASC";

					$stmt1=" select top 10 ops_order.BranchID,sum(PromoDiscount) as PromoDiscount, coalesce(sum(SpecialDiscount),0) as SpecialDiscount,sum(MemberDiscount) as MemberDiscount from ops_order
							left join (mas_branch left join mas_branchtype on mas_branch.BranchID=mas_branchtype.BranchTypeID)
							on ops_order.BranchID=mas_branch.BranchID
							WHERE ops_order.OrderDate BETWEEN '".$date_start."' AND '".$date_end."' AND ops_order.IsActive='1'
							AND mas_branch.BranchType='".$keywords."'
							GROUP BY ops_order.BranchID
							Order By ops_order.BranchID ASC";

					$stmt2="select top 10 count(distinct ops_order.OrderNo) as CountOrder
from (ops_order left join ops_orderdetail on ops_order.OrderNo=ops_orderdetail.OrderNo)
left join (mas_branch left join mas_branchtype on mas_branch.BranchID=mas_branchtype.BranchTypeID)
on ops_order.BranchID=mas_branch.BranchID
where ops_order.OrderDate BETWEEN '".$date_start."' AND '".$date_end."' AND ops_order.IsActive='1'
AND mas_branch.BranchType='".$keywords."'
group by mas_branchtype.BranchTypeNameTH,
 		mas_branch.BranchCode,
 		mas_branch.BranchNameTH,
 		ops_order.BranchID
Order By ops_order.BranchID ASC";
					}}else if($_GET['select_top']==20){
					if($_GET['keywords2']=='cheese'&&$_GET['keywords']=='cheese'){
					$stmt="select top 20 mas_branchtype.BranchTypeNameTH,mas_branch.BranchCode, mas_branch.BranchNameTH,
						count(distinct ops_order.OrderNo) as CountOrder,
						((sum(Amount)+sum((Amount)*coalesce(ExpressRate,0))/100)+sum(coalesce(ops_orderdetail.AdditionAmount,0)))-sum(coalesce(ops_orderdetail.DiscountAmount,0)) as total
						from (ops_orderdetail left join (ops_order left join (mas_branch left join mas_branchtype on mas_branch.BranchType=mas_branchtype.BranchTypeID)
						on ops_order.BranchID=mas_branch.BranchID) on ops_orderdetail.OrderNo=ops_order.OrderNo)
						left join mas_priceexpression on ops_order.IsExpressLevel=mas_priceexpression.IsExpressLevel
						WHERE ops_order.OrderDate BETWEEN '".$date_start."' AND '".$date_end."' AND ops_order.IsActive='1'
						GROUP BY
 						mas_branchtype.BranchTypeNameTH,
 						mas_branch.BranchCode,
 						mas_branch.BranchNameTH,
 						ops_order.BranchID
 						Order By ops_order.BranchID ASC";

					$stmt1=" select top 20 ops_order.BranchID,sum(PromoDiscount) as PromoDiscount, coalesce(sum(SpecialDiscount),0) as SpecialDiscount,sum(MemberDiscount) as MemberDiscount from ops_order
							left join (mas_branch left join mas_branchtype on mas_branch.BranchID=mas_branchtype.BranchTypeID)
							on ops_order.BranchID=mas_branch.BranchID
							WHERE ops_order.OrderDate BETWEEN '".$date_start."' AND '".$date_end."' AND ops_order.IsActive='1'
							GROUP BY ops_order.BranchID
							Order By ops_order.BranchID ASC";

					$stmt2="select top 20 count(distinct ops_order.OrderNo) as CountOrder
from (ops_order left join ops_orderdetail on ops_order.OrderNo=ops_orderdetail.OrderNo)
left join (mas_branch left join mas_branchtype on mas_branch.BranchID=mas_branchtype.BranchTypeID)
on ops_order.BranchID=mas_branch.BranchID
where ops_order.OrderDate BETWEEN '".$date_start."' AND '".$date_end."' AND ops_order.IsActive='1'
group by mas_branchtype.BranchTypeNameTH,
 		mas_branch.BranchCode,
 		mas_branch.BranchNameTH,
 		ops_order.BranchID
Order By ops_order.BranchID ASC";
					}else if($_GET['keywords2']!='cheese'&&$_GET['keywords']=='cheese'){
 					$stmt="select top 20 mas_branchtype.BranchTypeNameTH,mas_branch.BranchCode, mas_branch.BranchNameTH,
						count(distinct ops_order.OrderNo) as CountOrder,
						((sum(Amount)+sum((Amount)*coalesce(ExpressRate,0))/100)+sum(coalesce(ops_orderdetail.AdditionAmount,0)))-sum(coalesce(ops_orderdetail.DiscountAmount,0)) as total
						from (ops_orderdetail left join (ops_order left join (mas_branch left join mas_branchtype on mas_branch.BranchType=mas_branchtype.BranchTypeID)
						on ops_order.BranchID=mas_branch.BranchID) on ops_orderdetail.OrderNo=ops_order.OrderNo)
						left join mas_priceexpression on ops_order.IsExpressLevel=mas_priceexpression.IsExpressLevel
						WHERE ops_order.OrderDate BETWEEN '".$date_start."' AND '".$date_end."' AND ops_order.IsActive='1'
						AND mas_branch.BranchID='".$keywords2."'
						GROUP BY
 						mas_branchtype.BranchTypeNameTH,
 						mas_branch.BranchCode,
 						mas_branch.BranchNameTH,
 						ops_order.BranchID
 						Order By ops_order.BranchID ASC";

					$stmt1=" select top 20 ops_order.BranchID,sum(PromoDiscount) as PromoDiscount, coalesce(sum(SpecialDiscount),0) as SpecialDiscount,sum(MemberDiscount) as MemberDiscount from ops_order
							left join (mas_branch left join mas_branchtype on mas_branch.BranchID=mas_branchtype.BranchTypeID)
							on ops_order.BranchID=mas_branch.BranchID
							WHERE ops_order.OrderDate BETWEEN '".$date_start."' AND '".$date_end."' AND ops_order.IsActive='1'
							AND mas_branch.BranchID='".$keywords2."'
							GROUP BY ops_order.BranchID
							Order By ops_order.BranchID ASC";

					$stmt2="select top 20 count(distinct ops_order.OrderNo) as CountOrder
from (ops_order left join ops_orderdetail on ops_order.OrderNo=ops_orderdetail.OrderNo)
left join (mas_branch left join mas_branchtype on mas_branch.BranchID=mas_branchtype.BranchTypeID)
on ops_order.BranchID=mas_branch.BranchID
where ops_order.OrderDate BETWEEN '".$date_start."' AND '".$date_end."' AND ops_order.IsActive='1'
AND mas_branch.BranchID='".$keywords2."'
group by mas_branchtype.BranchTypeNameTH,
 		mas_branch.BranchCode,
 		mas_branch.BranchNameTH,
 		ops_order.BranchID
Order By ops_order.BranchID ASC";
					}else{
					$stmt="select top 20 mas_branchtype.BranchTypeNameTH,mas_branch.BranchCode, mas_branch.BranchNameTH,
						count(distinct ops_order.OrderNo) as CountOrder,
						((sum(Amount)+sum((Amount)*coalesce(ExpressRate,0))/100)+sum(coalesce(ops_orderdetail.AdditionAmount,0)))-sum(coalesce(ops_orderdetail.DiscountAmount,0)) as total
						from (ops_orderdetail left join (ops_order left join (mas_branch left join mas_branchtype on mas_branch.BranchType=mas_branchtype.BranchTypeID)
						on ops_order.BranchID=mas_branch.BranchID) on ops_orderdetail.OrderNo=ops_order.OrderNo)
						left join mas_priceexpression on ops_order.IsExpressLevel=mas_priceexpression.IsExpressLevel
						WHERE ops_order.OrderDate BETWEEN '".$date_start."' AND '".$date_end."' AND ops_order.IsActive='1'
						AND mas_branch.BranchType='".$keywords."'
						GROUP BY
 						mas_branchtype.BranchTypeNameTH,
 						mas_branch.BranchCode,
 						mas_branch.BranchNameTH,
 						ops_order.BranchID
 						Order By ops_order.BranchID ASC";

					$stmt1=" select top 20 ops_order.BranchID,sum(PromoDiscount) as PromoDiscount, coalesce(sum(SpecialDiscount),0) as SpecialDiscount,sum(MemberDiscount) as MemberDiscount from ops_order
							left join (mas_branch left join mas_branchtype on mas_branch.BranchID=mas_branchtype.BranchTypeID)
							on ops_order.BranchID=mas_branch.BranchID
							WHERE ops_order.OrderDate BETWEEN '".$date_start."' AND '".$date_end."' AND ops_order.IsActive='1'
							AND mas_branch.BranchType='".$keywords."'
							GROUP BY ops_order.BranchID
							Order By ops_order.BranchID ASC";

					$stmt2="select top 20 count(distinct ops_order.OrderNo) as CountOrder
from (ops_order left join ops_orderdetail on ops_order.OrderNo=ops_orderdetail.OrderNo)
left join (mas_branch left join mas_branchtype on mas_branch.BranchID=mas_branchtype.BranchTypeID)
on ops_order.BranchID=mas_branch.BranchID
where ops_order.OrderDate BETWEEN '".$date_start."' AND '".$date_end."' AND ops_order.IsActive='1'
AND mas_branch.BranchType='".$keywords."'
group by mas_branchtype.BranchTypeNameTH,
 		mas_branch.BranchCode,
 		mas_branch.BranchNameTH,
 		ops_order.BranchID
Order By ops_order.BranchID ASC";
					}}else if($_GET['select_top']==30){
					if($_GET['keywords2']=='cheese'&&$_GET['keywords']=='cheese'){
					$stmt="select top 30 mas_branchtype.BranchTypeNameTH,mas_branch.BranchCode, mas_branch.BranchNameTH,
						count(distinct ops_order.OrderNo) as CountOrder,
						((sum(Amount)+sum((Amount)*coalesce(ExpressRate,0))/100)+sum(coalesce(ops_orderdetail.AdditionAmount,0)))-sum(coalesce(ops_orderdetail.DiscountAmount,0)) as total
						from (ops_orderdetail left join (ops_order left join (mas_branch left join mas_branchtype on mas_branch.BranchType=mas_branchtype.BranchTypeID)
						on ops_order.BranchID=mas_branch.BranchID) on ops_orderdetail.OrderNo=ops_order.OrderNo)
						left join mas_priceexpression on ops_order.IsExpressLevel=mas_priceexpression.IsExpressLevel
						WHERE ops_order.OrderDate BETWEEN '".$date_start."' AND '".$date_end."' AND ops_order.IsActive='1'
						GROUP BY
 						mas_branchtype.BranchTypeNameTH,
 						mas_branch.BranchCode,
 						mas_branch.BranchNameTH,
 						ops_order.BranchID
 						Order By ops_order.BranchID ASC";

					$stmt1=" select top 30 ops_order.BranchID,sum(PromoDiscount) as PromoDiscount, coalesce(sum(SpecialDiscount),0) as SpecialDiscount,sum(MemberDiscount) as MemberDiscount from ops_order
							left join (mas_branch left join mas_branchtype on mas_branch.BranchID=mas_branchtype.BranchTypeID)
							on ops_order.BranchID=mas_branch.BranchID
							WHERE ops_order.OrderDate BETWEEN '".$date_start."' AND '".$date_end."' AND ops_order.IsActive='1'
							GROUP BY ops_order.BranchID
							Order By ops_order.BranchID ASC";

					$stmt2="select top 30 count(distinct ops_order.OrderNo) as CountOrder
from (ops_order left join ops_orderdetail on ops_order.OrderNo=ops_orderdetail.OrderNo)
left join (mas_branch left join mas_branchtype on mas_branch.BranchID=mas_branchtype.BranchTypeID)
on ops_order.BranchID=mas_branch.BranchID
where ops_order.OrderDate BETWEEN '".$date_start."' AND '".$date_end."' AND ops_order.IsActive='1'
group by mas_branchtype.BranchTypeNameTH,
 		mas_branch.BranchCode,
 		mas_branch.BranchNameTH,
 		ops_order.BranchID
Order By ops_order.BranchID ASC";
					}else if($_GET['keywords2']!='cheese'&&$_GET['keywords']=='cheese'){
 					$stmt="select top 30 mas_branchtype.BranchTypeNameTH,mas_branch.BranchCode, mas_branch.BranchNameTH,
						count(distinct ops_order.OrderNo) as CountOrder,
						((sum(Amount)+sum((Amount)*coalesce(ExpressRate,0))/100)+sum(coalesce(ops_orderdetail.AdditionAmount,0)))-sum(coalesce(ops_orderdetail.DiscountAmount,0)) as total
						from (ops_orderdetail left join (ops_order left join (mas_branch left join mas_branchtype on mas_branch.BranchType=mas_branchtype.BranchTypeID)
						on ops_order.BranchID=mas_branch.BranchID) on ops_orderdetail.OrderNo=ops_order.OrderNo)
						left join mas_priceexpression on ops_order.IsExpressLevel=mas_priceexpression.IsExpressLevel
						WHERE ops_order.OrderDate BETWEEN '".$date_start."' AND '".$date_end."' AND ops_order.IsActive='1'
						AND mas_branch.BranchID='".$keywords2."'
						GROUP BY
 						mas_branchtype.BranchTypeNameTH,
 						mas_branch.BranchCode,
 						mas_branch.BranchNameTH,
 						ops_order.BranchID
 						Order By ops_order.BranchID ASC";

					$stmt1=" select top 30 ops_order.BranchID,sum(PromoDiscount) as PromoDiscount, coalesce(sum(SpecialDiscount),0) as SpecialDiscount,sum(MemberDiscount) as MemberDiscount from ops_order
							left join (mas_branch left join mas_branchtype on mas_branch.BranchID=mas_branchtype.BranchTypeID)
							on ops_order.BranchID=mas_branch.BranchID
							WHERE ops_order.OrderDate BETWEEN '".$date_start."' AND '".$date_end."' AND ops_order.IsActive='1'
							AND mas_branch.BranchID='".$keywords2."'
							GROUP BY ops_order.BranchID
							Order By ops_order.BranchID ASC";

					$stmt2="select top 30 count(distinct ops_order.OrderNo) as CountOrder
from (ops_order left join ops_orderdetail on ops_order.OrderNo=ops_orderdetail.OrderNo)
left join (mas_branch left join mas_branchtype on mas_branch.BranchID=mas_branchtype.BranchTypeID)
on ops_order.BranchID=mas_branch.BranchID
where ops_order.OrderDate BETWEEN '".$date_start."' AND '".$date_end."' AND ops_order.IsActive='1'
AND mas_branch.BranchID='".$keywords2."'
group by mas_branchtype.BranchTypeNameTH,
 		mas_branch.BranchCode,
 		mas_branch.BranchNameTH,
 		ops_order.BranchID
Order By ops_order.BranchID ASC";
					}else{
					$stmt="select top 30 mas_branchtype.BranchTypeNameTH,mas_branch.BranchCode, mas_branch.BranchNameTH,
						count(distinct ops_order.OrderNo) as CountOrder,
						((sum(Amount)+sum((Amount)*coalesce(ExpressRate,0))/100)+sum(coalesce(ops_orderdetail.AdditionAmount,0)))-sum(coalesce(ops_orderdetail.DiscountAmount,0)) as total
						from (ops_orderdetail left join (ops_order left join (mas_branch left join mas_branchtype on mas_branch.BranchType=mas_branchtype.BranchTypeID)
						on ops_order.BranchID=mas_branch.BranchID) on ops_orderdetail.OrderNo=ops_order.OrderNo)
						left join mas_priceexpression on ops_order.IsExpressLevel=mas_priceexpression.IsExpressLevel
						WHERE ops_order.OrderDate BETWEEN '".$date_start."' AND '".$date_end."' AND ops_order.IsActive='1'
						AND mas_branch.BranchType='".$keywords."'
						GROUP BY
 						mas_branchtype.BranchTypeNameTH,
 						mas_branch.BranchCode,
 						mas_branch.BranchNameTH,
 						ops_order.BranchID
 						Order By ops_order.BranchID ASC";

					$stmt1=" select top 30 ops_order.BranchID,sum(PromoDiscount) as PromoDiscount, coalesce(sum(SpecialDiscount),0) as SpecialDiscount,sum(MemberDiscount) as MemberDiscount from ops_order
							left join (mas_branch left join mas_branchtype on mas_branch.BranchID=mas_branchtype.BranchTypeID)
							on ops_order.BranchID=mas_branch.BranchID
							WHERE ops_order.OrderDate BETWEEN '".$date_start."' AND '".$date_end."' AND ops_order.IsActive='1'
							AND mas_branch.BranchType='".$keywords."'
							GROUP BY ops_order.BranchID
							Order By ops_order.BranchID ASC";

					$stmt2="select top 30 count(distinct ops_order.OrderNo) as CountOrder
from (ops_order left join ops_orderdetail on ops_order.OrderNo=ops_orderdetail.OrderNo)
left join (mas_branch left join mas_branchtype on mas_branch.BranchID=mas_branchtype.BranchTypeID)
on ops_order.BranchID=mas_branch.BranchID
where ops_order.OrderDate BETWEEN '".$date_start."' AND '".$date_end."' AND ops_order.IsActive='1'
AND mas_branch.BranchType='".$keywords."'
group by mas_branchtype.BranchTypeNameTH,
 		mas_branch.BranchCode,
 		mas_branch.BranchNameTH,
 		ops_order.BranchID
Order By ops_order.BranchID ASC";
					}}else if($_GET['select_top']==100){
					if($_GET['keywords2']=='cheese'&&$_GET['keywords']=='cheese'){
					$stmt="select mas_branchtype.BranchTypeNameTH,mas_branch.BranchCode, mas_branch.BranchNameTH,
						count(distinct ops_order.OrderNo) as CountOrder,
						((sum(Amount)+sum((Amount)*coalesce(ExpressRate,0))/100)+sum(coalesce(ops_orderdetail.AdditionAmount,0)))-sum(coalesce(ops_orderdetail.DiscountAmount,0)) as total
						from (ops_orderdetail left join (ops_order left join (mas_branch left join mas_branchtype on mas_branch.BranchType=mas_branchtype.BranchTypeID)
						on ops_order.BranchID=mas_branch.BranchID) on ops_orderdetail.OrderNo=ops_order.OrderNo)
						left join mas_priceexpression on ops_order.IsExpressLevel=mas_priceexpression.IsExpressLevel
						WHERE ops_order.OrderDate BETWEEN '".$date_start."' AND '".$date_end."' AND ops_order.IsActive='1'
						GROUP BY
 						mas_branchtype.BranchTypeNameTH,
 						mas_branch.BranchCode,
 						mas_branch.BranchNameTH,
 						ops_order.BranchID
 						Order By ops_order.BranchID ASC";

					$stmt1=" select ops_order.BranchID,sum(PromoDiscount) as PromoDiscount, coalesce(sum(SpecialDiscount),0) as SpecialDiscount,sum(MemberDiscount) as MemberDiscount from ops_order
							left join (mas_branch left join mas_branchtype on mas_branch.BranchID=mas_branchtype.BranchTypeID)
							on ops_order.BranchID=mas_branch.BranchID
							WHERE ops_order.OrderDate BETWEEN '".$date_start."' AND '".$date_end."' AND ops_order.IsActive='1'
							GROUP BY ops_order.BranchID
							Order By ops_order.BranchID ASC";

					$stmt2="select count(distinct ops_order.OrderNo) as CountOrder
from (ops_order left join ops_orderdetail on ops_order.OrderNo=ops_orderdetail.OrderNo)
left join (mas_branch left join mas_branchtype on mas_branch.BranchID=mas_branchtype.BranchTypeID)
on ops_order.BranchID=mas_branch.BranchID
where ops_order.OrderDate BETWEEN '".$date_start."' AND '".$date_end."' AND ops_order.IsActive='1'
group by mas_branchtype.BranchTypeNameTH,
 		mas_branch.BranchCode,
 		mas_branch.BranchNameTH,
 		ops_order.BranchID
Order By ops_order.BranchID ASC";
					}else if($_GET['keywords2']!='cheese'&&$_GET['keywords']=='cheese'){
 					$stmt="select mas_branchtype.BranchTypeNameTH,mas_branch.BranchCode, mas_branch.BranchNameTH,
						count(distinct ops_order.OrderNo) as CountOrder,
						((sum(Amount)+sum((Amount)*coalesce(ExpressRate,0))/100)+sum(coalesce(ops_orderdetail.AdditionAmount,0)))-sum(coalesce(ops_orderdetail.DiscountAmount,0)) as total
						from (ops_orderdetail left join (ops_order left join (mas_branch left join mas_branchtype on mas_branch.BranchType=mas_branchtype.BranchTypeID)
						on ops_order.BranchID=mas_branch.BranchID) on ops_orderdetail.OrderNo=ops_order.OrderNo)
						left join mas_priceexpression on ops_order.IsExpressLevel=mas_priceexpression.IsExpressLevel
						WHERE ops_order.OrderDate BETWEEN '".$date_start."' AND '".$date_end."' AND ops_order.IsActive='1'
						AND mas_branch.BranchID='".$keywords2."'
						GROUP BY
 						mas_branchtype.BranchTypeNameTH,
 						mas_branch.BranchCode,
 						mas_branch.BranchNameTH,
 						ops_order.BranchID
 						Order By ops_order.BranchID ASC";

					$stmt1=" select ops_order.BranchID,sum(PromoDiscount) as PromoDiscount, coalesce(sum(SpecialDiscount),0) as SpecialDiscount,sum(MemberDiscount) as MemberDiscount from ops_order
							left join (mas_branch left join mas_branchtype on mas_branch.BranchID=mas_branchtype.BranchTypeID)
							on ops_order.BranchID=mas_branch.BranchID
							WHERE ops_order.OrderDate BETWEEN '".$date_start."' AND '".$date_end."' AND ops_order.IsActive='1'
							AND mas_branch.BranchID='".$keywords2."'
							GROUP BY ops_order.BranchID
							Order By ops_order.BranchID ASC";

					$stmt2="select count(distinct ops_order.OrderNo) as CountOrder
from (ops_order left join ops_orderdetail on ops_order.OrderNo=ops_orderdetail.OrderNo)
left join (mas_branch left join mas_branchtype on mas_branch.BranchID=mas_branchtype.BranchTypeID)
on ops_order.BranchID=mas_branch.BranchID
where ops_order.OrderDate BETWEEN '".$date_start."' AND '".$date_end."' AND ops_order.IsActive='1'
AND mas_branch.BranchID='".$keywords2."'
group by mas_branchtype.BranchTypeNameTH,
 		mas_branch.BranchCode,
 		mas_branch.BranchNameTH,

 		ops_order.BranchID
Order By ops_order.BranchID ASC";
					}else{
					$stmt="select mas_branchtype.BranchTypeNameTH,mas_branch.BranchCode, mas_branch.BranchNameTH,
						count(distinct ops_order.OrderNo) as CountOrder,
						((sum(Amount)+sum((Amount)*coalesce(ExpressRate,0))/100)+sum(coalesce(ops_orderdetail.AdditionAmount,0)))-sum(coalesce(ops_orderdetail.DiscountAmount,0)) as total
						from (ops_orderdetail left join (ops_order left join (mas_branch left join mas_branchtype on mas_branch.BranchType=mas_branchtype.BranchTypeID)
						on ops_order.BranchID=mas_branch.BranchID) on ops_orderdetail.OrderNo=ops_order.OrderNo)
						left join mas_priceexpression on ops_order.IsExpressLevel=mas_priceexpression.IsExpressLevel
						WHERE ops_order.OrderDate BETWEEN '".$date_start."' AND '".$date_end."' AND ops_order.IsActive='1'
						AND mas_branch.BranchType='".$keywords."'
						GROUP BY
 						mas_branchtype.BranchTypeNameTH,
 						mas_branch.BranchCode,
 						mas_branch.BranchNameTH,
 						ops_order.BranchID
 						Order By ops_order.BranchID ASC";

					$stmt1=" select ops_order.BranchID,sum(PromoDiscount) as PromoDiscount, coalesce(sum(SpecialDiscount),0) as SpecialDiscount,sum(MemberDiscount) as MemberDiscount from ops_order
							left join (mas_branch left join mas_branchtype on mas_branch.BranchID=mas_branchtype.BranchTypeID)
							on ops_order.BranchID=mas_branch.BranchID
							WHERE ops_order.OrderDate BETWEEN '".$date_start."' AND '".$date_end."' AND ops_order.IsActive='1'
							AND mas_branch.BranchType='".$keywords."'
							GROUP BY ops_order.BranchID
							Order By ops_order.BranchID ASC";

					$stmt2="select count(distinct ops_order.OrderNo) as CountOrder
from (ops_order left join ops_orderdetail on ops_order.OrderNo=ops_orderdetail.OrderNo)
left join (mas_branch left join mas_branchtype on mas_branch.BranchID=mas_branchtype.BranchTypeID)
on ops_order.BranchID=mas_branch.BranchID
where ops_order.OrderDate BETWEEN '".$date_start."' AND '".$date_end."' AND ops_order.IsActive='1'
AND mas_branch.BranchType='".$keywords."'
group by mas_branchtype.BranchTypeNameTH,
 		mas_branch.BranchCode,
 		mas_branch.BranchNameTH,
 		ops_order.BranchID
Order By ops_order.BranchID ASC";
					}}else{
					if($_GET['keywords2']=='cheese'&&$_GET['keywords']=='cheese'){
					$stmt="select mas_branchtype.BranchTypeNameTH,mas_branch.BranchCode, mas_branch.BranchNameTH,
						count(distinct ops_order.OrderNo) as CountOrder,
						((sum(Amount)+sum((Amount)*coalesce(ExpressRate,0))/100)+sum(coalesce(ops_orderdetail.AdditionAmount,0)))-sum(coalesce(ops_orderdetail.DiscountAmount,0)) as total
						from (ops_orderdetail left join (ops_order left join (mas_branch left join mas_branchtype on mas_branch.BranchType=mas_branchtype.BranchTypeID)
						on ops_order.BranchID=mas_branch.BranchID) on ops_orderdetail.OrderNo=ops_order.OrderNo)
						left join mas_priceexpression on ops_order.IsExpressLevel=mas_priceexpression.IsExpressLevel
						WHERE ops_order.OrderDate BETWEEN '".$date_start."' AND '".$date_end."' AND ops_order.IsActive='1'
						GROUP BY
 						mas_branchtype.BranchTypeNameTH,
 						mas_branch.BranchCode,
 						mas_branch.BranchNameTH,
 						ops_order.BranchID
 						Order By ops_order.BranchID ASC";

					$stmt1=" select ops_order.BranchID,sum(PromoDiscount) as PromoDiscount, coalesce(sum(SpecialDiscount),0) as SpecialDiscount,sum(MemberDiscount) as MemberDiscount from ops_order
							left join (mas_branch left join mas_branchtype on mas_branch.BranchID=mas_branchtype.BranchTypeID)
							on ops_order.BranchID=mas_branch.BranchID
							WHERE ops_order.OrderDate BETWEEN '".$date_start."' AND '".$date_end."' AND ops_order.IsActive='1'
							GROUP BY ops_order.BranchID
							Order By ops_order.BranchID ASC";

					$stmt2="select count(distinct ops_order.OrderNo) as CountOrder
from (ops_order left join ops_orderdetail on ops_order.OrderNo=ops_orderdetail.OrderNo)
left join (mas_branch left join mas_branchtype on mas_branch.BranchID=mas_branchtype.BranchTypeID)
on ops_order.BranchID=mas_branch.BranchID
where ops_order.OrderDate BETWEEN '".$date_start."' AND '".$date_end."' AND ops_order.IsActive='1'
group by mas_branchtype.BranchTypeNameTH,
 		mas_branch.BranchCode,
 		mas_branch.BranchNameTH,
 		ops_order.BranchID
Order By ops_order.BranchID ASC";
 					}else if($_GET['keywords2']!='cheese'&&$_GET['keywords']=='cheese'){
 					$stmt="select mas_branchtype.BranchTypeNameTH,mas_branch.BranchCode, mas_branch.BranchNameTH,
						count(distinct ops_order.OrderNo) as CountOrder,
						((sum(Amount)+sum((Amount)*coalesce(ExpressRate,0))/100)+sum(coalesce(ops_orderdetail.AdditionAmount,0)))-sum(coalesce(ops_orderdetail.DiscountAmount,0)) as total
						from (ops_orderdetail left join (ops_order left join (mas_branch left join mas_branchtype on mas_branch.BranchType=mas_branchtype.BranchTypeID)
						on ops_order.BranchID=mas_branch.BranchID) on ops_orderdetail.OrderNo=ops_order.OrderNo)
						left join mas_priceexpression on ops_order.IsExpressLevel=mas_priceexpression.IsExpressLevel
						WHERE ops_order.OrderDate BETWEEN '".$date_start."' AND '".$date_end."' AND ops_order.IsActive='1'
						AND mas_branch.BranchID='".$keywords2."'
						GROUP BY
 						mas_branchtype.BranchTypeNameTH,
 						mas_branch.BranchCode,
 						mas_branch.BranchNameTH,
 						ops_order.BranchID
 						Order By ops_order.BranchID ASC";

					$stmt1=" select ops_order.BranchID,sum(PromoDiscount) as PromoDiscount, coalesce(sum(SpecialDiscount),0) as SpecialDiscount,sum(MemberDiscount) as MemberDiscount from ops_order
							left join (mas_branch left join mas_branchtype on mas_branch.BranchID=mas_branchtype.BranchTypeID)
							on ops_order.BranchID=mas_branch.BranchID
							WHERE ops_order.OrderDate BETWEEN '".$date_start."' AND '".$date_end."' AND ops_order.IsActive='1'
							AND mas_branch.BranchID='".$keywords2."'
							GROUP BY ops_order.BranchID
							Order By ops_order.BranchID ASC";

					$stmt2="select count(distinct ops_order.OrderNo) as CountOrder
from (ops_order left join ops_orderdetail on ops_order.OrderNo=ops_orderdetail.OrderNo)
left join (mas_branch left join mas_branchtype on mas_branch.BranchID=mas_branchtype.BranchTypeID)
on ops_order.BranchID=mas_branch.BranchID
where ops_order.OrderDate BETWEEN '".$date_start."' AND '".$date_end."' AND ops_order.IsActive='1'
AND mas_branch.BranchID='".$keywords2."'
group by mas_branchtype.BranchTypeNameTH,
 		mas_branch.BranchCode,
 		mas_branch.BranchNameTH,
 		ops_order.BranchID
Order By ops_order.BranchID ASC";
					}else{
					$stmt="select mas_branchtype.BranchTypeNameTH,mas_branch.BranchCode, mas_branch.BranchNameTH,
						count(distinct ops_order.OrderNo) as CountOrder,
						((sum(Amount)+sum((Amount)*coalesce(ExpressRate,0))/100)+sum(coalesce(ops_orderdetail.AdditionAmount,0)))-sum(coalesce(ops_orderdetail.DiscountAmount,0)) as total
						from (ops_orderdetail left join (ops_order left join (mas_branch left join mas_branchtype on mas_branch.BranchType=mas_branchtype.BranchTypeID)
						on ops_order.BranchID=mas_branch.BranchID) on ops_orderdetail.OrderNo=ops_order.OrderNo)
						left join mas_priceexpression on ops_order.IsExpressLevel=mas_priceexpression.IsExpressLevel
						WHERE ops_order.OrderDate BETWEEN '".$date_start."' AND '".$date_end."' AND ops_order.IsActive='1'
						AND mas_branch.BranchType='".$keywords."'
						GROUP BY
 						mas_branchtype.BranchTypeNameTH,
 						mas_branch.BranchCode,
 						mas_branch.BranchNameTH,
 						ops_order.BranchID
 						Order By ops_order.BranchID ASC";

					$stmt1=" select ops_order.BranchID,sum(PromoDiscount) as PromoDiscount, coalesce(sum(SpecialDiscount),0) as SpecialDiscount,sum(MemberDiscount) as MemberDiscount from ops_order
							left join (mas_branch left join mas_branchtype on mas_branch.BranchID=mas_branchtype.BranchTypeID)
							on ops_order.BranchID=mas_branch.BranchID
							WHERE ops_order.OrderDate BETWEEN '".$date_start."' AND '".$date_end."' AND ops_order.IsActive='1'
							AND mas_branch.BranchType='".$keywords."'
							GROUP BY ops_order.BranchID
							Order By ops_order.BranchID ASC";

					$stmt2="select count(distinct ops_order.OrderNo) as CountOrder
from (ops_order left join ops_orderdetail on ops_order.OrderNo=ops_orderdetail.OrderNo)
left join (mas_branch left join mas_branchtype on mas_branch.BranchID=mas_branchtype.BranchTypeID)
on ops_order.BranchID=mas_branch.BranchID
where ops_order.OrderDate BETWEEN '".$date_start."' AND '".$date_end."' AND ops_order.IsActive='1'
AND mas_branch.BranchType='".$keywords."'
group by mas_branchtype.BranchTypeNameTH,
 		mas_branch.BranchCode,
 		mas_branch.BranchNameTH,
 		ops_order.BranchID
Order By ops_order.BranchID ASC";
					}
					}
					
	$query = sqlsrv_query($conn,$stmt);
	$query1 = sqlsrv_query($conn,$stmt1);
	$query2 = sqlsrv_query($conn,$stmt2);
	
   	$object_array = array();
	$total1=0;
								$total2=0;
								$total3=0;
								$total4=0;

								$arrBranchID=array();
								$arrBranchType=array();
								$arrBranchName=array();
								$arrTotal=array();
								$arrCount=array();
								$arrSpecail=array();
								$arrMember=array();
								while($row = sqlsrv_fetch_array($query)){
										array_push($arrBranchID,$row['BranchCode']);
										array_push($arrBranchType,$row['BranchTypeNameTH']);
										array_push($arrBranchName,$row['BranchNameTH']);
										array_push($arrTotal,$row['total']);


										//$echo $row['total'];
								}
								$arrPromo=array();
								while($row1 = sqlsrv_fetch_array($query1)){
										array_push($arrPromo,$row1['PromoDiscount']);
										array_push($arrSpecail,$row1['SpecialDiscount']);
										array_push($arrMember,$row1['MemberDiscount']);
										//$echo $row1['PromoDiscount'];
								}

								while($row2 = sqlsrv_fetch_array($query2)){
										array_push($arrCount,$row2['CountOrder']);
								}

								for($i=0;$i<count($arrPromo);$i++){
									array_push($object_array,array('BranchType' => $arrBranchType[$i], 'BranchCode' => $arrBranchID[$i]
		,'BranchNameTH' => $arrBranchName[$i],'counts' => $arrCount[$i],'total' => $arrTotal[$i]-$arrPromo[$i]-$arrMember[$i],
		'SpecialDiscount' => $arrSpecail[$i],'total1' => $arrTotal[$i]-$arrPromo[$i]-$arrMember[$i]-$arrSpecail[$i]));
								}
    $json_array=json_encode($object_array);
	echo $json_array;
?>
