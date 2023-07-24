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
    <button onclick="location.href='transfer.php'">Transfer Money</button>
    <button onclick="location.href='loanpay.html'">Make Loan Payment</button>
    <button onclick="location.href='loan.html'">Set Up Loan</button>
	<button onclick="location.href='budget.php'">Create Budget</button>
	<button onclick="location.href='history.html'">Spending History</button>
	<button onclick="location.href='analysis.php'">Analysis</button>
  <button onclick="location.href='maps.php'">Map</button>
  </body>
</html>