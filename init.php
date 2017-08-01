<?php

define('DB_HOST',     'localhost');
define('DB_USER',     'sakarioka_blog');
define('DB_PASSWORD', 's4k4r10k4!@');
define('DB_NAME',     'sakarioka_blog');

define('PROJECT_ROOT', $_SERVER['DOCUMENT_ROOT']);

include('Database.php');
include('function.php');

if (!empty($_FILES)) {
  include('Upload_Image.php');
}
