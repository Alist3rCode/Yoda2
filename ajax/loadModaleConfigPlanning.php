<?php 
require_once "ajaxDatabaseInit.php";

?>

<div class="modal-dialog" role="document">
    <div class="modal-content" style="width: 95vw;margin-left: -32vw;">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Configuration Planning Support</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
            <div class="col-md-12 d-flex flex-row">
                <div class="col-md-6" >
                    <div class="col-md-12" >
                        <div class="btn-group text-center mx-auto" role="group" aria-label="Button group with nested dropdown">

                            <div class="btn-group" role="group">
                                <button id="btnTech" type="button" class="btn btn-secondary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                  Technicien
                                </button>
                                <div class="dropdown-menu" aria-labelledby="btnTech">
                                    <a class="dropdown-item" href="#">YLP</a>
                                    <a class="dropdown-item" href="#">JSA</a>
                                    <a class="dropdown-item" href="#">AJA</a>
                                    <a class="dropdown-item" href="#">MAC</a>
                                    <a class="dropdown-item" href="#">RGE</a>
                                </div>
                            </div>

                            <div class="btn-group" role="group">
                                <button id="btnSlot" type="button" class="btn btn-secondary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                  Créneaux
                                </button>
                                <div class="dropdown-menu" aria-labelledby="btnSlot">
                                    <a class="dropdown-item" href="#">MAT</a>
                                    <a class="dropdown-item" href="#">APM</a>
                                    <a class="dropdown-item" href="#">ABS</a>
                                </div>
                            </div>
                            <input type="date" class="loginInput" placeholder="Date">
                            <button class="btn btn-primary" > 
                                <i class="fas fa-search"></i>
                            </button>
                            <button class="btn btn-success" data-toggle="collapse" data-target="#createAssocSlot" aria-expanded="false" aria-controls="createAssocSlot"> 
                                <i class="fas fa-plus-square"></i>
                            </button>
                        </div>
                        <div class="collapse" id="createAssocSlot" style="border: solid 1px darkgrey; border-radius: 5px;">
                            <div class="row ml-3">
                                <p>YLP -> MAT -> Début : </p>
                                <input class="loginInput" style="width:inherit;margin-left:30px" type="date" id="startAssocSlot" placeholder="Début">
                            </div>
                            <div class="col-md-12">
                                
                                <div class="row mx-auto mb-3">
                                    <button class="btn btn-outline-secondary">
                                        Hebdo
                                    </button>
                                    <div class="btn-group mx-auto" role="group">
                                        <button type="button" class="btn btn-outline-primary">Lundi</button>
                                        <button type="button" class="btn btn-outline-primary">Mardi</button>
                                        <button type="button" class="btn btn-outline-primary">Mercredi</button>
                                        <button type="button" class="btn btn-outline-primary">Jeudi</button>
                                        <button type="button" class="btn btn-outline-primary">Vendredi</button>
                                        <button type="button" class="btn btn-outline-primary">Samedi</button>
                                        <button type="button" class="btn btn-outline-primary">Dimanche</button>
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
                            </div>
                        </div>
                        <div class="col-md-12">
                            <table class="table table-striped mb-3">
                                <tbody>
                                    <tr>
                                        <th scope="row">
                                            <button class="btn btn-secondary">
                                                <i class="far fa-edit"></i>
                                            </button>

                                        </th>
                                        <td>YLP</td>
                                        <td>APM</td>
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
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <div class="col-md-6" style="border-left: solid 1px darkgrey">
                    <div class="col-md-12" style="border-bottom: solid 1px darkgrey">
                        <p>Créneaux Types</p>
                        <table class="table table-striped mb-3">
                            <thead>
                                <tr>
                                    <th scope="col">
                                        <button class="btn btn-primary">
                                            <i class="far fa-plus-square"></i>
                                        </button>
                                    </th>
                                    <th scope="col">
                                        <input class="loginInput" type="text" id="codeSlot" placeholder="Code">
                                    </th>
                                    <th scope="col">
                                        <input class="loginInput" type="text" id="nameSlot" placeholder="Nom">
                                    </th>
                                    <th scope="col">
                                        <input class="loginInput" type="time" id="startSlot" placeholder="Début">
                                    </th>
                                    <th scope="col">
                                        <input class="loginInput" type="time" id="endSlot" placeholder="Fin">
                                    </th>
                                    <th scope="col">
                                        <input  type="color" id="colorSlot" placeholder="Couleur">
                                    </th>
                                    <th scope="col">
                                        <button class="btn btn-success">
                                            <i class="fas fa-check"></i>
                                        </button>
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <th scope="row">
                                        <button class="btn btn-secondary">
                                            <i class="far fa-edit"></i>
                                        </button>
                                        
                                    </th>
                                    <td>MAT</td>
                                    <td>Matin</td>
                                    <td>08h00</td>
                                    <td>16h30</td>
                                    <td>@mdo</td>
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
                                    <td>APM</td>
                                    <td>Après-Midi</td>
                                    <td>09h30</td>
                                    <td>180h00</td>
                                    <td>@mdo</td>
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
                                    <td>ABS</td>
                                    <td>Absence</td>
                                    <td>08h00</td>
                                    <td>18h00</td>
                                    <td>@mdo</td>
                                    <td>
                                        <button class="btn btn-danger">
                                            <i class="far fa-trash-alt"></i>
                                        </button>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <div class="col-md-12" style="border-bottom : solid 1px darkgrey;">
                        <div class="row d-flex flex-row">
                            <p>Horaire Planning : </p>
                            <input class="loginInput" style="width:inherit;margin-left:30px" type="texte" id="startPlanning" placeholder="Début">
                            
                            <input class="loginInput" style="width:inherit;margin-left:30px" type="texte" id="endPlanning" placeholder="Fin">
                        </div>
                        <div class="row mx-auto">
                            <div class="btn-group mx-auto mb-3" role="group">
                                <button type="button" class="btn btn-outline-primary">Lundi</button>
                                <button type="button" class="btn btn-outline-primary">Mardi</button>
                                <button type="button" class="btn btn-outline-primary">Mercredi</button>
                                <button type="button" class="btn btn-outline-primary">Jeudi</button>
                                <button type="button" class="btn btn-outline-primary">Vendredi</button>
                                <button type="button" class="btn btn-outline-primary">Samedi</button>
                                <button type="button" class="btn btn-outline-primary">Dimanche</button>
                            </div>
                        </div>
                        
                    </div>
                    <div class="col-md-12">
                        <p>Jours fériés / Jours fermés</p>
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th scope="col">
                                        <button class="btn btn-primary">
                                            <i class="far fa-plus-square"></i>
                                        </button>
                                    </th>
                                    <th scope="col">
                                        <input class="loginInput" type="text" id="dateOff" placeholder="Date">
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
                            <tbody>
                                <tr>
                                    <th scope="row">
                                        <button class="btn btn-secondary">
                                            <i class="far fa-edit"></i>
                                        </button>
                                        
                                    </th>
                                    <td>01/01</td>
                                    <td>Jour de l'an</td>
                                    <td>
                                        <button class="btn btn-outline-secondary active">
                                            <i class="fas fa-redo"></i>
                                        </button>
                                    </td>
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
                                    <td>21/04/2018</td>
                                    <td>Paques</td>
                                    <td>
                                        <button class="btn btn-outline-secondary ">
                                            <i class="fas fa-redo"></i>
                                        </button>
                                    </td>
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
                                    <td>01/11</td>
                                    <td>Toussaint</td>
                                    <td>
                                        <button class="btn btn-outline-secondary active">
                                            <i class="fas fa-redo"></i>
                                        </button>
                                    </td>
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
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Fermer</button>
            <button type="button" class="btn btn-primary" id="saveConfigPlanning">Enregistrer</button>
        </div>
    </div>
</div>