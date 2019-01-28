<?php include('connect.php') ?>
<!doctype html>
<html lang="en">

<head>
	<title>Summary All</title>
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

					<li><a href="Home-Factory.php" class="active"><i class="lnr lnr-home"></i> <span>หน้าแรก</span></a></li>
					<li><a href="Summary-All-F.php" class=""><i class="lnr lnr-chart-bars"></i> <span>สรุปยอดขายรวมทุกประเภท</span></a></li>
					<li><a href="Order-All.php" class=""><i class="lnr lnr-chart-bars"></i> <span>รายงานข้อมูลรายละเอียดออเดอร์</span></a></li>
					<li><a href="Summary-Service-F.php" class=""><i class="lnr lnr-chart-bars"></i> <span>สรุปยอดขายแยกตามประเภทบริการ</span></a></li>
					<li><a href="Summary-Product-Group-F.php" class=""><i class="lnr lnr-chart-bars"></i> <span>สรุปยอดขายแยกตามประเภทกลุ่มสินค้า</span></a></li>
					<li><a href="Summary-All-Product-F.php" class=""><i class="lnr lnr-chart-bars"></i> <span>สรุปยอดขายแยกตามทุกรายการสินค้า</span></a></li>
					<li><a href="Summary-Canceled-F.php" class=""><i class="lnr lnr-chart-bars"></i> <span>สรุปยอดขายรายการยกเลิกออเดอร์<br>(ที่ร้าน, ที่โรงงาน )</span></a></li>
					<li><a href="Order-All-F.php" class=""><i class="lnr lnr-chart-bars"></i> <span>สรุปยอดรายการออเดอร์ทุกประเภท</span></a></li>
					<li><a href="Order-Service-F.php" class=""><i class="lnr lnr-chart-bars"></i> <span>สรุปยอดรายการออเดอร์ประเภทบริการ</span></a></li>
					<li><a href="Order-Product-Group-F.php" class=""><i class="lnr lnr-chart-bars"></i> <span>สรุปยอดรายการออเดอร์ประเภทกลุ่มสินค้า</span></a></li>
					<li><a href="Order-All-Product-F.php" class=""><i class="lnr lnr-chart-bars"></i> <span>สรุปยอดรายการออเดอรทุกรายการสินค้า</span></a></li>
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
							<form action="Order-All.php" method="post" onSubmit="return getDate()" >

								<label>เลือกวันที่</label>
								<input type="date" name="date_start" class="form-control" required>
								<br><label>ถึง</label><br>
								<input type="date" name="date_end" class="form-control" required>
								<br>
								<label>ค้นหาประเภทร้าน</label><br>
								<select class="form-control"  name="keywords" required>
									<option value="cheese">--เลือกประเภทร้าน--</option>
									<?php
									$stmt="select BranchTypeNameTH from mas_branchtype where IsActive=1";
									$query = sqlsrv_query($conn,$stmt);
									while($row = sqlsrv_fetch_array($query)){
									?>
										<option value="<?php echo $row["BranchTypeNameTH"];?>"><?php echo $row["BranchTypeNameTH"];?></option>
									<?php } ?>
								</select>
								<br><label>ค้นหาชื่อร้าน</label><br>
								<select class="form-control"  name="keywords2" required>
									<option value="cheese">--เลือกชื่อร้าน--</option>
									<?php
									$stmt="select distinct BranchNameTH from ops_order left join mas_branch on ops_order.BranchID=mas_branch.BranchID where ops_order.IsActive=1";
									$query = sqlsrv_query($conn,$stmt);
									while($row = sqlsrv_fetch_array($query)){
									?>
									<option value="<?php echo $row["BranchNameTH"];?>"><?php echo $row["BranchNameTH"];?></option>
									<?php } ?>
								</select>
								<br>

								<input type="submit" value="Search">

							</form>
						</div>
					</div>
				</div>
				<!-- END INPUTS -->

				<?php
					$top=$_POST['select_top'];
					$date_start=$_POST['start'];
					$date_end=$_POST['end'];
					$keywords=$_POST["keywords"];
					$keywords2=$_POST["keywords2"];
					?>
				<div class="col-md-6">
					<!-- INPUTS -->
					<div class="panel">
						<div class="panel-heading">

							<h1>10 อันดับ</h1>
							<h1>สรุปยอดขายรวมทุกประเภท</h1>

							<h2 class="panel-title">ผลการค้นหา <?php echo $$top;?></h2>
						</div>
						<div class="panel-body">
							<div class="row">
								<div class="col-md-12">
									<div class="metric">
										<p><span class="title">วันที่</span>
											<span class="number"><?php echo "&nbsp";?><?php echo substr($date_start,8,2);?>-<?php echo substr($date_start,5,2);?>-<?php echo substr($date_start,0,4);?>
												<?php echo "&nbsp ถึง &nbsp";?>
												<?php echo substr($date_end,8,2);?>-<?php echo substr($date_end,5,2);?>-<?php echo substr($date_end,0,4);?></span>
										</p>
										<br>
									</div>
								</div>

							</div>
						</div><br>
						<div class="panel-body">
							<label>จัดอันดับ</label><br>
							<select class="form-control"  name="forma" onchange="location = this.value;">
								<option value="cheese">--เลือกการจัดอันดับ--</option>
								<option value="Summary-All-F10.php">10 อันดับแรก (Top 10)</option>
								<option value="Summary-All-F20.php">20 อันดับแรก (Top 20)</option>
								<option value="Summary-All-F30.php">30 อันดับแรก (Top 30)</option>
							</select>
							<br>
						</div>
					</div>
				</div>



				<!-- END INPUTS -->



				<!-- OVERVIEW -->
				<?php
					$stmt="select distinct ROW_NUMBER() OVER(ORDER BY ops_order.OrderNo ASC) AS Row ,mas_branch.BranchNameTH,
