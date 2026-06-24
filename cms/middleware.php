<?php

function auth(array $route): void
{
    if (!$route['auth']) {
        return;
    }

    if (!isset($_SESSION['user'])) {
        header('Location: index.php?page=login');
        exit;
    }
}
?>