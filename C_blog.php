<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>School Blog</title>
    <!-- Include Bootstrap CSS and jQuery -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
    <div class="container mt-5">
        <h1>School Blog</h1>
        
        <!-- Blog Post -->
        <div class="card mb-4">
            <img src="school_image.jpg" class="card-img-top" alt="School Image">
            <div class="card-body">
            <form id="comment-form">
                    <div class="form-group">
                        <label for="name">Title</label>
                        <input type="text" class="form-control" id="name" name="name" required>
                    </div>
                    <div class="form-group">
                        <label for="comment">Content</label>
                        <textarea class="form-control" id="comment" name="comment" rows="3" required></textarea>
                    </div>
                    <button type="submit" class="btn btn-primary">Submit Comment</button>
                </form>
            
                <h2 class="card-title">Blog Post Title</h2>
                <p class="card-text">Blog post content goes here.</p>
            </div>
        </div>
        
        <!-- Comment Form -->
        <div class="card">
            <div class="card-body">
                <h3 class="card-title">Leave a Comment</h3>
                <form id="comment-form">
                    <div class="form-group">
                        <label for="name">Name</label>
                        <input type="text" class="form-control" id="name" name="name" required>
                    </div>
                    <div class="form-group">
                        <label for="comment">Comment</label>
                        <textarea class="form-control" id="comment" name="comment" rows="3" required></textarea>
                    </div>
                    <button type="submit" class="btn btn-primary">Submit Comment</button>
                </form>
            </div>
        </div>
    </div>

    <!-- Include jQuery and Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

    <!-- Include your custom JavaScript for handling form submission -->
    <script src="custom.js"></script>
</body>
</html>
