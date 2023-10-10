<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "user";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    
    die("Connection failed: " . $conn->connect_error);
}
echo"connected successfully";
?>
if($stmt)
			{
				$_SESSION['log']=$password;
				header('Location: welcome.php');
				exit();

			}
			else
			{
				echo "something went wrong!<br>";
				echo "Error Description: ", $conn-> error;
			}
