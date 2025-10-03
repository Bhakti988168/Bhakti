<?php
include 'header.php';
echo '<section class="main-content"><div class="container">';

$message = "";
$message_type = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $first_name = $conn->real_escape_string($_POST['first_name']);
    $last_name = $conn->real_escape_string($_POST['last_name']);
    $email = $conn->real_escape_string($_POST['email']);
    $phone_number = $conn->real_escape_string($_POST['phone_number']);
    $registration_date = date('Y-m-d');

    if (!empty($first_name) && !empty($last_name) && !empty($email) && !empty($phone_number)) {
        $stmt = $conn->prepare("INSERT INTO members (first_name, last_name, email, phone_number, registration_date) VALUES (?, ?, ?, ?, ?)");
        $stmt->bind_param("sssss", $first_name, $last_name, $email, $phone_number, $registration_date);
        if ($stmt->execute()) {
            $message = "New member registered successfully!";
            $message_type = "success";
        } else {
            if ($conn->errno == 1062) {
                $message = "Error: This email address is already registered.";
            } else {
                $message = "Error: " . $stmt->error;
            }
            $message_type = "error";
        }
        $stmt->close();
    } else {
        $message = "Please fill in all fields.";
        $message_type = "error";
    }
    echo "<div class='message " . $message_type . "'>" . $message . "</div>";
    echo '<a href="register.php"><button style="margin-top:20px;">Back to Registration</button></a>';
}

echo '</div></section>';
include 'footer.php';
?>