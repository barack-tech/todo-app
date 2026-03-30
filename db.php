<?php
declare(strict_types=1);

/*
|--------------------------------------------------------------------------
| MySQL configuration
|--------------------------------------------------------------------------
| Update these values if your local MySQL credentials differ.
*/
$dbHost = '127.0.0.1';
$dbUser = 'root';
$dbPass = '';
$dbName = 'todo_app';

mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);

try {
    // Step 1: Connect without selecting a database so we can create it safely.
    $bootstrapConnection = new mysqli($dbHost, $dbUser, $dbPass);
    $bootstrapConnection->set_charset('utf8mb4');
    $bootstrapConnection->query(
        "CREATE DATABASE IF NOT EXISTS `{$dbName}` CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci"
    );
    $bootstrapConnection->close();

    // Step 2: Connect to the target database.
    $conn = new mysqli($dbHost, $dbUser, $dbPass, $dbName);
    $conn->set_charset('utf8mb4');

    // Step 3: Create tasks table if it does not exist.
    $conn->query(
        "CREATE TABLE IF NOT EXISTS tasks (
            id INT AUTO_INCREMENT PRIMARY KEY,
            task VARCHAR(255) NOT NULL,
            done TINYINT(1) DEFAULT 0,
            created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
        ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci"
    );
} catch (mysqli_sql_exception $exception) {
    http_response_code(500);
    exit('Database connection/setup failed: ' . htmlspecialchars($exception->getMessage(), ENT_QUOTES, 'UTF-8'));
}
