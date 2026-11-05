<?php
ini_set('display_errors', "1");
error_reporting(E_ALL);

require_once __DIR__ . '/../model/Database.php';
require_once __DIR__ . '/../model/User.php';

session_start();
if (isset($_POST['name']) && isset($_POST['pass']) && isset($_POST['pass2'])) {
    if ($_POST['pass'] === $_POST['pass2']) {
        $name = $_POST['name'];
        $pass = $_POST['pass'];
    
        $pdo = Database::getConnection();
        $userModel = new User($pdo);
        $userModel->create($name, $pass);

        header('Location: ../view/staff/staff_add_done.php?name=' . $name);
        exit;
    }
}