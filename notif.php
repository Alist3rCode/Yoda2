<?php
session_start();

header('Content-Type: text/html; charset=utf-8');
require 'class/Autoloader.php';
Autoloader::register();

$bdd = new Database('yoda');
$bdd2 = new Database('ecsupgrader');

require_once('./class/checkCookie.php');
checkCookie($bdd,'notif.php');

require_once './public/fetchInfoUser.php';
require_once './public/fetchInfoNotif.php';

    
require_once('./class/checkRights.php');
$right = checkRights($bdd,$_SESSION['id_user']);



?>

<!doctype html>
<html lang="fr">
    <head>
        
        <!-- Required meta tags -->
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <meta name="description" content="Bookmarks for all the ETMI Customer Application. For RIS and PACS. Internal user Only !">
        <meta name="author" content="Yohann LOPEZ">
        <link rel="icon" type="image/png" href="public/img/yodaTitle.png" />
        <title>Notifications - Y.O.D.A. <?php
        $res = $bdd->queryObj('SELECT * FROM CFG_CONFIG');
        echo ' v' . $res[0]->CFG_VERSION;
        ?></title>
       
        <!-- Bootstrap CSS -->
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
         
        <!--Fontawesome CSS-->
        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.2.0/css/all.css" integrity="sha384-hWVjflwFxL6sNzntih27bfxkr27PmbbK/iSvJ+a4+0owXq79v+lsFkW54bOGbiDQ" crossorigin="anonymous">

        <!--CSS Perso-->

        <link rel="stylesheet" href="public/css/yoda.css">
        <?php require 'public/checkTheme.php'; ?>        
        <link rel="stylesheet" href="public/css/dashboard.css">
        <link rel="stylesheet" href="public/css/filters.css">
        <!--<link rel="icon" type="image/png" href="./public/img/yodaTitle.png" />-->
        
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
            
            <div class="clients" style="display:block">
                <div class="col-md-12 ">
                    <div class="card text-center mx-auto mt-3" >
                        <nav>
                            <div class="nav nav-tabs" id="nav-tab" role="tablist" style="background-color:rgb(216, 216, 216);">
                                <a class="nav-item nav-link active" id="nav-notif-tab" data-toggle="tab" href="#nav-notif" role="tab" aria-controls="nav-notif" aria-selected="true" style="color:black;">Mes notifications</a>
                                <?php if(in_array("rgt_cod_notification", $right)):?>
                                <a class="nav-item nav-link" id="nav-config-notif-tab" data-toggle="tab" href="#nav-config-notif" role="tab" aria-controls="nav-config-notif" aria-selected="false" style="color:black;">Configuration</a>
                                <a class="nav-item nav-link" id="nav-notif-users-tab" data-toggle="tab" href="#nav-notif-users" role="tab" aria-controls="nav-notif-users" aria-selected="false" style="color:black;">Notifications Utilisateurs</a>
                                <a class="nav-item nav-link" id="nav-notif-clients-tab" data-toggle="tab" href="#nav-notif-clients" role="tab" aria-controls="nav-notif-clients" aria-selected="false" style="color:black;">Notifications Clients</a>
                                <?php endif; ?>
                            </div>
                        </nav>
                        <div class="tab-content" id="nav-tabContent" style="background-color:#f7f7f7">
                            <div class="tab-pane fade show active col-12" id="nav-notif" role="tabpanel" aria-labelledby="nav-notif-tab" >
                                <div class="col-md-12" style="border-bottom: 1px solid lightgray;">
                                    <p>
                                        <h4>Salutations, <span id="nameDisplay"><?=$name?></span> <span id="lastNameDisplay"><?=$lastName?></span>. </h4>
                                        <br>C'est ici que viennent se configurer les différentes notifications que YODA peut générer. Pensez à sauvegarder avant de partir.
                                    </p>
                                </div>

                                <div class="row col-md-12" style="margin-top:50px;">
                                    <div class="col-md-4 col-xs-12" >
                                        <p>Recevoir une notification lors de la création de nouveaux clients dans YODA</p>
                                        <button class="btn btn-success <?php if($arrayCustomer['create']==0){echo 'd-none';}?>  " type="button" id='activeCreate'><i class="fa fa-check" style="color:darkGreen;"></i></button>
                                        <button class="btn btn-danger <?php if($arrayCustomer['create']==1){echo 'd-none';}?> " type="button" id='desactiveCreate'><i class="fa fa-times" style="color:darkRed;"></i></button>
                                    </div>

                                    <div class="col-md-4  col-xs-12">
                                        <p>Recevoir une notification lors de la modification de clients dans YODA</p>
                                        <button class="btn btn-success <?php if($arrayCustomer['modif']==0){echo 'd-none';}?>" type="button" id='activeModif'><i class="fa fa-check" style="color:darkGreen;"></i></button>
                                        <button class="btn btn-danger <?php if($arrayCustomer['modif']==1){echo 'd-none';}?> " type="button" id='desactiveModif'><i class="fa fa-times" style="color:darkRed;"></i></button>
                                    </div>

                                    <div class="col-md-4  col-xs-12">
                                        <p>Ajouter à la liste ci-dessous les nouveaux clients comme sélectionnés</p>
                                        <button class="btn btn-success <?php if($arrayCustomer['new_custo']==0){echo 'd-none';}?>" type="button" id='activeNewCusto'><i class="fa fa-check" style="color:darkGreen;"></i></button>
                                        <button class="btn btn-danger <?php if($arrayCustomer['new_custo']==1){echo 'd-none';}?>" type="button" id='desactiveNewCusto'><i class="fa fa-times" style="color:darkRed;"></i></button>
                                    </div>

                                </div>

                                <div class="row text-center mx-auto" style="margin-top:50px;border-top: 1px solid lightgray;">
                                    <p class="mx-auto col-md-12" style="margin-top:15px;">Recevoir une notification lors de la création de mise à jour des clients sélectionnés ci-dessous</p>
                                    <div class="col-md-6 mx-auto">


                                        <button type="button" id="selectAllCustomer" class="btn btn-primary" style="margin-bottom:15px;">
                                            <i class="fa fa-plus"></i> Tout ajouter
                                        </button>
                                        <div class="input-group mb-3">	
                                            <div class="input-group-prepend">
                                                <button class="btn btn-outline-danger" id="searchUnselectCustomerButton">
                                                    <i class="fa fa-times"></i>
                                                </button>
                                            </div>
                                            <input type="text" id="searchUnselectCustomer" class="form-control" placeholder="Rechercher...">
                                        </div>

                                        <br>
                                        <ul class="list-group" id="unselectedCustomer" style="max-height:50vh; overflow:auto;margin-bottom:15px;">
                                            <?php
                                            for ($y = 0; $y < count($arrayCustomer['client']); $y++) {

                                                if (!in_array($arrayCustomer['client'][$y]['id'], $arrayCustomer['notif'])) {
                                                    echo '<li class=" text-capitalize list-group-item list-group-item-danger selected" data-id=' . 
                                                            $arrayCustomer['client'][$y]['id'] . ' id="selectItem-' . $arrayCustomer['client'][$y]['id'] 
                                                            . '"  onclick="unselectCustomer(' . $arrayCustomer['client'][$y]['id'] . ')">' 
                                                            . $arrayCustomer['client'][$y]['ville'] . ' - ' . $arrayCustomer['client'][$y]['nom'] .'</li>'."\n";
                                                }
                                            }
                                            ?>
                                        </ul>
                                        <div class="alert alert-warning d-none" role="alert" id='alertUnselectedCustomer'>
                                            <p>Attention, une recherche est en cours, tous les clients présent dans la base peuvent ne pas être affichés.</p>
                                        </div>
                                    </div>
                                    <div class="col-md-6 mx-auto">
                                        <button type="button" id="unselectAllCustomer" class="btn btn-info col-md-6" style="margin-bottom:15px;"><i class="fa fa-undo"></i> Tout retirer</button>
                                        <div class="input-group mb-3">	
                                            <div class="input-group-prepend">
                                                <button class="btn btn-outline-danger" id="searchSelectCustomerButton"><i class="fa fa-times"></i></button>
                                            </div>
                                            <input type="text" id="searchSelectCustomer" class="form-control" placeholder="Rechercher...">
                                        </div>

                                        <br>
                                        <ul class="list-group" id="selectedCustomer" style="max-height:50vh; overflow:auto;margin-bottom:15px;">

                                            <?php

                                            for ($y = 0; $y < count($arrayCustomer['client']); $y++) {
                                                if (in_array($arrayCustomer['client'][$y]['id'], $arrayCustomer['notif'])) {
                                                    echo '<li class=" text-capitalize list-group-item list-group-item-success unselected" data-id=' . $arrayCustomer['client'][$y]['id'] . ' id="unselectItem-' . $arrayCustomer['client'][$y]['id'] . '"  onclick="selectCustomer(' . $arrayCustomer['client'][$y]['id'] . ')">' . $arrayCustomer['client'][$y]['ville'] . ' - ' . $arrayCustomer['client'][$y]['nom'] .'</li>'."\n";

                                                }
                                            }

                                            ?>
                                        </ul>
                                        <div class="alert alert-warning d-none" role="alert" id='alertSelectedCustomer'>
                                            <p>Attention, une recherche est en cours, tous les clients présent dans la base peuvent ne pas être affichés.</p>
                                        </div>
                                    </div>                            
                                </div>  
                                <div id='alertNotif' class="alert d-none col-12 text-center" style="margin-top:15px;"></div>
                                <div id='confirmNotif' class="alert d-none col-12 text-center" style="margin-top:15px;"></div>
                                <div class="col-12" style="margin-bottom:15px;">

                                    <button type="button" class="btn btn-warning btn-lg" id="resetNotif">Réinitialiser</button>
                                    <button type="button" class="btn btn-success btn-lg" id="updateNotif">Enregistrer</button>
                                </div>
                            </div>
                            <?php if(in_array("rgt_cod_notification", $right)):?>
                            <div class="tab-pane fade col-12" id="nav-config-notif" role="tabpanel" aria-labelledby="nav-config-notif-tab">
                                <p style="margin-top:15px;">Choisir un utilisateur à configurer : </p>
                                <div class="col-8 form-group input-group dropdown mx-auto">
                                    <input class="form-control" id="searchUser" type="text" placeholder="Utilisateurs...">
                                    <div class="input-group-append" id="divDropDown">
                                        <button class="btn btn-outline-secondary rounded-right" type="button" id="dropdownMenuUser" data-toggle="dropdown" >
                                            <i class="fa fa-search"></i>
                                        </button>
                                        <div class="d-none" id="listUser"></div>
                                        <div class="dropdown-menu dropdown-menu-right col-11 text-truncate" id="dropDownUser" aria-labelledby="clickTest"></div>
                                    </div>
                                </div>
                                <div id='selectedUser' class="d-none"></div>
                                <div id='configNotifUserHidden' class="d-none">
                                    <div class="row col-md-12" style="margin-top:50px;">
                                        <div class="col-md-4 col-xs-12" >
                                            <p>L'utilisateur doit-il recevoir une notification lors de la création de nouveaux clients dans YODA</p>
                                            <button class="btn btn-success" type="button" id='activeCreateConfig'><i class="fa fa-check" style="color:darkGreen;"></i></button>
                                            <button class="btn btn-danger" type="button" id='desactiveCreateConfig'><i class="fa fa-times" style="color:darkRed;"></i></button>
                                        </div>

                                        <div class="col-md-4  col-xs-12">
                                            <p>L'utilisateur doit-il recevoir une notification lors de la modification de clients dans YODA</p>
                                            <button class="btn btn-success" type="button" id='activeModifConfig'><i class="fa fa-check" style="color:darkGreen;"></i></button>
                                            <button class="btn btn-danger" type="button" id='desactiveModifConfig'><i class="fa fa-times" style="color:darkRed;"></i></button>
                                        </div>

                                        <div class="col-md-4  col-xs-12">
                                            <p>Ajouter à la liste ci-dessous les nouveaux clients comme sélectionnés pour l'utilisateur en cours</p>
                                            <button class="btn btn-success" type="button" id='activeNewCustoConfig'><i class="fa fa-check" style="color:darkGreen;"></i></button>
                                            <button class="btn btn-danger" type="button" id='desactiveNewCustoConfig'><i class="fa fa-times" style="color:darkRed;"></i></button>
                                        </div>

                                    </div>

                                    <div class="row text-center mx-auto" style="margin-top:50px;border-top: 1px solid lightgray;">
                                        <p class="mx-auto col-md-12" style="margin-top:15px;">L'utilisateur doit-il recevoir une notification lors de la création de mise à jour des clients sélectionnés ci-dessous</p>
                                        <div class="col-md-6 mx-auto">
                                            <button type="button" id="selectAllCustomerConfig" class="btn btn-primary" style="margin-bottom:15px;">
                                                <i class="fa fa-plus"></i> Tout ajouter
                                            </button>
                                            <div class="input-group mb-3">	
                                                <div class="input-group-prepend">
                                                    <button class="btn btn-outline-danger" id="searchUnselectCustomerButtonConfig"><i class="fa fa-times"></i></button>
                                                </div>
                                                <input type="text" id="searchUnselectCustomerConfig" class="form-control" placeholder="Rechercher...">
                                            </div>

                                            <br>
                                            <ul class="list-group" id="unselectedCustomerConfig" style="max-height:50vh; overflow:auto;margin-bottom:15px;">

                                            </ul>
                                            <div class="alert alert-warning d-none" role="alert" id='alertUnselectedCustomerConfig'>
                                                <p>Attention, une recherche est en cours, tous les clients présent dans la base peuvent ne pas être affichés.</p>
                                            </div>
                                        </div>
                                        <div class="col-md-6 mx-auto">
                                            <button type="button" id="unselectAllCustomerConfig" class="btn btn-info col-md-6" style="margin-bottom:15px;">
                                                <i class="fa fa-undo"></i> Tout retirer
                                            </button>
                                            <div class="input-group mb-3">	
                                                <div class="input-group-prepend">
                                                    <button class="btn btn-outline-danger" id="searchSelectCustomerButtonConfig"><i class="fa fa-times"></i></button>
                                                </div>
                                                <input type="text" id="searchSelectCustomerConfig" class="form-control" placeholder="Rechercher...">
                                            </div>

                                            <br>
                                            <ul class="list-group" id="selectedCustomerConfig" style="max-height:50vh; overflow:auto;margin-bottom:15px;">


                                            </ul>
                                            <div class="alert alert-warning d-none" role="alert" id='alertSelectedCustomerConfig'>
                                                <p>Attention, une recherche est en cours, tous les clients présent dans la base peuvent ne pas être affichés.</p>
                                            </div>
                                        </div>                            
                                    </div>
                                    <div id='alertNotifConfig' class="alert d-none col-12 text-center" style="margin-top:15px;"></div>
                                    <div id='confirmNotifConfig' class="alert d-none col-12 text-center" style="margin-top:15px;"></div>
                                    <div class="col-12" style="margin-bottom:15px;">

                                        <button type="button" class="btn btn-warning btn-lg" id="resetNotifConfig">Réinitialiser</button>
                                        <button type="button" class="btn btn-success btn-lg" id="updateNotifConfig">Enregistrer</button>
                                    </div>
                                </div>
                            </div>
                            <div class="tab-pane fade col-12" id="nav-notif-users" role="tabpanel" aria-labelledby="nav-notif-users" >
                                <div class=" row col-md-12" style="margin-bottom:15px;margin-top:15px;">
                                    <div class="col-md-6" >
                                        <div class="row text-center mx-auto" style="margin-top:10px;">
                                            <p class="mx-auto col-md-12" style="margin-top:15px;">Sélectionnez les utilisateurs ou profil que vous souhaitez contacter</p>
                                            <div class="col-md-6 mx-auto" style="padding: 0 5px;">
                                                <button type="button" id="selectAllUser" class="btn btn-primary col-md-8" style="margin-bottom:15px;">
                                                    <i class="fa fa-plus"></i> Tous
                                                </button>
                                                <div class="col-md-12"><span id='selectedProfilNumber' >0</span><span>/<?=count($arrayUser['profil'])?> profil(s)<br>sélectionnés</span></div>
                                                <br>
                                                <ul class="list-group" id="selectProfilList" style="max-height:50vh; overflow:auto;margin-bottom:15px;">
                                                    <?php
                                                    for ($y = 0; $y < count($arrayUser['profil']); $y++) {
                                                        echo '<li class=" text-capitalize list-group-item list-group-item-light profilNotif" id="profil-' . $arrayUser['profil'][$y]['id'] . '"  onclick="selectProfil(' . $arrayUser['profil'][$y]['id'] . ')">' . $arrayUser['profil'][$y]['name'] .'</li>'."\n";
                                                    }
                                                    ?>
                                                </ul>
                                            </div>
                                            <div class="col-md-6 mx-auto" style="padding: 0 5px;"> 
                                                <button type="button" id="unselectAllUser" class="btn btn-warning col-md-8" style="margin-bottom:15px;"><i class="fa fa-undo"></i> Aucun</button>
                                                <div class="col-md-12"><span id='selectedUserNumber' >0</span><span>/<?=count($arrayUser['user'])?> utilisateur(s) sélectionnés</span></div>
                                                <br>
                                                <ul class="list-group" id="selectUserList" style="max-height:50vh; overflow:auto;margin-bottom:15px;">
                                                    <?php
                                                    for ($y = 0; $y < count($arrayUser['user']); $y++) {
                                                        echo '<li class=" text-capitalize list-group-item list-group-item-light userNotif" data-user-id=' . $arrayUser['user'][$y]['id'] . ' data-profil-id=' . $arrayUser['user'][$y]['profil'] . ' id="user-' . $arrayUser['user'][$y]['id'] . '"  onclick="selectUser(' . $arrayUser['user'][$y]['id'] . ')">' . ucfirst($arrayUser['user'][$y]['prenom']) .' ' . ucfirst($arrayUser['user'][$y]['nom']) . '</li>'."\n";
                                                    }
                                                    ?>
                                                </ul>
                                            </div>                            
                                        </div>  
                                    </div>
                                    <div class="col-md-6 " style="margin-top:10px;">
                                        <p class="mx-auto col-md-12" style="margin-top:15px;">Renseignez un objet au mail, ainsi que le corps du message dans la zone de saisie.</p>

                                        <input type="text" class="form-control col-md-8 mx-auto" id='objet' placeholder="Objet..." style="margin:15px">
                                        <textarea class="form-control" id="textarea" name="textarea"></textarea>
                                        <div class="alert d-none" style="margin-top:15px" id="alertNotifUser"></div>
                                        <div class="alert d-none" style="margin-top:15px" id="successNotifUser"></div>
                                        <button class="btn btn-primary form-control" style="margin-top:15px;" id="sendMailButton">Envoyer</button>
                                    </div>  
                                </div>   
                            </div>
                            <div class="tab-pane fade col-12" id="nav-notif-clients" role="tabpanel" aria-labelledby="nav-notif-clients">
                                <div class="alert alert-primary" role="alert">
                                    En travaux nav-notif-clients                
                                </div>
                            </div>
                            <?php endif;?>
                        </div>
                    </div>
                </div>
                
            </div>      
        <!-- Optional JavaScript -->
        <!-- jQuery first, then Popper.js, then Bootstrap JS -->
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
        <script src="./public/js/yoda_style.js"></script>
        <script src="./public/js/tinymce/jquery.tinymce.min.js"></script>
        <script src="./public/js/tinymce/tinymce.min.js"></script>
        <script src="./public/js/capFirst.js"></script>
        <script src="./public/js/notif.js"></script>
        <script>
            tinymce.init({
                selector: "#textarea",
                height:450,
                contextmenu: false,
                plugins: "textcolor link",
                font_formats: "Sans Serif = arial, helvetica, sans-serif;Serif = times new roman, serif;Fixed Width = monospace;Wide = arial black, sans-serif;Narrow = arial narrow, sans-serif;Comic Sans MS = comic sans ms, sans-serif;Garamond = garamond, serif;Georgia = georgia, serif;Tahoma = tahoma, sans-serif;Trebuchet MS = trebuchet ms, sans-serif;Verdana = verdana, sans-serif",
                toolbar: "fontselect | fontsizeselect | bold italic underline | forecolor | numlist bullist | alignleft aligncenter alignright alignjustify | outdent indent | link unlink | undo redo"
            });
        </script>
       
                     
    </body>

</html>