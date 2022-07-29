<?php
session_start();
include_once('connect.php');
if(isset($_SESSION['mail'])&& isset($_SESSION['pass'])){
    $category_id=$_GET['id'];
    $sql="DELETE FROM danhmucbaiviet_sp WHERE id_danhmuc_bv = '$category_id'";
    mysqli_query($conn, $sql);
    header('location: index.php?page_layout=category_content');
}
?>