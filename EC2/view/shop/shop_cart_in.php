<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>カート追加 - KENGAMES</title>
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
            text-align: center;
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

        /* メッセージ領域 */
        .message-area {
            padding: 60px 0;
        }
        .message-title {
            font-size: 15px;
            font-weight: bold;
            color: #333;
            margin-bottom: 20px;
        }
        .link-back {
            font-size: 12px;
            color: #555;
            text-decoration: none;
        }
        .link-back:hover {
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

    <!-- メッセージコンテンツ -->
    <div class="message-area">
        <div class="message-title">カートに追加しました</div>
        <a href="shop_list.php" class="link-back">商品一覧へ戻る</a>
    </div>

    <!-- フッター -->
    <footer>
        &copy; 2026 MINPLE All rights reserved.
    </footer>
</div>

</body>
</html>