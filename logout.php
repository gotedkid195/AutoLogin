<?php 
 session_start();
if(isSet($_SESSION['username']))
{
	unset($_SESSION['username']);
	unset($_SESSION['id']);}
if(isSet($_COOKIE['cookie_name']))
{
	setcookie('cookie_name', '', time() - (3600 * 24 * 30));
	echo $_COOKIE['cookie_name'];
}
	header('Location: index.php'); 
	exit;
?>