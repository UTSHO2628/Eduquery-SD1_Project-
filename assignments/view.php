<?php
include '../includes/auth.php';
include '../includes/db.php';

$result = $conn->query("SELECT * FROM assignments ORDER BY id DESC");

echo "<h2>Assignments</h2>";
echo "<table border='1'><tr><th>ID</th><th>Title</th><th>Description</th><th>File</th></tr>";
while ($row = $result->fetch_assoc()) {
    echo "<tr>
        <td>{$row['id']}</td>
        <td>{$row['title']}</td>
        <td>{$row['description']}</td>
        <td><a href='../assets/uploads/{$row['filename']}' download>Download</a></td>
    </tr>";
}
echo "</table>";
