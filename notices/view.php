<?php
include '../includes/auth.php';
include '../includes/db.php';

$result = $conn->query("SELECT * FROM notices ORDER BY created_at DESC");

echo "<h2>All Notices</h2>";
echo "<table border='1'><tr><th>Title</th><th>Content</th><th>Posted On</th></tr>";
while ($row = $result->fetch_assoc()) {
    echo "<tr>
        <td>{$row['title']}</td>
        <td>{$row['content']}</td>
        <td>{$row['created_at']}</td>
    </tr>";
}
echo "</table>";
