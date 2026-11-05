<?php
session_start();

$productId = $_POST['product_id'] ?? null;
$quantity = (int)($_POST['quantity'] ?? 1);

if ($productId && $quantity > 0) {
    if (!isset($_SESSION['cart'])) {
        $_SESSION['cart'] = [];
    }

    if (isset($_SESSION['cart'][$productId])) {
        $_SESSION['cart'][$productId] += $quantity;
    } else {
        $_SESSION['cart'][$productId] = $quantity;
    }

    header('Location: ../../view/shop/shop_cart_in.php');
    exit;
}

/*
$_SESSION['cart'] = [
    1 => 3,  // 商品ID 1 が 合計 3個 (最初に2個 + 追加で1個)
    4 => 1   // 商品ID 4 が 1個
];
*/