<?php
require_once __DIR__ . '/../../model/Database.php';
require_once __DIR__ . '/../../model/Product.php';

$pdo = Database::getConnection();
$proModel = new Product($pdo);
$product_list = $proModel->findAll();
?>
<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>商品一覧</title>
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
            padding: 30px;
            border-radius: 12px;
            box-shadow: 0 4px 12px rgba(0,0,0,0.05);
            width: 360px;
        }
        h2 {
            font-size: 24px;
            margin-bottom: 20px;
        }
        .product-list {
            text-align: left;
            margin-bottom: 20px;
            max-height: 200px;
            overflow-y: auto;
        }
        .product-item {
            margin: 8px 0;
            display: flex;
            align-items: center;
        }
        .product-item input[type="radio"] {
            margin-right: 10px;
        }
        .btn-group {
            display: flex;
            gap: 8px;
            margin-bottom: 15px;
        }
        .btn {
            flex: 1;
            padding: 10px 0;
            border: none;
            border-radius: 6px;
            color: #fff;
            font-weight: bold;
            cursor: pointer;
            font-size: 14px;
        }
        .btn-disp    { background-color: #00a2ed; } /* 参照 */
        .btn-add     { background-color: #5856d6; } /* 追加 */
        .btn-edit    { background-color: #000000; } /* 修正 */
        .btn-delete  { background-color: #e5e5ea; color: #333; } /* 削除 */
        
        .top-link {
            display: block;
            width: 100%;
            padding: 10px 0;
            background-color: #f0f3f8;
            color: #333;
            text-decoration: none;
            border-radius: 6px;
            font-size: 14px;
            font-weight: bold;
            box-sizing: border-box;
        }
    </style>
</head>
<body>

<div class="container">
    <h2>商品一覧</h2>

    <form method="post" action="../../controller/product_branch.php">

        <div class="product-list">
            <?php foreach ($product_list as $product): ?>
                <div class="product-item">
                    <input type="radio" name="productcode" value="<?= htmlspecialchars($product['id'], ENT_QUOTES, 'UTF-8') ?>">
                    <span><?= htmlspecialchars($product['name'], ENT_QUOTES, 'UTF-8') ?> … <?= htmlspecialchars($product['price'], ENT_QUOTES, 'UTF-8') ?>円</span>
                </div>
            <?php endforeach; ?>
        </div>

        <div class="btn-group">
            <input type="submit" name="disp" value="参照" class="btn btn-disp">
            <input type="submit" name="add" value="追加" class="btn btn-add">
            <input type="submit" name="edit" value="修正" class="btn btn-edit">
            <input type="submit" name="delete" value="削除" class="btn btn-delete">
        </div>

    </form>

    <a href="../staff/staff_top.php" class="top-link">トップへ戻る</a>
</div>

</body>
</html>