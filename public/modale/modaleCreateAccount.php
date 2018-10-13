<div class="modal-dialog cardInput" role="document">
    <div class="modal-content cardInput">
        <div class="modal-header" style="background-color:rgb(216, 216, 216);">
            <h5 class="modal-title" >Création d'un compte</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <div class="modal-body col-12 cardInput" style="display:flex; flex-flow:row wrap;background-color:#f7f7f7">
            <p>Tout compte créé par cette interface disposera des droits minimum sur l'application. Il sera nécessaire de contacter l'administrateur afin d'acquerir les droits supplémentaires lié à votre fonction.
            Le mot de passe doit contenir 10 caractères, un chiffre, une majuscule, une minuscule, et un caractère spécial.</p>
        <div class="d-flex col-md-6">
                
            <span class="iconLogin"><i class="fas fa-address-card"></i></span>
            <input class="loginInput" id="createName" type="text" placeholder="Prénom" autocomplete="nope">
        </div>
        <div class="d-flex col-md-6">
                
            <span class="iconLogin"><i class="far fa-address-card"></i></span>
            <input class="loginInput" id="createLastName" type="text" placeholder="Nom" autocomplete="nope">
        </div>
        <div class="d-flex col-md-12">
                
            <span class="iconLogin"><i class="fas fa-at"></i></span>
            <input class="loginInput" id="createEmail" type="email" placeholder="Adresse eMail" autocomplete="nope">
        </div>
        <div class="d-flex col-md-12">
                
            <span class="iconLogin"><i class="fas fa-unlock-alt"></i></span>
            <input class="loginInput" id="createPassword" type="password" placeholder="Mot de Passe" autocomplete="nope">
        </div>
        <div class="d-flex col-md-12">
                
            <span class="iconLogin"><i class="fas fa-lock"></i></i></span>
            <input class="loginInput" id="createConfirmPassword" type="password" placeholder="Confirmer Mot de Passe" autocomplete="nope">
        </div>
        
        <div class="col-12 form-group">
            
            <select class="custom-select" id="defaultPage">
                <option value="0" selected>Page par défaut...</option>
                <option value="Dashboard">Dashboard</option>
                <option value="Clients">Clients</option>
                <option value="Carte">Carte</option>
                <option value="Interne">Liens Interne</option>
            </select>
        </div>
        <div id='alertCreate' class="alert d-none col-12 text-center" style="margin-top:15px;"></div>
        <div id='confirmCreate' class="alert d-none col-12 text-center" style="margin-top:15px;"></div>
      </div>
      
      <div class="modal-footer">
        <button type="button" class="btn btn-danger" data-dismiss="modal">Annuler</button>
        <button type="button" class="btn btn-success" id="createAccount">Créer le compte</button>
        
      </div>
      
      </div>
    </div>
  </div>