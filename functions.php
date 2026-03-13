<?php
    
?>

<?php
function isLoggedIn() {
    return isset($_SESSION['user_id']);
}

function getUser($user_id) {
    global $pdo;
    $stmt = $pdo->prepare("SELECT * FROM users WHERE id = ?");
    $stmt->execute([$user_id]);
    return $stmt->fetch(PDO::FETCH_ASSOC);
}

function getUserPackage($user_id) {
    global $pdo;
    $stmt = $pdo->prepare("
        SELECT p.* FROM packages p 
        JOIN users u ON u.package_id = p.id 
        WHERE u.id = ?
    ");
    $stmt->execute([$user_id]);
    return $stmt->fetch(PDO::FETCH_ASSOC);
}

function getTodayAdViews($user_id) {
    global $pdo;
    $stmt = $pdo->prepare("
        SELECT COUNT(*) as count FROM ad_views 
        WHERE user_id = ? AND DATE(viewed_at) = CURDATE()
    ");
    $stmt->execute([$user_id]);
    return $stmt->fetch()['count'];
}

function addEarnings($user_id, $amount) {
    global $pdo;
    $pdo->prepare("UPDATE users SET balance = balance + ?, total_earned = total_earned + ? WHERE id = ?")
        ->execute([$amount, $amount, $user_id]);
}

function generateReferralCode() {
    return strtoupper(substr(md5(uniqid()), 0, 8));
}

function getReferrals($user_id) {
    global $pdo;
    $stmt = $pdo->prepare("SELECT * FROM users WHERE referred_by = ?");
    $stmt->execute([$user_id]);
    return $stmt->fetchAll();
}
?>