<script
    src="ckeditor/ckeditor.js">
    if (window.history.replaceState) {
		window.history.replaceState(null, null, window.location.href);
	}
</script>
<?php
ob_start();
include_once("connect.php");
define('hang', true);
session_start();
if(isset($_SESSION['mail'])&&isset($_SESSION['pass'])){
    $mail = $_SESSION['mail'];
    $pass = $_SESSION['pass'];
    $sql = "SELECT * FROM user WHERE user_mail='$mail' AND user_pass='$pass'";
    $query = mysqli_query($conn, $sql);
    $row = mysqli_fetch_array($query);
    if ($row['user_level'] == 1) {
        define("admin", true);
        include_once('admin.php');
    } else {
        define("btv", true);
        include_once('admin.php');
    }
}
else{
    include_once('login.php');
}
?>