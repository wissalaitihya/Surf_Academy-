<?php
require_once __DIR__ . '/../config/db.php';
require_once __DIR__ . '/../model/student.php';

class StudentController {
    private $pdo;
    public function __construct($pdo) {
        $this->pdo = $pdo;
}
//this for admin only to view all students
public function index() {
    session_start();
    //checking if admin
    if(!isset($_SESSION['logged_in']) || $_SESSION['role'] !== 'admin'){
     $_SESSION['error'] = "Access denied, for admin only";
     header("Location: view/login.php");
     exit();
    }
    //get all students
    $students = Student :: getAllStudents($this->pdo);
    require_once "view/adminDashboard.php";
}
public function showStudentInfo($id){
    session_start();
    if(!isset($_SESSION['logged_in']) || $_SESSION['role'] !== 'admin'){
        $_SESSION['error'] = "Access denied, for admin only";
        header("Location: view/login.php");
        exit();
    }

    $student = Student::getStudentById($this->pdo, $id);
    $lessons = Student::getStudentLessons($this->pdo, $id);
    $stats = Student::getStudentStatus($this->pdo, $id);
    if(!$student){
     $_SESSION['error'] ="Student not found";
     header("Location: view/adminDashboard.php");
     exit();
    }
    require_once "view/studentDashboard.php";
}
//update student info by admin
public function update(){
session_start();
    if(!isset($_SESSION["logged_in"]) || $_SESSION["role"] !== "admin"){
    $_SESSION["error"] = "Access denied, for admin only";
    header("Location: view/login.php");
    exit();
    }
    if($_SERVER['REQUEST_METHOD'] === 'POST'){
         $id = $_POST['student_id'] ?? null;
         $name = trim($_POST['name'] ?? '');
         $email = trim($_POST['email'] ?? '');
         $country = trim($_POST['country'] ?? '');
         $level = trim($_POST['level'] ?? '');
    }
    if(empty($name) || empty($email)){
        $_SESSION["error"] = "Name and email cannot be empty";
        header("Location: view/adminDashboard.php");
        exit();
    }
    if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
        $_SESSION["error"] = "Invalid email format";
        header("Location: view/adminDashboard.php");
        exit();
    }
    //UPDATE STUDENT INFO
    if(student::updateStudent($this->pdo, $id, $name, $country, $level)){
        $_SESSION["success"] = "Student info updated successfully";
    }else{
        $_SESSION['error'] = "Failed to update student info";
    }
    header("Location: view/adminDashboard.php");
    exit();
    }







}
?>