<?php
	include("config.php");
	session_start();
	$user = $_SESSION['current_user'];
?>

<?php
  $query = "SELECT DATENAME(MONTH(`Date`), S0.OrderDateTime) AS Month, SUM(Total_cost) AS Revenue FROM ORDER GROUP BY MONTH(`Date`) ORDER BY MONTH(`Date`)";
  $result = mysqli_query($query);
?>

<html>
	<head>
		<title>Revenue Report</title>

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
			table {
				margin-top: 60px;
	      		border-collapse: separate;
	      		width: 50%;
	      		border: none;
	      		border-spacing: 20px;
	      	}
	      	th, td {
	    		border: 1px solid black;
			}
			td {
				height: 50px;
				text-align: center;
				width: 30%;
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
		<h1> View Revenue Report </h1>
		<hr>
		<h3> <?php echo $user ?> </h3>
		<hr>



		<table align="center">
      <tr class="header">
        <td>Month</td>
        <td>Revenue</td>
      </tr>
      <?php
         while ($row = mysqli_fetch_array($result)) {
           echo "<tr>";
           echo "<td>".$row[Month]."</td>";
           echo "<td>".$row[Revenue]."</td>";
           echo "</tr>";
         }
      ?>
    </table>
	</body>
</html>
