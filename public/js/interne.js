$('#editSectionButton').click(function () {
    if ($("#selectSection").val() !== 0){
        if ($('#createSection').hasClass('show')) {
            $('#createSection').collapse('hide');
            $('#internalCreateSectionName').val('');
            $('#createSection').on('hidden.bs.collapse', function () {
                $('#editSection').collapse('show');
            });
        } else {
            $('#editSection').collapse('show');
        }
        $('#internalEditSectionName').val($('#selectSection option:selected').text());
        console.log($('#selectSection option:selected').text());
    }
    
});

$('#createSectionButton').click(function () {

    if ($('#editSection').hasClass('show')) {
        $('#editSection').collapse('hide');
        $('#internalEditSectionName').val('');
        $('#editSection').on('hidden.bs.collapse', function () {
            $('#createSection').collapse('show');
        });
    } else {
        $('#createSection').collapse('show');
    }
});

$("#selectSection").click(function () {
    $('#createSection').collapse('hide');
    $('#editSection').collapse('hide');

});

function readURL(input) {

    if (input.files && input.files[0]) {
        var reader = new FileReader();

        reader.onload = function (e) {
            $('#previewLink').attr('src', e.target.result);
            $('#previewLink').removeClass('d-none');
        };

        reader.readAsDataURL(input.files[0]);
    }
}

$("#internalLinkImage").change(function () {
    readURL(this);
    $('#modifImage').html('1');
});


$('#modaleCreateInternalLink').on('hidden.bs.modal', function (e) {
    
    $('#selectSection').val('0');
    $('#internalLinkImage').val('');
    $('#previewLink').addClass('d-none');
    $('#modifImage').html('0');
    $('#internalLinkURL').val('');
    $('#internalLinkName').val('');
    $('#cancelModaleLink').removeClass('d-none');
    $('#validNewLink').removeClass('d-none');
    $('#deleteLink').addClass('d-none');
    $('#modifLink').addClass('d-none');
    $('#linkToModif').html('');
    $('#linkModalTitle').html('Création d\'un lien interne');

    
});

$('#validNewSection').click(function () {
    var value = $('#internalCreateSectionName').val();

    if (value == '') {

        displayAlert('alertModaleInternalLink', 'danger', 'Merci de saisir un nom de section.');

    } else {

        $.get("ajax/interne/createSection.php?value=" + value, function (retour) {

            if (retour['ok'] === 'ok') {
                $('#selectSection').append('<option value="' + retour['id'] + '">' + value + '</option>');
                $('#selectSection').val(retour['id']);
                displayAlert('alertModaleInternalLink', 'success', 'Section créée.');
                $('#createSection').collapse('hide');
                $('#internalCreateSectionName').val('');
            }

        });
    }

});

$('#validModifSection').click(function () {
    var value = $('#internalEditSectionName').val();
    var id = $('#selectSection').val();

    if (value == '') {

        displayAlert('alertModaleInternalLink', 'danger', 'Merci de saisir un nom de section.');

    } else {

        $.get("ajax/interne/modifSection.php?value=" + value + "&id=" + id + "&valid=1", function (retour) {

            if (retour['ok'] === 'ok') {
                $('#selectSection option:contains("' + retour['name'] + '")').text(value);
                displayAlert('alertModaleInternalLink', 'success', 'Les modifications effectuées ont été enregistrées.');
                $('#editSection').collapse('hide');
            }

        });
    }

});

$('#deleteSection').click(function () {
    var value = $('#internalEditSectionName').val();
    var id = $('#selectSection').val();

    $.get("ajax/interne/checkDeleteSection.php?id=" + id, function (retour) {

        if (retour['ok'] === 'ok' && retour['delete'] === 'YES') {

            $.get("ajax/interne/modifSection.php?value=" + value + "&id=" + id + "&valid=0", function (retour) {

                if (retour['ok'] === 'ok') {
                    $('#selectSection').val(0);
                    $("#selectSection option[value='" + id + "']").remove();
                    displayAlert('alertModaleInternalLink', 'success', 'La section a été supprimée');
                    $('#editSection').collapse('hide');
                }
            });

        } else if (retour['ok'] === 'ok' && retour['delete'] === 'NO') {

            displayAlert('alertModaleInternalLink', 'danger', 'La section contient des liens et ne peut être supprimée.');

        } else if (retour['ok'] != 'ok') {
            displayAlert('alertModaleInternalLink', 'danger', 'Une erreur est survenue.');

        }
    });
});

