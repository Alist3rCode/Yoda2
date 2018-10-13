<?php
$cookie_name = 'yoda';
unset($_COOKIE[$cookie_name]);
// empty value and expiration one hour before
$res = setcookie($cookie_name, '', time() - 3600);

session_start();
session_destroy();

header('Location: ../login.php');

?>