<?php
include_once '../includes/init.php';
checkAuth('teacher');

$teacher_id = $_SESSION['user_id'];

// Handle assignment deletion
if (isset($_GET['delete_id'])) {
    $delete_id = $_GET['delete_id'];
    deleteAssignment($pdo, $delete_id, $teacher_id);
    header('Location: manage_assignments.php');
    exit();
}

// Handle new assignment creation
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['add_assignment'])) {
    $title = $_POST['title'];
    $description = $_POST['description'];
    $due_date = $_POST['due_date'];

    addAssignment($pdo, $title, $description, $due_date, $teacher_id);
    header('Location: manage_assignments.php');
    exit();
}

// Fetch all assignments by this teacher
$assignments = getTeacherAssignments($pdo, $teacher_id);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Assignments - EduQuery</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
    <div class="container mt-4">
        <h2>Manage Assignments</h2>
        <a href="dashboard.php" class="btn btn-secondary mb-3">Back to Dashboard</a>

        <div class="card mb-4">
            <div class="card-header">Add New Assignment</div>
            <div class="card-body">
                <form action="" method="post">
                    <div class="form-group">
                        <label for="title">Title</label>
                        <input type="text" name="title" id="title" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label for="description">Description</label>
                        <textarea name="description" id="description" class="form-control" rows="3"></textarea>
                    </div>
                    <div class="form-group">
                        <label for="due_date">Due Date</label>
                        <input type="datetime-local" name="due_date" id="due_date" class="form-control" required>
                    </div>
                    <button type="submit" name="add_assignment" class="btn btn-primary">Add Assignment</button>
                </form>
            </div>
        </div>

        <h3>Existing Assignments</h3>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Title</th>
                    <th>Description</th>
                    <th>Due Date</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($assignments as $assignment): ?>
                    <tr>
                        <td><?php echo $assignment['title']; ?></td>
                        <td><?php echo $assignment['description']; ?></td>
                        <td><?php echo $assignment['due_date']; ?></td>
                        <td>
                            <a href="view_submissions.php?assignment_id=<?php echo $assignment['id']; ?>" class="btn btn-sm btn-info">View Submissions</a>
                            <a href="manage_assignments.php?delete_id=<?php echo $assignment['id']; ?>" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure?')">Delete</a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</body>
</html>