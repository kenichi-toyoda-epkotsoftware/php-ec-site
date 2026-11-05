<?php
session_start();

if (isset($_POST['add'])) {
    header('Location: ../view/product/pro_add.php');
    exit;
}


if (isset($_POST['disp'])) {
    if (!isset($_POST['productcode'])) {
        header('Location: ../view/product/product_list.php');
        exit;
    }
    $procode = $_POST['productcode'];
    header('Location: ../view/product/pro_disp.php?id=' . $procode);
    exit;
}


if (isset($_POST['edit'])) {
    if (!isset($_POST['productcode'])) {
        header('Location: ../view/product/product_list.php');
        exit;
    }
    $procode = $_POST['productcode'];
    header('Location: ../view/product/pro_edit.php?id=' . $procode);
    exit;
}


if (isset($_POST['delete'])) {
    if (!isset($_POST['productcode'])) {
        header('Location: ../view/product/product_list.php');
        exit;
    }
    $procode = $_POST['productcode'];
    header('Location: ../view/product/pro_delete.php?id=' . $procode);
    exit;
}


header('Location: ../../view/staff/staff_list.php');
exit;