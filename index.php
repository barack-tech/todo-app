<?php
declare(strict_types=1);

require_once __DIR__ . '/db.php';

/**
 * Escape output for safe HTML rendering.
 */
function escapeHtml(string $value): string
{
    return htmlspecialchars($value, ENT_QUOTES, 'UTF-8');
}

/*
|--------------------------------------------------------------------------
| Handle all write operations (Create / Update / Delete)
|--------------------------------------------------------------------------
*/
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $action = $_POST['action'] ?? '';

    if ($action === 'add') {
        $task = trim((string)($_POST['task'] ?? ''));

        if ($task !== '') {
            // Keep values inside the VARCHAR(255) column limit.
            $task = mb_substr($task, 0, 255);

            $insertStatement = $conn->prepare('INSERT INTO tasks (task, done) VALUES (?, 0)');
            $insertStatement->bind_param('s', $task);
            $insertStatement->execute();
            $insertStatement->close();
        }
    }

    if ($action === 'toggle') {
        $taskId = filter_input(INPUT_POST, 'id', FILTER_VALIDATE_INT);

        if ($taskId !== false && $taskId !== null) {
            $done = isset($_POST['done']) ? 1 : 0;

            $toggleStatement = $conn->prepare('UPDATE tasks SET done = ? WHERE id = ?');
            $toggleStatement->bind_param('ii', $done, $taskId);
            $toggleStatement->execute();
            $toggleStatement->close();
        }
    }

    if ($action === 'delete') {
        $taskId = filter_input(INPUT_POST, 'id', FILTER_VALIDATE_INT);

        if ($taskId !== false && $taskId !== null) {
            $deleteStatement = $conn->prepare('DELETE FROM tasks WHERE id = ?');
            $deleteStatement->bind_param('i', $taskId);
            $deleteStatement->execute();
            $deleteStatement->close();
        }
    }

    // Post/Redirect/Get prevents duplicate form submissions on refresh.
    header('Location: ' . $_SERVER['PHP_SELF']);
    exit;
}

/*
|--------------------------------------------------------------------------
| Read all tasks for display
|--------------------------------------------------------------------------
*/
$tasks = [];
$tasksResult = $conn->query('SELECT id, task, done, created_at FROM tasks ORDER BY created_at DESC, id DESC');

while ($row = $tasksResult->fetch_assoc()) {
    $tasks[] = $row;
}

$tasksResult->close();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My To-Do List</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="public/styles.css">
</head>
<body>
    <main class="app-shell">
        <section class="todo-card">
            <header class="app-header">
                <h1>My To-Do List</h1>
                <p>Keep your day organized and focused.</p>
            </header>

            <form class="task-form" action="" method="post">
                <input type="hidden" name="action" value="add">
                <label class="sr-only" for="new-task">Add a new task</label>
                <input
                    type="text"
                    id="new-task"
                    name="task"
                    placeholder="Add a new task..."
                    autocomplete="off"
                    maxlength="255"
                    required
                >
                <button type="submit">Add</button>
            </form>

            <ul class="task-list">
                <?php if (empty($tasks)): ?>
                    <li class="task-item">
                        <span class="task-text">No tasks yet. Add your first one above.</span>
                    </li>
                <?php endif; ?>

                <?php foreach ($tasks as $task): ?>
                    <li class="task-item <?php echo (int)$task['done'] === 1 ? 'is-complete' : ''; ?>">
                        <div class="task-main">
                            <form action="" method="post" style="margin: 0;">
                                <input type="hidden" name="action" value="toggle">
                                <input type="hidden" name="id" value="<?php echo (int)$task['id']; ?>">
                                <input
                                    type="checkbox"
                                    name="done"
                                    value="1"
                                    onchange="this.form.submit()"
                                    <?php echo (int)$task['done'] === 1 ? 'checked' : ''; ?>
                                    aria-label="Mark task <?php echo (int)$task['id']; ?> as done or undone"
                                >
                            </form>

                            <span class="task-text">
                                <?php echo escapeHtml((string)$task['task']); ?>
                                <small style="display:block;color:#667085;">
                                    ID: <?php echo (int)$task['id']; ?> |
                                    Status: <?php echo (int)$task['done'] === 1 ? 'Done' : 'Undone'; ?>
                                </small>
                            </span>
                        </div>

                        <form action="" method="post" style="margin: 0;">
                            <input type="hidden" name="action" value="delete">
                            <input type="hidden" name="id" value="<?php echo (int)$task['id']; ?>">
                            <button class="delete-btn" type="submit" aria-label="Delete task <?php echo (int)$task['id']; ?>">×</button>
                        </form>
                    </li>
                <?php endforeach; ?>
            </ul>
        </section>
    </main>
</body>
</html>
