<?php
session_start();
include_once('connect.php');
if (isset($_SESSION['mail']) && isset($_SESSION['pass'])) {
    $user_id = $_GET['id'];
    $sql = "DELETE FROM user WHERE user_id='$user_id'";
    mysqli_query($conn, $sql);
    header('location: index.php?page_layout=user');
} else {
    die('ban can dang nhap truoc!');
}
?>