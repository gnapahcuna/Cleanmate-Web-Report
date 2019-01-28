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
	<title>รายงานข้อมูลรายละเอียดออเดอร์</title>
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

	<script data-require="jquery@*" data-semver="2.0.3" src="http://code.jquery.com/jquery-2.0.3.min.js"></script>
	<script data-require="bootstrap@*" data-semver="3.1.1" src="//netdna.bootstrapcdn.com/bootstrap/3.1.1/js/bootstrap.min.js"></script>

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
            //alert(session)
			/*var keys="",keys2="";
			if(keywords!=""){
                keys='cheese';
            }else{
                keys=keywords;
            }
            if(keywords!=""){
                keys2='cheese';
            }else{
                keys2=keywords;
            }
            alert(keywords+","+keywords2)*/


            if(end!=''){
				var html=''+
						'<a href="PDF/Load-Order-All.php?date_start='+start+'&date_end='+end+'&keywords='+keywords+'&keywords2='+keywords2+'&session='+session+'&select_top='+select_top+'" target="_blank" rel="noopener noreferrer">'+
							'<i class="fa fa-print"></i>'+
							'<span>Print for PDF</span>'+
						'</a>';
                $("#get_branch").html(html);

            }
            //alert(start+","+end)

            $("#get_date").text(start+" ถึง "+end);
            $.get( "path.txt", function( data ) {
                var resourceContent = data;
                $.ajax({
                    url: resourceContent+"/OrderAll.php?select_top="+select_top+
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

                        var ser1=0;
                        var ser2=0;
                        var ser3=0;
                        var ser4=0;
                        var ser5=0;
                        var ser6=0;
                        var ser7=0;
                        var counts_=0;

                        if(obj != '')
                        {
                            total=0;
                            total2=0;
                            ser1=0;
                            ser2=0;
                            ser3=0;
                            ser4=0;
                            ser5=0;
                            ser6=0;
                            ser7=0;
                            counts_=0;
                            $("#myTable_ tbody tr").remove();
                            $("#myBody_").empty();
                            $.each(obj, function(key, val) {
                                i++;
                                var tr = "<tr>";
                                tr = tr + "<td style='color: #0c1312'><center>" + i + "</center></td>";
                               /* tr = tr + "<td style='color: #0c1312'><center>" + val["BranchType"] + "</center></td>";*/
                                tr = tr + "<td style='color: #0c1312'><center>" + val["BranchNameTH"] + "</center></td>";
                                tr = tr + "<td style='color: #0c1312'><center>" + val["OrderDate"] + "</center></td>";
                                tr = tr + "<td style='color: #0c1312'><center><a href=\"#myModal\" data-toggle=\"modal\" id=\"+"+val["OrderNo"]+","+val["couponCount"]+"+\"data-target=\"#edit-modal\">"+val["OrderNo"]+"</a></center></td>";
                                tr = tr + "<td style='color: #0c1312'><center>" + val["service1"] + "</center></td>";
                                tr = tr + "<td style='color: #0c1312'><center>" + val["service2"] + "</center></td>";
                                tr = tr + "<td style='color: #0c1312'><center>" + val["service3"] + "</center></td>";
                                tr = tr + "<td style='color: #0c1312'><center>" + val["service4"] + "</center></td>";
                                tr = tr + "<td style='color: #0c1312'><center>" + val["service5"] + "</center></td>";
                                tr = tr + "<td style='color: #0c1312'><center>" + val["service6"] + "</center></td>";
                                tr = tr + "<td style='color: #0c1312'><center>" + val["service7"] + "</center></td>";
                                tr = tr + "<td style='color: #0c1312'><center>" + val["counts"] + "</center></td>";

                                if (isNaN(parseInt(val["SpecialDiscount"]))){
                                    tr = tr + "<td style='color: #0c1312'><center>" + parseInt(0).toLocaleString('us', {
                                        minimumFractionDigits: 2,
                                        maximumFractionDigits: 2
                                    });+"</center></td>";
                                    total2+=0
                                }else{
                                    tr = tr + "<td style='color: #0c1312'><center>" + parseInt(val["SpecialDiscount"]).toLocaleString('us', {
                                        minimumFractionDigits: 2,
                                        maximumFractionDigits: 2
                                    });+"</center></td>";
                                    total2+=parseInt(val["SpecialDiscount"])
                                }
                                total+=parseInt(val["Total"])
                                ser1+=parseInt(val["service1"]);
                                ser2+=parseInt(val["service2"]);
                                ser3+=parseInt(val["service3"]);
                                ser4+=parseInt(val["service4"]);
                                ser5+=parseInt(val["service5"]);
                                ser6+=parseInt(val["service6"]);
                                ser7+=parseInt(val["service7"]);
                                counts_+=parseInt(val["counts"]);

                                tr = tr + "<td style='color: #0c1312'><center>" + parseInt(val["Total"]).toLocaleString('us', {
                                    minimumFractionDigits: 2,
                                    maximumFractionDigits: 2
                                }); +"</center></td>";
                                if(parseInt(val["IsPayment"])==1){
                                    tr = tr + "<td style='color: #0c1312'><font style='color: #0f0f0f'><center>" + "ชำระแล้ว" + "</center></font></td>";
                                }else{
                                    tr = tr + "<td style='color: #0c1312'><font style='color: #e50914'><center>" + "ค้างชำระ" + "</center></font></td>";
                                }

                                tr = tr + "</tr>";
                                $('#myTable_ > tbody:last').append(tr);
                            });
                            var tr = "<tr>";
                            tr = tr + "<td colspan=\"5\" bgcolor=\"#2eb82e\" style='color: #ffffff'><center>" + "รวม" +"</center></td>";
                            tr = tr + "<td bgcolor=\"#2eb82e\" style='color: #ffffff'><center>" + ser1.toLocaleString() +"</center></td>";
                            tr = tr + "<td bgcolor=\"#2eb82e\" style='color: #ffffff'><center>" + ser2.toLocaleString() +"</center></td>";
                            tr = tr + "<td bgcolor=\"#2eb82e\" style='color: #ffffff'><center>" + ser3.toLocaleString() +"</center></td>";
                            tr = tr + "<td bgcolor=\"#2eb82e\" style='color: #ffffff'><center>" + ser4.toLocaleString() +"</center></td>";
                            tr = tr + "<td bgcolor=\"#2eb82e\" style='color: #ffffff'><center>" + ser5.toLocaleString() +"</center></td>";
                            tr = tr + "<td bgcolor=\"#2eb82e\" style='color: #ffffff'><center>" + ser6.toLocaleString() +"</center></td>";
                            tr = tr + "<td bgcolor=\"#2eb82e\" style='color: #ffffff'><center>" + ser7.toLocaleString() +"</center></td>";
                            tr = tr + "<td bgcolor=\"#2eb82e\" style='color: #ffffff'><center>" + counts_.toLocaleString() +"</center></td>";
                            tr = tr + "<td bgcolor=\"#2eb82e\" style='color: #ffffff'><center>" + parseInt(total2).toLocaleString('us', {
                                minimumFractionDigits: 2,
                                maximumFractionDigits: 2
                            }); +"</center></td>";
                            tr = tr + "<td bgcolor=\"#2eb82e\" style='color: #ffffff'><center>" + parseInt(total).toLocaleString('us', {
                                minimumFractionDigits: 2,
                                maximumFractionDigits: 2
                            }); +"</center></td>";
                            tr = tr + "<td bgcolor=\"#2eb82e\" style='color: #ffffff'><center>" + "" +"</center></td>";
                            tr = tr + "</tr>";
                            $('#myTable_ > tbody:last').append(tr);
                        }else{
                            $("#myTable_ tbody tr").remove();
                            $("#myBody_").empty();
                            $.each(obj, function(key, val) {
                                i++;

                                var tr = "<tr>";
                                tr = tr + "<td style='color: #0c1312'><center>" + i + "</center></td>";
                                tr = tr + "<td style='color: #0c1312'><center>" + val["BranchType"] + "</center></td>";
                                tr = tr + "<td style='color: #0c1312'><center>" + val["BranchID"] + "</center></td>";
                                tr = tr + "<td style='color: #0c1312'><center>" + val["BranchNameTH"] + "</center></td>";
                                tr = tr + "<td style='color: #0c1312'><center>" + parseInt(val["Total"]).toLocaleString('us', {
                                    minimumFractionDigits: 2,
                                    maximumFractionDigits: 2
                                }); +"</center></td>";
                                tr = tr + "<td style='color: #0c1312'><center>" + parseInt(val["Specail"]).toLocaleString('us', {
                                    minimumFractionDigits: 2,
                                    maximumFractionDigits: 2
                                });+"</center></td>";
                                tr = tr + "<td style='color: #0c1312'><center>" + parseInt(val["Total1"]).toLocaleString('us', {
                                    minimumFractionDigits: 2,
                                    maximumFractionDigits: 2
                                }); +"</center></td>";
                                tr = tr + "</tr>";
                                $('#myTable_ > tbody:last').append(tr);
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
						<li><a href="Order-All.php" class="active"><i class="lnr lnr-chart-bars"></i> <span>2. รายงานข้อมูลรายละเอียดออเดอร์</span></a></li>
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
						<li><a href="Invoice-CM-Bill.php" class=""><i class="lnr lnr-chart-bars"></i> <span>10. รายงานใบเรียกเก็บเงิน</span></a></li>
					<?php }elseif($value=='028'){ $indexes++; ?>
						<li><a href="Material-CM.php" class=""><i class="lnr lnr-chart-bars"></i> <span>11. รายงานการสั่งซื้อวัสดุสิ้นเปลือง</span></a></li>
					<?php }
					}?>
					<?php }else{
					$indexes=0;
					foreach ($parts as $key => $value){
						if($value=='019'){ $indexes++; ?>
							<li><a href="Order-All.php" class="active"><i class="lnr lnr-chart-bars"></i> <span><?php echo $indexes;?>. รายงานข้อมูลรายละเอียดออเดอร์</span></a></li>
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
										<canvas id="canvas"></canvas>
									</div>
								</center>
							</div>
							<script>
                                var MONTHS = ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'];
                                var color = Chart.helpers.color;
                                var barChartData = {
                                    labels: [
                                    <?php
                                    while($row = sqlsrv_fetch_array($query_chart)) {
                                        echo "['".$row['OrderNo']."',],";
                                    }
                                    ?>
                                ],
                                datasets: [{
                                    label: 'รวมจำนวนเงินสุทธิ(บาท)',
                                    backgroundColor: window.chartColors.blue,
                                    borderColor: window.chartColors.blue,
                                    borderWidth: 1,
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
                                                    echo $arrTotalChart[$i]-$arrPromoChart[$i]-$arrSpecailDiscount[$i]-$arrMember[$i];
                                			    }else{
                                                    echo  $arrTotalChart[$i]-$arrPromoChart[$i]-$arrSpecailDiscount[$i]-$arrMember[$i].',';
                                			    }
                                			}
                                    ?>
                                    ]
                                }, /*{
                                    label: 'จำนวน(ชิ้น)',
                                    backgroundColor: window.chartColors.blue,
                                    borderColor: window.chartColors.blue,
                                    borderWidth: 1,
                                    data: [
										<?php
                                        	$arrCount=array();
                                    		$arrCount1=array();
                                    		while($row = sqlsrv_fetch_array($query_chart11)) {
                                        		array_push($arrCount,$row['counts']);
                                    		}
                                    		while($row1 = sqlsrv_fetch_array($query_chart22)) {
                                        		array_push($arrCount1,$row1['counts']);
                                    		}
                                    		for($i=0;$i<=sizeof($arrCount1);$i++){
                                        		if($i==sizeof($arrTotalChart)) {
                                           		 echo $arrCount[$i]-($arrCount1[$i]+$arrCount1[$i]);
                                        		}else{
                                           		 echo  $arrCount[$i]-($arrCount1[$i]+$arrCount1[$i]).',';
                                        		}
                                    		}
                                        ?>
                                ]
                                }*/]

                                };

                                window.onload = function() {
                                    var ctx = document.getElementById('canvas').getContext('2d');
                                    window.myBar = new Chart(ctx, {
                                        type: 'bar',
                                        data: barChartData,
                                        /*options: {
                                            responsive: true,
                                            legend: {
                                                position: 'top',
                                            },
                                            title: {
                                                display: true,
                                                text: 'Bar Chart'
                                            }
                                        }*/
                                        options: {
                                            title: {
                                                display: true,
                                                text: 'Bar Chart'
                                            },
                                            tooltips: {
                                                callbacks: {
                                                    label: function(t, d) {
                                                        var xLabel = d.datasets[t.datasetIndex].label;
                                                        var yLabel = t.yLabel >= 1000 ? t.yLabel.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",") : t.yLabel;
                                                        return xLabel + ': ' + yLabel;
                                                    }
                                                }
                                            },
                                            scales: {
                                                yAxes: [{
                                                    ticks: {
                                                        callback: function(value, index, values) {
                                                            if (parseInt(value) >= 1000) {
                                                                return value.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
                                                            } else {
                                                                return value;
                                                            }
                                                        }
                                                    }
                                                }]
                                            },

                                        }
                                    });

                                };

                                document.getElementById('randomizeData').addEventListener('click', function() {
                                    var zero = Math.random() < 0.2 ? true : false;
                                    barChartData.datasets.forEach(function(dataset) {
                                        dataset.data = dataset.data.map(function() {
                                            return zero ? 0.0 : randomScalingFactor();
                                        });

                                    });
                                    window.myBar.update();
                                });

                                var colorNames = Object.keys(window.chartColors);
                                document.getElementById('addDataset').addEventListener('click', function() {
                                    var colorName = colorNames[barChartData.datasets.length % colorNames.length];
                                    var dsColor = window.chartColors[colorName];
                                    var newDataset = {
                                        label: 'Dataset ' + barChartData.datasets.length,
                                        backgroundColor: color(dsColor).alpha(0.5).rgbString(),
                                        borderColor: dsColor,
                                        borderWidth: 1,
                                        data: []
                                    };

                                    for (var index = 0; index < barChartData.labels.length; ++index) {
                                        newDataset.data.push(randomScalingFactor());
                                    }

                                    barChartData.datasets.push(newDataset);
                                    window.myBar.update();
                                });

                                document.getElementById('addData').addEventListener('click', function() {
                                    if (barChartData.datasets.length > 0) {
                                        var month = MONTHS[barChartData.labels.length % MONTHS.length];
                                        barChartData.labels.push(month);

                                        for (var index = 0; index < barChartData.datasets.length; ++index) {
                                            // window.myBar.addData(randomScalingFactor(), index);
                                            barChartData.datasets[index].data.push(randomScalingFactor());
                                        }

                                        window.myBar.update();
                                    }
                                });

                                document.getElementById('removeDataset').addEventListener('click', function() {
                                    barChartData.datasets.splice(0, 1);
                                    window.myBar.update();
                                });

                                document.getElementById('removeData').addEventListener('click', function() {
                                    barChartData.labels.splice(-1, 1); // remove the label first

                                    barChartData.datasets.forEach(function(dataset) {
                                        dataset.data.pop();
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
							<table class="table table-bordered" id="myTable_">
								<thead>
								<tr>
									<th rowspan="2" style="vertical-align : middle;text-align:center;" bgcolor="#2b333e"><font color="white"> <center>ลำดับที่</center></font> </th>
									<!--<th rowspan="2" style="vertical-align : middle;text-align:center;" bgcolor="#2b333e"><font color="white"> <center>ประเภทสาขา</center></font> </th>-->
									<th rowspan="2" style="vertical-align : middle;text-align:center;" bgcolor="#2b333e"><font color="white"> <center>สาขา</center></font> </th>
									<th rowspan="2" style="vertical-align : middle;text-align:center;" bgcolor="#2b333e"><font color="white"> <center>วดป ออเดอร์</center></font> </th>
									<th rowspan="2" style="vertical-align : middle;text-align:center;" bgcolor="#2b333e"><font color="white"> <center>เลขที่ออเดอร์</center></font> </th>
									<th colspan="7" bgcolor="#2b333e"><font color="white"> <center>จำนวน (ชิ้น)</center></font> </th>
									<th rowspan="2" style="vertical-align : middle;text-align:center;"bgcolor="#2b333e"><font color="white"> <center>รวมจำนวน(ชิ้น)</center></font> </th>
									<th rowspan="2" style="vertical-align : middle;text-align:center;"bgcolor="#2b333e"><font color="white"> <center>ส่วนลดโดยร้าน</center></font> </th>
									<th rowspan="2" style="vertical-align : middle;text-align:center;"bgcolor="#2b333e"><font color="white"> <center>จำนวนเงิน</center></font> </th>
									<th rowspan="2" style="vertical-align : middle;text-align:center;"bgcolor="#2b333e"><font color="white"> <center>สถานะการชำระเงิน</center></font> </th>
								</tr>
								<tr>
									<th colspan="1"bgcolor="#2b333e"><font color="white"> <center>ซักแห้ง</center></font> </th>
									<th colspan="1"bgcolor="#2b333e"><font color="white"> <center>ซักน้ำ</center></font> </th>
									<th colspan="1"bgcolor="#2b333e"><font color="white"> <center>สปาเครื่องหนัง</center></font> </th>
									<th colspan="1"bgcolor="#2b333e"><font color="white"> <center>ซักน้ำด้วยมือ</center></font> </th>
									<th colspan="1"bgcolor="#2b333e"><font color="white"> <center>รีด</center></font> </th>
									<th colspan="1"bgcolor="#2b333e"><font color="white"> <center>คูปองเล่มซักน้ำ</center></font> </th>
									<th colspan="1"bgcolor="#2b333e"><font color="white"> <center>คูปองเล่มรีด</center></font> </th>
								</tr>
								</thead>
								<tbody id="myBody_">

								</tbody>
							</table>
						</div>
					</div>

					<!-- Modal -->
					<div id="edit-modal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
						<div class="modal-dialog">
							<div class="modal-content">
								<div class="modal-header">
									<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
									<h4 class="modal-title" id="myModalLabel">รายละเอียดบิล</h4>
								</div>

								<div class="modal-body">
									<div class="row">
										<div class="col-sm-6"align="right"><font size="3">เลขที่ใบรับฝากผ้า : </font></div>
										<div class="col-sm-4"><font size="3"><span  class="edit-content1"></span></font></div>
									</div>
									<div class="row">
										<div class="col-sm-6" align="right"><font size="3">สาขา : </font></div>
										<div class="col-sm-4"><font size="3"><span  class="edit-content2"></span></font></div>
									</div>
									<div class="row">
										<div class="col-sm-6"align="right"><font size="3">ชื่อลูกค้า : </font></div>
										<div class="col-sm-4"><font size="3"><span  class="edit-content3"></span></font></div>
									</div>
									<div class="row">
										<div class="col-sm-6"align="right"><font size="3">เบอร์ติดต่อ : </font></div>
										<div class="col-sm-4"><font size="3"><span  class="edit-content4"></span></font></div>
									</div>
									<div class="row">
										<div class="col-sm-6"align="right"><font size="3">วันที่ทำรายการ : </font></div>
										<div class="col-sm-4"><font size="3"><span  class="edit-content5"></span></font></div>
									</div>
									<div class="row">
										<div class="col-sm-6"align="right"><font size="3">วันที่นัดรับผ้า : </font></div>
										<div class="col-sm-4"><font size="3"><span  class="edit-content6"></span></font></div>
									</div>
									<br>
									<!--<li>เลขที่ใบรับฝากผ้า : <span  class="edit-content1"></span></li>
                                    <li>สาขา : <span  class="edit-content2"></span></li>
                                    <li>ชื่อลูกค้า : <span  class="edit-content3"></span></li>
                                    <li>เบอร์ติดต่อ : <span  class="edit-content4"></span></li>
                                    <li>วันที่ทำรายการ : <span  class="edit-content5"></span></li>
                                    <li>วันที่นัดรับผ้า : <span  class="edit-content6"></span></li>-->


									<div class="table-responsive">
										<table class="table table-striped" id="myTable">
											<thead>
											<tr bgcolor="#2b333e">
												<th style="color: #f1f1f1"><center>ลำดับ</center></th>
												<th style="color: #f1f1f1"><center>ชื่อสินค้า</center></th>
												<th style="color: #f1f1f1"><center>ประเภท</center></th>
												<th style="color: #f1f1f1"><center>ราคาต่อหน่วย</center></th>
												<th style="color: #f1f1f1"><center>จำนวน</center></th>
												<th style="color: #f1f1f1"><center>ราคารวม</center></th>
												<th style="color: #f1f1f1"><center>ราคาอัพเดท</center></th>
											</tr>
											</thead >
											<tbody id="myBody">
											</tbody>
										</table>
									</div><br>

									<div class="row">
										<div class="col-sm-6"align="right"><font size="3">รวมจำนวนผ้า : </font></div>
										<div class="col-sm-2"><font size="3"><span  class="edit-content13"></span></font></div>
										<div class="col-sm-1"><font size="3">ชิ้น</font></div>
									</div>
									<div class="row">
										<div class="col-sm-6"align="right"><font size="3">ราคา : </font></div>
										<div class="col-sm-2"><font size="3"><span  class="edit-content12"></span></font></div>
										<div class="col-sm-1"><font size="3">บาท</font></div>
									</div>
									<div class="row">
										<div class="col-sm-6"align="right"><font size="3">จำนวนคูปอง(รวม) : </font></div>
										<div class="col-sm-2"><font size="3"><span  class="edit-content7"></span></font></div>
										<div class="col-sm-1"><font size="3">ใบ</font></div>
									</div>
									<div class="row">
										<div class="col-sm-6" align="right"><font size="3">ส่วนลดโปรโมชั่น : </font></div>
										<div class="col-sm-2"><font size="3"><span  class="edit-content8"></span></font></div>
										<div class="col-sm-1"><font size="3">บาท</font></div>
									</div>
									<div class="row">
										<div class="col-sm-6" align="right"><font size="3">ส่วนลดคูปองเงินสด : </font></div>
										<div class="col-sm-2"><font size="3"><span  class="edit-content10"></span></font></div>
										<div class="col-sm-1"><font size="3">บาท</font></div>
									</div>
									<div class="row">
										<div class="col-sm-6" align="right"><font size="3">ส่วนลดสมาชิก : </font></div>
										<div class="col-sm-2"><font size="3"><span  class="edit-content14"></span></font></div>
										<div class="col-sm-1"><font size="3">บาท</font></div>
									</div>
									<div class="row">
										<span class="col-sm-6" align="right"><font size="4" color="red">ราคารวม : </font></span>
										<span class="col-sm-2"><font size="4" color="red"><span  class="edit-content15"></span></font></span>
										<span class="col-sm-1"><font size="4" color="red">บาท</font></span>
									</div>
									<div class="row">
										<div class="col-sm-6" align="right"><font size="3">ส่วนลดโดยร้าน : </font></div>
										<div class="col-sm-2"><font size="3"><span  class="edit-content9"></span></font></div>
										<div class="col-sm-1"><font size="3">บาท</font></div>
									</div>
									<div class="row">
										<div class="col-sm-6" align="right"><font size="3">ราคาสุทธิ : </font></div>
										<div class="col-sm-2"><font size="3"><span  class="edit-content11"></span></font></div>
										<div class="col-sm-1"><font size="3">บาท</font></div>
									</div>
									<br>

									<div class="modal-footer">
										<button type="button" class="btn btn-default" data-dismiss="modal">ปิด</button>
									</div>
								</div>
							</div>
						</div>
					</div>

					<script>
                        $('#edit-modal').on('show.bs.modal', function(e) {

                            var $modal = $(this),
                                esseyId = e.relatedTarget.id;
                            var sub =esseyId.substring(1,esseyId.length-1)
                            var res = sub.split(",");
                            //$modal.find('.edit-content13').html(res[0]+"=="+res[1]);
                            $.get( "path.txt", function( data ) {
                                var resourceContent = data;

                                $.ajax({
                                    url: resourceContent+"/getData.php?OrderNo="+res[0] ,
                                    type: "POST",
                                    data: ''
                                })
                                    .success(function(result) {
                                        var obj = jQuery.parseJSON(result);
                                        var i=0;
                                        if(obj != '') {
                                            $("#myBody").empty();
                                            var z=0;
                                            var totals=0;
                                            var couponValue=0;
                                            var SpecialDiscount=0;
                                            var PromoDiscount=0;
                                            var NetAmount=0;
                                            var amount=0;
                                            var counts=0;
                                            var MemberDiscount=0;
                                            var countCoupon=0;
                                            var totals1=0;
                                            $.each(obj, function (key, val) {
                                                /*if(val["couponValue"].indexOf(".")==0){
                                                    couponValue=0;
                                                }else{
                                                    couponValue=parseInt(val["couponValue"]);
                                                }*/
                                                if(val["SpecialDiscount"].indexOf(".")==0){
                                                    SpecialDiscount=0;
                                                } else{
                                                    SpecialDiscount=parseInt(val["SpecialDiscount"]);
                                                }
                                                if(val["PromoDiscount"].indexOf(".")==0){
                                                    PromoDiscount=0;
                                                } else{
                                                    PromoDiscount=parseInt(val["PromoDiscount"]);
                                                }
                                                /*if(val["NetAmount"].indexOf(".")==0){
                                                    NetAmount=0;
                                                } else{
                                                    NetAmount=parseInt(val["NetAmount"]);
                                                }*/


                                                if(val["MemberDiscount"].indexOf(".")==0){
                                                    MemberDiscount=0;
                                                } else{
                                                    MemberDiscount=parseInt(val["MemberDiscount"]);
                                                }
                                                amount=amount+parseInt(val["totals"]);
                                                counts=counts+parseInt(val["counts"]);

                                                if(res[1]==""){
                                                    countCoupon=0;
                                                } else{
                                                    countCoupon=res[1];
                                                }

                                                countCoupon=val["CouponCount"];

                                                z++;
                                                var tr = "<tr>";
                                                tr = tr + "<td style='color: #0c1312'><center>" + z + "</center></td>";
                                                tr = tr + "<td style='color: #0c1312'>" + val["ProductNameTH"] + "</td>";
                                                tr = tr + "<td style='color: #0c1312'><center>" + val["ServiceNameTH"] + "</center></td>";
                                                tr = tr + "<td style='color: #0c1312'><center>" + parseInt(val["Amount"]).toLocaleString('us', {minimumFractionDigits: 2, maximumFractionDigits: 2});  + "</center></td>";
                                                tr = tr + "<td style='color: #0c1312'><center>" + val["counts"] + "</center></td>";
                                                tr = tr + "<td style='color: #0c1312'><center>" + parseInt(val["totals"]).toLocaleString('us', {minimumFractionDigits: 2, maximumFractionDigits: 2});  + "</center></td>";
                                                if(!isNaN(parseInt(val["AdditionAmount"]))){
                                                    tr = tr + "<td style='color: #00aa00'><center>" +"+"+ parseInt(val["AdditionAmount"]).toLocaleString('us', {minimumFractionDigits: 2, maximumFractionDigits: 2});  + "</center></td>";
                                                    amount+= parseInt(val["AdditionAmount"]);
                                                }else if(!isNaN(parseInt(val["DiscountAmount"]))){
                                                    tr = tr + "<td style='color: #e50914'><center>" +"-"+ parseInt(val["DiscountAmount"]).toLocaleString('us', {minimumFractionDigits: 2, maximumFractionDigits: 2});  + "</center></td>";
                                                    amount-= parseInt(val["DiscountAmount"]);
                                                }else{
                                                    tr = tr + "<td style='color: #0c1312'><center>" + parseInt(0).toLocaleString('us', {minimumFractionDigits: 2, maximumFractionDigits: 2});  + "</center></td>";
                                                }
                                                tr = tr + "</tr>";
                                                $('#myTable > tbody:last').append(tr);


                                                //totals1=totals1+
                                                NetAmount=amount-PromoDiscount;
                                                totals=(NetAmount-SpecialDiscount);

                                                $modal.find('.edit-content13').html("\t\t\t"+counts);
                                                $modal.find('.edit-content12').html("\t\t\t"+amount.toLocaleString('us', {minimumFractionDigits: 2, maximumFractionDigits: 2}));
                                                $modal.find('.edit-content1').html("\t\t\t"+val["OrderNo"]);
                                                $modal.find('.edit-content2').html("\t\t\t"+val["BranchNameTH"]);
                                                $modal.find('.edit-content3').html("\t\t\t"+val["FirstName"]);
                                                $modal.find('.edit-content4').html("\t\t\t"+val["TelephoneNo"]);
                                                $modal.find('.edit-content5').html("\t\t\t"+val["OrderDate"]);
                                                $modal.find('.edit-content6').html("\t\t\t"+val["AppointmentDate"]);
                                                $modal.find('.edit-content7').html("\t\t\t"+countCoupon);
                                                $modal.find('.edit-content8').html("\t\t\t"+PromoDiscount.toLocaleString('us', {minimumFractionDigits: 2, maximumFractionDigits: 2}));
                                                $modal.find('.edit-content14').html("\t\t\t"+MemberDiscount.toLocaleString('us', {minimumFractionDigits: 2, maximumFractionDigits: 2}));
                                                $modal.find('.edit-content15').html("\t\t\t"+NetAmount.toLocaleString('us', {minimumFractionDigits: 2, maximumFractionDigits: 2}));
                                                $modal.find('.edit-content9').html("\t\t\t"+SpecialDiscount.toLocaleString('us', {minimumFractionDigits: 2, maximumFractionDigits: 2}));
                                                $modal.find('.edit-content10').html("\t\t\t"+couponValue.toLocaleString('us', {minimumFractionDigits: 2, maximumFractionDigits: 2}));
                                                $modal.find('.edit-content11').html("\t\t\t"+totals.toLocaleString('us', {minimumFractionDigits: 2, maximumFractionDigits: 2}));

                                            });

                                        }
                                    });
                            });
                        });
					</script>

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

    function getDate1() {
        alert(document.getElementById("select_top").value);
        var start = document.getElementById("select_top").value;

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
            ['ชื่อร้านค้า','จำนวนออร์เดอร์ซักแห้ง','จำนวนออร์เดอร์ซักน้ำ','จำนวนออร์เดอร์ซักน้ำด้วยมือ','จำนวนออร์เดอร์สปาเครื่องหนัง','จำนวนคูปองเล่มซักน้ำ','จำนวนคูปองเล่มรีด'],
        <?php
        while($row = sqlsrv_fetch_array($query)) {
            echo "['".$row['BranchNameTH']."',".$row['service1'].",".$row['service2'].",".$row['service3'].",".$row['service4'].",".$row['service5'].",".$row['service6']."],";
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
