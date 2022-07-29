<?php
session_start();
include_once('connect.php');
if(isset($_SESSION['mail'])&& isset($_SESSION['pass'])){
    $prd_id=$_GET['id'];
    $name_del=$_GET['name'];
    $img=$_GET['img'];
    unlink("anh/$img");
    $sql="DELETE FROM sanpham_sp WHERE id_sp=$prd_id";
    mysqli_query($conn, $sql);
    header('location: index.php?page_layout=product');
}
else{
    die("Ban khong co quyen");
}
?>

