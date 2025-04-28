<?php
require_once '../Model/database.php';

header('Content-Type: application/json');

$action = $_GET['action'] ?? '';
$query = $_GET['query'] ?? '';
$id = $_GET['id'] ?? '';

$database = new Database();
$db = $database->getConnection();

switch ($action) {
    case 'featured':
        fetchFeaturedManga($db);
        break;
    case 'search':
        searchManga($db, $query);
        break;
    case 'details':
        getMangaDetails($db, $id);
        break;
    default:
        echo json_encode(['error' => 'Invalid action']);
}

function fetchFeaturedManga($db) {
    $stmt = $db->query("SELECT * FROM mangas ORDER BY members DESC LIMIT 10");
    $mangas = $stmt->fetchAll(PDO::FETCH_ASSOC);
    echo json_encode($mangas);
}

function searchManga($db, $query) {
    $stmt = $db->prepare("SELECT * FROM mangas WHERE title LIKE ? ORDER BY members DESC");
    $stmt->execute(['%' . $query . '%']);
    $mangas = $stmt->fetchAll(PDO::FETCH_ASSOC);
    echo json_encode($mangas);
}

function getMangaDetails($db, $id) {
    $stmt = $db->prepare("SELECT * FROM mangas WHERE mal_id = ?");
    $stmt->execute([$id]);
    $manga = $stmt->fetch(PDO::FETCH_ASSOC);
    echo json_encode($manga);
}
?>