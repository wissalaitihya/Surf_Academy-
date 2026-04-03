<?php

class User{
    private $id;
    private $name;
    private $email;
    private $password;
    private $created_at;
    private $role;

    public function __construct($id, $name, $email, $password, $created_at, $role){
       $this->id = $id;
       $this->name = $name;
       $this->email = $email;
       $this->password = $password;
       $this->created_at = $created_at;
       $this->role = $role;
    }
  public function getId(){ 
    return $this->id; }
    public function getName(){ 
    return $this->name; }
    public function getEmail(){ 
    return $this->email; }
    public function getPassword(){ 
    return $this->password; }
    public function getCreatedAt(){ 
    return $this->created_at; }
    public function getRole(){ 
    return $this->role; }


    public function setName($name){
         $this->name = $name; }

    public function setEmail($email){
         $this->email = $email; }

    public function setPassword($password){
         $this->password = $password; }

    public function setCreatedAt($created_at){ 
        $this->created_at = $created_at; }

    public function setRole($role){
         $this->role = $role; }


public function register($pdo){
     $stmt = $pdo->prepare("INSERT INTO users (name, email, password, created_at, role) VALUES (?, ?, ?, ?, ?)");
     $stmt->execute([$this->email, password_hash($this->password, PASSWORD_DEFAULT), $this->role]);
}


public function login($pdo, $email, $password){
     $stmt = $pdo->prepare("SELECT * FROM users WHERE email = ?");
     $stmt->execute([$email]);
     $user = $stmt->fetch();
     if($user && password_verify($password, $user['password'])){
       return $user;
     }
     return false;
   }

   public function FindByEmail($pdo, $email){
 


   }

}










?>