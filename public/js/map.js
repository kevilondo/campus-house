
var address = document.getElementById('address').innerHTML;

var lat, lng;


function geocode()
{
    if (window.XMLHttpRequest) 
    {
        
        xmlhttp = new XMLHttpRequest();
    } 
    else
    {
        
        xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
    }
    
    xmlhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200)
        {
            var response = JSON.parse(this.response);
            console.log(response)
            lat = response.results[0].geometry.location.lat;
            lng = response.results[0].geometry.location.lng;

            initMap();
            
        }
    };
    var PageToSendTo = "https://maps.googleapis.com/maps/api/geocode/json?";
    var addressUrl = address.replace(' ', '+');
    var addressData = "address=" + addressUrl;
    var key = "&key=" + 'AIzaSyCPpd0mCpEYxt3GDnOcFZtmY4IeaqUHPts';
    var UrlToSend = PageToSendTo + addressData + key;
    xmlhttp.open("GET", UrlToSend, true);
    xmlhttp.send();

}



function initMap()
{

    //get the position from geocode
    

    var options = 
    {
        zoom:16,
        center: {lat: parseFloat(lat), lng: parseFloat(lng)}
    }

    var map = new google.maps.Map(document.getElementById('map'), options);

    //add marker
    var marker = new google.maps.Marker({
        //position:{lat:lat, lng:lng}, map:map
        position:{lat: parseFloat(lat), lng: parseFloat(lng)}, map:map
    });
    
    //add info window

    var infoWindow = new google.maps.InfoWindow({
        content: address
    });

    marker.addListener('click', function(){
        infoWindow.open(map, marker);
    });

}


geocode();

/*var counter = 0;

var interval = setTimeout(() => {
    initMap();
    counter += 1;
}, 1000);


//after 3 seconds, the counter will stop
if (counter == 3)
{
    clearInterval(interval);
}*/
