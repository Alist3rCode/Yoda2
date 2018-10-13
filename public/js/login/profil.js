$("#resetProfil").click(function(evt) {
    evt.preventDefault();
    var name = document.getElementById('updateName');
    var lastName = document.getElementById('updateLastName');
    var email = document.getElementById('updateEmail');
    var password = document.getElementById('updatePassword');
    var passwordConfirm = document.getElementById('updateConfirmPassword');
    var page = document.getElementById('updatePage');
    var id_user = document.getElementById('id_user').innerHTML;

    $.post("ajax/loadUser.php", {
        id: id_user
    },
    function(retour) {

        name.value = capFirst(retour['name']);
        lastName.value = capFirst(retour['lastName']);
        email.value = retour['email'];
        page.value = retour["page"];
        password.value = '';
        passwordConfirm.value = '';

    });
});

$("#actifUser").click(function(evt) {
    if (document.getElementById('droitActifUser').innerHTML == 'OK') {

        var active = 2;
        var id_user = document.getElementById('selectedUser').innerHTML;
        console.log(id_user);

        if (this.classList.contains('active')) {
            this.classList.remove('active');
            this.classList.add('d-none');
            document.getElementById('desactifUser').classList.add('active');
            document.getElementById('desactifUser').classList.remove('d-none');
            active = 0;

        }
        else if (!this.classList.contains('active')) {
            this.classList.add('active');
            active = 2;
        }
        console.log(active);
        $.post("ajax/updateProfil.php", {
            id: id_user,
            actif: active,
            mode: 'active'
        },
        function(retour) {
            if (retour == 'ok' && active == 2) {
                displayAlert('confirmAdminModif','success',"L'utilisateur a bien été activé");
                
                $.post("ajax/notif/notifMailActiveAccount.php", {id: id_user});

            }
            else if (retour == 'ok' && active == 0) {
                displayAlert('confirmAdminModif','success',"L'utilisateur a bien été désactivé");
            }
        });
    }
});