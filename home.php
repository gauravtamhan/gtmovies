<?php
   include("config.php");
   session_start();
   $user = $_SESSION["current_user"];
?>




<html>
   
   <head>
      <title> Now Playing </title>

      <style>
      	table {
      		border-collapse: collapse;
      		width: 50%;
      	}

      	table, th, td {
    		border: 1px solid black;
		}

		td {
			height: 50px;
			padding-top: 10px;
		    padding-right: 10px;
		    padding-bottom: 10px;
		    padding-left: 10px;
			text-align: center;
			width: 50%;
		}
		td:hover{background-color:#f5f5f5}
      </style>

   </head>
   
   <body>
   		<h2> <?php echo $user ?> <h2>
      <center><h1> Now Playing </h1> </center>
      <!-- <h2><a href = "logout.php">Sign Out</a></h2> -->
      <table align="center">
      	<?php
			$query = "SELECT DISTINCT Movie_title FROM PLAYS_AT WHERE Playing = 1";

			$result = mysqli_query($db, $query);

			// $row = mysqli_fetch_row($result);
			$movie_name = array();

			while ($row = mysqli_fetch_row($result)) {
		?>
		  <tr>
		    <td>
		    	<?php
		    		array_push($movie_name, $row[0]);
		    		echo $row[0];
		    	?>
		    </td>
		   
		  </tr>
		  <!-- <tr>
		    <td><?php echo $row?></td>
		    <td><?php echo $row?></td> 
		  </tr> -->
		  <!-- <tr>
		    <td><?php echo $row?></td>
		    <td><?php echo $row?></td> 
		  </tr> -->
		<?php
			} print_r($movie_name);
			?>
		</table>
   </body>
   
</html>

