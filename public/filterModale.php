<?php 
require_once 'class/Version.php';

$versionToDisplay = loadParentVersion();
$parentVersion = array_keys($versionToDisplay);
?>


<div class="modal-dialog" role="document">
    <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Filtres Avancés</h5>
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
                        <button type="button" class="btn btn-<?=$bootstrapColor?> btn-sm" onclick="AdvancedFiltersVersion('<?=$parentValue?>')">
                            <?=$parentValue?>
                        </button>
                        <br>
                        <div class="collapse" id="<?=$parentValue?>Collapse">
                            <?php foreach ($versionToDisplay[$parentValue] as $key=>$value):?>
                                <a href="#" class="badge badge-<?=$bootstrapColor?>" onclick="AdvancedFiltersVersion('<?=$value?>')">
                                    <?=$value?>
                                </a>
                            <?php endforeach; ?>
                        </div> 
                    </div>
                <?php endforeach;?>
               
                
                </div>
            
                <div style="border-bottom: solid 1px darkgrey; padding-bottom:10px;">
                    <button type="button" class="btn btn-light btn-sm" onclick="AdvancedFiltersVersion('none')">
                        N/A
                    </button>
                    <button type="button" class="btn btn-danger btn-sm" onclick="AdvancedFiltersVersion('ris')">
                        RIS
                    </button>
                    <button type="button" class="btn btn-success btn-sm" onclick="AdvancedFiltersVersion('pacs')">
                        PACS
                    </button>
                    <button type="button" class="btn btn-info btn-sm" onclick="AdvancedFiltersVersion('ris-pacs')">
                        RIS / PACS
                    </button>
                </div>    
            </div>
            <div class="col-8" >
                <p>Afficher les versions </p>
                <div id="advancedVersionFilters"></div>
                <button type="button" class="btn btn-secondary btn-sm" >
                    ET
                </button>
                <p>Les clients ayant une activité</p>
                <div id="advancedActivityFilters"></div>
            </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Fermer</button>
          <button type="button" class="btn btn-warning" data-dismiss="modal">Réinitialiser</button>
          <button type="button" class="btn btn-success">Filtrer</button>
        </div>
    </div>
</div>
