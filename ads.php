<?php
    
?>

<?php
require_once '../includes/config.php';
require_once '../includes/functions.php';
if(!isLoggedIn()) header("Location: ../login.php");

$user = getUser($_SESSION['user_id']);
$package = getUserPackage($_SESSION['user_id']);
$today_views = getTodayAdViews($_SESSION['user_id']);

if($today_views < $package['daily_ads']){
    $ads = $pdo->query("SELECT * FROM ads WHERE status=1 ORDER BY RAND() LIMIT 1")->fetch();
    if($ads && isset($_POST['watch'])){
        addEarnings($_SESSION['user_id'], $ads['reward']);
        $stmt = $pdo->prepare("INSERT INTO ad_views (user_id, ad_id, reward) VALUES (?,?,?)");
        $stmt->execute([$_SESSION['user_id'], $ads['id'], $ads['reward']]);
        $success = "Earned ₹$ads[reward]";
    }
}
?>
<form method="post">
    <?php if(isset($success)) echo "<p>$success</p>"; ?>
    <button type="submit" name="watch">Watch Ad</button>
</form>