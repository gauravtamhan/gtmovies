<?php
   include("config.php");
   session_start();
   $user = $_SESSION["current_user"];
?>




<html>
   
   <head>
      <title> Now Playing </title>

      <style>
      	h1 {
				font-style: italic;
				font-size: 50px;
				text-align: center;
				padding-top: 20px;
			}

		p {
			font-size: 20px;
			font-family: Georgia;
			padding-top: 5px;
			padding-left: 5px;
		}
      	table {
      		border-collapse: collapse;
      		width: 50%;
      	}

      	table, th, td {
    		border: 1px solid black;
		}

		td {
			height: 50px;
			text-align: center;
			width: 50%;
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
   		<p> <a href="me.php" >Me</a> </p>
   			<hr>
      <center><h1> Now Playing </h1> </center>
      <!-- <h2><a href = "logout.php">Sign Out</a></h2> -->
      
      	<?php
			$query = "SELECT DISTINCT Movie_title FROM PLAYS_AT WHERE Playing = 1";

			$result = mysqli_query($db, $query);

			$movie_name = array();

			while ($row = mysqli_fetch_row($result)) {
		
		    	array_push($movie_name, $row[0]);

			} 
			// print_r($movie_name);
		?>

		<table align="center">
			<tr>
				<td> 
					<a href="movie.php?movie=<?php echo $movie_name[0] ?>"> <?php echo $movie_name[0] ?> </a>
				</td>
			</tr>
			<tr>
				<td> 
					<a href="movie.php?movie=<?php echo $movie_name[1] ?>"> <?php echo $movie_name[1] ?> </a>
				</td>
			</tr>
			<tr>
				<td> 
					<a href="movie.php?movie=<?php echo $movie_name[2] ?>"> <?php echo $movie_name[2] ?> </a>
				</td>
			</tr>
			<tr>
				<td> 
					<a href="movie.php?movie=<?php echo $movie_name[3] ?>"> <?php echo $movie_name[3] ?> </a>
				</td>
			</tr>
			<tr>
				<td> 
					<a href="movie.php?movie=<?php echo $movie_name[4] ?>"> <?php echo $movie_name[4] ?> </a>
				</td>
			</tr>

		</table>
		
   </body>
   
</html>

