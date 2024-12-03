<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);


if (php_sapi_name() == 'cli-server') {
    $path = __DIR__ . parse_url($_SERVER["REQUEST_URI"], PHP_URL_PATH);
    if (is_file($path)) {
        return false; // Отдаем статический файл напрямую
    }
}

require_once(__DIR__ . '/vendor/autoload.php');

use Geekbrains\Application1\Application;

$app = new Application();
echo $app->run();
