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

    public function fetchResults($blog_title) {
        // Modify your query to fetch data for the specific blog
        $query = "SELECT Title, Content, File_name, File_size FROM articles WHERE Title = ?";
        $stmt = $this->connection->prepare($query);
        $stmt->bind_param("s", $blog_title);
        $stmt->execute();

        $result = $stmt->get_result();
        $data = $result->fetch_assoc();

        $stmt->close();

        return $data;
    }
}

$dbHost = "localhost";
$dbUser = "root";
$dbPass = "";
$dbName = "crystalline";

$dbHandler = new DatabaseHandler($dbHost, $dbUser, $dbPass, $dbName);
$blog_title = $_POST['blog_title'] ?? '';
$blogInfo = null;

if (!empty($blog_title)) {
    $blogInfo = $dbHandler->fetchResults($blog_title);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Secondary School Blog</title>
    <!-- Include any necessary CSS or external dependencies here -->
</head>
<body>

<?php include('Crystalline_navbar2.php');?>

<!-- Add this code inside your form -->
<form method="POST" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']);?>" enctype="multipart/form-data"> 
    <label for="blog_title">Enter Blog Title:</label>
    <input type="text" id="blog_title" name="blog_title">
    <button type="submit">Search</button>
</form>

<?php if (!empty($blogInfo)): ?>
    <form method="post" action="cr_edit_blog2.php" enctype="multipart/form-data">
        <div class="form-group">
            <label for="editBlogTitle">Edit Blog Title:</label>
            <input type="text" class="form-control" id="editBlogTitle" name="editBlogTitle" value="<?php echo $blogInfo['Title']; ?>">
        </div>
        <div class="form-group">
            <label for="editBlogContent">Edit Blog Content:</label>
            <input type="text" class="form-control" id="editBlogContent" name="editBlogContent" value="<?php echo $blogInfo['Content']; ?>">
        </div>
        <div class="form-group">
            <label for="editBlogFile">Edit Blog File:</label>
            <input type="text" class="form-control" id="editBlogFile" name="editBlogFile" value="<?php echo htmlspecialchars($blogInfo['File_name']); ?>">
        </div>
        <div class="form-group">
            <label for="editBlogSize">Edit Blog Size:</label>
            <input type="number" class="form-control" id="editBlogSize" name="editBlogSize" value="<?php echo htmlspecialchars($blogInfo['File_size']); ?>">
        </div>
       
        <button type="submit">Save Changes</button>
    </form>
<?php endif; ?>

<?php include('Crystalline_footer.php');?>

</body>
</html>
