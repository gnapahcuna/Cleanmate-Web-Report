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
	<title>สรุปยอดขายรวมทุกประเภท</title>
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

	<!--Chart -->
	<script src="Chart.js-2.7.2/dist/Chart.bundle.js"></script>
	<script src="Chart.js-2.7.2/samples/utils.js"></script>
	<style>
		canvas {
			-moz-user-select: none;
			-webkit-user-select: none;
			-ms-user-select: none;
		}
		.chart-container {
			width: 500px;
			margin-left: 40px;
			margin-right: 40px;
			margin-bottom: 40px;
		}
		.container {
			display: flex;
			flex-direction: row;
			flex-wrap: wrap;
			justify-content: center;
		}
		@media screen and (min-width: 800px) {
			.container div:first-child {
				max-width: 50%;
				float: left;
			}

			.container div:nth-child(2) {
				max-width: 50%;
				float: left;
			}
		}
	</style>

	<script>
        function getDataFromDb()
        {
            var select_top="";
            var start=$("#date_start").val();
            var end=$("#date_end").val();
            var keywords2=$("#keywords2").val();
            var keywords=$("#keywords").val();
            select_top=$("#select_top").val();

            //alert(start+","+end)

            $("#get_date").text(start+" ถึง "+end);
            $.get( "path.txt", function( data ) {
                var resourceContent = data;
                $.ajax({
                    url: resourceContent+"/InvoiceCMBill.php?select_top="+select_top+
                    "&date_start="+start +
                    "&date_end="+end +
                    "&keywords2="+keywords2+
                    "&keywords="+keywords,
                    type: "POST",
                    data: ''
                })
                    .success(function(result) {
                        var obj = jQuery.parseJSON(result);
                        var i=0;

                        if(obj != '')
                        {
                            $("#myTable tbody tr").remove();
                            $("#myBody").empty();
                            $.each(obj, function(key, val) {
                                i++;
                                var tr = "<tr>";
                                tr = tr + "<td style='color: #0c1312'><center>" + i + "</center></td>";
                                tr = tr + "<td style='color: #0c1312'><center>" + val["BranchTypeNameTH"] + "</center></td>";
                                tr = tr + "<td style='color: #0c1312'><center>" + val["BranchCode"] + "</center></td>";
                                tr = tr + "<td style='color: #0c1312'><center>" + val["BranchNameTH"] + "</center></td>";
                                tr = tr + "<td align=\"center\"><a href=\"PDF/Load-Invoice.php?date_start="+start+"&date_end="+end+"&branchID="+val["BranchID"]+"&branchType="+keywords+"&top="+select_top+"\" target=\"_blank\" rel=\"noopener noreferrer\"><i class=\"fa fa-print\"></i> <span>Print for PDF</span></a></td>";
                                tr = tr + "</tr>";
                                $('#myTable > tbody:last').append(tr);
                            });
                        }else{
                            $("#myTable tbody tr").remove();
                            $("#myBody").empty();
                            $.each(obj, function(key, val) {
                                i++;
                                var tr = "<tr>";
                                tr = tr + "<td style='color: #0c1312'><center>" + i + "</center></td>";
                                tr = tr + "<td style='color: #0c1312'><center>" + val["BranchTypeNameTH"] + "</center></td>";
                                tr = tr + "<td style='color: #0c1312'><center>" + val["BranchCode"] + "</center></td>";
                                tr = tr + "<td style='color: #0c1312'><center>" + val["BranchNameTH"] + "</center></td>";
                                tr = tr + "<td align=\"center\"><a href=\"PDF/Print-Invoice-Bill.php?date_start="+start+"&date_end="+end+"&branchID="+val["BranchID"]+"&branchType="+keywords+"&top="+select_top+"\" target=\"_blank\" rel=\"noopener noreferrer\"><i class=\"fa fa-print\"></i> <span>Print for PDF</span></a></td>";
                                tr = tr + "</tr>";
                                $('#myTable > tbody:last').append(tr);
                            });
                        }


                    });
            });
        }
	</script>
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
					$parts = explode(',', $_SESSION['MenuName']);
					if($_SESSION['BranchID']==1){
					$indexes=0;
					foreach ($parts as $key => $value){
					if($value=='018'){ $indexes++; ?>
					<li><a href="Summary-All-F.php" class=""><i class="lnr lnr-chart-bars"></i> <span>1. สรุปยอดขายรวมทุกประเภท</span></a></li>
					<?php }elseif($value=='019'){ $indexes++; ?>
					<li><a href="Order-All.php" class=""><i class="lnr lnr-chart-bars"></i> <span>2. รายงานข้อมูลรายละเอียดออเดอร์</span></a></li>
					<?php }elseif($value=='020'){ $indexes++; ?>
					<li><a href="Summary-All-Product-F.php" class=""><i class="lnr lnr-chart-bars"></i> <span>3. สรุปยอดขายแยกตามทุกรายการสินค้า</span></a></li>
					<?php }elseif($value=='021'){ $indexes++; ?>
					<li><a href="Summary-Canceled-F.php" class=""><i class="lnr lnr-chart-bars"></i> <span>4. สรุปยอดขายรายการยกเลิกออเดอร์<br>(ที่ร้าน, ที่โรงงาน )</span></a></li>
					<?php }elseif($value=='022'){ $indexes++; ?>
					<li><a href="Order-All-F.php" class=""><i class="lnr lnr-chart-bars"></i> <span>5. สรุปยอดรายการออเดอร์ทุกประเภท</span></a></li>
					<?php }elseif($value=='023'){ $indexes++; ?>
					<li><a href="Order-Product-Group-F.php" class=""><i class="lnr lnr-chart-bars"></i> <span>6. สรุปยอดรายการออเดอร์ประเภทกลุ่มสินค้า</span></a></li>
					<?php }elseif($value=='024'){ $indexes++; ?>
					<li><a href="Customer-Product-F.php" class=""><i class="lnr lnr-chart-bars"></i> <span>7. สรุปยอดออเดอร์ลูกค้าประจำร้าน</span></a></li>
					<?php }elseif($value=='025'){ $indexes++; ?>
					<li><a href="Customer-Service-F.php" class=""><i class="lnr lnr-chart-bars"></i> <span>8. สรุปยอดประเภทบริการลูกค้าประจำร้าน</span></a></li>
					<?php }elseif($value=='026'){ $indexes++; ?>
					<li><a href="Branch-CM-Bill.php" class=""><i class="lnr lnr-chart-bars"></i> <span>9. รายงานใบรับสินค้าของร้านสาขา</span></a></li>
					<?php }elseif($value=='027'){ $indexes++; ?>
					<li><a href="Invoice-CM-Bill.php" class="active"><i class="lnr lnr-chart-bars"></i> <span>10. รายงานใบเรียกเก็บเงิน</span></a></li>
					<?php }elseif($value=='028'){ $indexes++; ?>
					<li><a href="Material-CM.php" class=""><i class="lnr lnr-chart-bars"></i> <span>11. รายงานการสั่งซื้อวัสดุสิ้นเปลือง</span></a></li>
					<?php }
					}?>
					<?php }else{
					$indexes=0;
					foreach ($parts as $key => $value){
					if($value=='019'){ $indexes++; ?>
					<li><a href="Order-All.php" class=""><i class="lnr lnr-chart-bars"></i> <span><?php echo $indexes;?>. รายงานข้อมูลรายละเอียดออเดอร์</span></a></li>
					<?php }elseif($value=='021'){ $indexes++; ?>
					<li><a href="Summary-Canceled-F.php" class=""><i class="lnr lnr-chart-bars"></i> <span><?php echo $indexes;?>. สรุปยอดขายรายการยกเลิกออเดอร์<br>(ที่ร้าน, ที่โรงงาน )</span></a></li>
					<?php }elseif($value=='023'){ $indexes++; ?>
					<li><a href="Order-Product-Group-F.php" class=""><i class="lnr lnr-chart-bars"></i> <span>3. สรุปยอดรายการออเดอร์ประเภทกลุ่มสินค้า</span></a></li>
					<?php }elseif($value=='024'){ $indexes++; ?>
					<li><a href="Customer-Product-F.php" class=""><i class="lnr lnr-chart-bars"></i> <span>4. สรุปยอดออเดอร์ลูกค้าประจำร้าน</span></a></li>
					<?php }elseif($value=='025'){ $indexes++; ?>
					<li><a href="Customer-Service-F.php" class=""><i class="lnr lnr-chart-bars"></i> <span>5. สรุปยอดประเภทบริการลูกค้าประจำร้าน</span></a></li>
					<?php }elseif($value=='029'){ $indexes++; ?>
					<li><a href="Customer-Top.php" class=""><i class="lnr lnr-chart-bars"></i> <span>6. รายงานลูกค้าประจำร้าน Top 30</span></a></li>
					<?php }elseif($value=='030'){ $indexes++; ?>
					<li><a href="Customer-Search.php" class=""><i class="lnr lnr-chart-bars"></i> <span>7. รายงานค้นหาข้อมูลยอดขายบริการลูกค้าประจำร้าน</span></a></li>
					<?php }
					}?>
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
							<form id='myform1' method="post">
								<label>เลือกวันที่</label>
								<input type="date" name="date_start" id="date_start" class="form-control" onchange="return getDataFromDb()"  required>
								<br><label>ถึง</label><br>
								<input type="date" name="date_end" id="date_end" class="form-control" onchange="return getDataFromDb()" required>

								<input type="hidden" name="keywords" id="keywords" value="cheese" onchange="return getDataFromDb()" required>
								<input type="hidden" name="keywords2" id="keywords2" value="cheese" onchange="return getDataFromDb()">
								<br>
								<!--<label>ค้นหาประเภทร้าน</label><br>
								<select class="form-control"  name="keywords" required type="hidden">
									<option value="cheese">&#45;&#45;เลือกประเภทร้าน&#45;&#45;</option>
									<?php
									$stmt="select BranchTypeID,BranchTypeNameTH from mas_branchtype where IsActive=1";
									$query = sqlsrv_query($conn,$stmt);
									while($row = sqlsrv_fetch_array($query)){
									?>
									<option value="<?php echo $row["BranchTypeID"];?>"><?php echo $row["BranchTypeNameTH"];?></option>
									<?php } ?>
								</select>
								<br><label>ค้นหาชื่อร้าน</label><br>
								<select class="form-control"  name="keywords2" required >
									<option value="cheese">&#45;&#45;เลือกชื่อร้าน&#45;&#45;</option>
									<?php
									$stmt="select distinct ops_order.BranchID,BranchNameTH from ops_order left join mas_branch on ops_order.BranchID=mas_branch.BranchID where ops_order.IsActive=1";
									$query = sqlsrv_query($conn,$stmt);
									while($row = sqlsrv_fetch_array($query)){
									?>
									<option value="<?php echo $row["BranchID"];?>"><?php echo $row["BranchNameTH"];?></option>
									<?php } ?>
								</select>-->

								<!--<center><input type="submit" value="Search"></center>-->
							</form>
							<?php }else{ ?>
							<form action="Invoice-CM-Bill.php" method="post" onSubmit="return getDate()" >
								<label>เลือกวันที่</label>
								<input type="date" name="date_start" class="form-control" required>
								<br><label>ถึง</label><br>
								<input type="date" name="date_end" class="form-control" required>
								<br>
								<input type="hidden" name="keywords" class="form-control" value="cheese" required>
								<input type="hidden" name="keywords2" class="form-control" value="cheese" required>
								<br>
								<center><input type="submit" value="Search"></center>
								<br>
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
							<br>
						</div>
						<div class="panel-body">
							<div class="row">
								<div class="col-md-12">
									<div class="metric">
										<p><span class="title">วันที่</span>
											<span class="number" id="get_date"></span>
										<h4 align="right" id="get_branch"><h4>
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
						</div><br><br>
						<!--<div class="panel-body">
							<label>จัดอันดับ</label><br>
							<form method="post" action="Invoice-CM-Bill.php" id="frm">
								<select class="form-control" name="select_top" onchange="onSelectChange();">
									<?php if($_POST["date_start"]){?>
									<option value="">&#45;&#45;เลือกการจัดอันดับ&#45;&#45;</option>
									<option value="10">10 อันดับแรก (Top 10)</option>
									<option value="20">20 อันดับแรก (Top 20)</option>
									<option value="30">30 อันดับแรก (Top 30)</option>
									<option value="100">แสดงทั้งหมด (All)</option>
									<?php }else{?>
									<option value="">&#45;&#45;เลือกการจัดอันดับ&#45;&#45;</option>
									<?php }?>

								</select>
								<input type="hidden" name="date_start" value=<?php echo $date_start; ?>>
								<input type="hidden" name="date_end" value=<?php echo $date_end; ?>>
								<input type="hidden" name="keywords" value=<?php echo $keywords; ?>>
								<input type="hidden" name="keywords2" value=<?php echo $_POST["keywords2"];?>>

							</form>

							<br>
						</div>-->
					</div>
				</div>



				<!-- END INPUTS -->



				<!-- OVERVIEW -->



				<div class="row">
					<div class="col-md-12">
						<!--<div class="panel">
							<div class="panel-body">
								<center>
									<div style="width:75%; height:100%;"  class="table-responsive">
										<canvas id="canvas"></canvas>
									</div>
								</center>
							</div>
							<script>
                                var MONTHS = ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'];
                                var config = {
                                    type: 'line',
                                    data: {
                                        labels: [
                                        <?php
                                        while($row = sqlsrv_fetch_array($query_chart)) {
                                            echo "['".$row['BranchNameTH']."',],";
                                        }
                                        ?>
                                ],
                                datasets: [{
                                    label: 'รวมจำนวนเงิน',
                                    backgroundColor: window.chartColors.red,
                                    borderColor: window.chartColors.red,
                                    data: [
                                    <?php
                                        $arrTotalChart=array();
                                $arrPromoChart=array();
                                $arrSpecailDiscount=array();
                                $arrMember=array();
                                while($row = sqlsrv_fetch_array($query_chart1)) {
                                    array_push($arrTotalChart,$row['total']);
                                }
                                while($row1 = sqlsrv_fetch_array($query_chart2)) {
                                    array_push($arrPromoChart,$row1['PromoDiscount']);
                                    array_push($arrSpecailDiscount,$row1['SpecialDiscount']);
                                    array_push($arrMember,$row1['MemberDiscount']);
                                }
                                for($i=0;$i<=sizeof($arrTotalChart);$i++){
                                    if($i==sizeof($arrTotalChart)) {
                                        echo $arrTotalChart[$i]-$arrPromoChart[$i]-$arrMember[$i];
                                    }else{
                                        echo  $arrTotalChart[$i]-$arrPromoChart[$i]-$arrMember[$i].',';
                                    }
                                }
                                    ?>
                                ],
                                fill: false,
                                }, {
                                    label: 'รวมจำนวนเงินสุทธิ',
                                        fill: false,
                                        backgroundColor: window.chartColors.blue,
                                        borderColor: window.chartColors.blue,
                                        data: [
                                    <?php
                                        $arrTotalChart=array();
                                    $arrPromoChart=array();
                                    $arrSpecailDiscount=array();
                                    $arrMember=array();
                                    while($row = sqlsrv_fetch_array($query_chart11)) {
                                        array_push($arrTotalChart,$row['total']);
                                    }
                                    while($row1 = sqlsrv_fetch_array($query_chart22)) {
                                        array_push($arrPromoChart,$row1['PromoDiscount']);
                                        array_push($arrSpecailDiscount,$row1['SpecialDiscount']);
                                        array_push($arrMember,$row1['MemberDiscount']);
                                    }
                                    for($i=0;$i<=sizeof($arrTotalChart);$i++){
                                        if($i==sizeof($arrTotalChart)) {
                                            echo $arrTotalChart[$i]-$arrPromoChart[$i]-$arrSpecailDiscount[$i]-$arrMember[$i];
                                        }else{
                                            echo  $arrTotalChart[$i]-$arrPromoChart[$i]-$arrSpecailDiscount[$i]-$arrMember[$i].',';
                                        }
                                    }
                                        ?>
                                ],
                                }]
                                },
                                options: {
                                    responsive: true,
                                        title: {
                                        display: true,
                                            text: 'Bar Chart'
                                    },
                                    tooltips: {
                                        mode: 'index',
                                            intersect: false,
                                    },
                                    hover: {
                                        mode: 'nearest',
                                            intersect: true
                                    },
                                    scales: {
                                        xAxes: [{
                                            display: true,
                                            scaleLabel: {
                                                display: true,
                                                labelString: 'สาขา'
                                            }
                                        }],
                                            yAxes: [{
                                            display: true,
                                            scaleLabel: {
                                                display: true,
                                                labelString: 'จำนวนเงิน(บาท)'
                                            }
                                        }]
                                    }
                                }
                                };

                                window.onload = function() {
                                    var ctx = document.getElementById('canvas').getContext('2d');
                                    window.myLine = new Chart(ctx, config);
                                };

                                document.getElementById('randomizeData').addEventListener('click', function() {
                                    config.data.datasets.forEach(function(dataset) {
                                        dataset.data = dataset.data.map(function() {
                                            return randomScalingFactor();
                                        });

                                    });

                                    window.myLine.update();
                                });

                                var colorNames = Object.keys(window.chartColors);
                                document.getElementById('addDataset').addEventListener('click', function() {
                                    var colorName = colorNames[config.data.datasets.length % colorNames.length];
                                    var newColor = window.chartColors[colorName];
                                    var newDataset = {
                                        label: 'Dataset ' + config.data.datasets.length,
                                        backgroundColor: newColor,
                                        borderColor: newColor,
                                        data: [],
                                        fill: false
                                    };

                                    for (var index = 0; index < config.data.labels.length; ++index) {
                                        newDataset.data.push(randomScalingFactor());
                                    }

                                    config.data.datasets.push(newDataset);
                                    window.myLine.update();
                                });

                                document.getElementById('addData').addEventListener('click', function() {
                                    if (config.data.datasets.length > 0) {
                                        var month = MONTHS[config.data.labels.length % MONTHS.length];
                                        config.data.labels.push(month);

                                        config.data.datasets.forEach(function(dataset) {
                                            dataset.data.push(randomScalingFactor());
                                        });

                                        window.myLine.update();
                                    }
                                });

                                document.getElementById('removeDataset').addEventListener('click', function() {
                                    config.data.datasets.splice(0, 1);
                                    window.myLine.update();
                                });

                                document.getElementById('removeData').addEventListener('click', function() {
                                    config.data.labels.splice(-1, 1); // remove the label first

                                    config.data.datasets.forEach(function(dataset) {
                                        dataset.data.pop();
                                    });

                                    window.myLine.update();
                                });
							</script>
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
							<table class="table table-bordered" id="myTable">
								<thead>
								<tr>
									<th bgcolor="#2b333e"><font color="white"> <center>ลำดับที่</center></font> </th>
									<th bgcolor="#2b333e"><font color="white"> <center>ประเภทร้าน</center></font> </th>
									<th bgcolor="#2b333e"><font color="white"> <center>รหัสร้าน</center></font> </th>
									<th bgcolor="#2b333e"><font color="white"> <center>ชือร้าน</center></font> </th>
									<th bgcolor="#2b333e"><font color="white"> <center>พิมพ์ใบเรียกเก็บเงิน</center></font> </th>
								</tr>
								</thead>
								<tbody id="myBody">
								</tbody>
							</table>
						</div>
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
            ['ชื่อร้านค้า', 'จำนวนเงินสุทธิ',],
        <?php
        while($row = sqlsrv_fetch_array($query)) {
            echo "['".$row['BranchNameTH']."',".$row['total']."],";
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
