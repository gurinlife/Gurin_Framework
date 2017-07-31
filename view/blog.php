<div class="container">
  <h1 class="h3 clearfix">
    Blog Lists
    <div class="pull-right">
      <a class="btn btn-xs btn-default" href="/add_blog.php">Add</a>
    </div>
  </h1>
  <table class="table table-bordered table-hover">
    <thead>
      <tr>
        <th>#</th>
        <th>Image</th>
        <th>Title</th>
        <th>Description</th>
        <th>Tags</th>
        <th>Post Date</th>
        <th>Action</th>
      </tr>
    </thead>
    <tbody>
      <?php $i = 1 ?>
      <?php foreach ($blogs as $_blog) : ?>
        <tr>
          <td><?php echo $i ?></td>
          <td><?php echo $_blog['image'] ?></td>
          <td><?php echo $_blog['title'] ?></td>
          <td><?php echo $_blog['description'] ?></td>
          <td><?php echo (!empty($_blog['tags'])) ? $_blog['tags'] : '-' ?></td>
          <td><?php echo $_blog['date_created'] ?></td>
          <td>
            <a class="btn btn-xs btn-warning" href="/edit_blog.php?id=<?php echo $_blog['id'] ?>">Edit</a>
            <a class="btn btn-xs btn-danger" href="/delete_blog.php?id=<?php echo $_blog['id'] ?>" onclick="return confirm('Are you sure want to delete &quot;<?php echo $_blog['title'] ?>&quot;');">Delete</a>
          </td>
        </tr>
        <?php $i++ ?>
      <?php endforeach ?>
    </tbody>
  </table>
</div>