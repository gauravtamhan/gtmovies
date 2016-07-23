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
	$status = "Used";

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
		    // }
		}

		$sql3 = "INSERT INTO ORDERS (`Date`, Senior_Tickets, Child_Tickets, Adult_Tickets, Total_Tickets, Time, Status, Username, Card_No, Movie_title, Theater_ID)
				VALUES ('$dateOfOrder', '$seniorTicketCount', '$childTicketCount', '$adultTicketCount', '$totalTicketCount', '$timeOfOrder', '$status', '$user', '$card_num', '$movie', '$theaterID')";

		mysqli_query($db, $sql3);

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

		$ans2 = mysqli_query($db, $sql4);
		$tuple2 = mysqli_fetch_row($ans2);
		$order_number = $tuple2[0];
	}
   
?>

<html>
   
   <head>
      <title>Order Confirmation</title>

      <style>
      	h1 {
			font-style: italic;
			font-size: 50px;
			text-align: center;
			padding-top: 20px;
		}

		h2 {
			text-align: center;
			padding-top: 10px;
			padding-bottom: 1px;
			font-size: 35px;
			color: #4d4d4d;
			font-family: Verdana;
			font-style: italic;
			font-weight: lighter;
		}

		h3 {
			text-align: center;
			padding-top: 10px;
			padding-bottom: 1px;
			font-size: 25px;
			color: grey;
			font-family: Verdana;
			font-weight: lighter;
		}

		hr {
			width: 60%;
		}

		p.subtitle {
			font-size: 25px;
			font-family: Georgia;
			font-style: italic;
			padding-top: 5px;
			padding-left: 5px;
			/*display: inline-block;*/
			text-align: center;
			color: #4d4d4d;
		}

		label.fancy {
         		text-align: left;
				padding-top: 10px;
				padding-bottom: 1px;
				font-size: 20px;
				color: #4d4d4d;
				font-family: Verdana;
				width: 180px;
				display: inline-block;
         }

         p.mini-head {
         	text-align: left;
			padding-top: 10px;
			padding-bottom: 1px;
			font-weight: bold;
			font-size: 20px;
			color: #4d4d4d;
			font-family: Verdana;
         }

         .container {
         	width: 620px;
         	border: none;
         	margin-top:30px;

         }

         select {
             -webkit-appearance: button;
             -webkit-border-radius: 2px;
             -webkit-box-shadow: 0px 1px 3px rgba(0, 0, 0, 0.1);
             -webkit-padding-end: 20px;
             -webkit-padding-start: 2px;
             -webkit-user-select: none;
             background-image: url(http://i62.tinypic.com/15xvbd5.png), -webkit-linear-gradient(#FAFAFA, #F4F4F4 40%, #E5E5E5);
             background-position: 97% center;
             background-repeat: no-repeat;
             border: 1px solid #AAA;
             color: #555;
             font-size: inherit;
             margin: 20px;
             overflow: hidden;
             padding: 5px 10px;
             text-overflow: ellipsis;
             white-space: nowrap;
             width: 120px;
          }

          input[type=submit].upper {
            font-size: 15px;
            background-color: black;
            color: white;
            padding: 7px 15px;
            border: none;
            font-family: Georgia;
            cursor: hand;
            border-radius: 3px;
            display: inline;
         }

         input[type=submit].lower {
            font-size: 15px;
            background-color: black;
            color: white;
            padding: 7px 15px;
            border: none;
            font-family: Georgia;
            cursor: hand;
            border-radius: 3px;
            display: block;
            margin: 20px 0px;
         }

         input[type=number]::-webkit-inner-spin-button, input[type=number]::-webkit-outer-spin-button { 
		    -webkit-appearance: none;
		    -moz-appearance: none;
		    appearance: none;
		    margin: 0; 
		}

         input[type=text], input[type=number], input[type=date] {
             width: 300px;
             padding: 5px 10px;
             margin-top: 20px;
             margin-left: 20px;
             margin-right: 20px;

             box-sizing: border-box;
             border: 1px solid #ccc;
             -webkit-transition: 0.5s;
             transition: 0.5s;
             outline: none;
             border-radius: 2px;
             font-family: Georgia;
             font-size: 15px;
             display: inline-block;
         }

         input[type=date] {
         	margin-bottom: 50px;
         }

         input[type=text]:focus, input[type=number]:focus, input[type=date]:focus {
             border: 1px solid black;
         }

         form.top {
         	border: 1px solid black;
         	padding-top: 20px;
         	padding: 20px;
         	padding-left: 40px;
         /*	width: 260px;
         	padding-left: 30px;	
         	padding-bottom: 10px;*/
         }

         form.bottom {
         	border: 1px solid black;
         	padding: 20px;
         	/*padding-left: 40px;*/
         /*	width: 260px;
         	padding-left: 30px;	
         	padding-bottom: 10px;*/
         }

         input[type = checkbox] {
         	font-size: 18px;
         	float: middle;
         	display: inline-block;
         	width: 20px;
         	
         }

         label.original {
         	display: inline-block;
         }

         .backbutton {
				margin-top: 20px;
	      		border-collapse: separate;
	      		width: 30%;
	      		border: none;
	      		border-spacing: 20px;
			}

			table {
				margin-top: 90px;
	      		border-collapse: separate;
	      		width: 80%;
	      		border: none;
	      		border-spacing: 20px;
	      	}

	      	th, td {
	    		border: 1px solid black;
			}

			td {
				/*height: 50px;*/
				text-align: center;
				width: 30%;
				font-family: Georgia;
				font-size: 20px;
			}

			a {
				display: block;
				width: 100%;
				padding: 10px 0px;
			}
			
			td:hover {
				background-color:#f5f5f5
			}

			a:link {
				color: black;
				text-decoration: none;
			}

			a:visited {
				color: black;
				text-decoration: none;
			}

      </style>

   </head>
   
   <body>
      <h1> Order Confirmation</h1>
      <hr>
      <p class="subtitle"> Movie: <?php echo $movie?> </p>
      <p class="subtitle"> Location: <?php echo $theater?> </p>
      <p class="subtitle"> Date: <?php echo $formattedDate?> </p>
      <p class="subtitle"> Order ID: <?php echo $order_number?> </p>
      <hr>
      <h2> Thank you for you purchase!</h2>
      <h3> Please save the order ID for your records. </h3>

    
 		<table align="center" class="backbutton">
			<tr>
				<td>
					<a href="home.php"> Back to Now Playing </a>
				</td>
			</tr>
		</table>


   </body>
   
</html>

