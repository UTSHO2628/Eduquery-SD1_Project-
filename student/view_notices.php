<?php
include_once '../includes/init.php';
checkAuth('student');

// Fetch all notices
$notices = getAllNotices($pdo);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Notices - EduQuery</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
    <div class="container mt-4">
        <h2>View Notices</h2>
        <a href="dashboard.php" class="btn btn-secondary mb-3">Back to Dashboard</a>

        <?php foreach ($notices as $notice): ?>
            <div class="card mb-3">
                <div class="card-header">
                    <?php echo $notice['title']; ?>
                </div>
                <div class="card-body">
                    <p class="card-text"><?php echo $notice['content']; ?></p>
                </div>
                <div class="card-footer text-muted">
                    Posted by <?php echo $notice['full_name']; ?> on <?php echo $notice['created_at']; ?>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
</body>
</html>