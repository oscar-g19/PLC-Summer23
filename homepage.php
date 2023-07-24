<!DOCTYPE html>
<html>
  <head>
    <title>Homepage</title>
  </head>
  <body>
    
    <h1>Welcome, <?php session_start(); echo $_SESSION['username']; ?>!</h1>
    <p>Please choose one of the following options:</p>
    <button onclick="location.href='withdraw.html'">Withdraw</button>
    <button onclick="location.href='deposit.html'">Deposit</button>
	</body>
</html>