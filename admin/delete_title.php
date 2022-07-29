<?php
session_start();
include_once('modules/connect/connect.php');
if(isset($_SESSION['mail'])&& isset($_SESSION['pass'])){
    $id=$_GET['id'];
    $sql="DELETE FROM title WHERE id=$id";
    mysqli_query($conn, $sql);
    $insert = "INSERT INTO title (id) VALUES (1)";
    mysqli_query($conn, $insert);
    header('location: index.php?page_layout=setting_title');
}
else{
    die("Ban khong co quyen");
}
?>
