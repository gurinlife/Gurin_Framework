<?php

include('init.php');

$m_blog = new Database('blog');

if ($_POST) {
  $m_blog->validate('title', 'min_3');
  $m_blog->validate('title', 'max_100');
  $m_blog->validate('description', 'min_10');
  $m_blog->validate('description', 'max_10000');

  $m_blog->set_error_template('<i class="text-danger small">', '</i>');

  if (!$m_blog->has_errors()) {
    $c_image = new Upload_Image($_FILES['image']);
    $c_image->upload();
  } else {
    $errors = $m_blog->get_errors();
  }
}

get_view('add_blog', compact('m_blog'));
