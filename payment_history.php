<?php
   include("config.php");
   session_start();
   $user = $_SESSION["current_user"];

	$error = "";
	$query = "SELECT Card_No, Name_on_Card, Expiration_Date  FROM PAYMENT_INFO WHERE Username = '$user' AND Saved = 1 ";

	$result = mysqli_query($db, $query);
	$count = mysqli_num_rows($result);
	

	$cardno = array();
	$nameoncard = array();
	$expdate = array();

	while ($row = mysqli_fetch_assoc($result)) {

    	array_push($cardno, $row["Card_No"]);
    	array_push($nameoncard, $row["Name_on_Card"]);
    	array_push($expdate, $row["Expiration_Date"]);

	} 


	if (isset($_POST['delete_card']) && isset($_POST['order_radio'])) {
		$card = $_POST['order_radio'];
		$query12 = "DELETE FROM PAYMENT_INFO WHERE Card_No = '$card'";
		mysqli_query($db,$query12);
		header("location: payment_history.php");
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
		<title>Payment Saved</title>

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
		<h1> Payment Saved </h1>
		
      

       <div style = "font-size:11px; color:#cc0000; margin-top:10px; height:30px"> <?php echo "$error" ?> </div>

		<table class="datatable" align="center">
			<tr class="datatable">
				<th class="datatable"> Select </th>
				<th class="datatable"> Card Number </th>
				<th class="datatable"> Name on Card </th>
				<th class="datatable"> Expiration Date </th>
			</tr>
			<?php
				$i = 0;
				?>
				<form action ="" method ="post">
				<?php
					while ($i < $count) {
						echo "<tr class="."datatable".">";
							echo "<td class="."datatable".">";
								echo "<input type=radio name='order_radio' value='$cardno[$i]' >";
							echo "</td>";

							echo "<td class="."datatable".">";
								echo $cardno[$i];
		
							echo "</td>";

							echo "<td class="."datatable".">";
								echo $nameoncard[$i];
							echo "</td>";

							echo "<td class="."datatable".">";
								echo $expdate[$i];
							echo "</td>";

						echo "</tr>";
						$i++;
					}
				?>





		</table>
		
		
		<table align="center" class="button backbutton">
          <tr class="button">
            <td class="button">
              <a class="button"> <input type = "submit" name = "delete_card" value ="Delete Card"></a>
            </td>
          </tr>
          <tr class="button">
            <td class="button">
              <a class="button" href="Me.php"> Back </a>
            </td>
          </tr>
        </table>
        </form>
	</body>
</html>

