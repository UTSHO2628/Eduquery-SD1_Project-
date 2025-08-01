<?php
include '../includes/auth.php';
include '../includes/db.php';

$role = $_SESSION['role'];
$user_id = $_SESSION['user_id'];

if ($role === 'student') {
    $stmt = $conn->prepare("SELECT * FROM results WHERE student_id = ?");
    $stmt->bind_param("i", $user_id);
} elseif ($role === 'teacher') {
    $stmt = $conn->prepare("SELECT * FROM results WHERE teacher_id = ?");
    $stmt->bind_param("i", $user_id);
} else {
    $stmt = $conn->prepare("SELECT * FROM results");
}

$stmt->execute();
$result = $stmt->get_result();

echo "<h2>Results</h2>";
echo "<table border='1'><tr><th>Student ID</th><th>Subject</th><th>Marks</th><th>Uploaded By</th></tr>";
while ($row = $result->fetch_assoc()) {
    echo "<tr>
        <td>{$row['student_id']}</td>
        <td>{$row['subject']}</td>
        <td>{$row['marks']}</td>
        <td>{$row['teacher_id']}</td>
    </tr>";
}
echo "</table>";
