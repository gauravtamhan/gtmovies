<?php
   include("config.php");
   session_start();
   $user = $_SESSION["current_user"];
?>

<?php
	$query = "SELECT Order_ID, Movie_title, Status FROM ORDERS WHERE Username = '$user'";

	$result = mysqli_query($db, $query);
	$count = mysqli_num_rows($result);
	
	$row = mysqli_fetch_assoc($result);

	$orderIDs = array();
	$movie_titles = array();
	$statuses = array();

	while ($row = mysqli_fetch_assoc($result)) {

    	array_push($orderIDs, $row["Order_ID"]);
    	array_push($movie_titles, $row["Movie_title"]);
    	array_push($statuses, $row["Status"]);

	} 
	  // print_r($orderIDs);
?>

<html>
	<head>
		<title>Order History</title>

		<style>
			h1 {
				font-style: italic;
				font-size: 50px;
				text-align: center;
				padding-top: 30px;
			}

			h3 {
				text-align: center;
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
				width: 30%;
			}

			table.datatable {
				margin-top: 60px;
	      		border-collapse: collapse;
	      		width: 800px;
	      		border: 1px solid black;
	      	
	      	}

	      	th.datatable, td.datatable {
	    		padding: 5px;
			}

			th.datatable {
				height: 55px;
				font-family: Georgia;
				font-size: 22px;
				border-bottom: 1px solid black;
			}

			td.datatable {
				height: 50px;
				text-align: center;
				font-family: Georgia;
				font-size: 20px;
			}

			

			table.button {
				margin-top: 60px;
	      		border-collapse: separate;
	      		width: 30%;
	      		border: none;
	      		border-spacing: 20px;
	      	}

	      	th.button, td.button {
	    		border: 1px solid black;
			}

			td.button {
				height: 50px;
				text-align: center;
				width: 30%;
				font-family: Georgia;
				font-size: 20px;
			}

			a.button {
				display: block;
				width: 100%;
			}
			
			td.button:hover {
				background-color:#f5f5f5
			}

			a.button:link {
				color: black;
				text-decoration: none;
			}

			a.button:visited {
				color: black;
				text-decoration: none;
			}

			.backbutton {
	            margin-top: 0px;
	            border-collapse: separate;
	            height: 50px;
	            border: none;
	            border-spacing: 20px;
          }
		</style>
	</head>
	<body>
		<h1> Order History </h1>
		
		
		

		<table class="datatable" align="center">
			<tr class="datatable">
				<th class="datatable"> Select </th>
				<th class="datatable"> Order ID </th>
				<th class="datatable"> Movie </th>
				<th class="datatable"> Status </th>
			</tr>
			<?php
				$i = 0;
				while ($i < $count - 1) {
					echo "<tr class="."datatable".">";
						echo "<td class="."datatable".">";
							echo "<input type="."radio"." name="."A".">";
						echo "</td>";

						echo "<td class="."datatable".">";
							echo $orderIDs[$i];
						echo "</td>";

						echo "<td class="."datatable".">";
							echo $movie_titles[$i];
						echo "</td>";

						echo "<td class="."datatable".">";
							echo $statuses[$i];
						echo "</td>";

					echo "</tr>";
					$i++;
				}
			?>			
		</table>
		<table align="center" class="button backbutton">
          <tr class="button">
            <td class="button">
              <a class="button" href="#"> View Detail </a>
            </td>
          </tr>
          <tr class="button">
            <td class="button">
              <a class="button" href="Me.php"> Back </a>
            </td>
          </tr>
        </table>

	</body>
</html>

