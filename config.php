<?php
   define('DB_SERVER', 'localhost');
   define('DB_USERNAME', 'root');
   define('DB_PASSWORD', '123456');
   define('DB_DATABASE', 'GTMovies');
   $db = mysqli_connect(DB_SERVER,DB_USERNAME,DB_PASSWORD,DB_DATABASE);

   if (mysqli_connect_errno()) 
    {
		die ("Database connection failed:" . mysqli_connect_error(). " (". mysqli_connect_errno() .")");
	}
?>