# My To-Do List (PHP + MySQL)

A simple to-do list application built with PHP, MySQL, HTML, and CSS.
It supports full CRUD operations:

- Create tasks
- Read/display tasks
- Update task completion status (done/undone)
- Delete tasks

The app automatically creates its database and table on first run.

## Project Structure

- `index.php` - Main app logic and UI rendering (handles all CRUD actions).
- `db.php` - MySQL connection and automatic database/table creation.
- `styles.css` - Frontend styling.

## Requirements

- PHP 8.0+ (recommended)
- MySQL 5.7+ or MariaDB 10.3+
- PHP MySQLi extension enabled
- A local server environment (XAMPP, WAMP, Laragon, MAMP, or built-in PHP server)

## Database Setup (Automatic)

No manual SQL import is required.

On startup, `db.php` will automatically:

1. Connect to MySQL server.
2. Create database `todo_app` if it does not exist.
3. Create table `tasks` if it does not exist.

### Table Schema

`tasks`

- `id` INT AUTO_INCREMENT PRIMARY KEY
- `task` VARCHAR(255) NOT NULL
- `done` TINYINT(1) DEFAULT 0
- `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP

## Configuration

Open `db.php` and update credentials if needed:

```php
$dbHost = '127.0.0.1';
$dbUser = 'root';
$dbPass = '';
$dbName = 'todo_app';
```

## How to Run

## Option A: XAMPP/WAMP/Laragon

1. Place the project folder inside your web root (for example, `htdocs`).
2. Start Apache and MySQL.
3. Open in browser:
   - `http://localhost/To%20Do%20App/`
   - or your matching local path

## Option B: PHP Built-In Server

From the project directory, run:

```bash
php -S localhost:8000
```

Then open:

`http://localhost:8000`

Note: MySQL server must still be running for database access.

## CRUD Flow

All CRUD actions are handled in `index.php` using `POST` requests and prepared statements.

### 1) Add Task (Create)

- Form submits with `action=add` and `task`.
- Input is trimmed and capped at 255 chars.
- Insert query:
  - `INSERT INTO tasks (task, done) VALUES (?, 0)`

### 2) Display Tasks (Read)

- Query:
  - `SELECT id, task, done, created_at FROM tasks ORDER BY created_at DESC, id DESC`
- Each task renders with:
  - Task text
  - Completion checkbox
  - Delete button
  - ID and status text

### 3) Toggle Done/Undone (Update)

- Checkbox form submits `action=toggle`, `id`, and optional `done=1`.
- If checkbox is checked, `done=1`; otherwise `done=0`.
- Update query:
  - `UPDATE tasks SET done = ? WHERE id = ?`

### 4) Delete Task (Delete)

- Delete form submits `action=delete` and `id`.
- Delete query:
  - `DELETE FROM tasks WHERE id = ?`

## Security and Validation

The app includes basic security measures:

- Prepared statements for all INSERT/UPDATE/DELETE queries (SQL injection protection).
- `filter_input(..., FILTER_VALIDATE_INT)` for task IDs.
- `htmlspecialchars()` when rendering task text (XSS protection).
- Post/Redirect/Get pattern to prevent duplicate submissions on refresh.

## Frontend Integration Notes

This backend is server-rendered and already integrated with the current HTML/CSS.
If you later switch to AJAX or a JavaScript frontend, you can reuse the same CRUD logic by moving it into dedicated endpoints.

## Troubleshooting

- **Cannot connect to MySQL**
  - Verify `db.php` credentials and ensure MySQL service is running.
- **`Access denied for user`**
  - Check username/password and host.
- **Page loads but no style**
  - Ensure `styles.css` is in the same directory as `index.php`.
- **Checkbox/delete not updating**
  - Confirm `POST` is enabled and no PHP errors are shown in server logs.

## Future Improvements (Optional)

- Add CSRF protection tokens.
- Add task edit functionality.
- Add due dates and priority.
- Add pagination/search for larger task lists.
- Move inline styles in `index.php` into `styles.css`.
