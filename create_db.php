<?php

$host = getenv('DB_HOST') ?: '127.0.0.1';
$port = getenv('DB_PORT') ?: '3306';
$user = getenv('DB_USERNAME') ?: 'root';
$pass = getenv('DB_PASSWORD');
$database = getenv('DB_DATABASE') ?: 'cfarm_ir';

if ($pass === false || $pass === '') {
    fwrite(STDERR, "DB_PASSWORD is required.\n");
    exit(1);
}

try {
    $pdo = new PDO("mysql:host=$host;port=$port", $user, $pass);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $pdo->exec("CREATE DATABASE IF NOT EXISTS `{$database}` CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;");
    echo "Database created successfully\n";
} catch (PDOException $e) {
    fwrite(STDERR, "Database initialization failed.\n");
    exit(1);
}
