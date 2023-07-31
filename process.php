<?php
session_start();

// Check if the form was submitted
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Hardcoded login credentials (Simulated login)
    $valid_username = 'JohnDoe'; // Replace 'JohnDoe' with the desired username
    $valid_password = 'password'; // Replace 'password' with the desired password

    // Get form data
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Validate the submitted credentials
    if ($username == $valid_username && $password == $valid_password) {
        // Login successful, set session variables
        $_SESSION['username'] = $username;

        // Redirect to the dashboard page (homepage.php)
        header('Location: dashboard.php');
        exit();
    } else {
        // Login failed, show error message
        echo "Username and/or password incorrect.";
    }
}
?>
