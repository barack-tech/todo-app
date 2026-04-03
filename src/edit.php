<?php
declare(strict_types=1);

require_once __DIR__ . '/../config/db.php';

$taskId = filter_input(INPUT_POST, 'id', FILTER_VALIDATE_INT);
$task   = trim((string)($_POST['task'] ?? ''));

if ($taskId === false || $taskId === null || $task === '') {
    header('Location: ../index.php');
    exit;
}

$task = mb_substr($task, 0, 255);

$stmt = $conn->prepare('UPDATE tasks SET task = ? WHERE id = ?');
$stmt->bind_param('si', $task, $taskId);
$stmt->execute();
$stmt->close();

header('Location: ../index.php');
exit;