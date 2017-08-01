<?php

include('init.php');

$path = parse_url($url, PHP_URL_PATH);

dump($path);
