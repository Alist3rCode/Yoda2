$('[data-toggle="tooltip"]').tooltip();

$('[data-toggle="tooltip"]').each(function(index, element){

    var tg = $(element);
    var idx = element.getAttribute('data-id');
        $.get("ajax/loadVersion.php?id=" + idx, function(data) {
            tg.attr('data-original-title', data);
        });
});


function clickModaleVersion(version){
    v = version?version:'v7';
    
    $('.versionModale button').removeClass('active');
    $('#'+v+'Button').addClass('active');

}

function clickModaleActivity(activity){
    if (activity){
        if ($('#'+activity+'Button').hasClass('active')){
            $('#'+activity+'Button').removeClass('active');
        }else{
            $('#'+activity+'Button').addClass('active');
        }
    }else{
        $('#risButton').removeClass('active');
        $('#pacsButton').removeClass('active');
    }
    

}

//$('#modaleClient').on('hidden.bs.modal', function (e) {
//   while($("#petitTag").length !== 0){
//        $("#petitTag").remove();
//    }
//    
//    $('#myModalLabel').html("Rien");
//    $('#id').html('');
//    
//    var rightTV = $('#rightTV').html();    
//    
//    var ville = $('#ville');        
//    var nom = $('#nom');        
//    var url = $('#url');
//    
//    
//    
//    var v8 = $('#v8Button');
//    var v7 = $('#v7Button');
//    var v6 = $('#v6Button');
//    
//    var tags = $('#tag');
//    var tagHidden = $('#tag_hidden');
//    
//    ville.val('');
//    nom.val('');
//    url.val('');
//    
//    tags.val('Tags...');
//    tagHidden.val('');
//       
//    clickModaleVersion();
//    clickModaleActivity();
//    
//    $('#viewVersion').val('');
//    $('#uViewVersion').val('');
//    $('#imagingVersion').val('');
//      
//     
//    $('#phones').html('<div id="divPhone0" class="col-12 row divPhoneModale">' +
//                            '<div class="btn-group special col-12 phoneModale" role="group" >'+
//                                '<button type="button" class="btn btn-outline-success form-group col-1 newPhone"  id="newPhone0" onclick="newPhone(0)">'+
//                                    '<i class="fa fa-plus"></i>'+ 
//                                '</button>'+
//                                '<input class="form-group col-5 d-none siteClass" type="text" id="site0" placeholder="Site..." autocomplete="off">'+
//                                '<input class="form-group col-10 phoneClass" type="text" name="phone0" id="phone0" placeholder="Téléphone..." autocomplete="off">'+
//                                '<button type="button" class="btn btn-outline-secondary form-group col-1 deletePhone"  id="deletePhone0" disabled onclick="deletePhone(0)">'+
//                                    '<i class="far fa-trash-alt"></i>'+
//                                '</button>'+
//                            '</div>'+
//                            '<div class="btn-group special col-md-6 groupModale"  role="group">'+
//                                '<button class="btn btn-outline-primary form-group disabled btn44"  disabled type="button" style="height:38px;">'+
//                                    '<i class="fas fa-map"></i>'+
//                                '</button>'+
//                                '<input class="form-control col-md-10 latClass formCustom" type="text" id="lat0" placeholder="Latitude..." autocomplete="off">'+
//                            '</div>'+
//                            '<div class="btn-group special col-md-6 groupModale" role="group">'+
//                                '<button class="btn btn-outline-primary form-group disabled btn44" disabled type="button" style="height:38px;">'+
//                                    '<i class="far fa-map"></i>'+
//                                '</button>'+       
//                                '<input class="form-control col-md-10 lonClass formCustom" type="text" id="lon0" placeholder="Longitude..." autocomplete="off">'+
//                            '</div>'+
//                            '<div class="btn-group special col-md-6 groupModale" role="group">'+
//                                '<button class="btn btn-outline-primary form-group disabled btn44" disabled  type="button" style="height:38px;">'+
//                                    '<i class="far fa-envelope"></i>'+
//                               '</button>'+     
//                                '<input class="form-control col-md-10 mailClass formCustom" type="text" id="mail0" placeholder="eMail..." autocomplete="off">'+
//                            '</div>'+
//                            '<div class="btn-group special col-md-6 groupModale" role="group">'+
//                                '<button class="btn btn-outline-primary form-group disabled btn44"  disabled type="button" style="height:38px;">'+
//                                    '<i class="fas fa-external-link-alt"></i>'+
//                                '</button>'+
//                                '<input type="text" class="form-control col-10 TXClass formCustom" id="TX0"  placeholder="Adresse TX..." autocomplete="off">'+
//                            '</div>'+
//                            '<div class="btn-group special col-md-6 groupModale" role="group">'+
//                                '<button class="btn btn-outline-primary form-group disabled btn44" disabled  type="button" style="height:38px;">'+
//                                    '<i class="far fa-id-card"></i>'+
//                                '</button>'+     
//                                '<input class="form-control col-md-10 idTVClass formCustom" type="text" id="idTV0" placeholder="ID Teamviewer..." autocomplete="off">'+
//                            '</div>'+
//                            '<div class="btn-group special col-md-6 groupModale " role="group">'+
//                                '<button class="btn btn-outline-primary form-group disabled btn44"  disabled type="button" style="height:38px;">'+
//                                    '<i class="fas fa-unlock"></i>'+
//                                '</button>'+
//                                '<input type="text" class="form-control col-10 passwordTVClass formCustom" name="passTV0" id="passTV0"  placeholder="Mot de Passe..." autocomplete="off" >'+
//                           '</div>'+
//                        '</div>'+
//                        
//                        '<input type="hidden" value="1" id="delete0" name="delete0">'+
//                        '<input type="hidden" value="" id="id0" name="id0">'
//            
//    
//            
//            );
//                        
//    document.getElementById('alerte').innerHTML = '';
//                        
//    
//});

$('#modaleClient').on('hidden.bs.modal', function (e) {
    
    $( "#modaleClient" ).load( "public/modaleClient.php" );
    
});
