<?php
session_start();
include_once('connect.php');
if(isset($_SESSION['mail'])&& isset($_SESSION['pass'])){
    $id_bv=$_GET['id'];
    $name_del=$_GET['name'];
    $img=$_GET['img'];
    unlink("anh/$img");
    $sql="DELETE FROM baiviet_sp WHERE id_bv='$id_bv'";
    mysqli_query($conn, $sql);
    header('location: index.php?page_layout=content');
}
else{
    die("Ban khong co quyen");
}
?>

