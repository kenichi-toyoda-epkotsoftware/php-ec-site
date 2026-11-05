<?php
require_once __DIR__ . '/../model/Database.php';
require_once __DIR__ . '/../model/Product.php';

ini_set('display_errors', "1");
error_reporting(E_ALL);

if (isset($_POST['name']) && isset($_POST['price']) && isset($_FILES['gazou'])) {
    $pro_code = $_POST['id'];
    $pro_name = $_POST['name'];
    $pro_price = $_POST['price'];

    $gazou_name = $_POST['old_gazou'] ?? ''; 
    $file = $_FILES['gazou'] ?? null;

    if ($file && $file['error'] === UPLOAD_ERR_OK) {
        $gazou_name = basename($file['name']);

        $upload_dir = __DIR__ . '/../img/'; 
        $upload_path = $upload_dir . $gazou_name;
        
        if (!move_uploaded_file($file['tmp_name'], $upload_path)) {
            exit('画像のアップロードに失敗しました。');
        }
    }
    
    $pdo = Database::getConnection();
    $proModel = new Product($pdo);
    $proModel->update($pro_name,$pro_price,$gazou_name,$pro_code);
    

    header('Location: ../view/product/product_list.php');
    exit;
}