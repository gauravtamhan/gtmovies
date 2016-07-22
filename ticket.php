<?php
	include("config.php");
	session_start();
	$_SESSION['showtime'] = $_GET['showtime'];
	$showtime = $_SESSION['showtime'];

	echo "You picked this show time: ".$showtime;
?>