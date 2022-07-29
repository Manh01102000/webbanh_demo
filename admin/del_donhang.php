<?php
session_start();
include_once('connect.php');
if(isset($_SESSION['mail'])&& isset($_SESSION['pass'])){
    $magiohang=$_GET['magiohang'];
    $sql="DELETE FROM giohang_sp WHERE magiohang = '$magiohang'";
    mysqli_query($conn, $sql);
    header('location: index.php?page_layout=quanlydonhang');
}
?>

