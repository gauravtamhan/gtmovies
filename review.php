<?php
	include("config.php");
	session_start(); 
	$movie = $_SESSION['movie'];
?>

<?php
	// Gets the reviews
	$query = "SELECT Title, Comment, Rating, Username FROM REVIEW WHERE Movie_title = '$movie'";

	$result = mysqli_query($db, $query);

	$cnt = mysqli_num_rows($result);

	$reviewtitles = array();
	$comments = array();
	$ratings = array();
	$usernames = array();

	while ($row = mysqli_fetch_assoc($result)) {
		array_push($reviewtitles, $row["Title"]);
		array_push($comments, $row["Comment"]);
		array_push($ratings, $row["Rating"]);
		array_push($usernames, $row["Username"]);

	}

	// Calculates the average rating
	$query2 = "SELECT Movie_title, ROUND(AVG(Rating), 1) AS AvgRating FROM REVIEW WHERE Movie_title = '$movie' GROUP BY Movie_title";
	
	$result2 = mysqli_query($db, $query2);
	
	$row2 = mysqli_fetch_assoc($result2);
	$avgrating = $row2["AvgRating"];

?>

<html>
	<head>
		<title>
			Reviews
		</title>

		<style>
			h1 {
				font-style: italic;
				font-size: 50px;
				text-align: center;
				padding-top: 50px;
			}

			p {
				text-align: left;
				padding-top: 20px;
				padding-bottom: 30px;
				font-size: 20px;
				color: grey;
				font-family: Verdana;
				width: 70%;
				display: inline-block;
			}

			.subheading {
				text-align: center;
				padding-top: 10px;
				padding-bottom: 1px;
				font-size: 30px;
				color: #4d4d4d;
				font-family: Verdana;
				width: 70%;
				display: inline-block;
			}

			.review {
				margin: 0px 0px 0px 0px;
			}

			hr {
				width: 70%;
			}

			.container {
				text-align: center;

			}

			table {
				margin-top: 90px;
	      		border-collapse: separate;
	      		width: 40%;
	      		border: none;
	      		border-spacing: 20px;
	      	}

	      	th, td {
	    		border: 1px solid black;
			}

			td {
				height: 50px;
				text-align: center;
				width: 30%;
				font-family: Georgia;
				font-size: 20px;
			}

			a {
				display: block;
				width: 100%;
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
		<div class="container">
			<h1><?php echo $movie ?></h1>
			
			<p class="subheading"> <i> Avg Rating: <?php echo $avgrating ?> out of 5 </i></p>
			<hr>
			<?php
				$i = 0;
				while ($i <= $cnt - 1) {
					echo "<p class="."review"."> Title: ".$reviewtitles[$i]."</p>";
					echo "<p class="."review"."> User: ".$usernames[$i]."</p>";
					echo "<p class="."review"."> Rating: ".$ratings[$i]."</p>";
					echo "<p class="."review"."> Comment: ".$comments[$i]."</p>";
					echo "<hr>";
					$i++;
				}
				
			?>
			
			<table align="center">
				<tr>
					<td>
						<a href="movie.php?movie=<?php echo $movie ?>"> Back </a>
					</td>
					
				</tr>
			</table>
		</div>
	</body>
</html>