<?php
    
?>

<?php
session_start();

$host = 'localhost';
$dbname = 'ptc_site';
$username = 'root';
$password = '';

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8mb4", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch(PDOException $e) {
    die("Connection failed: " . $e->getMessage());
}

define('SITE_NAME', 'EarnCash PTC');
define('SITE_URL', 'http://localhost/ptc-site');
define('REFERRAL_BONUS', 10);
define('MIN_WITHDRAWAL', 500);
?>