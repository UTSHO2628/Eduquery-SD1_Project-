<?php
include '../includes/auth.php'; // auth.php check user er authentication plus login kora asekina role ki aisob check kore
include '../includes/db.php';  // database collection 

if ($_SESSION['role'] !== 'teacher') {  // check kore user teacher kina
    header("Location: ../login.php");
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') { // check kore form submit hoise kina 
    $student_id = $_POST['student_id'];
    $subject = $_POST['subject'];
    $marks = $_POST['marks'];

    $stmt = $conn->prepare("INSERT INTO results (student_id, subject, marks, teacher_id) VALUES (?, ?, ?, ?)"); // MySQLi prepared statement use kora hoise. prepare() SQL injection theke save korar jonne secure input handling।
    $stmt->bind_param("isii", $student_id, $subject, $marks, $_SESSION['user_id']);
    $stmt->execute();
    echo "Result uploaded!";
}
?>

<form method="POST">
    <h2>Upload Result</h2>
    <input type="number" name="student_id" placeholder="Student ID" required><br>
    <input type="text" name="subject" placeholder="Subject" required><br>
    <input type="number" name="marks" placeholder="Marks" required><br>
    <button type="submit">Upload</button>
</form>
