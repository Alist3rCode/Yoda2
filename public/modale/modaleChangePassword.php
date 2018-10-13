<div class="modal-dialog cardInput" role="document">
    <div class="modal-content cardInput">
      <div class="modal-header" style="background-color:rgb(216, 216, 216);">
        <h5 class="modal-title">Changement de mot de passe</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body cardInput" style="background-color:#f7f7f7"><p>Votre mot de passe a expiré (délai de 90 jours), vous devez le modifier.</p> <br>
        <p>Veuillez renseigner votre ancien mot de passe, puis le nouveau deux fois (pour le confirmer). Le nouveau mot de passe ne peut être identique à l'ancien.</p>

        
        <div class="d-flex col-md-12">
                
            <span class="iconLogin"><i class="fas fa-user-clock"></i></span>
            <input class="loginInput" id="newPassword_Old" type="password" placeholder="Ancien mot de passe" autocomplete="nope">
        </div>
        <div class="d-flex col-md-12">
                
            <span class="iconLogin"><i class="fas fa-unlock-alt"></i></span>
            <input class="loginInput" id="newPassword_New" type="password" placeholder="Nouveau mot de passe" autocomplete="nope">
        </div>
        <div class="d-flex col-md-12">
                
            <span class="iconLogin"><i class="fas fa-lock"></i></span>
            <input class="loginInput" id="newPassword_Confirm" type="password" placeholder="Confirmez..." autocomplete="nope">
        </div>
        
        </div>
        <div id='confirmNewPassword' class="alert d-none col-12 text-center" style="margin-top:15px;"></div>
        <div id='alertNewPassword' class="alert d-none col-12 text-center" style="margin-top:15px;"></div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-danger" data-dismiss="modal">Annuler</button>
        <button type="button" class="btn btn-success" id="submitNewPassword">Changer le mot de passe</button>
        
    </div>
  </div>