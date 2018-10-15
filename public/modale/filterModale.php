<?php 
require_once 'class/Version.php';

$versionToDisplay = loadParentVersion();
$parentVersion = array_keys($versionToDisplay);
?>


<div class="modal-dialog" role="document">
    <div class="modal-content">
        <div class="modal-header ">
            <h5 class="modal-title " id="exampleModalLabel">Filtres Avancés  <small class="text-muted "> - Cliquer sur une version à gauche ou une activité pour les faire basculer à droite. <br>L'opérateur entre les éléments à droite est un "OU"</small></h5>
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
                        <button type="button" class="btn btn-outline-<?=$bootstrapColor?> btn-sm filtersBtn" id="advancedVersionFilterButton<?=$parentValue?>" onclick="AdvancedFiltersParent('<?=$parentValue?>')">
                            <?=$parentValue?>
                        </button>
                        <br>
                        <div class="collapse" id="<?=$parentValue?>Collapse">
                            <?php foreach ($versionToDisplay[$parentValue] as $key=>$value):?>
                                <a href="#" class="btn btn-outline-<?=$bootstrapColor?> btn-sm spacingFilters filtersBtn" id="advancedVersionFilter<?=$value?>" onclick="AdvancedFilters('<?=$bootstrapColor?>','<?=$value?>','<?=$parentValue?>')" data-color="<?=$bootstrapColor?>" data-version="<?=$value?>">
                                    <?=$value?>
                                </a>
                            <?php endforeach; ?>
                        </div> 
                    </div>
                <?php endforeach;?>
               
                
                </div>
            
                <div style="border-bottom: solid 1px darkgrey; padding-bottom:10px;">
                    <button type="button" class="btn btn-outline-dark btn-sm filtersBtn" id="advancedActivityFilterButtonNONE"  onclick="AdvancedFiltersActivity('NONE','dark')" >
                        NONE
                    </button>
                    <button type="button" class="btn btn-outline-danger btn-sm filtersBtn" id="advancedActivityFilterButtonRIS"  onclick="AdvancedFiltersActivity('RIS','danger')">
                        RIS
                    </button>
                    <button type="button" class="btn btn-outline-success btn-sm filtersBtn" id="advancedActivityFilterButtonPACS" onclick="AdvancedFiltersActivity('PACS','success')">
                        PACS
                    </button>
                    <button type="button" class="btn btn-outline-info btn-sm filtersBtn" id="advancedActivityFilterButtonRIS-PACS"  onclick="AdvancedFiltersActivity('RIS-PACS','info')">
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
                    <div class="btn-group" role="group" >
                        <button type="button" class="btn btn-outline-dark btn active" id='switchFiltersAND' onclick="switchFilters('AND')">
                            ET
                        </button>
                        <button type="button" class="btn btn-outline-dark btn" id='switchFiltersOR' onclick="switchFilters('OR')">
                            OU
                        </button>

                    </div>
                    
                </div>
                
                
                <div class="text-center">
                    <h3>Les clients ayant une activité </h3>
                        <div id="advancedActivityFilters"></div>
                        
                </div>
                
            </div>
        </div>
        <div class="alert d-none text-center" id="alerteFilter">
            
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Fermer</button>
          <button type="button" class="btn btn-warning" id="resetFilterModale" onclick="resetFilterModale()">Réinitialiser</button>
          <button type="button" class="btn btn-success" id="validFilterModale">Filtrer</button>
        </div>
    </div>
</div>
