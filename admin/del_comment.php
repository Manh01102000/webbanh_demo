<?php
session_start();
include_once('connect.php');
if(isset($_SESSION['mail'])&& isset($_SESSION['pass'])){
    $comment_id=$_GET['id'];
    $sql="DELETE FROM binhluan_sp WHERE id_bl = '$comment_id'";
    mysqli_query($conn, $sql);
    header('location: index.php?page_layout=comment');
}
?>