mas_branchtype.BranchTypeNameTH,ops_order.OrderDate,ops_order.OrderNo,
coalesce (SUM(CASE WHEN ops_orderdetail.ServiceNameEN = 'Dry Clean' then 1 else null end),0) AS service1,
coalesce (SUM(CASE WHEN ops_orderdetail.ServiceNameEN = 'Laundry' then 1 else null end),0) AS service2,
coalesce (SUM(CASE WHEN ops_orderdetail.ServiceNameEN = 'Spa Leathers' then 1 else null end),0) AS service3,
coalesce (SUM(CASE WHEN ops_orderdetail.ServiceNameEN = 'hand wash' then 1 else null end),0) AS service4,
coalesce (SUM(CASE WHEN ops_orderdetail.ServiceNameEN = 'Dry Clean' then 1 else null end),0) +
coalesce (SUM(CASE WHEN ops_orderdetail.ServiceNameEN = 'Laundry' then 1 else null end),0) +
coalesce (SUM(CASE WHEN ops_orderdetail.ServiceNameEN = 'Spa Leathers' then 1 else null end),0) +
coalesce (SUM(CASE WHEN ops_orderdetail.ServiceNameEN = 'hand wash' then 1 else null end),0) AS counts,
sum(Amount)-PromoDiscount - case when (IsExpress=0 OR IsExpress IS NULL) then 0 else (sum(Amount)-((sum(Amount)*IsExpressLevel)/100)) end as total
from ((ops_order left join uac_customer on ops_order.CustomerID=uac_customer.CustomerID)
left join (mas_branch left join mas_branchtype on mas_branch.BranchType=mas_branchtype.BranchTypeID) ON ops_order.BranchID=mas_branch.BranchID)
left join ops_orderdetail on ops_order.OrderNo=ops_orderdetail.OrderNo
WHERE  (ops_order.OrderDate BETWEEN '".$date_start."' AND '".$date_end."' AND ops_order.IsActive='1') OR mas_branch.BranchNameTH = '".$keywords."' OR mas_branchtype.BranchTypeNameTH = '".$keywords2."'
GROUP BY mas_branch.BranchNameTH,ops_order.OrderNo,mas_branchtype.BranchTypeNameTH,ops_order.OrderDate,ops_order.NetAmount,ops_order.OrderNo,
ops_order.IsExpress,ops_order.IsExpressLevel,OrderDate,ops_order.PromoDiscount";

					$query = sqlsrv_query($conn,$stmt);
					?>


				<div class="row">
					<div class="col-md-12">
						<div class="panel">
							<div class="panel-heading">
								<h3 class="panel-title">Bar Chart</h3>
							</div>
							<div class="panel-body">
								<center>
									<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
									<div id="chart_div" style="height: 370px; width: 100%"></div>
								</center>
							</div>
						</div>
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
								<th bgcolor="#ffffff"> <center>ประเภทสาขา</center> </th>
								<th bgcolor="#ffffff"> <center>สาขา</center> </th>
								<th bgcolor="#ffffff"> <center>วดป ออเดอร์</center> </th>
								<th bgcolor="#ffffff"> <center>เลขที่ออเดอร์</center> </th>
								<th bgcolor="#ffffff"> <center>ซักแห้ง(ชิ้น)</center> </th>
								<th bgcolor="#ffffff"> <center>ซักน้ำ(ชิ้น)</center> </th>
								<th bgcolor="#ffffff"> <center>ซักน้ำด้วยมือ(ชิ้น)</center> </th>
								<th bgcolor="#ffffff"> <center>สปาเครื่องหนัง(ชิ้น)</center> </th>
								<th bgcolor="#ffffff"> <center>รวมจำนวน(ชิ้น)</center> </th>
								<th bgcolor="#ffffff"> <center>จำนวนเงิน</center> </th>
							</tr>
							</thead>
							<?php

								$i=1;
								$total1=0;

								while($row = sqlsrv_fetch_array($query)){

									$format_total=number_format($row['total'],2);

									$total1=$total1+$row['service1'];
									$total2=$total2+$row['service2'];
									$total3=$total3+$row['service3'];
									$total4=$total4+$row['service4'];
									$total5=$total5+$row['counts'];
									$total6=$total6+$row['total'];

									?>

							<tbody>
							<tr>
								<td align="center"><?php echo $row['Row'];?></td>
								<td align="center"><?php echo $row['BranchTypeNameTH'];?></td>
								<td align="center"><?php echo $row['BranchNameTH'];?></td>
								<td align="center"><?php echo $row['OrderDate'];?></td>
								<td align="center"><?php echo $row['OrderNo'];?></td>
								<td align="center"><?php echo $row['service1'];?></td>
								<td align="center"><?php echo $row['service2'];?></td>
								<td align="center"><?php echo $row['service3'];?></td>
								<td align="center"><?php echo $row['service4'];?></td>
								<td align="center"><?php echo $row['counts'];?></td>
								<td align="center"><?php echo $row['total'];?></td>
								<?php $i++;}?>
							<tr>

								<td colspan="5" align="center" bgcolor="#2eb82e"><font color="white"><text1><?php echo 'รวม';?></text1></font></td>
								<td align="center" bgcolor="#2eb82e"><text1><font color="white"><?php echo $total1;?></font></text1></td>
								<td align="center" bgcolor="#2eb82e"><text1><font color="white"><?php echo $total2;?></font></text1></td>
								<td align="center" bgcolor="#2eb82e"><text1><font color="white"><?php echo $total3;?></font></text1></td>
								<td align="center" bgcolor="#2eb82e"><text1><font color="white"><?php echo $total4;?></font></text1></td>
								<td align="center" bgcolor="#2eb82e"><text1><font color="white"><?php echo $total5;?></font></text1></td>
								<td align="center" bgcolor="#2eb82e"><text1><font color="white"><?php echo number_format($total6,2);?></font></text1></td>
							</tr>
							</tbody>
						</table>
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
    google.charts.load('current', {'packages':['bar']});
    google.charts.setOnLoadCallback(drawChart);


    $('#list').change(function() {
        var top=0;
        if ($(this).val() === '10') {
            top=10;
        }else if($(this).val() === '20'){
            top=20;
        }else if($(this).val() === '30'){
            top=30;
        }
        $.ajax({
            url: 'Summary-All-F.php?top='+top,
            type: 'POST',
            data: {option : selectedValue},
            success: function() {
                console.log("Data sent!");
            }
        });
    });

    function drawChart() {
        var data = google.visualization.arrayToDataTable([
            ['ชื่อร้านค้า','จำนวนออร์เดอร์ซักแห้ง','จำนวนออร์เดอร์ซักน้ำ','จำนวนออร์เดอร์ซักน้ำด้วยมือ','จำนวนออร์เดอร์สปาเครื่องหนัง'],
        <?php
        while($row = sqlsrv_fetch_array($query)) {
            echo "['".$row['BranchNameTH']."',".$row['service1'].",".$row['service2'].",".$row['service3'].",".$row['service4']."],";
        }
            ?>
    ]);
        var options = {
            chart: {
                subtitle: 'ยอดขายสุทธิ (บาท)'
            },
            bars: 'vertical',
            vAxis: {format: 'decimal'},

            colors: ['#1b9e77', '#d95f02', '#7570b3']
        };

        var chart = new google.charts.Bar(document.getElementById('chart_div'));

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
