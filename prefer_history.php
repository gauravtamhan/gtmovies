<?php
   include("config.php");
   session_start();
   $user = $_SESSION["current_user"];

	$error = "";
	$query = "SELECT Name, Street, City, State, Zip, Theater_ID FROM PREFERS NATURAL JOIN THEATER WHERE Username = '$user'";

	$result = mysqli_query($db, $query);
	$count = mysqli_num_rows($result);
	

	$name = array();
	$street = array();
	$city = array();
	$state = array();
	$zip = array();
	$theater = array();

	while ($row = mysqli_fetch_assoc($result)) {

    	array_push($name, $row["Name"]);
    	array_push($street, $row["Street"]);
    	array_push($city, $row["City"]);
    	array_push($state, $row["State"]);
    	array_push($zip, $row["Zip"]);
    	array_push($theater, $row["Theater_ID"]);

	} 


	if (isset($_POST['delete_theater']) && isset($_POST['theater_radio'])) {
		$theater = $_POST['theater_radio'];
		$query12 = "DELETE FROM PREFERS WHERE Theater_ID = '$theater' and Username = '$user'";
		mysqli_query($db,$query12);
		header("location: prefer_history.php");
	}
	  // print_r($orderIDs);
	  // echo $count;

	//aleta HSnAWhqJ


	//-------------------------------------------------- To Do: Calculate total order cost

	// $query2 = "SELECT Order_ID AS Order, Adult_tickets*Price + Child_tickets*(1-Child_discount)*Price + Senior_tickets*(1-Senior_discount)*Price AS Total_cost
	// FROM ORDERS, SYSTEM_INFO";

	// $result2 = mysqli_query($db, $query2);
	// $cnt = mysqli_num_rows($result2);

?>

<html>
	<head>
		<title>Saved Theaters</title>

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
	      		width: 700px;
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
	      	/*th.datatable, td.datatable {
	    		padding: 5px;
			}*/

			/*th.datatable {
				height: 55px;
				font-family: Georgia;
				font-size: 100px;
				border-bottom: 1px solid black;
			}*/

			td.datatable {
				height: 50px;
				text-align: center;
				font-family: Georgia;
				font-size: 20px;
			}
			td.datatabletheatername {
				height: 55px;
				text-align: center;
				font-family: Georgia;
				font-size: 25px;

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

			table.backbutton {
	            margin-top: 0px;
	            border-collapse: separate;
	            height: 50px;
	            width: 29.5%;
	            border: none;
	            border-spacing: 20px;
          	}

			.backbutton {
	            margin-top: 0px;
	            border-collapse: separate;
	            height: 50px;
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

          input[type=radio] {
          	margin-left: 15px;
          }
		</style>
	</head>
	<body>
		<h1> Saved Theaters </h1>
		
      

       <div style = "font-size:11px; color:#cc0000; margin-top:10px; height:30px"> <?php echo "$error" ?> </div>

		<table class="datatable" align="center">
			
			<?php
				$i = 0;
				?>
				<form action ="" method ="post">
				<?php
					while ($i < $count) {
						echo "<tr>";
							echo "<td rowspan="."2"."class="."datatable-selector"."> <input type=radio name='theater_radio' checked='checked' value='$theater[$i]' ></td>";
								echo "<td class="."datatabletheatername".">";
								echo $name[$i];
								echo "</td>";
							echo "</tr>";
							echo "<tr class="."datatable".">";
								echo "<td class="."datatable-address".">";
								
									echo $street[$i];
									echo "  ";
									echo $city[$i];
									echo "  ";
									echo $state[$i];
									echo ", ";
									echo $zip[$i];
								echo "</td>";

						echo "</tr>";
						$i++;
					}
				?>





		</table>
		
		
		<table align="center" class="button-black">
          <tr class="button-black">
            <td class="button-black">
              <a class="button"> <input type = "submit" name = "delete_theater" value ="Delete Theater"></a>
            </td>
          </tr>
        </table>
        <table align = "center" class="backbutton">
          <tr class="button">
            <td class="button">
              <a class="button" href="Me.php"> Back </a>
            </td>
          </tr>
        </table>
        </form>
	</body>
</html>
