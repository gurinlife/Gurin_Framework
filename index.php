<?php

include('init.php');

$m_blog = new Database('blog');

$data['blogs'] = $m_blog->select('*', "is_deleted = '0' ORDER BY id DESC");

get_view('blog', $data);

$m_blog->close();