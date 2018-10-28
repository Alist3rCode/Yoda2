function displayPhones(id){
    if (id){
        var collapseDiv = $('#collapse_' + id);
        $('.collapsePhone').remove();

        if(!collapseDiv.length){
            var location = document.getElementById('vignette_' + id).offsetTop;
            var newLocation = 0;
            var flag = 0;
            $( ".vignette" ).each(function( index ) {
                if(this.offsetTop-2 > location  && flag === 0){
                    newLocation = this.id.substring(9);

                    flag = 1;
                }
            });
            var clients = document.getElementById('clients');
            var newItem = document.createElement("div"); 
            newItem.id = 'collapse_' + id;
            newItem.classList.add('collapsePhone');

            clients.insertBefore(newItem, document.getElementById('vignette_' + newLocation) );
            $("#collapse_" + id).load("ajax/phones/loadDivPhone.php?id=" + id + "&user="+ document.getElementById('idUser').innerHTML); 

            collapseDiv = document.getElementById('collapse_' + id);
        }

    }else{
        $('.collapsePhone').remove();
    }
    
    
}
