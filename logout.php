<?php 
 session_start();
 unset($_SESSION['id']);
 unset($_SESSION['username']);
setcookie('cookie_name', '',time()-2592000,'/');

 header('Location: ../index.php'); 
 ?>
