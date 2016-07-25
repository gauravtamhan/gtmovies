<?php
   include("config.php");
   session_start();
   $Order_ID = $_SESSION['order_ID'];
   //$Order_ID_valid = $_SESSION['order_valid'];

   $error = "";
   $refund = "";

  //Orders queries
   $query = "SELECT * FROM ORDERS WHERE Order_ID = '$Order_ID'";
   $result = mysqli_query($db, $query);
   $row = mysqli_fetch_assoc($result);

   $movie_title = $row['Movie_title'];
   $theater_ID = $row['Theater_ID'];
   $movie_date = $row['Date'];
   $movie_time = $row['Time'];
   $movie_time_arr = explode(":", $movie_time);
   $movie_time_hour = intval($movie_time_arr[0]);
   $movie_time_min = $movie_time_arr[1];
   $numb_adults = intval($row['Adult_Tickets']);
   $numb_children = intval($row['Child_Tickets']);
   $numb_seniors = intval($row['Senior_Tickets']);
   $date = $row['Date'];
   $time = $row['Time'];
   $status = trim($row['Status']);

   $showtime = $row['Order_Showtime'];

   // format the showtime
    $date = date_create($showtime);
    $formattedShowtime = date_format($date, "l\, F j \@ g:ia");


   //Theater queries
   $query_theater = "SELECT * FROM THEATER WHERE Theater_ID = '$theater_ID'";
   $result_theater = mysqli_query($db, $query_theater);
   $row_theater = mysqli_fetch_assoc($result_theater);

   $theater_name = $row_theater['Name'];
   $theater_street = $row_theater['Street'];
   $theater_state = $row_theater['State'];
   $theater_city = $row_theater['City'];
   $theater_zip = $row_theater['Zip'];

   //Movie queries
   $query_movie = "SELECT * FROM MOVIE WHERE Title = '$movie_title'";
   $result_movie = mysqli_query($db, $query_movie);
   $row_movie = mysqli_fetch_assoc($result_movie);

   $movie_rating = $row_movie['Rating'];
   $movie_length = $row_movie['Length'];
   // $movie_duration = date_create($movie_length);
   // $formatted_movie_duration = date_format($movie_duration, "h 'hr' i 'min'"); // h \h\r i \m\i\n

   //System Info queries
   $query_sys_info = "SELECT * FROM SYSTEM_INFO";
   $result_sys_info = mysqli_query($db, $query_sys_info);
   $row_sys_info = mysqli_fetch_assoc($result_sys_info);
   // echo floatval($row_sys_info['Price']). '<br>';
   // echo gettype(floatval($row_sys_info['Price'])). '<br>';
   // echo (float)$numb_adults. '<br>';
   // echo gettype((float)$numb_adults). '<br>';
   // echo $row_sys_info['Cancellation_fee']. '<br>';
   // echo $row_sys_info['Child_discount']. '<br>';
   // echo $row_sys_info['Senior_discount']. '<br>';
   $cancel_fee = floatval($row_sys_info['Cancellation_fee']);
   $child_dis = floatval($row_sys_info['Child_discount']);
   $senior_dis = floatval($row_sys_info['Senior_discount']);
   $price = floatval($row_sys_info['Price']);
   $cancel_fee = ($row_sys_info['Cancellation_fee']);
   $child_dis = ($row_sys_info['Child_discount']);
   // echo (1.00 - $child_dis). '<br>';
   // echo gettype(1.00-$child_dis);
   $senior_dis = ($row_sys_info['Senior_discount']);
   $price = ($row_sys_info['Price']);

   //Showtime queries 
   $query_sys_info = "SELECT * FROM SHOWTIME WHERE Theater_ID ='$theater_ID' and Movie_title ='$movie_title' and Showtime = ''";
   $result_showtime = mysqli_query($db, $query_sys_info);
   $row_sys_showtime = mysqli_fetch_assoc($result_showtime);

   // $showtime = date("F j, Y, g:i a", strtotime($date . " " . $time));
   // echo $showtime;
   //Total price 
   $total_price = (float)$numb_adults * $price + (float)$numb_children * ($price * (1.00 - $child_dis)) + (float)$numb_seniors * ($price * (1.00 - $senior_dis));
   $formattedPrice = number_format($total_price, 2, '.', ',');
   // echo $formattedPrice. '<br>';
   // echo gettype($total_price);

   if (isset($_POST['cancel']) && $status == "Cancelled") {
      $error = "The order has already been cancelled.";
   } else if (isset($_POST['cancel']) && $status == "Used") { //time() > strtotime($date . " " . $time)
      $error = "The order cannot be cancelled since the movie's start time has passed.";
   } else if (isset($_POST['cancel'])) {
      $refund_amount = $total_price - $cancel_fee;
      if ($refund_amount < 0) {
        $refund_amount = 0;
      }
      $formattedrefund = number_format($refund_amount, 2, '.', ',');
      $query_refund = "UPDATE ORDERS SET Status = 'Cancelled' WHERE Order_ID = '$Order_ID'";
      $result_movie = mysqli_query($db, $query_refund);
      $refund = "The order has been cancelled. Total refund is $" . $formattedrefund  . ".";
   }


