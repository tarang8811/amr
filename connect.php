<?php
require_once('config.php');
//Create the connection  
 
$con = mysqli_connect(DB_HOST,DB_USER,DB_PASSWORD,DB_DATABASE) or die("Some error occurred during connection " . mysqli_error($con));  
//echo 'connection succesful';
?>