<?php
session_start();

if (!isset($_SESSION['name'])) {
    header('Location: Crystalline_login.php');
    exit();
}
?>

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
        $stmt->bind_param("s", $_SESSION['name']);
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
$results = $dbHandler->fetchResults();
?>

<!DOCTYPE html>
<html>
<head>
    <title>Results</title>
</head>
<body>
    <?php include('Crystalline_navbar2.php'); ?>
    <div class="mt-3">
        <h3>Results</h3>
        <p>Welcome, <?php echo $_SESSION['name']; ?>!</p>
    
        <div class="table-responsive">
            <table class="table">
                <thead>
                    <tr>
                        <th>NAME</th>
                        <th>CLASS</th>
                        <th>NO OF PRESENT</th>
                        <th>NO OF ABSENT</th>
                        <th>SEX</th>
                        <th>POSITION</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($results as $result): ?>
                        <tr>
                            <td><?= $result['student_name'] ?></td>
                            <td><?= $result['class_name'] ?></td>
                            
                        </tr>
                        <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>

    <div class="table-responsive">
        <table class="table">
            <thead>
                <tr>
                    <th>Subject</th>
                    <th>Assignments</th>
                    <th>Test 1</th>
                    <th>Test 2</th>
                    <th>Exams</th>
                    <th>Total</th>
                    <th>Average</th>
                </tr>
            </thead>
            <br>
            <br><br><br><br><br>
            <tbody>
                <?php foreach ($results as $result): ?>
                    <tr>
                        <td><?= $result['subjects'] ?></td>
                        <td><?= $result['assignments'] ?></td>
                        <td><?= $result['test1'] ?></td>
                        <td><?= $result['test2'] ?></td>
                        <td><?= $result['exams'] ?></td>
                        <td><?= $result['total_score'] ?></td>
                        <td><?= $result['average_score'] ?></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
    <?php include('Crystalline_footer.php'); ?>
</body>
</html>
