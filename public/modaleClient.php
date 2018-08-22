<div class="modal-dialog" role="document">
    <div class="modal-content" >
        <div class="modal-header mx-auto">
            <h4 class="modal-title" id="myModalLabel">Création d'un nouveau client</h4>
        </div>

        <div class="modal-body row">
            <div class="col-4 colInfoClient">
                <div class="form-control infoClientModale" id="formulaire">
                    <input class="form-control spaceInput col-6" type="text" id="ville" placeholder="Ville..." autocomplete="off">
                    <input class="form-control spaceInput col-6" type="text" id="nom" placeholder="Site Principal..." autocomplete="off" >
                    <input class="form-control spaceInput col-12" type="text" id="url" placeholder="https://..." autocomplete="off">

                    <p class="col-12" style="text-align:center;">Saisir des tags séparés par des virgules : </p>
                    <ul class="tags-input col-12" id="tags-input">
                        <li class="tags-new">
                            <input class="spaceInput" type="text" id="tag" name="tag" value="Tags..." onfocus="if(this.value==='Tags...')this.value=''"  onblur="if(this.value==='')this.value='Tags...'" autocomplete="off"> 
                            <input type='hidden' name='tag_hidden' id='tag_hidden'  value=''>
                        </li>
                    </ul>

                    <div class="btn-group spaceInput versionModale" role="group" aria-label="Basic example">
                        <button type="button" class="btn btn-outline-warning" id="v6Button" onclick="clickModaleVersion('v6')">v6</button>
                        <button type="button" class="btn btn-outline-primary active" id="v7Button" onclick="clickModaleVersion('v7')">v7</button>
                        <button type="button" class="btn btn-outline-dark" id="v8Button" onclick="clickModaleVersion('v8')">v8</button>
                    </div>

                    <div class="btn-group spaceInput activityModale" role="group" aria-label="Basic example">
                        <button type="button" class="btn btn-outline-secondary" id="risButton" onclick="clickModaleActivity('ris')">RIS</button>
                        <button type="button" class="btn btn-outline-secondary" id="pacsButton" onclick="clickModaleActivity('pacs')">PACS</button>
                    </div>                       

                    <input type="text" class="form-control spaceInput col-12" id="viewVersion" placeholder="Version View">
                    <input type="text" class="form-control spaceInput col-12" id="uViewVersion" placeholder="Version uView">
                    <input type="text" class="form-control spaceInput col-12" id="imagingVersion" placeholder="Version Imaging">

                </div>
                <div >
                    <button class="btn btn-danger d-none btnModale" id ='buttonDelete'>Supprimer</button>
                    <button class="btn btn-primary d-none btnModale" id ='buttonModif'>Modifier</button>
                    <button class="btn btn-primary btnModale" id ='buttonSubmit'>Valider</button>
                    <div id='alerte' class="alert alert-danger alertModale"></div>
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
                            <input class="form-group col-5 d-none siteClass" type="text" id="site0" placeholder="Site..." autocomplete="off">
                            <input class="form-group col-10 phoneClass" type="text" name="phone0" id="phone0" placeholder="Téléphone..." autocomplete="off">
                            <button type="button" class="btn btn-outline-secondary form-group col-1 deletePhone"  id="deletePhone0" disabled onclick="deletePhone(0)">
                                <i class="far fa-trash-alt"></i>
                            </button>
                        </div>
                        <div class="btn-group special col-md-6 groupModale"  role="group">
                            <button class="btn btn-outline-primary form-group disabled btn44"  disabled type="button" style="height:38px;">
                                <i class="fas fa-map"></i>
                            </button>
                            <input class="form-control col-md-10 latClass formCustom" type="text" id="lat0" placeholder="Latitude..." autocomplete="off">
                        </div>
                        <div class="btn-group special col-md-6 groupModale" role="group">
                            <button class="btn btn-outline-primary form-group disabled btn44" disabled type="button" style="height:38px;">
                                <i class="far fa-map"></i>
                            </button>       
                            <input class="form-control col-md-10 lonClass formCustom" type="text" id="lon0" placeholder="Longitude..." autocomplete="off">
                        </div>
                        <div class="btn-group special col-md-6 groupModale" role="group">
                            <button class="btn btn-outline-primary form-group disabled btn44" disabled  type="button" style="height:38px;">
                                <i class="far fa-envelope"></i>
                            </button>     
                            <input class="form-control col-md-10 mailClass formCustom" type="text" id="mail0" placeholder="eMail..." autocomplete="off">
                        </div>
                        <div class="btn-group special col-md-6 groupModale" role="group">
                            <button class="btn btn-outline-primary form-group disabled btn44"  disabled type="button" style="height:38px;">
                                <i class="fas fa-external-link-alt"></i>
                            </button>
                            <input type="text" class="form-control col-10 TXClass formCustom" id="TX0"  placeholder="Adresse TX..." autocomplete="off">
                        </div>
                        <div class="btn-group special col-md-6 groupModale" role="group">
                            <button class="btn btn-outline-primary form-group disabled btn44" disabled  type="button" style="height:38px;">
                                <i class="far fa-id-card"></i>
                            </button>     
                            <input class="form-control col-md-10 idTVClass formCustom" type="text" id="idTV0" placeholder="ID Teamviewer..." autocomplete="off">
                        </div>
                        <div class="btn-group special col-md-6 groupModale " role="group">
                            <button class="btn btn-outline-primary form-group disabled btn44"  disabled type="button" style="height:38px;">
                                <i class="fas fa-unlock"></i>
                            </button>
                            <input type="text" class="form-control col-10 passwordTVClass formCustom" name="passTV0" id="passTV0"  placeholder="Mot de Passe..." autocomplete="off" >
                        </div>
                    </div>
                    <!--<hr>-->
                    <input type='hidden' value ='1' id='delete0' name='delete0'>
                    <input type='hidden' value ='' id='id0' name='id0'>
                </div>
                <input type='hidden' value ='' id='nbPhone' name="nbPhone">
            </div>
        </div>
    </div>
</div>
<!-- /.modal -->
