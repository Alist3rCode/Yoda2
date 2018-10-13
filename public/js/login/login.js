$(".alert").hide();

function capFirst(string) {
	return string.charAt(0).toUpperCase() + string.slice(1);
}

$("#login").click(function(evt) {
    evt.preventDefault();
    var email = document.getElementById('inputEmail').value;
    var password = document.getElementById('inputPassword').value;

    $.post("ajax/checkUser.php", {
        email: email
    },
        function(retour) {
        if (retour == 'WELCOME') {
            $.post("ajax/checkPassword.php", {
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

        $.post("ajax/checkUser.php", {
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
                $.post("ajax/createUser.php", {
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

    $.post("ajax/checkUser.php", {
        email: email
    },
    function(retour) {
        if (retour === 'WELCOME' || retour === 'WAIT') {
            $.post("ajax/notif/resetPassword.php", {
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

$("#updateProfil").click(function(evt) {
	var name = document.getElementById('updateName').value;
	var lastName = document.getElementById('updateLastName').value;
	var email = document.getElementById('updateEmail').value;
	var page = document.getElementById('updatePage').value;
	var password = document.getElementById('updatePassword').value;
	var passwordConfirm = document.getElementById('updateConfirmPassword').value;
	var id_user = document.getElementById('id_user').innerHTML;

	var regex = /^[\w.-]+@[\w.-]+\.[a-z]{2,6}$/;

	var match = regex.test(email);

	var errors = [];
	var flag = 0;

	if (name === '') {
		errors.push('Merci de renseigner votre prénom');
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
	else {
		$.ajax({
			method: "POST",
			url: "ajax/checkModifUser.php",
			data: {
				id: id_user,
				email: email
			},
			async: false,
		}).done(function(retour) {

			if (retour != id_user && retour != '') {
				errors.push('Cette adresse mail est déjà rattachée à un compte.');
				flag = 1;
			}
		});
	}

	if (password != passwordConfirm) {
		errors.push('Merci de vérifier les mot de passe saisis');
		flag = 1;

	}

	if (page == '0') {
		errors.push('Merci de renseigner la page par défault lors de la connexion');
		flag = 1;

	}

	if (flag === 0) {

		if (password == '') {
			password = 'PASTOUCHE';
		}
		$.post("ajax/updateProfil.php", {
				id: id_user,
				email: email,
				password: password,
				name: name,
				lastName: lastName,
				page: page,
				idProfil: 'PASTOUCHE',
				mode: 'update'
			},
			function(retour) {
				if (retour == 'ok') {
					$("#confirmModif").html("Les modifications apportées ont été sauvegardées.");
					$("#confirmModif").fadeTo(3000, 500).slideUp(500, function() {
						$("#confirmModif").slideUp(500);
					});
					document.getElementById('nameDisplay').innerHTML = capFirst(name);
					document.getElementById('lastNameDisplay').innerHTML = capFirst(lastName);
					document.getElementById('updateName').value = capFirst(name);
					document.getElementById('updateLastName').value = capFirst(lastName);

				}
			});

	}
	else {
		$("#alertModif").html(errors.join("<br>"));
		$("#alertModif").fadeTo(3000, 500).slideUp(500, function() {
			$("#alertModif").slideUp(500);
		});
	}
});

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

					$("#confirmAdminModif").html("L'utilisateur a bien été activé");
					$("#confirmAdminModif").fadeTo(3000, 500).slideUp(500, function() {
						$("#confirmAdminModif").slideUp(500);
					});
					 
					$.post("ajax/notifMailActiveAccount.php", {
        				id: id_user	});
					
				}
				else if (retour == 'ok' && active == 0) {

					$("#confirmAdminModif").html("L'utilisateur a bien été désactivé");
					$("#confirmAdminModif").fadeTo(3000, 500).slideUp(500, function() {
						$("#confirmAdminModif").slideUp(500);
					});
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

					$("#confirmAdminModif").html("L'utilisateur a bien été réactivé");
					$("#confirmAdminModif").fadeTo(3000, 500).slideUp(500, function() {
						$("#confirmAdminModif").slideUp(500);
					});
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

				document.getElementById('dropDownUser').innerHTML = document.getElementById('dropDownUser').innerHTML + "<li class='dropdown-item dropdownUserLi' id='user-" + retour[idx]['id'] + "' onclick='selectUserToModif(" + retour[idx]['id'] + ")' style='color:" + retour[idx]['color'] + ";'>" +
					capFirst(retour[idx]['name']) + " " + capFirst(retour[idx]['lastName']) + " - " + capFirst(retour[idx]['profil']) + "</li>";
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
			
			if(retour['isTech'] == 1 || retour['isDirection'] == 1){
			    $("#technicianPlanningQuestion").show();
                $('#desactivePlanning').addClass('d-none');
                $('#activePlanning').removeClass('d-none');
                
                $('#isNotTech').addClass('d-none');
                $('#isTech').removeClass('d-none');
                
                if(retour['isDirection'] == 1){
                    $('#isNotDirection').click();
                }
                if(retour['isRef'] == 1){
                    $('#isNotRef').click();
                }
                
                
			}else{
			    $("#technicianPlanningQuestion").hide();
                $('#activePlanning').addClass('d-none');
                $('#desactivePlanning').removeClass('d-none');
                
                $('#isTech').addClass('d-none');
                $('#isNotTech').removeClass('d-none');
                
                $('#isRef').addClass('d-none');
                $('#isNotRef').removeClass('d-none');
                
                $('#isDirection').addClass('d-none');
                $('#isNotDirection').removeClass('d-none');
			}
			if(retour['teamviewer'] == 1){
			    
                $('#desactiveTV').addClass('d-none');
                $('#activeTV').removeClass('d-none');
			}else{
			    $('#desactiveTV').removeClass('d-none');
                $('#activeTV').addClass('d-none');
			}
			
			

		});
	document.getElementById('cardProfil').classList.add('d-none');
	document.getElementById('cardUser').classList.remove('d-none');
	
	
}

$("#resetAdminProfil").click(function(evt) {
	evt.preventDefault();
	var name = document.getElementById('updateAdminName');
	var lastName = document.getElementById('updateAdminLastName');
	var email = document.getElementById('updateAdminEmail');
	var password = document.getElementById('updateAdminPassword');
	var passwordConfirm = document.getElementById('updateAdminConfirmPassword');
	var page = document.getElementById('updateAdminPage');
	var profil = document.getElementById('configUserProfil');
	var id_user = document.getElementById('selectedUser').innerHTML;

	$.post("ajax/loadUser.php", {
			id: id_user
		},
		function(retour) {

			name.value = capFirst(retour['name']);
			lastName.value = capFirst(retour['lastName']);
			email.value = retour['email'];
			page.value = retour["page"];
			profil.value = retour['profil'];
			password.value = '';
			passwordConfirm.value = '';
			
			if(retour['isTech'] == 1 || retour['isDirection'] == 1){
			    $("#technicianPlanningQuestion").show();
                $('#desactivePlanning').addClass('d-none');
                $('#activePlanning').removeClass('d-none');
                
                $('#isNotTech').addClass('d-none');
                $('#isTech').removeClass('d-none');
                
                if(retour['isDirection'] == 1){
                    $('#isNotDirection').click();
                }
                if(retour['isRef'] == 1){
                    $('#isNotRef').click();
                }
                
                
			}else{
			    $("#technicianPlanningQuestion").hide();
                $('#activePlanning').addClass('d-none');
                $('#desactivePlanning').removeClass('d-none');
                
                $('#isTech').addClass('d-none');
                $('#isNotTech').removeClass('d-none');
                
                $('#isRef').addClass('d-none');
                $('#isNotRef').removeClass('d-none');
                
                $('#isDirection').addClass('d-none');
                $('#isNotDirection').removeClass('d-none');
			}

		});
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
	var isRef = 0;
	var isDirection = 0;
	var surname = document.getElementById('updateAdminSurname');
	var teamviewer = 0;
    // console.log(document.getElementById('isNotRef').classList.contains('d-none'));
    
    if(document.getElementById('isNotTech').classList.contains('d-none')){
        isTech = 1;
    }else{
        isTech = 0;
    }
    if(document.getElementById('isNotRef').classList.contains('d-none')){
        isRef = 1;
    }else{
        isRef = 0;
    }
    if(document.getElementById('isNotDirection').classList.contains('d-none')){
        isDirection = 1;
    }else{
        isDirection = 0;
    }
    if(document.getElementById('desactiveTV').classList.contains('d-none')){
        teamviewer = 1;
    }else{
        teamviewer = 0;
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
					$("#alertAdminModif").html("Cette adresse mail est déjà rattachée à un compte.");
					$("#alertAdminModif").fadeTo(3000, 500).slideUp(500, function() {
						$("#alertAdminModif").slideUp(500);
					});
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
				isRef : isRef,
				isDirection : isDirection,
				surname : surname.value,
				teamviewer : teamviewer
			},
			function(retour) {
				var testId = retour.substring(0, 3);
				if (retour == 'ok') {
					$("#confirmAdminModif").html("Les modifications apportées ont été sauvegardées.");
					$("#confirmAdminModif").fadeTo(3000, 500).slideUp(500, function() {
						$("#confirmAdminModif").slideUp(500);
					});
					nameSelect.innerHTML = capFirst(name);
					profilSelected.innerHTML = profil.value;
					lastNameSelect.innerHTML = capFirst(lastName);
					name.value = capFirst(name);
					lastName.value = capFirst(lastName);

					if (document.getElementById('id_user').innerHTML == document.getElementById('selectedUser').innerHTML) {

						administratorName.innerHTML = capFirst(lastName);

					}

				}
				else if (testId == 'id-') {
					$("#confirmAdminModif").html("Les modifications apportées ont été sauvegardées.");
					$("#confirmAdminModif").fadeTo(3000, 500).slideUp(500, function() {
						$("#confirmAdminModif").slideUp(500);
					});
					nameSelect.innerHTML = capFirst(name);
					lastNameSelect.innerHTML = capFirst(lastName);
					name.value = capFirst(name);
					lastName.value = capFirst(lastName);
					profilSelected.innerHTML = profil.value;

					if (document.getElementById('id_user').innerHTML == document.getElementById('selectedUser').innerHTML) {

						administratorName.innerHTML = capFirst(lastName);

					}

					var newId = retour.split('-');

					id_user.innerHTML = newId[1];
					document.getElementById('activeOrNot').classList.remove('invisible');
					document.getElementById('actifUser').click();

				}
			});

	}
	else {
		$("#alertAdminModif").html(errors.join("<br>"));
		$("#alertAdminModif").fadeTo(3000, 500).slideUp(500, function() {
			$("#alertAdminModif").slideUp(500);
		});
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
		$.get("ajax/searchForUser.php?search=" + search, function(json) {

			listUser.innerHTML = json;
			console.log(json);
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
				document.getElementById('dropdownProfil').innerHTML = document.getElementById('dropdownProfil').innerHTML + "<li class='dropdown-item dropdownProfilLi' id='profil-" + retour[idx]['id'] + "' onclick='selectProfilToModif(" + retour[idx]['id'] + ")'>" + capFirst(retour[idx]['name']) + "</li>";
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
				document.getElementById('dropdownUserProfil').innerHTML = document.getElementById('dropdownUserProfil').innerHTML + "<li class='dropdown-item dropdownProfilLi' id='profil-" + retour[idx]['id'] + "' onclick='selectProfilUser(" + retour[idx]['id'] + ", \"" + retour[idx]['name'] + "\")'>" + capFirst(retour[idx]['name']) + "</li>";
			}
		});
});

function selectProfilUser(idProfil, nameProfil) {
	console.log(idProfil, nameProfil);
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
			console.log(retour)
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
					selectedRights.innerHTML = selectedRights.innerHTML + '<li class="list-group-item list-group-item-success selected" data-id=' + retour["right"][y]["id"] + ' id="selectItem-' + retour["right"][y]["id"] + '"  onclick="unselectRight(' + retour['right'][y]['id'] + ')">' + retour["right"][y]["name"] + '</li>';
				}
				else {
					unselectedRights.innerHTML = unselectedRights.innerHTML + '<li class="list-group-item list-group-item-danger unselected" data-id=' + retour["right"][y]["id"] + ' id="unselectItem-' + retour["right"][y]["id"] + '" onclick="selectRight(' + retour['right'][y]['id'] + ')">' + retour["right"][y]["name"] + '</li>';
				}
			}

			document.getElementById('cardProfil').classList.remove('d-none');
			document.getElementById('cardUser').classList.add('d-none');

		});
}

function selectRight(id) {

	var name = $('#unselectItem-' + id).html();
	$('#unselectItem-' + id).remove();
	$("#selectedRights").append('<li class="list-group-item list-group-item-success selected" data-id=' + id + ' id="selectItem-' + id + '"  onclick="unselectRight(' + id + ')">' + name + '</li>');

	var elems = $('#selectedRights').children('li').remove();
	elems.sort(function(a, b) {
		return parseInt(a.dataset.id) > parseInt(b.dataset.id);
	});
	$('#selectedRights').append(elems);

}

function unselectRight(id) {

	var name = $('#selectItem-' + id).html();
	$('#selectItem-' + id).remove();
	$("#unselectedRights").append('<li class="list-group-item list-group-item-danger unselected" data-id=' + id + ' id="unselectItem-' + id + '" onclick="selectRight(' + id + ')">' + name + '</li>');

	var elems = $('#unselectedRights').children('li').remove();
	elems.sort(function(a, b) {
		return parseInt(a.dataset.id) > parseInt(b.dataset.id);
	});
	$('#unselectedRights').append(elems);

}

$("#selectAllRights").click(function(evt) {

	$(".unselected").click();

});

$("#unselectAllRights").click(function(evt) {

	$(".selected").click();

});

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
				$("#confirmProfilModif").html("Les modifications apportées ont été sauvegardées.");
				$("#confirmProfilModif").fadeTo(3000, 500).slideUp(500, function() {
					$("#confirmProfilModif").slideUp(500);
				});
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

				$("#confirmProfilModif").html("Le profil a bien été désactivé");
				$("#confirmProfilModif").fadeTo(3000, 500).slideUp(500, function() {
					$("#confirmProfilModif").slideUp(500);
				});
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

				$("#confirmProfilModif").html("Le profil a bien été activé");
				$("#confirmProfilModif").fadeTo(3000, 500).slideUp(500, function() {
					$("#confirmProfilModif").slideUp(500);
				});
			}
		});
});



$("#closeTab").click(function(evt) {
    
   window.top.close();
    
});


$('#desactivePlanning').click(function(){
    
    $("#technicianPlanningQuestion").show("fast");
    $('#desactivePlanning').addClass('d-none');
    $('#activePlanning').removeClass('d-none');
    
    $('#isNotTech').addClass('d-none');
    $('#isTech').removeClass('d-none');
    
});


$('#activePlanning').click(function(){
    
    $("#technicianPlanningQuestion").hide("fast");
    $('#activePlanning').addClass('d-none');
    $('#desactivePlanning').removeClass('d-none');
    
    $('#isTech').addClass('d-none');
    $('#isNotTech').removeClass('d-none');
    
    $('#isRef').addClass('d-none');
    $('#isNotRef').removeClass('d-none');
    
    $('#isDirection').addClass('d-none');
    $('#isNotDirection').removeClass('d-none');
    
});

$('#isNotRef').click(function(){
    
   
    $('#isNotRef').addClass('d-none');
    $('#isRef').removeClass('d-none');
    
    $('#isDirection').addClass('d-none');
    $('#isNotDirection').removeClass('d-none');
    
    $('#isNotTech').addClass('d-none');
    $('#isTech').removeClass('d-none');
   
    
});

$('#isRef').click(function(){
    
   
    $('#isRef').addClass('d-none');
    $('#isNotRef').removeClass('d-none');
   
    
});

$('#isNotDirection').click(function(){
    
   
    $('#isNotDirection').addClass('d-none');
    $('#isDirection').removeClass('d-none');
   
    $('#isRef').addClass('d-none');
    $('#isNotRef').removeClass('d-none');
    
    $('#isTech').addClass('d-none');
    $('#isNotTech').removeClass('d-none');
    
    
});

$('#isDirection').click(function(){
    
   
    $('#isDirection').addClass('d-none');
    $('#isNotDirection').removeClass('d-none');
   
    $('#isNotTech').addClass('d-none');
    $('#isTech').removeClass('d-none');
    
});

$('#activeTV').click(function(){
    
   
    $('#activeTV').addClass('d-none');
    $('#desactiveTV').removeClass('d-none');
   
    
});

$('#desactiveTV').click(function(){
    
   
    $('#desactiveTV').addClass('d-none');
    $('#activeTV').removeClass('d-none');
   
    
});