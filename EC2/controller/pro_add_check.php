<?php
require_once __DIR__ . '/../model/Database.php';
require_once __DIR__ . '/../model/Product.php';

ini_set('display_errors', "1");
error_reporting(E_ALL);

if (isset($_POST['name']) && isset($_POST['price']) && isset($_FILES['gazou'])) {
    $name = $_POST['name'];
    $price = $_POST['price'];
    $file = $_FILES['gazou'];
    $gazou_name = '';


    if ($file['error'] === UPLOAD_ERR_OK) {
        $gazou_name = basename($file['name']);

        $upload_dir = __DIR__ . '/../img/'; 
        $upload_path = $upload_dir . $gazou_name;
        if (!move_uploaded_file($file['tmp_name'], $upload_path)) {
            exit('画像のアップロードに失敗しました。');
        }
    }

    $pdo = Database::getConnection();
    $userModel = new Product($pdo);
    $userModel->create($name, $price, $gazou_name);

    header('Location: ../view/product/product_list.php');
    exit;
}

/*
$_FILES['gazou'] = [
    'name' => 'tea.jpg',             // 元のファイル名
    'tmp_name' => '/tmp/phpY3h1a2',   // ★サーバーの一時保存場所（ここにある！）
    'error' => 0,                    // エラーがないか
    'size' => 12345                  // ファイルサイズ
];
*/