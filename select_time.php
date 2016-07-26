<?php
   include("config.php");
   session_start();
   $user = $_SESSION["current_user"];
   $movie = $_SESSION["movie"];
?>

<?php 
	date_default_timezone_set('America/New_York');
	$sql = "";
	$theater = "";

	$datetimeOfOrder = "";
	$datetime = date("Y-m-d H:i:s");
	$datetimeOfOrder = $datetime;
	// echo $datetimeOfOrder;

	// sets the sql query if user chose a preferred theater.
	if (isset($_POST["saved_theater"])) {
		$saved_theater = $_POST["saved_theater"];
   		$theater = $saved_theater;
   		$sql = "SELECT Showtime FROM SHOWTIME, THEATER WHERE Movie_title = '$movie'
   				AND SHOWTIME.Theater_ID = THEATER.Theater_ID
   				AND THEATER.Name = '$saved_theater'
   				AND SHOWTIME.Showtime >= '$datetimeOfOrder'";
	}

	// sets the sql query if user selects a new theater.
	if (isset($_POST["selected_theater"])) {
		$selected_theater = $_POST["selected_theater"];
		$theater = $selected_theater;
		$sql = "SELECT Showtime FROM SHOWTIME, THEATER
				WHERE Movie_title = '$movie'
				AND SHOWTIME.Theater_ID = THEATER.Theater_ID
				AND THEATER.Name = '$selected_theater'
				AND SHOWTIME.Showtime >= '$datetimeOfOrder'";
	}
	
	// adds the new theater to the preferred theater table only if box was checked.
	if (isset($_POST['addToPrefferedTheaters']) && $_POST['addToPrefferedTheaters'] == 'Yes') {
	    $query1 = "SELECT Theater_ID FROM THEATER WHERE Name = '$selected_theater'";
	    $res = mysqli_query($db, $query1);
	    $tuple = mysqli_fetch_row($res);

	    $query = "INSERT INTO PREFERS (Theater_ID, Username) VALUES ('$tuple[0]', '$user')";
	    mysqli_query($db, $query);

	    // Debugging check: This code block should be left commented when not debugging.
	    
	    // if (mysqli_query($db, $query)) {
	    // 	echo " Added '$selected_theater' to preffered theaters successfully.";
	    // } else {
	    // 	echo mysqli_error($db);
	    // }
	}   
 
 	$_SESSION["theater"] = $theater;
 	// performs the query to obtain all showtimes at the selected theater.
	$result = mysqli_query($db, $sql);


	$count = mysqli_num_rows($result);
	// have a check if count == 0 Display: there are now show times available at this theater. Try selecting a different location.
	

	$showtimes = array();
	$formattedShowtimes = array();
	

	while ($row = mysqli_fetch_assoc($result)) {

    	array_push($showtimes, $row["Showtime"]);

	} 

	// print_r($showtimes);
	for ($x = 0; $x < $count; $x++) {
		$date = date_create($showtimes[$x]);
		$formattedDate = date_format($date, "l\, F j \@ g:ia");
		array_push($formattedShowtimes, $formattedDate);
	}
    
   
?>

<html>
   
   <head>
      <title>Show Times</title>

      <style>
      	h1 {
			font-style: italic;
			font-size: 50px;
			text-align: center;
			padding-top: 20px;
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

		p.error {
			font-size: 20px;
			font-family: Verdana;
			font-style: italic;
			margin-top: 10%;
			padding-top: 40px;
			padding-left: 100px;
			padding-right: 100px;
			text-align: center;
			color: grey;
		}
		p.error2 {
			font-size: 20px;
			font-family: Verdana;
			font-style: italic;
			padding: 0px 100px;
			text-align: center;
			color: grey;
		}

		table.backbutton {
            margin-top: 0px;
            border-collapse: separate;
            height: 50px;
            width: 29.5%;
            border: none;
            border-spacing: 20px;
	   	}

      	table {
      		border-collapse: separate;
      		border: none;
      		border-spacing: 20px;
      		width: 50%;
      	}

      	th, td {
    		border: 1px solid black;
		}

		td {

			/*height: 50px;*/
			text-align: center;
			width: 50%;
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
      <center><h1> Select a Show Time </h1> </center>
      <p class="subtitle"> for <?php echo $movie?> at <?php echo $theater?></p>
      	<?php 
      		if ($count > 0) {
	      		$i = 0;
	      		while ($i < $count) {
	      			echo "<table align='center'>";
						echo "<tr>";
							echo "<td>";
								echo "<a href=\"ticket.php?showtime=$showtimes[$i]\" > $formattedShowtimes[$i] </a>";
							echo "</td>";
						echo "</tr>";
					echo "</table>";
	      			$i++;
	      		}
	      	} else {
	      		echo "<p class='error'>There are currently no show times available at this theater.</p>";
	      		echo "<p class='error2'>Try selecting a different location.</p>";
	      	}
		?>
		<table align="center" class="backbutton">
          <tr class="button">
            <td class="button">
              <a class="button" href="choose_theater.php"> Back to Choose Theater</a>
            </td>
          </tr>
        </table>
		
   </body>
   
</html>





