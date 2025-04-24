<?php
require_once __DIR__ . '/../config/database.php';
require_once __DIR__ . '/../models/Product.php';
require_once __DIR__ . '/../models/Category.php';

class AdminController {
    private $db;
    private $productModel;
    private $categoryModel;

    public function __construct() {
        $this->db = (new Database())->getConnection();
        $this->productModel = new Product($this->db);
        $this->categoryModel = new Category($this->db);
    }

    public function dashboard() {
        session_start();
        if (!isset($_SESSION['is_admin']) || !$_SESSION['is_admin']) {
            header('Location: /index.php');
        }
        $content = __DIR__ . '/../views/admin/dashboard.php';
        require_once __DIR__ . '/../views/layouts/main.php';
    }

    public function manageProducts() {
        session_start();
        if (!isset($_SESSION['is_admin']) || !$_SESSION['is_admin']) {
            header('Location: /index.php');
        }
        $products = $this->productModel->getAll();
        $content = __DIR__ . '/../views/admin/manage-products.php';
        require_once __DIR__ . '/../views/layouts/main.php';
    }

    public function manageCategories() {
        session_start();
        if (!isset($_SESSION['is_admin']) || !$_SESSION['is_admin']) {
            header('Location: /index.php');
        }
        $categories = $this->categoryModel->getAll();
        $content = __DIR__ . '/../views/admin/manage-categories.php';
        require_once __DIR__ . '/../views/layouts/main.php';
    }
}
?>