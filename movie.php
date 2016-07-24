<?php
	include("config.php");
	session_start();
	if (empty($_SESSION['current_user'])) {
   		header('Location: login.php');
   		exit;
    }
	$_SESSION['movie'] = $_GET['movie'];
	$movie = $_SESSION['movie'];
	
?>

<?php
	$query = "SELECT Title, Length, Genre, Release_date, Rating  FROM MOVIE WHERE Title = '$movie'";

	$result = mysqli_query($db, $query);

	
	$row = mysqli_fetch_assoc($result);
	$title = $row["Title"];
	$length = $row["Length"];
	$genre = $row["Genre"];
	$release = $row["Release_date"];
	$rating = $row["Rating"];

?>

<html>
	<head>
		<title>
			<?php echo $title ?>
		</title>

		<style>
			h1 {
				font-style: italic;
				font-size: 50px;
				text-align: center;
				padding-top: 50px;
			}

			p {
				text-align: center;
				padding-top: 40px;
				padding-bottom: 80px;
				font-size: 20px;
				color: grey;
				font-family: Verdana;
			}

			hr {
				width: 70%;
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
		<h1><?php echo $title ?></h1>
		
		<p> Released: <?php echo $release ?>  | <?php echo $rating ?> | <?php echo $length ?> | <?php echo $genre ?></p>
		<hr>
		<table align="center">
			<tr>
				<td>
					<a href="overview.php"> Overview </a>
				</td>
				<td>
					<a href="review.php"> Movie Review </a>
				</td>
				<td>
					<a href="choose_theater.php"> Buy Ticket </a>
				</td>
			</tr>
		</table>

		<table align="center" class="backbutton">
			<tr>
				<td>
					<a href="home.php"> Back to Now Playing </a>
				</td>
			</tr>
		</table>
	</body>
</html>