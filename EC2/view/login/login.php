<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <title>ログイン画面</title>
</head>
<body>
    <div style="text-align: center; margin-top: 100px;">
        <h2>Login</h2>
        
        <form action="../../controller/AuthController.php" method="POST">
            <p>
                Staff name<br>
                <input type="text" name="staff_name" required>
            </p>
            <p>
                Pass word<br>
                <input type="password" name="staff_pass" required>
            </p>
            <p>
                <button type="submit">Login</button>
            </p>
        </form>
    </div>
</body>
</html>