<div class="modal-dialog cardInput" role="document">
    <div class="modal-content">
      <div class="modal-header" style="background-color:rgb(216, 216, 216);">
        <h5 class="modal-title" id="exampleModalLabel">Mot de passe oublié</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body cardInput" style="background-color:#f7f7f7">
        <p>Veuillez renseigner votre adresse eMail dans le champ ci-dessous. Un mail automatique vous sera envoyé avec votre nouveau mot de passe.</p>

        <div class="d-flex col-md-12">
                
            <span class="iconLogin"><i class="far fa-address-card"></i></span>
            <input class="loginInput" id="forgetEmail" type="email" placeholder="Adresse eMail" autocomplete="nope">
        </div>
        
        <div id='confirmReset' class="alert d-none col-12 text-center" style="margin-top:15px;"></div>
        <div id='alertReset' class="alert d-none col-12 text-center" style="margin-top:15px;"></div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-danger" data-dismiss="modal">Annuler</button>
        <button type="button" class="btn btn-success" id="resetPassword">Réinitialiser le mot de passe</button>
        
    </div>
  </div>
</div>