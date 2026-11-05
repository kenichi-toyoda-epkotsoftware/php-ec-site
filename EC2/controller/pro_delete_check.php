<?php
require_once __DIR__ . '/../model/Database.php';
require_once __DIR__ . '/../model/Product.php';

$id = $_POST['id'];

$pdo = Database::getConnection();
$proModel = new Product($pdo);
$product = $proModel->delete($id);

header('Location: ../view/product/product_list.php');
exit;
