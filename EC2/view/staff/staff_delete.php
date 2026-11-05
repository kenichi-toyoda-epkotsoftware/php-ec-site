<?php
$staff_code = $_GET['id'];
?>
<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <title>Staff Delete</title>
</head>
<body>
    <div style="text-align: center; margin-top: 100px;">
        <h2>Staff Delete</h2>
        
        <p>Staff code: <?php echo htmlspecialchars($staff_code, ENT_QUOTES, 'UTF-8'); ?></p>
        <p>Are you sure you want to delete this staff?</p>
        
        <form action="../../controller/staff_delete_check.php" method="POST">
            <input type="hidden" name="staffcode" value="<?php echo htmlspecialchars($staff_code, ENT_QUOTES, 'UTF-8'); ?>">
            
            <p>
                Staff name: <strong><?php echo htmlspecialchars($staff_list[$staff_code-1]['name'] ?? '', ENT_QUOTES, 'UTF-8'); ?></strong>
            </p>
            
            <p>
                <button type="button" onclick="history.back()">Back</button>
                <button type="submit" name="delete" style="background-color: #ff4d4d; color: white;">Delete</button>
            </p>
        </form>
    </div>
</body>
</html>