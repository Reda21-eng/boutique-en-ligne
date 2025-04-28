<?php
require_once '../Model/database.php';

class MangaFetcher {
    private $db;
    private $baseUrl = 'https://api.jikan.moe/v4';

    public function __construct() {
        $database = new Database();
        $this->db = $database->getConnection();
    }

    public function fetchAndStoreManga() {
        try {
            // Fetch top manga from the API
            $response = file_get_contents("{$this->baseUrl}/top/manga?filter=bypopularity&limit=50");
            $data = json_decode($response, true);

            if (!$data || !isset($data['data'])) {
                throw new Exception("Failed to fetch manga data from API");
            }

            $mangas = $data['data'];

            // Prepare SQL statement to insert or update manga
            $stmt = $this->db->prepare("
                INSERT INTO mangas (mal_id, title, image_url, synopsis, created_at, updated_at)
                VALUES (:mal_id, :title, :image_url, :synopsis, NOW(), NOW())
                ON DUPLICATE KEY UPDATE
                    title = :title,
                    image_url = :image_url,
                    synopsis = :synopsis,
                    updated_at = NOW()
            ");

            // Insert each manga into the database
            foreach ($mangas as $manga) {
                $stmt->execute([
                    ':mal_id' => $manga['mal_id'],
                    ':title' => $manga['title'],
                    ':image_url' => $manga['images']['jpg']['image_url'],
                    ':synopsis' => $manga['synopsis'] ?? 'No synopsis available',
                ]);
            }

            echo "Successfully fetched and stored " . count($mangas) . " mangas.\n";
        } catch (Exception $e) {
            error_log("Error fetching manga: " . $e->getMessage());
            echo "Error: " . $e->getMessage();
        }
    }
}

// Run the fetcher
$fetcher = new MangaFetcher();
$fetcher->fetchAndStoreManga();
?>