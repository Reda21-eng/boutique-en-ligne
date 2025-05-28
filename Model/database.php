<?php
class Database {
    private $host;
    private $db_name;
    private $username;
    private $password;
    private $conn = null;

    public function __construct() {
        $this->host = getenv('MYSQL_HOST') ?: ($_ENV['MYSQL_HOST'] ?? 'localhost');
        $this->db_name = getenv('MYSQL_DATABASE') ?: ($_ENV['MYSQL_DATABASE'] ?? 'manga_meow');
        $this->username = getenv('MYSQL_USER') ?: ($_ENV['MYSQL_USER'] ?? 'root');
        // Mot de passe vide par défaut pour Wamp, 'root' si variable d'env présente (Docker)
        $this->password = getenv('MYSQL_PASSWORD') ?: ($_ENV['MYSQL_PASSWORD'] ?? '');
    }

    public function getConnection() {
        try {
            $this->conn = new PDO(
                "mysql:host=" . $this->host . ";dbname=" . $this->db_name . ";charset=utf8mb4",
                $this->username,
                $this->password
            );
            $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch(PDOException $e) {
            error_log("Connection Error: " . $e->getMessage());
            die("Erreur de connexion à la base de données.");
        }
        return $this->conn;
    }
}
?>
