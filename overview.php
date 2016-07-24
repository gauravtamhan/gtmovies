<?php
	include("config.php");
	session_start(); 
	$movie = $_SESSION['movie'];
?>

<?php
	$query = "SELECT Synopsis, Cast FROM MOVIE WHERE Title = '$movie'";

	$result = mysqli_query($db, $query);

	
	$row = mysqli_fetch_assoc($result);
	$synopsis = $row["Synopsis"];
	$cast = $row["Cast"];

?>


<html>
	<head>
		<title>
			Overview
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
		<div class="container">
			<h1><?php echo $movie ?></h1>
			
			<p class="subheading"> <i> Synopsis </i></p>

			<p> <i> <?php echo $synopsis ?> </i></p>
			<hr>
			<p class="subheading"> <i> Cast </i></p>

			<p> <i> <?php echo $cast ?> </i></p>
			<hr>
			<table align="center">
				<tr>
					<td>
						<a href="movie.php?movie=<?php echo $movie ?>"> Back to Movie Selection </a>
					</td>
					
				</tr>
			</table>
		</div>
	</body>
</html>