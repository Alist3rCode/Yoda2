<?php

class Autoloader{
    
    static function autoload($class_name){
        require 'C:\wamp64\www\Yoda2\class\\' . $class_name . '.php';
    }

    static function register(){
        spl_autoload_register(array(__CLASS__,'autoload'));

    }

}
