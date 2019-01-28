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
                    '<a href="PDF/Load-Branch-CM-Bill.php?date_start='+start+'&date_end='+end+'&keywords='+keywords+'&keywords2='+keywords2+'&session='+session+'&select_top='+select_top+'" target="_blank" rel="noopener noreferrer">'+
                    '<i class="fa fa-print"></i>'+
                    '<span>Print for PDF</span>'+
                    '</a>';
                $("#get_branch").html(html);

            }

            $("#get_date").text(start+" ถึง "+end);
            $.get( "path.txt", function( data ) {
                var resourceContent = data;
                $.ajax({
                    url: resourceContent+"/BranchCMBill.php?select_top="+select_top+
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
                        var ser1=0;
                        var ser2=0;
                        var ser3=0;
                        var ser4=0;
                        var ser5=0;
                        var ser6=0;
                        var ser7=0;
                        var count1=0;
                        var count2=0;
                        var count3=0;
                        var count4=0;
                        var count5=0;
                        var count6=0;
                        var count7=0;
                        var counts=0;
                        var promo=0;
                        var member=0;
                        var special=0;
                        var total=0;

                        if(obj != '')
                        {
                            ser1=0;
                            ser2=0;
                            ser3=0;
                            ser4=0;
                            ser5=0;
                            ser6=0;
                            ser7=0;
                            count1=0;
                            count2=0;
                            count3=0;
                            count4=0;
                            count5=0;
                            count6=0;
                            count7=0;
                            counts=0;
                            promo=0;
                            member=0;
                            special=0;
                            total=0;
                            $("#myTable_ tbody tr").remove();
                            $("#myBody_").empty();
                            $.each(obj, function(key, val) {
                                i++;
                                var tr = "<tr>";
                                tr = tr + "<td style='color: #0c1312'><center>" + i + "</center></td>";
                                tr = tr + "<td style='color: #0c1312'><center>" + val["OrderDate"] + "</center></td>";
                                /*tr = tr + "<td style='color: #0c1312'><center>" + val["OrderNo"] + "</center></td>";*/
                                tr = tr + "<td style='color: #0c1312'><center><a href=\"#myModal\" data-toggle=\"modal\" id=\"+"+val["OrderNo"]+","+val["couponCount"]+"+\"data-target=\"#edit-modal\">"+val["OrderNo"]+"</a></center></td>";
                                tr = tr + "<td style='color: #0c1312'><center>" + val["CountService1"] + "</center></td>";
                                if (isNaN(parseInt(val["SumService1"]))){
                                    tr = tr + "<td style='color: #0c1312'><center>" + parseInt(0).toLocaleString('us', {
                                        minimumFractionDigits: 2,
                                        maximumFractionDigits: 2
                                    });+"</center></td>";
                                    ser1+=0;
                                }else{
                                    tr = tr + "<td style='color: #0c1312'><center>" + parseInt(val["SumService1"]).toLocaleString('us', {
                                        minimumFractionDigits: 2,
                                        maximumFractionDigits: 2
                                    });+"</center></td>";
                                    ser1+=parseInt(val["SumService1"]);
                                }
                                tr = tr + "<td style='color: #0c1312'><center>" + val["CountService2"] + "</center></td>";
                                if (isNaN(parseInt(val["SumService2"]))){
                                    tr = tr + "<td style='color: #0c1312'><center>" + parseInt(0).toLocaleString('us', {
                                        minimumFractionDigits: 2,
                                        maximumFractionDigits: 2
                                    });+"</center></td>";
                                    ser2+=0;
                                }else{
                                    tr = tr + "<td style='color: #0c1312'><center>" + parseInt(val["SumService2"]).toLocaleString('us', {
                                        minimumFractionDigits: 2,
                                        maximumFractionDigits: 2
                                    });+"</center></td>";
                                    ser2+=parseInt(val["SumService2"]);
                                }
                                tr = tr + "<td style='color: #0c1312'><center>" + val["CountService3"] + "</center></td>";
                                if (isNaN(parseInt(val["SumService3"]))){
                                    tr = tr + "<td style='color: #0c1312'><center>" + parseInt(0).toLocaleString('us', {
                                        minimumFractionDigits: 2,
                                        maximumFractionDigits: 2
                                    });+"</center></td>";
                                    ser3+=0;
                                }else{
                                    tr = tr + "<td style='color: #0c1312'><center>" + parseInt(val["SumService3"]).toLocaleString('us', {
                                        minimumFractionDigits: 2,
                                        maximumFractionDigits: 2
                                    });+"</center></td>";
                                    ser3+=parseInt(val["SumService3"]);
                                }
                                tr = tr + "<td style='color: #0c1312'><center>" + val["CountService4"] + "</center></td>";
                                if (isNaN(parseInt(val["SumService4"]))){
                                    tr = tr + "<td style='color: #0c1312'><center>" + parseInt(0).toLocaleString('us', {
                                        minimumFractionDigits: 2,
                                        maximumFractionDigits: 2
                                    });+"</center></td>";
                                    ser4+=0;
                                }else{
                                    tr = tr + "<td style='color: #0c1312'><center>" + parseInt(val["SumService4"]).toLocaleString('us', {
                                        minimumFractionDigits: 2,
                                        maximumFractionDigits: 2
                                    });+"</center></td>";
                                    ser4+=parseInt(val["SumService4"]);
                                }
                                tr = tr + "<td style='color: #0c1312'><center>" + val["CountService5"] + "</center></td>";
                                if (isNaN(parseInt(val["SumService5"]))){
                                    tr = tr + "<td style='color: #0c1312'><center>" + parseInt(0).toLocaleString('us', {
                                        minimumFractionDigits: 2,
                                        maximumFractionDigits: 2
                                    });+"</center></td>";
                                    ser5+=0;
                                }else{
                                    tr = tr + "<td style='color: #0c1312'><center>" + parseInt(val["SumService5"]).toLocaleString('us', {
                                        minimumFractionDigits: 2,
                                        maximumFractionDigits: 2
                                    });+"</center></td>";
                                    ser5+=parseInt(val["SumService5"]);
                                }
                                tr = tr + "<td style='color: #0c1312'><center>" + val["CountService6"] + "</center></td>";
                                if (isNaN(parseInt(val["SumService6"]))){
                                    tr = tr + "<td style='color: #0c1312'><center>" + parseInt(0).toLocaleString('us', {
                                        minimumFractionDigits: 2,
                                        maximumFractionDigits: 2
                                    });+"</center></td>";
                                    ser6+=0;
                                }else{
                                    tr = tr + "<td style='color: #0c1312'><center>" + parseInt(val["SumService6"]).toLocaleString('us', {
                                        minimumFractionDigits: 2,
                                        maximumFractionDigits: 2
                                    });+"</center></td>";
                                    ser6+=parseInt(val["SumService6"]);
                                }
                                tr = tr + "<td style='color: #0c1312'><center>" + val["couponCount"] + "</center></td>";
                                if (isNaN(parseInt(val["PromoDiscount"]))){
                                    tr = tr + "<td style='color: #0c1312'><center>" + parseInt(0).toLocaleString('us', {
                                        minimumFractionDigits: 2,
                                        maximumFractionDigits: 2
                                    });+"</center></td>";
                                    promo+=0
                                }else{
                                    tr = tr + "<td style='color: #0c1312'><center>" + parseInt(val["PromoDiscount"]).toLocaleString('us', {
                                        minimumFractionDigits: 2,
                                        maximumFractionDigits: 2
                                    });+"</center></td>";
                                    promo+=parseInt(val["PromoDiscount"]);
                                }
                                if (isNaN(parseInt(val["MemberDiscount"]))){
                                    tr = tr + "<td style='color: #0c1312'><center>" + parseInt(0).toLocaleString('us', {
                                        minimumFractionDigits: 2,
                                        maximumFractionDigits: 2
                                    });+"</center></td>";
                                    member+=0
                                }else{
                                    tr = tr + "<td style='color: #0c1312'><center>" + parseInt(val["MemberDiscount"]).toLocaleString('us', {
                                        minimumFractionDigits: 2,
                                        maximumFractionDigits: 2
                                    });+"</center></td>";
                                    member+=parseInt(val["MemberDiscount"])
                                }
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
                                tr = tr + "<td style='color: #0c1312'><center>" + parseInt(val["total"]).toLocaleString('us', {
                                    minimumFractionDigits: 2,
                                    maximumFractionDigits: 2
                                }); +"</center></td>";
                                if(parseInt(val["IsPayment"])==1){
                                    tr = tr + "<td style='color: #0c1312'><font style='color: #0f0f0f'><center>" + "ชำระแล้ว" + "</center></font></td>";
                                }else{
                                    tr = tr + "<td style='color: #0c1312'><font style='color: #e50914'><center>" + "ค้างชำระ" + "</center></font></td>";
                                }

                                count1+=parseInt(val["CountService1"]);
                                count2+=parseInt(val["CountService2"]);
                                count3+=parseInt(val["CountService3"]);
                                count4+=parseInt(val["CountService4"]);
                                count5+=parseInt(val["CountService5"]);
                                count6+=parseInt(val["CountService6"]);
                                count7+=parseInt(val["CountService7"]);
                                counts+=parseInt(val["couponCount"]);
                                total+=parseInt(val["total"]);
                                tr = tr + "</tr>";
                                $('#myTable_ > tbody:last').append(tr);
                            });
                            var tr = "<tr>";
                            tr = tr + "<td colspan=\"3\" bgcolor=\"#2eb82e\" style='color: #ffffff'><center>" + "รวม" +"</center></td>";
                            tr = tr + "<td bgcolor=\"#2eb82e\" style='color: #ffffff'><center>" + count1.toLocaleString() +"</center></td>";
                            tr = tr + "<td bgcolor=\"#2eb82e\" style='color: #ffffff'><center>" + ser1.toLocaleString('us', {
                                minimumFractionDigits: 2,
                                maximumFractionDigits: 2
                            }); +"</center></td>";
                            tr = tr + "<td bgcolor=\"#2eb82e\" style='color: #ffffff'><center>" + count2.toLocaleString() +"</center></td>";
                            tr = tr + "<td bgcolor=\"#2eb82e\" style='color: #ffffff'><center>" + ser2.toLocaleString('us', {
                                minimumFractionDigits: 2,
                                maximumFractionDigits: 2
                            }); +"</center></td>";
                            tr = tr + "<td bgcolor=\"#2eb82e\" style='color: #ffffff'><center>" + count3.toLocaleString() +"</center></td>";
                            tr = tr + "<td bgcolor=\"#2eb82e\" style='color: #ffffff'><center>" + ser3.toLocaleString('us', {
                                minimumFractionDigits: 2,
                                maximumFractionDigits: 2
                            }); +"</center></td>";
                            tr = tr + "<td bgcolor=\"#2eb82e\" style='color: #ffffff'><center>" + count4.toLocaleString() +"</center></td>";
                            tr = tr + "<td bgcolor=\"#2eb82e\" style='color: #ffffff'><center>" + ser4.toLocaleString('us', {
                                minimumFractionDigits: 2,
                                maximumFractionDigits: 2
                            }); +"</center></td>";
                            tr = tr + "<td bgcolor=\"#2eb82e\" style='color: #ffffff'><center>" + count5.toLocaleString() +"</center></td>";
                            tr = tr + "<td bgcolor=\"#2eb82e\" style='color: #ffffff'><center>" + ser5.toLocaleString('us', {
                                minimumFractionDigits: 2,
                                maximumFractionDigits: 2
                            }); +"</center></td>";
                            tr = tr + "<td bgcolor=\"#2eb82e\" style='color: #ffffff'><center>" + count6.toLocaleString() +"</center></td>";
                            tr = tr + "<td bgcolor=\"#2eb82e\" style='color: #ffffff'><center>" + ser6.toLocaleString('us', {
                                minimumFractionDigits: 2,
                                maximumFractionDigits: 2
                            }); +"</center></td>";
                            tr = tr + "<td bgcolor=\"#2eb82e\" style='color: #ffffff'><center>" + parseInt(counts).toLocaleString() +"</center></td>";
                            tr = tr + "<td bgcolor=\"#2eb82e\" style='color: #ffffff'><center>" + parseInt(promo).toLocaleString('us', {
                                minimumFractionDigits: 2,
                                maximumFractionDigits: 2
                            }); +"</center></td>";
                            tr = tr + "<td bgcolor=\"#2eb82e\" style='color: #ffffff'><center>" + member.toLocaleString('us', {
                                minimumFractionDigits: 2,
                                maximumFractionDigits: 2
                            }); +"</center></td>";
                            tr = tr + "<td bgcolor=\"#2eb82e\" style='color: #ffffff'><center>" + special.toLocaleString('us', {
                                minimumFractionDigits: 2,
                                maximumFractionDigits: 2
                            }); +"</center></td>";
                            tr = tr + "<td bgcolor=\"#2eb82e\" style='color: #ffffff'><center>" + total.toLocaleString('us', {
                                minimumFractionDigits: 2,
                                maximumFractionDigits: 2
                            }); +"</center></td>";
                            tr = tr + "<td bgcolor=\"#2eb82e\" style='color: #ffffff'><center>" + "" +"</center></td>";
                            $('#myTable_ > tbody:last').append(tr);
                        }else{
                            $("#myTable_ tbody tr").remove();
                            $("#myBody_").empty();
                            $.each(obj, function(key, val) {
                                i++;
                                var tr = "<tr>";
                                tr = tr + "<td style='color: #0c1312'><center>" + i + "</center></td>";
                                tr = tr + "<td style='color: #0c1312'><center>" + val["OrderDate"] + "</center></td>";
                                tr = tr + "<td style='color: #0c1312'><center>" + val["OrderNo"] + "</center></td>";
                                tr = tr + "<td style='color: #0c1312'><center>" + val["CountService1"] + "</center></td>";
                                tr = tr + "<td bgcolor=\"#2eb82e\" style='color: #ffffff'><center>" + parseInt(val["SumService1"]).toLocaleString('us', {
                                    minimumFractionDigits: 2,
                                    maximumFractionDigits: 2
                                }); +"</center></td>";
                                tr = tr + "<td style='color: #0c1312'><center>" + val["CountService2"] + "</center></td>";
                                tr = tr + "<td bgcolor=\"#2eb82e\" style='color: #ffffff'><center>" + parseInt(val["SumService2"]).toLocaleString('us', {
                                    minimumFractionDigits: 2,
                                    maximumFractionDigits: 2
                                }); +"</center></td>";
                                tr = tr + "<td style='color: #0c1312'><center>" + val["CountService3"] + "</center></td>";
                                tr = tr + "<td bgcolor=\"#2eb82e\" style='color: #ffffff'><center>" + parseInt(val["SumService3"]).toLocaleString('us', {
                                    minimumFractionDigits: 2,
                                    maximumFractionDigits: 2
                                }); +"</center></td>";
                                tr = tr + "<td style='color: #0c1312'><center>" + val["CountService4"] + "</center></td>";
                                tr = tr + "<td bgcolor=\"#2eb82e\" style='color: #ffffff'><center>" + parseInt(val["SumService4"]).toLocaleString('us', {
                                    minimumFractionDigits: 2,
                                    maximumFractionDigits: 2
                                }); +"</center></td>";
                                tr = tr + "<td style='color: #0c1312'><center>" + val["CountService5"] + "</center></td>";
                                tr = tr + "<td bgcolor=\"#2eb82e\" style='color: #ffffff'><center>" + parseInt(val["SumService5"]).toLocaleString('us', {
                                    minimumFractionDigits: 2,
                                    maximumFractionDigits: 2
                                }); +"</center></td>";
                                tr = tr + "<td style='color: #0c1312'><center>" + val["CountService6"] + "</center></td>";
                                tr = tr + "<td bgcolor=\"#2eb82e\" style='color: #ffffff'><center>" + parseInt(val["SumService6"]).toLocaleString('us', {
                                    minimumFractionDigits: 2,
                                    maximumFractionDigits: 2
                                }); +"</center></td>";
                                tr = tr + "<td style='color: #0c1312'><center>" + val["couponCount"] + "</center></td>";
                                if (isNaN(parseInt(val["PromoDiscount"]))){
                                    tr = tr + "<td style='color: #0c1312'><center>" + parseInt(0).toLocaleString('us', {
                                        minimumFractionDigits: 2,
                                        maximumFractionDigits: 2
                                    });+"</center></td>";
                                    promo+=0
                                }else{
                                    tr = tr + "<td style='color: #0c1312'><center>" + parseInt(val["PromoDiscount"]).toLocaleString('us', {
                                        minimumFractionDigits: 2,
                                        maximumFractionDigits: 2
                                    });+"</center></td>";
                                    promo+=parseInt(val["PromoDiscount"])
                                }
                                if (isNaN(parseInt(val["MemberDiscount"]))){
                                    tr = tr + "<td style='color: #0c1312'><center>" + parseInt(0).toLocaleString('us', {
                                        minimumFractionDigits: 2,
                                        maximumFractionDigits: 2
                                    });+"</center></td>";
                                    member+=0
                                }else{
                                    tr = tr + "<td style='color: #0c1312'><center>" + parseInt(val["MemberDiscount"]).toLocaleString('us', {
                                        minimumFractionDigits: 2,
                                        maximumFractionDigits: 2
                                    });+"</center></td>";
                                    member+=parseInt(val["MemberDiscount"])
                                }
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
                                tr = tr + "<td bgcolor=\"#2eb82e\" style='color: #ffffff'><center>" + parseInt(val["total"]).toLocaleString('us', {
                                    minimumFractionDigits: 2,
                                    maximumFractionDigits: 2
                                }); +"</center></td>";
                                if(parseInt(val["IsPayment"])==1){
                                    tr = tr + "<td style='color: #0c1312'><center>" + "ชำระเงินแล้ว" + "</center></td>";
                                }else{
                                    tr = tr + "<td style='color: #0c1312'><center>" + "ค้างชำระ" + "</center></td>";
                                }

                                ser1+=parseInt(val["CountService1"]);
                                ser2+=parseInt(val["CountService2"]);
                                ser3+=parseInt(val["CountService3"]);
                                ser4+=parseInt(val["CountService4"]);
                                ser5+=parseInt(val["CountService5"]);
                                ser6+=parseInt(val["CountService6"]);
                                ser7+=parseInt(val["CountService7"]);
                                count1+=parseInt(val["SumService1"]);
                                count2+=parseInt(val["SumService2"]);
                                count3+=parseInt(val["SumService3"]);
                                count4+=parseInt(val["SumService4"]);
                                count5+=parseInt(val["SumService5"]);
                                count6+=parseInt(val["SumService6"]);
                                count7+=parseInt(val["SumService7"]);
                                counts+=parseInt(val["counts"]);
                                total+=parseInt(val["total"]);
                                tr = tr + "<td style='color: #0c1312'><center>" + val["dates"] + "</center></td>";
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
					<li><a href="Branch-CM-Bill.php" class="active"><i class="lnr lnr-chart-bars"></i> <span>9. รายงานใบรับสินค้าของร้านสาขา</span></a></li>
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
								<input type="hidden" name="keywords2" id="keywords2" value=<?php echo $_POST["keywords2"];?>>

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
							<table class="table table-bordered" id="myTable_">
								<thead>
								<tr>
									<th rowspan="3" style="vertical-align : middle;text-align:center;" bgcolor="#2b333e"><font color="white"> <center>ลำดับที่</center></font> </th>
									<th rowspan="3" style="vertical-align : middle;text-align:center;" bgcolor="#2b333e"><font color="white"> <center>วันที่</center></font> </th>
									<th rowspan="3" style="vertical-align : middle;text-align:center;" bgcolor="#2b333e"><font color="white"> <center>เลขที่บิล</center></font> </th>
									<th colspan="12" bgcolor="#2b333e"><font color="white"> <center>จำนวน (ชิ้น) / จำนวนเงิน (บาท)</center></font> </th>
									<th rowspan="3" style="vertical-align : middle;text-align:center;" bgcolor="#2b333e"><font color="white"> <center>จำนวนคูปอง</center></font> </th>
									<th colspan="3" bgcolor="#2b333e"><font color="white"> <center>จำนวนเงิน (บาท)</center></font> </th>
									<!--<th rowspan="3" style="vertical-align : middle;text-align:center;" bgcolor="#ffffff"> <center>ส่วนลดโปรโมชั่น</center> </th>
                                    <th rowspan="3" style="vertical-align : middle;text-align:center;" bgcolor="#ffffff"> <center>ส่วนลดสมาชิก</center> </th>-->
									<th rowspan="3" style="vertical-align : middle;text-align:center;" bgcolor="#2b333e"><font color="white"> <center>จำนวนเงิน</center></font> </th>
									<th rowspan="3" style="vertical-align : middle;text-align:center;" bgcolor="#2b333e"><font color="white"> <center> สถานะจ่ายเงิน</center></font> </th>
								</tr>
								<tr bgcolor="#191970">
									<th colspan="2" bgcolor="#2b333e"><font color="white"> <center>ซักแห้ง</center></font> </th>
									<th colspan="2" bgcolor="#2b333e"><font color="white"> <center>ซักน้ำ</center></font> </th>
									<th colspan="2" bgcolor="#2b333e"><font color="white"> <center>สปาเครื่องหนัง</center></font> </th>
									<th colspan="2" bgcolor="#2b333e"><font color="white"> <center>รีด</center></font> </th>
									<th colspan="2" bgcolor="#2b333e"><font color="white"> <center>คูปองเล่มซักน้ำ</center></font> </th>
									<th colspan="2" bgcolor="#2b333e"><font color="white"> <center>คูปองเล่มรีด</center></font> </th>
									<th colspan="3" style="vertical-align : middle;text-align:center;" bgcolor="#2b333e"><font color="white"> <center>ส่วนลด</center></font> </th>
								</tr>
								<tr bgcolor="#191970">
									<th style="vertical-align : middle;text-align:center;" bgcolor="#2b333e"><font color="white"> <center>ชิ้น</center></font> </th>
									<th style="vertical-align : middle;text-align:center;" bgcolor="#2b333e"><font color="white"> <center>บาท</center></font> </th>
									<th style="vertical-align : middle;text-align:center;" bgcolor="#2b333e"><font color="white"> <center>ชิ้น</center></font> </th>
									<th style="vertical-align : middle;text-align:center;" bgcolor="#2b333e"><font color="white"> <center>บาท</center></font> </th>
									<th style="vertical-align : middle;text-align:center;" bgcolor="#2b333e"><font color="white"> <center>ชิ้น</center></font> </th>
									<th style="vertical-align : middle;text-align:center;" bgcolor="#2b333e"><font color="white"> <center>บาท</center></font> </th>
									<th style="vertical-align : middle;text-align:center;" bgcolor="#2b333e"><font color="white"> <center>ชิ้น</center></font> </th>
									<th style="vertical-align : middle;text-align:center;" bgcolor="#2b333e"><font color="white"> <center>บาท</center></font> </th>
									<th style="vertical-align : middle;text-align:center;" bgcolor="#2b333e"><font color="white"> <center>ชิ้น</center></font> </th>
									<th style="vertical-align : middle;text-align:center;" bgcolor="#2b333e"><font color="white"> <center>บาท</center></font> </th>
									<th style="vertical-align : middle;text-align:center;" bgcolor="#2b333e"><font color="white"> <center>ชิ้น</center></font> </th>
									<th style="vertical-align : middle;text-align:center;" bgcolor="#2b333e"><font color="white"> <center>บาท</center></font> </th>
									<th style="vertical-align : middle;text-align:center;" bgcolor="#2b333e"><font color="white"> <center>โปรโมชั่น</center></font> </th>
									<th style="vertical-align : middle;text-align:center;" bgcolor="#2b333e"><font color="white"> <center>สมาชิก</center></font> </th>
									<th style="vertical-align : middle;text-align:center;" bgcolor="#2b333e"><font color="white"> <center>โดยร้าน</center></font> </th>
								</tr>
								</thead>
								<tbody id="myBody_">
								</tbody>
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
