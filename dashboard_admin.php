<?php
include 'includes/auth.php';
include 'includes/db.php';
if ($_SESSION['role'] !== 'admin') {
    header("Location: login.php");
    exit;
}
include 'includes/header.php';
?>

<h2>Welcome, <?php echo $_SESSION['name']; ?> (Admin)</h2>
<p>This is the admin dashboard. You have full access.</p>
<ul>
    <li><a href="assignments/view.php">All Assignments</a></li>
    <li><a href="results/view.php">All Results</a></li>
    <li><a href="notices/view.php">All Notices</a></li>
</ul>

<?php include 'includes/footer.php'; ?>
