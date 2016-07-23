<?php
	include("config.php");
	session_start();
	$showtime = $_SESSION['showtime'];
	$user = $_SESSION["current_user"];
   	$movie = $_SESSION["movie"];
   	$theater = $_SESSION["theater"];

   	// format the showtime
   	$date = date_create($showtime);
	$formattedDate = date_format($date, "l\, F j \@ g:ia");

	$adultTicketCount = $_SESSION["numAdultTickets"];
	$seniorTicketCount = $_SESSION["numSeniorTickets"];
	$childTicketCount = $_SESSION["numChildTickets"];

	$totalTicketCount = $adultTicketCount + $seniorTicketCount + $childTicketCount;

	
?>

<?php 
	$date = date("Y-m-d");
	$time = date("h:i:s");
	// retrieves the saved card number the user selected when purchasing a ticket
	if (isset($_POST["saved_card"])) {
		$saved_card_number = $_POST["saved_card"];
		
		$query = "SELECT Theater_ID FROM THEATER WHERE Name = '$theater'";
		$result = mysqli_query($db, $query);
		$row = mysqli_fetch_assoc($result);

		$theaterID = $row["Theater_ID"];
		$status = "Unused";
		$sql = "INSERT INTO ORDERS (`Date`, Senior_Tickets, Child_Tickets, Adult_Tickets, Total_Tickets, Time, Status, Username, Card_No, Movie_title, Theater_ID) VALUES ('$date', '$seniorTicketCount', '$childTicketCount', '$adultTicketCount', '$totalTicketCount', '$time', '$status', '$user', '$saved_card_number', '$movie', '$theaterID')";
		// mysqli_query($db, $sql);
		if (mysqli_query($db, $sql)) {
	    	echo " Added order successfully at ".$time;
	    } else {
	    	echo mysqli_error($db);
	    }

	} // put a else here

	
	if (isset($_POST['nameOnCard'])) {
		$cardholder_name = $_POST['nameOnCard'];
	}

	if (isset($_POST['cardNum'])) {
		$card_num = $_POST['cardNum'];
	}

	if (isset($_POST['cardCVV'])) {
		$card_cvv = $_POST['cardCVV'];
	}

	if (isset($_POST['cardExp'])) {
		$card_exp = $_POST['cardExp'];
	}
	
	// adds the new theater to the preferred theater table only if box was checked.
	if (isset($_POST['addToSavedCards']) && $_POST['addToSavedCards'] == 'Yes') {

	    $query = "INSERT INTO PAYMENT_INFO (Card_No, CVV, Name_on_card, Expiration_Date, Saved, Username) VALUES ('$card_num', '$card_cvv', 'cardholder_name', 'card_exp', 1, '$user')";
	    // mysqli_query($db, $query);
	
	    // Debugging check: This code block should be left commented when not debugging.
	    
	    // if (mysqli_query($db, $query)) {
	    // 	echo " Added '$card_num' to PAYMENT_INFO successfully.";
	    // } else {
	    // 	echo mysqli_error($db);
	    // }
	}
   
?>



