<?php
session_start();

header('Content-Type: text/html; charset=utf-8');
require 'class/Autoloader.php';
Autoloader::register();

$bdd = new Database('yoda');
$bdd2 = new Database('ecsupgrader');

require_once('./class/checkCookie.php');
checkCookie($bdd,'mdp.php');
    

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
            
            <div class="clients" style="display:block;">
                      
                <div class="text-center" >
                    <div class="input-group col-lg-6 col-12" style="margin-left: auto;margin-right: auto;margin-top: 15px;">

                        <input type="password" class ="form-control col-12" id="motDePasseNormal" placeholder="Mot de Passe" >
                        <div class="input-group-append">
                            <span class="input-group-text" id="eye">
                                <i class="fa fa-eye-slash"></i>
                            </span>
                        </div>
                    </div>
        
        
                    <div class="collapse col-lg-6 col-sm-12" id="collapseGenerator" style="margin-left: auto;margin-right: auto;margin-top: 15px;">
                        <div class="card card-body" style="display:flex;flex-flow:row wrap;">
                            <span class="col-12">Sélectionnez les options de votre mot de passe sécurisé : </span>

                            <div class="btn-group-toggle col-lg-4 col-sm-12" data-toggle="buttons" style="margin-top:15px;" >
                                <label class="btn btn-outline-secondary" style="width:100%;" id="numbers">
                                    <input type="checkbox" checked autocomplete="off"  >Chiffres
                                </label>
                            </div>
                            <div class="btn-group-toggle col-lg-4 col-sm-12" data-toggle="buttons" style="margin-top:15px;">
                                <label class="btn btn-outline-secondary " style="width:100%;" id='mini'>
                                    <input type="checkbox" checked autocomplete="off" >Minuscules
                                </label>
                            </div>
                            <div class="btn-group-toggle col-lg-4 col-sm-12" data-toggle="buttons" style="margin-top:15px;">
                                <label class="btn btn-outline-secondary " style="width:100%;" id='maj'>
                                    <input type="checkbox" checked autocomplete="off" >Majuscules
                                </label>
                            </div>
                            <div class="btn-group-toggle col-lg-6 col-sm-12" data-toggle="buttons" style="margin-top:15px;">
                                <label class="btn btn-outline-secondary " style="width:100%;" id='spec'>
                                    <input type="checkbox" checked autocomplete="off" > Caractères Spéciaux
                                </label>
                            </div>
                            <div class="btn-group-toggle col-lg-6 col-sm-12" data-toggle="buttons" style="margin-top:15px;">
                                <label class="btn btn-outline-secondary active" style="width:100%;" id='simi'>
                                    <input type="checkbox" checked autocomplete="off" > Caractères Similaires
                                </label>
                            </div>

                            <div class="input-group col-12" style="margin-top:15px;">
                                <div class="input-group-prepend ">
                                    <label class="input-group-text" >Caractères : </label>
                                </div>
                                <input type="text" class="form-control" placeholder="4 - 255" id='nbCarac'>


                            </div>
                            <div class="alert alert-danger col-12" style="margin-left: auto;margin-right: auto;margin-top: 15px;" id="alertCreate"></div>
                        </div>
                        <button type="button" class="btn btn-success col-12" id="createPassword" style="margin-top:15px; margin-right:15px;">Créer</button>
                    </div>

                    <div class="col-12">
                        <button type="button" class="btn btn-light col-sm-12 col-lg-2" id="createGeneratePassword" style="margin-top:15px; margin-right:15px;" data-toggle="collapse" data-target="#collapseGenerator" aria-expanded="false" aria-controls="collapseGenerator">Générer</button>
                        <button type="button" class="btn btn-info col-sm-12 col-lg-2" id="validGeneratePassword" style="margin-top:15px; margin-right:15px;">Crypter</button>
                        <button type="button" class="btn btn-primary col-sm-12 col-lg-2" id="copyGeneratePassword" style="margin-top:15px">Copier</button> 
                    </div>

                    <div class="col-lg-6 col-sm-12 card sha1-md5 mt-3 mx-auto" id="losMotdePassos">
                        <div class="card-body">
                            <span class="font-weight-bold">SHA1 : </span><span id="sha1Pass"></span><br/>
                            <span class="font-weight-bold">MD5 : </span><span id="md5Pass"></span>

                        </div>
                    </div>



                        <div class="alert alert-success col-lg-6 col-sm-12 alertCopy" id="alertCopy"></div>

                    </div>
            </div>      
        <!-- Optional JavaScript -->
        <!-- jQuery first, then Popper.js, then Bootstrap JS -->
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
        <script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCo_lLa3e8UeMBQdc6EYS5Wbw7udYxl3_o&callback=initMap"></script>
        <script src="./public/js/maps.js"></script>
        <script src="./public/js/initAddons.js"></script>
        <script>
    
        $("#alertCopy").hide();
        $("#alertCreate").hide();
        $("#losMotdePassos").hide();
       
        
        $('#validGeneratePassword').click(function(){
    
            var array = [] ;
            var motDePasse = document.getElementById('motDePasseNormal').value;
                $.post("ajax/login/generatePassword.php", 
                    {mdp: motDePasse}, 
                    function(ok){
                        ok = JSON.parse(ok);
                        
                        document.getElementById('sha1Pass').innerText = ok[0];
                        document.getElementById('md5Pass').innerText = ok[1];
                        
                });
            $("#losMotdePassos").slideDown(125);
        });
        
        
        $('#copyGeneratePassword').click(function(){
            // Create a new textarea element and give it id='t'
            let textarea = document.createElement('textarea')
            textarea.id = 't'
            // Optional step to make less noise on the page, if any!
            textarea.style.height = 0
            // Now append it to your page somewhere, I chose <body>
            document.body.appendChild(textarea)
            // Give our textarea a value of whatever inside the div of id=containerid
            textarea.value = document.getElementById("losMotdePassos").innerText
            // Now copy whatever inside the textarea to clipboard
            let selector = document.querySelector('#t')
            selector.select()
            document.execCommand('copy')
            // Remove the textarea
            document.body.removeChild(textarea)
            
            $("#alertCopy").html('Texte copié dans le presse papier');
            $("#alertCopy").fadeTo(1000, 500).slideUp(500, function(){
                $("#alertCopy").slideUp(500);
            });
        });
        
        
        $('#createGeneratePassword').click(function(){
            $("#losMotdePassos").fadeTo(0, 500).slideUp(125, function(){
                    $("#losMotdePassos").slideUp(125);
                });
        });
        
        
        
        $('#createPassword').click(function(){
    
            var array = [] ;
            
            var numbers = document.getElementById('numbers').classList.contains('active');
            // console.log(numbers);
            var mini = document.getElementById('mini').classList.contains('active');
            // console.log(mini);
            var maj = document.getElementById('maj').classList.contains('active');
            // console.log(maj);
            var spec = document.getElementById('spec').classList.contains('active');
            // console.log(spec);
            var simi = document.getElementById('simi').classList.contains('active');
            // console.log(simi);
            var nbCarac = document.getElementById('nbCarac').value;
            
            var flag = 0;
            var errors = [];
            var regex = /^([4-9]|[1-9][0-9]|[1-2][0-5][0-9])$/;
            
            
            var match = regex.test(nbCarac);
            
            
            if(!match){
                errors.push('Merci de choisir un nombre de caratère valide entre 4 et 255');
                flag = 1;
            }
            if(numbers == false && mini == false && maj == false && spec == false){
                errors.push('Merci de choisir un type de caratère contenu dans le mot de passe');
                flag = 1;
            }
            
           if (flag == 1) {
                
                flag = '';
                $("#alertCreate").html(errors.join("<br>"));
                $("#alertCreate").fadeTo(3000, 500).slideUp(500, function(){
                    $("#alertCreate").slideUp(500);
                });
                
            } else {
                    
                $.post("ajax/login/createPassword.php", 
                    {numbers: numbers, mini: mini, maj: maj, spec: spec, simi: simi, nbCarac: nbCarac}, 
                    function(ok){
                        document.getElementById('motDePasseNormal').value = ok;
                        
                });
            }
        });
        
        $('#eye').click(function(){
            var input = document.getElementById('motDePasseNormal');
            var eye = document.getElementById('eye');
         
            if (input.type == 'text'){
                $('#motDePasseNormal').attr('type', 'password');
                eye.innerHTML = '<i class="fa fa-eye-slash"></i>'
            }else if (input.type == 'password'){
                $('#motDePasseNormal').attr('type', 'text');
                eye.innerHTML = '<i class="fa fa-eye"></i>'
            }
        });
        
        
        
    </script>
        
        
        
    </body>

</html>