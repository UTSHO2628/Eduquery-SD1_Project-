<?php
include 'includes/auth.php';
include 'includes/db.php';
if ($_SESSION['role'] !== 'student') {
    header("Location: login.php");
    exit;
}
include 'includes/header.php';
?>

<h2>Welcome, <?php echo $_SESSION['name']; ?> (Student)</h2>
<p>This is your student dashboard. You can view assignments, submit them, and check your results.</p>
<ul>
    <li><a href="assignments/view.php">View Assignments</a></li>
    <li><a href="results/view.php">View Results</a></li>
    <li><a href="notices/view.php">View Notices</a></li>
</ul>

<?php include 'includes/footer.php'; ?>
