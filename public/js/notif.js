let selectedProfil = 0;
let selectedUser = 0;

function selectCustomer(id) {

    var name = $('#unselectItem-' + id).html();
    $('#unselectItem-' + id).remove();
    $("#unselectedCustomer").append('<li class=" text-capitalize list-group-item list-group-item-danger selected" data-id=' + id + ' id="selectItem-' + id + '"  onclick="unselectCustomer(' + id + ')">' + name + '</li>'+"\n");

    var elems = $('#unselectedCustomer').children('li').remove();
    elems.sort(function(a, b) {
        if(a.innerHTML < b.innerHTML) return -1;
        if(a.innerHTML > b.innerHTML) return 1;
        return 0;
    });
    $('#unselectedCustomer').append(elems);
	
    if(document.getElementById('selectedCustomer').innerHTML.trim() === ''){
        $("#searchSelectCustomer").prop("disabled", true);
        $("#searchSelectCustomerButton").prop("disabled", true);
    }else{
        $("#searchSelectCustomer").prop("disabled", false);
        $("#searchSelectCustomerButton").prop("disabled", false);
    }
    if(document.getElementById('unselectedCustomer').innerHTML.trim() === ''){
        
        $("#searchUnselectCustomer").prop("disabled", true);
        
        $("#searchUnselectCustomerButton").prop("disabled", true);
    }else{
        $("#searchUnselectCustomer").prop("disabled", false);
        
        $("#searchUnselectCustomerButton").prop("disabled", false);
    }

}

function unselectCustomer(id) {

    var name = $('#selectItem-' + id).html();
    $('#selectItem-' + id).remove();
    $("#selectedCustomer").append('<li class="text-capitalize list-group-item list-group-item-success unselected" data-id=' + id + ' id="unselectItem-' + id + '" onclick="selectCustomer(' + id + ')">' + name + '</li>'+"\n");

    var elems = $('#selectedCustomer').children('li').remove();
    elems.sort(function(a, b) {
        if(a.innerHTML < b.innerHTML) return -1;
        if(a.innerHTML > b.innerHTML) return 1;
        return 0;
    });
	
    $('#selectedCustomer').append(elems);
	
    if(document.getElementById('selectedCustomer').innerHTML.trim() === ''){
        $("#searchSelectCustomer").prop("disabled", true);
        $("#searchSelectCustomerButton").prop("disabled", true);
    }else{
        $("#searchSelectCustomer").prop("disabled", false);
        $("#searchSelectCustomerButton").prop("disabled", false);
    }
    if(document.getElementById('unselectedCustomer').innerHTML.trim() === ''){
        
        $("#searchUnselectCustomer").prop("disabled", true);
        
        $("#searchUnselectCustomerButton").prop("disabled", true);
    }else{
        $("#searchUnselectCustomer").prop("disabled", false);
        
        $("#searchUnselectCustomerButton").prop("disabled", false);
    }
}

$("#selectAllCustomer").click(function(evt) {


    search = document.getElementById('searchUnselectCustomer'); 
    search.value = '';
    $('#alertUnselectedCustomer').addClass('d-none');
    $(".selected").click();
});

$("#unselectAllCustomer").click(function(evt) {

	
    search = document.getElementById('searchSelectCustomer'); 
    search.value = '';
    $('#alertSelectedCustomer').addClass('d-none');
    $(".unselected").click();
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
    } else {
        n = 0;
    }
});


$(document).ready(function(){
    
   if(document.getElementById('selectedCustomer').innerHTML.trim() === ''){
        $("#searchSelectCustomer").prop("disabled", true);
        $("#searchSelectCustomerButton").prop("disabled", true);
    }else{
        $("#searchSelectCustomer").prop("disabled", false);
        $("#searchSelectCustomerButton").prop("disabled", false);
    }
    if(document.getElementById('unselectedCustomer').innerHTML.trim() === ''){
        
        $("#searchUnselectCustomer").prop("disabled", true);
        $("#searchUnselectCustomerButton").prop("disabled", true);
    }else{
        $("#searchUnselectCustomer").prop("disabled", false);
        $("#searchUnselectCustomerButton").prop("disabled", false);
    }
});

$("#activeCreate").click(function(evt) {

    this.classList.remove('active');
    this.classList.add('d-none');
    document.getElementById('desactiveCreate').classList.add('active');
    document.getElementById('desactiveCreate').classList.remove('d-none');
		
});

