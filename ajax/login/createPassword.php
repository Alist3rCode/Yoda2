<?php

// print_r($_REQUEST);


$arrayMini = ['a','b','c','d','e','f','g','h','i','j','k','l','m','n','o','p','q','r','s','t','u','v','w','x','y','z'];
$arrayMaj = ['A','B','C','D','E','F','G','H','I','J','K','L','M','N','O','P','Q','R','S','T','U','V','W','X','Y','Z'];
$arrayNbr = ['0','1','2','3','4','5','6','7','8','9'];
$arraySpe = ['~', '!',  '@',  '#', '$', '%', '^', '&', '*', '(', ')', '-', '_', '=', '+', '[', ']', '{', '}', ';' ,':' , ',', '.', '<', '>', '/', '?'];
$arraySimi = ['0' , 'O', 'l', '1', 'I'];

$size = $_REQUEST['nbCarac'];

$array = [];

if($_REQUEST['numbers']  == 'true'){
    $array = array_merge($array, $arrayNbr);
}
if($_REQUEST['mini'] == 'true'){
    $array = array_merge($array, $arrayMini);
}
if($_REQUEST['maj']  == 'true'){
    $array = array_merge($array, $arrayMaj);
}
if($_REQUEST['spec']  == 'true'){
    $array = array_merge($array, $arraySpe);
}

// print_r($array);
$mdp = '';
$temp = '';

for($i = 0; $i < $size; $i++){
    
    
    $temp = array_rand($array, 1);
    // var_dump($array[$temp]);
    if($_REQUEST['simi'] == 'false'){
        while (in_array($array[$temp], $arraySimi)){
            $temp = array_rand($array, 1);
        }
    }
    
    $mdp = $mdp . $array[$temp];
}
if(isset($_REQUEST['mode']) && $_REQUEST['mode'] == 'reset'){
    echo sha1($mdp);
}else{
    echo $mdp;
}
?>