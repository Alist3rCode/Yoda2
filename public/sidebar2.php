<nav class="sidebar <?php require 'public/checkCollapse.php'?> hideInMobile" id="sidebar">
        <div class="sidebar-header">
            <h3 class="title">
                <p>Yohann</p>
                <p>Optimized</p>
                <p>Direct links to</p>
                <p>Applications
                    <?php
                    $res = $bdd->queryObj('SELECT * FROM CFG_CONFIG');
                    echo ' v' . $res[0]->CFG_VERSION;
                    ?></p> 
            </h3>
            <div class="collapseTitle">
                <p>Y.O.D.A</p>
               <?=' v'. $res[0]->CFG_VERSION?>
            </div>
        </div>
    <br>

    <ul class="list-unstyled components sidebarUl">
        <a href="index.php">
            <li id="sidebar_index">
                <i class="fas fa-home"></i>
                <span class="sidebarLabel"> Home</span> 
            </li>
        </a>
        <a href="yoda.php">
            <li  id="sidebar_yoda">
                <i class="fas fa-th"></i>
                <span class="sidebarLabel"> Clients</span> 
            </li>
        </a>
        <a href="map.php">
            <li id="sidebar_map">
                <i class="fas fa-globe-africa"></i>
                <span class="sidebarLabel"> Carte</span> 
            </li>
        </a>
        <a href="interne.php">
            <li id="sidebar_interne">
                <i class="fas fa-link"></i>
                <span class="sidebarLabel"> Lien Interne</span> 
           </li>
        </a>
 
    </ul>
    
      
    <ul class="list-unstyled components">
        <a href="profil.php">
            <li id="sidebar_profil">
                <i class="fas fa-users"></i>
                <span class="sidebarLabel"> Profil</span> 
            </li>
        </a>
        <a href="notif.php">
            <li id="sidebar_notif">
                <i class="fas fa-bell"></i>
                <span class="sidebarLabel"> Notifications</span> 
            </li>
        </a>
        <a href="planning.php">
            <li id="sidebar_planning">
                <i class="far fa-calendar-alt"></i>
                <span class="sidebarLabel"> Planning Support</span> 
            </li>
        </a>
        <a href="public/logout.php" >
            <li>
                <i class="fas fa-sign-out-alt" style="color:red!important"></i>
                <span class="sidebarLabel" > Déconnexion</span> 
            </li>
        </a>
    </ul>
    <button type="button" id="sidebarCollapse" class="btn btn-info ">
        <i id="toogleSidebar" class="fas fa-angle-left"></i>
    </button>
</nav>
    