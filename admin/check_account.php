<?php
session_start();
include("connect.php");
if (isset($_SESSION['mail']) && isset($_SESSION['pass'])) {
    // include_once('modules/connect/connect.php');
    // session_start();
    //update
    if (isset($_GET['id'])) {
        $_SESSION['id'] = $_GET['id'];
        $_SESSION['mail'];
        $_SESSION['pass'];
        header('location: index.php?page_layout=product');
    }
    //delete
    if (isset($_GET['id_del'])) {
        $_SESSION['id_del'] = $_GET['id_del'];
        $_SESSION['name_del'] = $_GET['name_del'];
        $_SESSION['img'] = $_GET['img'];
        header('location: index.php?page_layout=product');
    }
}else{
    die('Bạn không có quyền truy cập file check_account');
}
?>
