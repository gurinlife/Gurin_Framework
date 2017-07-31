<?php

include('init.php');

if ($_POST) {
  $m_blog = new Database('blog');
  $m_blog->close();
  
  $c_image = new Upload_Image($_FILES['image']);
  $c_image->upload();
}

get_view('add_blog');
