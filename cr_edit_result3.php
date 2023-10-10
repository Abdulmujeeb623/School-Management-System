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

    public function fetchResults() {
        // Modify your query to fetch data for the specific student
        $query = "SELECT student_name, class_name, subjects, assignments, test1, test2, exams, total_score, average_score FROM scores WHERE student_name = ? ORDER BY subjects ASC";


        $stmt = $this->connection->prepare($query);
        $stmt->bind_param("s", $studentName);
        $stmt->execute();

        $result = $stmt->get_result();
        $data = array();

        while ($row = $result->fetch_assoc()) {
            $data[] = $row;
        }

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
if (!empty($studentName)) {
    $results = $dbHandler->fetchResults($studentName);
} else {
    // Display a message or redirect if the student name is not provided
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
    <?php if (!empty($results)): ?>

<form method="post" action="cr_edit_result.php" enctype="multipart/form-data">
<?php foreach ($results as $result): ?>
    <div class="form-group">
        <label for="editStudentName">Edit Student Name:</label>
        <input type="text" class="form-control" id="editStudentName" name="editStudentName" value="<?php echo $result['student_name']; ?>">
    </div>
    <div class="form-group">
        <label for="editClassName">Edit Class Name:</label>
        <input type="text" class="form-control" id="editClassName" name="editClassName" value="<?php echo $result['class_name']; ?>">
    </div>
    <div class="form-group">
        <label for="editSubject">Edit Subject:</label>
        <input type="text" class="form-control" id="editSubject" name="editSubject" value="<?php echo htmlspecialchars($result['subjects']); ?>">
    </div>
    <div class="form-group">
        <label for="editAssignments">Edit Assignments Score:</label>
        <input type="number" class="form-control" id="editAssignments" name="editAssignments" value="<?php echo htmlspecialchars($result['assignments']); ?>">
    </div>
    <div class="form-group">
        <label for="editTest1">Edit Test 1 Score:</label>
        <input type="number" class="form-control" id="editTest1" name="editTest1" value="<?php echo htmlspecialchars($result['test1']); ?>">
    </div>
    <div class="form-group">
        <label for="editTest2">Edit Test 2 Score:</label>
        <input type="number" class="form-control" id="editTest2" name="editTest2" value="<?php echo htmlspecialchars($result['test2']); ?>">
    </div>
    <div class="form-group">
        <label for="editExams">Edit Exams Score:</label>
        <input type="number" class="form-control" id="editExams" name="editExams" value="<?php echo htmlspecialchars($result['exams']); ?>">
    </div>
    <?php endforeach; ?>
            <button type="submit">Save Changes</button>
        </form>
    <?php endif; ?>

<script>
document.addEventListener("DOMContentLoaded", function () {
    const calculateButton = document.getElementById("calculate");
    calculateButton.addEventListener("click", calculateScores);

    function calculateScores() {
        const assignments = parseFloat(document.getElementById("assignments").value) || 0;
        const test1 = parseFloat(document.getElementById("test1").value) || 0;
        const test2 = parseFloat(document.getElementById("test2").value) || 0;
        const exams = parseFloat(document.getElementById("exams").value) || 0;

        const totalScore = assignments + test1 + test2 + exams;
        const averageScore = totalScore / 4;

        document.getElementById("totalScore").textContent = totalScore;
        document.getElementById("averageScore").textContent = averageScore.toFixed(2);
    }
});
</script>

<?php include('Crystalline_footer.php');?>


</body>
</html>



