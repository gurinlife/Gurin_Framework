<?php

define('DB_HOST',     'localhost');
define('DB_USER',     'sakarioka_blog');
define('DB_PASSWORD', 's4k4r10k4!@');
define('DB_NAME',     'sakarioka_blog');

define('DEFAULT_CONTROLLER', 'home');
define('DEFAULT_METHOD',     'index');

define('PROJECT_ROOT', $_SERVER['DOCUMENT_ROOT']);
define('CURRENT_URL',  (isset($_SERVER['HTTPS'])) ? 'https' : 'http'.'://'.$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI']);

require('function.php');
require('InputForm.php');
require('Database.php');

if (!empty($_FILES)) {
  require('UploadImage.php');
}
