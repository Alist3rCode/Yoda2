<?php 
require_once 'class/Version.php';

$versionToDisplay = loadParentVersion();
$parentVersion = array_keys($versionToDisplay);
?>

<ul class="navbar-nav filterUl"  >
    <li class="nav-item  filterParent" onclick="displayFilter('version')">
        <a class="nav-link" href="#"><i class="fas fa-filter"></i><span id="versionFilterSpan"> Version</span></a>
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

    <li class="nav-item filterParent" onclick="displayFilter('activity')">
        <a class="nav-link" href="#"><i class="fas fa-filter"></i><span id="activityFilterSpan"> Activité</span> </a>
    </li>
    <li id="searchActivity_None" class="nav-item filter filterActivity" onclick="searchForActivity('None')">
        <a class="nav-link" href="#">N/A</a>
    </li>
    <li id="searchActivity_Ris" class="nav-item filter filterActivity" onclick="searchForActivity('Ris')">
        <a class="nav-link" href="#">RIS</a>
    </li>
    <li id="searchActivity_Pacs" class="nav-item filter filterActivity" onclick="searchForActivity('Pacs')">
        <a class="nav-link" href="#">PACS</a>
    </li>
    <li id="searchActivity_RisPacs" class="nav-item filter filterActivity" onclick="searchForActivity('RisPacs')">
        <a class="nav-link" href="#">RIS / PACS</a>
    </li>
    <li class="nav-item filterParent" id="advancedFilterLi" data-toggle="modal" data-target="#ModaleFilter">
        <a class="nav-link" href="#"><i class="fas fa-filter" id="iconAdvancedFilter"></i><span id="advancedFilter"> Avancé</span> </a>
    </li>
</ul>
