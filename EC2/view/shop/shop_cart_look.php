<?php
ini_set('display_errors', "1");
error_reporting(E_ALL);
session_start();

require_once __DIR__ . '/../../model/Database.php';
require_once __DIR__ . '/../../model/Product.php';

$cart = $_SESSION['cart'] ?? [];
$products = [];
$totalPrice = 0;
$shipping = 300; 
$errorMessage = '';
$userName = $_SESSION['staff_name'] ?? 'ゲスト'; // ← これを追加！

if (!empty($cart)) {
    try {
        $pdo = Database::getConnection();
        $productModel = new Product($pdo);

        foreach ($cart as $pId => $qty) {
            $product = $productModel->findById($pId);
            if ($product) {
                $products[] = $product;
            }
        }

        $totalPrice = $productModel->math($cart, $products);

    } catch (Exception $e) {
        $errorMessage = 'データの取得に失敗しました。';
    }
}

$finalTotal = $totalPrice + $shipping;
?>
<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>カートの中身 - KENGAMES</title>
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
            margin-bottom: 30px;
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

        .page-title {
            font-size: 16px;
            font-weight: bold;
            color: #333;
            margin-bottom: 25px;
        }

        .error-msg {
            color: #e57373;
            font-size: 13px;
            margin-bottom: 20px;
        }

        /* カートリスト（カード型） */
        .cart-list {
            display: flex;
            flex-direction: column;
            gap: 15px;
            margin-bottom: 30px;
        }
        .cart-item {
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 20px;
            border: 1px solid #f0f0f0;
            border-radius: 6px;
            background: #fff;
        }
        .item-left {
            display: flex;
            align-items: center;
            gap: 20px;
        }
        .item-img {
            width: 60px;
            height: 60px;
            object-fit: contain;
            border-radius: 4px;
            border: 1px solid #eee;
        }
        .item-info {
            display: flex;
            flex-direction: column;
            gap: 4px;
        }
        .item-name {
            font-size: 14px;
            font-weight: bold;
            color: #333;
        }
        .item-sub {
            font-size: 11px;
            color: #aaa;
        }
        .item-price {
            font-size: 14px;
            font-weight: bold;
            color: #2e7d32;
            margin-top: 4px;
        }

        .item-right {
            display: flex;
            align-items: center;
            gap: 15px;
        }
        .quantity-input {
            width: 50px;
            padding: 6px;
            border: 1px solid #ccc;
            border-radius: 4px;
            text-align: center;
            font-size: 14px;
        }
        .btn-delete {
            color: #e57373;
            font-size: 12px;
            text-decoration: none;
            background: none;
            border: none;
            cursor: pointer;
            padding: 4px 8px;
        }
        .btn-delete:hover {
            text-decoration: underline;
        }

        /* 金額計算ブロック */
        .summary-box {
            background-color: #fafafa;
            border-radius: 6px;
            padding: 25px 30px;
            display: flex;
            flex-direction: column;
            gap: 12px;
            margin-bottom: 25px;
        }
        .summary-row {
            display: flex;
            justify-content: space-between;
            font-size: 13px;
            color: #555;
        }
        .summary-row.total {
            font-size: 15px;
            font-weight: bold;
            color: #333;
            border-top: 1px solid #eaeaea;
            padding-top: 12px;
            margin-top: 4px;
        }
        .price-green {
            color: #2e7d32;
            font-weight: bold;
        }

        /* アクションボタン */
        .action-area {
            display: flex;
            justify-content: flex-end;
            gap: 15px;
        }
        .btn-update {
            background-color: #718096;
            color: #fff;
            padding: 12px 20px;
            border-radius: 4px;
            border: none;
            font-size: 13px;
            font-weight: bold;
            cursor: pointer;
        }
        .btn-update:hover {
            background-color: #4a5568;
        }
        .btn-checkout {
            background-color: #4a5568;
            color: #fff;
            padding: 12px 30px;
            border-radius: 4px;
            text-decoration: none;
            font-size: 13px;
            font-weight: bold;
            display: inline-block;
            text-align: center;
        }
        .btn-checkout:hover {
            background-color: #2d3748;
        }
        .empty-cart {
            text-align: center;
            padding: 40px 0;
            color: #778;
            font-size: 14px;
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

    <div class="page-title">カートの中身</div>

    <?php if (!empty($errorMessage)): ?>
        <div class="error-msg"><?= htmlspecialchars($errorMessage, ENT_QUOTES, 'UTF-8') ?></div>
    <?php endif; ?>

    <?php if (empty($cart) || empty($products)): ?>
        <div class="empty-cart">
            <p>カートに商品は入っていません。</p>
            <a href="shop_list.php" style="color: #c5a059; text-decoration: none;">商品一覧へ戻る</a>
        </div>
    <?php else: ?>
        <form action="cart_update.php" method="post">
            <div class="cart-list">
                <?php foreach ($products as $product): 
                    $pId = $product['id'];
                    $qty = $cart[$pId] ?? 0;
                    // ※ ここでの $totalPrice への加算は削除！計算はすべてModelに任せる
                ?>
                <div class="cart-item">
                    <div class="item-left">
                        <?php if (!empty($product['gazou'])): ?>
                            <img src="../../img/<?= htmlspecialchars($product['gazou'], ENT_QUOTES, 'UTF-8') ?>" alt="商品画像" class="item-img">
                        <?php else: ?>
                            <img src="../../img/no_image.png" alt="画像なし" class="item-img">
                        <?php endif; ?>
                        <div class="item-info">
                            <span class="item-name"><?= htmlspecialchars($product['name'], ENT_QUOTES, 'UTF-8') ?></span>
                            <span class="item-sub">KENGAMES セレクト</span>
                            <span class="item-price"><?= number_format($product['price']) ?>円</span>
                        </div>
                    </div>
                    <div class="item-right">
                        <!-- 数量変更用インプット -->
                        <input type="number" name="quantity[<?= $pId ?>]" value="<?= $qty ?>" min="1" max="99" class="quantity-input">
                        <a href="cart_delete.php?id=<?= $pId ?>" class="btn-delete">削除</a>
                    </div>
                </div>
                <?php endforeach; ?>
            </div>

            <!-- 金額計算ブロック -->
            <div class="summary-box">
                <div class="summary-row">
                    <span>商品合計金額:</span>
                    <span class="price-green"><?= number_format($totalPrice) ?>円</span>
                </div>
                <div class="summary-row">
                    <span>送料:</span>
                    <span class="price-green"><?= number_format($shipping) ?>円</span>
                </div>
                <div class="summary-row total">
                    <span>お支払い金額合計:</span>
                    <span class="price-green"><?= number_format($finalTotal) ?>円</span>
                </div>
            </div>

            <!-- アクションボタン領域 -->
            <div class="action-area">
                <button type="submit" class="btn-update">数量を更新する</button>
                <a href="form.php" class="btn-checkout">購入手続きへ</a>
            </div>
        </form>
    <?php endif; ?>

    <!-- フッター -->
    <footer>
        &copy; 2026 KENGAMES All rights reserved.
    </footer>
</div>

</body>
</html>