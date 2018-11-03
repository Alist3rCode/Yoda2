<?PHP
        
        $mdpToEncode = $_REQUEST['mdp'];
        $array= [];
        $sha1 = sha1($mdpToEncode);
        array_push($array, $sha1); 
        $md5 = md5($mdpToEncode);
        array_push($array, $md5); 
        
        
         echo json_encode($array);
       
?>