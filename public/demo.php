<?php
require_once '../Init.php';

try {
    Init::boot("../src/*");

    $controller = new DemoController();
    $controller->indexAction();
}
catch (\Throwable $e) {
    http_response_code(500);
    echo '500 Internal Server Error';
}