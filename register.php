<?php
$serverName = "localhost";
$userName = "root";
$passwordDB = "";
$dbName = "bankbcnf";
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
	

// (B) CONNECT TO DATABASE
try{
    // Connect To MySQL Database
    $con = new PDO("mysql:host=$serverName;dbname=$dbName", $userName, $passwordDB);

    $con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    echo "Connection successful";
    $sql = "INSERT INTO user ( UserID, Name, Address, PhoneNumber, password)
	VALUES ('$user_name', '$fname', '$addy', '$Pnum', '$usrpwd')";
	$con->exec($sql);
	echo "User created!";
	// Redirect to success page
	header('Location: index.html');
	exit;
} catch (PDOException $ex) {
    
    echo 'Error Not Connected: '.$ex->getMessage();
    
}
	

	
	
}
?>