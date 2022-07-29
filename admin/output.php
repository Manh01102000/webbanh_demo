<?php
session_start();
echo $_SESSION['mail'];
echo $_SESSION['pass'];
echo $_SESSION['tenadmin'];
unset($_SESSION['mail']);
unset($_SESSION['pass']);
unset($_SESSION['tenadmin']);
header('location: login.php');
?>