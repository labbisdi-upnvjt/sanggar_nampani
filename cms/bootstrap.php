<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

#bootstrap ini berperan seperti base controller
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

/*
|--------------------------------------------------------------------------
| Base Path
|--------------------------------------------------------------------------
*/
define('BASE_PATH', dirname(__DIR__));

/*
|--------------------------------------------------------------------------
| Configuration
|--------------------------------------------------------------------------
*/
$app = require BASE_PATH . '/config/app.php';
$db = require BASE_PATH . '/config/db.php';
$GLOBALS['db'] = $db;

/*
|--------------------------------------------------------------------------
| CMS Routes
|--------------------------------------------------------------------------
*/
require_once __DIR__ . '/routes.php';

/*
|--------------------------------------------------------------------------
| Middleware
|--------------------------------------------------------------------------
*/
require_once __DIR__ . '/middleware.php';

/*
|--------------------------------------------------------------------------
| Flash Message Helper
|--------------------------------------------------------------------------
*/
function flash(string $key)
{
    if (!isset($_SESSION[$key])) {
        return null;
    }
    $message = $_SESSION[$key];
    unset($_SESSION[$key]);
    return $message;
}

/*
|--------------------------------------------------------------------------
| Router
|--------------------------------------------------------------------------
*/
$page = $_GET['page'] ?? 'dashboard';
$route = $routes[$page] ?? null;

if (!$route) {
    http_response_code(404);
    die('404 Page Not Found');
}

// Allow login page without auth check always
if ($page !== 'login') {
    auth($route);
}

/*
|--------------------------------------------------------------------------
| Dispatch POST Actions
|--------------------------------------------------------------------------
*/
require_once __DIR__ . '/content.php';

/*
|--------------------------------------------------------------------------
| Load Layout & View
|--------------------------------------------------------------------------
*/
require_once __DIR__ . '/includes/layout_start.php';
require_once __DIR__ . '/' . $route['view'];
require_once __DIR__ . '/includes/layout_end.php';
?>