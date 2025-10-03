<?php include 'header.php'; ?>

<section class="main-content">
    <div class="container">
        <h2>Contact Us</h2>
        <p>Have questions? Want to get involved? Reach out to us!</p>
        <ul>
            <li><strong>Email:</strong> coordinator@greenthumb.example.com</li>
            <li><strong>Location:</strong> 123 Community Way, Garden City</li>
        </ul>
        <div class="form-container">
            <h3>Send a Message</h3>
            <p>(This form is for demonstration purposes only and does not send emails.)</p>
            <form>
                 <div class="form-group">
                    <label for="name">Your Name:</label>
                    <input type="text" id="name" name="name" required>
                </div>
                 <div class="form-group">
                    <label for="email">Your Email:</label>
                    <input type="email" id="email" name="email" required>
                </div>
                 <div class="form-group">
                    <label for="message">Message:</label>
                    <textarea id="message" name="message" rows="5" required></textarea>
                </div>
                <button type="submit">Send Message</button>
            </form>
        </div>
    </div>
</section>

<?php include 'footer.php'; ?>