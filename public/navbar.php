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
            <button type="button" class="btn btn-outline-success createIcon"  id="create" data-toggle="modal" data-target="#myModal">
                <i class="fa fa-fw fa-plus-circle"></i>
            </button>
            <input id="searchBar"  type="text" class="form-control searchBar" placeholder="Recherche...">
            <button class="btn btn-outline-success " id="resetSearch" ><i class="fa fa-fw fa-times"></i></button>
        </div>
<!--        <div class="input-group btn-group form-inline my-2 my-lg-0" role="group">
            <?php // if(in_array("rgt_cod_add_client", $right)):?>
            <button type="button" class="btn btn-outline-success createIcon"  id="create" data-toggle="modal" data-target="#myModal"><i class="fa fa-fw fa-plus-circle"></i></button>
            <?php // endif;?>
            <input id="searchBar"  type="text" class="form-control searchBar" placeholder="Recherche...">
            <button class="btn btn-outline-success " id="resetSearch" ><i class="fa fa-fw fa-times"></i></button>
        </div>-->
    </div>
</nav>