<?php
session_start();

// Load the JSON data from the database.json file
$jsonData = file_get_contents('PLC-Summer23/database.json');
$database = json_decode($jsonData, true);

// User input
$username = $_POST['username'];
$password = $_POST['password'];

try {
    // Check if the user exists in the JSON database
    if (array_key_exists($username, $database['Users']) && password_verify($password, $database['Users'][$username]['password'])) {
        // Login successful, set session variables or redirect to dashboard
        $_SESSION['username'] = $username;
        echo "User logged in!";
        // Redirect to success page
        header('Location: homepage.php');
        exit();
    } else {
        // Login failed, show error message
        echo "Username and/or password incorrect.";
        header("Location: index.html");
        exit();
    }
} catch (Exception $ex) {
    echo 'Error: '.$ex->getMessage();
}
