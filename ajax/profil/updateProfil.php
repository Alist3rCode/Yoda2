<?php 
require_once "../ajaxDatabaseInit.php";
header('Content-Type: text/plain; charset=utf-8');

$id = '';
$email = '';
$password = '';
$profil = '';
$name = '';
$firstName = '';
$create = '';
$delete = '';

$today = date("Y-m-d H:i:s");  

if ($_REQUEST['mode'] == 'reset'){
    $select = $bdd->queryObj('SELECT * '
            . 'FROM YDA_USERS '
            . 'WHERE USR_MAIL="' . $_REQUEST["email"] . '"');

    $id = $select[0]->USR_ID;
    $email = $select[0]->USR_MAIL;
    $password = $select[0]->password;
    $profil = $select[0]->USR_ID_PRO;
    $name = $select[0]->USR_NAME;
    $firstName = $select[0]->USR_FIRST_NAME;
    $page = $select[0]->USR_PAGE;
    $create = $select[0]->USR_CREATE;
    $delete = $select[0]->USR_DELETE;
    $isTech = $select[0]->USR_TECH;    
    $surname = $select[0]->USR_SURNAME;
        
    $retour = 'ok';
    
   
}

if ($_REQUEST['mode'] == 'update' && $_REQUEST['id'] != 'NEW'){
    
    $select = $bdd->queryObj('SELECT * '
            . 'FROM YDA_USERS '
            . 'WHERE USR_ID="' . $_REQUEST["id"] . '"');

         
    $id = $_REQUEST["id"];
    $email = $_REQUEST['email'];

    if($_REQUEST['password'] == 'PASTOUCHE'){
        
        $password = $select[0]->USR_PASSWORD;
    }else{
       $password = sha1($_REQUEST['password']);
       
    }
    
    if($_REQUEST['idProfil'] == 'PASTOUCHE'){
        
        $profil = $select[0]->USR_ID_PRO;
    }else{
       $profil = $_REQUEST['idProfil'];
       
    }
    
    
        
    $name = strtolower($_REQUEST['lastName']);
    $firstName = strtolower($_REQUEST['name']);

    $create = $select[0]->USR_CREATE;
    $delete = $select[0]->USR_DELETE;
        
    $page = '';
    switch ($_REQUEST['page']) {
        case 'Dashboard' :
            $page = 'index.php';
            break;
        case 'Clients' :
            $page = 'yoda.php';
            break;
        case 'Carte' :
            $page = 'maps.php';
            break;
        case 'Interne' :
            $page = 'interne.php';
            break;
    }
    if(isset($_REQUEST['isTech'])){
        $isTech = $_REQUEST['isTech'];
    }else{
        $isTech = $select[0]->USR_TECH;
    }
    
    $surname = $_REQUEST['surname'];
    
    if (isset($_REQUEST['hook'])){
        
        $deleteRequest = $bdd->prepare('DELETE FROM YDA_HOOK '
            . 'WHERE HOK_ID_TYPE = :idUser '
            . 'AND HOK_TYPE = :type');
    
        $deleteRequest->execute(array(
            'idUser' => $_REQUEST["id"],
            'type' => "User")) or die(print_r($req->errorInfo()));
        if($_REQUEST['hook'][0] != 'null'){
            for($i=0; $i<count($_REQUEST['hook']); $i++){

            $req = $bdd->prepare('INSERT INTO YDA_HOOK( HOK_ID_TYPE, HOK_ID_RGT, HOK_TYPE) '
                    . 'VALUES (:idUser, :right, :type)');

            $req->execute(array(
                'idUser' => $_REQUEST["id"],
                'right' => $_REQUEST['hook'][$i],
                'type' => "User")) or die(print_r($req->errorInfo()));

            } 
        }
        
    }
    
    
    
    $retour = 'ok';
     
}else if($_REQUEST['mode'] == 'update' && $_REQUEST['id'] == 'NEW'){
    $page = '';
    switch ($_REQUEST['page']) {
        case 'Dashboard' :
            $page = 'index.php';
            break;
        case 'Clients' :
            $page = 'yoda.php';
            break;
        case 'Carte' :
            $page = 'maps.php';
            break;
        case 'Interne' :
            $page = 'interne.php';
            break;
    }

    $req = $bdd->prepare('INSERT INTO YDA_USERS'
            . '(USR_MAIL, USR_PASSWORD, USR_ID_PRO, USR_FIRST_NAME, USR_NAME, USR_PAGE, USR_TECH, USR_REFERING, USR_DIRECTION) '
            . 'VALUES (:email, :password, :profil, :name, :lastName, :page, :isTech, :isRef, :isDirection)');

    $req->execute(array(
        'email' => strtolower($_REQUEST['email']),
        'password' => sha1($_REQUEST['password']),
        'profil' => $_REQUEST["idProfil"],
        'name' => strtolower($_REQUEST['name']),
        'lastName' => strtolower($_REQUEST['lastName']),
        'page' => $page,
        'isTech' => $_REQUEST['isTech'],
        'isRef' => $_REQUEST['isRef'],
        'isDirection' => $_REQUEST['isDirection'])) or die(print_r($req->errorInfo()));

    $retour = 'id-' . $bdd->lastInsertId();
}

