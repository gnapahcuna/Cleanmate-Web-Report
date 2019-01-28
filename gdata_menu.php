<?php
session_start();
		$key=$_GET['key'];
	   $_SESSION['ProgramCode'][$key]=$_GET['ProgramCode'];
       //$_SESSION['MenuName'][] = $_GET['MenuName'];

echo $_SESSION['ProgramCode'];
?>