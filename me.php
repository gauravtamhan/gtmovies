<?php
	include("config.php");
	session_start(); 
	$user = $_SESSION['current_user'];
	echo $user;
?>