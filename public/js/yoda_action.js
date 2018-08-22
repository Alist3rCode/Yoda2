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

$('#modaleClient').on('hidden.bs.modal', function (e) {
    
    $( "#modaleClient" ).load( "public/modaleClient.php" );
    
});


function newPhone(i) {
      
    var newPhone = $('.newPhone');
    var phoneDisplayed = newPhone.length;
    var survivor = 0;
    var rightTV = $('#rightTV').html();
    
    for(y=0; y < newPhone.length; y++){
        if($('#divPhone' + y).hasClass('d-none')){
            phoneDisplayed -= 1;
        }else{
            survivor = y;
        }
    }
    
    if(phoneDisplayed === 1){
        $('#phone' + survivor).removeClass("col-10");
        $('#phone' + survivor).addClass("col-5");
        $('#site' + survivor).removeClass("d-none");
        $('#deletePhone' + survivor).prop("disabled",false);
        $('#deletePhone' + survivor).removeClass("btn-outline-secondary");
        $('#deletePhone' + survivor).addClass("btn-outline-danger");
    }
  
    $('#newPhone'+i).prop("disabled",true);
  
    x = newPhone.length ;
    var str = '<div id="divPhone'+x+'" class="col-12 row divPhoneModale">'+
                '<div class="btn-group special col-12 phoneModale" role="group" >'+
                    '<button type="button" class="btn btn-outline-success form-group col-1 newPhone"  id="newPhone0" onclick="newPhone('+x+')">'+
                        '<i class="fa fa-plus"></i>'+
                    '</button>'+
                    '<input class="form-group col-5 siteClass" type="text" id="site'+x+'" placeholder="Site..." autocomplete="off">'+
                    '<input class="form-group col-5 phoneClass" type="text" id="phone'+x+'" placeholder="Téléphone..." autocomplete="off">'+
                    '<button type="button" class="btn btn-outline-danger form-group col-1 deletePhone"  id="deletePhone'+x+'" onclick="deletePhone('+x+')">'+
                        '<i class="far fa-trash-alt"></i>'+
                    '</button>'+
                '</div>'+
                '<div class="btn-group special col-md-6 groupModale"  role="group">'+
                    '<button class="btn btn-outline-primary form-group disabled btn44"  disabled type="button" style="height:38px;">'+
                        '<i class="fas fa-map"></i>'+
                    '</button>'+
                    '<input class="form-control col-md-10 latClass formCustom" type="text" id="lat'+x+'" placeholder="Latitude..." autocomplete="off">'+
                '</div>'+
                '<div class="btn-group special col-md-6 groupModale" role="group">'+
                    '<button class="btn btn-outline-primary form-group disabled btn44" disabled type="button" style="height:38px;">'+
                        '<i class="far fa-map"></i>'+
                    '</button>'+
                    '<input class="form-control col-md-10 lonClass formCustom" type="text" id="lon'+x+'" placeholder="Longitude..." autocomplete="off">'+
                '</div>'+
                '<div class="btn-group special col-md-6 groupModale" role="group">'+
                    '<button class="btn btn-outline-primary form-group disabled btn44" disabled  type="button" style="height:38px;">'+
                        '<i class="far fa-envelope"></i>'+
                    '</button>'+
                    '<input class="form-control col-md-10 mailClass formCustom" type="text" id="mail'+x+'" placeholder="eMail..." autocomplete="off">'+
                '</div>'+
                '<div class="btn-group special col-md-6 groupModale" role="group">'+
                    '<button class="btn btn-outline-primary form-group disabled btn44"  disabled type="button" style="height:38px;">'+
                        '<i class="fas fa-external-link-alt"></i>'+
                    '</button>'+
                    '<input type="text" class="form-control col-10 TXClass formCustom" id="TX'+x+'"  placeholder="Adresse TX..." autocomplete="off">'+
                '</div>'+
                '<div class="btn-group special col-md-6 groupModale" role="group">'+
                    '<button class="btn btn-outline-primary form-group disabled btn44" disabled  type="button" style="height:38px;">'+
                        '<i class="far fa-id-card"></i>'+
                    '</button>'+
                    '<input class="form-control '+rightTV+' col-md-10 idTVClass formCustom" type="text" id="idTV'+x+'" placeholder="ID Teamviewer..." autocomplete="off">'+
                '</div>'+
                '<div class="btn-group special col-md-6 groupModale " role="group">'+
                    '<button class="btn btn-outline-primary form-group disabled btn44"  disabled type="button" style="height:38px;">'+
                        '<i class="fas fa-unlock"></i>'+
                    '</button>'+
                    '<input type="text" class="form-control '+rightTV+' col-10 passwordTVClass formCustom" id="passTV'+x+'"  placeholder="Mot de Passe..." autocomplete="off" >'+
                '</div>'+
            '</div>'+
            '<input type="hidden" value ="1" id="delete'+x+'">'+
            '<input type="hidden" value ="" id="id'+x+'">';

    $('#phones').append(str);
}


function deletePhone(i){
   
    
    $('#divPhone' + i).addClass('d-none');
    $('#delete' + i).val(0);
    
    var newPhone = $('.newPhone');
    var phoneDisplayed = newPhone.length;
    var survivor = 0;
    for(y=0; y < newPhone.length; y++){
        if($('#divPhone' + y).hasClass('d-none')){
            phoneDisplayed -= 1;
        }else{
            survivor = y;
        }
    }
    
    if(phoneDisplayed === 1){
        $('#phone' + survivor).addClass("col-10");
        $('#phone' + survivor).removeClass("col-5");
        $('#site' + survivor).addClass("d-none");
        $('#deletePhone' + survivor).prop('disabled', true);
        $('#deletePhone' + survivor).addClass("btn-outline-secondary");
        $('#deletePhone' + survivor).removeClass("btn-outline-danger");
   }   
   $('#newPhone' + survivor).prop('disabled',false);
}   

