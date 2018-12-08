<?php 
session_start();
require_once "../ajaxDatabaseInit.php";

require_once('../../class/checkRights.php');
$right = checkRights($bdd,$_SESSION['id_user']);
$type = $_REQUEST['type'];
$tags = "";
if($_REQUEST['type'] == "create"){
    $titre = "Création d'un nouveau client";
    $version = "v8";
    $ris = 0;
    $pacs = 0;
    $uid = "";
    
}else if($_REQUEST['type'] == 'modif'){
    $client = $bdd->query('SELECT * FROM '
            . 'YDA_CLIENT '
            . 'WHERE CLI_ID ="'.$_REQUEST['id'].'"', 'Clients');
    $sites = $bdd->queryObj('SELECT * FROM YDA_PHONE '
            . 'INNER JOIN YDA_MAPS ON PHO_ID = MPS_ID_PHO '
            . 'WHERE PHO_ID_CLI = "'.$_REQUEST['id'].'" '
            . 'AND PHO_VALID = 1');
    
    if ($client[0]->CLI_UID == ''){
        $select = $bdd->queryObj('SELECT CLI_NUM_VERSION FROM YDA_CLIENT WHERE CLI_ID ="' . $client[0]->CLI_ID . '"');
        $numVersion = $select[0]->CLI_NUM_VERSION;
    }else{
        $select = $bdd2->queryObj('SELECT * FROM wrk_client where wrk_client.uid = "' . $client[0]->CLI_UID . '"');
        $numVersion = $select[0]->version . '.' . $select[0]->hotfix;
    }
    
    $version = $client[0]->CLI_VERSION;
    $ris = $client[0]->CLI_RIS;
    $pacs = $client[0]->CLI_PACS;
    $uid = $client[0]->CLI_UID;
    
    $titre = "Fiche client : ".$client[0]->CLI_VILLE." - ".$client[0]->CLI_NOM;
    $nbPhone = count($sites);
    
    foreach($client[0]->linearTag as $key=>$value){
    
    $tags .= '<li class="tags"id="petitTag"><span>'. $value .'</span><i class="fa fa-times"></i></i></li>';
    
    }
}






