<?php
require_once __DIR__ . '/../../model/Database.php';
require_once __DIR__ . '/../../model/Product.php';

ini_set('display_errors', "1");
error_reporting(E_ALL);

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
    <title>商品削除</title>
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
            max-width: 120px;
            height: auto;
            border-radius: 4px;
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
        /* 削除ボタンは警告色がわかりやすいように少し赤みを持たせるか、黒でシックに統一するならそのままでもOK */
        .btn-delete {
            background-color: #dc3545; /* 削除用の赤系カラー（必要に応じて黒の #000 にしてもOK） */
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
    <h2>商品削除</h2>

    <form method="POST" action="../../controller/pro_delete_check.php">

        <input type="hidden" name="id" value="<?= htmlspecialchars($product['id'] ?? '4', ENT_QUOTES, 'UTF-8') ?>">
        
        <input type="hidden" name="gazou" value="<?= htmlspecialchars($product['gazou'] ?? '', ENT_QUOTES, 'UTF-8') ?>">

        <div class="form-group">
            <label>商品番号</label>
            <p class="value-box"><?= htmlspecialchars($product['id'] ?? '4', ENT_QUOTES, 'UTF-8') ?></p>
        </div>

        <div class="form-group">
            <label>商品名</label>
            <p class="value-box"><?= htmlspecialchars($product['name'] ?? '酔7132', ENT_QUOTES, 'UTF-8') ?></p>
        </div>

        <div class="form-group">
            <label>価格</label>
            <p class="value-box"><?= htmlspecialchars($product['price'] ?? '1650', ENT_QUOTES, 'UTF-8') ?>円</p>
        </div>

        <div class="form-group">
            <label>商品画像</label>
            <div class="image-container">
                <?php if (!empty($product['gazou'])): ?>
                    <img src="../../img/<?= htmlspecialchars($product['gazou'], ENT_QUOTES, 'UTF-8') ?>" alt="商品画像">
                <?php else: ?>
                    <p style="margin: 0; font-size: 13px; color: #888;">画像はありません</p>
                <?php endif; ?>
            </div>
        </div>

        <div class="btn-container">
            <a href="product_list.php" class="btn-back">戻る</a>
            <button type="submit" class="btn-delete">削除</button>
        </div>

    </form>
</div>

</body>
</html>