$("#desactiveCreate").click(function(evt) {

    this.classList.remove('active');
    this.classList.add('d-none');
    document.getElementById('activeCreate').classList.add('active');
    document.getElementById('activeCreate').classList.remove('d-none');
		
});

$("#activeModif").click(function(evt) {

    this.classList.remove('active');
    this.classList.add('d-none');
    document.getElementById('desactiveModif').classList.add('active');
    document.getElementById('desactiveModif').classList.remove('d-none');
		
});

$("#desactiveModif").click(function(evt) {

    this.classList.remove('active');
    this.classList.add('d-none');
    document.getElementById('activeModif').classList.add('active');
    document.getElementById('activeModif').classList.remove('d-none');
		
});


$("#activeNewCusto").click(function(evt) {

    this.classList.remove('active');
    this.classList.add('d-none');
    document.getElementById('desactiveNewCusto').classList.add('active');
    document.getElementById('desactiveNewCusto').classList.remove('d-none');
		
});

$("#desactiveNewCusto").click(function(evt) {

    this.classList.remove('active');
    this.classList.add('d-none');
    document.getElementById('activeNewCusto').classList.add('active');
    document.getElementById('activeNewCusto').classList.remove('d-none');
		
});

$("#activeCreateConfig").click(function(evt) {

    this.classList.remove('active');
    this.classList.add('d-none');
    document.getElementById('desactiveCreateConfig').classList.add('active');
    document.getElementById('desactiveCreateConfig').classList.remove('d-none');
		
});

$("#desactiveCreateConfig").click(function(evt) {

    this.classList.remove('active');
    this.classList.add('d-none');
    document.getElementById('activeCreateConfig').classList.add('active');
    document.getElementById('activeCreateConfig').classList.remove('d-none');
		
});

$("#activeModifConfig").click(function(evt) {

    this.classList.remove('active');
    this.classList.add('d-none');
    document.getElementById('desactiveModifConfig').classList.add('active');
    document.getElementById('desactiveModifConfig').classList.remove('d-none');
		
});

$("#desactiveModifConfig").click(function(evt) {

    this.classList.remove('active');
    this.classList.add('d-none');
    document.getElementById('activeModifConfig').classList.add('active');
    document.getElementById('activeModifConfig').classList.remove('d-none');
		
});


$("#activeNewCustoConfig").click(function(evt) {

    this.classList.remove('active');
    this.classList.add('d-none');
    document.getElementById('desactiveNewCustoConfig').classList.add('active');
    document.getElementById('desactiveNewCustoConfig').classList.remove('d-none');
		
});

$("#desactiveNewCustoConfig").click(function(evt) {

    this.classList.remove('active');
    this.classList.add('d-none');
    document.getElementById('activeNewCustoConfig').classList.add('active');
    document.getElementById('activeNewCustoConfig').classList.remove('d-none');
		
});


$("#updateNotif").click(function(evt) {
    var activeCreate = document.getElementById('activeCreate').classList.contains('d-none');
    var boolCreate = 1;
    var activeModif = document.getElementById('activeModif').classList.contains('d-none');
    var boolModif = 1;
    var activeNewCusto = document.getElementById('activeNewCusto').classList.contains('d-none');
    var boolNewCusto = 1;
    var selectedCustomerHtml = document.getElementById("selectedCustomer").getElementsByTagName("li");
    var id_user = document.getElementById('id_user').innerHTML;
    var selectedCustomer = new Array();
    for (var i = 0; i < selectedCustomerHtml.length; i++) {
        selectedCustomer.push(selectedCustomerHtml[i].dataset.id)
    }
    
    if (!activeCreate){
        boolCreate = 1;
    }else{
        boolCreate = 0;
    }
    if (!activeModif){
        boolModif = 1;
    }else{
        boolModif = 0;
    }
    if (!activeNewCusto){
        boolNewCusto = 1;
    }else{
        boolNewCusto = 0;
    }
    // console.log(desactiveCreate)
    $.ajax({
        method: "POST",
        url: "ajax/notif/updateNotif.php",
        data: {
            id: id_user,
            update: selectedCustomer,
            create: boolCreate,
            modif: boolModif,
            new_custo: boolNewCusto
        },
        async: false
    }).done(function(retour) {

        if (retour == 'ok') {
            displayAlert('confirmNotif','success','Les modifications apportées ont été sauvegardées.')
        }else{
            displayAlert('confirmNotif','danger','Une erreur est survenue.')
        }
    });
});

