<?php

function get_view($view, $data = null) {
  if (!empty($data)) {
    extract($data);
  }
  
  ob_start();
  include('view/'.$view.'.php');
  $main_html = ob_get_contents();
  ob_end_clean(); 

  include('view/layout.php');
}

function dump($var) {
  echo '<pre>';
  var_dump($var);
  echo '</pre>';
}