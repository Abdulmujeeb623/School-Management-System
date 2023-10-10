<?php
include('conn.php');

function test_input($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Get the form data
    $title = isset($_POST['title']) ? test_input($_POST['title']) : '';
    $content = isset($_POST['content']) ? test_input($_POST['content']) : '';

    // Validate title and content
    if (empty($title)) {
        echo "Title is empty";
        exit;
    }

    if (empty($content)) {
        echo "Content is empty";
        exit;
    }

    $uploads_dir = 'upload/';

    // Check if the file was uploaded successfully
    if (isset($_FILES['file']) && $_FILES['file']['error'] === UPLOAD_ERR_OK) {
        $file_name = $_FILES['file']['name'];
        $file_tmp = $_FILES['file']['tmp_name'];
        $file_type = $_FILES['file']['type'];
        $file_size = $_FILES['file']['size'];

        // Check if file already exists
        if (file_exists($uploads_dir . $file_name)) {
            echo "Sorry, file already exists.";
            exit;
        }

        // Check file size
        if ($file_size > 500000) {
            echo "Sorry, your file is too large.";
            exit;
        }

        // Allow certain file formats
        $allowed_extensions = array("pdf", "txt", "jpeg", "rtf");
        $file_extension = strtolower(pathinfo($file_name, PATHINFO_EXTENSION));
        if (!in_array($file_extension, $allowed_extensions)) {
            echo "Sorry, only PDF, txt, JPEG & RTF files are allowed.";
            exit;
        }

        // Move uploaded file to the destination directory
        move_uploaded_file($file_tmp, $uploads_dir . $file_name);
    } elseif (isset($_FILES['file'])) {
        echo "File upload error: " . $_FILES['file']['error'];
        exit;
    } else {
        echo "File not set";
        exit;
    }

    // Prepare and execute the SQL statement
    $stmt = $conn->prepare("INSERT INTO articles (Title, Content, File_name, File_type, File_size) VALUES (?, ?, ?, ?, ?)");
    if (!$stmt) {
        echo "Prepare failed: (" . $conn->errno . ") " . $conn->error;
        exit;
    }

    $stmt->bind_param("ssssi", $title, $content, $file_name, $file_type, $file_size);
    $stmt->execute();

    // Check if the post was successfully created
    if ($stmt->affected_rows > 0) {
        echo '<p>Post created successfully!</p>';
        header("Location: Blog.php");
        exit;
    } else {
        echo '<p>Error creating post.</p>';
    }

    $stmt->close();
    $conn->close();
}
?>
