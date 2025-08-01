<?php
include_once '../includes/init.php';
checkAuth('student');

$user = getLoggedInUser($pdo);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Dashboard - EduQuery</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="../assets/css/style.css">
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <a class="navbar-brand" href="#">EduQuery</a>
        <div class="collapse navbar-collapse">
            <ul class="navbar-nav ml-auto">
                <li class="nav-item">
                    <a class="nav-link" href="../logout.php">Logout</a>
                </li>
            </ul>
        </div>
    </nav>

    <div class="container mt-4">
        <h2>Welcome, <?php echo $user['full_name']; ?>!</h2>
        <p>This is your student dashboard. You can view assignments, submit your work, check results, and see notices from here.</p>

        <div class="row">
            <div class="col-md-4">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">View Assignments</h5>
                        <p class="card-text">View and submit your assignments.</p>
                        <a href="view_assignments.php" class="btn btn-primary">Go to Assignments</a>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">View Results</h5>
                        <p class="card-text">Check your academic results.</p>
                        <a href="view_results.php" class="btn btn-primary">Go to Results</a>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">View Notices</h5>
                        <p class="card-text">View notices from the admin and your teachers.</p>
                        <a href="view_notices.php" class="btn btn-primary">Go to Notices</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>