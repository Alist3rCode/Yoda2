<?php

$str = file_get_contents('./miserables.txt');

?>

<div id="str" style="display:none;"><?=$str?></div>

<script>
   
var str = document.getElementById('str').innerHTML;

var arrayStr = str.split(' ');

var array = ['2','3','3','4','5','6','7','7','8','9','10','11','9','10','9','12','9','5','4','13','14','15','16','12','3','9','8','2','17','12','18','10'];

function fibo(n) 
{
    if (n < 2) return n
    return fibo(n-2) + fibo(n-1)
}

for(var i = 1; i < array.length ; i++)
{
//   document.write(i + " => " + array[i] + "<br>");
   document.write(' '+ arrayStr[fibo(array[i])]);
}


</script>


