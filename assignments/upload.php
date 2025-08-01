<?php
include '../includes/auth.php';
include '../includes/db.php';

if ($_SESSION['role'] !== 'teacher') {
    header("Location: ../login.php");
    exit;
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $title = $_POST['title'];
    $description = $_POST['description'];
    $filename = $_FILES['file']['name'];
    $temp = $_FILES['file']['tmp_name'];
    move_uploaded_file($temp, "../assets/uploads/$filename");

    $stmt = $conn->prepare("INSERT INTO assignments (title, description, filename, teacher_id) VALUES (?, ?, ?, ?)");
    $stmt->bind_param("sssi", $title, $description, $filename, $_SESSION['user_id']);
    $stmt->execute();
    echo "Assignment uploaded successfully!";
}
?>

<form method="POST" enctype="multipart/form-data">
    <h2>Upload Assignment</h2>
    <input type="text" name="title" placeholder="Assignment Title" required><br>
    <textarea name="description" placeholder="Description" required></textarea><br>
    <input type="file" name="file" required><br>
    <button type="submit">Upload</button>
</form>