$('#validNewLink').click(function () {
    var preview = document.getElementById('previewLink');
    var section = $('#selectSection').val();
    var name = $('#internalLinkName').val();
    var url = $('#internalLinkURL').val();
    var nameImage = "";
    var formdata = new FormData();
    
    formdata.append('file', $('input[type=file]')[0].files[0]);
    var flag = 0;
    var errors =[];
    
    if(preview.width > '150'){
        flag = 1;
        errors.push('Merci de choisir une image avec un ratio de 1.5 de proportion (100x150px par exemple).');
    }
    
    if(section == '0'){
        flag = 1;
        errors.push('Merci de saisir une section pour ce lien');
    }
    
    if(name == ''){
        flag = 1;
        errors.push('Merci de saisir un nom pour ce lien');
    }
    
    if(url == ''){
        flag = 1;
        errors.push('Merci de saisir un URL valide pour ce lien');
    }

    if (flag == 1){
        displayAlert('alertModaleInternalLink', 'danger', errors.join('<br>'));
    } else{
        $.ajax({
            url: "ajax/interne/saveLinkImage.php", // Url to which the request is send
            type: "POST", // Type of request to be send, called as method
            data: formdata, // Data sent to server, a set of key/value pairs (i.e. form fields and values)
            contentType: false, // The content type used when sending data to the server.
            cache: false, // To unable request pages to be cached
            processData: false, // To send DOMDocument or non processed data file it is set to false
            success: function (data)   // A function to be called if request succeeds
            {
                if(data['ok'] === 'nok'){
                    displayAlert('alertModaleInternalLink', 'danger', data['error']);
                }else if (data['ok'] === 'ok'){
                    
                    $.post("ajax/interne/saveLink.php",
                        {
                        section: section,
                        name : name,
                        url : url,
                        image : data['name']
                        }, 
                    function(retour){
                        
                        if( retour['ok'] == 'ok'){
                            displayAlert('alertModaleInternalLink', 'success', 'Lien enregistré avec succès. La page va se recharger dans 3s');
                            setTimeout(function(){
                                window.location.reload();
                            }, 3000);
                        }else{
                            displayAlert('alertModaleInternalLink', 'danger', retour['error']);
                        }
                    });
                }
            }
        });
    }
});


$('#modifLinks').click(function(){
    
    if($('.buttonModifLinks').hasClass('d-none')){
        $('.buttonModifLinks').removeClass('d-none');
    }else{
        $('.buttonModifLinks').addClass('d-none');
    }
        
});

function moveBefore(id){
    
    var parent = document.getElementById('divLinkParent_'+id);
    var order = parent.dataset.order;
    var section = parent.dataset.section;
    var parentBefore = document.querySelectorAll('[data-order="'+(order-1)+'"][data-section="'+section+'"]')[0];
    var idParentBefore = parentBefore.id.substring(14)
     $.post("ajax/interne/changeOrderLink.php",
        {
        id: id,
        idOther : idParentBefore,
        order : order,
        newOrder : (order-1)        
        }, 
    function(retour){
        if(retour['ok'] = 'ok'){
            $(parent).insertBefore(parentBefore);
            parent.dataset.order = (order-1);
            parentBefore.dataset.order =  order;
        }
    });
};

function moveAfter(id){
    
    var parent = document.getElementById('divLinkParent_'+id);
    var order = parseInt(parent.dataset.order);
    var section = parseInt(parent.dataset.section);
    var parentAfter = document.querySelectorAll('[data-order="'+(order + 1)+'"][data-section="'+section+'"]')[0];
    var idParentAfter = parentAfter.id.substring(14);
     $.post("ajax/interne/changeOrderLink.php",
        {
        id: id,
        idOther : idParentAfter,
        order : order,
        newOrder : (order+1)        
        }, 
    function(retour){
        if(retour['ok'] = 'ok'){
            $(parent).insertAfter(parentAfter);
            parent.dataset.order = (order+1);
            parentAfter.dataset.order =  order;
        }
    });
};


