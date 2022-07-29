<?php
session_start();
include_once('connect.php');
if(isset($_SESSION['email_kh'])&&isset($_SESSION['ten_kh'])){
    $id_sp = $_GET['id_sp'];
    $comment_id=$_GET['id_bl'];
    $sql="DELETE FROM binhluan_sp WHERE id_bl = '$comment_id'";
    mysqli_query($conn, $sql);
    header("location:chitietsanpham.php?id_sp=$id_sp");
}
?>