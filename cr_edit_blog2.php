<?php
require_once 'datab.php'; // Replace 'DatabaseHandler.php' with the correct path

// Assuming you have already instantiated $dbHost, $dbUser, $dbPass, and $dbName
$dbHandler = new DatabaseHandler($dbHost, $dbUser, $dbPass, $dbName);

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $editBlogTitle = $_POST["editBlogTitle"];
    $editBlogContent = $_POST["editBlogContent"];
    $editBlogFile = $_POST["editBlogFile"];
    $editBlogSize = $_POST["editBlogSize"];
    
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
