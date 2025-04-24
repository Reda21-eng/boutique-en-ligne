<?php
require_once __DIR__ . '/ProductController.php';
session_start();
$controller = new ProductController();
$products = $controller->getAll();
$content = __DIR__ . '/views/home.php';
require_once __DIR__ . '/views/layouts/main.php';
?>