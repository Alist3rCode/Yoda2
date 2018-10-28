<?php
session_start();

header('Content-Type: text/html; charset=utf-8');
require 'class/Autoloader.php';
Autoloader::register();

$bdd = new Database('yoda');
$bdd2 = new Database('ecsupgrader');

require_once('./class/checkCookie.php');
checkCookie($bdd,'planning.php');

require_once('./class/checkRights.php');
$right = checkRights($bdd,$_SESSION['id_user']);

require('./public/fetchInfoPlanning.php');

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
        <link rel="stylesheet" href="public/css/modale.css">
        <link rel="stylesheet" href="public/css/login.css">
        <link rel="stylesheet" href="public/css/calendar.css">
        <link rel="stylesheet" href="public/css/planning_css.php?month=<?=$monthGet?>&year=<?=$yearGet?>">
        
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
                
		<div class="d-flex flex-row align-items-center justify-content-between mx-sm-3">
		    <h1 style="color:white;"><?=$month->toString();?></h1>
		    <div>
		        <?php if(in_array("rgt_cod_planning_config", $right)):?>
                        <btn class="btn btn-light" onclick='displayModaleConfig()'>
                            <i class="fas fa-users-cog"></i>
                        </btn>
                        <?php endif;?>
    		    <a href="planning.php?month=<?=$month->previousMonth()->month;?>&year=<?=$month->previousMonth()->year;?>" class="btn btn-primary">&lt;</a>
    		    <a href="planning.php?month=<?=$month->nextMonth()->month;?>&year=<?=$month->nextMonth()->year;?>" class="btn btn-primary">&gt;</a>
		    </div>
		</div>
		
		    
		  
                <table class="calendar__table calendar__table--<?=$weeks?>weeks">
                    <?php for($i =0; $i< $weeks;$i++):?>
                    <tr>
                        <?php foreach($workingDays as $k =>$day):
                            $startClone2 = clone $start;
                            $date = $startClone2->modify("+". ($k + $i * 7). " days");
                            if(isset($events[$date->format("Y-m-d")])){
                                $eventForDay = $events[$date->format("Y-m-d")];
                            }else{
                                $eventForDay = [];
                            }
                        ?>

                            <td class="<?= $month->withinMonth($date) ? '' : 'calendar__othermonth'; ?>">
                                <div class="d-flex flex-row align-items-center justify-content-between">
                                    <?php if($i ==0):?>
                                        <div class="calendar__weekday"><?=$day?></div>
                                    <?php endif;?>
                                    <div class="calendar__day text-right <?php if($date->format('Y-m-d') === date("Y-m-d")){echo 'today';}?>" ><?= $date->format('d');?></div>
                                </div>

                                <div class="grid" id='<?php if($date->format('Y-m-d') === date("Y-m-d")){echo 'today';}?>'>
                                    <?php foreach($eventForDay as $key=>$event):?>
                                    <div class="<?=$event->SCO_CODE?> tech <?=$event->USR_SURNAME?>"><?php echo $event->USR_SURNAME .' - '. $event->SCO_CODE;?></div>

                                    <?php endforeach;?>
                                    <div class="hour mx-sm-1">
                                        <div class="start"><?=$arrayPlanning['start']->format('H:i');?></div>
                                        <div class="startJquery d-none"><?=$arrayPlanning['start']->format('H');?></div>
                                        <div class="middle">12</div>
                                        <div class="end"><?=$arrayPlanning['stop']->format('H:i');?></div>

                                    </div>
                                </div>
                           </td>
                        <?php endforeach;?>
                    </tr>

                    <?php endfor;?>
                </table>
                
                
            </div>     
            
            
            <div class="modal fade" id="modaleConfigPlanning" tabindex="-1" role="dialog" aria-hidden="true">
                
            </div>
            
        <!-- Optional JavaScript -->
        <!-- jQuery first, then Popper.js, then Bootstrap JS -->
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
        <script src="./public/js/yoda_style.js"></script>
        <script src="./public/js/displayAlert.js"></script>
        <script src="./public/js/planning.js"></script>

       
                     
    </body>

</html>