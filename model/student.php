<?php
require_once('../config/db.php');
require_once('../model/user.php');
 
class Student {
    private $id;
    private $name;
    private $country;
    private $level;
    private $user_id;

    public function __construct ($id, $name, $country, $level, $user_id) {
        $this ->id = $id;
        $this ->name = $name;
        $this ->country = $country;
        $this ->level = $level;
        $this ->user_id = $user_id;
    }
public function getId() {
    return $this->id;
}
public function getName() {
    return $this->name;
}      
public function getCountry() {
    return $this->country;
}
public function getLevel() {
    return $this->level;
}
public function getUserId() {
    return $this->user_id;
}
public function setNAME($name) {
    $this->name = $name;
}
public function setCountry($country) {
    $this->country = $country;
}
public function setLevel($level) {
    $this->level = $level;
}
public function setUserId($user_id) {
    $this->user_id = $user_id;
}
public static function getAllStudents($pdo){
    $stmt = $pdo->prepare("SELECT * FROM students WHERE role= 'student' ORDER BY name ASC");
    $stmt->execute();
    return $stmt->fetchAll();
}
  public static function getStudentById($pdo, $id) {
    $stmt = $pdo->prepare("SELECT * FROM students WHERE id = ? AND role = 'student'");
    $stmt->execute([$id]);
    return $stmt->fetch();
  }
public static function getStudentByEmail($pdo, $email){
    $stmt = $pdo->prepare("SELECT * FROM students WHERE role='student' AND email = ?");
    $stmt->execute([$email]);   
    return $stmt->fetch();
}
public static function getTotalStudents($pdo){
    $stmt = $pdo->prepare("SELECT COUNT(*) as total FROM students WHERE role= 'student'");
   return $stmt->fetch()['total'];
}
public static function searchStudents($pdo, $search){
    $stmt = $pdo->prepare("SELECT * FROM students WHERE role= 'student' AND (name LIKE ? OR email LIKE ?) ORDER BY name ASC");
    $searchTerm = '%$search%';
    $stmt->execute([$searchTerm, $searchTerm]);
    return $stmt->fetchAll();
}
public static function deleteStudent($pdo, $id){
$stmt= $pdo->prepare("DELETE FROM students WHERE id = ? AND role = 'student'");
return $stmt->execute([$id]);
}
public static function updateStudent($pdo, $id, $name, $country, $level){
    $stmt = $pdo->prepare("UPDATE students SET name = ?, country = ?, level = ? WHERE id = ? AND role = 'student'");
    return $stmt->execute([$name, $country, $level, $id]);
}
public static function getStudentLessons($pdo, $user_id){
    $stmt = $pdo->prepare("SELECT * FROM enrollements WHERE user_id = ? ");
    $stmt->execute([$user_id]);
    return $stmt->fetchAll();
}
public static function getStudentStatus($pdo, $user_id){
   $stmt = $pdo ->prepare("SELECT status FROM enrollements WHERE user_id = ? ");
    $stmt->execute([$user_id]);
    return $stmt->fetchAll();
}
}
?>
