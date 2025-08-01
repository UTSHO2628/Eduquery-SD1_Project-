<?php
include('includes/db.php');

if (isset($_POST['register'])) {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
    $role = $_POST['role'];

    // Check if user already exists
    $checkQuery = "SELECT * FROM users WHERE email='$email'";
    $checkResult = mysqli_query($conn, $checkQuery);

    if (mysqli_num_rows($checkResult) > 0) {
        echo "<script>alert('Email already exists!');</script>";
    } else {
        $query = "INSERT INTO users (name, email, password, role) 
                  VALUES ('$name', '$email', '$password', '$role')";
        if (mysqli_query($conn, $query)) {
            echo "<script>alert('Registration successful! Please login.'); window.location='login.php';</script>";
        } else {
            echo "<script>alert('Registration failed!');</script>";
        }
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Register</title>
    <link rel="stylesheet" href="assets/css/style.css">
    <style>
        body {
            margin: 0;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: #f0f4f8;
        }
        .container {
            display: flex;
            height: 100vh;
        }
        .left-panel {
            flex: 1;
            background-color: #eaf4fe;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 30px;
        }
        .left-panel img {
            width: 100%;
            max-width: 450px;
            height: auto;
        }
        .right-panel {
            flex: 1;
            background-color: #fff;
            padding: 60px 40px;
            display: flex;
            flex-direction: column;
            justify-content: center;
        }
        .right-panel h2 {
            margin-bottom: 30px;
            color: #0077cc;
            text-align: center;
        }
        .form-group {
            margin-bottom: 20px;
        }
        .form-group label {
            display: block;
            margin-bottom: 6px;
            font-weight: bold;
        }
        .form-group input,
        .form-group select {
            width: 100%;
            padding: 12px;
            border: 1px solid #ccc;
            border-radius: 6px;
        }
        .btn {
            width: 100%;
            padding: 12px;
            background-color: #0077cc;
            color: white;
            font-weight: bold;
            border: none;
            border-radius: 6px;
            cursor: pointer;
        }
        .btn:hover {
            background-color: #005fa3;
        }
        .bottom-text {
            margin-top: 15px;
            text-align: center;
        }
        .bottom-text a {
            color: #0077cc;
            text-decoration: none;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="left-panel">
            <img src="assets/img/register.png" alt="Register Illustration">
        </div>
        <div class="right-panel">
            <h2>Create an Account</h2>
            <form action="register.php" method="POST">
                <div class="form-group">
                    <label>Full Name:</label>
                    <input type="text" name="name" required>
                </div>
                <div class="form-group">
                    <label>Email:</label>
                    <input type="email" name="email" required>
                </div>
                <div class="form-group">
                    <label>Password:</label>
                    <input type="password" name="password" required>
                </div>
                <div class="form-group">
                    <label>Role:</label>
                    <select name="role" required>
                        <option value="student">Student</option>
                        <option value="teacher">Teacher</option>
                        <option value="admin">Admin</option>
                    </select>
                </div>
                <button class="btn" type="submit" name="register">Register</button>
                <div class="bottom-text">
                    Already have an account? <a href="login.php">Login here</a>
                </div>
            </form>
        </div>
    </div>
</body>
</html>
