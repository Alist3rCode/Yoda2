<?php
 
class Clients{
    
    public $formatedTag = '';
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
    
    
}