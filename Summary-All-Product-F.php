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
	<title>สรุปยอดขายแยกตามทุกรายการสินค้า</title>
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

	<!--Chart-->
	<script src="Chart.js-2.7.2/dist/Chart.bundle.js"></script>
	<script src="Chart.js-2.7.2/samples/utils.js"></script>
	<style>
		canvas {
			-moz-user-select: none;
			-webkit-user-select: none;
			-ms-user-select: none;
		}
	</style>

	<script>
        function getDataBranch()
        {
            var start=$( "#keywords1 option:selected" ).val();
            var start1= $( "#keywords1 option:selected" ).text();

            $('#keywords1')
                .empty()
                .append('<option selected="selected" value="cheese">--เลือกชื่อร้าน--</option>');
            $(".ct option[value='start']").remove();

            $('#keywords1').children('option').text(start1);
            $('#keywords1').children('option').val(start);

            //$("#get_branch").text(start1);


            $.get( "path.txt", function( data ) {
                var resourceContent = data;
                $.ajax({
                    url: resourceContent+"/getDataBranch.php" ,
                    type: "POST",
                    data: ''
                })
                    .success(function(result) {
                        var obj = jQuery.parseJSON(result);
                        var i=0;
                        if(obj != '')
                        {
                            $('#keywords1').append($('<option>', {
                                value: 'cheese',
                                text : '--แสดงทั้งหมด--'
                            }));
                            $.each(obj, function(key, val) {
                                $('#keywords1').append($('<option>', {
                                    value: val["BranchID"],
                                    text : val["BranchNameTH"]
                                }));
                                //$('#keywords2').children('option[value="thevalue"]').text('New Text');
                            });
                        }else{

                        }
                    });
            });
        }
        function getDataProduct()
        {
            var start=$( "#keywords2 option:selected" ).val();
            var start1= $( "#keywords2 option:selected" ).text();

            $('#keywords2')
                .empty()
                .append('<option selected="selected" value="cheese">--เลือกชื่อร้าน--</option>');
            $(".ct option[value='start']").remove();

            $('#keywords2').children('option').text(start1);
            $('#keywords2').children('option').val(start);

            //$("#get_branch").text(start1);


            $.get( "path.txt", function( data ) {
                var resourceContent = data;
                $.ajax({
                    url: resourceContent+"/getDataProduct.php" ,
                    type: "POST",
                    data: ''
                })
                    .success(function(result) {
                        var obj = jQuery.parseJSON(result);
                        var i=0;
                        if(obj != '')
                        {
                            $('#keywords2').append($('<option>', {
                                value: 'cheese',
                                text : '--แสดงทั้งหมด--'
                            }));
                            $.each(obj, function(key, val) {
                                $('#keywords2').append($('<option>', {
                                    value: val["ProductID"],
                                    text : val["ProductNameTH"]
                                }));
                                //$('#keywords2').children('option[value="thevalue"]').text('New Text');
                            });
                        }else{

                        }
                    });
            });
        }
        function getDataBranchType()
        {
            var start=$( "#keywords option:selected" ).val();
            var start1= $( "#keywords option:selected" ).text();

            /*if(start!=='cheese'){
                $("#get_branch").text(start1);
            }else{
                $("#get_branch").text('แสดงทั้งหมด');
            }
*/
            $('#keywords')
                .empty()
                .append('<option selected="selected" value="cheese">--เลือกประเภทร้าน--</option>');
            $('#keywords').children('option').text(start1);
            $('#keywords').children('option').val(start);

            $.get( "path.txt", function( data ) {
                var resourceContent = data;
                $.ajax({
                    url: resourceContent+"/getDataBranchType.php" ,
                    type: "POST",
                    data: ''
                })
                    .success(function(result) {
                        var obj = jQuery.parseJSON(result);
                        var i=0;
                        if(obj != '')
                        {
                            $('#keywords').append($('<option>', {
                                value: 'cheese',
                                text : '--แสดงทั้งหมด--'
                            }));
                            $.each(obj, function(key, val) {
                                $('#keywords').append($('<option>', {
                                    value: val["BranchTypeID"],
                                    text : val["BranchTypeNameTH"]
                                }));
                            });
                        }else{

                        }
                    });
            });
        }
        function getDataFromDb()
        {
            getDataBranch();
            getDataBranchType();
            getDataProduct()

            var start=$("#date_start").val();
            var end=$("#date_end").val();
            var keywords=$("#keywords").val();
            var keywords1=$("#keywords1").val();
            var keywords2=$("#keywords2").val();
            var select_top=$("#select_top").val();

            var session="<?php echo $_SESSION['BranchID'];?>";

            if(end!=''){
                var html=''+
                    '<a href="PDF/Load-Summary-All-Product-F.php?date_start='+start+'&date_end='+end+'&keywords='+keywords+'&keywords1='+keywords1+'&keywords2='+keywords2+'&session='+session+'&select_top='+select_top+'" target="_blank" rel="noopener noreferrer">'+
                    '<i class="fa fa-print"></i>'+
                    '<span>Print for PDF</span>'+
                    '</a>';
                $("#get_branch").html(html);

            }

            $("#get_date").text(start+" ถึง "+end);
            $.get( "path.txt", function( data ) {
                var resourceContent = data;
                $.ajax({
                    url: resourceContent+"/SummaryAllProductF.php?select_top="+select_top+
                    "&date_start="+start +
                    "&date_end="+end +
                    "&keywords="+keywords+
                    "&keywords1="+keywords1+
                    "&keywords2="+keywords2,
                    type: "POST",
                    data: ''
                })
                    .success(function(result) {
                        var obj = jQuery.parseJSON(result);
                        var i=0;
                        var total=0;
                        var ser1=0;
                        var ser2=0;
                        var ser3=0;

                        if(obj != '')
                        {
                            total=0;
                            ser1=0;
                            ser2=0;
                            ser3=0;
                            $("#myTable tbody tr").remove();
                            $("#myBody").empty();
                            $.each(obj, function(key, val) {
                                i++;
                                var tr = "<tr>";
                                tr = tr + "<td style='color: #0c1312'><center>" + i + "</center></td>";
                                tr = tr + "<td style='color: #0c1312'><center>" + val["ProductNameTH"] + "</center></td>";
                                tr = tr + "<td style='color: #0c1312'><center>" + val["service1"].toLocaleString(); + "</center></td>";
                                tr = tr + "<td style='color: #0c1312'><center>" + val["service2"].toLocaleString(); + "</center></td>";
                                tr = tr + "<td style='color: #0c1312'><center>" + val["service3"].toLocaleString(); + "</center></td>";
                                var service=val["service1"]+val["service2"]+val["service3"];
                                tr = tr + "<td style='color: #0c1312'><center>" + service.toLocaleString(); + "</center></td>";
                                ser1+=val["service1"];
                                ser2+=val["service2"];
                                ser3+=val["service3"];
                                total+=service;
                                tr = tr + "</tr>";
                                $('#myTable > tbody:last').append(tr);
                            });
                            var tr = "<tr>";
                            tr = tr + "<td colspan=\"2\" bgcolor=\"#2eb82e\" style='color: #ffffff'><center>" + "รวม" +"</center></td>";
                            tr = tr + "<td bgcolor=\"#2eb82e\" style='color: #ffffff'><center>" + ser1.toLocaleString(); +"</center></td>";
                            tr = tr + "<td bgcolor=\"#2eb82e\" style='color: #ffffff'><center>" + ser2.toLocaleString(); +"</center></td>";
                            tr = tr + "<td bgcolor=\"#2eb82e\" style='color: #ffffff'><center>" + ser3.toLocaleString(); +"</center></td>";
                            tr = tr + "<td bgcolor=\"#2eb82e\" style='color: #ffffff'><center>" + total.toLocaleString(); +"</center></td>";
                            tr = tr + "</tr>";
                            $('#myTable > tbody:last').append(tr);
                        }else{
                            $("#myTable tbody tr").remove();
                            $("#myBody").empty();
                            $.each(obj, function(key, val) {
                                i++;
                                var tr = "<tr>";
                                tr = tr + "<td style='color: #0c1312'><center>" + i + "</center></td>";
                                tr = tr + "<td style='color: #0c1312'><center>" + val["ProductNameTH"] + "</center></td>";
                                tr = tr + "<td style='color: #0c1312'><center>" + val["service1"] + "</center></td>";
                                tr = tr + "<td style='color: #0c1312'><center>" + val["service2"] + "</center></td>";
                                tr = tr + "<td style='color: #0c1312'><center>" + val["service3"] + "</center></td>";
                                var service=val["service1"]-val["service2"]-val["service3"]
                                tr = tr + "<td style='color: #0c1312'><center>" + parseInt(service).toLocaleString('us', {
                                    minimumFractionDigits: 2,
                                    maximumFractionDigits: 2
                                });+"</center></td>";
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
					<li><a href="Summary-All-Product-F.php" class="active"><i class="lnr lnr-chart-bars"></i> <span>3. สรุปยอดขายแยกตามทุกรายการสินค้า</span></a></li>
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
					<li><a href="Invoice-CM-Bill.php" class=""><i class="lnr lnr-chart-bars"></i> <span>10. รายงานใบเรียกเก็บเงิน</span></a></li>
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
							<form method="post">

								<label>เลือกวันที่</label>
								<input type="date" name="date_start" id="date_start" class="form-control" onchange="return getDataFromDb()" required>
								<br><label>ถึง</label><br>
								<input type="date" name="date_end" id="date_end" class="form-control" onchange="return getDataFromDb()" required>
								<br>
								<label>ค้นหาประเภทร้าน</label><br>
								<select class="form-control"  name="keywords" id="keywords" onchange="return getDataFromDb()" required>
									<option value="cheese">--เลือกประเภทร้าน--</option>
								</select>
								<br><label>ค้นหาชื่อร้าน</label><br>
								<select class="form-control"  name="keywords1" id="keywords1" onchange="return getDataFromDb()" required>
									<option value="cheese">--เลือกชื่อร้าน--</option>
								</select>
								<br>
								<label>ค้นหารายการสินค้า</label><br>
								<select class="form-control"  name="keywords2" id="keywords2" onchange="return getDataFromDb()" required>
									<option value="cheese">--เลือกรายการสินค้า--</option>
								</select>
								<br>

								<!--<center><input type="submit" value="Search"></center>
                                <br>-->
							</form>
							<?php }else{ ?>
							<form method="post">
								<label>เลือกวันที่</label>
								<input type="date" name="date_start" id="date_start" class="form-control" onchange="return getDataFromDb()" required>
								<br><label>ถึง</label><br>
								<input type="date" name="date_end" id="date_end" class="form-control" onchange="return getDataFromDb()" required>
								<br>
								<input type="hidden" name="keywords" id="keywords" class="form-control" onchange="return getDataFromDb()" value="cheese" required>
								<input type="hidden" name="keywords2" id="keywords2" class="form-control" onchange="return getDataFromDb()" value="cheese" required>
								<br>
								<!--<center><input type="submit" value="Search"></center>
                                <br><br><br>-->
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
					$keywords1=$_POST["keywords1"];
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
						</div>
						<div class="panel-body">
							<label>จัดอันดับ</label><br>
							<form id="myform3">
								<select class="form-control" name="select_top" id="select_top" onchange="getDataFromDb();">
									<option value="">--เลือกการจัดอันดับ--</option>
									<option value="10">10 อันดับแรก (Top 10)</option>
									<option value="20">20 อันดับแรก (Top 20)</option>
									<option value="30">30 อันดับแรก (Top 30)</option>
									<option value="100">แสดงทั้งหมด (All)</option>
								</select>
								<input type="hidden" name="date_start" id="date_start" value=<?php echo $date_start; ?>>
								<input type="hidden" name="date_end" id="date_end" value=<?php echo $date_end; ?>>
								<input type="hidden" name="keywords" id="keywords" value=<?php echo $keywords; ?>>
								<input type="hidden" name="keywords1" id="keywords1" value=<?php echo $keywords1; ?>>
								<input type="hidden" name="keywords2" id="keywords2" value=<?php echo $keywords2; ?>>

							</form>
							<br>
						</div>
					</div>
				</div>

				<!-- END INPUTS -->
				<!-- OVERVIEW -->


				<div class="row">
					<div class="col-md-12">
						<!--<div class="panel">
                            <div class="panel-body">
                                <center>
                                    <div style="width:100%; height:100%;"  class="table-responsive">
                                        <canvas id="canvas"></canvas>
                                    </div>
                                </center>
                            </div>
                            <script>
                                var barChartData = {
                                    labels: [
                                    <?php
                                    while($row = sqlsrv_fetch_array($query_chart)) {
                                        echo "['".$row['ProductNameTH']."',],";
                                    }
                                    ?>
                                ],
                                datasets: [{
                                    label: 'คลีนเมท (Cleanmate)',
                                    backgroundColor: window.chartColors.red,
                                    yAxisID: 'y-axis-1',
                                    data: [
                                    <?php
                                    while($row = sqlsrv_fetch_array($query_chart1)) {
                                        echo "['".$row['service1']."',],";
                                    }
                                    ?>
                                ]
                                }, {
                                    label: 'แฟรนไชส์ (Franchise )',
                                        backgroundColor: window.chartColors.green,
                                        yAxisID: 'y-axis-2',
                                        data: [
                                    <?php
                                    while($row = sqlsrv_fetch_array($query_chart2)) {
                                        echo "['".$row['service2']."',],";
                                    }
                                        ?>
                                ]
                                }, {
                                    label: 'เซเว่นอีเลฟเฟ่น (7-Eleven)',
                                        backgroundColor: window.chartColors.blue,
                                        yAxisID: 'y-axis-2',
                                        data: [
                                    <?php
                                    while($row = sqlsrv_fetch_array($query_chart3)) {
                                        echo "['".$row['service3']."',],";
                                    }
                                        ?>
                                ]
                                }]

                                };
                                window.onload = function() {
                                    var ctx = document.getElementById('canvas').getContext('2d');
                                    window.myBar = new Chart(ctx, {
                                        type: 'bar',
                                        data: barChartData,
                                        options: {
                                            responsive: true,
                                            title: {
                                                display: true,
                                                text: 'Bar Chart'
                                            },
                                            tooltips: {
                                                mode: 'index',
                                                intersect: true
                                            },
                                            scales: {
                                                yAxes: [{
                                                    type: 'linear', // only linear but allow scale type registration. This allows extensions to exist solely for log scale for instance
                                                    display: true,
                                                    position: 'left',
                                                    id: 'y-axis-1',
                                                }, {
                                                    type: 'linear', // only linear but allow scale type registration. This allows extensions to exist solely for log scale for instance
                                                    display: true,
                                                    position: 'right',
                                                    id: 'y-axis-2',
                                                    gridLines: {
                                                        drawOnChartArea: false
                                                    }
                                                }],
                                            }
                                        }
                                    });
                                };

                                document.getElementById('randomizeData').addEventListener('click', function() {
                                    barChartData.datasets.forEach(function(dataset) {
                                        dataset.data = dataset.data.map(function() {
                                            return randomScalingFactor();
                                        });
                                    });
                                    window.myBar.update();
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
									<th bgcolor="#2b333e"><font color="white"> <center>รายการสินค้า</center></font> </th>
									<th bgcolor="#2b333e"><font color="white"> <center>คลีนเมท (Cleanmate)</center></font> </th>
									<th bgcolor="#2b333e"><font color="white"> <center>แฟรนไชส์ (Franchise )</center></font> </th>
									<th bgcolor="#2b333e"><font color="white"> <center>เซเว่นอีเลฟเฟ่น (7-Eleven)</center></font> </th>
									<th bgcolor="#2b333e"><font color="white"> <center>รวมจำนวนชิ้น</center></font></th> </th>
								</tr>
								</thead>
								<tbody id="myBody">
								</tbody>
							</table>
						</div>
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
            ['รายการสินค้า', 'สำนักงานใหญ่','Franchise','7-Eleven'],
        <?php
        while($row = sqlsrv_fetch_array($query)) {
            echo "['".$row['ProductNameTH']."',".$row['service1'].",".$row['service2'].",".$row['service3']."],";
        }
            ?>
    ]);
        var options = {
            hAxis: {
                title: 'จำนวนผ้า (ชิ้น)',
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
