<?php 
require_once 'class/Version.php';

$versionToDisplay = loadParentVersion();
$parentVersion = array_keys($versionToDisplay);
?>


<div class="modal-dialog" role="document">
    <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Filtres Avancés  <small class="text-muted">- Cliquer sur une version à droite ou une activité pour les faire basculer à droite.</small></h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <div class="modal-body d-flex flex-row">
            <div class="col-4" style="border-right: solid 1px darkgrey;">
                <div style="border-bottom: solid 1px darkgrey; margin-bottom:10px;">
                <?php foreach ($parentVersion as $parentKey=>$parentValue):
                    $bootstrapColor = bootstrapColorVersion($parentValue);
                    
                    ?>
                    <div class="col-md-12" style="margin-bottom:5px;">
                    
                
                        <i class="far fa-folder folderCollapseFilters collapsed" data-toggle="collapse" href="#<?=$parentValue?>Collapse" role="button"></i>
                        <button type="button" class="btn btn-outline-<?=$bootstrapColor?> btn-sm" id="advancedVersionFilterButton<?=$parentValue?>" onclick="AdvancedFiltersParent('<?=$parentValue?>')">
                            <?=$parentValue?>
                        </button>
                        <br>
                        <div class="collapse" id="<?=$parentValue?>Collapse">
                            <?php foreach ($versionToDisplay[$parentValue] as $key=>$value):?>
                                <a href="#" class="btn btn-outline-<?=$bootstrapColor?> btn-sm spacingFilters" id="advancedVersionFilter<?=$value?>" onclick="AdvancedFilters('<?=$bootstrapColor?>','<?=$value?>','<?=$parentValue?>')" data-color="<?=$bootstrapColor?>" data-version="<?=$value?>">
                                    <?=$value?>
                                </a>
                            <?php endforeach; ?>
                        </div> 
                    </div>
                <?php endforeach;?>
               
                
                </div>
            
                <div style="border-bottom: solid 1px darkgrey; padding-bottom:10px;">
                    <button type="button" class="btn btn-outline-light btn-sm" id="advancedActivityFilterButtonNONE"  onclick="AdvancedFiltersActivity('NONE','light')" style="color:black">
                        NONE
                    </button>
                    <button type="button" class="btn btn-outline-danger btn-sm" id="advancedActivityFilterButtonRIS"  onclick="AdvancedFiltersActivity('RIS','danger')">
                        RIS
                    </button>
                    <button type="button" class="btn btn-outline-success btn-sm" id="advancedActivityFilterButtonPACS" onclick="AdvancedFiltersActivity('PACS','success')">
                        PACS
                    </button>
                    <button type="button" class="btn btn-outline-info btn-sm" id="advancedActivityFilterButtonRIS-PACS"  onclick="AdvancedFiltersActivity('RIS-PACS','info')">
                        RIS-PACS
                    </button>
                </div>    
            </div>
            <div class="col-8" >
                <div class="text-center ">
                    <h3>Afficher les versions </h3>
                        <div id="advancedVersionFilters"></div>
                    
                        
                </div>
                <div class="text-center" style="border-bottom: solid 1px darkgrey;border-top: solid 1px darkgrey;padding-top:5px; padding-bottom:5px;">
                    <button type="button" class="btn btn-secondary btn" id='switchFiltersAND' onclick="switchFilters('AND')">
                        ET
                    </button>
                    <button type="button" class="btn btn-secondary btn d-none" id='switchFiltersOR' onclick="switchFilters('OR')">
                        OU
                    </button>
                </div>
                <div class="text-center">
                    <h3>Les clients ayant une activité </h3>
                        <div id="advancedActivityFilters"></div>
                        
                </div>
                
            </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Fermer</button>
          <button type="button" class="btn btn-warning" data-dismiss="modal">Réinitialiser</button>
          <button type="button" class="btn btn-success">Filtrer</button>
        </div>
    </div>
</div>
