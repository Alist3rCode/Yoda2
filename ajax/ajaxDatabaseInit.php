<?php
header('Content-Type: text/html; charset=iso-8859-1');
require '../class/Autoloader.php';
Autoloader::register();

$bdd = new Database('yoda');