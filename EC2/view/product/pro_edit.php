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
    <title>商品編集</title>
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
            width: 420px;
            box-sizing: border-box;
        }
        h2 {
            font-size: 20px;
            text-align: center;
            margin-bottom: 10px;
        }
        .product-id {
            text-align: center;
            font-size: 14px;
            color: #555;
            margin-bottom: 20px;
        }
        .image-preview {
            text-align: center;
            margin-bottom: 25px;
        }
        .image-preview img {
            max-width: 120px;
            height: auto;
            border-radius: 6px;
            border: 1px solid #ddd;
            padding: 4px;
            background: #fff;
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
        input[type="text"],
        input[type="file"] {
            width: 100%;
            padding: 10px;
            border: 1px solid #ddd;
            border-radius: 6px;
            box-sizing: border-box;
            font-size: 14px;
        }
        input[type="file"] {
            border: none;
            padding: 0;
            background: transparent;
        }
        .btn-container {
            display: flex;
            justify-content: space-between;
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
        }
        .btn-submit {
            background-color: #000;
            color: #fff;
            border: none;
            padding: 10px 25px;
            border-radius: 6px;
            font-weight: bold;
            cursor: pointer;
            font-size: 14px;
        }
    </style>
</head>
<body>

<div class="container">
    <h2>商品編集</h2>
    <div class="product-id">商品番号：<?= htmlspecialchars($product['id'] ?? '4', ENT_QUOTES, 'UTF-8') ?></div>

    <div class="image-preview">
        <?php if (!empty($product['gazou'])): ?>
            <img src="../../img/<?= htmlspecialchars($product['gazou'], ENT_QUOTES, 'UTF-8') ?>" alt="商品画像">
        <?php else: ?>
            <p style="font-size: 13px; color: #888;">画像はありません</p>
        <?php endif; ?>
    </div>

    <form method="POST" action="../../controller/pro_edit_check.php" enctype="multipart/form-data">

        <input type="hidden" name="id" value="<?= htmlspecialchars($product['id'] ?? '4', ENT_QUOTES, 'UTF-8') ?>">
        <input type="hidden" name="old_gazou" value="<?= htmlspecialchars($product['gazou'] ?? '', ENT_QUOTES, 'UTF-8') ?>">

        <div class="form-group">
            <label for="name">商品名</label>
            <input type="text" id="name" name="name" value="<?= htmlspecialchars($product['name'] ?? '酔7132', ENT_QUOTES, 'UTF-8') ?>" required>
        </div>

        <div class="form-group">
            <label for="price">価格</label>
            <input type="text" id="price" name="price" value="<?= htmlspecialchars($product['price'] ?? '1650', ENT_QUOTES, 'UTF-8') ?>" required>
        </div>

        <div class="form-group">
            <label for="gazou">画像を選択してください</label>
            <input type="file" id="gazou" name="gazou" accept="image/*">
        </div>

        <div class="btn-container">
            <a href="product_list.php" class="btn-back">戻る</a>
            <button type="submit" class="btn-submit">編集</button>
        </div>

    </form>
</div>

</body>
</html>