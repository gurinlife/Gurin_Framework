<?php

require('init.php');

$path = explode('/', trim(parse_url(CURRENT_URL, PHP_URL_PATH), '/'));

if (isset($path[0])) {
  $controller = $path[0];
} else {
  $controller = DEFAULT_CONTROLLER;
}

if (isset($path[1])) {
  $method = $path[1];
} else {
  $method = DEFAULT_METHOD;
}

if (count($path) > 2) {
  $option = array();

  for ($i = 2; $i < count($path); $i++) {
    $option[] = $path[$i];
  }
}

$controller_name = str_replace(' ', '', ucwords(str_replace('_', ' ', $controller)));

require(PROJECT_ROOT.'/Controller/'.$controller_name.'.php');