$("#resetNotif").click(function(evt) {
    location.reload();    
});

$("#searchSelectCustomer").keyup(function(evt){
   
   var search = this.value;
   if(search == ''){
        $('.unselected').removeClass('d-none');
        $('#alertSelectedCustomer').addClass('d-none');
    }else{
        $.get("ajax/yoda/search.php?search=" + search , function(json){
               
            $('.unselected').addClass('d-none');
            $('#alertSelectedCustomer').removeClass('d-none');
            for (i = 0; i < json.length; i++) {

                document.getElementById('unselectItem-' + json[i]).classList.remove('d-none');
            }
        });
    } 
});

$("#searchSelectCustomerButton").click(function(evt){
    
    search = document.getElementById('searchSelectCustomer'); 
    search.value = '';
    $('#alertSelectedCustomer').addClass('d-none');
    $('.unselected').removeClass('d-none');
    
});

$("#searchUnselectCustomer").keyup(function(evt){
   
   var search = this.value;
   if(search == ''){
        
        $('.selected').removeClass('d-none');
        $('#alertUnselectedCustomer').addClass('d-none');
    }else{
        $.get("ajax/yoda/search.php?search=" + search , function(json){
               
            $('.selected').addClass('d-none');
            $('#alertUnselectedCustomer').removeClass('d-none');  
            for (i = 0; i < json.length; i++) {
                
                document.getElementById('selectItem-' + json[i]).classList.remove('d-none');
            }
        });
    } 
});

$("#searchUnselectCustomerButton").click(function(evt){
    
    search = document.getElementById('searchUnselectCustomer'); 
    search.value = '';
    $('#alertUnselectedCustomer').addClass('d-none');
    $('.selected').removeClass('d-none');
    
});

function selectProfil(id){
    
    if (document.getElementById('profil-'+id).classList.contains("list-group-item-light")){
        
        document.getElementById('profil-'+id).classList.add("list-group-item-info");
        document.getElementById('profil-'+id).classList.remove("list-group-item-light");
        
        $( ".userNotif" ).each(function() {
            
            if($(this).data('profil-id') === id){
                // console.log($(this).data('profil-id')+  ' ' + id);
                $(this).addClass("list-group-item-info");
                $(this).removeClass("list-group-item-light");
            }
        });
    }else if (document.getElementById('profil-'+id).classList.contains("list-group-item-info")){
        
        document.getElementById('profil-'+id).classList.remove("list-group-item-info");
        document.getElementById('profil-'+id).classList.add("list-group-item-light");

        $( ".userNotif" ).each(function() {
            if($(this).data('profil-id') === id){
            
                $(this).removeClass("list-group-item-info");
                $(this).addClass("list-group-item-light");
            }
        });
    }
    selectedProfil = selectedUser = 0;
     $( ".profilNotif.list-group-item-info" ).each(function() {
        selectedProfil = selectedProfil + 1;
    });
    $( ".userNotif.list-group-item-info" ).each(function() {
        selectedUser = selectedUser + 1;
    });
    
    document.getElementById('selectedProfilNumber').innerHTML = selectedProfil;
    document.getElementById('selectedUserNumber').innerHTML = selectedUser;
}

function selectUser(id){
    var idProfil = document.getElementById('user-'+id).dataset.profilId;
    if (document.getElementById('user-'+id).classList.contains("list-group-item-light")){
        
        document.getElementById('user-'+id).classList.add("list-group-item-info");
        document.getElementById('user-'+id).classList.remove("list-group-item-light");
        
        var profilOK = 1;
        $(".userNotif").each(function(){
            if($(this).data('profil-id') == idProfil && $(this).hasClass('list-group-item-light')){
                
                profilOK=0;
            }
        
        });
        if (profilOK == 1){
            
            if (document.getElementById('profil-'+idProfil).classList.contains("list-group-item-light")){
        
                document.getElementById('profil-'+idProfil).classList.add("list-group-item-info");
                document.getElementById('profil-'+idProfil).classList.remove("list-group-item-light");
                
            }
        }
    }else if (document.getElementById('user-'+id).classList.contains("list-group-item-info")){
        
        document.getElementById('user-'+id).classList.remove("list-group-item-info");
        document.getElementById('user-'+id).classList.add("list-group-item-light");
            
        if (document.getElementById('profil-'+idProfil).classList.contains("list-group-item-info")){

            document.getElementById('profil-'+idProfil).classList.add("list-group-item-light");
            document.getElementById('profil-'+idProfil).classList.remove("list-group-item-info");

        }

    }
    selectedProfil = selectedUser = 0;
     $( ".profilNotif.list-group-item-info" ).each(function() {
        selectedProfil = selectedProfil + 1;
    });
    $( ".userNotif.list-group-item-info" ).each(function() {
        selectedUser = selectedUser + 1;
    });
    
    document.getElementById('selectedProfilNumber').innerHTML = selectedProfil;
    document.getElementById('selectedUserNumber').innerHTML = selectedUser;
}

