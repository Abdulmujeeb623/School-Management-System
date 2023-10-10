
<?php
require_once 'datab.php'; // Replace 'DatabaseHandler.php' with the correct path

// Assuming you have already instantiated $dbHost, $dbUser, $dbPass, and $dbName
$dbHandler = new DatabaseHandler($dbHost, $dbUser, $dbPass, $dbName);

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $editStudentName = $_POST["editStudentName"];
    $editClassName = $_POST["editClassName"];
    $editSubject = $_POST["editSubject"];
    $editAssignments = $_POST["editAssignments"];
    $editTest1 = $_POST["editTest1"];
    $editTest2 = $_POST["editTest2"];
    $editExams = $_POST["editExams"];

    // Assuming studentName, className, and subject together uniquely identify a record
    $query = "UPDATE scores SET assignments=?, test1=?, test2=?, exams=? WHERE student_name=? AND class_name=? AND subjects=?";
    $stmt = $dbHandler->connection->prepare($query);
    $stmt->bind_param("iiiisss", $editAssignments, $editTest1, $editTest2, $editExams, $editStudentName, $editClassName, $editSubject);

    if ($stmt->execute()) {
        echo "Data updated successfully!";
    } else {
        echo "Error updating data.";
    }
}
?>
