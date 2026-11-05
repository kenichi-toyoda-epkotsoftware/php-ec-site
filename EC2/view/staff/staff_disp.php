<?php
require_once __DIR__ . '/../../model/Database.php';
require_once __DIR__ . '/../../model/User.php';

$staffcode = $_GET['id'] ?? null;
$pdo = Database::getConnection();
$userModel = new User($pdo);
$staff = $userModel->findById($staffcode);
?>
<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Staff data</title>
    <style>
        body {
            font-family: sans-serif;
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            margin: 0;
            background-color: #f8f9fa;
        }
        .container {
            text-align: center;
            background: #fff;
            padding: 40px;
            border-radius: 12px;
            box-shadow: 0 4px 12px rgba(0,0,0,0.05);
            width: 320px;
        }
        h2 {
            font-size: 24px;
            margin-bottom: 30px;
            color: #333;
        }
        .info-group {
            text-align: left;
            margin-bottom: 30px;
            font-size: 15px;
            line-height: 1.8;
            color: #333;
            padding: 0 10px;
        }
        .back-btn {
            display: inline-block;
            padding: 10px 24px;
            background-color: #f0f3f8;
            color: #333;
            text-decoration: none;
            border-radius: 6px;
            font-size: 14px;
            font-weight: bold;
            box-sizing: border-box;
            transition: background-color 0.2s;
        }
        .back-btn:hover {
            background-color: #e2e8f0;
        }
    </style>
</head>
<body>

<div class="container">
    <h2>Staff data</h2>

    <div class="info-group">
        <p>Staff code: <?= htmlspecialchars($staff['id'], ENT_QUOTES, 'UTF-8') ?></p>
        <p>Staff name: <?= htmlspecialchars($staff['name'], ENT_QUOTES, 'UTF-8') ?></p>
    </div>

    <a href="staff_list.php" class="back-btn">Back</a>
</div>

</body>
</html>