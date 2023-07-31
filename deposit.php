<?php
// Check if the form was submitted
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Hardcoded account data (Simulated initial JSON database)
    $accounts = [
        '123' => [
            'Balance' => 1000.00,
            'AccountDate' => '2023-07-30 12:00:00'
        ],
        '456' => [
            'Balance' => 500.00,
            'AccountDate' => '2023-07-29 15:30:00'
        ]
    ];

    // Get form data and validate input
    $usr_acct = filter_var($_POST['account_id'], FILTER_SANITIZE_NUMBER_INT);
    $deposit = filter_var($_POST['deposit'], FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION);
    if (!is_numeric($usr_acct) || !is_numeric($deposit)) {
        die("Invalid input");
    }

    // Check if the user account exists in the accounts array
    if (!isset($accounts[$usr_acct])) {
        die("Account not found.");
    }

    // Update the account balance in the accounts array
    $accounts[$usr_acct]['Balance'] += $deposit;
    $accounts[$usr_acct]['AccountDate'] = date('Y-m-d H:i:s');

    // For demonstration purposes, display the updated balance after deposit
    echo "Updated Balance after Deposit: $" . $accounts[$usr_acct]['Balance'];
}
?>
