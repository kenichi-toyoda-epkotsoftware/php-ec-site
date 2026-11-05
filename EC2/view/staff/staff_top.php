<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <title>管理者画面</title>
    <style>
        body { display: flex; margin: 0; font-family: sans-serif; }
        .sidebar { width: 200px; background: #2c3e50; color: white; height: 100vh; padding: 20px; }
        .main { flex: 1; padding: 20px; background: #f9f9f9; }
        .card { background: white; padding: 15px; margin-bottom: 10px; border: 1px solid #ddd; border-radius: 5px; }
    </style>
</head>
<body>
    <div class="sidebar">
        <h3>管理者画面</h3>
        <p><a href="staff_list.php" style="color: white; text-decoration: none;">スタッフ管理</a></p>
        <p><a href="../product/product_list.php" style="color: white; text-decoration: none;">商品管理</a></p>
        <p><a href="../shop/shop_list.php" style="color: white; text-decoration: none;">ショップ</a></p>
    </div>

    <div class="main">
        <div style="display: flex; justify-content: space-between; align-items: center;">
            <h2>ダッシュボード</h2>
            <div>
                <span>こんにちは Miyu Ishida さん</span>
                <!-- ログアウトボタン -->
                <a href="../Controller/logout.php"><button>ログアウト</button></a>
            </div>
        </div>

        <div style="display: flex; gap: 15px; margin-top: 20px;">
            <div class="card" style="flex: 1;">
                <p>スタッフ数</p>
                <h3 style="color: blue;">20人</h3>
            </div>
            <div class="card" style="flex: 1;">
                <p>新規登録</p>
                <h3 style="color: green;">5人</h3>
            </div>
            <div class="card" style="flex: 1;">
                <p>アクティブユーザー</p>
                <h3>15人</h3>
            </div>
        </div>
    </div>

</body>
</html>