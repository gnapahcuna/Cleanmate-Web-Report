<?php include('connect.php') ?>
<!doctype html>
<html lang="en">

<head>
	<title>Summary Product Group</title>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
	<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0">
	<!-- VENDOR CSS -->
	<link rel="stylesheet" href="assets/vendor/bootstrap/css/bootstrap.min.css">
	<link rel="stylesheet" href="assets/vendor/font-awesome/css/font-awesome.min.css">
	<link rel="stylesheet" href="assets/vendor/linearicons/style.css">
	<link rel="stylesheet" href="assets/vendor/chartist/css/chartist-custom.css">
	<!-- MAIN CSS -->
	<link rel="stylesheet" href="assets/css/main.css">
	<!-- FOR DEMO PURPOSES ONLY. You should remove this in your project -->
	<link rel="stylesheet" href="assets/css/demo.css">
	<!-- GOOGLE FONTS -->
	<link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700" rel="stylesheet">
	<!-- ICONS -->
	<link rel="apple-touch-icon" sizes="76x76" href="assets/img/apple-icon.png">
	<link rel="icon" type="image/png" sizes="96x96" href="assets/img/favicon.png">
</head>

<body>
	<!-- WRAPPER -->
	<div id="wrapper">
		<!-- NAVBAR -->
		<?php include('bar.php') ?>
		<!-- END NAVBAR -->
		<!-- LEFT SIDEBAR -->
		<div id="sidebar-nav" class="sidebar">
			<div class="sidebar-scroll">
				<nav>
					<ul class="nav">

						<!--<li><a href="Home-Factory.php" class="active"><i class="lnr lnr-home"></i> <span>หน้าแรก</span></a></li>-->
						<li><a href="Summary-All-F.php" class=""><i class="lnr lnr-chart-bars"></i> <span>สรุปยอดขายรวมทุกประเภท</span></a></li>
						<li><a href="Order-All.php" class=""><i class="lnr lnr-chart-bars"></i> <span>รายงานข้อมูลรายละเอียดออเดอร์</span></a></li>
						<li><a href="Summary-Service-F.php" class=""><i class="lnr lnr-chart-bars"></i> <span>สรุปยอดขายแยกตามประเภทบริการ</span></a></li>
						<li><a href="Summary-Product-Group-F.php" class="active"><i class="lnr lnr-chart-bars"></i> <span>สรุปยอดขายแยกตามประเภทกลุ่มสินค้า</span></a></li>
						<li><a href="Summary-All-Product-F.php" class=""><i class="lnr lnr-chart-bars"></i> <span>สรุปยอดขายแยกตามทุกรายการสินค้า</span></a></li>
						<li><a href="Summary-Canceled-F.php" class=""><i class="lnr lnr-chart-bars"></i> <span>สรุปยอดขายรายการยกเลิกออเดอร์<br>(ที่ร้าน, ที่โรงงาน )</span></a></li>
						<li><a href="Order-All-F.php" class=""><i class="lnr lnr-chart-bars"></i> <span>สรุปยอดรายการออเดอร์ทุกประเภท</span></a></li>
						<li><a href="Order-Service-F.php" class=""><i class="lnr lnr-chart-bars"></i> <span>สรุปยอดรายการออเดอร์ประเภทบริการ</span></a></li>
						<li><a href="Order-Product-Group-F.php" class=""><i class="lnr lnr-chart-bars"></i> <span>สรุปยอดรายการออเดอร์ประเภทกลุ่มสินค้า</span></a></li>
						<li><a href="Order-All-Product-F.php" class=""><i class="lnr lnr-chart-bars"></i> <span>สรุปยอดรายการออเดอร์ทุกรายการสินค้า</span></a></li>
						<li><a href="Customer-Product-F.php" class=""><i class="lnr lnr-chart-bars"></i> <span>สรุปยอดออเดอร์ลูกค้าประจำร้าน</span></a></li>
						<li><a href="Customer-Service-F.php" class=""><i class="lnr lnr-chart-bars"></i> <span>สรุปยอดประเภทบริการลูกค้าประจำร้าน</span></a></li>

					</ul>
				</nav>
			</div>
		</div>
		<!-- END LEFT SIDEBAR -->


		<!-- MAIN -->
		<div class="main">
			<div class="main-content">
				<div class="container-fluid">
					<div class="col-md-6">
						<!-- INPUTS -->
						<div class="panel">
							<div class="panel-heading">
								<h3 class="panel-title">ค้นหา</h3>
							</div>
							<div class="panel-body">
								<form action="Summary-Product-Group-F.php" method="post" onSubmit="return getDate()" >

									<label>เลือกวันที่</label>
									<input type="date" name="date_start" class="form-control" required>
									<br><label>ถึง</label><br>
									<input type="date" name="date_end" class="form-control" required>
									<br>
									<label>ค้นหาประเภทร้าน</label><br>
									<select class="form-control"  name="keywords" required>
										<option value="cheese">--เลือกประเภทร้าน--</option>
										<?php
									$stmt="select BranchTypeID,BranchTypeNameTH from mas_branchtype where IsActive=1";
									$query = sqlsrv_query($conn,$stmt);
									while($row = sqlsrv_fetch_array($query)){
									?>
										<option value="<?php echo $row["BranchTypeID"];?>"><?php echo $row["BranchTypeNameTH"];?></option>
										<?php } ?>
									</select>
									<br><label>ค้นหาชื่อร้าน</label><br>
									<select class="form-control"  name="keywords2" required>
										<option value="cheese">--เลือกชื่อร้าน--</option>
										<?php
									$stmt="select distinct ops_order.BranchID,BranchNameTH from ops_order left join mas_branch on ops_order.BranchID=mas_branch.BranchID where ops_order.IsActive=1";
									$query = sqlsrv_query($conn,$stmt);
									while($row = sqlsrv_fetch_array($query)){
									?>
										<option value="<?php echo $row["BranchID"];?>"><?php echo $row["BranchNameTH"];?></option>
										<?php } ?>
									</select>
									<br>

									<center><input type="submit" value="Search"></center>

								</form>
							</div>
						</div>
					</div>
					<!-- END INPUTS -->

					<?php
					$date_start=$_POST["date_start"];
					$date_end=$_POST["date_end"];
					$keywords=$_POST["keywords"];
					$keywords2=$_POST["keywords2"];
					?>
					<div class="col-md-6">
						<!-- INPUTS -->
						<div class="panel">
							<div class="panel-heading">

								<h2>สรุปยอดขายแยกตามประเภทกลุ่มสินค้า</h2>

								<h2 class="panel-title">ผลการค้นหา</h2>
							</div>
							<div class="panel-body">
								<div class="row">
									<div class="col-md-12">
										<div class="metric">
											<p><span class="title">วันที่</span>
												<span class="number"><?php echo "&nbsp";?><?php echo substr($date_start,8,2);?>-<?php echo substr($date_start,5,2);?>-<?php echo substr($date_start,0,4);?>
												<?php echo "&nbsp ถึง &nbsp";?>
												<?php echo substr($date_end,8,2);?>-<?php echo substr($date_end,5,2);?>-<?php echo substr($date_end,0,4);?></span>
												<br>
												<?php
												if($_POST['select_top']){
												 if($_POST['select_top']==100){
													echo 'แสดงทั้งหมด (All)';
												}else{
													echo $_POST['select_top'].' อันดับแรก (Top '.$_POST['select_top'].')';
												}
												}
												?>
											</p>
											<br>
										</div>
									</div>
								</div>
							</div>
							<div class="panel-body">
								<label>จัดอันดับ</label><br>
								<form method="post" action="Summary-Product-Group-F.php" id="frm">
									<select class="form-control" name="select_top" onchange="onSelectChange();">
										<?php if($_POST["date_start"]){?>
										<option value="">--เลือกการจัดอันดับ--</option>
										<option value="10">10 อันดับแรก (Top 10)</option>
										<option value="20">20 อันดับแรก (Top 20)</option>
										<option value="30">30 อันดับแรก (Top 30)</option>
										<option value="100">แสดงทั้งหมด (All)</option>
										<?php }else{?>
										<option value="">--เลือกการจัดอันดับ--</option>
										<?php }?>

									</select>
									<input type="hidden" name="date_start" value=<?php echo $date_start; ?>>
									<input type="hidden" name="date_end" value=<?php echo $date_end; ?>>
									<input type="hidden" name="keywords" value=<?php echo $keywords; ?>>
									<input type="hidden" name="keywords2" value=<?php echo $_POST["keywords2"];?>>

								</form>

								<br>
							</div>
						</div>
					</div>



					<!-- END INPUTS -->



					<!-- OVERVIEW -->
					<?php
					if($_POST['select_top']==10){
					if($_POST['keywords2']=='cheese'||$_POST['keywords']=='cheese'){
					$stmt="SELECT top 10 mas_branch.BranchNameTH,ops_order.BranchID,mas_branchgroup.BranchGroupName,
                           					Count(distinct ops_order.OrderID) AS cont,
                           					coalesce (SUM(CASE WHEN mas_productcategory.CategoryNameEN = 'Dress Male' then ops_orderdetail.Amount else null end),0) AS service1,
                           					coalesce (SUM(CASE WHEN mas_productcategory.CategoryNameEN = 'Dress Female' then ops_orderdetail.Amount else null end),0) AS service2,
                           					coalesce (SUM(CASE WHEN mas_productcategory.CategoryNameEN = 'Shoes' then ops_orderdetail.Amount else null end),0) AS service3,
                           					coalesce (SUM(CASE WHEN mas_productcategory.CategoryNameEN = 'Bag' then ops_orderdetail.Amount else null end),0) AS service4,
                           					coalesce (SUM(CASE WHEN mas_productcategory.CategoryNameEN = 'Blanket' then ops_orderdetail.Amount else null end),0) AS service5,
                           					coalesce (SUM(CASE WHEN mas_productcategory.CategoryNameEN = 'Capet Curtain' then ops_orderdetail.Amount else null end),0) AS service6,
                           					coalesce (SUM(CASE WHEN mas_productcategory.CategoryNameEN = 'Others' then ops_orderdetail.Amount else null end),0) AS service7,

                           					coalesce (SUM(CASE WHEN mas_productcategory.CategoryNameEN = 'Dress Male' then ops_orderdetail.Amount else null end),0)+
                           					coalesce (SUM(CASE WHEN mas_productcategory.CategoryNameEN = 'Dress Female' then ops_orderdetail.Amount else null end),0)+
                           					coalesce (SUM(CASE WHEN mas_productcategory.CategoryNameEN = 'Shoes' then ops_orderdetail.Amount else null end),0)+
                           					coalesce (SUM(CASE WHEN mas_productcategory.CategoryNameEN = 'Bag' then ops_orderdetail.Amount else null end),0)+
                           					coalesce (SUM(CASE WHEN mas_productcategory.CategoryNameEN = 'Blanket' then ops_orderdetail.Amount else null end),0)+
                           					coalesce (SUM(CASE WHEN mas_productcategory.CategoryNameEN = 'Capet Curtain' then ops_orderdetail.Amount else null end),0)+
                           					coalesce (SUM(CASE WHEN mas_productcategory.CategoryNameEN = 'Others' then ops_orderdetail.Amount else null end),0) AS total


                           					FROM (ops_order left join (mas_branch left join mas_branchgroup on mas_branch.BranchGroupID=mas_branchgroup.BranchGroupID)
                           					on ops_order.BranchID=mas_branch.BranchID)left join
                           					(ops_orderdetail left join (mas_product left join mas_productcategory on mas_product.CategoryID=mas_productcategory.CategoryID)
                           					on ops_orderdetail.ProductID=mas_product.ProductID)
                           					 on ops_order.OrderNo=ops_orderdetail.OrderNo
                           					WHERE ops_order.OrderDate BETWEEN '$date_start' AND '$date_end' AND ops_order.IsActive='1'
                           					GROUP BY  mas_branch.BranchNameTH,ops_order.BranchID,mas_branchgroup.BranchGroupName";
					}else{
					$stmt="SELECT top 10 mas_branch.BranchNameTH,ops_order.BranchID,mas_branchgroup.BranchGroupName,
                           					Count(distinct ops_order.OrderID) AS cont,
                           					coalesce (SUM(CASE WHEN mas_productcategory.CategoryNameEN = 'Dress Male' then ops_orderdetail.Amount else null end),0) AS service1,
                           					coalesce (SUM(CASE WHEN mas_productcategory.CategoryNameEN = 'Dress Female' then ops_orderdetail.Amount else null end),0) AS service2,
                           					coalesce (SUM(CASE WHEN mas_productcategory.CategoryNameEN = 'Shoes' then ops_orderdetail.Amount else null end),0) AS service3,
                           					coalesce (SUM(CASE WHEN mas_productcategory.CategoryNameEN = 'Bag' then ops_orderdetail.Amount else null end),0) AS service4,
                           					coalesce (SUM(CASE WHEN mas_productcategory.CategoryNameEN = 'Blanket' then ops_orderdetail.Amount else null end),0) AS service5,
                           					coalesce (SUM(CASE WHEN mas_productcategory.CategoryNameEN = 'Capet Curtain' then ops_orderdetail.Amount else null end),0) AS service6,
                           					coalesce (SUM(CASE WHEN mas_productcategory.CategoryNameEN = 'Others' then ops_orderdetail.Amount else null end),0) AS service7,

                           					coalesce (SUM(CASE WHEN mas_productcategory.CategoryNameEN = 'Dress Male' then ops_orderdetail.Amount else null end),0)+
                           					coalesce (SUM(CASE WHEN mas_productcategory.CategoryNameEN = 'Dress Female' then ops_orderdetail.Amount else null end),0)+
                           					coalesce (SUM(CASE WHEN mas_productcategory.CategoryNameEN = 'Shoes' then ops_orderdetail.Amount else null end),0)+
                           					coalesce (SUM(CASE WHEN mas_productcategory.CategoryNameEN = 'Bag' then ops_orderdetail.Amount else null end),0)+
                           					coalesce (SUM(CASE WHEN mas_productcategory.CategoryNameEN = 'Blanket' then ops_orderdetail.Amount else null end),0)+
                           					coalesce (SUM(CASE WHEN mas_productcategory.CategoryNameEN = 'Capet Curtain' then ops_orderdetail.Amount else null end),0)+
                           					coalesce (SUM(CASE WHEN mas_productcategory.CategoryNameEN = 'Others' then ops_orderdetail.Amount else null end),0) AS total


                           					FROM (ops_order left join (mas_branch left join mas_branchgroup on mas_branch.BranchGroupID=mas_branchgroup.BranchGroupID)
                           					on ops_order.BranchID=mas_branch.BranchID)left join
                           					(ops_orderdetail left join (mas_product left join mas_productcategory on mas_product.CategoryID=mas_productcategory.CategoryID)
                           					on ops_orderdetail.ProductID=mas_product.ProductID)
                           					 on ops_order.OrderNo=ops_orderdetail.OrderNo
                           					WHERE ops_order.OrderDate BETWEEN '$date_start' AND '$date_end' AND ops_order.BranchID = '".$keywords2."'
                           					AND ops_order.IsActive='1' OR mas_branchgroup.BranchGroupName = '".$keywords."'
                           					GROUP BY  mas_branch.BranchNameTH,ops_order.BranchID,mas_branchgroup.BranchGroupName";
					}}else if($_POST['select_top']==20){
					if($_POST['keywords2']=='cheese'||$_POST['keywords']=='cheese'){
					$stmt="SELECT top 20 mas_branch.BranchNameTH,ops_order.BranchID,mas_branchgroup.BranchGroupName,
                           					Count(distinct ops_order.OrderID) AS cont,
                           					coalesce (SUM(CASE WHEN mas_productcategory.CategoryNameEN = 'Dress Male' then ops_orderdetail.Amount else null end),0) AS service1,
                           					coalesce (SUM(CASE WHEN mas_productcategory.CategoryNameEN = 'Dress Female' then ops_orderdetail.Amount else null end),0) AS service2,
                           					coalesce (SUM(CASE WHEN mas_productcategory.CategoryNameEN = 'Shoes' then ops_orderdetail.Amount else null end),0) AS service3,
                           					coalesce (SUM(CASE WHEN mas_productcategory.CategoryNameEN = 'Bag' then ops_orderdetail.Amount else null end),0) AS service4,
                           					coalesce (SUM(CASE WHEN mas_productcategory.CategoryNameEN = 'Blanket' then ops_orderdetail.Amount else null end),0) AS service5,
                           					coalesce (SUM(CASE WHEN mas_productcategory.CategoryNameEN = 'Capet Curtain' then ops_orderdetail.Amount else null end),0) AS service6,
                           					coalesce (SUM(CASE WHEN mas_productcategory.CategoryNameEN = 'Others' then ops_orderdetail.Amount else null end),0) AS service7,

                           					coalesce (SUM(CASE WHEN mas_productcategory.CategoryNameEN = 'Dress Male' then ops_orderdetail.Amount else null end),0)+
                           					coalesce (SUM(CASE WHEN mas_productcategory.CategoryNameEN = 'Dress Female' then ops_orderdetail.Amount else null end),0)+
                           					coalesce (SUM(CASE WHEN mas_productcategory.CategoryNameEN = 'Shoes' then ops_orderdetail.Amount else null end),0)+
                           					coalesce (SUM(CASE WHEN mas_productcategory.CategoryNameEN = 'Bag' then ops_orderdetail.Amount else null end),0)+
                           					coalesce (SUM(CASE WHEN mas_productcategory.CategoryNameEN = 'Blanket' then ops_orderdetail.Amount else null end),0)+
                           					coalesce (SUM(CASE WHEN mas_productcategory.CategoryNameEN = 'Capet Curtain' then ops_orderdetail.Amount else null end),0)+
                           					coalesce (SUM(CASE WHEN mas_productcategory.CategoryNameEN = 'Others' then ops_orderdetail.Amount else null end),0) AS total


                           					FROM (ops_order left join (mas_branch left join mas_branchgroup on mas_branch.BranchGroupID=mas_branchgroup.BranchGroupID)
                           					on ops_order.BranchID=mas_branch.BranchID)left join
                           					(ops_orderdetail left join (mas_product left join mas_productcategory on mas_product.CategoryID=mas_productcategory.CategoryID)
                           					on ops_orderdetail.ProductID=mas_product.ProductID)
                           					 on ops_order.OrderNo=ops_orderdetail.OrderNo
                           					WHERE ops_order.OrderDate BETWEEN '$date_start' AND '$date_end' AND ops_order.IsActive='1'
                           					GROUP BY  mas_branch.BranchNameTH,ops_order.BranchID,mas_branchgroup.BranchGroupName";
					}else{
					$stmt="SELECT top 20 mas_branch.BranchNameTH,ops_order.BranchID,mas_branchgroup.BranchGroupName,
                           					Count(distinct ops_order.OrderID) AS cont,
                           					coalesce (SUM(CASE WHEN mas_productcategory.CategoryNameEN = 'Dress Male' then ops_orderdetail.Amount else null end),0) AS service1,
                           					coalesce (SUM(CASE WHEN mas_productcategory.CategoryNameEN = 'Dress Female' then ops_orderdetail.Amount else null end),0) AS service2,
                           					coalesce (SUM(CASE WHEN mas_productcategory.CategoryNameEN = 'Shoes' then ops_orderdetail.Amount else null end),0) AS service3,
                           					coalesce (SUM(CASE WHEN mas_productcategory.CategoryNameEN = 'Bag' then ops_orderdetail.Amount else null end),0) AS service4,
                           					coalesce (SUM(CASE WHEN mas_productcategory.CategoryNameEN = 'Blanket' then ops_orderdetail.Amount else null end),0) AS service5,
                           					coalesce (SUM(CASE WHEN mas_productcategory.CategoryNameEN = 'Capet Curtain' then ops_orderdetail.Amount else null end),0) AS service6,
                           					coalesce (SUM(CASE WHEN mas_productcategory.CategoryNameEN = 'Others' then ops_orderdetail.Amount else null end),0) AS service7,

                           					coalesce (SUM(CASE WHEN mas_productcategory.CategoryNameEN = 'Dress Male' then ops_orderdetail.Amount else null end),0)+
                           					coalesce (SUM(CASE WHEN mas_productcategory.CategoryNameEN = 'Dress Female' then ops_orderdetail.Amount else null end),0)+
                           					coalesce (SUM(CASE WHEN mas_productcategory.CategoryNameEN = 'Shoes' then ops_orderdetail.Amount else null end),0)+
                           					coalesce (SUM(CASE WHEN mas_productcategory.CategoryNameEN = 'Bag' then ops_orderdetail.Amount else null end),0)+
                           					coalesce (SUM(CASE WHEN mas_productcategory.CategoryNameEN = 'Blanket' then ops_orderdetail.Amount else null end),0)+
                           					coalesce (SUM(CASE WHEN mas_productcategory.CategoryNameEN = 'Capet Curtain' then ops_orderdetail.Amount else null end),0)+
                           					coalesce (SUM(CASE WHEN mas_productcategory.CategoryNameEN = 'Others' then ops_orderdetail.Amount else null end),0) AS total


                           					FROM (ops_order left join (mas_branch left join mas_branchgroup on mas_branch.BranchGroupID=mas_branchgroup.BranchGroupID)
                           					on ops_order.BranchID=mas_branch.BranchID)left join
                           					(ops_orderdetail left join (mas_product left join mas_productcategory on mas_product.CategoryID=mas_productcategory.CategoryID)
                           					on ops_orderdetail.ProductID=mas_product.ProductID)
                           					 on ops_order.OrderNo=ops_orderdetail.OrderNo
                           					WHERE ops_order.OrderDate BETWEEN '$date_start' AND '$date_end' AND ops_order.BranchID = '".$keywords2."'
                           					AND ops_order.IsActive='1' OR mas_branchgroup.BranchGroupName = '".$keywords."'
                           					GROUP BY  mas_branch.BranchNameTH,ops_order.BranchID,mas_branchgroup.BranchGroupName";
					}}else if($_POST['select_top']==30){
					if($_POST['keywords2']=='cheese'||$_POST['keywords']=='cheese'){
					$stmt="SELECT top 30 mas_branch.BranchNameTH,ops_order.BranchID,mas_branchgroup.BranchGroupName,
                           					Count(distinct ops_order.OrderID) AS cont,
                           					coalesce (SUM(CASE WHEN mas_productcategory.CategoryNameEN = 'Dress Male' then ops_orderdetail.Amount else null end),0) AS service1,
                           					coalesce (SUM(CASE WHEN mas_productcategory.CategoryNameEN = 'Dress Female' then ops_orderdetail.Amount else null end),0) AS service2,
                           					coalesce (SUM(CASE WHEN mas_productcategory.CategoryNameEN = 'Shoes' then ops_orderdetail.Amount else null end),0) AS service3,
                           					coalesce (SUM(CASE WHEN mas_productcategory.CategoryNameEN = 'Bag' then ops_orderdetail.Amount else null end),0) AS service4,
                           					coalesce (SUM(CASE WHEN mas_productcategory.CategoryNameEN = 'Blanket' then ops_orderdetail.Amount else null end),0) AS service5,
                           					coalesce (SUM(CASE WHEN mas_productcategory.CategoryNameEN = 'Capet Curtain' then ops_orderdetail.Amount else null end),0) AS service6,
                           					coalesce (SUM(CASE WHEN mas_productcategory.CategoryNameEN = 'Others' then ops_orderdetail.Amount else null end),0) AS service7,

                           					coalesce (SUM(CASE WHEN mas_productcategory.CategoryNameEN = 'Dress Male' then ops_orderdetail.Amount else null end),0)+
                           					coalesce (SUM(CASE WHEN mas_productcategory.CategoryNameEN = 'Dress Female' then ops_orderdetail.Amount else null end),0)+
                           					coalesce (SUM(CASE WHEN mas_productcategory.CategoryNameEN = 'Shoes' then ops_orderdetail.Amount else null end),0)+
                           					coalesce (SUM(CASE WHEN mas_productcategory.CategoryNameEN = 'Bag' then ops_orderdetail.Amount else null end),0)+
                           					coalesce (SUM(CASE WHEN mas_productcategory.CategoryNameEN = 'Blanket' then ops_orderdetail.Amount else null end),0)+
                           					coalesce (SUM(CASE WHEN mas_productcategory.CategoryNameEN = 'Capet Curtain' then ops_orderdetail.Amount else null end),0)+
                           					coalesce (SUM(CASE WHEN mas_productcategory.CategoryNameEN = 'Others' then ops_orderdetail.Amount else null end),0) AS total


                           					FROM (ops_order left join (mas_branch left join mas_branchgroup on mas_branch.BranchGroupID=mas_branchgroup.BranchGroupID)
                           					on ops_order.BranchID=mas_branch.BranchID)left join
                           					(ops_orderdetail left join (mas_product left join mas_productcategory on mas_product.CategoryID=mas_productcategory.CategoryID)
                           					on ops_orderdetail.ProductID=mas_product.ProductID)
                           					 on ops_order.OrderNo=ops_orderdetail.OrderNo
                           					WHERE ops_order.OrderDate BETWEEN '$date_start' AND '$date_end' AND ops_order.IsActive='1'
                           					GROUP BY  mas_branch.BranchNameTH,ops_order.BranchID,mas_branchgroup.BranchGroupName";
					}else{
					$stmt="SELECT top 20 mas_branch.BranchNameTH,ops_order.BranchID,mas_branchgroup.BranchGroupName,
                           					Count(distinct ops_order.OrderID) AS cont,
                           					coalesce (SUM(CASE WHEN mas_productcategory.CategoryNameEN = 'Dress Male' then ops_orderdetail.Amount else null end),0) AS service1,
                           					coalesce (SUM(CASE WHEN mas_productcategory.CategoryNameEN = 'Dress Female' then ops_orderdetail.Amount else null end),0) AS service2,
                           					coalesce (SUM(CASE WHEN mas_productcategory.CategoryNameEN = 'Shoes' then ops_orderdetail.Amount else null end),0) AS service3,
                           					coalesce (SUM(CASE WHEN mas_productcategory.CategoryNameEN = 'Bag' then ops_orderdetail.Amount else null end),0) AS service4,
                           					coalesce (SUM(CASE WHEN mas_productcategory.CategoryNameEN = 'Blanket' then ops_orderdetail.Amount else null end),0) AS service5,
                           					coalesce (SUM(CASE WHEN mas_productcategory.CategoryNameEN = 'Capet Curtain' then ops_orderdetail.Amount else null end),0) AS service6,
                           					coalesce (SUM(CASE WHEN mas_productcategory.CategoryNameEN = 'Others' then ops_orderdetail.Amount else null end),0) AS service7,

                           					coalesce (SUM(CASE WHEN mas_productcategory.CategoryNameEN = 'Dress Male' then ops_orderdetail.Amount else null end),0)+
                           					coalesce (SUM(CASE WHEN mas_productcategory.CategoryNameEN = 'Dress Female' then ops_orderdetail.Amount else null end),0)+
                           					coalesce (SUM(CASE WHEN mas_productcategory.CategoryNameEN = 'Shoes' then ops_orderdetail.Amount else null end),0)+
                           					coalesce (SUM(CASE WHEN mas_productcategory.CategoryNameEN = 'Bag' then ops_orderdetail.Amount else null end),0)+
                           					coalesce (SUM(CASE WHEN mas_productcategory.CategoryNameEN = 'Blanket' then ops_orderdetail.Amount else null end),0)+
                           					coalesce (SUM(CASE WHEN mas_productcategory.CategoryNameEN = 'Capet Curtain' then ops_orderdetail.Amount else null end),0)+
                           					coalesce (SUM(CASE WHEN mas_productcategory.CategoryNameEN = 'Others' then ops_orderdetail.Amount else null end),0) AS total


                           					FROM (ops_order left join (mas_branch left join mas_branchgroup on mas_branch.BranchGroupID=mas_branchgroup.BranchGroupID)
                           					on ops_order.BranchID=mas_branch.BranchID)left join
                           					(ops_orderdetail left join (mas_product left join mas_productcategory on mas_product.CategoryID=mas_productcategory.CategoryID)
                           					on ops_orderdetail.ProductID=mas_product.ProductID)
                           					 on ops_order.OrderNo=ops_orderdetail.OrderNo
                           					WHERE ops_order.OrderDate BETWEEN '$date_start' AND '$date_end' AND ops_order.BranchID = '".$keywords2."'
                           					AND ops_order.IsActive='1' OR mas_branchgroup.BranchGroupName = '".$keywords."'
                           					GROUP BY  mas_branch.BranchNameTH,ops_order.BranchID,mas_branchgroup.BranchGroupName";
					}}else if($_POST['select_top']==100){
					if($_POST['keywords2']=='cheese'||$_POST['keywords']=='cheese'){
					$stmt="SELECT mas_branch.BranchNameTH,ops_order.BranchID,mas_branchgroup.BranchGroupName,
                           					Count(distinct ops_order.OrderID) AS cont,
                           					coalesce (SUM(CASE WHEN mas_productcategory.CategoryNameEN = 'Dress Male' then ops_orderdetail.Amount else null end),0) AS service1,
                           					coalesce (SUM(CASE WHEN mas_productcategory.CategoryNameEN = 'Dress Female' then ops_orderdetail.Amount else null end),0) AS service2,
                           					coalesce (SUM(CASE WHEN mas_productcategory.CategoryNameEN = 'Shoes' then ops_orderdetail.Amount else null end),0) AS service3,
                           					coalesce (SUM(CASE WHEN mas_productcategory.CategoryNameEN = 'Bag' then ops_orderdetail.Amount else null end),0) AS service4,
                           					coalesce (SUM(CASE WHEN mas_productcategory.CategoryNameEN = 'Blanket' then ops_orderdetail.Amount else null end),0) AS service5,
                           					coalesce (SUM(CASE WHEN mas_productcategory.CategoryNameEN = 'Capet Curtain' then ops_orderdetail.Amount else null end),0) AS service6,
                           					coalesce (SUM(CASE WHEN mas_productcategory.CategoryNameEN = 'Others' then ops_orderdetail.Amount else null end),0) AS service7,

                           					coalesce (SUM(CASE WHEN mas_productcategory.CategoryNameEN = 'Dress Male' then ops_orderdetail.Amount else null end),0)+
                           					coalesce (SUM(CASE WHEN mas_productcategory.CategoryNameEN = 'Dress Female' then ops_orderdetail.Amount else null end),0)+
                           					coalesce (SUM(CASE WHEN mas_productcategory.CategoryNameEN = 'Shoes' then ops_orderdetail.Amount else null end),0)+
                           					coalesce (SUM(CASE WHEN mas_productcategory.CategoryNameEN = 'Bag' then ops_orderdetail.Amount else null end),0)+
                           					coalesce (SUM(CASE WHEN mas_productcategory.CategoryNameEN = 'Blanket' then ops_orderdetail.Amount else null end),0)+
                           					coalesce (SUM(CASE WHEN mas_productcategory.CategoryNameEN = 'Capet Curtain' then ops_orderdetail.Amount else null end),0)+
                           					coalesce (SUM(CASE WHEN mas_productcategory.CategoryNameEN = 'Others' then ops_orderdetail.Amount else null end),0) AS total


                           					FROM (ops_order left join (mas_branch left join mas_branchgroup on mas_branch.BranchGroupID=mas_branchgroup.BranchGroupID)
                           					on ops_order.BranchID=mas_branch.BranchID)left join
                           					(ops_orderdetail left join (mas_product left join mas_productcategory on mas_product.CategoryID=mas_productcategory.CategoryID)
                           					on ops_orderdetail.ProductID=mas_product.ProductID)
                           					 on ops_order.OrderNo=ops_orderdetail.OrderNo
                           					WHERE ops_order.OrderDate BETWEEN '$date_start' AND '$date_end' AND ops_order.IsActive='1'
                           					GROUP BY  mas_branch.BranchNameTH,ops_order.BranchID,mas_branchgroup.BranchGroupName";
					}else{
					$stmt="SELECT mas_branch.BranchNameTH,ops_order.BranchID,mas_branchgroup.BranchGroupName,
                           					Count(distinct ops_order.OrderID) AS cont,
                           					coalesce (SUM(CASE WHEN mas_productcategory.CategoryNameEN = 'Dress Male' then ops_orderdetail.Amount else null end),0) AS service1,
                           					coalesce (SUM(CASE WHEN mas_productcategory.CategoryNameEN = 'Dress Female' then ops_orderdetail.Amount else null end),0) AS service2,
                           					coalesce (SUM(CASE WHEN mas_productcategory.CategoryNameEN = 'Shoes' then ops_orderdetail.Amount else null end),0) AS service3,
                           					coalesce (SUM(CASE WHEN mas_productcategory.CategoryNameEN = 'Bag' then ops_orderdetail.Amount else null end),0) AS service4,
                           					coalesce (SUM(CASE WHEN mas_productcategory.CategoryNameEN = 'Blanket' then ops_orderdetail.Amount else null end),0) AS service5,
                           					coalesce (SUM(CASE WHEN mas_productcategory.CategoryNameEN = 'Capet Curtain' then ops_orderdetail.Amount else null end),0) AS service6,
                           					coalesce (SUM(CASE WHEN mas_productcategory.CategoryNameEN = 'Others' then ops_orderdetail.Amount else null end),0) AS service7,

                           					coalesce (SUM(CASE WHEN mas_productcategory.CategoryNameEN = 'Dress Male' then ops_orderdetail.Amount else null end),0)+
                           					coalesce (SUM(CASE WHEN mas_productcategory.CategoryNameEN = 'Dress Female' then ops_orderdetail.Amount else null end),0)+
                           					coalesce (SUM(CASE WHEN mas_productcategory.CategoryNameEN = 'Shoes' then ops_orderdetail.Amount else null end),0)+
                           					coalesce (SUM(CASE WHEN mas_productcategory.CategoryNameEN = 'Bag' then ops_orderdetail.Amount else null end),0)+
                           					coalesce (SUM(CASE WHEN mas_productcategory.CategoryNameEN = 'Blanket' then ops_orderdetail.Amount else null end),0)+
                           					coalesce (SUM(CASE WHEN mas_productcategory.CategoryNameEN = 'Capet Curtain' then ops_orderdetail.Amount else null end),0)+
                           					coalesce (SUM(CASE WHEN mas_productcategory.CategoryNameEN = 'Others' then ops_orderdetail.Amount else null end),0) AS total


                           					FROM (ops_order left join (mas_branch left join mas_branchgroup on mas_branch.BranchGroupID=mas_branchgroup.BranchGroupID)
                           					on ops_order.BranchID=mas_branch.BranchID)left join
                           					(ops_orderdetail left join (mas_product left join mas_productcategory on mas_product.CategoryID=mas_productcategory.CategoryID)
                           					on ops_orderdetail.ProductID=mas_product.ProductID)
                           					 on ops_order.OrderNo=ops_orderdetail.OrderNo
                           					WHERE ops_order.OrderDate BETWEEN '$date_start' AND '$date_end' AND ops_order.BranchID = '".$keywords2."'
                           					AND ops_order.IsActive='1' OR mas_branchgroup.BranchGroupName = '".$keywords."'
                           					GROUP BY  mas_branch.BranchNameTH,ops_order.BranchID,mas_branchgroup.BranchGroupName";
					}}else{
					if($_POST['keywords2']=='cheese'||$_POST['keywords']=='cheese'){
$stmt="SELECT  mas_branch.BranchNameTH,ops_order.BranchID,mas_branchgroup.BranchGroupName,
                           					Count(distinct ops_order.OrderID) AS cont,
                           					coalesce (SUM(CASE WHEN mas_productcategory.CategoryNameEN = 'Dress Male' then ops_orderdetail.Amount else null end),0) AS service1,
                           					coalesce (SUM(CASE WHEN mas_productcategory.CategoryNameEN = 'Dress Female' then ops_orderdetail.Amount else null end),0) AS service2,
                           					coalesce (SUM(CASE WHEN mas_productcategory.CategoryNameEN = 'Shoes' then ops_orderdetail.Amount else null end),0) AS service3,
                           					coalesce (SUM(CASE WHEN mas_productcategory.CategoryNameEN = 'Bag' then ops_orderdetail.Amount else null end),0) AS service4,
                           					coalesce (SUM(CASE WHEN mas_productcategory.CategoryNameEN = 'Blanket' then ops_orderdetail.Amount else null end),0) AS service5,
                           					coalesce (SUM(CASE WHEN mas_productcategory.CategoryNameEN = 'Capet Curtain' then ops_orderdetail.Amount else null end),0) AS service6,
                           					coalesce (SUM(CASE WHEN mas_productcategory.CategoryNameEN = 'Others' then ops_orderdetail.Amount else null end),0) AS service7,

                           					coalesce (SUM(CASE WHEN mas_productcategory.CategoryNameEN = 'Dress Male' then ops_orderdetail.Amount else null end),0)+
                           					coalesce (SUM(CASE WHEN mas_productcategory.CategoryNameEN = 'Dress Female' then ops_orderdetail.Amount else null end),0)+
                           					coalesce (SUM(CASE WHEN mas_productcategory.CategoryNameEN = 'Shoes' then ops_orderdetail.Amount else null end),0)+
                           					coalesce (SUM(CASE WHEN mas_productcategory.CategoryNameEN = 'Bag' then ops_orderdetail.Amount else null end),0)+
                           					coalesce (SUM(CASE WHEN mas_productcategory.CategoryNameEN = 'Blanket' then ops_orderdetail.Amount else null end),0)+
                           					coalesce (SUM(CASE WHEN mas_productcategory.CategoryNameEN = 'Capet Curtain' then ops_orderdetail.Amount else null end),0)+
                           					coalesce (SUM(CASE WHEN mas_productcategory.CategoryNameEN = 'Others' then ops_orderdetail.Amount else null end),0) AS total


                           					FROM (ops_order left join (mas_branch left join mas_branchgroup on mas_branch.BranchGroupID=mas_branchgroup.BranchGroupID)
                           					on ops_order.BranchID=mas_branch.BranchID)left join
                           					(ops_orderdetail left join (mas_product left join mas_productcategory on mas_product.CategoryID=mas_productcategory.CategoryID)
                           					on ops_orderdetail.ProductID=mas_product.ProductID)
                           					 on ops_order.OrderNo=ops_orderdetail.OrderNo
                           					WHERE ops_order.OrderDate BETWEEN '$date_start' AND '$date_end'
                           					AND ops_order.IsActive='1'
                           					GROUP BY  mas_branch.BranchNameTH,ops_order.BranchID,mas_branchgroup.BranchGroupName";
						}else{
					$stmt="SELECT  mas_branch.BranchNameTH,ops_order.BranchID,mas_branchgroup.BranchGroupName,
                           					Count(distinct ops_order.OrderID) AS cont,
                           					coalesce (SUM(CASE WHEN mas_productcategory.CategoryNameEN = 'Dress Male' then ops_orderdetail.Amount else null end),0) AS service1,
                           					coalesce (SUM(CASE WHEN mas_productcategory.CategoryNameEN = 'Dress Female' then ops_orderdetail.Amount else null end),0) AS service2,
                           					coalesce (SUM(CASE WHEN mas_productcategory.CategoryNameEN = 'Shoes' then ops_orderdetail.Amount else null end),0) AS service3,
                           					coalesce (SUM(CASE WHEN mas_productcategory.CategoryNameEN = 'Bag' then ops_orderdetail.Amount else null end),0) AS service4,
                           					coalesce (SUM(CASE WHEN mas_productcategory.CategoryNameEN = 'Blanket' then ops_orderdetail.Amount else null end),0) AS service5,
                           					coalesce (SUM(CASE WHEN mas_productcategory.CategoryNameEN = 'Capet Curtain' then ops_orderdetail.Amount else null end),0) AS service6,
                           					coalesce (SUM(CASE WHEN mas_productcategory.CategoryNameEN = 'Others' then ops_orderdetail.Amount else null end),0) AS service7,

                           					coalesce (SUM(CASE WHEN mas_productcategory.CategoryNameEN = 'Dress Male' then ops_orderdetail.Amount else null end),0)+
                           					coalesce (SUM(CASE WHEN mas_productcategory.CategoryNameEN = 'Dress Female' then ops_orderdetail.Amount else null end),0)+
                           					coalesce (SUM(CASE WHEN mas_productcategory.CategoryNameEN = 'Shoes' then ops_orderdetail.Amount else null end),0)+
                           					coalesce (SUM(CASE WHEN mas_productcategory.CategoryNameEN = 'Bag' then ops_orderdetail.Amount else null end),0)+
                           					coalesce (SUM(CASE WHEN mas_productcategory.CategoryNameEN = 'Blanket' then ops_orderdetail.Amount else null end),0)+
                           					coalesce (SUM(CASE WHEN mas_productcategory.CategoryNameEN = 'Capet Curtain' then ops_orderdetail.Amount else null end),0)+
                           					coalesce (SUM(CASE WHEN mas_productcategory.CategoryNameEN = 'Others' then ops_orderdetail.Amount else null end),0) AS total


                           					FROM (ops_order left join (mas_branch left join mas_branchgroup on mas_branch.BranchGroupID=mas_branchgroup.BranchGroupID)
                           					on ops_order.BranchID=mas_branch.BranchID)left join
                           					(ops_orderdetail left join (mas_product left join mas_productcategory on mas_product.CategoryID=mas_productcategory.CategoryID)
                           					on ops_orderdetail.ProductID=mas_product.ProductID)
                           					 on ops_order.OrderNo=ops_orderdetail.OrderNo
                           					WHERE ops_order.OrderDate BETWEEN '$date_start' AND '$date_end' AND ops_order.BranchID = '".$keywords2."'
                           					AND ops_order.IsActive='1' OR mas_branchgroup.BranchGroupName = '".$keywords."'
                           					GROUP BY  mas_branch.BranchNameTH,ops_order.BranchID,mas_branchgroup.BranchGroupName";
					}
					}
					$query = sqlsrv_query($conn,$stmt);
					?>


					<div class="row">
						<div class="col-md-12">
							<!--<div class="panel">
								<div class="panel-heading">
									<h3 class="panel-title">Bar Chart</h3>
								</div>
								<div class="panel-body">
									<center>
										<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
										<div id="chart_div" style="height: 1000px; width: 100%"></div>
									</center>
								</div>
							</div>-->
						</div>
					</div>
					<!-- END OVERVIEW -->




					<!-- RECENT PURCHASES -->

					<div class="panel">
						<div class="panel-heading">
							<h3 class="panel-title">ตารางข้อมูล</h3>

						</div>
						<div class="panel-body">
							<table class="table table-bordered">
								<thead>
									<tr>
										<th bgcolor="#ffffff"> <center>ลำดับที่</center> </th>
										<th bgcolor="#ffffff"> <center>ประเภทร้าน</center> </th>
										<th bgcolor="#ffffff"> <center>รหัสร้าน</center> </th>
										<th bgcolor="#ffffff"> <center>ชือร้าน</center> </th>
										<th bgcolor="#ffffff"> <center>เสื้อผ้าบุรษ</center> </th>		<!---service1---->
										<th bgcolor="#ffffff"> <center>เสื้อผ้าสตรี</center> </th>		<!---service2---->
										<th bgcolor="#ffffff"> <center>รองเท้า</center> </th>				<!---service3---->
										<th bgcolor="#ffffff"> <center>กระเป๋า</center> </th>				<!---service4---->
										<th bgcolor="#ffffff"> <center>เครื่องนอน</center> </th>			<!---service5---->
										<th bgcolor="#ffffff"> <center>พรม ผ้าม่าน</center> </th>			<!---service6---->
										<th bgcolor="#ffffff"> <center>อื่นๆ</center> </th>						<!---service7---->
										<th bgcolor="#ffffff"> <center>รวมจำนวนเงิน</center> </th>
									</tr>
								</thead>
								<?php

								$i=1;
								$total1=0;
								$total2=0;
								$total3=0;
								$total4=0;
								$total5=0;
								$total6=0;
								$total7=0;
								$total8=0;
								$total9=0;


								while($row = sqlsrv_fetch_array($query)){

									$format_total=number_format($row['total'],2);

									$total1=$total1+$row['cont'];
									$total2=$total2+$row['service1'];
									$total3=$total3+$row['service2'];
									$total4=$total4+$row['service3'];
									$total5=$total5+$row['service4'];
									$total6=$total6+$row['service5'];
									$total7=$total7+$row['service6'];
									$total8=$total8+$row['service7'];
									$total9=$total9+$row['total'];

									?>

									<tbody>
										<tr>
											<td align="center"><?php echo $i;?></td>
											<td align="center"><?php echo $row['BranchGroupName'];?></td>
											<td align="center"><?php echo $row['BranchID'];?></td>
											<td align="center"><?php echo $row['BranchNameTH'];?></td>
											<td align="center"><?php echo number_format($row['service1'],2);?></td>
											<td align="center"><?php echo number_format($row['service2'],2);?></td>
											<td align="center"><?php echo number_format($row['service3'],2);?></td>
											<td align="center"><?php echo number_format($row['service4'],2);?></td>
											<td align="center"><?php echo number_format($row['service5'],2);?></td>
											<td align="center"><?php echo number_format($row['service6'],2);?></td>
											<td align="center"><?php echo number_format($row['service7'],2);?></td>
											<td align="center"><?php echo $format_total;?></td>
											<?php $i++;}?>
											<tr>

												<td colspan="4" align="center" bgcolor="#2eb82e"><font color="white"><text1><?php echo 'รวม';?></text1></font></td>
												<td align="center" bgcolor="#2eb82e"><text1><font color="white"><?php echo number_format($total2,2);?></font></text1></td>
												<td align="center" bgcolor="#2eb82e"><text1><font color="white"><?php echo number_format($total3,2);?></font></text1></td>
												<td align="center" bgcolor="#2eb82e"><text1><font color="white"><?php echo number_format($total4,2);?></font></text1></td>
												<td align="center" bgcolor="#2eb82e"><text1><font color="white"><?php echo number_format($total5,2);?></font></text1></td>
												<td align="center" bgcolor="#2eb82e"><text1><font color="white"><?php echo number_format($total6,2);?></font></text1></td>
												<td align="center" bgcolor="#2eb82e"><text1><font color="white"><?php echo number_format($total7,2);?></font></text1></td>
												<td align="center" bgcolor="#2eb82e"><text1><font color="white"><?php echo number_format($total8,2);?></font></text1></td>
												<td align="center" bgcolor="#2eb82e"><text1><font color="white"><?php echo number_format($total9,2);?></font></text1></td>

											</tr>
										</tbody>
									</table>
								</div>

								<!-- END RECENT PURCHASES -->
							</div>
						</div>
					</div>
					<!-- END MAIN CONTENT -->
				</div>
				<!-- END MAIN -->
				<div class="clearfix"></div>

			</div>
			<!-- END WRAPPER -->
			<!-- Javascript -->
			<script type="text/javascript">
                function onSelectChange(){
                    document.getElementById('frm').submit();
                }
				function getDate(){
					var start=document.getElementById("date_start").value;
					var end=document.getElementById("date_start").value;
				}

			</script>
	<script src="assets/vendor/jquery/jquery.min.js"></script>
	<script src="assets/vendor/bootstrap/js/bootstrap.min.js"></script>
	<script src="assets/vendor/jquery-slimscroll/jquery.slimscroll.min.js"></script>
	<script src="assets/vendor/jquery.easy-pie-chart/jquery.easypiechart.min.js"></script>
	<script src="assets/vendor/chartist/js/chartist.min.js"></script>
	<script src="assets/scripts/klorofil-common.js"></script>

			<?php
			$query = sqlsrv_query($conn,$stmt);
			?>

			<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
			<script type="text/javascript">
			google.charts.load('current', {packages: ['corechart', 'bar']});
			google.charts.setOnLoadCallback(drawBasic);

			function drawBasic() {
					var data = google.visualization.arrayToDataTable([
						['ชื่อร้านค้า', 'เสื้อผ้าบุรษ','เสื้อผ้าสตรี','รองเท้า','กระเป๋า','เครื่องนอน','พรม ผ้าม่าน','อื่นๆ'],
						<?php
						while($row = sqlsrv_fetch_array($query)) {
							echo "['".$row['BranchNameTH']."',".$row['service1'].",".$row['service2'].",".$row['service3'].",".$row['service4'].",".$row['service5'].",".$row['service6'].",".$row['service7']."],";
						}
						?>
						]);
						var options = {
							hAxis: {
					title: 'จำนวนเงินสุทธิ (บาท)',
					minValue: 0
				},

					 legend: { position: 'top', maxLines: 3 },
					 bar: { groupWidth: '75%' },
					 isStacked: true
					};

					var chart = new google.visualization.BarChart(document.getElementById('chart_div'));

				 chart.draw(data, google.charts.Bar.convertOptions(options));

				 var btns = document.getElementById('btn-group');

				 btns.onclick = function (e) {

					 if (e.target.tagName === 'BUTTON') {
						 options.vAxis.format = e.target.id === 'none' ? '' : e.target.id;
						 chart.draw(data, google.charts.Bar.convertOptions(options));
					 }
				 }
			 }

		 </script>


		</body>

		</html>
