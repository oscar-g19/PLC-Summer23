<?php
// Check if the form was submitted
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Get form data
    $user_name = $_POST['uid'];
    $fname = $_POST['name'];
    $addy = $_POST['address'];
    $Pnum = $_POST['phone_number'];
    $usrpwd = $_POST['password'];
    $confirm_password = $_POST['confirm_password'];

    // Validate form data
    if ($usrpwd != $confirm_password) {
        echo "Passwords do not match.";
        exit;
    }

    // Load the JSON data from the database.json file
    $jsonData = file_get_contents('PLC-Summer23/database.json');
    $database = json_decode($jsonData, true);

    // Check if the user already exists in the JSON database
    if (isset($database['Users'][$user_name])) {
        echo "Username already exists.";
        exit;
    }

    // Save user data to the JSON database
    $database['Users'][$user_name] = array(
        "name" => $fname,
        "address" => $addy,
        "phone_number" => $Pnum,
        "password" => $usrpwd
    );

    // Write the updated JSON data back to the file
    $jsonData = json_encode($database, JSON_PRETTY_PRINT);
    file_put_contents('database.json', $jsonData);

    echo "User created!";
    // Redirect to success page
    header('Location: index.html');
    exit;
}
?>
