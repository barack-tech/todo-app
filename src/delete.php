<?php
declare(strict_types=1);

require_once __DIR__ . '/../config/db.php';

$taskId = filter_input(INPUT_POST, 'id', FILTER_VALIDATE_INT);

if ($taskId === false || $taskId === null) {
    header('Location: ../index.php');
    exit;
}

$stmt = $conn->prepare('DELETE FROM tasks WHERE id = ?');
$stmt->bind_param('i', $taskId);
$stmt->execute();
$stmt->close();

header('Location: ../index.php');
exit;