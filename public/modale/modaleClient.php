<?php 

require_once('./class/checkRights.php');
$right = checkRights($bdd,$_SESSION['id_user']);

?>

<div class="modal-dialog " role="document" >
    <div class="modal-content" >
        <div class="modal-header mx-auto">
            <h4 class="modal-title" id="myModalLabel">Création d'un nouveau client</h4>
        </div>

        <div class="modal-body row modaleClientBackground">
            <div class="col-4 colInfoClient">
                <div class="col-md-12 ">
                    <div class="vignette v8 mx-auto" id="vignetteDemo">   
                        <a href="#">
                            <div class="infoClient">
                                <p class="ville v8 text-capitalize" id="villeDemo"></p>
                                <p class="nom text-capitalize" id="nomDemo"></p>
                            </div>
                        </a>
                    </div>
                </div>
                <hr>
                
                <div class="form-control infoClientModale" id="formulaire">
                    <input class="form-control spaceInput col-6" type="text" id="ville" placeholder="Ville..." autocomplete="nope">
                    <input class="form-control spaceInput col-6" type="text" id="nom" placeholder="Site Principal..." autocomplete="nope" >
                    <input class="form-control spaceInput col-12" type="text" id="url" placeholder="https://..." autocomplete="nope">

                    <p class="col-12" style="text-align:center;">Saisir des tags séparés par des virgules :</p>
                    <ul class="tags-input col-12" id="tags-input">
                        <li class="tags-new">
                            <input class="spaceInput" type="text" id="tag" name="tag" value="Tags..." onfocus="if(this.value==='Tags...')this.value=''"  onblur="if(this.value==='')this.value='Tags...'" autocomplete="nope"> 
                            <input type='hidden' name='tag_hidden' id='tag_hidden'  value=''>
                        </li>
                    </ul>

                    <div class="btn-group spaceInput versionModale" role="group" aria-label="Basic example">
                        <button type="button" class="btn btn-outline-warning" id="v6Button" onclick="clickModaleVersion('v6')">v6</button>
                        <button type="button" class="btn btn-outline-primary " id="v7Button" onclick="clickModaleVersion('v7')">v7</button>
                        <button type="button" class="btn btn-outline-dark active" id="v8Button" onclick="clickModaleVersion('v8')">v8</button>
                    </div>

                    <div class="btn-group spaceInput activityModale" role="group" aria-label="Basic example">
                        <button type="button" class="btn btn-outline-secondary" id="risButton" onclick="clickModaleActivity('ris')">RIS</button>
                        <button type="button" class="btn btn-outline-secondary" id="pacsButton" onclick="clickModaleActivity('pacs')">PACS</button>
                    </div>                       

                    <input type="text" class="form-control spaceInput col-12" id="viewVersion" placeholder="Version View">
                    <input type="text" class="form-control spaceInput col-12" id="uViewVersion" placeholder="Version uView">
                    <input type="text" class="form-control spaceInput col-12" id="imagingVersion" placeholder="Version Imaging">

                </div>
                <div>
                    <?php if(in_array("rgt_cod_modif_client", $right)):?>
                    
                    <button class="btn btn-danger d-none btnModale" id ='buttonDelete' onclick="deleteCustomer()">Supprimer</button>
                    <button class="btn btn-primary d-none btnModale" id ='buttonModif' onclick="modifCustomer()">Modifier</button>
                    <button class="btn btn-primary btnModale" id ='buttonSubmit' onclick="createCustomer()">Valider</button>
                    <?php endif;?>
                    <div id='alerte' class="alert  alertModale d-none"></div>
                    <div id='id' class="d-none"></div>

                </div>
            </div>

            <div class="col-8 form-control colPhoneModale">
                <div id ="phones" class="col-12 phoneModale">
                    <div id="divPhone0" class="col-12 row divPhoneModale">
                        <div class="btn-group special col-12 phoneModale" role="group" >
                            <button type="button" class="btn btn-outline-success form-group col-1 newPhone"  id="newPhone0" onclick="newPhone(0)">
                                <i class="fa fa-plus"></i>
                            </button>
                            <input class="form-group col-5 d-none siteClass" type="text" id="site0" placeholder="Site..." autocomplete="nope">
                            <input class="form-group col-10 phoneClass" type="text" id="phone0" placeholder="Téléphone..." autocomplete="nope">
                            <button type="button" class="btn btn-outline-secondary form-group col-1 deletePhone"  id="deletePhone0" disabled onclick="deletePhone(0)">
                                <i class="far fa-trash-alt"></i>
                            </button>
                        </div>
                        <div class="btn-group special col-md-6 groupModale"  role="group">
                            <button class="btn btn-outline-primary form-group disabled btn44"  disabled type="button" style="height:38px;">
                                <i class="fas fa-map"></i>
                            </button>
                            <input class="form-control col-md-10 latClass formCustom" type="text" id="lat0" placeholder="Latitude..." autocomplete="nope">
                        </div>
                        <div class="btn-group special col-md-6 groupModale" role="group">
                            <button class="btn btn-outline-primary form-group disabled btn44" disabled type="button" style="height:38px;">
                                <i class="far fa-map"></i>
                            </button>       
                            <input class="form-control col-md-10 lonClass formCustom" type="text" id="lon0" placeholder="Longitude..." autocomplete="nope">
                        </div>
                        <div class="btn-group special col-md-6 groupModale" role="group">
                            <button class="btn btn-outline-primary form-group disabled btn44" disabled  type="button" style="height:38px;">
                                <i class="far fa-envelope"></i>
                            </button>     
                            <input class="form-control col-md-10 mailClass formCustom" type="text" id="mail0" placeholder="eMail..." autocomplete="nope">
                        </div>
                        <div class="btn-group special col-md-6 groupModale" role="group">
                            <button class="btn btn-outline-primary form-group disabled btn44"  disabled type="button" style="height:38px;">
                                <i class="fas fa-external-link-alt"></i>
                            </button>
                            <input type="text" class="form-control col-10 TXClass formCustom" id="TX0"  placeholder="Adresse TX..." autocomplete="nope">
                        </div>
                        <div class="btn-group special col-md-6 groupModale" role="group">
                            <button class="btn btn-outline-primary form-group disabled btn44" disabled  type="button" style="height:38px;">
                                <i class="far fa-id-card"></i>
                            </button>     
                            <input class="form-control col-md-10 idTVClass formCustom " type="text" id="idTV0" placeholder="ID Teamviewer..." autocomplete="nope">
                        </div>
                        <div class="btn-group special col-md-6 groupModale" role="group">
                            <button class="btn btn-outline-primary form-group disabled btn44"  disabled type="button" style="height:38px;">
                                <i class="fas fa-unlock"></i>
                            </button>
                            <input type="text" class="form-control col-10 passwordTVClass formCustom" id="passTV0"  placeholder="Mot de Passe..." autocomplete="nope" >
                        </div>
                    </div>
                    <!--<hr>-->
                    <input type="hidden" value ="1" id="delete0">
                    <input type="hidden" value ="" id="id0">
                </div>
                <input type='hidden' value ='1' id='nbPhone'>
            </div>
        </div>
    </div>
</div>
<!-- /.modal -->

<script src="./public/js/tags.js"></script>
