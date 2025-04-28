<?php
header('Content-Type: application/json');
require_once '../Model/database.php';

class MangaAPI {
    private $db;

    public function __construct() {
        $database = new Database();
        $this->db = $database->getConnection();
    }

    public function getFeaturedManga() {
        $stmt = $this->db->prepare("SELECT * FROM mangas ORDER BY updated_at DESC LIMIT 8");
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function searchManga($query) {
        $stmt = $this->db->prepare("SELECT * FROM mangas WHERE title LIKE :query LIMIT 20");
        $stmt->execute([':query' => "%$query%"]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getMangaDetails($id) {
        $stmt = $this->db->prepare("SELECT * FROM mangas WHERE mal_id = :id");
        $stmt->execute([':id' => $id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
}

// Handle API requests
$api = new MangaAPI();

$action = $_GET['action'] ?? '';
switch ($action) {
    case 'featured':
        echo json_encode($api->getFeaturedManga());
        break;
    case 'search':
        $query = $_GET['query'] ?? '';
        echo json_encode($api->searchManga($query));
        break;
    case 'details':
        $id = $_GET['id'] ?? 0;
        echo json_encode($api->getMangaDetails($id));
        break;
    default:
        echo json_encode(['error' => 'Invalid action']);
        break;
}
?>