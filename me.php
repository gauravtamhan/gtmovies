<?php
	include("config.php");
	session_start(); 
	$user = $_SESSION['current_user'];
?>

<html>
	<head>
		<title>Me</title>

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
		<h1> Me </h1>
		<hr>
		<h3> <?php echo $user ?> </h3>
		<hr>
		
		

		<table align="center">
			<tr>
				<td>
					<a href="order_history.php"> My Order History </a>
				</td>
			</tr>
			<tr>
				<td>
					<a href="payment_history.php"> My Payment Information </a>
				</td>
			</tr>
			<tr>
				<td>
					<a href="prefer_history.php"> My Preferred Theater </a>
				</td>
			</tr>
			<tr>
				<td>
					<a href="home.php"> Back to Now Playing</a>
				</td>
			</tr>
		</table>
	</body>
</html>
