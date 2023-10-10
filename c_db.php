<?php 
class DatabaseHandler {
    private $connection;

    public function __construct($host, $username, $password, $dbname) {
        $this->connection = new mysqli($host, $username, $password, $dbname);
        if ($this->connection->connect_error) {
            die("Connection failed: " . $this->connection->connect_error);
        }
    }

    public function insertData($data) {
        $query = "INSERT INTO scores (subject, assignments, test1, test2, exams, total_score, average_score)
                  VALUES (?, ?, ?, ?, ?, ?, ?)";
        
        $stmt = $this->connection->prepare($query);
        $stmt->bind_param("siiiiii", $data['subject'], $data['assignments'], $data['test1'], $data['test2'], $data['exams'], $data['total'], $data['average']);
        
        if ($stmt->execute()) {
            return true;
        } else {
            return false;
        }
    }
}
?>