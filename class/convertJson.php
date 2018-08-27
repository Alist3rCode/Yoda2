<?php 
function convert_json($dat)
{
  if (is_string($dat)) {
     return utf8_encode($dat);
  } elseif (is_array($dat)) {
     $ret = [];
     foreach ($dat as $i => $d) $ret[ $i ] = convert_json($d);

     return $ret;
  } elseif (is_object($dat)) {
     foreach ($dat as $i => $d) $dat->$i = convert_json($d);

     return $dat;
  } else {
     return $dat;
  }
}