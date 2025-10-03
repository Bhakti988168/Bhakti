<?php include 'header.php'; ?>

<section class="main-content">
    <div class="container">
        <h2>Garden Plot Directory</h2>
        <p>Here is a list of all plots in the garden and their current assignment status.</p>
        
        <table>
            <thead>
                <tr>
                    <th>Plot Number</th>
                    <th>Size</th>
                    <th>Currently Growing</th>
                    <th>Notes</th>
                    <th>Status</th>
                    <th>Assigned To</th>
                </tr>
            </thead>
            <tbody>
                <?php
                // UPDATED SQL QUERY: Select the new columns 'plant_type' and 'notes'
                $sql = "SELECT p.plot_id, p.plot_number, p.size, p.plant_type, p.notes, p.status, m.first_name, m.last_name 
                        FROM plots p 
                        LEFT JOIN members m ON p.assigned_member_id = m.member_id 
                        ORDER BY p.plot_number";
                $result = $conn->query($sql);

                if ($result->num_rows > 0) {
                    while($row = $result->fetch_assoc()) {
                        echo "<tr>";
                        echo "<td>" . htmlspecialchars($row['plot_number']) . "</td>";
                        echo "<td>" . htmlspecialchars($row['size']) . "</td>";
                        // ADDED: Display the new plant_type data
                        echo "<td>" . htmlspecialchars($row['plant_type']) . "</td>";
                        // ADDED: Display the new notes data
                        echo "<td>" . htmlspecialchars($row['notes']) . "</td>";
                        echo "<td>" . htmlspecialchars(ucfirst($row['status'])) . "</td>";
                        echo "<td>" . ($row['first_name'] ? htmlspecialchars($row['first_name'] . ' ' . $row['last_name']) : '<em>Available</em>') . "</td>";
                        echo "</tr>";
                    }
                } else {
                    echo "<tr><td colspan='6'>No plots found.</td></tr>";
                }
                ?>
            </tbody>
        </table>
        
        <div class="form-container">
            <h3>Assign a Plot</h3>
            <p>Assign an available plot to a registered member who does not currently have one.</p>
            <form action="assign_plot_process.php" method="POST">
                <div class="form-group">
                    <label for="plot_id">Select an Available Plot:</label>
                    <select name="plot_id" id="plot_id" required>
                        <option value="">-- Choose a Plot --</option>
                        <?php
                        $plot_sql = "SELECT plot_id, plot_number FROM plots WHERE status = 'available'";
                        $plot_result = $conn->query($plot_sql);
                        while($plot = $plot_result->fetch_assoc()) {
                            echo "<option value='" . $plot['plot_id'] . "'>" . htmlspecialchars($plot['plot_number']) . "</option>";
                        }
                        ?>
                    </select>
                </div>
                <div class="form-group">
                    <label for="member_id">Select a Member:</label>
                    <select name="member_id" id="member_id" required>
                         <option value="">-- Choose a Member --</option>
                        <?php
                        $member_sql = "SELECT member_id, first_name, last_name FROM members WHERE member_id NOT IN (SELECT assigned_member_id FROM plots WHERE assigned_member_id IS NOT NULL)";
                        $member_result = $conn->query($member_sql);
                        while($member = $member_result->fetch_assoc()) {
                            echo "<option value='" . $member['member_id'] . "'>" . htmlspecialchars($member['first_name'] . ' ' . $member['last_name']) . "</option>";
                        }
                        ?>
                    </select>
                </div>
                <button type="submit">Assign Plot</button>
            </form>
        </div>
    </div>
</section>

<?php include 'footer.php'; ?>