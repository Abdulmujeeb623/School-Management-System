
<?php include('TheNavbarArab.php');?>





<!-- Create a new blog post -->
    <h2>Create a new blog post</h2>
    <form action="create_article.php" enctype="multipart/form-data" method="POST">
      <div class="mb-3">
        <label for="title" class="form-label">Title</label>
        <input type="text" class="form-control" id="title" name="title" required>
      </div>
      <div class="mb-3">
        <label for="content" class="form-label">Content</label>
        <textarea class="form-control" id="content" name="content" rows="3" required></textarea>
      </div>
      <div class="mb-3">
      <label for="file" class="form-label">Upload File:</label>
        <input type="file" class="form-control" id="file" name="file" required>
       </div>
      <button type="submit" value="submit" class="btn btn-primary">Create blog</button>
    </form>
    <?php include('footerr.php');?>
  </div>
  
  