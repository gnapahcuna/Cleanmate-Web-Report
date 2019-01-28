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
					$stmt="select top 10 bt.BranchTypeNameTH,
                    b.BranchCode,b.BranchNameTH,
                     coalesce (SUM(CASE WHEN pd.CategoryID = 1 then 1 else null end),0) AS service1,
                     coalesce (SUM(CASE WHEN pd.CategoryID = 2 then 1 else null end),0) AS service2,
                     coalesce (SUM(CASE WHEN pd.CategoryID = 3 then 1 else null end),0) AS service3,
                     coalesce (SUM(CASE WHEN pd.CategoryID = 4 then 1 else null end),0) AS service4,
                     coalesce (SUM(CASE WHEN pd.CategoryID = 5 then 1 else null end),0) AS service5,
                     coalesce (SUM(CASE WHEN pd.CategoryID = 6 then 1 else null end),0) AS service6,
                     coalesce (SUM(CASE WHEN pd.CategoryID = 7 then 1 else null end),0) AS service7,
                      coalesce (SUM(case when pd.CategoryID = 1 then 1 else null end),0) +
                     coalesce (SUM(case when pd.CategoryID = 2 then 1 else null end),0) +
                     coalesce (SUM(case when pd.CategoryID = 3 then 1 else null end),0) +
                     coalesce (SUM(case when pd.CategoryID = 4 then 1 else null end),0) +
                     coalesce (SUM(case when pd.CategoryID = 5 then 1 else null end),0) +
                     coalesce (SUM(case when pd.CategoryID = 6 then 1 else null end),0) +
                    coalesce (SUM(case when pd.CategoryID = 7 then 1 else null end),0) AS total
                    from (ops_order od left join (ops_orderdetail odd left join mas_product pd on odd.ProductID=pd.ProductID)
                    on od.OrderNo=odd.OrderNo )
                    left join (mas_branch b left join mas_branchtype bt on b.BranchType=bt.BranchTypeID) on od.BranchID=b.BranchID
                    where od.OrderDate BETWEEN '".$date_start."' AND '".$date_end."' AND od.IsActive='1'
                    Group by bt.BranchTypeNameTH,
                    b.BranchCode,b.BranchNameTH";
						}else if($_GET['keywords2']!='cheese'&&$_GET['keywords']=='cheese'){
						$stmt="select top 10 bt.BranchTypeNameTH,
                        b.BranchCode,b.BranchNameTH,
                         coalesce (SUM(CASE WHEN pd.CategoryID = 1 then 1 else null end),0) AS service1,
                         coalesce (SUM(CASE WHEN pd.CategoryID = 2 then 1 else null end),0) AS service2,
                         coalesce (SUM(CASE WHEN pd.CategoryID = 3 then 1 else null end),0) AS service3,
                         coalesce (SUM(CASE WHEN pd.CategoryID = 4 then 1 else null end),0) AS service4,
                         coalesce (SUM(CASE WHEN pd.CategoryID = 5 then 1 else null end),0) AS service5,
                         coalesce (SUM(CASE WHEN pd.CategoryID = 6 then 1 else null end),0) AS service6,
                         coalesce (SUM(CASE WHEN pd.CategoryID = 7 then 1 else null end),0) AS service7,
                          coalesce (SUM(case when pd.CategoryID = 1 then 1 else null end),0) +
                         coalesce (SUM(case when pd.CategoryID = 2 then 1 else null end),0) +
                         coalesce (SUM(case when pd.CategoryID = 3 then 1 else null end),0) +
                         coalesce (SUM(case when pd.CategoryID = 4 then 1 else null end),0) +
                         coalesce (SUM(case when pd.CategoryID = 5 then 1 else null end),0) +
                         coalesce (SUM(case when pd.CategoryID = 6 then 1 else null end),0) +
                        coalesce (SUM(case when pd.CategoryID = 7 then 1 else null end),0) AS total
                        from (ops_order od left join (ops_orderdetail odd left join mas_product pd on odd.ProductID=pd.ProductID)
                        on od.OrderNo=odd.OrderNo )
                        left join (mas_branch b left join mas_branchtype bt on b.BranchType=bt.BranchTypeID) on od.BranchID=b.BranchID
                        where od.OrderDate BETWEEN '".$date_start."' AND '".$date_end."' AND od.IsActive='1' AND b.BranchID='".$keywords2."'
                        Group by bt.BranchTypeNameTH,
                        b.BranchCode,b.BranchNameTH";
						}
						else{
					$stmt="select top 10 bt.BranchTypeNameTH,
                    b.BranchCode,b.BranchNameTH,
                     coalesce (SUM(CASE WHEN pd.CategoryID = 1 then 1 else null end),0) AS service1,
                     coalesce (SUM(CASE WHEN pd.CategoryID = 2 then 1 else null end),0) AS service2,
                     coalesce (SUM(CASE WHEN pd.CategoryID = 3 then 1 else null end),0) AS service3,
                     coalesce (SUM(CASE WHEN pd.CategoryID = 4 then 1 else null end),0) AS service4,
                     coalesce (SUM(CASE WHEN pd.CategoryID = 5 then 1 else null end),0) AS service5,
                     coalesce (SUM(CASE WHEN pd.CategoryID = 6 then 1 else null end),0) AS service6,
                     coalesce (SUM(CASE WHEN pd.CategoryID = 7 then 1 else null end),0) AS service7,
                      coalesce (SUM(case when pd.CategoryID = 1 then 1 else null end),0) +
                     coalesce (SUM(case when pd.CategoryID = 2 then 1 else null end),0) +
                     coalesce (SUM(case when pd.CategoryID = 3 then 1 else null end),0) +
                     coalesce (SUM(case when pd.CategoryID = 4 then 1 else null end),0) +
                     coalesce (SUM(case when pd.CategoryID = 5 then 1 else null end),0) +
                     coalesce (SUM(case when pd.CategoryID = 6 then 1 else null end),0) +
                    coalesce (SUM(case when pd.CategoryID = 7 then 1 else null end),0) AS total
                    from (ops_order od left join (ops_orderdetail odd left join mas_product pd on odd.ProductID=pd.ProductID)
                    on od.OrderNo=odd.OrderNo )
                    left join (mas_branch b left join mas_branchtype bt on b.BranchType=bt.BranchTypeID) on od.BranchID=b.BranchID
                    where od.OrderDate BETWEEN '".$date_start."' AND '".$date_end."' AND od.IsActive='1' AND b.BranchType='".$keywords."'
                    Group by bt.BranchTypeNameTH,
                    b.BranchCode,b.BranchNameTH";
				}
                    }
                    else if($_GET['select_top']==20){
                    if($_GET['keywords2']=='cheese'&&$_GET['keywords']=='cheese'){
					$stmt="select top 20 bt.BranchTypeNameTH,
                    b.BranchCode,b.BranchNameTH,
                     coalesce (SUM(CASE WHEN pd.CategoryID = 1 then 1 else null end),0) AS service1,
                     coalesce (SUM(CASE WHEN pd.CategoryID = 2 then 1 else null end),0) AS service2,
                     coalesce (SUM(CASE WHEN pd.CategoryID = 3 then 1 else null end),0) AS service3,
                     coalesce (SUM(CASE WHEN pd.CategoryID = 4 then 1 else null end),0) AS service4,
                     coalesce (SUM(CASE WHEN pd.CategoryID = 5 then 1 else null end),0) AS service5,
                     coalesce (SUM(CASE WHEN pd.CategoryID = 6 then 1 else null end),0) AS service6,
                     coalesce (SUM(CASE WHEN pd.CategoryID = 7 then 1 else null end),0) AS service7,
                      coalesce (SUM(case when pd.CategoryID = 1 then 1 else null end),0) +
                     coalesce (SUM(case when pd.CategoryID = 2 then 1 else null end),0) +
                     coalesce (SUM(case when pd.CategoryID = 3 then 1 else null end),0) +
                     coalesce (SUM(case when pd.CategoryID = 4 then 1 else null end),0) +
                     coalesce (SUM(case when pd.CategoryID = 5 then 1 else null end),0) +
                     coalesce (SUM(case when pd.CategoryID = 6 then 1 else null end),0) +
                    coalesce (SUM(case when pd.CategoryID = 7 then 1 else null end),0) AS total
                    from (ops_order od left join (ops_orderdetail odd left join mas_product pd on odd.ProductID=pd.ProductID)
                    on od.OrderNo=odd.OrderNo )
                    left join (mas_branch b left join mas_branchtype bt on b.BranchType=bt.BranchTypeID) on od.BranchID=b.BranchID
                    where od.OrderDate BETWEEN '".$date_start."' AND '".$date_end."' AND od.IsActive='1'
                    Group by bt.BranchTypeNameTH,
                    b.BranchCode,b.BranchNameTH";
						}else if($_GET['keywords2']!='cheese'&&$_GET['keywords']=='cheese'){
						$stmt="select top 20 bt.BranchTypeNameTH,
                        b.BranchCode,b.BranchNameTH,
                         coalesce (SUM(CASE WHEN pd.CategoryID = 1 then 1 else null end),0) AS service1,
                         coalesce (SUM(CASE WHEN pd.CategoryID = 2 then 1 else null end),0) AS service2,
                         coalesce (SUM(CASE WHEN pd.CategoryID = 3 then 1 else null end),0) AS service3,
                         coalesce (SUM(CASE WHEN pd.CategoryID = 4 then 1 else null end),0) AS service4,
                         coalesce (SUM(CASE WHEN pd.CategoryID = 5 then 1 else null end),0) AS service5,
                         coalesce (SUM(CASE WHEN pd.CategoryID = 6 then 1 else null end),0) AS service6,
                         coalesce (SUM(CASE WHEN pd.CategoryID = 7 then 1 else null end),0) AS service7,
                          coalesce (SUM(case when pd.CategoryID = 1 then 1 else null end),0) +
                         coalesce (SUM(case when pd.CategoryID = 2 then 1 else null end),0) +
                         coalesce (SUM(case when pd.CategoryID = 3 then 1 else null end),0) +
                         coalesce (SUM(case when pd.CategoryID = 4 then 1 else null end),0) +
                         coalesce (SUM(case when pd.CategoryID = 5 then 1 else null end),0) +
                         coalesce (SUM(case when pd.CategoryID = 6 then 1 else null end),0) +
                        coalesce (SUM(case when pd.CategoryID = 7 then 1 else null end),0) AS total
                        from (ops_order od left join (ops_orderdetail odd left join mas_product pd on odd.ProductID=pd.ProductID)
                        on od.OrderNo=odd.OrderNo )
                        left join (mas_branch b left join mas_branchtype bt on b.BranchType=bt.BranchTypeID) on od.BranchID=b.BranchID
                        where od.OrderDate BETWEEN '".$date_start."' AND '".$date_end."' AND od.IsActive='1' AND b.BranchID='".$keywords2."'
                        Group by bt.BranchTypeNameTH,
                        b.BranchCode,b.BranchNameTH";
						}
						else{
					$stmt="select top 20 bt.BranchTypeNameTH,
                    b.BranchCode,b.BranchNameTH,
                     coalesce (SUM(CASE WHEN pd.CategoryID = 1 then 1 else null end),0) AS service1,
                     coalesce (SUM(CASE WHEN pd.CategoryID = 2 then 1 else null end),0) AS service2,
                     coalesce (SUM(CASE WHEN pd.CategoryID = 3 then 1 else null end),0) AS service3,
                     coalesce (SUM(CASE WHEN pd.CategoryID = 4 then 1 else null end),0) AS service4,
                     coalesce (SUM(CASE WHEN pd.CategoryID = 5 then 1 else null end),0) AS service5,
                     coalesce (SUM(CASE WHEN pd.CategoryID = 6 then 1 else null end),0) AS service6,
                     coalesce (SUM(CASE WHEN pd.CategoryID = 7 then 1 else null end),0) AS service7,
                      coalesce (SUM(case when pd.CategoryID = 1 then 1 else null end),0) +
                     coalesce (SUM(case when pd.CategoryID = 2 then 1 else null end),0) +
                     coalesce (SUM(case when pd.CategoryID = 3 then 1 else null end),0) +
                     coalesce (SUM(case when pd.CategoryID = 4 then 1 else null end),0) +
                     coalesce (SUM(case when pd.CategoryID = 5 then 1 else null end),0) +
                     coalesce (SUM(case when pd.CategoryID = 6 then 1 else null end),0) +
                    coalesce (SUM(case when pd.CategoryID = 7 then 1 else null end),0) AS total
                    from (ops_order od left join (ops_orderdetail odd left join mas_product pd on odd.ProductID=pd.ProductID)
                    on od.OrderNo=odd.OrderNo )
                    left join (mas_branch b left join mas_branchtype bt on b.BranchType=bt.BranchTypeID) on od.BranchID=b.BranchID
                    where od.OrderDate BETWEEN '".$date_start."' AND '".$date_end."' AND od.IsActive='1' AND b.BranchType='".$keywords."'
                    Group by bt.BranchTypeNameTH,
                    b.BranchCode,b.BranchNameTH";
				}}else if($_GET['select_top']==30){
					if($_GET['keywords2']=='cheese'&&$_GET['keywords']=='cheese'){
					$stmt="select top 30 bt.BranchTypeNameTH,
                    b.BranchCode,b.BranchNameTH,
                     coalesce (SUM(CASE WHEN pd.CategoryID = 1 then 1 else null end),0) AS service1,
                     coalesce (SUM(CASE WHEN pd.CategoryID = 2 then 1 else null end),0) AS service2,
                     coalesce (SUM(CASE WHEN pd.CategoryID = 3 then 1 else null end),0) AS service3,
                     coalesce (SUM(CASE WHEN pd.CategoryID = 4 then 1 else null end),0) AS service4,
                     coalesce (SUM(CASE WHEN pd.CategoryID = 5 then 1 else null end),0) AS service5,
                     coalesce (SUM(CASE WHEN pd.CategoryID = 6 then 1 else null end),0) AS service6,
                     coalesce (SUM(CASE WHEN pd.CategoryID = 7 then 1 else null end),0) AS service7,
                      coalesce (SUM(case when pd.CategoryID = 1 then 1 else null end),0) +
                     coalesce (SUM(case when pd.CategoryID = 2 then 1 else null end),0) +
                     coalesce (SUM(case when pd.CategoryID = 3 then 1 else null end),0) +
                     coalesce (SUM(case when pd.CategoryID = 4 then 1 else null end),0) +
                     coalesce (SUM(case when pd.CategoryID = 5 then 1 else null end),0) +
                     coalesce (SUM(case when pd.CategoryID = 6 then 1 else null end),0) +
                    coalesce (SUM(case when pd.CategoryID = 7 then 1 else null end),0) AS total
                    from (ops_order od left join (ops_orderdetail odd left join mas_product pd on odd.ProductID=pd.ProductID)
                    on od.OrderNo=odd.OrderNo )
                    left join (mas_branch b left join mas_branchtype bt on b.BranchType=bt.BranchTypeID) on od.BranchID=b.BranchID
                    where od.OrderDate BETWEEN '".$date_start."' AND '".$date_end."' AND od.IsActive='1'
                    Group by bt.BranchTypeNameTH,
                    b.BranchCode,b.BranchNameTH";
						}else if($_GET['keywords2']!='cheese'&&$_GET['keywords']=='cheese'){
						$stmt="select top 30 bt.BranchTypeNameTH,
                        b.BranchCode,b.BranchNameTH,
                         coalesce (SUM(CASE WHEN pd.CategoryID = 1 then 1 else null end),0) AS service1,
                         coalesce (SUM(CASE WHEN pd.CategoryID = 2 then 1 else null end),0) AS service2,
                         coalesce (SUM(CASE WHEN pd.CategoryID = 3 then 1 else null end),0) AS service3,
                         coalesce (SUM(CASE WHEN pd.CategoryID = 4 then 1 else null end),0) AS service4,
                         coalesce (SUM(CASE WHEN pd.CategoryID = 5 then 1 else null end),0) AS service5,
                         coalesce (SUM(CASE WHEN pd.CategoryID = 6 then 1 else null end),0) AS service6,
                         coalesce (SUM(CASE WHEN pd.CategoryID = 7 then 1 else null end),0) AS service7,
                          coalesce (SUM(case when pd.CategoryID = 1 then 1 else null end),0) +
                         coalesce (SUM(case when pd.CategoryID = 2 then 1 else null end),0) +
                         coalesce (SUM(case when pd.CategoryID = 3 then 1 else null end),0) +
                         coalesce (SUM(case when pd.CategoryID = 4 then 1 else null end),0) +
                         coalesce (SUM(case when pd.CategoryID = 5 then 1 else null end),0) +
                         coalesce (SUM(case when pd.CategoryID = 6 then 1 else null end),0) +
                        coalesce (SUM(case when pd.CategoryID = 7 then 1 else null end),0) AS total
                        from (ops_order od left join (ops_orderdetail odd left join mas_product pd on odd.ProductID=pd.ProductID)
                        on od.OrderNo=odd.OrderNo )
                        left join (mas_branch b left join mas_branchtype bt on b.BranchType=bt.BranchTypeID) on od.BranchID=b.BranchID
                        where od.OrderDate BETWEEN '".$date_start."' AND '".$date_end."' AND od.IsActive='1' AND b.BranchID='".$keywords2."'
                        Group by bt.BranchTypeNameTH,
                        b.BranchCode,b.BranchNameTH";
						}
						else{
					$stmt="select top 30 bt.BranchTypeNameTH,
                    b.BranchCode,b.BranchNameTH,
                     coalesce (SUM(CASE WHEN pd.CategoryID = 1 then 1 else null end),0) AS service1,
                     coalesce (SUM(CASE WHEN pd.CategoryID = 2 then 1 else null end),0) AS service2,
                     coalesce (SUM(CASE WHEN pd.CategoryID = 3 then 1 else null end),0) AS service3,
                     coalesce (SUM(CASE WHEN pd.CategoryID = 4 then 1 else null end),0) AS service4,
                     coalesce (SUM(CASE WHEN pd.CategoryID = 5 then 1 else null end),0) AS service5,
                     coalesce (SUM(CASE WHEN pd.CategoryID = 6 then 1 else null end),0) AS service6,
                     coalesce (SUM(CASE WHEN pd.CategoryID = 7 then 1 else null end),0) AS service7,
                      coalesce (SUM(case when pd.CategoryID = 1 then 1 else null end),0) +
                     coalesce (SUM(case when pd.CategoryID = 2 then 1 else null end),0) +
                     coalesce (SUM(case when pd.CategoryID = 3 then 1 else null end),0) +
                     coalesce (SUM(case when pd.CategoryID = 4 then 1 else null end),0) +
                     coalesce (SUM(case when pd.CategoryID = 5 then 1 else null end),0) +
                     coalesce (SUM(case when pd.CategoryID = 6 then 1 else null end),0) +
                    coalesce (SUM(case when pd.CategoryID = 7 then 1 else null end),0) AS total
                    from (ops_order od left join (ops_orderdetail odd left join mas_product pd on odd.ProductID=pd.ProductID)
                    on od.OrderNo=odd.OrderNo )
                    left join (mas_branch b left join mas_branchtype bt on b.BranchType=bt.BranchTypeID) on od.BranchID=b.BranchID
                    where od.OrderDate BETWEEN '".$date_start."' AND '".$date_end."' AND od.IsActive='1' AND b.BranchType='".$keywords."'
                    Group by bt.BranchTypeNameTH,
                    b.BranchCode,b.BranchNameTH";
				}}else if($_GET['select_top']==100){
					if($_GET['keywords2']=='cheese'&&$_GET['keywords']=='cheese'){
					$stmt="select bt.BranchTypeNameTH,
                    b.BranchCode,b.BranchNameTH,
                     coalesce (SUM(CASE WHEN pd.CategoryID = 1 then 1 else null end),0) AS service1,
                     coalesce (SUM(CASE WHEN pd.CategoryID = 2 then 1 else null end),0) AS service2,
                     coalesce (SUM(CASE WHEN pd.CategoryID = 3 then 1 else null end),0) AS service3,
                     coalesce (SUM(CASE WHEN pd.CategoryID = 4 then 1 else null end),0) AS service4,
                     coalesce (SUM(CASE WHEN pd.CategoryID = 5 then 1 else null end),0) AS service5,
                     coalesce (SUM(CASE WHEN pd.CategoryID = 6 then 1 else null end),0) AS service6,
                     coalesce (SUM(CASE WHEN pd.CategoryID = 7 then 1 else null end),0) AS service7,
                      coalesce (SUM(case when pd.CategoryID = 1 then 1 else null end),0) +
                     coalesce (SUM(case when pd.CategoryID = 2 then 1 else null end),0) +
                     coalesce (SUM(case when pd.CategoryID = 3 then 1 else null end),0) +
                     coalesce (SUM(case when pd.CategoryID = 4 then 1 else null end),0) +
                     coalesce (SUM(case when pd.CategoryID = 5 then 1 else null end),0) +
                     coalesce (SUM(case when pd.CategoryID = 6 then 1 else null end),0) +
                    coalesce (SUM(case when pd.CategoryID = 7 then 1 else null end),0) AS total
                    from (ops_order od left join (ops_orderdetail odd left join mas_product pd on odd.ProductID=pd.ProductID)
                    on od.OrderNo=odd.OrderNo )
                    left join (mas_branch b left join mas_branchtype bt on b.BranchType=bt.BranchTypeID) on od.BranchID=b.BranchID
                    where od.OrderDate BETWEEN '".$date_start."' AND '".$date_end."' AND od.IsActive='1'
                    Group by bt.BranchTypeNameTH,
                    b.BranchCode,b.BranchNameTH";
						}else if($_GET['keywords2']!='cheese'&&$_GET['keywords']=='cheese'){
						$stmt="select bt.BranchTypeNameTH,
                        b.BranchCode,b.BranchNameTH,
                         coalesce (SUM(CASE WHEN pd.CategoryID = 1 then 1 else null end),0) AS service1,
                         coalesce (SUM(CASE WHEN pd.CategoryID = 2 then 1 else null end),0) AS service2,
                         coalesce (SUM(CASE WHEN pd.CategoryID = 3 then 1 else null end),0) AS service3,
                         coalesce (SUM(CASE WHEN pd.CategoryID = 4 then 1 else null end),0) AS service4,
                         coalesce (SUM(CASE WHEN pd.CategoryID = 5 then 1 else null end),0) AS service5,
                         coalesce (SUM(CASE WHEN pd.CategoryID = 6 then 1 else null end),0) AS service6,
                         coalesce (SUM(CASE WHEN pd.CategoryID = 7 then 1 else null end),0) AS service7,
                          coalesce (SUM(case when pd.CategoryID = 1 then 1 else null end),0) +
                         coalesce (SUM(case when pd.CategoryID = 2 then 1 else null end),0) +
                         coalesce (SUM(case when pd.CategoryID = 3 then 1 else null end),0) +
                         coalesce (SUM(case when pd.CategoryID = 4 then 1 else null end),0) +
                         coalesce (SUM(case when pd.CategoryID = 5 then 1 else null end),0) +
                         coalesce (SUM(case when pd.CategoryID = 6 then 1 else null end),0) +
                        coalesce (SUM(case when pd.CategoryID = 7 then 1 else null end),0) AS total
                        from (ops_order od left join (ops_orderdetail odd left join mas_product pd on odd.ProductID=pd.ProductID)
                        on od.OrderNo=odd.OrderNo )
                        left join (mas_branch b left join mas_branchtype bt on b.BranchType=bt.BranchTypeID) on od.BranchID=b.BranchID
                        where od.OrderDate BETWEEN '".$date_start."' AND '".$date_end."' AND od.IsActive='1' AND b.BranchID='".$keywords2."'
                        Group by bt.BranchTypeNameTH,
                        b.BranchCode,b.BranchNameTH";
						}
						else{
					$stmt="select bt.BranchTypeNameTH,
                    b.BranchCode,b.BranchNameTH,
                     coalesce (SUM(CASE WHEN pd.CategoryID = 1 then 1 else null end),0) AS service1,
                     coalesce (SUM(CASE WHEN pd.CategoryID = 2 then 1 else null end),0) AS service2,
                     coalesce (SUM(CASE WHEN pd.CategoryID = 3 then 1 else null end),0) AS service3,
                     coalesce (SUM(CASE WHEN pd.CategoryID = 4 then 1 else null end),0) AS service4,
                     coalesce (SUM(CASE WHEN pd.CategoryID = 5 then 1 else null end),0) AS service5,
                     coalesce (SUM(CASE WHEN pd.CategoryID = 6 then 1 else null end),0) AS service6,
                     coalesce (SUM(CASE WHEN pd.CategoryID = 7 then 1 else null end),0) AS service7,
                      coalesce (SUM(case when pd.CategoryID = 1 then 1 else null end),0) +
                     coalesce (SUM(case when pd.CategoryID = 2 then 1 else null end),0) +
                     coalesce (SUM(case when pd.CategoryID = 3 then 1 else null end),0) +
                     coalesce (SUM(case when pd.CategoryID = 4 then 1 else null end),0) +
                     coalesce (SUM(case when pd.CategoryID = 5 then 1 else null end),0) +
                     coalesce (SUM(case when pd.CategoryID = 6 then 1 else null end),0) +
                    coalesce (SUM(case when pd.CategoryID = 7 then 1 else null end),0) AS total
                    from (ops_order od left join (ops_orderdetail odd left join mas_product pd on odd.ProductID=pd.ProductID)
                    on od.OrderNo=odd.OrderNo )
                    left join (mas_branch b left join mas_branchtype bt on b.BranchType=bt.BranchTypeID) on od.BranchID=b.BranchID
                    where od.OrderDate BETWEEN '".$date_start."' AND '".$date_end."' AND od.IsActive='1' AND b.BranchType='".$keywords."'
                    Group by bt.BranchTypeNameTH,
                    b.BranchCode,b.BranchNameTH";
						}
				}else{
					if($_GET['keywords2']=='cheese'&&$_GET['keywords']=='cheese'){
                        $stmt="select bt.BranchTypeNameTH,
                        b.BranchCode,b.BranchNameTH,
                         coalesce (SUM(CASE WHEN pd.CategoryID = 1 then 1 else null end),0) AS service1,
                         coalesce (SUM(CASE WHEN pd.CategoryID = 2 then 1 else null end),0) AS service2,
                         coalesce (SUM(CASE WHEN pd.CategoryID = 3 then 1 else null end),0) AS service3,
                         coalesce (SUM(CASE WHEN pd.CategoryID = 4 then 1 else null end),0) AS service4,
                         coalesce (SUM(CASE WHEN pd.CategoryID = 5 then 1 else null end),0) AS service5,
                         coalesce (SUM(CASE WHEN pd.CategoryID = 6 then 1 else null end),0) AS service6,
                         coalesce (SUM(CASE WHEN pd.CategoryID = 7 then 1 else null end),0) AS service7,
                          coalesce (SUM(case when pd.CategoryID = 1 then 1 else null end),0) +
                         coalesce (SUM(case when pd.CategoryID = 2 then 1 else null end),0) +
                         coalesce (SUM(case when pd.CategoryID = 3 then 1 else null end),0) +
                         coalesce (SUM(case when pd.CategoryID = 4 then 1 else null end),0) +
                         coalesce (SUM(case when pd.CategoryID = 5 then 1 else null end),0) +
                         coalesce (SUM(case when pd.CategoryID = 6 then 1 else null end),0) +
                        coalesce (SUM(case when pd.CategoryID = 7 then 1 else null end),0) AS total
                        from (ops_order od left join (ops_orderdetail odd left join mas_product pd on odd.ProductID=pd.ProductID)
                        on od.OrderNo=odd.OrderNo )
                        left join (mas_branch b left join mas_branchtype bt on b.BranchType=bt.BranchTypeID) on od.BranchID=b.BranchID
                        where od.OrderDate BETWEEN '".$date_start."' AND '".$date_end."' AND od.IsActive='1'
                        Group by bt.BranchTypeNameTH,
                        b.BranchCode,b.BranchNameTH";
                            }else if($_GET['keywords2']!='cheese'&&$_GET['keywords']=='cheese'){
                            $stmt="select bt.BranchTypeNameTH,
                            b.BranchCode,b.BranchNameTH,
                             coalesce (SUM(CASE WHEN pd.CategoryID = 1 then 1 else null end),0) AS service1,
                             coalesce (SUM(CASE WHEN pd.CategoryID = 2 then 1 else null end),0) AS service2,
                             coalesce (SUM(CASE WHEN pd.CategoryID = 3 then 1 else null end),0) AS service3,
                             coalesce (SUM(CASE WHEN pd.CategoryID = 4 then 1 else null end),0) AS service4,
                             coalesce (SUM(CASE WHEN pd.CategoryID = 5 then 1 else null end),0) AS service5,
                             coalesce (SUM(CASE WHEN pd.CategoryID = 6 then 1 else null end),0) AS service6,
                             coalesce (SUM(CASE WHEN pd.CategoryID = 7 then 1 else null end),0) AS service7,
                              coalesce (SUM(case when pd.CategoryID = 1 then 1 else null end),0) +
                             coalesce (SUM(case when pd.CategoryID = 2 then 1 else null end),0) +
                             coalesce (SUM(case when pd.CategoryID = 3 then 1 else null end),0) +
                             coalesce (SUM(case when pd.CategoryID = 4 then 1 else null end),0) +
                             coalesce (SUM(case when pd.CategoryID = 5 then 1 else null end),0) +
                             coalesce (SUM(case when pd.CategoryID = 6 then 1 else null end),0) +
                            coalesce (SUM(case when pd.CategoryID = 7 then 1 else null end),0) AS total
                            from (ops_order od left join (ops_orderdetail odd left join mas_product pd on odd.ProductID=pd.ProductID)
                            on od.OrderNo=odd.OrderNo )
                            left join (mas_branch b left join mas_branchtype bt on b.BranchType=bt.BranchTypeID) on od.BranchID=b.BranchID
                            where od.OrderDate BETWEEN '".$date_start."' AND '".$date_end."' AND od.IsActive='1' AND b.BranchID='".$keywords2."'
                            Group by bt.BranchTypeNameTH,
                            b.BranchCode,b.BranchNameTH";
                            }
                            else{
                        $stmt="select bt.BranchTypeNameTH,
                        b.BranchCode,b.BranchNameTH,
                         coalesce (SUM(CASE WHEN pd.CategoryID = 1 then 1 else null end),0) AS service1,
                         coalesce (SUM(CASE WHEN pd.CategoryID = 2 then 1 else null end),0) AS service2,
                         coalesce (SUM(CASE WHEN pd.CategoryID = 3 then 1 else null end),0) AS service3,
                         coalesce (SUM(CASE WHEN pd.CategoryID = 4 then 1 else null end),0) AS service4,
                         coalesce (SUM(CASE WHEN pd.CategoryID = 5 then 1 else null end),0) AS service5,
                         coalesce (SUM(CASE WHEN pd.CategoryID = 6 then 1 else null end),0) AS service6,
                         coalesce (SUM(CASE WHEN pd.CategoryID = 7 then 1 else null end),0) AS service7,
                          coalesce (SUM(case when pd.CategoryID = 1 then 1 else null end),0) +
                         coalesce (SUM(case when pd.CategoryID = 2 then 1 else null end),0) +
                         coalesce (SUM(case when pd.CategoryID = 3 then 1 else null end),0) +
                         coalesce (SUM(case when pd.CategoryID = 4 then 1 else null end),0) +
                         coalesce (SUM(case when pd.CategoryID = 5 then 1 else null end),0) +
                         coalesce (SUM(case when pd.CategoryID = 6 then 1 else null end),0) +
                        coalesce (SUM(case when pd.CategoryID = 7 then 1 else null end),0) AS total
                        from (ops_order od left join (ops_orderdetail odd left join mas_product pd on odd.ProductID=pd.ProductID)
                        on od.OrderNo=odd.OrderNo )
                        left join (mas_branch b left join mas_branchtype bt on b.BranchType=bt.BranchTypeID) on od.BranchID=b.BranchID
                        where od.OrderDate BETWEEN '".$date_start."' AND '".$date_end."' AND od.IsActive='1' AND b.BranchType='".$keywords."'
                        Group by bt.BranchTypeNameTH,
                        b.BranchCode,b.BranchNameTH";
                            }
                     }
					 //branch
				}else{
					if($_GET['select_top']==10){
					if($_GET['keywords2']=='cheese'&&$_GET['keywords']=='cheese'){
					$stmt="select top 10 bt.BranchTypeNameTH,
                    b.BranchCode,b.BranchNameTH,
                     coalesce (SUM(CASE WHEN pd.CategoryID = 1 then 1 else null end),0) AS service1,
                     coalesce (SUM(CASE WHEN pd.CategoryID = 2 then 1 else null end),0) AS service2,
                     coalesce (SUM(CASE WHEN pd.CategoryID = 3 then 1 else null end),0) AS service3,
                     coalesce (SUM(CASE WHEN pd.CategoryID = 4 then 1 else null end),0) AS service4,
                     coalesce (SUM(CASE WHEN pd.CategoryID = 5 then 1 else null end),0) AS service5,
                     coalesce (SUM(CASE WHEN pd.CategoryID = 6 then 1 else null end),0) AS service6,
                     coalesce (SUM(CASE WHEN pd.CategoryID = 7 then 1 else null end),0) AS service7,
                      coalesce (SUM(case when pd.CategoryID = 1 then 1 else null end),0) +
                     coalesce (SUM(case when pd.CategoryID = 2 then 1 else null end),0) +
                     coalesce (SUM(case when pd.CategoryID = 3 then 1 else null end),0) +
                     coalesce (SUM(case when pd.CategoryID = 4 then 1 else null end),0) +
                     coalesce (SUM(case when pd.CategoryID = 5 then 1 else null end),0) +
                     coalesce (SUM(case when pd.CategoryID = 6 then 1 else null end),0) +
                    coalesce (SUM(case when pd.CategoryID = 7 then 1 else null end),0) AS total
                    from (ops_order od left join (ops_orderdetail odd left join mas_product pd on odd.ProductID=pd.ProductID)
                    on od.OrderNo=odd.OrderNo )
                    left join (mas_branch b left join mas_branchtype bt on b.BranchType=bt.BranchTypeID) on od.BranchID=b.BranchID
                    where od.OrderDate BETWEEN '".$date_start."' AND '".$date_end."' AND od.IsActive='1' AND b.BranchID='".$session."'
                    Group by bt.BranchTypeNameTH,
                    b.BranchCode,b.BranchNameTH";
						}
                    }
                    else if($_GET['select_top']==20){
                    if($_GET['keywords2']=='cheese'&&$_GET['keywords']=='cheese'){
					$stmt="select top 20 bt.BranchTypeNameTH,
                    b.BranchCode,b.BranchNameTH,
                     coalesce (SUM(CASE WHEN pd.CategoryID = 1 then 1 else null end),0) AS service1,
                     coalesce (SUM(CASE WHEN pd.CategoryID = 2 then 1 else null end),0) AS service2,
                     coalesce (SUM(CASE WHEN pd.CategoryID = 3 then 1 else null end),0) AS service3,
                     coalesce (SUM(CASE WHEN pd.CategoryID = 4 then 1 else null end),0) AS service4,
                     coalesce (SUM(CASE WHEN pd.CategoryID = 5 then 1 else null end),0) AS service5,
                     coalesce (SUM(CASE WHEN pd.CategoryID = 6 then 1 else null end),0) AS service6,
                     coalesce (SUM(CASE WHEN pd.CategoryID = 7 then 1 else null end),0) AS service7,
                      coalesce (SUM(case when pd.CategoryID = 1 then 1 else null end),0) +
                     coalesce (SUM(case when pd.CategoryID = 2 then 1 else null end),0) +
                     coalesce (SUM(case when pd.CategoryID = 3 then 1 else null end),0) +
                     coalesce (SUM(case when pd.CategoryID = 4 then 1 else null end),0) +
                     coalesce (SUM(case when pd.CategoryID = 5 then 1 else null end),0) +
                     coalesce (SUM(case when pd.CategoryID = 6 then 1 else null end),0) +
                    coalesce (SUM(case when pd.CategoryID = 7 then 1 else null end),0) AS total
                    from (ops_order od left join (ops_orderdetail odd left join mas_product pd on odd.ProductID=pd.ProductID)
                    on od.OrderNo=odd.OrderNo )
                    left join (mas_branch b left join mas_branchtype bt on b.BranchType=bt.BranchTypeID) on od.BranchID=b.BranchID
                    where od.OrderDate BETWEEN '".$date_start."' AND '".$date_end."' AND od.IsActive='1' AND b.BranchID='".$session."'
                    Group by bt.BranchTypeNameTH,
                    b.BranchCode,b.BranchNameTH";
						}}else if($_GET['select_top']==30){
					if($_GET['keywords2']=='cheese'&&$_GET['keywords']=='cheese'){
					$stmt="select top 30 bt.BranchTypeNameTH,
                    b.BranchCode,b.BranchNameTH,
                     coalesce (SUM(CASE WHEN pd.CategoryID = 1 then 1 else null end),0) AS service1,
                     coalesce (SUM(CASE WHEN pd.CategoryID = 2 then 1 else null end),0) AS service2,
                     coalesce (SUM(CASE WHEN pd.CategoryID = 3 then 1 else null end),0) AS service3,
                     coalesce (SUM(CASE WHEN pd.CategoryID = 4 then 1 else null end),0) AS service4,
                     coalesce (SUM(CASE WHEN pd.CategoryID = 5 then 1 else null end),0) AS service5,
                     coalesce (SUM(CASE WHEN pd.CategoryID = 6 then 1 else null end),0) AS service6,
                     coalesce (SUM(CASE WHEN pd.CategoryID = 7 then 1 else null end),0) AS service7,
                      coalesce (SUM(case when pd.CategoryID = 1 then 1 else null end),0) +
                     coalesce (SUM(case when pd.CategoryID = 2 then 1 else null end),0) +
                     coalesce (SUM(case when pd.CategoryID = 3 then 1 else null end),0) +
                     coalesce (SUM(case when pd.CategoryID = 4 then 1 else null end),0) +
                     coalesce (SUM(case when pd.CategoryID = 5 then 1 else null end),0) +
                     coalesce (SUM(case when pd.CategoryID = 6 then 1 else null end),0) +
                    coalesce (SUM(case when pd.CategoryID = 7 then 1 else null end),0) AS total
                    from (ops_order od left join (ops_orderdetail odd left join mas_product pd on odd.ProductID=pd.ProductID)
                    on od.OrderNo=odd.OrderNo )
                    left join (mas_branch b left join mas_branchtype bt on b.BranchType=bt.BranchTypeID) on od.BranchID=b.BranchID
                    where od.OrderDate BETWEEN '".$date_start."' AND '".$date_end."' AND od.IsActive='1' AND b.BranchID='".$session."'
                    Group by bt.BranchTypeNameTH,
                    b.BranchCode,b.BranchNameTH";
					}}else if($_GET['select_top']==100){
					if($_GET['keywords2']=='cheese'&&$_GET['keywords']=='cheese'){
					$stmt="select bt.BranchTypeNameTH,
                    b.BranchCode,b.BranchNameTH,
                     coalesce (SUM(CASE WHEN pd.CategoryID = 1 then 1 else null end),0) AS service1,
                     coalesce (SUM(CASE WHEN pd.CategoryID = 2 then 1 else null end),0) AS service2,
                     coalesce (SUM(CASE WHEN pd.CategoryID = 3 then 1 else null end),0) AS service3,
                     coalesce (SUM(CASE WHEN pd.CategoryID = 4 then 1 else null end),0) AS service4,
                     coalesce (SUM(CASE WHEN pd.CategoryID = 5 then 1 else null end),0) AS service5,
                     coalesce (SUM(CASE WHEN pd.CategoryID = 6 then 1 else null end),0) AS service6,
                     coalesce (SUM(CASE WHEN pd.CategoryID = 7 then 1 else null end),0) AS service7,
                      coalesce (SUM(case when pd.CategoryID = 1 then 1 else null end),0) +
                     coalesce (SUM(case when pd.CategoryID = 2 then 1 else null end),0) +
                     coalesce (SUM(case when pd.CategoryID = 3 then 1 else null end),0) +
                     coalesce (SUM(case when pd.CategoryID = 4 then 1 else null end),0) +
                     coalesce (SUM(case when pd.CategoryID = 5 then 1 else null end),0) +
                     coalesce (SUM(case when pd.CategoryID = 6 then 1 else null end),0) +
                    coalesce (SUM(case when pd.CategoryID = 7 then 1 else null end),0) AS total
                    from (ops_order od left join (ops_orderdetail odd left join mas_product pd on odd.ProductID=pd.ProductID)
                    on od.OrderNo=odd.OrderNo )
                    left join (mas_branch b left join mas_branchtype bt on b.BranchType=bt.BranchTypeID) on od.BranchID=b.BranchID
                    where od.OrderDate BETWEEN '".$date_start."' AND '".$date_end."' AND od.IsActive='1' AND b.BranchID='".$session."'
                    Group by bt.BranchTypeNameTH,
                    b.BranchCode,b.BranchNameTH";
					}
				}else{
					if($_GET['keywords2']=='cheese'&&$_GET['keywords']=='cheese'){
					$stmt="select bt.BranchTypeNameTH,
                    b.BranchCode,b.BranchNameTH,
                     coalesce (SUM(CASE WHEN pd.CategoryID = 1 then 1 else null end),0) AS service1,
                     coalesce (SUM(CASE WHEN pd.CategoryID = 2 then 1 else null end),0) AS service2,
                     coalesce (SUM(CASE WHEN pd.CategoryID = 3 then 1 else null end),0) AS service3,
                     coalesce (SUM(CASE WHEN pd.CategoryID = 4 then 1 else null end),0) AS service4,
                     coalesce (SUM(CASE WHEN pd.CategoryID = 5 then 1 else null end),0) AS service5,
                     coalesce (SUM(CASE WHEN pd.CategoryID = 6 then 1 else null end),0) AS service6,
                     coalesce (SUM(CASE WHEN pd.CategoryID = 7 then 1 else null end),0) AS service7,
                      coalesce (SUM(case when pd.CategoryID = 1 then 1 else null end),0) +
                     coalesce (SUM(case when pd.CategoryID = 2 then 1 else null end),0) +
                     coalesce (SUM(case when pd.CategoryID = 3 then 1 else null end),0) +
                     coalesce (SUM(case when pd.CategoryID = 4 then 1 else null end),0) +
                     coalesce (SUM(case when pd.CategoryID = 5 then 1 else null end),0) +
                     coalesce (SUM(case when pd.CategoryID = 6 then 1 else null end),0) +
                    coalesce (SUM(case when pd.CategoryID = 7 then 1 else null end),0) AS total
                    from (ops_order od left join (ops_orderdetail odd left join mas_product pd on odd.ProductID=pd.ProductID)
                    on od.OrderNo=odd.OrderNo )
                    left join (mas_branch b left join mas_branchtype bt on b.BranchType=bt.BranchTypeID) on od.BranchID=b.BranchID
                    where od.OrderDate BETWEEN '".$date_start."' AND '".$date_end."' AND od.IsActive='1' AND b.BranchID='".$session."'
                    Group by bt.BranchTypeNameTH,
                    b.BranchCode,b.BranchNameTH";
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
