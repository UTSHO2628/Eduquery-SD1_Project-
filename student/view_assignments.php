<?php
include_once '../includes/init.php';
checkAuth('student');

$student_id = $_SESSION['user_id'];

// Handle assignment submission
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['submit_assignment'])) {
    $assignment_id = $_POST['assignment_id'];
    $file = $_FILES['submission_file'];

    // File upload handling
    $fileName = time() . '_' . basename($file['name']);
    $targetDir = "../uploads/submissions/";
    $targetFilePath = $targetDir . $fileName;

    if (move_uploaded_file($file['tmp_name'], $targetFilePath)) {
        submitAssignment($pdo, $assignment_id, $student_id, $fileName);
    }

    header('Location: view_assignments.php');
    exit();
}

// Fetch all assignments
$assignments = getStudentAssignments($pdo);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Assignments - EduQuery</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
    <div class="container mt-4">
        <h2>View Assignments</h2>
        <a href="dashboard.php" class="btn btn-secondary mb-3">Back to Dashboard</a>

        <?php foreach ($assignments as $assignment): ?>
            <div class="card mb-3">
                <div class="card-header">
                    <h5><?php echo $assignment['title']; ?></h5>
                    <small>Posted by: <?php echo $assignment['teacher_name']; ?></small>
                </div>
                <div class="card-body">
                    <p class="card-text"><?php echo $assignment['description']; ?></p>
                    <p><strong>Due Date:</strong> <?php echo $assignment['due_date']; ?></p>

                    <form action="" method="post" enctype="multipart/form-data">
                        <input type="hidden" name="assignment_id" value="<?php echo $assignment['id']; ?>">
                        <div class="form-group">
                            <label for="submission_file">Submit Your Work</label>
                            <input type="file" name="submission_file" class="form-control-file" required>
                        </div>
                        <button type="submit" name="submit_assignment" class="btn btn-primary">Submit</button>
                    </form>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
</body>
</html>