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

?>

<?php 
	if ($_SERVER["REQUEST_METHOD"] == "POST") {
		$numAdultTickets = $_POST["AdultTickets"];
		$numSeniorTickets = $_POST["SeniorTickets"];
		$numChildTickets = $_POST["ChildTickets"];

		
		$_SESSION["numAdultTickets"] = $numAdultTickets;
		$_SESSION["numSeniorTickets"] = $numSeniorTickets;
		$_SESSION["numChildTickets"] = $numChildTickets;
		
		header("location: payment_info.php");
	}
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

		h2 {
			text-align: center;
			padding-top: 10px;
			padding-bottom: 1px;
			font-size: 35px;
			color: #4d4d4d;
			font-family: Verdana;
			font-style: italic;
			font-weight: lighter;
			/*width: 70%;
			display: inline-block;*/
		}

		hr {
			width: 60%;
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

		label {
         		text-align: left;
				padding-top: 10px;
				padding-bottom: 1px;
				font-size: 20px;
				color: #4d4d4d;
				font-family: Verdana;
				width: 20%;
				display: inline;
         }

         .container {
         	width: 500px;
         	border: none;
         	margin-top:30px;
         }

         select {
             -webkit-appearance: button;
             -webkit-border-radius: 2px;
             -webkit-box-shadow: 0px 1px 3px rgba(0, 0, 0, 0.1);
             -webkit-padding-end: 20px;
             -webkit-padding-start: 2px;
             -webkit-user-select: none;
             background-image: url(http://i62.tinypic.com/15xvbd5.png), -webkit-linear-gradient(#FAFAFA, #F4F4F4 40%, #E5E5E5);
             background-position: 97% center;
             background-repeat: no-repeat;
             border: 1px solid #AAA;
             color: #555;
             font-size: inherit;
             margin: 20px;
             overflow: hidden;
             padding: 5px 10px;
             text-overflow: ellipsis;
             white-space: nowrap;
             width: 60px;
          }

          input[type=submit] {
            width: 60%;
            font-size: 15px;
            background-color: black;
            border-radius: 3px;
            color: white;
            margin-top:40px;
            margin-left: 35px;
            padding: 10px;
            border: none;
            font-family: Georgia;
            cursor: hand;
            
         }

         form {
         	border: 1px solid black;
         	width: 260px;
         	padding-left: 30px;	
         	padding-bottom: 10px;
         }
      </style>

   </head>
   
   <body>
      <h1> Buy a Ticket </h1>
      <hr>
      <p class="subtitle"> Movie: <?php echo $movie?> </p>
      <p class="subtitle"> Location: <?php echo $theater?> </p>
      <p class="subtitle"> Date: <?php echo $formattedDate?> </p>
      <hr>
      <h2> Select the Amount </h2>

      <div align = "center">
         <div class="container" align = "left">
            
				
            <div style = "margin-left:100px; margin-bottom:50px;">
               
               <form action = "" method = "post">
                  <label> Adult Tickets</label> <select name="AdultTickets">
                  						<option value = "0"> 0 </option>
                  						<option value = "1"> 1 </option>
                  						<option value = "2"> 2 </option>
                  						<option value = "3"> 3 </option>
                  						<option value = "4"> 4 </option>
                  						<option value = "5"> 5 </option> </select> <br>
               	  <label> Senior Tickets</label> <select name="SeniorTickets">
                  						<option value = "0"> 0 </option>
                  						<option value = "1"> 1 </option>
                  						<option value = "2"> 2 </option>
                  						<option value = "3"> 3 </option>
                  						<option value = "4"> 4 </option>
                  						<option value = "5"> 5 </option> </select> <br>
                  <label> Child Tickets</label> <select name="ChildTickets">
                  						<option value = "0"> 0 </option>
                  						<option value = "1"> 1 </option>
                  						<option value = "2"> 2 </option>
                  						<option value = "3"> 3 </option>
                  						<option value = "4"> 4 </option>
                  						<option value = "5"> 5 </option> </select> <br>
                  <input type = "submit" value = "Submit"/>
               </form>
					
            </div>
				
         </div>
			
      </div>

		
   </body>
   
</html>