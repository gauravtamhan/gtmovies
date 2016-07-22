<?php
   include("config.php");
   session_start();
   $user = $_SESSION['current_user'];
   $movie = $_SESSION['movie'];
?>

<?php   
   $query = "SELECT Name FROM THEATER, PREFERS WHERE PREFERS.Username = '$user' AND THEATER.Theater_ID = PREFERS.Theater_ID";

   $result = mysqli_query($db, $query);

   $count = mysqli_num_rows($result);

   $preferred_theaters = array();

   while ($row = mysqli_fetch_assoc($result)) {

      array_push($preferred_theaters, $row["Name"]);

   }

   // if(isset($_POST['choose'])) {
   //    if(isset($_POST['saved_theater'])){ 
   //       //header("location: search_theater_result.php");
   //    }
   // }


   // if(isset($_POST['search'])) {
   //    $_SESSION['theater'] = $_POST['user_input'];
   //    //header("location: search_theater_result.php");
   // }


?>
<html>
   
   <head>
      <title>Choose Theater</title>
      
      <style type = "text/css">
         h1 {
            font-style: italic;
            font-size: 50px;
            text-align: center;
            margin-top: 60px;
         }

         hr {
          width: 70%;
          margin-bottom: 50px
         }

         label {
               text-align: left;
            padding-top: 10px;
            padding-bottom: 1px;
            font-size: 20px;
            color: #4d4d4d;
            font-family: Verdana;
            width: 20%;
            display: inline-block;
         }

         .container {
            width: 500px;
            border: none;
            margin-top:30px;
            margin-left: 12%;
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
             margin-top: 20px;
             margin-right: 20px;
             overflow: hidden;
             padding: 5px 10px;
             text-overflow: ellipsis;
             white-space: nowrap;
             display: inline;
             width: 300px;

          }

         textarea {
            resize: none;
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

         textarea:focus {
            border: 1px solid black;
         }

         form {
            margin-top: 50px;
         }

         label {
            display: block;
            width: 70%
         }

         p {
            margin-left: 30%;
            font-style: italic;
            font-size: 30px;
            margin-top: 15%;
            margin-bottom: 15%;
         }

         input[type=text] {
             width: 60%;
             padding: 5px 10px;
             margin-top: 20px;
             margin-right: 20px;
             box-sizing: border-box;
             border: 1px solid #ccc;
             -webkit-transition: 0.5s;
             transition: 0.5s;
             outline: none;
             border-radius: 2px;
             font-family: Georgia;
             font-size: 15px;
             display: inline;
         }

         input[type=text]:focus {
             border: 1px solid black;
         }

         input[type=submit] {
            /*width: 60%;*/
            font-size: 15px;
            background-color: black;
            color: white;
            padding: 10px;
            border: none;
            font-family: Georgia;
            cursor: hand;
            border-radius: 3px;
            display: inline;
         }

         .backbutton {
            margin-top: 30px;
            border-collapse: separate;
        
            height: 50px;
            border: none;
            border-spacing: 20px;
          }

          table {
            margin-top: 10px;
            margin-bottom: 20px;
            border-collapse: separate;
            width: 30%;
            border: none;
            border-spacing: 10px;
          }

          th, td {
          border: 1px solid black;
          }

          td {
            /*height: 40px;*/
            text-align: center;
            width: 100%;
            font-family: Georgia;
            font-size: 16px;
          }

          a {
            display: block;
            width: 100%;
            padding: 8px 0px;
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
      <h1> Choose a Theater </h1>
      <hr>
      <div align = "center">
         <div class="container" align = "left">
          
				
            <div style = "margin:20px auto;">
               
               <form action = "" method = "post"> 
                  <label> Saved Theaters </label><select name="saved_theater">  
                                 <?php

                                    $i = 0;
                                    while ($i < $count) {
                                       $out = strlen($preferred_theaters[$i]) > 25 ? substr($preferred_theaters[$i],0,25)."..." : $preferred_theaters[$i];
                                       echo "<option value="."'".$preferred_theaters[$i]."'>".$out."</option>";
                                       $i++;
                                    }
                                 ?>                    
                              </select>
                  <input type = "submit" name= "choose" value ="Choose"/><br />
               </form>
               <!-- <br> -->
               <p> OR </p>
               <form action = "" method = "post"> 
                  <label> City/State/Theater </label>
                  <input type = "text" name= "user_input" placeholder="Search..." />
                  <input type = "submit" name= "search" value = " Search "/><br />
               </form>
               <br>
               <br>

            </div>
				
         </div>
			
      </div>

       <hr>
      <table align="center" class="backbutton">
         <tr>
            <td>
               <a href="movie.php?movie=<?php echo $movie ?>"> Back </a>
            </td>
         </tr>
      </table>

   </body>
</html>