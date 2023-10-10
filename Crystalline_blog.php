<!-- index.php -->
<?php include('Crystalline_navbar2.php');
include('dbb.php');
?>

<body>

<!-- Page Header Start -->
<div class="container-fluid bg-dark page-header py-5 mb-5 wow fadeIn" data-wow-delay="0.1s">
        <div class="container text-center py-5">
            <h1 class="display-2 text-white mb-4 animated slideInDown">Blog</h1>
            <nav aria-label="breadcrumb animated slideInDown">
                <ol class="breadcrumb justify-content-center mb-0">
                    <li class="breadcrumb-item"><a href="LandingHome.php">Home</a></li>
                    <li class="breadcrumb-item"><a href="Crystalline_blog.php">Blog</a></li>
                    <li class="breadcrumb-item text-primary" aria-current="page">About</li>
                </ol>
            </nav>
        </div>
    </div>
    
    <!-- Page Header Start -->
    <!-- Your page header code here -->

    <div class="container">
        <!-- Display blog posts -->
        <?php
        // Fetch blog posts from the database
        $sql = "SELECT * FROM articles ORDER BY created_at DESC";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                echo '<div class="card mb-3">';
                echo '<div class="card-body">';
                echo '<h2 class="card-title">' . $row['Title'] . '</h2>';
                echo '<p class="card-text">' . $row['Content'] . '</p>';
                $file = $row['File_name'];

                // Assuming that the "File_name" column contains the relative path to the file
                // You can modify the path as needed based on your file storage
                $file_path = 'uploads/' . $file; // Modify 'uploads/' with your actual file path

                echo '<a href="' . $file_path . '" download>Download</a>';

                echo '<p class="card-text">Created at: ' . $row['Created_at'] . '</p>';
                echo '</div>';
                echo '</div>';
            }
        } else {
            echo '<p>No blog posts found.</p>';
        }

        $conn->close();
        ?>
    </div>
</body>

<?php include('Crystalline_footer.php'); ?>
</html>
