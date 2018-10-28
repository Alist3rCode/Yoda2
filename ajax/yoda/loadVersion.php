<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ERROR | E_WARNING | E_PARSE);

require_once "../ajaxDatabaseInit.php";   
   
$i = $_REQUEST['id'];
$uid = '';
$version = '';
$historique = '';
$color = '';
$array = [];


foreach($bdd->query('SELECT * FROM YDA_CLIENT WHERE CLI_ID ="' . $i . '"','Clients') as $client):

          
if ($client->CLI_UID == ''){
    $select = $bdd->queryObj('SELECT CLI_NUM_VERSION FROM YDA_CLIENT WHERE CLI_ID ="' . $i . '"');
    $version = $select[0]->CLI_NUM_VERSION;
               
}else{
    
    $select = $bdd2->queryObj('SELECT * FROM wrk_client where wrk_client.uid = "' . $client->CLI_UID . '"');
                    
    $version = $select[0]->version . '.' . $select[0]->hotfix;
    
    $select2 = $bdd2->queryObj('SELECT * FROM `logs` WHERE uid ="' . $client->CLI_UID . '" AND performed_action <> "session_poke" order by inserted_at DESC LIMIT 10');
              
    foreach($select2 as $key => $value){
            $release = $value->local_version . '.' . $value->local_hotfix;
            
            
            $date = strtotime( $value->inserted_at );
            $date2 = date( 'd-m-Y H:i:s', $date);
            // echo $date2;
// 
            $historique = $historique . '<em>' . $date2 .  '</em> : <strong style="color:#87cdf1">' . $release  . '</strong><br>';
    }
}

if ($_REQUEST['mode'] === 'display'):
    
   if(trim($client->CLI_VIEW)!= ''){
       echo "<p>Version View : <strong style='color:white;'>".$client->CLI_VIEW."</strong></p>";
       
   }
    if(trim($client->CLI_UVIEW)!= ''){
        echo "<p>Version uView : <strong style='color:white;'>".$client->CLI_UVIEW."</strong></p>";
        
    }?>

    <p>Version Imaging : <strong style='color:<?=$client->colorVersion();?>'><?=$version?></strong></p>
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