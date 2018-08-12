<?php 

class Database{

    private $db_name;
    private $db_user;
    private $db_pass;
    private $db_host;
    private $pdo;
    
    public function __construct($db_name, $db_user = 'root', $db_pass = '', $db_host = 'localhost')
    {
        $this->db_name = $db_name;
        $this->db_user = $db_user;
        $this->db_pass = $db_pass;
        $this->db_host = $db_host;
    }

    private function getPDO(){  
        if ($this->pdo == null){
            $pdo = new PDO('mysql:dbname=yoda;host=localhost','root');
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $this->pdo = $pdo;
        }          
        
        return $this->pdo;
    }
    
    public function query($statement, $className){
        $res = $this->getPDO()->query($statement);
        $datas = $res->fetchAll(PDO::FETCH_CLASS, $className);
        return $datas;
        
    }
    
    
    public function prepare($statement, $attributes, $className, $one = false){
        $req = $this->getPDO()->prepare($statement);
        $req->execute($attributes);
        $req->setFetchMode(PDO::FETCH_CLASS, $className);
        if ($one){
            $data = $req->fetch();
        }else{
            $data = $req->fetchAll();
        }
        return $datas;
        
    }
}
