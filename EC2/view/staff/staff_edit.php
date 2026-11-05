<?php
$staff_code = $_GET['id'] ?? null;
?>
<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <title>Edit staff</title>
</head>
<body>
    <div style="text-align: center; margin-top: 100px;">
        <h2>Edit staff</h2>
        
        <p>Staff code: <?php echo htmlspecialchars($staff_code, ENT_QUOTES, 'UTF-8'); ?></p>
        
        <form action="../../controller/staff_edit_check.php" method="POST">
            <input type="hidden" name="staffcode" value="<?php echo htmlspecialchars($staff_code, ENT_QUOTES, 'UTF-8'); ?>">
            <p>
                Staff name<br>
                <input type="text" name="name" value="<?php echo htmlspecialchars($staff_code, ENT_QUOTES, 'UTF-8'); ?>" required>
            </p>
            <p>
                Password<br>
                <input type="password" name="pass">
            </p>
            <p>
                One more again password<br>
                <input type="password" name="pass2">
            </p>
            <p>
                <button type="button" onclick="history.back()">Back</button>
                <button type="submit" name="edit">Edit</button>
            </p>
        </form>
    </div>
</body>
</html>