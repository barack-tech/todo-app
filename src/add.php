<?php
declare(strict_types=1);

require_once __DIR__ . '/../config/db.php';

$task = trim((string)($_POST['task'] ?? ''));

if ($task === '') {
    header('Location: ../index.php');
    exit;
}

$task = mb_substr($task, 0, 255);

$stmt = $conn->prepare('INSERT INTO tasks (task, done) VALUES (?, 0)');
$stmt->bind_param('s', $task);
$stmt->execute();
$stmt->close();

header('Location: ../index.php');
exit;