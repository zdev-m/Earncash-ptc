<?php
    
?>

<?php
require_once '../includes/config.php';
require_once '../includes/functions.php';
if(!isLoggedIn()) header("Location: ../login.php");

$user = getUser($_SESSION['user_id']);
if($_POST && $_POST['amount'] >= MIN_WITHDRAWAL && $_POST['amount'] <= $user['balance']){
    $stmt = $pdo->prepare("INSERT INTO withdrawals (user_id, amount, method, account_details) VALUES (?,?,?,?)");
    $stmt->execute([$_SESSION['user_id'], $_POST['amount'], $_POST['method'], $_POST['account']]);
    $pdo->prepare("UPDATE users SET balance = balance - ? WHERE id = ?")->execute([$_POST['amount'], $_SESSION['user_id']]);
    $success = "Request sent";
}
?>
<form method="post">
    <input type="number" name="amount" placeholder="Amount" required>
    <select name="method">
        <option value="easypaisa">Easypaisa</option>
        <option value="jazzcash">JazzCash</option>
    </select>
    <input type="text" name="account" placeholder="Account number" required>
    <button type="submit">Withdraw</button>
    <?php if(isset($success)) echo $success; ?>
</form>