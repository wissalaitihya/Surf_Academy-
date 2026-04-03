<?php
session_start();
require_once '../config/db.php';

$message="";

if($_SERVER["REQUEST_METHOD"] === "POST"){
    $name=$_POST['name'];
    $email=$_POST['email'];
    $password = $_POST['password'];
    $confirm_password = $_POST['confirm_password'];
    $country=$_POST['country'];
    $level=['beginner','intermediate','advanced'];

    if($password !== $confirm_password){
     $message="Password not valid!";
    }else{
     try{
     $password_hash = password_hash($password, PASSWORD_DEFAULT);



     }


    }




}



?>