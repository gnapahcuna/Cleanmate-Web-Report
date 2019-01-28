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
             var start="<?php echo $_GET['date_start'];?>";
            var end="<?php echo $_GET['date_end'];?>";
            var keywords2="<?php echo $_GET['keywords2'];?>";
            var keywords="<?php echo $_GET['keywords'];?>";
			var select_top="<?php echo $_GET['select_top'];?>";
			var key="";
			var b ="<?php echo $_GET['session'];?>";
			
			 var branchData = "";
            var branchCode = "";
            var branchName = "";
            var branchType = "";
            var branchTel = "-";
            var branchAddress = "-";
            var branchContact = "-";
			var email = "-";
			
			
			if(b!=1){
				key="<?php echo $_GET['session'];?>";
				 //alert(start+","+end)
            $.get( "../path.txt", function( data ) {
                var resourceContent = data;
                $.ajax({
                    url: resourceContent+"/getDataBranch_.php?branchID="+key,
                    type: "POST",
                    data: ''
                })
                    .success(function(result) {
                        var obj = jQuery.parseJSON(result);
						//alert(result)
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

                                load(branchData,branchCode,branchName,branchType,branchTel,branchAddress,branchContact,email,start,end,keywords,keywords2,select_top,b);
                            });
                        }
                    });
            });
			}else if(keywords2!='cheese'){
				 $.get( "../path.txt", function( data ) {
                var resourceContent = data;
                $.ajax({
                    url: resourceContent+"/getDataBranch_.php?branchID="+keywords2,
                    type: "POST",
                    data: ''
                })
                    .success(function(result) {
                        var obj = jQuery.parseJSON(result);
						//alert(result)
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

                                load(branchData,branchCode,branchName,branchType,branchTel,branchAddress,branchContact,email,start,end,keywords,keywords2,select_top,b);
                            });
                        }
                    });
            });
				//load(branchData,branchCode,branchName,branchType,branchTel,branchAddress,branchContact,email,start,end,keywords,keywords2,select_top,b);
			}else{
				load(branchData,branchCode,branchName,branchType,branchTel,branchAddress,branchContact,email,start,end,keywords,keywords2,select_top,b);
			}

        //}
        function load(branchData,branchCode,branchName,branchType,branchTel,branchAddress,branchContact,email,start,end,keywords,keywords2,select_top,session) 		{
		
            //alert(keywords2+","+keywords+","+start+","+end+","+branchCode+","+session)
            $.get( "../path.txt", function( data ) {
                var resourceContent = data;
                $.ajax({
                   url: resourceContent+"/CustomerServiceF.php?select_top="+select_top+
                    "&date_start="+start +
                    "&date_end="+end +
                    "&keywords2="+keywords2+
                    "&keywords="+keywords+
                    "&session="+session,
                    type: "POST",
                    data: ''
                })
                    .success(function(result) {
                        var obj = jQuery.parseJSON(result);
						//alert(result)
                        if(obj != '')
                        {
							$("#load").text("กำลังโหลดไฟล์...");
								$.post('Print-Customer-Service-F.php', { 
								resultData:result,
								date_start:start,
								branch:branchName,
								date_end:end
												
							}, function(result) { 
   								//alert(result); 			
								window.location = 'MyPDF/File-Customer-Service-F.pdf';
							});
                            /*$.each(obj, function (key, val) {
								
                                
											var str_BranchType = JSON.stringify(val['BranchType'])
											var str_OrderDate = JSON.stringify(val['str_OrderDate'])
											var str_BranchNameTH = JSON.stringify(val['BranchNameTH'])
											var data1 = branchName
											var data2 = branchCode
											var data3 = start
											var data4 = end
											
											
								//window.location = 'MyPDF/File-Invoice.pdf';
                            });*/

                        }else{
							if (confirm("ไม่มีข้อมูล")) {
    							close();
  							}else{
								close();
							}
							//window.close();
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