<?php
	include("config.php");
	session_start();
	$showtime = $_SESSION['showtime'];
	$user = $_SESSION["current_user"];
   	$movie = $_SESSION["movie"];
   	$theater = $_SESSION["theater"];

   	// format the showtime
   	$date = date_create($showtime);
	$formattedDate = date_format($date, "l\, F j \@ g:ia");

	$adultTicketCount = $_SESSION["numAdultTickets"];
	$seniorTicketCount = $_SESSION["numSeniorTickets"];
	$childTicketCount = $_SESSION["numChildTickets"];

	// echo $user." bought ".$adultTicketCount." adult tickets, ".$seniorTicketCount." senior tickets, ".$childTicketCount." child tickets.";

  $error = "";
	$query = "SELECT Card_No, Name_on_Card, Expiration_Date  FROM PAYMENT_INFO WHERE Username = '$user' AND Saved = 1";

	$result = mysqli_query($db, $query);

	$count = mysqli_num_rows($result);
	
	$saved_cards = array();

	while ($row = mysqli_fetch_assoc($result)) {

    	array_push($saved_cards, $row["Card_No"]);
    	
	} 

  $error = "";
  if (isset($_SESSION["error_msg"])) {
    $error = $_SESSION["error_msg"];
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

		label.fancy {
         		text-align: left;
				padding-top: 10px;
				padding-bottom: 1px;
				font-size: 20px;
				color: #4d4d4d;
				font-family: Verdana;
				width: 180px;
				display: inline-block;
         }

         p.mini-head {
         	text-align: left;
			padding-top: 10px;
			padding-bottom: 1px;
			font-weight: bold;
			font-size: 20px;
			color: #4d4d4d;
			font-family: Verdana;
         }

         .container {
         	width: 620px;
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
             width: 120px;
          }

          input[type=submit].upper {
            font-size: 15px;
            background-color: black;
            color: white;
            padding: 7px 15px;
            border: none;
            font-family: Georgia;
            cursor: hand;
            border-radius: 3px;
            display: inline;
         }

         input[type=submit].lower {
            font-size: 15px;
            background-color: black;
            color: white;
            padding: 7px 15px;
            border: none;
            font-family: Georgia;
            cursor: hand;
            border-radius: 3px;
            display: block;
            margin: 20px 0px;
         }

         input[type=number]::-webkit-inner-spin-button, input[type=number]::-webkit-outer-spin-button { 
      		    -webkit-appearance: none;
      		    -moz-appearance: none;
      		    appearance: none;
      		    margin: 0; 
		    }

         input[type=text], input[type=number], input[type=date] {
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

         input[type=date] {
         	margin-bottom: 50px;
         }

         input[type=text]:focus, input[type=number]:focus, input[type=date]:focus {
             border: 1px solid black;
         }

         form.top {
         	border: 1px solid black;
         	padding-top: 20px;
         	padding: 20px;
         	padding-left: 40px;
         /*	width: 260px;
         	padding-left: 30px;	
         	padding-bottom: 10px;*/
         }

         form.bottom {
         	border: 1px solid black;
         	padding: 20px;
         	/*padding-left: 40px;*/
         /*	width: 260px;
         	padding-left: 30px;	
         	padding-bottom: 10px;*/
         }

         input[type = checkbox] {
         	font-size: 18px;
         	float: middle;
         	display: inline-block;
         	width: 20px;
         	
         }

         label.original {
         	display: inline-block;
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
      <h2> Payment Information </h2>

      <div align = "center">
         <div class="container" align = "left">
          
				
            <div style = "margin:20px">
               
               <form class="top" action = "confirmation.php" method = "post"> 
                  <label class="fancy"> Use a saved card </label><select name="saved_card">  
                                 <?php
                                    $i = 0;
                                    while ($i < $count) {
                                       $out = "****".substr($saved_cards[$i], -4);
                                       echo "<option value="."'".$saved_cards[$i]."'>".$out."</option>";
                                       $i++;
                                    }
                                 ?>                    
                              </select>
                  <input class="upper" type = "submit" name= "choose" value ='Use' />
               </form>
               <br>
             

               <form class="bottom" action = "confirmation.php" method = "post"> 
               		<p class="mini-head"> Use a new card </p>
                  <label class="fancy"> Name on Card </label><input type = "text" name= "nameOnCard" />
                  <label class="fancy"> Card Number </label><input type = "number" name= "cardNum" />
                  <label class="fancy"> CVV </label><input type = "number" name= "cardCVV" />
                  <label class="fancy"> Expiration Date </label><input type = "date" name= "cardExp" placeholder="yyyy-mm-dd"/>
                  <!-- <label style = "font-size:11px; color:#cc0000; margin-top:10px; margin-bottom: 30px"> <?php echo "$error" ?> </label><br/> -->

                  <!-- <div style = "font-size:11px; color:#cc0000; margin-top:10px"> <?php echo "$error" ?> </div> -->

                  <input type='checkbox' name='addToSavedCards' value='Yes' /> <label class='original'> Save this card for later use </label>
                  
                  <input class="lower" type = "submit" name= "search" value = 'Buy Ticket'/><br />
               </form>
               <br>
               <br>

            </div>
				
         </div>
			
      </div>
		
   </body>
   
</html>

