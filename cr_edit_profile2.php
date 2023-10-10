<?php
session_start();

if (!isset($_SESSION['name'])) {
    header('Location: Crystalline_login.php');
    exit();
}

class DatabaseHandler {
    private $connection;

    public function __construct($dbHost, $dbUser, $dbPass, $dbName) {
        // Create a database connection
        $this->connection = new mysqli($dbHost, $dbUser, $dbPass, $dbName);

        if ($this->connection->connect_error) {
            die("Connection failed: " . $this->connection->connect_error);
        }
    }

    public function fetchStudentInfo($username) {
        // Modify query to fetch student information based on username
        $query = "SELECT FirstName, LastName, EmailAddress, Gender, ContactNumber, ResidentialAddress, BloodGenotype, HealthChallenges, CurrentClass, StateofOrigin, OccupationofParent, NextofKin FROM admission WHERE FirstName = ? LIMIT 1";
    
        $stmt = $this->connection->prepare($query);
        $stmt->bind_param("s", $username);
        $stmt->execute();
    
        $result = $stmt->get_result();
        $data = array();
    
        if ($row = $result->fetch_assoc()) {
            $data = $row;
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
$studentInfo = $dbHandler->fetchStudentInfo($_SESSION['name']);
?>

<!-- Include your HTML and form for editing student information -->
<?php include('Crystalline_navbar2.php');?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Student Information</title>
    
    <style>
        /* Additional inline styles can be added here */
        .profile-picture {
            max-width: 200px;
            height: auto;
            border: 5px solid #fff;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.2);
        }
        
        .profile-info h1 {
            font-size: 24px;
        }
        
        .profile-info p {
            font-size: 18px;
            margin: 10px 0;
        }
        
        .additional-section {
            background-color: #f8f8f8;
            padding: 20px;
        }
    </style>
</head>
<body>
<div class="container mt-5">
    <div class="row">
        <!-- Display student information here -->
        <div class="col-md-4">
            <img src="Arab1.jpg" alt="Student Profile Picture" class="img-fluid rounded-circle profile-picture">
        </div>
        <div class="col-md-8 profile-info">
            <h1><?php echo $studentInfo['FirstName'] . ' ' . $studentInfo['LastName']; ?></h1>
            <!-- Display other student information attributes here -->
        </div>
    
        <!-- Add your editing form here -->
        <div class="col-md-8 profile-info">
            <!-- Editable Form for Student Name -->
            <form method="post" action="cr_edit_profile.php" enctype="multipart/form-data">
                <div class="form-group">
                    <label for="editStudentName">Edit Student Name:</label>
                    <input type="text" class="form-control" id="editStudentName" name="editStudentName" value="<?php echo $studentInfo['FirstName'] . ' ' . $studentInfo['LastName']; ?>">
                </div>
                <!-- Include other input fields for editing student information -->
                <div class="form-group">
                    <label for="editEmail">Edit Email:</label>
                    <input type="text" class="form-control" id="editEmail" name="editEmail" value="<?php echo $studentInfo['EmailAddress']; ?>">
                </div>
                <div class="form-group">
                    <label for="editGender">Edit Gender:</label>
                    <input type="text" class="form-control" id="editGender" name="editGender" value="<?php echo $studentInfo['Gender']; ?>">
                </div>
                <div class="form-group">
                    <label for="editContactNumber">Edit Contact Number:</label>
                    <input type="text" class="form-control" id="editContactNumber" name="editContactNumber" value="<?php echo $studentInfo['ContactNumber']; ?>">
                </div>
                <div class="form-group">
                    <label for="editResidentialAddress">Edit Residential Address:</label>
                    <input type="text" class="form-control" id="editResidentialAddress" name="editResidentialAddress" value="<?php echo $studentInfo['ResidentialAddress']; ?>">
                </div>
                <!-- Add a Save Changes button for each section -->
                <button type="submit" class="btn btn-primary">Save Changes</button>
            </form>
        </div>
    </div>
</div>

<?php include('Crystalline_footer.php');?>
</body>
</html>
