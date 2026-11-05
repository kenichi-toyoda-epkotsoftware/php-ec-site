<?php
session_start();

if (isset($_POST['add'])) {
    header('Location: ../view/staff/staff_add.php');
    exit;
}


if (isset($_POST['disp'])) {
    if (!isset($_POST['staffcode'])) {
        header('Location: ../view/staff/staff_list.php'); // 未選択エラー等へ
        exit;
    }
    $staffcode = $_POST['staffcode'];
    header('Location: ../view/staff/staff_disp.php?id=' . $staffcode);
    exit;
}


if (isset($_POST['edit'])) {
    if (!isset($_POST['staffcode'])) {
        header('Location: ../view/staff/staff_ng.php');
        exit;
    }
    $staffcode = $_POST['staffcode'];
    header('Location: ../view/staff/staff_edit.php?id=' . $staffcode);
    exit;
}


if (isset($_POST['delete'])) {
    if (!isset($_POST['staffcode'])) {
        header('Location: ../../view/staff/staff_ng.php');
        exit;
    }
    $staffcode = $_POST['staffcode'];
    header('Location: ../view/staff/staff_delete.php?id=' . $staffcode);
    exit;
}


header('Location: ../../view/staff/staff_list.php');
exit;