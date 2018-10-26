<?php 
require_once "ajaxDatabaseInit.php";
require('../public/fetchInfoPlanning.php');
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
                                <button id="btnTech" type="button" class="btn btn-secondary dropdown-toggle col-md-12" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" style="padding:0">
                                  Technicien
                                </button>
                                <div class="dropdown-menu" aria-labelledby="btnTech">
                                    <a class="dropdown-item searchTech">Tous</a>
                                    <div class="dropdown-divider"></div>
                                    <?php for($i=0;$i < count($arrayTech);$i++):?>
                                        <a class="dropdown-item searchTech"><?=$arrayTech[$i]['firstName'].' '.$arrayTech[$i]['name']?></a>
                                    <?php endfor;?>
                                </div>
                            </div>

                            <div class="btn-group col-md-2" role="group" style="padding:0">
                                <button id="btnSlot" type="button" class="btn btn-secondary dropdown-toggle  col-md-12" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" style="padding:0">
                                  Créneaux
                                </button>
                                <div class="dropdown-menu col-md-12" aria-labelledby="btnSlot">
                                    <a class="dropdown-item searchSlot">Tous</a>
                                    <div class="dropdown-divider"></div>
                                    <?php for($i=0;$i < count($arrayConfig);$i++):?>
                                        <a class="dropdown-item searchSlot"><?=$arrayConfig[$i]['name']?></a>
                                    <?php endfor;?>
                                </div>
                            </div>
                            <input type="text" class="loginInput col-md-3 inputDateWithText" placeholder="Début">
                            <input type="text" class="loginInput col-md-3 inputDateWithText" placeholder="Fin">
                            <button class="btn btn-primary col-md-1" > 
                                <i class="fas fa-search"></i>
                            </button>
                            <button class="btn btn-success col-md-1" data-toggle="collapse" data-target="#createAssocSlot" aria-expanded="false" aria-controls="createAssocSlot"> 
                                <i class="fas fa-plus-square"></i>
                            </button>
                        </div>
                        <div class="collapse mb-3" id="createAssocSlot" style="border: solid 1px darkgrey; border-radius: 5px;">
                            <div class="row ml-3">
                                <div class="btn-group text-center mx-auto col-md-12 mt-3 mb-3" role="group" aria-label="Button group with nested dropdown" style="height:40px;padding:0" >

                                    <div class="btn-group  col-md-3" role="group" style="padding:0">
                                        <button id="btnAddTech" type="button" class="btn btn-secondary dropdown-toggle col-md-12" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" style="padding:0">
                                          Technicien
                                        </button>
                                        <div class="dropdown-menu" aria-labelledby="btnAddTech">
                                            <?php for($i=0;$i < count($arrayTech);$i++):?>
                                                <a class="dropdown-item createTech"><?=$arrayTech[$i]['firstName'].' '.$arrayTech[$i]['name']?></a>
                                            <?php endfor;?>
                                        </div>
                                    </div>

                                    <div class="btn-group col-md-3" role="group" style="padding:0">
                                        <button id="btnAddSlot" type="button" class="btn btn-secondary dropdown-toggle  col-md-12" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" style="padding:0">
                                          Créneaux
                                        </button>
                                        <div class="dropdown-menu col-md-12" aria-labelledby="btnAddSlot">
                                            <?php for($i=0;$i < count($arrayConfig);$i++):?>
                                                <a class="dropdown-item createSlot"><?=$arrayConfig[$i]['name']?></a>
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
                        <div class="col-md-12" >
                            <table class="table table-striped mb-3"  > 
                                <thead>
                                    <tr>
                                        <th scope="col">
                                            Editer
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
                                        <th scope="col">
                                            Supprimer
                                        </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php for($i=0;$i<count($arraySlot);$i++):?>
                                    <tr>
                                        <th scope="row">
                                            <button class="btn btn-secondary" onclick='modifSlotAssoc(<?=$arraySlot[$i]['id']?>)'>
                                                <i class="far fa-edit"></i>
                                            </button>
                                        </th>
                                        <td><?=$arraySlot[$i]['nameTech']?></td>
                                        <td><?=$arraySlot[$i]['nameSlot']?></td>
                                        <td><?=$arraySlot[$i]['dateSlot']?></td>
                                        <td>
                                            <button class="btn btn-danger" onclick='deleteSlotAssoc(<?=$arraySlot[$i]['id']?>)'>
                                                <i class="far fa-trash-alt"></i>
                                            </button>
                                        </td>
                                    </tr>
                                    <?php endfor;?>
                                    <tr>
                                        <th scope="row">
                                            <button class="btn btn-secondary">
                                                <i class="far fa-edit"></i>
                                            </button>

                                        </th>
                                        <td>Yohann Lopez</td>
                                        <td>Après-Midi</td>
                                        <td>25/10/2018</td>
                                        <td>
                                            <button class="btn btn-danger">
                                                <i class="far fa-trash-alt"></i>
                                            </button>
                                        </td>
                                    </tr>
                                    <tr>
                                        <th scope="row">
                                            <button class="btn btn-secondary">
                                                <i class="far fa-edit"></i>
                                            </button>
                                        </th>
                                        <td>JSA</td>
                                        <td>MAT</td>
                                        <td>25/10/2018</td>
                                        <td>
                                            <button class="btn btn-danger">
                                                <i class="far fa-trash-alt"></i>
                                            </button>
                                        </td>
                                    </tr>
                                    <tr>
                                        <th scope="row">
                                            <button class="btn btn-secondary">
                                                <i class="far fa-edit"></i>
                                            </button>
                                        </th>
                                        <td>YLP</td>
                                        <td>ALL</td>
                                        <td>26/10/2018</td>
                                        <td>
                                            <button class="btn btn-danger">
                                                <i class="far fa-trash-alt"></i>
                                            </button>
                                        </td>
                                    </tr>
                                    <tr>
                                        <th scope="row">
                                            <button class="btn btn-secondary">
                                                <i class="far fa-edit"></i>
                                            </button>
                                        </th>
                                        <td>JSA</td>
                                        <td>ABS</td>
                                        <td>26/10/2018</td>
                                        <td>
                                            <button class="btn btn-danger">
                                                <i class="far fa-trash-alt"></i>
                                            </button>
                                        </td>
                                    </tr>
                                    <tr>
                                        <th scope="row">
                                            <button class="btn btn-secondary">
                                                <i class="far fa-edit"></i>
                                            </button>
                                        </th>
                                        <td>JSA</td>
                                        <td>ABS</td>
                                        <td>26/10/2018</td>
                                        <td>
                                            <button class="btn btn-danger">
                                                <i class="far fa-trash-alt"></i>
                                            </button>
                                        </td>
                                    </tr>
                                    <tr>
                                        <th scope="row">
                                            <button class="btn btn-secondary">
                                                <i class="far fa-edit"></i>
                                            </button>
                                        </th>
                                        <td>JSA</td>
                                        <td>ABS</td>
                                        <td>26/10/2018</td>
                                        <td>
                                            <button class="btn btn-danger">
                                                <i class="far fa-trash-alt"></i>
                                            </button>
                                        </td>
                                    </tr>
                                    <tr>
                                        <th scope="row">
                                            <button class="btn btn-secondary">
                                                <i class="far fa-edit"></i>
                                            </button>
                                        </th>
                                        <td>JSA</td>
                                        <td>ABS</td>
                                        <td>26/10/2018</td>
                                        <td>
                                            <button class="btn btn-danger">
                                                <i class="far fa-trash-alt"></i>
                                            </button>
                                        </td>
                                    </tr>
                                    <tr>
                                        <th scope="row">
                                            <button class="btn btn-secondary">
                                                <i class="far fa-edit"></i>
                                            </button>
                                        </th>
                                        <td>JSA</td>
                                        <td>ABS</td>
                                        <td>26/10/2018</td>
                                        <td>
                                            <button class="btn btn-danger">
                                                <i class="far fa-trash-alt"></i>
                                            </button>
                                        </td>
                                    </tr>
                                    <tr>
                                        <th scope="row">
                                            <button class="btn btn-secondary">
                                                <i class="far fa-edit"></i>
                                            </button>
                                        </th>
                                        <td>JSA</td>
                                        <td>ABS</td>
                                        <td>26/10/2018</td>
                                        <td>
                                            <button class="btn btn-danger">
                                                <i class="far fa-trash-alt"></i>
                                            </button>
                                        </td>
                                    </tr>
                                    <tr>
                                        <th scope="row">
                                            <button class="btn btn-secondary">
                                                <i class="far fa-edit"></i>
                                            </button>
                                        </th>
                                        <td>JSA</td>
                                        <td>ABS</td>
                                        <td>26/10/2018</td>
                                        <td>
                                            <button class="btn btn-danger">
                                                <i class="far fa-trash-alt"></i>
                                            </button>
                                        </td>
                                    </tr>
                                    <tr>
                                        <th scope="row">
                                            <button class="btn btn-secondary">
                                                <i class="far fa-edit"></i>
                                            </button>
                                        </th>
                                        <td>JSA</td>
                                        <td>ABS</td>
                                        <td>26/10/2018</td>
                                        <td>
                                            <button class="btn btn-danger">
                                                <i class="far fa-trash-alt"></i>
                                            </button>
                                        </td>
                                    </tr>
                                    <tr>
                                        <th scope="row">
                                            <button class="btn btn-secondary">
                                                <i class="far fa-edit"></i>
                                            </button>
                                        </th>
                                        <td>JSA</td>
                                        <td>ABS</td>
                                        <td>26/10/2018</td>
                                        <td>
                                            <button class="btn btn-danger">
                                                <i class="far fa-trash-alt"></i>
                                            </button>
                                        </td>
                                    </tr>
                                    <tr>
                                        <th scope="row">
                                            <button class="btn btn-secondary">
                                                <i class="far fa-edit"></i>
                                            </button>
                                        </th>
                                        <td>JSA</td>
                                        <td>ABS</td>
                                        <td>26/10/2018</td>
                                        <td>
                                            <button class="btn btn-danger">
                                                <i class="far fa-trash-alt"></i>
                                            </button>
                                        </td>
                                    </tr>
                                    <tr>
                                        <th scope="row">
                                            <button class="btn btn-secondary">
                                                <i class="far fa-edit"></i>
                                            </button>
                                        </th>
                                        <td>JSA</td>
                                        <td>ABS</td>
                                        <td>26/10/2018</td>
                                        <td>
                                            <button class="btn btn-danger">
                                                <i class="far fa-trash-alt"></i>
                                            </button>
                                        </td>
                                    </tr>
                                    <tr>
                                        <th scope="row">
                                            <button class="btn btn-secondary">
                                                <i class="far fa-edit"></i>
                                            </button>
                                        </th>
                                        <td>YLP</td>
                                        <td>ABS</td>
                                        <td>26/10/2018</td>
                                        <td>
                                            <button class="btn btn-danger">
                                                <i class="far fa-trash-alt"></i>
                                            </button>
                                        </td>
                                    </tr>
                                    
                                </tbody>
                            </table>
                        </div>
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
                            <div class="btn-group mx-auto mb-3" role="group">
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
                            <thead>
                                <tr>
                                    <th scope="col" style="width: 5%">
                                        <button class="btn btn-primary">
                                            <i class="far fa-plus-square"></i>
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
                                        <button class="btn btn-success">
                                            <i class="fas fa-check"></i>
                                        </button>
                                    </th>
                                </tr>
                            </thead>
                            <tbody style="overflow-y: scroll;">
                                
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
                                    <td><input  type="color" id="colorSlot_<?=$arrayConfig[$i]['id']?>" placeholder="Couleur" value="<?=$arrayConfig[$i]['color']?>" disabled></td>
                                    <td>
                                        <button class="btn btn-danger" onclick='deleteSlot(<?=$arrayConfig[$i]['id']?>)'>
                                            <i class="far fa-trash-alt"></i>
                                        </button>
                                    </td>
                                </tr>
                                <?php endfor;?>
                            </tbody>
                        </table>
                    </div>
                    
                    <div class="col-md-12 mt-3">
                        <div class="text-center">
                            <h4>Jours fériés / Jours fermés </h4>
                        </div>
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th scope="col">
                                        <button class="btn btn-primary">
                                            <i class="far fa-plus-square"></i>
                                        </button>
                                    </th>
                                    <th scope="col">
                                        <input class="loginInput inputDateWithText" type="text" id="dateOff" placeholder="Date">
                                    </th>
                                    <th scope="col">
                                        <input class="loginInput" type="text" id="nameOff" placeholder="Nom">
                                    </th>
                                    <th scope="col">
                                        <button class="btn btn-outline-secondary">
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
                                    <td><button class="btn btn-outline-secondary <?=($arrayOff[$i]['repeat']==1? "active": "");?>" diabled>
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
    
    