<html>
<head>
    <title>Report PDF</title>
    
    <script src="../assets/vendor/jquery/jquery.min.js"></script>
    <script src="../assets/vendor/bootstrap/js/bootstrap.min.js"></script>
    <script src="../assets/vendor/jquery-slimscroll/jquery.slimscroll.min.js"></script>
    <script src="../assets/vendor/jquery.easy-pie-chart/jquery.easypiechart.min.js"></script>
    <script src="../assets/vendor/chartist/js/chartist.min.js"></script>
    <script src="../assets/scripts/klorofil-common.js"></script>

    <script>
        /*function getDataFromDb()
        {*/
            //var select_top="<?php echo $_GET['date_start'];?>";
            var start="<?php echo $_GET['date_start'];?>";
            var end="<?php echo $_GET['date_end'];?>";
            var keywords2="<?php echo $_GET['branchID'];?>";
            var keywords="<?php echo $_GET['branchType'];?>";

            //alert(start+","+end+","+keywords2+","+keywords)

            var branchData = "";
            var branchCode = "";
            var branchName = "";
            var branchType = "";
            var branchTel = "-";
            var branchAddress = "-";
            var branchContact = "-";
			var email = "-";

            //alert(start+","+end)
            $.get( "../path.txt", function( data ) {
                var resourceContent = data;
                $.ajax({
                    url: resourceContent+"/getDataBranch_.php?branchID="+keywords2,
                    type: "POST",
                    data: ''
                })
                    .success(function(result) {
                        var obj = jQuery.parseJSON(result);

                        if(obj != '')
                        {
                            $.each(obj, function(key, val) {
                                branchData=val['BranchID'];
                                branchCode=val['BranchCode'];
                                branchName=val['BranchNameTH'];
                                branchType=val['BranchTypeNameTH'];
                                branchTel=val['TelephoneNo'];
                                branchAddress=val['Address'];
                                branchContact=val['BranchContactName'];
								email=val['Email'];

                                load(branchData,branchCode,branchName,branchType,branchTel,branchAddress,branchContact,email,start,end,keywords,keywords2);
                            });
                        }
                    });
            });

        //}
        function load(branchData,branchCode,branchName,branchType,branchTel,branchAddress,branchContact,email,start,end,keywords,keywords2) {
		
            //alert(keywords2+","+start+","+end+","+keywords+","+branchCode)
            $.get( "../path.txt", function( data ) {
                var resourceContent = data;
                $.ajax({
                    url: resourceContent+"/loadInvoice.php?branchID="+keywords2+
                    "&date_start="+start +
                    "&date_end="+end +
                    "&branchType="+keywords+
                    "&branchCode="+branchCode,
                    type: "POST",
                    data: ''
                })
                    .success(function(result) {
                        var obj = jQuery.parseJSON(result);
                        if(obj != '')
                        {
                            $.each(obj, function (key, val) {
								
                                
											var str = JSON.stringify(val['resultData'])
											var str1 = JSON.stringify(val['resultData1'])
											var str2 = JSON.stringify(val['resultData2'])
											var str3 = JSON.stringify(val['resultData3'])
											var str4 = JSON.stringify(val['resultData4'])
											var data1 = branchName
											var data2 = branchCode
											var data3 = branchType
											var data4 = branchTel
											var data5 = branchAddress
											var data6 = branchContact
											var data7 = end
											var data8 = email
											
											$("#load").text("กำลังโหลดไฟล์...");
											$.post('Print-Invoice-Bill.php', { 
												resultData:str,
												resultData1:str1,
												resultData2:str2,
												resultData3:str3,
												resultData4:str4,
												branchName:data1,
												branchCode:data2,
												branchType:data3,
												branchTel:data4,
												branchAddress:data5,
												branchContact:data6,
												email:data8,
												date_end:data7
												
											}, function(result) { 
   												//alert(result); 
												
												window.location = 'MyPDF/File-Invoice.pdf';
											});
								//window.location = 'MyPDF/File-Invoice.pdf';
                            });

                        }
                    });
            });
        }

    </script>

</head>
<body>
<table align="center">
    <td align="center" valign="middle" height="500" width="1200">
        <h3 id="load"><br><br></h3>
    </td>
</table>
</body>
</html>