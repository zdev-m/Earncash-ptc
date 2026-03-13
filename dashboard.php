<?php
    
?>

<?php
require_once '../includes/config.php';
require_once '../includes/functions.php';
if(!isLoggedIn()) header("Location: ../login.php");
$user = getUser($_SESSION['user_id']);
?>
<h1>Welcome <?php echo $user['username']; ?></h1>
<p>Balance: ₹<?php echo $user['balance']; ?></p>
<a href="ads.php">View Ads</a>
<a href="withdraw.php">Withdraw</a>
<a href="../logout.php">Logout</a>