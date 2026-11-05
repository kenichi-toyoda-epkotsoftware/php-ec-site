<?php
require_once __DIR__ . '/../../model/Database.php';
require_once __DIR__ . '/../../model/Product.php';

$id = $_GET["id"];

$pdo = Database::getConnection();
$proModel = new Product($pdo);
$product = $proModel->findById($id);
?>
<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= htmlspecialchars($product['name'], ENT_QUOTES, 'UTF-8') ?> - KENGAMES</title>
    <style>
        body {
            font-family: sans-serif;
            background-color: #f8f9fa;
            margin: 0;
            padding: 40px 20px;
            color: #333;
            display: flex;
            justify-content: center;
        }
        .main-container {
            background: #fff;
            width: 100%;
            max-width: 900px;
            padding: 40px;
            border-radius: 4px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.03);
            box-sizing: border-box;
        }
        /* ヘッダー */
        header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            border-bottom: 1px solid #eaeaea;
            padding-bottom: 20px;
            margin-bottom: 40px;
        }
        .logo {
            font-family: serif;
            font-style: italic;
            font-size: 28px;
            color: #c5a059;
            letter-spacing: 1px;
            text-decoration: none;
        }
        .header-right {
            display: flex;
            align-items: center;
            gap: 20px;
            font-size: 13px;
            color: #666;
        }
        .header-icons {
            display: flex;
            gap: 15px;
            font-size: 16px;
        }
        .header-icons a {
            text-decoration: none;
            color: #555;
        }

        /* 詳細コンテンツ（左右2カラム） */
        .detail-layout {
            display: flex;
            gap: 50px;
            align-items: flex-start;
        }
        .detail-image-box {
            flex: 1;
            border: 1px solid #eee;
            border-radius: 4px;
            padding: 30px;
            text-align: center;
            background: #fff;
        }
        .detail-image-box img {
            max-width: 100%;
            max-height: 300px;
            object-fit: contain;
        }
        .detail-info-box {
            flex: 1;
        }
        .product-code {
            font-size: 14px;
            color: #888;
            margin: 0 0 10px 0;
        }
        .product-title {
            font-size: 22px;
            font-weight: bold;
            color: #333;
            margin: 0 0 15px 0;
        }
        .product-price {
            font-size: 20px;
            font-weight: bold;
            color: #c5a059;
            margin: 0 0 20px 0;
        }
        .product-desc {
            font-size: 13px;
            line-height: 1.8;
            color: #666;
            margin-bottom: 30px;
            border-top: 1px solid #f0f0f0;
            border-bottom: 1px solid #f0f0f0;
            padding: 15px 0;
        }
        
        /* カートフォーム */
        .cart-form {
            display: flex;
            flex-direction: column;
            gap: 20px;
        }
        .quantity-group {
            display: flex;
            align-items: center;
            gap: 15px;
            font-size: 13px;
            color: #555;
        }
        .quantity-input {
            width: 70px;
            padding: 8px;
            border: 1px solid #ccc;
            border-radius: 4px;
            font-size: 14px;
            text-align: center;
        }
        .btn-add-cart {
            width: 100%;
            background-color: #000;
            color: #fff;
            padding: 14px 0;
            border: none;
            border-radius: 4px;
            font-size: 14px;
            font-weight: bold;
            cursor: pointer;
            transition: opacity 0.2s;
        }
        .btn-add-cart:hover {
            opacity: 0.85;
        }
        .btn-back {
            display: inline-block;
            margin-top: 15px;
            color: #888;
            font-size: 12px;
            text-decoration: none;
        }
        .btn-back:hover {
            text-decoration: underline;
        }

        footer {
            text-align: center;
            font-size: 11px;
            color: #aaa;
            margin-top: 60px;
            border-top: 1px solid #eaeaea;
            padding-top: 20px;
        }
    </style>
</head>
<body>

<div class="main-container">
    <!-- ヘッダー -->
    <header>
        <a href="shop_list.php" class="logo">KENGAMES</a>
        <div class="header-right">
            <span>ようこそ <?= htmlspecialchars($userName, ENT_QUOTES, 'UTF-8') ?> 様</span>
            <div class="header-icons">
                <a href="shop_list.php" title="ホーム">🏠</a>
                <a href="cart_look.php" title="カート">🛒</a>
                <a href="contact.php" title="お問い合わせ">✉️</a>
                <a href="member_logout.php" title="ログアウト">🚪</a>
            </div>
        </div>
    </header>

    <!-- メイン領域 -->
    <div class="detail-layout">
        <!-- 左：商品画像 -->
        <div class="detail-image-box">
            <?php if (!empty($product['gazou'])): ?>
                <img src="../../img/<?= htmlspecialchars($product['gazou'], ENT_QUOTES, 'UTF-8') ?>" alt="商品画像">
            <?php else: ?>
                <img src="../../img/no_image.png" alt="画像なし">
            <?php endif; ?>
        </div>

        <!-- 右：商品情報 ＆ カート追加フォーム -->
        <div class="detail-info-box">
            <p class="product-code">#<?= htmlspecialchars($product['id'], ENT_QUOTES, 'UTF-8') ?></p>
            <h1 class="product-title"><?= htmlspecialchars($product['name'], ENT_QUOTES, 'UTF-8') ?></h1>
            <p class="product-price"><?= number_format($product['price']) ?>円</p>
            
            <div class="product-desc">
                KENGAMESが厳選した大人気タイトル！最新のグラフィックと重厚なストーリーをお楽しみいただけます。
            </div>

            <!-- カート追加処理（cart_in.php へ送信） -->
            <form action="../../controller/shop_ctrl/cart.php" method="post" class="cart-form">
                <input type="hidden" name="product_id" value="<?= htmlspecialchars($product['id'], ENT_QUOTES, 'UTF-8') ?>">
                
                <div class="quantity-group">
                    <label for="quantity">数量：</label>
                    <input type="number" id="quantity" name="quantity" value="1" min="1" max="99" class="quantity-input" required>
                </div>

                <button type="submit" class="btn-add-cart">カートに追加する</button>
            </form>

            <a href="shop_list.php" class="btn-back">← 一覧に戻る</a>
        </div>
    </div>

    <!-- フッター -->
    <footer>
        &copy; 2026 MINPLE All rights reserved.
    </footer>
</div>

</body>
</html>