?>
<div class="modal-dialog " role="document" >
    <div class="modal-content" >
        <div class="modal-header mx-auto">
            <h4 class="modal-title text-capitalize" id="myModalLabel"><?=$titre?></h4>
        </div>

        <div class="modal-body row modaleClientBackground">
            <div class="col-4 colInfoClient">
                <div class="col-md-12 ">
                    <div class="vignette <?=$type=='modif'?$client[0]->CLI_VERSION:"v8"?> mx-auto" id="vignetteDemo">   
                        <a href="#">
                            <div class="infoClient">
                                <p class="ville <?=$type=='modif'?$client[0]->CLI_VERSION:"v8"?> text-capitalize" id="villeDemo">
                                    <?=$type=='modif'?$client[0]->CLI_VILLE:""?>
                                </p>
                                <p class="nom text-capitalize" id="nomDemo">
                                    <?=$type=='modif'?$client[0]->CLI_NOM:""?>
                                </p>
                            </div>
                        </a>
                    </div>
                </div>
                <div id='alerte' class="alert alertModale d-none"></div>
                
                <div class="form-control infoClientModale" id="formulaire">
                    <input class="form-control spaceInput col-6" type="text" id="ville" placeholder="Ville..." autocomplete="nope" value="<?=$type=='modif'?$client[0]->CLI_VILLE:""?>">
                    <input class="form-control spaceInput col-6" type="text" id="nom" placeholder="Site Principal..." autocomplete="nope" value="<?=$type=='modif'?$client[0]->CLI_NOM:""?>">
                    <input class="form-control spaceInput col-12" type="text" id="url" placeholder="https://..." autocomplete="nope" value="<?=$type=='modif'?$client[0]->CLI_URL:""?>">

                    <p class="col-12" style="text-align:center;">Saisir des tags séparés par des virgules : </p>
                    <ul class="tags-input col-12" id="tags-input">
                        <?=$tags?>
                        <li class="tags-new">
                            <input class="spaceInput" type="text" id="tag" name="tag" value="Tags..." onfocus="if(this.value==='Tags...')this.value=''"  onblur="if(this.value==='')this.value='Tags...'" autocomplete="nope"> 
                            <input type='hidden' name='tag_hidden' id='tag_hidden'  value=''>
                        </li>
                    </ul>

                    <div class="btn-group spaceInput versionModale" role="group">
                        <button type="button" class="btn btn-outline-warning <?=$version=='v6'?"active":""?>" id="v6Button" onclick="clickModaleVersion('v6')">v6</button>
                        <button type="button" class="btn btn-outline-primary <?=$version=='v7'?"active":""?>" id="v7Button" onclick="clickModaleVersion('v7')">v7</button>
                        <button type="button" class="btn btn-outline-dark <?=$version=='v8'?"active":""?>" id="v8Button" onclick="clickModaleVersion('v8')">v8</button>
                    </div>

                    <div class="btn-group spaceInput activityModale" role="group" aria-label="Basic example">
                        <button type="button" class="btn btn-outline-secondary <?=$ris==1?"active":""?>" id="risButton" onclick="clickModaleActivity('ris')">RIS</button>
                        <button type="button" class="btn btn-outline-secondary <?=$pacs==1?"active":""?>" id="pacsButton" onclick="clickModaleActivity('pacs')">PACS</button>
                    </div>                       

                    <input type="text" class="form-control spaceInput col-12" id="viewVersion" placeholder="Version View" value="<?=$type=='modif'?$client[0]->CLI_VIEW:""?>">
                    <input type="text" class="form-control spaceInput col-12" id="uViewVersion" placeholder="Version uView" value="<?=$type=='modif'?$client[0]->CLI_UVIEW:""?>">
                    <input type="text" class="form-control spaceInput col-12" id="imagingVersion" placeholder="Version Imaging" <?=$uid==""?"":"disabled"?> value="<?=$type=='modif'?$numVersion:""?>">

                </div>
                <div>
                    <?php if(in_array("rgt_cod_modif_client", $right)):?>
                    
                    <button class="btn btn-danger btnModale <?=$type=="modif"?"":"d-none"?>" id ='buttonDelete' onclick="deleteCustomer()">Supprimer</button>
                    <button class="btn btn-primary btnModale <?=$type=="modif"?"":"d-none"?>" id ='buttonModif' onclick="modifCustomer()">Modifier</button>
                    <button class="btn btn-primary btnModale <?=$type=="create"?"":"d-none"?>" id ='buttonSubmit' onclick="createCustomer()">Valider</button>
                    <?php endif;?>
                    
                    <div id='id' class="d-none"><?=$_REQUEST['id']!=0?$_REQUEST['id']:""?></div>

                </div>
            </div>

            <div class="col-8 form-control colPhoneModale">
                <div id ="phones" class="col-12 phoneModale">
                    <?php 
                    if($type == "modif"){
                        foreach($sites as $key => $value):?>
                        
                    <div id="divPhone<?=$key?>" class="col-12 row divPhoneModale">
                        <div class="btn-group special col-12 phoneModale" role="group" >
                            <button type="button" class="btn btn-outline-success form-group col-1 newPhone" <?=$nbPhone==$key+1?"":"disabled"?> id="newPhone<?=$key?>" onclick="newPhone(<?=$key?>)">
                                <i class="fa fa-plus"></i>
                            </button>
                            <input class="form-group <?=$nbPhone>1?"col-5":"col-5 d-none"?> siteClass" type="text" id="site<?=$key?>" placeholder="Site..." autocomplete="nope" value="<?=$value->PHO_SITE?>">
                            <input class="form-group <?=$nbPhone>1?"col-5":"col-10"?> phoneClass" type="text" id="phone<?=$key?>" placeholder="Téléphone..." autocomplete="nope" value="<?=$value->PHO_PHONE?>">
                            <button type="button" class="btn btn-outline-secondary form-group col-1 deletePhone"  id="deletePhone<?=$key?>" <?=$nbPhone>1?"disabled":""?> onclick="deletePhone(<?=$key?>)">
                                <i class="far fa-trash-alt"></i>
                            </button>
                        </div>
                        <div class="btn-group special col-md-6 groupModale"  role="group">
                            <button class="btn btn-outline-primary form-group disabled btn44"  disabled type="button" style="height:38px;">
                                <i class="fas fa-map"></i>
                            </button>
                            <input class="form-control col-md-10 latClass formCustom" type="text" id="lat<?=$key?>" placeholder="Latitude..." autocomplete="nope" value="<?=$value->MPS_LAT?>">
                        </div>
                        <div class="btn-group special col-md-6 groupModale" role="group">
                            <button class="btn btn-outline-primary form-group disabled btn44" disabled type="button" style="height:38px;">
                                <i class="far fa-map"></i>
                            </button>       
                            <input class="form-control col-md-10 lonClass formCustom" type="text" id="lon<?=$key?>" placeholder="Longitude..." autocomplete="nope" value="<?=$value->MPS_LON?>">
                        </div>
                        <div class="btn-group special col-md-6 groupModale" role="group">
                            <button class="btn btn-outline-primary form-group disabled btn44" disabled  type="button" style="height:38px;">
                                <i class="far fa-envelope"></i>
                            </button>     
                            <input class="form-control col-md-10 mailClass formCustom" type="text" id="mail<?=$key?>" placeholder="eMail..." autocomplete="nope" value="<?=$value->PHO_MAIL?>">
                        </div>
                        <div class="btn-group special col-md-6 groupModale" role="group">
                            <button class="btn btn-outline-primary form-group disabled btn44"  disabled type="button" style="height:38px;">
                                <i class="fas fa-external-link-alt"></i>
                            </button>
                            <input type="text" class="form-control col-10 TXClass formCustom" id="TX<?=$key?>"  placeholder="Adresse TX..." autocomplete="nope" value="<?=$value->PHO_TX?>">
                        </div>
                        <div class="btn-group special col-md-6 groupModale" role="group">
                            <button class="btn btn-outline-primary form-group disabled btn44" disabled  type="button" style="height:38px;">
                                <i class="far fa-id-card"></i>
                            </button>     
                            <input class="form-control col-md-10 idTVClass formCustom " type="text" id="idTV<?=$key?>" placeholder="ID Teamviewer..." autocomplete="nope" value="<?=$value->PHO_TV_ID?>">
                        </div>
                        <div class="btn-group special col-md-6 groupModale" role="group">
                            <button class="btn btn-outline-primary form-group disabled btn44"  disabled type="button" style="height:38px;">
                                <i class="fas fa-unlock"></i>
                            </button>
                            <input type="text" class="form-control col-10 passwordTVClass formCustom" id="passTV<?=$key?>"  placeholder="Mot de Passe..." autocomplete="nope"  value="<?=$value->PHO_TV_PASSWORD?>">
                        </div>
                    </div>
                    <!--<hr>-->
                    <input type="hidden" value ="1" id="delete<?=$key?>">
                    <input type="hidden" value ="" id="id<?=$key?>">
                    
                        <?php endforeach;
                    }else if ($type == "create"):?>
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
                    <?php endif;
                    ?>
                </div>
                <input type='hidden' value ='1' id='nbPhone'>
            </div>
        </div>
    </div>
</div>
<!-- /.modal -->

<script src="./public/js/tags.js"></script>
<script src="./public/js/yoda_style.js"></script>
<script src="./public/js/yoda_action.js"></script>
