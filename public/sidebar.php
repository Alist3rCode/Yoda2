<div class="sidebar">
                
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
    <a href="#">Dashboard</a>
    <a href="#">Clients</a>
    <a href="#">Carte</a>
    <a href="#">Lien Interne</a> 
    <hr>
    <a href="#">Profil</a>
    <a href="#">Notifications</a>
    <a href="#">Planning Support</a>
    <a href="#">Déconnexion</a> 
    
    
    
    
</div>