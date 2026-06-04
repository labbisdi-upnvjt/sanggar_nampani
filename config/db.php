<?php

try {

    return new PDO(
        "mysql:host=127.0.0.1;port=3307;dbname=sanggar;charset=utf8mb4",
        "root",
        "12345678" #password hint : brian
    );

} catch (PDOException $e) {

    die("Database connection failed : " . $e->getMessage());

}