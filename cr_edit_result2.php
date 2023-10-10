<?php
class DatabaseHandler {
    private $connection;

    public function __construct($dbHost, $dbUser, $dbPass, $dbName) {
        // Create a database connection
        $this->connection = new mysqli($dbHost, $dbUser, $dbPass, $dbName);

        if ($this->connection->connect_error) {
            die("Connection failed: " . $this->connection->connect_error);
        }
    }

    public function fetchResults($studentName) {
        // Modify your query to fetch data for the specific student
        $query = "SELECT student_name, class_name, subjects, assignments, test1, test2, exams, total_score, average_score FROM scores WHERE student_name = ? ORDER BY subjects ASC";

        $stmt = $this->connection->prepare($query);
        $stmt->bind_param("s", $studentName);
        $stmt->execute();

        $result = $stmt->get_result();
        $data = $result->fetch_assoc(); // Assuming only one student with the given name

        $stmt->close();

        return $data;
    }
}

$dbHost = "localhost";
$dbUser = "root";
$dbPass = "";
$dbName = "crystalline";

$dbHandler = new DatabaseHandler($dbHost, $dbUser, $dbPass, $dbName);
$studentName = $_POST['student_name'] ?? '';
$studentInfo = null;

if (!empty($studentName)) {
    $studentInfo = $dbHandler->fetchResults($studentName);
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Secondary School Result Form</title>
    <!-- Include any necessary CSS or external dependencies here -->
</head>
<body>

<?php include('Crystalline_navbar2.php');?>

<!-- Add this code inside your form -->
<form method="POST" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']);?>" enctype="multipart/form-data"> 
    <label for="student_name">Enter Student Name:</label>
    <input type="text" id="student_name" name="student_name">
    <button type="submit">Search</button>
</form>
<?php if (!empty($studentInfo)): ?>
    <form method="post" action="cr_edit_result.php" enctype="multipart/form-data">
        <div class="form-group">
            <label for="editStudentName">Edit Student Name:</label>
            <input type="text" class="form-control" id="editStudentName" name="editStudentName" value="<?php echo $studentInfo['student_name']; ?>">
        </div>
        <div class="form-group">
            <label for="editClassName">Edit Class Name:</label>
            <input type="text" class="form-control" id="editClassName" name="editClassName" value="<?php echo $studentInfo['class_name']; ?>">
        </div>
        <div class="form-group">
            <label for="editSubject">Edit Subject:</label>
            <input type="text" class="form-control" id="editSubject" name="editSubject" value="<?php echo htmlspecialchars($studentInfo['subjects']); ?>">
        </div>
        <div class="form-group">
            <label for="editAssignments">Edit Assignments Score:</label>
            <input type="number" class="form-control" id="editAssignments" name="editAssignments" value="<?php echo htmlspecialchars($studentInfo['assignments']); ?>">
        </div>
        <div class="form-group">
            <label for="editTest1">Edit Test 1 Score:</label>
            <input type="number" class="form-control" id="editTest1" name="editTest1" value="<?php echo htmlspecialchars($studentInfo['test1']); ?>">
        </div>
        <div class="form-group">
            <label for="editTest2">Edit Test 2 Score:</label>
            <input type="number" class="form-control" id="editTest2" name="editTest2" value="<?php echo htmlspecialchars($studentInfo['test2']); ?>">
        </div>
        <div class="form-group">
            <label for="editExams">Edit Exams Score:</label>
            <input type="number" class="form-control" id="editExams" name="editExams" value="<?php echo htmlspecialchars($studentInfo['exams']); ?>">
        </div>
        <button type="submit">Save Changes</button>
    </form>
<?php endif; ?>

<?php include('Crystalline_footer.php');?>

</body>
</html>
