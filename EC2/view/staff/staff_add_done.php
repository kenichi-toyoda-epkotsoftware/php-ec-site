<?php
require_once __DIR__ . '/../../model/Database.php';
require_once __DIR__ . '/../../model/User.php';
$staff_name = $_GET['name'] ?? null;

$pdo = Database::getConnection();
$userModel = new User($pdo);

?>

<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <title>スタッフ追加完了</title>
    <style>
        body {
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
            font-family: sans-serif;
            background-color: #fff;
        }
        p {
            font-size: 18px;
            margin-bottom: 24px;
            color: #333;
        }
        .btn-back {
            display: inline-block;
            width: 300px;
            padding: 12px 0;
            text-align: center;
            background-color: #f3f4f6;
            color: #1f2937;
            text-decoration: none;
            border-radius: 6px;
            font-weight: 500;
            transition: background-color 0.2s;
        }
        .btn-back:hover {
            background-color: #e5e7eb;
        }
    </style>
</head>
<body>

    <!-- 登録されたスタッフ名を安全に表示（XSS対策） -->
    <p>"<?php echo htmlspecialchars($staff_name, ENT_QUOTES, 'UTF-8'); ?>"さんを登録しました。</p>

    <!-- スタッフ一覧や管理画面へのリンク -->
    <a href="staff_list.php" class="btn-back">戻る</a>

</body>
</html>