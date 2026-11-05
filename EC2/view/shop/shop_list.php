<?php
require_once __DIR__ . '/../../model/Database.php';
require_once __DIR__ . '/../../model/Product.php';

$pdo = Database::getConnection();
$proModel = new Product($pdo);
$products = $proModel->findAll();
?>
<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>KENGAMES - ゲーム一覧</title>
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
            max-width: 1000px;
            padding: 40px;
            border-radius: 4px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.03);
            box-sizing: border-box;
        }

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
        
        .content-layout {
            display: flex;
            gap: 40px;
        }
        
        .brand-section {
            flex: 1;
        }
        .brand-title {
            font-size: 15px;
            font-weight: bold;
            margin-bottom: 15px;
            color: #444;
        }
        .brand-card {
            background: #fff;
            border: 1px solid #eee;
            border-radius: 4px;
            overflow: hidden;
            padding-bottom: 15px;
        }
        .brand-card img {
            width: 100%;
            height: auto;
            display: block;
        }
        .brand-text {
            padding: 15px;
            font-size: 12px;
            line-height: 1.6;
            color: #666;
        }

        .product-section {
            flex: 1.2;
        }
        .section-title {
            font-size: 15px;
            font-weight: bold;
            margin-bottom: 15px;
            color: #444;
        }
        .product-grid {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            gap: 15px;
        }
        .product-card {
            background: #fff;
            border: 1px solid #eee;
            border-radius: 4px;
            padding: 15px;
            box-sizing: border-box;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
        }
        .product-card img {
            width: 100%;
            height: 120px;
            object-fit: contain;
            margin-bottom: 10px;
        }
        .product-info {
            margin-bottom: 15px;
        }
        .product-code {
            font-size: 11px;
            color: #888;
            margin: 0 0 4px 0;
        }
        .product-name {
            font-size: 12px;
            color: #444;
            margin: 0 0 6px 0;
            line-height: 1.4;
        }
        .product-price {
            font-size: 13px;
            font-weight: bold;
            color: #c5a059;
            margin: 0;
        }
        .btn-buy {
            display: block;
            width: 100%;
            background-color: #fcf6eb;
            color: #bfa15f;
            text-align: center;
            padding: 8px 0;
            border-radius: 3px;
            text-decoration: none;
            font-size: 12px;
            font-weight: bold;
            border: 1px solid #f2e6d0;
            box-sizing: border-box;
            transition: background 0.2s;
        }
        .btn-buy:hover {
            background-color: #f7ecdb;
        }

        footer {
            text-align: center;
            font-size: 11px;
            color: #aaa;
            margin-top: 50px;
            border-top: 1px solid #eaeaea;
            padding-top: 20px;
        }
    </style>
</head>
<body>

<div class="main-container">
    <header>
        <a href="shop_list.php" class="logo">KENGAMES</a>
        <div class="header-right">
            <span>ようこそ <?= htmlspecialchars($userName, ENT_QUOTES, 'UTF-8') ?> 様</span>
            <div class="header-icons">
                <a href="../staff/staff_top.php" title="ホーム">🏠</a>
                <a href="shop_cart_look.php" title="カート">🛒</a>
                <a href="contact.php" title="お問い合わせ">✉️</a>
                <a href="member_logout.php" title="ログアウト">🚪</a>
            </div>
        </div>
    </header>


    <div class="content-layout">
        

        <div class="brand-section">
            <div class="brand-title">ゲーム</div>
            <div class="brand-card">
                <img src="../../img/brand_sample.jpg" alt="ゲームイメージ">
                <div class="brand-text">
                    チャフロ茶は、特許取得の焙煎法で引き出したポリフェノール「チャフロサイド」が豊富なお茶です。1つ1つ手作業で丁寧に作られ、内側からゆっくりと健やかな身体へ導きます。
                </div>
            </div>
        </div>


        <div class="product-section">
            <div class="section-title">ゲーム一覧</div>
            <div class="product-grid">
                
                <?php if (!empty($products)): ?>
                    <?php foreach ($products as $product): ?>
                        <div class="product-card">
                            <div>
                                <?php if (!empty($product['gazou'])): ?>
                                    <img src="../../img/<?= htmlspecialchars($product['gazou'], ENT_QUOTES, 'UTF-8') ?>" alt="商品画像">
                                <?php else: ?>
                                    <img src="../../img/no_image.png" alt="画像なし">
                                <?php endif; ?>
                                
                                <div class="product-info">
                                    <p class="product-code">#<?= htmlspecialchars($product['id'], ENT_QUOTES, 'UTF-8') ?></p>
                                    <p class="product-name"><?= htmlspecialchars($product['name'], ENT_QUOTES, 'UTF-8') ?></p>
                                    <p class="product-price"><?= number_format($product['price']) ?>円</p>
                                </div>
                            </div>
                            <a href="shop_item.php?id=<?= htmlspecialchars($product['id'], ENT_QUOTES, 'UTF-8') ?>" class="btn-buy">購入する</a>
                        </div>
                    <?php endforeach; ?>
                <?php else: ?>
                    <p style="font-size: 13px; color: #888;">現在登録されている商品はありません。</p>
                <?php endif; ?>

            </div>
        </div>

    </div>


    <footer>
        &copy; 2026 MINPLE All rights reserved.
    </footer>
</div>

</body>
</html>