<?php
include_once 'config.php';
include_once 'functions.php';

// Handle form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['title']) && isset($_POST['description'])) {
        $title = $_POST['title'];
        $description = $_POST['description'];
        addTask($title, $description);
        header("Location: index.php");
        exit();
    }
    if (isset($_POST['task_id'])) {
        $taskId = $_POST['task_id'];
        markAsCompleted($taskId);
        header("Location: index.php");
        exit();
    }
    if (isset($_POST['delete_task_id'])) {
        $deleteTaskId = $_POST['delete_task_id'];
        deleteTask($deleteTaskId);
        header("Location: index.php");
        exit();
    }
}

// Get tasks from the database
$tasks = getTasks();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>To-Do List</title>
 <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">

    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <div class="container">
        <h1>To-Do List</h1>
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
            <input type="text" name="title" class="form-control" placeholder="Title" required>
            <textarea name="description" class="form-control" placeholder="Description"></textarea>
            <button  class="form-control"type="submit">Add Task</button>
        </form>
        <ul>
            <?php foreach ($tasks as $task): ?>
                <li>
                    <span ><?php echo $task['title']; ?></span>
                    <span><?php echo $task['description']; ?></span>
                    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
                        <input type="hidden" name="task_id" value="<?php echo $task['id']; ?>">
                        <button type="submit">Mark as Completed</button>
                    </form>
                    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
                        <input type="hidden" name="delete_task_id" value="<?php echo $task['id']; ?>">
                        <button type="submit">Delete</button>
                    </form>
                </li>
            <?php endforeach; ?>
        </ul>
    </div>
</body>
</html>