$('#selectAllUser').click(function(){
    
    $( ".profilNotif.list-group-item-light" ).each(function() {
        $(this).click();
    });
    $( ".userNotif.list-group-item-light" ).each(function() {
        $(this).click();
    });
    
});

$('#unselectAllUser').click(function(){
    
    $( ".profilNotif.list-group-item-info" ).each(function() {
        $(this).click();
    });
    $( ".userNotif.list-group-item-info" ).each(function() {
        $(this).click();
    });
    
});

$('#sendMailButton').click(function(){
    
    var objet = document.getElementById("objet")
    var message = tinyMCE.activeEditor.getContent();
    console.log(message);
    var errors = [];
    var flag = 0;
    var destinataires = [];
    
    $( ".userNotif.list-group-item-info" ).each(function() {
        destinataires.push($(this).data('user-id'));
    });
    if (objet.value == ''){
        flag = 1;
        errors.push('Veuillez saisir un objet pour la notification');
    }
    if (message == ''){
        flag = 1;
        errors.push('Veuillez saisir un contenu pour la notification');
    }
    if (destinataires.length == 0){
        flag = 1;
        errors.push('Veuillez sélectionner des utilisateurs pour l\'envoie de la notification');
    }
    
    if(flag == 1){
        $("#alertNotifUser").html(errors.join('<br>'));
		$("#alertNotifUser").fadeTo(3000, 500).slideUp(500, function() {
			$("#alertNotifUser").slideUp(500);
		});
    }else{
        
        $.ajax({
            method: "POST",
            url: "ajax/notif/NotifMailUsers.php",
            data: {
                destinataires: destinataires,
                objet: objet.value,
                message: message
            },
            async: false
        }).done(function(retour) {

            if (retour == 'ok') {
                displayAlert('successNotifUser','success','La notification a été envoyée.');
                
            }
        });
    }
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

        listUser.innerHTML = 'ALL';

    } else {
        $.get("ajax/profil/searchForUser.php?search=" + search, function(json) {

            listUser.innerHTML = json;
            if (json.length == 1) {
                document.getElementById('dropdownMenuUser').click();
                setTimeout(function() {
                    selectUserNotif(json[0]);
                }, 250);
            }
        });
    }
});

$("#divDropDown").on('show.bs.dropdown', function() {

    if (document.getElementById('listUser').innerHTML == '') {
        document.getElementById('listUser').innerHTML = 'ALL';
    }

    $.post("ajax/profil/loadAllUser.php", {
        id: document.getElementById('listUser').innerHTML,
        mode : 'notif'
    },
    function(retour) {
        var arrayLength = retour.length;
        document.getElementById('dropDownUser').innerHTML = '';
        for (var idx = 0; idx < arrayLength; idx++) {
            document.getElementById('dropDownUser').innerHTML = document.getElementById('dropDownUser').innerHTML + "<li class='dropdown-item dropdownUserLi' id='user-" + retour[idx]['id'] + "' onclick='selectUserNotif(" + retour[idx]['id'] + ")' style='color:" + retour[idx]['color'] + ";'>" +
            capFirst(retour[idx]['name']) + " " + capFirst(retour[idx]['lastName']) + " - " + capFirst(retour[idx]['profil']) + "</li>";
        }
    });
});

