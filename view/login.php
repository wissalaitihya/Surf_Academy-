<?php
session_start();
require_once '../config/db.php';

$error_message =isset($_GET['error']) ? $_GET(['error']):"";
$success_message=isset($_GET['success']) ? $_GET(['success']):"";
?>


