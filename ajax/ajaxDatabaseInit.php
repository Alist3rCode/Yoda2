<?php
header('Content-Type: text/html; charset=utf-8');
require '../../class/Autoloader.php';
Autoloader::register();

$bdd = new Database('yoda');
$bdd2 = new Database('ecsupgrader');

