$("#resetProfil").click(function(evt) {
    evt.preventDefault();
    var name = document.getElementById('updateName');
    var lastName = document.getElementById('updateLastName');
    var email = document.getElementById('updateEmail');
    var password = document.getElementById('updatePassword');
    var passwordConfirm = document.getElementById('updateConfirmPassword');
    var page = document.getElementById('updatePage');
    var id_user = document.getElementById('idUser').innerHTML;

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

$("#desactifUser").click(function(evt) {
    if (document.getElementById('droitActifUser').innerHTML == 'OK') {

        var active = 2;
        var id_user = document.getElementById('selectedUser').innerHTML;

        if (this.classList.contains('active')) {
            this.classList.remove('active');
            this.classList.add('d-none');
            document.getElementById('actifUser').classList.add('active');
            document.getElementById('actifUser').classList.remove('d-none');
            active = 1;
        }

        $.post("ajax/updateProfil.php", {
            id: id_user,
            actif: active,
            mode: 'active'
        },
        function(retour) {
            if (retour == 'ok') {
                displayAlert('confirmAdminModif','success',"L'utilisateur a bien été réactivé");
                
            }
        });
    }
});

$("#divDropDown").on('show.bs.dropdown', function() {

    if (document.getElementById('listUser').innerHTML == '') {
        document.getElementById('listUser').innerHTML = 'ALL';
    }

    $.post("ajax/loadAllUser.php", {
        id: document.getElementById('listUser').innerHTML,
        mode : 'profil'
    },
    function(retour) {
        var arrayLength = retour.length;
        document.getElementById('dropDownUser').innerHTML = '';
        for (var idx = 0; idx < arrayLength; idx++) {

            document.getElementById('dropDownUser').innerHTML += "<li class='dropdown-item dropdownUserLi' id='user-" + retour[idx]['id'] 
                    + "' onclick='selectUserToModif(" + retour[idx]['id'] + ")' style='color:" + retour[idx]['color'] + ";'>" 
                    + capFirst(retour[idx]['name']) + " " + capFirst(retour[idx]['lastName']) + " - " + capFirst(retour[idx]['profil']) + "</li>";
        }
    });
});

function selectUserToModif(id_select) {
    var idLigne = document.getElementById('user-' + id_select);
    document.getElementById('searchUser').value = idLigne.innerHTML;
    document.getElementById('selectedUser').innerHTML = id_select;

    var name = document.getElementById('updateAdminName');
    var nameSelect = document.getElementById('nameSelected');
    var lastName = document.getElementById('updateAdminLastName');
    var lastNameSelect = document.getElementById('lastNameSelected');
    var email = document.getElementById('updateAdminEmail');
    var password = document.getElementById('updateAdminPassword');
    var passwordConfirm = document.getElementById('updateAdminConfirmPassword');
    var page = document.getElementById('updateAdminPage');
    var profil = document.getElementById('profilSelected');
    var profilUser = document.getElementById('configUserProfil');
    var surname = document.getElementById('updateAdminSurname');
    
    var unselectedRightsUser = document.getElementById('unselectedRightsUser');
    var selectedRightsUser = document.getElementById('selectedRightsUser');

    document.getElementById('activeOrNot').classList.remove('invisible');
	
    $.post("ajax/loadUser.php", {
        id: id_select
    },
    function(retour) {
        name.value = capFirst(retour['name']);
        nameSelect.innerHTML = capFirst(retour['name']);
        lastName.value = capFirst(retour['lastName']);
        lastNameSelect.innerHTML = capFirst(retour['lastName']);
        profil.innerHTML = retour['profil'];
        profilUser.value = retour['profil'];
        document.getElementById('configUserProfil').dataset.id = retour['idProfil'];
        email.value = retour['email'];
        page.value = retour["page"];
        password.value = '';
        passwordConfirm.value = '';
        surname.value = retour['surname'];
        unselectedRightsUser.innerHTML = '';
        selectedRightsUser.innerHTML = '';

        if (retour['actif'] == 0) {
            document.getElementById('actifUser').classList.remove('active');
            document.getElementById('actifUser').classList.remove('d-none');
            document.getElementById('desactifUser').classList.remove('active');
            document.getElementById('desactifUser').classList.add('d-none');
        }
        else if (retour['actif'] == 1) {
            document.getElementById('actifUser').classList.remove('active');
            document.getElementById('actifUser').classList.add('d-none');
            document.getElementById('desactifUser').classList.add('active');
            document.getElementById('desactifUser').classList.remove('d-none');
        }
        else if (retour['actif'] == 2) {
            document.getElementById('actifUser').classList.add('active');
            document.getElementById('actifUser').classList.remove('d-none');
            document.getElementById('desactifUser').classList.remove('active');
            document.getElementById('desactifUser').classList.add('d-none');
        }

        if(retour['isTech'] == 1){
            
            $('#isNotTech').addClass('d-none');
            $('#isTech').removeClass('d-none');

        }else{
            $('#isTech').addClass('d-none');
            $('#isNotTech').removeClass('d-none');
        }
        for (y = 0; y < retour['right'].length; y++) {
            if (retour['hook']['Profil'].includes(retour['right'][y]['id'])) {
                selectedRightsUser.innerHTML += '<li class="list-group-item list-group-item-success selectedUser" data-id=' 
                        + retour["right"][y]["id"] + ' data-type="Profil" id="selectItemUser-' + retour["right"][y]["id"] + '"><span id="nameRight' + retour["right"][y]["id"] + '">' 
                        + retour["right"][y]["name"] + ' </span><span class="text-muted"> - Profil</span></li>';
            
            }else if (retour['hook']['User'].includes(retour['right'][y]['id'])) {
                selectedRightsUser.innerHTML += '<li class="list-group-item list-group-item-success selectedUser" data-id=' 
                        + retour["right"][y]["id"] + ' data-type="User" id="selectItemUser-' + retour["right"][y]["id"] + '"  onclick="unselectRightUser(' 
                        + retour['right'][y]['id'] + ')"><span id="nameRight' + retour["right"][y]["id"] + '">' + retour["right"][y]["name"] + ' </span><span class="text-muted"> - User</span></li>';
            }
            else {
                unselectedRightsUser.innerHTML += '<li class="list-group-item list-group-item-danger unselectedUser" data-id=' 
                        + retour["right"][y]["id"] + ' id="unselectItemUser-' + retour["right"][y]["id"] + '" onclick="selectRightUser(' 
                        + retour['right'][y]['id'] + ')"><span id="nameRight' + retour["right"][y]["id"] + '">' + retour["right"][y]["name"] + '</span></li>';
            }
        }
    });
    document.getElementById('cardProfil').classList.add('d-none');
    document.getElementById('cardUser').classList.remove('d-none');

}

$("#resetAdminProfil").click(function(evt) {
    evt.preventDefault();
    var id_user = document.getElementById('selectedUser').innerHTML;
    selectUserToModif(id_user);
});

$("#updateAdminProfil").click(function(evt) {
    var name = document.getElementById('updateAdminName').value;
    var nameSelect = document.getElementById('nameSelected');
    var lastName = document.getElementById('updateAdminLastName').value;
    var lastNameSelect = document.getElementById('lastNameSelected');
    var administratorName = document.getElementById('administratorName');
    var email = document.getElementById('updateAdminEmail').value;
    var page = document.getElementById('updateAdminPage').value;
    var password = document.getElementById('updateAdminPassword').value;
    var passwordConfirm = document.getElementById('updateAdminConfirmPassword').value;
    var id_user = document.getElementById('selectedUser');
    var profilSelected = document.getElementById('profilSelected');
    var profil = document.getElementById('configUserProfil');
    var idProfil = profil.dataset.id;
    var isTech = 0;
    var hook = [];
    
    $(".selectedUser").each(function(index) {
        if($(this).data('type') == 'User'){
             hook.push($(this).data('id'));
        }
       
    });
    
   
   
    var surname = document.getElementById('updateAdminSurname');

    // console.log(document.getElementById('isNotRef').classList.contains('d-none'));
    
    if(document.getElementById('isNotTech').classList.contains('d-none')){
        isTech = 1;
    }else{
        isTech = 0;
    }
    
    var regex = /^[\w.-]+@[\w.-]+\.[a-z]{2,6}$/;
    var match = regex.test(email);
    var errors = [];
    var flag = 0;
    var flagMail = 0;
    var flagNewUser = 0;

    if (name === '') {
            errors.push('Merci de renseigner votre prénom');
            flag = 1;
    }
    if (surname.value.length != 3) {
            errors.push('Merci de renseigner un trigramme de 3 caractères');
            flag = 1;
    }
    if (lastName === '') {
            errors.push('Merci de renseigner votre nom');
            flag = 1;
    }
    if (email === '' || !match) {
            errors.push('Merci de renseigner une adresse eMail valide');
            flag = 1;
    }
    if (password != passwordConfirm) {
            errors.push('Merci de vérifier les mot de passe saisis');
            flag = 1;
            flagMail = 1;
    }

    if (id_user.innerHTML == "NEW" && password == '') {
            errors.push('Merci de vérifier les mot de passe saisis');
            flag = 1;
    }

    if (page == '0') {
            errors.push('Merci de renseigner la page par défault lors de la connexion');
            flag = 1;
    }

    if (id_user.innerHTML == "NEW" && flagMail === 0) {
        $.post("ajax/checkUser.php", {
            email: email
        },
        function(retour) {
            if (retour == 'WELCOME' || retour == 'WAIT' || retour == 'NOPE') {
                flagNewUser = 1;
                displayAlert('alertAdminModif','danger',"Cette adresse mail est déjà rattachée à un compte.");
            }
            else if (retour == 'DUNNO') {
                flagNewUser = 0;
            }
        });
    }
    if (flag === 0 && flagMail === 0 && flagNewUser == 0) {
        if (password == '') {
                password = 'PASTOUCHE';
        }
        console.log(lastName);
        $.post("ajax/updateProfil.php", {
            id: id_user.innerHTML,
            email: email,
            password: password,
            name: name,
            lastName: lastName,
            page: page,
            idProfil: idProfil,
            mode: 'update',
            isTech : isTech,
            surname : surname.value,
            hook : hook           
        },
        function(retour) {
            var testId = retour.substring(0, 3);
            if (retour == 'ok') {
                displayAlert('confirmAdminModif','success',"Les modifications apportées ont été sauvegardées.");
                
                nameSelect.innerHTML = capFirst(name);
                profilSelected.innerHTML = profil.value;
                lastNameSelect.innerHTML = capFirst(lastName);
                name.value = capFirst(name);
                lastName.value = capFirst(lastName);

                if (document.getElementById('idUser').innerHTML === document.getElementById('selectedUser').innerHTML) {
                    administratorName.innerHTML = capFirst(lastName);
                }

            }else if (testId == 'id-') {
                displayAlert('confirmAdminModif','success','Les modifications apportées ont été sauvegardées.');
                
                nameSelect.innerHTML = capFirst(name);
                lastNameSelect.innerHTML = capFirst(lastName);
                name.value = capFirst(name);
                lastName.value = capFirst(lastName);
                profilSelected.innerHTML = profil.value;

                if (document.getElementById('idUser').innerHTML == document.getElementById('selectedUser').innerHTML) {
                    administratorName.innerHTML = capFirst(lastName);
                }

                var newId = retour.split('-');
                id_user.innerHTML = newId[1];
                document.getElementById('activeOrNot').classList.remove('invisible');
                document.getElementById('actifUser').click();

            }
        });

    }else{
        displayAlert('alertAdminModif','danger',errors.join("<br>"));
    }
});

$("#newUser").click(function(evt) {
    evt.preventDefault();
    var name = document.getElementById('updateAdminName');
    var nameSelect = document.getElementById('nameSelected');
    var lastName = document.getElementById('updateAdminLastName');
    var lastNameSelect = document.getElementById('lastNameSelected');
    var email = document.getElementById('updateAdminEmail');
    var password = document.getElementById('updateAdminPassword');
    var passwordConfirm = document.getElementById('updateAdminConfirmPassword');
    var page = document.getElementById('updateAdminPage');
    var id_user = document.getElementById('selectedUser').innerHTML;
    var profilSelected = document.getElementById('profilSelected');
    var profil = document.getElementById('configUserProfil');
    var surname = document.getElementById('updateAdminSurname');   
        
    name.value = '';
    nameSelect.innerHTML = "Nouvel";
    lastName.value = '';
    lastNameSelect.innerHTML = "Utilisateur";
    profilSelected.innerHTML = "Padawan";
    profil.value = "Padawan"
    profil.dataset.id = 'profilChoose-2';
    email.value = '';
    page.value = '0';
    password.value = '';
    passwordConfirm.value = '';
    surname.value = "";

    document.getElementById('cardUser').classList.remove('d-none');
    document.getElementById('actifUser').classList.remove('active');
    document.getElementById('actifUser').classList.remove('d-none');
    document.getElementById('desactifUser').classList.add('d-none');
    document.getElementById('activeOrNot').classList.add('invisible');
    document.getElementById('desactifUser').classList.remove('active');

    document.getElementById('selectedUser').innerHTML = 'NEW';

    document.getElementById('updateAdminName').focus();

});

$("#searchUser").click(function() {
    this.value = '';
    document.getElementById('listUser').innerHTML = 'ALL';
});

$("#searchUser").keyup(function(e) {

    var search = document.getElementById('searchUser').value.toLowerCase();
    var user = document.getElementsByClassName('dropdownUserLi');
    var listUser = document.getElementById('listUser');
    if (search == '') {
        listUser.innerHTLM = 'ALL';
    }
    else {
        $.get("ajax/searchForUser.php?search=" + search, 
        function(json) {
            listUser.innerHTML = json;
            if (json.length == 1) {
                document.getElementById('dropdownMenuUser').click();
                setTimeout(function() {
                        selectUserToModif(json[0]);
                }, 250);
                // window.setTimeout(selectUserToModif(json[0]), 3000);
            }
        });
    }
});

$("#configChooseProfil").click(function(evt) {

    $.post("ajax/loadProfil.php",
    function(retour) {
        var arrayLength = retour.length;
        document.getElementById('dropdownProfil').innerHTML = '';

        for (var idx = 0; idx < arrayLength; idx++) {
                // document.getElementById('configChooseProfil').innerHTML = '<option>Profil</option>';
                document.getElementById('dropdownProfil').innerHTML += "<li class='dropdown-item dropdownProfilLi' id='profil-" 
                        + retour[idx]['id'] + "' onclick='selectProfilToModif(" + retour[idx]['id'] + ")'>" 
                        + capFirst(retour[idx]['name']) + "</li>";
        }
    });
});

$("#configUserProfil").click(function(evt) {

    $.post("ajax/loadProfil.php",
        function(retour) {
            var arrayLength = retour.length;
            document.getElementById('dropdownUserProfil').innerHTML = '';

            for (var idx = 0; idx < arrayLength; idx++) {
                    // document.getElementById('configChooseProfil').innerHTML = '<option>Profil</option>';
                    document.getElementById('dropdownUserProfil').innerHTML +=  "<li class='dropdown-item dropdownProfilLi' id='profil-" 
                            + retour[idx]['id'] + "' onclick='selectProfilUser(" + retour[idx]['id'] + ", \"" + retour[idx]['name'] + "\")'>" 
                            + capFirst(retour[idx]['name']) + "</li>";
            }
        });
});

function selectProfilUser(idProfil, nameProfil) {
    document.getElementById('configUserProfil').value = nameProfil;
    document.getElementById('configUserProfil').dataset.id = idProfil;

}

function selectProfilToModif(idProfil) {
    var idLigne = document.getElementById('profil-' + idProfil);
    document.getElementById('configChooseProfil').value = idLigne.innerHTML;
    document.getElementById('selectedProfil').innerHTML = idProfil;
    var unselectedRights = document.getElementById('unselectedRights');
    var selectedRights = document.getElementById('selectedRights');

    var name = document.getElementById('configNameProfil');
    var nameSelect = document.getElementById('profilConfSelected');

    $.post("ajax/loadConfProfil.php", {
        id: idProfil
    },
    function(retour) {
        console.log(retour);
        nameSelect.innerHTML = retour['profil']['name'];
        name.value = retour['profil']['name'];
        unselectedRights.innerHTML = '';
        selectedRights.innerHTML = '';
        if (retour['actif'] == 1) {
            document.getElementById('actifUser').classList.remove('d-none');
            document.getElementById('desactifUser').classList.add('d-none');
        }
        else if (retour['actif'] == 0) {
            document.getElementById('actifUser').classList.add('d-none');
            document.getElementById('desactifUser').classList.remove('d-none');
        }
        for (y = 0; y < retour['right'].length; y++) {
            if (retour['hook'].includes(retour['right'][y]['id'])) {
                selectedRights.innerHTML += '<li class="list-group-item list-group-item-success selected" data-id=' 
                        + retour["right"][y]["id"] + ' id="selectItem-' + retour["right"][y]["id"] + '"  onclick="unselectRight(' 
                        + retour['right'][y]['id'] + ')">' + retour["right"][y]["name"] + '</li>';
            }
            else {
                unselectedRights.innerHTML += '<li class="list-group-item list-group-item-danger unselected" data-id=' 
                        + retour["right"][y]["id"] + ' id="unselectItem-' + retour["right"][y]["id"] + '" onclick="selectRight(' 
                        + retour['right'][y]['id'] + ')">' + retour["right"][y]["name"] + '</li>';
            }
        }
        document.getElementById('cardProfil').classList.remove('d-none');
        document.getElementById('cardUser').classList.add('d-none');

    });
}

$("#resetConfigProfil").click(function(evt) {

    var idProfil = document.getElementById('selectedProfil').innerHTML;
    selectProfilToModif(idProfil);

});



$("#updateConfigProfil").click(function(evt) {

    var idProfil = document.getElementById('selectedProfil').innerHTML;
    var name = document.getElementById('configNameProfil').value;

    var hook = [];

    $(".selected").each(function(index) {
        hook.push($(this).data('id'));
    });
    // console.log(hook);

    $.post("ajax/updateConfProfil.php", {
        id: idProfil,
        name: name,
        hook: hook,
        mode: 'update'
    },
    function(retour) {
        if (retour == 'ok') {
            displayAlert('confirmProfilModif','success',"Les modifications apportées ont été sauvegardées.");
                
        }
    });

});


$("#updateConfigProfil").click(function(evt) {

    var idProfil = document.getElementById('selectedProfil').innerHTML;
    var name = document.getElementById('configNameProfil').value;
    var hook = [];

    $(".selected").each(function(index) {
        hook.push($(this).data('id'));
    });
    // console.log(hook);

    $.post("ajax/updateConfProfil.php", {
        id: idProfil,
        name: name,
        hook: hook,
        mode: 'update'
    },  
    function(retour) {
        if (retour == 'ok') {
            displayAlert('confirmProfilModif','success','Les modifications apportées ont été sauvegardées.');
        }
    });
});

$("#actifProfil").click(function(evt) {

    var active = 0;
    var idProfil = document.getElementById('selectedProfil').innerHTML;
    this.classList.add('d-none');

    document.getElementById('desactifProfil').classList.remove('d-none');
    $.post("ajax/updateConfProfil.php", {
        id: idProfil,
        valid: active,
        mode: 'valid'
    },
    function(retour) {
        if (retour == 'ok') {
            displayAlert('confirmProfilModif','success','Le profil a bien été désactivé.');
        }
    });
});

$("#desactifProfil").click(function(evt) {

    var active = 1;
    var idProfil = document.getElementById('selectedProfil').innerHTML;
    this.classList.add('d-none');

    document.getElementById('actifProfil').classList.remove('d-none');
    $.post("ajax/updateConfProfil.php", {
        id: idProfil,
        valid: active,
        mode: 'valid'
    },
    function(retour) {
        if (retour == 'ok') {
            displayAlert('confirmProfilModif','success','Le profil a bien été activé.')
        }
    });
});


function changeTheme(theme){
    
    if(theme == 'dark'){
        $.post("ajax/changeTheme.php", {
        theme: 'dark',
        id : document.getElementById('idUser').innerHTML
        },
        function(retour) {
            if (retour == 'ok') {
                document.querySelector("link[href='./public/css/light.css']").href = "./public/css/dark.css";
                $('#darkTheme').removeClass('d-none');
                $('#lightTheme').addClass('d-none');
            }
        });
        
    }else if(theme == 'light'){
        $.post("ajax/changeTheme.php", {
        theme: 'light',
        id : document.getElementById('idUser').innerHTML
        },
        function(retour) {
            if (retour == 'ok') {
                document.querySelector("link[href='./public/css/dark.css']").href = "./public/css/light.css";
                $('#darkTheme').addClass('d-none');
                $('#lightTheme').removeClass('d-none');
            }
        });
    }
    
    
    
}