function selectUserNotif(id){
    
    var idLigne = document.getElementById('user-' + id);
    document.getElementById('searchUser').value = idLigne.innerHTML;
    document.getElementById('selectedUser').innerHTML = id;
    document.getElementById('unselectedCustomerConfig').innerHTML = '';
    document.getElementById('selectedCustomerConfig').innerHTML = '';
	
    $.ajax({
        method: "POST",
        url: "ajax/notif/loadNotifUser.php",
        data: {
                id: id
        },
        async: false
    }).done(function(retour) {
            
        for (y = 0; y < retour['client'].length; y++) {
            if (!retour['notif'].includes(retour['client'][y]['id'])){
                document.getElementById('unselectedCustomerConfig').innerHTML = document.getElementById('unselectedCustomerConfig').innerHTML + '<li class=" text-capitalize list-group-item list-group-item-danger selectedConfig" data-id=' + retour['client'][y]['id'] + ' id="selectItemConfig-' + retour['client'][y]['id'] + '"  onclick="unselectCustomerConfig(' + retour['client'][y]['id'] + ')">' + retour['client'][y]['ville'] + ' - ' + retour['client'][y]['nom'] +'</li>'+"\n";
            }
        }
        for (y = 0; y < retour['client'].length; y++) {
            if (retour['notif'].includes(retour['client'][y]['id'])){
                document.getElementById('selectedCustomerConfig').innerHTML = document.getElementById('selectedCustomerConfig').innerHTML + '<li class=" text-capitalize list-group-item list-group-item-success unselectedConfig" data-id=' + retour['client'][y]['id'] + ' id="unselectItemConfig-' + retour['client'][y]['id'] + '"  onclick="selectCustomerConfig(' + retour['client'][y]['id'] + ')">' + retour['client'][y]['ville'] + ' - ' + retour['client'][y]['nom'] +'</li>'+"\n";
            }
        }
            
        if(retour['create'] == 1){
            document.getElementById('activeCreateConfig').classList.remove('d-none');
            document.getElementById('desactiveCreateConfig').classList.add('d-none');
        }else if(retour['create'] == 0){
            document.getElementById('activeCreateConfig').classList.add('d-none');
            document.getElementById('desactiveCreateConfig').classList.remove('d-none');
        }
            
        if(retour['modif'] == 1){
            document.getElementById('activeModifConfig').classList.remove('d-none');
            document.getElementById('desactiveModifConfig').classList.add('d-none');
        }else if(retour['modif'] == 0){
            document.getElementById('activeModifConfig').classList.add('d-none');
            document.getElementById('desactiveModifConfig').classList.remove('d-none');
        }
            
        if(retour['new_custo'] == 1){
            document.getElementById('activeNewCustoConfig').classList.remove('d-none');
            document.getElementById('desactiveNewCustoConfig').classList.add('d-none');
        }else if(retour['new_custo'] == 0){
            document.getElementById('activeNewCustoConfig').classList.add('d-none');
            document.getElementById('desactiveNewCustoConfig').classList.remove('d-none');
        }
            
        if(document.getElementById('selectedCustomerConfig').innerHTML.trim() === ''){
            $("#searchSelectCustomerConfig").prop("disabled", true);
            $("#searchSelectCustomerButtonConfig").prop("disabled", true);
        }else{
            $("#searchSelectCustomerConfig").prop("disabled", false);
            $("#searchSelectCustomerButtonConfig").prop("disabled", false);
        }
        if(document.getElementById('unselectedCustomerConfig').innerHTML.trim() === ''){
                
            $("#searchUnselectCustomerConfig").prop("disabled", true);
            
            $("#searchUnselectCustomerButtonConfig").prop("disabled", true);
        }else{
            $("#searchUnselectCustomerConfig").prop("disabled", false);
            
            $("#searchUnselectCustomerButtonConfig").prop("disabled", false);
        }
            
            
        document.getElementById('configNotifUserHidden').classList.remove('d-none')
    });
    
}
$("#resetNotifConfig").click(function(evt) {
    var id = document.getElementById('selectedUser').innerHTML;
    selectUserNotif(id);
    
});

function selectCustomerConfig(id) {

    var name = $('#unselectItemConfig-' + id).html();
    $('#unselectItemConfig-' + id).remove();
    $("#unselectedCustomerConfig").append('<li class=" text-capitalize list-group-item list-group-item-danger selectedConfig" data-id=' + id + ' id="selectItemConfig-' + id + '"  onclick="unselectCustomerConfig(' + id + ')">' + name + '</li>'+"\n");

    var elems = $('#unselectedCustomerConfig').children('li').remove();
    elems.sort(function(a, b) {
        if(a.innerHTML < b.innerHTML) return -1;
        if(a.innerHTML > b.innerHTML) return 1;
        return 0;
    });
    $('#unselectedCustomerConfig').append(elems);
	
    if(document.getElementById('selectedCustomerConfig').innerHTML.trim() === ''){
        $("#searchSelectCustomerConfig").prop("disabled", true);
        $("#searchSelectCustomerButtonConfig").prop("disabled", true);
    }else{
        $("#searchSelectCustomerConfig").prop("disabled", false);
        $("#searchSelectCustomerButtonConfig").prop("disabled", false);
    }
    if(document.getElementById('unselectedCustomerConfig').innerHTML.trim() === ''){
        
        $("#searchUnselectCustomerConfig").prop("disabled", true);
        
        $("#searchUnselectCustomerButtonConfig").prop("disabled", true);
    }else{
        $("#searchUnselectCustomerConfig").prop("disabled", false);
        
        $("#searchUnselectCustomerButtonConfig").prop("disabled", false);
    }

}

