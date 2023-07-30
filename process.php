<?php
$firebase_project_id = "bank-portal-4d74d";
$database_url = "https://$firebase_project_id.firebaseio.com/";

function writeToFirebase($node, $data) {
    global $database_url;
    $url = $database_url . $node . '.json';

    $ch = curl_init($url);
    curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "PUT");
    curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

    $response = curl_exec($ch);
    curl_close($ch);

    return json_decode($response, true);
}

// session_start();
// $serverName = "localhost";
// $DBuserName = "root";
// $passwordDB = "";
// $dbName = "bankbcnf";

// Check if the form was submitted
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Get form data
    $username = $_POST['username'];
    $password = $_POST['password'];

    // (B) CONNECT TO DATABASE
    try {
        // Initialize Firebase project settings and database reference
        $firebase_node_users = "Users";
        
        // Fetch user data from Firebase Realtime Database
        $url = $database_url . $firebase_node_users . '.json';
        $users_data = json_decode(file_get_contents($url), true);
        
        // Check if the provided username exists in the database
        $user_found = false;
        foreach ($users_data as $user_id => $user) {
            if ($user['username'] == $username) {
                $user_found = true;
                // Verify the password
                if (password_verify($password, $user['password'])) {
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
                }
            }
        }

        // If the username was not found in the database
        if (!$user_found) {
            echo "Username not found.";
            header("Location: index.html");
        }
    } catch (Exception $ex) {
        echo 'Error Not Connected: ' . $ex->getMessage();
    }
}
?>