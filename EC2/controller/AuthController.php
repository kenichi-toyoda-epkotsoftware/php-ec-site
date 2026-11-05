<?php

require_once __DIR__ . '/../model/Database.php';
require_once __DIR__ . '/../model/User.php';

class AuthController
{
    public function login(): void
    {
        // POST以外の情報が来たらリセット
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            header('Location: ../view/login/login.php');
            exit;
        }

        // POSTの情報がおかしいなら''を入れる
        $staffName = trim($_POST['staff_name'] ?? '');
        $staffPass = $_POST['staff_pass'] ?? '';

        // 空ならリセット
        if ($staffName === '' || $staffPass === '') {
            header('Location: ../view/login/login_ng.php');
            
            exit;
        }

        // 例外処理 DB,server,SQLがエラー起きた時の処理
        try {
            // ec_shop2とのパイプを呼び出す
            $pdo = Database::getConnection();
            $userModel = new User($pdo);

            // 認証実行
            $user = $userModel->authenticate($staffName, $staffPass);

            if ($user) {
                // セッション固定攻撃対策（IDを再生成）
                session_start();
                session_regenerate_id(true);

                // この人はログインできますよ
                $_SESSION['staff_id']   = $user['id'];
                $_SESSION['staff_name'] = $user['name'];

                header('Location: ../view/staff/staff_top.php');
                exit;
            } else {
                header('Location: ../view/login/login_ng.php');
                
                exit;
            }

        } catch (Exception $e) {
            header('Location: ../view/login/login_ng.php');
            
            exit;
        }
    }
}


$controller = new AuthController();
$controller->login();