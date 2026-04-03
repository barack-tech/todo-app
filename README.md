# To-Do App In PHP And MYSQL


## Screenshots
### Initial App Preview

<img width="1017" height="522" alt="Initial Preview" src="https://github.com/user-attachments/assets/21c04d5c-a8e5-470f-a05d-64fd0d93d882" />

### Tasks Added Preview

<img width="862" height="901" alt="Tasks added preview" src="https://github.com/user-attachments/assets/ac77aed4-a681-4396-9551-4b2420230a76" />

### Tasks Marked As Done

<img width="800" height="911" alt="Tasks marked done" src="https://github.com/user-attachments/assets/22ee2177-ecbc-4aa1-ba2b-9f06578b1500" />

### Final App Preview

<img width="1076" height="912" alt="Final edit preview" src="https://github.com/user-attachments/assets/10b3d08a-8f41-44c1-83bb-f9b207f8fd59" />




A simple to-do list application built with PHP, MySQL, HTML, Javascript and CSS.
It supports full CRUD operations:

- Create tasks.
- Read/display tasks.
- Update task completion status. (done/undone)
- Edit/Rename tasks.
- Delete tasks. 


## Project Structure

```
todo-app/
├── config/
│   ├── db.php          # Database connection
│   └── schema.sql      # Import once to set up the database
├── src/
│   ├── add.php         # Add task
│   ├── delete.php      # Delete task
│   ├── edit.php        # Edit task
│   └── toggle.php      # Toggle task done/undone
├── views/
│   └── tasks.php       # HTML rendering
├── public/
│   └── styles.css      # Styling
└── index.php           # Entry point
```

## Requirements

- PHP
- MySQL
- PHP MySQLi extension enabled
- A local server environment - XAMPP

## Setup

1. Clone the repository.
2. Import the database schema:
3. Update credentials in `config/db.php` if needed.
4. Serve the project via XAMPP or any local PHP server.

## Features

- Add tasks
- Mark tasks as done or undone
- Inline edit tasks
- Delete tasks
- Post/Redirect/Get pattern to prevent duplicate form submissions
- Prepared statements throughout to prevent SQL injection

