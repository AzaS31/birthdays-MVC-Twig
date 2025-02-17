<?php

if (php_sapi_name() == 'cli-server') {
    $path = __DIR__ . parse_url($_SERVER["REQUEST_URI"], PHP_URL_PATH);
    if (is_file($path)) {
        return false; 
    }
}

require_once(__DIR__ . '/vendor/autoload.php');

use Geekbrains\Application1\Application;

$app = new Application();
echo $app->run();
