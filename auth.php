<?php
	//Start session
	session_start();
	$admin = 0;
	//Check whether the session variable SESS_MEMBER_ID is present or not
	if(!isset($_SESSION['SESS_MEMBER_ID']) || (trim($_SESSION['SESS_MEMBER_ID']) == '')) {
		header("location: login.php");
		exit();
	}
	$admin = $_SESSION['SESS_MEMBER_ADMIN'];
	$member_name = $_SESSION['SESS_MEMBER_NAME'];
?>