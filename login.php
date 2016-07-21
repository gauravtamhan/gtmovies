<?php
   include("config.php");
   session_start();
   
   if($_SERVER["REQUEST_METHOD"] == "POST") {
      // username and password sent from form 
      
      $myusername = mysqli_real_escape_string($db,$_POST['username']);
      $mypassword = mysqli_real_escape_string($db,$_POST['password']); 
      
      $sql = "SELECT * FROM CUSTOMER WHERE Username = '$myusername' and Password = '$mypassword'";
      $result = mysqli_query($db, $sql);
      $row = mysqli_fetch_assoc($result);
      
      $count = mysqli_num_rows($result);
      echo $count;

      $user = array();

      
      
      // If result matched $myusername and $mypassword, table row must be 1 row
		
      if($count == 1) {
         $_SESSION['current_user'] = $myusername;
         header("location: home.php");
      } else {
         $error = "Your Username or Password is invalid";
      }
   }
?>
<html>
   
   <head>
      <title>Login Page</title>
      
      <style type = "text/css">
         body {
           /* background-image: url("tower.jpg");
            background-repeat: no-repeat;
            background-position: center;
            background-size: cover;*/
         }
         
         h1 {
            font-style: italic;
            font-size: 50px;
            text-align: center;
            margin-top: 80px;
         }

         .registerbutton {
            margin-top: 0px;
            border-collapse: separate;
        
            height: 50px;
            border: none;
            border-spacing: 20px;
          }

          table {
            margin-top: 10px;
            border-collapse: separate;
            width: 100%;
            border: none;
            border-spacing: 10px;
          }

          th, td {
          border: 1px solid black;
          }

          td {
            height: 40px;
            text-align: center;
            width: 100%;
            font-family: Georgia;
            font-size: 15px;
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

         label {
            font-weight:bold;
            width:100px;
            font-size:14px;
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
         }
      </style>
      
   </head>
   
   <body bgcolor = "#FFFFFF">
	<?php
      if (!isset($_POST['submit'])) {
         $error = "";
         // echo $_POST['submit'];
      }
   ?>
   <h1> GT Movies </h1>
      <div align = "center">
         <div style = "width:300px; border: none; margin-top:80px" align = "left">
				
            <div style = "margin:20px">
               
               <form action = "" method = "post">
                  <input type = "text" name = "username" placeholder="Username" />
                  <input type = "password" name = "password" placeholder="Password" />
                  <input type = "submit" value = "Log In" /><br />
               </form>
               <table align="center" class="registerbutton">
                  <tr>
                    <td>
                      <a href="register.php"> Register </a>
                    </td>
                  </tr>
                </table>
               
               <div style = "font-size:11px; color:#cc0000; margin-top:10px; height:30px"> <?php echo "$error" ?> </div>
					
            </div>
				
         </div>
			
      </div>

   </body>
</html>