<?php 
require_once "../ajaxDatabaseInit.php";
require('../../public/fetchInfoPlanning.php');
$arrayDays = ['Lundi','Mardi','Mercredi','Jeudi','Vendredi','Samedi','Dimanche'];

?>

<div class="modal-dialog" role="document" style="margin : 15px">
    <div class="modal-content" style="width: calc(100vw - 30px);margin:0; padding: 0; max-height: 930px">
        <div class="modal-header text-center">
          <h4 class="modal-title mx-auto" id="exampleModalLabel">Configuration Planning Support</h4>
        </div>
        <div class="modal-body" style="height:800px;">
            <div class="col-md-12 d-flex flex-row" style="height:100%;">
                <div class="col-md-6" style="overflow-y:scroll;">
                    <div class="col-md-12">
                        <div class="text-center mb-3">
                            <h4>Recherche / Création</h4>
                        </div>
                        <div class="btn-group text-center mx-auto col-md-12 mb-3" role="group" aria-label="Button group with nested dropdown" style="height:40px" >

                            <div class="btn-group  col-md-2" role="group" style="padding:0">
                                <button id="btnTech" type="button" data-id="" class="btn btn-secondary dropdown-toggle col-md-12" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" style="padding:0">
                                  Technicien
                                </button>
                                <div class="dropdown-menu" aria-labelledby="btnTech">
                                    <a class="dropdown-item searchTech" onclick="dropdown('btnTech','Tous',0)">Tous</a>
                                    <div class="dropdown-divider"></div>
                                    <?php for($i=0;$i < count($arrayTech);$i++):?>
                                        <a class="dropdown-item searchTech" onclick="dropdown('btnTech','<?=$arrayTech[$i]['firstName'].' '.$arrayTech[$i]['name']?>',<?=$arrayTech[$i]['id']?>)">
                                            <?=$arrayTech[$i]['firstName'].' '.$arrayTech[$i]['name']?>
                                        </a>
                                    <?php endfor;?>
                                </div>
                            </div>

                            <div class="btn-group col-md-2" role="group" style="padding:0">
                                <button id="btnSlot" type="button" data-id="" class="btn btn-secondary dropdown-toggle  col-md-12" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" style="padding:0">
                                  Créneaux
                                </button>
                                <div class="dropdown-menu col-md-12" aria-labelledby="btnSlot">
                                    <a class="dropdown-item searchSlot" data-id="0" onclick="dropdown('btnSlot','Tous',0)">Tous</a>
                                    <div class="dropdown-divider"></div>
                                    <?php for($i=0;$i < count($arrayConfig);$i++):?>
                                        <a class="dropdown-item searchSlot" onclick="dropdown('btnSlot','<?=$arrayConfig[$i]['name']?>',<?=$arrayConfig[$i]['id']?>)">
                                            <?=$arrayConfig[$i]['name']?>
                                        </a>
                                    <?php endfor;?>
                                </div>
                            </div>
                            <input type="text" class="loginInput col-md-3 inputDateWithText" id="startSearchSlot" placeholder="Début">
                            <input type="text" class="loginInput col-md-3 inputDateWithText" id="endSearchSlot" placeholder="Fin">
                            <button class="btn btn-primary col-md-1 btnCollapse" id="slotSearch"> 
                                <i class="fas fa-search"></i>
                            </button>
                            <button class="btn btn-success col-md-1 btnCollapse" data-toggle="collapse" data-target="#createAssocSlot" aria-expanded="false" aria-controls="createAssocSlot"> 
                                <i class="fas fa-plus-square"></i>
                            </button>
                        </div>
                        <div class="collapse mb-3" id="createAssocSlot" style="border: solid 1px darkgrey; border-radius: 5px;">
                            <div class="row ml-3">
                                <div class="btn-group text-center mx-auto col-md-12 mt-3 mb-3" role="group" aria-label="Button group with nested dropdown" style="height:40px;padding:0" >

                                    <div class="btn-group  col-md-3" role="group" style="padding:0">
                                        <button id="btnAddTech" data-id="" type="button" class="btn btn-secondary dropdown-toggle col-md-12" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" style="padding:0">
                                          Technicien
                                        </button>
                                        <div class="dropdown-menu" aria-labelledby="btnAddTech">
                                            <?php for($i=0;$i < count($arrayTech);$i++):?>
                                                <a class="dropdown-item createTech" onclick="dropdown('btnAddTech','<?=$arrayTech[$i]['firstName'].' '.$arrayTech[$i]['name']?>',<?=$arrayTech[$i]['id']?>)">
                                                    <?=$arrayTech[$i]['firstName'].' '.$arrayTech[$i]['name']?>
                                                </a>
                                            <?php endfor;?>
                                        </div>
                                    </div>

                                    <div class="btn-group col-md-3" role="group" style="padding:0">
                                        <button id="btnAddSlot" data-id="" type="button" class="btn btn-secondary dropdown-toggle  col-md-12" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" style="padding:0">
                                          Créneaux
                                        </button>
                                        <div class="dropdown-menu col-md-12" aria-labelledby="btnAddSlot">
                                            <?php for($i=0;$i < count($arrayConfig);$i++):?>
                                                <a class="dropdown-item " onclick="dropdown('btnAddSlot','<?=$arrayConfig[$i]['name']?>',<?=$arrayConfig[$i]['id']?>)">
                                                    <?=$arrayConfig[$i]['name']?>
                                                </a>
                                            <?php endfor;?>
                                        </div>
                                    </div>
                                    <p class="col-md-2">Début : </p>
                                    <input class="loginInput col-md-3 inputDateWithText" style="width:inherit;" type="date" id="startAssocSlot" placeholder="Début">
                                </div>
                                
                            </div>
                            <div class="col-md-12">
                                
                                <div class="row mx-auto mb-3">
                                    <button class="btn btn-outline-secondary">
                                        Une fois
                                    </button>
                                    
                                </div>
                                
                                <div class="row mx-auto mb-3">
                                    <button class="btn btn-outline-secondary">
                                        Hebdo
                                    </button>
                                    <div class="btn-group ml-3" role="group">
                                        <?php foreach($workingDays as $key=>$value):?>
                                            <button type="button" class="btn btn-outline-primary daysButton>"><?=$value?></button>
                                        <?php endforeach; ?>
                                    </div>
                                </div>
                                <div class="row mx-auto mb-3">
                                    <button class="btn btn-outline-secondary">
                                        Mensuel
                                    </button>
                                    <div class="row ml-3" role="group">
                                        Le 
                                        <input type="text" class="loginInput" placeholder="1" style="width:50px;">
                                         tous les 
                                        <input type="text" class="loginInput" placeholder="1" style="width:50px;">
                                         mois
                                        
                                    </div>
                                    
                                </div>
                                <div class="row mb-3 d-flex justify-content-between">
                                    <div class="row ml-3">
                                        Fin le : <input type="date" class="loginInput" style="width:inherit;">
                                    </div>
                                    <div class="row mr-3">
                                        Fin après <input type="text" class="loginInput" placeholder="1" style="width:50px;"> répétitions
                                    </div>
                                </div>
                                <div class="row mb-3 mx-3 d-flex justify-content-between">
                                    <button class="btn btn-warning">Réinitialiser</button>
                                    <button class="btn btn-success">Valider</button>
                                </div>
                            </div>
                        </div>
                        <div class="d-none alert" id="alertSearchOrCreate"></div>
                        <div class="col-md-12 collapse" id="resultSlotSearch">
                            <table class="table table-striped mb-3"  > 
                                <thead>
                                    <tr>
                                        <th scope="col" style="width: 5%">
                                           
                                        </th>
                                        <th scope="col">
                                            Technicien
                                        </th>
                                        <th scope="col">
                                            Créneau
                                        </th>
                                        <th scope="col">
                                            Date
                                        </th>
                                        <th scope="col" style="width: 5%">
                                           
                                        </th>
                                    </tr>
                                </thead>
                                <tbody id="tableResultSlot">
                                    
                                </tbody>
                            </table>
                        </div>
                        <div id="noSearchNorCreate" class="alert alert-warning collapse show">Cliquer sur la loupe effectuer une recherche d'association de créneaux, ou sur le + vert pour paramétrer des associations de créneaux. </div>
                    </div>
                </div>
                <div class="col-md-6" style="border-left: solid 1px darkgrey">
                    <div class="col-md-12" style="border-bottom : solid 2px darkgrey;">
                        <div class="row d-flex flex-row text-center mb-3 ">
                            
                                <h4>Horaires Planning : </h4>
                                
                            <input class="loginInput inputTimeWithText" style="width:inherit;margin-left:30px" type="time" id="startPlanning" placeholder="Début" value="<?=$arrayPlanning['start']->format('H:i:s')?>">
                            
                            <input class="loginInput inputTimeWithText" style="width:inherit;margin-left:30px" type="time" id="endPlanning" placeholder="Fin" value="<?=$arrayPlanning['stop']->format('H:i:s')?>">
                        </div>
                        <div class="row mx-auto">
                            <div class="btn-group mx-auto mb-3" role="group" id="workingDaysButton">
                                <?php foreach($arrayDays as $key=>$value):?>
                                    <button type="button" class="btn btn-outline-primary daysButton <?=(in_array($value, $workingDays)? "active": "");?>"><?=$value?></button>
                                <?php endforeach; ?>
                            </div>
                            
                            <button class="btn btn-success mb-3 " id="validPlanningTime">Enregistrer</button>
                        </div>
                        <div class="alert d-none" id="alertPlanningTime"></div>                        
                        
                    </div>
                    <div class="col-md-12 mt-3" style="border-bottom: solid 2px darkgrey">
                        <div class="text-center">
                            <h4>Créneaux Types</h4>
                        </div>
                        <table class="table table-striped mb-3">
                            <thead class="d-none" id="theadSlotInput">
                                <tr>
                                    <th scope="col" style="width: 5%">
                                        <button class="btn btn-secondary" onclick="switchHeadTable('headSlot')">
                                            <i class="fas fa-table"></i>
                                        </button>
                                    </th>
                                    <th scope="col" style="width: 14.28%">
                                        <input class="loginInput" type="text" id="codeSlot" placeholder="Code">
                                    </th>
                                    <th scope="col" style="width: 14.28%">
                                        <input class="loginInput" type="text" id="nameSlot" placeholder="Nom">
                                    </th>
                                    <th scope="col" style="width: 14.28%">
                                        <input class="loginInput inputTimeWithText" type="text" id="startSlot" placeholder="Début">
                                    </th>
                                    <th scope="col" style="width: 14.28%">
                                        <input class="loginInput inputTimeWithText" type="text" id="endSlot" placeholder="Fin">
                                    </th>
                                    <th scope="col" style="width: 5%">
                                        <input  type="color" id="colorSlot" placeholder="Couleur">
                                    </th>
                                    <th scope="col" style="width: 5%">
                                        <button class="btn btn-success" onclick='addNewSlot()'>
                                            <i class="fas fa-check"></i>
                                        </button>
                                    </th>
                                </tr>
                            </thead>
                            <thead id="theadSlot">
                                <tr>
                                    <th scope="col" style="width: 5%">
                                        <button class="btn btn-success" onclick="switchHeadTable('inputSlot')">
                                            <i class="fas fa-plus-square"></i>
                                        </button>
                                    </th>
                                    <th scope="col" style="width: 14.28%">
                                        Code
                                    </th>
                                    <th scope="col" style="width: 14.28%">
                                        Nom
                                    </th>
                                    <th scope="col" style="width: 14.28%">
                                        Début
                                    </th>
                                    <th scope="col" style="width: 14.28%">
                                        Fin
                                    </th>
                                    <th scope="col" style="width: 5%">
                                        Couleur
                                    </th>
                                    <th scope="col" style="width: 5%">
                                        
                                    </th>
                                </tr>
                            </thead>
                            <tbody id="tableSlot" style="overflow-y: scroll;">
                                
                                <?php for($i=0;$i<count($arrayConfig);$i++):?>
                                <tr>
                                    <th scope="row">
                                        <button class="btn btn-secondary" onclick='modifSlot(<?=$arrayConfig[$i]['id']?>)'>
                                            <i class="far fa-edit"></i>
                                        </button>
                                    </th>
                                    <td><?=$arrayConfig[$i]['code']?></td>
                                    <td><?=$arrayConfig[$i]['name']?></td>
                                    <td><?=$arrayConfig[$i]['start']->format('H:i:s')?></td>
                                    <td><?=$arrayConfig[$i]['stop']->format('H:i:s')?></td>
                                    <td><input  type="color" value="<?=$arrayConfig[$i]['color']?>" disabled></td>
                                    <td>
                                        <button class="btn btn-danger" onclick='deleteSlot(<?=$arrayConfig[$i]['id']?>)'>
                                            <i class="far fa-trash-alt"></i>
                                        </button>
                                    </td>
                                </tr>
                                <?php endfor;?>
                            </tbody>
                        </table>
                        <div class="alert d-none" id="alertSlot"></div>    
                    </div>
                    
                    <div class="col-md-12 mt-3">
                        <div class="text-center">
                            <h4>Jours fériés / Jours fermés </h4>
                        </div>
                        <table class="table table-striped">
                            <thead class="d-none" id="theadOffInput">
                                <tr>
                                    <th scope="col">
                                        <button class="btn btn-secondary"  onclick="switchHeadTable('headOff')">
                                            <i class="fas fa-table"></i>
                                        </button>
                                    </th>
                                    <th scope="col">
                                        <input class="loginInput inputDateWithText" type="text" id="dateOff" placeholder="Date">
                                    </th>
                                    <th scope="col">
                                        <input class="loginInput" type="text" id="nameOff" placeholder="Nom">
                                    </th>
                                    <th scope="col">
                                        <button class="btn btn-outline-primary">
                                            <i class="fas fa-redo"></i>
                                        </button>
                                    </th>
                                    <th scope="col">
                                        <button class="btn btn-success">
                                            <i class="fas fa-check"></i>
                                        </button>
                                    </th>
                                </tr>
                            </thead>
                            <thead id="theadOff">
                                <tr>
                                    <th scope="col">
                                        <button class="btn btn-success"  onclick="switchHeadTable('inputOff')">
                                            <i class="fas fa-plus-square"></i>
                                        </button>
                                    </th>
                                    <th scope="col">
                                        Date
                                    </th>
                                    <th scope="col">
                                        Nom
                                    </th>
                                    <th scope="col">
                                        Répétition
                                    </th>
                                    <th scope="col">
                                       
                                    </th>
                                </tr>
                            </thead>
                            <tbody  style="overflow-y: scroll;">
                                <?php for($i=0;$i<count($arrayOff);$i++):?>
                                <tr>
                                    <th scope="row">
                                        <button class="btn btn-secondary" onclick='modifOff(<?=$arrayOff[$i]['id']?>)'>
                                            <i class="far fa-edit"></i>
                                        </button>
                                    </th>
                                    <td><?=$arrayOff[$i]['day'].$arrayOff[$i]['month'].$arrayOff[$i]['year']?></td>
                                    <td><?=$arrayOff[$i]['name']?></td>
                                    <td><button class="btn btn-outline-primary <?=($arrayOff[$i]['repeat']==1? "active": "");?>" diabled>
                                            <i class="fas fa-redo"></i>
                                        </button>
                                    <td>
                                        <button class="btn btn-danger" onclick='deleteOff(<?=$arrayOff[$i]['id']?>)'>
                                            <i class="far fa-trash-alt"></i>
                                        </button>
                                    </td>
                                </tr>
                                <?php endfor;?>
                            </tbody>
                        </table>
                        <div class="alert d-none" id="alertOff"></div>   
                    </div>
                    <div class="modal-footer ">
                        <button type="button" class="btn btn-secondary mb-3" data-dismiss="modal">Fermer</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script src="./public/js/planning.js"></script>
    
    