<?php include 'header.php'; ?>

<section class="main-content">
    <div class="container">
        <div class="form-container">
            <h2>Join Our Community Garden!</h2>
            <form action="register_process.php" method="POST">
                <div class="form-group">
                    <label for="first_name">First Name:</label>
                    <input type="text" id="first_name" name="first_name" required>
                </div>
                <div class="form-group">
                    <label for="last_name">Last Name:</label>
                    <input type="text" id="last_name" name="last_name" required>
                </div>
                <div class="form-group">
                    <label for="email">Email:</label>
                    <input type="email" id="email" name="email" required>
                </div>
                <div class="form-group">
                    <label for="phone_number">Phone Number:</label>
                    <input type="tel" id="phone_number" name="phone_number" required>
                </div>
                <button type="submit">Register</button>
            </form>
        </div>
    </div>
</section>

<?php include 'footer.php'; ?>