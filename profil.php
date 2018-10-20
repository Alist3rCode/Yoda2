<?php
session_start();

header('Content-Type: text/html; charset=utf-8');
require 'class/Autoloader.php';
Autoloader::register();

$bdd = new Database('yoda');
$bdd2 = new Database('ecsupgrader');

require_once('./class/checkCookie.php');
checkCookie($bdd,'profile.php');

require_once './public/fetchInfoUser.php';

require_once('./class/checkRights.php');
$right = checkRights($bdd,$_SESSION['id_user']);

?>

<!doctype html>
<html lang="fr">
    <head>
        
        <!-- Required meta tags -->
        <meta charset="utf-8">       
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

        <!-- Bootstrap CSS -->
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
         
        <!--Fontawesome CSS-->
        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.2.0/css/all.css" integrity="sha384-hWVjflwFxL6sNzntih27bfxkr27PmbbK/iSvJ+a4+0owXq79v+lsFkW54bOGbiDQ" crossorigin="anonymous">

        <!--CSS Perso-->

        <link rel="stylesheet" href="public/css/yoda.css">
        <?php require 'public/checkTheme.php'; ?>        
        <link rel="stylesheet" href="public/css/dashboard.css">
        <link rel="stylesheet" href="public/css/filters.css">
        <link rel="stylesheet" href="public/css/login.css">
        
        <!--Add Jquery-->
        <script  src="https://code.jquery.com/jquery-3.2.1.js"  integrity="sha256-DZAnKJ/6XZ9si04Hgrsxu/8s717jcIzLy3oi35EouyE="   crossorigin="anonymous"></script>


    </head>
    <body>
        
        <div id='idUser' class="d-none"><?=$_SESSION['id_user']?></div>
        
        
        <div class="content">
            
            <?php 
            require 'public/navbar2.php';
            require 'public/sidebar2.php';
            ?>
            
            <div class="clients" style="display:block;">
                
                <div class="card text-center mx-auto" style="margin-top:15px;width:75%;" >
                    <nav>
                        <div class="nav nav-tabs" id="nav-tab" role="tablist">
                            <a class="nav-item nav-link active" id="nav-profil-tab" data-toggle="tab" href="#nav-profil" role="tab" aria-controls="nav-profil" aria-selected="true">
                                Mon Profil
                            </a>
                            <?php if(in_array("rgt_cod_configuration", $right)):?>
                            <a class="nav-item nav-link" id="nav-config-tab" data-toggle="tab" href="#nav-config" role="tab" aria-controls="nav-config" aria-selected="false">
                                Configuration
                            </a>
                            <?php endif;?>
                        </div>
                    </nav>
                    <div class="tab-content cardInput" id="nav-tabContent">
                        <div class="tab-pane fade show active col-12 " id="nav-profil" role="tabpanel" aria-labelledby="nav-profil-tab" >
                            <div class="mt-3" style="display:flex;flex-flow: row wrap;">
                                <div class="col-12">
                                    <p class="text-muted">Que la force soit avec toi.</p>
                                </div>
                                <div class="col-md-12" id='technicianQuestion'>
                                    Theme visuel : 

                                    <button class="btn btn-light <?=$light?>"  type="button" id='lightTheme' onclick="changeTheme('dark')">
                                        <i class="fab fa-jedi-order"></i>
                                    </button>
                                    <button class="btn btn-dark <?=$dark?>"  type="button" id='darkTheme' onclick="changeTheme('light')">
                                        <i class="fab fa-empire"></i>
                                    </button>
                                </div>
                                
                                
                                
                                <div class="col-md-4 d-flex">
                                    <span class="iconLogin"><i class="fas fa-address-card"></i></span>
                                    <input class="loginInput " id="updateName" type="text" placeholder="Prénom" value="<?=$name?>">
                                </div>
                                <div class="col-md-4 d-flex">
                                    <span class="iconLogin"><i class="far fa-address-card"></i></span>
                                    <input class="loginInput" id="updateLastName" type="text" placeholder="Nom" value="<?=$lastName?>">
                                </div>
                                <div class="col-md-4 d-flex">
                                    <span class="iconLogin"><i class="fas fa-barcode"></i></span>
                                    <input class="loginInput text-uppercase" id="updateSurname" type="text" placeholder="Trigramme" disabled value="<?=$surname?>">
                                </div>
                                <div class="col-12 d-flex">
                                    <span class="iconLogin"><i class="fas fa-at"></i></span>
                                    <input class="loginInput" id="updateEmail" type="email" placeholder="Adresse eMail" value="<?=$mail?>">
                                </div>
                                <div class="col-12 text-center text-muted">
                                        <p>Page par défaut à la connexion : </p>
                                </div>
                                <div class="col-12 form-group" id="selectPageUser">
                                    <select class="custom-select" id="updatePage">
                                        <option value="0"<?=$page == '0' ? 'selected' : '';?>>Page par défaut...</option>
                                        <option value="Dashboard"<?=$page == 'index.php' ? 'selected' : '';?>>Dashboard</option>
                                        <option value="Clients"<?=$page == 'yoda.php' ? 'selected' : '';?>>Clients</option>
                                        <option value="Carte"<?=$page == 'maps.php' ? 'selected' : '';?>>Carte</option>
                                        <option value="Interne"<?=$page == 'interne.php' ? 'selected' : '';?>>Liens Interne</option>
                                    </select>
                                </div>
					
                                <div class="col-12 text-center text-muted">
                                        <p>Modifier le mot de passe ? </p>
                                </div>
                                <div class="col-md-6 d-flex">
                                    <span class="iconLogin"><i class="fas fa-unlock-alt"></i></span>
                                    <input class="loginInput" id="updatePassword" type="password" placeholder="Mot de Passe">
                                </div>
                                <div class="col-md-6 d-flex">
                                    <span class="iconLogin"><i class="fas fa-lock"></i></i></span>
                                    <input class="loginInput" id="updateConfirmPassword" type="password" placeholder="Confirmer Mot de Passe">
                                </div>
                                <div id='alertModif' class="alert d-none col-12 text-center" style="margin-top:15px;"></div>
                                <div id='confirmModif' class="alert d-none col-12 text-center" style="margin-top:15px;"></div>
                                <div class="col-12" style="margin-bottom:15px;">
                                    <a href="mdp.php" target="_blank"><button type="button" class="btn btn-info">
                                            Mot de passe aléatoire</button>
                                    </a>
                                    <button type="button" class="btn btn-warning" id="resetProfil">Réinitialiser</button>
                                    <button type="button" class="btn btn-success" id="updateProfil">Enregistrer</button>
                                </div>
                            </div>
                        </div>
                        <?php if(in_array("rgt_cod_configuration", $right)):?>
                        <div class="tab-pane fade col-12" id="nav-config" role="tabpanel" aria-labelledby="nav-config-tab">
                            <div style="display:flex;flex-flow: row wrap;">
                                <div class="col-12">
                                    <p>
                                    <h4><i class="fab fa-empire"></i> Mes respects, administrateur <span id="administratorName"><?=$lastName?></span>. </h4>
                                    <br>Quelle est la cible aujourd'hui ?</p>
                                </div>
                                <div class="col-md-4 col-xs-12">
                                    <div class="col-12 form-group input-group dropdown">
                                        <div class="input-group-prepend">
                                            <button class="btn btn-outline-secondary" type="button" id="newProfile">
                                                <i class="far fa-plus-square"></i>
                                            </button>
                                        </div>
                                        <input class="form-control rounded-right" id="configChooseProfil" type="text" placeholder="Profil..." data-toggle="dropdown">
                                
                                        <div class="dropdown-menu dropdown-menu-right col-11 text-truncate" aria-labelledby="configChooseProfil" id='dropdownProfil'></div>
                            
        			    </div>
                                    <hr>
    				    <div class="col-12 form-group input-group dropdown">
    				        
    				        <div class="input-group-prepend">
                                            <button class="btn btn-outline-secondary" type="button" id="newUser">
                                                <i class="fa fa-user-plus"></i>
                                            </button>
                                        </div>
                          
                                        <input class="form-control" id="searchUser" type="text" placeholder="Utilisateurs...">
                                        <div class="input-group-append" id="divDropDown">
                                            <button class="btn btn-outline-secondary rounded-right" type="button" id="dropdownMenuUser" data-toggle="dropdown" ><i class="fa fa-search"></i></button>
                                                <div class="d-none" id="listUser"></div>
                                            <div class="dropdown-menu dropdown-menu-right col-11 text-truncate" id="dropDownUser" aria-labelledby="clickTest"></div>
                                        </div>
    				    </div>
                                </div>
                                <div class="card col-md-8 col-xs-12 d-none" style="padding:0;margin-bottom:15px;" id="cardUser">
                                    <div class="card-header" style='background-color:#d8d8d8'>
                                        <h4><span id='nameSelected'></span> <span id='lastNameSelected'></span> - <span id='profilSelected'></span></h4>
                                        <div class="d-none" id="selectedUser"></div>
                                    </div>
                                    <div class="card-body col-12" style="display:flex;flex-flow: row wrap;">
                                        <div class="col-md-4 col-xs-12" id='activeOrNot'>
                                            Utilisateur actif : 
                                            
                                            <div class="d-none" id="droitActifUser">OK</div>
                                    
                                            <button class="btn btn-outline-success" type="button" id='actifUser'>
                                                <i class="fa fa-check" style="color:darkGreen;"></i>
                                            </button>
                                            <button class="btn btn-outline-danger d-none" type="button" id='desactifUser'>
                                                <i class="fa fa-times" style="color:darkRed;"></i>
                                            </button>
                                        </div>
                                        <div class="col-md-8 col-xs-12 dropdown" style='margin-bottom:15px;'>
                                            <input class="form-control rounded-right" id="configUserProfil" type="text" placeholder="Profil..." data-toggle="dropdown">
                                            <div class="dropdown-menu dropdown-menu-right col-11 text-truncate" aria-labelledby="configUserProfil" id='dropdownUserProfil'></div>
                                        </div>
                                        <div class="col-md-4 form-group">
                                                <input class="form-control" id="updateAdminName" type="text" placeholder="Prénom">
                                        </div>
                                        <div class="col-md-4 form-group">
                                                <input class="form-control" id="updateAdminLastName" type="text" placeholder="Nom" >
                                        </div>
                                        <div class="col-md-4 form-group">
                                                <input class="form-control" id="updateAdminSurname" type="text" placeholder="Trigramme" >
                                        </div>
                                        <div class="col-12 form-group">
                                                <input class="form-control" id="updateAdminEmail" type="email" placeholder="Adresse eMail" >
                                        </div>
                                        <div class="col-12 form-group">
                                            <select class="custom-select" id="updateAdminPage">
                                                <option value="0" selected>Page par défault...</option>
                                                <option value="Dashboard">Dashboard</option>
                                                <option value="Clients">Clients</option>
                                                <option value="Carte">Carte</option>
                                                <option value="Interne">Liens Interne</option>
                                            </select>
                                        </div>
                                        <div class="col-12 row" id="isTechnician" style="margin-bottom:15px;">
                                            
                                            <div class="col-md-4 col-xs-12" id='technicianQuestion'>
                                                Technicien Support : 

                                                <button class="btn btn-success  d-none"  type="button" id='isTech'>
                                                    <i class="fa fa-check" style="color:darkGreen;"></i>
                                                </button>
                                                <button class="btn btn-danger "  type="button" id='isNotTech'>
                                                    <i class="fa fa-times" style="color:darkRed;"></i>
                                                </button>
                                            </div>
                                                
                                        </div>
                                        <div class="col-12 text-center">
                                                <p>Modifier le mot de passe ?</p>
                                        </div>
                                        <div class="col-md-6 col-12 form-group">
                                                <input class="form-control" id="updateAdminPassword" type="password" placeholder="Mot de Passe">
                                        </div>
                                        <div class="col-md-6 col-12 form-group">
                                                <input class="form-control" id="updateAdminConfirmPassword" type="password" placeholder="Confirmer Mot de Passe">
                                        </div>
                                        
                                        <div class="accordion cardLogin" style="width:100%">
                                            <div class="card">
                                                <div class="card-header cardInput" id="headingOne">
                                                    <h5 class="mb-0">
                                                        <button class="btn btn-secondary" type="button" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                                                          <i class="fas fa-user-cog"></i> Gestion des Droits
                                                        </button>
                                                    </h5>
                                                </div>

                                                <div id="collapseOne" class="collapse" aria-labelledby="headingOne" data-parent="#accordionExample">
                                                    <div class="card-body">
                                                        <div class="row col-12 mx-auto">
                                                            <div class="col-md-6 mx-auto">
                                                                <button type="button" id="selectAllRightsUser" class="btn btn-primary" style="margin-bottom:15px;">
                                                                    <i class="fa fa-plus"></i> Tout ajouter
                                                                </button>
                                                                <ul class="list-group" id="unselectedRightsUser" style="max-height:30vh; overflow:auto;margin-bottom:15px;">
                                                                </ul>
                                                            </div>
                                                            <div class="col-md-6 mx-auto">
                                                                <button type="button" id="unselectAllRightsUser" class="btn btn-info" style="margin-bottom:15px;">
                                                                    <i class="fa fa-undo"></i> Tout retirer</button>
                                                                <br>
                                                                <ul class="list-group" id="selectedRightsUser" style="max-height:30vh; overflow:auto;margin-bottom:15px;">
                                                                </ul>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <br>
                                            </div>
                                        </div>
                                        <div id='alertAdminModif' class="alert d-none col-12 text-center" style="margin-top:15px;"></div>
                                        <div id='confirmAdminModif' class="alert d-none col-12 text-center" style="margin-top:15px;"></div>
                                        <div class="col-12" style="margin-bottom:15px;">
                                            <a href="mdp.php" target="_blank"><button type="button" class="btn btn-info">Mot de passe aléatoire</button></a>
                                            <button type="button" class="btn btn-warning" id="resetAdminProfil">Réinitialiser</button>
                                            <button type="button" class="btn btn-success" id="updateAdminProfil">Enregistrer</button>
                            
                                        </div>
                                    </div>
				</div>
                                <div class="card col-md-8 col-xs-12 d-none" style="padding:0;margin-bottom:15px;" id="cardProfil">
                                    <div class="card-header" style='background-color:#d8d8d8'>
                                        <h4>Configuration du profil <span id='profilConfSelected'></span></h4>
                                        <div class="d-none" id="selectedProfil"></div>
                                    </div>
                                    <div class="card-body col-12 mx-auto" style="display:flex;flex-flow: row wrap;">
                                        <div class="col-md-4 col-xs-12" id='ProfilActiveOrNot'>
                                            Profil actif : 
                                            <button class="btn btn-outline-success active" type="button" id='actifProfil'>
                                                <i class="fa fa-check" style="color:darkGreen;"></i>
                                            </button>
                                            <button class="btn btn-outline-danger active d-none" type="button" id='desactifProfil'>
                                                <i class="fa fa-times" style="color:darkRed;"></i>
                                            </button>
                                        </div>
                                        <div class="col-md-8 col-xs-12 dropdown" style='margin-bottom:15px;'>
                                            <input class="form-control rounded-right" id="configNameProfil" type="text" placeholder="Libellé...">
                                        </div>
                                        <div class="row col-12 mx-auto ">
                                            <div class="col-md-6 mx-auto">
                                                <button type="button" id="selectAllRights" class="btn btn-primary" style="margin-bottom:15px;">
                                                    <i class="fa fa-plus"></i> Tout ajouter
                                                </button>
                                                <ul class="list-group" id="unselectedRights" style="max-height:30vh; overflow:auto;margin-bottom:15px;">
                                                </ul>
                                            </div>
                                            <div class="col-md-6 mx-auto">
                                                <button type="button" id="unselectAllRights" class="btn btn-info" style="margin-bottom:15px;">
                                                    <i class="fa fa-undo"></i> Tout retirer</button>
                                                <br>
                                                <ul class="list-group" id="selectedRights" style="max-height:30vh; overflow:auto;margin-bottom:15px;">
                                                </ul>
                                            </div>
                                        </div>
                                        
                                        <div id='alertProfilModif' class="alert d-none col-12 text-center" style="margin-top:15px;"></div>
                                        <div id='confirmProfilModif' class="alert d-none  col-12 text-center" style="margin-top:15px;"></div>
                                        <div class="col-12" style="margin-bottom:15px;">
                                            <button type="button" class="btn btn-warning" id="resetConfigProfil">Réinitialiser</button>
                                            <button type="button" class="btn btn-success" id="updateConfigProfil">Enregistrer</button>

                                        </div>
                                    </div>
				</div>
                            </div>
			</div>
                        <?php endif;?>
                    </div>
		</div>
                
                
                
                
            </div>      
        <!-- Optional JavaScript -->
        <!-- jQuery first, then Popper.js, then Bootstrap JS -->
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>

        <script src="./public/js/yoda_style.js"></script>
        <script src="./public/js/capFirst.js"></script>
        <script src="./public/js/yoda_action.js"></script>
        <script src="./public/js/displayAlert.js"></script>
        <script src="./public/js/filters.js"></script>
        <script src="./public/js/login/rights.js"></script>
        <script src="./public/js/login/profil.js"></script>

       
       
       
                     
    </body>

</html>