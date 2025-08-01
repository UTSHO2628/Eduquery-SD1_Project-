<?php
include '../includes/auth.php';
include '../includes/db.php';

if ($_SESSION['role'] !== 'teacher' && $_SESSION['role'] !== 'admin') {
    header("Location: ../login.php");
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $title = $_POST['title'];
    $content = $_POST['content'];
    $user_id = $_SESSION['user_id'];

    $stmt = $conn->prepare("INSERT INTO notices (title, content, posted_by) VALUES (?, ?, ?)");
    $stmt->bind_param("ssi", $title, $content, $user_id);
    $stmt->execute();
    echo "Notice posted!";
}
?>

<form method="POST">
    <h2>Post Notice</h2>
    <input type="text" name="title" placeholder="Notice Title" required><br>
    <textarea name="content" placeholder="Notice Content" required></textarea><br>
    <button type="submit">Post Notice</button>
</form>
