<?php
	include("config.php");
	session_start(); 
	$movie = $_SESSION['movie'];
	$user = $_SESSION['current_user'];
?>
<?php
$query12 = "SELECT Name FROM PREFERS, THEATER WHERE Username = '$user' AND PREFERS.Theater_ID = THEATER.Theater_ID";
$result2 = mysqli_query($db, $query12);
?>

<html>
	<head>
		<title>
			Buy Ticket 
		</title>

		<style>
			h1 {
				font-style: italic;
				font-size: 50px;
				text-align: center;
				padding-top: 50px;
			}

			p {
				text-align: left;
				padding-top: 20px;
				padding-bottom: 30px;
				font-size: 20px;
				color: grey;
				font-family: Verdana;
				width: 70%;
				display: inline-block;
			}

			.subheading {
				text-align: center;
				padding-top: 10px;
				padding-bottom: 1px;
				font-size: 30px;
				color: #4d4d4d;
				font-family: Verdana;
				width: 70%;
				display: inline-block;
			}

			.review {
				margin: 0px 0px 0px 0px;
			}

			hr {
				width: 70%;
			}

			.container {
				text-align: center;

			}

			table {
				margin-top: 90px;
	      		border-collapse: separate;
	      		width: 40%;
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
		<select name="exa" >
        <?php
        while ($row =  mysqli_fetch_assoc($result)) {
            echo '<option value="'.$row['ak_ex'].'">'.$row['ak_ex'].'</option>';
        }
        ?>
    </select>
	</body>
</html>