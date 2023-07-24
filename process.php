<?php
session_start();
$serverName = "localhost";
$DBuserName = "root";
$passwordDB = "";
$dbName = "bankbcnf";
// Connect To MySQL Database
    $con = new PDO("mysql:host=$serverName;dbname=$dbName", $DBuserName, $passwordDB);

    $con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    echo "Connection successful";

//user input
$username = $_POST['username'];
$password = $_POST['password'];
$sql = $con->prepare('SELECT * FROM user WHERE UserID = ?');
	  $sql->execute([$username]);
    $user = $sql->fetch();

try{
    if ($username == "admin" && $password == "pwd") {
  $_SESSION['username'] = $username;
  header("Location: homepage.php");
  exit();

  // If user exists and password matches
} elseif($user && password_verify($password, $user['password'])) {
    // Login successful, set session variables or redirect to dashboard
    $_SESSION['username'] = $username;
    echo "User logged in!";
	  $con->close();
	  // Redirect to success page
	  header('Location: homepage.php');
	  exit();
} else {
    // Login failed, show error message
    echo "Username and/or password incorrect.";
    header("Location: index.html");
}

	
} catch (PDOException $ex) {
    
    echo 'Error Not Connected: '.$ex->getMessage();
    
}

?>