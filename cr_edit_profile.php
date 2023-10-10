<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Include the DatabaseHandler class here
    require_once('datab.php');

    
    $dbHandler = new DatabaseHandler($dbHost, $dbUser, $dbPass, $dbName);

    // Get the updated student information from the form
    $editFirstName = $_POST['editStudentName'];
    $editLastName = $_POST['editLastName'];
    $editNextofKin = $_POST['editNextofKin'];
    $editCurrentClass = $_POST['editCurrentClass'];
    $editContactNumber = $_POST['editContactNumber'];
    $editResidentialAddress = $_POST['editResidentialAddress'];

    // Update the student information in the database
    $query = "UPDATE admission SET FirstName = ?, LastName = ?, NextofKin = ?, CurrentClass = ?, ContactNumber=?, ResidentialAddress = ? WHERE FirstName = ?";
    $stmt = $dbHandler->connection->prepare($query);
    $stmt->bind_param("sssssss", $editFirstName, $editLastName, $editNextofKin, $editCurrentClass, $editContactNumber, $editResidentialAddress, $_SESSION['name']);

    if ($stmt->execute()) {
        // Redirect back to the C_profile.php page after successful update
        header('Location: C_profile.php');
        exit();
    } else {
        echo "Error updating student information: " . $stmt->error;
    }

    $stmt->close();
}


?>