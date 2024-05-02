<?php
// Include config file
include_once 'config.php';

// Function to add a task
function addTask($title, $description) {
    global $conn;
    $sql = "INSERT INTO todo (title, description) VALUES (?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ss", $title, $description);
    $stmt->execute();
    $stmt->close();
}

// Function to get all tasks
function getTasks() {
    global $conn;
    $sql = "SELECT * FROM todo";
    $result = $conn->query($sql);
    $tasks = [];
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $tasks[] = $row;
        }
    }
    return $tasks;
}

// Function to mark a task as completed
function markAsCompleted($taskId) {
    global $conn;
    $sql = "UPDATE todo SET completed = 1 WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $taskId);
    $stmt->execute();
    $stmt->close();
}

// Function to delete a task
function deleteTask($taskId) {
    global $conn;
    $sql = "DELETE FROM todo WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $taskId);
    $stmt->execute();
    $stmt->close();
}
?>
