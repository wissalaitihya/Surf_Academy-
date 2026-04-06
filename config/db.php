<?php
class Database {
    private $host;
    private $db_name;
    private $user;
    private $password;
    private $pdo;

    public function __construct($host = 'localhost', $db_name = 'surf_academy', $user = 'root', $password = '') {
        $this->host = $host;
        $this->db_name = $db_name;
        $this->user = $user;
        $this->password = $password;
    }

    public function connect() {
        try {
            $dsn = 'mysql:host=' . $this->host . ';dbname=' . $this->db_name . ';charset=utf8mb4';

            $this->pdo = new PDO($dsn, $this->user, $this->password);
            $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            return $this->pdo;
        } catch (PDOException $e) {
            die('Connection Error: ' . $e->getMessage());
        }
    }

    public function getPdo() {
        if ($this->pdo == null) {
            $this->connect(); 
        }
        return $this->pdo;
    }
    
}
$db = new Database();
?>

