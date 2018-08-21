$('[data-toggle="tooltip"]').tooltip();

$('[data-toggle="tooltip"]').each(function(index, element){
    
    var tg = $(element);
    var idx = element.getAttribute('data-id');
        $.get("ajax/loadVersion.php?id=" + idx, function(data) {
            tg.attr('data-original-title', data);
        });
});


function clickModaleVersion(version){
    $('.versionModale button').removeClass('active');
    $('#'+version+'Button').addClass('active');
}

function clickModaleActivity(activity){
    if ($('#'+activity+'Button').hasClass('active')){
        $('#'+activity+'Button').removeClass('active');
    }else{
        $('#'+activity+'Button').addClass('active');
    }
    
}