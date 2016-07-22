<?php
   include("config.php");
   session_start();
   $user = $_SESSION["current_user"];
   $movie = $_SESSION["movie"];
?>

<?php 
       $saved_theater = $_POST["saved_theater"];
       echo "Theater ".$saved_theater." has been chosen.";
			
	

?>