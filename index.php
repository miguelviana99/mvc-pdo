<?php
require_once(__DIR__ . '/core/App.php');
try {
    $app = new App();

    $app->autoload();
    $app->config();
    $app->start();

} catch (\Exception $e) {
    echo $e->getMessage();
}
