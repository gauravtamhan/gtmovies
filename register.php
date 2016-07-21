<?php
   include("config.php");
   session_start();

   
   if($_SERVER["REQUEST_METHOD"] == "POST") {
         echo "initially";
   		$count = 0;
   		$mang_pass_sql = "SELECT * FROM SYSTEM_INFO";
   		$mang_pass_result = mysqli_query($db, '$mang_pass_sql');
   		$mang_pass = $mang_pass_result[2];

      
      if ($_POST['password'] == "" || $_POST['conf_password'] == "" || $_POST['email'] == "" || $_POST['username'] == "") {
            echo "please privide";
      		$error = "Please provide input to all fields";
      } else if ($_POST['mymang_password'] != "" && $_POST['mymang_password'] != $mang_pass) {
      		$error = "Manager password is incorrect.";
      } else if ($_POST['password'] != $_POST['conf_password']) {
      		$error = "Password and Confirm Password do not match.";
      } else if ($_POST['mymang_password'] != "" && $_POST['mymang_password'] == $mang_pass) {
            $new_username = $_POST['username'];
            $new_email = $_POST['email'];
            $new_password = $_POST['password'];
            $new_user_qu = "SELECT * FROM MANAGER WHERE Username ='$new_username' or Email ='$new_email' ";
            $new_user_result = mysqli_query($db, $new_user_qu);
            $numb_rows = mysqli_num_rows($new_user_result);
            if ($numb_rows == 0) {
               $sql = "INSERT INTO MANAGER (Email, Username, Password) VALUES ('$new_username', '$new_email', '$new_password')";
               $result = mysqli_query($db, $sql);
               $error = "";
               header("location: home.php");
            } else {
               $error = "Username and Password already exists";
            }
      } else {
  
      		$new_username = $_POST['username'];
      		$new_email = $_POST['email'];
      		$new_password = $_POST['password'];
      		$new_user_qu = "SELECT * FROM CUSTOMER WHERE Username ='$new_username' or Email ='$new_email' ";
      		$new_user_result = mysqli_query($db, $new_user_qu);
      		$numb_rows = mysqli_num_rows($new_user_result);
      		if ($numb_rows == 0) {
      			$sql = "INSERT INTO CUSTOMER (Email, Username, Password) VALUES ('$new_username', '$new_email', '$new_password')";
				   $result = mysqli_query($db, $sql);
               $error = "";
					header("location: home.php");
				} else {
      			$error = "Username and Password already exists";
      		}
         

      }		

   }
?>
<html>
   
   <head>
      <title>Registeration Page</title>
      
      <style type = "text/css">
         body {
            font-family:Arial, Helvetica, sans-serif;
            font-size:14px;
         }
         
         label {
            font-weight:bold;
            width:100px;
            font-size:14px;
         }
         
         .box {
            border:#666666 solid 1px;
         }
      </style>
      
   </head>
   
   <body bgcolor = "#FFFFFF">
     <?php
         if(!isset($_POST['submit'])) {
            $error = "";
         }	
     ?>

      <div align = "center">
         <div style = "width:500px; border: solid 1px #333333; " align = "left">
            <div style = "background-color:#333333; color:#FFFFFF; padding:3px;"><b>Registration</b></div>
				
            <div style = "margin:30px">
               
               <form action = "" method = "post">
                  <label>UserName  	:</label><input type = "text" name = "username" class = "box"/><br /><br />
                  <label>Email Address  :</label><input type = "text" name = "email" class = "box"/><br /><br />
                  <label>Password  :</label><input type = "password" name = "password" class = "box" /><br/><br />
                  <label>Confirm Password  :</label><input type = "password" name = "conf_password" class = "box" /><br/><br />
                  <label>Manager Password  :</label><input type = "password" name = "mymang_password" class = "box" /><br/><br />
                  <input type = "submit" value = " Create "/><br />
               </form>


               <div style = "font-size:11px; color:#cc0000; margin-top:10px"> <?php echo "$error" ?> </div>
					
            </div>
				
         </div>
			
      </div>

   </body>
</html>