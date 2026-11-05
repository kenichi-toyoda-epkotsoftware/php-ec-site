<?php
require_once __DIR__ . '/../model/Database.php';
require_once __DIR__ . '/../model/User.php';

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header('Location: staff_list.php');
    exit;
}

$id = $_POST['staffcode'];
        
try {
    $pdo = Database::getConnection();
    $userModel = new User($pdo);
    $userModel->delete($id);

    header('Location: ../view/staff/staff_list.php');
    exit;

} catch (Exception $e) {
    exit('削除に失敗しました。');
}