$("#login").click(function(evt) {
    evt.preventDefault();
    var email = document.getElementById('inputEmail').value;
    var password = document.getElementById('inputPassword').value;

    $.post("ajax/loing/checkUser.php", {
        email: email
    },
        function(retour) {
        if (retour == 'WELCOME') {
            $.post("ajax/login/checkPassword.php", {
                email: email,
                password: password,
                mode : 'login'
            },
            function(retour) {
                console.log(retour[0]);
                if (retour[0] == 'OK') {
                    
                    if(document.location.search.indexOf('redirect') === 1){
                        var url = document.location.search.split('=');
                        console.log(url);
                        document.location.href = url[1];

                        }else{

                          document.location.href = retour[1];
                        }
                    }else if (retour[0] == 'NOK') {
                        displayAlert('alertSlideUp','danger',"Votre mot de passe est erronné. Merci de vérifier.");

                    }else if (retour[0] == 'CHANGE'){
                        $("#newPasswordModal").modal('show');
                    }
            });

        }
        else if (retour == 'WAIT') {
            displayAlert('alertSlideUp','warning',"Votre compte est en cours de validation par l'administrateur.");

        }
        else if (retour == 'DUNNO') {
            displayAlert('alertSlideUp','danger',"Votre adresse mail n'est pas connue. Merci de créer un compte.");

        }
        else if (retour == 'NOPE') {
            displayAlert('alertSlideUp','danger',"Votre compte a été désactivé. S'il s'agit d'une erreur, merci de vous rapprocher de l'administrateur.");

        }
    });
});


$('#submitNewPassword').click(function(){
   
   var flag = 0;
   var errors = [];
   
   if ($('#newPassword_Old').val() === ''){
       flag = 1;
       errors.push('Merci de saisir votre ancien mot de passe');
    }
    if ($('#newPassword_New').val() === ''){
       flag = 1;
       errors.push('Merci de saisir votre nouveau mot de passe');
    }
    if ($('#newPassword_Confirm').val() === ''){
       flag = 1;
       errors.push('Merci de confirmer votre nouveau mot de passe');
    }
    if ($('#newPassword_New').val() !== $('#newPassword_Confirm').val()){
       flag = 1;
       errors.push('Les deux mot de passe ne sont pas identiques');
    }
   
    if (flag === 1){
        displayAlert('alertNewPassword','danger',errors.join('<br>'));
        
    }else{
       
        $.post("ajax/checkPassword.php", {
            email: document.getElementById('inputEmail').value,
            password: document.getElementById('newPassword_New').value,
            mode : "change"
        },
        function(retour) {
            if (retour['0'] === 'NOK'){
                displayAlert('alertNewPassword','danger',retour["1"]);

            }else if (retour['0'] === 'OK'){
                displayAlert('confirmNewPassword','success',retour["1"]);

            }
        });
    }
});

$(document).keypress(function(e) {
    var keycode = (e.keyCode ? e.keyCode : e.which);
    if (keycode == 13) {
            console.log(keycode);

        if (!document.getElementById('createModal').classList.contains('show') && !document.getElementById('forgetModal').classList.contains('show')) {
            $("#login").click();
        }
        else if (document.getElementById('createModal').classList.contains('show') && !document.getElementById('forgetModal').classList.contains('show')) {
            $("#createAccount").click();
        }
        else if (!document.getElementById('createModal').classList.contains('show') && document.getElementById('forgetModal').classList.contains('show')) {
            $("#resetPassword").click();
        }
    }
});

