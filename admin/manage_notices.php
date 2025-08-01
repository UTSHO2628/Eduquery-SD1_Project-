<?php
include_once '../includes/init.php';
checkAuth('admin');

// Handle notice deletion
if (isset($_GET['delete_id'])) {
    $delete_id = $_GET['delete_id'];
    deleteNotice($pdo, $delete_id);
    header('Location: manage_notices.php');
    exit();
}

// Handle new notice creation
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['add_notice'])) {
    $title = $_POST['title'];
    $content = $_POST['content'];
    $user_id = $_SESSION['user_id'];

    addNotice($pdo, $title, $content, $user_id);
    header('Location: manage_notices.php');
    exit();
}

// Fetch all notices
$notices = getAllNotices($pdo);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Notices - EduQuery</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
    <div class="container mt-4">
        <h2>Manage Notices</h2>
        <a href="dashboard.php" class="btn btn-secondary mb-3">Back to Dashboard</a>

        <div class="card mb-4">
            <div class="card-header">Add New Notice</div>
            <div class="card-body">
                <form action="" method="post">
                    <div class="form-group">
                        <label for="title">Title</label>
                        <input type="text" name="title" id="title" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label for="content">Content</label>
                        <textarea name="content" id="content" class="form-control" rows="3" required></textarea>
                    </div>
                    <button type="submit" name="add_notice" class="btn btn-primary">Add Notice</button>
                </form>
            </div>
        </div>

        <h3>Existing Notices</h3>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Title</th>
                    <th>Content</th>
                    <th>Posted By</th>
                    <th>Date</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($notices as $notice): ?>
                    <tr>
                        <td><?php echo $notice['title']; ?></td>
                        <td><?php echo $notice['content']; ?></td>
                        <td><?php echo $notice['full_name']; ?></td>
                        <td><?php echo $notice['created_at']; ?></td>
                        <td>
                            <a href="manage_notices.php?delete_id=<?php echo $notice['id']; ?>" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure?')">Delete</a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</body>
</html>