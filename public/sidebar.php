<div class="sidebar ">
                
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
    <br>
    <a href="#"><span class="nav-label">Dashboard</span></a>
    <a href="#"><span class="nav-label">Clients</span></a>
    <a href="#"><span class="nav-label">Carte</span></a>
    <a href="#"><span class="nav-label">Lien Interne</span></a> 
    <hr> 
    <a href="#"><span class="nav-label">Profil</span></a>
    <a href="#"><span class="nav-label">Notifications</span></a>
    <a href="#"><span class="nav-label">Planning Support</span></a>
    <a href="#"><span class="nav-label">Déconnexion</span></a> 
    
    <a href="#" class="btn-expand-collapse" style="position: absolute;
    bottom: 0;"><span class="fas fa-2x fa-arrow-left"></span></a>
    
</div>