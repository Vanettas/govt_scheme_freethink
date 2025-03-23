<?php
session_start();
if (!isset($_SESSION['role']) || !in_array($_SESSION['role'], ['je', 'ae', 'ee'])) {
    header("Location: login.php");
    exit();
}
echo "Welcome, " . strtoupper($_SESSION['role']) . "!";
?>
