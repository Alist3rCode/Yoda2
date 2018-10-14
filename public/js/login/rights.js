function selectRight(id) {

    var name = $('#unselectItem-' + id).html();
    $('#unselectItem-' + id).remove();
    $("#selectedRights").append('<li class="list-group-item list-group-item-success selected" data-id=' + id + ' id="selectItem-' + id + '"  onclick="unselectRight(' + id + ')">' + name + '</li>');

    var elems = $('#selectedRights').children('li').remove();
    elems.sort(function(a, b) {
        return parseInt(a.dataset.id) > parseInt(b.dataset.id);
    });
    $('#selectedRights').append(elems);

}

function unselectRight(id) {

    var name = $('#selectItem-' + id).html();
    $('#selectItem-' + id).remove();
    $("#unselectedRights").append('<li class="list-group-item list-group-item-danger unselected" data-id=' + id + ' id="unselectItem-' + id + '" onclick="selectRight(' + id + ')">' + name + '</li>');

    var elems = $('#unselectedRights').children('li').remove();
    elems.sort(function(a, b) {
        return parseInt(a.dataset.id) > parseInt(b.dataset.id);
    });
    $('#unselectedRights').append(elems);

}

$("#selectAllRights").click(function(evt) {

    $(".unselected").click();

});

$("#unselectAllRights").click(function(evt) {

    $(".selected").click();

});

function selectRightUser(id) {

    var name = $('#nameRight'+ id).html();
    console.log('select  '+ name);
    $('#unselectItemUser-' + id).remove();
    $("#selectedRightsUser").append('<li class="list-group-item list-group-item-success selectedUser" data-id=' + id 
            + ' data-type="User" id="selectItemUser-' + id + '"  onclick="unselectRightUser(' + id + ')"><span id="nameRight'+ id +'">' + name + '</span><span class="text-muted"> - User</span></li>');

    var elems = $('#selectedRightsUser').children('li').remove();
    elems.sort(function(a, b) {
        return parseInt(a.dataset.id) > parseInt(b.dataset.id);
    });
    $('#selectedRightsUser').append(elems);

}

function unselectRightUser(id) {

    var name = $('#nameRight'+ id).html();
    console.log('unselect  '+ name);
    $('#selectItemUser-' + id).remove();
    $("#unselectedRightsUser").append('<li class="list-group-item list-group-item-danger unselectedUser" data-id=' + id 
            + ' id="unselectItemUser-' + id + '" onclick="selectRightUser(' + id + ')"><span id="nameRight'+ id +'">' + name + '</span></li>');

    var elems = $('#unselectedRightsUser').children('li').remove();
    elems.sort(function(a, b) {
        return parseInt(a.dataset.id) > parseInt(b.dataset.id);
    });
    $('#unselectedRightsUser').append(elems);

}

$("#selectAllRightsUser").click(function(evt) {

    $(".unselectedUser").click();

});

$("#unselectAllRightsUser").click(function(evt) {

    $(".selectedUser").click();

});