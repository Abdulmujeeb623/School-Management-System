
<?php
require_once 'datab.php'; // Replace 'DatabaseHandler.php' with the correct path
function test_input($data) {
    $data = trim($data);             // Remove extra whitespace
    $data = stripslashes($data);     // Remove backslashes
    $data = htmlspecialchars($data); // Convert special characters to HTML entities
    return $data;
}


// Assuming you have already instantiated $dbHost, $dbUser, $dbPass, and $dbName
$dbHandler = new DatabaseHandler($dbHost, $dbUser, $dbPass, $dbName);


if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $editStudentName = test_input($_POST["editStudentName"]);
    $editClassName = test_input($_POST["editClassName"]);
    $editSubject = test_input($_POST["editSubject"]);
    $editAssignments = test_input($_POST["editAssignments"]);
    $editTest1 = test_input($_POST["editTest1"]);
    $editTest2 = test_input($_POST["editTest2"]);
    $editExams = test_input($_POST["editExams"]);

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

