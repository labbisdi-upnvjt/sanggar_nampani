<?php

session_start();

define(
    'BASE_PATH',
    dirname(__DIR__)
);

$app = require BASE_PATH . '/config/app.php';

$db = require BASE_PATH . '/config/db.php';

require BASE_PATH . '/routes/web.php';

$page = $_GET['page'] ?? 'dashboard';

$route = $routes[$page] ?? null;

if (!$route) {

    http_response_code(404);

    die('404 Page Not Found');
}

$controllerFile =
    BASE_PATH .
    '/app/controllers/' .
    $route['controller'] .
    '.php';

if (!file_exists($controllerFile)) {

    http_response_code(404);

    die('404 Controller Not Found');
}

require_once $controllerFile;

$controllerName =
    $route['controller'];

$controller =
    new $controllerName();

$method =
    $route['method'];

$controller->$method();