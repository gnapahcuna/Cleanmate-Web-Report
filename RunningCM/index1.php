<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<html>
	<head>
		<title>Running..</title>
		<style type="text/css">
		body{
			background: #fff;
		}
		.title_clock{
			position: absolute;
			top: 30%;
			left: 50%;
			transform: translateX(-50%) translateY(-50%);
			color: #0099cc;
			font-size: 40px;
			border: 0px solid #ccc;
			padding: 0px 5px 0px 5px;
		}
		.clock{
			position: absolute;
			top: 40%;
			left: 50%;
			transform: translateX(-50%) translateY(-50%);
			color: #0099cc;
			font-size: 80px;
			border: 1px solid #ccc;
			padding: 0px 5px 0px 5px;
			font-family: clock;
		}
		@font-face {
    		font-family: clock;
    		src: url(digital-7.ttf);
		}
		img {
    		width: 80%;
    		height: auto;
		}
		.footer {
   			position: fixed;
   			left: 0;
   			bottom: 0;
   			width: 100%;
   			background-color: #fff;
   			color: #0099cc;
   			text-align: center;
		}
		
		</style>
	</head>
	<body>
    	<!--<div class="title_clock">
        	<img src="Logo_300.png" alt="Workplace" usemap="#workmap" width="50" height="50">
        </div>!-->
        <div id="MyClockDisplay" class="clock"></div>
        <div id="getData">
        
        <div class="footer">
  			<p>**อย่าปิด เพราะกำลังรันนิ่งเพื่อ backup ไฟล์ประจำวันของคลีนเมทอยู่ (20.00 น.)</p>
		</div>
        <?php
		//require('index.php');
		?>
        </div>
        
		<script type="text/javascript">

			function showTime(){
				var date = new Date();
				var h = date.getHours(); // 0 - 23
				var m = date.getMinutes(); // 0 - 59
				var s = date.getSeconds(); // 0 - 59
				var session = "AM";
				
				if(h >= 12){
					h = h - 12;
					session = "PM";
				}

				if(h == 0){
					h = 12;
				}

				h = (h < 10) ? "0" + h : h;
				m = (m < 10) ? "0" + m : m;
				s = (s < 10) ? "0" + s : s;

				var time = h + ":" + m + ":" + s + " " + session;
				if(h==08&&m==00&&s==01&&session=='PM'){
					//document.getElementById("getData").textContent = time
					window.location.href = 'index.php';
				}
				document.getElementById("MyClockDisplay").innerText = time;
				document.getElementById("MyClockDisplay").textContent = time;

				setTimeout(showTime, 1000);
			}

			showTime();

		</script>
	</body>
</html>