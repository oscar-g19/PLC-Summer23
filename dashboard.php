
<!DOCTYPE html>
<html>
  <head>
    <title>Homepage</title>
    <link rel="stylesheet" type="text/css" href="dashboard.css">
  </head>
  <body>
    <?php
session_start();
// User is logged in, show the dashboard
echo "Welcome, " . $_SESSION['username'] . "!";

?>
    
    <p>Please choose one of the following options:</p>
    <button onclick="location.href='withdraw.html'">Withdraw</button>
    <button onclick="location.href='deposit.html'">Deposit</button>
	<button onclick="location.href='history.html'">Spending History</button>
  <button onclick="location.href='index.html'">Log Out</button>
  </body>
</html>
