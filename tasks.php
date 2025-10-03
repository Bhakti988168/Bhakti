<?php include 'header.php'; ?>

<section class="main-content">
    <div class="container">
        <h2>Community Task Board</h2>
        <p>Find out what needs doing around the garden. Pitch in and help out!</p>

        <h3>Open Tasks</h3>
        <?php
        $open_tasks_sql = "SELECT * FROM tasks WHERE status = 'open' ORDER BY due_date ASC";
        $open_result = $conn->query($open_tasks_sql);
        if ($open_result->num_rows > 0) {
            while($task = $open_result->fetch_assoc()) {
                echo "<div class='task-card'>";
                echo "<h3>" . htmlspecialchars($task['task_name']) . "</h3>";
                echo "<p>" . htmlspecialchars($task['description']) . "</p>";
                echo "<p><strong>Due Date:</strong> " . ($task['due_date'] ? htmlspecialchars($task['due_date']) : 'N/A') . "</p>";
                
                // --- NEW: Action Buttons ---
                echo "<div class='task-actions'>";
                echo "<a href='edit_task.php?id=" . $task['task_id'] . "' class='button-edit'>Edit</a>";
                echo "<a href='delete_task.php?id=" . $task['task_id'] . "' class='button-delete' onclick=\"return confirm('Are you sure you want to delete this task?');\">Delete</a>";
                echo "</div>";
                // --- End of Action Buttons ---

                echo "</div>";
            }
        } else {
            echo "<p>No open tasks at the moment. Great job, everyone!</p>";
        }
        ?>

        <div class="form-container">
            <h3>Add a New Task</h3>
            <form action="add_task_process.php" method="POST">
                <div class="form-group">
                    <label for="task_name">Task Name:</label>
                    <input type="text" name="task_name" id="task_name" required>
                </div>
                <div class="form-group">
                    <label for="description">Description:</label>
                    <textarea name="description" id="description" rows="3"></textarea>
                </div>
                 <div class="form-group">
                    <label for="due_date">Due Date (Optional):</label>
                    <input type="date" name="due_date" id="due_date">
                </div>
                <button type="submit">Add Task</button>
            </form>
        </div>
    </div>
</section>

<?php include 'footer.php'; ?>
