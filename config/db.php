<?php

return new PDO(
    "mysql:host=127.0.0.1;port=3307;dbname=sanggar;charset=utf8mb4",
    "root",
    "12345678",
    [
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
        PDO::ATTR_EMULATE_PREPARES => false
    ]
);