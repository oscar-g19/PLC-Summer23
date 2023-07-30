<?php

$firebase_project_id = "bank-portal-4d74d";
$database_url = "https://$firebase_project_id.firebaseio.com/";

// Function to send data to Firebase Realtime Database
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

// Check if the form was submitted
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
	// Get form data and validate input
	$usr_acct = filter_var($_POST['account_id'], FILTER_SANITIZE_NUMBER_INT);
	$withdraw = filter_var($_POST['withdraw'], FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION);
	if (!is_numeric($usr_acct) || !is_numeric($withdraw)) {
		die("Invalid input");
	}

	// (B) CONNECT TO DATABASE
	try{
        // Initialize Firebase project settings and database reference
        $firebase_node_users = "Users/$usr_acct/Balance";
        $firebase_node_transactions = "Transactions/$usr_acct";
        
        // Update the balance in the Users node
        $balance_data = array('Balance' => $withdraw);
        writeToFirebase($firebase_node_users, $balance_data);

        // Record the transaction in the Transactions node
        $transaction_data = array(
            'type' => 'Withdraw',
            'amount' => $withdraw
        );
        $timestamp = time();
        writeToFirebase("$firebase_node_transactions/$timestamp", $transaction_data);

        print("Withdraw successful!");
        // Redirect to success page
        header('Location: homepage.php');
        exit;
    } catch (Exception $ex) {
        echo 'Withdraw failed: ' . $ex->getMessage();
    }
}
?>
