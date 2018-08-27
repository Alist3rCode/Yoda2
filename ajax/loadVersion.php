<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ERROR | E_WARNING | E_PARSE);

require_once "ajaxDatabaseInit.php";   
   
$i = $_REQUEST['id'];
$uid = '';
$version = '';
$historique = '';
$color = '';
$array = [];


foreach($bdd->query('SELECT * FROM YDA_CLIENT WHERE CLI_ID ="' . $i . '"','Clients') as $client):?>
<?php

          
//    while ($query = $select->fetch()){
//        $uid = $query['CLI_UID'];
//        $versionUview = $query['CLI_UVIEW'];
//        $versionView = $query['CLI_VIEW'];
//    }
//    // echo $uid;
//if ($uid == ''){
//    $select = $bdd->query('SELECT * FROM YDA_CLIENT WHERE CLI_ID ="' . $i . '"');
//                    
//        while ($query = $select->fetch()){
//            $version = $query['CLI_NUM_VERSION'];
//            
//        }
//        
//}else{
//    
//    $select = $bdd2->query('SELECT * FROM wrk_client where wrk_client.uid = "' . $uid . '"');
//                    
//    while ($query = $select->fetch()){
//        $version = $query['version'] . '.' . $query['hotfix'];
//    }
//    
//    // $select2 = $bdd2->query('SELECT wrk_deploy.confirmed_at, wrk_hotfix.number, wrk_release.version  FROM `wrk_deploy` 
//    //                         JOIN wrk_client on wrk_client.id = wrk_deploy.client_id 
//    //                         left join wrk_hotfix on wrk_hotfix.id = wrk_deploy.hotfix_id 
//    //                         left join wrk_release on wrk_release.id = wrk_deploy.release_id WHERE wrk_client.uid ="' . $uid . '"
//    //                         order by confirmed_at desc, version desc, number desc
//    //                         LIMIT 10');
//    
//    
//    $select2 = $bdd2->query('SELECT * FROM `logs` WHERE uid ="' . $uid . '" AND performed_action <> "session_poke" order by inserted_at DESC LIMIT 10');
//                        
//        while ($query = $select2->fetch()){
//            // echo '<pre>';
//            // print_r($query);
//            // echo '</pre>';
//            
//            $release = $query['local_version'] . '.' . $query['local_hotfix'];
//            
//            
//            $date = strtotime( $query['inserted_at'] );
//            $date2 = date( 'd-m-Y H:i:s', $date);
//            // echo $date2;
//// 
//            $historique = $historique . '<em>' . $date2 .  '</em> : <strong style="color:#87cdf1">' . $release  . '</strong><br>';
//        }
//
//
//// echo $historique;

if ($_REQUEST['mode'] === 'display'):?>
    
   <?php if(trim($client->CLI_VIEW)!= ''){echo "<p>Version View : <strong style='color:white;'>".$client->CLI_VIEW."</strong></p>";}
    if(trim($client->CLI_UVIEW)!= ''){echo "<p>Version uView : <strong style='color:white;'>".$client->CLI_UVIEW."</strong></p>";}?>

    <p>Version Imaging : <strong style='color:<?=$client->colorVersion();?>'><?=$client->CLI_NUM_VERSION?></strong></p>
    <?php if($historique != ''):?>
    <p>Historique : <br>
    <?=$historique;?>
    </p>
    <?php endif;?>


<?php endif;
if ($_REQUEST['mode'] === 'modif'){
    header("content-type:application/json");
    $array['version'] = $client->CLI_NUM_VERSION;
    $array['uid'] = false;
    echo json_encode($array);
      
}

endforeach;?>