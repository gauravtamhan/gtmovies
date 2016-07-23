<?php
   include("config.php");
   session_start();
   $user = $_SESSION["current_user"];
?>

<?php
$query = "SELECT Theater_ID, Name, Street, City, State, Zip FROM THEATER, PREFERS WHERE PREFERS.Username = '$user' AND THEATER.Theater_ID = PREFERS.Theater_ID";
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
	  // print_r($orderIDs);
	  // echo $count;
?>

<html>
	<head>
		<title>Preferred Theaters</title>

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
				/*height: 50px;*/
				text-align: center;
				width: 30%;
				font-family: Georgia;
				font-size: 20px;
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
		<h1> My Preferred Theaters </h1>

      <?php
				echo "<table class='datatable' align='center'>";
				if ($count > 0) {

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

					echo "</table>";
				} else {
					echo "<p> You do not have any preferred theaters. </p>";
				}
			?>
		</table>
		<table align="center" class="button backbutton">
          <tr class="button">
            <td class="button">
              <a class="button" href="#"> Delete </a>
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
