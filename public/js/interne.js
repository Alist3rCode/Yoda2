$('#editSectionButton').click(function(){
    if ($('#createSection').hasClass('show')){
        $('#createSection').collapse('hide');
        $('#internalCreateSectionName').val('');
        $('#createSection').on('hidden.bs.collapse', function () {
            $('#editSection').collapse('show');
        });
    }else{
        $('#editSection').collapse('show');
    }
    $('#internalEditSectionName').val($('#selectSection option:selected').text());
    console.log($('#selectSection option:selected').text());
});

$('#createSectionButton').click(function(){
    
     if ($('#editSection').hasClass('show')){
        $('#editSection').collapse('hide');
        $('#internalEditSectionName').val('');
        $('#editSection').on('hidden.bs.collapse', function () {
            $('#createSection').collapse('show');
        });
    }else{
        $('#createSection').collapse('show');
    }
});

$("#selectSection").change(function() {
    $('#createSection').collapse('hide');
    $('#editSection').collapse('hide');
    
});

function readURL(input) {

    if (input.files && input.files[0]) {
        var reader = new FileReader();

        reader.onload = function(e) {
            $('#previewLink').attr('src', e.target.result);
            $('#previewLink').removeClass('d-none');
        };

        reader.readAsDataURL(input.files[0]);
    }
}

$("#internalLinkImage").change(function() {
    readURL(this);
});


$('#validNewSection').click(function(){
   var value = $('#internalCreateSectionName').val();
   console.log(value);
    if(value == ''){
        
        displayAlert('alertModaleInternalLink','danger','Merci de saisir un nom de section.');
        
    }else{
        
        $.get("ajax/createSection.php?value=" + value , function(retour){
            
            if(retour['ok'] === 'ok'){
                $('#selectSection').append('<option value="'+retour['id']+'">'+value+'</option>');
                $('#selectSection').val(retour['id']);
                displayAlert('alertModaleInternalLink','success','Section créée.');
                $('#createSection').collapse('hide');
            }
            
        });
    }

});

$('#validModifSection').click(function(){
   var value = $('#internalEditSectionName').val();
   var id = $('#selectSection').val();
   console.log(value);
    if(value == ''){
        
        displayAlert('alertModaleInternalLink','danger','Merci de saisir un nom de section.');
        
    }else{
        
        $.get("ajax/modifSection.php?value=" + value + "&id=" + id + "&valid=1", function(retour){
            
            if(retour['ok'] === 'ok'){
                $('#selectSection option:contains("'+retour['name']+'")').text(value);
                displayAlert('alertModaleInternalLink','success','Les modifications effectuées ont été enregistrées.');
                $('#editSection').collapse('hide');
            }
            
        });
    }

});