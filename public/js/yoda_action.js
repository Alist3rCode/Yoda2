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
                '<div class="btn-group special col-md-6 groupModale '+rightTV+' " role="group">'+
                    '<button class="btn btn-outline-primary form-group disabled btn44" disabled  type="button" style="height:38px;">'+
                        '<i class="far fa-id-card"></i>'+
                    '</button>'+
                    '<input class="form-control col-md-10 idTVClass formCustom" type="text" id="idTV'+x+'" placeholder="ID Teamviewer..." autocomplete="off">'+
                '</div>'+
                '<div class="btn-group special col-md-6 groupModale  '+rightTV+'" role="group">'+
                    '<button class="btn btn-outline-primary form-group disabled btn44"  disabled type="button" style="height:38px;">'+
                        '<i class="fas fa-unlock"></i>'+
                    '</button>'+
                    '<input type="text" class="form-control col-10 passwordTVClass formCustom" id="passTV'+x+'"  placeholder="Mot de Passe..." autocomplete="off" >'+
                '</div>'+
            '</div>'+
            '<input type="hidden" value ="1" id="delete'+x+'">'+
            '<input type="hidden" value ="" id="id'+x+'">';

    $('#phones').append(str);
    $('#nbPhone').val(parseInt(phoneDisplayed)+1);
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
   $('#nbPhone').val(phoneDisplayed);
}   

