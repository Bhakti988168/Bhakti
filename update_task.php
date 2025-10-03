<?php
require_once 'db_connect.php';

// Check if the form was submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    
    // Validate and sanitize inputs
    $task_id = (int)$_POST['task_id'];
    $task_name = $conn->real_escape_string($_POST['task_name']);
    $description = $conn->real_escape_string($_POST['description']);
    $due_date = !empty($_POST['due_date']) ? $conn->real_escape_string($_POST['due_date']) : NULL;

    if(!empty($task_id) && !empty($task_name)) {
        // Prepare an update statement
        $stmt = $conn->prepare("UPDATE tasks SET task_name = ?, description = ?, due_date = ? WHERE task_id = ?");
        $stmt->bind_param("sssi", $task_name, $description, $due_date, $task_id);

        // Execute the statement
        if($stmt->execute()) {
            header("Location: tasks.php");
            exit();
        } else {
            echo "Error updating record: " . $conn->error;
        }
        $stmt->close();
    }
    $conn->close();
} else {
    header("Location: tasks.php");
    exit();
}
?>