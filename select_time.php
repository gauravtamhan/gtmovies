<?php
   include("config.php");
   session_start();
   $user = $_SESSION["current_user"];
   $movie = $_SESSION["movie"];
?>

<?php 
	$sql = "";

	// sets the sql query if user chose a preferred theater.
	if (isset($_POST["saved_theater"])) {
		$saved_theater = $_POST["saved_theater"];
   		echo "Theater ".$saved_theater." has been chosen.";
   		$sql = "SELECT Showtime FROM SHOWTIME, THEATER WHERE Movie_title = '$movie' AND SHOWTIME.Theater_ID = THEATER.Theater_ID AND THEATER.Name = '$saved_theater'";
	}

	// sets the sql query if user selects a new theater.
	if (isset($_POST["selected_theater"])) {
		$selected_theater = $_POST["selected_theater"];
		echo "Theater ".$selected_theater." was selected from the search.";
		$sql = "SELECT Showtime FROM SHOWTIME, THEATER WHERE Movie_title = '$movie' AND SHOWTIME.Theater_ID = THEATER.Theater_ID AND THEATER.Name = '$selected_theater'";
	}
	
	// adds the new theater to the preferred theater table only if box was checked.
	if (isset($_POST['addToPrefferedTheaters']) && $_POST['addToPrefferedTheaters'] == 'Yes') {
	    $query1 = "SELECT Theater_ID FROM THEATER WHERE Name = '$selected_theater'";
	    $res = mysqli_query($db, $query1);
	    $tuple = mysqli_fetch_row($res);

	    $query = "INSERT INTO PREFERS (Theater_ID, Username) VALUES ('$tuple[0]', '$user')";
	    // mysqli_query($db, $query);
	    if (mysqli_query($db, $query)) {
	    	echo " Added '$selected_theater' to preffered theaters successfully.";
	    } else {
	    	echo mysqli_error($db);
	    }
	}   
 
 	// performs the query to obtain all showtimes at the selected theater.
	$result = mysqli_query($db, $sql);

	// if (mysqli_query($db, $sql)) {
	//     	echo " Retrieved all showtimes for '$movie' successfully.";
	// } else {
	//     	echo mysqli_error($db);
	// }

	$count = mysqli_num_rows($result);
	// have a check if count == 0 Display: there are now show times available at this theater. Try selecting a different location.
	

	$showtimes = array();
	

	while ($row = mysqli_fetch_assoc($result)) {

    	array_push($showtimes, $row["Showtime"]);

	} 

	print_r($showtimes);
       
?>