<?php

$conn = new mysqli('localhost', 'root', '', 'AlBabUsers');

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} 

?>