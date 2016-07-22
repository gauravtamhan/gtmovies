<?php
   include("config.php");
   session_start();
   // $user_input = $_SESSION["user_input"];
   //$current_user = $_SESSION["user_input"];
       
			
  		//$user_input = echo 'name1';
		$query = "SELECT Theater_ID, Name, Street, City, State, Zip FROM THEATER";
			//WHERE Name = '$user_input' or City = '$user_input' or State = '$user_input'";

		$result = mysqli_query($db, $query);

		$error = "";

		if(isset($_POST['next'])) {
			if(!empty($_POST['check_list'])){ 
				$_SESSION["theater_ID"] = $_POST['check_list'][0];
			}
			if (isset($_POST['check_box']) && !empty($_POST['check_list'])) {
				//$prefered_qu = "INSERT INTO PREFERS VALUES ('$theaterID', )";
			} else if (isset($_POST['check_box']) && empty($_POST['check_list'])) {
				$error = "Please select a theater to save.";
			}

		}		

?>




<html>
   
   <head>
      <title> Search Theater Result </title>

   </head>
   
   <body>
   		
   		
   			<hr>
      <center><h1> Results </h1> </center>     


			 <form id="theater"  action="search_theater_result.php"  method="post">


				<?php  
					while ($row = mysqli_fetch_row($result)) {
						$theater_name = $row[1];
						$theater_address = $row[2] . ", " . $row[3] . ", " . $row[4] . ", " . $row[5];
						$theater_ID = $row[0];
				?>
							<input type="radio" name= "check_list[]" value="<?php echo $theater_ID; ?>"> <?php echo  $theater_name; ?><br />
							<label> <?php echo $theater_address; ?> </label><br />

				<?php
					}
				?>

				 <label><?php echo "$error" ?></label><br />
				<label><input type="checkbox" name="check_box" value="save_theater"/> Save this theater </label><br />

				<input type="submit" name="next" value="Next"/><br />
			</form>

		
   </body>
   
</html>

