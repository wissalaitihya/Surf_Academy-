<?php
session_start();
if(!isset($_SESSION['logged_in']) || $_SESSION['user_role'] !== 'student'){
    $_SESSION['error'] = "Access denied, students only";
    header("Location: login.php");
    exit();
}
require_once __DIR__ . "/../controller/StudentControllers.php";
require_once __DIR__ . "/../config/db.php";

$db = new Database();
$pdo = $db->connect();

$student_id = $_SESSION['user_id'];

// Fetch student data
$stmt = $pdo->prepare("SELECT * FROM students WHERE user_id = ?");
$stmt->execute([$student_id]);
$student = $stmt->fetch(PDO::FETCH_ASSOC);

// Check if student record exists
if(!$student) {
    $_SESSION['error'] = "Student profile not found. Please contact support.";
    header("Location: login.php");
    exit();
}

$courses = Student::getStudentLessons($pdo, $student['id']);
$total_courses = count($courses) ?? 0;
$active_courses = 0;
$completed_courses = 0;
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Dashboard</title>
</head>
<body>
    <div class="form-container">
        <h2>Student Dashboard</h2>
        
</body>
</html>




