<?php

$conn = new mysqli('localhost', 'modernar_Abdulmujeeb_Otuyo', 'Abdulmujeeb_623', 'modernar_Order');

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} 

?>