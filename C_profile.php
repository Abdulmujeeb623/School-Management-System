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

    public function fetchResults($username) {
        // Modify query to fetch specific columns for the student based on username
        $query = "SELECT FirstName, LastName, EmailAddress, Gender, ContactNumber, ResidentialAddress, BloodGenotype, HealthChallenges, CurrentClass, StateofOrigin, OccupationofParent, NextofKin FROM admission WHERE FirstName = ? LIMIT 1";
    
        $stmt = $this->connection->prepare($query);
        $stmt->bind_param("s", $username);
        $stmt->execute();
    
        $result = $stmt->get_result();
        $data = array();
    
        if ($row = $result->fetch_assoc()) {
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
$results = $dbHandler->fetchResults($_SESSION['name']);
?>
<?php include('Crystalline_navbar2.php');?>
<!DOCTYPE html>
<html lang="en">
<head>
    
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
        <div class="col-md-4">
            <img src="Arab1.jpg" alt="Student Profile Picture" class="img-fluid rounded-circle profile-picture">
        </div>
        <div class="col-md-8 profile-info">
            <?php foreach ($results as $result): ?>
                <h1><?php echo $result['FirstName'] . ' ' . $result['LastName']; ?></h1>
                <p>Email: <?php echo $result['EmailAddress']; ?></p>
                <p>Gender: <?php echo $result['Gender']; ?></p>
                <p>Contact Number: <?php echo $result['ContactNumber']; ?></p>
                <p>Residential Address: <?php echo $result['ResidentialAddress']; ?></p>
            <?php endforeach; ?>
            <a href="cr_edit_profile2.php">Edit Profile</a>
        </div>
    </div>
</div>


<div class="container mt-4 additional-section">
    <div class="row">
        <div class="col-md-12">
            <!-- Add more sections here if needed -->
            <?php foreach ($results as $result): ?>
                <h1><?php echo $result['FirstName'] . ' ' . $result['LastName']; ?></h1>
                <p>Next of kin: <?php echo $result['NextofKin']; ?></p>
                <p>Current class: <?php echo $result['CurrentClass']; ?></p>
                <p>Contact Number: <?php echo $result['ContactNumber']; ?></p>
                <p>Residential Address: <?php echo $result['ResidentialAddress']; ?></p>
            <?php endforeach; ?>
        </div>
    </div>
</div>


    
<!-- Additional Sections (you can add more as needed) -->
<div class="row mt-4">
    <div class="col-md-12">
        <!-- Add more sections here if needed -->
    </div>
</div>
</div>
<?php include('Crystalline_footer.php');?>
</body>
</html>
