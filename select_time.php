<?php
   include("config.php");
   session_start();
   $user = $_SESSION["current_user"];
   $movie = $_SESSION["movie"];
?>

<?php 
		if (isset($_POST["saved_theater"])) {
			$saved_theater = $_POST["saved_theater"];
       		echo "Theater ".$saved_theater." has been chosen.";
		}

		if (isset($_POST["selected_theater"])) {
			$selected_theater = $_POST["selected_theater"];
			echo "Theater ".$selected_theater." was selected from the search.";
		}
       
?>