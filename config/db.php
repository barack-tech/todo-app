<?php
declare(strict_types=1);

$dbHost = '127.0.0.1';
$dbUser = 'root';
$dbPass = '';
$dbName = 'todo_app';

mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);

try {
    $conn = new mysqli($dbHost, $dbUser, $dbPass, $dbName);
    $conn->set_charset('utf8mb4');
} catch (mysqli_sql_exception $e) {
    http_response_code(500);
    exit('Database connection failed: ' . htmlspecialchars($e->getMessage(), ENT_QUOTES, 'UTF-8'));
}

// mysql -u root -p < config/schema.sql