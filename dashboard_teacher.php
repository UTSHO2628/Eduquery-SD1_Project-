<?php
include 'includes/auth.php';
include 'includes/db.php';
if ($_SESSION['role'] !== 'teacher') {
    header("Location: login.php");
    exit;
}
include 'includes/header.php';
?>

<h2>Welcome, <?php echo $_SESSION['name']; ?> (Teacher)</h2>
<p>This is your teacher dashboard. You can upload assignments and post results.</p>
<ul>
    <li><a href="assignments/upload.php">Upload Assignment</a></li>
    <li><a href="results/upload.php">Upload Results</a></li>
    <li><a href="notices/post.php">Post Notice</a></li>
</ul>

<?php include 'includes/footer.php'; ?>
