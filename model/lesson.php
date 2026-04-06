<?php
require_once(__DIR__ . '/../config/db.php');

class Lesson {
    private $id;
    private $title;
    private $coach;
    private $date;
    private $price;
    private $level;
    private $description;

    public function __construct($id = null, $title = null, $coach = null, $date = null, $price = null, $level = null, $description = null) {
        $this->id = $id;
        $this->title = $title;
        $this->coach = $coach;
        $this->date = $date;
        $this->price = $price;
        $this->level = $level;
        $this->description = $description;
    }

public function getId() {
        return $this->id;
    }

    public function getTitle() {
        return $this->title;
    }

    public function getCoach() {
        return $this->coach;
    }

    public function getDate() {
        return $this->date;
    }

    public function getPrice() {
        return $this->price;
    }

    public function getLevel() {
        return $this->level;
    }

    public function getDescription() {
        return $this->description;
    }
    
    public function setTitle($title) {
        $this->title = $title;
    }

    public function setCoach($coach) {
        $this->coach = $coach;
    }

    public function setDate($date) {
        $this->date = $date;
    }

    public function setPrice($price) {
        $this->price = $price;
    }

    public function setLevel($level) {
        $this->level = $level;
    }

    public function setDescription($description) {
        $this->description = $description;

    }

public static function getAllLessons($pdo) {
        try {
            $sql = "SELECT * FROM lessons ORDER BY date DESC";
            $stmt = $pdo->prepare($sql);
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            error_log("Error getting lessons: " . $e->getMessage());
            return [];
        }
    }
public static function getLessonById($pdo, $id) {
        try {
            $sql = "SELECT * FROM lessons WHERE id = ?";
            $stmt = $pdo->prepare($sql);
            $stmt->execute([$id]);
            return $stmt->fetch(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            error_log("Error getting lesson: " . $e->getMessage());
            return false;
        }
    }
    public static function getLessonsByLevel($pdo, $level) {
        try {
            $sql = "SELECT * FROM lessons WHERE level = ? ORDER BY date ASC";
            $stmt = $pdo->prepare($sql);
            $stmt->execute([$level]);
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            error_log("Error getting lessons by level: " . $e->getMessage());
            return [];
        }
    }
    public static function getLessonsByCoach($pdo, $coach) {
        try {
            $sql = "SELECT * FROM lessons WHERE coach = ? ORDER BY date DESC";
            $stmt = $pdo->prepare($sql);
            $stmt->execute([$coach]);
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            error_log("Error getting lessons by coach: " . $e->getMessage());
            return [];
        }
    }
    public static function searchLessons($pdo, $search) {
        try {
            $sql = "SELECT * FROM lessons 
                    WHERE title LIKE ? OR description LIKE ? OR coach LIKE ?
                    ORDER BY date DESC";
            $searchTerm = '%' . $search . '%';
            $stmt = $pdo->prepare($sql);
            $stmt->execute([$searchTerm, $searchTerm, $searchTerm]);
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            error_log("Error searching lessons: " . $e->getMessage());
            return [];
        }
    }
    public static function createLesson($pdo, $title, $coach, $date, $price, $level, $description) {
        try {
            $sql = "INSERT INTO lessons (title, coach, date, price, level, description) 
                    VALUES (?, ?, ?, ?, ?, ?)";
            $stmt = $pdo->prepare($sql);
            $stmt->execute([$title, $coach, $date, $price, $level, $description]);
            return $pdo->lastInsertId();
        } catch (PDOException $e) {
            error_log("Error creating lesson: " . $e->getMessage());
            return false;
        }
    }
    public static function updateLesson($pdo, $id, $title, $coach, $date, $price, $level, $description) {
        try {
            $sql = "UPDATE lessons 
                    SET title = ?, coach = ?, date = ?, price = ?, level = ?, description = ?
                    WHERE id = ?";
            $stmt = $pdo->prepare($sql);
            return $stmt->execute([$title, $coach, $date, $price, $level, $description, $id]);
        } catch (PDOException $e) {
            error_log("Error updating lesson: " . $e->getMessage());
            return false;
        }
    }
     public static function deleteLesson($pdo, $id) {
        try {
            // First check if students are enrolled
            $checkSql = "SELECT COUNT(*) as count FROM enrollments WHERE lesson_id = ?";
            $checkStmt = $pdo->prepare($checkSql);
            $checkStmt->execute([$id]);
            $result = $checkStmt->fetch(PDO::FETCH_ASSOC);
            
            // If students enrolled, don't delete
            if ($result['count'] > 0) {
                return false;
            }
            $sql = "DELETE FROM lessons WHERE id = ?";
            $stmt = $pdo->prepare($sql);
            return $stmt->execute([$id]);
        } catch (PDOException $e) {
            error_log("Error deleting lesson: " . $e->getMessage());
            return false;
        }
    }
    public static function getUpcomingLessons($pdo) {
        try {
            $sql = "SELECT * FROM lessons WHERE date >= NOW() ORDER BY date ASC";
            $stmt = $pdo->prepare($sql);
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            error_log("Error getting upcoming lessons: " . $e->getMessage());
            return [];
        }
    }
    public static function getPastLessons($pdo) {
        try {
            $sql = "SELECT * FROM lessons WHERE date < NOW() ORDER BY date DESC";
            $stmt = $pdo->prepare($sql);
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            error_log("Error getting past lessons: " . $e->getMessage());
            return [];
        }
    }
     public static function getTotalLessons($pdo) {
        try {
            $sql = "SELECT COUNT(*) as total FROM lessons";
            $stmt = $pdo->prepare($sql);
            $stmt->execute();
            $result = $stmt->fetch(PDO::FETCH_ASSOC);
            return $result['total'];
        } catch (PDOException $e) {
            error_log("Error getting total lessons: " . $e->getMessage());
            return 0;
        }
    }
    public static function getLessonCountByLevel($pdo) {
        try {
            $sql = "SELECT level, COUNT(*) as count FROM lessons GROUP BY level";
            $stmt = $pdo->prepare($sql);
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            error_log("Error getting lesson count by level: " . $e->getMessage());
            return [];
        }
    }
    public static function getEnrolledCount($pdo, $lesson_id) {
        try {
            $sql = "SELECT COUNT(*) as count FROM enrollments WHERE lesson_id = ?";
            $stmt = $pdo->prepare($sql);
            $stmt->execute([$lesson_id]);
            $result = $stmt->fetch(PDO::FETCH_ASSOC);
            return $result['count'];
        } catch (PDOException $e) {
            error_log("Error getting enrolled count: " . $e->getMessage());
            return 0;
        }
    }
    public static function getAvailableLessons($pdo, $student_id) {
        try {
            $sql = "SELECT * FROM lessons 
                    WHERE id NOT IN (SELECT lesson_id FROM enrollments WHERE student_id = ?)
                    AND date >= NOW()
                    ORDER BY date ASC";
            $stmt = $pdo->prepare($sql);
            $stmt->execute([$student_id]);
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            error_log("Error getting available lessons: " . $e->getMessage());
            return [];
        }
    }
    public static function getLessonsByPriceRange($pdo, $min_price, $max_price) {
        try {
            $sql = "SELECT * FROM lessons WHERE price BETWEEN ? AND ? ORDER BY price ASC";
            $stmt = $pdo->prepare($sql);
            $stmt->execute([$min_price, $max_price]);
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            error_log("Error getting lessons by price: " . $e->getMessage());
            return [];
        }
    }
      public static function getLessonsByDateRange($pdo, $start_date, $end_date) {
        try {
            $sql = "SELECT * FROM lessons WHERE date BETWEEN ? AND ? ORDER BY date ASC";
            $stmt = $pdo->prepare($sql);
            $stmt->execute([$start_date, $end_date]);
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            error_log("Error getting lessons by date: " . $e->getMessage());
            return [];
        }
    }
    public static function lessonExists($pdo, $id) {
        try {
            $sql = "SELECT COUNT(*) as count FROM lessons WHERE id = ?";
            $stmt = $pdo->prepare($sql);
            $stmt->execute([$id]);
            $result = $stmt->fetch(PDO::FETCH_ASSOC);
            return $result['count'] > 0;
        } catch (PDOException $e) {
            error_log("Error checking lesson: " . $e->getMessage());
            return false;
        }
    }
     public static function getAllCoaches($pdo) {
        try {
            $sql = "SELECT DISTINCT coach FROM lessons WHERE coach IS NOT NULL ORDER BY coach ASC";
            $stmt = $pdo->prepare($sql);
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_COLUMN);
        } catch (PDOException $e) {
            error_log("Error getting coaches: " . $e->getMessage());
            return [];
        }
    }
    public static function getLessonsWithEnrollmentCount($pdo) {
        try {
            $sql = "SELECT l.*, 
                    COUNT(e.id) as total_enrollments,
                    SUM(CASE WHEN e.payment_status = 'paid' THEN 1 ELSE 0 END) as paid_enrollments,
                    SUM(CASE WHEN e.payment_status = 'pending' THEN 1 ELSE 0 END) as pending_enrollments
                    FROM lessons l
                    LEFT JOIN enrollments e ON l.id = e.lesson_id
                    GROUP BY l.id
                    ORDER BY l.date DESC";
            $stmt = $pdo->prepare($sql);
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            error_log("Error getting lessons with stats: " . $e->getMessage());
            return [];
        }
    }
}
?>