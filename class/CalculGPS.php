<?php
function DECtoDMS_LAT($dec)
{

// Converts decimal longitude / latitude to DMS
// ( Degrees / minutes / seconds ) 

// This is the piece of code which may appear to 
// be inefficient, but to avoid issues with floating
// point math we extract the integer part and the float
// part by using a string function.

    $vars = explode(".",$dec);
    $deg = $vars[0];
    if (substr($deg, 0,1) == '-'){
        $letter = 'S';
        $deg = substr($deg, 1);
    }else{
        $letter = 'N';
    }
    
    $tempma = "0.".$vars[1];

    $tempma = $tempma * 3600;
    $min = floor($tempma / 60);
    $sec = $tempma - ($min*60);

    return $result = $deg . '°' . $min . '\'' . $sec.$letter;
   
    // return array("deg"=>$deg,"min"=>$min,"sec"=>$sec);
}   

function DECtoDMS_LON($dec)
{

// Converts decimal longitude / latitude to DMS
// ( Degrees / minutes / seconds ) 

// This is the piece of code which may appear to 
// be inefficient, but to avoid issues with floating
// point math we extract the integer part and the float
// part by using a string function.

    $vars = explode(".",$dec);
    $deg = $vars[0];
    if (substr($deg, 0,1) == '-'){
        $letter = 'W';
        $deg = substr($deg, 1);
    }else{
        $letter = 'E';
        
    }
    $tempma = "0.".$vars[1];

    $tempma = $tempma * 3600;
    $min = floor($tempma / 60);
    $sec = $tempma - ($min*60);

    return $result = $deg . '°' . $min . '\'' . $sec.$letter;
   
    // return array("deg"=>$deg,"min"=>$min,"sec"=>$sec);
}   