<?php include 'header.php'; ?>

<div class="hero">
    <div class="container">
        <h1>Welcome to the GreenThumb Hub</h1>
        <p>Your central place to connect, share, and grow with our community.</p>
    </div>
</div>

<section class="main-content">
    <div class="container">
        <h2 class="section-title">Garden at a Glance</h2>
        <div class="stats-container">
            <?php
                // Fetch total members
                $member_result = $conn->query("SELECT COUNT(*) as total FROM members");
                $total_members = $member_result->fetch_assoc()['total'];

                // Fetch available plots
                $plot_result = $conn->query("SELECT COUNT(*) as total FROM plots WHERE status = 'available'");
                $available_plots = $plot_result->fetch_assoc()['total'];

                // Fetch open tasks
                $task_result = $conn->query("SELECT COUNT(*) as total FROM tasks WHERE status = 'open'");
                $open_tasks = $task_result->fetch_assoc()['total'];
            ?>
            <div class="stat-card">
                <span class="stat-icon">👥</span>
                <h3><?php echo $total_members; ?></h3>
                <p>Total Members</p>
            </div>
            <div class="stat-card">
                <span class="stat-icon">🌱</span>
                <h3><?php echo $available_plots; ?></h3>
                <p>Available Plots</p>
            </div>
            <div class="stat-card">
                <span class="stat-icon">📝</span>
                <h3><?php echo $open_tasks; ?></h3>
                <p>Open Tasks</p>
            </div>
        </div>

        <div class="cta-container">
             <h2 class="section-title">Get Involved</h2>
             <p>Ready to dig in? Check the plot directory or join our community today.</p>
             <a href="plots.php" class="cta-button">View Plots</a>
             <a href="register.php" class="cta-button secondary">Join Now</a>
        </div>
    </div>
</section>

<?php include 'footer.php'; ?>