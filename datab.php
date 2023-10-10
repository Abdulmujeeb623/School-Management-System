<?php
class DatabaseHandler {
    public $connection;

    public function __construct($dbHost, $dbUser, $dbPass, $dbName) {
        // Create a database connection
        $this->connection = new mysqli($dbHost, $dbUser, $dbPass, $dbName);

        if ($this->connection->connect_error) {
            die("Connection failed: " . $this->connection->connect_error);
        }
    }

    
}

$dbHost = "localhost";
$dbUser = "root";
$dbPass = "";
$dbName = "crystalline";

$dbHandler = new DatabaseHandler($dbHost, $dbUser, $dbPass, $dbName);

?>
