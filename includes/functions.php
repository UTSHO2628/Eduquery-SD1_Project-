<?php

function registerUser($pdo, $fullName, $email, $password, $role) {
    // Check if user already exists
    $stmt = $pdo->prepare("SELECT * FROM users WHERE email = ?");
    $stmt->execute([$email]);
    if ($stmt->rowCount() > 0) {
        return "Email already registered.";
    }

    // Hash the password
    $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

    // Insert user into the database
    $stmt = $pdo->prepare("INSERT INTO users (full_name, email, password, role) VALUES (?, ?, ?, ?)");
    if ($stmt->execute([$fullName, $email, $hashedPassword, $role])) {
        return "Registration successful. You can now login.";
    } else {
        return "Something went wrong. Please try again.";
    }
}

function loginUser($pdo, $email, $password) {
    $stmt = $pdo->prepare("SELECT * FROM users WHERE email = ?");
    $stmt->execute([$email]);
    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($user && password_verify($password, $user['password'])) {
        return $user;
    } else {
        return false;
    }
}

function redirectUser($role) {
    switch ($role) {
        case 'admin':
            header('Location: admin/dashboard.php');
            break;
        case 'teacher':
            header('Location: teacher/dashboard.php');
            break;
        case 'student':
            header('Location: student/dashboard.php');
            break;
        default:
            header('Location: login.php');
            break;
    }
    exit();
}

function checkAuth($role) {
    // session_start() is now handled by init.php
    if (!isset($_SESSION['user_id']) || $_SESSION['user_role'] != $role) {
        header('Location: ../login.php');
        exit();
    }
}

function getLoggedInUser($pdo) {
    if (isset($_SESSION['user_id'])) {
        $stmt = $pdo->prepare("SELECT * FROM users WHERE id = ?");
        $stmt->execute([$_SESSION['user_id']]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
    return null;
}

// Functions for admin
function getAllUsers($pdo) {
    $stmt = $pdo->query("SELECT * FROM users");
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

function deleteUser($pdo, $userId) {
    $stmt = $pdo->prepare("DELETE FROM users WHERE id = ?");
    return $stmt->execute([$userId]);
}

function getUserById($pdo, $userId) {
    $stmt = $pdo->prepare("SELECT * FROM users WHERE id = ?");
    $stmt->execute([$userId]);
    return $stmt->fetch(PDO::FETCH_ASSOC);
}

function updateUser($pdo, $userId, $fullName, $email, $role) {
    $stmt = $pdo->prepare("UPDATE users SET full_name = ?, email = ?, role = ? WHERE id = ?");
    return $stmt->execute([$fullName, $email, $role, $userId]);
}

function addNotice($pdo, $title, $content, $userId) {
    $stmt = $pdo->prepare("INSERT INTO notices (title, content, user_id) VALUES (?, ?, ?)");
    return $stmt->execute([$title, $content, $userId]);
}

function getAllNotices($pdo) {
    $stmt = $pdo->query("SELECT notices.*, users.full_name FROM notices JOIN users ON notices.user_id = users.id ORDER BY notices.created_at DESC");
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

function deleteNotice($pdo, $noticeId) {
    $stmt = $pdo->prepare("DELETE FROM notices WHERE id = ?");
    return $stmt->execute([$noticeId]);
}

// Functions for teacher
function addAssignment($pdo, $title, $description, $dueDate, $teacherId) {
    $stmt = $pdo->prepare("INSERT INTO assignments (title, description, due_date, teacher_id) VALUES (?, ?, ?, ?)");
    return $stmt->execute([$title, $description, $dueDate, $teacherId]);
}

function getTeacherAssignments($pdo, $teacherId) {
    $stmt = $pdo->prepare("SELECT * FROM assignments WHERE teacher_id = ? ORDER BY created_at DESC");
    $stmt->execute([$teacherId]);
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

function deleteAssignment($pdo, $assignmentId, $teacherId) {
    $stmt = $pdo->prepare("DELETE FROM assignments WHERE id = ? AND teacher_id = ?");
    return $stmt->execute([$assignmentId, $teacherId]);
}

function getAssignmentById($pdo, $assignmentId) {
    $stmt = $pdo->prepare("SELECT * FROM assignments WHERE id = ?");
    $stmt->execute([$assignmentId]);
    return $stmt->fetch(PDO::FETCH_ASSOC);
}

function getSubmissionsForAssignment($pdo, $assignmentId) {
    $stmt = $pdo->prepare("SELECT submissions.*, users.full_name FROM submissions JOIN users ON submissions.student_id = users.id WHERE assignment_id = ? ORDER BY submitted_at DESC");
    $stmt->execute([$assignmentId]);
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

function addResult($pdo, $studentId, $teacherId, $subject, $marks, $grade) {
    $stmt = $pdo->prepare("INSERT INTO results (student_id, teacher_id, subject, marks, grade) VALUES (?, ?, ?, ?, ?)");
    return $stmt->execute([$studentId, $teacherId, $subject, $marks, $grade]);
}

function getTeacherResults($pdo, $teacherId) {
    $stmt = $pdo->prepare("SELECT results.*, users.full_name FROM results JOIN users ON results.student_id = users.id WHERE teacher_id = ? ORDER BY published_at DESC");
    $stmt->execute([$teacherId]);
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

function deleteResult($pdo, $resultId, $teacherId) {
    $stmt = $pdo->prepare("DELETE FROM results WHERE id = ? AND teacher_id = ?");
    return $stmt->execute([$resultId, $teacherId]);
}

function getAllStudents($pdo) {
    $stmt = $pdo->query("SELECT * FROM users WHERE role = 'student'");
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

// Functions for student
function getStudentAssignments($pdo) {
    $stmt = $pdo->query("SELECT assignments.*, users.full_name AS teacher_name FROM assignments JOIN users ON assignments.teacher_id = users.id ORDER BY due_date DESC");
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

function submitAssignment($pdo, $assignmentId, $studentId, $filePath) {
    $stmt = $pdo->prepare("INSERT INTO submissions (assignment_id, student_id, file_path) VALUES (?, ?, ?)");
    return $stmt->execute([$assignmentId, $studentId, $filePath]);
}

function getStudentResults($pdo, $studentId) {
    $stmt = $pdo->prepare("SELECT results.*, users.full_name AS teacher_name FROM results JOIN users ON results.teacher_id = users.id WHERE student_id = ? ORDER BY published_at DESC");
    $stmt->execute([$studentId]);
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

?>