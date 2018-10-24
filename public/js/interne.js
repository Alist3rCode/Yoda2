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
});


$('#validNewSection').click(function () {
    var value = $('#internalCreateSectionName').val();

    if (value == '') {

        displayAlert('alertModaleInternalLink', 'danger', 'Merci de saisir un nom de section.');

    } else {

        $.get("ajax/createSection.php?value=" + value, function (retour) {

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

        $.get("ajax/modifSection.php?value=" + value + "&id=" + id + "&valid=1", function (retour) {

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

    $.get("ajax/checkDeleteSection.php?id=" + id, function (retour) {

        if (retour['ok'] === 'ok' && retour['delete'] === 'YES') {

            $.get("ajax/modifSection.php?value=" + value + "&id=" + id + "&valid=0", function (retour) {

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

    if (flag === 1){
        displayAlert('alertModaleInternalLink', 'danger', errors.join('<br>'));
    } else{
        $.ajax({
            url: "ajax/saveLinkImage.php", // Url to which the request is send
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
                    
                    $.post("ajax/saveLink.php",
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