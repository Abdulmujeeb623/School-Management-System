<?php
require_once 'datab.php'; // Replace 'DatabaseHandler.php' with the correct path

// Assuming you have already instantiated $dbHost, $dbUser, $dbPass, and $dbName
$dbHandler = new DatabaseHandler($dbHost, $dbUser, $dbPass, $dbName);

// Function to validate and sanitize input data
function test_input($data) {
    $data = trim($data);            // Remove leading and trailing whitespace
    $data = stripslashes($data);    // Remove backslashes
    $data = htmlspecialchars($data); // Convert special characters to HTML entities
    return $data;
}

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $editBlogTitle = test_input($_POST["editBlogTitle"]);
    $editBlogContent = test_input($_POST["editBlogContent"]);
    $editBlogFile = test_input($_POST["editBlogFile"]);
    $editBlogSize = test_input($_POST["editBlogSize"]);
    
    // Update the blog record
    $query = "UPDATE articles SET Content=?, File_name=?, File_size=? WHERE Title=?";
    $stmt = $dbHandler->connection->prepare($query);
    $stmt->bind_param("ssss", $editBlogContent, $editBlogFile, $editBlogSize, $editBlogTitle);

    if ($stmt->execute()) {
        echo "Blog data updated successfully!";
    } else {
        echo "Error updating blog data.";
    }
}
?>
