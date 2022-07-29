<?php
session_start();
include_once('connect.php');
if(isset($_SESSION['mail'])&& isset($_SESSION['pass'])){
    $id_dangky=$_GET['id'];
    $sql="DELETE FROM dangky_sp WHERE id_dangky = '$id_dangky'";
    mysqli_query($conn, $sql);
    header('location: index.php?page_layout=customer');
}
?>