<?php
	include("config.php");
	session_start(); 
	$movie = $_SESSION['movie'];
?>

<?php
	
	if ($_SERVER["REQUEST_METHOD"] == "POST") {

		$new_rating = $_POST['Rating'];
		$new_title = $_POST['Title'];
		$new_comment = $_POST['Comment'];
	}

?>

<html>
   
   <head>
      <title>Give Review</title>
      
      <style type = "text/css">
         h1 {
            font-style: italic;
            font-size: 30px;
            text-align: center;
            margin-top: 80px;
         }

         hr {
          width: 70%;
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
             width: 200px;
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
         // if(!isset($_POST['submit'])) {
         //    $error = "";
         // }	
     ?>
     <h1> <?php echo $movie ?> Review</h1>

     <hr>
      <div align = "center">
         <div class="container" align = "left">
            
				
            <div style = "margin:20px">
               
               <form action = "" method = "post">
                  <label> Rating </label> <select name="Rating">
                  						<option value = "1"> 1 out of 5 </option>
                  						<option value = "2"> 2 out of 5 </option>
                  						<option value = "3"> 3 out of 5 </option>
                  						<option value = "4"> 4 out of 5 </option>
                  						<option value = "5"> 5 out of 5 </option> </select> <br>
                  <label> Title </label> <input type = "text" name = "Title" placeholder="Give your review a name..." />
                  <label> Comment </label> <textarea name = "Comment" rows="10" cols="62" placeholder="Write you review here..."></textarea>
               
                  <input type = "submit" value = "Submit"/>
               </form>


               <div style = "font-size:11px; color:#cc0000; margin-top:10px"> <?php echo "$error" ?> </div>
					
            </div>
				
         </div>
			
      </div>

   </body>
</html>