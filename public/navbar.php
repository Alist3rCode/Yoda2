<!--<div class="menu">
    
    
    <div class="filters navbar ml-auto row">
        <ul>
            <li>
                <a href="#">Filtre version</a>
            </li>
            <li>
                <a href="#">Filtre activité</a>
            </li>
        </ul>
        
        
        <div class="input-group btn-group" role="group">
            <?php // if(in_array("rgt_cod_add_client", $right)):?>
            <button type="button" class="btn btn-outline-success createIcon"  id="create" data-toggle="modal" data-target="#myModal"><i class="fa fa-fw fa-plus-circle"></i></button>
            <?php // endif;?>
            <input id="searchBar"  type="text" class="form-control searchBar" placeholder="Recherche...">
            <button class="btn btn-outline-success " id="resetSearch" ><i class="fa fa-fw fa-times"></i></button>
        </div>
    </div>

</div>-->

<nav class=" menu navbar navbar-expand-lg navbar-light bg-light">
    <span class="logo">
        <img src="public/img/yoda.png">
    </span>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav ml-auto">
            <li class="nav-item active">
                <a class="nav-link" href="#">Filtre Version</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="#">Filtre Activité</a>
            </li>
        </ul>
        
        <div class="form-inline my-2 my-lg-0 btn-group">
            <button type="button" class="btn btn-success createIcon"  id="create" data-toggle="modal" data-target="#modaleClient">
                <i class="fa fa-fw fa-plus-circle"></i>
            </button>
            <input id="searchBar"  type="text" class="form-control searchBar" placeholder="Recherche...">
            <button class="btn btn-success " id="resetSearch" ><i class="fa fa-fw fa-times"></i></button>
        </div>
                    <button type="button" class="btn btn-outline-secondary"  id="helpMePlease" data-toggle="modal" data-target="#modalHelp" style="margin-left:15px;"><i class="fa fa-fw fa-question-circle"></i></button>

<!--        <div class="input-group btn-group form-inline my-2 my-lg-0" role="group">
            <?php // if(in_array("rgt_cod_add_client", $right)):?>
            <button type="button" class="btn btn-outline-success createIcon"  id="create" data-toggle="modal" data-target="#myModal"><i class="fa fa-fw fa-plus-circle"></i></button>
            <?php // endif;?>
            <input id="searchBar"  type="text" class="form-control searchBar" placeholder="Recherche...">
            <button class="btn btn-outline-success " id="resetSearch" ><i class="fa fa-fw fa-times"></i></button>
        </div>-->
    </div>
</nav>

<div class="modal fade bd-example-modal-lg" id="modalHelp" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
          <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Trucs et Astuces</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
              <div class="modal-body">
                
                <small class="text-muted">Lors de la frappe, il est possible d'utiliser certaines touches pour effectuer des actions rapides sur la vignette sélectionnée par le halo vert.</small> 
                <br>
            
                <table class="table table-hover">
                  <thead>
                    <tr>
                      
                      <th scope="col">Touche</th>
                      <th scope="col">Raccourci</th>
                      
                    </tr>
                  </thead>
                  <tbody>
                    <tr>
                      <td>Entrée</td>
                      <td>Ouvrir l'URL du client</td>
                      
                    </tr>
                    <tr>
                      <td>Ctrl + Entrée</td>
                      <td>Ouvrir la base de donnée du client soumis à droit</td>
                      
                    </tr>
                    <tr>
                      <td>Echap</td>
                      <td>Efface le texte renseigné dans la barre de recherche</td>
                      
                    </tr>
                    <tr>
                      <td><i class="fa fa-arrow-right"></i></td>
                      <td>Naviguer vers la droite sur les vignette affichées</td>
                      
                    </tr>
                    <tr>
                      <td><i class="fa fa-arrow-left"></i></td>
                      <td>Naviguer vers la gauche sur les vignette affichées</td>
                    </tr>
                    <tr>
                      <td><i class="fa fa-arrow-down"></i></td>
                      <td>Ouvrir la liste des numéros de téléphones / sites du client</td>
                    </tr>
                    <tr>
                      <td><i class="fa fa-arrow-up"></i></td>
                      <td>Fermer la liste des numéros de téléphones / sites du client</td>
                    </tr>
                  </tbody>
                </table>
                
              </div>
              
            </div>
          </div>
        </div>