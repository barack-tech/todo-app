# My To-Do App (PHP + MySQL)


## Screenshots
### Initial App Preview

<img width="1017" height="522" alt="Initial Preview" src="https://github.com/user-attachments/assets/21c04d5c-a8e5-470f-a05d-64fd0d93d882" />

### Tasks Added Preview

<img width="862" height="901" alt="Tasks added preview" src="https://github.com/user-attachments/assets/ac77aed4-a681-4396-9551-4b2420230a76" />

###Tasks Marked As Done

<img width="800" height="911" alt="Tasks marked done" src="https://github.com/user-attachments/assets/22ee2177-ecbc-4aa1-ba2b-9f06578b1500" />



A simple to-do list application built with PHP, MySQL, HTML, and CSS.
It supports full CRUD operations:

- Create tasks
- Read/display tasks
- Update task completion status (done/undone)
- Delete tasks


## Project Structure

- `index.php` - Main app logic and UI rendering (handles all CRUD actions).
- `db.php` - MySQL connection and automatic database/table creation.
- `styles.css` - Frontend styling.

## Requirements

- PHP 8.0+
- MySQL 5.7+
- PHP MySQLi extension enabled
- A local server environment (XAMPP, WAMP, Laragon, MAMP, or built-in PHP server)

## Database Setup

No manual SQL import is required. (Automatic)

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



## Future Improvements (Optional)

- Add task edit functionality.


