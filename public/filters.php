<?php 
require 'class/Version.php';

$v8 = loadVersion('v8');
$v7 = loadVersion('v7');
$v6 = loadVersion('v6');

$versionToDisplay = loadParentVersion();
$parentVersion = array_keys($versionToDisplay);

?>

<ul class="navbar-nav filterUl"  >
    <li class="nav-item  filterParent" onclick="displayFilter('version')">
        <a class="nav-link" href="#"><i class="fas fa-filter"></i> Version</a>
    </li>
    <?php 
    foreach ($parentVersion as $parentKey=>$parentValue):
        if (count($versionToDisplay[$parentValue])!= 0):?>
    
        <li class="nav-item filter filterVersionHead filter<?=$parentValue?>" onclick="displayFilter('<?=$parentValue?>')">
            <a class="nav-link" href="#"><?=$parentValue?></a>
        </li>
        <?php foreach ($versionToDisplay[$parentValue] as $key=>$value):?>
            <li id="searchVersion_<?=$value?>" class="nav-item filter filterVersion filter<?=$parentValue?>" onclick="searchForVersion('<?=$parentValue?>','<?=$value?>')">
                <a class="nav-link" href="#"><?=$value?></a>
            </li>
        <?php endforeach;
        endif;
        

    endforeach;
    
    ?>

    <li class="nav-item filterParent">
        <a class="nav-link" href="#"><i class="fas fa-filter"></i> Activité</a>
    </li>
</ul>
