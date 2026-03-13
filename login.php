<?php
    
?>

<?php
require_once 'includes/config.php';
if($_POST){
    $stmt = $pdo->prepare("SELECT * FROM users WHERE email = ?");
    $stmt->execute([$_POST['email']]);
    $user = $stmt->fetch();
    if($user && password_verify($_POST['password'], $user['password'])){
        $_SESSION['user_id'] = $user['id'];
        header("Location: user/dashboard.php");
    } else $error = "Invalid credentials";
}
?>
<form method="post">
    <input type="email" name="email" placeholder="Email" required>
    <input type="password" name="password" placeholder="Password" required>
    <button type="submit">Login</button>
    <?php if(isset($error)) echo $error; ?>
</form>