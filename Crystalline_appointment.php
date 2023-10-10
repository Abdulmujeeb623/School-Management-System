<?php
// Crystalline_appointment.php

// Function to sanitize and validate input data
function test_input($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Gather the form data and sanitize/validate using the test_input function
    $gname = test_input($_POST["gname"]);
    $gmail = test_input($_POST["gmail"]);
    $cname = test_input($_POST["cname"]);
    $cage = test_input($_POST["cage"]);
    $message = test_input($_POST["message"]);

    // Perform validation
    $errors = [];

    if (empty($gname)) {
        $errors[] = "Guardian Name is required.";
    }

    if (empty($gmail) || !filter_var($gmail, FILTER_VALIDATE_EMAIL)) {
        $errors[] = "Valid Guardian Email is required.";
    }

    if (empty($cname)) {
        $errors[] = "Child Name is required.";
    }

    if (empty($cage)) {
        $errors[] = "Child Age is required.";
    }

    // If there are no validation errors, proceed to insert into the database
    if (empty($errors)) {
        // Assuming you have a database connection established
        $conn = new mysqli("localhost", "root", "", "crystalline");
        
        // Insert data into the database
        // For example:
        
        $sql = "INSERT INTO appointments (guardian_name, guardian_email, child_name, child_age, message) VALUES (?, ?, ?, ?, ?)";
        $stmt = $conn->prepare($sql);
        $stmt->execute([$gname, $gmail, $cname, $cage, $message]);
        

        // Redirect or display a success message
        echo "<script>alert('Appointment successfully booked!'); window.location='Appointment_list.php'</script>";
    }
}
?>

<!-- Your HTML code for the form goes here -->

