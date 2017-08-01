<?php

include('init.php');

$current_url = (isset($_SERVER['HTTPS'])) ? 'https' : 'http'.'://'.$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'];
$path        = parse_url($current_url, PHP_URL_PATH);

dump($path);
