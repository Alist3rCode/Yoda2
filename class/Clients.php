<?php
 
class Clients{
    
    public $formatedTag = '';
    public $colorVersion = '';
    public $linearTag = [];
   
    
    public function __construct(){
        $this->linearTag = self::linearTag();
        $this->colorVersion = self::colorVersion();
        $this->formatedTag = self::formatedTag();

    }
    
    /**
     * 
     * @return string 
     * Retourne les tags formatés avec un diese devant si il y a un tag ou plus sur le client.
     */
    public function formatedTag(){
                       
        if ($this->CLI_TAG != ''){

            $tags = explode(',',$this->CLI_TAG);
            $length = (count($tags)<5)?count($tags):5;
           
                for($i=0;$i<$length;$i++){
                    $this->formatedTag .= '#' . $tags[$i] . ' ';
                }
            }
            
        return $this->formatedTag;
    }
    
    /**
     * 
     * @return string
     * Retour les tags en array
     */
    public function linearTag(){
        if ($this->CLI_TAG != ''){

            $this->linearTag = explode(',',$this->CLI_TAG);
        }
                        
        return $this->linearTag;
    }
    
    public function colorVersion(){
        if($this->CLI_VERSION == 'v7'){
            $colorVersion = '#87cdf1';
        }
        if($this->CLI_VERSION == 'v6'){
            $colorVersion = '#f6e18b';
        }
        if($this->CLI_VERSION == 'v8'){
            $colorVersion = '#cacaca';
        }
        return $colorVersion;
    }
    
    public function urlProd(){
        if ($this->CLI_VERSION == 'v6'){
            $urlProd = $this->CLI_URL . 'home.php';
        }else{
            $urlProd = $this->CLI_URL . 'main.php';
        }
        
        return $urlProd;
    }
    
    
   
}