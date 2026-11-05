<?php
require_once __DIR__ . '/../model/Database.php';
require_once __DIR__ . '/../model/User.php';

if (isset($_POST['name']) && isset($_POST['pass']) && isset($_POST['pass2'])) {
    if ($_POST['pass'] === $_POST['pass2']) {
        $staff_code = $_POST['staffcode'];
        $staff_name = $_POST['name'];
        $staff_pass = $_POST['pass'];
        
        $pdo = Database::getConnection();
        $userModel = new User($pdo);
        $staff = $userModel->update($staff_name,$staff_pass,$staff_code);
        

        header('Location: ../view/staff/staff_list.php');
        exit;
    }
}