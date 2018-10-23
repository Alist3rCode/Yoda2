<?php

require_once('./class/checkRights.php');
$right = checkRights($bdd,$_SESSION['id_user']);

$select = $bdd->queryObj('SELECT * FROM INT_SECTION WHERE SEC_VALID = 1');
$dropdown = '';
foreach($select as $key=>$value){
    $dropdown .= '<option value="'.$value->SEC_ID.'">'.$value->SEC_NAME.'</option>';
}



?>

<div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Création d'un lien interne</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
            <div class="col-md-12 row">
                <div class="input-group mb-3 col-md-6">
                    <div class="input-group-prepend">
                        <button class="btn btn-outline-success" id="createSectionButton" type="button" >
                            <i class="far fa-plus-square"></i>
                        </button>
                    </div>
                    <select class="custom-select" id="selectSection" >
                        <option selected>Section...</option>
                        <?= $dropdown?>

                    </select>
                    <div class="input-group-append">
                        <button class="btn btn-outline-secondary" id="editSectionButton" type="button" >
                            <i class="far fa-edit"></i>
                        </button>
                    </div>
                </div>
                
                
                <div class="col-md-6">
                    <input type="text" class="loginInput" id='internalLinkName' placeholder="Nom du lien">
                </div>
            </div>
            <div class="col-md-12 row">
                
                <div class="collapse col-md-6" id="createSection">
                    <div class="input-group mb-3 ">
                        <div class="input-group-prepend">
                            <button class="btn btn-outline-success" type="button" id="validNewSection">
                                <i class="fas fa-check"></i>
                            </button>
                        </div>
                        <input type="text" class="form-control loginInput" id='internalCreateSectionName' placeholder="Nom de la section">
                        
                    </div>
                </div>
                <div class="collapse col-md-6" id="editSection">
                    <div class="input-group mb-3 ">
                        <div class="input-group-prepend">
                            <button class="btn btn-outline-success" type="button" id="validModifSection">
                                <i class="fas fa-check"></i>
                            </button>
                        </div>
                        <input type="text" class="form-control loginInput" id='internalEditSectionName' placeholder="Nom de la section">
                        <div class="input-group-append">
                            <button class="btn btn-outline-danger" type="button" id='deleteSection'>
                                <i class="far fa-trash-alt"></i>
                            </button>
                        </div>
                    </div>
                </div>
                
            </div>
            <div class="col-md-12 row">
                <div class="col-md-6">
                    <div class="custom-file">
                          <input type="file" class="custom-file-input" id="internalLinkImage"  accept="image/*">
                          <label class="custom-file-label" for="inputGroupFile01">Image du lien</label>
                    </div>
                    <img class="d-none" id="previewLink" src="#" alt="your image" />
                </div>

                <div class="col-md-6">
                    <input type="text" class="loginInput" id='internalLinkURL' placeholder="URL du lien">
                </div>

            </div>
            <div class="alert col-md-12 d-none" id="alertModaleInternalLink"> </div>
          
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Annuler</button>
        <button type="button" class="btn btn-primary">Valider</button>
      </div>
    </div>
  </div>