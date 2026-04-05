<?php
session_start();
require_once __DIR__ . "/controller/AuthControllers.php";
require_once __DIR__ . "/config/db.php";

// Check if this is a login/register/logout request
$action = $_GET['action'] ?? null;

if($action === 'login' && $_SERVER["REQUEST_METHOD"] === "POST") {
    // Process login
    $db = new Database();
    $pdo = $db->connect();
    $auth = new AuthControllers($pdo);
    $auth->login();
    // If login is successful, login() will redirect
    // If login fails, it also redirects back to login.php
    exit();
} elseif($action === 'register' && $_SERVER["REQUEST_METHOD"] === "POST") {
    // Process register
    $db = new Database();
    $pdo = $db->connect();
    $auth = new AuthControllers($pdo);
    $auth->register();
    exit();
} elseif($action === 'logout') {
    // Process logout
    $auth = new AuthControllers(null);
    $auth->logout();
    exit();
}

// Check if user is already logged in
if (isset($_SESSION['user_id'])) {
    if ($_SESSION['user_role'] === 'admin') {
        header("Location: view/adminDashboard.php");
    } else {
        header("Location: view/studentDashboard.php");
    }
} else {
    header("Location: view/login.php");
}
exit();
?>