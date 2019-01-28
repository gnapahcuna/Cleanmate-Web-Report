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
	<title>สรุปยอดออเดอร์ลูกค้าประจำร้าน</title>
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
            var start=$( "#keywords2 option:selected" ).val();
            var start1= $( "#keywords2 option:selected" ).text();

            $('#keywords2')
                .empty()
                .append('<option selected="selected" value="cheese">--เลือกชื่อร้าน--</option>');
            $(".ct option[value='start']").remove();

            /*if(start!="cheese"){
                $('#keywords2').children('option').val(start).remove();
            }*/
            $('#keywords2').children('option').text(start1);
            $('#keywords2').children('option').val(start);


            /*if(start!=='cheese'){
                $("#get_branch").text(start1);
            }else{
                $("#get_branch").text('แสดงทั้งหมด');
            }*/
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
                            $('#keywords2').append($('<option>', {
                                value: 'cheese',
                                text : '--แสดงทั้งหมด--'
                            }));
                            $.each(obj, function(key, val) {
                                $('#keywords2').append($('<option>', {
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
            getDataBranch()
            getDataBranchType()

            var start=$("#date_start").val();
            var end=$("#date_end").val();
            var keywords2=$("#keywords2").val();
            var keywords=$("#keywords").val();
            var select_top=$("#select_top").val();

            var session="<?php echo $_SESSION['BranchID'];?>";

            if(end!=''){
                var html=''+
                    '<a href="PDF/Load-Customer-Product-F.php?date_start='+start+'&date_end='+end+'&keywords='+keywords+'&keywords2='+keywords2+'&session='+session+'&select_top='+select_top+'" target="_blank" rel="noopener noreferrer">'+
                    '<i class="fa fa-print"></i>'+
                    '<span>Print for PDF</span>'+
                    '</a>';
                $("#get_branch").html(html);

            }

            $("#get_date").text(start+" ถึง "+end);
            $.get( "path.txt", function( data ) {
                var resourceContent = data;
                $.ajax({
                    url: resourceContent+"/CustomerProductF.php?select_top="+select_top+
                    "&date_start="+start +
                    "&date_end="+end +
                    "&keywords2="+keywords2+
                    "&keywords="+keywords+
                    "&session=<?php echo $_SESSION['BranchID'];?>",
                    type: "POST",
                    data: ''
                })
                    .success(function(result) {
                        var obj = jQuery.parseJSON(result);
                        var i=0;
                        var total=0;
                        var total2=0;
                        var special=0;
                        var counts_=0;

                        if(obj != '')
                        {
                            total=0;
                            total2=0;
                            special=0;
                            counts_=0;
                            $("#myTable tbody tr").remove();
                            $("#myBody").empty();
                            $.each(obj, function(key, val) {
                                i++;
                                var tr = "<tr>";
                                tr = tr + "<td style='color: #0c1312'><center>" + i + "</center></td>";
                                tr = tr + "<td style='color: #0c1312'><center>" + val["CustomerName"] + "</center></td>";
                                tr = tr + "<td style='color: #0c1312'><center>" + val["TelephoneNo"] + "</center></td>";
                                if(parseInt(val["CustomerType"])==1){
                                    tr = tr + "<td style='color: #0c1312'><center>" + "ลูกค้าสมาชิก" + "</center></td>";
                                }else{
                                    tr = tr + "<td style='color: #0c1312'><center>" + "ลูกค้าทั่วไป" + "</center></td>";
                                }
                                tr = tr + "<td style='color: #0c1312'><center>" + val["counts"] + "</center></td>";
                                tr = tr + "<td style='color: #0c1312'><center>" + parseInt(val["total"]).toLocaleString('us', {
                                    minimumFractionDigits: 2,
                                    maximumFractionDigits: 2
                                });+"</center></td>";
                                if (isNaN(parseInt(val["SpecialDiscount"]))){
                                    tr = tr + "<td style='color: #0c1312'><center>" + parseInt(0).toLocaleString('us', {
                                        minimumFractionDigits: 2,
                                        maximumFractionDigits: 2
                                    });+"</center></td>";
                                    special+=0
                                }else{
                                    tr = tr + "<td style='color: #0c1312'><center>" + parseInt(val["SpecialDiscount"]).toLocaleString('us', {
                                        minimumFractionDigits: 2,
                                        maximumFractionDigits: 2
                                    });+"</center></td>";
                                    special+=parseInt(val["SpecialDiscount"])
                                }
                                total+=parseInt(val["total"])
                                total2+=parseInt(val["total1"])
                                counts_+=parseInt(val["counts"]);

                                tr = tr + "<td style='color: #0c1312'><center>" + parseInt(val["total1"]).toLocaleString('us', {
                                    minimumFractionDigits: 2,
                                    maximumFractionDigits: 2
                                }); +"</center></td>";
                                tr = tr + "<td style='color: #0c1312'><center>" + val["dates"] + "</center></td>";
                                tr = tr + "</tr>";
                                $('#myTable > tbody:last').append(tr);
                            });
                            var tr = "<tr>";
                            tr = tr + "<td colspan=\"4\" bgcolor=\"#2eb82e\" style='color: #ffffff'><center>" + "รวม" +"</center></td>";
                            tr = tr + "<td bgcolor=\"#2eb82e\" style='color: #ffffff'><center>" + counts_.toLocaleString() +"</center></td>";
                            tr = tr + "<td bgcolor=\"#2eb82e\" style='color: #ffffff'><center>" + parseInt(total).toLocaleString('us', {
                                minimumFractionDigits: 2,
                                maximumFractionDigits: 2
                            }); +"</center></td>";
                            tr = tr + "<td bgcolor=\"#2eb82e\" style='color: #ffffff'><center>" + parseInt(special).toLocaleString('us', {
                                minimumFractionDigits: 2,
                                maximumFractionDigits: 2
                            }); +"</center></td>";
                            tr = tr + "<td bgcolor=\"#2eb82e\" style='color: #ffffff'><center>" + parseInt(total2).toLocaleString('us', {
                                minimumFractionDigits: 2,
                                maximumFractionDigits: 2
                            }); +"</center></td>";
                            tr = tr + "<td bgcolor=\"#2eb82e\" style='color: #ffffff'><center>" + "" +"</center></td>";
                            tr = tr + "</tr>";
                            $('#myTable > tbody:last').append(tr);
                        }else{
                            $("#myTable tbody tr").remove();
                            $("#myBody").empty();
                            $.each(obj, function(key, val) {
                                i++;
                                var tr = "<tr>";
                                tr = tr + "<td style='color: #0c1312'><center>" + i + "</center></td>";
                                tr = tr + "<td style='color: #0c1312'><center>" + val["CustomerName"] + "</center></td>";
                                tr = tr + "<td style='color: #0c1312'><center>" + val["TelephoneNo"] + "</center></td>";
                                if(parseInt(val["CustomerType"])==1){
                                    tr = tr + "<td style='color: #0c1312'><center>" + "ลูกค้าสมาชิก" + "</center></td>";
                                }else{
                                    tr = tr + "<td style='color: #0c1312'><center>" + "ลูกค้าทั่วไป" + "</center></td>";
                                }
                                tr = tr + "<td style='color: #0c1312'><center>" + val["counts"] + "</center></td>";
                                tr = tr + "<td style='color: #0c1312'><center>" + parseInt(val["total"]).toLocaleString('us', {
                                    minimumFractionDigits: 2,
                                    maximumFractionDigits: 2
                                });+"</center></td>";
                                if (isNaN(parseInt(val["SpecialDiscount"]))){
                                    tr = tr + "<td style='color: #0c1312'><center>" + parseInt(0).toLocaleString('us', {
                                        minimumFractionDigits: 2,
                                        maximumFractionDigits: 2
                                    });+"</center></td>";
                                    special+=0
                                }else{
                                    tr = tr + "<td style='color: #0c1312'><center>" + parseInt(val["SpecialDiscount"]).toLocaleString('us', {
                                        minimumFractionDigits: 2,
                                        maximumFractionDigits: 2
                                    });+"</center></td>";
                                    special+=parseInt(val["SpecialDiscount"])
                                }
                                total+=parseInt(val["total"])
                                total2+=parseInt(val["total1"])
                                counts_+=parseInt(val["counts"]);

                                tr = tr + "<td style='color: #0c1312'><center>" + parseInt(val["total1"]).toLocaleString('us', {
                                    minimumFractionDigits: 2,
                                    maximumFractionDigits: 2
                                }); +"</center></td>";
                                tr = tr + "<td style='color: #0c1312'><center>" + val["dates"] + "</center></td>";
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
					<li><a href="Customer-Product-F.php" class="active"><i class="lnr lnr-chart-bars"></i> <span>7. สรุปยอดออเดอร์ลูกค้าประจำร้าน</span></a></li>
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
					<li><a href="Customer-Product-F.php" class="active"><i class="lnr lnr-chart-bars"></i> <span>4. สรุปยอดออเดอร์ลูกค้าประจำร้าน</span></a></li>
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
								<br>
								<label>ค้นหาประเภทร้าน</label><br>
								<select class="form-control"  name="keywords" id="keywords" onchange="return getDataFromDb()" required>
									<option value="cheese">--เลือกประเภทร้าน--</option>
								</select>
								<br><label>ค้นหาชื่อร้าน</label><br>
								<select class="form-control"  name="keywords2" id="keywords2" onchange="return getDataFromDb()" required>
									<option value="cheese">--เลือกชื่อร้าน--</option>
								</select>
								<br>

								<!--<center><input type="submit" value="Search"></center>-->
							</form>
							<?php }else{ ?>
							<form id='myform2' method="post">
								<label>เลือกวันที่</label>
								<input type="date" name="date_start" id="date_start" class="form-control" onchange="return getDataFromDb()" required>
								<br><label>ถึง</label><br>
								<input type="date" name="date_end" id="date_end" class="form-control" onchange="return getDataFromDb()" required>
								<br>
								<input type="hidden" name="keywords" id="keywords" class="form-control" value="cheese" onchange="return getDataFromDb()" required>
								<input type="hidden" name="keywords2" id="keywords2" class="form-control" value="cheese" onchange="return getDataFromDb()" required>
								<br>
								<!--<center><input type="submit" value="Search"></center>-->
								<!--<br><br><br>-->
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
						<?php
						if($_SESSION['BranchID']!=1){
							//
						}else{?>
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
								<input type="hidden" name="keywords2" id="keywords2" value=<?php echo $_POST["keywords2"];?>>

							</form>

							<br>
						</div>
						<?php }?>
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
										<canvas id="chart-area"></canvas>
									</div>
								</center>
							</div>
							<script>
                                var randomScalingFactor = function() {
                                    return Math.round(Math.random() * 100);
                                };

                                var config = {
                                    type: 'pie',
                                    data: {
                                        datasets: [{
                                            data: [
                                                <?php
                                                echo $totalCust1.',';
                                                echo $totalCust2.',';;
												?>
                                            ],
                                            backgroundColor: [
                                                window.chartColors.yellow,
                                                window.chartColors.green,
                                            ],
                                            label: 'Dataset 1',
                                        }],
                                        labels: [
                                            'ลูกค้าทั่วไป',
                                            'ลูกค้าสมาชิก',
                                        ]
                                    },
                                    options: {
                                        responsive: true,
                                        title: {
                                            display: true,
                                                text: 'Bar Chart'
                                        },
                                        tooltips: {
                                            callbacks: {
                                                label: function(tooltipItem, data) {
                                                    var dataset = data.datasets[tooltipItem.datasetIndex];
                                                    var total = dataset.data.reduce(function(previousValue, currentValue, currentIndex, array) {
                                                        return previousValue + currentValue;
                                                    });
                                                    var currentValue = dataset.data[tooltipItem.index];
                                                    var percentage = Math.floor(((currentValue/total) * 100)+0.5);
                                                    return (currentValue).toFixed(2).replace(/\d(?=(\d{3})+\.)/g, '$&,') +" ("+percentage + "%)";
                                                }
                                            }
                                        }
                                    }
                                };

                                window.onload = function() {
                                    var ctx = document.getElementById('chart-area').getContext('2d');
                                    window.myPie = new Chart(ctx, config);
                                };

                                document.getElementById('randomizeData').addEventListener('click', function() {
                                    config.data.datasets.forEach(function(dataset) {
                                        dataset.data = dataset.data.map(function() {
                                            return randomScalingFactor();
                                        });
                                    });

                                    window.myPie.update();
                                });

                                var colorNames = Object.keys(window.chartColors);
                                document.getElementById('addDataset').addEventListener('click', function() {
                                    var newDataset = {
                                        backgroundColor: [],
                                        data: [],
                                        label: 'New dataset ' + config.data.datasets.length,
                                    };

                                    for (var index = 0; index < config.data.labels.length; ++index) {
                                        newDataset.data.push(randomScalingFactor());

                                        var colorName = colorNames[index % colorNames.length];
                                        var newColor = window.chartColors[colorName];
                                        newDataset.backgroundColor.push(newColor);
                                    }

                                    config.data.datasets.push(newDataset);
                                    window.myPie.update();
                                });

                                document.getElementById('removeDataset').addEventListener('click', function() {
                                    config.data.datasets.splice(0, 1);
                                    window.myPie.update();
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
								<th bgcolor="#2b333e"><font color="white"> <center>ชื่อ-นามสกุล</center></font> </th>
								<th bgcolor="#2b333e"><font color="white"> <center>เบอร์มือถือ</center></font> </th>
								<th bgcolor="#2b333e"><font color="white"> <center>ประเภทลูกค้า</center></th> </th>
								<th bgcolor="#2b333e"><font color="white"> <center>จำนวนออเดอร์</center></font> </th>
								<th bgcolor="#2b333e"><font color="white"> <center>จำนวนเงิน</center></font> </th>
								<th bgcolor="#2b333e"><font color="white"> <center>ส่วนลดโดยร้าน</center></font> </th>
								<th bgcolor="#2b333e"><font color="white"> <center>จำนวนเงินสุทธิ</center></font> </th>
								<th bgcolor="#2b333e"><font color="white"> <center>ใช้บริการครั้งล่าสุด วดป</center></font> </th>
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
