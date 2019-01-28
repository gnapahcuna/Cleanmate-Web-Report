<?php
	include("config.php");
   	$keywords2=$_GET['keywords2'];
	$keywords1=$_GET['keywords1'];
	$keywords=$_GET['keywords'];
	$date_start=$_GET['date_start'];
	$date_end=$_GET['date_end'];
	
	if($_GET['select_top']==10){
					if($_GET['keywords']=='cheese'&&$_GET['keywords1']=='cheese'&&$_GET['keywords2']=='cheese'){
					$stmt="select top 10 odd.ProductNameTH,
                    Count(case when b.BranchType = 1 then 1 else null end) as service1,
                    Count(case when b.BranchType = 2 then 1 else null end) as service2,
                    Count(case when b.BranchType = 3 then 1 else null end) as service3
                     from (ops_order od left join (ops_orderdetail odd left join mas_product pd on odd.ProductID=pd.ProductID)
                     on od.OrderNo=odd.OrderNo )
                     left join (mas_branch b left join mas_branchtype bt on b.BranchType=bt.BranchTypeID) on od.BranchID=b.BranchID
                     where od.OrderDate BETWEEN '".$date_start."' AND '".$date_end."' AND od.IsActive='1'
                     GROUP BY odd.ProductNameTH";
						}elseif($_GET['keywords']!='cheese'&&$_GET['keywords1']=='cheese'&&$_GET['keywords2']=='cheese'){
						$stmt=" select top 10 odd.ProductNameTH,
                        Count(case when b.BranchType = 1 then 1 else null end) as service1,
                        Count(case when b.BranchType = 2 then 1 else null end) as service2,
                        Count(case when b.BranchType = 3 then 1 else null end) as service3
                         from (ops_order od left join (ops_orderdetail odd left join mas_product pd on odd.ProductID=pd.ProductID)
                         on od.OrderNo=odd.OrderNo )
                         left join (mas_branch b left join mas_branchtype bt on b.BranchType=bt.BranchTypeID) on od.BranchID=b.BranchID
                         where od.OrderDate BETWEEN '".$date_start."' AND '".$date_end."' AND od.IsActive='1' and b.BranchType='".$keywords."'
                         GROUP BY odd.ProductNameTH";
						}elseif($_GET['keywords']=='cheese'&&$_GET['keywords1']!='cheese'&&$_GET['keywords2']=='cheese'){
						$stmt=" select top 10 odd.ProductNameTH,
                        Count(case when b.BranchType = 1 then 1 else null end) as service1,
                        Count(case when b.BranchType = 2 then 1 else null end) as service2,
                        Count(case when b.BranchType = 3 then 1 else null end) as service3
                         from (ops_order od left join (ops_orderdetail odd left join mas_product pd on odd.ProductID=pd.ProductID)
                         on od.OrderNo=odd.OrderNo )
                         left join (mas_branch b left join mas_branchtype bt on b.BranchType=bt.BranchTypeID) on od.BranchID=b.BranchID
                         where od.OrderDate BETWEEN '".$date_start."' AND '".$date_end."' AND od.IsActive='1' and b.BranchID='".$keywords1."'
                         GROUP BY odd.ProductNameTH";
						}elseif($_GET['keywords']=='cheese'&&$_GET['keywords1']!='cheese'&&$_GET['keywords2']=='cheese'){
						$stmt=" select top 10 odd.ProductNameTH,
                        Count(case when b.BranchType = 1 then 1 else null end) as service1,
                        Count(case when b.BranchType = 2 then 1 else null end) as service2,
                        Count(case when b.BranchType = 3 then 1 else null end) as service3
                         from (ops_order od left join (ops_orderdetail odd left join mas_product pd on odd.ProductID=pd.ProductID)
                         on od.OrderNo=odd.OrderNo )
                         left join (mas_branch b left join mas_branchtype bt on b.BranchType=bt.BranchTypeID) on od.BranchID=b.BranchID
                         where od.OrderDate BETWEEN '".$date_start."' AND '".$date_end."' AND od.IsActive='1' and b.BranchID='".$keywords1."'
                         and b.BranchType='".$keywords."'
                         GROUP BY odd.ProductNameTH";
						}else if($_GET['keywords']=='cheese'&&$_GET['keywords1']=='cheese'&&$_GET['keywords2']!='cheese'){
					$stmt=" select top 10 odd.ProductNameTH,
                    Count(case when b.BranchType = 1 then 1 else null end) as service1,
                    Count(case when b.BranchType = 2 then 1 else null end) as service2,
                    Count(case when b.BranchType = 3 then 1 else null end) as service3
                     from (ops_order od left join (ops_orderdetail odd left join mas_product pd on odd.ProductID=pd.ProductID)
                     on od.OrderNo=odd.OrderNo )
                     left join (mas_branch b left join mas_branchtype bt on b.BranchType=bt.BranchTypeID) on od.BranchID=b.BranchID
                     where od.OrderDate BETWEEN '".$date_start."' AND '".$date_end."' AND od.IsActive='1' and odd.ProductID='".$keywords2."'
                     GROUP BY odd.ProductNameTH";
					}else{
					$stmt=" select top 10 odd.ProductNameTH,
                    Count(case when b.BranchType = 1 then 1 else null end) as service1,
                    Count(case when b.BranchType = 2 then 1 else null end) as service2,
                    Count(case when b.BranchType = 3 then 1 else null end) as service3
                     from (ops_order od left join (ops_orderdetail odd left join mas_product pd on odd.ProductID=pd.ProductID)
                     on od.OrderNo=odd.OrderNo )
                     left join (mas_branch b left join mas_branchtype bt on b.BranchType=bt.BranchTypeID) on od.BranchID=b.BranchID
                     where od.OrderDate BETWEEN '".$date_start."' AND '".$date_end."' AND od.IsActive='1'
                     GROUP BY odd.ProductNameTH";
					}}else if($_GET['select_top']==20){
					if($_GET['keywords']=='cheese'&&$_GET['keywords1']=='cheese'&&$_GET['keywords2']=='cheese'){
					$stmt="select top 20 odd.ProductNameTH,
                    Count(case when b.BranchType = 1 then 1 else null end) as service1,
                    Count(case when b.BranchType = 2 then 1 else null end) as service2,
                    Count(case when b.BranchType = 3 then 1 else null end) as service3
                     from (ops_order od left join (ops_orderdetail odd left join mas_product pd on odd.ProductID=pd.ProductID)
                     on od.OrderNo=odd.OrderNo )
                     left join (mas_branch b left join mas_branchtype bt on b.BranchType=bt.BranchTypeID) on od.BranchID=b.BranchID
                     where od.OrderDate BETWEEN '".$date_start."' AND '".$date_end."' AND od.IsActive='1'
                     GROUP BY odd.ProductNameTH";
						}elseif($_GET['keywords']!='cheese'&&$_GET['keywords1']=='cheese'&&$_GET['keywords2']=='cheese'){
						$stmt=" select top 20 odd.ProductNameTH,
                        Count(case when b.BranchType = 1 then 1 else null end) as service1,
                        Count(case when b.BranchType = 2 then 1 else null end) as service2,
                        Count(case when b.BranchType = 3 then 1 else null end) as service3
                         from (ops_order od left join (ops_orderdetail odd left join mas_product pd on odd.ProductID=pd.ProductID)
                         on od.OrderNo=odd.OrderNo )
                         left join (mas_branch b left join mas_branchtype bt on b.BranchType=bt.BranchTypeID) on od.BranchID=b.BranchID
                         where od.OrderDate BETWEEN '".$date_start."' AND '".$date_end."' AND od.IsActive='1' and b.BranchType='".$keywords."'
                         GROUP BY odd.ProductNameTH";
						}elseif($_GET['keywords']=='cheese'&&$_GET['keywords1']!='cheese'&&$_GET['keywords2']=='cheese'){
						$stmt=" select top 20 odd.ProductNameTH,
                        Count(case when b.BranchType = 1 then 1 else null end) as service1,
                        Count(case when b.BranchType = 2 then 1 else null end) as service2,
                        Count(case when b.BranchType = 3 then 1 else null end) as service3
                         from (ops_order od left join (ops_orderdetail odd left join mas_product pd on odd.ProductID=pd.ProductID)
                         on od.OrderNo=odd.OrderNo )
                         left join (mas_branch b left join mas_branchtype bt on b.BranchType=bt.BranchTypeID) on od.BranchID=b.BranchID
                         where od.OrderDate BETWEEN '".$date_start."' AND '".$date_end."' AND od.IsActive='1' and b.BranchID='".$keywords1."'
                         GROUP BY odd.ProductNameTH";
						}elseif($_GET['keywords']=='cheese'&&$_GET['keywords1']!='cheese'&&$_GET['keywords2']=='cheese'){
						$stmt=" select top 20 odd.ProductNameTH,
                        Count(case when b.BranchType = 1 then 1 else null end) as service1,
                        Count(case when b.BranchType = 2 then 1 else null end) as service2,
                        Count(case when b.BranchType = 3 then 1 else null end) as service3
                         from (ops_order od left join (ops_orderdetail odd left join mas_product pd on odd.ProductID=pd.ProductID)
                         on od.OrderNo=odd.OrderNo )
                         left join (mas_branch b left join mas_branchtype bt on b.BranchType=bt.BranchTypeID) on od.BranchID=b.BranchID
                         where od.OrderDate BETWEEN '".$date_start."' AND '".$date_end."' AND od.IsActive='1' and b.BranchID='".$keywords1."'
                         and b.BranchType='".$keywords."'
                         GROUP BY odd.ProductNameTH";
						}else if($_GET['keywords']=='cheese'&&$_GET['keywords1']=='cheese'&&$_GET['keywords2']!='cheese'){
					$stmt=" select top 20 odd.ProductNameTH,
                    Count(case when b.BranchType = 1 then 1 else null end) as service1,
                    Count(case when b.BranchType = 2 then 1 else null end) as service2,
                    Count(case when b.BranchType = 3 then 1 else null end) as service3
                     from (ops_order od left join (ops_orderdetail odd left join mas_product pd on odd.ProductID=pd.ProductID)
                     on od.OrderNo=odd.OrderNo )
                     left join (mas_branch b left join mas_branchtype bt on b.BranchType=bt.BranchTypeID) on od.BranchID=b.BranchID
                     where od.OrderDate BETWEEN '".$date_start."' AND '".$date_end."' AND od.IsActive='1' and odd.ProductID='".$keywords2."'
                     GROUP BY odd.ProductNameTH";
					}else{
					$stmt=" select top 20 odd.ProductNameTH,
                    Count(case when b.BranchType = 1 then 1 else null end) as service1,
                    Count(case when b.BranchType = 2 then 1 else null end) as service2,
                    Count(case when b.BranchType = 3 then 1 else null end) as service3
                     from (ops_order od left join (ops_orderdetail odd left join mas_product pd on odd.ProductID=pd.ProductID)
                     on od.OrderNo=odd.OrderNo )
                     left join (mas_branch b left join mas_branchtype bt on b.BranchType=bt.BranchTypeID) on od.BranchID=b.BranchID
                     where od.OrderDate BETWEEN '".$date_start."' AND '".$date_end."' AND od.IsActive='1'
                     GROUP BY odd.ProductNameTH";
					}}else if($_GET['select_top']==30){
					if($_GET['keywords']=='cheese'&&$_GET['keywords1']=='cheese'&&$_GET['keywords2']=='cheese'){
					$stmt="select top 30 odd.ProductNameTH,
                    Count(case when b.BranchType = 1 then 1 else null end) as service1,
                    Count(case when b.BranchType = 2 then 1 else null end) as service2,
                    Count(case when b.BranchType = 3 then 1 else null end) as service3
                     from (ops_order od left join (ops_orderdetail odd left join mas_product pd on odd.ProductID=pd.ProductID)
                     on od.OrderNo=odd.OrderNo )
                     left join (mas_branch b left join mas_branchtype bt on b.BranchType=bt.BranchTypeID) on od.BranchID=b.BranchID
                     where od.OrderDate BETWEEN '".$date_start."' AND '".$date_end."' AND od.IsActive='1'
                     GROUP BY odd.ProductNameTH";
						}elseif($_GET['keywords']!='cheese'&&$_GET['keywords1']=='cheese'&&$_GET['keywords2']=='cheese'){
						$stmt=" select top 30 odd.ProductNameTH,
                        Count(case when b.BranchType = 1 then 1 else null end) as service1,
                        Count(case when b.BranchType = 2 then 1 else null end) as service2,
                        Count(case when b.BranchType = 3 then 1 else null end) as service3
                         from (ops_order od left join (ops_orderdetail odd left join mas_product pd on odd.ProductID=pd.ProductID)
                         on od.OrderNo=odd.OrderNo )
                         left join (mas_branch b left join mas_branchtype bt on b.BranchType=bt.BranchTypeID) on od.BranchID=b.BranchID
                         where od.OrderDate BETWEEN '".$date_start."' AND '".$date_end."' AND od.IsActive='1' and b.BranchType='".$keywords."'
                         GROUP BY odd.ProductNameTH";
						}elseif($_GET['keywords']=='cheese'&&$_GET['keywords1']!='cheese'&&$_GET['keywords2']=='cheese'){
						$stmt=" select top 30 odd.ProductNameTH,
                        Count(case when b.BranchType = 1 then 1 else null end) as service1,
                        Count(case when b.BranchType = 2 then 1 else null end) as service2,
                        Count(case when b.BranchType = 3 then 1 else null end) as service3
                         from (ops_order od left join (ops_orderdetail odd left join mas_product pd on odd.ProductID=pd.ProductID)
                         on od.OrderNo=odd.OrderNo )
                         left join (mas_branch b left join mas_branchtype bt on b.BranchType=bt.BranchTypeID) on od.BranchID=b.BranchID
                         where od.OrderDate BETWEEN '".$date_start."' AND '".$date_end."' AND od.IsActive='1' and b.BranchID='".$keywords1."'
                         GROUP BY odd.ProductNameTH";
						}elseif($_GET['keywords']=='cheese'&&$_GET['keywords1']!='cheese'&&$_GET['keywords2']=='cheese'){
						$stmt=" select top 30 odd.ProductNameTH,
                        Count(case when b.BranchType = 1 then 1 else null end) as service1,
                        Count(case when b.BranchType = 2 then 1 else null end) as service2,
                        Count(case when b.BranchType = 3 then 1 else null end) as service3
                         from (ops_order od left join (ops_orderdetail odd left join mas_product pd on odd.ProductID=pd.ProductID)
                         on od.OrderNo=odd.OrderNo )
                         left join (mas_branch b left join mas_branchtype bt on b.BranchType=bt.BranchTypeID) on od.BranchID=b.BranchID
                         where od.OrderDate BETWEEN '".$date_start."' AND '".$date_end."' AND od.IsActive='1' and b.BranchID='".$keywords1."'
                         and b.BranchType='".$keywords."'
                         GROUP BY odd.ProductNameTH";
						}else if($_GET['keywords']=='cheese'&&$_GET['keywords1']=='cheese'&&$_GET['keywords2']!='cheese'){
					$stmt=" select top 30 odd.ProductNameTH,
                    Count(case when b.BranchType = 1 then 1 else null end) as service1,
                    Count(case when b.BranchType = 2 then 1 else null end) as service2,
                    Count(case when b.BranchType = 3 then 1 else null end) as service3
                     from (ops_order od left join (ops_orderdetail odd left join mas_product pd on odd.ProductID=pd.ProductID)
                     on od.OrderNo=odd.OrderNo )
                     left join (mas_branch b left join mas_branchtype bt on b.BranchType=bt.BranchTypeID) on od.BranchID=b.BranchID
                     where od.OrderDate BETWEEN '".$date_start."' AND '".$date_end."' AND od.IsActive='1' and odd.ProductID='".$keywords2."'
                     GROUP BY odd.ProductNameTH";
					}else{
					$stmt=" select top 30 odd.ProductNameTH,
                    Count(case when b.BranchType = 1 then 1 else null end) as service1,
                    Count(case when b.BranchType = 2 then 1 else null end) as service2,
                    Count(case when b.BranchType = 3 then 1 else null end) as service3
                     from (ops_order od left join (ops_orderdetail odd left join mas_product pd on odd.ProductID=pd.ProductID)
                     on od.OrderNo=odd.OrderNo )
                     left join (mas_branch b left join mas_branchtype bt on b.BranchType=bt.BranchTypeID) on od.BranchID=b.BranchID
                     where od.OrderDate BETWEEN '".$date_start."' AND '".$date_end."' AND od.IsActive='1'
                     GROUP BY odd.ProductNameTH";
					}}else if($_GET['select_top']==100){
					if($_GET['keywords']=='cheese'&&$_GET['keywords1']=='cheese'&&$_GET['keywords2']=='cheese'){
					$stmt=" select odd.ProductNameTH,
                    Count(case when b.BranchType = 1 then 1 else null end) as service1,
                    Count(case when b.BranchType = 2 then 1 else null end) as service2,
                    Count(case when b.BranchType = 3 then 1 else null end) as service3
                     from (ops_order od left join (ops_orderdetail odd left join mas_product pd on odd.ProductID=pd.ProductID)
                     on od.OrderNo=odd.OrderNo )
                     left join (mas_branch b left join mas_branchtype bt on b.BranchType=bt.BranchTypeID) on od.BranchID=b.BranchID
                     where od.OrderDate BETWEEN '".$date_start."' AND '".$date_end."' AND od.IsActive='1'
                     GROUP BY odd.ProductNameTH";
						}elseif($_GET['keywords']!='cheese'&&$_GET['keywords1']=='cheese'&&$_GET['keywords2']=='cheese'){
						$stmt=" select odd.ProductNameTH,
                        Count(case when b.BranchType = 1 then 1 else null end) as service1,
                        Count(case when b.BranchType = 2 then 1 else null end) as service2,
                        Count(case when b.BranchType = 3 then 1 else null end) as service3
                         from (ops_order od left join (ops_orderdetail odd left join mas_product pd on odd.ProductID=pd.ProductID)
                         on od.OrderNo=odd.OrderNo )
                         left join (mas_branch b left join mas_branchtype bt on b.BranchType=bt.BranchTypeID) on od.BranchID=b.BranchID
                         where od.OrderDate BETWEEN '".$date_start."' AND '".$date_end."' AND od.IsActive='1' and b.BranchType='".$keywords."'
                         GROUP BY odd.ProductNameTH";
						}elseif($_GET['keywords']=='cheese'&&$_GET['keywords1']!='cheese'&&$_GET['keywords2']=='cheese'){
						$stmt=" select odd.ProductNameTH,
                        Count(case when b.BranchType = 1 then 1 else null end) as service1,
                        Count(case when b.BranchType = 2 then 1 else null end) as service2,
                        Count(case when b.BranchType = 3 then 1 else null end) as service3
                         from (ops_order od left join (ops_orderdetail odd left join mas_product pd on odd.ProductID=pd.ProductID)
                         on od.OrderNo=odd.OrderNo )
                         left join (mas_branch b left join mas_branchtype bt on b.BranchType=bt.BranchTypeID) on od.BranchID=b.BranchID
                         where od.OrderDate BETWEEN '".$date_start."' AND '".$date_end."' AND od.IsActive='1' and b.BranchID='".$keywords1."'
                         GROUP BY odd.ProductNameTH";
						}elseif($_GET['keywords']=='cheese'&&$_GET['keywords1']!='cheese'&&$_GET['keywords2']=='cheese'){
						$stmt=" select odd.ProductNameTH,
                        Count(case when b.BranchType = 1 then 1 else null end) as service1,
                        Count(case when b.BranchType = 2 then 1 else null end) as service2,
                        Count(case when b.BranchType = 3 then 1 else null end) as service3
                         from (ops_order od left join (ops_orderdetail odd left join mas_product pd on odd.ProductID=pd.ProductID)
                         on od.OrderNo=odd.OrderNo )
                         left join (mas_branch b left join mas_branchtype bt on b.BranchType=bt.BranchTypeID) on od.BranchID=b.BranchID
                         where od.OrderDate BETWEEN '".$date_start."' AND '".$date_end."' AND od.IsActive='1' and b.BranchID='".$keywords1."'
                         and b.BranchType='".$keywords."'
                         GROUP BY odd.ProductNameTH";
						}else if($_GET['keywords']=='cheese'&&$_GET['keywords1']=='cheese'&&$_GET['keywords2']!='cheese'){
					$stmt=" select odd.ProductNameTH,
                    Count(case when b.BranchType = 1 then 1 else null end) as service1,
                    Count(case when b.BranchType = 2 then 1 else null end) as service2,
                    Count(case when b.BranchType = 3 then 1 else null end) as service3
                     from (ops_order od left join (ops_orderdetail odd left join mas_product pd on odd.ProductID=pd.ProductID)
                     on od.OrderNo=odd.OrderNo )
                     left join (mas_branch b left join mas_branchtype bt on b.BranchType=bt.BranchTypeID) on od.BranchID=b.BranchID
                     where od.OrderDate BETWEEN '".$date_start."' AND '".$date_end."' AND od.IsActive='1' and odd.ProductID='".$keywords2."'
                     GROUP BY odd.ProductNameTH";
					}else{
					$stmt=" select odd.ProductNameTH,
                    Count(case when b.BranchType = 1 then 1 else null end) as service1,
                    Count(case when b.BranchType = 2 then 1 else null end) as service2,
                    Count(case when b.BranchType = 3 then 1 else null end) as service3
                     from (ops_order od left join (ops_orderdetail odd left join mas_product pd on odd.ProductID=pd.ProductID)
                     on od.OrderNo=odd.OrderNo )
                     left join (mas_branch b left join mas_branchtype bt on b.BranchType=bt.BranchTypeID) on od.BranchID=b.BranchID
                     where od.OrderDate BETWEEN '".$date_start."' AND '".$date_end."' AND od.IsActive='1'
                     GROUP BY odd.ProductNameTH";
					}
					}else{
					if($_GET['keywords']=='cheese'&&$_GET['keywords1']=='cheese'&&$_GET['keywords2']=='cheese'){
					$stmt=" select odd.ProductNameTH,
                    Count(case when b.BranchType = 1 then 1 else null end) as service1,
                    Count(case when b.BranchType = 2 then 1 else null end) as service2,
                    Count(case when b.BranchType = 3 then 1 else null end) as service3
                     from (ops_order od left join (ops_orderdetail odd left join mas_product pd on odd.ProductID=pd.ProductID)
                     on od.OrderNo=odd.OrderNo )
                     left join (mas_branch b left join mas_branchtype bt on b.BranchType=bt.BranchTypeID) on od.BranchID=b.BranchID
                     where od.OrderDate BETWEEN '".$date_start."' AND '".$date_end."' AND od.IsActive='1'
                     GROUP BY odd.ProductNameTH";
                    }elseif($_GET['keywords']!='cheese'&&$_GET['keywords1']=='cheese'&&$_GET['keywords2']=='cheese'){
						$stmt=" select odd.ProductNameTH,
                        Count(case when b.BranchType = 1 then 1 else null end) as service1,
                        Count(case when b.BranchType = 2 then 1 else null end) as service2,
                        Count(case when b.BranchType = 3 then 1 else null end) as service3
                         from (ops_order od left join (ops_orderdetail odd left join mas_product pd on odd.ProductID=pd.ProductID)
                         on od.OrderNo=odd.OrderNo )
                         left join (mas_branch b left join mas_branchtype bt on b.BranchType=bt.BranchTypeID) on od.BranchID=b.BranchID
                         where od.OrderDate BETWEEN '".$date_start."' AND '".$date_end."' AND od.IsActive='1' and b.BranchType='".$keywords."'
                         GROUP BY odd.ProductNameTH";
						}elseif($_GET['keywords']=='cheese'&&$_GET['keywords1']!='cheese'&&$_GET['keywords2']=='cheese'){
						$stmt=" select odd.ProductNameTH,
                        Count(case when b.BranchType = 1 then 1 else null end) as service1,
                        Count(case when b.BranchType = 2 then 1 else null end) as service2,
                        Count(case when b.BranchType = 3 then 1 else null end) as service3
                         from (ops_order od left join (ops_orderdetail odd left join mas_product pd on odd.ProductID=pd.ProductID)
                         on od.OrderNo=odd.OrderNo )
                         left join (mas_branch b left join mas_branchtype bt on b.BranchType=bt.BranchTypeID) on od.BranchID=b.BranchID
                         where od.OrderDate BETWEEN '".$date_start."' AND '".$date_end."' AND od.IsActive='1' and b.BranchID='".$keywords1."'
                         GROUP BY odd.ProductNameTH";
						}elseif($_GET['keywords']=='cheese'&&$_GET['keywords1']!='cheese'&&$_GET['keywords2']=='cheese'){
						$stmt=" select odd.ProductNameTH,
                        Count(case when b.BranchType = 1 then 1 else null end) as service1,
                        Count(case when b.BranchType = 2 then 1 else null end) as service2,
                        Count(case when b.BranchType = 3 then 1 else null end) as service3
                         from (ops_order od left join (ops_orderdetail odd left join mas_product pd on odd.ProductID=pd.ProductID)
                         on od.OrderNo=odd.OrderNo )
                         left join (mas_branch b left join mas_branchtype bt on b.BranchType=bt.BranchTypeID) on od.BranchID=b.BranchID
                         where od.OrderDate BETWEEN '".$date_start."' AND '".$date_end."' AND od.IsActive='1' and b.BranchID='".$keywords1."'
                         and b.BranchType='".$keywords."'
                         GROUP BY odd.ProductNameTH";
						}else if($_GET['keywords']=='cheese'&&$_GET['keywords1']=='cheese'&&$_GET['keywords2']!='cheese'){
					$stmt=" select odd.ProductNameTH,
                    Count(case when b.BranchType = 1 then 1 else null end) as service1,
                    Count(case when b.BranchType = 2 then 1 else null end) as service2,
                    Count(case when b.BranchType = 3 then 1 else null end) as service3
                     from (ops_order od left join (ops_orderdetail odd left join mas_product pd on odd.ProductID=pd.ProductID)
                     on od.OrderNo=odd.OrderNo )
                     left join (mas_branch b left join mas_branchtype bt on b.BranchType=bt.BranchTypeID) on od.BranchID=b.BranchID
                     where od.OrderDate BETWEEN '".$date_start."' AND '".$date_end."' AND od.IsActive='1' and odd.ProductID='".$keywords2."'
                     GROUP BY odd.ProductNameTH";
					}else{
					$stmt=" select odd.ProductNameTH,
                    Count(case when b.BranchType = 1 then 1 else null end) as service1,
                    Count(case when b.BranchType = 2 then 1 else null end) as service2,
                    Count(case when b.BranchType = 3 then 1 else null end) as service3
                     from (ops_order od left join (ops_orderdetail odd left join mas_product pd on odd.ProductID=pd.ProductID)
                     on od.OrderNo=odd.OrderNo )
                     left join (mas_branch b left join mas_branchtype bt on b.BranchType=bt.BranchTypeID) on od.BranchID=b.BranchID
                     where od.OrderDate BETWEEN '".$date_start."' AND '".$date_end."' AND od.IsActive='1'
                     GROUP BY odd.ProductNameTH";
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
