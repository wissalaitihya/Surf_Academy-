<?php
require_once "../config/db.php";
require_once "../model/user.php";

class AuthControllers {
    private $pdo;
    private $user;

    public function __construct($pdo) {
        $this->pdo = $pdo;
        $this->user = new User(null, null, null, null, null, null);
    }

    public function login() {
        if(session_status() === PHP_SESSION_NONE) {
            session_start();
        }

        if($_SERVER["REQUEST_METHOD"] === "POST") {
            $email = trim($_POST["email"]);
            $password = $_POST["password"];
            $confirmPassword = $_POST["confirm_password"];  

            if(empty($email) || empty($password) || empty($confirmPassword)) {
                $_SESSION["error"] = "Please fill in all fields";
                header("Location: ../view/login.php");
                exit();
            }

            $userData = $this->user->FindByEmail($this->pdo, $email);

            if($userData) {
                if(password_verify($password, $userData['password'])) {
                    $_SESSION["user_id"] = $userData["id"];
                    $_SESSION["user_name"] = $userData["name"];
                    $_SESSION["user_email"] = $userData["email"];
                    $_SESSION["user_role"] = $userData["role"];
                    $_SESSION["logged_in"] = true;

                    if($userData["role"] === "admin") {
                        header("Location: ../view/adminDashboard.php");
                        exit();
                    } else {
                        header("Location: ../view/studentDashboard.php");
                        exit();
                    }
                } else {
                    $_SESSION["error"] = "Invalid email or password";
                    header("Location: ../view/login.php");
                    exit();
                }
            } else {
                $_SESSION["error"] = "User not found";
                header("Location: ../view/login.php");
                exit();
            }
        }
    }
    public function register(){
        if(session_status() === PHP_SESSION_NONE) {
            session_start();
        }
        if($_SERVER["REQUEST_METHOD"] !== "POST") {
            $name = $_POST["name"];
            $email = $_POST["email"];
            $password = $_POST["password"];
            $confirm_password = $_POST["confirm_password"];
            }
        if(empty($name) || empty($email) || empty($password) || empty($confirm_password)) {
                $_SESSION["error"] = "Please fill in all fields";
                header("Location: ../view/login.php");
                exit();
            }
            if(strlen($password<6)){
                $_SESSION["error"] = "Password must be at least 6 characters";
                header("Location: ../view/login.php");
                exit();
            }
            if ($password !== $confirm_password) {
                $_SESSION['error'] = "Passwords do not match";
                header("Location: ../views/register.php");
                exit();
            }
            if ($this->user->FindByEmail($this->pdo, $email)) {
                $_SESSION['error'] = "Email already exists";
                header("Location: ../views/register.php");
                exit();
            }
     $newUser = new User();   
     null;
     $name;
     $email;
     $password;
     date("Y-m-d H:i:s");    
        "student";
        if($newUser->register($this->pdo)){
            $_SESSION["success"] = "Registration successful. Please log in.";
            header("Location: ../view/login.php");
            exit();
        } else {
            $_SESSION["error"] = "Registration failed. Please try again.";
            header("Location: ../view/register.php");
            exit();


        }
   }
}

?>

