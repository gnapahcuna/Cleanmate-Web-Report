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
	<title>รายงานใบรับสินค้าของร้านสาขา</title>
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

	<script>
        var start=$( "#keywords1 option:selected" ).val();
        var start1= $( "#keywords1 option:selected" ).text();

        $('#keywords2')
            .empty()
            .append('<option selected="selected" value="cheese">--เลือกชื่อร้าน--</option>');
        $(".ct option[value='start']").remove();

        /*if(start!="cheese"){
            $('#keywords2').children('option').val(start).remove();
        }*/
        $('#keywords1').children('option').text(start1);
        $('#keywords1').children('option').val(start);


        /*if(start!=='cheese'){
            $("#get_branch").text(start1);
        }else{
            $("#get_branch").text('แสดงทั้งหมด');
        }*/
        //$("#get_branch").text(start1);


        $.get( "path.txt", function( data ) {
            var resourceContent = data;
            $.ajax({
                url: resourceContent+"/getDataBranch1.php" ,
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
        function getDataFromDb()
        {
            var select_top=$("#select_top").val();
            var start=$("#date_start").val();
            var end=$("#date_end").val();
            var keywords1=$("#keywords1").val();

            $("#get_date").text(start+" ถึง "+end);
            $.get( "path.txt", function( data ) {
                var resourceContent = data;
                $.ajax({
                    url: resourceContent+"/getDataMain.php?key=" +select_top+
                    "&date_start=" +start+
                    "&date_end=" +end+
                    "&branchID="+keywords1 ,
                    type: "POST",
                    data: ''
                })
                    .success(function(result) {
                        var obj = jQuery.parseJSON(result);
                        var i=0;
                        if(obj != '')
                        {
                            //$("#myTableMain thead").add( '<th>Details</th>' );
                            //$("#myTableMain thead tr:not(:first-child)").remove();


                            $("#myBodyMain").empty();
                            $.each(obj, function(key, val) {
                                i++;
                                var tr = "<tr>";
                                tr = tr + "<td style='color: #0c1312'><center>" + i + "</center></td>";
                                tr = tr + "<td style='color: #0c1312'><center>" + val["BranchCode"] + "</center></td>";
                                tr = tr + "<td style='color: #0c1312'><center>" + val["BranchNameTH"] + "</center></td>";
                                tr = tr + "<td style='color: #0c1312'><center>" + val["OrderNo"] + "</center></td>";
                                if(select_top==5){
                                    $("#th5").html("ว/ด/ป ที่จัดการ");
                                    tr = tr + "<td style='color: #0c1312'><center>" + val["CheckerDate"]['date'] + "</center></td>";
                                }else if(select_top==3){
                                    $("#th5").html("ว/ด/ป ที่ได้รับของ");
                                    tr = tr + "<td style='color: #0c1312'><center>" + val["BranchEmpDate"]['date'] + "</center></td>";
                                }else if(select_top==4){
                                    $("#th5").html("ว/ด/ป ที่ยกเลิก");
                                    tr = tr + "<td style='color: #0c1312'><center>" + val["CancelDate"]['date'] + "</center></td>";
                                }else{
                                    $("#th5").html("ว/ด/ป ที่สั่ง");
                                    tr = tr + "<td style='color: #0c1312'><center>" + val["OrderSuppliesDate"]['date'] +"</center></td>";
                                }

                                if(val["IsChecker"]==1&&val['IsBranchEmp']==0){
                                    tr = tr + "<td><center><span class=\"label label-warning\">จัดการแล้ว</span></center></td>";
                                }else if(val["IsChecker"]==1&&val['IsBranchEmp']==1){
                                    tr = tr + "<td><center><span class=\"label label-success\">ร้านได้รับของแล้ว</span></center></td>";
                                }else if(val["IsActive"]==0){
                                    tr = tr + "<td><center><span class=\"label label-danger\">รายการถูกยกเลิก</span></center></td>";
                                }else{
                                    tr = tr + "<td><center><a href=\"#myModal\" data-toggle=\"modal\" id="+val["OrderNo"]+" data-target=\"#edit-modal\"><button type=\"button\" class=\"btn btn-info\"><i class=\"fa fa-plus-square\"></i> Manage</button></a></center></td>";
                                }
                                /*tr = tr + "<td>" + val["IsActive"] + "</td>";*/
                                tr = tr + "</tr>";
                                $('#myTableMain > tbody:last').append(tr);
                            });
                        }else{
                            $("#myBodyMain").empty();
                            $.each(obj, function(key, val) {
                                i++;
                                var tr = "<tr>";
                                tr = tr + "<td style='color: #0c1312'><center>" + i + "</center></td>";
                                tr = tr + "<td style='color: #0c1312'><center>" + val["BranchCode"] + "</center></td>";
                                tr = tr + "<td style='color: #0c1312'><center>" + val["BranchNameTH"] + "</center></td>";
                                tr = tr + "<td style='color: #0c1312'><center>" + val["OrderNo"] + "</center></td>";
                                tr = tr + "<td style='color: #0c1312'><center>" + val["OrderSuppliesDate"] + "</center></td>";
                                tr = tr + "<td><center><a href=\"#myModal\" data-toggle=\"modal\" id="+val["OrderNo"]+" data-target=\"#edit-modal\"><button type=\"button\" class=\"btn btn-info\"><i class=\"fa fa-plus-square\"></i> Manage</button></a></center></td>";
                                /*tr = tr + "<td>" + val["IsActive"] + "</td>";*/
                                tr = tr + "</tr>";
                                $('#myTableMain > tbody:last').append(tr);
                            });
                        }


                    });
            });
        }
        setInterval(getDataFromDb, 900);

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
					<li><a href="Invoice-CM-Bill.php" class=""><i class="lnr lnr-chart-bars"></i> <span>10. รายงานใบเรียกเก็บเงิน</span></a></li>
					<?php }elseif($value=='028'){ $indexes++; ?>
					<li><a href="Material-CM.php" class="active"><i class="lnr lnr-chart-bars"></i> <span>11. รายงานการสั่งซื้อวัสดุสิ้นเปลือง</span></a></li>
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
							<form method="post" onchange="return getDataFromDb()" >

								<label>เลือกวันที่</label>
								<input type="date" name="date_start" id="date_start" onchange="return getDataFromDb()" class="form-control" required>
								<br><label>ถึง</label><br>
								<input type="date" name="date_end" id="date_end" onchange="return getDataFromDb()" class="form-control" required>
								<br>

								<!--<label>ค้นหาประเภทร้าน</label><br>
								<select class="form-control"  name="keywords" required>
									<option value="cheese">&#45;&#45;เลือกประเภทร้าน&#45;&#45;</option>
									<?php
									$stmt="select BranchTypeID,BranchTypeNameTH from mas_branchtype where IsActive=1";
									$query = sqlsrv_query($conn,$stmt);
									while($row = sqlsrv_fetch_array($query)){
									?>
									<option value="<?php echo $row["BranchTypeID"];?>"><?php echo $row["BranchTypeNameTH"];?></option>
									<?php } ?>
								</select>
								<br>-->
								<label>ค้นหาชื่อร้าน</label><br>
								<select class="form-control"  name="keywords1" id="keywords1" required>
									<option value="cheese">--เลือกชื่อร้าน--</option>
								</select>
								<br>
								<!--<label>ค้นหารายการสินค้า</label><br>
								<select class="form-control"  name="keywords2" required>
									<option value="cheese">&#45;&#45;เลือกรายการสินค้า&#45;&#45;</option>
									<?php
									$stmt="select distinct ops_orderdetail.ProductID,mas_product.ProductNameTH +' ('+mas_productcategory.CategoryNameTH+')' as ProductNameTH
from ops_orderdetail left join mas_product on ops_orderdetail.ProductID=mas_product.ProductID
left join mas_productcategory on mas_product.CategoryID=mas_productcategory.CategoryID
where ops_orderdetail.IsCancel Is NULL OR ops_orderdetail.IsCancel=0";
									$query = sqlsrv_query($conn,$stmt);
									while($row = sqlsrv_fetch_array($query)){
									?>
									<option value="<?php echo $row["ProductID"];?>"><?php echo $row["ProductNameTH"];?></option>
									<?php } ?>
								</select>
								<br>-->

								<!--<center><input type="submit" value="Search"></center>-->
								<br>
							</form>
							<?php }else{ ?>
							<form  method="post" >
								<label>เลือกวันที่</label>
								<input type="date" name="date_start" id="date_start" class="form-control" onchange="return getDataFromDb()"  required>
								<br><label>ถึง</label><br>
								<input type="date" name="date_end" id="date_end" class="form-control" onchange="return getDataFromDb()"  required>
								<br>
								<input type="hidden" name="keywords" id="keywords" class="form-control" onchange="return getDataFromDb()"  value="cheese" required>
								<input type="hidden" name="keywords2" id="keywords2" class="form-control" onchange="return getDataFromDb()"  value="cheese" required>
								<br>
								<!--<center><input type="submit" value="Search"></center>-->
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
											<span class="number" id="get_date"><?php echo "&nbsp";?><?php echo substr($date_start,8,2);?>-<?php echo substr($date_start,5,2);?>-<?php echo substr($date_start,0,4);?>
												<?php echo "&nbsp ถึง &nbsp";?>
												<?php echo substr($date_end,8,2);?>-<?php echo substr($date_end,5,2);?>-<?php echo substr($date_end,0,4);?></span>

											<?php

												if($_POST['select_top']){
												 if($_POST['select_top']==1){?>
										<h4 align="right"><span class="label label-default">รับออเดอร์</span></h4>
										<?php }elseif($_POST['select_top']==2){?>
										<h4 align="right"><span class="label label-default">จัดการแล้ว</span></h4>
										<?php }elseif($_POST['select_top']==3){?>
										<h4 align="right"><span class="label label-default">ร้านรับของแล้ว</span></h4>
										<?php }elseif($_POST['select_top']==4){?>
										<h4 align="right"><span class="label label-default">ถูกยกเลิกแล้ว</span></h4>
										<?php }
												}
												?>
										</p>
									</div>
								</div>

							</div>
						</div>
						<div class="panel-body">
							<label>รูปแบบการแสดงผล</label><br>
							<form method="post">
								<select class="form-control" name="select_top" id="select_top" onchange="getDataFromDb();">
									<option value="">--เลือกรูปแบบการแสดงผล--</option>
									<option value="1">รับออเดอร์</option>
									<option value="5">จัดการแล้ว</option>
									<option value="3">ร้านรับของแล้ว</option>
									<option value="4">ถูกยกเลิกแล้ว</option>
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
				<!--<?php

				if($_SESSION['BranchID']==1){


					if($_POST['select_top']==10){
					if($_POST['keywords2']=='cheese'&&$_POST['keywords']=='cheese'){
				$stmt="select top 10 BranchCode,BranchNameTH,OrderNo,OrderSuppliesDate
from ops_ordersupplies left join mas_branch on ops_ordersupplies.BranchID=mas_branch.BranchID
where OrderSuppliesDate BETWEEN  '".$date_start."' AND '".$date_end."' AND ops_ordersupplies.IsActive='1'
and (IsChecker IS NULL OR IsChecker=0) and (IsBranchEmp IS NULL OR IsBranchEmp=0)";

				}else if($_POST['keywords2']!='cheese'&&$_POST['keywords']=='cheese'){
						$stmt="select top 10 BranchCode,BranchNameTH,OrderNo,OrderSuppliesDate
from ops_ordersupplies left join mas_branch on ops_ordersupplies.BranchID=mas_branch.BranchID
where OrderSuppliesDate BETWEEN  '".$date_start."' AND '".$date_end."' AND ops_ordersupplies.IsActive='1'
and (IsChecker IS NULL OR IsChecker=0) and (IsBranchEmp IS NULL OR IsBranchEmp=0)
AND mas_branch.BranchID = '".$keywords2."'";

						}
						else{
					$stmt="select top 10 BranchCode,BranchNameTH,OrderNo,OrderSuppliesDate
from ops_ordersupplies left join mas_branch on ops_ordersupplies.BranchID=mas_branch.BranchID
where OrderSuppliesDate BETWEEN  '".$date_start."' AND '".$date_end."' AND ops_ordersupplies.IsActive='1'
and (IsChecker IS NULL OR IsChecker=0) and (IsBranchEmp IS NULL OR IsBranchEmp=0)
AND mas_branch.BranchType = '".$keywords."'";
				}
				}
				else if($_POST['select_top']==20){
				if($_POST['keywords2']=='cheese'&&$_POST['keywords']=='cheese'){
				$stmt="select top 20 BranchCode,BranchNameTH,OrderNo,OrderSuppliesDate
from ops_ordersupplies left join mas_branch on ops_ordersupplies.BranchID=mas_branch.BranchID
where OrderSuppliesDate BETWEEN  '".$date_start."' AND '".$date_end."' AND ops_ordersupplies.IsActive='1'
and (IsChecker IS NULL OR IsChecker=0) and (IsBranchEmp IS NULL OR IsBranchEmp=0)";

				}else if($_POST['keywords2']!='cheese'&&$_POST['keywords']=='cheese'){
						$stmt="select top 20 BranchCode,BranchNameTH,OrderNo,OrderSuppliesDate
from ops_ordersupplies left join mas_branch on ops_ordersupplies.BranchID=mas_branch.BranchID
where OrderSuppliesDate BETWEEN  '".$date_start."' AND '".$date_end."' AND ops_ordersupplies.IsActive='1'
and (IsChecker IS NULL OR IsChecker=0) and (IsBranchEmp IS NULL OR IsBranchEmp=0)
AND mas_branch.BranchID = '".$keywords2."'";
						}
						else{
					$stmt="select top 20 BranchCode,BranchNameTH,OrderNo,OrderSuppliesDate
from ops_ordersupplies left join mas_branch on ops_ordersupplies.BranchID=mas_branch.BranchID
where OrderSuppliesDate BETWEEN  '".$date_start."' AND '".$date_end."' AND ops_ordersupplies.IsActive='1'
and (IsChecker IS NULL OR IsChecker=0) and (IsBranchEmp IS NULL OR IsBranchEmp=0)
AND mas_branch.BranchType = '".$keywords."'";
				}
				}
				else if($_POST['select_top']==30){
				if($_POST['keywords2']=='cheese'&&$_POST['keywords']=='cheese'){
				$stmt="select top 30 BranchCode,BranchNameTH,OrderNo,OrderSuppliesDate
from ops_ordersupplies left join mas_branch on ops_ordersupplies.BranchID=mas_branch.BranchID
where OrderSuppliesDate BETWEEN  '".$date_start."' AND '".$date_end."' AND ops_ordersupplies.IsActive='1'
and (IsChecker IS NULL OR IsChecker=0) and (IsBranchEmp IS NULL OR IsBranchEmp=0)";

				}else if($_POST['keywords2']!='cheese'&&$_POST['keywords']=='cheese'){
				$stmt="select top 30 BranchCode,BranchNameTH,OrderNo,OrderSuppliesDate
from ops_ordersupplies left join mas_branch on ops_ordersupplies.BranchID=mas_branch.BranchID
where OrderSuppliesDate BETWEEN  '".$date_start."' AND '".$date_end."' AND ops_ordersupplies.IsActive='1'
and (IsChecker IS NULL OR IsChecker=0) and (IsBranchEmp IS NULL OR IsBranchEmp=0)
AND mas_branch.BranchID = '".$keywords2."'";

						}
						else{
						$stmt="select top 30 BranchCode,BranchNameTH,OrderNo,OrderSuppliesDate
from ops_ordersupplies left join mas_branch on ops_ordersupplies.BranchID=mas_branch.BranchID
where OrderSuppliesDate BETWEEN  '".$date_start."' AND '".$date_end."' AND ops_ordersupplies.IsActive='1'
and (IsChecker IS NULL OR IsChecker=0) and (IsBranchEmp IS NULL OR IsBranchEmp=0)";
				}
				}
				else if($_POST['select_top']==100){
				if($_POST['keywords2']=='cheese'||$_POST['keywords']=='cheese'){
				$stmt="select BranchCode,BranchNameTH,OrderNo,OrderSuppliesDate
from ops_ordersupplies left join mas_branch on ops_ordersupplies.BranchID=mas_branch.BranchID
where OrderSuppliesDate BETWEEN  '".$date_start."' AND '".$date_end."' AND ops_ordersupplies.IsActive='1'
and (IsChecker IS NULL OR IsChecker=0) and (IsBranchEmp IS NULL OR IsBranchEmp=0)";

				}else if($_POST['keywords2']!='cheese'&&$_POST['keywords']=='cheese'){
						$stmt="select BranchCode,BranchNameTH,OrderNo,OrderSuppliesDate
from ops_ordersupplies left join mas_branch on ops_ordersupplies.BranchID=mas_branch.BranchID
where OrderSuppliesDate BETWEEN  '".$date_start."' AND '".$date_end."' AND ops_ordersupplies.IsActive='1'
and (IsChecker IS NULL OR IsChecker=0) and (IsBranchEmp IS NULL OR IsBranchEmp=0)
AND mas_branch.BranchID = '".$keywords2."'";

						}
						else{
					$stmt="select BranchCode,BranchNameTH,OrderNo,OrderSuppliesDate
from ops_ordersupplies left join mas_branch on ops_ordersupplies.BranchID=mas_branch.BranchID
where OrderSuppliesDate BETWEEN  '".$date_start."' AND '".$date_end."' AND ops_ordersupplies.IsActive='1'
and (IsChecker IS NULL OR IsChecker=0) and (IsBranchEmp IS NULL OR IsBranchEmp=0)
AND mas_branch.BranchType = '".$keywords."'";

				}
				}
				else{
				if($_POST['keywords2']=='cheese'||$_POST['keywords']=='cheese'){
				$stmt="select BranchCode,BranchNameTH,ops_ordersupplies.OrderNo,CONVERT(varchar,OrderSuppliesDate) as OrderSuppliesDate
from ops_ordersupplies left join mas_branch on ops_ordersupplies.BranchID=mas_branch.BranchID
where OrderSuppliesDate BETWEEN  '".$date_start."' AND '".$date_end."' AND ops_ordersupplies.IsActive='1'
and (IsChecker IS NULL OR IsChecker=0) and (IsBranchEmp IS NULL OR IsBranchEmp=0)";

				}else if($_POST['keywords2']!='cheese'&&$_POST['keywords']=='cheese'){
						$stmt="select BranchCode,BranchNameTH,OrderNo,CONVERT(varchar,OrderSuppliesDate) as OrderSuppliesDate
from ops_ordersupplies left join mas_branch on ops_ordersupplies.BranchID=mas_branch.BranchID
where OrderSuppliesDate BETWEEN  '".$date_start."' AND '".$date_end."' AND ops_ordersupplies.IsActive='1'
and (IsChecker IS NULL OR IsChecker=0) and (IsBranchEmp IS NULL OR IsBranchEmp=0)
AND mas_branch.BranchID = '".$keywords2."'";

						}
						else{
					$stmt="select BranchCode,BranchNameTH,OrderNo,CONVERT(varchar,OrderSuppliesDate) as OrderSuppliesDate
from ops_ordersupplies left join mas_branch on ops_ordersupplies.BranchID=mas_branch.BranchID
where OrderSuppliesDate BETWEEN  '".$date_start."' AND '".$date_end."' AND ops_ordersupplies.IsActive='1'
and (IsChecker IS NULL OR IsChecker=0) and (IsBranchEmp IS NULL OR IsBranchEmp=0)
AND mas_branch.BranchType = '".$keywords."'";

				}
				}

				}


					$query = sqlsrv_query($conn,$stmt);


				?>-->


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
						<!--<div class="row">
							<ul class="nav navbar-nav navbar-right">
								<li class="dropdown">
									<a href="#" class="dropdown-toggle icon-menu" data-toggle="dropdown">
										<i class="lnr lnr-alarm"></i>
										<span class="badge bg-danger" id="Badge" ></span>
									</a>
									&lt;!&ndash;<ul class="dropdown-menu notifications">
										<li><a href="#" class="notification-item"><span class="dot bg-warning"></span>System space is almost full</a></li>
										<li><a href="#" class="notification-item"><span class="dot bg-danger"></span>You have 9 unfinished tasks</a></li>
										<li><a href="#" class="notification-item"><span class="dot bg-success"></span>Monthly report is available</a></li>
										<li><a href="#" class="notification-item"><span class="dot bg-warning"></span>Weekly meeting in 1 hour</a></li>
										<li><a href="#" class="notification-item"><span class="dot bg-success"></span>Your request has been approved</a></li>
										<li><a href="#" class="more">See all notifications</a></li>
									</ul>&ndash;&gt;
								</li>
							</ul>
						</div>-->
						<h3 class="panel-title">ตารางข้อมูล</h3>
					</div>
					<div class="panel-body">
						<div class="table-responsive">
							<table class="table table-striped" id="myTableMain">
								<thead>
								<tr bgcolor="red">
									<th style="vertical-align : middle;text-align:center;" bgcolor="#2b333e"><text1><font color="white" id="th1"> <center>ลำดับที่</center></font></text1> </th>
									<th style="vertical-align : middle;text-align:center;" bgcolor="#2b333e"><text1><font color="white" id="th2"> <center>รหัสสาขา</center></font></text1> </th>
									<th style="vertical-align : middle;text-align:center;" bgcolor="#2b333e"><text1><font color="white" id="th3"> <center>ชื่อสาขา</center></font></text1> </th>
									<th style="vertical-align : middle;text-align:center;" bgcolor="#2b333e"><text1><font color="white" id="th4"> <center>เลขที่บิล</center></font></text1> </th>
									<th style="vertical-align : middle;text-align:center;" bgcolor="#2b333e"><text1><font color="white" id="th5"> <center>ว/ด/ป ที่สั่ง</center></font></text1> </th>
									<th style="vertical-align : middle;text-align:center;" bgcolor="#2b333e"><text1><font color="white" id="th6"> <center>จัดการ</center></font></text1> </th>
								</tr>
								</thead>
								<tbody id="myBodyMain">
							</table>
						</div>
					</div>

					<!-- END RECENT PURCHASES -->
					<!-- Modal -->
					<div id="edit-modal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
						<div class="modal-dialog">
							<div class="modal-content">
								<div class="modal-header">
									<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
									<h4 class="modal-title" id="myModalLabel">ข้อมูลการสั่งวัสดุ</h4>
								</div>

								<div class="modal-body">
									<div class="row">
										<div class="col-sm-6"align="right"><font size="3">เลขที่บิล : </font></div>
										<div class="col-sm-4"><font size="3"><span  class="edit-content1"></span></font></div>
									</div>
									<div class="row">
										<div class="col-sm-6" align="right"><font size="3">สาขา : </font></div>
										<div class="col-sm-6"><font size="3"><span  class="edit-content2"></span></font></div>
									</div>
									<div class="row">
										<div class="col-sm-6"align="right"><font size="3">วันที่สั่ง : </font></div>
										<div class="col-sm-4"><font size="3"><span  class="edit-content3"></span></font></div>
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
												<th style="color: #f1f1f1"><center>ราคาต่อหน่วย</center></th>
												<th style="color: #f1f1f1"><center>จำนวน</center></th>
												<th style="color: #f1f1f1"><center>ราคารวม</center></th>
											</tr>
											</thead >
											<tbody id="myBody">
											</tbody>
										</table>
									</div><br>
									<div class="row">
										<div class="col-sm-6"align="right"><font size="3">รวมจำนวนสินค้า : </font></div>
										<div class="col-sm-2"><font size="3"><span  class="edit-content4"></span></font></div>
										<div class="col-sm-1"><font size="3">ชิ้น</font></div>
									</div>
									<div class="row">
										<div class="col-sm-6"align="right"><font size="3">ราคารวม : </font></div>
										<div class="col-sm-2"><font size="3"><span  class="edit-content5"></span></font></div>
										<div class="col-sm-1"><font size="3">บาท</font></div>
									</div><br>
									<div class="row">
										<div class="col-sm-6"align="right">
											<font size="3">
												<button id="btnCan" type="button" class="btn btn-danger" data-dismiss="modal"><i class="fa fa-trash-o"></i> ยกเลิก</button>
												<!--<button type="button" class="btn btn-danger"><i class="fa fa-trash-o"></i> ยกเลิก</button>-->
											</font>
										</div>
										<div class="col-sm-6"align="left">
											<font size="3">
												<button id="btnSave" type="button" class="btn btn-primary" data-dismiss="modal"><i class="fa fa-check-circle"></i> ตอบรับ</button>
												<!--<a href="#"><button type="button" class="btn btn-success"><i class="fa fa-check-circle"></i> ตอบรับ</button></a>-->
											</font>
										</div>
									</div><br>
									<!--<div class="row">
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
										<div class="col-sm-6" align="right"><font size="3">ส่วนลดพิเศษ : </font></div>
										<div class="col-sm-2"><font size="3"><span  class="edit-content9"></span></font></div>
										<div class="col-sm-1"><font size="3">บาท</font></div>
									</div>
									<div class="row">
										<div class="col-sm-6" align="right"><font size="3">ราคาสุทธิ : </font></div>
										<div class="col-sm-2"><font size="3"><span  class="edit-content11"></span></font></div>
										<div class="col-sm-1"><font size="3">บาท</font></div>
									</div>
									<br>-->

									<div class="modal-footer">
										<button type="button" class="btn btn-default" data-dismiss="modal">ปิด</button>
									</div>
								</div>
							</div>
						</div>
					</div>
					<script>
                        var ORDERNO=0;
                        $('#edit-modal').on('show.bs.modal', function(e) {


                            var $modal = $(this),
                                esseyId = e.relatedTarget.id;
                            //$modal.find('.edit-content').html(esseyId);
                            ORDERNO=esseyId;

                            $('.btn btn-danger').click();
                            $.get( "path.txt", function( data ) {
                                var resourceContent = data;

                                $.ajax({
                                    url: resourceContent+"/getDataSupplies.php?OrderNo="+esseyId,
                                    type: "POST",
                                    data: ''
                                })
                                    .success(function(result) {
                                        var obj = jQuery.parseJSON(result);
                                        var i=0;
                                        if(obj != '') {
                                            $("#myBody").empty();
                                            var totals=0;
                                            var counts=0;
                                            $.each(obj, function (key, val) {

                                                $modal.find('.edit-content1').html("\t\t\t" + val["OrderNo"]);
                                                $modal.find('.edit-content2').html("\t\t\t" + val["BranchNameTH"]);
                                                $modal.find('.edit-content3').html("\t\t\t" + val["OrderSuppliesDate"]);

                                                $.each(val["Data"], function (key, val) {
                                                    i++;
                                                    counts+=val["counts"];
                                                    totals+=parseInt(val["totals"]);
                                                    var tr = "<tr>";
                                                    tr = tr + "<td style='color: #0c1312'><center>" + i + "</center></td>";
                                                    tr = tr + "<td style='color: #0c1312'>" + val["SuppliesNameTH"] + "</td>";
                                                    tr = tr + "<td style='color: #0c1312'><center>" + parseInt(val["Price"]).toLocaleString('us', {
                                                        minimumFractionDigits: 2,
                                                        maximumFractionDigits: 2
                                                    });
                                                    +"</center></td>";
                                                    tr = tr + "<td style='color: #0c1312'><center>" + val["counts"] + "</center></td>";
                                                    tr = tr + "<td style='color: #0c1312'><center>" + parseInt(val["totals"]).toLocaleString('us', {
                                                        minimumFractionDigits: 2,
                                                        maximumFractionDigits: 2
                                                    });
                                                    +"</center></td>";
                                                    tr = tr + "</tr>";
                                                    $('#myTable > tbody:last').append(tr);

                                                });
                                            });
                                            $modal.find('.edit-content4').html("\t\t\t"+counts);
                                            $modal.find('.edit-content5').html("\t\t\t"+parseInt(totals).toLocaleString('us', {
                                                minimumFractionDigits: 2,
                                                maximumFractionDigits: 2
                                            }));

                                        }
                                    });
                            });
                        });

                        $(function () {
                            $('#btnCan').on('click', function (event) {
                                $('#edit-modal').on('show.bs.modal', function(e) {
                                    var $modal = $(this),
                                        esseyId = e.relatedTarget.id;
                                    ORDERNO=esseyId;
                                });
                                var answer = confirm("ต้องการยกเลิกรายการใช่หรือไม่?");
                                if (answer) {

                                    $.get( "path.txt", function( data ) {
                                        var resourceContent = data;
                                        $.ajax({
                                            url: resourceContent+"/IsCancel.php?OrderNo="+ORDERNO,
                                            type: "POST",
                                            data: ''
                                        })
                                            .success(function(result) {
                                                var obj = jQuery.parseJSON(result);
                                                var i=0;
                                                if(obj != '') {

                                                }
                                            });
                                        var ok  = alert("ทำรายการสำเร็จ.");
                                        if(ok){
                                            $('#edit-modal').modal('hide');
                                        }
                                    });
                                }
                                else {

                                }
                                event.preventDefault();
                            });
                            var $modal=null;
                            $('#btnSave').on('click', function (event) {
                                $('#edit-modal').on('show.bs.modal', function(e) {
                                    $modal = $(this),
                                        esseyId = e.relatedTarget.id;
                                    ORDERNO=esseyId;
                                });
                                var answer = confirm("ยืนยันการทำรายการใช่หรือไม่?");
                                if (answer) {

                                    $.get( "path.txt", function( data ) {
                                        var resourceContent = data;

                                        $.ajax({
                                            url: resourceContent+"/IsChecker.php?OrderNo="+ORDERNO,
                                            type: "POST",
                                            data: ''
                                        })
                                            .success(function(result) {
                                                var obj = jQuery.parseJSON(result);
                                                var i=0;
                                                if(obj != '') {

                                                }
                                            });
                                        alert("ทำรายการสำเร็จ.");
                                        $modal.modal('toggle');
                                    });
                                }
                                else {

                                }
                                event.preventDefault();
                            });

                        });

					</script>
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
