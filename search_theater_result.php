<?php
   include("config.php");
   session_start();
   $user = $_SESSION["current_user"];
   $movie = $_SESSION["movie"];
?>

<?php 

	/**
	* Gets the user's input from the previous page (Chose Theater) from the 2nd form that had an input
	* tag with a name = user_input. Looks for it in the $_POST array at index 'user_input' and assigns it
	* to the variable $users_search. 
	*/
   $users_search = $_POST["user_input"];
   // echo "User had typed ".$users_search." in the previous screen";
		

   /**
   * Query to find a match in the database with what the user had inputted.
   */
	$query = "SELECT Theater_ID, Name, Street, City, State, Zip
				FROM THEATER 
				WHERE Name LIKE '$users_search%' OR City = '$users_search' OR State = '$users_search'";

	$result = mysqli_query($db, $query);
	$count = mysqli_num_rows($result);
	
	$error = "";

	$theaterIDs = array();
	$theaterNames = array();
	$theaterStreets = array();
	$theaterCities = array();
	$theaterStates = array();
	$theaterZips = array();

	while ($row = mysqli_fetch_assoc($result)) {
		array_push($theaterIDs, $row["Theater_ID"]);
		array_push($theaterNames, $row["Name"]);
		array_push($theaterStreets, $row["Street"]);
		array_push($theaterCities, $row["City"]);
		array_push($theaterStates, $row["State"]);
		array_push($theaterZips, $row["Zip"]);

	}
	// print_r($theaterNames);
	// print_r($theaterStreets);
	// echo $count;
?>



<html>
	<head>
		<title>Theater Results</title>

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
	      		width: 600px;
	      		border: 1px solid black;
	      	
	      	}

	      	td.datatable-address {
	    		/*padding: 5px;*/
	    		height: 30px;
				text-align: center;
				font-family: Georgia;
				font-size: 15px;
				border-bottom: 1px solid black;
			}

			td.datatable-selector {
	    		/*padding: 5px;*/
	    		padding-left: 10px;
	    		height: 30px;
	    		vertical-align: bottom;
				text-align: center;
				font-family: Georgia;
				font-size: 15px;
				
			}

			/*th.datatable {
				height: 55px;
				font-family: Georgia;
				font-size: 22px;
				border-bottom: 1px solid black;
			}*/

			td.datatable {
				padding: 5px;
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
	            height: 50px;
	      	}

	      	th.button, td.button {
	    		border: 1px solid black;
			}

			td.button {
				/*height: 50px;*/
				text-align: center;
				width: 30%;
				font-family: Georgia;
				font-size: 18px;
			}

			table.button-black {
				margin-top: 60px;
	      		border-collapse: separate;
	      		width: 30%;
	      		border: none;
	      		border-spacing: 20px;
	            height: 50px;
	      	}

			td.button-black {
				/*height: 50px;*/
				text-align: center;
				width: 30%;
				font-family: Georgia;
				border: none;
			}

			a.button {
				display: block;
				width: 100%;
				padding: 10px 0px;
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

			table.backbutton {
	            margin-top: 0px;
	            border-collapse: separate;
	            height: 50px;
	            width: 29.5%;
	            border: none;
	            border-spacing: 20px;
          }
          input[type=submit] {
            width: 100%;
            font-size: 18px;
            background-color: black;
            color: white;
            padding: 10px;
            border: none;
            font-family: Georgia;
            cursor: hand;
         }
		</style>
	</head>
	<body>
		<h1> Search Results </h1>
		
		
		

		
			
			<?php
				echo "<table class='datatable' align='center'>";
				if ($count > 0) {
					echo "<form id='form1' action='select_time.php' method='post'>"; 
					$i = 0;
					while ($i < $count) {
						echo "<tr class="."datatable".">";
							echo "<td class="."datatable-selector".">";
								// echo "<form action='' method='post'>";
								// echo "<input type="."radio"." name="."selected_theater".">";
								echo "<input type='radio' checked='checked' name='selected_theater' value='".$theaterNames[$i]."'>";
								// echo "</form>";
							echo "</td>";

							echo "<td class="."datatable".">";
								echo $theaterNames[$i];
							echo "</td>";
						echo "</tr>";

						echo "<tr class="."datatable".">";
							echo "<td class="."datatable".">";
								// echo "<input type="."radio"." name="."A".">";
							echo "</td>";

							echo "<td class="."datatable-address".">";
								echo $theaterStreets[$i].", ".$theaterCities[$i].", ".$theaterStates[$i].", ".$theaterZips[$i];
							echo "</td>";
						echo "</tr>";
						$i++;
					}
					echo "</form>";
					echo "</table>";

					echo "<table align='center' class='button-black'>";
				    	echo "<tr class='button-black'>";
				            echo "<td class='button-black'>";
				              echo "<input type='submit' form='form1' value='Next'/>";
				            echo "</td>";
				          echo "</tr>";
				     	 echo "</table>";
				} else {
					echo "<p> Search did not find any results. </p>";
				}
			?>			
		
     	 <table align="center" class="backbutton">
          <tr class="button">
            <td class="button">
              <a class="button" href="choose_theater.php"> Back </a>
            </td>
          </tr>
        </table>

	</body>
</html>



