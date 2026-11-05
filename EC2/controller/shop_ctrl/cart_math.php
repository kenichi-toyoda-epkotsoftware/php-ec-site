<?php
require_once __DIR__ . '/../../model/Database.php';
require_once __DIR__ . '/../../model/Product.php';

$cart = $_SESSION['cart'] ?? [];
$products = [];
$totalPrice = 0;
$shipping = 300; 
$userName = $_SESSION['staff_name'] ?? 'ゲスト';

$pdo = Database::getConnection();
$proModel = new Product($pdo);

$productIds = array_keys($cart);
$products = $productModel->findByIds($productIds);

$totalPrice = $productModel->math($cart, $products);
$finalTotal = $totalPrice + $shipping;