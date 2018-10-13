<?php

function checkPasswordStrenght($password){
    $errorPassword =[];
    if (strlen($password) < 11){
        
        array_push($errorPassword, "Le mot de passe doit contenir 11 caractères minimum");
    }
    if (!preg_match('/[A-Z]/', $password)){
        
        array_push($errorPassword, "Le mot de passe doit contenir au moins une lettre majuscule");
    }
    if (!preg_match('/[a-z]/', $password)){
        
        array_push($errorPassword, "Le mot de passe doit contenir au moins une lettre minuscule");
    }
    if (!preg_match('/[0-9]/', $password)){
        
        array_push($errorPassword, "Le mot de passe doit contenir au moins un chiffre");
    }
    if (!preg_match('/[\'^£$%&*()}{@#~!?><>,.;|=_+¬-]/', $password)){
        
        array_push($errorPassword, "Le mot de passe doit contenir au moins un caractère spécial");
    }
    
    return $errorPassword;
}