<?php
require_once 'db_connect.php';

// Check if an ID was  passed in the URL
if(isset($_GET['id']) && !empty($_GET['id'])) {
    $task_id = (int)$_GET['id'];

    // Prepare a delete  statement
    $stmt = $conn->prepare("DELETE FROM tasks WHERE task_id = ?");
    $stmt->bind_param("i", $task_id);

    // Execute the statement
    if($stmt->execute()) {
        // Redirect back  to the tasks page upon success
        header("Location: tasks.php");
        exit();
    } else {
        echo "Error deleting record: " . $conn->error;
    }

    $stmt->close();
    $conn->close();
} else {
    // If no ID was provided, redirect back
    header("Location: tasks.php");
    exit();
}
?>