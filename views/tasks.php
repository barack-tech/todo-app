<?php declare(strict_types=1); ?>

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

            <form class="task-form" action="src/add.php" method="post">
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
                            <form action="src/toggle.php" method="post">
                                <input type="hidden" name="id" value="<?php echo (int)$task['id']; ?>">
                                <input
                                    type="checkbox"
                                    name="done"
                                    value="1"
                                    onchange="this.form.submit()"
                                    <?php echo (int)$task['done'] === 1 ? 'checked' : ''; ?>
                                    aria-label="Mark task as done or undone"
                                >
                            </form>

                            <span class="task-text">
                                <?php echo htmlspecialchars((string)$task['task'], ENT_QUOTES, 'UTF-8'); ?>
                            </span>
                        </div>

                        <form action="src/delete.php" method="post">
                            <input type="hidden" name="id" value="<?php echo (int)$task['id']; ?>">
                            <button class="delete-btn" type="submit" aria-label="Delete task">×</button>
                        </form>
                    </li>
                <?php endforeach; ?>
            </ul>
        </section>
    </main>
</body>
</html>