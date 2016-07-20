<?php
	// Create a database connection
	// $dbhost = "localhost";
	// $dbuser = "root";
	// $dbpass = "cs4400";
	// $dbname = "Movie";
	$dbhost = "http://128.61.64.84/:3306";
	$dbuser = "root";
	$dbpass = "123456";
	$dbname = "GTMovies";
	$db = mysqli_connect($dbhost, $dbuser, $dbpass, $dbname);
	if(mysqli_connect_errno()) {
		die("Database connection failed:" . mysqli_connect_error(). " (". mysqli_connect_errno() .")");
	}
?>
<?php
	//Perform database query
	$query = "SELECT * FROM user";
	$result = mysqli_query($db, $query);
	//test for query error
	if(!$result) {
		die("Query failed");
	}

?>


<?php

	if (isset($_POST['login'])) {
		$username = $_POST["username"];
		$password = $_POST["password"];
		$message = "Login: {$username}";
		while($row = mysqli_fetch_assoc($result)) {
			if ($row["username"] == $username 
				&& $row["password"] == $password) {
				echo "{found user}" . "<br />";
				$found = $row["username"];
			} else {
				$found = "";
			}
		}
	} else if (isset($_POST['register'])) {
		header("Location: ". "registeration.php");
		exit;
	}
	else {
		$username = "";
		$password = "";
		$message = "Please login";
	}
?>




<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN"
	"http://www.w3.org/TR/html4/loose.dtd">


<html lang="en">
	<head>
		<title>login</title>
	</head>
	<body>
	<?php echo $message; ?><br />
	<form action="login.php" method ="post"> 
		Username: <input type="text" name="username" value=""/><br />
		Password: <input type="password" name="password" value=""/> <br />
		<br />
		<input type="submit" name="login" value="Login"/>
		<input type="submit" name="register" value="Register"/>
	</form>
	<?php
		// $username = $_POST["username"];
		// $password = $_POST["password"];
		// if (isset($_POST["username"])) {
		// 	$username = $_POST["username"];
		// } else {
		// 	$username = "";
		// }

		// if (isset($_POST["password"])) {
		// 	$password = $_POST["password"];
		// } else {
		// 	$password = "";
		// }
		// $query2 = "SELECT * FROM $result WHERE username = $username AND password = $password";
		// $result2 = mysqli_query($db, $query2);

		// if ($result2) {
		// 	echo $row["username"] . "<br />";
		// } else {
		// 	echo "{Can't find user}" . "<br />";
		// }

	?>
	<?php 
		//Release returned data
		mysqli_free_result($result);
	?>

	</body>
</html>
<?php
	//Close database connection
	mysqli_close($db);
?>
