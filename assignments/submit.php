<?php
include '../includes/auth.php';
include '../includes/db.php';

if ($_SESSION['role'] !== 'student') {
    header("Location: ../login.php");
    exit;
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $assignment_id = $_POST['assignment_id'];
    $filename = $_FILES['file']['name'];
    $temp = $_FILES['file']['tmp_name'];
    move_uploaded_file($temp, "../assets/uploads/$filename");

    $stmt = $conn->prepare("INSERT INTO submissions (assignment_id, student_id, filename) VALUES (?, ?, ?)");
    $stmt->bind_param("iis", $assignment_id, $_SESSION['user_id'], $filename);
    $stmt->execute();
    echo "Assignment submitted!";
}
?>

<form method="POST" enctype="multipart/form-data">
    <h2>Submit Assignment</h2>
    <label for="assignment_id">Assignment ID:</label>
    <input type="number" name="assignment_id" required><br>
    <input type="file" name="file" required><br>
    <button type="submit">Submit</button>
</form>
