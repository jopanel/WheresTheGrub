$(document).ready(function(){

// delivers, opennow, pickup, wifi, vegie, kids, access, bar, reservations, 24hr
function search() {
    locations = [];
    lists = [];
    savedata = [];
    if (document.getElementById("opennow").checked) {var opennow = 1;} else {var opennow = 0;}
    if (document.getElementById("delivers").checked) {var delivers = 1;} else {var delivers = 0;}
    if (document.getElementById("pickup").checked) {var pickup = 1;} else {var pickup = 0;}
    if (document.getElementById("wifi").checked) {var wifi = 1;} else {var wifi = 0;}
    if (document.getElementById("vegie").checked) {var vegie = 1;} else {var vegie = 0;}
    if (document.getElementById("kids").checked) {var kids = 1;} else {var kids = 0;}
    if (document.getElementById("access").checked) {var access = 1;} else {var access = 0;}
    if (document.getElementById("bar").checked) {var bar = 1;} else {var bar = 0;}
    if (document.getElementById("reservations").checked) {var reservations = 1;} else {var reservations = 0;}
    if (document.getElementById("24hr").checked) {var 24hr = 1;} else {var 24hr = 0;}

    ajax("http://autobodylocator.com/api/locator?api_key=zxmSS6PIYsW1WPxLoWYqpZ6WAIeN1keY&version=1.0&format=json&zip="+zip, function(data){
         var jsonObj = JSON.parse(data);
         //json decryption in data
         var jlen = jsonObj.shop_list.length;
         for (var i=0; i<jlen; i++) {
         var buildhtml = "";
         savedata[jsonObj.shop_list[i].apnid] = jsonObj.shop_list[i];
         var companyname = jsonObj.shop_list[i].company_name;
         // buildhtml is the inner map html after clicking pin
         buildhtml = "<strong style='color: black'>"+companyname+"</strong><hr><p style='color: black;'>"+address1+address2+"<br>"+city+", "+state+" "+zip+"<hr><a style='color:black;' href='tel:"+phone+"'>"+phone+"</a><br><button onClick='openshop("+jsonObj.shop_list[i].apnid+")'>Open Shop</button>";
         var buildarray = [buildhtml,lat,lon];
         locations.push(buildarray);
         var buildlist = '<div onClick="openshop('+jsonObj.shop_list[i].apnid+')" class="shop-result">'+thepic+'<p class="shop-distance-result">X<span>mi</span></p><div class="shop-info"><p class="shop-name">'+companyname+'</p><p class="shop-address">'+address1+' '+address2+', '+state+' '+zip+'</p><p class="shop-phone"><a href="tel:'+phone+'">'+phone+'</a></p></div></div>';
         /*
         <div class="grub-spot">
                        <div class="grub-text">
                            <h3>Restaurant Name</h3>
                            <p>1234 street address</p>
                            <p>City, CA 90020</p>
                            <ul>
                                <li>*</li>
                                <li>*</li>
                                <li>*</li>
                                <li>*</li>
                                <li>*</li>
                            </ul>
                        </div>
                    </div>
        */

         lists.push(buildlist);
         var v = document.getElementById("listcontainer");
         v.innerHTML = "";
         
         }
         
         new meow();
         });
}

var maploadcount = 0;
function loadMAP() {
    
    document.getElementById("map").innerHTML = "";
    var map = new google.maps.Map(document.getElementById('map'), {
                                  zoom: 10,
                                  center: new google.maps.LatLng(locations[0][1], locations[0][2]),
                                  mapTypeId: google.maps.MapTypeId.ROADMAP
                                  });
    
    var infowindow = new google.maps.InfoWindow();
    
    var marker, i;
    for (i = 0; i < locations.length; i++) {
        var image = 'img/car-icon.png';
        // create map
        marker = new google.maps.Marker({
                                        position: new google.maps.LatLng(locations[i][1], locations[i][2]),
                                        map: map,
                                        icon: image
                                        });
        
        google.maps.event.addListener(marker, 'click', (function(marker, i) {
                                                        return function() {
                                                        infowindow.setContent(locations[i][0]);
                                                        infowindow.open(map, marker);
                                                        }
                                                        })(marker, i));
    }
    
}

function meow() {
    var testing = "";
    for (i = 0; i < lists.length; i++) {
        testing += lists[i];
        
    }
    document.getElementById("listcontainer").innerHTML = "";
    
    
    $('#listcontainer').empty();
    $('#listcontainer').append($(testing));
    $('#listcontainer').trigger('create');
    
    
}

function getXmlHttpObject() {
    var xmlHttp;
    try {
        // Firefox, Opera 8.0+, Safari
        xmlHttp = new XMLHttpRequest();
    } catch (e) {
        // Internet Explorer
        try {
            xmlHttp = new ActiveXObject("Msxml2.XMLHTTP");
        } catch (e) {
            xmlHttp = new ActiveXObject("Microsoft.XMLHTTP");
        }
    }
    if (!xmlHttp) {
        showprompt("Your browser does not support AJAX!", "Wait");
    }
    return xmlHttp;
}


function ajax(url, onSuccess, onError) {
    
    var xmlHttp = getXmlHttpObject();
    
    xmlHttp.onreadystatechange = function() {
        if (this.readyState === 4) {
            
            // onSuccess
            if (this.status === 200 && typeof onSuccess == 'function') {
                onSuccess(this.responseText);
                
            }
            
            // onError
            else if(typeof onError == 'function') {
                onError();
            }
            
        }
    };
    xmlHttp.open("GET", url, true);
    xmlHttp.send(null);
    return xmlHttp;
}

})