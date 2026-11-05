<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>商品追加</title>
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
        .logo-area {
            text-align: center;
            margin-bottom: 15px;
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
        .btn-next {
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
    <div class="logo-area">
        📦
    </div>
    <h2>商品追加</h2>

    <form method="POST" action="../../controller/pro_add_check.php" enctype="multipart/form-data">

        <div class="form-group">
            <label for="name">商品名</label>
            <input type="text" id="name" name="name" required>
        </div>

        <div class="form-group">
            <label for="price">価格</label>
            <input type="text" id="price" name="price" required>
        </div>

        <div class="form-group">
            <label for="gazou">商品画像</label>
            <input type="file" id="gazou" name="gazou" accept="image/*">
        </div>

        <div class="btn-container">
            <a href="product_list.php" class="btn-back">Back</a>
            <button type="submit" class="btn-next">Next</button>
        </div>

    </form>
</div>

</body>
</html>