function linkEdit(id){
    
    var parent = document.getElementById('divLinkParent_'+id);
    var name = document.getElementById('nameLink_'+id).innerHTML;
    var url = document.getElementById('urlLink_'+id).href;
    var image = document.getElementById('imgLink_'+id).src;
    var section = parseInt(parent.dataset.section);
    
    $('#selectSection').val(section);
    $('#internalLinkImage').val('');
    $('#previewLink').removeClass('d-none');
    $('#previewLink').attr('src', image);
    $('#internalLinkURL').val(url);
    $('#internalLinkName').val(name);
    $('#cancelModaleLink').addClass('d-none');
    $('#validNewLink').addClass('d-none');
    $('#deleteLink').removeClass('d-none');
    $('#modifLink').removeClass('d-none');
    $('#linkToModif').html(id);
    $('#linkModalTitle').html('Modification d\'un lien interne');
    
    $('#modaleCreateInternalLink').modal('show');
    
}

function modifLink(){
    
    console.log('imin')
    var section = $('#selectSection').val();
    var name = $('#internalLinkName').val();
    var url = $('#internalLinkURL').val();
    var imageSrc = $('#previewLink').attr('src');
    var arrayImage = imageSrc.split('/');
    var image = arrayImage[arrayImage.length - 1];
    var id = $('#linkToModif').html();
    var flagImage = 0;
    var flag = 0;
    var errors =[];
    
    if($('#modifImage').html() == 1){
        var preview = document.getElementById('previewLink');
        var nameImage = "";
        var formdata = new FormData();
        formdata.append('file', $('input[type=file]')[0].files[0]);
        
        if(preview.width > '150'){
            flag = 1;
            errors.push('Merci de choisir une image avec un ratio de 1.5 de proportion (100x150px par exemple).');
        }
        
        if (flag === 1){
        displayAlert('alertModaleInternalLink', 'danger', errors.join('<br>'));
        } else{
            $.ajax({
                url: "ajax/interne/saveLinkImage.php", // Url to which the request is send
                type: "POST", // Type of request to be send, called as method
                data: formdata, // Data sent to server, a set of key/value pairs (i.e. form fields and values)
                contentType: false, // The content type used when sending data to the server.
                cache: false, // To unable request pages to be cached
                processData: false,
                async : false,// To send DOMDocument or non processed data file it is set to false
                success: function (data)   // A function to be called if request succeeds
                {
                    if(data['ok'] === 'nok'){
                        displayAlert('alertModaleInternalLink', 'danger', data['error']);
                        flagImage = 1;
                    }else if (data['ok'] === 'ok'){
                        flagImage = 0;
                        image = data['name'];
                        
                    }
                }
            });
        }
    }
    if(section === '0'){
        flag = 1;
        errors.push('Merci de saisir une section pour ce lien');
    }
    
    if(name === ''){
        flag = 1;
        errors.push('Merci de saisir un nom pour ce lien');
    }
    
    if(url === ''){
        flag = 1;
        errors.push('Merci de saisir un URL valide pour ce lien');
    }

    if (flag === 1 ){
        displayAlert('alertModaleInternalLink', 'danger', errors.join('<br>'));
    } else if(flagImage === 0){
                    
        $.post("ajax/interne/modifLink.php",
            {
            section: section,
            name : name,
            url : url,
            image : image,
            valid : "1",
            id : id
            }, 
        function(retour){

            if( retour['ok'] == 'ok'){
                displayAlert('alertModaleInternalLink', 'success', 'Lien enregistré avec succès. La page va se recharger dans 3s');
                setTimeout(function(){
                    window.location.reload();
                }, 3000);
            }else{
                displayAlert('alertModaleInternalLink', 'danger', retour['error']);
            }
        });
    }
}

function deleteLink(){
    
    var section = $('#selectSection').val();
    var name = $('#internalLinkName').val();
    var url = $('#internalLinkURL').val();
    var imageSrc = $('#previewLink').attr('src');
    var arrayImage = imageSrc.split('/');
    var image = arrayImage[arrayImage.length - 1];
    var id = $('#linkToModif').html();
    
    $.post("ajax/interne/modifLink.php",
        {
        section: section,
        name : name,
        url : url,
        image : image,
        valid : "0",
        id : id
        }, 
    function(retour){

        if( retour['ok'] == 'ok'){
            displayAlert('alertModaleInternalLink', 'warning', 'Lien supprimé. La page va se recharger dans 3s');
            setTimeout(function(){
                window.location.reload();
            }, 3000);
        }else{
            displayAlert('alertModaleInternalLink', 'danger', retour['error']);
        }
    });
}