if ($_REQUEST['mode'] == 'active'){
    if($_REQUEST['actif'] == 0){
        
        $select = $bdd->queryObj('SELECT * '
                . 'FROM YDA_USERS '
                . 'WHERE USR_ID="' . $_REQUEST["id"] . '"');
            
        $id = $select[0]->USR_ID;
        $email = $select[0]->USR_MAIL;
        $password = $select[0]->USR_PASSWORD;
        $profil = $select[0]->USR_ID_PRO;
        $name = $select[0]->USR_NAME;
        $firstName = $select[0]->USR_FIRST_NAME;
        $page = $select[0]->USR_PAGE;
        $create = $select[0]->USR_CREATE;
        $delete = $today;
        $isTech = $select[0]->USR_TECH;
        $surname = $select[0]->USR_SURNAME;
        $retour = 'ok';
        
        
        $req = $bdd->prepare('UPDATE PLA_SLOT '
                . 'SET SLO_VALID = 0 '
                . 'WHERE SLO_ID_USR = :id '
                . 'AND SLO_DATE > :date ');
        
        $req ->execute(array(
        'id' => $_REQUEST["id"],
        'date' => date('Y-m-d')
        ));
        
        
    }else if($_REQUEST['actif'] == 1){
        
        $select = $bdd->queryObj('SELECT * '
                . 'FROM YDA_USERS '
                . 'WHERE USR_ID="' . $_REQUEST["id"] . '"');
    
        $id = $select[0]->USR_ID;
        $email = $select[0]->USR_MAIL;
        $password = $select[0]->USR_PASSWORD;
        $profil = $select[0]->USR_ID_PRO;
        $name = $select[0]->USR_NAME;
        $firstName = $select[0]->USR_FIRST_NAME;
        $page = $select[0]->USR_PAGE;
        $create = $select[0]->USR_CREATE;
        $delete = NULL;
        $isTech = $select[0]->USR_TECH;
        $surname = $select[0]->USR_SURNAME;
        $retour = 'ok';
        
    }else if($_REQUEST['actif'] == 2){
        
        $select = $bdd->queryObj('SELECT * '
                . 'FROM YDA_USERS '
                . 'WHERE USR_ID="' . $_REQUEST["id"] . '"');
       
        $id = $select[0]->USR_ID;
        $email = $select[0]->USR_MAIL;
        $password = $select[0]->USR_PASSWORD;
        $profil = $select[0]->USR_ID_PRO;
        $name = $select[0]->USR_NAME;
        $firstName = $select[0]->USR_FIRST_NAME;
        $page = $select[0]->USR_PAGE;
        $create = $today;
        $delete = NULL;
        $isTech = $select[0]->USR_TECH;
        $surname = $select[0]->USR_SURNAME;
        $retour = 'ok';
    }
}


$update = $bdd->prepare('UPDATE YDA_USERS '
        . 'SET USR_MAIL = :mail, '
        . 'USR_PASSWORD = :password, '
        . 'USR_ID_PRO = :profil, '
        . 'USR_NAME = :name, '
        . 'USR_FIRST_NAME = :firstName, '
        . 'USR_PAGE = :page, '
        . 'USR_CREATE = :create, '
        . 'USR_DELETE = :delete, '
        . 'USR_TECH = :isTech, '
        . 'USR_SURNAME = :surname '
        . 'WHERE USR_ID = :id');
//var_dump($_REQUEST);
//var_dump($id, $email, $password, $profil, $name, $firstName, $page, $create, $delete, $isTech, $surname);
    
$update ->execute(array(
    'id' => $id,
    'mail' => $email,
    'password' => $password,
    'profil' => $profil,
    'name' => $name,
    'firstName' => $firstName,
    'page' => $page,
    'create' => $create,
    'delete' => $delete,
    'isTech' => $isTech,
    'surname' => strtoupper($surname)
    ));


echo $retour;

?>