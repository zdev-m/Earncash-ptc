<?php
    
?>

<?php
require_once 'includes/config.php';
require_once 'includes/functions.php';
if($_POST){
    $ref_code = generateReferralCode();
    $hashed = password_hash($_POST['password'], PASSWORD_DEFAULT);
    $stmt = $pdo->prepare("INSERT INTO users (username, email, password, referral_code) VALUES (?,?,?,?)");
    $stmt->execute([$_POST['username'], $_POST['email'], $hashed, $ref_code]);
    header("Location: login.php");
}
?>
<form method="post">
    <input type="text" name="username" placeholder="Username" required>
    <input type="email" name="email" placeholder="Email" required>
    <input type="password" name="password" placeholder="Password" required>
    <button type="submit">Register</button>
</form>