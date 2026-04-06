<?php
session_start();
if (!isset($_SESSION['logged_in']) || $_SESSION['role'] !== 'admin') {
    $_SESSION['error'] = "Access denied. Admins only.";
    header("Location: login.php");
    exit();
}
require_once '../config/db.php';
require_once '../model/student.php';
require_once '../model/lesson.php';

$pdo = $db->getPdo();
$totalStudents = Student::getTotalStudents($pdo);
$totalLessons = Lesson::getTotalLessons($pdo);
$allStudents = Student::getAllStudents($pdo);
$upcomingLessons = Lesson::getUpcomingLessons($pdo);

// Get recent students (last 5)
$recentStudents = array_slice($allStudents, 0, 5);
?>
