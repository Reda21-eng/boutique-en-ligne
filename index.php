<?php
require_once __DIR__ . '/controllers/ProductController.php';
session_start();
$controller = new ProductController();
$controller->index();
$content = __DIR__ . '/views/home.php';
require_once __DIR__ . '/views/layouts/main.php';
?>