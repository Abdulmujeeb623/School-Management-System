<?php
require_once('dbb.php');

class ArticleUploader {
    private $db;

    public function __construct($db) {
        $this->db = $db;
    }

    public function test_input($data) {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }

    public function uploadArticle() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // Get the form data
            $title = isset($_POST['title']) ? $this->test_input($_POST['title']) : '';
            $content = isset($_POST['content']) ? $this->test_input($_POST['content']) : '';

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

                // Allow only specific file formats (JPG, JPEG, PNG)
                $allowed_extensions = array("jpg", "jpeg", "png");
                $file_extension = strtolower(pathinfo($file_name, PATHINFO_EXTENSION));
                if (!in_array($file_extension, $allowed_extensions)) {
                    echo "Sorry, only JPG, JPEG, and PNG files are allowed.";
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
            $stmt = $this->db->conn->prepare("INSERT INTO articles (Title, Content, File_name, File_type, File_size) VALUES (?, ?, ?, ?, ?)");
            if (!$stmt) {
                echo "Prepare failed: (" . $this->db->conn->errno . ") " . $this->db->conn->error;
                exit;
            }

            $stmt->bind_param("ssssi", $title, $content, $file_name, $file_type, $file_size);
            $stmt->execute();

            // Check if the post was successfully created
            if ($stmt->affected_rows > 0) {
                echo '<p>Post created successfully!</p>';
                header("Location: Crystalline_blog.php");
                exit;
            } else {
                echo '<p>Error creating post.</p>';
            }

            $stmt->close();
        }
    }
}

// Create a DBConnect object
$db = new DBConnect();

// Create an ArticleUploader object
$articleUploader = new ArticleUploader($db);

// Call the uploadArticle method
$articleUploader->uploadArticle();
?>