function unselectCustomerConfig(id) {

    var name = $('#selectItemConfig-' + id).html();
    $('#selectItemConfig-' + id).remove();
    $("#selectedCustomerConfig").append('<li class="text-capitalize list-group-item list-group-item-success unselectedConfig" data-id=' + id + ' id="unselectItemConfig-' + id + '" onclick="selectCustomerConfig(' + id + ')">' + name + '</li>'+"\n");

    var elems = $('#selectedCustomerConfig').children('li').remove();
    elems.sort(function(a, b) {
        if(a.innerHTML < b.innerHTML) return -1;
        if(a.innerHTML > b.innerHTML) return 1;
        return 0;
    });
	
    $('#selectedCustomerConfig').append(elems);
	
    if(document.getElementById('selectedCustomerConfig').innerHTML.trim() === ''){
        $("#searchSelectCustomerConfig").prop("disabled", true);
        $("#searchSelectCustomerButtonConfig").prop("disabled", true);
    }else{
        $("#searchSelectCustomerConfig").prop("disabled", false);
        $("#searchSelectCustomerButtonConfig").prop("disabled", false);
    }
    if(document.getElementById('unselectedCustomerConfig').innerHTML.trim() === ''){
        
        $("#searchUnselectCustomerConfig").prop("disabled", true);
        
        $("#searchUnselectCustomerButtonConfig").prop("disabled", true);
    }else{
        $("#searchUnselectCustomerConfig").prop("disabled", false);
        
        $("#searchUnselectCustomerButtonConfig").prop("disabled", false);
    }
}

$("#selectAllCustomerConfig").click(function(evt) {


    search = document.getElementById('searchUnselectCustomerConfig'); 
    search.value = '';
    $('#alertUnselectedCustomerConfig').addClass('d-none');
    
    $(".selectedConfig").click();
});

$("#unselectAllCustomerConfig").click(function(evt) {

	
    search = document.getElementById('searchSelectCustomerConfig'); 
    search.value = '';
    $('#alertSelectedCustomerConfig').addClass('d-none');
    $(".unselectedConfig").click();
});

$("#updateNotifConfig").click(function(evt) {
    var activeCreate = document.getElementById('activeCreateConfig').classList.contains('d-none');
    var boolCreate = 1;
    var activeModif = document.getElementById('activeModifConfig').classList.contains('d-none');
    var boolModif = 1;
    var activeNewCusto = document.getElementById('activeNewCustoConfig').classList.contains('d-none');
    var boolNewCusto = 1;
    var selectedCustomerHtml = document.getElementById("selectedCustomerConfig").getElementsByTagName("li");
    var id_user = document.getElementById('selectedUser').innerHTML;
    var selectedCustomer = new Array();
    for (var i = 0; i < selectedCustomerHtml.length; i++) {
        selectedCustomer.push(selectedCustomerHtml[i].dataset.id)
    }
    
    if (!activeCreate){
        boolCreate = 1;
    }else{
        boolCreate = 0;
    }
    if (!activeModif){
        boolModif = 1;
    }else{
        boolModif = 0;
    }
    if (!activeNewCusto){
        boolNewCusto = 1;
    }else{
        boolNewCusto = 0;
    }
    $.ajax({
        method: "POST",
        url: "ajax/notif/updateNotif.php",
        data: {
            id: id_user,
            update: selectedCustomer,
            create: boolCreate,
            modif: boolModif,
            new_custo: boolNewCusto
        },
        async: false
    }).done(function(retour) {

        if (retour == 'ok') {
            displayAlert('confirmNotifConfig','success','Les modification apportées ont été sauvegardées.');
           
        }
    });
});