function control_form() {
    var id = $('#id').html();
    
    var ville = $('#ville').val();
    var nom = $('#nom').val();
    var url = $('#url').val();
    
    //voir fonction Check dans tags.js, ça gère les tag
    var tag = '';
    check();
    tag = $('#tag_hidden').val();  
    
    var version = 'v7';
    var ris = 1;
    var pacs = 1;    
    
    var viewVersion = $('#viewVersion').val();
    var uViewVersion = $('#uViewVersion').val();
    var imagingVersion = $('#imagingVersion').val();
    
    var regexUrl = /^(https:\/\/)?([\da-z\.-]+)\.([a-z\.]{2,6})([\/\w \.-]*)*(:\d*)?\/?$/;
    var regexUrl2 = /^(https:\/\/)(([0-9]|[1-9][0-9]|1[0-9]{2}|2[0-4][0-9]|25[0-5])\.){3}([0-9]|[1-9][0-9]|1[0-9]{2}|2[0-4][0-9]|25[0-5])*(:(\d*))?\/?$/;
    var regexPhone = /((?:\+|00)[17](?: |\-)?|(?:\+|00)[1-9]\d{0,2}(?: |\-)?|(?:\+|00)1\-\d{3}(?: |\-)?)?(0\d|\([0-9]{3}\)|[1-9]{0,3})(?:((?: |\-)[0-9]{2}){4}|((?:[0-9]{2}){4})|((?: |\-)[0-9]{3}(?: |\-)[0-9]{4})|([0-9]{7}))/;
    var regexMap = /^(\-?\d+(\.\d+)?).\s*(\-?\d+(\.\d+)?)$/;
    var regexMail = /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
    
    uViewVersion===''?null:uViewVersion;    
    viewVersion===''?null:viewVersion;
    
    if($('#v6Button').hasClass('active')){
        version = 'v6';
    }else if($('#v7Button').hasClass('active')){
        version = 'v7';
    }else if($('#v8Button').hasClass('active')){
        version = 'v8';
    }
    
    if($('#risButton').hasClass('active')){
        ris = 1;
    }else{
        ris = 0;
    }
    if($('#pacsButton').hasClass('active')){
        pacs = 1;
    }else{
        pacs = 0;
    }    
    
    
   
    
    var errors = [];
    var flag = 0;
   
    if (ville === '') {
        errors.push('Merci de renseigner un nom de ville');
        flag = 1;
    }

    if (nom === '') {
        errors.push('Merci de renseigner un nom pour le client');
        flag = 1;
    }
    
    var match = regexUrl.test(url);
    var match2 = regexUrl2.test(url);

    if (!match && !match2) {
        errors.push('Merci de renseigner un URL valide avec https://');
        flag = 1;
    }
    
    if (url.substr(url.length - 1) !== '/'){
        url += '/';
    }
    
    var errorPhone = 0;
    var errorSite = 0;
    var errorGPS = 0;
    var errorTX = 0;
    var errorMail = 0;
    
    var listPhone = [];
    var listSite= [];
    var listIdPhone = [];
    var listDelete = [];
    var listLat = [];
    var listLon = [];
    var listMail = [];
    var listTX = [];
    var listIdTV = [];
    var listPasswordTV = [];
    
    var nbPhone =  parseInt($('#nbPhone').val());
    var phone = $('.phoneClass');
    var lat = $('.latClass');
    var lon = $('.lonClass');
    var eMail = $('.mailClass');
    var TX = $('.TXClass');
    var idTV = $('.idTVClass');
    var passwordTV = $('.passwordTVClass');
    var site = $('.siteClass');
    
    for (var i = 0; i < nbPhone; i++) {
        if(nbPhone === 1 && phone[i].value === ''){
            listPhone =[];
            listLat = [];
            listLon = [];
            listMail = [];
            listTX = [];
            listIdTV = [];
            listPasswordTV = [];
            nbPhone = 0; 
        }else{
            var match3 = regexPhone.test(phone[i].value);
            var matchMail = regexMail.test(eMail[i].value);
            var matchTX1 = regexUrl.test(TX[i].value);
            var matchTX2 = regexUrl2.test(TX[i].value);            
           
            listIdPhone[i] = $('#id'+i).val();
            listDelete[i] = $('#delete'+i).val();
            
            if (!match3) {
                if(errorPhone === 0){
                    errors.push('Merci de renseigner un ou plusieurs numéro(s) de téléphone valide');
                    flag = 1;
                    errorPhone = 1;
                }
            }else{
                listPhone[i] = phone[i].value;
            }
            
            
            if (nbPhone > 1){
                listSite[i] = site[i].value;
                if (site[i].value === '') {
                    if(errorSite === 0 ){
                        errors.push('Merci de renseigner un ou plusieurs nom de site(s) secondaire valide(s)');
                        flag = 1;
                        errorSite = 1;
                    }
                }
            }
            
            var match4 = regexMap.test(lat[i].value);
            var match5 = regexMap.test(lon[i].value);
            if (lat[i].value !== '' && lon[i].value !== ''){
               if (!match4 && !match5) {
                    if(errorGPS === 0){
                        errors.push('Merci de renseigner des coordonnées GPS valides');
                        flag = 1;
                        errorGPS = 1;
                    }
                }else{
                    listLat[i] = lat[i].value;
                    listLon[i] = lon[i].value;
                } 
            }
            
            if (eMail[i].value !== ''){
                if (!matchMail) {
                    if(errorMail === 0){
                        errors.push('Merci de renseigner une ou plusieurs adresse eMail valide');
                        flag = 1;
                        errorMail = 1;
                    }
                }else{
                    listMail[i] = eMail[i].value;
                }
            }
            
            if(TX[i].value !== ''){
               if (!matchTX1 && !matchTX2) {
                    if(errorTX === 0){
                        errors.push('Merci de renseigner une ou plusieurs adresse de TX valide');
                        flag = 1;
                        errorTX = 1;
                    }
                }else{
                    listTX[i] = TX[i].value;
                } 
            }           
            
            if(idTV[i].value !== ''){
                listIdTV[i] = idTV[i].value;
            }
            
            if(passwordTV[i].value !== ''){
                listPasswordTV[i] = passwordTV[i].value; 
            }
            
            
        }
    }
    
    if (flag === 1) {
        flag = '';
        displayAlerteModale('danger',errors.join("<br>"));
        return {
            'ok' : 0,
            'error': errors
        };
       
    } else {
       return {
            'ok' : 1,
            'id': id,
            'ville': ville.toLowerCase(),
            'nom': nom.toLowerCase(),
            'url': url, 
            'version': version, 
            'ris' : parseInt(ris),
            'pacs' : parseInt(pacs),
            'tag': tag.toLowerCase(), 
            'phone': listPhone, 
            'site': listSite, 
            'listIdPhone': listIdPhone,
            'listDelete' : listDelete,
            'nbPhone': nbPhone,
            'lat': listLat,
            'lon': listLon,
            'mail': listMail,
            'TX': listTX,
            'idTV': listIdTV,
            'passwordTV': listPasswordTV,
            'viewVersion': viewVersion,
            'uViewVersion' : uViewVersion,
            'imagingVersion': imagingVersion
        };
    }
}

$('#buttonSubmit').click(function(){
    
    var array = [] ;
    var idUser = $('#idUser').html();
    array = control_form();
    array.idUser = idUser;
    
    if (array['ok'] === 1){
        $.post("ajax/createCustomer.php", 
            {array},
            
            function(ok){
                result = JSON.parse(ok);
                if(result.result === 'ok'){
                    displayAlertModale('success','Le client a bien été ajouté avec l\'ID ' + result.id);
//                    $.post("ajax/notifMailCreateCustomer.php", 
//                    {id: result.id, idUser : idUser});
                    $('#modaleClient').modal('hide');
                    location.reload();
                }else{
                    console.log(ok);
                }
        });
    }
    
});