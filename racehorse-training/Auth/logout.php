<?php
session_start();
session_destroy();
header("Location: /racehorse-training/auth/login.php");
exit;