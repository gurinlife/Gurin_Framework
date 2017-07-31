<div class="container">
  <h1 class="h3 clearfix">Add Blog</h1>
  <form action="http://cms-blog.sakarioka.com/add_blog.php" method="post" enctype="multipart/form-data">
    <div class="form-group">
      <label>Image</label>
      <input type="file" name="image">
    </div>
    <div class="form-group">
      <label>Title</label>
      <input type="text" name="title" class="form-control">
    </div>
    <div class="form-group">
      <label>Description</label>
      <textarea name="description" class="form-control"></textarea>
    </div>
    <div class="form-group">
      <label>Tags</label>
      <input type="text" name="tag" class="form-control">
    </div>
    <div class="clearfix">
      <a href="http://cms-blog.sakarioka.com" class="btn btn-default pull-left">Cancel</a>
      <button type="submit" class="btn btn-danger pull-right">Save</button>
    </div>
  </form>
</div>