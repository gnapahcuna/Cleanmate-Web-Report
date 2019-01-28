<?php

// Inialize session
session_start();

// Check, if username session is NOT set then this page will jump to login page
if (!isset($_SESSION['username'])) {
header('Location: Login.php');
}

?>
<?php
include('connect.php')
?>
<!doctype html>
<html lang="en">

<head>
	<title>Summary Service</title>
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
					<?php
					if($_SESSION['BranchID']==1){
					?>
					<!--<li><a href="Home-Factory.php" class=""><i class="lnr lnr-home"></i> <span>หน้าแรก</span></a></li>-->
					<li><a href="Summary-All-F.php" class=""><i class="lnr lnr-chart-bars"></i> <span>1. สรุปยอดขายรวมทุกประเภท</span></a></li>
					<li><a href="Order-All.php" class=""><i class="lnr lnr-chart-bars"></i> <span>2. รายงานข้อมูลรายละเอียดออเดอร์</span></a></li>
					<!--<li><a href="Summary-Service-F.php" class=""><i class="lnr lnr-chart-bars"></i> <span>สรุปยอดขายแยกตามประเภทบริการ</span></a></li>
					<li><a href="Summary-Product-Group-F.php" class=""><i class="lnr lnr-chart-bars"></i> <span>สรุปยอดขายแยกตามประเภทกลุ่มสินค้า</span></a></li>-->
					<li><a href="Summary-All-Product-F.php" class=""><i class="lnr lnr-chart-bars"></i> <span>3. สรุปยอดขายแยกตามทุกรายการสินค้า</span></a></li>
					<li><a href="Summary-Canceled-F.php" class=""><i class="lnr lnr-chart-bars"></i> <span>4. สรุปยอดขายรายการยกเลิกออเดอร์<br>(ที่ร้าน, ที่โรงงาน )</span></a></li>
					<li><a href="Order-All-F.php" class=""><i class="lnr lnr-chart-bars"></i> <span>5. สรุปยอดรายการออเดอร์ทุกประเภท</span></a></li>
					<!--<li><a href="Order-Service-F.php" class=""><i class="lnr lnr-chart-bars"></i> <span>สรุปยอดรายการออเดอร์ประเภทบริการ</span></a></li>-->
					<li><a href="Order-Product-Group-F.php" class=""><i class="lnr lnr-chart-bars"></i> <span>6. สรุปยอดรายการออเดอร์ประเภทกลุ่มสินค้า</span></a></li>
					<li><a href="Order-All-Product-F.php" class=""><i class="lnr lnr-chart-bars"></i> <span>7. สรุปยอดรายการออเดอร์ทุกรายการสินค้า</span></a></li>
					<li><a href="Customer-Product-F.php" class=""><i class="lnr lnr-chart-bars"></i> <span>8. สรุปยอดออเดอร์ลูกค้าประจำร้าน</span></a></li>
					<li><a href="Customer-Service-F.php" class=""><i class="lnr lnr-chart-bars"></i> <span>9. สรุปยอดประเภทบริการลูกค้าประจำร้าน</span></a></li>
					<li><a href="Branch-CM-Bill.php" class=""><i class="lnr lnr-chart-bars"></i> <span>10. รายงานใบรับสินค้าของร้านสาขา</span></a></li>
					<li><a href="Branch-Detail-Bill.php" class="active"><i class="lnr lnr-chart-bars"></i> <span>11. รายงานรายละเอียดสินค้าแต่ละบิล</span></a></li>
					<?php }else{?>
					<li><a href="Order-All.php" class=""><i class="lnr lnr-chart-bars"></i> <span>1. รายงานข้อมูลรายละเอียดออเดอร์</span></a></li>
					<!--<li><a href="Summary-Service-F.php" class=""><i class="lnr lnr-chart-bars"></i> <span>สรุปยอดขายแยกตามประเภทบริการ</span></a></li>
					<li><a href="Summary-Product-Group-F.php" class=""><i class="lnr lnr-chart-bars"></i> <span>สรุปยอดขายแยกตามประเภทกลุ่มสินค้า</span></a></li>-->
					<!--<li><a href="Summary-All-Product-F.php" class=""><i class="lnr lnr-chart-bars"></i> <span>2. สรุปยอดขายแยกตามทุกรายการสินค้า</span></a></li>-->
					<li><a href="Summary-Canceled-F.php" class=""><i class="lnr lnr-chart-bars"></i> <span>2. สรุปยอดขายรายการยกเลิกออเดอร์<br>(ที่ร้าน, ที่โรงงาน )</span></a></li>
					<!--<li><a href="Order-All-F.php" class=""><i class="lnr lnr-chart-bars"></i> <span>3. สรุปยอดรายการออเดอร์ทุกประเภท</span></a></li>-->
					<!--<li><a href="Order-Service-F.php" class=""><i class="lnr lnr-chart-bars"></i> <span>สรุปยอดรายการออเดอร์ประเภทบริการ</span></a></li>-->
					<li><a href="Order-Product-Group-F.php" class=""><i class="lnr lnr-chart-bars"></i> <span>3. สรุปยอดรายการออเดอร์ประเภทกลุ่มสินค้า</span></a></li>
					<!--<li><a href="Order-All-Product-F.php" class=""><i class="lnr lnr-chart-bars"></i> <span>6. สรุปยอดรายการออเดอรทุกรายการสินค้า</span></a></li>-->
					<li><a href="Customer-Product-F.php" class="active"><i class="lnr lnr-chart-bars"></i> <span>4. สรุปยอดออเดอร์ลูกค้าประจำร้าน</span></a></li>
					<li><a href="Customer-Service-F.php" class=""><i class="lnr lnr-chart-bars"></i> <span>6. สรุปยอดประเภทบริการลูกค้าประจำร้าน</span></a></li>
					<?php }?>
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
							<?php
									if($_SESSION['BranchID']==1){

									?>
							<form action="Customer-Product-F.php" method="post" onSubmit="return getDate()" >

								<label>เลือกวันที่</label>
								<input type="date" name="date_start" class="form-control" required>
								<br><label>ถึง</label><br>
								<input type="date" name="date_end" class="form-control" required>
								<br><label>ค้นหาประเภทร้าน</label><br>
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
							<?php }else{ ?>
							<form action="Customer-Product-F.php" method="post" onSubmit="return getDate()" >
								<label>เลือกวันที่</label>
								<input type="date" name="date_start" class="form-control" required>
								<br><label>ถึง</label><br>
								<input type="date" name="date_end" class="form-control" required>
								<br>
								<input type="hidden" name="keywords" class="form-control" value="cheese" required>
								<input type="hidden" name="keywords2" class="form-control" value="cheese" required>
								<br>
								<center><input type="submit" value="Search"></center>
								<br><br><br>
							</form>
							<?php }?>
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
											<?php
												$stmt7="select BranchNameTH from mas_branch where BranchID='$keywords2'";
												$query7 = sqlsrv_query($conn,$stmt7);
												if($row = sqlsrv_fetch_array($query7)){?>
										<h4 align="right"><?php echo $row['BranchNameTH'];?><h4>
											<?php }?>
											<?php
												if($_POST['select_top']){
												 if($_POST['select_top']==100){?>
											<h4 align="right"><?php echo 'แสดงทั้งหมด (All)';?></h4>
											<?php }else{?>

											<h4 align="right"><?php	echo $_POST['select_top'].' อันดับแรก (Top '.$_POST['select_top'].')'; ?> </h4>
											<?php }
												}
												?>
										</p>
									</div>
								</div>

							</div>
						</div>
						<div class="panel-body">
							<label>จัดอันดับ</label><br>
							<form method="post" action="Customer-Product-F.php" id="frm">
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

				if($_SESSION['BranchID']==1){


					if($_POST['select_top']==10){
					if($_POST['keywords2']=='cheese'&&$_POST['keywords']=='cheese'){
				$stmt="select distinct top 10 ROW_NUMBER() OVER(ORDER BY uac_customer.CustomerID ASC) AS Row ,mas_branch.BranchNameTH,
case when  uac_customer.CustomerType=1 then 'ลูกค้าสมาชิก' else 'ลูกค้าทั่วไป' end as CustomerType,uac_customer.CustomerID,
uac_customer.FirstName+' '+uac_customer.LastName as CustomerName,uac_customer.TelephoneNo,count(ops_order.OrderNo) as counts,
((sum(Amount)+sum((Amount)*coalesce(ExpressRate,0))/100)+sum(coalesce(ops_orderdetail.AdditionAmount,0)))-sum(coalesce(ops_orderdetail.DiscountAmount,0)) as total,
MAX(OrderDate) as dates
from (((ops_order left join uac_customer on ops_order.CustomerID=uac_customer.CustomerID)
left join (mas_branch left join mas_branchtype on mas_branch.BranchType=mas_branchtype.BranchTypeID) ON ops_order.BranchID=mas_branch.BranchID)
left join ops_orderdetail on ops_order.OrderNo=ops_orderdetail.OrderNo)
left join mas_priceexpression on ops_order.IsExpressLevel=mas_priceexpression.IsExpressLevel
WHERE ops_order.OrderDate BETWEEN '$date_start' AND '$date_end' AND ops_order.IsActive='1'
GROUP BY uac_customer.CustomerID,uac_customer.FirstName,uac_customer.LastName,uac_customer.TelephoneNo,mas_branch.BranchNameTH,uac_customer.CustomerType
Order By uac_customer.CustomerID DESC";

$stmt1="select top 10 count(ops_order.OrderNo) as nums,ops_order.CustomerID,sum(PromoDiscount) as PromoDiscount,sum(ops_order.IsExpress)as counts, coalesce(sum(SpecialDiscount),0) as SpecialDiscount from (ops_order
left join (mas_branch left join mas_branchtype on mas_branch.BranchID=mas_branchtype.BranchTypeID)
on ops_order.BranchID=mas_branch.BranchID)
WHERE ops_order.OrderDate BETWEEN '$date_start' AND '$date_end' AND ops_order.IsActive='1'
GROUP BY ops_order.CustomerID,ops_order.BranchID
Order By ops_order.CustomerID DESC";
				}else if($_POST['keywords2']!='cheese'&&$_POST['keywords']=='cheese'){
						$stmt="select distinct top 10 ROW_NUMBER() OVER(ORDER BY uac_customer.CustomerID ASC) AS Row ,mas_branch.BranchNameTH,
case when  uac_customer.CustomerType=1 then 'ลูกค้าสมาชิก' else 'ลูกค้าทั่วไป' end as CustomerType,uac_customer.CustomerID,
uac_customer.FirstName+' '+uac_customer.LastName as CustomerName,uac_customer.TelephoneNo,count(ops_order.OrderNo) as counts,
((sum(Amount)+sum((Amount)*coalesce(ExpressRate,0))/100)+sum(coalesce(ops_orderdetail.AdditionAmount,0)))-sum(coalesce(ops_orderdetail.DiscountAmount,0)) as total,
MAX(OrderDate) as dates
from (((ops_order left join uac_customer on ops_order.CustomerID=uac_customer.CustomerID)
left join (mas_branch left join mas_branchtype on mas_branch.BranchType=mas_branchtype.BranchTypeID) ON ops_order.BranchID=mas_branch.BranchID)
left join ops_orderdetail on ops_order.OrderNo=ops_orderdetail.OrderNo)
left join mas_priceexpression on ops_order.IsExpressLevel=mas_priceexpression.IsExpressLevel
WHERE ops_order.OrderDate BETWEEN '$date_start' AND '$date_end' AND ops_order.IsActive='1'
AND mas_branch.BranchID = '".$keywords2."'
GROUP BY uac_customer.CustomerID,uac_customer.FirstName,uac_customer.LastName,uac_customer.TelephoneNo,mas_branch.BranchNameTH,uac_customer.CustomerType
Order By uac_customer.CustomerID DESC";

$stmt1="select top 10 count(ops_order.OrderNo) as nums,ops_order.CustomerID,sum(PromoDiscount) as PromoDiscount,sum(ops_order.IsExpress)as counts, coalesce(sum(SpecialDiscount),0) as SpecialDiscount from (ops_order
left join (mas_branch left join mas_branchtype on mas_branch.BranchID=mas_branchtype.BranchTypeID)
on ops_order.BranchID=mas_branch.BranchID)
WHERE ops_order.OrderDate BETWEEN '$date_start' AND '$date_end' AND ops_order.IsActive='1'
AND mas_branch.BranchID = '".$keywords2."'
GROUP BY ops_order.CustomerID,ops_order.BranchID
Order By ops_order.CustomerID DESC";
						}
						else{
					$stmt="select distinct top 10 ROW_NUMBER() OVER(ORDER BY uac_customer.CustomerID ASC) AS Row ,mas_branch.BranchNameTH,
case when  uac_customer.CustomerType=1 then 'ลูกค้าสมาชิก' else 'ลูกค้าทั่วไป' end as CustomerType,uac_customer.CustomerID,
uac_customer.FirstName+' '+uac_customer.LastName as CustomerName,uac_customer.TelephoneNo,count(ops_order.OrderNo) as counts,
((sum(Amount)+sum((Amount)*coalesce(ExpressRate,0))/100)+sum(coalesce(ops_orderdetail.AdditionAmount,0)))-sum(coalesce(ops_orderdetail.DiscountAmount,0)) as total,
MAX(OrderDate) as dates
from (((ops_order left join uac_customer on ops_order.CustomerID=uac_customer.CustomerID)
left join (mas_branch left join mas_branchtype on mas_branch.BranchType=mas_branchtype.BranchTypeID) ON ops_order.BranchID=mas_branch.BranchID)
left join ops_orderdetail on ops_order.OrderNo=ops_orderdetail.OrderNo)
left join mas_priceexpression on ops_order.IsExpressLevel=mas_priceexpression.IsExpressLevel
WHERE ops_order.OrderDate BETWEEN '$date_start' AND '$date_end' AND ops_order.IsActive='1'
AND mas_branch.BranchType = '".$keywords."'
GROUP BY uac_customer.CustomerID,uac_customer.FirstName,uac_customer.LastName,uac_customer.TelephoneNo,mas_branch.BranchNameTH,uac_customer.CustomerType
Order By uac_customer.CustomerID DESC";

$stmt1="select top 10 count(ops_order.OrderNo) as nums,ops_order.CustomerID,sum(PromoDiscount) as PromoDiscount,sum(ops_order.IsExpress)as counts, coalesce(sum(SpecialDiscount),0) as SpecialDiscount from (ops_order
left join (mas_branch left join mas_branchtype on mas_branch.BranchID=mas_branchtype.BranchTypeID)
on ops_order.BranchID=mas_branch.BranchID)
WHERE ops_order.OrderDate BETWEEN '$date_start' AND '$date_end' AND ops_order.IsActive='1'
AND mas_branch.BranchType = '".$keywords."'
GROUP BY ops_order.CustomerID,ops_order.BranchID
Order By ops_order.CustomerID DESC";
				}
				}
				else if($_POST['select_top']==20){
				if($_POST['keywords2']=='cheese'&&$_POST['keywords']=='cheese'){
				$stmt="select distinct top 20 ROW_NUMBER() OVER(ORDER BY uac_customer.CustomerID ASC) AS Row ,mas_branch.BranchNameTH,
case when  uac_customer.CustomerType=1 then 'ลูกค้าสมาชิก' else 'ลูกค้าทั่วไป' end as CustomerType,uac_customer.CustomerID,
uac_customer.FirstName+' '+uac_customer.LastName as CustomerName,uac_customer.TelephoneNo,count(ops_order.OrderNo) as counts,
((sum(Amount)+sum((Amount)*coalesce(ExpressRate,0))/100)+sum(coalesce(ops_orderdetail.AdditionAmount,0)))-sum(coalesce(ops_orderdetail.DiscountAmount,0)) as total,
MAX(OrderDate) as dates
from (((ops_order left join uac_customer on ops_order.CustomerID=uac_customer.CustomerID)
left join (mas_branch left join mas_branchtype on mas_branch.BranchType=mas_branchtype.BranchTypeID) ON ops_order.BranchID=mas_branch.BranchID)
left join ops_orderdetail on ops_order.OrderNo=ops_orderdetail.OrderNo)
left join mas_priceexpression on ops_order.IsExpressLevel=mas_priceexpression.IsExpressLevel
WHERE ops_order.OrderDate BETWEEN '$date_start' AND '$date_end' AND ops_order.IsActive='1'
GROUP BY uac_customer.CustomerID,uac_customer.FirstName,uac_customer.LastName,uac_customer.TelephoneNo,mas_branch.BranchNameTH,uac_customer.CustomerType
Order By uac_customer.CustomerID DESC";

$stmt1="select top 20 count(ops_order.OrderNo) as nums,ops_order.CustomerID,sum(PromoDiscount) as PromoDiscount,sum(ops_order.IsExpress)as counts, coalesce(sum(SpecialDiscount),0) as SpecialDiscount from (ops_order
left join (mas_branch left join mas_branchtype on mas_branch.BranchID=mas_branchtype.BranchTypeID)
on ops_order.BranchID=mas_branch.BranchID)
WHERE ops_order.OrderDate BETWEEN '$date_start' AND '$date_end' AND ops_order.IsActive='1'
GROUP BY ops_order.CustomerID,ops_order.BranchID
Order By ops_order.CustomerID DESC";
				}else if($_POST['keywords2']!='cheese'&&$_POST['keywords']=='cheese'){
						$stmt="select distinct top 20 ROW_NUMBER() OVER(ORDER BY uac_customer.CustomerID ASC) AS Row ,mas_branch.BranchNameTH,
case when  uac_customer.CustomerType=1 then 'ลูกค้าสมาชิก' else 'ลูกค้าทั่วไป' end as CustomerType,uac_customer.CustomerID,
uac_customer.FirstName+' '+uac_customer.LastName as CustomerName,uac_customer.TelephoneNo,count(ops_order.OrderNo) as counts,
((sum(Amount)+sum((Amount)*coalesce(ExpressRate,0))/100)+sum(coalesce(ops_orderdetail.AdditionAmount,0)))-sum(coalesce(ops_orderdetail.DiscountAmount,0)) as total,
MAX(OrderDate) as dates
from (((ops_order left join uac_customer on ops_order.CustomerID=uac_customer.CustomerID)
left join (mas_branch left join mas_branchtype on mas_branch.BranchType=mas_branchtype.BranchTypeID) ON ops_order.BranchID=mas_branch.BranchID)
left join ops_orderdetail on ops_order.OrderNo=ops_orderdetail.OrderNo)
left join mas_priceexpression on ops_order.IsExpressLevel=mas_priceexpression.IsExpressLevel
WHERE ops_order.OrderDate BETWEEN '$date_start' AND '$date_end' AND ops_order.IsActive='1'
AND mas_branch.BranchID = '".$keywords2."'
GROUP BY uac_customer.CustomerID,uac_customer.FirstName,uac_customer.LastName,uac_customer.TelephoneNo,mas_branch.BranchNameTH,uac_customer.CustomerType
Order By uac_customer.CustomerID DESC";

$stmt1="select top 20 count(ops_order.OrderNo) as nums,ops_order.CustomerID,sum(PromoDiscount) as PromoDiscount,sum(ops_order.IsExpress)as counts , coalesce(sum(SpecialDiscount),0) as SpecialDiscountfrom (ops_order
left join (mas_branch left join mas_branchtype on mas_branch.BranchID=mas_branchtype.BranchTypeID)
on ops_order.BranchID=mas_branch.BranchID)
WHERE ops_order.OrderDate BETWEEN '$date_start' AND '$date_end' AND ops_order.IsActive='1'
AND mas_branch.BranchID = '".$keywords2."'
GROUP BY ops_order.CustomerID,ops_order.BranchID
Order By ops_order.CustomerID DESC";
						}
						else{
					$stmt="select distinct top 20 ROW_NUMBER() OVER(ORDER BY uac_customer.CustomerID ASC) AS Row ,mas_branch.BranchNameTH,
case when  uac_customer.CustomerType=1 then 'ลูกค้าสมาชิก' else 'ลูกค้าทั่วไป' end as CustomerType,uac_customer.CustomerID,
uac_customer.FirstName+' '+uac_customer.LastName as CustomerName,uac_customer.TelephoneNo,count(ops_order.OrderNo) as counts,
((sum(Amount)+sum((Amount)*coalesce(ExpressRate,0))/100)+sum(coalesce(ops_orderdetail.AdditionAmount,0)))-sum(coalesce(ops_orderdetail.DiscountAmount,0)) as total,
MAX(OrderDate) as dates
from (((ops_order left join uac_customer on ops_order.CustomerID=uac_customer.CustomerID)
left join (mas_branch left join mas_branchtype on mas_branch.BranchType=mas_branchtype.BranchTypeID) ON ops_order.BranchID=mas_branch.BranchID)
left join ops_orderdetail on ops_order.OrderNo=ops_orderdetail.OrderNo)
left join mas_priceexpression on ops_order.IsExpressLevel=mas_priceexpression.IsExpressLevel
WHERE ops_order.OrderDate BETWEEN '$date_start' AND '$date_end' AND ops_order.IsActive='1'
AND mas_branch.BranchType = '".$keywords."'
GROUP BY uac_customer.CustomerID,uac_customer.FirstName,uac_customer.LastName,uac_customer.TelephoneNo,mas_branch.BranchNameTH,uac_customer.CustomerType
Order By uac_customer.CustomerID DESC";

$stmt1="select top 20 count(ops_order.OrderNo) as nums,ops_order.CustomerID,sum(PromoDiscount) as PromoDiscount,sum(ops_order.IsExpress)as count, coalesce(sum(SpecialDiscount),0) as SpecialDiscounts from (ops_order
left join (mas_branch left join mas_branchtype on mas_branch.BranchID=mas_branchtype.BranchTypeID)
on ops_order.BranchID=mas_branch.BranchID)
WHERE ops_order.OrderDate BETWEEN '$date_start' AND '$date_end' AND ops_order.IsActive='1'
AND mas_branch.BranchType = '".$keywords."'
GROUP BY ops_order.CustomerID,ops_order.BranchID
Order By ops_order.CustomerID DESC";
				}
				}
				else if($_POST['select_top']==30){
				if($_POST['keywords2']=='cheese'&&$_POST['keywords']=='cheese'){
				$stmt="select distinct top 30 ROW_NUMBER() OVER(ORDER BY uac_customer.CustomerID ASC) AS Row ,mas_branch.BranchNameTH,
case when  uac_customer.CustomerType=1 then 'ลูกค้าสมาชิก' else 'ลูกค้าทั่วไป' end as CustomerType,uac_customer.CustomerID,
uac_customer.FirstName+' '+uac_customer.LastName as CustomerName,uac_customer.TelephoneNo,count(ops_order.OrderNo) as counts,
((sum(Amount)+sum((Amount)*coalesce(ExpressRate,0))/100)+sum(coalesce(ops_orderdetail.AdditionAmount,0)))-sum(coalesce(ops_orderdetail.DiscountAmount,0)) as total,
MAX(OrderDate) as dates
from (((ops_order left join uac_customer on ops_order.CustomerID=uac_customer.CustomerID)
left join (mas_branch left join mas_branchtype on mas_branch.BranchType=mas_branchtype.BranchTypeID) ON ops_order.BranchID=mas_branch.BranchID)
left join ops_orderdetail on ops_order.OrderNo=ops_orderdetail.OrderNo)
left join mas_priceexpression on ops_order.IsExpressLevel=mas_priceexpression.IsExpressLevel
WHERE ops_order.OrderDate BETWEEN '$date_start' AND '$date_end' AND ops_order.IsActive='1'
GROUP BY uac_customer.CustomerID,uac_customer.FirstName,uac_customer.LastName,uac_customer.TelephoneNo,mas_branch.BranchNameTH,uac_customer.CustomerType
Order By uac_customer.CustomerID DESC";

$stmt1="select top 30 count(ops_order.OrderNo) as nums,ops_order.CustomerID,sum(PromoDiscount) as PromoDiscount,sum(ops_order.IsExpress)as counts, coalesce(sum(SpecialDiscount),0) as SpecialDiscount from (ops_order
left join (mas_branch left join mas_branchtype on mas_branch.BranchID=mas_branchtype.BranchTypeID)
on ops_order.BranchID=mas_branch.BranchID)
WHERE ops_order.OrderDate BETWEEN '$date_start' AND '$date_end' AND ops_order.IsActive='1'
GROUP BY ops_order.CustomerID,ops_order.BranchID
Order By ops_order.CustomerID DESC";
				}else if($_POST['keywords2']!='cheese'&&$_POST['keywords']=='cheese'){
						$stmt="select distinct top 30 ROW_NUMBER() OVER(ORDER BY uac_customer.CustomerID ASC) AS Row ,mas_branch.BranchNameTH,
case when  uac_customer.CustomerType=1 then 'ลูกค้าสมาชิก' else 'ลูกค้าทั่วไป' end as CustomerType,uac_customer.CustomerID,
uac_customer.FirstName+' '+uac_customer.LastName as CustomerName,uac_customer.TelephoneNo,count(ops_order.OrderNo) as counts,
((sum(Amount)+sum((Amount)*coalesce(ExpressRate,0))/100)+sum(coalesce(ops_orderdetail.AdditionAmount,0)))-sum(coalesce(ops_orderdetail.DiscountAmount,0)) as total,
MAX(OrderDate) as dates
from (((ops_order left join uac_customer on ops_order.CustomerID=uac_customer.CustomerID)
left join (mas_branch left join mas_branchtype on mas_branch.BranchType=mas_branchtype.BranchTypeID) ON ops_order.BranchID=mas_branch.BranchID)
left join ops_orderdetail on ops_order.OrderNo=ops_orderdetail.OrderNo)
left join mas_priceexpression on ops_order.IsExpressLevel=mas_priceexpression.IsExpressLevel
WHERE ops_order.OrderDate BETWEEN '$date_start' AND '$date_end' AND ops_order.IsActive='1'
AND mas_branch.BranchID = '".$keywords2."'
GROUP BY uac_customer.CustomerID,uac_customer.FirstName,uac_customer.LastName,uac_customer.TelephoneNo,mas_branch.BranchNameTH,uac_customer.CustomerType
Order By uac_customer.CustomerID DESC";

$stmt1="select top 30 count(ops_order.OrderNo) as nums,ops_order.CustomerID,sum(PromoDiscount) as PromoDiscount,sum(ops_order.IsExpress)as counts, coalesce(sum(SpecialDiscount),0) as SpecialDiscount from (ops_order
left join (mas_branch left join mas_branchtype on mas_branch.BranchID=mas_branchtype.BranchTypeID)
on ops_order.BranchID=mas_branch.BranchID)
WHERE ops_order.OrderDate BETWEEN '$date_start' AND '$date_end' AND ops_order.IsActive='1'
AND mas_branch.BranchID = '".$keywords2."'
GROUP BY ops_order.CustomerID,ops_order.BranchID
Order By ops_order.CustomerID DESC";
						}
						else{
					$stmt="select distinct top 30 ROW_NUMBER() OVER(ORDER BY uac_customer.CustomerID ASC) AS Row ,mas_branch.BranchNameTH,
case when  uac_customer.CustomerType=1 then 'ลูกค้าสมาชิก' else 'ลูกค้าทั่วไป' end as CustomerType,uac_customer.CustomerID,
uac_customer.FirstName+' '+uac_customer.LastName as CustomerName,uac_customer.TelephoneNo,count(ops_order.OrderNo) as counts,
((sum(Amount)+sum((Amount)*coalesce(ExpressRate,0))/100)+sum(coalesce(ops_orderdetail.AdditionAmount,0)))-sum(coalesce(ops_orderdetail.DiscountAmount,0)) as total,
MAX(OrderDate) as dates
from (((ops_order left join uac_customer on ops_order.CustomerID=uac_customer.CustomerID)
left join (mas_branch left join mas_branchtype on mas_branch.BranchType=mas_branchtype.BranchTypeID) ON ops_order.BranchID=mas_branch.BranchID)
left join ops_orderdetail on ops_order.OrderNo=ops_orderdetail.OrderNo)
left join mas_priceexpression on ops_order.IsExpressLevel=mas_priceexpression.IsExpressLevel
WHERE ops_order.OrderDate BETWEEN '$date_start' AND '$date_end' AND ops_order.IsActive='1'
AND mas_branch.BranchType = '".$keywords."'
GROUP BY uac_customer.CustomerID,uac_customer.FirstName,uac_customer.LastName,uac_customer.TelephoneNo,mas_branch.BranchNameTH,uac_customer.CustomerType
Order By uac_customer.CustomerID DESC";

$stmt1="select top 30 count(ops_order.OrderNo) as nums,ops_order.CustomerID,sum(PromoDiscount) as PromoDiscount,sum(ops_order.IsExpress)as counts, coalesce(sum(SpecialDiscount),0) as SpecialDiscount from (ops_order
left join (mas_branch left join mas_branchtype on mas_branch.BranchID=mas_branchtype.BranchTypeID)
on ops_order.BranchID=mas_branch.BranchID)
WHERE ops_order.OrderDate BETWEEN '$date_start' AND '$date_end' AND ops_order.IsActive='1'
AND mas_branch.BranchType = '".$keywords."'
GROUP BY ops_order.CustomerID,ops_order.BranchID
Order By ops_order.CustomerID DESC";
				}
				}
				else if($_POST['select_top']==100){
				if($_POST['keywords2']=='cheese'||$_POST['keywords']=='cheese'){
				$stmt="select distinct ROW_NUMBER() OVER(ORDER BY uac_customer.CustomerID ASC) AS Row ,mas_branch.BranchNameTH,
case when  uac_customer.CustomerType=1 then 'ลูกค้าสมาชิก' else 'ลูกค้าทั่วไป' end as CustomerType,uac_customer.CustomerID,
uac_customer.FirstName+' '+uac_customer.LastName as CustomerName,uac_customer.TelephoneNo,count(ops_order.OrderNo) as counts,
((sum(Amount)+sum((Amount)*coalesce(ExpressRate,0))/100)+sum(coalesce(ops_orderdetail.AdditionAmount,0)))-sum(coalesce(ops_orderdetail.DiscountAmount,0)) as total,
MAX(OrderDate) as dates
from (((ops_order left join uac_customer on ops_order.CustomerID=uac_customer.CustomerID)
left join (mas_branch left join mas_branchtype on mas_branch.BranchType=mas_branchtype.BranchTypeID) ON ops_order.BranchID=mas_branch.BranchID)
left join ops_orderdetail on ops_order.OrderNo=ops_orderdetail.OrderNo)
left join mas_priceexpression on ops_order.IsExpressLevel=mas_priceexpression.IsExpressLevel
WHERE ops_order.OrderDate BETWEEN '$date_start' AND '$date_end' AND ops_order.IsActive='1'
GROUP BY uac_customer.CustomerID,uac_customer.FirstName,uac_customer.LastName,uac_customer.TelephoneNo,mas_branch.BranchNameTH,uac_customer.CustomerType
Order By uac_customer.CustomerID DESC";

$stmt1="select count(ops_order.OrderNo) as nums,ops_order.CustomerID,sum(PromoDiscount) as PromoDiscount,sum(ops_order.IsExpress)as counts, coalesce(sum(SpecialDiscount),0) as SpecialDiscount from (ops_order
left join (mas_branch left join mas_branchtype on mas_branch.BranchID=mas_branchtype.BranchTypeID)
on ops_order.BranchID=mas_branch.BranchID)
WHERE ops_order.OrderDate BETWEEN '$date_start' AND '$date_end' AND ops_order.IsActive='1'
GROUP BY ops_order.CustomerID,ops_order.BranchID
Order By ops_order.CustomerID DESC";
				}else if($_POST['keywords2']!='cheese'&&$_POST['keywords']=='cheese'){
						$stmt="select distinct ROW_NUMBER() OVER(ORDER BY uac_customer.CustomerID ASC) AS Row ,mas_branch.BranchNameTH,
case when  uac_customer.CustomerType=1 then 'ลูกค้าสมาชิก' else 'ลูกค้าทั่วไป' end as CustomerType,uac_customer.CustomerID,
uac_customer.FirstName+' '+uac_customer.LastName as CustomerName,uac_customer.TelephoneNo,count(ops_order.OrderNo) as counts,
((sum(Amount)+sum((Amount)*coalesce(ExpressRate,0))/100)+sum(coalesce(ops_orderdetail.AdditionAmount,0)))-sum(coalesce(ops_orderdetail.DiscountAmount,0)) as total,
MAX(OrderDate) as dates
from (((ops_order left join uac_customer on ops_order.CustomerID=uac_customer.CustomerID)
left join (mas_branch left join mas_branchtype on mas_branch.BranchType=mas_branchtype.BranchTypeID) ON ops_order.BranchID=mas_branch.BranchID)
left join ops_orderdetail on ops_order.OrderNo=ops_orderdetail.OrderNo)
left join mas_priceexpression on ops_order.IsExpressLevel=mas_priceexpression.IsExpressLevel
WHERE ops_order.OrderDate BETWEEN '".$date_start."' AND '".$date_end."' AND ops_order.IsActive='1'
AND mas_branch.BranchID = '".$keywords2."'
GROUP BY uac_customer.CustomerID,uac_customer.FirstName,uac_customer.LastName,uac_customer.TelephoneNo,mas_branch.BranchNameTH,uac_customer.CustomerType
Order By uac_customer.CustomerID DESC";

$stmt1="select count(ops_order.OrderNo) as nums,ops_order.CustomerID,sum(PromoDiscount) as PromoDiscount,sum(ops_order.IsExpress)as counts, coalesce(sum(SpecialDiscount),0) as SpecialDiscount from (ops_order
left join (mas_branch left join mas_branchtype on mas_branch.BranchID=mas_branchtype.BranchTypeID)
on ops_order.BranchID=mas_branch.BranchID)
WHERE ops_order.OrderDate BETWEEN '$date_start' AND '$date_end' AND ops_order.IsActive='1'
AND mas_branch.BranchID = '".$keywords2."'
GROUP BY ops_order.CustomerID,ops_order.BranchID
Order By ops_order.CustomerID DESC";
						}
						else{
					$stmt="select distinct ROW_NUMBER() OVER(ORDER BY uac_customer.CustomerID ASC) AS Row ,mas_branch.BranchNameTH,
case when  uac_customer.CustomerType=1 then 'ลูกค้าสมาชิก' else 'ลูกค้าทั่วไป' end as CustomerType,uac_customer.CustomerID,
uac_customer.FirstName+' '+uac_customer.LastName as CustomerName,uac_customer.TelephoneNo,count(ops_order.OrderNo) as counts,
((sum(Amount)+sum((Amount)*coalesce(ExpressRate,0))/100)+sum(coalesce(ops_orderdetail.AdditionAmount,0)))-sum(coalesce(ops_orderdetail.DiscountAmount,0)) as total,
MAX(OrderDate) as dates
from (((ops_order left join uac_customer on ops_order.CustomerID=uac_customer.CustomerID)
left join (mas_branch left join mas_branchtype on mas_branch.BranchType=mas_branchtype.BranchTypeID) ON ops_order.BranchID=mas_branch.BranchID)
left join ops_orderdetail on ops_order.OrderNo=ops_orderdetail.OrderNo)
left join mas_priceexpression on ops_order.IsExpressLevel=mas_priceexpression.IsExpressLevel
WHERE ops_order.OrderDate BETWEEN '".$date_start."' AND '".$date_end."' AND ops_order.IsActive='1'
AND mas_branch.BranchType = '".$keywords."'
GROUP BY uac_customer.CustomerID,uac_customer.FirstName,uac_customer.LastName,uac_customer.TelephoneNo,mas_branch.BranchNameTH,uac_customer.CustomerType
Order By uac_customer.CustomerID DESC";

$stmt1="select count(ops_order.OrderNo) as nums,ops_order.CustomerID,sum(PromoDiscount) as PromoDiscount,sum(ops_order.IsExpress)as counts, coalesce(sum(SpecialDiscount),0) as SpecialDiscount from (ops_order
left join (mas_branch left join mas_branchtype on mas_branch.BranchID=mas_branchtype.BranchTypeID)
on ops_order.BranchID=mas_branch.BranchID)
WHERE ops_order.OrderDate BETWEEN '$date_start' AND '$date_end' AND ops_order.IsActive='1'
AND mas_branch.BranchType = '".$keywords."'
GROUP BY ops_order.CustomerID,ops_order.BranchID
Order By ops_order.CustomerID DESC";
				}
				}
				else{
				if($_POST['keywords2']=='cheese'&&$_POST['keywords']=='cheese'){
$stmt="select distinct ROW_NUMBER() OVER(ORDER BY uac_customer.CustomerID ASC) AS Row ,mas_branch.BranchNameTH,
case when  uac_customer.CustomerType=1 then 'ลูกค้าสมาชิก' else 'ลูกค้าทั่วไป' end as CustomerType,uac_customer.CustomerID,
uac_customer.FirstName+' '+uac_customer.LastName as CustomerName,uac_customer.TelephoneNo,count(ops_order.OrderNo) as counts,
((sum(Amount)+sum((Amount)*coalesce(ExpressRate,0))/100)+sum(coalesce(ops_orderdetail.AdditionAmount,0)))-sum(coalesce(ops_orderdetail.DiscountAmount,0)) as total,
MAX(OrderDate) as dates
from (((ops_order left join uac_customer on ops_order.CustomerID=uac_customer.CustomerID)
left join (mas_branch left join mas_branchtype on mas_branch.BranchType=mas_branchtype.BranchTypeID) ON ops_order.BranchID=mas_branch.BranchID)
left join ops_orderdetail on ops_order.OrderNo=ops_orderdetail.OrderNo)
left join mas_priceexpression on ops_order.IsExpressLevel=mas_priceexpression.IsExpressLevel
WHERE ops_order.OrderDate BETWEEN '".$date_start."' AND '".$date_end."' AND ops_order.IsActive='1'
GROUP BY uac_customer.CustomerID,uac_customer.FirstName,uac_customer.LastName,uac_customer.TelephoneNo,mas_branch.BranchNameTH,uac_customer.CustomerType
Order By uac_customer.CustomerID DESC";

$stmt1="select  count(ops_order.OrderNo) as nums,ops_order.CustomerID,sum(PromoDiscount) as PromoDiscount,sum(ops_order.IsExpress)as counts, coalesce(sum(SpecialDiscount),0) as SpecialDiscount from (ops_order
left join (mas_branch left join mas_branchtype on mas_branch.BranchID=mas_branchtype.BranchTypeID)
on ops_order.BranchID=mas_branch.BranchID)
WHERE ops_order.OrderDate BETWEEN '$date_start' AND '$date_end' AND ops_order.IsActive='1'
GROUP BY ops_order.CustomerID,ops_order.BranchID
Order By ops_order.CustomerID DESC";

						}else if($_POST['keywords2']!='cheese'&&$_POST['keywords']=='cheese'){
						$stmt="select distinct ROW_NUMBER() OVER(ORDER BY uac_customer.CustomerID ASC) AS Row ,mas_branch.BranchNameTH,
case when  uac_customer.CustomerType=1 then 'ลูกค้าสมาชิก' else 'ลูกค้าทั่วไป' end as CustomerType,uac_customer.CustomerID,
uac_customer.FirstName+' '+uac_customer.LastName as CustomerName,uac_customer.TelephoneNo,count(ops_order.OrderNo) as counts,
((sum(Amount)+sum((Amount)*coalesce(ExpressRate,0))/100)+sum(coalesce(ops_orderdetail.AdditionAmount,0)))-sum(coalesce(ops_orderdetail.DiscountAmount,0)) as total,
MAX(OrderDate) as dates
from (((ops_order left join uac_customer on ops_order.CustomerID=uac_customer.CustomerID)
left join (mas_branch left join mas_branchtype on mas_branch.BranchType=mas_branchtype.BranchTypeID) ON ops_order.BranchID=mas_branch.BranchID)
left join ops_orderdetail on ops_order.OrderNo=ops_orderdetail.OrderNo)
left join mas_priceexpression on ops_order.IsExpressLevel=mas_priceexpression.IsExpressLevel
WHERE ops_order.OrderDate BETWEEN '".$date_start."' AND '".$date_end."' AND ops_order.IsActive='1'
AND mas_branch.BranchID = '".$keywords2."'
GROUP BY uac_customer.CustomerID,uac_customer.FirstName,uac_customer.LastName,uac_customer.TelephoneNo,mas_branch.BranchNameTH,uac_customer.CustomerType
Order By uac_customer.CustomerID DESC";

$stmt1="select count(ops_order.OrderNo) as nums,ops_order.CustomerID,sum(PromoDiscount) as PromoDiscount,sum(ops_order.IsExpress)as counts, coalesce(sum(SpecialDiscount),0) as SpecialDiscount from (ops_order
left join (mas_branch left join mas_branchtype on mas_branch.BranchID=mas_branchtype.BranchTypeID)
on ops_order.BranchID=mas_branch.BranchID)
WHERE ops_order.OrderDate BETWEEN '$date_start' AND '$date_end' AND ops_order.IsActive='1'
AND mas_branch.BranchID = '".$keywords2."'
GROUP BY ops_order.CustomerID,ops_order.BranchID
Order By ops_order.CustomerID DESC";
						}
						else{
					$stmt="select distinct ROW_NUMBER() OVER(ORDER BY uac_customer.CustomerID ASC) AS Row ,mas_branch.BranchNameTH,
case when  uac_customer.CustomerType=1 then 'ลูกค้าสมาชิก' else 'ลูกค้าทั่วไป' end as CustomerType,uac_customer.CustomerID,
uac_customer.FirstName+' '+uac_customer.LastName as CustomerName,uac_customer.TelephoneNo,count(ops_order.OrderNo) as counts,
((sum(Amount)+sum((Amount)*coalesce(ExpressRate,0))/100)+sum(coalesce(ops_orderdetail.AdditionAmount,0)))-sum(coalesce(ops_orderdetail.DiscountAmount,0)) as total,
MAX(OrderDate) as dates
from (((ops_order left join uac_customer on ops_order.CustomerID=uac_customer.CustomerID)
left join (mas_branch left join mas_branchtype on mas_branch.BranchType=mas_branchtype.BranchTypeID) ON ops_order.BranchID=mas_branch.BranchID)
left join ops_orderdetail on ops_order.OrderNo=ops_orderdetail.OrderNo)
left join mas_priceexpression on ops_order.IsExpressLevel=mas_priceexpression.IsExpressLevel
WHERE ops_order.OrderDate BETWEEN '".$date_start."' AND '".$date_end."' AND ops_order.IsActive='1'
AND mas_branch.BranchType = '".$keywords."'
GROUP BY uac_customer.CustomerID,uac_customer.FirstName,uac_customer.LastName,uac_customer.TelephoneNo,mas_branch.BranchNameTH,uac_customer.CustomerType
Order By uac_customer.CustomerID DESC";

$stmt1="select count(ops_order.OrderNo) as nums,ops_order.CustomerID,sum(PromoDiscount) as PromoDiscount,sum(ops_order.IsExpress)as counts, coalesce(sum(SpecialDiscount),0) as SpecialDiscount from (ops_order
left join (mas_branch left join mas_branchtype on mas_branch.BranchID=mas_branchtype.BranchTypeID)
on ops_order.BranchID=mas_branch.BranchID)
WHERE ops_order.OrderDate BETWEEN '$date_start' AND '$date_end' AND ops_order.IsActive='1'
AND mas_branch.BranchType = '".$keywords."'
GROUP BY ops_order.CustomerID,ops_order.BranchID
Order By ops_order.CustomerID DESC";
				}
				}


				//branch
				}else{

				if($_POST['select_top']==10){
					if($_POST['keywords2']=='cheese'&&$_POST['keywords']=='cheese'){
				$stmt="select distinct top 10 ROW_NUMBER() OVER(ORDER BY uac_customer.CustomerID ASC) AS Row ,mas_branch.BranchNameTH,
case when  uac_customer.CustomerType=1 then 'ลูกค้าสมาชิก' else 'ลูกค้าทั่วไป' end as CustomerType,uac_customer.CustomerID,
uac_customer.FirstName+' '+uac_customer.LastName as CustomerName,uac_customer.TelephoneNo,count(ops_order.OrderNo) as counts,
((sum(Amount)+sum((Amount)*coalesce(ExpressRate,0))/100)+sum(coalesce(ops_orderdetail.AdditionAmount,0)))-sum(coalesce(ops_orderdetail.DiscountAmount,0)) as total,
MAX(OrderDate) as dates
from (((ops_order left join uac_customer on ops_order.CustomerID=uac_customer.CustomerID)
left join (mas_branch left join mas_branchtype on mas_branch.BranchType=mas_branchtype.BranchTypeID) ON ops_order.BranchID=mas_branch.BranchID)
left join ops_orderdetail on ops_order.OrderNo=ops_orderdetail.OrderNo)
left join mas_priceexpression on ops_order.IsExpressLevel=mas_priceexpression.IsExpressLevel
WHERE ops_order.OrderDate BETWEEN '$date_start' AND '$date_end' AND ops_order.IsActive='1'
 AND mas_branch.BranchID='".$_SESSION['BranchID']."'
GROUP BY uac_customer.CustomerID,uac_customer.FirstName,uac_customer.LastName,uac_customer.TelephoneNo,mas_branch.BranchNameTH,uac_customer.CustomerType
Order By uac_customer.CustomerID DESC";

$stmt1="select top 10 count(ops_order.OrderNo) as nums,ops_order.CustomerID,sum(PromoDiscount) as PromoDiscount,sum(ops_order.IsExpress)as counts, coalesce(sum(SpecialDiscount),0) as SpecialDiscount from (ops_order
left join (mas_branch left join mas_branchtype on mas_branch.BranchID=mas_branchtype.BranchTypeID)
on ops_order.BranchID=mas_branch.BranchID)
WHERE ops_order.OrderDate BETWEEN '$date_start' AND '$date_end' AND ops_order.IsActive='1'
 AND mas_branch.BranchID='".$_SESSION['BranchID']."'
GROUP BY ops_order.CustomerID,ops_order.BranchID
Order By ops_order.CustomerID DESC";
				}
				}
				else if($_POST['select_top']==20){
				if($_POST['keywords2']=='cheese'&&$_POST['keywords']=='cheese'){
				$stmt="select distinct top 20 ROW_NUMBER() OVER(ORDER BY uac_customer.CustomerID ASC) AS Row ,mas_branch.BranchNameTH,
case when  uac_customer.CustomerType=1 then 'ลูกค้าสมาชิก' else 'ลูกค้าทั่วไป' end as CustomerType,uac_customer.CustomerID,
uac_customer.FirstName+' '+uac_customer.LastName as CustomerName,uac_customer.TelephoneNo,count(ops_order.OrderNo) as counts,
((sum(Amount)+sum((Amount)*coalesce(ExpressRate,0))/100)+sum(coalesce(ops_orderdetail.AdditionAmount,0)))-sum(coalesce(ops_orderdetail.DiscountAmount,0)) as total,
MAX(OrderDate) as dates
from (((ops_order left join uac_customer on ops_order.CustomerID=uac_customer.CustomerID)
left join (mas_branch left join mas_branchtype on mas_branch.BranchType=mas_branchtype.BranchTypeID) ON ops_order.BranchID=mas_branch.BranchID)
left join ops_orderdetail on ops_order.OrderNo=ops_orderdetail.OrderNo)
left join mas_priceexpression on ops_order.IsExpressLevel=mas_priceexpression.IsExpressLevel
WHERE ops_order.OrderDate BETWEEN '$date_start' AND '$date_end' AND ops_order.IsActive='1'
 AND mas_branch.BranchID='".$_SESSION['BranchID']."'
GROUP BY uac_customer.CustomerID,uac_customer.FirstName,uac_customer.LastName,uac_customer.TelephoneNo,mas_branch.BranchNameTH,uac_customer.CustomerType
Order By uac_customer.CustomerID DESC";

$stmt1="select top 20 count(ops_order.OrderNo) as nums,ops_order.CustomerID,sum(PromoDiscount) as PromoDiscount,sum(ops_order.IsExpress)as counts, coalesce(sum(SpecialDiscount),0) as SpecialDiscount from (ops_order
left join (mas_branch left join mas_branchtype on mas_branch.BranchID=mas_branchtype.BranchTypeID)
on ops_order.BranchID=mas_branch.BranchID)
WHERE ops_order.OrderDate BETWEEN '$date_start' AND '$date_end' AND ops_order.IsActive='1'
 AND mas_branch.BranchID='".$_SESSION['BranchID']."'
GROUP BY ops_order.CustomerID,ops_order.BranchID
Order By ops_order.CustomerID DESC";
				}
				}
				else if($_POST['select_top']==30){
				if($_POST['keywords2']=='cheese'&&$_POST['keywords']=='cheese'){
				$stmt="select distinct top 30 ROW_NUMBER() OVER(ORDER BY uac_customer.CustomerID ASC) AS Row ,mas_branch.BranchNameTH,
case when  uac_customer.CustomerType=1 then 'ลูกค้าสมาชิก' else 'ลูกค้าทั่วไป' end as CustomerType,uac_customer.CustomerID,
uac_customer.FirstName+' '+uac_customer.LastName as CustomerName,uac_customer.TelephoneNo,count(ops_order.OrderNo) as counts,
((sum(Amount)+sum((Amount)*coalesce(ExpressRate,0))/100)+sum(coalesce(ops_orderdetail.AdditionAmount,0)))-sum(coalesce(ops_orderdetail.DiscountAmount,0)) as total,
MAX(OrderDate) as dates
from (((ops_order left join uac_customer on ops_order.CustomerID=uac_customer.CustomerID)
left join (mas_branch left join mas_branchtype on mas_branch.BranchType=mas_branchtype.BranchTypeID) ON ops_order.BranchID=mas_branch.BranchID)
left join ops_orderdetail on ops_order.OrderNo=ops_orderdetail.OrderNo)
left join mas_priceexpression on ops_order.IsExpressLevel=mas_priceexpression.IsExpressLevel
WHERE ops_order.OrderDate BETWEEN '$date_start' AND '$date_end' AND ops_order.IsActive='1'
 AND mas_branch.BranchID='".$_SESSION['BranchID']."'
GROUP BY uac_customer.CustomerID,uac_customer.FirstName,uac_customer.LastName,uac_customer.TelephoneNo,mas_branch.BranchNameTH,uac_customer.CustomerType
Order By uac_customer.CustomerID DESC";

$stmt1="select top 30 count(ops_order.OrderNo) as nums,ops_order.CustomerID,sum(PromoDiscount) as PromoDiscount,sum(ops_order.IsExpress)as counts, coalesce(sum(SpecialDiscount),0) as SpecialDiscount from (ops_order
left join (mas_branch left join mas_branchtype on mas_branch.BranchID=mas_branchtype.BranchTypeID)
on ops_order.BranchID=mas_branch.BranchID)
WHERE ops_order.OrderDate BETWEEN '$date_start' AND '$date_end' AND ops_order.IsActive='1'
 AND mas_branch.BranchID='".$_SESSION['BranchID']."'
GROUP BY ops_order.CustomerID,ops_order.BranchID
Order By ops_order.CustomerID DESC";
				}
				}
				else if($_POST['select_top']==100){
				if($_POST['keywords2']=='cheese'||$_POST['keywords']=='cheese'){
				$stmt="select distinct ROW_NUMBER() OVER(ORDER BY uac_customer.CustomerID ASC) AS Row ,mas_branch.BranchNameTH,
case when  uac_customer.CustomerType=1 then 'ลูกค้าสมาชิก' else 'ลูกค้าทั่วไป' end as CustomerType,uac_customer.CustomerID,
uac_customer.FirstName+' '+uac_customer.LastName as CustomerName,uac_customer.TelephoneNo,count(ops_order.OrderNo) as counts,
((sum(Amount)+sum((Amount)*coalesce(ExpressRate,0))/100)+sum(coalesce(ops_orderdetail.AdditionAmount,0)))-sum(coalesce(ops_orderdetail.DiscountAmount,0)) as total,
MAX(OrderDate) as dates
from (((ops_order left join uac_customer on ops_order.CustomerID=uac_customer.CustomerID)
left join (mas_branch left join mas_branchtype on mas_branch.BranchType=mas_branchtype.BranchTypeID) ON ops_order.BranchID=mas_branch.BranchID)
left join ops_orderdetail on ops_order.OrderNo=ops_orderdetail.OrderNo)
left join mas_priceexpression on ops_order.IsExpressLevel=mas_priceexpression.IsExpressLevel
WHERE ops_order.OrderDate BETWEEN '$date_start' AND '$date_end' AND ops_order.IsActive='1'
 AND mas_branch.BranchID='".$_SESSION['BranchID']."'
GROUP BY uac_customer.CustomerID,uac_customer.FirstName,uac_customer.LastName,uac_customer.TelephoneNo,mas_branch.BranchNameTH,uac_customer.CustomerType
Order By uac_customer.CustomerID DESC";

$stmt1="select count(ops_order.OrderNo) as nums,ops_order.CustomerID,sum(PromoDiscount) as PromoDiscount,sum(ops_order.IsExpress)as counts, coalesce(sum(SpecialDiscount),0) as SpecialDiscount from (ops_order
left join (mas_branch left join mas_branchtype on mas_branch.BranchID=mas_branchtype.BranchTypeID)
on ops_order.BranchID=mas_branch.BranchID)
WHERE ops_order.OrderDate BETWEEN '$date_start' AND '$date_end' AND ops_order.IsActive='1'
 AND mas_branch.BranchID='".$_SESSION['BranchID']."'
GROUP BY ops_order.CustomerID,ops_order.BranchID
Order By ops_order.CustomerID DESC";
				}
				}
				else{
				if($_POST['keywords2']=='cheese'&&$_POST['keywords']=='cheese'){
$stmt="select distinct ROW_NUMBER() OVER(ORDER BY uac_customer.CustomerID ASC) AS Row ,mas_branch.BranchNameTH,
case when  uac_customer.CustomerType=1 then 'ลูกค้าสมาชิก' else 'ลูกค้าทั่วไป' end as CustomerType,uac_customer.CustomerID,
uac_customer.FirstName+' '+uac_customer.LastName as CustomerName,uac_customer.TelephoneNo,count(ops_order.OrderNo) as counts,
((sum(Amount)+sum((Amount)*coalesce(ExpressRate,0))/100)+sum(coalesce(ops_orderdetail.AdditionAmount,0)))-sum(coalesce(ops_orderdetail.DiscountAmount,0)) as total,
MAX(OrderDate) as dates
from (((ops_order left join uac_customer on ops_order.CustomerID=uac_customer.CustomerID)
left join (mas_branch left join mas_branchtype on mas_branch.BranchType=mas_branchtype.BranchTypeID) ON ops_order.BranchID=mas_branch.BranchID)
left join ops_orderdetail on ops_order.OrderNo=ops_orderdetail.OrderNo)
left join mas_priceexpression on ops_order.IsExpressLevel=mas_priceexpression.IsExpressLevel
WHERE ops_order.OrderDate BETWEEN '".$date_start."' AND '".$date_end."' AND ops_order.IsActive='1'
 AND mas_branch.BranchID='".$_SESSION['BranchID']."'
GROUP BY uac_customer.CustomerID,uac_customer.FirstName,uac_customer.LastName,uac_customer.TelephoneNo,mas_branch.BranchNameTH,uac_customer.CustomerType
Order By uac_customer.CustomerID DESC";

$stmt1="select  count(ops_order.OrderNo) as nums,ops_order.CustomerID,sum(PromoDiscount) as PromoDiscount,sum(ops_order.IsExpress)as counts, coalesce(sum(SpecialDiscount),0) as SpecialDiscount from (ops_order
left join (mas_branch left join mas_branchtype on mas_branch.BranchID=mas_branchtype.BranchTypeID)
on ops_order.BranchID=mas_branch.BranchID)
WHERE ops_order.OrderDate BETWEEN '$date_start' AND '$date_end' AND ops_order.IsActive='1'
 AND mas_branch.BranchID='".$_SESSION['BranchID']."'
GROUP BY ops_order.CustomerID,ops_order.BranchID
Order By ops_order.CustomerID DESC";

						}
				}
				}


					$query = sqlsrv_query($conn,$stmt);
					$query1 = sqlsrv_query($conn,$stmt1);
					$query2 = sqlsrv_query($conn,$stmt);


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
						<div class="table-responsive">
						<table class="table table-bordered">
							<thead>
							<tr>
								<th bgcolor="#ffffff"> <center>ลำดับที่</center> </th>
								<th bgcolor="#ffffff"> <center>ชื่อ-นามสกุล</center> </th>
								<th bgcolor="#ffffff"> <center>เบอร์มือถือ</center> </th>
								<th bgcolor="#ffffff"> <center>ประเภทลูกค้า</center> </th>
								<th bgcolor="#ffffff"> <center>จำนวนออเดอร์</center> </th>
								<th bgcolor="#ffffff"> <center>จำนวนเงิน</center> </th>
								<th bgcolor="#ffffff"> <center>ส่วนลดพิเศษ</center> </th>
								<th bgcolor="#ffffff"> <center>จำนวนเงินสุทธิ</center> </th>
								<th bgcolor="#ffffff"> <center>ใช้บริการครั้งล่าสุด วดป</center> </th>
							</tr>
							</thead>
							<?php

								$i=1;
								$total1=0;
								$total2=0;
								$total3=0;
								$total4=0;



								$arrCustomerName=array();
								$arrPhone=array();
								$arrCustomerType=array();
								$arrCount=array();
								$arrCount1=array();
								$arrTotal=array();
								$arrDate=array();
								$arrNums=array();
								$arrSpecail=array();
								while($row = sqlsrv_fetch_array($query)){


									array_push($arrCustomerName,$row['CustomerName']);
									array_push($arrPhone,$row['TelephoneNo']);
									array_push($arrCustomerType,$row['CustomerType']);
									array_push($arrCount,$row['counts']);
									array_push($arrTotal,$row['total']);
									array_push($arrDate,$row['dates']);
								}
								$arrPromo=array();
								while($row1 = sqlsrv_fetch_array($query1)){
										array_push($arrPromo,$row1['PromoDiscount']);
										array_push($arrCount1,$row1['counts']);
										array_push($arrNums,$row1['nums']);
										array_push($arrSpecail,$row1['SpecialDiscount']);
								}
								for($i=0;$i<count($arrPromo);$i++){
									$total1=$total1+$arrNums[$i];
									$total2=$total2+$arrTotal[$i]-$arrPromo[$i];
									$total3=$total3+$arrSpecail[$i];
									$total4=$total4+($arrTotal[$i]-$arrPromo[$i])-$arrSpecail[$i];
								?>
							<tbody>
							<tr>
								<td align="center"><?php echo $i+1;?></td>
								<td align="center"><?php echo $arrCustomerName[$i];?></td>
								<td align="center"><?php echo $arrPhone[$i];?></td>
								<td align="center"><?php echo $arrCustomerType[$i];?></td>
								<td align="center"><?php echo number_format($arrNums[$i]);?></td>
								<td align="center"><?php echo number_format($arrTotal[$i]-$arrPromo[$i],2);?></td>
								<td align="center"><?php echo number_format($arrSpecail[$i],2);?></td>
								<td align="center"><?php echo number_format($arrTotal[$i]-$arrPromo[$i]-$arrSpecail[$i],2);?></td>
								<td align="center"><?php echo $arrDate[$i];?></td>
								<?php }?>
							<tr>

								<td colspan="4" align="center" bgcolor="#2eb82e"><font color="white"><text1><?php echo 'รวม';?></text1></font></td>
								<td align="center" bgcolor="#2eb82e"><text1><font color="white"><?php echo number_format($total1);?></font></text1></td>
								<td align="center" bgcolor="#2eb82e"><text1><font color="white"><?php echo number_format($total2,2);?></font></text1></td>
								<td align="center" bgcolor="#2eb82e"><text1><font color="white"><?php echo number_format($total3,2);?></font></text1></td>
								<td align="center" bgcolor="#2eb82e"><text1><font color="white"><?php echo number_format($total4,2);?></font></text1></td>
								<td align="center" bgcolor="#2eb82e"><text1><font color="white"></font></text1></td>
							</tr>
							</tbody>
						</table>
						</div>
					</div>

					<!-- END RECENT PURCHASES -->
				</div>



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
    function onSelectChange1(){
        document.getElementById('frm1').submit();
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
            ['ชื่อร้านค้า', 'ซักแห้ง','ซักน้ำ','ซักน้ำ','สปาเครื่องหนัง'],
        <?php
        while($row = sqlsrv_fetch_array($query)) {
            echo "['".$row['FirstName'].' '.$row['LastName'].'(สาขา'.$row['BranchNameTH']."',".$row['service1'].",".$row['service2'].",".$row['service3'].",".$row['service4']."],";
        }
            ?>
    ]);
        var options = {
            colors: ['#ff9999', '#8080ff', '#99ffff', '#ffa31a'],
            hAxis: {
                title: 'จำนวนสินค้า (ชิ้น)',
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
