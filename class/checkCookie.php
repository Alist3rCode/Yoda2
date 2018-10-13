<?php

function checkCookie($bdd,$page){
    
   
    if($_SERVER['HTTP_HOST'] == 'maj-imaging.evolucare.com'){
            
        header('Location: https://yoda.evolucare.com/index.php');
            
    }else{
    
        if (isset($_COOKIE['yoda'])){
            $cookie = $_COOKIE['yoda'];
            $parts = explode('====', $cookie);
            $id_user = $parts[0];
            
            $select = $bdd->queryObj('SELECT * '
                    . 'FROM YDA_SESSION '
                    . 'WHERE SES_ID_USR ="'.$id_user.'"');
            $sessionCookie = [];
            if(count($select) !== 0){
                
                $sessionCookie['token'] = $select[0]->SES_TOKEN;
                $sessionCookie['timeout'] = new Datetime($select[0]->SES_TIMEOUT);

                $expected = $id_user . '====' . $sessionCookie['token'] . '====' . $sessionCookie['timeout']->format('Y-m-d H:i:s');
                $now = new DateTime(date('Y-m-d H:i:s'));
                $interval = $now->diff($sessionCookie['timeout']);            
            
                if ($expected == $cookie && intval($interval->format('%R%a')) > 0 ){
                    
                    $_SESSION['login'] = 'ok';
                    $_SESSION['id_user'] = $id_user; 
                    $_SESSION['token'] = $sessionCookie['token'];
                    $now->modify('+4 days');
                    
                    $_SESSION['timeout'] = $now->format('Y-m-d H:i:s');
                    $req = $bdd->prepare('UPDATE YDA_SESSION SET SES_TIMEOUT = :timeout WHERE SES_ID_USR = :id_user');
                
                    $req->execute(array(
                    'id_user' => $id_user,
                    'timeout' => $now->format('Y-m-d H:i:s')
                    )) or die(print_r($bdd->errorCode()));
                }
            }else{
                header('Location: logout.php');
            }
        }
            
        if(!isset($_SESSION['login']) || $_SESSION['login'] != 'ok'){

            header('Location: login.php?redirect='.$page);

        }else if(!isset($_SESSION['id_user']) || $_SESSION['id_user'] == ''){

           header('Location: login.php?redirect='.$page);

        }else{
            setcookie('yoda', $_SESSION['id_user'] . '====' . $_SESSION['token'] . '====' . $_SESSION['timeout'], time() + 60 * 60 * 24 * 4);
        }
    }
}