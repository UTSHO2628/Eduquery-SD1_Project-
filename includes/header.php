<?php
include 'db.php';
session_start();
?>
<!DOCTYPE html>
<html>
<head>
    <title>EduQuery</title>
    <link rel="stylesheet" href="/assets/css/style.css">
</head>
<body>
    <header>
        <h2>EduQuery Portal</h2>
        <nav>
            <?php if (isset($_SESSION['role'])): ?>
                <a href="logout.php">Logout</a>
            <?php endif; ?>
        </nav>
    </header>
