<?php 
require_once "../ajaxDatabaseInit.php";
require_once "../../class/checkPasswordStrenght.php";

$flag = 0;
if (count(checkPasswordStrenght($_REQUEST['password'])) != 0){
    $flag = 1;
}

$page = '';
$array = [];

switch ($_REQUEST['page']) {
    case 'Dashboard' :
        $page = 'index.php';
        break;
    case 'Clients' :
        $page = 'yoda.php';
        break;
    case 'Clients_Vers' :
        $page = 'yoda.php?filter=ok';
        break;
    case 'Clients_Acti' :
        $page = 'yoda.php?filter=activity';
        break;
    case 'Carte' :
        $page = 'maps.php';
        break;
    case 'Interne' :
        $page = 'interne.php';
        break;
}

if ($flag == 0){
    $req = $bdd->prepare('INSERT INTO YDA_USERS( USR_MAIL, USR_PASSWORD, USR_ID_PRO, USR_FIRST_NAME, USR_NAME, USR_PAGE, USR_SURNAME) '
            . 'VALUES (:email, :password, :profil, :name, :lastName, :page, :surname)');
    
    $req->execute(array(
	'email' => strtolower($_REQUEST['email']),
	'password' => sha1($_REQUEST['password']),
	'profil' => '2',
	'name' => strtolower($_REQUEST['name']),
	'lastName' => strtolower($_REQUEST['lastName']),
	'page' => $page,
        'surname' => strtoupper(substr($_REQUEST['name'], 0, 1).substr($_REQUEST['lastName'], 0, 2)))) or die(print_r($req->errorInfo()));
	$array['ok'] = 'ok';

    $array['id'] = $bdd->lastInsertId();
    
}else{
    
    $array = checkPasswordStrenght($_REQUEST['password']);
    
}



header("content-type:application/json");    
echo json_encode($array);


?>