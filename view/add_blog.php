<div class="container">
  <div class="page-header">
    <h1 class="h3 clearfix">Add Blog</h1>
  </div>
  <form action="http://cms-blog.sakarioka.com/add_blog.php" method="post" enctype="multipart/form-data">
    <div class="form-group">
      <label>Image</label>
      <input type="file" name="image">
    </div>
    <div class="form-group <?php if ($m_blog->has_error('title')) echo 'has-error' ?>">
      <label>Title</label>
      <input type="text" name="title" class="form-control">
      <?php echo $m_blog->show_error('title') ?>
    </div>
    <div class="form-group <?php if ($m_blog->has_error('description')) echo 'has-error' ?>">
      <label>Description</label>
      <textarea name="description" class="form-control"></textarea>
      <?php echo $m_blog->show_error('description') ?>
    </div>
    <div class="form-group <?php if ($m_blog->has_error('tags')) echo 'has-error' ?>">
      <label>Tags</label>
      <span class="small">(Optional)</span>
      <input type="text" name="tag" class="form-control">
      <?php echo $m_blog->show_error('tags') ?>
    </div>
    <div class="clearfix">
      <a href="http://cms-blog.sakarioka.com" class="btn btn-default pull-left">Cancel</a>
      <button type="submit" class="btn btn-danger pull-right">Save</button>
    </div>
  </form>
</div>