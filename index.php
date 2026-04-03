<?php
declare(strict_types=1);

require_once __DIR__ . '/config/db.php';

$tasks = [];
$result = $conn->query('SELECT id, task, done, created_at FROM tasks ORDER BY created_at DESC, id DESC');

while ($row = $result->fetch_assoc()) {
    $tasks[] = $row;
}

$result->close();

require_once __DIR__ . '/views/tasks.php';