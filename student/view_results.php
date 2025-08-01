<?php
include_once '../includes/init.php';
checkAuth('student');

$student_id = $_SESSION['user_id'];

// Fetch results for this student
$results = getStudentResults($pdo, $student_id);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Results - EduQuery</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
    <div class="container mt-4">
        <h2>View Results</h2>
        <a href="dashboard.php" class="btn btn-secondary mb-3">Back to Dashboard</a>

        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Subject</th>
                    <th>Marks</th>
                    <th>Grade</th>
                    <th>Published By</th>
                    <th>Date</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($results as $result): ?>
                    <tr>
                        <td><?php echo $result['subject']; ?></td>
                        <td><?php echo $result['marks']; ?></td>
                        <td><?php echo $result['grade']; ?></td>
                        <td><?php echo $result['teacher_name']; ?></td>
                        <td><?php echo $result['published_at']; ?></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</body>
</html>