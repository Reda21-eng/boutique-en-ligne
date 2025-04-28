<?php
require_once '../Model/database.php';

class MangaImporter {
    private $db;

    public function __construct() {
        $database = new Database();
        $this->db = $database->getConnection();
    }

    public function importFromAPI() {
        $apiUrl = 'https://api.jikan.moe/v4/top/manga?filter=bypopularity&limit=50';

        try {
            $response = file_get_contents($apiUrl);
            $data = json_decode($response, true);

            if (isset($data['data'])) {
                foreach ($data['data'] as $manga) {
                    $this->saveManga(
                        $manga['mal_id'],
                        $manga['title'],
                        $manga['images']['jpg']['image_url'],
                        rand(10, 30), // Random price between 10 and 30
                        $manga['members'],
                        $manga['score'] ?? null
                    );
                }
                echo "Mangas imported successfully.";
            } else {
                echo "No data found in API response.";
            }
        } catch (Exception $e) {
            echo "Error importing mangas: " . $e->getMessage();
        }
    }

    private function saveManga($mal_id, $title, $image_url, $price, $members, $score) {
        $stmt = $this->db->prepare(
            "INSERT INTO mangas (mal_id, title, image_url, price, members, score) 
            VALUES (?, ?, ?, ?, ?, ?) 
            ON DUPLICATE KEY UPDATE title = VALUES(title), image_url = VALUES(image_url), price = VALUES(price), members = VALUES(members), score = VALUES(score)"
        );

        $stmt->execute([$mal_id, $title, $image_url, $price, $members, $score]);
    }
}

$importer = new MangaImporter();
$importer->importFromAPI();
?>