<?php
 
class Clients{
    
    public $formatedTag = '';
    public $colorVersion = '';
    /**
     * 
     * @return string 
     * Retourne les tags formatés avec un diese devant si il y a un tag ou plus sur le client.
     */
    public function formatedTag(){
                       
        if ($this->CLI_TAG != ''){

            $tags = explode(',',$this->CLI_TAG);
            $lenght = (count($tags)<5)?count($tags):5;
           
                for($i=0;$i<$lenght;$i++){
                    $this->formatedTag .= '#' . $tags[$i] . ' ';
                }
            }
            
        return $this->formatedTag;
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
}