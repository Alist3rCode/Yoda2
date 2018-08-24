<nav class="sidebar" id="sidebar">
        <div class="sidebar-header">
            <h3 class="title">
            <p>Yohann</p>
            <p>Optimized</p>
            <p>Direct links to</p>
            <p>Applications
            <?php
            $res = $db->query('SELECT * FROM YDA_CONFIG', 'Clients');
            echo ' v'. $res[0]->CFG_VERSION;
            ?></p> 
            </h3>
        </div>
    <br>

        <ul class="list-unstyled components">
            <li>
                <a href="#">
                    <i class="fas fa-home"></i>
                    <span class="sidebarLabel">Home</span> 
                </a>
            </li>
            <li class="active">
                <a href="#">
                    <i class="fas fa-user"></i>
                    <span class="sidebarLabel">Clients</span> 
                </a>
            </li>
            <li>
                <a href="#">
                    <i class="fas fa-globe-americas"></i>
                    <span class="sidebarLabel">Carte</span> 
                </a>
            </li>
            <li>
                <a href="#">
                    <i class="fas fa-link"></i>
                    <span class="sidebarLabel">Lien Interne</span> 
                </a>
            </li>
        </ul>
        <hr>
        <ul class="list-unstyled components">
            <li>
                <a href="#">
                    <i class="fas fa-users"></i>
                    <span class="sidebarLabel">Profil</span> 
                </a>
            </li>
            <li>
                <a href="#">
                    <i class="fas fa-bell"></i>
                    <span class="sidebarLabel">Notifications</span> 
                </a>
            </li>
            <li>
                <a href="#">
                    <i class="far fa-calendar-alt"></i>
                    <span class="sidebarLabel">Planning Support</span> 
                </a>
            </li>
            <li>
                <a href="#">
                    <i class="fas fa-sign-out-alt"></i>
                    <span class="sidebarLabel">Déconnexion</span> 
                </a>
            </li>
        </ul>
        <button type="button" id="sidebarCollapse" class="btn btn-info">
            <i id="toogleSidebar" class="fas fa-angle-left"></i>
        </button>

    </nav>
