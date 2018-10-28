<?php 
session_start();
require_once "../ajaxDatabaseInit.php";
require_once "../../class/checkPasswordStrenght.php";


if ($_REQUEST['mode'] === 'login'){
    $password = sha1($_REQUEST['password']);
    $id = '';
    
    if(isset($_REQUEST["email"]) && $_REQUEST["email"] != ''){
        $select = $bdd->queryObj('SELECT * FROM '
                . 'YDA_USERS '
                . 'WHERE USR_MAIL="' . $_REQUEST["email"] . '"');
        
        $passwordSql = $select[0]->USR_PASSWORD;
        $changeDate = new DateTime($select[0]->USR_CHANGE_PASSWORD);
        $changeDate->format('Y-m-d H:i:s');
        $page = $select[0]->USR_PAGE;
        $id = $select[0]->USR_ID;
    }
    
    $array= [];
    $now = new DateTime(date('Y-m-d H:i:s'));
    
    if($password == $passwordSql){
        
        $interval = $changeDate->diff($now);
        if (intval($interval->format('%a')) > 90){
            $array[0] = 'CHANGE';
            
        }else{
        
            $array[0] = 'OK';
            $array[1] = $page;
           
            $_SESSION['login'] = 'ok';
            $_SESSION['user'] = $_REQUEST["email"];
            $_SESSION['id_user'] = $id; 
            
            $token = sha1(microtime(true));
            $_SESSION['token'] = $token;
            $timeout = new DateTime(date('Y-m-d H:i:s'));
            $timeout->modify('+4 days');
            $_SESSION['timeout'] = $timeout->format('Y-m-d H:i:s');
            
            
            $req = $bdd->prepare('REPLACE INTO '
                    . 'YDA_SESSION(SES_TOKEN, SES_ID_USR, SES_TIMEOUT) '
                    . 'VALUES (:token, :id_user, :timeout)');
            
            $req->execute(array(
            'token' => $_SESSION['token'],
            'id_user' => $id,
            'timeout' => $_SESSION['timeout']
            )) or die(print_r($bdd->errorCode()));
            
//            setcookie('yoda', $_SESSION['id_user'] . '====' . $_SESSION['token'] . '====' . $_SESSION['timeout'], time() + 60 * 60 * 24 * 4);
        }
        
    } else{
        $array[0] = 'NOK';
        $_SESSION['login'] = 'nok';
    }
}else if ($_REQUEST['mode'] == "change"){
    
    $password = sha1($_REQUEST['password']);
    $id = '';
    
    if(isset($_REQUEST["email"]) && $_REQUEST["email"] != ''){
        $select = $bdd->queryObj('SELECT * FROM YDA_USERS WHERE USR_MAIL="' . $_REQUEST["email"] . '"');
    
        $passwordSql = $select[0]->USR_PASSWORD;
        $changeDate = new DateTime($select[0]->USR_CHANGE_PASSWORD);
        $changeDate->format('Y-m-d H:i:s');
        $page = $select[0]->USR_PAGE;
        $id = $select[0]->USR_ID;
    }
    $array= [];
    
    if($password == $passwordSql){
        
        $array[0] = 'NOK';
        $array[1] = 'Mot de passe identique au précédent';
        
    }else {
        $flag = 0;
        if (count(checkPasswordStrenght($_REQUEST['password'])) != 0){
            $flag = 1;
        }
        if ($flag == 1){
           
            $array[0] = 'NOK';
            $array[1] =  join("<br>" , checkPasswordStrenght($_REQUEST['password']));
            
            
        }else if($flag == 0){
            
            $update = $bdd->prepare('UPDATE YDA_USERS SET USR_PASSWORD = :password, USR_CHANGE_PASSWORD = :date WHERE USR_ID = :id');
    
            $update->execute(array(
        	'id' => $id,
        	'date' => date('Y-m-d H:i:s'),
        	'password' => sha1($_REQUEST['password']))) or die(print_r($update->errorInfo()));
        	
        	$array[0] = 'OK';
            $array[1] = 'Mot de passe modifié, merci de vous reconnecter';
        }
    }
}
 header("content-type:application/json");

echo json_encode($array);

?>