<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
?>
<!DOCTYPE html>
<!DOCTYPE html>
<html>
<head>
    <title>Racehorse Training Academy</title>
    <link rel="stylesheet" href="/racehorse-training/assets/style.css">
</head>
<body>

<div style="background:#2c3e50; color:white; padding:12px 20px; display:flex; justify-content:space-between; align-items:center;">
    <div>
        <strong>Racehorse Training Academy</strong>
    </div>
    <div>
        Logged in as: <strong><?= htmlspecialchars($_SESSION['full_name'] ?? $_SESSION['username'] ?? 'Guest') ?></strong>
| <a href="/racehorse-training/auth/logout.php" style="color:#ffcc00; text-decoration:none;" onclick="return confirm('Are you sure you want to log out?')">Logout</a>    </div>
</div>