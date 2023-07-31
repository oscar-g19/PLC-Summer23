<?php
// Check if the form was submitted
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Get form data and validate input
    $usr_acct = filter_var($_POST['account_id'], FILTER_SANITIZE_NUMBER_INT);
    $deposit = filter_var($_POST['deposit'], FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION);
    if (!is_numeric($usr_acct) || !is_numeric($deposit)) {
        die("Invalid input");
    }

    // Load the JSON data from the database.json file
    $jsonData = file_get_contents('PLC-Summer23/database.json');
    $database = json_decode($jsonData, true);

    // Check if the user account exists in the JSON database
    if (!isset($database['Accounts'][$usr_acct])) {
        die("Account not found.");
    }

    // Update the account balance in the JSON database
    $database['Accounts'][$usr_acct]['Balance'] += $deposit;
    $database['Accounts'][$usr_acct]['AccountDate'] = date('Y-m-d H:i:s');

    // Write the updated JSON data back to the file
    $jsonData = json_encode($database, JSON_PRETTY_PRINT);
    file_put_contents('database.json', $jsonData);

    echo "Deposit successful!";
    // Redirect to success page
    header('Location: homepage.php');
    exit;
}
?>
