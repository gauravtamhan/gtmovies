<?php
	include("config.php");
	session_start();
	$user = $_SESSION['current_user'];
?>

<?php
  $query = "(SELECT MONTH(`Date`) AS Month, Movie_title AS Movie, COUNT(*) AS Orders FROM `ORDERS` WHERE MONTH(`Date`) = 5 GROUP BY Movie_title ORDER BY COUNT(*) LIMIT 3) UNION (SELECT MONTH(`Date`) AS Month, Movie_title, COUNT(*) AS Orders FROM `ORDERS` WHERE MONTH(`Date`) = 6 GROUP BY Movie_title ORDER BY COUNT(*) LIMIT 3) UNION (SELECT MONTH(`Date`) AS Month, Movie_title, COUNT(*) AS Orders FROM `ORDERS` WHERE MONTH(`Date`) = 7 GROUP BY Movie_title ORDER BY COUNT(*) LIMIT 3) UNION (SELECT MONTH(`Date`) AS Month, Movie_title, COUNT(*) AS Orders FROM `ORDERS` WHERE MONTH(`Date`) = 8 GROUP BY Movie_title ORDER BY COUNT(*) LIMIT 3)";
  $result = mysqli_query($db, $query);
?>

<html>
	<head>
		<title>Popular Movie Report</title>

		<style>
			h1 {
				font-style: italic;
				font-size: 50px;
				text-align: center;
				padding-top: 30px;
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
		<h1> View Popular Movie Report </h1>


		<table class="datatable" align="center">
	      <tr class="datatable">
	        <th class="datatable">Month</th>
	        <th class="datatable">Movie</th>
	        <th class="datatable">Orders</th>
	      </tr>
		      <?php
		         while ($row = mysqli_fetch_array($result)) {
		           echo "<tr class="."datatable".">";
		           echo "<td class="."datatable".">".$row['Month']."</td>";
		           echo "<td class="."datatable".">".$row['Movie']."</td>";
		           echo "<td class="."datatable".">".$row['Orders']."</td>";
		           echo "</tr>";
		         }
		      ?>
		  </table>

	    	<table align="center" class="button backbutton">
	          <tr class="button">
	            <td class="button">
	              <a class="button" href="manager_view.php"> Back </a>
	            </td>
	          </tr>
	        </table>

	</body>
</html>
