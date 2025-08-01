<?php
include_once '../includes/init.php';
checkAuth('teacher');

$teacher_id = $_SESSION['user_id'];

// Handle result deletion
if (isset($_GET['delete_id'])) {
    $delete_id = $_GET['delete_id'];
    deleteResult($pdo, $delete_id, $teacher_id);
    header('Location: manage_results.php');
    exit();
}

// Handle new result creation
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['add_result'])) {
    $student_id = $_POST['student_id'];
    $subject = $_POST['subject'];
    $marks = $_POST['marks'];
    $grade = $_POST['grade'];

    addResult($pdo, $student_id, $teacher_id, $subject, $marks, $grade);
    header('Location: manage_results.php');
    exit();
}

// Fetch all results published by this teacher
$results = getTeacherResults($pdo, $teacher_id);

// Fetch all students
$students = getAllStudents($pdo);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Results - EduQuery</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
    <div class="container mt-4">
        <h2>Manage Results</h2>
        <a href="dashboard.php" class="btn btn-secondary mb-3">Back to Dashboard</a>

        <div class="card mb-4">
            <div class="card-header">Add New Result</div>
            <div class="card-body">
                <form action="" method="post">
                    <div class="form-group">
                        <label for="student_id">Student</label>
                        <select name="student_id" id="student_id" class="form-control" required>
                            <?php foreach ($students as $student): ?>
                                <option value="<?php echo $student['id']; ?>"><?php echo $student['full_name']; ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="subject">Subject</label>
                        <input type="text" name="subject" id="subject" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label for="marks">Marks</label>
                        <input type="number" step="0.01" name="marks" id="marks" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label for="grade">Grade</label>
                        <input type="text" name="grade" id="grade" class="form-control" required>
                    </div>
                    <button type="submit" name="add_result" class="btn btn-primary">Add Result</button>
                </form>
            </div>
        </div>

        <h3>Published Results</h3>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Student Name</th>
                    <th>Subject</th>
                    <th>Marks</th>
                    <th>Grade</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($results as $result): ?>
                    <tr>
                        <td><?php echo $result['full_name']; ?></td>
                        <td><?php echo $result['subject']; ?></td>
                        <td><?php echo $result['marks']; ?></td>
                        <td><?php echo $result['grade']; ?></td>
                        <td>
                            <a href="manage_results.php?delete_id=<?php echo $result['id']; ?>" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure?')">Delete</a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</body>
</html>