?>
<html>
   
   <head>
      <title>Order Detail</title>
      <style type = "text/css">
         
         h1 {
            font-style: italic;
            font-size: 50px;
            text-align: center;
            margin-top: 40px;
         }

         hr {
          width: 60%;
         }

        h2 {
            font-size: 30px;
            text-align: center;
            margin-top: 5px;
         }

        h3 {
            font-weight:normal;
            width:400px;
            font-size:20px;
            margin-top: 5px;
         }

         .registerbutton {
            margin-top: 0px;
            border-collapse: separate;
            height: 50px;
            border: none;
            border-spacing: 20px;
          }

          table.data {
            margin-top: 10px;
            border-collapse: separate;
            width: 100%;
            border: none;
            border-spacing: 10px;
          }

          td.data {
            /*height: 40px;*/
            text-align: center;
            width: 100%;
            font-family: Georgia;
            font-size: 15px;
          }

          a {
            display: block;
            width: 100%;
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
          a.button {
            width: 100%;
            padding: 10px 0px;
            /*border: 1px solid black;*/
          }

         label {
            font-weight:normal;
            width:100px;
            font-size:20px;
            margin-top: 5px;
         }

        label.red {
            font-weight:normal;
            width:100px;
            font-size:20px;
            margin-top: 5px;
            color: red;
         }
         

         input[type=text], input[type=password]{
             width: 100%;
             padding: 10px 10px;
             margin-bottom: 8px;
             box-sizing: border-box;
             border: 1px solid #ccc;
             -webkit-transition: 0.5s;
             transition: 0.5s;
             outline: none;
             border-radius: 2px;
             font-family: Georgia;
             font-size: 15px;
         }

         input[type=text]:focus, input[type=password]:focus {
             border: 1px solid black;
         }

         input[type=submit] {
            width: 100%;
            font-size: 15px;
            background-color: black;
            color: white;
            padding: 10px;
            border: none;
            font-family: Georgia;
            cursor: hand;
         }

          .backbutton {
              margin-top: 0px;
              border-collapse: separate;
              height: 50px;
              /*border: 1px solid black;*/
              border-spacing: 5px;
          }

          table.backbutton {
              margin-top: 0px;
              border-collapse: separate;
              height: 50px;
              width: 29.5%;
              border: none;
              border-spacing: 5px;
            }

          td.button {
            border: 1px solid black;
            text-align: center;
          }

          table.button {
            margin-top: 60px;
            border-collapse: separate;
            width: 30%;
            border: none;
            border-spacing: 20px;
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

      </style>
      
   </head>
   
   <body bgcolor = "#FFFFFF">
      <div class="container" align ="center">
          <h1> Order Detail </h1>
          <hr>
          <table>
            <th>
              <table class="data">
                <tr>
                  <th> 
                    <h2> <?php echo $movie_title?><br/>
                        <label> <?php echo $movie_rating . " | Duration: " . $movie_length ?><br/></label>
                        <label><?php echo $formattedShowtime?></label>
                    </h2> 
                  </th>
                  <th> 
                    <h2> <?php echo $theater_name ?><br/>
                      <label><?php echo $theater_street ?></label><br/>
                      <label><?php echo $theater_city . ", " . $theater_state . ", " .  $theater_zip ?></label>
                    </h2>
                  </th>
                </tr>
                <tr>
                  <th> 
                    <h3> <?php echo $numb_adults . " adult tickets"?><br/>
                             <?php 
                                if ($numb_children > 0) {
                                  echo $numb_children . " child tickets";
                             ?>
                             <br/>
                             <?php
                                }
                             ?>
                            <?php 
                                if ($numb_seniors > 0) {
                                  echo $numb_seniors . " senior tickets";
                             ?>
                             <br/>
                             <?php
                                }
                             ?>
                             <b><?php echo "Total price: $" . $formattedPrice?><b/><br/>

                    </h3> 
                  </th>
                </tr>
              </table>


        </div>
          <label><?php echo $refund?></label>
          <label class="red"> <?php echo $error ?> </label>

        <table align="center" class="button-black">
          <tr class="button-black">
            <td class="button-black">
              <form action = "" method = "post"> 
                <a> <input type = "submit" name= "cancel" value = 'Cancel this order'/></a>
             </form>
            </td>
          </tr>
        </table>

        <table align="center" class="backbutton">
          <tr class="button">
            <td class="button">
              <a class="button" href="order_history.php"> Back </a>
            </td>
          </tr>
          </table>
   </body>
</html>