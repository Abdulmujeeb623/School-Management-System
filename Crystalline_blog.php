<?php include('Crystalline_navbar2.php');?>
<body>

<div class="container">
    <table class="table">
        <thead>
         </thead>
        <tbody>
            <?php
            require_once('dbb.php');

            // Create a DBConnect object
            $db = new DBConnect();

            // Query to fetch articles
            // Query to fetch articles in descending order of created_time
           $query = "SELECT id, Title, Content, File_name, File_type, File_size, Created_at FROM articles ORDER BY Created_at DESC";
           $result = $db->conn->query($query);

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $id = $row['id'];
        $title = $row['Title'];
        $content = $row['Content'];
        $file_name = $row['File_name'];
        $file_type = $row['File_type'];
        $created_time = $row['Created_at'];

        echo "<div class='card'>";
        echo "<img src='upload/$file_name' alt='Article Image' class='card-img-top' style='max-width: 200px; max-height: 200px;'>";
        echo "<div class='card-body'>";
        echo "<h5 class='card-title'>$title</h5>";
        echo "<p class='card-text'>$content</p>";
        echo "<p class='card-text'>Created: $created_time</p>";

        // Add a comment section
        echo "<h6>Comments</h6>";
        // Display comments here (you need to implement the logic to fetch and display comments)
        
        echo "</div>";
        echo "</div>";
    }
} else {
    echo "<p>No articles found.</p>";
}
?>
</div>
<?php include('Crystalline_footer.php');?>
</body>

