<?php
	include("config.php");
   	$keywords2=$_GET['keywords2'];
	$keywords=$_GET['keywords'];
	$date_start=$_GET['date_start'];
	$date_end=$_GET['date_end'];
	if($_GET['select_top']==10){
					if($_GET['keywords2']=='cheese'&&$_GET['keywords']=='cheese'){
						$stmt="SELECT top 10 mas_branch.BranchNameTH,mas_branch.BranchCode,mas_branchtype.BranchTypeNameTH,Count(distinct ops_order.OrderNo) AS cont,
					((sum(Amount)+sum((Amount)*coalesce(ExpressRate,0))/100)+sum(coalesce(ops_orderdetail.AdditionAmount,0)))-sum(coalesce(ops_orderdetail.DiscountAmount,0)) as total
					FROM ((ops_order left join (mas_branch left join mas_branchtype on mas_branch.BranchType=mas_branchtype.BranchTypeID)
					on ops_order.BranchID=mas_branch.BranchID)left join ops_orderdetail
					on ops_order.OrderNo=ops_orderdetail.OrderNo)
					left join mas_priceexpression on ops_order.IsExpressLevel=mas_priceexpression.IsExpressLevel
					WHERE ops_order.OrderDate BETWEEN '".$date_start."' AND '".$date_end."' AND ops_order.IsActive='1'
					GROUP BY  mas_branch.BranchNameTH,ops_order.BranchID,mas_branchtype.BranchTypeNameTH,mas_branch.BranchCode
					Order By ops_order.BranchID ASC";

					$stmt1="select top 10 ops_order.BranchID,sum(PromoDiscount) as PromoDiscount,sum(MemberDiscount) as MemberDiscount, coalesce(sum(SpecialDiscount),0) as SpecialDiscount from ops_order
							left join (mas_branch left join mas_branchtype on mas_branch.BranchID=mas_branchtype.BranchTypeID)
							on ops_order.BranchID=mas_branch.BranchID
							WHERE ops_order.OrderDate BETWEEN '".$date_start."' AND '".$date_end."' AND ops_order.IsActive='1'
							GROUP BY ops_order.BranchID
							Order By ops_order.BranchID ASC";
					}else if($_GET['keywords2']!='cheese'&&$_GET['keywords']=='cheese'){
							$stmt="SELECT top 10 mas_branch.BranchNameTH,mas_branch.BranchCode,mas_branchtype.BranchTypeNameTH,Count(distinct ops_order.OrderNo) AS cont,
					((sum(Amount)+sum((Amount)*coalesce(ExpressRate,0))/100)+sum(coalesce(ops_orderdetail.AdditionAmount,0)))-sum(coalesce(ops_orderdetail.DiscountAmount,0)) as total
					FROM ((ops_order left join (mas_branch left join mas_branchtype on mas_branch.BranchType=mas_branchtype.BranchTypeID)
					on ops_order.BranchID=mas_branch.BranchID)left join ops_orderdetail
					on ops_order.OrderNo=ops_orderdetail.OrderNo)
					left join mas_priceexpression on ops_order.IsExpressLevel=mas_priceexpression.IsExpressLevel
					WHERE ops_order.OrderDate BETWEEN '".$date_start."' AND '".$date_end."' AND ops_order.IsActive='1'
					AND mas_branch.BranchID='".$keywords2."'
					GROUP BY  mas_branch.BranchNameTH,ops_order.BranchID,mas_branchtype.BranchTypeNameTH,mas_branch.BranchCode
					Order By ops_order.BranchID ASC";

					$stmt1="select top 10 ops_order.BranchID,sum(PromoDiscount) as PromoDiscount,sum(MemberDiscount) as MemberDiscount, coalesce(sum(SpecialDiscount),0) as SpecialDiscount from ops_order
							left join (mas_branch left join mas_branchtype on mas_branch.BranchID=mas_branchtype.BranchTypeID)
							on ops_order.BranchID=mas_branch.BranchID
							WHERE ops_order.OrderDate BETWEEN '".$date_start."' AND '".$date_end."' AND ops_order.IsActive='1'
							AND mas_branch.BranchID='".$keywords2."'
							GROUP BY ops_order.BranchID
							Order By ops_order.BranchID ASC";
						}
						else{
							$stmt="SELECT top 10 mas_branch.BranchNameTH,mas_branch.BranchCode,mas_branchtype.BranchTypeNameTH,Count(distinct ops_order.OrderNo) AS cont,
					((sum(Amount)+sum((Amount)*coalesce(ExpressRate,0))/100)+sum(coalesce(ops_orderdetail.AdditionAmount,0)))-sum(coalesce(ops_orderdetail.DiscountAmount,0)) as total
					FROM ((ops_order left join (mas_branch left join mas_branchtype on mas_branch.BranchType=mas_branchtype.BranchTypeID)
					on ops_order.BranchID=mas_branch.BranchID)left join ops_orderdetail
					on ops_order.OrderNo=ops_orderdetail.OrderNo)
					left join mas_priceexpression on ops_order.IsExpressLevel=mas_priceexpression.IsExpressLevel
					WHERE ops_order.OrderDate BETWEEN '".$date_start."' AND '".$date_end."' AND ops_order.IsActive='1'
					AND  mas_branch.BranchType='".$keywords."'
					GROUP BY  mas_branch.BranchNameTH,ops_order.BranchID,mas_branchtype.BranchTypeNameTH,mas_branch.BranchCode
					Order By ops_order.BranchID ASC";

							$stmt1="select top 10 ops_order.BranchID,sum(PromoDiscount) as PromoDiscount,sum(MemberDiscount) as MemberDiscount, coalesce(sum(SpecialDiscount),0) as SpecialDiscount from ops_order
							left join (mas_branch left join mas_branchtype on mas_branch.BranchID=mas_branchtype.BranchTypeID)
							on ops_order.BranchID=mas_branch.BranchID
							WHERE ops_order.OrderDate BETWEEN '".$date_start."' AND '".$date_end."' AND ops_order.IsActive='1'
							AND  mas_branch.BranchType='".$keywords."'
							GROUP BY ops_order.BranchID
							Order By ops_order.BranchID ASC";
						}
					}
					else if($_GET['select_top']==20){
					if($_GET['keywords2']=='cheese'&&$_GET['keywords']=='cheese'){
					$stmt="SELECT top 20 mas_branch.BranchNameTH,mas_branch.BranchCode,mas_branchtype.BranchTypeNameTH,Count(distinct ops_order.OrderNo) AS cont,
					((sum(Amount)+sum((Amount)*coalesce(ExpressRate,0))/100)+sum(coalesce(ops_orderdetail.AdditionAmount,0)))-sum(coalesce(ops_orderdetail.DiscountAmount,0)) as total
					FROM ((ops_order left join (mas_branch left join mas_branchtype on mas_branch.BranchType=mas_branchtype.BranchTypeID)
					on ops_order.BranchID=mas_branch.BranchID)left join ops_orderdetail
					on ops_order.OrderNo=ops_orderdetail.OrderNo)
					left join mas_priceexpression on ops_order.IsExpressLevel=mas_priceexpression.IsExpressLevel
					WHERE ops_order.OrderDate BETWEEN '".$date_start."' AND '".$date_end."' AND ops_order.IsActive='1'
					GROUP BY  mas_branch.BranchNameTH,ops_order.BranchID,mas_branchtype.BranchTypeNameTH,mas_branch.BranchCode
					Order By ops_order.BranchID ASC";

					$stmt1="select top 20 ops_order.BranchID,sum(PromoDiscount) as PromoDiscount,sum(MemberDiscount) as MemberDiscount, coalesce(sum(SpecialDiscount),0) as SpecialDiscount from ops_order
							left join (mas_branch left join mas_branchtype on mas_branch.BranchID=mas_branchtype.BranchTypeID)
							on ops_order.BranchID=mas_branch.BranchID
							WHERE ops_order.OrderDate BETWEEN '".$date_start."' AND '".$date_end."' AND ops_order.IsActive='1'
							GROUP BY ops_order.BranchID
							Order By ops_order.BranchID ASC";
					}else if($_GET['keywords2']!='cheese'&&$_GET['keywords']=='cheese'){
							$stmt="SELECT top 20 mas_branch.BranchNameTH,mas_branch.BranchCode,mas_branchtype.BranchTypeNameTH,Count(distinct ops_order.OrderNo) AS cont,
					((sum(Amount)+sum((Amount)*coalesce(ExpressRate,0))/100)+sum(coalesce(ops_orderdetail.AdditionAmount,0)))-sum(coalesce(ops_orderdetail.DiscountAmount,0)) as total
					FROM ((ops_order left join (mas_branch left join mas_branchtype on mas_branch.BranchType=mas_branchtype.BranchTypeID)
					on ops_order.BranchID=mas_branch.BranchID)left join ops_orderdetail
					on ops_order.OrderNo=ops_orderdetail.OrderNo)
					left join mas_priceexpression on ops_order.IsExpressLevel=mas_priceexpression.IsExpressLevel
					WHERE ops_order.OrderDate BETWEEN '".$date_start."' AND '".$date_end."' AND ops_order.IsActive='1'
					AND mas_branch.BranchID='".$keywords2."'
					GROUP BY  mas_branch.BranchNameTH,ops_order.BranchID,mas_branchtype.BranchTypeNameTH,mas_branch.BranchCode
					Order By ops_order.BranchID ASC";

					$stmt1="select top 20 ops_order.BranchID,sum(PromoDiscount) as PromoDiscount,sum(MemberDiscount) as MemberDiscount, coalesce(sum(SpecialDiscount),0) as SpecialDiscount from ops_order
							left join (mas_branch left join mas_branchtype on mas_branch.BranchID=mas_branchtype.BranchTypeID)
							on ops_order.BranchID=mas_branch.BranchID
							WHERE ops_order.OrderDate BETWEEN '".$date_start."' AND '".$date_end."' AND ops_order.IsActive='1'
							AND mas_branch.BranchID='".$keywords2."'
							GROUP BY ops_order.BranchID
							Order By ops_order.BranchID ASC";
						}
						else{
							$stmt="SELECT top 20 mas_branch.BranchNameTH,mas_branch.BranchCode,mas_branchtype.BranchTypeNameTH,Count(distinct ops_order.OrderNo) AS cont,
					((sum(Amount)+sum((Amount)*coalesce(ExpressRate,0))/100)+sum(coalesce(ops_orderdetail.AdditionAmount,0)))-sum(coalesce(ops_orderdetail.DiscountAmount,0)) as total
					FROM ((ops_order left join (mas_branch left join mas_branchtype on mas_branch.BranchType=mas_branchtype.BranchTypeID)
					on ops_order.BranchID=mas_branch.BranchID)left join ops_orderdetail
					on ops_order.OrderNo=ops_orderdetail.OrderNo)
					left join mas_priceexpression on ops_order.IsExpressLevel=mas_priceexpression.IsExpressLevel
					WHERE ops_order.OrderDate BETWEEN '".$date_start."' AND '".$date_end."' AND ops_order.IsActive='1'
					AND  mas_branch.BranchType='".$keywords."'
					GROUP BY  mas_branch.BranchNameTH,ops_order.BranchID,mas_branchtype.BranchTypeNameTH,mas_branch.BranchCode
					Order By ops_order.BranchID ASC";

							$stmt1="select top 20 ops_order.BranchID,sum(PromoDiscount) as PromoDiscount,sum(MemberDiscount) as MemberDiscount, coalesce(sum(SpecialDiscount),0) as SpecialDiscount from ops_order
							left join (mas_branch left join mas_branchtype on mas_branch.BranchID=mas_branchtype.BranchTypeID)
							on ops_order.BranchID=mas_branch.BranchID
							WHERE ops_order.OrderDate BETWEEN '".$date_start."' AND '".$date_end."' AND ops_order.IsActive='1'
							AND  mas_branch.BranchType='".$keywords."'
							GROUP BY ops_order.BranchID
							Order By ops_order.BranchID ASC";
						}
					}
					else if($_GET['select_top']==30){
					if($_GET['keywords2']=='cheese'&&$_GET['keywords']=='cheese'){
					$stmt="SELECT top 30 mas_branch.BranchNameTH,mas_branch.BranchCode,mas_branchtype.BranchTypeNameTH,Count(distinct ops_order.OrderNo) AS cont,
					((sum(Amount)+sum((Amount)*coalesce(ExpressRate,0))/100)+sum(coalesce(ops_orderdetail.AdditionAmount,0)))-sum(coalesce(ops_orderdetail.DiscountAmount,0)) as total
					FROM ((ops_order left join (mas_branch left join mas_branchtype on mas_branch.BranchType=mas_branchtype.BranchTypeID)
					on ops_order.BranchID=mas_branch.BranchID)left join ops_orderdetail
					on ops_order.OrderNo=ops_orderdetail.OrderNo)
					left join mas_priceexpression on ops_order.IsExpressLevel=mas_priceexpression.IsExpressLevel
					WHERE ops_order.OrderDate BETWEEN '".$date_start."' AND '".$date_end."' AND ops_order.IsActive='1'
					GROUP BY  mas_branch.BranchNameTH,ops_order.BranchID,mas_branchtype.BranchTypeNameTH,mas_branch.BranchCode
					Order By ops_order.BranchID ASC";

					$stmt1="select top 30 ops_order.BranchID,sum(PromoDiscount) as PromoDiscount, coalesce(sum(SpecialDiscount),0) as SpecialDiscount from ops_order
							left join (mas_branch left join mas_branchtype on mas_branch.BranchID=mas_branchtype.BranchTypeID)
							on ops_order.BranchID=mas_branch.BranchID
							WHERE ops_order.OrderDate BETWEEN '".$date_start."' AND '".$date_end."' AND ops_order.IsActive='1'
							GROUP BY ops_order.BranchID
							Order By ops_order.BranchID ASC";
					}else if($_GET['keywords2']!='cheese'&&$_GET['keywords']=='cheese'){
							$stmt="SELECT top 30 mas_branch.BranchNameTH,mas_branch.BranchCode,mas_branchtype.BranchTypeNameTH,Count(distinct ops_order.OrderNo) AS cont,
					((sum(Amount)+sum((Amount)*coalesce(ExpressRate,0))/100)+sum(coalesce(ops_orderdetail.AdditionAmount,0)))-sum(coalesce(ops_orderdetail.DiscountAmount,0)) as total
					FROM ((ops_order left join (mas_branch left join mas_branchtype on mas_branch.BranchType=mas_branchtype.BranchTypeID)
					on ops_order.BranchID=mas_branch.BranchID)left join ops_orderdetail
					on ops_order.OrderNo=ops_orderdetail.OrderNo)
					left join mas_priceexpression on ops_order.IsExpressLevel=mas_priceexpression.IsExpressLevel
					WHERE ops_order.OrderDate BETWEEN '".$date_start."' AND '".$date_end."' AND ops_order.IsActive='1'
					AND mas_branch.BranchID='".$keywords2."'
					GROUP BY  mas_branch.BranchNameTH,ops_order.BranchID,mas_branchtype.BranchTypeNameTH,mas_branch.BranchCode
					Order By ops_order.BranchID ASC";

					$stmt1="select top 30 ops_order.BranchID,sum(PromoDiscount) as PromoDiscount,sum(MemberDiscount) as MemberDiscount, coalesce(sum(SpecialDiscount),0) as SpecialDiscount from ops_order
							left join (mas_branch left join mas_branchtype on mas_branch.BranchID=mas_branchtype.BranchTypeID)
							on ops_order.BranchID=mas_branch.BranchID
							WHERE ops_order.OrderDate BETWEEN '".$date_start."' AND '".$date_end."' AND ops_order.IsActive='1'
							AND mas_branch.BranchID='".$keywords2."'
							GROUP BY ops_order.BranchID
							Order By ops_order.BranchID ASC";
						}
						else{
							$stmt="SELECT top 30 mas_branch.BranchNameTH,mas_branch.BranchCode,mas_branchtype.BranchTypeNameTH,Count(distinct ops_order.OrderNo) AS cont,
					((sum(Amount)+sum((Amount)*coalesce(ExpressRate,0))/100)+sum(coalesce(ops_orderdetail.AdditionAmount,0)))-sum(coalesce(ops_orderdetail.DiscountAmount,0)) as total
					FROM ((ops_order left join (mas_branch left join mas_branchtype on mas_branch.BranchType=mas_branchtype.BranchTypeID)
					on ops_order.BranchID=mas_branch.BranchID)left join ops_orderdetail
					on ops_order.OrderNo=ops_orderdetail.OrderNo)
					left join mas_priceexpression on ops_order.IsExpressLevel=mas_priceexpression.IsExpressLevel
					WHERE ops_order.OrderDate BETWEEN '".$date_start."' AND '".$date_end."' AND ops_order.IsActive='1'
					AND  mas_branch.BranchType='".$keywords."'
					GROUP BY  mas_branch.BranchNameTH,ops_order.BranchID,mas_branchtype.BranchTypeNameTH,mas_branch.BranchCode
					Order By ops_order.BranchID ASC";

							$stmt1="select top 30 ops_order.BranchID,sum(PromoDiscount) as PromoDiscount,sum(MemberDiscount) as MemberDiscount, coalesce(sum(SpecialDiscount),0) as SpecialDiscount from ops_order
							left join (mas_branch left join mas_branchtype on mas_branch.BranchID=mas_branchtype.BranchTypeID)
							on ops_order.BranchID=mas_branch.BranchID
							WHERE ops_order.OrderDate BETWEEN '".$date_start."' AND '".$date_end."' AND ops_order.IsActive='1'
							AND  mas_branch.BranchType='".$keywords."'
							GROUP BY ops_order.BranchID
							Order By ops_order.BranchID ASC";
						}
					}
					else if($_GET['select_top']==100){
					if($_GET['keywords2']=='cheese'&&$_GET['keywords']=='cheese'){
					$stmt="SELECT  mas_branch.BranchNameTH,mas_branch.BranchCode,mas_branchtype.BranchTypeNameTH,Count(distinct ops_order.OrderNo) AS cont,
					((sum(Amount)+sum((Amount)*coalesce(ExpressRate,0))/100)+sum(coalesce(ops_orderdetail.AdditionAmount,0)))-sum(coalesce(ops_orderdetail.DiscountAmount,0)) as total
					FROM ((ops_order left join (mas_branch left join mas_branchtype on mas_branch.BranchType=mas_branchtype.BranchTypeID)
					on ops_order.BranchID=mas_branch.BranchID)left join ops_orderdetail
					on ops_order.OrderNo=ops_orderdetail.OrderNo)
					left join mas_priceexpression on ops_order.IsExpressLevel=mas_priceexpression.IsExpressLevel
					WHERE ops_order.OrderDate BETWEEN '".$date_start."' AND '".$date_end."' AND ops_order.IsActive='1'
					GROUP BY  mas_branch.BranchNameTH,ops_order.BranchID,mas_branchtype.BranchTypeNameTH,mas_branch.BranchCode
					Order By ops_order.BranchID ASC";

					$stmt1="select ops_order.BranchID,sum(PromoDiscount) as PromoDiscount,sum(MemberDiscount) as MemberDiscount, coalesce(sum(SpecialDiscount),0) as SpecialDiscount from ops_order
							left join (mas_branch left join mas_branchtype on mas_branch.BranchID=mas_branchtype.BranchTypeID)
							on ops_order.BranchID=mas_branch.BranchID
							WHERE ops_order.OrderDate BETWEEN '".$date_start."' AND '".$date_end."' AND ops_order.IsActive='1'
							GROUP BY ops_order.BranchID
							Order By ops_order.BranchID ASC";
					}else if($_GET['keywords2']!='cheese'&&$_GET['keywords']=='cheese'){
							$stmt="SELECT mas_branch.BranchNameTH,mas_branch.BranchCode,mas_branchtype.BranchTypeNameTH,Count(distinct ops_order.OrderNo) AS cont,
					((sum(Amount)+sum((Amount)*coalesce(ExpressRate,0))/100)+sum(coalesce(ops_orderdetail.AdditionAmount,0)))-sum(coalesce(ops_orderdetail.DiscountAmount,0)) as total
					FROM ((ops_order left join (mas_branch left join mas_branchtype on mas_branch.BranchType=mas_branchtype.BranchTypeID)
					on ops_order.BranchID=mas_branch.BranchID)left join ops_orderdetail
					on ops_order.OrderNo=ops_orderdetail.OrderNo)
					left join mas_priceexpression on ops_order.IsExpressLevel=mas_priceexpression.IsExpressLevel
					WHERE ops_order.OrderDate BETWEEN '".$date_start."' AND '".$date_end."' AND ops_order.IsActive='1'
					AND mas_branch.BranchID='".$keywords2."'
					GROUP BY  mas_branch.BranchNameTH,ops_order.BranchID,mas_branchtype.BranchTypeNameTH,mas_branch.BranchCode
					Order By ops_order.BranchID ASC";

					$stmt1="select ops_order.BranchID,sum(PromoDiscount) as PromoDiscount,sum(MemberDiscount) as MemberDiscount, coalesce(sum(SpecialDiscount),0) as SpecialDiscount from ops_order
							left join (mas_branch left join mas_branchtype on mas_branch.BranchID=mas_branchtype.BranchTypeID)
							on ops_order.BranchID=mas_branch.BranchID
							WHERE ops_order.OrderDate BETWEEN '".$date_start."' AND '".$date_end."' AND ops_order.IsActive='1'
							AND mas_branch.BranchID='".$keywords2."'
							GROUP BY ops_order.BranchID
							Order By ops_order.BranchID ASC";
						}
						else{
							$stmt="SELECT mas_branch.BranchNameTH,mas_branch.BranchCode,mas_branchtype.BranchTypeNameTH,Count(distinct ops_order.OrderNo) AS cont,
					((sum(Amount)+sum((Amount)*coalesce(ExpressRate,0))/100)+sum(coalesce(ops_orderdetail.AdditionAmount,0)))-sum(coalesce(ops_orderdetail.DiscountAmount,0)) as total
					FROM ((ops_order left join (mas_branch left join mas_branchtype on mas_branch.BranchType=mas_branchtype.BranchTypeID)
					on ops_order.BranchID=mas_branch.BranchID)left join ops_orderdetail
					on ops_order.OrderNo=ops_orderdetail.OrderNo)
					left join mas_priceexpression on ops_order.IsExpressLevel=mas_priceexpression.IsExpressLevel
					WHERE ops_order.OrderDate BETWEEN '".$date_start."' AND '".$date_end."' AND ops_order.IsActive='1'
					AND  mas_branch.BranchType='".$keywords."'
					GROUP BY  mas_branch.BranchNameTH,ops_order.BranchID,mas_branchtype.BranchTypeNameTH,mas_branch.BranchCode
					Order By ops_order.BranchID ASC";

							$stmt1="select ops_order.BranchID,sum(PromoDiscount) as PromoDiscount,sum(MemberDiscount) as MemberDiscount, coalesce(sum(SpecialDiscount),0) as SpecialDiscount from ops_order
							left join (mas_branch left join mas_branchtype on mas_branch.BranchID=mas_branchtype.BranchTypeID)
							on ops_order.BranchID=mas_branch.BranchID
							WHERE ops_order.OrderDate BETWEEN '".$date_start."' AND '".$date_end."' AND ops_order.IsActive='1'
							AND  mas_branch.BranchType='".$keywords."'
							GROUP BY ops_order.BranchID
							Order By ops_order.BranchID ASC";
						}
					}
					else{
						if($_GET['keywords2']=='cheese'&&$_GET['keywords']=='cheese'){
						$stmt="SELECT mas_branch.BranchNameTH,mas_branch.BranchCode,mas_branchtype.BranchTypeNameTH,Count(distinct ops_order.OrderNo) AS cont,
					((sum(Amount)+sum((Amount)*coalesce(ExpressRate,0))/100)+sum(coalesce(ops_orderdetail.AdditionAmount,0)))-sum(coalesce(ops_orderdetail.DiscountAmount,0)) as total
					FROM ((ops_order left join (mas_branch left join mas_branchtype on mas_branch.BranchType=mas_branchtype.BranchTypeID)
					on ops_order.BranchID=mas_branch.BranchID)left join ops_orderdetail
					on ops_order.OrderNo=ops_orderdetail.OrderNo)
					left join mas_priceexpression on ops_order.IsExpressLevel=mas_priceexpression.IsExpressLevel
					WHERE ops_order.OrderDate BETWEEN '".$date_start."' AND '".$date_end."' AND ops_order.IsActive='1'
					GROUP BY  mas_branch.BranchNameTH,ops_order.BranchID,mas_branchtype.BranchTypeNameTH,mas_branch.BranchCode
					Order By ops_order.BranchID ASC";

					$stmt1="select ops_order.BranchID,sum(PromoDiscount) as PromoDiscount,sum(MemberDiscount) as MemberDiscount, coalesce(sum(SpecialDiscount),0) as SpecialDiscount from ops_order
							left join (mas_branch left join mas_branchtype on mas_branch.BranchID=mas_branchtype.BranchTypeID)
							on ops_order.BranchID=mas_branch.BranchID
							WHERE ops_order.OrderDate BETWEEN '".$date_start."' AND '".$date_end."' AND ops_order.IsActive='1'
							GROUP BY ops_order.BranchID
							Order By ops_order.BranchID ASC";

						}else if($_GET['keywords2']!='cheese'&&$_GET['keywords']=='cheese'){
							$stmt="SELECT mas_branch.BranchNameTH,mas_branch.BranchCode,mas_branchtype.BranchTypeNameTH,Count(distinct ops_order.OrderNo) AS cont,
					((sum(Amount)+sum((Amount)*coalesce(ExpressRate,0))/100)+sum(coalesce(ops_orderdetail.AdditionAmount,0)))-sum(coalesce(ops_orderdetail.DiscountAmount,0)) as total
					FROM ((ops_order left join (mas_branch left join mas_branchtype on mas_branch.BranchType=mas_branchtype.BranchTypeID)
					on ops_order.BranchID=mas_branch.BranchID)left join ops_orderdetail
					on ops_order.OrderNo=ops_orderdetail.OrderNo)
					left join mas_priceexpression on ops_order.IsExpressLevel=mas_priceexpression.IsExpressLevel
					WHERE ops_order.OrderDate BETWEEN '".$date_start."' AND '".$date_end."' AND ops_order.IsActive='1'
					AND mas_branch.BranchID='".$keywords2."'
					GROUP BY  mas_branch.BranchNameTH,ops_order.BranchID,mas_branchtype.BranchTypeNameTH,mas_branch.BranchCode
					Order By ops_order.BranchID ASC";

					$stmt1="select ops_order.BranchID,sum(PromoDiscount) as PromoDiscount,sum(MemberDiscount) as MemberDiscount, coalesce(sum(SpecialDiscount),0) as SpecialDiscount from ops_order
							left join (mas_branch left join mas_branchtype on mas_branch.BranchID=mas_branchtype.BranchTypeID)
							on ops_order.BranchID=mas_branch.BranchID
							WHERE ops_order.OrderDate BETWEEN '".$date_start."' AND '".$date_end."' AND ops_order.IsActive='1'
							AND mas_branch.BranchID='".$keywords2."'
							GROUP BY ops_order.BranchID
							Order By ops_order.BranchID ASC";
						}

						else if($_GET['keywords']!='cheese'){
							$stmt="SELECT mas_branch.BranchNameTH,mas_branch.BranchCode,mas_branchtype.BranchTypeNameTH,Count(distinct ops_order.OrderNo) AS cont,
					((sum(Amount)+sum((Amount)*coalesce(ExpressRate,0))/100)+sum(coalesce(ops_orderdetail.AdditionAmount,0)))-sum(coalesce(ops_orderdetail.DiscountAmount,0)) as total
					FROM ((ops_order left join (mas_branch left join mas_branchtype on mas_branch.BranchType=mas_branchtype.BranchTypeID)
					on ops_order.BranchID=mas_branch.BranchID)left join ops_orderdetail
					on ops_order.OrderNo=ops_orderdetail.OrderNo)
					left join mas_priceexpression on ops_order.IsExpressLevel=mas_priceexpression.IsExpressLevel
					WHERE ops_order.OrderDate BETWEEN '".$date_start."' AND '".$date_end."' AND ops_order.IsActive='1'
					AND mas_branch.BranchType='".$keywords."'
					GROUP BY  mas_branch.BranchNameTH,ops_order.BranchID,mas_branchtype.BranchTypeNameTH,mas_branch.BranchCode
					Order By ops_order.BranchID ASC";

							$stmt1="select ops_order.BranchID,sum(PromoDiscount) as PromoDiscount,sum(MemberDiscount) as MemberDiscount, coalesce(sum(SpecialDiscount),0) as SpecialDiscount from ops_order
							left join (mas_branch left join mas_branchtype on mas_branch.BranchID=mas_branchtype.BranchTypeID)
							on ops_order.BranchID=mas_branch.BranchID
							WHERE ops_order.OrderDate BETWEEN '".$date_start."' AND '".$date_end."' AND ops_order.IsActive='1'
							AND mas_branch.BranchType='".$keywords."'
							GROUP BY ops_order.BranchID
							Order By ops_order.BranchID ASC";
						}
					}
					$query = sqlsrv_query($conn,$stmt);
					$query1 = sqlsrv_query($conn,$stmt1);
	
    				$object_array = array();
					
					$arrBranchID=array();
					$arrBranchType=array();
					$arrBranchName=array();
					$arrTotal=array();
					$arrSpecail=array();
					$arrMember=array();
					while($row = sqlsrv_fetch_array($query)){
						array_push($arrBranchID,$row['BranchCode']);
						array_push($arrBranchType,$row['BranchTypeNameTH']);
						array_push($arrBranchName,$row['BranchNameTH']);
						array_push($arrTotal,$row['total']);
					}
					$arrPromo=array();
					while($row1 = sqlsrv_fetch_array($query1)){
						array_push($arrPromo,$row1['PromoDiscount']);
						array_push($arrSpecail,$row1['SpecialDiscount']);
						array_push($arrMember,$row1['MemberDiscount']);
					}
					for($i=0;$i<count($arrPromo);$i++){
						array_push($object_array,array('BranchType' => $arrBranchType[$i], 'BranchID' => $arrBranchID[$i]
		,'BranchNameTH' => $arrBranchName[$i],'Total' => $arrTotal[$i]-$arrPromo[$i]-$arrMember[$i],
		'Specail' => $arrSpecail[$i],'Total1' => ($arrTotal[$i]-$arrPromo[$i]-$arrMember[$i])-$arrSpecail[$i]));
					}
    $json_array=json_encode($object_array);
	echo $json_array;
?>
