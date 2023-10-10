<?php
class Database {
    private $host = "localhost";
    private $username = "root";
    private $password = "";
    private $dbname = "crystalline";

    protected $conn;

    public function __construct() {
        try {
            $this->conn = new PDO("mysql:host=$this->host;dbname=$this->dbname", $this->username, $this->password);
            $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            echo "Connection failed: " . $e->getMessage();
        }
    }

    public function insertFormData($data) {
        $stmt = $this->conn->prepare("INSERT INTO admission (FirstName, LastName, Gender, DateofBirth, ContactNumber, EmailAddress, ResidentialAddress, StateofOrigin, PlaceofBirth, OccupationofParent, BloodGenotype, HealthChallenges, CurrentClass, AnticipatedClass, NextofKin, Questions) VALUES (:firstname, :lastname, :gender, :birthday, :contact, :email, :address, :state, :birthplace, :parentOccupation, :bloodGroup, :healthChallenges, :currentClass, :anticipatedClass, :nextOfKin, :questions)");

        $stmt->bindParam(':firstname', $data['firstname']);
        $stmt->bindParam(':lastname', $data['lastname']);
        $stmt->bindParam(':gender', $data['gender']);
        $stmt->bindParam(':birthday', $data['birthday']);
        $stmt->bindParam(':contact', $data['contact']);
        $stmt->bindParam(':email', $data['email']);
        $stmt->bindParam(':address', $data['address']);
        $stmt->bindParam(':state', $data['state']);
        $stmt->bindParam(':birthplace', $data['birthplace']);
        $stmt->bindParam(':parentOccupation', $data['parentOccupation']);
        $stmt->bindParam(':bloodGroup', $data['bloodGroup']);
        $stmt->bindParam(':healthChallenges', $data['healthChallenges']);
        $stmt->bindParam(':currentClass', $data['currentClass']);
        $stmt->bindParam(':anticipatedClass', $data['anticipatedClass']);
        $stmt->bindParam(':nextOfKin', $data['nextOfKin']);
        $stmt->bindParam(':questions', $data['questions']);

        if ($stmt->execute()) {
            echo "<script>alert('Account successfully created!'); window.location='Crystalline_login.php'</script>";
 
            
        } else {
            return "Error inserting form data.";
        }
    }
}
?>