$("#createAccount").click(function(evt) {
    evt.preventDefault();

    var email = document.getElementById('createEmail');
    var password = document.getElementById('createPassword');
    var name = document.getElementById('createName');
    var lastName = document.getElementById('createLastName');
    var passwordConfirm = document.getElementById('createConfirmPassword');
    var defaultPage = document.getElementById('defaultPage');
    console.log(defaultPage);
    var regex = /^[\w.-]+@[\w.-]+\.[a-z]{2,6}$/;

    var match = regex.test(email.value);

    var errors = [];
    var flag = 0;

    if (name.value === '') {
            errors.push('Merci de renseigner votre prénom');
            flag = 1;

    }
    if (lastName.value === '') {
            errors.push('Merci de renseigner votre nom');
            flag = 1;

    }
    if (email.value === '' || !match) {
            errors.push('Merci de renseigner une adresse eMail valide');
            flag = 1;

    }
    if (password.value === '' || password.value !== passwordConfirm.value) {
            errors.push('Merci de vérifier le mot de passe');
            flag = 1;

    }

    if (defaultPage.value === '0') {

            errors.push('Merci de renseigner la page par défault lors de la connexion');
            flag = 1;

    }

    if (flag === 0) {

        $.post("ajax/login/checkUser.php", {
            email: email.value
        },
        function(retour) {
            if (retour === 'WELCOME') {
                displayAlert('alertCreate','warning',"L'adresse mail renseignée existe déja. Merci de vous connecter normalement.");

            }else if (retour === 'NOPE') {
                displayAlert('alertCreate','danger',"L'adresse mail renseignée concerne un compte désactivé. S'il s'agit d'une erreur, merci de contacter l'administrateur.");
           
            }else if (retour === 'WAIT') {
                displayAlert('alertCreate','warning',"Votre compte est en cours de validation par l'administrateur.");

            }else if (retour === 'DUNNO') {
                $.post("ajax/login/createUser.php", {
                    email: email.value,
                    password: password.value,
                    name: name.value,
                    lastName: lastName.value,
                    page: defaultPage.value
                },
                function(retour) {
                    if (retour['ok'] === 'ok') {
                        displayAlert('confirmCreate','success',"Le compte a bien été créé. Une demande a été envoyée à l'administrateur. Vous recevrez une notification dès que l'accès sera autorisé.");
                        email.value = '';
                        password.value = '';
                        name.value = '';
                        lastName.value = '';
                        passwordConfirm.value = '';
                        defaultPage.value = '0';

                        $.post("ajax/notif/notifMailNewAccount.php", {
                            id: retour['id'],
                            password: password.value
                        });
                    }else{
                        displayAlert('alertCreate','danger',retour.join("<br><hr><br>"));
                        
                    }
                });
            }
        });
    }else {
        displayAlert('alertCreate','danger',errors.join("<br>"));
    }
});

$("#resetPassword").click(function(evt) {

    var email = document.getElementById('forgetEmail').value;
    var newPassword = '';

    $.post("ajax/login/checkUser.php", {
        email: email
    },
    function(retour) {
        if (retour === 'WELCOME' || retour === 'WAIT') {
            $.post("ajax/login/resetPassword.php", {
                numbers: true,
                mini: true,
                maj: true,
                spec: false,
                simi: false,
                nbCarac: '11',
                email: email
            },
            function(retour) {
                if (retour === 'ok') {
                    displayAlert('confirmReset','success',"Votre mot de passe a bien été réinitialisé. Il a été envoyé sur votre adresse mail.");
                    email = '';
                    password = '';
                    name = '';
                    lastName = '';
                    passwordConfirm = '';
                    defaultPage = '0';
		}
            });
        }else if (retour === 'NOPE') {
            displayAlert('alertReset','danger',"L'adresse mail renseignée concerne un compte désactivé. S'il s'agit d'une erreur, merci de contacter l'administrateur.");

        }else if (retour == 'DUNNO') {
            displayAlert('alertReset','danger',"Votre adresse mail n'est pas connue. Merci de créer un compte.");
        }
    });
});





//Je m'arrete ici





























//konami
var k = [38, 38, 40, 40, 37, 39, 37, 39, 66, 65],
	n = 0;
$(document).keydown(function(e) {
	if (e.keyCode === k[n++]) {
		if (n === k.length) {
			window.open('https://www.youtube.com/watch?v=dQw4w9WgXcQ');
			n = 0;
			return false;
		}
	}
	else {
		n = 0;
	}
});