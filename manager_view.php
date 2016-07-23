<?php
	include("config.php");
	session_start();
	$user = $_SESSION['current_user'];
?>

<html>
	<head>
		<title>Manager Portal</title>

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

			p.subtitle {
				font-size: 25px;
				font-family: Georgia;
				font-style: italic;
				padding-top: 5px;
				padding-left: 5px;
				/*display: inline-block;*/
				text-align: center;
				color: #4d4d4d;
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
				/*height: 50px;*/
				text-align: center;
				width: 30%;
				font-family: Georgia;
				font-size: 20px;
			}
			a {
				display: block;
				width: 100%;
				padding: 10px 0px;
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
		<h1> Manager Portal </h1>
		<p class="subtitle"> Choose Functionality</p>
		

		<table align="center">
			<tr>
				<td>
					<a href="revenue_report.php"> View Revenue Report </a>
				</td>
			</tr>
			<tr>
				<td>
					<a href="movie_report.php"> View Popular Movie Report </a>
				</td>
			</tr>
			<tr>
				<td>
					<a href="logout.php"> Log Out </a>
				</td>
			</tr>
		</table>
	</body>
</html>
