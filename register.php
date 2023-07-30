<?php

$firebase_project_id = "bank-portal-4d74d";
$database_url = "https://$firebase_project_id.firebaseio.com/";

// funtion to send data to Firebase

function writeToFirebase($node, $data) {
	global $database_url;
	$url = $database_url.$node.'json';

	$ch = curl.init($url);
	curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
	curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

	$response = curl_exec($ch);
	curl_close($ch);

	return json_decode($response, true);
}


// $serverName = "localhost";
// $userName = "root";
// $passwordDB = "";
// $dbName = "bankbcnf";

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
		// Save user data to database or file
	
		$user_data = array(
			"name" => $fname,
        "address" => $addy,
        "phone_number" => $Pnum,
        "password" => password_hash($usrpwd, PASSWORD_DEFAULT) // Hash the password
		);
		
		$firebase_node = "Users/$user_name"; // Use the username as the unique ID
    	$response = writeToFirebase($firebase_node, $user_data);

		if(isset($response['name'])){
			echo "User created!";
			header('Location: index.html');
			exit;
		}
		else{
			exho "Error creating user.";
		}
}
?>