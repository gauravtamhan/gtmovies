<?php
	include("config.php");
	session_start();
	$_SESSION['showtime'] = $_GET['showtime'];
	$showtime = $_SESSION['showtime'];
	$user = $_SESSION["current_user"];
   	$movie = $_SESSION["movie"];
   	$theater = $_SESSION["theater"];

   	// format the showtime
   	$date = date_create($showtime);
	$formattedDate = date_format($date, "l\, F j \@ g:ia");

	echo "You picked this show time: ".$formattedDate;
?>

<html>
   
   <head>
      <title>Buy Tickets</title>

      <style>
      	h1 {
			font-style: italic;
			font-size: 50px;
			text-align: center;
			padding-top: 20px;
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

		p.error {
			font-size: 20px;
			font-family: Verdana;
			font-style: italic;
			margin-top: 10%;
			padding-top: 40px;
			padding-left: 100px;
			padding-right: 100px;
			text-align: center;
			color: grey;
		}
		p.error2 {
			font-size: 20px;
			font-family: Verdana;
			font-style: italic;
			padding: 0px 100px;
			text-align: center;
			color: grey;
		}

		table.backbutton {
            margin-top: 0px;
            border-collapse: separate;
            height: 50px;
            width: 29.5%;
            border: none;
            border-spacing: 20px;
	   	}

      	table {
      		border-collapse: separate;
      		border: none;
      		border-spacing: 20px;
      		width: 50%;
      	}

      	th, td {
    		border: 1px solid black;
		}

		td {

			/*height: 50px;*/
			text-align: center;
			width: 50%;
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
      <center><h1> Buy a Ticket </h1> </center>
      <p class="subtitle"> for <?php echo $movie?> at <?php echo $theater?> on <?php echo $formattedDate?></p>
      
		<table align="center" class="backbutton">
          <tr class="button">
            <td class="button">
              <a class="button" href="#"> Next </a>
            </td>
          </tr>
        </table>
		
   </body>
   
</html>