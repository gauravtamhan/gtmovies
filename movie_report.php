<?php
	include("config.php");
	session_start();
	$user = $_SESSION['current_user'];
?>

<?php
  $query = "SELECT DATENAME(MONTH(`Date`), S0.OrderDateTime) AS Month, Movie, COUNT(*) AS Orders FROM ORDER WHERE MONTH(`Date`) = 5 GROUP BY Movie ORDER BY COUNT(*) LIMIT 3
UNION ALL
SELECT DATENAME(MONTH(`Date`), S0.OrderDateTime) AS Month, Movie, COUNT(*) AS Orders FROM ORDER WHERE MONTH(`Date`) = 6 GROUP BY Movie ORDER BY COUNT(*) LIMIT 3
UNION ALL
SELECT DATENAME(MONTH(`Date`), S0.OrderDateTime) AS Month, Movie, COUNT(*) AS Orders FROM ORDER WHERE MONTH(`Date`) = 7 GROUP BY Movie ORDER BY COUNT(*) LIMIT 3
UNION ALL
SELECT DATENAME(MONTH(`Date`), S0.OrderDateTime) AS Month, Movie, COUNT(*) AS Orders FROM ORDER WHERE MONTH(`Date`) = 8 GROUP BY Movie ORDER BY COUNT(*) LIMIT 3
";
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
		<h1> View Popular Movie Report </h1>
		<hr>
		<h3> <?php echo $user ?> </h3>
		<hr>



		<table align="center">
      <tr class="header">
        <td>Month</td>
        <td>Movie</td>
        <td>Orders</td>
      </tr>
      <?php
         while ($row = mysql_fetch_array($query)) {
           echo "<tr>";
           echo "<td>".$row[Month]."</td>";
           echo "<td>".$row[Movie]."</td>";
           echo "<td>".$row[Orders]."</td>";
           echo "</tr>";
         }
      ?>
	</body>
</html>
