<?php
session_start();
if(isset($_GET["confirm"]) && $_GET["confirm"] === "true") {
   require_once("../controller/AuthoControllers.php");
   $authoController = new AuthControllers (null);
   $authoController->logout();
}
$dashboardUrl = "login.php";
if(isset($_SESSION["user_role"]) && $_SESSION["user_role"] === "admin"){
    $dashboardUrl = "adminDashboard.php";
} else {
    $dashboardUrl = "studentDashboard.php";
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Logout</title>
</head>
<body>
    <h2>Confirm Logout</h2>
    <p>Are you sure you wanna logout?</p>
    <a href="logout.php?confirm=true">Yes, Logout</a>
    <a href="<?=htmlspecialchars($dashboardUrl);?>">Cancel</a>
</body>
</html>