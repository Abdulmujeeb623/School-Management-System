<?php
class FormDataHandler {
    
    private $studentName;
    private $className;
    private $subject;
    private $assignments;
    private $test1;
    private $test2;
    private $exams;

    public function __construct($studentName, $className, $subject, $assignments, $test1, $test2, $exams) {
        $this->studentName = $studentName;
        $this->className = $className;
        $this->subject = $subject;
        $this->assignments = $assignments;
        $this->test1 = $test1;
        $this->test2 = $test2;
        $this->exams = $exams;
    }

    public function validate(&$errors = []) {
        $isValid = true;

        if ($this->assignments > 20 || $this->test1 > 20 || $this->test2 > 20) {
            $errors[] = "Assignment scores and test scores cannot be higher than 20.";
            $isValid = false;
        }

        if ($this->exams > 60) {
            $errors[] = "Exam scores cannot be greater than 60.";
            $isValid = false;
        }

        return $isValid;
    }

    public function calculateTotalAverage() {
        $totalScore = $this->assignments + $this->test1 + $this->test2 + $this->exams;
        $averageScore = $totalScore / 4;
        return ['total' => $totalScore, 'average' => $averageScore];
    }
}
class DatabaseHandler {
    private $connection;

    public function __construct($host, $username, $password, $dbname) {
        $this->connection = new mysqli($host, $username, $password, $dbname);
        if ($this->connection->connect_error) {
            die("Connection failed: " . $this->connection->connect_error);
        }
    }


    public function insertData($data) {
        $query = "INSERT INTO scores (student_name, class_name, subjects, assignments, test1, test2, exams, total_score, average_score)
                  VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)";
        
        $stmt = $this->connection->prepare($query);
        $stmt->bind_param("sssiiiiii", $data['studentName'], $data['className'], $data['subject'], $data['assignments'], $data['test1'], $data['test2'], $data['exams'], $data['total'], $data['average']);
        
    
        if ($stmt->execute()) {
            return true;
        } else {
            return false;
        }
    }

}


if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $studentName = $_POST["studentName"];
    $className = $_POST["className"];
    $subject = $_POST["subject"];
    $assignments = $_POST["assignments"];
    $test1 = $_POST["test1"];
    $test2 = $_POST["test2"];
    $exams = $_POST["exams"];
    
    $formData = new FormDataHandler($studentName, $className, $subject, $assignments, $test1, $test2, $exams);

    if ($formData->validate()) {
        $scoreData = $formData->calculateTotalAverage();

        $dbHost = "localhost";
        $dbUser = "root";
        $dbPass = "";
        $dbName = "crystalline";
        

        $dbHandler = new DatabaseHandler($dbHost, $dbUser, $dbPass, $dbName);

        if ($dbHandler->insertData(array_merge($scoreData, $_POST))) {
            echo "Data inserted successfully!";
        } else {
            echo "Error inserting data.";
        }
    } else {
        echo "Invalid input data!";
    }
}
?>
