<nav class="sidebar <?php require 'public/checkCollapse.php'?>" id="sidebar">
        <div class="sidebar-header">
            <h3 class="title">
                <p>Yohann</p>
                <p>Optimized</p>
                <p>Direct links to</p>
                <p>Applications
                    <?php
                    $res = $bdd->queryObj('SELECT * FROM YDA_CONFIG');
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
        <li id="sidebar_index">
            <a href="index.php">
                <i class="fas fa-home"></i>
                <span class="sidebarLabel"> Home</span> 
            </a>
        </li>
        <li  id="sidebar_yoda">
            <a href="yoda.php">
                <i class="fas fa-th"></i>
                <span class="sidebarLabel"> Clients</span> 
            </a>
        </li>
        <li id="sidebar_map">
            <a href="map.php">
                <i class="fas fa-globe-africa"></i>
                <span class="sidebarLabel"> Carte</span> 
            </a>
        </li>
        <li id="sidebar_interne">
            <a href="interne.php">
                <i class="fas fa-link"></i>
                <span class="sidebarLabel"> Lien Interne</span> 
            </a>
        </li>
    </ul>
        <hr>
        <ul class="list-unstyled components">
            <li id="sidebar_profil">
                <a href="profil.php">
                    <i class="fas fa-users"></i>
                    <span class="sidebarLabel"> Profil</span> 
                </a>
            </li>
            <li id="sidebar_notif">
                <a href="notif.php">
                    <i class="fas fa-bell"></i>
                    <span class="sidebarLabel"> Notifications</span> 
                </a>
            </li>
            <li id="sidebar_planning">
                <a href="planning.php">
                    <i class="far fa-calendar-alt"></i>
                    <span class="sidebarLabel"> Planning Support</span> 
                </a>
            </li>
            <li>
                <a href="public/logout.php" >
                    <i class="fas fa-sign-out-alt" style="color:red!important"></i>
                    <span class="sidebarLabel" > Déconnexion</span> 
                </a>
            </li>
        </ul>
        <button type="button" id="sidebarCollapse" class="btn btn-info ">
            <i id="toogleSidebar" class="fas fa-angle-left"></i>
        </button>
    </nav>
    