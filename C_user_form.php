<?php
require_once 'dbb.php';

class UserRegistration {
    private $conn;

    public function __construct() {
        $db = new DBConnect();
        $this->conn = $db->conn;
    }

    public function registerUser($username, $password) {
        $stmt = $this->conn->prepare("INSERT INTO user (user_name, pass1) VALUES (?, ?)");
        $hashedPassword = password_hash($password, PASSWORD_BCRYPT);

        $stmt->bind_param("ss", $username, $hashedPassword);

        if ($stmt->execute()) {
            return true;
        } else {
            return false;
        }
    }
}
?>
