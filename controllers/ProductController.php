<?php
require_once __DIR__ . '/../config/database.php';
require_once __DIR__ . '/../models/Product.php';
require_once __DIR__ . '/../models/Category.php';

class ProductController {
    private $db;
    private $productModel;
    private $categoryModel;

    public function __construct() {
        $this->db = (new Database())->getConnection();
        $this->productModel = new Product($this->db);
        $this->categoryModel = new Category($this->db);
    }

    public function index() {
        $products = $this->productModel->getAll();
        $categories = $this->categoryModel->getAll();
        $content = __DIR__ . '/../views/products.php';
        require_once __DIR__ . '/../views/layouts/main.php';
    }

    public function details($id) {
        $product = $this->productModel->getById($id);
        if ($product) {
            $content = __DIR__ . '/../views/product-details.php';
            require_once __DIR__ . '/../views/layouts/main.php';
        } else {
            header('HTTP/1.0 404 Not Found');
            echo 'Produit non trouvé';
        }
    }

    public function search($query) {
        $products = $this->productModel->search($query);
        header('Content-Type: application/json');
        echo json_encode($products);
    }

    public function create($data) {
        return $this->productModel->create($data);
    }

    public function update($id, $data) {
        return $this->productModel->update($id, $data);
    }

    public function delete($id) {
        return $this->productModel->delete($id);
    }
}
?>