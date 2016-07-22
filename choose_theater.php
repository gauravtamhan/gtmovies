<?php
   include("config.php");
   session_start();
   $user = $_SESSION['current_user'];
?>

<?php   
   $query = "SELECT DISTINCT Theater_ID FROM THEATER";

   $result = mysqli_query($db, $query);

   if(isset($_POST['choose'])) {
      if(isset($_POST['saved_theater'])){ 
         //header("location: search_theater_result.php");
      }
   }


   if(isset($_POST['search'])) {
      $_SESSION['theater'] = $_POST['user_input'];
      //header("location: search_theater_result.php");
   }


?>
<html>
   
   <head>
      <title>Choose Theater</title>
      
      
   </head>
   
   <body>
      <h1> Choose Theater </h1>
      <div align = "center">
         <div style = "width:500px; border: solid 1px #333333; " align = "left">
          
				
            <div style = "margin:30px">
               
               <form action = "" method = "post"> 
                  <label> Saved Theater </label>
                  <select name="saved_theater">  
                     <?php  
                        while ($row = mysqli_fetch_row($result)) {
                           $theater_name = $row[0];
                     ?>                    
                           <option value=<?php echo $row[0] ?> name="list[]"><?php echo $row[0] ?></option>
                     <?php
                        }
                     ?>
                  </select>
                  <input type = "submit" name= "choose" value = " Choose "/><br />
               </form>
               <form action = "" method = "post"> 
                  <label> City/State/Theater </label>
                  <input type = "text" name= "user_input" class = "box"/>
                  <input type = "submit" name= "search" value = " Search "/><br />
               </form>
					
            </div>
				
         </div>
			
      </div>

   </body>
</html>