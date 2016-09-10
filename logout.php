<?php
	//Start session
	session_start();
	
	//Unset the variables stored in session
	unset($_SESSION['SESS_MEMBER_ID']);
	unset($_SESSION['SESS_MEMBER_ADMIN']);
	unset($_SESSION['SESS_MEMBER_NAME']);

	header("location: login.php");
?>
