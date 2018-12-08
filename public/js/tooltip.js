$('[data-toggle="tooltip"]').tooltip();

$('[data-toggle="tooltip"]').each(function(index, element){

    var tg = $(element);
    var idx = element.getAttribute('data-id');
        $.post("ajax/yoda/loadVersion.php",{
          id : idx,
          mode : "display"
        } , function(data) {
            tg.attr('data-original-title', data);
        });
});