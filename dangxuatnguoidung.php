<?php
session_start();
echo $_SESSION['ten_kh'];
echo $_SESSION['email_kh'];
unset($_SESSION['email_kh']);
unset($_SESSION['ten_kh']);
header('location: dangnhap.php');
?>