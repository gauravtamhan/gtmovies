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
	// echo "Total tickets: ".$totalTicketCount.". Adult tickets: ".$adultTicketCount.". Senior tickets: ".$seniorTicketCount.". Child tickets: ".$childTicketCount;

	
?>

<?php 
	$dateOfOrder = "";
	$timeOfOrder = "";
	$order_number = "";
	$status = "Unused";

	date_default_timezone_set('America/New_York');
	
	$date = date("Y-m-d");
	$time = date("h:i:s");
	
	$dateOfOrder = $date;
	$timeOfOrder = $time;

	$query = "SELECT Theater_ID FROM THEATER WHERE Name = '$theater'";
	$result = mysqli_query($db, $query);
	$row = mysqli_fetch_assoc($result);

	$theaterID = $row["Theater_ID"];

	// retrieves the saved card number the user selected when purchasing a ticket then adds the order into the database.
	if (isset($_POST["saved_card"])) {
		$saved_card_number = $_POST["saved_card"];
		
		
		$sql = "INSERT INTO ORDERS (`Date`, Senior_Tickets, Child_Tickets, Adult_Tickets, Total_Tickets, Time, Status, Username, Card_No, Movie_title, Theater_ID)
				VALUES ('$dateOfOrder', '$seniorTicketCount', '$childTicketCount', '$adultTicketCount', '$totalTicketCount', '$timeOfOrder', '$status', '$user', '$saved_card_number', '$movie', '$theaterID')";
		mysqli_query($db, $sql);

		// gets the order ID from the recently placed order
		$sql2 = "SELECT Order_ID FROM ORDERS WHERE `Date` = '$dateOfOrder'
				AND Senior_Tickets = '$seniorTicketCount'
				AND Child_Tickets = '$childTicketCount'
				AND Adult_Tickets = '$adultTicketCount'
				AND Total_Tickets = '$totalTicketCount'
				AND Time = '$timeOfOrder'
				AND Status = '$status'
				AND Username = '$user'
				AND Card_No = '$saved_card_number'
				AND Movie_title = '$movie'
				And Theater_ID = '$theaterID'";

		$ans = mysqli_query($db, $sql2);
		$tuple = mysqli_fetch_row($ans);
		$order_number = $tuple[0];

	} else { // if the user pays with a new card...

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
		
		// adds the card to payment info if box was checked.
		if (isset($_POST['addToSavedCards']) && $_POST['addToSavedCards'] == 'Yes') {

		    $query = "INSERT INTO PAYMENT_INFO (Card_No, CVV, Name_on_card, Expiration_Date, Saved, Username) VALUES ('$card_num', '$card_cvv', '$cardholder_name', '$card_exp', 1, '$user')";
		    mysqli_query($db, $query);
		
		    // Debugging check: This code block should be left commented when not debugging.
		    
		    // if (mysqli_query($db, $query)) {
		    // 	echo " Added '$card_num' with name on card as '$' to PAYMENT_INFO successfully.";
		    // } else {
		    // 	echo mysqli_error($db);
		    }
		}

		$sql3 = "INSERT INTO ORDERS (`Date`, Senior_Tickets, Child_Tickets, Adult_Tickets, Total_Tickets, Time, Status, Username, Card_No, Movie_title, Theater_ID)
				VALUES ('$dateOfOrder', '$seniorTicketCount', '$childTicketCount', '$adultTicketCount', '$totalTicketCount', '$timeOfOrder', '$status', '$user', '$card_num', '$movie', '$theaterID')";

		// mysqli_query($db, $sql3);

		// gets the order ID from the recently placed order
		$sql4 = "SELECT Order_ID FROM ORDERS WHERE `Date` = '$dateOfOrder'
				AND Senior_Tickets = '$seniorTicketCount'
				AND Child_Tickets = '$childTicketCount'
				AND Adult_Tickets = '$adultTicketCount'
				AND Total_Tickets = '$totalTicketCount'
				AND Time = '$timeOfOrder'
				AND Status = '$status'
				AND Username = '$user'
				AND Card_No = '$card_num'
				AND Movie_title = '$movie'
				And Theater_ID = '$theaterID'";

		// $ans2 = mysqli_query($db, $sql4);
		// $tuple2 = mysqli_fetch_row($ans2);
		// $order_number = $tuple2[0];
	}

	// echo $order_number;
   
?>



