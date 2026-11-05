<?php
require_once __DIR__ . '/../../model/Database.php';
require_once __DIR__ . '/../../model/User.php';

$name = $_POST['name'];
$pdo = Database::getConnection();
$userModel = new User($pdo);

?>
<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add your account</title>
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
            padding: 40px;
            border-radius: 12px;
            box-shadow: 0 4px 12px rgba(0,0,0,0.05);
            width: 360px;
        }
        .logo {
            font-size: 24px;
            margin-bottom: 20px;
        }
        h2 {
            font-size: 22px;
            margin-bottom: 30px;
            color: #111;
        }
        .form-group {
            text-align: left;
            margin-bottom: 20px;
        }
        .form-group label {
            display: block;
            font-size: 13px;
            font-weight: bold;
            color: #333;
            margin-bottom: 6px;
        }
        .form-group input[type="text"],
        .form-group input[type="password"] {
            width: 100%;
            padding: 10px 12px;
            border: 1px solid #ddd;
            border-radius: 6px;
            box-sizing: border-box;
            font-size: 14px;
            outline: none;
            transition: border-color 0.2s;
        }
        .form-group input:focus {
            border-color: #000;
        }
        .btn-group {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-top: 30px;
        }
        .back-btn {
            padding: 10px 20px;
            background-color: #f0f3f8;
            color: #333;
            text-decoration: none;
            border-radius: 6px;
            font-size: 14px;
            font-weight: bold;
            box-sizing: border-box;
            transition: background-color 0.2s;
        }
        .back-btn:hover {
            background-color: #e2e8f0;
        }
        .next-btn {
            padding: 10px 24px;
            background-color: #000;
            color: #fff;
            border: none;
            border-radius: 6px;
            font-size: 14px;
            font-weight: bold;
            cursor: pointer;
            transition: background-color 0.2s;
        }
        .next-btn:hover {
            background-color: #333;
        }
    </style>
</head>
<body>

<div class="container">
    <div class="logo">🏯</div>
    
    <h2>add your account</h2>

    <form method="post" action="../../controller/staff_add_check.php">

        <div class="form-group">
            <label for="name">Staff name</label>
            <input type="text" id="name" name="name" required>
        </div>

        <div class="form-group">
            <label for="pass">Pass word</label>
            <input type="password" id="pass" name="pass" required>
        </div>

        <div class="form-group">
            <label for="pass2">Please enter your password again</label>
            <input type="password" id="pass2" name="pass2" required>
        </div>

        <div class="btn-group">
            <a href="staff_list.php" class="back-btn">Back</a>
            <input type="submit" value="Next" class="next-btn">
        </div>

    </form>
</div>
</body>
</html>