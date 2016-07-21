<?php
	include("config.php");
	session_start(); 
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
		</style>
	</head>
	<body>
		<h1><?php echo $title ?></h1>
		
		<p> Released: <?php echo $release ?>  | <?php echo $rating ?> | <?php echo $length ?> | <?php echo $genre ?></p>
		<hr>

	</body>
</html>