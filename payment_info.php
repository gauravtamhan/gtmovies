<?php
   include("config.php");
   session_start();
   $user = $_SESSION["current_user"];
?>

<?php
	$query = "SELECT Card_No, Name_on_Card, Expiration_Date  FROM PAYMENT_INFO WHERE Username = '$user' AND Saved = 1 ";

	$result = mysqli_query($db, $query);
	$count = mysqli_num_rows($result);
	

	$card_no = array();
	$name_card = array();
	$expiration = array();

	while ($row = mysqli_fetch_assoc($result)) {

    	array_push($card_no, $row["Card_No"]);
    	array_push($name_card, $row["Name_on_Card"]);
    	array_push($expiration, $row["Expiration_Date"]);

	} 
	  // print_r($orderIDs);
	  // echo $count;
?>

<html>
	<head>
		<title>Payment Information</title>

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
		<h1> My Payment Infomation </h1>
		
		
		

		<table class="datatable" align="center">
			<tr class="datatable">
				<th class="datatable"> Select </th>
				<th class="datatable"> Card Number </th>
				<th class="datatable"> Name on Card </th>
				<th class="datatable"> Exp Date </th>
			</tr>
			<?php
				$i = 0;
				while ($i < $count) {
					echo "<tr class="."datatable".">";
						echo "<td class="."datatable".">";
							echo "<input type="."radio"." name="."A".">";
						echo "</td>";

						echo "<td class="."datatable".">";
							echo $card_no[$i];
						echo "</td>";

						echo "<td class="."datatable".">";
							echo $name_card[$i];
						echo "</td>";

						echo "<td class="."datatable".">";
							echo $expiration[$i];
						echo "</td>";

					echo "</tr>";
					$i++;
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

