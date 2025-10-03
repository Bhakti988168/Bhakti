<?php 
include 'header.php'; 

// Check for task ID in URL
if(isset($_GET['id']) && !empty($_GET['id'])) {
    $task_id = (int)$_GET['id'];

    // Fetch the specific task from the database
    $stmt = $conn->prepare("SELECT * FROM tasks WHERE task_id = ?");
    $stmt->bind_param("i", $task_id);
    $stmt->execute();
    $result = $stmt->get_result();

    if($result->num_rows == 1) {
        $task = $result->fetch_assoc();
    } else {
        // No task found with that ID, redirect
        header("Location: tasks.php");
        exit();
    }
    $stmt->close();
} else {
    header("Location: tasks.php");
    exit();
}
?>

<section class="main-content">
    <div class="container">
        <div class="form-container">
            <h2>Edit Task</h2>
            <form action="update_task.php" method="POST">
                <input type="hidden" name="task_id" value="<?php echo htmlspecialchars($task['task_id']); ?>">

                <div class="form-group">
                    <label for="task_name">Task Name:</label>
                    <input type="text" name="task_name" id="task_name" value="<?php echo htmlspecialchars($task['task_name']); ?>" required>
                </div>
                <div class="form-group">
                    <label for="description">Description:</label>
                    <textarea name="description" id="description" rows="3"><?php echo htmlspecialchars($task['description']); ?></textarea>
                </div>
                 <div class="form-group">
                    <label for="due_date">Due Date (Optional):</label>
                    <input type="date" name="due_date" id="due_date" value="<?php echo htmlspecialchars($task['due_date']); ?>">
                </div>
                <button type="submit">Update Task</button>
            </form>
        </div>
    </div>
</section>

<?php include 'footer.php'; ?>