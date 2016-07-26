<?php
   include("config.php");
   session_start();
   $user = $_SESSION["current_user"];

	$error = "";

	$sql = "UPDATE ORDERS SET Status = 'Used' WHERE Order_Showtime < NOW() AND Username = '$user' AND Status = 'Unused'";
	mysqli_query($db, $sql);

	$query = "SELECT Order_ID, Movie_title, Status FROM ORDERS WHERE Username = '$user'";

	$result = mysqli_query($db, $query);
	$count = mysqli_num_rows($result);
	

	$orderIDs = array();
	$movie_titles = array();
	$statuses = array();

	while ($row = mysqli_fetch_assoc($result)) {

    	array_push($orderIDs, $row["Order_ID"]);
    	array_push($movie_titles, $row["Movie_title"]);
    	array_push($statuses, $row["Status"]);

	} 

	if (isset($_POST['search'])) {
		$Order_ID_input = trim($_POST['Order_ID']);
		$Order_ID_query = "SELECT Order_ID FROM ORDERS WHERE Order_ID = '$Order_ID_input'";
		$Order_ID_result = mysqli_query($db, $Order_ID_query);
		$count_row = mysqli_num_rows($Order_ID_result);
		if ($count_row == 0) {
			$error = "The Order ID was not found";
		} else {
			$_SESSION['order_ID'] = $Order_ID_input;
			$_SESSION['order_valid'] = 1;
			header("location: order_detail.php");
		}

	}

	if (isset($_POST['view_detail']) && isset($_POST['order_radio'])) {
		$_SESSION['order_ID'] = $_POST['order_radio'];
		header("location: order_detail.php");
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
				margin-top: 20px;
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

			
			table.button-black {
				margin-top: 60px;
	      		border-collapse: separate;
	      		width: 30%;
	      		border: none;
	      		border-spacing: 5px;
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
	      		border-spacing: 5px;
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
	            border-spacing: 5px;
          	}

			.backbutton {
	            margin-top: 0px;
	            border-collapse: separate;
	            height: 50px;
	            border: none;
	            border-spacing: 5px;
          }

          input[type=submit].details {
            width: 100%;
            font-size: 18px;
            background-color: black;
            color: white;
            padding: 10px;
            border: none;
            font-family: Georgia;
            cursor: hand;
         }

         input[type=submit].search {
            /*width: 20%;*/
            font-size: 18px;
            border-radius: 3px;
            background-color: black;
            color: white;
            padding: 6px 20px;
            border: none;
            font-family: Georgia;
            cursor: hand;
         }

         label.fancy {
     		text-align: left;
			padding-top: 10px;
			padding-bottom: 1px;
			font-size: 20px;
			color: #4d4d4d;
			font-family: Verdana;
			width: 80px;
			display: inline-block;
         }

         input[type=number]::-webkit-inner-spin-button, input[type=number]::-webkit-outer-spin-button { 
  		    -webkit-appearance: none;
  		    -moz-appearance: none;
  		    appearance: none;
  		    margin: 0; 
		 }

         input[type=number] {
             width: 300px;
             padding: 5px 10px;
             margin-top: 20px;
             margin-left: 20px;
             margin-right: 20px;

             box-sizing: border-box;
             border: 1px solid #ccc;
             -webkit-transition: 0.5s;
             transition: 0.5s;
             outline: none;
             border-radius: 2px;
             font-family: Georgia;
             font-size: 15px;
             display: inline-block;
         }

         input[type=number]:focus {
             border: 1px solid black;
         }

         form.top {
         	/*border: 1px solid black;*/
         	padding-top: 20px;
         	/*padding: 20px;*/
         	/*padding-left: 40px;*/
         	width: 100%;
         	/*padding-left: 30px;	*/
         	padding-bottom: 0px;
         	text-align: center;
         }

		</style>
	</head>
	<body>
		<h1> Order History </h1>
		
       <form class="top" action = "" method = "post"> 
          <label class="fancy"> Order_ID </label>
          <input type = "number" name= "Order_ID" placeholder="Search..." />
          <input type = "submit" class="search" name= "search" value = 'Search'/><br />
       </form>

       <div style = "font-size:11px; color:#cc0000; margin-top:10px; height:30px; text-align:center;"> <?php echo "$error" ?> </div>

		<table class="datatable" align="center">
			<tr class="datatable">
				<th class="datatable"> Select </th>
				<th class="datatable"> Order ID </th>
				<th class="datatable"> Movie </th>
				<th class="datatable"> Status </th>
			</tr>
			<?php
				$i = 0;
				?>
				<form action ="" method ="post">
				<?php
					while ($i < $count) {
						echo "<tr class="."datatable".">";
							echo "<td class="."datatable".">";
								echo "<input type=radio name='order_radio' checked='checked' value='$orderIDs[$i]' >";
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
		
		
		<table align="center" class="button-black">
          <tr class="button-black">
            <td class="button-black">
              <a class="button"> <input class="details" type = "submit" name = "view_detail" value ="View Details"></a>
            </td>
          </tr>
      	</table>

      	<table align='center' class="backbutton">
          <tr class="button backbutton">
            <td class="button">
              <a class="button" href="Me.php"> Back </a>
            </td>
          </tr>
        </table>
</form>
	</body>
</html>

