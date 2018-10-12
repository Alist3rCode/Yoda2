
var customLabelActi = {
    nada: { icon: './public/img/greyPin.png'},
    ris: { icon: './public/img/redPin.png'},
    pacs: { icon: './public/img/greenPin.png' },
    rispacs: { icon: './public/img/purplePin.png' },
};

var customLabelVers = {
    v6: { icon: './public/img/orangePin.png'},
    v7: { icon: './public/img/bluePin.png'},
    v8: { icon: './public/img/greyPin.png'}
};

var filter = 0;



$('input[type=radio][name=filter]').change(function() {
    if (this.id == 'aucunRB') {
         filter = 0;
         initMap('aucunRB','all');
    }
    else if (this.id == 'versionRB') {

        filter = 1;
        initMap('versionRB','all');
    }
    else if (this.id == 'activityRB') {

        filter = 1;
        initMap('activityRB','all');
    }
});   



function firstUpper(string) {
    $('#map').removeClass('d-none');
    return string.charAt(0).toUpperCase() + string.slice(1);
}

function initMap(RB,search) {

var map = new google.maps.Map(document.getElementById('map'), {
  center: new google.maps.LatLng(30,0),
  zoom: 3
});
var infoWindow = new google.maps.InfoWindow;

$.ajax({
        method: "GET",
        url: "ajax/CreateXML.php?search="+search,
        dataType : "JSON",
        async: false,
        success: function(json) {
           console.log(json)
        }
    });

  // Change this depending on the name of your PHP or XML file
  downloadUrl('./address.xml' , function(data) {
    var xml = data.responseXML;
    var markers = xml.documentElement.getElementsByTagName('marker');
    Array.prototype.forEach.call(markers, function(markerElem) {
      var name = markerElem.getAttribute('name');
      name = firstUpper(name);
      var address = markerElem.getAttribute('address');
      address = firstUpper(address);
      var activity = markerElem.getAttribute('activity');
      var version = markerElem.getAttribute('version');
      var point = new google.maps.LatLng(
          parseFloat(markerElem.getAttribute('lat')),
          parseFloat(markerElem.getAttribute('lng')));

      var infowincontent = document.createElement('div');
      var strong = document.createElement('strong');
      strong.textContent = name
      infowincontent.appendChild(strong);
      infowincontent.appendChild(document.createElement('br'));

      var text = document.createElement('text');
      text.textContent = address
      infowincontent.appendChild(text);

      if (RB== null || RB == 'aucunRB') {
         filter = 0;

        }
        else if (RB == 'versionRB') {
             var icon = customLabelVers[version] || {};
            filter = 1;

        }
        else if (RB == 'activityRB') {
            var icon = customLabelActi[activity] || {};
            filter = 1;

        }

   
      if(filter == 0){
        var marker = new google.maps.Marker({
            map: map,
            position: point
        });
      }else{
        var marker = new google.maps.Marker({
            map: map,
            position: point,
            icon: icon.icon
        });

      }

      marker.addListener('click', function() {
        infoWindow.setContent(infowincontent);
        infoWindow.open(map, marker);
      });
    });
  });

}




function downloadUrl(url, callback) {
var request = window.ActiveXObject ?
    new ActiveXObject('Microsoft.XMLHTTP') :
    new XMLHttpRequest;

request.onreadystatechange = function() {
  if (request.readyState == 4) {
    request.onreadystatechange = doNothing;
    callback(request, request.status);
  }
};

request.open('GET', url, true);
request.send(null);
}

function doNothing() {}
