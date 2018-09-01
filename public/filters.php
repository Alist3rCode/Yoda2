<?php require 'class/Version.php';

$v8 = loadVersion('v8');
$v7 = loadVersion('v7');
$v6 = loadVersion('v6');


?>

<ul class="navbar-nav filterUl"  >
    <li class="nav-item  filterParent" onclick="displayFilter('version')">
        <a class="nav-link" href="#"><i class="fas fa-filter"></i> Version</a>
    </li>
    
    <?php if (count($v8)!= 0):?>
    
    <li class="nav-item filter filterVersionHead filterv8" onclick="displayFilter('v8')">
        <a class="nav-link" href="#">v8</a>
    </li>
    <?php foreach($v8 as $key=>$value):?>
    
    <li class="nav-item filter filterVersion filterv8">
        <a class="nav-link" href="#"><?=$value?></a>
    </li>
    
    <?php endforeach;
    endif;
    if (count($v7)!= 0):?>
    
    <li class="nav-item filter filterVersionHead filterv7" onclick="displayFilter('v7')">
        <a class="nav-link" href="#">v7</a>
    </li>
    <?php foreach($v7 as $key=>$value):?>
    
    <li class="nav-item filter filterVersion filterv7">
        <a class="nav-link" href="#"><?=$value?></a>
    </li>
    
    <?php endforeach;
    endif;
    if (count($v6)!= 0):?>
    
    <li class="nav-item filter filterVersionHead filterv6" onclick="displayFilter('v6')">
        <a class="nav-link" href="#">v6</a>
    </li>
    <?php endif;
    foreach($v6 as $key=>$value):?>
    
    <li class="nav-item filter filterVersion filterv6">
        <a class="nav-link" href="#"><?=$value?></a>
    </li>
    
    <?php endforeach;?>
    <li class="nav-item filterParent">
        <a class="nav-link" href="#"><i class="fas fa-filter"></i> Activité</a>
    </li>
</ul>
