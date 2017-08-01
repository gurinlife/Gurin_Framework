<?php

define('DB_HOST',     'localhost');
define('DB_USER',     'sakarioka_blog');
define('DB_PASSWORD', 's4k4r10k4!@');
define('DB_NAME',     'sakarioka_blog');

define('PROJECT_ROOT', $_SERVER['DOCUMENT_ROOT']);

include('function.php');
include('Database.php');
include('InputForm.php');

if (!empty($_FILES)) {
  include('UploadImage.php');
}
