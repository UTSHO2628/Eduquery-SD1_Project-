<?php
include_once '../includes/init.php'; // init.php include kore jeita database connection, session, o nedded function load kore 
checkAuth('teacher');  // check kore teacher kina 

$assignment_id = $_GET['assignment_id'];

// Fetch assignment details
$assignment = getAssignmentById($pdo, $assignment_id);

// Fetch submissions for this assignment
$submissions = getSubmissionsForAssignment($pdo, $assignment_id); 
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Submissions - EduQuery</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
    <div class="container mt-4">
        <h2>Submissions for: <?php echo $assignment['title']; ?></h2>
        <a href="manage_assignments.php" class="btn btn-secondary mb-3">Back to Assignments</a>

        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Student Name</th>
                    <th>Submitted At</th>
                    <th>File</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($submissions as $submission): ?>
                    <tr>
                        <td><?php echo $submission['full_name']; ?></td>
                        <td><?php echo $submission['submitted_at']; ?></td>
                        <td><a href="../uploads/submissions/<?php echo $submission['file_path']; ?>" target="_blank">Download</a></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</body>
</html>
