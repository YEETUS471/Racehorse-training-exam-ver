<?php
session_start();

if (!isset($_SESSION['user_id'])) {
    header("Location: /racehorse-training/auth/login.php");
    exit;
}