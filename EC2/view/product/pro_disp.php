<?php
require_once __DIR__ . '/../../model/Database.php';
require_once __DIR__ . '/../../model/Product.php';

$id = $_GET['id'];

$pdo = Database::getConnection();
$proModel = new Product($pdo);
$product = $proModel->findById($id);
?>
<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>商品詳細</title>
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
            background: #fff;
            padding: 30px;
            border-radius: 12px;
            box-shadow: 0 4px 12px rgba(0,0,0,0.05);
            width: 380px;
            box-sizing: border-box;
        }
        h2 {
            font-size: 20px;
            text-align: center;
            margin-bottom: 25px;
        }
        .form-group {
            margin-bottom: 20px;
        }
        label {
            display: block;
            font-size: 13px;
            font-weight: bold;
            color: #333;
            margin-bottom: 6px;
        }
        /* 入力欄と同じ形に揃えた表示ボックス */
        .value-box {
            width: 100%;
            padding: 10px;
            background-color: #f8f9fa;
            border: 1px solid #ddd;
            border-radius: 6px;
            box-sizing: border-box;
            font-size: 14px;
            color: #333;
            margin: 0;
        }
        .image-container {
            text-align: center;
            padding: 10px;
            background-color: #f8f9fa;
            border: 1px solid #ddd;
            border-radius: 6px;
        }
        .image-container img {
            max-width: 100%;
            height: auto;
            border-radius: 4px;
        }
        .btn-container {
            display: flex;
            justify-content: flex-start;
            align-items: center;
            margin-top: 30px;
        }
        .btn-back {
            background-color: #f0f3f8;
            color: #333;
            border: none;
            padding: 10px 20px;
            border-radius: 6px;
            font-weight: bold;
            cursor: pointer;
            text-decoration: none;
            font-size: 14px;
            display: inline-block;
        }
    </style>
</head>
<body>

    <div class="container">
        <h2>商品詳細</h2>

        <div class="form-group">
            <label>商品番号</label>
            <p class="value-box"><?= htmlspecialchars($product['id'] ?? '', ENT_QUOTES, 'UTF-8') ?></p>
        </div>

        <div class="form-group">
            <label>商品名</label>
            <p class="value-box"><?= htmlspecialchars($product['name'] ?? '', ENT_QUOTES, 'UTF-8') ?></p>
        </div>

        <div class="form-group">
            <label>価格</label>
            <p class="value-box"><?= htmlspecialchars($product['price'] ?? '', ENT_QUOTES, 'UTF-8') ?>円</p>
        </div>

        <div class="form-group">
            <label>商品画像</label>
            <div class="image-container">
                <?php if (!empty($product['gazou'])): ?>
                    <img src="../../img/<?= htmlspecialchars($product['gazou'], ENT_QUOTES, 'UTF-8') ?>" alt="商品画像">
                <?php else: ?>
                    <p style="margin: 0; font-size: 14px; color: #666;">画像はありません</p>
                <?php endif; ?>
            </div>
        </div>

        <div class="btn-container">
            <a href="product_list.php" class="btn-back">戻る</a>
        </div>
    </div>

</body>
</html>